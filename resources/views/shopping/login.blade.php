<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/register.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js{{'?v='.config('app.version')}}"></script>

</head>

<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="register-container">
    <section class="register-content p-y-20x">
        <!-- 顶部 logo -->
        <a href="/daily">
            <img class="img-fluid m-x-auto m-b-20x p-b-10x motif-logo"
                 src="{{env('CDN_Static')}}/images/login/login-logo.png"
                 srcset="{{env('CDN_Static')}}/images/login/login-logo@2x.png 2x,{{env('CDN_Static')}}/images/login/login-logo@3x.png 3x">
        </a>

        <div class="text-left p-t-20x m-b-20x p-b-5x">
            <img class="img-fluid m-x-auto m-b-20x" src="{{env('CDN_Static')}}/images/login/register-gg.png"
                 srcset="{{env('CDN_Static')}}/images/login/register-gg@2x.png 2x,{{env('CDN_Static')}}/images/login/register-gg@3x.png 3x">
        </div>

        <form id="register">
            <input type="hidden" name="referer" value="{{$referer}}">
            <div class="warning-info off flex text-warning flex-alignCenter text-left m-b-10x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span class="font-size-xs"></span>
            </div>
            <fieldset class="register-input m-b-10x">
                <label class="font-size-sm register-title">Your Name</label>
                <input class="input-register form-control font-size-sm" name="nick"
                       placeholder="" type="text" maxlength="32">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="register-input m-b-10x">
                <label class="font-size-sm register-title">Email</label>
                <input class="input-register form-control font-size-sm" name="email"
                       placeholder="" type="text" maxlength="60">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="register-input m-b-10x">
                <label class="font-size-sm register-title">Password(6 characters min)</label>
                <input class="input-register form-control font-size-sm" name="pw"
                       placeholder="" type="password" maxlength="32">
                <i class="iconfont icon-show icon-size-md input-show text-common off"></i>
            </fieldset>
        </form>
        <div class="m-t-20x p-t-10x">
            <!-- TODO 需要加disabled 样式 -->
            <div class="btn btn-primary btn-block btn-lg disabled" data-role="submit">SIGN UP</div>
        </div>
        <div class="text-center login-or m-t-10x">
            <hr class="hr-login m-a-0">
            <span class="p-x-5x font-size-md">or</span>
        </div>
        <div class="p-y-10x flex flex-spaceAround p-x-20x m-x-20x">
            <div href="#" class="iconfont icon-facebook btn-facebook" id="facebookLogin"></div>
            <div href="#" class="iconfont icon-google btn-google" id="googleLogin"></div>
        </div>
        <div class="m-t-10x text-primary text-center font-size-sm">Already have an account? <a
                    class="text-primary text-underLine font-size-base" href="{{'/register?referer='.$referer}}">SIGN
                IN</a></div>
        <div class="m-t-15x text-primary text-center font-size-sm">
            By registering, you’ve accepted our<br>
            <a class="text-primary text-underLine" href="/termsconditions">Terms & Conditions</a>
        </div>
    </section>

    <!-- 退出注册 -->
    @if($path==1)
        <a class="exit-register" href="/daily">
            <i class="iconfont icon-cross icon-size-md text-common"></i>
        </a>
    @else
        <a class="exit-register" href="javascript:;" onClick="javascript :history.go(-1);">
            <i class="iconfont icon-cross icon-size-md text-common"></i>
        </a>
    @endif

</div>
<!-- 提示注册成功 -->
<div class="remodal remodal-lg modal-content" data-remodal-id="changePwd-modal" id="successDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <div class="font-size-base">Congratulation！</div>
        <span>Account Created Successfully</span>
    </div>
    <hr class="hr-base m-a-0">
    <div class="btn-group flex">
        <a href="" class="btn remodal-btn flex-width text-primary" id="confirm">OK</a>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>

<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/register.js{{'?v='.config('app.version')}}"></script>
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

<script>
    var _learnq = _learnq || [];
    var userKlaviyoRegister = function () {
        var Email= $('input[name="email"]').val();
        _learnq.push(['track', 'Register', {
            'email' : Email
        }]);
    };
</script>

@include('global')
</html>
