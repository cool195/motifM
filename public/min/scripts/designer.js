"use strict";!function(a,t){function n(){a("#designerContainer").find(".loading").show()}function e(){a("#designerContainer").find(".loading").hide()}function i(){var t=a("#designerContainer"),i=t.data("start"),r=3;i!==-1&&t.data("loading")!==!0&&(t.data("loading",!0),n(),a.ajax({url:"/designer",data:{cmd:"designerinfolist",start:i,size:r}}).done(function(n){if(null!==n.data&&""!==n.data)if(null===n.data.list||""===n.data.list||void 0===n.data.list)t.data("start",-1);else{d(n.data);var e=n.data.list.length,i=n.data.start;e<r?t.data("start",-1):t.data("start",i),o(),a("img.img-lazy").lazyload({threshold:1e3,effect:"fadeIn"})}}).always(function(){t.data("loading",!1),e()}))}function d(t){var n=template("tpl-designer",t),e=a.parseHTML(n);a(".designer-content").append(e)}function o(){new t(".swiper-container",{freeMode:!0,slidesPerView:"auto",freeModeMomentumRatio:.5})}function r(){var t=window.pageYOffset,n=a(document).height()-a(window).height();t!==n&n<=100+t&&i()}a("img.img-lazy").lazyload({threshold:200,container:a("#designerContainer"),effect:"fadeIn"}),a(document).ready(function(){i(),o(),a(window).scroll(function(){a("img.img-lazy").each(function(){var t=a(this).attr("src"),n=a(this).attr("data-original");t===n&&a(this).removeClass("img-lazy")}),r()})})}(jQuery,Swiper);