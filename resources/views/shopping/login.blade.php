<!DOCTYPE html>
<html lang="en">
<head>

    <title>Sign in</title>
    @include('head')

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/login.css">

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css">

    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js"></script>

</head>
<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="login-container">
    <section class="login-content p-y-20x">
        <div class="m-x-auto m-b-20x text-center p-b-20x">
            <a href="/daily">
                <img class="motif-logo" src="{{env('CDN_Static')}}/images/login/login-logo.png"
                 srcset="{{env('CDN_Static')}}/images/login/login-logo@2x.png 2x,{{env('CDN_Static')}}/images/login/login-logo@3x.png 3x">
            </a>
        </div>
        <form id="login">
            <div class="warning-info off flex text-warning flex-alignCenter text-left m-b-5x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span class="font-size-xs"></span>
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
            <input type="hidden" name="referer" value="{{$referer}}">
        </form>
        <div class="m-t-15x text-primary text-center font-size-sm">
            <a href="/reset" class="text-primary">Forgot password?</a>
        </div>
        <div class="container-fluid p-a-0 m-t-20x">
            <div class="row">
                <div class="col-xs-6">
                    <a class="btn btn-primary-outline btn-lg btn-block" href="{{'/register?referer='.$referer}}" id="register">Register</a>
                </div>
                <div class="col-xs-6">
                    <div class="btn btn-primary btn-lg btn-block" data-role="submit" id="login">Sign in</div>
                </div>
            </div>
        </div>
        <div class="m-t-20x flex flex-justifyCenter">
            <hr class="hr-login m-a-0">
        </div>
        <div class="m-t-20x p-b-20x">
            <div class="btn btn-block btn-lg btn-facebook" id="facebookLogin">
                <i class="iconfont icon-facebook-o icon-size-md"></i>
                Sign in with Facebook
            </div>
            <div class="btn btn-block btn-lg btn-google m-l-0 m-t-10x" id="googleLogin">
                <i class="iconfont icon-google-o icon-size-md"></i>
                Sign in with Google
            </div>
        </div>
        <div class="m-t-20x text-center font-size-sm"><a href="/contactus">Contact Us</a></div>
    </section>

</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>
<script src="{{env('CDN_Static')}}/scripts/login.js?v=2"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="{{env('CDN_Static')}}/scripts/signWith.js"></script>

@include('global')
</html>
