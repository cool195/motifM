/**
 * Created by lhyin on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    function show() {
        var messageInfo = document.getElementById('messageInfo');
        var text = messageInfo.innerHTML;
        var newInfo = document.createElement('div');
        newInfo.innerHTML = text.substring(0, 550);
        $('#btnShowMore').click(function () {
            var showMore = $('#showMore');
            if (showMore.text() == 'Show More') {
                showMore.text('Show Less');
                newInfo.innerHTML = text;
            } else {
                showMore.text('Show More');
                newInfo.innerHTML = text.substring(0, 550);
            }
        });
        messageInfo.innerHTML = "";
        messageInfo.appendChild(newInfo);
    }

    show();
})(jQuery);
//# sourceMappingURL=orderDetail.js.map
