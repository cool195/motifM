/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    // 选择运输方式
    $('.btn-changeDelivery').on('click', function () {
        $(this).find(".icon-radio").addClass("active");
        $('.btn-changeDelivery').not(this).find(".icon-radio").removeClass("active");

        //将当前选择的 运输方式赋值给 模态框
        var deliveryText = $(this).data("dialog");
        $('#deliveryDialog').data('delivery', deliveryText);
    });

    // 将运输方式 显示在 结算页面
    $('#deliveryDialog').on('confirmation', function () {
        var delivery = $(this).data('delivery');
        $(".delivery-text").text(delivery);
    });

    // 关闭模态框后 去除模态框中的数据
    $('#deliveryDialog').on('closed', function () {
        $(this).removeData('delivery');
    });

    $('[data-form-action]').on('click', function () {
        var Action = $(this).data('form-action');
        $('#infoForm').attr('action', Action);
        $('#infoForm').submit();
    });
})(jQuery);
//# sourceMappingURL=orderCheckout.js.map
