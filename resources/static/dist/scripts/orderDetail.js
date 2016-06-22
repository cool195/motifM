/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';
(function ($) {
    // 显示隐藏 message 更多内容
    $('.btn-showMore').on('click', function () {
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

    $(document).ready(function () {
        if($('.message-info').children('p').height() <= 144){
            $('.btn-showMore').hide();
        }
    });

    // 获取当前取消的 订单
    function getOperate() {
        var orderlist = $('.orderList-item');
        var obj = {};
        $.each(orderlist, function (index) {
            var sku = $(this).data('sku');
            var qty = $(this).data('item-qty');

            obj[index] = {};
            obj[index].sale_qtty = qty;
            obj[index].sku = sku;

            //判断当前订单的 商品中 是否有增值服务
            var vasobj = {};
            $(this).find('.vaList').each(function (i) {
                var remark = $(this).data('remark');
                var vasid = $(this).data('vasid');

                vasobj[i] = {};
                vasobj[i].user_remark = remark;
                vasobj[i].vas_id = vasid;

                // 将增值服务添加到 obj 中
                obj[index].VAList = vasobj;
            });
        });
        console.info(obj);
        return obj;
    }

    // 取消订单 重新购买
    function buyAgain() {
        // 获取 取消的订单信息
        var operate = JSON.stringify(getOperate());
        $.ajax({
            url: '/cart/batchAddCart',
            type: 'POST',
            data: {cmd: 'addsku', pin: 'yinlinghui', operate: operate}
        })
            .done(function () {
                console.log('success');
            })
            .fail(function () {
                console.log('error');
            })
            .always(function () {
                console.log('complete');
            });
    }

    // 触发 重新购买 事件
    $('#buyAgain').click(function () {
        buyAgain();
    });

})(jQuery);

//# sourceMappingURL=orderDetail.js.map
