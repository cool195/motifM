!function(){function o(o){console.log(o.id),t.attachClickHandler(o,{},function(o){var n=o.getBasicProfile();$.ajax({url:"/googlelogin",type:"POST",data:{email:n.getEmail(),id:n.getId(),name:n.getName(),avatar:n.getImageUrl()}}).done(function(o){console.log("success"),o.success?window.location.href=o.redirectUrl:($(".warning-info").removeClass("off"),$(".warning-info").children("span").html(o.prompt_msg))}).fail(function(){console.log("error")}).always(function(){console.log("complete")})},function(o){console.error(JSON.stringify(o,void 0,2))})}function n(o){console.log("statusChangeCallback"),console.log(o),"connected"===o.status?e():"not_authorized"===o.status}function e(){FB.api("/me?fields=id,name,picture,email",function(o){o.size=function(o){var n,e=0;for(n in o)o.hasOwnProperty(n)&&e++;return e},console.log([o,o.size(o)]),4==o.size(o)?window.location.href="/addFacebookEmail?id="+o.id+"&name="+o.name+"&avatar="+o.picture.data.url.encodeURIComponent():$.ajax({url:"/facebooklogin",type:"POST",data:{email:o.email,id:o.id,name:o.name,avatar:o.picture.data.url}}).done(function(o){console.log("success"),o.success?window.location.href=o.redirectUrl:($(".warning-info").removeClass("off"),$(".warning-info").children("span").html(o.prompt_msg))}).fail(function(){console.log("error")}).always(function(){console.log("complete")})})}var i="21307862595-iabkmrtg7r2ioq6qmu1e81de66thp4p2.apps.googleusercontent.com",t={},a=function(){gapi.load("auth2",function(){t=gapi.auth2.init({client_id:i,cookiepolicy:"single_host_origin"}),o(document.getElementById("googleLogin"))})};a(),window.fbAsyncInit=function(){FB.init({appId:"270298046670851",cookie:!1,status:!1,xfbml:!1,logging:!1,frictionlessRequests:!0,oauth:!0,version:"v2.6"})},function(o,n,e){var i,t=o.getElementsByTagName(n)[0];o.getElementById(e)||(i=o.createElement(n),i.id=e,i.src="//connect.facebook.net/en_US/sdk.js",t.parentNode.insertBefore(i,t))}(document,"script","facebook-jssdk"),$("#facebookLogin").click(function(){FB.login(function(o){n(o)},{scope:"public_profile,email"})})}();