/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

// 设置默认地址 开关按钮
'use strict';

(function ($) {
    $('#bg-openClose').on('click', function () {
        var classname = $(this).attr('class') === 'close' ? 'open' : 'close';
        var btnclassname = $('#btn-openClose').attr('class') === 'btn-close' ? 'btn-open' : 'btn-close';
        $(this).attr('class', classname);
        $('#btn-openClose').attr('class', btnclassname);
    });
})(jQuery);
//# sourceMappingURL=profileSetting-addAddress.js.map
