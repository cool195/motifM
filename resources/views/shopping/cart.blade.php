<!DOCTYPE html>
<html lang="en">
<head>

    <title>Shopping Cart</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingCart.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">


</head>
<body>
<input type="text" id="removeFromCart-name" value="" hidden>
<input type="text" id="removeFromCart-spu" value="" hidden>
<input type="text" id="removeFromCart-price" value="" hidden>
<input type="text" id="removeFromCart-quantity" value="" hidden>
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    function onRemoveFromCart() {
        var name = document.getElementById('removeFromCart-name').value;
        var spu = document.getElementById('removeFromCart-spu').value;
        var price = document.getElementById('removeFromCart-price').value;
        var quantity = document.getElementById('removeFromCart-quantity').value;
        dataLayer.push({
            'event': 'removeFromCart',
            'ecommerce': {
                'remove': {
                    'products': [{
                        'name': name,
                        'id': spu,
                        'price': price,
                        'brand': 'Motif',
                        'category': '',
                        'variant': '',
                        'quantity': quantity
                    }]
                }
            }
        });
    }
</script>

@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    @include('nav')
    <div class="body-container">
    @include('navigator')
    <!-- 购物袋 商品列表 -->
        <section class="p-b-20x reserve-height">
            <!-- 满额包邮 -->
            @inject('getDate', 'App\Services\Publicfun')
            @if(!empty($getDate->configMap()))
                <article class="font-size-sm p-a-10x m-t-10x text-center bg-primary">{{$getDate->configMap()}}</article>
            @endif
            <!-- "Shopping Bag" 标题 -->
            <article class="font-size-md text-main p-a-10x bg-title"><strong>My Bag</strong></article>
            <hr class="hr-base m-a-0">

        @if(empty($cartData['showSkus']))
            <!-- 空袋子 提示信息 -->
                <div class="shopbag-empty-content p-x-10x">
                    <div class="container shopbag-emptyInfo">
                        <div class="m-b-20x p-b-5x"><i class="btn-shopbagEmpty iconfont icon-shopbag"></i></div>
                        <p class="text-primary font-size-sm m-b-20x p-b-20x">Your bag is empty. Fill it up</p>
                        <a href="/daily" class="btn btn-primary btn-block">Go Shopping</a>
                    </div>
                </div>
        @else
            <!-- 商品列表 -->
                <section class="cartList bg-white">
                    @if(isset($cartData['showSkus']))
                        @foreach($cartData['showSkus'] as $showSku)
                            <div class="cartList-item p-a-10x @if(!$showSku['stock_status'] || 1 != $showSku['isPutOn']) disabled @endif">
                                <a @if(0 != $showSku['stock_status'] && 1 == $showSku['isPutOn']) href="/detail/{{$showSku['spu']}}" @endif class="inBag">
                                    <div class="productInfo flex">
                                        <div class="flex-fixedShrink">
                                            <img class="img-thumbnail img-lazy"
                                                 src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                                                 data-original="{{ env('APP_Api_Image').'/n2/'.$showSku['main_image_url'] }}"
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
                                                @if(isset($showSku['attrValues']))
                                                    @foreach($showSku['attrValues'] as $attrValue)
                                                        <div><span>{{$attrValue['attr_type_value'] }}: </span><span>{{ $attrValue['attr_value'] }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($showSku['showVASes']) && !empty($showSku['showVASes']))
                                                    @foreach($showSku['showVASes'] as $showVAS)
                                                        <div class="flex flex-fullJustified">
                                                            <div class="">
                                                                <span>{{$showVAS['vas_name']}}: </span><span>{{$showVAS['user_remark']}}</span>
                                                            </div>
                                                            <div class="">
                                                                ${{number_format(($showVAS['vas_price'] / 100), 2)}}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </aside>
                                        </div>
                                        <div class="mask"></div>
                                    </div>
                                </a>
                                <div class="flex flex-alignCenter flex-fullJustified p-y-10x">
                                    <div class="flex">
                                        <a class="btn btn-cartUpdate btn-sm btn-inBag" data-remodal-target="modal"
                                           data-sku="{{$showSku['sku']}}" data-action="delsku" data-title="{{$showSku['main_title']}}" data-price="{{number_format(($showSku['sale_price'] / 100), 2)}}"
                                        data-qtty="{{$showSku['sale_qtty']}}" data-spu="{{$showSku['spu']}}">Remove</a>
                                        @if(Session::get('user.pin'))
                                        <a href="#" class="btn btn-cartUpdate btn-sm btn-inBag" data-product-move="save"
                                           data-sku="{{$showSku['sku']}}">Save for Later</a>
                                        @endif
                                    </div>
                                    <div class="flex flex-alignCenter">
                                        <span class="text-primary font-size-sm m-r-5x">Qty:</span>
                                        <div class="btn-group flex item-count" data-sku="{{$showSku['sku']}}">
                                            <div class="btn btn-cartCount btn-sm btn-minus @if($showSku['sale_qtty'] <=1 || !$showSku['stock_status'] || 1 != $showSku['isPutOn']) disabled @endif"
                                                 data-item="minus">
                                                <i class="iconfont icon-minus"></i>
                                            </div>
                                            <div class="btn btn-cartCount btn-sm"
                                                 data-count="{{$showSku['sale_qtty']}}">{{$showSku['sale_qtty']}}</div>
                                            <div class="btn btn-cartCount btn-sm btn-add @if($showSku['sale_qtty'] >=50 || !$showSku['stock_status'] || 1 != $showSku['isPutOn']) disabled @endif"
                                                 data-item="add">
                                                <i class="iconfont icon-add"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(0 == $showSku['stock_status'] || 2 == $showSku['stock_status'] || 1 != $showSku['isPutOn'])
                                <div class="text-warning font-size-xs">@if(2 !== $showSku['stock_status'])Warning: @endif{{$showSku['prompt_info']}}</div>
                                @elseif(50 == $showSku['sale_qtty'])
                                <div class="text-warning font-size-xs">Warning: 50 items limit</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </section>
                <div class="hr-between"></div>
                <!-- 商品总价 -->
                <section class="bg-white p-a-10x">
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Items ({{$cartData['total_sku_qtty'] }}):
                        </span><strong>${{number_format($cartData['total_amount'] /100, 2)}}</strong>
                    </div>
                    @if($cartData['vas_amount'] > 0)
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Additional Services: </span><strong>${{ number_format($cartData['vas_amount'] / 100, 2) }}</strong>
                    </div>
                    @endif
                    <div class="flex flex-rightJustify text-primary font-size-sm">
                        <span class="p-r-5x">Bag Subtotal: </span><strong>${{ number_format($cartData['pay_amount'] / 100, 2)}}</strong>
                    </div>
                </section>
                <hr class="hr-base m-a-0">
                <!-- 购买按钮 -->
                <section class="bg-white p-a-10x">
                    @if(Session::get('user.pin'))
                        <a href="/checkout/shipping" data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=check.100002&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&ref=&v={"skipType":"processedcheckout","skipId":"","version":"1.0.1","ver":"9.2","src":"H5"}'
                       class="btn btn-primary btn-block @if($cartData['pay_amount'] <= 0) disabled @endif" type="submit">Proceed to
                        Checkout</a>
                    @else
                        <a href="/login" class="btn btn-primary btn-block @if($cartData['pay_amount'] <= 0) disabled @endif" type="submit">Proceed toCheckout</a>
                    @endif

                </section>
            <script>
                var content_ids = [@foreach($cartData['showSkus'] as $key => $product) @if(0 == $key)'{{$product['spu']}}' @else ,'{{$product['spu']}}' @endif @endforeach];
                var totalPrice="{{ number_format($cartData['pay_amount'] / 100, 2)}}";
            </script>
        @endif

        @if(Session::get('user.pin') && !empty($saveData['showSkus']))
            <!-- 暂存商品列表 -->
                <hr class="hr-base m-a-0">
                <article class="font-size-md text-main p-a-10x bg-title"><strong>Saved</strong></article>
                <hr class="hr-base m-a-0">
                <!-- 商品列表 -->
                <section class="cartList bg-white">
                    @if(isset($saveData['showSkus']))
                        @foreach($saveData['showSkus'] as $showSku)
                            {{-- TODO 需要添加 商品是否上架的判断 --}}
                            <div class="cartList-item p-a-10x @if( 0 == $showSku['stock_status'] || 1 != $showSku['isPutOn'] ) disabled @endif">
                                <a @if(1 == $showSku['stock_status'] && 1 == $showSku['isPutOn']) href="/detail/{{$showSku['spu']}}" @endif class="inSaved">
                                    <div class="productInfo flex">
                                        <div class="flex-fixedShrink">
                                            <img class="img-thumbnail img-lazy"
                                                 src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                                                 data-original="{{ env('APP_Api_Image').'/n2/'.$showSku['main_image_url'] }}"
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
                                                @if(isset($showSku['attrValues']))
                                                    @foreach($showSku['attrValues'] as $attrValue)
                                                        <div><span>{{$attrValue['attr_type_value'] }}
                                                                : </span><span>{{ $attrValue['attr_value'] }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(isset($showSku['showVASes']) && !empty($showSku['showVASes']))
                                                    @foreach($showSku['showVASes'] as $showVAS)
                                                        <div class="flex flex-fullJustified">
                                                            <div class="">
                                                            <span>{{$showVAS['vas_name']}}
                                                                : </span><span>{{$showVAS['user_remark']}}</span></div>
                                                            <div class="">
                                                                ${{number_format(($showVAS['vas_price']), 2)}}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </aside>
                                        </div>
                                        <div class="mask"></div>
                                    </div>
                                </a>
                                <div class="flex p-y-10x">
                                    <a class="btn btn-cartUpdate btn-sm btn-inSaved" data-remodal-target="modal" data-sku="{{$showSku['sku']}}" data-action="delsave">
                                        Remove
                                    </a>
                                    <a class="btn btn-cartUpdate btn-sm btn-inSaved @if(0 == $showSku['stock_status'] || 1 != $showSku['isPutOn']) disabled @endif" data-product-move="movetocart" data-sku="{{$showSku['sku']}}">
                                        @if(0 == $showSku['stock_status'] || 1 != $showSku['isPutOn'])
                                            Listing Ended
                                        @else
                                            Move to Bag
                                        @endif
                                    </a>
                                </div>
                                @if(0 == $showSku['stock_status'] || 2 == $showSku['stock_status'] || 1 != $showSku['isPutOn'])
                                    <div class="text-warning font-size-xs">{{$showSku['prompt_info']}}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
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
        Are you sure you want to remove this item?
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/shoppingCart.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
