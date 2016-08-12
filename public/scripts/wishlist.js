'use strict';
/* global jQuery */

(function ($) {

    // 初始化 模态框
    // $('#wishDialog').remodal({
    //     closeOnOutsideClick: false,
    //     hashTracking: false
    // });
    //
    // $('.delwish').click(function (e) {
    //     // 暂存数据 to modal , 为拼接 ajax url 做准备
    //     $('#wishDialog').data('sku', $(e.target).parents('.wishlist-item').data('sku'));
    //     console.log('open');
    // });

    var Options = {
        closeOnOutsideClick: false,
        closeOnCancel: false,
        hashTracking: false
    };
    // 删除购物车商品 提示框
    var wishModal = $('[data-remodal-id="modal"]').remodal(Options);

    $('.delwish').click(function (e) {
        // 暂存数据 to modal , 为拼接 ajax url 做准备
        $('#wishDialog').data('spu', $(e.target).data('spu'));
        //wishModal.open();
        console.log('open');
     });

})(jQuery);

//# sourceMappingURL=shoppingCart.js.map