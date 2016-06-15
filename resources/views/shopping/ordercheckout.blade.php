<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
                @if(isset($data['showSkus']))
                    @foreach($data['showSkus'] as $showSku)
                        <div class="checkoutList-item p-a-10x">
                            <div class="flex">
                                <div class="flex-fixedShrink">
                                    <img class="img-thumbnail"
                                         src="{{'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$showSku['main_image_url']}}"
                                         width="70px" height="70px">
                                </div>
                                <div class="p-l-10x flex-width">
                                    <article class="flex flex-fullJustified">
                                        <h6 class="text-main font-size-md p-r-10x">
                                            <strong>{{$showSku['main_title']}}</strong>
                                        </h6>
                                        <span class="text-primary font-size-sm flex-fixedShrink">${{ number_format(($showSku['sale_price'] / 100), 2) }}</span>
                                    </article>
                                    <aside class="checkoutItem-secondaryInfo p-b-10x text-primary font-size-sm">
                                        @if(isset($showSku['attrValues']))
                                            @foreach($showSku['attrValues'] as $attrValue)
                                                <div><span>{{$attrValue['attr_type_value'] }}: </span><span>{{ $attrValue['attr_value'] }}</span></div>
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
                @endif
            </aside>
            <!-- 结算订单 地址、物流、支付等其他信息 -->
            <aside class="bg-white m-b-10x">
                {{--<a class="flex font-size-sm text-primary p-a-10x" href="/cart/addresslist">--}}
                <div class="flex font-size-sm text-primary p-a-10x" data-form-action="/cart/addresslist">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Ships to</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <div>
                            <div>{{$addr['email']}}</div>
                            <div>{{$addr['detail_address1']}}</div>
                            <div>{{$addr['city']}}, {{$addr['zip']}} {{$addr['status_code']}}</div>
                            <div>{{$addr['country']}}</div>
                        </div>
                        <input hidden name="aid" value="{{$addr['receiving_id']}}">
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                </div>
                <hr class="hr-base">
                <a class="flex font-size-sm text-primary p-a-10x" data-remodal-target="delivery-modal" href="#">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Delivery</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span class="delivery-text">7-20 working days +14.5$</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                </a>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-a-10x" data-form-action="2">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Pay with</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span>{{ (isset($paym) && !empty($paym)) ? $paym : "paypal"}}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-a-10x" data-form-action="/cart/coupon">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Gift Cards, Coupons</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span>{{ $cps }}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-a-10x" data-form-action="/cart/message">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Message to Us</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span class="text-truncate">{{$remark}}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x flex-fixedShrink"></i>
                    </div>
                </div>
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

<!-- 弹出 选择运送方式 Delivery -->
<div class="remodal remodal-lg modal-content" data-remodal-id="delivery-modal" id="deliveryDialog">
    <div class="text-right p-a-15x" data-remodal-action="close">
        <i class="iconfont icon-cross icon-size-md text-common"></i></div>
    <div class="font-size-sm">
        <hr class="hr-base m-a-0">
        <div class="p-a-15x flex flex-fullJustified flex-alignCenter btn-changeDelivery" data-dialog="Registered AirMail/7-20 working days $0.00">
            <span>Registered AirMail/7-20 working days $0.00</span>
            <span class="">
                <label class="iconfont icon-radio icon-size-md text-common m-b-0 active" for="delivery1"></label>
                <input type="radio" name="stype" value="1" id="delivery1" checked="checked" hidden>
            </span>
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-a-15x flex flex-fullJustified flex-alignCenter btn-changeDelivery" data-dialog="Standard/7-8 working days $14.50">
            <span>Standard/7-8 working days $14.50</span>
            <span class="">
                <label class="iconfont icon-radio icon-size-md text-common m-b-0" for="delivery2"></label>
                <input type="radio" name="stype" value="2" id="delivery2" hidden>
            </span>
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-a-15x flex flex-fullJustified flex-alignCenter btn-changeDelivery" data-dialog="Expedited/5-6 working days $25.66">
            <span>Expedited/5-6 working days $25.66</span>
            <span class="">
                <label class="iconfont icon-radio icon-size-md text-common m-b-0" for="delivery3"></label>
                <input type="radio" name="stype" value="3" id="delivery3" hidden>
            </span>
        </div>
    </div>
    <hr class="hr-base m-a-0">
    <div class="p-x-15x p-t-10x p-b-15x">
        <div class="btn btn-primary btn-block btn-md" data-dialog="" data-remodal-action="confirm">Change</div>
    </div>
</div>
<!-- 隐藏表单域 -->
<form id="infoForm" action="" hidden>
    <input type="hidden" name="aid" value="{{$addr['receiving_id']}}">
    @if(isset($input) && !empty($input))
        @foreach($input as $name=>$value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout.js"></script>

</html>
