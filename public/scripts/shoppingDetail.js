/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';

(function ($, Swiper) {
    // 图片轮播
    var BaseImgSwiper = new Swiper('#baseImg-swiper', {
        pagination: '#baseImg-pagination',
        paginationType: 'fraction',
        loop: true
    });
    // 全屏图片轮播
    var DetailImgSwiper = new Swiper('#detailImg-swiper', {
        pagination: '#detailImg-pagination',
        paginationType: 'fraction',
        loop: true
    });

    // 注意联动的设置顺序
    DetailImgSwiper.params.control = BaseImgSwiper;
    BaseImgSwiper.params.control = DetailImgSwiper;

    $('.product-baseImg').on('click', function () {
        $('.product-detailImg').addClass('in');
        $('body').addClass('no-scroll');
    });
    $('.product-detailImg').on('click', function () {
        $(this).removeClass('in');
        $('body').removeClass('no-scroll');
    });
    var options = {
        closeOnOutsideClick: false,
        closeOnCancel: false
    };
    $('[data-remodal-id=modal]').remodal(options);

    function productDetailInfo() {
        $.ajax({
            url: '/products/' + productId
        }).done(function () {
            console.log("success");
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("complete");
        });
    }
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
