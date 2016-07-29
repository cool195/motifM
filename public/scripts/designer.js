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

    // 图片延迟加载
    $('img.img-lazy').lazyload({
        threshold: 200,
        container: $('#designerContainer'),
        effect: 'fadeIn'
    });

    // ajax 请求 获取 推荐设计师列表 数据
    function getDesignerList() {
        //  $DesignerContainer 列表容器
        //  Start 当前页开始条数
        //  Size 当前页显示条数
        var $DesignerContainer = $('#designerContainer'),
            Start = $DesignerContainer.data('start'),
            Size = 10;
        // 判断是否还有数据要加载
        if (Start === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DesignerContainer.data('loading') === true) {
            return;
        } else {
            $DesignerContainer.data('loading', true);
        }


        loadingShow();
        $.ajax({
            url: '/designer',
            data: {cmd: 'designerinfolist', start: Start, size: Size}
        }).done(function (data) {
            if (data.data === null || data.data === '') {
                return;
            } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                $DesignerContainer.data('start', -1);
            } else {
                // 遍历模板 插入页面

                appendDesignerList(data.data);

                // 判断当前页是否是最后一页
                // CurrentSize 当前页显示条数
                // StartNum 下一页开始条数
                var CurrentSize = data.data.list.length,
                    StartNum = data.data.start;
                if (CurrentSize < Size) {
                    $DesignerContainer.data('start', -1);
                } else {
                    $DesignerContainer.data('start', StartNum);
                }

                // 初始化 swiper
                initSwiper();

                // 图片延迟加载
                $('img.img-lazy').lazyload({
                    threshold: 1000,
                    effect: 'fadeIn'
                });

            }
        }).always(function () {
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

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 300 + scrollCurrent) {
            getDesignerList();
        }
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getDesignerList();
        initSwiper();
        $(window).scroll(function () {
            $('img.img-lazy').each(function () {
                var Src = $(this).attr('src'),
                    Original = $(this).attr('data-original');
                if (Src === Original) {
                    $(this).removeClass('img-lazy');
                }
            });
            pullLoading();
        });
    });

})(jQuery, Swiper);


//# sourceMappingURL=designer.js.map
