<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Profile Setting</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

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
            <section class="bg-minHeight">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Settings</strong></article>
                <!-- 个人中心 sitting list -->
                <aside class="bg-white m-b-20x">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/user/changeprofile">
                        <span>Change Profile</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                    <hr class="hr-base m-a-0">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/user/shippingaddress">
                        <span>Shipping Address</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                    <hr class="hr-base m-a-0">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/user/changepassword">
                        <span>Change Password</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                    <hr class="hr-base m-a-0">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/braintree">
                        <span>Payment Method</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                </aside>
            </section>
<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接  end-->
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
@include('global')
</html>
