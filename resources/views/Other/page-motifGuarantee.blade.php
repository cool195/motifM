<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Motif Guarantee</title>
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

        <!-- 保障 -->
        <section>
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Motif guarantee</strong>
            </article>
            <aside class="product-secondaryInfo p-a-15x">
                <div class="media m-a-0">
                    <div class="media-left media-middle">
                        <img class="media-object" src="/images/icon/icon-guarantee.png" srcset="/images/icon/icon-guarantee@2x.png 2x, /images/icon/icon-guarantee@3x.png 3x" alt="">
                    </div>
                    <div class="media-body media-middle">
                        <p class="font-size-sm text-primary m-a-0 p-r-2">Motif guarantee security, quality and
                            convenience.</p>
                    </div>
                </div>
            </aside>

        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="scripts/vendor.js"></script>
</html>
