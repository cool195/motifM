"use strict";!function(t,a){function e(){t("#designerContainer").find(".loading").show()}function n(){t("#designerContainer").find(".loading").hide()}function i(){var a=t("#designerContainer"),i=a.data("start"),o=10;i!==-1&&a.data("loading")!==!0&&(a.data("loading",!0),e(),t.ajax({url:"/collection",data:{cmd:"designerinfolist",start:i,size:o}}).done(function(e){if(null!==e.data&&""!==e.data)if(null===e.data.list||""===e.data.list||void 0===e.data.list)a.data("start",-1);else{r(e.data);var n=9/16,i=t(window).width(),d=i*n;t(".ytplayer").length>0&&t(".designer-media").css("height",d),c("https://www.youtube.com/player_api",function(){setTimeout(function(){f()},1e3)});var s=e.data.list.length,u=e.data.start;s<o?a.data("start",-1):a.data("start",u),l(),t("img.img-lazy").lazyload({threshold:1e3,effect:"fadeIn"}),t("[data-clk]").unbind("click"),t("[data-clk]").bind("click",function(){var a=t(this);void 0!==a.data("link")&&(t.ajax({url:a.data("clk"),type:"GET"}),setTimeout(function(){window.location.href=a.data("link")},100))})}}).always(function(){a.data("loading",!1),n()}))}function o(t){t.children(".bg-player").css("display","none")}function d(a){var e=t(window).scrollTop()+t(window).height(),n=t(a).offset().top,i=n+t(a).height();return n>e||i<t(window).scrollTop()}function r(a){var e=template("tpl-designer",a),n=t.parseHTML(e);t(".designer-content").append(n)}function l(){new a(".swiper-container",{freeMode:!0,slidesPerView:"auto",freeModeMomentumRatio:.5})}function s(){var a=window.pageYOffset,e=t(document).height()-t(window).height();a!==e&e<=300+a&&i()}function c(t,a){var e=document.createElement("script");e.src=t;var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(e,n),a()}function f(){var a=t(".player-item");0!==a.length&&t.each(a,function(a,e){if(!d(e)&&!t(e).hasClass("active")){var n=t(e),i=n.data("playid");"undefined"!=typeof YT&&"undefined"!=typeof YT.Player&&(player=new YT.Player(i,{height:MediaHeight,width:Width,videoId:i,playerVars:{autoplay:1,controls:2,showinfo:0,rel:0},events:{onReady:o(n)}})),t(this).addClass("active")}})}t("img.img-lazy").lazyload({threshold:200,container:t("#designerContainer"),effect:"fadeIn"}),t(document).ready(function(){i(),l(),t(window).scroll(function(){t("img.img-lazy").each(function(){var a=t(this).attr("src"),e=t(this).attr("data-original");a===e&&t(this).removeClass("img-lazy")}),s()})}),c("https://www.youtube.com/player_api",function(){f()})}(jQuery,Swiper);