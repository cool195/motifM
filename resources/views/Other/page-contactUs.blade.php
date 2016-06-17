<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Contact Us</title>
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
@include('nav')
    <!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')

        <!-- 联系我们 -->
        <section>
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Contact Us</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-md text-main">Email:&nbsp;<a href="mailto:service@motif.me">Service@motif.me</a></div>
                <hr class="hr-base m-y-0">
                <div class="p-x-15x p-y-10x font-size-md text-main">On Facebook:&nbsp;
                    <a class="btn btn-primary btn-sm" target="_blank" href="https://www.facebook.com/Motif-862363260557363/">fackbook</a>
                </div>
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="scripts/vendor.js"></script>
</html>
