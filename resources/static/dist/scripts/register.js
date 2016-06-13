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
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailNull);
        } else if (!Reg.test(InputText)) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailStyle);
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
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
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordNull);
        } else if (InputText.length < 6 || InputText.length > 32) {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordLength);
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
        }
    }

    function validationNick($Nick) {
        var NickNull = 'Please enter your nick name';
        var InputText = $Nick.val();
        var $WarningInfo = $('.warning-info');

        if (InputText === '') {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(NickNull);
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
        }
    }

    // ajax
    function registerUser() {
        openLoading();
        $.ajax({
            url: '/user/signup',
            type: 'POST',
            data: $('#register').serialize()
        }).done(function (data) {
            if (data.success) {
                window.location.href = data.redirectUrl;
            } else {
                $('.warning-info').removeClass('off');
                $('.warning-info').children('span').html(data.prompt_msg);
            }
        }).fail(function () {
            console.log("error");
        }).always(function () {
            closeLoading();
            console.log("complete");
        });
    }

    // 验证昵称
    $('input[name="nick"]').on('keyup blur', function (e) {
        validationNick($(this));
    });

    // 验证电子邮件的情况
    $('input[name="email"]').on('keyup', function (e) {
        validationEmail($(this));
    });

    // 验证密码的情况
    $('input[name="pw"]').on('keyup', function (e) {
        validationPassword($(this));
    });

    // 提交注册用户请求
    $('div[data-role="submit"]').on('click', function (e) {

        var $Email = $('input[name="email"]'),
            $Password = $('input[name="password"]'),
            $Nick = $('input[name="nick"]');

        validationNick($Nick);
        validationEmail($Email);
        validationPassword($Password);

        if ($(e.target).hasClass('disabled')) {} else {
            registerUser();
        }
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
//# sourceMappingURL=register.js.map
