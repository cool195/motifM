<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')){{'Contact Us'}}@else{{'MOTIF'}}@endif</title>
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
    <!-- 联系我们 -->
        <section class="reserve-height">
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Contact Us</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-md text-main">Customer Support Email:&nbsp;<a href="mailto:service@motif.me">Service@motif.me</a>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-x-15x p-y-10x font-size-md text-main">Business Contact Email:&nbsp;
                    <a href="mailto:Business@motif.me">Business@motif.me</a>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-x-15x p-y-10x font-size-md text-main">Contact Us on Facebook:&nbsp;
                    <a target="_blank" href="@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')){{'https://www.facebook.com/motifme'}}@else{{'motif://o.c?a=outurl&url='.urlencode('https://www.facebook.com/motifme')}}@endif">
                        <img src="{{env('CDN_Static')}}/images/contactus/icon-facebook.png" srcset="{{env('CDN_Static')}}/images/contactus/icon-facebook@2x.png 2x,/images/contactus/icon-facebook@3x.png 3x"></a>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-x-15x p-y-10x font-size-md text-main">
                BUMPERR LTD <br />
                71-75, Shelton Street, Covent Garden, London, WC2H 9JQ, UNITED KINGDOM (This address is only for billing, not for return).
                </div>
            </div>
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
