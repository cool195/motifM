'use strict';

(function () {
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

    /* TODO 判断 token 是否为空 */
    // 客户端验证 token
    var token = $('#paypal').data('braintree');
    // 测试 token
    // braintree 初始化

    var checkout = {}; // 事件 句柄

    braintree.setup(token, "custom", {
        paypal: {
            currency: 'USD', // 沙盒系统需要字段
            locale: 'en_us', // 沙盒系统需要字段
            headless: true
        },
        onReady: function onReady(integration) {
            checkout = integration;
        },
        onPaymentMethodReceived: function onPaymentMethodReceived(payload) {
            console.info('payload : ');
            console.info(payload);

            openLoading();
            // TODO
            $.ajax({
                url: '/braintree',
                type: 'POST',
                data: {nonce: payload.nonce}
            }).done(function (data) {
                if (data.success) {
                    console.log("success");
                    location.reload();
                }
            }).fail(function () {
                console.log("error");
            }).always(function () {
                closeLoading();
                console.log("complete");
            });
        }
    });

    $('#paypal').on('click', function (event) {
        event.preventDefault();
        checkout.paypal.initAuthFlow();
    });

    $('.icon-delete').on('click', function (e) {

        var Token = $(e.target).parents('.payment-item').children('.payment-info').data(token);

        openLoading();
        // TODO
        $.ajax({
            url: '/braintree',
            type: 'DELETE',
            data: {methodtoken: Token}
        }).done(function (data) {
            if (data.success) {
                console.log("success");
                location.reload();
            }
        }).fail(function () {
            console.log("error");
        }).always(function () {
            closeLoading();
            console.log("complete");
        });
    });
})();
//# sourceMappingURL=paymentMethod-paypal.js.map
