/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';
(function ($) {
    // 计算 message 输入字数,并实时提示
    // 当字数超出规定字数,不能继续输入
    $('#messageContent').keyup(function () {
        var length = $(this).data('length');
        var content = $(this).val();
        var contentLen = content.length;
        if (contentLen <= length) {
            $('#wordNum').html(contentLen);
        } else {
            $(this).val(content.substring(0, length));
            $('#wordNum').html(length);
        }
    });
})(jQuery);


