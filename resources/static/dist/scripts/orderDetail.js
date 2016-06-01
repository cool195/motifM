/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

// 隐藏、显示 文字内容
// 显示 message to us 文字内容
'use strict';

(function ($) {
    var text = $('#messageInfo').html();

    var newInfo = $('<div></div>').html(text.substring(0, 550));

    $('#btnShowMore').on('click', function () {
        var showMore = $('#showMore');
        var btntext = showMore.text() === 'Show Less' ? 'Show More' : 'Show Less';
        var classtext = showMore.text() === 'Show Less' ? 'icon-arrow-bottom' : 'icon-arrow-right';
        var textstr = showMore.text() === 'Show More' ? text : text.substring(0, 550);
        showMore.text(btntext);
        $('#btnShowMore i').removeClass('icon-arrow-bottom icon-arrow-right').addClass(classtext);
        $('#messageInfo').html(newInfo.html(textstr));
    });

    $('#messageInfo').html(newInfo.html());
})(jQuery);
//# sourceMappingURL=orderDetail.js.map
