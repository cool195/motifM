<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    @include('head')
    <link rel="stylesheet" href="/styles/register.css">
    <link rel="stylesheet" href="/styles/remodal.css">
    <script src="/scripts/vendor/template-native.js"></script>

</head>

<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="register-container">
    <section class="register-content p-y-20x">
        <!-- 顶部 logo -->
        <a href="/daily"><img class="img-fluid m-x-auto m-b-20x motif-logo" src="/images/login/register-logo.png"
                              srcset="/images/login/register-logo@2x.png 2x,/images/login/register-logo@3x.png 3x"></a>
        <div class="text-main text-center p-t-10x m-b-20x p-b-5x"><strong>Create Your Account</strong></div>

        <form id="register">
            <div class="warning-info off flex text-warning flex-alignCenter text-left m-b-10x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span class="font-size-sm"></span>
            </div>
            <fieldset class="register-input m-b-10x">
                <input class="input-register form-control font-size-sm" name="nick"
                       placeholder="Your Name" type="text" maxlength="32">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="register-input m-b-10x">
                <input class="input-register form-control font-size-sm" name="email"
                       placeholder="Email" type="text" maxlength="60">
                <i class="iconfont icon-delete icon-size-md input-clear text-common hidden"></i>
            </fieldset>
            <fieldset class="register-input m-b-10x">
                <input class="input-register form-control font-size-sm" name="pw"
                       placeholder="Password" type="password" maxlength="32">
                <i class="iconfont icon-show icon-size-md input-show text-common off"></i>
            </fieldset>
        </form>
        <div class="m-t-15x text-primary text-center font-size-sm">
            By registering, you’ve accepted our<br>
            <a class="text-primary text-underLine" href="/termsconditions">Terms & Conditions</a>
        </div>
        <div class="m-t-20x">
            <!-- TODO 需要加disabled 样式 -->
            <div class="btn btn-primary btn-block btn-lg disabled" data-role="submit">Create Account</div>
        </div>
        <div class="m-t-20x font-size-sm text-center">or sign up with:</div>
        <div class="p-a-20x flex flex-spaceAround">
            <div href="#" class="iconfont icon-facebook btn-facebook" id="facebookLogin"></div>
            <div href="#" class="iconfont icon-google btn-google" id="googleLogin"></div>
        </div>
        <div class="m-t-20x text-primary text-center font-size-sm"><a href="/contactus">Contact Us</a></div>
    </section>
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
</div>s
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>

<script src="/scripts/vendor.js"></script>
<script src="/scripts/register.js"></script>
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
