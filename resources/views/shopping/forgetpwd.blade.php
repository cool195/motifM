<!DOCTYPE html>
<html lang="en">
<head>

    <title>RESET PASSWORD</title>
    @include('head')
    <link rel="stylesheet" href="/styles/resetPassword.css">

    <link rel="stylesheet" href="/styles/remodal.css">

</head>
<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="resetPwd-container p-t-20x">
    <section class="resetPwd-content m-t-10x p-y-20x reserve-height">
        <form id="reset" action="">
            <fieldset>
                <a href="/daily">
                    <div class="p-b-20x"><img src="/images/login/register-logo.png" srcset="/images/login/register-logo@2x.png 2x,/images/login/register-logo@3x.png 3x"></div>
                </a>
                <div class="text-main m-t-10x"><strong>Reset Password</strong></div>
                <div class="text-primary text-left m-t-15x font-size-sm">You will use the new password to login to your
                    Motif account.
                </div>
            </fieldset>
            <div class="warning-info text-warning font-size-sm flex flex-alignCenter text-left p-x-15x m-y-10x hidden-xs-up">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                <span></span>
            </div>
            <fieldset>
                <div class="m-t-10x">
                    <input class="input-resetPwd form-control font-size-sm" placeholder="New Password(6 characters min)"
                           maxlength="32" type="password" name="pw">
                </div>
                <div class="m-t-10x">
                    <input class="input-resetPwd form-control font-size-sm" placeholder="Confirm New Password"
                           maxlength="32" type="password" name="lastpw">
                    <input type="hidden" name="tp" value="{{$params['tp']}}">
                    <input type="hidden" name="sig" value="{{$params['sig']}}">
                </div>
                <div class="m-t-20x">
                    <div class="btn btn-primary btn-block disabled" data-role="submit">Reset Password</div>
                </div>
            </fieldset>
            <div class="text-primary font-size-sm contactUs">
                <a href="/contactus">Contact Us</a>
            </div>
        </form>
    </section>
</div>
<!-- 提示成功修改密码 -->
<div class="remodal remodal-lg modal-content" data-remodal-id="changePwd-modal" id="changePwdDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <span class="font-size-base">Password Reset Complete!</span>
        <br>Please sign in again!
    </div>
    <hr class="hr-base m-a-0">
    <div class="btn-group flex">
        <a href="" class="btn remodal-btn flex-width text-primary" id="confirmPwd">OK</a>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

</body>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/forgetPassword.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
