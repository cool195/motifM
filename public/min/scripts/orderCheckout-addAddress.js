"use strict";!function(n){function a(){n(".loading").toggleClass("loading-hidden"),setTimeout(function(){n(".loading").toggleClass("loading-open")},25)}function o(){n(".loading").addClass("loading-close"),setTimeout(function(){n(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function e(){a(),n.ajax({url:"/useraddr/addUserAddress",type:"POST",data:n("#addressInfo").serialize()}).done(function(n){n.success&&(window.location.href="/cart/ordercheckout?aid="+n.data.receiving_id)}).fail(function(){console.log("error")}).always(function(){o()})}function s(){var a=!0;return n('input[data-optional="false"]').each(function(){if(""===n(this).val()&&!n(this).data("optional"))return a=n(this),!1}),a}function t(){a(),n('input[name="countryState"]').remove(),n("#addressInfo").submit()}n(".radio-checkBox").on("click",function(){n(this).toggleClass("open"),n(this).hasClass("open")?n("#address-primary").prop("checked",!0):n("#address-default").prop("checked",!0)}),n("#country").on("click",function(){t()}),n("#stateselect").on("click",function(){a(),n("#addressInfo").attr("action","/user/statelist"),n("#addressInfo").submit()}),n('input[data-optional="false"]').on("blur keyup",function(){var a=s();a===!0?(n(".warning-info").addClass("hidden-xs-up"),n("#btn-addAddress").removeClass("disabled")):(n(".warning-info").removeClass("hidden-xs-up"),n(".warning-info").children("span").text("Please enter your "+a.data("role")+" !"),n("#btn-addAddress").addClass("disabled"))}),n("#btn-addAddress").on("click",function(a){n(a.target).hasClass("disabled")||e()}),n("#Cancel").on("click",function(){n("#infoForm").attr("action",n("#Cancel").attr("data-action")),n("#infoForm").submit()}),n(document).ready(function(){var a=s();a===!0&&n("#btn-addAddress").removeClass("disabled")})}(jQuery);