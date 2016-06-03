<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>designer</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/designer.css">

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
        <!-- designer 设计师首页 -->
        <section>
            <!-- 设计师列表 -->
            <article class="bg-white p-a-15x m-b-10x">
                <h5 class="font-size-base text-main m-b-10x"><strong>DESIGNERS</strong></h5>
                <div class="container-fluid p-a-0">
                    <div class="row">
                        <div class="col-xs-3">
                            <a class="designer-item" href="/designer/42">
                                <img class="img-fluid" src="/images/designer/designer.jpg">
                                <div class="designer-text font-size-sm text-center">Lovely Pepa</div>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a class="designer-item" href="/designer/42">
                                <img class="img-fluid" src="/images/designer/designer1.jpg">
                                <div class="designer-text font-size-sm text-center">Kyrzayda</div>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a class="designer-item" href="/designer/42">
                                <img class="img-fluid" src="/images/designer/designer2.jpg">
                                <div class="designer-text font-size-sm text-center">Dulce Candy</div>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a class="designer-item" href="/designer/42">
                                <img class="img-fluid" src="/images/designer/designer3.jpg">
                                <div class="designer-text font-size-sm text-center">Gabi Fresh</div>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- 设计师及其商品列表 -->
            <aside class="bg-white m-b-10x">
                <div class=""><img class="img-fluid" src="/images/designer/designer4.jpg" alt=""></div>
                <div class="container-fluid p-a-15x">
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="/designer/42"><img class="img-thumbnail" src="/images/product/product1.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="/designer/42"><img class="img-thumbnail" src="/images/product/product2.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="/designer/42"><img class="img-thumbnail" src="/images/product/product3.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="/designer/42"><img class="img-thumbnail" src="/images/product/product4.jpg"></a>
                        </div>
                    </div>
                </div>
            </aside>
            <aside class="bg-white m-b-10x">
                <div class=""><img class="img-fluid" src="/images/designer/designer4.jpg" alt=""></div>
                <div class="container-fluid p-a-15x">
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#"><img class="img-thumbnail" src="/images/product/product1.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#"><img class="img-thumbnail" src="/images/product/product2.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#"><img class="img-thumbnail" src="/images/product/product3.jpg"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#"><img class="img-thumbnail" src="/images/product/product4.jpg"></a>
                        </div>
                    </div>
                </div>
            </aside>

        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>


</html>
