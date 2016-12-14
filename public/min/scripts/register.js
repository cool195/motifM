"use strict";!function(i){function a(){i(".loading").toggleClass("loading-hidden"),setTimeout(function(){i(".loading").toggleClass("loading-open")},25)}function s(){i(".loading").addClass("loading-close"),setTimeout(function(){i(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function e(a){var s="Please enter your nick name",e=a.val(),t=i(".warning-info");return""===e||void 0===e?(t.removeClass("off"),t.children("span").html(s),i('div[data-role="submit"]').addClass("disabled"),!1):(t.addClass("off"),!0)}function t(a){var s="Please enter your email",e="Please enter a valid email address",t=i(".warning-info"),n=a.val(),l=/^[\.a-zA-Z0-9_-]+@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;return""===n||void 0===n?(t.removeClass("off"),t.children("span").html(s),i('div[data-role="submit"]').addClass("disabled"),!1):l.test(n)?(t.addClass("off"),!0):(t.removeClass("off"),t.children("span").html(e),i('div[data-role="submit"]').addClass("disabled"),!1)}function n(a){var s="Please enter your password",e="Password (6 characters min)",t=i(".warning-info"),n=a.val();return""===n||void 0===n?(t.removeClass("off"),t.children("span").html(s),i('div[data-role="submit"]').addClass("disabled"),!1):n.length<6||n.length>32?(t.removeClass("off"),t.children("span").html(e),i('div[data-role="submit"]').addClass("disabled"),!1):(t.addClass("off"),!0)}function l(){var a=i('input[name="nick"]'),s=i('input[name="email"]'),l=i('input[name="pw"]');e(a)&&t(s)&&n(l)&&i('div[data-role="submit"]').removeClass("disabled")}function r(){a(),i.ajax({url:"/user/signup",type:"POST",data:i("#register").serialize()}).done(function(a){a.success?(o.open(),i("#confirm").attr("href",a.redirectUrl)):(i(".warning-info").removeClass("off"),i(".warning-info").children("span").html(a.prompt_msg))}).always(function(){s()})}var o=i("#successDialog").remodal({closeOnOutsideClick:!1,hashTracking:!1});i(".input-register").on("keyup",function(){var a=i(this).val();""===a||void 0===a?i(this).siblings(".input-clear").addClass("hidden"):i(this).siblings(".input-clear").removeClass("hidden"),l()}),i('div[data-role="submit"]').on("click",function(a){i(a.target).hasClass("disabled")||r()}),i(".input-clear").on("click",function(a){i(a.target).siblings("input").val(""),i(a.target).siblings(".register-title").removeClass("active"),i(this).addClass("hidden"),l()}),i(".input-show").on("click",function(a){var s=i(a.target).siblings("input");i(a.target).hasClass("off")?(s.attr("type","text"),i(a.target).removeClass("off")):(s.attr("type","password"),i(a.target).addClass("off"))}),i(function(){var a=setTimeout(function(){""!=i('[name="email"]').val&&(i('[name="email"]').siblings(".register-title").addClass("active"),i('[name="pw"]').siblings(".register-title").addClass("active"),clearTimeout(a))},1e3)}),i(".input-register").on("focus",function(){i(this).siblings(".register-title").addClass("active")}),i(".input-register").on("blur",function(){""===i(this).val()&&i(this).siblings(".register-title").removeClass("active")}),i(".register-title").on("click",function(){i(this).hasClass("active")||(i(this).addClass("active"),i(this).siblings(".input-register").focus())})}(jQuery);