<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>shopping</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/shoppingList.css">

    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body class="body-tabs">
<!-- App 下载提示 -->
<!--<nav class="navbar-fixed-bottom bg-download p-y-10x p-x-15x flex flex-fullJustified flex-alignCenter">-->
<!--<div class="flex flex-alignCenter">-->
<!--<span class="p-r-20x"><a href="#"><i class="iconfont icon-cross text-common"></i></a></span>-->
<!--<span class="p-r-15x"><img src="/images/icon/icon-motif.png"-->
<!--srcset="/images/icon/icon-motif@2x.png 2x,/images/icon/icon-motif@3x.png 3x">-->
<!--</span>-->
<!--<span class="p-r-15x font-size-sm text-primary">Find More With MOTIF App</span>-->
<!--</div>-->
<!--<div class="font-size-sm"><a href="#">DOWNLOAD</a></div>-->
<!--</nav>-->
<!-- 头部导航 -->
@include('navigator')
<nav class="navbar-fixed-top swiper-container bg-gray" id="tabIndex-container">
    <ul class="nav nav-tabs swiper-wrapper">
        @foreach($categories as $key => $c)
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-earrings @if($key!=0) inactive @endif">
                    <span class="font-size-sm m-l-5x">{{ $c['category_name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
<section class="swiper-container p-b-10x" id="tabs-container" data-loading="">
    <div class="swiper-wrapper">
        @foreach($categories as $c)
            <div class="swiper-slide" data-loading="">
                <div class="container-fluid p-x-10x p-t-10x">
                    <div class="row">
                    </div>
                </div>
                <div class="loading" style="display: none">
                    <div class="loader"></div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!-- 页脚 功能链接 -->
@include('footer')
</body>
<!-- 模板 -->
<template id="tpl-product">
    @{{ each list }}
    <div class="col-xs-6">
        <div class="productList-item">
            <div class="image-bg">
                <div class="image-container">
                    <a href="/products/@{{ $value.spu }}">
                        <img class="img-fluid" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/@{{ $value.main_image_url }}" alt="@{{ $value.main_title }}">
                        @{{ if $value.skuPrice.sale_price !== $value.skuPrice.price }}
                        <div class="price-off">
                            <strong class="font-size-sm">@{{ $value.skuPrice.skuPromotion.display }}</strong>
                        </div>
                        @{{ /if }}
                    </a>
                </div>
            </div>
            <div class="price-caption">
                <span class="font-size-sm m-l-5x">
                    <strong>$@{{ $value.skuPrice.price }}</strong>
                </span>
                @{{ if $value.skuPrice.skuPromotion !== undefined }}
                <span class="font-size-xs text-common text-throughLine m-l-5x">$@{{ $value.skuPrice.price }}</span>
                @{{ /if }}
            </div>
        </div>
    </div>
    @{{ /each }}
</template>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingList.js"></script>
</html>
