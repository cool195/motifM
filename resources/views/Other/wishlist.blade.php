<!DOCTYPE html>
<html lang="en">
<head>

    <title>Wishlist</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingCart.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/wishlist.css{{'?v='.config('app.version')}}">

</head>
<body>
<input type="text" id="addToCart-sku" value="1" hidden>
@include('check.tagmanager')
        <!-- 外层容器 -->
<div id="body-content">
    @include('nav')
    <div class="body-container">
        @include('navigator')
        <article class="font-size-md text-main p-a-10x bg-title"><strong>Wishlist</strong></article>
        <hr class="hr-base m-a-0">
        <!-- wishlist 商品列表 -->
        <section class="reserve-height">
            <div id="wishContainer" class="wishList m-b-20x" data-loading="false" data-pagenum="0"
                 data-wishpagenum="0">

                <!-- 空 wishlist 提示信息 -->
                <div class="shopbag-empty-content p-x-10x hidden-xs-up" id="emptyWishlist">
                    <div class="container shopbag-emptyInfo">
                        <div class="m-b-20x p-b-5x"><i class="btn-shopbagEmpty iconfont icon-like"></i></div>
                        <p class="text-primary font-size-sm m-b-20x p-b-20x">Your wishlist is empty!</p>
                    </div>
                </div>

                <!-- 商品列表 -->
            </div>
            <div class="loading wishloading" style="display: none">
                <div class="loader"></div>
            </div>
        </section>

        <!-- 页脚 功能链接 start-->
        @include('footer')
                <!-- 页脚 功能链接 end-->
    </div>
</div>

<template id="tpl-wishlist">
    @{{ each list }}
    <div class="wishlist-item bg-white" data-wishspu="@{{ $value.spu }}">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="p-a-10x">
                        <a href="/detail/@{{ $value.spu }}">
                            <img class="img-fluid img-lazy"
                                 src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                 data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.main_image_url }}">
                        </a>
                        <!-- 预售信息 -->
                        @{{ if $value.sale_type == 1 }}
                        <span class="preorder-info font-size-xs">Limited Edition</span>
                        @{{ /if }}
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="p-a-10x">
                        <article class="wishlist-title">
                            <div class="flex flex-fullJustified">
                                <a href="/detail/@{{ $value.spu }}">
                                    <h6 class="text-main font-size-sm p-r-5x p-t-15x">
                                        <strong>@{{ $value.main_title }}</strong></h6>
                                </a>
                            <span class="text-primary font-size-sm flex-fixedShrink">
                                <i class="iconfont icon-cross icon-size-md text-common delwish"
                                   data-spu="@{{ $value.spu }}"></i>
                            </span>
                            </div>
                            <div class="text-primary font-size-sm">
                                <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong></div>
                        </article>
                        <aside class="moveToBag">
                            <div class="moveToBag-itme">
                                @{{ if $value.isPutOn != 1 }}
                                <div class="warning-info off flex text-warning flex-alignCenter text-left p-y-10x">
                                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                                    <span class="font-size-xs">Sold Out</span>
                                </div>
                                @{{ /if }}
                                <div class="btn btn-primary btn-block btn-md btn-moveToBag"
                                     data-spu="@{{ $value.spu }}">Move to Bag
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr-base m-x-15x">
    </div>
    @{{ /each }}
</template>

<!-- 弹出选择属性加入购物车 -->
<div class="remodal modal-content" data-remodal-id="movetobagmodal" id="moveToBagDialog" data-spu="" data-sku="">
    <form action="">
        <div class="p-x-15x p-t-15x text-right">
            <a data-remodal-action="close"><i class="iconfont icon-cross text-common icon-size-lg"></i>
            </a>
        </div>
        <div class="product-img">
            <img class="img-thumbnail img-lazy" id="productImg" src="{{env('CDN_Static')}}/images/product/bg-product@140.png"
                 data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n1/product/motif/6118/800X800/ea4bc0f0e2796542048f14ceba7260a4.jpg" width="100" height="100">
        </div>
        <fieldset class="text-primary p-x-15x p-t-20x text-left">
            <div class="font-size-base">
                <span class="font-size-lx text-red" id="skuNewPrice">$68</span>
                <span class="font-size-sm text-throughLine text-common" id="productPrice">$90</span>
            </div>
        </fieldset>
        <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x" id="Product-prompt">
            <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
            <span class="font-size-xs"></span>
        </div>
        <!-- 商品属性列表 -->
        <section data-spu="" id="modalDialog" data-login="1" data-status="">
            <div id="product-skuAttr"></div>
        </section>
        <fieldset class="p-x-15x p-y-10x">
            <div class="flex flex-fullJustified flex-alignCenter">
                <span class="text-primary font-size-sm">Qty:</span>
                <div class="btn-group flex" id="item-count">
                    <div class="btn btn-cartCount btn-sm disabled" data-item="minus">
                        <i class="iconfont icon-minus"></i>
                    </div>
                    <div class="btn btn-cartCount btn-sm" data-num="num">1</div>

                    <div class="btn btn-cartCount btn-sm"
                         data-item="add">
                        <i class="iconfont icon-add"></i>
                    </div>
                </div>
            </div>
        </fieldset>
        <hr class="hr-dark m-a-0">

        <fieldset class="container-fluid p-a-15x">
            <!-- 添加 购物车 控制按钮显示 -->
            <div class="btn btn-primary btn-block" data-control="continue" data-role="continue" data-action="PATCH">Move To Bag
            </div>
        </fieldset>
    </form>
</div>

<template id="tpl-skuattrlist">
    @{{ each spuAttrs }}
    <fieldset class="p-x-15x p-y-10x text-left">
        <div class="container-fluid p-a-0">
            <div class="text-primary font-size-sm sparow" id="spa@{{ $value.attr_type }}"
                 data-click="false"
                 data-msg="@{{ $value.attr_type_value }}">@{{ $value.attr_type_value }}
            </div>
            <div class="row">
                @{{ each $value.skuAttrValues as value index }}
                <div class="p-t-10x p-x-5x">
                    <div class="btn btn-itemProperty btn-sm skarow" id="@{{ value.attr_value_id }}" data-image="@{{ value.img_path }}" data-spa="@{{ $value.attr_type }}" data-ska="@{{ value.attr_value_id }}">@{{ value.attr_value }}</div>
                </div>
                @{{ /each }}
            </div>
        </div>
    </fieldset>
    <hr class="hr-base m-a-0">
    @{{ /each }}
</template>

<!-- 失败 loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="error">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon-success.png"
                 srcset="{{env('CDN_Static')}}/images/icon-success@2x.png 2x, {{env('CDN_Static')}}/images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x" id="error-info"></div>
    </div>
</div>

<div class="loading loading-screen loading-transprant loading-hidden" style="z-index: 10001" id="selectmsg">
    <div class="loading-modal">
        <div class="text-white font-size-md text-center m-t-10x" id="selectspa"></div>
    </div>
</div>


<!-- 删除将要购买的商品 -->
<div class="remodal remodal-md modal-content" data-remodal-id="modal" id="wishDialog" data-spu="">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        Are you sure you want to remove this item?
    </div>
    <div class="btn-group flex">
        <div class="btn remodal-btn flex-width" data-remodal-action="confirm">Remove</div>
        <div class="btn remodal-btn flex-width" data-remodal-action="cancel">Cancel</div>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden" id="loading">
    <div class="loader loader-screen"></div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/wishlist.js{{'?v='.config('app.version')}}"></script>
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
