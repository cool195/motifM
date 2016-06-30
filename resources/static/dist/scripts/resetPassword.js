/**
 * Created by zhaozhe on 16/5/24.
 */
/*global jQuery*/
'use strict';
(function($) {

    function openAddSuccess() {
        $('#success').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#success').toggleClass('loading-open');
        }, 25);
    }

    function closeAddSuccess() {
        $('#success').addClass('loading-close');
        setTimeout(function() {
            $('#success').toggleClass('loading-hidden loading-open').removeClass('loading-close');
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
    $('input[name="email"]').on('keyup blur change', function(e) {
        if (validationEmail($(this))) {
            $('div[data-role="submit"]').removeClass('disabled');
        } else {
            $('div[data-role="submit"]').addClass('disabled');
        }
    });

    $('div[data-role="submit"]').click(function() {
        if (!$(this).hasClass('disabled')) {
            $.ajax({
                    url: "/user/forget",
                    type: "POST",
                    data: $('#reset').serialize()
                })
                .done(function(data) {
                    console.log("success");
                    if (data.success) {
                        openAddSuccess();
                        setTimeout(function() {
                            closeAddSuccess();
                        }, 1500);

                        $('.warning-info').addClass('hidden-xs-up');

                        $('#successText').text(data.prompt_msg);
                        window.location.href = data.redirectUrl;
                    } else {
                        $('.warning-info').removeClass('hidden-xs-up');
                        $('.warning-info').children('span').text(data.error_msg);
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
        }
    });

})(jQuery);

//# sourceMappingURL=resetPassword.js.map
