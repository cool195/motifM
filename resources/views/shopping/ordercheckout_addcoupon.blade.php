<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Add Coupon</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

</head>
<body>
    <!-- 外层容器 -->
    <div id="body-content">
        <!-- 展开的汉堡菜单 -->
        @include('nav')
        <!-- 主体内容 -->
        <div class="body-container">
            @include('navigator')
            <!-- 添加coupon -->
            <section class="m-b-20x">
                <form method="">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="text" placeholder="Enter gift or coupon code">
                        <p class="text-center font-size-xs text-common p-t-10x">Gift cards and coupons can only be
                                                                                redeemed
                                                                                through
                                                                                PayPal.</p>
                    </fieldset>

                    <div class="navbar-fixed-bottom bg-white p-a-15x">
                        <button class="btn btn-primary btn-block btn-sm" type="submit">Continue</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
</html>
