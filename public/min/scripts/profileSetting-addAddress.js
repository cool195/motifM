"use strict";!function(n){function s(){n("#success").toggleClass("loading-hidden"),setTimeout(function(){n("#success").toggleClass("loading-open")},25)}function e(){n("#success").addClass("loading-close"),setTimeout(function(){n("#success").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function a(){n(".loading").toggleClass("loading-hidden"),setTimeout(function(){n(".loading").toggleClass("loading-open")},25)}function o(){n(".loading").addClass("loading-close"),setTimeout(function(){n(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function t(){a(),n.ajax({url:"/useraddr/addUserAddress",type:"POST",data:n("#addressInfo").serialize()}).done(function(n){n.success&&(s(),setTimeout(function(){e(),window.location.href=n.redirectUrl},1500))}).always(function(){o()})}function i(){var s=!0;return n('input[data-optional="false"]').each(function(){if(""===n(this).val()&&!n(this).data("optional"))return s=n(this),!1}),s}function d(){a(),n('input[name="countryState"]').remove(),n("#addressInfo").submit()}n(".radio-checkBox").on("click",function(){n(this).toggleClass("open"),n(this).hasClass("open")?n("#address-primary").prop("checked",!0):n("#address-default").prop("checked",!0)}),n("#stateselect").on("click",function(){a(),n("#addressInfo").attr("action","/user/statelist"),n("#addressInfo").submit()}),n("#country").on("click",function(){d()}),n('input[data-optional="false"]').on("blur keyup",function(){var s=i();s===!0?(n(".warning-info").addClass("hidden-xs-up"),n("#btn-addAddress").removeClass("disabled")):(n(".warning-info").removeClass("hidden-xs-up"),n(".warning-info").children("span").text("Please enter your "+s.data("role")+" !"),n("#btn-addAddress").addClass("disabled"))}),n("#btn-addAddress").on("click",function(s){n(s.target).hasClass("disabled")||t()}),n("#Cancel").on("click",function(){n("#infoForm").attr("action",n("#Cancel").attr("data-action")),n("#infoForm").submit()}),n(document).ready(function(){var s=i();s===!0&&n("#btn-addAddress").removeClass("disabled")})}(jQuery);