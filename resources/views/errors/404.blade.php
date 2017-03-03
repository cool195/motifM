<!DOCTYPE html>
<html lang="en">
<head>
    <title>MOTIF | Page Not Found 404 error</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/404.css">
</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
@endif
<!-- 主体内容 -->
    <div class="body-container">
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        @include('navigator')
    @endif
    <!-- 404 内容 -->
        <section class="reserve-height flex flex-justifyCenter flex-alignCenter">
            <div class="p-x-20x">
                <div class="text-center">
                    <div>
                        <img class="img-fluid" src="{{env('CDN_Static')}}/images/404/404.png"
                             srcset="{{env('CDN_Static')}}/images/404/404@2x.png 2x,{{env('CDN_Static')}}/images/404/404@3x.png 3x">
                    </div>
                    <div class="p-t-10x p-b-5x font-size-lg">
                        <strong>Oops,You've lost...</strong>
                    </div>
                    <div class="text-primary font-size-sm">Your requested URL was not found</div>
                    <div class="text-primary font-size-sm p-t-20x p-b-10x">You may want to</div>
                    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
                        <div><a href="/trending" class="btn btn-primary btn-block btn-goHome">Go Home</a></div>
                    @else
                        <div><a href="motif://o.c?a=daily" class="btn btn-primary btn-block btn-goHome">Go Home</a></div>
                    @endif

                </div>
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>
@include('global')
</html>
