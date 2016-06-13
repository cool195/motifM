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

    // TODO 登录后跳转
    // ajax
    function loginUser() {
        openLoading();
        $.ajax({
            url: '/user/logincheck',
            type: 'POST',
            data: $('#login').serialize()
        }).done(function (data) {
            console.log("success");
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("complete");
            closeLoading();
        });
    }

    /**
     *  验证 Email 格式
     * @param $Email
     */
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

    /**
     * 验证 Password 格式
     * @param $Password
     */
    function validationPassword($Password) {
        var PasswordNull = 'Please enter your password',
            PasswordLength = 'Password (6 characters min)';
        var $WarningInfo = $('.warning-info');
        var InputText = $Password.val();

        if (InputText === '' || InputText === undefined) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordNull);
            return false;
        } else if (InputText.length < 6 || InputText.length > 32) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordLength);
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
    }

    // 验证电子邮件的情况
    $('input[name="email"]').on('keyup blur', function (e) {
        if (validationEmail($(this))) {
            $('div[data-role="submit"]').removeClass('disabled');
        } else {
            $('div[data-role="submit"]').addClass('disabled');
        }
    });

    // 验证密码的情况
    $('input[name="pw"]').on('keyup blur', function (e) {
        if (validationPassword($(this))) {
            $('div[data-role="submit"]').removeClass('disabled');
        } else {
            $('div[data-role="submit"]').addClass('disabled');
        }
    });

    $('div[data-role="submit"]').on('click', function (e) {
        var $Email = $('input[name="email"]'),
            $Password = $('input[name="password"]');

        if (!validationEmail($Email)) {
            $('div[data-role="submit"]').addClass('disabled');
            return;
        } else if (!validationPassword($Password)) {
            $('div[data-role="submit"]').addClass('disabled');
            return;
        }

        loginUser();
    });

    // 清除输入
    $('.input-clear').on('click', function (e) {
        $(e.target).siblings('input').val('');
    });

    // 查看密码
    $('.input-show').on('click', function (e) {
        var $Password = $(e.target).siblings('input');

        if ($(e.target).hasClass('off')) {
            $Password.attr('type', 'text');
            $(e.target).removeClass('off');
        } else {
            $Password.attr('type', 'password');
            $(e.target).addClass('off');
        }
    });
})(jQuery);
//# sourceMappingURL=login.js.map
