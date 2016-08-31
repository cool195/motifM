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

    // 图片延迟加载
    $('img.img-lazy').lazyload({
        threshold: 200,
        effect: 'fadeIn'
    });

    // 删除对应商品
    // TODO loading , ajax返回后 , 刷新页面
    function deleteCart() {
        onRemoveFromCart();

        // 判断相应的参数里是否有相应的值
        var sku = $('#cartDialog').data('sku'),
            action = $('#cartDialog').data('action');
        if (sku === undefined || action === undefined || sku === '' || action === '' || sku === null || action === null) {
            console.log('sku||action 为空');
            return;
        }
        openLoading();
        $.ajax({
                url: '/cart/operate',
                type: 'POST',
                data: {cmd: action, sku: sku}
            })
            .done(function (data) {
                if (data.success) {
                    console.log('success');
                    location.reload();
                }
            })
            .fail(function () {
                console.log('error');
            })
            .always(function () {
                closeLoading();
                console.log('complete');
            });

    }

    /**
     * 移动商品 move to cart || move to save
     * moveProduct()
     * @param action
     * @param sku
     */
    function moveProduct(action, sku) {
        if (sku === undefined || action === undefined || sku === '' || action === '' || sku === null || action === null) {
            console.log('sku||action 为空');
            return;
        }
        openLoading();
        $.ajax({
                url: '/cart/operate',
                type: 'POST',
                data: {cmd: action, sku: sku}
            })
            .done(function (data) {
                console.log('success');
                // 操作成功刷新页面
                if (data.success) {
                    location.reload();
                }
            })
            .fail(function () {
                console.log('error');
            })
            .always(function () {
                closeLoading();
                console.log('complete');
            });
    }

    /**
     * 更改 商品数量
     * @param Sku
     * @param Qtty
     * @param $Count
     */
    function changeQtty(Sku, Qtty, $Count) {
        openLoading();
        $.ajax({
                url: '/cart/alterQtty',
                type: 'POST',
                data: {sku: Sku, qtty: Qtty}
            })
            .done(function (data) {
                // TODO 操作失败时 需要进行什么操作
                // 操作成功刷新页面
                if (data.success) {
                    location.reload();
                    $Count.siblings('[data-count]').html(Qtty);
                }
            })
            .fail(function () {
                console.log('error');
            })
            .always(function () {
                console.log('complete');
                closeLoading();
            });
    }

    // 绑定计数事件,商品数量
    // 需要添加库存验证
    $('.item-count').on('click', '[data-item]', function (e) {

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
        // Checkstock 拼接后的请求字符串
        var Count = parseInt($QtyCount.siblings('[data-count]').html()),
            SelectSku = $(e.target).parents('.item-count').data('sku'),
            NextCount = Count;

        if ($QtyCount.data('item') === 'add') {
            NextCount++;
        } else {
            NextCount--;
        }
        changeQtty(SelectSku, NextCount, $QtyCount);
    });

    // 购物车对话框 触发点
    $('[data-remodal-target="modal"]').click(function (e) {
        // 暂存数据 to modal , 为拼接 ajax url 做准备
        $('#cartDialog').data('sku', $(e.target).data('sku'));
        $('#cartDialog').data('action', $(e.target).data('action'));

        $('#removeFromCart-name').val($(this).data('title'));
        $('#removeFromCart-sku').val($(this).data('sku'));
        $('#removeFromCart-price').val($(this).data('price'));
        $('#removeFromCart-quantity').val($(this).data('qtty'));
        console.log('open');
    });

    // 初始化 模态框
    $('#cartDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

    $('#cartDialog').on('closed', function () {
        $(this).removeData('sku').removeData('action');
        console.log('close');
    });
    $('#cartDialog').on('confirmation', function () {
        deleteCart();
    });

    // move 商品的触发点
    $('[data-product-move]').on('click', function () {
        var action = $(this).data('product-move');
        var sku = $(this).data('sku');
        moveProduct(action, sku);
    });

    // 更新商品数量
    $('[data-item-qty]').on('click', function (e) {
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
        // Sku 从父级标签获取 SkuID
        // Qtty 从兄弟标签获取 商品数量
        var Sku = $QtyCount.parents('.btn-group').data('sku'),
            Qtty = $QtyCount.siblings('[data-item-num]').data('item-num');
        // 判断点击的项是 + 还是 -
        if ($QtyCount.data('item-qty') === 'add') {
            // 加号
            Qtty++;
        } else {
            Qtty--;
        }
        changeQtty(Sku, Qtty);
    });
})(jQuery);

