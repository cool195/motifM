/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    // 暂存选中的物流 ID
    var SelectID = '';

    var $ModalDialog = $('#deliveryDialog');
    // 选择运输方式
    $('[data-stype]').on('click', function () {
        $('#deliveryDialog').find('.icon-radio').removeClass("active");
        $(this).children(".icon-radio").addClass("active");
        // 传值
        SelectID = $(this).data("stype");
    });
    // 物流模态框 绑定事件
    $ModalDialog.on('opening', function () {
        // 初始化 物流选中项
        SelectID = $(this).data('select');
        // 激活选中项
        $(this).find('.icon-radio').removeClass('active');
        $('[data-stype="' + SelectID + '"]').children('.icon-radio').addClass('active');
    });
    $ModalDialog.on('confirmation', function () {
        // 获取 物流文本
        var DeliveryText = $('[data-stype="' + SelectID + '"]').data('dialog');
        // 传给页面
        $(".delivery-text").text(DeliveryText);

        //将当前选择的 运输方式赋值给 模态框
        $('#deliveryDialog').data('select', SelectID);

        $('input[name="stype"]').val(SelectID);
    });

    $('[data-form-action]').on('click', function () {
        var Action = $(this).data('form-action');
        $('#infoForm').attr('action', Action);
        $('#infoForm').submit();
    });
})(jQuery);
//# sourceMappingURL=orderCheckout.js.map
