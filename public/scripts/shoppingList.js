/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery Swiper template*/

'use strict';

(function ($, Swiper) {
    // 导航条自动隐藏
    $('#header').headroom({
        'tolerance': .5,
        'offset': 44,
        'classes': {
            // when above offset
            top: 'animated',
            // when below offset
            notTop: 'animated',
            // when at bottom of scoll area
            bottom: 'animated',
            // when not at bottom of scroll area
            notBottom: 'animated',
            // when element is initialised
            initial: 'animated',
            // when scrolling up
            pinned: 'slideInDown',
            // when scrolling down
            unpinned: 'slideOutUp'
        }
    });

    // 导航条自动隐藏
    $('#tabIndex-container').headroom({
        'tolerance': .5,
        'offset': 44,
        'classes': {
            // when above offset
            top: 'animated',
            // when below offset
            notTop: 'animated',
            // when at bottom of scoll area
            bottom: 'animated',
            // when not at bottom of scroll area
            notBottom: 'animated',
            // when element is initialised
            initial: 'animated',
            // when scrolling up
            pinned: 'tabIndexDown',
            // when scrolling down
            unpinned: 'tabIndexUp'
        }
    });

    // 选项卡导航
    var TabIndexSwiper = new Swiper('#tabIndex-container', {
        freeMode: true,
        slidesPerView: 'auto',
        freeModeMomentumRatio: .5,
        onTap: function onTap() {
            if ($(event.target).is('li') || $(event.target).is('a') || $(event.target).is('span')) {
                tabSwitch(TabIndexSwiper.clickedIndex);
            }
        }
    });

    // 选项卡容器
    var TabsContainerSwiper = new Swiper('#tabs-container', {
        autoHeight: true,
        onlyExternal: true
    });

    // 导航和选项卡容器 联动的方法
    function tabSwitch(index) {
        // 选项卡序号 移动
        TabIndexSwiper.slideTo(index, 500, false);
        // 选项卡 移动ta
        TabsContainerSwiper.slideTo(index, 500, false);
        // 为选项卡序号 更改样式
        $(TabIndexSwiper.slides).children('a').addClass('inactive');
        $(TabIndexSwiper.slides[index]).children('a').removeClass('inactive');
    }

    // Category 分类列表
    // TabsPage 记录各个选项卡Index对应的页码数
    var Category = [],
        TabsPage = [];

    /**
     * 对选项卡 所加载的页码 集合, 根据分类 Category 的数目, 进行初始化
     * @param ArraryLength
     */
    function tabsPageInit(ArraryLength) {
        TabsPage.length = ArraryLength;
        $.each(TabsPage, function (index) {
            TabsPage[index] = 0;
        });
    }

    // 获取分类
    (function category() {
        $.ajax({
            url: '/category'
        }).done(function (data) {
            if (data.success === true) {
                Category = data.data.list;
                // Tabs页码数组初始化
                tabsPageInit(Category.length);
                console.log('获取分类成功');
                // 首次打开 加载相应页面
                tabsLoading();
            } else {
                console.log('获取分类失败');
            }
        });
    })();

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 100 + scrollCurrent) {
            tabsLoading();
        }
    }

    // 加载动画显示
    function loadingShow(CurrentTab) {
        $(TabsContainerSwiper.slides[CurrentTab]).find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide(CurrentTab) {
        $(TabsContainerSwiper.slides[CurrentTab]).find('.loading').hide();
    }

    // function errorShow() {
    // TODO
    // }
    //
    // function errorHide() {
    // TODO
    // }

    // 遍历模板, 插入数据到指定位置
    /**
     *
     * @param ProductsList
     */
    function appendProductsList(ProductsList, CurrentTab) {
        var TplHtml = template('tpl-product', ProductsList);
        var StageCache = $.parseHTML(TplHtml);
        // TODO 插入页面相应位置
        $(TabsContainerSwiper.slides[CurrentTab]).find('.row').append(StageCache);
    }

    /**
     * 加载商品列表, ajax请求
     * @need appendProductsList()
     */
    function tabsLoading() {
        // 当前激活的选项卡容器
        var ActiveTab = TabsContainerSwiper.activeIndex;

        // 当前选项卡
        var $Current = $(TabsContainerSwiper.slides[ActiveTab]);

        // 判断当前选项卡是否在加载中
        if ($Current.data('loading') === true) {
            return;
        } else {
            $Current.data('loading', true);
        }

        // 判断当前选项卡是否还有数据要加载
        if (TabsPage[ActiveTab] === null) {
            return;
        }

        // 当前选项卡所要加载的分页页码
        var CurrentPage = TabsPage[ActiveTab],
            NextPage = ++CurrentPage;
        // 当前激活的分类ID
        var CurrentCid = Category[ActiveTab].category_id;

        // 显示加载动画
        loadingShow(ActiveTab);
        // ajax 请求加载数据
        $.ajax({
            url: '/products',
            data: { pagenum: NextPage, pagesize: 20, cid: CurrentCid }
        }).done(function (data) {
            if (data.data === null || data.data === '') {
                return;
            } else if (data.data.list.length === 0) {
                // 没有数据要加载
                TabsPage[ActiveTab] = null;
                return;
            }
            // 遍历模板 插入页面
            appendProductsList(data.data, ActiveTab);
            // TabsPage 选项卡加载页 页码+1
            TabsPage[ActiveTab]++;
        })
        // TODO failed 时的提示
        .always(function () {
            // 隐藏加载动画
            loadingHide(ActiveTab);
            // 请求结束, loading = false
            $Current.data('loading', false);
        });
    }

    // 为选项卡导航, 绑定一次性事件, 加载商品数据
    $('#tabIndex-container').find('li[data-tabIndex]').one('click', function () {
        console.log('顶部切换, 触发选项卡loading, 一次性事件');
        tabsLoading();
        // 图片延迟加载
        $('img.img-lazy').lazyload();
    });

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        $(window).scroll(function () {
            pullLoading();
            // 图片延迟加载
            $('img.img-lazy').lazyload();
            console.log('滚动条滚动');
        });
    });
})(jQuery, Swiper);
//# sourceMappingURL=shoppingList.js.map
