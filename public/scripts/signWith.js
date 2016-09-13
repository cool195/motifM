/**
 * Created by zhaozhe on 16/6/21.
 */
/* eslint-disable */
(function() {
    // loading 打开
    function openLoading() {
        $('.loading').toggleClass('loading-hidden');
        setTimeout(function () {
            $('.loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('.loading').addClass('loading-close');
        setTimeout(function () {
            $('.loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }
    // google 第三方登录
    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
                var profile = googleUser.getBasicProfile();
                $.ajax({
                        url: '/googlelogin',
                        type: 'POST',
                        data: {
                            email: profile.getEmail(),
                            id: profile.getId(),
                            name: profile.getName(),
                            avatar: profile.getImageUrl()
                        }
                    })
                    .done(function(data) {
                        console.log("success");
                        if (data.success) {
                            window.location.href = data.redirectUrl;
                        } else {
                            $('.warning-info').removeClass('off');
                            $('.warning-info').children('span').html(data.prompt_msg);
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });

            },
            function(error) {
                console.error(JSON.stringify(error, undefined, 2));
            });
    }

    var ClientID = '21307862595-iabkmrtg7r2ioq6qmu1e81de66thp4p2.apps.googleusercontent.com';
    // var googleUser = {};
    var auth2 = {};
    var initGoogle = function() {
        gapi.load('auth2', function() {
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

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            loginFacebook();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
        }
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId: '270298046670851',
            cookie: false,
            status: false,
            xfbml: false,
            logging: false,
            frictionlessRequests: true,
            oauth: true,
            version: 'v2.6' // use version 2.2
        });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function loginFacebook() {
        FB.api('/me', 'GET', {fields: 'id,name,picture.width(750).height(750),email'},function (response) {
            if(response.email == '' || response.email == undefined){
                $.ajax({
                    url: '/facebookstatus/'+response.id,
                    type: 'get'
                })
                    .done(function(data) {

                        if (data.status) {
                            response.email = data.data.email;
                            loginSuccess(response);
                        } else {
                            window.location.href = '/addFacebookEmail?id=' + response.id + '&name=' + response.name;
                        }
                    })

            }else{
                loginSuccess(response);
            }
        });
    }

    function loginSuccess(response){
        $.ajax({
            url: '/facebooklogin',
            type: 'POST',
            data: {
                email: response.email,
                id: response.id,
                name: response.name,
                avatar: response.picture.data.url
            }
        })
            .done(function(data) {
                if (data.success) {
                    window.location.href = data.redirectUrl;
                } else {
                    $('.warning-info').removeClass('off');
                    $('.warning-info').children('span').html(data.prompt_msg);
                }
            });
    }

    $('#facebookLogin').click(function() {
        openLoading();
        /* Act on the event */
        FB.login(function(response) {
            // handle the response
            statusChangeCallback(response);
        }, {
            scope: 'public_profile,email'
        });
    });
    $('#googleLogin').click(function(){
        openLoading();
    })
})();

