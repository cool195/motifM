!function(){function o(o){console.log(o.id),a.attachClickHandler(o,{},function(o){var e=o.getBasicProfile();$.ajax({url:"/googlelogin",type:"POST",data:{email:e.getEmail(),id:e.getId(),name:e.getName(),avatar:e.getImageUrl()}}).done(function(o){console.log("success"),o.success?window.location.href=o.redirectUrl:($(".warning-info").removeClass("off"),$(".warning-info").children("span").html(o.prompt_msg))}).fail(function(){console.log("error")}).always(function(){console.log("complete")})},function(o){console.error(JSON.stringify(o,void 0,2))})}function e(o){console.log("statusChangeCallback"),console.log(o),"connected"===o.status?n():"not_authorized"===o.status}function n(){console.log("Welcome!  Fetching your information.... "),FB.api("/me?fields=id,name,picture,email",function(o){console.log(o),""===o.email||void 0===o.email?window.location.href="/addFacebookEmail?id="+o.id+"&name="+o.name+"&avatar="+o.picture.data.url.encodeURIComponent():$.ajax({url:"/facebooklogin",type:"POST",data:{email:o.email,id:o.id,name:o.name,avatar:o.picture.data.url}}).done(function(o){console.log("success"),o.success?window.location.href=o.redirectUrl:($(".warning-info").removeClass("off"),$(".warning-info").children("span").html(o.prompt_msg))}).fail(function(){console.log("error")}).always(function(){console.log("complete")})})}var i="21307862595-iabkmrtg7r2ioq6qmu1e81de66thp4p2.apps.googleusercontent.com",a={},t=function(){gapi.load("auth2",function(){a=gapi.auth2.init({client_id:i,cookiepolicy:"single_host_origin"}),o(document.getElementById("googleLogin"))})};t(),window.fbAsyncInit=function(){FB.init({appId:"270298046670851",cookie:!0,xfbml:!0,version:"v2.6"})},function(o,e,n){var i,a=o.getElementsByTagName(e)[0];o.getElementById(n)||(i=o.createElement(e),i.id=n,i.src="//connect.facebook.net/en_US/sdk.js",a.parentNode.insertBefore(i,a))}(document,"script","facebook-jssdk"),$("#facebookLogin").click(function(){FB.login(function(o){e(o)},{scope:"public_profile,email"})})}();