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

    function checkInput() {
        var Result = true;
        $('input[type="text"]').each(function () {
            if ($(this).val() === '') {
                Result = false;
                return Result;
            }
        });
        return Result;
    }

    $('div[data-role="submit"]').on('click', function (e) {
        $(e.target).removeClass('disabled');

        if (checkInput()) {
            openLoading();
            $.ajax({
                url: '/user/modifyUserInfo',
                type: 'POST',
                data: $('#changeProfile').serialize()
            })
                .done(function (data) {
                    if (data.success) {
                        console.log("success");
                        $('#nick').attr('placeholder', $('#nick').val());
                        $('#nick').val("");
                    }
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                    closeLoading();
                });
        } else {
            $(e.target).addClass('disabled');
        }
    });
})(jQuery);

//# sourceMappingURL=profileSetting-changeProfile.js.map
