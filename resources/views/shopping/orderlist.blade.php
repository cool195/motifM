<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Order List</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/orderList.css">

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
    <!-- 订单列表 -->
        <section class="p-b-20x">
            <article class="font-size-md text-main p-a-10x"><strong>Orders</strong></article>

            <!-- 订单数为0 -->
            <div class="order-empty-content m-t-20x p-x-10x" id="emptyOrder">
                <div class="container m-t-20x order-emptyInfo">
                    <div class="m-b-20x p-b-5x"><i class="btn-orderEmpty iconfont icon-error"></i></div>
                    <p class="text-primary font-size-sm m-b-20x p-b-20x">No orders found</p>
                    <a href="/daily" class="btn btn-primary btn-sm">Go Shopping</a>
                </div>
            </div>

            <!-- 订单列表 -->
            <section class="orderList" id="orderContainer" data-loading="false" data-pagenum="0">

            </section>
            <section class="loading" id="loading" style="display: none">
                <div class="loader"></div>
            </section>
        </section>
        <!-- 页脚 功能链接 start-->
    @include('footer')
    <!-- 页脚 功能链接 end-->
    </div>
</div>
</body>
<!-- 模板 -->
<template id="tpl-orderList">
    @{{ each list }}
    @{{ each $value.subOrderList }}
    <div class="orderList-item bg-white m-b-10x">
        <div class="p-a-10x">
            <div class="flex flex-fullJustified flex-alignCenter">
                <span class="font-size-sm text-primary">
                    <strong>@{{ $value.status_info }}: </strong>@{{ $value.update_time }}
                </span>
                <a class="btn btn-primary btn-sm" href="/order/orderdetail/@{{ $value.sub_order_no }}">Order
                    Detail</a>
            </div>
            @{{ if $value.status_explain == '' || $value.status_explain == null }}
            <div class="font-size-sm text-primary p-t-10x">
                @{{ $value.status_explain }}
            </div>
            @{{ /if }}
        </div>
        <hr class="hr-base m-y-0 m-l-10x">

        @{{ each $value.lineOrderList }}
        <a href="/detail/@{{ $value.spu }}">
        <div class="flex p-a-10x">
            <div class="flex-fixedShrink">
                <img class="img-thumbnail img-lazy"
                     src="/images/product/bg-product@70.png"
                     data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n4/@{{ $value.img_path }}"
                     width="70px" height="70px">
            </div>
            <div class="p-x-10x order-product-title">
                <h6 class="text-main font-size-md text-truncate">
                    <strong>@{{ $value.main_title }}</strong>
                </h6>
                <aside class="text-primary font-size-sm">
                    @{{ each $value.attrValues }}
                    <div><span>@{{ $value.attr_type_value }}: </span><span>@{{ $value.attr_value }}</span></div>
                    @{{ /each }}

                    <div><span>Qty: </span><span>@{{ $value.sale_qtty }}</span></div>
                    {{-- TODO 这里的数据加载还没有验证 --}}
                    @{{ if $value.vas_info !== null }}
                    @{{ each $value.vas_info }}
                    <div><span>@{{ $value.vas_name }}: </span><span>@{{ $value.user_remark }}</span></div>
                    @{{ /each }}
                    @{{ /if }}
                </aside>
            </div>
        </div>
        </a>
        @{{ /each }}

        <hr class="hr-base m-y-0 m-l-10x">
        <div class="flex flex-alignCenter flex-fullJustified p-a-10x">
            <div class="text-primary font-size-sm">
                <span>Order # </span><span>@{{ $value.sub_order_no }}</span>
            </div>
            <div class="text-primary font-size-sm">
                <span>Order Total: </span><span>$@{{ ($value.pay_amount/100).toFixed(2) }}</span>
            </div>
        </div>
    </div>
    @{{ /each }}
    @{{ /each }}
</template>

<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderList.js"></script>
</html>
