<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Confirm</title>
    @include('head')

</head>
<body>
@if(!empty($order))
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'ecommerce': {
                'purchase': {
                    'actionField': {
                        'id': '{{ $order['sub_order_no'] }}',
                        'affiliation': 'Online Store',
                        'revenue': '{{ number_format($order['total_amount'] / 100, 2) }}',
                        'tax': '{{ number_format($order['tax_amount']) }}',
                        'shipping': '{{ number_format($order['freight_amount'] / 100, 2) }}',
                        'coupon': ''
                    },
                    'products': [
                            @foreach($order['lineOrderList'] as $lineOrder)
                        {
                            'name': '{{ $lineOrder['main_title'] }}',
                            'id': '{{ $lineOrder['spu'] }}',
                            'price': '{{ number_format($lineOrder['sale_price'] / 100, 2) }}',
                            'brand': 'Motif',
                            'category': '',
                            'quantity': '{{ $lineOrder['sale_qtty'] }}'
                        },
                        @endforeach
                    ]
                }
            }
        });
    </script>
@endif

@include('check.tagmanager')
<script>
    var totalPrice="{{ number_format($order['total_amount'] / 100, 2) }}";
    var content_ids = [@foreach($order['lineOrderList'] as $key => $product) @if(0 == $key)'{{$product['spu']}}' @else ,'{{$product['spu']}}' @endif @endforeach];
</script>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- 订单结算确认信息 -->
        <section class="reserve-height" data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=order.100001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"orderno":"{{ $order['sub_order_no'] }}","version":"1.0.1","ver":"9.2","src":"H5"}'>
            <article class="bg-white m-b-10x p-a-15x text-center">
                <h5 class="font-size-lx text-primary p-t-5x m-y-20x">Thank You!<br>Your Order is Confirmed</h5>
                <div class="font-size-sm text-primary p-t-5x">A confirmation email has been sent to:</div>
                <div class="font-size-sm text-primary m-b-20x"><strong>{{Session::get('user.login_email')}}</strong>
                </div>
                <p class="font-size-xs text-common m-b-15x p-t-10x p-x-20x m-x-10x">You can track
                    <a href="@if(!empty($order))/order/orderdetail/{{$order['sub_order_no']}}@else /order/orderlist @endif"
                       class="text-primary text-underLine">your order</a>
                    at any time by visting the Orders tab in settings.
                </p>
                {{--<a href="/shopping" class="btn btn-primary btn-block btn-sm" type="submit">Continue Shopping</a>--}}
            </article>

            <!-- 订单完成 邀请好友 -->
            <aside class="p-y-20x">
                <div class="text-center p-t-10x">
                    <img src="{{env('CDN_Static')}}/images/icon/gift-big.png" srcset="{{env('CDN_Static')}}/images/icon/gift-big@2x.png 2x,{{env('CDN_Static')}}/images/icon/gift-big@3x.png 3x">
                </div>
                <div class="text-center text-primary font-size-sm p-y-20x"><strong>Share Motif with friends.<br/>They get $20 off, and you <br/> will too after their first purchase.</strong></div>
                <div class="container-fluid p-x-10x p-y-20x">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="/trending" class="btn btn-common btn-block">Ignore</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="/invitefriends" class="btn btn-primary btn-block">Invite Friends</a>
                        </div>
                    </div>
                </div>
            </aside>
        </section>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
<img src="@if(!empty($order))https://shareasale.com/sale.cfm?amount={{ number_format($order['pay_amount'] / 100, 2) }}&tracking={{ $order['sub_order_no'] }}&transtype=sale&merchantID=69783 @endif" width="1" height="1" hidden>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@if(!empty($order['sub_order_no']))
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: $(".reserve-height").data('impr')
            }).done(function () {

            });
        })
    </script>
@endif

<script>
    var _learnq = _learnq || [];
    _learnq.push(['track', 'Checkout Successfully', {
        'EventId': '{{ $order['sub_order_no'] }}',
        'Value' : '{{ number_format($order['total_amount'] / 100, 2) }}',
        'Brand' : 'Motif h5',
        'ItemNames' : [@foreach($order['lineOrderList'] as $lineOrder) '{{ $lineOrder['main_title'] }}' @endforeach],
        'Items' : [
                @foreach($order['lineOrderList'] as $lineOrder)
            {
                'SPU' : '{{ $lineOrder['spu'] }}',
                'Name' : '{{ $lineOrder['main_title'] }}',
                'Quantity' : '{{ $lineOrder['sale_qtty'] }}',
                'ItemPrice' : '{{ number_format($lineOrder['sale_price'] / 100, 2) }}',
                'ProductURL' : 'https://m.motif.me/detail/{{$lineOrder['main_title']}}-{{$lineOrder['spu']}}'
            },
            @endforeach
        ]
    }]);
</script>

@include('global')
</html>
