<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Email</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/resetPassword.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js{{'?v='.config('app.version')}}"></script>

</head>

<body>
    <!-- 主体内容 -->
    <div class="resetPwd-container p-t-20x">
        <section class="resetPwd-content m-t-10x p-y-20x">
            <form id="register">
                <fieldset>
                    <div class="p-b-20x"><img src="{{env('CDN_Static')}}/images/login/register-logo.png" srcset="{{env('CDN_Static')}}/images/login/register-logo@2x.png 2x,{{env('CDN_Static')}}/images/login/register-logo@3x.png 3x">
                    </div>
                    <div class="text-main m-t-10x"><strong>Add Email</strong></div>
                    <div class="text-primary text-left m-t-15x font-size-sm">
                        Enter the email address associated with your Motif account, then click Continue.
                    </div>
                </fieldset>
                <fieldset>
                    <div class="warning-info text-warning flex flex-alignCenter text-left m-t-15x hidden-xs-up">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i><span class="font-size-xs">Sorry, this email has already been registered.</span>
                    </div>
                    <div class="m-t-10x">
                        <input class="input-resetPwd form-control font-size-sm" placeholder="Please enter your email address" type="email" name="email">
                    </div>
                    <div class="m-t-20x">
                        <div class="btn btn-primary btn-block" data-role="submit">Continue</div>
                    </div>
                </fieldset>
                <div class="text-primary font-size-sm contactUs">
                    <a href="/contactus">Contact Us</a>
                </div>
                <input type="hidden" name="id" value="{{$params['id']}}">
                <input type="hidden" name="name" value="{{$params['name']}}">
                <input type="hidden" name="avatar" value="{{$params['avatar']}}">
            </form>
        </section>
    </div>

    <!-- 提示添加成功 -->
    <div class="remodal remodal-md modal-content" data-remodal-id="question-modal" id="successModal">
        <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
            <div class="font-size-base">Register Success!</div>
            <div class="p-t-5x">You will Register Success. </div>
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

<script src="{{env('CDN_Static')}}/scripts/registerAddEmial.js{{'?v='.config('app.version')}}"></script>

</html>
