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
@include('nav')
    <div class="body-container">
        @include('navigator')
        <!-- 订单详情 start-->
            @if('CANCELLED' == $data['status_info'])
                @include('shopping.orderdetail_cancel', ['data'=>$data])
            @else
                @include('shopping.orderdetail_success', ['data'=>$data])
            @endif
        <!-- 订单详情 end-->
<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderDetail.js"></script>
</html>
