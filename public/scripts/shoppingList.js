/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery Swiper template*/

'use strict';

(function ($, Swiper) {
    // 搜索条件
    var SearchType = "";
    // 选项卡导航
    var TabIndexSwiper = new Swiper('#tabIndex-container', {
        freeMode: true,
        slidesPerView: 'auto',
        freeModeMomentumRatio: .5
    });
    // 选项卡容器
    var TabsContainerSwiper = new Swiper('#tabs-container', {
        onlyExternal: true
    });
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
    // 导航和选项卡容器 联动的方法
    function tabSwitch(index, speed) {
        // 选项卡序号 移动
        TabIndexSwiper.slideTo(index, speed, false);
        // 选项卡 移动ta
        TabsContainerSwiper.slideTo(index, speed, false);
        // 为选项卡序号 更改样式
        $(TabIndexSwiper.slides).children('a').addClass('inactive');
        $(TabIndexSwiper.slides[index]).children('a').removeClass('inactive');
    }

    // 设置 tab 高度
    function setTabHeight() {
        var ActiveTabIndex = TabsContainerSwiper.activeIndex,
            $ActiveTab = $(TabsContainerSwiper.slides[ActiveTabIndex]);
        $ActiveTab.css({
            height: 'auto'
        });
        var ActiveTabHeight = $ActiveTab.children('.container-fluid').height();
        console.info(ActiveTabHeight);
        $ActiveTab.siblings('.swiper-slide').height(ActiveTabHeight);
    }

    // 加载动画显示
    function loadingShow(CurrentTab) {
        $(TabsContainerSwiper.slides[CurrentTab]).find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide(CurrentTab) {
        $(TabsContainerSwiper.slides[CurrentTab]).find('.loading').hide();
    }

    /**
     * 加载商品列表, ajax请求
     * @need appendProductsList()
     * type 加载方式 1:继续加载  2:重新加载(新的搜索条件)
     */
    function tabsLoading(Type) {
        // 当前激活的选项卡容器
        var ActiveTab = TabsContainerSwiper.activeIndex;

        // 当前选项卡
        var $Current = $(TabsContainerSwiper.slides[ActiveTab]);
        // 当前选项卡 Index列表
        var $Index = $(TabIndexSwiper.slides[ActiveTab]);

        //  PageNum 当前页码数
        if (Type === 1) {
            var PageNum = $Current.data('pagenum');
        } else {
            var PageNum = 0;
        }

        // 判断是否还有数据要加载
        if (PageNum === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($Current.data('loading') === true) {
            return;
        } else {
            $Current.data('loading', true);
        }

        // 当前选项卡所要加载的分页页码
        var NextPage = ++PageNum;

        // 当前激活的分类ID
        var CurrentCid = $Index.data('tab-index');

        // 显示加载动画
        loadingShow(ActiveTab);

        // 条件搜索条件
        var Url;
        if (SearchType != '') {
            Url = '/products?extra_kv=sea:' + SearchType;
        } else {
            Url = '/products';
        }

        // ajax 请求加载数据
        $.ajax({
            url: Url,
            data: {
                pagenum: NextPage,
                pagesize: 20,
                cid: CurrentCid
            }
        }).done(function (data) {
                if (data.success) {
                    onImpressProduct(data.data.list);
                    if (data.data === null || data.data === '' || data.data.list.length === 0) {
                        $Current.data('pagenum', -1);
                    } else {
                        // 遍历模板 插入页面
                        appendProductsList(data.data, ActiveTab, Type);
                        $Current.data('pagenum', PageNum);

                        $.ajax({
                            url: data.data.impr
                        });

                        // 图片延迟加载
                        $('img.img-lazy').lazyload({
                            threshold: 200,
                            container: $('#tabs-container'),
                            effect: 'fadeIn'
                        });

                        //给模板a标签绑定事件
                        $('[data-clk]').unbind('click');
                        $('[data-clk]').bind('click', function () {
                            var $this = $(this);

                            $('#productClick-name').val($this.data('title'));
                            $('#productClick-spu').val($this.data('spu'));
                            $('#productClick-price').val($this.data('price'));

                            onProductClick();

                            if (undefined !== $this.data('link')) {
                                $.ajax({
                                    url: $this.data('clk'),
                                    type: "GET"
                                });
                                setTimeout(function () {
                                    window.location.href = $this.data('link');
                                }, 100);
                            }
                        })
                    }
                }
            })
            // TODO failed 时的提示
            .always(function () {
                // 隐藏加载动画
                loadingHide(ActiveTab);
                // 请求结束, loading = false
                $Current.data('loading', false);
            });
    }

    $('#tabIndex-container').on('click', '.nav-item', function () {
        /* Act on the event */
        tabSwitch(TabIndexSwiper.clickedIndex, 500);
        tabsLoading(1);
        setTabHeight();
    });

    // 初始化模态框
    var options = {
        hashTracking: false
    };

    $('[data-remodal-id=download-modal]').remodal(options);

    /**
     * 对选项卡 所加载的页码 集合, 根据分类 Category 的数目, 进行初始化
     * @param ArraryLength
     */
    // 根据 url 地址, 页面跳转到指定 tab
    function initTab() {
        var slideText = (location.hash);
        if (slideText !== '' && slideText !== null) {
            slideText = slideText.substring(1);
            var slideIndex = $('#' + slideText).index();
            if (slideIndex >= 0) {
                tabSwitch(slideIndex, 0);
            }
        }
    }

    // 页面初始化
    (function initBody() {
        initTab();
        tabsLoading(1);
    })();

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax && scrollMax <= 300 + scrollCurrent) {
            tabsLoading(1);
        }
    }

    // 遍历模板, 插入数据到指定位置
    /**
     *
     * @param ProductsList
     */
    function appendProductsList(ProductsList, CurrentTab, Type) {
        var TplHtml = template('tpl-product', ProductsList);
        var StageCache = $.parseHTML(TplHtml);
        if (Type === 1) {
            $(TabsContainerSwiper.slides[CurrentTab]).find('.row').append(StageCache);
        } else if (Type === 2) {
            $('.swiper-wrapper .productList').each(function () {
                $(this).html('');
            });
            $(TabsContainerSwiper.slides[CurrentTab]).find('.row').html(StageCache);
        }

    }

    // 为选项卡导航, 绑定一次性事件, 加载商品数据
    $('#tabIndex-container').find('li[data-tab-index]').one('click', function () {
        $('body').animate({
            scrollTop: 0
        }, 200);
    });
    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        $(window).scroll(function () {
            $('img.img-lazy').each(function () {
                var Src = $(this).attr('src'),
                    Original = $(this).attr('data-original');
                if (Src === Original) {
                    $(this).removeClass('img-lazy');
                }
            });
            pullLoading();
            console.log('滚动条滚动');
        });
    });

    // 点击 wish
    $('.swiper-wrapper').on('click', '.btn-wish', function (e) {
        var $this = $(e.target);
        var spu = $(e.target).data('spu');
        if (spu != undefined) {
            if (!$this.hasClass('active')) {
                $this.addClass('active');
            } else {
                $this.removeClass('active');
            }
            $.ajax({
                url: '/updateWish',
                type: 'post',
                data: {spu: spu}
            });
        } else {
            spu = $this.data('actionspu');
            $.ajax({
                    url: '/notesaction',
                    type: 'get',
                    data: {
                        action: 'wish',
                        spu: spu
                    }
                })
                .done(function (data) {
                    window.location.href = '/login';
                });
        }
    });

    // 显示隐藏搜索条件
    $('.btn-search').on('click', function () {
        var SearchHeight = ($('.search-item').length) * 52 + 47;
        $('.search-container').toggleClass('active');
        if ($('.search-container').hasClass('active')) {
            $('.search-container').css('height', SearchHeight);
            $('.btn-search').html('CLOSE');
            $('.swiper-slide-active').children('.container-fluid').addClass('search-mask');
        } else {
            $('.search-container').css('height', 0);
            $('.btn-search').html('SORT BY');
            $('.swiper-slide-active').children('.container-fluid').removeClass('search-mask');
        }
    });

    // 选择搜索条件
    $('.search-item').on('click', function () {
        $('.search-item').removeClass('active');
        $(this).addClass('active');
        $('.search-container').toggleClass('active');
        $('.search-container').css('height', 0);
        $('.btn-search').html('SORT BY');
        $('.swiper-slide-active').children('.container-fluid').removeClass('search-mask');
        // 搜索条件 备用
        SearchType = $(this).data('search');
        // 显示搜索条件
        $('.lowTo-info').html($(this).data('searchtext'));
        $('.lowTo').removeClass('disabled');
        $('[data-pagenum]').each(function () {
            $(this).data('pagenum', 0);
        });
        tabsLoading(2);

    });

    // reset 重置搜索条件
    $('#searchReset').on('click', function () {
        $('.search-item').removeClass('active');
        $('.search-container').toggleClass('active');
        $('.search-container').css('height', 0);
        $('.btn-search').html('FILTER');
        $('.swiper-slide-active').children('.container-fluid').removeClass('search-mask');
        // 重置
        SearchType = '';
        // 隐藏搜索条件
        $('.lowTo-info').html(SearchType);
        $('.lowTo').addClass('disabled');
        $('[data-pagenum]').each(function () {
            $(this).data('pagenum', 0);
        });
        tabsLoading(2);
    });

})(jQuery, Swiper);
