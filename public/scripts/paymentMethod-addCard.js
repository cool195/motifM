/*global jQuery braintree getCardTypes*/

'use strict';
(function($) {
    function openSuccess() {
        $('#success').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#success').toggleClass('loading-open');
        }, 25);
    }
    // loading 打开
    function openLoading() {
        $('#loading').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('#loading').addClass('loading-close');
        setTimeout(function() {
            $('#loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    var token = $('#card-container').data('token');
    // 测试 token

    var $WaringInfo = $('.warning-info');
    var checkout = {}; // 事件 句柄

    braintree.setup(token, 'custom', {
        id: 'card-container',
        onReady: function(integration) {
            checkout = integration;
        },
        onError: function(error) {
            if (error.type === 'VALIDATION') {
                $WaringInfo.children('span').html(error.message);
                $WaringInfo.removeClass('off');
            }
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
                        $('.warning-info').addClass('off');
                        openSuccess();
                        var $InfoForm = $('#infoForm');
                        if ($InfoForm.length === 0) {
                            setTimeout(function() {
                                window.location.href = data.redirectUrl;
                            }, 1500);
                        } else {
                            setTimeout(function() {
                                $InfoForm.submit();
                            }, 1500);
                        }
                    } else {
                        $('.warning-info').removeClass('off');
                        $('.warning-info').children('span').text(data.prompt_msg);
                    }
                })
                .fail(function() {})
                .always(function() {
                    closeLoading();
                });
        }
    });

    // 判断 卡类型
    function validationCard($CardInput) {
        // visa|master-card|american-express|diners-club|discover|jcb|unionpay|maestro
        var $CardImage = $('#card-type'),
            CardNum = $CardInput.val(),
            CardsTypes = getCardTypes(CardNum);
        if (CardNum === '') {
            $CardImage.attr('class', 'card-image');
        } else if (CardsTypes.length !== 0) {
            if (!$CardImage.hasClass(CardsTypes)) {
                $CardImage.attr('class', 'card-image');
                $CardImage.addClass(CardsTypes[0].type);
                // TODO 判断 CVV 长度
            }
            $CardInput.removeClass('text-warning');
        } else {
            $CardInput.addClass('text-warning');
        }
    }

    // 验证 卡的输入情况
    $('#cardNum').on('keyup', function() {
        validationCard($(this));
    });

    // 表单非空验证
    function checkInput() {
        var Result = true;
        $('input[data-optional]').each(function() {
            if ($(this).val() === '') {
                Result = $(this);
                return false;
            }
        });
        return Result;
    }

    $('input[data-optional]').on('keyup', function() {
        var $Error = checkInput();
        if ($Error === true) {
            $('.warning-info').addClass('hidden-xs-up');
            $('input[type="submit"]').removeClass('disabled').removeAttr('disabled');
        } else {
            $('.warning-info').removeClass('hidden-xs-up');
            $('input[type="submit"]').addClass('disabled').attr('disabled', 'disabled');
        }
    });

    // 初始化 弹出 paywith 选择框
    var Options = {
        closeOnOutsideClick: true,
        closeOnCancel: false,
        hashTracking: false
    };
    // 选择支付方式框
    var CVVModal = $('[data-remodal-id="cvvquestion-modal"]').remodal(Options);
    $('.icon-question').on('click',function () {
        CVVModal.open();
    })

})(jQuery);

//# sourceMappingURL=paymentMethod-addCard.js.map
