"use strict";!function(a,n){function t(n,t){r.slideTo(n,t,!1),u.slideTo(n,t,!1),a(r.slides).children("a").addClass("inactive"),a(r.slides[n]).children("a").removeClass("inactive")}function i(){var n=u.activeIndex,t=a(u.slides[n]);t.css({height:"auto"});var i=t.children(".container-fluid").height();console.info(i),t.siblings(".swiper-slide").height(i)}function e(n){a(u.slides[n]).find(".loading").show()}function o(n){a(u.slides[n]).find(".loading").hide()}function d(){var n=u.activeIndex,t=a(u.slides[n]),i=a(r.slides[n]),d=t.data("pagenum");if(d!==-1&&t.data("loading")!==!0){t.data("loading",!0);var s=++d,l=i.data("tab-index");e(n),a.ajax({url:"/products",data:{pagenum:s,pagesize:20,cid:l}}).done(function(i){i.success&&(onImpressProduct(i.data.list),null===i.data||""===i.data||0===i.data.list.length?t.data("pagenum",-1):(c(i.data,n),t.data("pagenum",d),a.ajax({url:i.data.impr}),a("img.img-lazy").lazyload({threshold:200,container:a("#tabs-container"),effect:"fadeIn"}),a("[data-clk]").unbind("click"),a("[data-clk]").bind("click",function(){var n=a(this);void 0!==n.data("link")&&(a.ajax({url:n.data("clk"),type:"GET"}),setTimeout(function(){window.location.href=n.data("link")},100))})))}).always(function(){o(n),t.data("loading",!1)})}}function s(){var n=location.hash;if(""!==n&&null!==n){n=n.substring(1);var i=a("#"+n).index();i>=0&&t(i,0)}}function l(){var n=window.pageYOffset,t=a(document).height()-a(window).height();n!==t&&t<=300+n&&d()}function c(n,t){var i=template("tpl-product",n),e=a.parseHTML(i);a(u.slides[t]).find(".row").append(e)}var r=new n("#tabIndex-container",{freeMode:!0,slidesPerView:"auto",freeModeMomentumRatio:.5}),u=new n("#tabs-container",{onlyExternal:!0});a("#header").headroom({tolerance:.5,offset:44,classes:{top:"animated",notTop:"animated",bottom:"animated",notBottom:"animated",initial:"animated",pinned:"slideInDown",unpinned:"slideOutUp"}}),a("#tabIndex-container").headroom({tolerance:.5,offset:44,classes:{top:"animated",notTop:"animated",bottom:"animated",notBottom:"animated",initial:"animated",pinned:"tabIndexDown",unpinned:"tabIndexUp"}}),a("#tabIndex-container").on("click",".nav-item",function(){t(r.clickedIndex,500),d(),i()});var f={hashTracking:!1};a("[data-remodal-id=download-modal]").remodal(f),function(){s(),d()}(),a("#tabIndex-container").find("li[data-tab-index]").one("click",function(){console.log("一次性事件"),a("body").animate({scrollTop:0},200)}),a(document).ready(function(){a(window).scroll(function(){a("img.img-lazy").each(function(){var n=a(this).attr("src"),t=a(this).attr("data-original");n===t&&a(this).removeClass("img-lazy")}),l(),console.log("滚动条滚动")})}),a(".swiper-wrapper").on("click",".btn-wish",function(n){var t=a(n.target),i=a(n.target).data("spu");a.ajax({url:"/updateWish",type:"post",data:{spu:i}}).done(function(a){a.success&&(t.hasClass("active")?t.removeClass("active"):t.addClass("active"))})})}(jQuery,Swiper);