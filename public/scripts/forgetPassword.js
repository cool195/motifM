/**
 * Created by lhyin on 16/6/01.
 */
/*global jQuery*/

'use strict';
(function($) {
    // 初始化模态框
    var $ModalDialog = $('#changePwdDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

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
    // 验证密码输入长度
    function validatePwdLenght(InputText) {
        var PasswordNull = 'Please enter your password',
            PasswordLength = 'Password needs to be at least 6 characters';
        var $WarningInfo = $('.warning-info');
        if (InputText === '' || InputText === undefined) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.children('span').html(PasswordNull);
            return false;
        } else if (InputText.length < 6 || InputText.length > 32) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('hidden-xs-up');
            $WarningInfo.children('span').html(PasswordLength);
            return false;
        } else {
            return true;
        }
    }

    // 验证确认密码 和 新密码是否正确
    function validateConfirmPwd(NewPwd, confirmPwd) {
        var PasswordConfirm = 'New password does not match';
        var $WarningInfo = $('.warning-info');
        if (NewPwd !== confirmPwd) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('hidden-xs-up');
            $WarningInfo.children('span').html(PasswordConfirm);
            return false;
        } else {
            return true;
        }
    }
    $('input[type="password"]').on('keyup', function(e) {
        var NewPwd = $('input[name="pw"]').val(),
            AnotherPwd = $('input[name="lastpw"]').val();

        // 验证输入密码长度
        var BoolLength = validatePwdLenght($(e.target).val());

        if (NewPwd !== '' && NewPwd !== undefined && AnotherPwd !== '' && NewPwd !== undefined) {
            // 验证密码是否匹配
            var BoolSame = validateConfirmPwd(NewPwd, AnotherPwd);
        }

        if (BoolLength && BoolSame) {
            $('[data-role="submit"]').removeClass('disabled');
            $('.warning-info').addClass('hidden-xs-up');
        }

    });

    $('[data-role="submit"]').on('click', function(e) {
        if (!$(e.target).hasClass('disabled')) {
            updatePassword();
        }
    });

    function updatePassword() {
        openLoading();
        $.ajax({
                type: 'POST',
                url: '/forgetpwd',
                data: $('#reset').serialize()
            })
            .done(function(data) {
                if (data.success) {
                    $ModalDialog.open();
                    var href = data.redirectUrl;
                    $('#confirmPwd').attr('href', href);
                } else {
                    $('.warning-info').removeClass('hidden-xs-up');
                    $('.warning-info').children('span').html('Oops something went wrong, please go to the sign-in page and reset your password.');
                }
            })
            .always(function() {
                closeLoading();
            });
    }

})(jQuery);

//# sourceMappingURL=forgetPassword.js.map
