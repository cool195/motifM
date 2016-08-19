<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">

</head>
<body>
<script type="text/javascript">
    function onCheckout() {
        dataLayer.push({
            'event': 'checkout',
            'ecommerce': {
                'checkout': {
                    'actionField': {'step': 1, 'total': '{{ number_format(($data['pay_amount'] / 100), 2)}}'},
                    'products': [
                            @foreach($data['showSkus'] as $showSku)
                        {
                        'name': '{{$showSku['main_title']}}',
                        'id': '{{$showSku['spu']}}',
                        'sku': '{{$showSku['sku']}}',
                        'price': '{{ number_format(($showSku['sale_price'] / 100), 2) }}',
                        'brand': 'Motif',
                        'category': '',
                        'variant': '',
                        'quantity': '{{$showSku['sale_qtty']}}'
                    },
                        @endforeach
                    ]
                }
            },
        });
    }
</script>
@include('check.tagmanager')

<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator', ['pageScope'=>true])
    <!-- 结算 商品列表 -->
        <section class="reserve-height">
            <!-- 商品列表 -->
            <aside class="checkoutList bg-white m-b-10x">
                @if(isset($data['showSkus']))
                    @foreach($data['showSkus'] as $showSku)
                        <div class="checkoutList-item p-a-10x">
                            <div class="flex">
                                <div class="flex-fixedShrink">
                                    <img class="img-thumbnail img-lazy" src="{{env('CDN_Static')}}/images/product/bg-product@70.png" data-original="{{env('APP_Api_Image').'/n2/'.$showSku['main_image_url']}}" width="70px" height="70px">
                                </div>
                                <div class="p-l-10x flex-width text-overflow">
                                    <article class="flex flex-fullJustified text-overflow">
                                        <h6 class="text-main font-size-md p-r-10x text-truncate">
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
                                        @if(isset($showSku['showVASes']) && !empty($showSku['showVASes']))
                                            @foreach($showSku['showVASes'] as $showVAS)
                                                <div class="flex flex-fullJustified">
                                                    <div>
                                                        <span>{{$showVAS['vas_name']}}: </span>
                                                        <span>{{$showVAS['user_remark']}} </span>
                                                    </div>
                                                    <div>${{number_format(($showVAS['vas_price'] / 100), 2)}}</div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </aside>
                                    <div class="flex flex-rightJustify p-t-10x text-primary font-size-sm">
                                        <span>x&nbsp;{{$showSku['sale_qtty']}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </aside>
            <!-- 结算订单 地址、物流、支付等其他信息 -->
            <aside class="bg-white m-b-10x">
                {{--<a class="flex font-size-sm text-primary p-a-10x" href="/cart/addresslist">--}}
                <div class="flex font-size-sm text-primary p-a-10x order-option" data-form-action="/cart/addresslist" id="btn-shipTo">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Ship to</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        @if(empty($addr) || "" == $addr)
                            <div class="text-warning">Add new address</div>
                        @else
                        <div>
                            <div>{{ $addr['name'] }}</div>
                            <div>{{$addr['detail_address1']}}</div>
                            @if(!empty($addr['detail_address2'])) <div> {{ $addr['detail_address2'] }} </div> @endif
                            <div>{{$addr['city']}}  {{$addr['state']}}  {{$addr['zip']}}</div>
                            <div>{{$addr['country']}}</div>
                            <div>@if(!empty($addr['telephone'])){{ $addr['telephone'] }} @endif</div>
                        </div>
                        @endif
                        <input hidden name="aid" value="{{$addr['receiving_id']}}">
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                    <div class="bg-option bg-shipTo"></div>
                </div>
                <hr class="hr-base">
                <a class="flex font-size-sm text-primary p-a-10x btn-method" data-remodal-target="delivery-modal" href="#">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Shipping method</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span class="delivery-text">{{$defaultMethod['logistics_name']}} +${{ number_format(($defaultMethod['price'] / 100), 2) }}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                </a>

                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-x-10x p-y-5x" href="#">
                    <span class="checkoutInfo-subTitle flex-fixedShrink p-y-5x">Pay with</span>
                    <div class="checkoutInfo-content flex flex-alignCenter">
                        <div class="row flex-width">
                            <div class="col-xs-6 p-y-5x border-right active" id="payWith-card" data-with="Oceanpay">
                                <div class="payWith-card-active">
                                    <span class="delivery-text"><img src="{{env('CDN_Static')}}/images/payment/icon-card2-color.png" srcset="{{env('CDN_Static')}}/images/payment/icon-card2-color@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-card2-color@3x.png 3x" alt=""></span>
                                    <i class="iconfont icon-check icon-size-md text-common p-l-5x"></i>
                                </div>
                                <!-- 灰色 -->
                                <span class="delivery-text payWith-card"><img src="{{env('CDN_Static')}}/images/payment/icon-card2.png" srcset="{{env('CDN_Static')}}/images/payment/icon-card2@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-card2@3x.png 3x" alt=""></span>
                            </div>
                            <div class="col-xs-6 p-y-5x" id="payWith-paypal" data-with="PayPalNative">
                                <span class="payWith-paypal delivery-text p-l-5x"><img src="{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive.png" srcset="{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive@3x.png 3x" alt=""></span>

                                <!-- 彩色图标 -->
                                <div class="payWith-paypal-active">
                                    <span class="delivery-text p-l-5x"><img src="{{env('CDN_Static')}}/images/payment/icon-paypal2-color.png" srcset="{{env('CDN_Static')}}/images/payment/icon-paypal2-color@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-paypal2-color@3x.png 3x" alt=""></span>
                                    <i class="iconfont icon-check icon-size-md text-common p-l-5x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-a-10x order-option" data-form-action="/cart/coupon">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Promotion code</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span>{{ $cps }}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x"></i>
                    </div>
                    <div class="bg-option bg-promotion"></div>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-a-10x order-option" data-form-action="/cart/message">
                    <span class="checkoutInfo-subTitle flex-fixedShrink">Special request (optional)</span>
                    <div class="checkoutInfo-content flex flex-fullJustified flex-alignCenter">
                        <span class="text-truncate">{{$remark}}</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-15x flex-fixedShrink"></i>
                    </div>
                    <div class="bg-option bg-special"></div>
                </div>
            </aside>

            <!-- 结算总价 -->
            <aside class="bg-white p-a-10x m-b-10x">
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Items ({{$data['total_sku_qtty']}})</span><span>${{ number_format(($data['total_amount'] / 100), 2)}}</span>
                </div>
                @if($data['vas_amount'] > 0)
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Additional Services:</span><span>${{number_format(($data['vas_amount'] / 100), 2)}}</span>
                </div>
                @endif
                @if(!empty($addr))
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Ship to {{$addr['zip']}}</span><span>@if(0 == $data['freight_amount']) Free @else${{ number_format(($data['freight_amount'] / 100), 2)}} @endif</span>
                    </div>
                @endif
                @if($data['promot_discount_amount'] > 0)
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Discount</span><span>-${{number_format(($data['promot_discount_amount'] / 100), 2)}}</span>
                    </div>
                @endif
                @if($data['cps_amount'] > 0)
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Promotion code</span><span>-${{number_format(($data['cps_amount'] / 100), 2)}}</span>
                </div>
                @endif
                <div class="flex flex-fullJustified p-t-10x text-primary font-size-sm">
                    <span><strong>Order Total</strong></span><span><strong>${{ number_format(($data['pay_amount'] / 100), 2)}}</strong></span>
                </div>
            </aside>

            <!-- 结算按钮 -->
            <aside class="bg-white m-t-10x p-a-10x">
                <div class="btn btn-primary btn-block @if(empty($paym) || empty($addr) || "" == $paym || "" == $addr) disabled @endif"  data-role="submit">Pay Now</div>
            </aside>
        </section>
        <!-- 页脚 功能链接 start-->
    @include('footer')
    <!-- 页脚 功能链接 end-->
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

<!-- 弹出 选择运送方式 Delivery -->
<div class="remodal remodal-lg modal-content" data-remodal-id="delivery-modal" data-select="{{ $shipMethodList[$stype]['logistics_type'] }}" id="deliveryDialog">
    <div class="text-right p-a-15x" data-remodal-action="close">
        <i class="iconfont icon-cross icon-size-md text-common"></i>
    </div>
    <div class="font-size-sm">
        @foreach($shipMethodList as $index => $shipMethod)
        <hr class="hr-base m-a-0">
        <div class="p-a-15x flex flex-fullJustified flex-alignCenter" data-stype="{{$shipMethod['logistics_type']}}" data-dialog="{{ $shipMethod['logistics_name'] }} ${{ number_format(($shipMethod['price'] / 100), 2) }}">
            <span>{{ $shipMethod['logistics_name'] }} +${{ number_format(($shipMethod['price'] / 100), 2) }}</span>
            <i class="iconfont icon-radio icon-size-md text-common active"></i>
        </div>
        @endforeach
    </div>
    <hr class="hr-base m-a-0">
    <div class="p-x-15x p-t-10x p-b-15x">
        <div class="btn btn-primary btn-block btn-md" data-remodal-action="confirm">Save</div>
    </div>
</div>

<!-- 隐藏表单域 -->
<form id="infoForm" action="" hidden>
    <input type="hidden" name="pageSrc" value="checkout">
    <input type="hidden" name="aid" value="{{$addr['receiving_id']}}">
    <input type="hidden" name="stype" value="{{$stype}}">
    <input type="hidden" name="paym" value="{{$paym}}">
    @if(isset($input) && !empty($input))
        @foreach($input as $name=>$value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/orderCheckout.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
