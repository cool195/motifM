/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';

(function ($, Swiper) {
    var BaseImgSwiper = new Swiper('#baseImg-swiper', {
        pagination: '#baseImg-pagination',
        paginationType: 'fraction',
        loop: true
    });
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
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
