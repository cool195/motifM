/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';

(function ($, Swiper) {
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

    // 图片轮播
    var BaseImgSwiper = new Swiper('#baseImg-swiper', {
        pagination: '#baseImg-pagination',
        paginationType: 'fraction',
        loop: true,
        lazyLoading: true,
        lazyLoadingInPrevNext: true
    });
    // 全屏图片轮播
    var DetailImgSwiper = new Swiper('#detailImg-swiper', {
        pagination: '#detailImg-pagination',
        paginationType: 'fraction',
        loop: true,
        lazyLoading: true,
        lazyLoadingInPrevNext: true
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
    var Options = {},
        Stock = {},
        Vas = {};
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

    // 初始化 增值服务
    function newVas(DataList, objCache) {
        $.each(DataList, function (index, value) {
            var vas_id = value.vas_id,
                vas_type = value.vas_type;
            objCache[vas_id] = vas_type;
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
            // 所有选项
            newOptions(data.data.spuAttrs, Inventory, Options);
            // 所有sku对应的库存
            newStock(data.data.skuExps, Stock);
            // 所有增值服务
            newVas(data.data.vasBases, Vas);
        });
    })();

    /**
     *
     * @param SpuID 一组商品所对应的ID
     * @param SkuID 一个商品所对应的ID
     */
    function filterOptions(SpaId, SkaId, ActiveOptions) {
        // 所点击的项, 所对应的 Skus , 数组类型
        // ResultSkus 代表 已选项 所产生的 Skus 的交集
        // 通过它 来对未选中项进行筛选

        // 所有的 Spa
        var OptionSpa = Object.keys(Options);

        // 未选项的 SpaID 组
        var NoChooseSpa = [];

        // 已选项 SpaID 组
        var SelectSpa = [];

        // 已选项的 SpaID 获取未选项组 SpaID
        // 把值分别筛选出来
        for (var SpaIndex = 0; SpaIndex < ActiveOptions.length; SpaIndex++) {
            var CacheSpa = $(ActiveOptions[SpaIndex]).data('spa');
            SelectSpa.push(CacheSpa);
            OptionSpa = filterNull(OptionSpa, CacheSpa.toString());
        }
        NoChooseSpa = OptionSpa;

        // 筛选 未选项
        $.each(NoChooseSpa, function (i, iValue) {
            // StaticSpa 是一个Spa
            var StaticSpa = Options[iValue];

            $.each(StaticSpa, function (j, jValue) {
                // 等同于 var StaticSkus = StaticSpa[j] = Options[iValue][j]
                var StaticSkus = jValue;
                // 比对记录
                var Detection = false;
                for (var k = 0; k < StaticSkus.length; k++) {
                    if (Detection) {
                        break;
                    }
                    for (var l = 0; l < ResultSkus.length; l++) {
                        if (StaticSkus[k] === ResultSkus[l]) {
                            Detection = true;
                            break;
                        }
                    }
                }

                if (Detection === false) {
                    $('#' + j).addClass('disabled');
                    $('#' + j).removeClass('active');
                } else {
                    $('#' + j).removeClass('disabled');
                }
            });
        });
        // 筛选 已选项
        var CurrentSkus = Options[SpaId][SkaId];

        $.each(SelectSpa, function (i, iValue) {
            var StaticSpa = Options[iValue];

            if (iValue !== SpaId) {

                $.each(StaticSpa, function (j, jValue) {
                    var StaticSkus = jValue;
                    // 比对记录
                    var Detection = false;

                    for (var k = 0; k < StaticSkus.length; k++) {
                        if (Detection) {
                            break;
                        }
                        for (var l = 0; l < CurrentSkus.length; l++) {
                            if (StaticSkus[k] === CurrentSkus[l]) {
                                Detection = true;
                                break;
                            }
                        }
                    }

                    if (Detection === false) {
                        $('#' + j).addClass('disabled');
                        $('#' + j).removeClass('active');
                    } else {
                        $('#' + j).removeClass('disabled');
                    }
                });
            }
        });
    }

    /**
     * item 为比对值
     * List 为待比对数组
     * 遍历List数组, 若List中有值为 item, 则返回此项(item)
     *
     * @param List
     * @param item
     * @returns {*}
     */
    function sameArray(List, item) {
        return List.find(function (el) {
            return el === item;
        });
    }

    /**
     *
     * @param SpaId
     * @param SkaId
     */
    function getResultSku(ActiveOptions) {

        var RadioList = ActiveOptions;
        ResultSkus = [];
        // 只选中了一项时
        if (RadioList.length === 1) {
            var SpaId = $(ActiveOptions).data('spa'),
                SkaId = $(ActiveOptions).data('ska');
            ResultSkus = Options[SpaId][SkaId];
            return;
        }
        var InitSkus = [];
        // 把选中的选项的 Skus, 建成二维数组
        for (var l = 0; l < RadioList.length; l++) {
            // 分别获取选中的选项中的 skaid 和 spaid
            var Ska = $(RadioList[l]).data('ska'),
                Spa = $(RadioList[l]).data('spa');
            InitSkus.push(Options[Spa][Ska]);
        }

        // 作为比对项存在
        var Intersection = [];
        for (var i = 0; i < RadioList.length; i++) {
            var Cache = [];
            if (i === 0) {
                Intersection = InitSkus[i];
                continue;
            }
            for (var k = 0; k < InitSkus[i].length; k++) {
                var SameSku = sameArray(Intersection, InitSkus[i][k]);
                if (SameSku !== undefined) {
                    Cache.push(SameSku);
                }
            }
            Intersection = Cache;
        }

        ResultSkus = Intersection;
    }

    // 为所有选项绑定事件
    $('#modalDialog').on('click', '.btn-itemProperty', function (e) {

        if ($(e.target).hasClass('disabled')) {
            console.log('选项不可用');
            return;
        } else if ($(e.target).hasClass('active')) {
            console.log('取消选中');
            $(e.target).removeClass('active');
        } else {
            $(e.target).parents('.row').find('.btn-itemProperty').removeClass('active');
            $(e.target).addClass('active');
        }

        var SpaId = $(e.target).data('spa'),
            SkaId = $(e.target).data('ska');

        var ActiveOptions = $('#modalDialog').find('.btn-itemProperty.active');
        if (ActiveOptions.length < 1) {
            $('#modalDialog').find('.btn-itemProperty').removeClass('disabled');
            ResultSkus = [];
        } else {
            getResultSku(ActiveOptions);
            filterOptions(SpaId, SkaId, ActiveOptions);
        }

        // 调整数量按钮组
        var $Count = $('#item-count');

        // 重置 调整数量按钮组
        $Count.children('[data-item]').addClass('disabled');
        $Count.children('[data-num="num"]').html(1);

        // RadioList 选中的选项数量
        // CheckCount 所有选项的组数
        var RadioList = $('#modalDialog').find('.btn-itemProperty.active'),
            CheckCount = Object.keys(Options);

        // 判断所选项 是否 全选
        if (CheckCount.length === RadioList.length) {
            // 获取所选中 sku 对应的库存
            var StockCache = Stock[ResultSkus[0]];

            // 切换Sku时(确定一个sku时),商品购买数量归1
            // 减号不可用
            $Count.children('[data-item="minus"]').addClass('disabled');
            $Count.children('[data-num="num"]').html(1);
            // 如果库存大于1 加号可用
            if (StockCache > 1) {
                $Count.children('[data-item="add"]').removeClass('disabled');
            }
            // 全选状态时, 可以购买
            $('#addCart').removeClass('disabled');
            $('#buyNow').removeClass('disabled');
        } else {
            // 非全选状态时, 不可以购买
            $('#addCart').addClass('disabled');
            $('#buyNow').addClass('disabled');
        }
    });

    // 调整数量
    /**
     *
     * @param Count
     */
    function changeQtty(RequestStock, $QttyCount) {
        openLoading();
        $.ajax({
            url: '/stock/checkstock',
            data: { skus: RequestStock }
        }).done(function (data) {
            if (data.success) {

                var Request = true;

                if (data.data.list[0].stockStatus === 1) {
                    Request = true;
                } else {
                    Request = false;
                }

                if (Request === false) {
                    $QttyCount.addClass('disabled');
                }
            }
        }).fail(function () {
            console.log('error');
        }).always(function () {
            console.log('complete');
            closeLoading();
        });
    }

    // 绑定计数事件,商品数量
    // 需要添加库存验证
    $('#item-count').on('click', '[data-item]', function (e) {
        // 已选中的选项 以及 商品的选项组数
        var RadioList = $('#modalDialog').find('.btn-itemProperty.active'),
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
        var NextCount = parseInt($QtyCount.siblings('[data-num]').html()),
            SelectSku = ResultSkus[0],
            StockCache = Stock[SelectSku],
            Count = NextCount++,
            // Count 当前的数值 , NextCount 是+1 之后的数量 , 用来拼接参数
        Qtty = Count; // 用来 储存 最后改变后的数量

        if ($QtyCount.data('item') === 'add') {
            Qtty = NextCount;
            var MaxCount = 50;

            if (NextCount > 1) {
                $QtyCount.siblings('[data-item="minus"]').removeClass('disabled');
            }
            if (NextCount === MaxCount) {
                $QtyCount.addClass('disabled');
            }

            // 判断本地库存量
            if (StockCache < 20) {
                if (NextCount === StockCache) {
                    $QtyCount.addClass('disabled');
                }
            } else if (StockCache === 20) {
                // 库存量等于20的情况
                if (NextCount >= 20) {
                    var RequestStock = SelectSku + '_' + ++NextCount;

                    // 查看库存情况
                    changeQtty(RequestStock, $QtyCount);
                }
            }
        } else {
            --Count;
            if (Count === 1) {
                $QtyCount.addClass('disabled');
            } else if ($QtyCount.siblings('[data-item="add"]').hasClass('disabled')) {
                $QtyCount.siblings('[data-item="add"]').removeClass('disabled');
            }
            Qtty = Count;
        }
        // 将计数更新
        $QtyCount.siblings('[data-num]').html(Qtty);
    });

    /**
     * 添加购物车
     * @param Action
     */
    function initCart(Action) {
        var Qtty = $('#item-count').children('[data-num]').html();
        // ajax 请求的参数
        var Operate = {
            'sale_qtty': Qtty, // 数量
            'select': true, // 是否选中
            'sku': ResultSkus[0], // SKU
            'VAList': [] // 增值服务
        };

        var i = 0;
        var VarList = [];

        $.each(Vas, function (index, val) {
            var $CurrentVas = $('#' + index);

            // 增值项 是否被选中
            if ($CurrentVas.prop('checked')) {
                VarList[i] = {};
                VarList[i].vas_id = index; // 增值服务ID
                VarList[i].user_remark = ''; // 用户备注信息
                // 增值服务类型
                switch (val) {
                    case 1:
                        // 刻字
                        var remark = $CurrentVas.siblings('input-engraving').value();
                        VarList[i].user_remark = remark;
                        break;
                    case 2:
                        // 礼品包装
                        break;
                    default:
                        console.log('不存在的增值服务类型');
                }
                i++;
            }
        });

        Operate.VAList = VarList;
        openLoading();
        // PUT 立即购买
        // PATCH 添加购物车
        $.ajax({
            url: '/cart',
            type: Action,
            data: { operate: Operate }
        }).done(function () {
            console.log("success");
        }).fail(function () {
            console.log("error");
        }).always(function () {
            closeLoading();
            console.log("complete");
        });
    }

    // TODO 立即购买
    $('#addCart').on('click', function (e) {
        if ($(e.target).hasClass('disabled')) {
            return;
        }
        initCart('PATCH');
        // 添加成功 刷新数量
        $.ajax({
            url: ' /cart/amount',
            type: 'GET'
        }).done(function (data) {
            console.log('success');
            // 操作成功刷新页面
            if (data.success) {
                if (data.data.skusAmout > 0) {
                    $('.nav-shoppingCart').children('span').html(data.data.skusAmout);
                }
            }
        }).fail(function () {
            console.log('error');
        }).always(function () {
            console.log('complete');
        });
    });
    $('#buyNow').on('click', function () {
        if ($(e.target).hasClass('disabled')) {
            return;
        }
        initCart('PUT');
    });
    // 增值服务是否选中
    $('fieldset[data-vas-type]').on('click', function (e) {
        // 判断增值服务类型
        if (parseInt($(this).data('vas-type')) === 1 && $(e.target).hasClass('icon-checkcircle')) {
            var $input = $(e.target).siblings('input[type="text"]');
            if ($(e.target).hasClass('active')) {
                $input.addClass('disabled').attr('disabled', 'disabled');
                $(e.target).removeClass('active');
                $input.val('');
            } else {
                $input.removeClass('disabled').removeAttr('disabled');
                $(e.target).addClass('active');
            }
        }
    });
})(jQuery, Swiper);
//# sourceMappingURL=shoppingDetail.js.map
