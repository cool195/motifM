<!DOCTYPE html>
<html lang="en">
<head>
    <title>shopping</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingList.css{{'?v='.config('app.version')}}">
</head>
<body>

<div id="body-content">
    @include('nav')
    <div class="body-container" style="padding-top: 44px">
        <!-- 头部导航 -->
        @include('navigator')
        <nav class="bg-white nav-category">
            <div class="text-center p-t-15x p-b-10x titDiv">
                <button style="border: none;background-color: white" class="text-main font-size-lg" id="nav-categoryTit">All</button>
            </div>
            <!-- 商品类别 二级导航 -->
            <section class="bg-white search-container">
                @if(isset($categories))
                    @foreach($categories as $key => $c)
                        <button style="width:100%;border: none;background-color: white" class="p-a-15x search-item {{ 'cateClick'.$c['category_id'] }}"
                                data-categoryid="{{ $c['category_id'] }}" data-categoryname="{{ $c['category_name'] }}">
                            <span class="text-primary font-size-sm text-right">{{ $c['category_name'] }}</span>
                            <i class="iconfont icon-check icon-size-md text-primary"></i>
                        </button>
                    @endforeach
                @endif
                <hr class="hr-base m-a-0">
            </section>
            <!--排序-->
            <select class="font-size-sm text-main btn-sortBy" id="sortBy">
                <option data-searchtext="reset">Reset</option>
                @foreach($search['list'] as $value)
                    @if($value['attr_type']==1)
                        <option data-search="{{$value['attr_id']}}" data-searchtext="{{$value['attr_label']}}">{{$value['attr_label']}}</option>
                    @endif
                @endforeach
            </select>
            <span class="falseSortBy text-primary font-size-sm">Sort By</span>
        </nav>
        <!-- 商品列表-->
        <div class="lowTo p-y-15x bg-white disabled">{{--disabled--}}
            <hr class="hr-base m-a-0">
            <span class="p-x-15x text-common font-size-sm lowTo-info">Low to High</span>
        </div>
        <div class="container-fluid" id="productList-container" data-loading="false" data-pagenum="0">
            <div class="loading m-y-10x" style="display: none;">
                <div class="loader"></div>
            </div>
            <div class="row red-productList">

            </div>
        </div>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>


</body>

<!-- 模板 -->
<template id="tpl-product-redsquare">
    @{{ each list }}
    <div class="col-xs-6 p-a-0">
        <div class="productList-item">
            <div class="image-bg">
                <div class="image-container">
                    <a data-link="/savedetail/@{{ $value.spu }}" data-impr="@{{ $value.impr }}" data-clk="@{{ $value.clk }}"
                       href="javascript:void(0)" data-spu="@{{ $value.spu }}" data-title="@{{ $value.main_title }}"
                       data-price="@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}">
                        <div class="swiper-container productList-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid swiper-lazy"
                                         data-src="{{env('APP_Api_Image')}}/n1/@{{ $value.main_image_url }}"
                                         alt="">
                                    <img class="img-fluid preloader"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@336.png" alt="">
                                </div>
                                @{{ each $value.image_paths as value index }}
                                <div class="swiper-slide">
                                    <img class="img-fluid img-lazy"
                                         src="{{env('APP_Api_Image')}}/n1/@{{ value }}"
                                         alt="@{{ $value.main_title }}">
                                </div>
                                @{{ /each }}

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </a>
                    @{{ if $value.sale_type == 1 }}
                    {{--预售产品 预定信息--}}
                    <span class="preorder-info font-size-xs">Limited Edition</span>
                    @{{ /if }}
                </div>
            </div>
            <div class="font-size-sm product-title text-main">
                @{{ $value.main_title }}
            </div>
            <div class="price-caption">
                @{{ if $value.skuPrice.sale_price != $value.skuPrice.price }}
                <span class="font-size-sm m-l-5x text-primary">
                    <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong>
                </span>
                <span class="font-size-xs text-green text-throughLine">$@{{ ($value.skuPrice.skuPromotion.price/100).toFixed(2) }}</span>
                @{{ else }}
                <span class="font-size-sm m-l-5x">
                    <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong>
                </span>
                @{{ /if }}
            </div>
        </div>
    </div>
    @{{ /each }}
</template>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/store.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    @if($selectCid != 0)
        var selectCid = '{{'.cateClick'.$selectCid}}';
        $(selectCid).click();
        $('#nav-categoryTit').click();
    @endif
</script>
@include('global')
</html>
