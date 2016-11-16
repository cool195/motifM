"use strict";!function(a){function t(){a("#loading").toggleClass("loading-hidden"),setTimeout(function(){a("#loading").toggleClass("loading-open")},25)}function e(){a("#loading").addClass("loading-close"),setTimeout(function(){a("#loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function n(){a("#checkout-failure").toggleClass("loading-hidden"),setTimeout(function(){a("#checkout-failure").toggleClass("loading-open")},25)}function i(){a("#checkout-failure").addClass("loading-close"),setTimeout(function(){a("#checkout-failure").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function d(t){a(".pageview").removeClass("active"),t.addClass("active")}function s(t){t.hasClass("active")?(t.html("Edit"),t.toggleClass("active"),t.addClass("btn-primary-outline").removeClass("btn-primary"),a('div[data-role="submit"]').removeClass("hidden")):(t.html("Done"),t.toggleClass("active"),t.addClass("btn-primary").removeClass("btn-primary-outline"),a('div[data-role="submit"]').addClass("hidden"))}function o(t){var e=a(".addressItem-info").find(".iconfont");t.hasClass("active")?e.removeClass("icon-arrow-right").addClass("icon-radio"):e.removeClass("icon-radio").addClass("icon-arrow-right")}function r(t){var e=a(".addressItem-info");t.hasClass("active")?a.each(e,function(t,e){var n=a(e).data("url-return");a(e).data("action",n)}):a.each(e,function(t,e){var n=a(e).data("url-edit");a(e).data("action",n)})}function l(n){t(),a.ajax({url:"/addresses",type:"DELETE",data:{aid:n}}).done(function(){location.reload()}).always(function(){e()})}function c(t,e){if(1===t&&0===e){a('input[name="name"]').val(""),a('input[name="city"]').val(""),a('input[name="state"]').val(""),a('input[name="tel"]').val(""),a('input[name="addr1"]').val(""),a('input[name="addr2"]').val(""),a('input[name="zip"]').val(""),a("#btn-submitEditorAddress").addClass("disabled");var n=a("#countryName").data("oldcountry");u(n,""),a(".addressItem-info").length>0&&(a("#makePrimary").removeAttr("hidden"),a(".radio-checkBox").removeClass("open"),a("#address-default").attr("checked","checked"),a("#address-primary").removeAttr("checked"))}else a.ajax({url:"/address/"+e,type:"GET"}).done(function(t){a('input[name="name"]').val(t.name),a('input[name="city"]').val(t.city),a('input[name="state"]').val(t.state),a('input[name="tel"]').val(t.telephone),a('input[name="addr1"]').val(t.detail_address1),a('input[name="addr2"]').val(t.detail_address2),a('input[name="zip"]').val(t.zip),a("#btn-submitEditorAddress").removeClass("disabled"),u(t.country,t.state),1==t.isDefault?a("#makePrimary").attr("hidden","hidden"):(a("#makePrimary").removeAttr("hidden"),a(".radio-checkBox").removeClass("open"),a("#address-default").attr("checked","checked"),a("#address-primary").removeAttr("checked"))})}function u(t,e){var n=a('[data-cname="'+t+'"]').data("cid"),i=a('[data-cname="'+t+'"]').data("type"),d=a('[data-cname="'+t+'"]').data("childlabel"),s=a('[data-cname="'+t+'"]').data("zipcode"),o=a('[data-cname="'+t+'"]').data("csn");if(a('input[name="zip"]').attr("placeholder",s),a('input[name="zip"]').attr("data-role",s),a(".country-item").removeClass("active"),a("[data-cid="+n+"]").addClass("active"),a("#btn-toCountryList").data("id",n),a("#btn-toCountryList").data("type",i),a("#btn-toCountryList").data("childlabel",d),a("#btn-toCountryList").data("zipcode",s),a("#countryName").html(t),a('input[name="country"]').val(t),a('input[name="csn"]').val(o),void 0!=i&&0===i)a(".state-info").html('<input type="text" name="state" data-optional="true" class="form-control form-control-block p-a-15x font-size-sm" placeholder="State (optional)">'),a('input[name="state"]').val(e);else if(void 0!=i&&1===i)a(".state-info").html('<input type="text" name="state" data-optional="false" data-role="'+d+'" class="form-control form-control-block p-a-15x font-size-sm address-state" placeholder="'+d+'">'),a('input[name="state"]').val(e),""===e&&(a(".warning-info").removeClass("hidden-xs-up"),a(".warning-info").children("span").text("Please enter your "+d+" !"),a("#payment-checkBox").length>0?a(".btn-submitAddCard").addClass("disabled"):a("#btn-submitEditorAddress").addClass("disabled"));else{a(".country-item").removeClass("active"),a("[data-cid="+n+"]").addClass("active");var r="",l="";a.ajax({url:"/statelist/"+n,type:"GET"}).done(function(t){a.each(t,function(t,n){r=n.state_name_en,l=n.state_name_sn;var i=n.state_id;0===t?(a(".state-info").html('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option" id="stateselect"> <span id="childLabel">'+d+'</span> <div> <span id="stateName">'+r+'</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i> </div><input type="text" name="state" data-optional="false" hidden value="'+l+'"></div>'),a(".statelist-info").append('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x state-item active" data-statesn="'+l+'" data-state="'+r+'" data-sid="'+i+'"> <span>'+r+'</span> <i class="iconfont icon-check icon-size-sm text-common"></i> </div> <hr class="hr-base">')):a(".statelist-info").append('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x state-item" data-statesn="'+l+'" data-state="'+r+'" data-sid="'+i+'"> <span>'+r+'</span> <i class="iconfont icon-check icon-size-sm text-common"></i> </div> <hr class="hr-base">'),""!=e&&l===e&&(e=r)}),""!=e&&(r=e,a(".state-info").html('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option" id="stateselect"> <span id="childLabel">'+d+'</span> <div> <span id="stateName">'+r+'</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i> </div><input type="text" name="state" data-optional="false" hidden value="'+l+'"></div> </div>'),a(".state-item").removeClass("active"),a('[data-state="'+r+'"]').addClass("active"))}),a("#payment-checkBox").length>0?p(a('input[name="card"]'))&&p(a('input[name="expiry"]'))&&p(a('input[name="cvv"]'))&&p(a('input[name="name"]'))&&p(a('input[name="addr1"]'))&&p(a('input[name="city"]'))&&p(a('input[name="zip"]'))&&p(a('input[name="tel"]'))&&(a(".warning-info").addClass("hidden-xs-up"),a(".btn-submitAddCard").removeClass("disabled")):p(a('input[name="name"]'))&&p(a('input[name="addr1"]'))&&p(a('input[name="city"]'))&&p(a('input[name="zip"]'))&&p(a('input[name="tel"]'))&&(a(".warning-info").addClass("hidden-xs-up"),a("#btn-submitEditorAddress").removeClass("disabled"))}}function m(){var t=!0;return a('input[data-optional="false"]').each(function(){if(""===a(this).val()&&!a(this).data("optional"))return t=a(this),!1}),t}function p(t){var e=!1,n=a("#card-warning"),i=t.val();return""==i||void 0==i||null==i?(n.removeClass("hidden-xs-up"),a("#card-warning").children("span").text("Please enter your "+t.data("role")+" !"),e=!1):(n.addClass("hidden-xs-up"),e=!0),e}function h(n){t(),a.ajax({url:"/delcard/"+n,type:"POST"}).done(function(){location.reload()}).always(function(){e()})}a(".method-item").on("click",function(){a(".method-item").removeClass("active"),a(this).addClass("active"),a.ajax({url:"/checkout/selShip/"+a(this).data("type"),type:"GET"}).done(function(){"review"==a("#shipping-shipTo").data("ref")&&(window.location.href="/checkout/review")})}),a(".skipError").on("click",function(){alert("Please select a Payment Method")}),a("#submit-shipping").on("click",function(){window.location.href=a(this).data("url")}),a("#submit-address").on("click",function(){window.location.href=a(this).data("url")}),a("#btn-toAddAddress").on("click",function(){d(a(".shipping-editorAddress")),a("#shipping-editorAddress").data("aid",""),c(1,0)}),a("#shipping-editorAddress").length>0&&a("#shipping-editorAddress").hasClass("active")&&c(1,0),a("#address-edit").on("click",function(t){o(a(t.target)),r(a(t.target)),s(a(t.target)),a(".addressList-delete").toggleClass("switch")}),a('[data-role="submit"]').on("click",function(){var t=a(this).data("action");a("#infoForm").attr("action",t),a("#infoForm").submit()}),a('[data-role="add"]').on("click",function(){var t=a(this).data("action");a("#infoForm").attr("action",t),a("#infoForm").submit()}),a(".addressList-delete").on("click",function(t){var e=a(t.target).parents(".addressList-container").data("address");a("#modalDialog").data("address",e)}),a(".addressItem-info").on("click",function(){var e=a(this).data("action"),n=a(this).parents(".addressList-container").data("address");"return"===e?(t(),a(".icon-radio.active").removeClass("active"),a(this).find(".icon-radio").addClass("active"),a('input[name="aid"]').val(n),a.ajax({url:"/checkout/selAddr/"+n,type:"GET"}).done(function(t){t.receiving_id==n&&(window.location.href=a("#addressFrom").data("url"))})):"edit"===e&&(a("#shipping-editorAddress").data("aid",n),d(a(".shipping-editorAddress")),c(2,n))}),a("#modalDialog").remodal({closeOnOutsideClick:!1,hashTracking:!1}),a("#modalDialog").on("closed",function(){a(this).removeData("address")}),a("#modalDialog").on("confirmation",function(){var t=a("#modalDialog").data("address");void 0!==t&&null!==t&&""!==t&&l(t)}),a(".radio-checkBox").on("click",function(){a(this).toggleClass("open"),a(this).hasClass("open")?a("#address-primary").prop("checked",!0):a("#address-default").prop("checked",!0)}),a("#btn-cancelEditorAddress").on("click",function(){d(a(".shipping-chooseAddress"))}),a("#btn-toCountryList").on("click",function(){d(a(".shipping-chooseCountry"))}),a(".state-info").on("click","#stateselect",function(){d(a(".shipping-chooseState"))}),a(".country-item").on("click",function(){var t=a(this).data("cid"),e=a(this).data("cname"),n=a(this).data("type"),i=a(this).data("childlabel"),s=a(this).data("zipcode");if(a("#btn-toCountryList").data("id",t),a("#btn-toCountryList").data("type",n),a("#btn-toCountryList").data("childlabel",i),a("#btn-toCountryList").data("zipcode",s),a("#countryName").html(e),a('input[name="country"]').val(e),a(".country-item").removeClass("active"),a("[data-cid="+t+"]").addClass("active"),u(e,""),d(a(".shipping-editorAddress")),a("#payment-checkBox").length>0){var o=a("#btn-toCountryList").data("oldcountry"),r=a(this).data("csn");a('input[name="csn"]').val(r),a("#countryName").html()!=o&&a("#payment-checkBox").removeClass("open")}}),a(".statelist-info").on("click",".state-item",function(){var t=a(this).data("sid"),e=a(this).data("state"),n=a(this).data("statesn");if(a(".state-info #stateName").html(e),a('input[name="state"]').val(n),a(".state-item").removeClass("active"),a("[data-sid="+t+"]").addClass("active"),d(a(".shipping-editorAddress")),a("#payment-checkBox").length>0){var i=a(".state-info").data("oldstate");a("#stateName").html()!=i&&a("#payment-checkBox").removeClass("open")}}),a('input[data-optional="false"]').on("blur keyup",function(){var t=m();t===!0?(a(".warning-info").addClass("hidden-xs-up"),a("#btn-submitEditorAddress").removeClass("disabled"),a("#payment-checkBox").length>0&&a(".btn-submitAddCard").removeClass("disabled")):(a(".warning-info").removeClass("hidden-xs-up"),a(".warning-info").children("span").text("Please enter your "+t.data("role")+" !"),a("#btn-submitEditorAddress").addClass("disabled"),a("#payment-checkBox").length>0&&a(".btn-submitAddCard").addClass("disabled"))}),a(".state-info").on("keyup blur",".address-state",function(){a("#payment-checkBox").length>0?p(a('input[name="card"]'))&&p(a('input[name="expiry"]'))&&p(a('input[name="cvv"]'))&&p(a('input[name="name"]'))&&p(a('input[name="addr1"]'))&&p(a('input[name="city"]'))&&p(a('input[name="zip"]'))&&p(a('input[name="tel"]'))&&p(a(this))?(a(".warning-info").addClass("hidden-xs-up"),a(".btn-submitAddCard").removeClass("disabled")):(a(".warning-info").removeClass("hidden-xs-up"),a(".btn-submitAddCard").addClass("disabled")):p(a('input[name="name"]'))&&p(a('input[name="addr1"]'))&&p(a('input[name="city"]'))&&p(a('input[name="zip"]'))&&p(a('input[name="tel"]'))&&p(a(this))?(a(".warning-info").addClass("hidden-xs-up"),a("#btn-submitEditorAddress").removeClass("disabled")):(a(".warning-info").removeClass("hidden-xs-up"),a("#btn-submitEditorAddress").addClass("disabled"))}),a("#btn-submitEditorAddress").on("click",function(){t();var e=a("#shipping-editorAddress").data("aid");""==e||void 0===e?a.ajax({url:"/checkout/address",type:"POST",data:a("#addAddressForm").serialize()}).done(function(t){t.success&&(window.location.href=a("#addressFrom").data("url"))}):a.ajax({url:"/updateUserAddr/"+e,type:"POST",data:a("#addAddressForm").serialize()}).done(function(t){t.success&&(window.location.href=a("#addressFrom").data("url"))}),window.location.href=a("#addressFrom").data("url")}),a("#cancel-country").on("click",function(){d(a(".shipping-editorAddress"))}),a("#cancel-state").on("click",function(){d(a(".shipping-editorAddress"))}),a(".btn-toAddCard").on("click",function(){a('input[name="add_type"]').val(a(this).data("type")),d(a(".shipping-addCard"));var t=a("#btn-toCountryList").data("oldcountry"),e=a(".state-info").data("oldstate");"Oceanpay"==a(this).data("method")?(a("#img-amex").css("display","none"),a("#img-jcb").css("display","none")):(a("#img-amex").css("display","inline-flex"),a("#img-jcb").css("display","inline-flex")),u(t,e)}),a(".btn-cancelAddCard").on("click",function(){d(a(".shipping-payment"))}),a("#btn-toPromotionCode").on("click",function(){d(a(".shipping-promotion"))}),a("#btn-cancelPromoCode").on("click",function(){"editcode"==a("#shipping-payment").data("ref")?window.location.href="/checkout/review":d(a(".shipping-payment"))}),a("#payment-checkBox").length>0&&a("#card-container").card({container:".card-wrapper"}),a("#cancel-paymentCountry").on("click",function(){d(a(".shipping-addCard"))}),a("#cancel-paymentState").on("click",function(){d(a(".shipping-addCard"))}),a("#payment-checkBox").on("click",function(){var t=a("#btn-toCountryList").data("oldcountry"),e=a("#btn-toCountryList").data("newcountry"),n=a(".state-info").data("oldstate"),i=a('input[name="name"]').data("oldname"),d=a('input[name="addr1"]').data("oldaddr1"),s=a('input[name="addr2"]').data("oldaddr2"),o=a('input[name="city"]').data("oldcity"),r=a('input[name="zip"]').data("oldzip"),l=a('input[name="tel"]').data("oldtel");a(this).hasClass("open")?(a('input[name="name"]').val(i),a('input[name="city"]').val(o),a('input[name="tel"]').val(l),a('input[name="addr1"]').val(d),a('input[name="addr2"]').val(s),a('input[name="zip"]').val(r),u(t,n),a("#card-warning").hasClass("hidden-xs-up")):(a('input[name="name"]').val(""),a('input[name="city"]').val(""),a('input[name="state"]').val(""),a('input[name="tel"]').val(""),a('input[name="addr1"]').val(""),a('input[name="addr2"]').val(""),a('input[name="zip"]').val(""),a(".btn-submitAddCard").addClass("disabled"),u(e,""))}),a("#cardAddress input[data-role]").on("blur keyup",function(){a("#payment-checkBox").hasClass("open")&&a("#payment-checkBox").removeClass("open")}),a(".btn-submitAddCard").on("click",function(){t(),a.ajax({url:"/checkout/addcard",type:"POST",data:a("#card-container").serialize()}).done(function(t){t.success?window.location.href="/checkout/payment?from="+a("#shipping-payment").data("ref"):(a(".warning-info").removeClass("hidden-xs-up"),a(".warning-info").children("span").html(t.prompt_msg),e())})}),a(".clickPayWith").on("click",function(){t(),a(".clickPayWith").removeClass("active"),a(this).addClass("active"),a.ajax({url:"/checkout/paywith/"+a(this).data("type")+"/"+a(this).data("card"),type:"GET"}).done(function(){e()})}),a("#shipping-review").length>0&&"error"==a("#shipping-review").data("pay")&&(n(),setTimeout(function(){i()},3e3)),a(".submit-paymentbutton").on("click",function(){a(".clickPayWith.active").length>0?window.location.href="/checkout/review":(a(".ErrorMessage").html("Please select a Payment Method"),n(),setTimeout(function(){i()},2e3))}),a(".submit-checkout").on("click",function(){t();var n=a(this).data("clkurl");a.ajax({url:"/payorder",type:"POST",data:{remark:a('textarea[name="remark"]').val()}}).done(function(t){a.ajax({url:n,type:"GET"}),t.success?window.location.href=t.redirectUrl:(e(),alert("There was a problem validating your payment. Please verify all payment details and try placing your order again. Thank you."),window.location.href=t.redirectUrl)}),onCheckout()}),a('input[name="expiry"]').on("keyup",function(){var t=new Date,e=t.getFullYear(),n=a("#card-warning");if(5===a(this).val().length){var i=parseInt(a(this).val().substring(0,2));i>12?(n.removeClass("hidden-xs-up"),n.children("span").html("Month Error")):(n.addClass("hidden-xs-up"),n.children("span").html(""))}if(7===a(this).val().length){var d=parseInt("20"+a(this).val().substring(5,7));d<e||d>e+30?(n.removeClass("hidden-xs-up"),n.children("span").html("Year Error")):(n.addClass("hidden-xs-up"),n.children("span").html(""))}}),a('input[name="coupon"]').on("keyup",function(){""===a(this).val()?a("#btn-submitPromoCode").addClass("disabled"):a("#btn-submitPromoCode").removeClass("disabled")}),a('input[name="coupon"]').on("paste",function(t){var e=void 0;e=window.clipboardData&&window.clipboardData.getData?window.clipboardData.getData("Text"):t.originalEvent.clipboardData.getData("Text"),""===e||void 0===e?a('div[data-role="submit"]').addClass("disabled"):a('div[data-role="submit"]').removeClass("disabled")}),a(".bindidcode").on("click",function(e){t(),a.ajax({url:"/checkout/selCode/"+a(this).data("bindid"),type:"GET"}).always(function(){"editcode"==a("#shipping-payment").data("ref")?window.location.href="/checkout/review":window.location.href="/checkout/payment?from="+a("#shipping-payment").data("ref")})}),a("#btn-submitPromoCode").on("click",function(){a(this).hasClass("disabled")||a.ajax({url:"/cart/verifycoupon",type:"POST",data:{couponcode:a('input[name="coupon"]').val()}}).done(function(t){0==t.code?a.ajax({url:"/checkout/selCode/"+t.data.bind_id,type:"GET"}).always(function(){"editcode"==a("#shipping-payment").data("ref")?window.location.href="/checkout/review":window.location.href="/checkout/payment?from="+a("#shipping-payment").data("ref")}):(a(".ErrorMessage").html(t.prompt_msg),n(),setTimeout(function(){i()},1500))})}),a("#deleteCard-modalDialog").remodal({closeOnOutsideClick:!1,hashTracking:!1}),a("#deleteCard-modalDialog").on("closed",function(){a(this).removeData("cardid")}),a("#deleteCard-modalDialog").on("confirmation",function(){var t=a("#deleteCard-modalDialog").data("cardid");void 0!==t&&null!==t&&""!==t&&h(t)}),a(".btn-deleteCard").on("click",function(){var t=a(this).data("cardid");a("#deleteCard-modalDialog").data("cardid",t)}),a("#review-special").on("click",function(){d(a(".shipping-request"))}),a("#btn-addSpecial").on("click",function(){var t=a('textarea[name="remark"]').val().length>30?a('textarea[name="remark"]').val().substr(0,30)+"...":a('textarea[name="remark"]').val();""!=t?(a(".request").html(t),a(".request").removeClass("text-common")):(a(".request").html("Optional"),a(".request").addClass("text-common")),d(a(".shipping-review"))}),a("#messageContent").keyup(function(){var t=a(this).data("length"),e=a(this).val(),n=e.length;n<=t?a("#wordNum").html(n):(a(this).val(e.substring(0,t)),a("#wordNum").html(t))})}(jQuery);