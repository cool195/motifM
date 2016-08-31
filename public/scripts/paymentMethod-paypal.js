/*global jQuery braintree*/

'use strict';
(function($) {
    /**
     *
     * @param $Edit
     */
    function switchEdit($Edit) {
        if ($Edit.hasClass('active')) {
            $Edit.html('Edit');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary-outline').removeClass('btn-primary');
        } else {
            $Edit.html('Done');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary').removeClass('btn-primary-outline');
        }
    }

    $('#payment-edit').on('click', function(e) {
        // 切换按钮以及叉号状态
        switchEdit($(e.target));
        $('.payment-delete').toggleClass('switch');
    });

    // loading 打开
    function openLoading() {
        $('.loading').toggleClass('loading-hidden');
        setTimeout(function() {
            $('.loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('.loading').addClass('loading-close');
        setTimeout(function() {
            $('.loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    /* TODO 判断 token 是否为空 */
    // 客户端验证 token
    var token = $('#paypal').data('braintree');
    // 测试 token
    // braintree 初始化

    var checkout = {}; // 事件 句柄
    if (token !== '' && token !== undefined) {
        braintree.setup(token, 'custom', {
            paypal: {
                currency: 'USD', // 沙盒系统需要字段
                locale: 'en_us', // 沙盒系统需要字段
                headless: true
            },
            onReady: function(integration) {
                checkout = integration;
            },
            onPaymentMethodReceived: function(payload) {
                openLoading();
                // TODO
                $.ajax({
                        url: '/braintree',
                        type: 'POST',
                        data: {
                            nonce: payload.nonce
                        }
                    })
                    .done(function(data) {
                        if (data.success) {
                            window.location.href = data.redirectUrl;
                        }
                    })
                    .always(function() {
                        closeLoading();
                    });

            }
        });
    }

    $('#paypal').on('click', function(event) {
        event.preventDefault();
        checkout.paypal.initAuthFlow();
    });

    function deletePayment(PaymentToken) {
        // TODO loading 动画
        openLoading();

        $.ajax({
                url: ' /braintree',
                type: 'DELETE',
                data: {
                    methodtoken: PaymentToken
                }
            })
            .done(function(data) {
                if (data.success) {
                    window.location.href = data.redirectUrl;
                }
            })
            .always(function() {
                closeLoading();
            });
    }

    // 删除按钮
    $('.payment-delete').on('click', function(e) {
        var PaymentToken = $(e.target).parents('.payment-item').data('token');
        $('#modalDialog').data('token', PaymentToken);
    });

    // 初始化 模态框
    $('#modalDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

    $('#modalDialog').on('closed', function() {
        $(this).removeData('token');
    });
    $('#modalDialog').on('confirmation', function() {
        var PaymentToken = $(this).data('token');
        if (PaymentToken === undefined || PaymentToken === null || PaymentToken === '') {
            return;
        }
        deletePayment(PaymentToken);
    });
})(jQuery);


