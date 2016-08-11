<!DOCTYPE html>
<html lang="en">
<head>
    <title>designer</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/designer.css">
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
    <!-- designer 设计师首页 -->
        <section class="reserve-height">
            <!-- 设计师列表 -->


            <!-- 设计师及其商品列表 -->
            <div id="designerContainer" data-pagenum="0" data-loading="false">
                <div class="designer-content">
                </div>
                <div class="loading" style="display: none">
                    <div class="loader"></div>
                </div>
            </div>

        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<!-- 模板 -->
<template id="tpl-designer">
    @{{ each list }}
    <aside class="bg-white m-b-10x">
        <div class="">
            <a data-link="/designer/@{{$value.designerId}}"
               data-impr='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v=<?="\"action\":0,\"skipType\":2,\"skipId\":"?>@{{ $value.designerId }}<?=",\"expid\":0,\"version\":\"1.0.1\", \"ver\":\"9.2\",\"src\":\"H5\" "?>'
               data-clk='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v=<?="\"action\":0,\"skipType\":2,\"skipId\":"?>@{{ $value.designerId }}<?=",\"expid\":0,\"version\":\"1.0.1\",\"ver\":\"9.2\",\"src\":\"H5\" "?>'
               href="javascript:void(0)">
                <img class="img-fluid img-lazy" data-original="{{env('APP_Api_Image')}}/n2/@{{ $value.listImg }}" src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="@{{ $value.name }}">
            </a>
        </div>
        <div class="p-x-10x p-y-15x swiper-container" id="designer-container">
            <div class="swiper-wrapper">
                @{{ each $value.products }}
                <div class="product-item swiper-slide p-x-5x">
                    <a data-link="/detail/@{{$value.spu}}" href="javascript:void(0)"
                       data-designerid="@{{ $value.designerId }}"
                       data-clk='http://clk.motif.me/log.gif?t=designer.300001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v=<?="\"action\":0,\"skipType\":2,\"skipId\":"?>@{{ $value.designerId }}<?=",\"expid\":0,\"version\":\"1.0.1\", \"ver\":\"9.2\",\"src\":\"H5\" "?>'>
                        <img class="img-fluid"
                             src="{{env('APP_Api_Image')}}/n2/@{{ $value.mainImage }}">
                    </a>
                </div>
                @{{ /each }}
            </div>
        </div>
    </aside>
    @{{ /each }}
</template>
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>

<script src="{{env('CDN_Static')}}/scripts/designer.js?v=3"></script>
@include('global')
</html>
