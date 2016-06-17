'use strict';

(function ($) {
    /**
     *
     * @param $Edit
     */
    function switchEdit($Edit) {
        if ($Edit.hasClass('active')) {
            $Edit.html('Edit');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary-outline').removeClass('btn-primary');
            $('div[data-role="submit"]').removeClass('hidden');
        } else {
            $Edit.html('Done');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary').removeClass('btn-primary-outline');
            $('div[data-role="submit"]').addClass('hidden');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchSelect($Edit) {
        var $IconFont = $('.payment-info').find('.iconfont');
        if ($Edit.hasClass('active')) {
            $IconFont.addClass('icon-radio');
        } else {
            $IconFont.removeClass('icon-radio');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchLink($Edit) {
        var $LinkList = $('.payment-info');

        if ($Edit.hasClass('active')) {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-return');
                $(val).attr('href', Link);
            });
        } else {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-edit');
                $(val).attr('href', Link);
            });
        }
    }

    $('#payment-edit').on('click', function (e) {
        // 可选的状态切换
        switchSelect($(e.target));

        // 跳转链接的切换
        switchLink($(e.target));

        // 切换按钮以及叉号状态
        switchEdit($(e.target));

        $('.payment-delete').toggleClass('switch');
    });

    $('[data-role="submit"]').on('click', function () {
        $('#infoForm').submit();
    });

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

    /**
     *
     * @param AddressId
     */
    function deleteAddress(PaymentToken) {
        // TODO loading 动画
        openLoading();

        $.ajax({
            url: ' /pay/del',
            type: 'DELETE',
            data: {
                methodtoken: PaymentToken
            }
        }).done(function () {
            console.log("success");
            return true;
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("complete");
            closeLoading();
        });
    }

    // 删除按钮
    $('.payment-delete').on('click', function (e) {
        var PaymentToken = $(e.target).parents('.payment-info').data('token');
        $('#modalDialog').data('address', PaymentToken);
    });
    $('.payment-info').on('click', function () {
        $('.icon-radio.active').removeClass('active');
        $(this).find('.icon-radio').addClass('active');
        var PaymentToken = $(this).parents('.payment-info').data('token');
        $('input[name="methodtoken"]').val(PaymentToken);
    });
    // 初始化 模态框
    $('#modalDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: true
    });

    $('#modalDialog').on('closed', function () {
        $(this).removeData('address');
        console.log('close');
    });
    $('#modalDialog').on('confirmation', function () {
        var PaymentToken = $(this).data('token');
        if (AddressID === undefined || AddressID === null || AddressID === '') {
            console.log('Token 没有值');
            return;
        }
        deleteAddress(PaymentToken);
    });

    /* TODO 判断 token 是否为空 */
    // 客户端验证 token
    var token = $('#paypal').data('braintree');
    // 测试 token
    // var token = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJjZTRjNzVjZTkwMjRiNGVkMTYxMzlmNTlmODNiYmVmMjRmNDFjMjZjM2U3YjMyZmE0YzI5YzdmMjJiNDAyOTQ0fGNyZWF0ZWRfYXQ9MjAxNi0wNi0xM1QxMDo1NDozMy4wMzcxMDk3ODArMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";
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
                data: { nonce: payload.nonce }
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
            data: { methodtoken: Token }
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
})(jQuery);
//# sourceMappingURL=orderCheckout-payment.js.map
