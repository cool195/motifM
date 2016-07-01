/**
 * Created by yinlinghui on 16/6/13.
 */
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

    // 验证密码输入长度
    function validatePwdLenght(InputText) {
        var PasswordNull = 'Please enter your password',
            PasswordLength = 'Password needs to be at least 6 characters';
        var $WarningInfo = $('.warning-info');
        if (InputText === '' || InputText === undefined) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass("off");
            $WarningInfo.children('span').html(PasswordNull);
            return false;
        } else if (InputText.length < 6 || InputText.length > 32) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass("off");
            $WarningInfo.children('span').html(PasswordLength);
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
    }

    // 验证确认密码 和 新密码是否正确
    function validateconfirmPwd(NewPwd, confirmPwd) {
        var PasswordConfirm = 'New password does not match';
        var $WarningInfo = $('.warning-info');
        if (NewPwd !== confirmPwd) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordConfirm);
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
    }

    // 输入密码时 进行验证
    $('input[type="password"]').on('keyup', function() {
        validatePwd();
    });

    // 验证密码格式
    function validatePwd() {
        var OldPwd = $('input[name="oldpw"]').val(),
            NewPpwd = $('input[name="pw"]').val(),
            ConfirmPwd = $('input[data-role="confirmPwd"]').val();
        if (validatePwdLenght(OldPwd) && validatePwdLenght(NewPpwd) && validatePwdLenght(ConfirmPwd) && validateconfirmPwd(NewPpwd, ConfirmPwd)) {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    }

    $('div[data-role="submit"]').on('click', function(e) {
        if (!$(e.taget).hasClass('disabled')) {
            updatePassword();
        }
    });

    function updatePassword() {
        openLoading();
        $.ajax({
                url: '/user/modifyUserPwd',
                type: 'POST',
                data: $('#changePassword').serialize()
            })
            .done(function(data) {
                if (data.success) {
                    $ModalDialog.open();
                    var href = data.redirectUrl;
                    $('#confirmPwd').attr('href', href);
                    console.log('success');
                } else {
                    $('.warning-info').removeClass('off');
                    $('.warning-info').children('span').html(data.prompt_msg);
                }
            })
            .fail(function() {
                console.log('error');
            })
            .always(function() {
                console.log('complete');
                closeLoading();
            });
    }

    // 初始化模态框
    var $ModalDialog = $('#changePwdDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

})(jQuery);

//# sourceMappingURL=profileSetting-changePassword.js.map
