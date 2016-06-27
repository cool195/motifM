<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Login</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/login.css">

    <link rel="stylesheet" href="/styles/remodal.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

    <script src="/scripts/vendor/template-native.js"></script>

</head>
<body>
<!-- 主体内容 -->
<div class="login-container">
    <section class="login-content p-y-20x">
        <a href="/daily"><img class="img-fluid m-x-auto m-b-20x" src="/images/login/login-logo.png"
             srcset="/images/login/login-logo@2x.png 2x,/images/login/login-logo@3x.png 3x"></a>
        <form id="login">
            <div class="warning-info off flex text-warning flex-alignCenter text-left m-b-5x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span class="font-size-sm"></span>
            </div>
            <fieldset class="m-t-10x login-text">
                <input class="input-login form-control font-size-sm" name="email" placeholder="Email"
                       type="text" maxlength="60">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="m-t-10x login-text">
                <input class="input-login form-control font-size-sm" name="pw" placeholder="Password"
                       type="password" maxlength="32">
                <i class="iconfont icon-show icon-size-lg input-show text-common off"></i>
            </fieldset>
        </form>
        <div class="m-t-15x text-primary text-center font-size-sm">
            <a href="/reset" class="text-primary">Forgot Password?</a>
        </div>
        <div class="container-fluid p-a-0 m-t-20x">
            <div class="row">
                <div class="col-xs-6">
                    <a class="btn btn-primary-outline btn-block" href="/register">Register</a>
                </div>
                <div class="col-xs-6">
                    <div class="btn btn-primary btn-block" data-role="submit">Login</div>
                </div>
            </div>
        </div>
        <div class="m-t-20x flex flex-justifyCenter">
            <hr class="hr-login m-a-0">
        </div>
        <div class="m-t-20x p-b-20x">
            <div class="btn btn-block btn-facebook" id="facebookLogin">
                <i class="iconfont icon-facebook-o icon-size-md"></i>
                Sign in with Facebook
            </div>
            <div class="btn btn-block btn-google m-l-0 m-t-10x" id="googleLogin">
                <i class="iconfont icon-google-o icon-size-md"></i>
                Sign in with Google
            </div>
        </div>
        <div class="m-t-20x text-primary text-center font-size-sm"><a href="/contactus">Contact Us</a></div>
    </section>

</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/login.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="/scripts/signWith.js"></script>

@include('global')
</html>
