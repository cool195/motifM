'use strict';
/*global jQuery*/
(function ($) {
    // 初始化模态框
    var $Modal = $('#successDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });
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
     * 验证 昵称 格式
     * @param $Nick
     */
    function validationNick($Nick) {
        var NickNull = 'Please enter your nick name';
        var InputText = $Nick.val();
        var $WarningInfo = $('.warning-info');

        if (InputText === '' || InputText === undefined) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(NickNull);
            $('div[data-role="submit"]').addClass('disabled');
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
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
        //var Reg = /^[a-z0-9]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
        var Reg = /^[\.a-zA-Z0-9_-]+@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
        if (InputText === '' || InputText === undefined) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailNull);
            $('div[data-role="submit"]').addClass('disabled');
            return false;
        } else if (!Reg.test(InputText)) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(EmailStyle);
            $('div[data-role="submit"]').addClass('disabled');
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
            $('div[data-role="submit"]').addClass('disabled');
            return false;
        } else if (InputText.length < 6 || InputText.length > 32) {
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(PasswordLength);
            $('div[data-role="submit"]').addClass('disabled');
            return false;
        } else {
            $WarningInfo.addClass('off');
            return true;
        }
    }

    // 验证昵称、邮箱、密码格式
    function validateInfo() {
        var $Nick = $('input[name="nick"]'),
            $Email = $('input[name="email"]'),
            $Password = $('input[name="pw"]');
        if (validationNick($Nick) && validationEmail($Email) && validationPassword($Password)) {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    }

    // 输入注册信息时 进行验证
    $('.input-register').on('keyup', function () {
        var InputText = $(this).val();
        if (InputText === '' || InputText === undefined) {
            $(this).siblings('.input-clear').addClass('hidden');
        } else {
            $(this).siblings('.input-clear').removeClass('hidden');
        }
        validateInfo();
    });


    // ajax
    function registerUser() {
        openLoading();
        var Email=$('input[name="email"]').val();
        $.ajax({
                url: '/user/signup',
                type: 'POST',
                data: $('#register').serialize()
            })
            .done(function (data) {
                if (data.success) {
                    $('#confirm').attr('href', data.redirectUrl);
                    $Modal.open();
                    trackRegister(Email);
                } else {
                    $('.warning-info').removeClass('off');
                    $('.warning-info').children('span').html(data.prompt_msg);
                }
            })
            .always(function () {
                closeLoading();
            });
    }

    // 注册埋点 --- KLAVIYO
    function trackRegister(Email){
        var _learnq = _learnq || [];
        _learnq.push(['identify', {
            '$email' : Email
        }]);
        userKlaviyoRegister();
    }

    // 提交注册用户请求
    $('div[data-role="submit"]').on('click', function (e) {
        if (!($(e.target).hasClass('disabled'))) {
            registerUser();
        }
    });
    // 清除输入
    $('.input-clear').on('click', function (e) {
        $(e.target).siblings('input').val('');
        $(e.target).siblings('.register-title').removeClass('active');
        $(this).addClass('hidden');
        validateInfo();
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

    $(function () {
        var timeIsText = setTimeout(function () {
            if ($('[name="email"]').val != '') {
                $('[name="email"]').siblings('.register-title').addClass('active');
                $('[name="pw"]').siblings('.register-title').addClass('active');
                clearTimeout(timeIsText);
            }
        }, 1000)
    });

    $('.input-register').on('focus', function () {
        $(this).siblings('.register-title').addClass('active');
    });
    $('.input-register').on('blur', function () {
        if ($(this).val() === '') {
            $(this).siblings('.register-title').removeClass('active');
        }
    });
    $('.register-title').on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active');
            $(this).siblings('.input-register').focus();
        }
    });
})(jQuery);
