/*global jQuery*/

'use strict';
(function($) {

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
            .done(function(data) {
                if (data.success) {
                    $('input[name="cps"]').val(Coupon);
                    $('#infoForm').submit();
                } else {
                    $('.warning-info').removeAttr('hidden');
                    $('.warning-info').children('span').text(data.prompt_msg);
                }
            })
            .always(function() {
                closeLoading();
            });
    }

    $('input[name="coupon"]').on('keyup', function() {
        if($(this).val()===''){
            $('div[data-role="submit"]').addClass('disabled');
        }else {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    });

    $('div[data-role="submit"]').on('click', function(e) {
        if (!$(e.target).hasClass('disabled')) {
            var Coupon = $('input[name="coupon"]').val();
            verifyCoupon(Coupon);
        }
    });

})(jQuery);

//# sourceMappingURL=orderCheckout-addCoupon.js.map
