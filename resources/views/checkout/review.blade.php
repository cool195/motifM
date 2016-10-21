<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet"
          href="{{env('CDN_Static')}}/styles/profileSetting-addAddress.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet"
          href="{{env('CDN_Static')}}/styles/orderCheckout-addressList.css{{'?v='.config('app.version')}}">
</head>
<body>
@include('check.tagmanager')

        <!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
            <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator', ['pageScope'=>true])

        <div class="checkout-container">
            <!-- 3.REVIEW -->
            <div class="pageview shipping-review active" id="shipping-review">
                <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                    <span class="p-x-15x">1.SHIPPING</span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">2.PAYMENT</span><strong><i class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x active">3.REVIEW</span>
                </div>
                <hr class="hr-light m-a-0">

                <!-- 总价 + place order 按钮 -->
                <div class="p-y-20x p-x-15x">
                    <div class="text-center text-primary font-size-sm"><strong>ORDER TOTAL: $48.67</strong></div>
                    <div class="p-t-10x submit-placeOrder">
                        <div class="btn btn-primary btn-block" id="submit-shipping">Continue</div>
                    </div>
                </div>
                <hr class="hr-base m-a-0">

                <!-- ship to -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SHIP TO</strong></span>
                        <a class="text-underLine pull-right text-primary" href="/checkout/shipping" id="review-editShipTo">Edit</a>
                    </div>
                    <div class="">
                        <span>Ming</span><br>
                        <span>Beijing chao yang</span><br>
                        <span>Beijing, AK 10000</span><br>
                        <span>China</span><br>
                        <span>130 2784 8900</span>
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- shipping method -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SHIPPING METHOD</strong></span>
                        <a class="text-underLine pull-right text-primary" href="/checkout/shipping" id="review-method">Edit</a>
                    </div>
                    <div class="">
                        Expedited Shipping / 3-4 business days $20.00
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- payment method -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>PAYMENT METHOD</strong></span>
                        <a class="text-underLine pull-right text-primary" href="/checkout/payment" id="review-payment">Edit</a>
                    </div>
                    <div class="">
                        <span>Card: 6202 *** *** *** 1203</span><br>
                        <span>Exp: 12/19</span><br>
                        <span>Promotion code: 20% OFF</span>
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- special request -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SPECIAL REQUEST</strong></span>
                    </div>
                    <div class="" id="review-special">
                        <span>Optional</span>
                        <span class="pull-right"><i class="iconfont icon-arrow-right icon-size-xm"></i></span>
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- 价格汇总 -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Items(1)</span><span>$45.00</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Promotion code</span><span>-$9.00</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Shipping and handling</span><span>$10.00 </span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Tax</span><span>$0.00 </span>
                    </div>
                </div>
                <hr class="hr-base m-a-0">

                <!-- 总价 + place order 按钮 -->
                <div class="p-y-20x p-x-15x">
                    <div class="text-center text-primary font-size-sm"><strong>ORDER TOTAL: $48.67</strong></div>
                    <div class="p-t-10x submit-placeOrder">
                        <div class="btn btn-primary btn-block" id="submit-shipping">Continue</div>
                    </div>
                </div>
                <hr class="hr-base m-a-0">

            </div>
        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addressList.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
