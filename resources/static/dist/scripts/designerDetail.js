/**
 * Created by lhyin on 16/6/01.
 */
/*global jQuery*/

// 设置 视频比例
'use strict';

(function ($) {
    var vbl = 315 / 560;
    function init() {
        var ww = $(window).width();
        var ifh = ww * vbl;
        $('.ytplayer').css('height', ifh);
    }
    $(window).resize(function () {
        init();
    });
    init();
})(jQuery);
//# sourceMappingURL=designerDetail.js.map
