<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Setting</title>
    @include('head')
    <script src="{{env('CDN_Static')}}/scripts/vendor/fastclick.js{{'?v='.config('app.version')}}"></script>

</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
        <section class="reserve-height">
            <article class="p-x-15x p-y-10x font-size-md text-main bg-title"><strong>Settings</strong></article>
            <hr class="hr-base m-a-0">

            <!-- 个人中心 sitting list -->
            <aside class="bg-white m-b-20x">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                   href="/user/changeprofile">
                    <span>Edit Profile</span>
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
                @if(1 == Session::get('user.login_type'))
                    <hr class="hr-base m-a-0">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                       href="/user/changepassword">
                        <span>Change Password</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                @endif
                <hr class="hr-base m-a-0">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                   href="/user/shippingaddress">
                    <span>Shipping Address</span>
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
                <hr class="hr-base m-a-0">
                {{--                    <hr class="hr-base m-a-0">
                                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/braintree">
                                        <span>Payment Method</span>
                                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                    </a>--}}
            </aside>
        </section>
        <!-- 页脚 功能链接 start-->
    @include('footer')
    <!-- 页脚 功能链接  end-->
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
