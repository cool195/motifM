/**
 * Created by yinlinghui on 16/6/8.
 */
/*global jQuery Swiper template*/

'use strict';

(function ($, Swiper) {
    // 加载动画显示
    function loadingShow() {
        $('#designerContainer').find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide() {
        $('#designerContainer').find('.loading').hide();
    }

    // ajax 请求 获取 推荐设计师列表 数据
    function getDesignerList() {
        //  $DesignerContainer 列表容器
        //  PageNum 当前页码数
        var $DesignerContainer = $('#designerContainer'),
            PageNum = $DesignerContainer.data('pagenum');
        // 判断是否还有数据要加载
        if (PageNum === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DesignerContainer.data('loading') === true) {
            return;
        } else {
            $DesignerContainer.data('loading', true);
        }

        var NextNum = ++PageNum;

        loadingShow();
        $.ajax({
            url: '/designer',
            data: { cmd: 'designerinfolist', num: NextNum, size: 3 }
        }).done(function (data) {
            if (data.data === null || data.data === '') {
                return;
            } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                $DesignerContainer.data('pagenum', -1);
            } else {
                // 遍历模板 插入页面
                appendDesignerList(data.data);
                // 页数 +1
                $DesignerContainer.data('pagenum', PageNum);
                console.info('当前页码数为' + PageNum);

                // 图片延迟加载
                $('img.img-lazy').lazyload({
                    threshold: 200,
                    container: $('#designerContainer'),
                    effect: 'fadeIn'
                });

                // 初始化 swiper
                initSwiper();
            }
        }).always(function () {
            console.log('Ajax请求结束');

            $DesignerContainer.data('loading', false);
            loadingHide();
        });
    }

    // 将数据插入到模板中 设计师
    function appendDesignerList(DesignerList) {
        var TplHtml = template('tpl-designer', DesignerList);
        // 把 字符串 转义成 HTML
        var StageCache = $.parseHTML(TplHtml);
        // 将 html 插入页面相应位置
        $('.designer-content').append(StageCache);
    }

    // 初始化 Swiper
    function initSwiper() {
        var designerSwiper = new Swiper('.swiper-container', {
            freeMode: true,
            slidesPerView: 'auto',
            freeModeMomentumRatio: .5
        });
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getDesignerList();
        initSwiper();
        $(window).scroll(function () {
            pullLoading();
            console.log('滚动条滚动');
        });
    });

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 100 + scrollCurrent) {
            getDesignerList();
        }
    }
})(jQuery, Swiper);
//# sourceMappingURL=designer.js.map
