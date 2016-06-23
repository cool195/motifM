/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';
(function($, Swiper) {
    function openAddSuccess() {
        $('#success').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#success').toggleClass('loading-open');
        }, 25);
    }

    function closeAddSuccess() {
        $('#success').addClass('loading-close');
        setTimeout(function() {
            $('#success').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    // loading 打开
    function openLoading() {
        $('#loading').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('#loading').addClass('loading-close');
        setTimeout(function() {
            $('#loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
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

    $('.product-baseImg').on('click', function() {
        $('.product-detailImg').addClass('in');
        $('body').addClass('no-scroll');
    });
    $('.product-detailImg').on('click', function() {
        $(this).removeClass('in');
        $('body').removeClass('no-scroll');
    });

    var height = $('#detailImg-swiper').height();
    $('#detailImg-pagination')

    var options = {
        closeOnOutsideClick: false,
        closeOnCancel: false,
        hashTracking: false
    };
    var Modal = $('[data-remodal-id=modal]').remodal(options);

    // 建立 选项组 的数据集合
    // 为 Options 赋值
    var Options = {},
        Stock = {},
        Vas = {};

    // 剔除 库存为 0 的项
    function filterNull(List, Arr) {
        List = List.filter(function(el) {
            return el !== Arr;
        });
        return List;
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
        return List.find(function(el) {
            return el === item;
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

    // 以选项的ID 为key
    // 以skus 和spuID 为value
    function newOptions(DataList, Inventory, objCache) {
        var Obj = objCache;

        $.each(DataList, function(index, val) {
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

    // 初始化 赋值 库存 Stock
    function newStock(DataList, objCache) {
        $.each(DataList, function(index, val) {
            if (val.stock_qtty !== 0) {
                objCache[val.sku] = val.stock_qtty;
            }
        });
    }

    // 初始化 增值服务
    function newVas(DataList, objCache) {
        $.each(DataList, function(index, value) {
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
            })
            .done(function(data) {
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
     * 根据 Skus 获取 选定 Sku 的交集
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

    /**
     * filterWaitOptions - 根据 已选定的 Skus 的集合(ResultSkus),筛选待选项的 Skus
     * 没有交集的项，添加 disabled
     *
     * @param  {Object} WaitOptions 带选项，多对应的 Spa ，Skus
     */
    function filterWaitOptions(WaitOptions) {
        // 筛选 未选项
        $.each(WaitOptions, function(i, iValue) {
            // StaticSpa 是一个Spa
            var StaticSpa = Options[iValue];

            $.each(StaticSpa, function(j, jValue) {
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

    }

    /**
     * filterSelectOptions - 根据 已选定的 选项的 Skus ,取交集互相筛选
     * 没有交集的项，添加 disabled
     *
     * @param  {Object} SelectOptions  当前所有选中的 options 项, 保存的是 Spaid , 对应 data-spa
     * @param  {Object} CurrentOptions 本次选中的 option 项
     */
    function filterSelectOptions(SelectOptions, SpaId, SkaId) {
        var CurrentOptions = Options[SpaId][SkaId];
        if (SelectOptions.length === 1) {
            $('.btn-itemProperty[data-spa=' + SelectOptions[0] + ']').removeClass('disabled');
        } else {
            $.each(SelectOptions, function(i, iValue) {
                var StaticSpa = Options[iValue];

                if (iValue !== SpaId) {

                    $.each(StaticSpa, function(j, jValue) {
                        var StaticSkus = jValue;
                        // 比对记录
                        var Detection = false;

                        for (var k = 0; k < StaticSkus.length; k++) {
                            if (Detection) {
                                break;
                            }
                            for (var l = 0; l < CurrentOptions.length; l++) {
                                if (StaticSkus[k] === CurrentOptions[l]) {
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

    }

    /**
     * resolutOptions - 划分 商品 选项 的状态
     * @param  {Object} ActiveOptions 当前已选中的商品 的选项
     * @returns {Object} OptionsStatus filter 后 的 商品状态的选项组
     */
    function resolutOptions(ActiveOptions) {
        // 所有的 Spa
        var OptionSpas = Object.keys(Options);

        // 选项 SpaID 组
        var OptionsStatus = {};

        OptionsStatus.select = [];
        OptionsStatus.wait = [];

        // 已选项的 SpaID 获取未选项组 SpaID
        // 把值分别筛选出来
        for (var SpaIndex = 0; SpaIndex < ActiveOptions.length; SpaIndex++) {
            var CacheSpa = $(ActiveOptions[SpaIndex]).data('spa');
            OptionsStatus.select.push(CacheSpa);
            OptionSpas = filterNull(OptionSpas, CacheSpa.toString());
        }

        OptionsStatus.wait = OptionSpas;
        return OptionsStatus;
    }

    /**
     * 全选状态下的筛选
     * @param SpaId
     * @param SkaId
     */
    function switchOption(RadioList) {

        var SpaList = Object.keys(Options);

        // 把选定的 Skus , 编成一组 , Skus集合
        var SkusList = {};
        $.each(SpaList, function(index, val) {
            // 分别获取选中的选项中的 skaid 和 spaid
            var Ska = $(RadioList[index]).data('ska'),
                Spa = $(RadioList[index]).data('spa');
            SkusList[val] = Options[Spa][Ska];
        });

        // 作为比对项存在, 取 除需要比对的 Spa 外 ,剩余 Spa 所对应的 Skus 的集合
        $.each(SpaList, function(SpaIndex, SpaVal) {

            var Intersection = [];
            // 取交集
            $.each(SkusList, function(SkuIndex, SkuVal) {
                if (SpaVal !== SkuIndex) {
                    var Cache = [];
                    if (Intersection.length === 0) {
                        Cache = SkuVal;
                    } else {
                        for (var k = 0; k < SkuVal.length; k++) {
                            var SameSku = sameArray(Intersection, SkuVal[k]);
                            if (SameSku !== undefined) {
                                Cache.push(SameSku);
                            }
                        }
                    }
                    Intersection = Cache;
                }
            });

            // 遍历除去的 Spa 所对应的各项 option 内 , 所对应的 Sku
            $.each(Options[SpaVal], function(SkusIndex, SkusVal) {

                // 比对 每项中 的 Sku, 与交集中的 Skus 进行比对
                var Detection = false;
                for (var i = 0; i < Intersection.length; i++) {
                    if (Detection) {
                        break;
                    }
                    for (var l = 0; l < SkusVal.length; l++) {
                        if (SkusVal[l] === Intersection[i]) {
                            // 有交集 removeClass
                            Detection = true;
                            break;
                        }
                    }
                }

                if (Detection === false) {
                    $('#' + SkusIndex).addClass('disabled');
                    $('#' + SkusIndex).removeClass('active');
                } else {
                    $('#' + SkusIndex).removeClass('disabled');
                }
            });

        });

    }

    // 为所有选项绑定事件
    $('#modalDialog').on('click', '.btn-itemProperty', function(e) {

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


        // RadioList 选中的选项数量
        // CheckCount 所有选项的组数
        var RadioList = $('#modalDialog').find('.btn-itemProperty.active'),
            CheckCount = Object.keys(Options);
        // 调整数量按钮组
        var $Count = $('#item-count');
        var OptionsStatus = resolutOptions(RadioList);

        // 重置 调整数量按钮组
        $Count.children('[data-item]').addClass('disabled');
        $Count.children('[data-num="num"]').html(1);

        // 全选状态的筛选
        if (RadioList.length === CheckCount.length) {
            switchOption(RadioList);

            // 获取所选中 sku 对应的库存
            var StockCache = Stock[ResultSkus[0]];

            // 切换Sku时(确定一个sku时),商品购买数量归1
            // 减号不可用
            $Count.children('[data-item="minus"]').addClass('disabled');
            $Count.children('[data-num="num"]').html(1);

            if (StockCache > 1) { // 如果库存大于1 加号可用
                $Count.children('[data-item="add"]').removeClass('disabled');
            }

            // 全选状态时, 可以购买
            $('#addCart').removeClass('disabled');
            $('#buyNow').removeClass('disabled');
        } else if (RadioList.length < 1) {
            // 全都未选
            $('#modalDialog').find('.btn-itemProperty').removeClass('disabled');
            // 重置交集
            ResultSkus = [];
        } else if (RadioList.length === 0) {
            // 只选中一项时
            getResultSku(RadioList); // 取得交集
            filterWaitOptions(OptionsStatus.wait);
            filterSelectOptions(OptionsStatus.select, SpaId, SkaId);
            // 非全选状态时, 不可以购买
            $('#addCart').addClass('disabled');
            $('#buyNow').addClass('disabled');
        } else if (RadioList.length === 1) {
            // 只选中一项时
            getResultSku(RadioList); // 取得交集
            filterWaitOptions(OptionsStatus.wait);
            filterSelectOptions(OptionsStatus.select, SpaId, SkaId);
            // 非全选状态时, 不可以购买
            $('#addCart').addClass('disabled');
            $('#buyNow').addClass('disabled');
        }else {
            getResultSku(RadioList);
            filterWaitOptions(OptionsStatus.wait);
            filterSelectOptions(OptionsStatus.select, SpaId, SkaId);
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
                data: {
                    skus: RequestStock
                }
            })
            .done(function(data) {
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
            })
            .fail(function() {
                console.log('error');
            })
            .always(function() {
                console.log('complete');
                closeLoading();
            });
    }

    // 绑定计数事件,商品数量
    // 需要添加库存验证
    $('#item-count').on('click', '[data-item]', function(e) {
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
            Count = NextCount++, // Count 当前的数值 , NextCount 是+1 之后的数量 , 用来拼接参数
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
                    var RequestStock = SelectSku + '_' + (++NextCount);

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

        $.each(Vas, function(index, val) {
            var $CurrentVas = $('#' + index);

            // 增值项 是否被选中
            if ($CurrentVas.hasClass('active')) {
                VarList[i] = {};
                VarList[i].vas_id = index; // 增值服务ID
                VarList[i].user_remark = ''; // 用户备注信息
                // 增值服务类型
                switch (val) {
                    case 1:
                        // 刻字
                        var remark = $CurrentVas.siblings('.input-engraving').val();
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
                data: {
                    operate: Operate
                }
            })
            .done(function(data) {
                if (data.success) {
                    if (data.redirectUrl !== '') {
                        window.location.href = data.redirectUrl;
                    }
                    console.log("success");
                    Modal.close();
                    if (Action === 'PATCH') {
                        openAddSuccess();
                        setTimeout(function() {
                            closeAddSuccess();
                        }, 1500);
                    }
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                closeLoading();
                console.log("complete");
            });

    }

    // 添加购物车
    $('[data-role="addCart"]').on('click', function(e) {
        var $SelectOptions = $('.btn-itemProperty.active');
        var OptionsCount = Object.keys(Options);

        if ($(e.target) === $('#addCart')) {
            if (!$(e.target).hasClass('disabled')) {
                initCart('PATCH');
                // 添加成功 刷新数量
                $.ajax({
                        url: ' /cart/amount',
                        type: 'GET'
                    })
                    .done(function(data) {
                        console.log('success');
                        // 操作成功刷新页面
                        if (data.success) {
                            if (data.data.skusAmout > 0) {
                                $('.nav-shoppingCart').children('span').html(data.data.skusAmout);
                            }
                        }
                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('complete');
                    });
            }
        } else {
            if ($SelectOptions.length !== OptionsCount.length) {
                Modal.open();
            } else {
                initCart('PATCH');
            }
        }
    });
    // 立即购买
    $('[data-role="buyNow"]').on('click', function(e) {
        var $SelectOptions = $('.btn-itemProperty.active');
        var OptionsCount = Object.keys(Options);
        if ($(e.target) === $('#addCart')) {
            if (!$(e.target).hasClass('disabled')) {
                initCart('PUT');
            }
        } else {
            if ($SelectOptions.length === OptionsCount.length) {
                Modal.open();
            }else {
                initCart('PUT');
            }
        }
    });

    $('.input-engraving').on('click', function(e) {
        $(e.target).removeClass('disabled');
    });

    // 模态框关闭时，把选择的项更新到 select 位置
    $('[data-remodal-id=modal]').on('closed', function() {
        var $SelectList = $('.btn-itemProperty.active');
        var TextOptions = '';
        $.each($SelectList, function(index, val) {
            if (index === ($SelectList.length - 1)) {
                TextOptions += val.text();
            } else {
                TextOptions += val.text() + ' , ';
            }
        });
        $('#selectOptions').text(TextOptions);
    });
    // 增值服务是否选中
    $('fieldset[data-vas-type]').on('click', function(e) {
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

    // 显示隐藏 message 更多内容
    $('.btn-showMore').on('click', function() {
        var $Message = $(this).siblings('.message-info');
        $Message.toggleClass('active');
        if ($Message.hasClass('active')) {
            $(this).children('.showMore').html('Show Less');
            $(this).children('.iconfont').removeClass('icon-arrow-bottom').addClass('icon-arrow-up');
        } else {
            $(this).children('.showMore').html('Show More');
            $(this).children('.iconfont').removeClass('icon-arrow-up').addClass('icon-arrow-bottom');
        }
    });

    $(document).ready(function() {
        if ($('.message-info').children('p').height() <= 56) {
            $('.btn-showMore').hide();
        }
    });
})
(jQuery, Swiper);

//# sourceMappingURL=shoppingDetail.js.map
