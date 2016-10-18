<!DOCTYPE html>
<html lang="en">
<head>
    <title>Motif Guarantee</title>
    @include('head')

</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
@endif
<!-- 主体内容 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        <div class="body-container">
            @include('navigator')
            @else
                <div class="body-container" style="padding-top:0px">
                @endif
    <!-- 保障 -->
        <section class="reserve-height">
            <article class="font-size-md text-main p-x-15x p-y-10x bg-title"><strong>Motif guarantee</strong>
            </article>
            <hr class="hr-base m-a-0">

            <aside class="product-secondaryInfo p-a-15x">
                <div class="media m-a-0">
                    <div class="media-left media-middle">
                        <img class="media-object" src="{{env('CDN_Static')}}/images/icon/icon-guarantee.png"
                             srcset="{{env('CDN_Static')}}/images/icon/icon-guarantee@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-guarantee@3x.png 3x"
                             alt="">
                    </div>
                    <div class="media-body media-middle">
                        <p class="font-size-sm text-primary m-a-0 p-r-2">Motif guarantee security, quality and
                            convenience.</p>
                    </div>
                </div>
            </aside>
            <hr class="hr-base m-a-0">
        </section>
        <!-- 页脚 功能链接 -->
        @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
            @include('footer')
        @endif
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
