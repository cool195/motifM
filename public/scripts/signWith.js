'use strict';

/**
 * Created by zhaozhe on 16/6/21.
 */

(function () {
    // google 第三方登录
    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {}, function (googleUser) {
            var profile = googleUser.getBasicProfile();
            $.ajax({
                url: '/googlelogin',
                type: 'POST',
                data: {
                    email: profile.getEmail(),
                    token: googleUser.getAuthResponse().id_token,
                    name: profile.getName(),
                    avatar: profile.getImageUrl()
                }
            }).done(function (data) {
                console.log("success");
                if (data.success) {
                    window.location.href = data.redirectUrl;
                } else {
                    $('.warning-info').removeClass('off');
                    $('.warning-info').children('span').html(data.prompt_msg);
                }
            }).fail(function () {
                console.log("error");
            }).always(function () {
                console.log("complete");
            });
        }, function (error) {
            console.error(JSON.stringify(error, undefined, 2));
        });
    }

    var ClientID = '21307862595-iabkmrtg7r2ioq6qmu1e81de66thp4p2.apps.googleusercontent.com';
    // var googleUser = {};
    var auth2={};
    var initGoogle = function initGoogle() {
        gapi.load('auth2', function () {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
             auth2 = gapi.auth2.init({
                client_id: ClientID,
                cookiepolicy: 'single_host_origin'
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('googleLogin'));
        });
    };

    initGoogle();

    // facebook 第三方登录
})();
//# sourceMappingURL=signWith.js.map
