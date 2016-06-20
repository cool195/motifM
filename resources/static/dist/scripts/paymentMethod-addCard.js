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

    // 测试 token
    var token = "sandbox_g42y39zw_348pk9cgf3bgyw2b";

    var $CardImage = $('#card-type'),
        $WaringInfo = $('.warning-info');

    var checkout = {}; // 事件 句柄

    braintree.setup(token, "custom", {
        id: "card-container",
        hostedFields: {
            number: {
                selector: "#card-number",
                placeholder: "Card Number"
            },
            expirationDate: {
                selector: "#expiration-date",
                placeholder: "MM/YY"
            },
            cvv: {
                selector: "#cvv",
                placeholder: "111"
            },
            onFieldEvent: function onFieldEvent(event) {
                console.info(event);
                if (event.type === 'focus') {
                    // Handle focus
                } else if (event.type === 'blur') {
                        // Handle blur
                    } else if (event.type === 'fieldStateChange') {
                            // Handle a change in validation or card type
                            if (event.isValid) {
                                $WaringInfo.addClass('off');
                            } else {
                                var ErrorMessage = '';
                                switch (event.target.fieldKey) {
                                    case 'number':
                                        ErrorMessage = 'Please enter a valid credit card or debit card number.';
                                        break;
                                    case 'expirationDate':
                                        ErrorMessage = 'Please enter a valid Expiration Date.';
                                        break;
                                    case 'cvv':
                                        ErrorMessage = 'Please enter a valid CSC (Card Security Code).';
                                        break;
                                    default:
                                        break;
                                }
                                $WaringInfo.children('span').html(ErrorMessage);
                                $WaringInfo.removeClass('off');
                            }

                            // 银行卡 图片设置
                            if (event.card) {
                                console.log(event.card.type);
                                if (!$CardImage.hasClass(event.card.type)) {
                                    $CardImage.attr('class', 'card-image');
                                    $CardImage.addClass(event.card.type);
                                }
                                // visa|master-card|american-express|diners-club|discover|jcb|unionpay|maestro
                            } else {
                                    $CardImage.attr('class', 'card-image');
                                }
                        }
            }
        },
        onReady: function onReady(integration) {
            checkout = integration;
            console.log(checkout);
        },
        onError: function onError(error) {
            if (error.type === 'VALIDATION') {
                $WaringInfo.children('span').html(error.message);
                $WaringInfo.removeClass('off');
            } else {
                console.error(error.message);
            }
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
                console.log("complete");
                closeLoading();
            });
        }
    });
})();
//# sourceMappingURL=paymentMethod-addCard.js.map
