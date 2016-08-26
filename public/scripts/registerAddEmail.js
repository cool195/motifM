/**
 * Created by zhaozhe on 16/5/24.
 */
/*global jQuery*/
'use strict';
(function($) {
    var options = {
        closeOnOutsideClick: false,
        closeOnCancel: false,
        hashTracking: false
    };
    var Modal = $('#successModal').remodal(options);
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

    function validationEmail($Email) {
        var EmailNull = 'Please enter your email',
            EmailStyle = 'Please enter a valid email address';
        var $WarningInfo = $('.warning-info');
        var InputText = $Email.val();
        // 邮箱验证的正则表达式
        var Reg = /^[a-z0-9]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
        if (InputText === '') {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailNull);
            return false;
        } else if (!Reg.test(InputText)) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailStyle);
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
    }

    // 验证电子邮件的情况
    $('input[name="email"]').on('keyup blur change', function() {
        if (validationEmail($(this))) {
            $('div[data-role="submit"]').removeClass('disabled');
        } else {
            $('div[data-role="submit"]').addClass('disabled');
        }
    });

    $('div[data-role="submit"]').click(function() {
        if (!$(this).hasClass('disabled')) {
            openLoading();
            $.ajax({
                url: '/user/forget',
                type: 'POST',
                data: $('#reset').serialize()
            })
                .done(function(data) {
                    if (data.success) {
                        $('.warning-info').addClass('hidden-xs-up');

                        Modal.open();
                        $('#confirm').attr('href', data.redirectUrl);
                    } else {
                        $('.warning-info').removeClass('hidden-xs-up');
                        $('.warning-info').children('span').text(data.error_msg);
                    }
                })
                .always(function() {
                    closeLoading();
                });
        }
    });

})(jQuery);

//# sourceMappingURL=resetPassword.js.map
