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
            data: {cps: Coupon}
        })
            .done(function (data) {
                if (data.success) {
                    console.log("success");
                    $('input[name="coupon"]').val(Coupon);
                    $('#infoForm').submit();
                } else {
                    $('.warning-info').removeAttr('hidden');
                    $('.warning-info').children('span').text(data.prompt_msg);
                }
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
                closeLoading();

            });
    }

    $('[data-role="submit"]').on('click', function () {
        var Coupon = $('input[name="coupon"]').val();
        verifyCoupon(Coupon);
    });

})(jQuery);

//# sourceMappingURL=orderCheckout-addCoupon.js.map
