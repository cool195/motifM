<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Order Detail</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/orderDetail.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

</head>
<body id="body-content">
@include('check.tagmanager')
@include('nav')
<div class="body-container">
    @include('navigator')
    <section>
        <article class="font-size-md text-main p-y-10x p-x-15x"><strong>Order Details</strong></article>

        <!-- 订单主要信息:日期、订单号、总金额 -->
        <article class="bg-white font-size-sm p-y-10x p-x-15x m-b-10x" data-order-number="{{ $data['sub_order_no'] }}">
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order date</span>
                <span>{{$data['create_time']}}</span>
            </div>
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order #</span>
                <span>{{$data['sub_order_no']}}</span>
            </div>
            <div class="flex text-primary">
                <span class="orderInfo-subTitle flex-fixedShrink">Order total</span>
                <span>${{number_format(($data['pay_amount'] / 100), 2)}}</span>
            </div>
        </article>

        <!-- 订单商品列表 -->
        <aside class="bg-white m-b-10x">
            <!-- 正常订单 下单日期 -->
        @if(in_array($data['status_code'], array(21, 22, 23)))
            <!--被取消的订单 取消原因、取消日期-->
                <div class="p-a-10x">
                    <div class="font-size-sm text-primary" id="orderState" data-state="true"><strong>{{ $data['status_info'] }}:</strong>
                        <span>{{$data['create_time']}}</span></div>
                    <div class="font-size-sm text-primary">
                        <div>{{ $data['status_explain'] }}</div>
                        {{--<div>Apr 15, 2016 - Apr 17, 2016</div>--}}
                    </div>
                </div>
            @else
                <div class="p-y-10x p-x-15x">
                    <span class="font-size-sm text-primary"><strong>{{ $data['status_info'] }}:</strong> {{$data['create_time']}} </span>
                    <span class="font-size-sm text-primary"><p class="m-b-0">@if(in_array($data['status_code'], array(11, 12, 14))) {{ $data['status_explain'] }} @endif</p></span>
                </div>
            @endif

            <hr class="hr-base m-y-0 m-l-15x">
            @if(isset($data['lineOrderList']))
                @foreach($data['lineOrderList'] as $lineOrder)
                 <a href="/detail/{{ $lineOrder['spu'] }}">
                    <div class="flex p-y-10x p-x-15x">
                        <div class="flex-fixedShrink">
                            <img class="img-thumbnail"
                                 src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$lineOrder['img_path'] }}"
                                 width="70px" height="70px">
                        </div>
                        <!-- TODO 缩略号的兼容性不好, 需要改样式 -->
                        <div class="p-x-10x order-product-title">
                            <h6 class="text-main font-size-md text-truncate">
                                <strong>{{$lineOrder['main_title']}}</strong>
                            </h6>
                            <aside class="text-primary font-size-sm">
                                @if(isset($lineOrder['attrValues']) && !empty($lineOrder['attrValues']))
                                    @foreach($lineOrder['attrValues'] as $attr)
                                        <div><span>{{$attr['attr_type_value']}}: </span><span>{{$attr['attr_value'] }}</span></div>
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
            @if(in_array($data['status_code'], array(21, 22, 23)))
                <div class="p-a-10x">
                    <div href="#" class="btn btn-primary btn-block btn-sm" type="bottom" id="buyAgain">Buy Again</div>
                </div>
            @endif
        </aside>

        <!-- 订单地址、物流、支付 等信息 -->
        <aside class="bg-white m-b-10x">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Ships to</span>
                <div>
                    <div>{{ $data['userAddr']['name'] }}   {{ $data['userAddr']['email'] }}</div>
                    <div>{{ $data['userAddr']['detail_address1'] }} @if(!empty($data['userAddr']['detail_address2'])) {{ $data['userAddr']['detail_address2'] }} @endif</div>
                    <div>{{$data['userAddr']['city']." ".$data['userAddr']['state']." ".$data['userAddr']['zip'] }}</div>
                    <div>{{$data['userAddr']['country']}}</div>
                    <div> @if(!empty($data['userAddr']['telephone'])) {{ $data['userAddr']['telephone'] }} @endif </div>
                </div>
            </div>
            <hr class="hr-base">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Delivery</span>
                <span>{{$data['logistics_name']}} +{{number_format(($data['logistics_price'] / 100), 2)}}$</span>
            </div>
            <hr class="hr-base">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Pay with</span>
                @if($data['pay_type']=="PayPal")
                    <span class="cardImage-inline paypal"></span>
                @elseif(array_get($data['cardlist'],$data['orderPayInfo']['card_type']))
                    <span class="cardImage-inline {{array_get($data['cardlist'],$data['orderPayInfo']['card_type'])}}"></span>
                @endif
                <span class="m-l-10x">{{$data['pay_type']}}({{$data['orderPayInfo']['show_name']}})</span>
            </div>
            <hr class="hr-base">
            <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                <span class="orderInfo-subTitle flex-fixedShrink">Message to Us</span>
                <div>
                    <div class="message-info">
                        <p class="m-b-0">@if(!empty($data['order_remark'])){{ $data['order_remark'] }} @endif</p>
                    </div>
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm p-t-5x text-common btn-showMore">
                        <span class="showMore">Show More</span>
                        <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- 订单金额 -->
        <aside class="bg-white m-b-10x">
            <div class="p-a-10x">
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Items({{ $data['item_qtty'] }}
                        )</span><span>${{number_format(($data['total_amount'] / 100), 2)}}</span>
                </div>
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Additional Services</span><span>${{number_format(($data['vas_amount'] / 100), 2)}}</span>
                </div>
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Shipping to {{ $data['userAddr']['zip'] }}</span><span>@if(0 == $data['freight_amount']) Free @else${{ number_format(($data['freight_amount'] / 100), 2)}} @endif</span>
                </div>
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span>Coupon</span><span>-${{ number_format(($data['cps_amount'] / 100), 2)}}</span>
                </div>
                <div class="flex flex-fullJustified p-t-10x text-primary font-size-sm">
                    <span><strong>Order Total</strong></span><span><strong>${{ number_format(($data['pay_amount'] / 100), 2)}}</strong></span>
                </div>
            </div>
            <hr class="hr-base m-a-0">
            <!-- 服务质量保证 -->
        </aside>

        <!-- 联系客服 -->
        <aside class="bg-white m-b-10x p-a-10x">
            <a href="/askshopping?skiptype=2&id={{$data['sub_order_no']}}" class="btn btn-primary btn-block btn-sm"
               type="submit">Contact Service</a>
        </aside>
    </section>
    <!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
</div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderDetail.js"></script>
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
