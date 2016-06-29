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

    var OrderInfo = [],
        OrderOperate = [];

    function getOrderInfo() {
        var OrderNum = $('[data-order-number]').data('order-number');
        $.ajax({
                url: '/orderdetail/' + OrderNum,
                type: 'GET'
            })
            .done(function(data) {
                console.log("success");
                if (data.success) {
                    OrderInfo = data.data.lineOrderList;
                    getOperate(OrderOperate);
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }

    function getOperate() {
        var Operate = {
            'sale_qtty': null, // 数量
            'select': true, // 是否选中
            'sku': null, // SKU
            'VAList': [] // 增值服务
        };

        $.each(OrderInfo, function(index, val) {
            Operate.sale_qtty = val.sale_qtty;
            Operate.sku = val.sku;

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
                console.log("success");
                if (data.success) {
                    //window.location.href = data.redirectUrl;
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    }
    $(document).ready(function() {
        if ($('.message-info').children('p').height() <= 144) {
            $('.btn-showMore').hide();
        }
        if ($('#orderState').data('state')) {
            getOrderInfo(OrderInfo);
        }
    });

    $('#buyAgain').click(function() {
        initCart();
    });

})(jQuery);

//# sourceMappingURL=orderDetail.js.map
