/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';
(function($) {
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

    var OrderInfo = [];
    var OrderOperate = new Array();
    function getOrderInfo() {
        var OrderNum = $('[data-order-number]').data('order-number');
        $.ajax({
                url: '/orderdetail/' + OrderNum,
                type: 'GET'
            })
            .done(function(data) {
                if (data.success) {
                    OrderInfo = data.data.lineOrderList;
                    getOperate();
                }
            });
    }

    function getOperate() {


        $.each(OrderInfo, function(index, val) {
            var Operate = {
                'sale_qtty': val.sale_qtty, // 数量
                'select': true, // 是否选中
                'sku': val.sku, // SKU
                'VAList': [] // 增值服务
            };
            var Cache = [];
            $.each(val.vas_info, function(i, el) {
                Cache[i] = {};
                Cache[i].user_remark = el.user_remark;
                Cache[i].vas_id = el.vas_id;
            });

            Operate.VAList = Cache;
            OrderOperate.push(Operate);
        });
    }

    function initCart() {

        $.ajax({
                url: '/cart/addBatchCart',
                type: 'POST',
                data: {
                    operate: OrderOperate
                }
            })
            .done(function(data) {
                if (data.success) {
                    window.location.href = data.redirectUrl;
                }
            });

    }
    $(document).ready(function() {
        if ($('.message-info').children('p').height() <= 144) {
            $('.btn-showMore').hide();
        }
        if ($('#orderState').data('state')) {
            getOrderInfo();
        }
    });

    $('#buyAgain').click(function() {
        initCart();
    });

    // 初始化 弹出 paywith 选择框
    var Options = {
        closeOnOutsideClick: true,
        closeOnCancel: false,
        hashTracking: false
    };
    // 选择支付方式框
    var PayWithModal = $('[data-remodal-id="paywith-modal"]').remodal(Options);
    // 打开窗口
    //PayWithModal.open();
    // 关闭窗口
    //PayWithModal.close();
    $('.checkoutPay').on('click',function () {
        PayWithModal.open();
    });
})(jQuery);

