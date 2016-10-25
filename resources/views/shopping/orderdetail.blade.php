<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Detail</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderDetail.css{{'?v='.config('app.version')}}">

</head>
<body id="body-content">
@include('check.tagmanager')
@include('nav')
<div class="body-container">
    @include('navigator')
    <section class="reserve-height">
        @inject('getDate', 'App\Services\Publicfun')
        <article class="font-size-md text-main p-y-10x p-x-15x bg-title"><strong>Order Detail</strong></article>
        <hr class="hr-base m-a-0">

        <!-- 订单主要信息:日期、订单号、总金额 -->
        <article class="bg-white font-size-sm p-y-10x p-x-15x" data-order-number="{{ $data['sub_order_no'] }}">
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order Date</span>
                <span>{{ $getDate->getMyDate($data['create_time']) }}</span>
            </div>
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order #</span>
                <span>{{$data['sub_order_no']}}</span>
            </div>
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order Total</span>
                <span>${{number_format(($data['pay_amount'] / 100), 2)}}</span>
            </div>
        </article>
        <div class="hr-between"></div>

        <!-- 订单商品列表 -->
        <aside class="bg-white">
            <!-- 正常订单 下单日期 -->
            @if(in_array($data['status_code'], array(21, 22, 23)))
            <!--被取消的订单 取消原因、取消日期-->
                <div class="p-y-10x p-x-5x @if($data['status_code'] == 21 || $data['status_code'] == 23) status-gray @else status-yellow @endif">
                    <div class="font-size-sm text-primary" id="orderState" data-state="true">
                        <strong>{{ $data['status_info'] }}:</strong>
                        <span>{{ $getDate->getMyDate($data['create_time']) }}</span></div>
                </div>
                <div class="p-b-10x p-x-15x p-r-20x">
                    <div class="font-size-sm text-primary">
                        {{ $data['status_explain'] }}
                    </div>
                </div>
            @else
                <div class="p-y-10x p-x-5x @if($data['status_code'] == 11) status-red @elseif($data['status_code'] == 23 || $data['status_code'] == 21  || $data['status_code'] == 27) status-gray @elseif($data['status_code'] == 25 || $data['status_code'] == 20) status-blue @elseif($data['status_code'] >= 17 && $data['status_code'] <= 19)  status-green @else status-yellow @endif ">
                    <span class="font-size-sm text-primary flex flex-fullJustified flex-alignCenter">
                        <span><strong>{{ $data['status_info'] }}:</strong> {{ $getDate->getMyDate($data['create_time']) }}</span>
                        @if($data['status_code']==11)
                            <a class="btn btn-primary btn-sm p-x-10x checkoutPay" href="javascript:;">Check Out</a>
                        @endif
                    </span>
                </div>
                    <div class="p-b-10x p-x-15x p-r-20x">
                        <div class="font-size-sm text-primary">
                            {{ $data['status_explain'] }}
                        </div>
                    </div>
            @endif

            <hr class="hr-base m-y-0 m-l-15x">
            @if(isset($data['lineOrderList']))
                @foreach($data['lineOrderList'] as $lineOrder)
                    <a href="/detail/{{ $lineOrder['spu'] }}" class="btn-orderDetail">
                        <div class="flex p-y-10x p-x-15x">
                            <div class="flex-fixedShrink">
                                <img class="img-thumbnail"
                                     src="{{ env('APP_Api_Image').'/n2/'.$lineOrder['img_path'] }}"
                                     width="70px" height="70px">
                            </div>
                            <div class="p-x-10x order-product-title">
                                <h6 class="text-main font-size-md text-truncate">
                                    <strong>{{$lineOrder['main_title']}}</strong>
                                </h6>
                                <aside class="text-primary font-size-sm">
                                    @if(isset($lineOrder['attrValues']) && !empty($lineOrder['attrValues']))
                                        @foreach($lineOrder['attrValues'] as $attr)
                                            <div><span>{{$attr['attr_type_value']}}
                                                    : </span><span>{{$attr['attr_value'] }}</span></div>
                                        @endforeach
                                    @endif
                                    <div><span>Qty: </span><span>{{$lineOrder['sale_qtty']}}</span></div>
                                    @if(isset($lineOrder['vas_info']) && !empty($lineOrder['vas_info']))
                                        @foreach($lineOrder['vas_info'] as $info)
                                            <div>
                                                <span>{{$info['vas_name']}}: </span>
                                                <span>{{$info['user_remark'] }}</span>
                                                <span>+${{number_format(($info['vas_price'] / 100), 2)}}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </aside>
                            </div>
                        </div>
                    </a>
                    <hr class="hr-base m-y-0 m-l-15x">
                @endforeach
            @endif
            @if(isset($data['logistics_info_url']))
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                   href="/orderlist">
                    Download our free app to track your order
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
            @endif
            @if(in_array($data['status_code'], array(21, 22, 23)))
                <div class="p-a-10x">
                    <div href="#" class="btn btn-primary btn-block" type="bottom" id="buyAgain">Buy Again</div>
                </div>
            @endif
        </aside>
        <div class="hr-between"></div>

        <!-- 订单地址、物流、支付 等信息 -->
        <aside class="bg-white">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Shipping to</span>
                <div>
                    <div>{{ $data['userAddr']['name'] }}</div>
                    <div>{{ $data['userAddr']['detail_address1'] }}</div>
                    @if(!empty($data['userAddr']['detail_address2']))
                        <div>{{ $data['userAddr']['detail_address2'] }} </div>@endif
                    <div>{{ $data['userAddr']['city'] }}
                        ,{{ $data['userAddr']['state'] }} {{  $data['userAddr']['zip'] }}</div>
                    <div>{{$data['userAddr']['country']}}</div>
                    <div> @if(!empty($data['userAddr']['telephone'])) {{ $data['userAddr']['telephone'] }} @endif </div>
                </div>
            </div>
            <hr class="hr-base">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Shipping</span>
                <span>{{$data['logistics_name']}} ${{number_format(($data['logistics_price'] / 100), 2)}}</span>
            </div>
            @if(!in_array($data['status_code'], array(11, 21, 27)))
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Paid with</span>
                    @if("PayPal" == $data['pay_type'] || "PayPalNative" == $data['pay_type'])
                        <span class="cardImage-inline paypal"></span>
                    @else
                        <span class="cardImage-inline cardCredit"></span>
                    @endif
                    <span class="m-l-10x">{{$data['orderPayInfo']['show_name']}}</span>
                </div>
            @endif
            @if(!empty($data['order_remark']))
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Special Request</span>
                    <div>
                        <div class="message-info">
                            <p class="m-b-0">{{ $data['order_remark'] }} </p>
                        </div>
                        <a class="flex flex-alignCenter flex-fullJustified font-size-xs p-t-5x text-common btn-showMore">
                            <span class="showMore">Show More</span>
                            <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                        </a>
                    </div>
                </div>
            @endif
        </aside>
        <div class="hr-between"></div>

        <!-- 订单金额 -->
        <aside class="bg-white">
            <div class="p-a-10x">

                {{--数量--}}
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Items({{ $data['item_qtty'] }})</span><span>${{number_format(($data['total_amount'] / 100), 2)}}</span>
                </div>

                {{--增值服务--}}
                @if($data['vas_amount'] > 0)
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Additional services</span><span>${{number_format(($data['vas_amount'] / 100), 2)}}</span>
                    </div>
                @endif

                {{--优惠--}}
                @if($data['cps_amount'] > 0)
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Promotion code</span><span>-${{ number_format(($data['cps_amount'] / 100), 2)}}</span>
                    </div>
                @endif

                {{--折扣--}}
                @if($data['promot_discount_amount'] > 0)
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Discount</span><span>-${{ number_format(($data['promot_discount_amount'] / 100), 2)}}</span>
                    </div>
                @endif

                {{--收税提示--}}
                @if($data['tax_amount'])
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Sale tax </span><span>${{ number_format(($data['tax_amount'] / 100), 2)}}</span>
                    </div>
                @endif

                {{--地址服务--}}
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Shipping and handling</span><span>@if(0 == $data['freight_amount'])
                            Free @else${{ number_format(($data['freight_amount'] / 100), 2)}} @endif</span>
                </div>

                {{--结算价--}}
                <div class="flex flex-fullJustified p-t-10x text-primary font-size-sm">
                    <span><strong>Order Total</strong></span><span><strong>${{ number_format(($data['pay_amount'] / 100), 2)}}</strong></span>
                </div>

            </div>
            <hr class="hr-base m-a-0">
            <!-- 服务质量保证 -->
        </aside>

        <!-- 联系客服 -->
        <aside class="bg-white p-a-10x">
            <a href="/askshopping?skiptype=2&id={{$data['sub_order_no']}}" class="btn btn-primary btn-block"
               type="submit">Contact Customer Service
            </a>
        </aside>
    </section>
    <!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
</div>

<!-- 弹出 选择支付方式 -->
<div class="remodal remodal-lg modal-content" data-remodal-id="paywith-modal" id="paywithDialog">
    <div class="p-a-15x text-left font-size-base p-l-20x"><strong>CheckOut With</strong></div>
    <div class="font-size-sm">
        <hr class="hr-base m-a-0">
        <a class="p-a-15x flex flex-fullJustified flex-alignCenter payAgainCard" href="/payAgain/{{$data['sub_order_no']}}/0">
            <div>
                <img src="{{env('CDN_Static')}}/images/payment/icon-cardCredit.png" srcset="{{env('CDN_Static')}}/images/payment/icon-cardCredit@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-cardCredit@3x.png 3x" alt="">
                <span class="p-l-15x text-primary">Direct debit/credit card</span>
            </div>
            <i class="iconfont icon-arrow-right icon-size-sm text-common"></i>
        </a>
        <hr class="hr-base m-a-0">
        <a class="p-a-15x flex flex-fullJustified flex-alignCenter payAgainPaypal" href="/payAgain/{{$data['sub_order_no']}}/1">
            <div>
                <img src="{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive.png" srcset="{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive@2x.png 2x,{{env('CDN_Static')}}/images/payment/icon-Paypal-inactive@3x.png 3x" alt="">
                <span class="p-l-15x text-primary">Paypal</span>
            </div>
            <i class="iconfont icon-arrow-right icon-size-sm text-common"></i>
        </a>
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/orderDetail.js{{'?v='.config('app.version')}}"></script>
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
