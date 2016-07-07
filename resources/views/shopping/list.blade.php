<!DOCTYPE html>
<html lang="en">
<head>
    <title>shopping</title>
    @include('head')
    <link rel="stylesheet" href="/styles/shoppingList.css">
</head>
<body>
@include('check.tagmanager')
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
<!-- 外层容器-->
<div id="body-content">
    @include('nav')
    <div class="body-container">
        <!-- 头部导航 -->
        @include('navigator')
        <nav class="navbar-fixed-top swiper-container bg-gray" id="tabIndex-container">
            <ul class="nav nav-tabs swiper-wrapper">
                @if(isset($categories))
                    @foreach($categories as $key => $c)
                        <li class="nav-item swiper-slide" data-tab-index="{{ $c['category_id'] }}" id="{{ $c['category_id'] }}">
                            <a class="nav-flex flex-alignCenter underLine-item text-primary m-x-15x p-y-10x nav-productType @if($key!=0) inactive @endif">
                                <img class="img-fluid img-icon" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$c['img_path'] }}" srcset="https://s3-us-west-1.amazonaws.com/emimagetest/n1/{{$c['img_path'] }} 2x,https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$c['img_path'] }} 3x">
                                <img class="img-fluid img-icon-active" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$c['img_path2'] }}" srcset="https://s3-us-west-1.amazonaws.com/emimagetest/n1/{{$c['img_path2'] }} 2x, https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$c['img_path2'] }} 3x">
                                <span class="font-size-sm m-l-5x">{{ $c['category_name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
        <section class="swiper-container p-b-10x reserve-height" id="tabs-container">
            <div class="swiper-wrapper">
                @if(isset($categories))
                    @foreach($categories as $c)
                        <div class="swiper-slide" data-loading="false" data-pagenum="0">
                            <div class="container-fluid p-x-10x p-t-10x">
                                <div class="row">
                                </div>
                            </div>
                            <div class="loading" style="display: none">
                                <div class="loader"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- 下载 App Download MOTIF -->
<div class="remodal remodal-md modal-content" data-remodal-id="download-modal" id="downloadModal">
    <div class="text-right p-x-15x p-t-15x" data-remodal-action="close">
        <i class="iconfont icon-cross icon-size-md text-common"></i>
    </div>
    <!-- 提示: 打开 app -->
    <div class="view-content" hidden>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            We supply this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <a class="btn btn-primary btn-block btn-sm" href="">View in MOTIF App</a>
        </div>
    </div>
    <!-- 提示: 下载 app -->
    <div class="download-content" hidden>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            We supply this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <div class="btn btn-primary btn-block btn-sm" data-role="downloading">Download MOTIF App
            </div>
        </div>
    </div>
    <!-- 提示: 不支持此设备 -->
    <div class="app-content" hidden>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            Your device is not supported.<br>It's available in stores below.
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <div class="field-items">
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="/images/icon/icon-appStore.png" srcset="/images/icon/icon-appStore@2x.png 2x, /images/icon/icon-appStore@3x.png 3x">
                </a>
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="/images/icon/icon-googlePlay.png" srcset="/images/icon/icon-googlePlay@2x.png 2x, /images/icon/icon-googlePlay@3x.png 3x">
                </a>
            </div>
        </div>
    </div>
</div>

</body>
<!-- 模板 -->
<template id="tpl-product">
    @{{ each list }}
    <div class="col-xs-6">
        <div class="productList-item">
            <div class="image-bg">
                <div class="image-container">
                    <a href="/detail/@{{ $value.spu }}" data-impr="@{{ $value.impr }}" data-clk="@{{ $value.clk }}">
                        <img class="img-fluid img-lazy"
                             data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n1/@{{ $value.main_image_url }}"
                             src="/images/product/bg-product@336.png" alt="@{{ $value.main_title }}">
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
                    <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong>
                </span>
                @{{ if $value.skuPrice.sale_price !== $value.skuPrice.price }}
                <span class="font-size-xs text-common text-throughLine m-l-5x">$@{{ ($value.skuPrice.price/100).toFixed(2) }}</span>
                @{{ /if }}
            </div>
        </div>
    </div>
    @{{ /each }}
</template>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingList.js"></script>
@include('global')
</html>
