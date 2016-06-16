<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Payment Methods</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="styles/vendor.css">


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
    <!-- 支付方式 列表 -->
        <section>
            <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter">
                <span class="font-size-md text-main"><strong>Payment Methods</strong></span>
                <a class="btn btn-primary-outline btn-sm" href="#">Edit</a>
                <!-- 修改状态 -->
                <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
            </article>
            <!-- 支付方式列表 list -->

            <!-- 已绑定PayPal支付方式 状态 -->
            @if(!empty($methodlist['PayPal']))
                @foreach($methodlist['PayPal'] as $value)
                    <aside class="bg-white m-b-10x">
                        <div class="flex flex-alignCenter font-size-sm text-primary p-y-10x p-x-15x">
                            <div class="p-r-15x"><i class="iconfont icon-delete icon-size-md text-warning"></i></div>
                            <div class="font-size-sm text-primary">
                                <span class="p-r-15x">
                                    <img src="images/payment/icon-Paypal.png"
                                         srcset="/images/payment/icon-Paypal@2x.png 2x,/images/payment/icon-Paypal@3x.png 3x"
                                         alt=""></span>
                                <span>{{$value['showName']}}</span></div>
                        </div>
                    </aside>
                @endforeach
            @else
            <!-- 没有绑定PayPal支付方式 状态 -->
                <aside class="bg-white m-b-10x">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x"
                         id="paypal" data-braintree="{{$token}}">
                        <div class="font-size-sm text-primary">
                        <span class="p-r-15x">
                            <img src="images/payment/icon-Paypal.png"
                                 srcset="/images/payment/icon-Paypal@2x.png 2x,/images/payment/icon-Paypal@3x.png 3x"
                                 alt=""></span>
                            <span>Paypal</span></div>
                        <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                    </div>
                </aside>
            @endif
        <!-- 已绑定信用卡支付方式 状态 -->
            @if(!empty($methodlist['Card']))
                <aside class="bg-white m-b-10x">
                    @foreach($methodlist['Card'] as $value)
                        <div class="flex flex-alignCenter font-size-sm text-primary p-a-15x">
                            <div class="p-r-15x"><i class="iconfont icon-delete icon-size-md text-warning"></i></div>
                            <div class="flex flex-alignCenter">
                                <span class="cardImage-inline {{array_get($methodlist['cardlist'],$value['cardType'])}}"></span>
                                <span class="m-l-10x">{{$value['showName']}}</span>
                            </div>
                        </div>
                    @endforeach
                    <hr class="hr-base m-a-0">
                    <div class="bg-white">
                        <a class="flex flex-alignCenter text-primary p-a-15x" href="#">
                            <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                            <span class="font-size-sm">Add a New Card</span>
                        </a>
                    </div>
                </aside>
            @else
            <!-- 没有绑定信用卡支付方式 状态 -->
                <aside class="bg-white m-b-10x">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x"
                       href="#">
                        <div class="font-size-sm text-primary">
                        <span class="p-r-15x"><img src="/images/payment/icon-card.png"
                                                   srcset="/images/payment/icon-card@2x.png 2x,/images/payment/icon-card@3x.png 3x"
                                                   alt=""></span>
                            <span>Direct debit/credit card</span></div>
                        <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                    </a>
                </aside>
            @endif
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<!-- BrainTree -->
<script src="/scripts/braintree-2.24.1.min.js"></script>

<script src="/scripts/vendor.js"></script>

<script src="/scripts/paymentMethod-paypal.js"></script>

</html>
