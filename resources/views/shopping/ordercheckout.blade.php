<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Order Checkout</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/orderCheckout.css">

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
            <!-- 结算 商品列表 -->
            <section class="">
                <!-- 商品列表 -->
                <aside class="checkoutList bg-white m-b-10x">
                    @foreach($data['showSkus'] as $showSku)
                    <div class="checkoutList-item p-a-10x">
                        <div class="flex">
                            <div class="flex-fixedShrink">
                                <img class="img-thumbnail" src="{{'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$showSku['main_image_url']}}" width="70px" height="70px">
                            </div>
                            <div class="p-l-10x flex-width">
                                <article class="flex flex-fullJustified">
                                    <h6 class="text-main font-size-md p-r-10x">
                                        <strong>{{$showSku['main_title']}}</strong>
                                    </h6>
                                    <span class="text-primary font-size-sm flex-fixedShrink">${{ number_format(($showSku['sale_price'] / 100), 2) }}</span>
                                </article>
                                <aside class="checkoutItem-secondaryInfo p-b-10x text-primary font-size-sm">
                                    @if(!empty($showSku['attrValues']))
                                        @foreach($showSku['attrValues'] as $attrValue)
                                            <div><span>{{$attrValue['attr_type_value'] }}: </span><span>{{ $attrValue['attr_value'] }}}</span></div>
                                        @endforeach
                                    @endif
                                    <div class="flex flex-fullJustified">
                                        <div class="">
                                            <span>Inside Engraving: </span><span>MY LOVE</span></div>
                                        <div class="">${{$showSku['cps_amount']}}</div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                        <div class="flex flex-rightJustify p-t-10x text-primary font-size-sm">
                            <span>x&nbsp;{{$showSku['sale_qtty']}}</span>
                        </div>
                    </div>
                    @endforeach
                </aside>
                <!-- 结算订单 地址、物流、支付等其他信息 -->
                <aside class="bg-white m-b-10x">
                    <a class="flex font-size-sm text-primary p-a-10x" href="/shopping/cart/addresslist">
                        <span class="checkoutInfo-subTitle flex-fixedShrink">Ships to</span>
                        <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                            <div>
                                <div>{{$addr['email']}}</div>
                                <div>{{$addr['detail_address1']}}</div>
                                <div>{{$addr['city']}}, {{$addr['zip']}} {{$addr['status_code']}}</div>
                                <div>{{$addr['country']}}</div>
                            </div>
                            <input hidden name="aid" value="{{$addr['receiving_id']}}"></input>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                        </div>
                    </a>
                    <hr class="hr-base">
                    <a class="flex font-size-sm text-primary p-a-10x" href="#">
                        <span class="checkoutInfo-subTitle flex-fixedShrink">Delivery</span>
                        <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                            <span>7-20 working days +14.5$</span>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                        </div>
                    </a>
                    <hr class="hr-base">
                    <a class="flex font-size-sm text-primary p-a-10x" href="#">
                        <span class="checkoutInfo-subTitle flex-fixedShrink">Pay with</span>
                        <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                            <span>{{$pay['cardType']}}</span>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                        </div>
                    </a>
                    <hr class="hr-base">
                    <a class="flex font-size-sm text-primary p-a-10x" href="/shopping/cart/coupon">
                        <span class="checkoutInfo-subTitle flex-fixedShrink">Gift Cards, Coupons</span>
                        <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                            <span>YY365</span>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                        </div>
                    </a>
                    <hr class="hr-base">
                    <a class="flex font-size-sm text-primary p-a-10x" href="/shopping/cart/message">
                        <span class="checkoutInfo-subTitle flex-fixedShrink">Message to Us</span>
                        <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                            <span class="text-truncate">My father was a self-taught mandolin self-taught mandolin</span>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x flex-fixedShrink"></i>
                        </div>
                    </a>
                </aside>

                <!-- 结算总价 -->
                <aside class="bg-white p-a-10x m-b-10x">
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Items({{$data['total_sku_qtty']}})</span><span>${{ number_format(($data['total_amount'] / 100), 2)}}</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Extra</span><span>${{number_format(($data['vas_amount'] / 100), 2)}}</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Shipping to 10000</span><span>${{ number_format(($data['freight_amount'] / 100), 2)}}</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Discount</span><span>20%</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Coupon</span><span>-${{$data['promot_discount_amount'] / 100}}</span>
                    </div>
                    <div class="flex flex-fullJustified p-t-10x text-primary font-size-sm">
                        <span><strong>Order Total</strong></span><span><strong>${{ number_format(($data['pay_amount'] / 100), 2)}}</strong></span>
                    </div>
                </aside>

                <!-- 结算按钮 -->
                <aside class="bg-white m-t-10x p-a-10x">
                    <a href="#" class="btn btn-primary btn-block btn-sm" type="submit">Place Order</a>
                </aside>
            </section>
<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout.js"></script>

</html>
