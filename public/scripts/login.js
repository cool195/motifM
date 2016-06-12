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

    // TODO 需要字段的格式
    // 验证电子邮件的情况
    $('input[name="email"]').on('blur', function (e) {
        console.info('电子邮件');
        console.log(e.target);

        var InputText = $(e.target).val();
        if (true) {} else {
            $('div[data-role="submit"]').addClass('disabled');
        }
    });

    // TODO 需要字段的格式
    // 验证密码的情况
    $('input[name="pw"]').on('blur', function (e) {
        console.info('密码');
        console.log(e.target);
        var InputText = $(e.target).val();
        if (true) {} else {
            $('a[data-role="submit"]').addClass('disabled');
        }
    });

    // 提交注册用户请求
    $('div[data-role="submit"]').on('click', function (e) {
        if ($(e.target).hasClass('disabled')) {} else {
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
//# sourceMappingURL=login.js.map