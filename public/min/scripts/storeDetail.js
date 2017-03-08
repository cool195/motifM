"use strict";!function(a,e){function t(){a("#error").toggleClass("loading-hidden"),setTimeout(function(){a("#error").toggleClass("loading-open")},25)}function i(){a("#error").addClass("loading-close"),setTimeout(function(){a("#error").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function s(){a("#loading").toggleClass("loading-hidden"),setTimeout(function(){a("#loading").toggleClass("loading-open")},25)}function n(){a("#loading").addClass("loading-close"),setTimeout(function(){a("#loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}function l(a){a.target.playVideo()}function r(a,e){return a=a.filter(function(a){return a!==e})}function o(a,e){return a.find(function(a){return a===e})}function d(e,t,i){var s=i;a.each(e,function(a,e){for(var i=e,n=0;n<i.skuAttrValues.length;n++){for(var l=i.skuAttrValues[n],o=i.attr_type,d=l.attr_value_id,c=l.skus,g=0;g<t.length;g++)c=r(c,t[g]);void 0===s[o]&&(s[o]={}),s[o][d]=c}})}function c(e){var t=e;if(T=[],1===t.length){var i=a(e).data("spa"),s=a(e).data("ska");return void(T=O[i][s])}for(var n=[],l=0;l<t.length;l++){var r=a(t[l]).data("ska"),d=a(t[l]).data("spa");n.push(O[d][r])}for(var c=[],g=0;g<t.length;g++){var u=[];if(0!==g){for(var m=0;m<n[g].length;m++){var f=o(c,n[g][m]);void 0!==f&&u.push(f)}c=u}else c=n[g]}T=c}function g(e){a.each(e,function(e,t){var i=O[t];a.each(i,function(e,t){for(var i=t,s=!1,n=0;n<i.length&&!s;n++)for(var l=0;l<T.length;l++)if(i[n]===T[l]){s=!0;break}s===!1?(a("#"+e).addClass("disabled"),a("#"+e).removeClass("active")):a("#"+e).removeClass("disabled")})})}function u(e,t,i){var s=O[t][i];1===e.length?a(".btn-itemProperty[data-spa="+e[0]+"]").removeClass("disabled"):a.each(e,function(e,i){var n=O[i];i!==t&&a.each(n,function(e,t){for(var i=t,n=!1,l=0;l<i.length&&!n;l++)for(var r=0;r<s.length;r++)if(i[l]===s[r]){n=!0;break}n===!1?(a("#"+e).addClass("disabled"),a("#"+e).removeClass("active")):a("#"+e).removeClass("disabled")})})}function m(e){var t=Object.keys(O),i={};i.select=[],i.wait=[];for(var s=0;s<e.length;s++){var n=a(e[s]).data("spa");i.select.push(n),t=r(t,n.toString())}return i.wait=t,i}function f(e){var t=Object.keys(O);if(1!==t.length){var i={};a.each(t,function(t,s){var n=a(e[t]).data("ska"),l=a(e[t]).data("spa");i[s]=O[l][n]}),a.each(t,function(e,t){var s=[];a.each(i,function(a,e){if(t!==a){var i=[];if(0===s.length)i=e;else for(var n=0;n<e.length;n++){var l=o(s,e[n]);void 0!==l&&i.push(l)}s=i}}),a.each(O[t],function(e,t){for(var i=!1,n=0;n<s.length&&!i;n++)for(var l=0;l<t.length;l++)if(t[l]===s[n]){i=!0;break}i===!1?(a("#"+e).addClass("disabled"),a("#"+e).removeClass("active")):a("#"+e).removeClass("disabled")})})}}function h(){var e=a(".btn-itemProperty.active"),t="";e.length>0?(a.each(e,function(a,i){t+=a===e.length-1?i.textContent.trim():i.textContent.trim()+","}),a("[data-select]").text("Selected:")):a("[data-select]").text("Select")}function v(e){a.each(S,function(t,i){if(e==i.sku)return a("#skuNewPrice").html("$"+(i.skuPrice.sale_price/100).toFixed(2)),!1})}function p(e,t){var i=a(".warning-info");s(),a.ajax({url:"/stock/checkstock",data:{skus:e}}).done(function(a){if(a.success){var e=!0,s=parseInt(t.siblings("[data-num]").html());e=1===a.data.list[0].stockStatus,e===!1&&(i.removeClass("off"),i.children("span").html("Warning: Only "+s+" left"),t.addClass("disabled"))}}).always(function(){n()})}function C(a){for(var e="",t=0;t<a.length;t++)a.charCodeAt(t)>0&&a.charCodeAt(t)<255&&(e+=a.charAt(t));return e}function b(a){for(var e=C(a.val()),t=/^([a-z_A-Z-\/+0-9+\s]+)$/i,i=0;i<e.length;i++){var s=e.charAt(i);t.test(s)||(e=e.replace(s,""))}a.val(e)}function y(e){var t=window.setInterval(function(){e<=1&&(a(".limited-title").html("<strong>Pre Sale has ended</strong>"),a(".stock-qtty").html("Sold Out"),a("#limited-progress").attr("value","0"),a(".down-btn-addToBag").addClass("disabled"),clearInterval(t));var i=0,s=0,n=0,l=0;e>0&&(i=Math.floor(e/86400),s=Math.floor(e/3600)-24*i,n=Math.floor(e/60)-24*i*60-60*s,l=Math.floor(e)-24*i*60*60-60*s*60-60*n),A<2592e5?a(".time_show").html(24*i+s+"h: "+n+"m: "+l+"s"):a(".time_show").html(i+"d: "+s+"h: "+n+"m: "+l+"s"),e--,L=1e4*(1e3*e/_).toFixed(4),a("#limited-progress").attr("value",L)},1e3)}var w=new e("#baseImg-swiper",{pagination:"#baseImg-pagination",paginationType:"fraction",loop:!0,lazyLoading:!0,lazyLoadingInPrevNext:!0}),k=new e("#detailImg-swiper",{pagination:"#detailImg-pagination",paginationType:"fraction",loop:!0,lazyLoading:!0,lazyLoadingInPrevNext:!0}),T=(new e("#recommend-productList",{slidesPerView:2.5,paginationClickable:!0,spaceBetween:1,freeMode:!0,lazyLoading:!0,lazyLoadingInPrevNext:!0}),[]);1==[1==a(".sparow").length&&a(".skarow").length]&&(a(".sparow").data("click",!0),a(".skarow").addClass("active"),T[0]=a("[data-onlysku]").data("onlysku"),a("[data-select]").text("Selected:"));var I=[],P=[];k.params.control=w,w.params.control=k,a(".product-baseImg").on("click",function(){a(".product-detailImg").addClass("in"),a("body").addClass("no-scroll")}),a(".product-detailImg").on("click",function(){a(this).removeClass("in"),a("body").removeClass("no-scroll")}),a(function(){var a=document.createElement("script");a.src="https://www.youtube.com/player_api";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}),a(".btn-productPlayer").on("click",function(){var e=a(this).data("ytbid");a("#ytplayer").data("playid",e),a(".product-detailPlay").addClass("in"),a("body").addClass("no-scroll");var t=9/16,i=a(window).width(),s=i*t;a(".play-content").css("height",s);var n,r=a("#ytplayer"),e=r.data("playid");n=new YT.Player("ytplayer",{height:s,width:i,videoId:e,playerVars:{autoplay:1,controls:2,showinfo:0,rel:0},events:{onReady:l}})}),a(".product-detailPlay").on("click",function(){a(this).removeClass("in"),a("body").removeClass("no-scroll"),a(".product-detailImg").removeClass("in"),a(".play-content").html('<div id="ytplayer" class="ytplayer" data-playid=""></div>')});var S,x={closeOnOutsideClick:!1,closeOnCancel:!1,hashTracking:!1},O=(a("[data-remodal-id=modal]").remodal(x),{}),z={};a(".btn-itemProperty").on("click",function(e){var t=a(".warning-info");t.hasClass("off")||t.addClass("off");var i=a(e.target).data("spa"),s=a(e.target).data("ska");if(!a(e.target).hasClass("disabled")){a(e.target).hasClass("active")?(a("#spa"+i).data("click","false"),a(e.target).removeClass("active")):(a(e.target).parents(".row").find(".btn-itemProperty").removeClass("active"),a("#spa"+i).data("click","true"),a(e.target).addClass("active")),h();var n=a("#modalDialog").find(".btn-itemProperty.active"),l=Object.keys(O),r=a("#item-count"),o=m(n);if(r.children('[data-num="num"]').html(1),n.length===l.length){c(n),f(n);var p=z[T[0]];r.children('[data-item="minus"]').addClass("disabled"),r.children('[data-num="num"]').html(1),p>1&&r.children('[data-item="add"]').removeClass("disabled")}else n.length<1?(d(I,P,O),T=[]):(c(n),g(o.wait),u(o.select,i,s));void 0!=T[0]&&(a("#addToCart-sku").val(T[0]),v(T[0]));var C=a(this).data("image"),b=!1;void 0!=C&&""!=C&&(a.each(a("#baseImg-swiper img.swiper-lazy"),function(e,t){var i=a(this).attr("src");if(i===C)return w.slideTo(e,1e3,!1),k.slideTo(e,1e3,!1),b=!0,!1}),b===!1&&(w.slides[1].className.indexOf("replace-img")>0?(a(".img-replace").attr("src",C),w.slideTo(1,1e3,!1),k.slideTo(1,1e3,!1)):(w.prependSlide('<div class="swiper-slide replace-img"><img class="img-fluid swiper-lazy img-replace" data-src="'+C+'" alt=""><img class="img-fluid preloader" src="/images/product/bg-product@750.png" alt=""></div>'),w.slideTo(1,1e3,!1),k.prependSlide('<div class="swiper-slide replace-img"><img class="img-fluid swiper-lazy img-replace" data-src="'+C+'" alt=""><img class="img-fluid preloader" src="/images/product/bg-product@750.png" alt=""></div>'),k.slideTo(1,1e3,!1))))}}),a("#item-count").on("click","[data-item]",function(e){if(!showmsg())return!1;var t=a(".warning-info"),i=a("#modalDialog").find(".btn-itemProperty.active"),s=Object.keys(O);if(!(s.length<i.length)){var n;if(n="I"===a(e.target)[0].tagName?a(e.target).parents(".btn-cartCount"):a(e.target),!n.hasClass("disabled")){var l=parseInt(n.siblings("[data-num]").html()),r=T[0],o=z[r],d=l++,c=d;if("add"===n.data("item")){c=l;var g=50;if(l>1&&n.siblings('[data-item="minus"]').removeClass("disabled"),l===g&&(t.removeClass("off"),t.children("span").html("50 items limit"),n.addClass("disabled")),o<20)l===o&&(t.removeClass("off"),t.children("span").html("Warning: Only "+l+" left"),n.addClass("disabled"));else if(20===o&&l>=20){var u=r+"_"+ ++l;p(u,n)}}else--d,t.addClass("off"),1===d?n.addClass("disabled"):n.siblings('[data-item="add"]').hasClass("disabled")&&n.siblings('[data-item="add"]').removeClass("disabled"),c=d;a("#addToCart-quantity").val(c),n.siblings("[data-num]").html(c)}}}),a("fieldset[data-vas-type]").on("click",function(e){if(1===parseInt(a(this).data("vas-type")))if(a(e.target).hasClass("icon-checkcircle")){var t=a(e.target),i=a(e.target).siblings(".input-engraving");t.hasClass("active")?(i.addClass("disabled"),t.removeClass("active"),i.val("")):(i.removeClass("disabled"),t.addClass("active"))}else if(a(e.target).hasClass("input-engraving")){var t=a(e.target).siblings(".icon-checkcircle"),i=a(e.target);i.hasClass("disabled")&&(i.removeClass("disabled"),t.addClass("active"),i.val(""))}}),a(".input-engraving").on("keyup blur",function(){b(a(this))}),a(".btn-showMore").on("click",function(){var e=a(this).siblings(".message-info");e.toggleClass("active"),e.hasClass("active")?(a(this).addClass("off"),a(this).children(".showMore").html("Show Less"),a(this).children(".iconfont").removeClass("icon-arrow-bottom").addClass("icon-arrow-up")):(a(this).removeClass("off"),a(this).children(".showMore").html("Show More"),a(this).children(".iconfont").removeClass("icon-arrow-up").addClass("icon-arrow-bottom"))}),a(document).ready(function(){a(".message-info").children("p").height()<=64&&a(".btn-showMore").hide(),a("img.img-lazy").lazyload({threshold:200,effect:"fadeIn"}),a.ajax({url:a(".product-baseInfo").data("impr"),type:"GET"}),a.ajax({url:a("#recommend").data("impr"),type:"GET"})});var j=a(".limited-content").data("begintime"),M=a(".limited-content").data("endtime"),A=a(".limited-content").data("lefttime"),_=(a(".limited-content").data("qtty"),parseInt(M-j)),L=1e4*(A/_).toFixed(4);a("#limited-progress").attr("value",L),A!=-1&&a(function(){y(A/1e3)}),a(".btn-addToSave").on("click",function(){if(!a(this).hasClass("disabled")){var e=a(this).data("spu"),s=a(this).data("issaved"),n=a(this);s?a.ajax({type:"POST",url:"/designer/editcancel",data:{spus:e}}).done(function(e){e.success?(n.data("issaved",0),a(".btn-addToSave").html("SAVE")):(a("#error-info").html("The operation failed,<br>Please try again!"),t(),setTimeout(function(){i()},1500))}):a.ajax({type:"POST",url:"/designer/editsave",data:{spus:e}}).done(function(e){e.success?(n.data("issaved",1),a(".btn-addToSave").html("SAVED")):(a("#error-info").html("The operation failed,<br>Please try again!"),t(),setTimeout(function(){i()},1500))})}})}(jQuery,Swiper);