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

    // 验证密码输入长度
    function validatePwdLenght(InputText) {
        var PasswordNull = 'Please enter your password',
            PasswordLength = 'Password needs to be at least 6 characters';
        var $WarningInfo = $('.warning-info');
        var flag = true;
        if (InputText == '') {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass("off");
            $WarningInfo.children('span').html(PasswordNull);
            flag = false;
        } else if (InputText.length < 6 || InputText.length > 32) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass("off");
            $WarningInfo.children('span').html(PasswordLength);
            flag = false;
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
            flag = true;
        }
        return flag;
    }

    // 验证确认密码 和 新密码是否正确
    function validateconfirmPwd(NewPwd, confirmPwd) {
        var PasswordConfirm = '确认密码有误';
        var $WarningInfo = $('.warning-info');
        var flag = true;
        if (NewPwd !== confirmPwd) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass("off");
            $WarningInfo.children('span').html(PasswordConfirm);
            return false;
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
            return true;
        }
    }

    $('input[type="password"]').on('keyup', function () {
        var InputText = $(this).val();
        validatePwdLenght(InputText);
    });

    $('input[data-role="confirmPwd"]').on('keyup', function () {
        var pwdText = $('input[name="pw"]').val();
        var confirmPwdText = $(this).val();
        validateconfirmPwd(pwdText, confirmPwdText);
    });

    $('div[data-role="submit"]').on('click', function (e) {
        var CurrentPwd = $('input[name="oldpw"]').val(),
            NewPwd = $('input[name="pw"]').val(),
            ConfirmPwd = $('input[data-role="confirmPwd"]').val();

        if (!validatePwdLenght(CurrentPwd) || !validatePwdLenght(NewPwd) || !validatePwdLenght(ConfirmPwd)) {
            $(e.target).addClass('disabled');
            return;
        }
        if (!validateconfirmPwd(NewPwd, ConfirmPwd)) {
            $(e.target).addClass('disabled');
            return;
        }
        updatePassword();
    });

    function updatePassword() {
        openLoading();
        $.ajax({
            url: '/user/modifyUserPwd',
            type: 'POST',
            data: $('#changePassword').serialize()
        }).done(function (data) {
            if (data.success) {
                console.log("success");
                $ModalDialog.open();
                var href = data.redirectUrl;
                $('[data-remodal-action="confirm"]').attr("href", href);
            } else {
                $('.warning-info').removeClass('off');
                $('.warning-info').children('span').html(data.prompt_msg);
            }
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("complete");
            closeLoading();
        });
    }

    // 初始化模态框
    var $ModalDialog = $('#changePwdDialog').remodal({
        closeOnOutsideClick: false
    });
})(jQuery);
//# sourceMappingURL=profileSetting-changePassword.js.map
