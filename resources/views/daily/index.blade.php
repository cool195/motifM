<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daily</title>

    @include('head')
    <meta property="og:image" content="http://cdn.m.motif.me/apple-touch-icon.png" />
    <meta property="og:title" content="MOTIF Exclusive Fashion Accessories Designed by the World’s Top Fashion Bloggers, Instagrammers and Digital Influencers" />
    <meta property="og:url" content="http://m.motif.me" />
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/daily.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/template-native.js{{'?v='.config('app.version')}}"></script>
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
        <section id="dailyContainer" class="reserve-height" data-loading="false" data-pagenum="0"
                 data-productpagenum="0">
            <div class="daily-content">

            </div>
            <input hidden id="puton" value="{{$puton}}">
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
    <div class="bg-white">
        <a data-impr='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":"0","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
           data-clk='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":"1","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
           data-link="@{{ if $value.skipType == 1 }}/detail/@{{ else if $value.skipType == 2 }}/designer/@{{ else if $value.skipType == 3 }}/topic/@{{ else if $value.skipType == 4 }}/shopping#@{{ /if }}@{{ $value.skipId }}"
           data-imprt='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v='
           href="javascript:void(0)">
            <img class="img-fluid img-lazy"
                 data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.imgPath }}"
                 src="{{env('CDN_Static')}}/images/product/bg-product@750.png">
        </a>
    </div>
    @{{ /if }}
    @{{ if $value.type == "2" }}
    <a data-clk='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":"1","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
       data-link="@{{ if $value.skipType == 1 }}/detail/@{{ else if $value.skipType == 2 }}/designer/@{{ else if $value.skipType == 3 }}/topic/@{{ else if $value.skipType == 4 }}/shopping#@{{ /if }}@{{ $value.skipId }}"
       data-impr='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":"0","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
       href="javascript:void(0)">
        <div class="bg-white">
            <div class="daily-imgInfo">
                <img class="img-fluid img-lazy"
                     data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.imgPath }}"
                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="@{{ $value.title }}">
                @{{ if $value.imgtextType }}<span
                        class="img-icon font-size-xs"><strong>@{{ $value.imgtextType }}</strong></span>@{{ /if }}
            </div>
            <div class="p-a-15x">
                <h6 class="text-main font-size-base m-b-5x"><strong>@{{ $value.title }}</strong></h6>
                <div class="text-primary font-size-sm">@{{ $value.subTitle }}</div>
            </div>
        </div>
    </a>
    @{{ /if }}

    @{{ if $value.type == "3" }}
    <div class="designer-media bg-white">
        <div class="player-item" data-playid="@{{ $value.videoId }}">
            <div id="@{{ $value.videoId }}" class="ytplayer" data-playid="@{{ $value.videoId }}"></div>
            <div class="bg-player">
                <img class="bg-img" src="{{env('APP_Api_Image')}}/n1/@{{ $value.imgPath }}" alt="">
                <div class="btn-beginPlayer">
                    {{--<img src="/images/daily/icon-player.png"--}}
                         {{--srcset="/images/daily/icon-player@2x.png 2x,/images/daily/icon-player@3x.png 3x" alt="">--}}
                    <div class="loading-screen loading-play">
                        <div class="">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="youtube_mask"></div>
            <div class="btn-morePlayer">
                <a class="text-white font-size-sm video-formore" data-impr='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":"0","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
                   data-clk='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":"1","type":"@{{ $value.type }}","imgtexttype":"@{{ $value.imgtextType }}","skiptype":"@{{ $value.skipType }}","skipid":"@{{ $value.skipId }}","sortno":"@{{ $value.sortNo }}","expid":0,"index": 1,"version":"1.0.1", "ver":"9.2", "src":"h5"}'
                   data-link="@{{ if $value.skipType == 1 }}/detail/@{{ else if $value.skipType == 2 }}/designer/@{{ else if $value.skipType == 3 }}/topic/@{{ else if $value.skipType == 4 }}/shopping#@{{ /if }}@{{ $value.skipId }}"
                   data-imprt='http://clk.motif.me/log.gif?t=daily.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v='
                   href="javascript:void(0)"><strong>Click for More</strong></a>
            </div>
        </div>
    </div>
    @{{ /if }}
    @{{ /each }}
</template>

<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/daily.js{{'?v='.config('app.version')}}"></script>
@include('global')
<script src="{{env('CDN_Static')}}/scripts/dailyVideoPlay.js"></script>
</html>
