
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Sign in</title>
    @include('head')

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/login.css{{'?v='.config('app.version')}}">

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">

    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js{{'?v='.config('app.version')}}"></script>

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
        <form id="login" autocomplete="off">
            <div class="warning-info off flex text-warning flex-alignCenter text-left m-b-5x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span class="font-size-xs"></span>
            </div>
            <fieldset class="m-t-15x login-text">
                <label class="text-main font-size-md login-title">Email</label>
                <input class="input-login form-control font-size-sm" name="email"
                       type="text" maxlength="60" autocomplete="off">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="m-t-15x login-text">
                <label class="text-main font-size-md login-title">Password</label>
                <input class="input-login form-control font-size-sm" name="pw"
                       type="password" maxlength="32" autocomplete="off">
                <i class="iconfont icon-show icon-size-lg input-show text-common off"></i>
            </fieldset>
            <input type="hidden" name="referer" value="{{$referer}}">
        </form>
        <div class="container-fluid p-a-0 m-t-20x p-t-15x">
            <div class="btn btn-primary btn-lg btn-block" data-role="submit" id="login">SIGN IN</div>
        </div>

        <div class="m-t-15x text-primary text-center font-size-sm">
            <a href="/reset" class="text-primary">Forgot password?</a>
        </div>
    </section>

    <!-- 退出登录 -->
    <a class="exit-login" href="{{'/login?path=1&url='.$referer}}">
        <i class="iconfont icon-cross icon-size-md text-common"></i>
    </a>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/login.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="{{env('CDN_Static')}}/scripts/signWith.js{{'?v='.config('app.version')}}"></script>

@include('global')
</html>