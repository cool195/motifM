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
                <form id="infoForm" method="get" action="/cart/ordercheckout" method="get">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="cps" placeholder="Enter gift or coupon code" value="{{$cps}}">
                        <p class="text-center font-size-xs text-common p-t-10x">Gift cards and coupons can only be
                                                                                redeemed
                                                                                through
                                                                                PayPal.</p>
                        <div class="warning-info flex text-warning flex-alignCenter text-left p-a-15x" hidden>
                            <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                            <span class="font-size-sm">Invalid Coupon</span>
                        </div>
                    </fieldset>
                    <div class="navbar-fixed-bottom bg-white p-a-15x">
                        <div class="btn btn-primary btn-block btn-sm" data-role="submit">Continue</div>
                    </div>
                    @if(isset($input) && !empty($input))
                        @foreach($input as $name=>$value)
                            <input type="hidden" name="{{$name}}" value="{{$value}}">
                        @endforeach
                    @endif
                </form>
            </section>
        </div>
    </div>
    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout-addCoupon.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</html>
