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
                <!--<div class="m-t-20x">-->
                <!--<div class="order-empty-content m-t-20x p-x-10x">-->
                <!--<div class="container m-t-20x order-emptyInfo">-->
                <!--<div class="m-b-20x p-b-5x"><i class="btn-orderEmpty iconfont icon-error"></i></div>-->
                <!--<p class="text-primary font-size-sm m-b-20x p-b-20x">No orders found</p>-->
                <!--<a href="#" class="btn btn-primary btn-block btn-sm">Go Shopping</a>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!-- 订单列表 -->
                <section class="orderList">
                @foreach($data['list'] as $list)
                   @foreach($list['subOrderList'] as $subOrderList)
                   <div class="orderList-item bg-white m-b-10x">
                        <div class="p-a-10x">
                            <div class="flex flex-fullJustified flex-alignCenter">
                                <span class="font-size-sm text-primary"><strong>ORDER PLACED:</strong>{{  $subOrderList['create_time']}}</span>
                                <a class="btn btn-primary btn-sm" href="/shopping/order/orderdetail/{{ $subOrderList['sub_order_no']}}">Order Detail</a>
                            </div>
                            <!--<div class="font-size-sm text-primary p-t-10x">We excepct your order to be processed between: <br/><span>Apr 15, 2016 - Apr 17, 2016 </span>-->
                            <!--</div>-->
                        </div>
                        <hr class="hr-base m-y-0 m-l-10x">
                        @foreach($subOrderList['lineOrderList'] as $lineOrderList)
                        <div class="flex p-a-10x">
                            <div class="flex-fixedShrink">
                                <img class="img-thumbnail" src="{{'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$lineOrderList['img_path']}}" width="70px" height="70px">
                            </div>
                            <div class="p-x-10x order-product-title">
                                <h6 class="text-main font-size-md text-truncate">
                                    <strong>{{ $lineOrderList['main_title']}}</strong>
                                </h6>
                                <aside class="text-primary font-size-sm">
                                    <div><span>Size: </span><span>11</span></div>
                                    <div><span>Color: </span><span>Black</span></div>
                                    <div><span>Qty: </span><span>{{ $lineOrderList['sale_qtty'] }}</span></div>
                                    <div><span>Inside Engraving: </span><span>MY LOVE</span></div>
                                </aside>
                            </div>
                        </div>
                        @endforeach
                        <hr class="hr-base m-y-0 m-l-10x">
                        <div class="flex flex-alignCenter flex-fullJustified p-a-10x">
                            <div class="text-primary font-size-sm"><span>Order # </span><span>{{ $subOrderList['sub_order_no']}}</span>
                            </div>
                            <div class="text-primary font-size-sm"><span>Order Total: </span><span>${{ $subOrderList['total_amount']}}</span></div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
                </section>
            </section>
<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
        </div>
    </div>
</body>
<script src="scripts/vendor.js"></script>
</html>
