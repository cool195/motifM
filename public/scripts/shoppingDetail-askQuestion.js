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

    function addAskQuestion(spu) {
        // 获取表单数据
        var email = $('#email').val();
        var content = $('#content').val();
        openLoading();
        $.ajax({
            url: '/feedback/support',
            type: 'POST',
            data: { cmd: 'support', spu: spu, content: content, email: email, type: '1', stype: '1' }
        }).done(function () {
            window.history.back(-1);
            console.log('success');
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // 点击提交表单
    $('#submit').click(function () {
        var spu = $(this).data('spu');
        addAskQuestion(spu);
    });

    // 退出编辑
    $('#Cancel').click(function () {
        window.history.back(-1);
    });

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
})(jQuery);
//# sourceMappingURL=shoppingDetail-askQuestion.js.map
