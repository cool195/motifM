"use strict";!function(o){function n(){o(".loading").toggleClass("loading-hidden"),setTimeout(function(){o(".loading").toggleClass("loading-open")},25)}function l(){o(".loading").addClass("loading-close"),setTimeout(function(){o(".loading").toggleClass("loading-hidden loading-open").removeClass("loading-close")},500)}o(".updateFollow").on("click",function(i){var a=o(this),e=a.data("did");n(),o.ajax({url:"/followDesigner/"+e,type:"GET"}).done(function(n){n.success&&o('[data-followingdid="'+e+'"]').remove()}).always(function(){l()})}),o(function(){o("img.img-lazy").lazyload({threshold:200,effect:"fadeIn"})})}(jQuery);