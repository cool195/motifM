"use strict";!function(a){function o(){a(".loading").toggleClass("loading-hidden"),setTimeout(function(){a(".loading").toggleClass("loading-open")},25)}function i(){a(".loading").addClass("loading-close"),setTimeout(function(){a(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function n(n){o(),a.ajax({url:"/cart/verifycoupon",type:"POST",data:{cps:n}}).done(function(o){o.success?(a('input[name="cps"]').val(n),a("#infoForm").submit()):(a(".warning-info").removeAttr("hidden"),o.prompt_msg=""==o.prompt_msg?"Invalid code":o.prompt_msg,a(".warning-info").children("span").text(o.prompt_msg))}).always(function(){i()})}a('input[name="coupon"]').on("keyup",function(o){""===a(this).val()?a('div[data-role="submit"]').addClass("disabled"):a('div[data-role="submit"]').removeClass("disabled")}),a('input[name="coupon"]').on("paste",function(o){var i=void 0;i=window.clipboardData&&window.clipboardData.getData?window.clipboardData.getData("Text"):o.originalEvent.clipboardData.getData("Text"),""===i||void 0===i?a('div[data-role="submit"]').addClass("disabled"):a('div[data-role="submit"]').removeClass("disabled")}),a('div[data-role="submit"]').on("click",function(o){if(!a(o.target).hasClass("disabled")){var i=a('input[name="coupon"]').val();n(i)}})}(jQuery);