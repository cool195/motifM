<!DOCTYPE html>
<html lang="en">
<head>
    <title>designer</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/designer.css{{'?v='.config('app.version')}}">
    <script src="https://www.youtube.com/player_api"></script>
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
            @{{ if $value.listVideoId == undefined }}
                <a data-link="/designer/@{{$value.designerId}}"
                   data-impr='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"0","skiptype":2,"skipid":"@{{ $value.designerId }}","expid":0,"version":"1.0.1", "ver":"9.2","src":"h5"}'
                   data-clk='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"1","skiptype":2,"skipid":"@{{ $value.designerId }}","expid":0,"version":"1.0.1", "ver":"9.2","src":"h5"}'
                   href="javascript:void(0)">
                    <img class="img-fluid img-lazy" data-original="{{env('APP_Api_Image')}}/n2/@{{ $value.listImg }}" src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="@{{ $value.name }}">
                </a>
            @{{ else }}
                <div class="designer-media bg-white m-b-10x">
                    <div class="player-item" data-playid="@{{$value.listVideoId}}">
                        <div id="@{{$value.listVideoId}}" class="ytplayer" data-playid="@{{$value.listVideoId}}"></div>
                        <div class="bg-player">
                            <img class="bg-img" src="{{env('APP_Api_Image')}}/n1/@{{ $value.listImg }}" alt="">
                            <div class="btn-beginPlayer">
                                {{--<img src="/images/daily/icon-player.png"--}}
                                     {{--srcset="/images/daily/icon-player@2x.png 2x,/images/daily/icon-player@3x.png 3x"--}}
                                     {{--alt="">--}}
                                <div class="loading-screen loading-play">
                                    <div class="">
                                        <div class="loader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-morePlayer">
                            <a class="text-white font-size-sm" data-link="/designer/@{{$value.designerId}}"
                               data-impr='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"0","skiptype":2,"skipid":"@{{ $value.designerId }}","expid":0,"version":"1.0.1", "ver":"9.2","src":"h5"}'
                               data-clk='http://clk.motif.me/log.gif?t=designer.200001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"1","skiptype":2,"skipid":"@{{ $value.designerId }}","expid":0,"version":"1.0.1", "ver":"9.2","src":"h5"}'
                               href="javascript:void(0)"><strong>Click for More</strong></a>
                        </div>
                    </div>
                </div>
            @{{ /if }}

        </div>
        <div class="p-x-10x p-y-15x swiper-container" id="designer-container">
            <div class="swiper-wrapper">
                @{{ each $value.products }}
                <div class="product-item swiper-slide p-x-5x">
                    <a data-link="/detail/@{{$value.spu}}" href="javascript:void(0)"
                       data-designerid="@{{ $value.designerId }}"
                       data-clk='http://clk.motif.me/log.gif?t=designer.300001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"1","skiptype":2,"skipid":"@{{ $value.designerId }}","expid":0,"version":"1.0.1", "ver":"9.2","src":"h5"}'>
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/designer.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/dailyVideoPlay.js"></script>
@include('global')
</html>
