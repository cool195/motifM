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
            <div class="pageview shipping-review active" id="shipping-review" data-pay="{{$payStatus}}">
                <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                    <span class="p-x-15x"><a class="text-primary"
                                             href="/checkout/shipping?from=review">SHIPPING</a></span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x"><a class="text-primary" href="/checkout/payment">PAYMENT</a></span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x active"><a class="text-primary" href="/checkout/review">CONFIRMATION</a></span>
                </div>
                <hr class="hr-light m-a-0">

                <!-- 总价 + place order 按钮 -->
                <div class="p-y-20x p-x-15x">
                    <div class="text-center text-primary font-size-sm"><strong>ORDER TOTAL:
                            ${{number_format(($checkInfo['pay_amount'] / 100), 2)}}</strong></div>
                    <div class="p-t-10x submit-placeOrder">
                        <div class="btn btn-primary btn-block submit-checkout"
                             data-clkurl='{{ config('app.clk_url') }}/log.gif?t=check.100002&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&ref=&v={"skipType":"placeorder","skipId":"","version":"1.0.1","ver":"9.2","src":"H5"}'>@if(Session::get('user.checkout.paywith.pay_method')=='PayPalNative'){{'Pay with PayPal'}}@else{{'Place Order'}}@endif</div>
                    </div>
                </div>
                <hr class="hr-base m-a-0">

                <!-- ship to -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SHIP TO</strong></span>
                        <a class="text-underLine pull-right text-primary" href="/checkout/address?from=review"
                           id="review-editShipTo">Edit</a>
                    </div>
                    <div class="">
                        <span>{{Session::get('user.checkout.address.name')}}</span><br>
                        <span>{{Session::get('user.checkout.address.detail_address1')}} {{Session::get('user.checkout.address.detail_address2')}}</span><br>
                        <span>{{Session::get('user.checkout.address.city')}} {{Session::get('user.checkout.address.state')}}</span><br>
                        <span>{{Session::get('user.checkout.address.country')}}</span><br>
                        <span>{{Session::get('user.checkout.address.telephone')}}</span>
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- shipping method -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SHIPPING METHOD</strong></span>
                        @if(count(Session::get('user.checkout.shipping'))>1)
                            <a class="text-underLine pull-right text-primary" href="/checkout/shipping?from=review"
                               id="review-method">Edit</a>
                        @endif
                    </div>
                    <div class="">
                        {{Session::get('user.checkout.selship.logistics_name')}} @if(Session::get('user.checkout.selship.pay_price')>0)
                            ${{number_format((Session::get('user.checkout.selship.pay_price') / 100), 2)}}@endif
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
                        @if(Session::get('user.checkout.paywith.pay_method')=='PayPalNative')
                            <span>Method:</span>
                            <span class="p-l-10x"><img
                                        src="{{env('CDN_Static')}}/images/payment/icon-paypal2-color.png{{'?v='.config('app.version')}}"
                                        srcset="{{env('CDN_Static')}}/images/payment/icon-paypal2-color@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-paypal2-color@3x.png{{'?v='.config('app.version')}} 3x"
                                        alt=""></span>
                            <br>
                        @else
                            <span>{{Session::get('user.checkout.paywith.withCard.card_number')}}</span>
                            @if(Session::get('user.checkout.paywith.withCard.card_type')=='Visa')
                                <span class="p-l-10x"><img
                                            src="{{env('CDN_Static')}}/images/payment/icon-visa.png{{'?v='.config('app.version')}}"
                                            srcset="{{env('CDN_Static')}}/images/payment/icon-visa@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-visa@3x.png{{'?v='.config('app.version')}} 3x"
                                            alt=""></span>
                            @elseif(Session::get('user.checkout.paywith.withCard.card_type')=='MasterCard')
                                <span class="p-l-10x"><img
                                            src="{{env('CDN_Static')}}/images/payment/icon-mastercard.png{{'?v='.config('app.version')}}"
                                            srcset="{{env('CDN_Static')}}/images/payment/icon-mastercard@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-mastercard@3x.png{{'?v='.config('app.version')}} 3x"
                                            alt=""></span>
                            @elseif(Session::get('user.checkout.paywith.withCard.card_type')=='AmericanExpress')
                                <span class="p-l-10x"><img
                                            src="{{env('CDN_Static')}}/images/payment/icon-americanexpress.png{{'?v='.config('app.version')}}"
                                            srcset="{{env('CDN_Static')}}/images/payment/icon-americanexpress@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-americanexpress@3x.png{{'?v='.config('app.version')}} 3x"
                                            alt=""></span>
                            @elseif(Session::get('user.checkout.paywith.withCard.card_type')=='JCB')
                                <span class="p-l-10x"><img
                                            src="{{env('CDN_Static')}}/images/payment/icon-jcb.png{{'?v='.config('app.version')}}"
                                            srcset="{{env('CDN_Static')}}/images/payment/icon-jcb@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-jcb@3x.png{{'?v='.config('app.version')}} 3x"
                                            alt=""></span>
                            @endif
                            <br>
                            <span>Exp {{Session::get('user.checkout.paywith.withCard.month').'/'.Session::get('user.checkout.paywith.withCard.year')}}</span>
                            <br>
                        @endif
                        @if(Session::get('user.checkout.couponInfo'))
                            <span>Promotion code: {{Session::get('user.checkout.couponInfo.cp_title')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- special request -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="p-b-5x">
                        <span><strong>SPECIAL REQUEST</strong></span>
                    </div>
                    <div class="" id="review-special">
                        <span class="request text-common">Optional</span>
                        <span class="pull-right"><i
                                    class="iconfont icon-arrow-right icon-size-xm text-common"></i></span>
                    </div>
                </div>
                <div class="hr-between"></div>

                <!-- 价格汇总 -->
                <div class="p-y-10x p-x-15x font-size-sm text-primary">
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Items ({{$checkInfo['total_sku_qtty']}}
                            )</span><span>${{number_format(($checkInfo['total_amount'] / 100), 2)}}</span>
                    </div>

                    {{--增值服务--}}
                    @if($checkInfo['vas_amount'] > 0)
                        <div class="flex flex-fullJustified text-primary font-size-sm">
                            <span>Additional services:</span><span>${{number_format(($checkInfo['vas_amount'] / 100), 2)}}</span>
                        </div>
                    @endif

                    {{--优惠--}}
                    @if($checkInfo['cps_amount'] > 0)
                        <div class="flex flex-fullJustified text-primary font-size-sm">
                            <span>Promotion code</span><span>-${{number_format(($checkInfo['cps_amount'] / 100), 2)}}</span>
                        </div>
                    @endif

                    {{--折扣--}}
                    @if($checkInfo['promot_discount_amount'] > 0)
                        <div class="flex flex-fullJustified text-primary font-size-sm">
                            <span>Discount</span><span>-${{number_format(($checkInfo['promot_discount_amount'] / 100), 2)}}</span>
                        </div>
                    @endif

                    {{--收税提示--}}
                    @if($checkInfo['tax_amount'])
                        <div class="flex flex-fullJustified text-primary font-size-sm">
                            <span>Sales tax </span><span>${{ number_format(($checkInfo['tax_amount'] / 100), 2)}}</span>
                        </div>
                    @endif

                    {{--地址服务--}}
                    @if(!empty(Session::get('user.checkout.selship')))
                        <div class="flex flex-fullJustified text-primary font-size-sm">
                            <span>Shipping and handling</span><span>@if(0 == $checkInfo['freight_amount']) Free @else
                                    ${{ number_format(($checkInfo['freight_amount'] / 100), 2)}} @endif</span>
                        </div>
                    @endif

                </div>
                <hr class="hr-base m-a-0">

                <!-- 总价 + place order 按钮 -->
                <div class="p-y-20x p-x-15x">
                    <div class="text-center text-primary font-size-sm"><strong>ORDER TOTAL:
                            ${{number_format(($checkInfo['pay_amount'] / 100), 2)}}</strong></div>
                    <div class="p-t-10x submit-placeOrder">
                        <div class="btn btn-primary btn-block submit-checkout"
                             data-clkurl='{{ config('app.clk_url') }}/log.gif?t=check.100002&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&ref=&v={"skipType":"placeorder","skipId":"","version":"1.0.1","ver":"9.2","src":"H5"}'>@if(Session::get('user.checkout.paywith.pay_method')=='PayPalNative'){{'Pay with PayPal'}}@else{{'Place Order'}}@endif</div>
                    </div>
                </div>
                <hr class="hr-base m-a-0">

            </div>

            <!-- 3.SPECIAL REQUEST -->
            <div class="pageview shipping-request" id="shipping-request">
                <section class="m-b-20x reserve-height">
                    <article class="font-size-md text-main p-a-10x bg-title"><strong>Special Request</strong></article>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="message-info">
                            <textarea class="form-control form-control-block p-a-15x font-size-sm" name="remark"
                                      id="messageContent" placeholder="Special Note" rows="12"
                                      data-length="1000"></textarea>
                            <span class="message-wordNumber font-size-sm text-primary"><span id="wordNum">0</span>/1000</span>
                        </div>
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <div class="p-a-15x">
                        <button class="btn btn-primary btn-block" id="btn-addSpecial">Save</button>
                    </div>
                </section>
            </div>
            <!-- loading -->
            <div class="loading loading-screen loading-switch loading-hidden" id="loading">
                <div class="loader loader-screen"></div>
            </div>

            <!-- 弹出提示 -->
            <div class="loading loading-screen loading-switch loading-hidden" id="checkout-failure">
                <div class="loading-modal">
                    <div class="text-white font-size-md text-center m-t-10x">There was a problem validating your
                        payment. Please verify all payment details and try placing your order again. Thank you.
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/checkout.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
