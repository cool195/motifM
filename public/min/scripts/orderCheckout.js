"use strict";!function(a){function i(){a(".loading").toggleClass("loading-hidden"),setTimeout(function(){a(".loading").toggleClass("loading-open")},25)}function o(){a(".loading").addClass("loading-close"),setTimeout(function(){a(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}a("img.img-lazy").lazyload({threshold:200,effect:"fadeIn"});var t={hashTracking:!1};a("[data-remodal-id=delivery-modal]").remodal(t);var n="",e=a("#deliveryDialog");a("[data-stype]").on("click",function(){a("#deliveryDialog").find(".icon-radio").removeClass("active"),a(this).children(".icon-radio").addClass("active"),n=a(this).data("stype")}),e.on("opening",function(){n=a(this).data("select"),a(this).find(".icon-radio").removeClass("active"),a('[data-stype="'+n+'"]').children(".icon-radio").addClass("active")}),e.on("confirmation",function(){var i=a('[data-stype="'+n+'"]').data("dialog");a(".delivery-text").text(i),a("#deliveryDialog").data("select",n),a('input[name="stype"]').val(n),a("#infoForm").attr("action",window.location.href),a("#infoForm").submit()}),a("[data-form-action]").on("click",function(){var i=a(this).data("form-action");a("#infoForm").attr("action",i),a("#infoForm").submit()}),a('[data-role="submit"]').on("click",function(){onCheckout(),a(this).hasClass("disabled")||(a('input[name="paym"]').val(a(this).data("with")),i(),a.ajax({url:"/order/orderSubmit",type:"POST",data:a("#infoForm").serialize()}).done(function(a){a.success?window.location.href=a.redirectUrl:(alert(a.error_msg),window.location.href=a.redirectUrl)}).fail(function(){}).always(function(){o()}))})}(jQuery);