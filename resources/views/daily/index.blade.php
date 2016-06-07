<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Daily</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/daily.css">

    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
    <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
        <!-- daily 首页列表 -->
            <section>
                <!-- banner 图 -->
                <div class="bg-white m-b-10x">
                    <img class="img-fluid" src="http://html.motif.app/images/daily/daily1.jpg">
                </div>

                <!-- 图文 -->
                <div class="bg-white m-b-10x">
                    <div><img class="img-fluid" src="http://html.motif.app/images/daily/daily2.jpg"></div>
                    <div class="p-a-15x">
                        <h6 class="text-main font-size-base m-b-5x"><strong>STREET SPOT: 20.04.2016</strong></h6>
                        <div class="text-primary font-size-sm">Handmade bracelets with gold mixture just occurs chemical
                            reaction.
                        </div>
                    </div>
                </div>
                <div class="bg-white m-b-10x">
                    <div class="daily-imgInfo">
                        <img class="img-fluid" src="http://html.motif.app/images/daily/daily2.jpg">
                        <span class="img-icon"><img src="http://html.motif.app/images/daily/daily-icon.png" srcset="http://html.motif.app/images/daily/daily-icon@2x.png 2x,http://html.motif.app/images/daily/daily-icon@3x.png 3x"></span>
                    </div>
                    <div class="p-a-15x">
                        <h6 class="text-main font-size-base m-b-5x"><strong>Boho Beaded Tassel Necklace</strong></h6>
                        <div class="text-primary font-size-sm">Gold leaf tassel pendant vintage necklace definitely
                            suits
                            for daily looks.
                        </div>
                    </div>
                </div>
                <div class="bg-white m-b-10x">
                    <div class="daily-imgInfo">
                        <img class="img-fluid" src="http://html.motif.app/images/daily/daily2.jpg">
                        <span class="img-icon"><img src="http://html.motif.app/images/daily/daily-icon.png" srcset="http://html.motif.app/images/daily/daily-icon@2x.png 2x,http://html.motif.app/images/daily/daily-icon@3x.png 3x"></span>
                    </div>
                    <div class="p-a-15x">
                        <h6 class="text-main font-size-base m-b-5x"><strong>Boho Beaded Tassel Necklace</strong></h6>
                        <div class="text-primary font-size-sm">Gold leaf tassel pendant vintage necklace definitely
                            suits
                            for daily looks.
                        </div>
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
