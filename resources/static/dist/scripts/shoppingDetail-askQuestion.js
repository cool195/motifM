/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

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

    function addMessage(spu) {
        // 获取表单数据
        openLoading();
        $.ajax({
            url: '/askshopping',
            type: 'PUT',
            data: $('#form-askQuestion').serialize()
        })
            .done(function (data) {
                if (data.success) {
                    $ModalDialog.open();
                    var href = data.redirectUrl;
                    $('#confirmQuestion').attr('href', href);
                }else{
                    $('.warning-info').removeClass('hidden-xs-up');
                    $('.warning-info').children('span').text(data.prompt_msg);
                }
            })
            .always(function () {
                closeLoading();
            });
    }

    // 计算 message 输入字数,并实时提示
    // 当字数超出规定字数,不能继续输入
    $('#content').keyup(function () {
        var length = $('#content').data('length');
        var content = $('#content').val();
        var contentLen = content.length;
        if (contentLen <= length) {
            $('#wordNum').html(contentLen);
        } else {
            $(this).val(content.substring(0, length));
            $('#wordNum').html(length);
        }
    });


    // 验证 邮箱格式
    function validationEmail(Email) {
        var EmailNull = 'Please enter your email',
            EmailStyle = 'Please enter a valid email address';
        var $WarningInfo = $('.warning-info');
        var InputText = Email;
        // 邮箱验证的正则表达式
        var Reg = /^[a-z0-9]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
        if (InputText === '') {
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
            $('div[data-role="submit"]').removeClass('disabled');
            return true;
        }
    }

    // 验证输入内容长度
    function validateMessageLenght(InputText) {
        var MessageNull = 'Please fill out all fieldes';
        var $WarningInfo = $('.warning-info');
        if (InputText === '') {
            $('div[data-role="submit"]').addClass('disabled');
            $WarningInfo.removeClass('off');
            $WarningInfo.children('span').html(MessageNull);
            return false;
        } else {
            $WarningInfo.addClass('off');
            $('div[data-role="submit"]').removeClass('disabled');
            return true;
        }
    }

    $('input[name="email"]').on('keyup', function () {
        var InputText = $(this).val();
        validationEmail(InputText);
    });
    $('textarea[name="content"]').on('keyup', function () {
        var InputText = $(this).val();
        validateMessageLenght(InputText);
    });

    // 点击提交表单时 对所填信息进行验证
    $('div[data-role="submit"]').on('click', function (e) {
        var MessageEmail = $('input[name="email"]').val(),
            MessageText = $('textarea[name="content"]').val();

        if (!validationEmail(MessageEmail)) {
            $(e.target).addClass('disabled');
            return;
        }
        if (!validateMessageLenght(MessageText)) {
            $(e.target).addClass('disabled');
            return;
        }

        // 提交 message
        var spu = $(this).data('spu');
        addMessage(spu);
    });

    // 退出编辑
    $('div[data-role="cancel"]').on('click', function () {
        window.history.back(-1);
    });

    // 初始化模态框
    var $ModalDialog = $('#askQuestion').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

})(jQuery);

//# sourceMappingURL=shoppingDetail-askQuestion.js.map
