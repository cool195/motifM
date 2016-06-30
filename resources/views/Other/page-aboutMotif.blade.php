<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>About Motif</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">


    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

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
                <!-- 关于我们 -->
                    <section>
                        <article class="font-size-md text-main p-x-15x p-y-10x"><strong>About Motif</strong>
                        </article>
                        <div class="bg-white">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">Your style is unique and cutting edge - your fashion should be
                                    too. </p>
                                <p class="m-b-15x">Exclusive, limited edition accessories designed by the world’s top
                                    fashion
                                    bloggers, Instagrammers and digital influencers are all here.</p>
                                <p class="m-b-15x">Motif products and services include:</p>
                                <p class="m-b-15x">- No. 1 ecommerce fashion boutique for digital influencers and
                                    limited
                                    editions</p>
                                <p class="m-b-15x">- Collections by the world’s best fashion and beauty Instagrammers,
                                    bloggers
                                    and YouTubers </p>
                                <p class="m-b-15x">- Limited edition collections: sold out designs will never be
                                    reproduced</p>
                                <p class="m-b-15x">- Also featuring hand-picked emerging fashion designers from around
                                    the
                                    world</p>
                                <p class="m-b-15x">- Rare, never before seen fashion: make your style as unique and
                                    special as
                                    you are</p>
                                <p class="m-b-15x">- New designs and style inspiration on our daily newsfeed</p>
                                <p class="m-b-15x">- NEW style inspo from the Motif social community, and be featured on
                                    our app
                                    via #motifme</p>
                                <p class="m-b-15x">- Free shipping and returns</p>
                                <p class="m-b-15x">Download the app. Discover your personal Motif. Flaunt.</p>
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
<script src="/scripts/vendor.js"></script>
@include('global')
</html>
