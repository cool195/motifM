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
        $('#loading').toggleClass('loading-hidden');
        setTimeout(function () {
            $('#loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('#loading').addClass('loading-close');
        setTimeout(function () {
            $('#loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    // 打开失败 loading
    function openAddError() {
        $('#error').toggleClass('loading-hidden');
        setTimeout(function () {
            $('#error').toggleClass('loading-open');
        }, 25);
    }

    // 关闭失败 loading
    function closeAddError() {
        $('#error').addClass('loading-close');
        setTimeout(function () {
            $('#error').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    // 暂存 根据所选项所筛选出的 Skus 的结果
    var ResultSkus = [];

    var ModalOptions = {
        closeOnOutsideClick: false,
        closeOnCancel: false,
        hashTracking: false
    };
    // 删除购物车商品 提示框
    var wishModal = $('[data-remodal-id="modal"]').remodal(ModalOptions);

    // 选择产品属性
    var moveToBagModal = $('[data-remodal-id="movetobagmodal"]').remodal(ModalOptions);

    // 临时是否可用的SKU数组
    var tempSkusStatic = [];
    var tempInventory = [];
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

    $('#wishContainer').on('click', '.delwish', function (e) {
        // 暂存数据 to modal , 为拼接 ajax url 做准备
        $('#wishDialog').data('spu', $(e.target).data('spu'));
        wishModal.open();
    });

    // ajax 删除 wishlist 商品
    $('[data-remodal-action="confirm"]').on('click', function () {
        var WishId = $('#wishDialog').data('spu');
        deleteWish(WishId);
    });

    // 删除 wishlist 商品
    function deleteWish(WishId) {
        openLoading();
        $.ajax({
                url: '/updateWish',
                type: 'post',
                data: {spu: WishId}
            })
            .done(function (data) {
                if (data.success) {
                    $('[data-wishspu="' + WishId + '"]').remove();
                } else {
                    $('#error-info').text(data.error_msg);
                    openAddError();
                    setTimeout(function () {
                        closeAddError();
                    }, 1500);
                }
            })
            .always(function () {
                if ($('.wishlist-item').length <= 0) {
                    if (isEmpty) {
                        $('#emptyWishlist').removeClass('hidden-xs-up');
                        isEmpty = true;
                    }
                }
                closeLoading();
            });
    }

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

    var isEmpty = false;
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
                    if (!isEmpty) {
                        $('#emptyWishlist').removeClass('hidden-xs-up');
                        isEmpty = true;
                    }
                } else {
                    if (!isEmpty) {
                        $('#emptyWishlist').addClass('hidden-xs-up');
                        isEmpty = true;
                    }
                    // 遍历模板 插入页面
                    appendWishList('tpl-wishlist', data.data);
                    console.info(data.data);
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

    // 移动到购物车
    var skuExps;
    $('#wishContainer').on('click', '.btn-moveToBag', function () {
        openLoading();
        var ProductSpu = $(this).data('spu');
        $.ajax({
                url: '/products/' + ProductSpu
            })
            .done(function (data) {
                if (data.success) {
                    console.info(data.data);
                    if (data.data.skus.length > 1) {
                        initProductDetail(data.data);

                        // 初始化
                        skuExps = data.data.skuExps;
                        var Inventory = tempInventory = inventoryNull(data.data.skuExps);
                        // 所有选项
                        if (data.data.spuAttrs === undefined || data.data.spuAttrs == '') {
                            ResultSkus = data.data.skus;
                        } else {
                            tempSkusStatic = data.data.spuAttrs;
                            newOptions(data.data.spuAttrs, Inventory, Options);
                        }
                        // 所有sku对应的库存
                        newStock(data.data.skuExps, Stock);
                        // 所有增值服务
                        newVas(data.data.vasBases, Vas);


                        $('#modalDialog').data('spu', ProductSpu);
                        $('#modalDialog').data('status', data.data.status_code);
                        moveToBagModal.open();
                    } else {
                        var sku = data.data.skus[0];
                        // 商品添加到购物车
                        addToCart(ProductSpu, sku, 1);
                    }
                }
            })
            .always(function () {
                closeLoading();
            });
    });

    // 初始化商品属性
    function initProductDetail(data) {
        // 加载商品图片
        var ProductImg = data.main_image_url;
        $('#productImg').attr('data-original', 'https://s3-us-west-1.amazonaws.com/emimagetest/n1/' + ProductImg);
        $('#productImg').attr('src', 'https://s3-us-west-1.amazonaws.com/emimagetest/n1/' + ProductImg);

        // 加载商品价格
        var Price = 0, promot_price = 0, sale_price;
        if (data.skuPrice.skuPromotion != '' || data.skuPrice.skuPromotion != undefined) {
            Price = (data.skuPrice.skuPromotion.price / 100).toFixed(2);  //商品原价
            promot_price = (data.skuPrice.skuPromotion.promot_price / 100).toFixed(2); //商品折扣价
        }
        sale_price = (data.skuPrice.sale_price / 100).toFixed(2); //商品价格
        if (Price > promot_price) {
            $('#skuNewPrice').html(promot_price);
            $('#skuNewPrice').removeClass('text-primary');
            $('#skuNewPrice').addClass('text-red');
            $('#productPrice').html(Price);
        } else {
            $('#skuNewPrice').html(sale_price);
            $('#skuNewPrice').removeClass('text-red');
            $('#skuNewPrice').addClass('text-primary');
            $('#productPrice').html('');
        }

        // 加载提示语
        if (data.prompt_words != '') {
            $('#Product-prompt span').html(data.prompt_words);
            $('#Product-prompt').css('display', 'block');
        } else {
            $('#Product-prompt').css('display', 'none');
        }

        // 加载商品属性
        appendSkuAttrList('tpl-skuattrlist', data);

        // 加载商品增值服务
        appendVasBasesList('tpl-vasbaseslist', data);
    }

    // 遍历 商品属性 生成html
    function appendSkuAttrList(tpl, SkuAttrList) {
        var TplHtml = template(tpl, SkuAttrList);
        var StageCache = $.parseHTML(TplHtml);
        $('#product-skuAttr').html(StageCache);
    }

    // 遍历 商品增值服务 生成html
    function appendVasBasesList(tpl, VasBasesList) {
        var TplHtml = template(tpl, VasBasesList);
        var StageCache = $.parseHTML(TplHtml);
        $('#product-vasBases').html(StageCache);
    }

    // 将商品添加到购物车
    function addToCart(spu, sku, sale_qtty) {
        var Operate = {
            'sale_qtty': sale_qtty, // 数量
            'select': true, // 是否选中
            'sku': sku, // SKU
            'VAList': [] // 增值服务
        };
        $.ajax({
                url: '/cart',
                type: 'PATCH',
                data: {
                    operate: Operate
                }
            })
            .done(function (data) {
                if (data.success) {
                    updateCartCount();
                    deleteWish(spu);
                } else {
                    $('#error-info').text(data.error_msg);
                    openAddError();
                    setTimeout(function () {
                        closeAddError();
                    }, 1500);
                }
            });
    }

    // 修改购物车数量
    function updateCartCount() {
        $.ajax({
                url: ' /cart/amount',
                type: 'GET'
            })
            .done(function (data) {
                if (data.success) {
                    if (data.data.skusAmout > 0 && data.data.skusAmout <= 99) {
                        $('.nav-shoppingCart').children('span').show();
                        $('.nav-shoppingCart').children('span').html(data.data.skusAmout);
                    } else if (data.data.skusAmout > 99) {
                        $('.nav-shoppingCart').children('span').show();
                        $('.nav-shoppingCart').children('span').html('99+');
                    } else {
                        $('.nav-shoppingCart').children('span').hide();
                    }
                }
            });
    }


    // 为所有选项绑定事件
    $('#product-skuAttr').on('click', '.btn-itemProperty', function (e) {

        var $WarningInfo = $('.warning-info');
        if (!$WarningInfo.hasClass('off')) {
            $WarningInfo.addClass('off');
        }

        var SpaId = $(e.target).data('spa'),
            SkaId = $(e.target).data('ska');

        if ($(e.target).hasClass('disabled')) {
            return;
        } else if ($(e.target).hasClass('active')) {
            $('#spa' + SpaId).data('click', 'false');
            $(e.target).removeClass('active');
        } else {
            $(e.target).parents('.row').find('.btn-itemProperty').removeClass('active');
            $('#spa' + SpaId).data('click', 'true');
            $(e.target).addClass('active');
        }

        selectOptionsText();


        // RadioList 选中的选项数量
        // CheckCount 所有选项的组数
        var RadioList = $('#modalDialog').find('.btn-itemProperty.active'),
            CheckCount = Object.keys(Options);
        // 调整数量按钮组
        var $Count = $('#item-count');
        var OptionsStatus = resolutOptions(RadioList);

        // 重置 调整数量按钮组
        //$Count.children('[data-item]').addClass('disabled');
        $Count.children('[data-num="num"]').html(1);

        // 全选状态的筛选
        if (RadioList.length === CheckCount.length) {
            getResultSku(RadioList);
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
        } else if (RadioList.length < 1) {
            // 全都未选
            newOptions(tempSkusStatic, tempInventory, Options);
            // 重置交集
            ResultSkus = [];
        } else {
            getResultSku(RadioList);
            filterWaitOptions(OptionsStatus.wait);
            filterSelectOptions(OptionsStatus.select, SpaId, SkaId);
        }

        //更新SKU价格
        if (ResultSkus[0] != undefined) {
            $('#addToCart-sku').val(ResultSkus[0]);
            getNewPrice(ResultSkus[0]);
        }

        // 更新显示图片
        var ImgPath = $(this).data('image');
        if (ImgPath != undefined && ImgPath != '') {
            $('#productImg').attr('data-original', 'https://s3-us-west-1.amazonaws.com/emimagetest/n1/' + ImgPath);
            $('#productImg').attr('src', 'https://s3-us-west-1.amazonaws.com/emimagetest/n1/' + ImgPath);
        }
    });

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
            var vasId = value.vas_id,
                vasType = value.vas_type;
            objCache[vasId] = vasType;
        });
    }

    //更新SKU价格
    function getNewPrice(sku) {
        $.each(skuExps, function (index, val) {
            if (sku == val.sku) {
                $('#skuNewPrice').html('$' + (val.skuPrice.sale_price / 100).toFixed(2));
                return false;
            }
        });
    }

    function selectOptionsText() {
        var $SelectList = $('.btn-itemProperty.active');
        var TextOptions = '';
        if ($SelectList.length > 0) {
            $.each($SelectList, function (index, val) {
                if (index === ($SelectList.length - 1)) {
                    TextOptions += val.textContent.trim();
                } else {
                    TextOptions += val.textContent.trim() + ',';
                }
            });
            $('[data-select]').text('Selected:');
            //$('[data-select-options]').text(TextOptions);
        } else {
            $('[data-select]').text('Select');
            //$('[data-select-options]').text('');
        }

    }

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
     * 全选状态下的筛选
     * @param SpaId
     * @param SkaId
     */
    function switchOption(RadioList) {

        var SpaList = Object.keys(Options);
        if (SpaList.length === 1) {
            return;
        }

        // 把选定的 Skus , 编成一组 , Skus集合
        var SkusList = {};
        $.each(SpaList, function (index, val) {
            // 分别获取选中的选项中的 skaid 和 spaid
            var Ska = $(RadioList[index]).data('ska'),
                Spa = $(RadioList[index]).data('spa');
            SkusList[val] = Options[Spa][Ska];
        });

        // 作为比对项存在, 取 除需要比对的 Spa 外 ,剩余 Spa 所对应的 Skus 的集合
        $.each(SpaList, function (SpaIndex, SpaVal) {

            var Intersection = [];
            // 取交集
            $.each(SkusList, function (SkuIndex, SkuVal) {
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
            $.each(Options[SpaVal], function (SkusIndex, SkusVal) {

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

    /**
     * filterWaitOptions - 根据 已选定的 Skus 的集合(ResultSkus),筛选待选项的 Skus
     * 没有交集的项，添加 disabled
     *
     * @param  {Object} WaitOptions 带选项，多对应的 Spa ，Skus
     */
    function filterWaitOptions(WaitOptions) {
        // 筛选 未选项
        $.each(WaitOptions, function (i, iValue) {
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
            $.each(SelectOptions, function (i, iValue) {
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


    // 调整数量
    /**
     *
     * @param Count
     */
    function changeQtty(RequestStock, $QttyCount) {
        var $WarningInfo = $('.warning-info');
        openLoading();
        $.ajax({
                url: '/stock/checkstock',
                data: {
                    skus: RequestStock
                }
            })
            .done(function (data) {
                if (data.success) {

                    var Request = true;
                    var StockCount = parseInt($QttyCount.siblings('[data-num]').html());
                    if (data.data.list[0].stockStatus === 1) {
                        Request = true;
                    } else {
                        Request = false;
                    }

                    if (Request === false) {
                        $WarningInfo.removeClass('off');
                        $WarningInfo.children('span').html('Warning: Only ' + StockCount + ' left');

                        $QttyCount.addClass('disabled');
                    }
                }
            })
            .always(function () {
                closeLoading();
            });
    }

    // 绑定计数事件,商品数量
    // 需要添加库存验证
    $('#item-count').on('click', '[data-item]', function (e) {
        if (!showmsg()) {
            return false;
        }
        var $WarningInfo = $('.warning-info');

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
                $WarningInfo.removeClass('off');
                $WarningInfo.children('span').html('50 items limit');

                $QtyCount.addClass('disabled');
            }

            // 判断本地库存量
            if (StockCache < 20) {
                if (NextCount === StockCache) {
                    $WarningInfo.removeClass('off');
                    $WarningInfo.children('span').html('Warning: Only ' + NextCount + ' left');

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
            $WarningInfo.addClass('off');

            if (Count === 1) {
                $QtyCount.addClass('disabled');
            } else if ($QtyCount.siblings('[data-item="add"]').hasClass('disabled')) {
                $QtyCount.siblings('[data-item="add"]').removeClass('disabled');
            }
            Qtty = Count;
        }
        // 将计数更新
        $('#addToCart-quantity').val(Qtty);
        $QtyCount.siblings('[data-num]').html(Qtty);
    });

    //是否提示选择属性
    function showmsg() {
        var submit = true;
        var msg = '';
        $('.sparow').each(function (index) {
            if ($(this).data('click') == false || $(this).data('click') == 'false') {
                submit = false;
                msg += $(this).data('msg') + ',';
            }
        })

        if (submit) {
            return true;
        } else {
            $('#selectspa').html(msg.substring(0, msg.length - 1) + ' not selected');
            $('#selectmsg').removeClass('loading-hidden');
            setTimeout(function () {
                $('#selectmsg').addClass('loading-hidden');
            }, 1500);
        }
        return false;
    }

    $('[data-role="continue"]').on('click', function (e) {

        if ($('#addToCart-sku').val() != 1 && $('#modalDialog').data('login') != 1) {
            initCart('PATCH');
        } else {
            if (showmsg()) {
                var Action = $(e.target).data('action');
                initCart(Action);
            }
        }
    });

    /**
     * 添加购物车
     * @param Action
     */
    function initCart(Action) {
        if ($('#addToCart-sku').val() != 1) {
            ResultSkus[0] = $('#addToCart-sku').val();
        }
        var Qtty = $('#item-count').children('[data-num]').html();
        // ajax 请求的参数
        var Operate = {
            'sale_qtty': Qtty, // 数量
            'select': true, // 是否选中
            'sku': ResultSkus[0], // SKU
            'VAList': [] // 增值服务
        };
        $('#addToCart-sku').val(ResultSkus[0]);

        var i = 0;
        var VarList = [];

        $.each(Vas, function (index, val) {
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
                }
                i++;
            }
        });

        //onAddToCart();

        Operate.VAList = VarList;
        openLoading();
        var spu = $('#modalDialog').data('spu');
        // PUT 立即购买
        // PATCH 添加购物车
        $.ajax({
                url: '/cart',
                type: Action,
                data: {
                    operate: Operate
                }
            })
            .done(function (data) {
                if (data.success) {
                    updateCartCount();
                    moveToBagModal.close();
                    deleteWish(spu);
                } else {
                    $('#error-info').text(data.error_msg);
                    openAddError();
                    setTimeout(function () {
                        closeAddError();
                    }, 1500);
                }
            })
            .always(function () {
                closeLoading();
            });

    }

    // 增值服务信息
    // 增值服务是否选中
    $('#product-vasBases').on('click', 'fieldset[data-vas-type]', function (e) {
        // 判断增值服务类型
        if (parseInt($(this).data('vas-type')) === 1) {
            if ($(e.target).hasClass('icon-checkcircle')) {
                var $Check = $(e.target);
                var $Input = $(e.target).siblings('.input-engraving');
                if ($Check.hasClass('active')) {
                    $Input.addClass('disabled');
                    $Check.removeClass('active');
                    $Input.val('');
                } else {
                    $Input.removeClass('disabled');
                    $Check.addClass('active');
                }
            } else if ($(e.target).hasClass('input-engraving')) {
                var $Check = $(e.target).siblings('.icon-checkcircle');
                var $Input = $(e.target);
                if ($Input.hasClass('disabled')) {
                    $Input.removeClass('disabled');
                    $Check.addClass('active');
                    $Input.val('');
                }
            }
        }
    });

    // 过滤增值服务 不能输入中文
    function validateChinese(VasStr) {
        var InputText = '';
        for (var i = 0; i < VasStr.length; i++) {
            if (VasStr.charCodeAt(i) > 0 && VasStr.charCodeAt(i) < 255) {
                InputText += VasStr.charAt(i);
            }
        }
        return InputText;
    }

    /* 验证增值服务 只能输入数字和字母 '_' '-' '/' 空格 */
    function validateVas($Vas) {
        var InputText = validateChinese($Vas.val());
        var Reg = /^([a-z_A-Z-/+0-9+\s]+)$/i;
        for (var i = 0; i < InputText.length; i++) {
            var VasStr = InputText.charAt(i);
            if (!Reg.test(VasStr)) {
                InputText = InputText.replace(VasStr, '');
            }
        }
        $Vas.val(InputText);
    }

    // 验证增值服务输入内容
    $('#product-vasBases').on('keyup blur','.input-engraving', function () {
        validateVas($(this));
    });


})(jQuery);
