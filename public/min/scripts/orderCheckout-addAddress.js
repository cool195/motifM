"use strict";!function(n){function o(){n("#success").toggleClass("loading-hidden"),setTimeout(function(){n("#success").toggleClass("loading-open")},25)}function s(){n("#success").addClass("loading-close"),setTimeout(function(){n("#success").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function a(){n(".loading").toggleClass("loading-hidden"),setTimeout(function(){n(".loading").toggleClass("loading-open")},25)}function e(){n(".loading").addClass("loading-close"),setTimeout(function(){n(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function i(){a(),n.ajax({url:"/useraddr/addUserAddress",type:"POST",data:n("#addressInfo").serialize()}).done(function(a){a.success&&(o(),setTimeout(function(){s(),n("#infoForm").submit()},1500))}).fail(function(){console.log("error")}).always(function(){e(),console.log("complete")})}function d(){var o=!0;return n('input[data-optional="false"]').each(function(){if(""===n(this).val()&&!n(this).data("optional"))return o=n(this),!1}),o}function t(){a(),n("#addressInfo").submit()}n(".radio-checkBox").on("click",function(){n(this).toggleClass("open"),n(this).hasClass("open")?n("#address-primary").prop("checked",!0):n("#address-default").prop("checked",!0)}),n("#country").on("click",function(n){t()}),n('input[data-optional="false"]').on("blur keyup",function(){var o=d();o===!0?(n(".warning-info").addClass("hidden-xs-up"),n("#btn-addAddress").removeClass("disabled")):(n(".warning-info").removeClass("hidden-xs-up"),n(".warning-info").children("span").text("Please enter your "+o.data("role")+" !"),n("#btn-addAddress").addClass("disabled"))}),n("#btn-addAddress").on("click",function(o){n(o.target).hasClass("disabled")||i()}),n("#Cancel").on("click",function(){n("#infoForm").attr("action",n("#Cancel").attr("data-action")),n("#infoForm").submit()}),n(document).ready(function(){var o=d();o===!0&&n("#btn-addAddress").removeClass("disabled")})}(jQuery);