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
            $.each($LinkList, function(index, val) {
                var Link = $(val).data('url-return');
                $(val).attr('href', Link);
            });
        } else {
            $.each($LinkList, function(index, val) {
                var Link = $(val).data('url-edit');
                $(val).attr('href', Link);
            });
        }
    }

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

    /**
     *
     * @param AddressId
     */
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
                    $('#infoForm').attr('action', data.redirectUrl);
                    $('#infoForm').submit();
                }
            });
    }

    $('#payment-edit').on('click', function(e) {
        // 可选的状态切换
        switchSelect($(e.target));

        // 跳转链接的切换
        switchLink($(e.target));

        // 切换按钮以及叉号状态
        switchEdit($(e.target));

        $('.payment-delete').toggleClass('switch');
    });

    $('[data-role="submit"]').on('click', function() {
        var PayType = $('.icon-radio.active').parents('.payment-info').data('type');
        var methodToken = $('.icon-radio.active').parents('.payment-info').data('token');
        var cardType = $('.icon-radio.active').parents('.payment-info').data('cardtype');
        var showName = $('.icon-radio.active').parents('.payment-info').data('showname');

        $('input[name="methodToken"]').val(methodToken);
        $('input[name="cardType"]').val(cardType);
        $('input[name="showName"]').val(showName);
        $('input[name="paym"]').val(PayType);

        $('#infoForm').submit();
    });

    // 删除按钮
    $('.payment-delete').on('click', function(e) {
        var PaymentToken = $(e.target).parents('.payment-item').data('token');
        $('#modalDialog').data('token', PaymentToken);
    });

    // 选定后赋值
    $('.payment-info').on('click', function() {
        var PaymentToken = $(this).parents('.payment-item').data('token');
        $('.icon-radio.active').removeClass('active');
        $(this).find('.icon-radio').addClass('active');
        $('input[name="methodtoken"]').val(PaymentToken);
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
                            $('#infoForm').attr('action', data.redirectUrl);
                            $('#infoForm').submit();
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

    $('#cardCredit').on('click', function(event) {
        event.preventDefault();
        $('#infoForm').attr('action', $(this).data('action'));
        $('#infoForm').submit();
    });

})(jQuery);


