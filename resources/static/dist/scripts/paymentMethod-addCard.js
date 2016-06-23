(function() {
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

    var token = $('#card-container').data('token');
    // 测试 token

    var $WaringInfo = $('.warning-info');
    var checkout = {}; // 事件 句柄

    braintree.setup(token, "custom", {
        id: "card-container",
        onReady: function(integration) {
            checkout = integration;
        },
        onError: function(error) {
            if (error.type === 'VALIDATION') {
                $WaringInfo.children('span').html(error.message);
                $WaringInfo.removeClass('off');
            } else {
                console.error(error.message);
            }
        },
        onPaymentMethodReceived: function(payload) {
            console.info('payload : ');
            console.info(payload);
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
                    console.log("success");
                    if (data.success) {
                        var $InfoForm = $('#infoForm');
                        if ($InfoForm.length === 0) {
                            window.location.href = data.redirectUrl;
                        } else {
                            $InfoForm.submit();
                        }
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
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
            console.log('CardNum 为空');
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
        console.log(CardsTypes);
    }

    // 验证 卡的输入情况
    $('#cardNum').on('keyup', function(e) {
        validationCard($(this));
    });
    // TODO 需要限制输入格式, 限制日期格式, 银行卡格式
})();
//onFieldEvent: function (event) {
// console.info(event);
// if (event.type === 'focus') {
//     // Handle focus
// } else if (event.type === 'blur') {
//     // Handle blur
// } else if (event.type === 'fieldStateChange') {
//     // Handle a change in validation or card type
//     if (event.isValid) {
//         $WaringInfo.addClass('off');
//     } else {
//         var ErrorMessage = '';
//         switch (event.target.fieldKey) {
//             case 'number':
//                 ErrorMessage = 'Please enter a valid credit card or debit card number.';
//                 break;
//             case 'expirationDate':
//                 ErrorMessage = 'Please enter a valid Expiration Date.';
//                 break;
//             case 'cvv':
//                 ErrorMessage = 'Please enter a valid CSC (Card Security Code).';
//                 break;
//             default:
//                 break;
//         }
//         $WaringInfo.children('span').html(ErrorMessage);
//         $WaringInfo.removeClass('off');
//     }
//
//     // 银行卡 图片设置
//     if (event.card) {
//         console.log(event.card.type);
//         if (!$CardImage.hasClass(event.card.type)) {
//             $CardImage.attr('class', 'card-image');
//             $CardImage.addClass(event.card.type);
//         }
//         // visa|master-card|american-express|diners-club|discover|jcb|unionpay|maestro
//     } else {
//         $CardImage.attr('class', 'card-image');
//     }
// }
//
// }

//# sourceMappingURL=paymentMethod-addCard.js.map
