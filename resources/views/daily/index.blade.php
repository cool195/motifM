<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daily</title>

    @include('head')

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/daily.css">
    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js"></script>
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
    <!-- daily 首页列表 -->
        <section id="dailyContainer" class="reserve-height" data-loading="false" data-pagenum="0" data-productpagenum="0">
            <div class="daily-content">

            </div>

            <div class="loading" style="display: none">
                <div class="loader"></div>
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<!-- 模板 -->
<!-- TODO 增加图文中 图片类型标签,如:热卖、新品、促销 目前接口中还没相应数据 -->
<template id="tpl-daily">
    @{{ each list }}
    @{{ if $value.type == "1" }}
    <div class="bg-white m-b-10x">
        <a href="@{{ if $value.skipType == 1 }}/detail/@{{ else if $value.skipType == 2 }}/designer/@{{ else if $value.skipType == 3 }}/topic/@{{ else if $value.skipType == 4 }}/shopping#@{{ /if }}@{{ $value.skipId }}">
            <img class="img-fluid img-lazy"
                 data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.imgPath }}"
                 src="/images/product/bg-product@750.png">
        </a>
    </div>
    @{{ /if }}
    @{{ if $value.type == "2" }}
    <a data-impr='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v=<?="{\"action\":0,\"type\":"?>@{{ $value.type }}<?=",\"imgtextType\":"?>@{{ $value.imgtextType }}<?=",\"skipType\","?>@{{ $value.skipType }}<?=",\"skipId\":"?>@{{ $value.skipId }}<?=",\"sortNo\":" ?>@{{ $value.sortNo }}<?=",\"expid\":0,\"index\": 1"?>@{{ xxx }}<?=",\"version\":\"1.0.1\", \"ver\":\"9.2\", \"src\":\"H5\"}"?>'
       data-clk='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v=<?="{\"action\":0,\"type\":"?>@{{ $value.type }}<?=",\"imgtextType\":"?>@{{ $value.imgtextType }}<?=",\"skipType\","?>@{{ $value.skipType }}<?=",\"skipId\":"?>@{{ $value.skipId }}<?=",\"sortNo\":" ?>@{{ $value.sortNo }}<?=",\"expid\":0,\"index\": 1"?>@{{ xxx }}<?=",\"version\":\"1.0.1\", \"ver\":\"9.2\", \"src\":\"H5\"}"?>'
       href="@{{ if $value.skipType == 1 }}/detail/@{{ else if $value.skipType == 2 }}/designer/@{{ else if $value.skipType == 3 }}/topic/@{{ else if $value.skipType == 4 }}/shopping#@{{ /if }}@{{ $value.skipId }}">
        <div class="bg-white m-b-10x">
            <div class="daily-imgInfo">
                <img class="img-fluid img-lazy"
                     data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.imgPath }}"
                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="@{{ $value.title }}">
                @{{ if $value.imgtextType }}<span class="img-icon font-size-xs"><strong>@{{ $value.imgtextType }}</strong></span>@{{ /if }}
            </div>
            <div class="p-a-15x">
                <h6 class="text-main font-size-base m-b-5x"><strong>@{{ $value.title }}</strong></h6>
                <div class="text-primary font-size-sm">@{{ $value.subTitle }}</div>
            </div>
        </div>
    </a>
    @{{ /if }}
    @{{ /each }}
</template>
<!-- 更多商品图片 模板 -->
{{--<template id="tpl-product">--}}
    {{--@{{ each list }}--}}
    {{--<a data-impr="@{{ $value.impr }}" data-clk="@{{ $value.clk }}" href="/detail/@{{ $value.spu }}">--}}
        {{--<div class="bg-white m-b-10x">--}}
            {{--<div class="daily-imgInfo">--}}
                {{--<img class="img-fluid img-lazy" data-original="{{env('APP_Api_Image')}}/n2/@{{ $value.main_image_url }}" src="/images/product/bg-product@750.png" alt="@{{ $value.title }}">--}}
            {{--</div>--}}
            {{--<div class="p-a-15x">--}}
                {{--<h6 class="text-main font-size-base m-b-5x"><strong>@{{ $value.main_title }}</strong></h6>--}}
                {{--<div class="text-primary font-size-sm">@{{ $value.sub_title }}</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</a>--}}
    {{--@{{ /each }}--}}
{{--</template>--}}

<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>

<script src="{{env('CDN_Static')}}/scripts/daily.js"></script>
@include('global')
</html>
