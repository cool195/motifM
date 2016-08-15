'use strict';
/* global jQuery */

(function ($) {
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

    $('.delwish').click(function (e) {
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
    $(function(){
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

})(jQuery);

//# sourceMappingURL=shoppingCart.js.map