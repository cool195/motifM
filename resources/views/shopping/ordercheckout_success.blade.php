<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Checkout Confirm</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
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
            <!-- 订单结算确认信息 -->
            <section>
                <article class="bg-white m-b-10x p-a-15x text-center">
                    <h5 class="font-size-lx text-primary p-t-5x m-b-20x">Order Comfirmed</h5>
                    <div class="font-size-sm text-primary p-t-5x">A confirmation email has been sent to:</div>
                    <div class="font-size-sm text-primary m-b-20x"><strong>{{Session::get('user.login_email')}}</strong></div>
                    <p class="font-size-xs text-common m-b-15x p-t-10x">You can track <a href="/order/orderlist" class="text-primary text-underLine">your
                                                                                                                             order</a>
                                                                        at any time by visting the Order tab from the
                                                                        PROFILE
                                                                        menu
                    </p>
                    <a href="/shopping" class="btn btn-primary btn-block btn-sm" type="submit">Continue Shopping</a>
                </article>
            </section>

            <!-- 页脚 功能链接 -->
           @include('footer')
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
@include('global')
</html>
