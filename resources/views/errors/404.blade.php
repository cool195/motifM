<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>404</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/404.css">

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
    <!-- 404 内容 -->
        <section class="reserve-height flex flex-justifyCenter flex-alignCenter">
            <div class="p-x-20x">
                <div class="text-center">
                    <div>
                        <img class="img-fluid" src="/images/404/404.png"
                             srcset="/images/404/404@2x.png 2x,/images/404/404@3x.png 3x">
                    </div>
                    <div class="p-t-10x">
                        <img src="/images/404/oops.png" srcset="/images/404/oops@2x.png 2x,/images/404/oops@3x.png 3x">
                    </div>
                    <div class="text-primary font-size-sm">Your requested URL was not found</div>
                    <div class="text-primary font-size-sm p-t-20x p-b-10x">You may want to</div>
                    <div><a href="/daily" class="btn btn-primary btn-block btn-sm btn-goHome">Go Home</a></div>
                </div>
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>
@include('global')
</html>