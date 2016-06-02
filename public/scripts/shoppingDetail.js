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
    function newOptions(dataList) {
        var Obj = {};
        $.each(dataList, function (index, val) {
            // 选项组 SpaValue 中的 一类选项
            var SpaValue = val;
            // 一类选项中的一个选项 SkaValue
            for (var i = 0; i < SpaValue.skuAttrValues.length; i++) {

                // 一类选项 SpaValue 中的第 i 个选项 SkaValue
                var SkaValue = SpaValue.skuAttrValues[i];

                // SpuID 该选项 的父级 SpaValue 所属的分类
                // SkuID 该选项 SkaValue 所对应的ID
                // Skus 该选项 SkaValue 所对应的skus
                var SpaID = SpaValue.atty_type,
                    SkaID = SkaValue.attr_value_id,
                    Skus = SkaValue.skus;

                Obj[SpaID] = {};
                Obj[SpaID][SkaID] = Skus;
            }
        });
        return Obj;
    }

    // 为 Options 赋值
    var Options = function Options() {
        // TODO 获取 cid 的值, 获取分类ID
        var productId = 0;
        $.ajax({
            url: '/products/' + productId
        }).done(function (data) {
            console.log('success');
            return newOptions(data.data.spuAttrs);
        });
    };

    // TODO 筛选 逻辑
    /**
     *
     * @param SpuID 一组商品所对应的ID
     * @param SkuID 一个商品所对应的ID
     */
    function filterOptions(SpaID, SkaID) {
        // 所点击的项, 所对应的 Skus , 数组类型
        var CurrentSkus = Options[SpaID][SkaID];

        $.each(Options, function (index, val) {
            // 排除同一类别的 选项
            if (index !== SpaID) {

                // Options中的需要比对的一组选项
                var StaticSpa = val;
                // 从组中的每一个选项 分别 进行比对
                // 通过 index , index 是 dom 中 ,选项元素的id
                $.each(StaticSpa, function (index, val) {

                    var StaticSkus = val;
                    // 比对记录
                    var Detection = false;

                    for (var j = 0; j < StaticSkus.length; j++) {
                        if (Detection) {
                            break;
                        }
                        for (var i = 0; i < CurrentSkus.length; i++) {
                            if (StaticSkus[j] === CurrentSkus[i]) {
                                Detection = true;
                                break;
                            }
                        }
                    }

                    if (Detection === false) {
                        // TODO input 和 label 都需要加 disabled
                        $('#' + index).addClass('disabled');
                    }
                });
            }
        });
    }

    $('#modalDialog').on('click', 'input[type=radio]', function () {
        console.log('Click Radio');
    });
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
