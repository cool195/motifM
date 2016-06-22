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

    var token = $('#card-container').data('token');
    // 测试 token
    // var clientToken = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiIwODU0ZjI3YmQyYjRiMWU0MzNmZTVjMTljMGIxYzg4NDk4YWNjOTFhYmVmYWZmZmQ3ODQzOWVkMDY0MTU0MzkxfGNyZWF0ZWRfYXQ9MjAxNi0wNi0yMVQwODo0OTowNi42MDIzMTI1NjIrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";

    var $WaringInfo = $('.warning-info');
    var checkout = {}; // 事件 句柄

    braintree.setup(token, "custom", {
        id: "card-container",
        onReady: function onReady(integration) {
            checkout = integration;
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
                console.log("success");
                if (data.success) {
                    var $InfoForm = $('#infoForm');
                    if ($InfoForm === undefined) {
                        window.location.href = data.redirectUrl;
                    } else {
                        $InfoForm.submit();
                    }
                }
            }).fail(function () {
                console.log("error");
            }).always(function () {
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
    $('#cardNum').on('keyup', function (e) {
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
