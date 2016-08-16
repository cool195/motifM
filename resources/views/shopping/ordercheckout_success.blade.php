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
                        'tax': '0',
                        'shipping': '{{ number_format($order['freight_amount'] / 100, 2) }}',
                        'coupon': ''
                    },
                    'products': [
                            @foreach($order['lineOrderList'] as $lineOrder)
                        {
                            'name': '{{ $lineOrder['main_title'] }}',
                            'sku': '{{ $lineOrder['sku'] }}',
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
</script>
        <!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
            <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
                <!-- 订单结算确认信息 -->
        <section class="reserve-height"
                 data-impr='http://clk.motif.me/log.gif?t=order.100001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"orderno":"{{ $order['sub_order_no'] }}","version":"1.0.1","ver":"9.2","src":"H5"}'>
            <article class="bg-white m-b-10x p-a-15x text-center">
                <h5 class="font-size-lx text-primary p-t-5x m-b-20x">Order Comfirmed</h5>
                <div class="font-size-sm text-primary p-t-5x">A confirmation email has been sent to:</div>
                <div class="font-size-sm text-primary m-b-20x"><strong>{{Session::get('user.login_email')}}</strong>
                </div>
                <p class="font-size-xs text-common m-b-15x p-t-10x">You can track
                    <a href="@if(!empty($order))/order/orderdetail/{{$order['sub_order_no']}}@else /order/orderlist @endif"
                       class="text-primary text-underLine">your order</a>
                    at any time by visting the Orders tab
                </p>
                <a href="/shopping" class="btn btn-primary btn-block btn-sm" type="submit">Continue Shopping</a>
            </article>
        </section>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
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
@include('global')
</html>
