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

    // 删除对应商品
    // TODO loading , ajax返回后 , 刷新页面
    function deleteCart() {
        // 判断相应的参数里是否有相应的值
        var sku = $('#cartDialog').data('sku'),
            action = $('#cartDialog').data('action');
        if (sku === undefined || action === undefined || sku === '' || action === '' || sku === null || action === null) {
            console.log('sku||action 为空');
            return;
        }
        openLoading();
        $.ajax({
            url: '/path/to/file',
            type: 'DELETE',
            data: { cmd: action, sku: sku }
        }).done(function () {
            console.log('success');
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // 移动商品 move to cart || move to save
    /**
     * moveProduct()
     * @param action
     * @param sku
     */
    // TODO loading , ajax返回后 , 刷新页面
    function moveProduct(action, sku) {
        if (sku === undefined || action === undefined || sku === '' || action === '' || sku === null || action === null) {
            console.log('sku||action 为空');
            return;
        }
        openLoading();
        $.ajax({
            url: '/path/to/file',
            type: 'UPDATE',
            data: { cmd: action, sku: sku }
        }).done(function () {
            console.log('success');
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // TODO 加载的 loading 动画
    // 调整商品数量
    function changeQtty(Sku, Qtty) {
        openLoading();
        $.ajax({
            url: '/path/to/file',
            type: 'UPDATE',
            data: { sku: Sku, qtty: Qtty }
        }).done(function () {
            console.log('success');
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // 购物车对话框 触发点
    $('[data-remodal-target="modal"]').click(function (e) {
        // 暂存数据 to modal , 为拼接 ajax url 做准备
        $('#cartDialog').data('sku', $(e.target).data('sku'));
        $('#cartDialog').data('action', $(e.target).data('action'));
        console.log('open');
    });

    // 初始化 模态框
    $('#cartDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: true
    });

    $('#cartDialog').on('closed', function () {
        $(this).removeData('sku').removeData('action');
        console.log('close');
    });
    $('#cartDialog').on('confirmation', function () {
        deleteCart();
    });

    // move 商品的出发点
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
//# sourceMappingURL=shoppingCart.js.map
