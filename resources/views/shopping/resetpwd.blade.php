<!DOCTYPE html>
<html lang="en">
<head>

    <title>Reset Password</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/resetPassword.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js{{'?v='.config('app.version')}}"></script>

</head>
<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="resetPwd-container p-t-20x">
    <section class="resetPwd-content m-t-10x p-y-20x">
        <form id="reset">
            <fieldset>
                <a href="/daily">
                    <div class="p-b-20x"><img src="{{env('CDN_Static')}}/images/login/register-logo.png" srcset="{{env('CDN_Static')}}/images/login/register-logo@2x.png 2x,{{env('CDN_Static')}}/images/login/register-logo@3x.png 3x"></div>
                </a>
                <div class="text-main m-t-10x"><strong>Forgot Password</strong></div>
                <div class="text-primary text-left m-t-15x font-size-sm">Enter the email address associated with
                    your Motif account, then click Continue. We'll send you a link to reset your password.
                </div>
            </fieldset>
            <fieldset>
                <div class="warning-info text-warning flex flex-alignCenter text-left m-t-15x hidden-xs-up">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i><span class="font-size-xs">Sorry, this email has not been registered.</span>
                </div>
                <div class="m-t-10x">
                    <input class="input-resetPwd form-control font-size-sm" placeholder="Your Email" type="text" name="email">
                </div>
                <div class="m-t-20x">
                    <div class="btn btn-primary btn-block disabled" data-role="submit">Continue</div>
                </div>
            </fieldset>
            <div class="text-primary font-size-sm contactUs">
                <a href="/contactus">Contact Us</a>
            </div>
        </form>
    </section>

</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

<!-- 提示添加成功 -->
<div class="remodal remodal-md modal-content" data-remodal-id="question-modal" id="successModal">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <div class="font-size-base">Check Your Email</div>
        <div class="p-t-5x">You will receive an email from us shortly. If you haven't received our email, please check your spam folder or contact our Customer Support team. </div>
    </div>
    <hr class="hr-base m-a-0">
    <div class="btn-group flex">
        <a href="" class="btn remodal-btn flex-width text-primary" id="confirm">OK</a>
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/resetPassword.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
