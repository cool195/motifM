<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Shopping Cart</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/styles/vendor.css">
    <link rel="stylesheet" href="/styles/shoppingCart.css">
    <link rel="stylesheet" href="/styles/remodal.css">

    <script src="/scripts/vendor/modernizr.js"></script>
    <script src="/scripts/vendor/fastclick.js"></script>

</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    @include('nav')
    <div class="body-container">
    @include('navigator')

    <!-- 购物袋 商品列表 -->
        <section class="p-b-20x">
            <!-- "Shopping Bag" 标题 -->
            <article class="font-size-md text-main p-a-10x"><strong>Shopping Bag</strong></article>

        @if(empty($cartData['showSkus']))
            <!-- 空袋子 提示信息 -->
                <div class="shopbag-empty-content p-x-10x">
                    <div class="container shopbag-emptyInfo">
                        <div class="m-b-20x p-b-5x"><i class="btn-shopbagEmpty iconfont icon-shopbag"></i></div>
                        <p class="text-primary font-size-sm m-b-20x p-b-20x">No saved items</p>
                        <a href="#" class="btn btn-primary btn-block btn-sm">Continue Shopping</a>
                    </div>
                </div>
        @else
            <!-- 商品列表 -->
                <section class="cartList bg-white">
                    @foreach($cartData['showSkus'] as $showSku)
                        <div class="cartList-item p-a-10x @if(1 !== $showSku['stock_status']) disabled @endif">
                            <div class="productInfo flex">
                                <div class="flex-fixedShrink">
                                    <img class="img-thumbnail"
                                         src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$showSku['main_image_url'] }}"
                                         width="70px" height="70px">
                                </div>
                                <div class="p-l-10x flex-width">
                                    <article class="flex flex-fullJustified">
                                        <!--<h6 class="text-main font-size-md p-r-10x">
                                               <strong>Crown Shape Black Gold-plated Sterling Silver Engagehape Black
                                                       Gold-plated
                                                       Sterling Silver</strong>
                                           </h6> -->
                                        <h6 class="text-main font-size-md p-r-10x">
                                            <strong>{{$showSku['main_title']}}</strong></h6>
                                        <span class="text-primary font-size-sm flex-fixedShrink">${{number_format(($showSku['sale_price'] / 100), 2)}}</span>
                                    </article>
                                    <aside class="cartItem-secondaryInfo text-primary font-size-sm">
                                        <div><span>Size: </span><span>11</span></div>
                                        <div><span>Color: </span><span>Black</span></div>
                                        <div><span>Material: </span><span>Gold</span></div>
                                        <div class="flex flex-fullJustified">
                                            <div class="">
                                                <span>Inside Engraving: </span><span>MY LOVE</span></div>
                                            <div class="">${{number_format(($showSku['total_amount'] / 100), 2)}}</div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="mask"></div>
                            </div>
                            <div class="flex flex-alignCenter flex-fullJustified p-y-10x">
                                <div class="flex">
                                    <a class="btn btn-cartUpdate btn-sm" data-remodal-target="modal"
                                       data-sku="{{$showSku['sku']}}" data-action="delsku">Delete</a>
                                    <a href="#" class="btn btn-cartUpdate btn-sm" data-product-move="save"
                                       data-sku="{{$showSku['sku']}}">Save for Later</a>
                                </div>
                                <div class="flex flex-alignCenter">
                                    <span class="text-primary font-size-sm m-r-5x">Qty:</span>
                                    <div class="btn-group flex" data-sku="{{$showSku['sku']}}">
                                        <div class="btn btn-cartCount btn-sm @if(1 !== $showSku['stock_status']) disabled @endif"
                                             data-item-qty="minus">
                                            <i class="iconfont icon-minus"></i>
                                        </div>
                                        <div class="btn btn-cartCount btn-sm"
                                             data-item-num="{{$showSku['sale_qtty']}}">{{$showSku['sale_qtty']}}</div>
                                        <div class="btn btn-cartCount btn-sm @if(1 !== $showSku['stock_status']) disabled @endif"
                                             data-item-qty="add">
                                            <i class="iconfont icon-add"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-warming font-size-xs">Warming: Women’s Ring</div>
                        </div>
                    @endforeach
                </section>

                <!-- 商品总价 -->
                <section class="bg-white m-t-10x p-a-10x">
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Items({{$cartData['total_sku_qtty'] }}
                            ): </span><strong>${{$cartData['total_amount']}}</strong>
                    </div>
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Extra: </span><strong>${{ $cartData['vas_amount'] }}</strong>
                    </div>
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Bag Subtotal: </span><strong>${{$cartData['pay_amount']}}</strong>
                    </div>
                </section>
                <!-- 购买按钮 -->
                <section class="bg-white m-t-10x p-a-10x">
                    <a href="#" class="btn btn-primary btn-block btn-sm" type="submit">Proceed To Checkout</a>
                </section>

        @endif

        @if(!empty($saveData['showSkus']))
            <!-- 暂存商品列表 -->
                <article class="font-size-md text-main p-a-10x"><strong>Saved Items</strong></article>
                <!-- 商品列表 -->
                <section class="cartList bg-white">
                    @foreach($saveData['showSkus'] as $showSku)
                        <div class="cartList-item p-a-10x @if( 1 !== $showSku['stock_status'] ) disabled @endif">
                            <div class="productInfo flex">
                                <div class="flex-fixedShrink">
                                    <img class="img-thumbnail"
                                         src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$showSku['main_image_url'] }}"
                                         width="70px" height="70px">
                                </div>
                                <div class="p-l-10x flex-width">
                                    <article class="flex flex-fullJustified">
                                        <h6 class="text-main font-size-md p-r-10x">
                                            <!--<strong>Crown Shape Black Gold-plated Sterling Silver Engage...</strong>-->
                                            <strong>{{$showSku['main_title']}}</strong>
                                        </h6>
                                        <span class="text-primary font-size-sm flex-fixedShrink">${{number_format(($showSku['sale_price'] / 100), 2)}}</span>
                                    </article>
                                    <aside class="cartItem-secondaryInfo text-primary font-size-sm">
                                        <div><span>Size: </span><span>11</span></div>
                                        <div><span>Color: </span><span>Black</span></div>
                                        <div><span>Material: </span><span>Gold</span></div>
                                        <div class="flex flex-fullJustified">
                                            <div class="">
                                                <span>Inside Engraving: </span><span>MY LOVE</span></div>
                                            <div class="">${{number_format(($showSku['total_amount']), 2)}}</div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="mask"></div>
                            </div>
                            <div class="flex p-y-10x">
                                <a class="btn btn-cartUpdate btn-sm" data-remodal-target="modal"
                                   data-sku="{{$showSku['sku']}}" data-action="delsave">Delete</a>
                                <a class="btn btn-cartUpdate btn-sm" data-product-move="movetocart"
                                   data-sku="{{$showSku['sku']}}">Move to Bag</a>
                            </div>
                        </div>
                    @endforeach
                </section>
            @endif
        </section>

        <!-- 页脚 功能链接 start-->
    @include('footer')
    <!-- 页脚 功能链接 end-->
    </div>
</div>

<!-- 删除将要购买的商品 -->
<!-- TODO remodal 有多余的样式 需要整理 -->
<div class="remodal remodal-md modal-content" data-remodal-id="modal" id="cartDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        Are you sure you want to remove <br> this item from your bag?
    </div>
    <div class="btn-group flex">
        <div class="btn remodal-btn flex-width" data-remodal-action="confirm">Remove</div>
        <div class="btn remodal-btn flex-width" data-remodal-action="cancel">Cancel</div>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingCart.js"></script>
</html>
