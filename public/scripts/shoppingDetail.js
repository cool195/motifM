/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';

(function ($, Swiper) {
    // 添加购物车的参数
    var operate = {
        'sale_qtty': 1, // 数量
        'select': true, // 是否选中
        'sku': '', // SKU
        'VAList': [// 增值服务
        {
            'user_remark': 'KG.KB', // 用户备注信息
            'vas_id': 'id' // 增值服务ID
        }]
    };
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
    // 暂存 根据所选项所筛选出的 Skus 的结果
    var ResultSkus = [];

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
    // 为 Options 赋值
    var Options = {};
    var Stock = {};

    // 剔除 库存为 0 的项
    function filterNull(List, Arr) {
        List = List.filter(function (el) {
            return el !== Arr;
        });
        return List;
    }

    // 以选项的ID 为key
    // 以skus 和spuID 为value
    function newOptions(DataList, Inventory, objCache) {
        var Obj = objCache;

        $.each(DataList, function (index, val) {
            // 选项组 SpaValue 中的 一类选项
            var SpaValue = val;
            // 一类选项中的一个选项 SkaValue
            for (var i = 0; i < SpaValue.skuAttrValues.length; i++) {

                // 一类选项 SpaValue 中的第 i 个选项 SkaValue
                var SkaValue = SpaValue.skuAttrValues[i];

                // SpuID 该选项 的父级 SpaValue 所属的分类
                // SkuID 该选项 SkaValue 所对应的ID
                // Skus 该选项 SkaValue 所对应的skus
                var SpaID = SpaValue.attr_type,
                    SkaID = SkaValue.attr_value_id,
                    Skus = SkaValue.skus;

                // 顾虑掉 没有库存的 Sku
                for (var j = 0; j < Inventory.length; j++) {
                    Skus = filterNull(Skus, Inventory[j]);
                }

                if (Obj[SpaID] === undefined) {
                    Obj[SpaID] = {};
                }
                Obj[SpaID][SkaID] = Skus;
            }
        });
    }

    // 筛选 没有库存的Sku
    function inventoryNull(DataList) {
        var Cache = [];
        for (var i = 0; i < DataList.length; i++) {
            if (DataList[i].stock_qtty === 0) {
                Cache.push(DataList[i].sku);
            }
        }
        return Cache;
    }

    // 初始化 赋值 库存 Stock
    function newStock(DataList, objCache) {
        $.each(DataList, function (index, val) {
            if (val.stock_qtty !== 0) {
                objCache[val.sku] = val.stock_qtty;
            }
        });
    }

    // 初始化 赋值
    (function initOptions() {
        var SpuId = $('#modalDialog').data('spu');
        $.ajax({
            url: '/products/' + SpuId
        }).done(function (data) {
            console.log('success');
            // 获取商品所有的库存
            // Inventory 为库存的商品的Sku
            var Inventory = inventoryNull(data.data.skuExps);
            newOptions(data.data.spuAttrs, Inventory, Options);
            newStock(data.data.skuExps, Stock);
        });
    })();

    // TODO 筛选 逻辑
    /**
     *
     * @param SpuID 一组商品所对应的ID
     * @param SkuID 一个商品所对应的ID
     */
    function filterOptions(SpaID, SkaID) {
        // 所点击的项, 所对应的 Skus , 数组类型
        var CurrentSkus = Options[SpaID][SkaID];

        $.each(Options, function (noIndex, v) {
            // 排除同一类别的 选项
            if (noIndex !== SpaID.toString()) {

                // Options中的需要比对的一组选项
                var StaticSpa = v;
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
                        $('#' + index).attr('disabled', 'disabled');
                        $('#' + index).siblings('label').addClass('disabled');
                    } else {
                        $('#' + index).removeAttr('disabled');
                        $('#' + index).siblings('label').removeClass('disabled');
                    }
                });
            }
        });
    }

    /**
     *
     * @param SpaId
     * @param SkaId
     */
    function getResultSku(SpaId, SkaId) {

        var RadioList = $('#modalDialog').find('input[type=radio]:checked');
        var CheckCount = RadioList.length;
        if (CheckCount === 1) {
            ResultSkus = Options[SpaId][SkaId];
            return;
        }
        var CurrentSkus = Options[SpaId][SkaId];
        var AfterSkus = [];
        for (var i = 0; i < ResultSkus.length; i++) {

            for (var j = 0; j < CurrentSkus.length; j++) {
                if (ResultSkus[i] === CurrentSkus[j]) {
                    AfterSkus.push(CurrentSkus[j]);
                    break;
                }
            }
        }
        ResultSkus = AfterSkus;
    }

    // 为所有选项绑定事件
    $('#modalDialog').on('click', 'input[type=radio]', function (e) {

        console.log('Click Radio');

        var SpaId = $(e.target).data('spa'),
            SkaId = $(e.target).data('ska');

        filterOptions(SpaId, SkaId);
        getResultSku(SpaId, SkaId);
    });

    // 调整数量
    /**
     *
     * @param Count
     */
    function changeQtty(RequestStock) {
        // TODO Loading Show
        $.ajax({
            url: '/path/to/file',
            data: { skus: RequestStock }
        }).done(function (data) {
            console.log('success');
            var requestList = [];
            for (var i = 0; i < RequestStock.length; i++) {
                if (data.data.list[i].stockStatus === 1) {
                    requestList[i] = true;
                } else {
                    requestList[i] = false;
                }
            }
            return requestList;
        }).fail(function () {
            console.log('error');
        }).always(function () {
            console.log('complete');
        });
    }

    // 绑定计数事件,商品数量
    // 需要添加库存验证
    $('#item-count').on('click', '[data-item]', function (e) {
        // 已选中的选项 以及 商品的选项组数
        var RadioList = $('#modalDialog').find('input[type=radio]:checked'),
            CheckCount = Object.keys(Options);
        if (CheckCount.length < RadioList.length) {
            return;
        }

        var $QtyCount;
        // 获取加减号的标签项
        if ($(e.target)[0].tagName === 'I') {
            $QtyCount = $(e.target).parents('.btn-cartCount');
        } else {
            $QtyCount = $(e.target);
        }

        // 标签是否 disabled
        if ($QtyCount.hasClass('disabled')) {
            return;
        }

        // Count 当前商品数量
        // SelectSku 选中的Sku 有且只有一个值
        // StockCache 本地储存的库存数据
        // Checkstock 拼接后的请求字符串
        var Count = $QtyCount.siblings('[data-num]').html(),
            SelectSku = ResultSkus[0],
            StockCache = Stock[SelectSku],
            RequestStock = ['', ''];

        if ($QtyCount.data('item') === 'add') {

            // 判断本地库存量
            if (StockCache < 20 && Count < StockCache) {
                ++Count;
                console.log('商品数量:' + Count + '剩余库存量小于20');
                // 判断增加后是否等于最大库存量
                if (Count === StockCache) {
                    $QtyCount.addClass('disabled');
                    console.log('商品数量等于最大库存量');
                }
            } else if (Count >= StockCache && StockCache === 20) {
                var StrCount = [Count, ++Count];

                for (var i = 0; i < RequestStock.length; i++) {
                    RequestStock[i] = SelectSku + '_' + StrCount[i];
                }
                var RequestList = changeQtty(RequestStock);
                // 查看库存情况
                if (RequestList[0] === true && RequestList[1] === true) {
                    $QtyCount.siblings('[data-num]').html(++Count);
                } else if (RequestList[0] === true && RadioList[1] === false) {
                    $QtyCount.siblings('[data-num]').html(++Count);
                    $QtyCount.siblings('[data-item="add"]').addClass('disabled');
                }
            }
        } else {
            --Count;
            if (Count === 1) {
                $QtyCount.addClass('disabled');
            }
            console.log('商品数量:' + Count);
        }

        $QtyCount.siblings('[data-num]').html(Count);
    });
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
