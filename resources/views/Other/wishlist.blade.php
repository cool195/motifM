<!DOCTYPE html>
<html lang="en">
<head>

    <title>Wishlist</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingCart.css">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css">


</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    @include('nav')
    <div class="body-container">
    @include('navigator')

        <!-- wishlist 商品列表 -->
        <section class="reserve-height">
            <!-- 商品列表 -->
            <aside id="wishContainer" class="wishList bg-white m-b-20x" data-loading="false" data-pagenum="0" data-wishpagenum="0">

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
    <div class="wishlist-item p-a-15x" data-wishspu="@{{ $value.spu }}">
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
                    <h6 class="text-main font-size-md p-r-20x">
                        <strong>@{{ $value.main_title }}</strong>
                    </h6>
                                    <span class="text-primary font-size-sm flex-fixedShrink">
                                        <i class="iconfont icon-cross icon-size-md text-common delwish" data-spu="@{{ $value.spu }}"></i>
                                    </span>
                </article>
                <aside class="text-primary font-size-sm">
                    <div>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</div>
                </aside>
            </div>
        </div>
    </div>
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>

<script src="{{env('CDN_Static')}}/scripts/wishlist.js"></script>
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
