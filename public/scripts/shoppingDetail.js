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

    // 建立 选项组 的数据集合
    // 以选项的ID 为key
    // 以skus 和spuID 为value
    var Options = function Options() {
        // TODO 获取 cid 的值, 获取分类ID
        var productId = 0;
        $.ajax({
            url: '/products/' + productId
        }).done(function (data) {
            console.log("success");
            return newOptions(data.data.spuAttrs);
        });
    };
    // 为 Options 赋值
    function newOptions(dataList) {
        var Options = {};
        $.each(dataList, function (index, val) {
            // 选项组 SpuAttr 中的 一类选项
            var SpuAttr = val;
            // 一类选项中的一个选项 SkuAttr
            for (var i = 0; i < SpuAttr.skuAttrValues.length; i++) {

                // 一类选项 SpuAttr 中的第 i 个选项 SkuAttr
                var SkuAttr = SpuAttr.skuAttrValues[i];

                // SpuID 该选项 的父级 SpuAttr 所属的分类
                // SkuID 该选项 SkuAttr 所对应的ID
                // Skus 该选项 SkuAttr 所对应的skus
                var SpuID = SpuAttr.atty_type,
                    SkuID = SkuAttr.attr_value_id,
                    Skus = SkuAttr.skus;

                Options[SpuID] = {};
                Options[SpuID][SkuID] = Skus;
            }
        });
        return Options;
    }

    // TODO 筛选 逻辑
    function filterOptions(CurrentOptionID) {

        var SpuID = Options[CurrentOptionID].skus;

        $.each(Options, function (index, val) {
            if (index) {}
            // 获取 skus sku集合
            var Skus = val.attr_type;

            for (var i = 0; i < Skus.length; i++) {
                Skus[i];
            }
        });
    };
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
