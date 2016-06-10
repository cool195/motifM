<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Register</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/register.css">

    <link rel="stylesheet" href="/styles/remodal.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

    <script src="/scripts/vendor/template-native.js"></script>

</head>

<body>
    <!-- 主体内容 -->
    <div class="register-container">
        <section class="register-content p-y-20x">
            <!-- 顶部 logo -->
            <img class="img-fluid m-x-auto m-b-20x" src="/images/login/register-logo.png" srcset="/images/login/register-logo@2x.png 2x,/images/login/register-logo@3x.png 3x">

            <div class="text-main text-center p-t-10x"><strong>Create An Account</strong></div>
            <div class="text-warning font-size-sm flex flex-alignCenter text-left p-t-20x m-b-10x">
                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                Sorry, this email has already been registered.
            </div>
            <form id="register">
                <fieldset class="register-input m-b-10x">
                    <input class="input-register form-control font-size-sm" name="nick" placeholder="Your Name" type="text">
                    <i class="iconfont icon-delete icon-size-md input-clear text-common"></i>
                </fieldset>
                <fieldset class="register-input m-b-10x">
                    <input class="input-register form-control font-size-sm" name="email" placeholder="Email" type="text">
                    <i class="iconfont icon-delete icon-size-md input-clear text-common"></i>
                </fieldset>
                <fieldset class="register-input m-b-10x">
                    <input class="input-register form-control font-size-sm" name="pw" placeholder="Password" type="text">
                    <i class="iconfont icon-show icon-size-md input-show text-common"></i>
                </fieldset>
            </form>
            <div class="m-t-15x text-primary text-center font-size-sm">
                By registering,You’ve read and accepted our<br>
                <a class="text-primary text-underLine" href="">User Agreement</a>
            </div>
            <div class="m-t-20x">
                <!-- TODO 需要加disabled 样式 -->
                <div class="btn btn-primary btn-block" data-role="submit">Create an account</div>
            </div>
            <div class="m-t-20x font-size-sm text-center">or sign up with:</div>
            <div class="p-a-20x flex flex-spaceAround">
                <a href="#" class="iconfont icon-facebook btn-facebook"></a>
                <a href="#" class="iconfont icon-google btn-google"></a>
            </div>
            <div class="m-t-20x text-primary text-center font-size-sm"><a href="#">Contact Us</a></div>
        </section>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/register.js"></script>
</html>
