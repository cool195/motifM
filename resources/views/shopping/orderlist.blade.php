<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order List</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderList.css{{'?v='.config('app.version')}}">

</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- 订单列表 -->
        <section class="p-b-20x reserve-height">
            <article class="font-size-md text-main p-a-10x"><strong>ORDERS</strong></article>

            <!-- 订单数为0 -->
            <div class="order-empty-content m-t-20x p-x-10x hidden-xs-up" id="emptyOrder">
                <div class="container m-t-20x order-emptyInfo">
                    <div class="m-b-20x p-b-5x"><i class="btn-orderEmpty iconfont icon-error"></i></div>
                    <p class="text-primary font-size-sm m-b-20x p-b-20x">No orders found</p>
                    <a href="/daily" class="btn btn-primary btn-block">Go Shopping</a>
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

<!-- 弹出 选择支付方式 -->
<div class="remodal remodal-lg modal-content" data-remodal-id="paywith-modal" id="paywithDialog">
    <div class="p-a-15x text-left font-size-base p-l-20x"><strong>Pay with</strong></div>
    <div class="font-size-sm">
        <hr class="hr-base m-a-0">
        <a class="p-a-15x flex flex-fullJustified flex-alignCenter">
            <div>
                <img src="/images/payment/icon-cardCredit.png" srcset="/images/payment/icon-cardCredit@2x.png 2x,/images/payment/icon-cardCredit@3x.png 3x" alt="">
                <span class="p-l-15x text-primary">Direct debit/credit card</span>
            </div>
            <i class="iconfont icon-arrow-right icon-size-sm text-common"></i>
        </a>
        <hr class="hr-base m-a-0">
        <a class="p-a-15x flex flex-fullJustified flex-alignCenter">
            <div>
                <img src="/images/payment/icon-Paypal-inactive.png" srcset="/images/payment/icon-Paypal-inactive@2x.png 2x,/images/payment/icon-Paypal-inactive@3x.png 3x" alt="">
                <span class="p-l-15x text-primary">Paypal</span>
            </div>
            <i class="iconfont icon-arrow-right icon-size-sm text-common"></i>
        </a>
    </div>
</div>

</body>
<!-- 模板 -->
<template id="tpl-orderList">
    @{{ each list }}
    @{{ each $value.subOrderList }}

        <div class="orderList-item bg-white m-b-10x">
            <div class="p-y-10x @{{ if $value.status_code == 11 }} status-red @{{ else if $value.status_code == 23 || $value.status_code == 21  || $value.status_code == 27 }} status-gray @{{ else if $value.status_code == 25 || $value.status_code == 20}} status-blue @{{ else if $value.status_code == 17}} status-green @{{ else if $value.status_code == 18}} status-green @{{ else if $value.status_code == 19}} status-green @{{ else }} status-yellow @{{ /if }}">
                <div class="p-l-5x p-r-10x flex flex-fullJustified flex-alignCenter">
                    <span class="font-size-sm text-primary">
                        <strong>@{{ $value.status_info }}: </strong>@{{ $value.update_time }}
                    </span>
                    @{{ if $value.status_code == 11 }}
                        <a class="btn btn-primary btn-sm p-x-10x" href="/payAgain/@{{ $value.sub_order_no }}">Check Out</a>
                    @{{ /if }}
                </div>
            </div>
            @{{ if $value.status_explain !== '' || $value.status_explain !== null }}
            <div class="p-b-10x p-x-15x p-r-20x">
                <div class="font-size-sm text-primary">
                    @{{ $value.status_explain }}
                </div>
            </div>
            @{{ /if }}

            <hr class="hr-base m-y-0 m-l-10x">

            @{{ each $value.lineOrderList }}
            <a href="/order/orderdetail/@{{ $value.sub_order_no }}">
                <div class="flex p-a-10x">
                <div class="flex-fixedShrink">
                    <img class="img-thumbnail img-lazy"
                         src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                         data-original="{{env('APP_Api_Image')}}/n4/@{{ $value.img_path }}"
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

<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/orderList.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
