"use strict";!function(e){function a(){var a=e("[data-order-number]").data("order-number");e.ajax({url:"/orderdetail/"+a,type:"GET"}).done(function(e){e.success&&(n=e.data.lineOrderList,o())})}function o(){e.each(n,function(a,o){var t={sale_qtty:o.sale_qtty,select:!0,sku:o.sku,VAList:[]},n=[];e.each(o.vas_info,function(e,a){n[e]={},n[e].user_remark=a.user_remark,n[e].vas_id=a.vas_id}),t.VAList=n,r.push(t)})}function t(){e.ajax({url:"/cart/addBatchCart",type:"POST",data:{operate:r}}).done(function(e){e.success&&(window.location.href=e.redirectUrl)})}e(".btn-showMore").on("click",function(){var a=e(this).siblings(".message-info");a.toggleClass("active"),a.hasClass("active")?(e(this).children(".showMore").html("Show Less"),e(this).children(".iconfont").removeClass("icon-arrow-bottom").addClass("icon-arrow-up")):(e(this).children(".showMore").html("Show More"),e(this).children(".iconfont").removeClass("icon-arrow-up").addClass("icon-arrow-bottom"))});var n=[],r=new Array;e(document).ready(function(){e(".message-info").children("p").height()<=144&&e(".btn-showMore").hide(),e("#orderState").data("state")&&a()}),e("#buyAgain").click(function(){t()});var i={closeOnOutsideClick:!0,closeOnCancel:!1,hashTracking:!1},s=e('[data-remodal-id="paywith-modal"]').remodal(i);e(".checkoutPay").on("click",function(){s.open()})}(jQuery);