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
            <!-- 1.SHIPPING -->
            <!-- 1.SHIPPING SHIPTO/METHOD-->
            <div class="pageview shipping-shipTo active" id="shipping-shipTo">
                <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                    <span class="p-x-15x active">1.SHIPPING</span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">2.PAYMENT</span><strong><i class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">3.REVIEW</span>
                </div>
                <hr class="hr-light m-a-0">
                <!-- ship to -->
                <div class="text-primary">
                    <div class="p-y-10x p-x-15x font-size-sm"><strong>SHIP TO</strong></div>
                    <hr class="hr-base m-a-0">
                    <div class="p-y-10x p-x-15x font-size-sm flex flex-alignCenter flex-fullJustified">
                        <div class="">
                            <span>{{Session::get('user.checkout.address.name')}}</span><br>
                            <span>{{Session::get('user.checkout.address.detail_address1')}} {{Session::get('user.checkout.address.detail_address2')}}</span><br>
                            <span>{{Session::get('user.checkout.address.city')}} {{Session::get('user.checkout.address.state')}} {{Session::get('user.checkout.address.zip')}}</span><br>
                            <span>{{Session::get('user.checkout.address.country')}}</span><br>
                            <span>{{Session::get('user.checkout.address.telephone')}}</span>
                        </div>
                        <a class="text-underLine text-primary" href="/checkout/address" id="edit-shipTp">Edit</a>
                    </div>
                    <hr class="hr-base m-a-0">
                </div>
                <!-- shipping method -->
                <div class="text-primary choose-method">
                    <div class="p-y-10x p-x-15x font-size-sm"><strong>SHIPPING METHOD</strong></div>
                    <hr class="hr-base m-a-0">
                    <div>
                        @foreach(Session::get('user.checkout.shipping') as $value)
                            <div class="p-a-15x font-size-sm flex flex-alignCenter flex-fullJustified method-item @if(Session::get('user.checkout.selship.logistics_type')==$value['logistics_type']) active @endif" data-type="{{$value['logistics_type']}}">
                                <span>{{$value['logistics_name']}} @if($value['pay_price']>0)${{number_format(($value['pay_price'] / 100), 2)}}@endif</span>
                                <i class="iconfont icon-check icon-size-base" data-type="{{$value['logistics_type']}}"></i>
                            </div>
                            <hr class="hr-base m-a-0">
                        @endforeach
                    </div>
                    <!-- Continue 按钮 -->
                    <div class="p-a-15x submit-shipping">
                        <div class="btn btn-primary btn-block" data-url="{{$continueUrl}}" id="submit-shipping">Continue</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/Checkout.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
