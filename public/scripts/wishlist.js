'use strict';
/* global jQuery */

(function ($) {
    // 加载动画显示
    function loadingShow() {
        $('.wishloading').show();
    }

    // 加载动画隐藏
    function loadingHide() {
        $('.wishloading').hide();
    }

    // loading 打开
    function openLoading() {
        $('.loading').toggleClass('loading-hidden');
        setTimeout(function () {
            $('.loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('.loading').addClass('loading-close');
        setTimeout(function () {
            $('.loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    var Options = {
        closeOnOutsideClick: false,
        closeOnCancel: false,
        hashTracking: false
    };
    // 删除购物车商品 提示框
    var wishModal = $('[data-remodal-id="modal"]').remodal(Options);

    $('#wishContainer').on('click', '.delwish', function (e) {
        // 暂存数据 to modal , 为拼接 ajax url 做准备
        $('#wishDialog').data('spu', $(e.target).data('spu'));
        wishModal.open();
    });

    // ajax 删除 wishlist 商品
    $('[data-remodal-action="confirm"]').on('click', function () {
        var WishId = $('#wishDialog').data('spu');
        openLoading();
        $.ajax({
                url: '/updateWish',
                type: 'post',
                data: {spu: WishId}
            })
            .done(function (data) {
                if (data.success) {
                    $('[data-wishspu="' + WishId + '"]').remove();
                }
            })
            .always(function () {
                closeLoading();
            });
    });

    // 取消删除
    $('[data-remodal-action="cancel"]').on('click', function () {
        $('#wishDialog').data('spu', '');
        wishModal.close();
    });

    // 图片延迟加载
    $(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

    // ajax 获取 wishlist 列表
    function getWishList() {
        //  $wishContainer 列表容器
        //  Wishpagenum 产品当前页码数
        var $wishContainer = $('#wishContainer'),
            Wishpagenum = $wishContainer.data('wishpagenum');
        // 判断是否还有数据要加载
        if (Wishpagenum === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($wishContainer.data('loading') === true) {
            return;
        } else {
            $wishContainer.data('loading', true);
        }
        var NextWishNum = ++Wishpagenum;

        loadingShow();
        $.ajax({
                url: '/wish',
                data: {
                    num: NextWishNum,
                    size: 10,
                    ajax: 1
                }
            })
            .done(function (data) {
                if (data.data === null || data.data === '') {
                    $wishContainer.data('wishpagenum', -1);
                } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined || data.data.list.length === 0) {
                    $wishContainer.data('wishpagenum', -1);
                } else {
                    // 遍历模板 插入页面
                    appendWishList('tpl-wishlist', data.data);
                    // 页数 +1
                    $wishContainer.data('wishpagenum', Wishpagenum);

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        effect: 'fadeIn'
                    });
                }
            })
            .always(function () {
                $wishContainer.data('loading', false);
                loadingHide();
            });

    }

    // 将数据插入到模板中
    function appendWishList(tpl, WishList) {
        var TplHtml = template(tpl, WishList);
        // 把 字符串 转义成 HTML
        var StageCache = $.parseHTML(TplHtml);
        // 将 html 插入页面相应位置
        $('#wishContainer').append(StageCache);
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getWishList();
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

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 300 + scrollCurrent) {
            getWishList();
        }
    }

})(jQuery);
