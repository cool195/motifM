"use strict";!function(a,t){function i(){a("#designerContainer").find(".loading").show()}function n(){a("#designerContainer").find(".loading").hide()}function e(){var t=a("#designerContainer"),e=t.data("start"),r=10;e!==-1&&t.data("loading")!==!0&&(t.data("loading",!0),i(),a.ajax({url:"/designer",data:{cmd:"designerinfolist",start:e,size:r}}).done(function(i){if(null!==i.data&&""!==i.data)if(null===i.data.list||""===i.data.list||void 0===i.data.list)t.data("start",-1);else{d(i.data);var n=i.data.list.length,e=i.data.start;n<r?t.data("start",-1):t.data("start",e),o(),a("img.img-lazy").lazyload({threshold:1e3,effect:"fadeIn"}),a("[data-clk]").unbind("click"),a("[data-clk]").bind("click",function(){var t=a(this);void 0!==t.data("link")&&(a.ajax({url:t.data("clk"),type:"GET"}),setTimeout(function(){window.location.href=t.data("link")},100))})}}).always(function(){t.data("loading",!1),n()}))}function d(t){var i=template("tpl-designer",t),n=a.parseHTML(i);a(".designer-content").append(n)}function o(){new t(".swiper-container",{freeMode:!0,slidesPerView:"auto",freeModeMomentumRatio:.5})}function r(){var t=window.pageYOffset,i=a(document).height()-a(window).height();t!==i&i<=300+t&&e()}a("img.img-lazy").lazyload({threshold:200,container:a("#designerContainer"),effect:"fadeIn"}),a(document).ready(function(){e(),o(),a(window).scroll(function(){a("img.img-lazy").each(function(){var t=a(this).attr("src"),i=a(this).attr("data-original");t===i&&a(this).removeClass("img-lazy")}),r()})})}(jQuery,Swiper);