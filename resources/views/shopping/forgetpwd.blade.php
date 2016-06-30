<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Reset Password</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/resetPassword.css">

    <link rel="stylesheet" href="/styles/remodal.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

    <script src="/scripts/vendor/template-native.js"></script>

</head>
<body>
@include('check.tagmanager')
<!-- 主体内容 -->
<div class="resetPwd-container p-t-20x">
    <section class="resetPwd-content m-t-10x p-y-20x">
        <form id="reset" action="">
            <fieldset>
                <div class="p-b-20x"><img src="/images/login/register-logo.png" srcset="/images/login/register-logo@2x.png 2x,/images/login/register-logo@3x.png 3x">
                </div>
                <div class="text-main m-t-10x"><strong>Reset Password</strong></div>
                <div class="text-primary text-left m-t-15x font-size-sm">You will use the new password to login to your MOTIF account.
                </div>
            </fieldset>
            <fieldset>
                <div class="m-t-10x">
                    <input class="input-resetPwd form-control font-size-sm" placeholder="New Password(6 characters min)" type="password" name="pw">
                </div>
                <div class="m-t-10x">
                    <input class="input-resetPwd form-control font-size-sm" placeholder="Confirm New Password" type="password" name="lastpw">
                    <input type="hidden" name="tp" value="{{$params['tp']}}">
                    <input type="hidden" name="sig" value="{{$params['sig']}}">
                </div>
                <div class="m-t-20x">
                    <div class="btn btn-primary btn-block" id="send">Reset Password</div>
                </div>
            </fieldset>
            <div class="text-primary font-size-sm contactUs">
                <a href="/contactus">Contact Us</a>
            </div>
        </form>
    </section>

</div>

</body>
<script src="/scripts/vendor.js"></script>
<script>
    $('#send').click(function(){
        $.ajax({
            type: "POST",
            url : "/forgetpwd",
            data : $('#reset').serialize(),
            success : function(data){
                if(data.success){
                    alert(data.prompt_msg);
                    window.location.href = data.redirectUrl;
                }else{
                    alert(data.error_msg);
                }
            }
        })
    });
</script>
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
