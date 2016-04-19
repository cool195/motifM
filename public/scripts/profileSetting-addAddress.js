"use strict";

/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

// 开关按钮
(function ($) {
    var btnPrimary = document.getElementById("btn-openClose");
    var bgBtnPrimary = document.getElementById("bg-openClose");
    bgBtnPrimary.onclick = function () {
        bgBtnPrimary.className = bgBtnPrimary.className == "close" ? "open" : "close";
        btnPrimary.className = btnPrimary.className == "btn-close" ? "btn-open" : "btn-close";
    };
})(jQuery);
//# sourceMappingURL=profileSetting-addAddress.js.map
