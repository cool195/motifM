<!DOCTYPE html>
<html lang="en">
<head>

    <title>Wishlist</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingCart.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">


</head>
<body>
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
            <aside id="wishContainer" class="wishList m-b-20x" data-loading="false" data-pagenum="0"
                   data-wishpagenum="0">

                <!-- 空 wishlist 提示信息 -->
                <div class="shopbag-empty-content p-x-10x hidden-xs-up" id="emptyWishlist">
                    <div class="container shopbag-emptyInfo">
                        <div class="m-b-20x p-b-5x"><i class="btn-shopbagEmpty iconfont icon-like"></i></div>
                        <p class="text-primary font-size-sm m-b-20x p-b-20x">Your wishlist is empty!</p>
                    </div>
                </div>

                <!-- 商品列表 -->
            </aside>
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
    <div class="wishlist-item bg-white p-a-15x" data-wishspu="@{{ $value.spu }}">
        <div class="flex">
            <div class="flex-fixedShrink">
                <a href="/detail/@{{ $value.spu }}">
                    <img class="img-thumbnail img-lazy"
                         src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                         data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.main_image_url }}"
                         width="70" height="70">
                </a>
            </div>
            <div class="p-l-10x flex-width">
                <article class="flex flex-fullJustified wishlist-title">
                    <a href="/detail/@{{ $value.spu }}"><h6 class="text-main font-size-md p-r-20x">
                        <strong>@{{ $value.main_title }}</strong>
                    </h6></a>
                                    <span class="text-primary font-size-sm flex-fixedShrink">
                                        <i class="iconfont icon-cross icon-size-md text-common delwish"
                                           data-spu="@{{ $value.spu }}"></i>
                                    </span>
                </article>
                <a href="/detail/@{{ $value.spu }}">
                    <aside class="text-primary font-size-sm">
                        <div>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</div>
                    </aside>
                </a>
            </div>
        </div>
    </div>
    <hr class="hr-base m-a-0">
    @{{ /each }}
</template>

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
<div class="loading loading-screen loading-switch loading-hidden">
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
