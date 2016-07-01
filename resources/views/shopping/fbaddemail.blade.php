<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Email</title>
    @include('head')
    <link rel="stylesheet" href="/styles/resetPassword.css">
    <link rel="stylesheet" href="/styles/remodal.css">
    <script src="/scripts/vendor/template-native.js"></script>

</head>

<body>
    <!-- 主体内容 -->
    <div class="resetPwd-container p-t-20x">
        <section class="resetPwd-content m-t-10x p-y-20x">
            <form action="">
                <fieldset>
                    <div class="p-b-20x"><img src="/images/login/register-logo.png" srcset="/images/login/register-logo@2x.png 2x,/images/login/register-logo@3x.png 3x">
                    </div>
                    <div class="text-main m-t-10x"><strong>Reset Password</strong></div>
                    <div class="text-primary text-left m-t-15x font-size-sm">
                        Enter the email address associated with your Motif account, then click Continue. We'll send you a link to reset your password.
                    </div>
                </fieldset>
                <fieldset>
                    <div class="warning-info text-warning flex flex-alignCenter text-left m-t-15x hidden-xs-up">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i><span class="font-size-sm">Sorry, this email has already been registered.</span>
                    </div>
                    <div class="m-t-10x">
                        <input class="input-resetPwd form-control font-size-sm" placeholder="Please enter your email address" type="email" name="email">
                    </div>
                    <div class="m-t-20x">
                        <a class="btn btn-primary btn-block">Continue</a>
                    </div>
                </fieldset>
                <div class="text-primary font-size-sm contactUs">
                    <a href="#">Contact Us</a>
                </div>
            </form>
        </section>
    </div>
    <!-- success 效果 -->
    <div class="loading loading-screen loading-transprant loading-hidden" id="success">
        <div class="loading-modal">
            <div class="">
                <img class="img-fluid m-x-auto" src="/images/icon-success.png" srcset="/images/icon-success@2x.png 2x, /images/icon-success@3x.png 3x">
            </div>
            <div class="text-white font-size-md text-center m-t-10x" id="successText"></div>
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

</html>
