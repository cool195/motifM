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
    <!-- 关于我们 -->
        <section>
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>About Motif</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x">Fashion is not just a pursuit of beauty, it’s an attitude towards life.</p>
                    <p class="m-b-15x">Declare your individuality and enhance your appearance with our selection of
                        fashionable jewelry.</p>
                    <p class="m-b-15x">Motif brings together a seamless online purchasing system with exceptional
                        customer service. </p>
                    <p class="m-b-15x">We guarantee a safe and secure shopping experience with Trust Marketing and SSL
                        certified payment
                        services. Whether you’re looking to complement your attire or reveal your style, Motif is just
                        the
                        best choice for you!</p>
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
<script src="scripts/vendor.js"></script>
</html>
