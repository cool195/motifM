/*global jQuery*/

'use strict';
(function ($) {

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
    function verifyCoupon(Coupon) {
        // TODO loading 动画
        openLoading();

        $.ajax({
                url: '/cart/verifycoupon',
                type: 'POST',
                data: {
                    cps: Coupon
                }
            })
            .done(function (data) {
                if (data.success) {
                    $('input[name="cps"]').val(Coupon);
                    $('#infoForm').submit();
                } else {
                    $('.warning-info').removeAttr('hidden');
                    data.prompt_msg = data.prompt_msg == '' ? 'Invalid code' : data.prompt_msg;
                    $('.warning-info').children('span').text(data.prompt_msg);
                }
            })
            .always(function () {
                closeLoading();
            });
    }

    // 键盘输入内容 触发事件
    $('input[name="coupon"]').on('keyup', function (e) {
        if ($(this).val() === '') {
            $('div[data-role="submit"]').addClass('disabled');
        } else {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    });

    // 粘贴内容 触发事件
    $('input[name="coupon"]').on('paste', function (e) {
        var pastedText = undefined;
        if (window.clipboardData && window.clipboardData.getData) {
            pastedText = window.clipboardData.getData('Text');
        } else {
            pastedText = e.originalEvent.clipboardData.getData('Text');
        }

        if (pastedText === '' || pastedText === undefined) {
            $('div[data-role="submit"]').addClass('disabled');
        } else {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    });

    $('div[data-role="submit"]').on('click', function (e) {
        if (!$(e.target).hasClass('disabled')) {
            var Coupon = $('input[name="coupon"]').val();
            verifyCoupon(Coupon);
        }
    });


    // 选择 promotion code
    //$('.promotion-item').on('click', function () {
    //    var PromotionCode = $(this).data('code');
    //    $('.promotion-radio').removeClass('active');
    //    if (!$(this).find('.promotion-radio').hasClass('hidden')) {
    //        $(this).find('.promotion-radio').addClass('active');
    //        $('input[name="coupon"]').val(PromotionCode);
    //        $('div[data-role="submit"]').removeClass('disabled');
    //    }
    //});

})(jQuery);

