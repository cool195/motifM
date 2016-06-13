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
        })
            .done(function (data) {
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
                closeLoading();
            });
    }

    // 验证电子邮件的情况
    $('input[name="email"]').on('keyup', function (e) {
        var EmailNull = 'Please enter your email',
            EmailStyle = 'email wrong';
        var $WarningInfo = $('.warning-info');
        var InputText = $(e.target).val();
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
    });

    // 验证密码的情况
    $('input[name="pw"]').on('keyup', function (e) {
        var PasswordNull = 'Please enter your password',
            PasswordLength = 'Password (6 characters min)';
        var $WarningInfo = $('.warning-info');
        var InputText = $(e.target).val();

        if (InputText === '') {
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
    });

    $('div[data-role="submit"]').on('click', function (e) {
        if ($(e.target).hasClass('disabled')) {

        } else {
            loginUser();
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
