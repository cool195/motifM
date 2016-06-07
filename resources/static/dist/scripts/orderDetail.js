/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    // 隐藏、显示 文字内容
    // 显示 message to us 文字内容
    var text = $('#messageInfo').html();
    var newInfo = $('<div></div>').html(text.substring(0, 550));
    $('#btnShowMore').on('click', function () {
        var showMore = $('#showMore');
        var btntext = showMore.text() === 'Show Less' ? 'Show More' : 'Show Less';
        var classtext = showMore.text() === 'Show Less' ? 'icon-arrow-bottom' : 'icon-arrow-right';
        var textstr = showMore.text() === 'Show More' ? text : text.substring(0, 550);
        showMore.text(btntext);
        $('#btnShowMore i').removeClass('icon-arrow-bottom icon-arrow-right').addClass(classtext);
        $('#messageInfo').html(newInfo.html(textstr));
    });
    $('#messageInfo').html(newInfo.html());

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
            data: { cmd: 'addsku', pin: 'yinlinghui', operate: operate }
        }).done(function () {
            console.log('success');
        }).fail(function () {
            console.log('error');
        }).always(function () {
            console.log('complete');
        });
    }

    // 触发 重新购买 事件
    $('#buyAgain').click(function () {
        buyAgain();
    });
})(jQuery);
//# sourceMappingURL=orderDetail.js.map
