"use strict";!function(a){function e(){a(".loading").toggleClass("loading-hidden"),setTimeout(function(){a(".loading").toggleClass("loading-open")},25)}function n(){a(".loading").addClass("loading-close"),setTimeout(function(){a(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function i(e){var n="Please enter your email",i="Please enter a valid email address",s=a(".warning-info"),l=e.val(),o=/^[a-z0-9]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;return""===l?(s.removeClass("off"),s.children("span").html(n),!1):o.test(l)?(s.addClass("off"),!0):(s.removeClass("off"),s.children("span").html(i),!1)}var s={closeOnOutsideClick:!1,closeOnCancel:!1,hashTracking:!1},l=a("#successModal").remodal(s);a('input[name="email"]').on("keyup blur change",function(){i(a(this))?a('div[data-role="submit"]').removeClass("disabled"):a('div[data-role="submit"]').addClass("disabled")}),a('div[data-role="submit"]').click(function(){a(this).hasClass("disabled")||(e(),a.ajax({url:"/facebooklogin",type:"get",data:a("#register").serialize()}).done(function(e){e.success?(a(".warning-info").addClass("hidden-xs-up"),l.open(),a("#confirm").attr("href",e.redirectUrl)):(a(".warning-info").removeClass("hidden-xs-up"),a(".warning-info").children("span").text(e.error_msg))}).always(function(){n()}))})}(jQuery);