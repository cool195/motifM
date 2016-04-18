<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>shopping detail</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/shoppingDetail.css">

    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body class="body-navbarPadding">
    <header class="navbar-fixed-top" id="header">
        <nav class="navbar navbar-full bg-primary">
            <ul class="nav navbar-primary">
                <li class="nav-item nav-menu">
                    <div class="">
                        <i class="nav-tap iconfont icon-hamburger icon-size-lg"></i>
                    </div>
                </li>
                <li class="nav-item nav-logo">
                    <a><img src="/images/logo/logo.png" srcset="/images/logo/logo@2x.png 2x,/images/logo/logo@3x.png 3x"></a>
                </li>
                <li class="nav-item">
                    <div class="nav-shoppingCart">
                        <i class="nav-tap iconfont icon-shopbag icon-size-lg"></i>
                        <span class="shoppingCart-number">2</span>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <!-- 图片详情 -->
    <div class="product-detailImg fade">
        <!-- 弹出图片轮播 -->
        <div class="swiper-container" id="detailImg-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail1.png"></div>
                <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail2.png"></div>
                <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail3.png"></div>
                <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail4.png"></div>
            </div>
            <div class="swiper-pagination font-size-sm" id="detailImg-pagination"></div>
        </div>
    </div>
    <!-- 商品内容介绍 -->
    <section class="container-fluid p-x-0">
        <!-- 产品图片 -->
        <div class="product-baseImg">
            <!-- Swiper -->
            <!-- 页面上图片轮播 -->
            <div class="swiper-container" id="baseImg-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail1.png"></div>
                    <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail2.png"></div>
                    <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail3.png"></div>
                    <div class="swiper-slide"><img class="img-fluid" src="/images/product/productDetail4.png"></div>
                </div>
                <!-- 分页器 -->
                <div class="swiper-pagination text-right p-r-20x font-size-sm" id="baseImg-pagination"></div>
            </div>
        </div>

        <!-- 产品 标题 简介 价格 基本信息 -->
        <article class="product-baseInfo bg-white m-b-10x">
            <div class="product-text">
                <h6 class="text-main">Retro Rose Gold-plated Flower Shape Black CZ Inlaid Women’s Cocktail Ring</h6>
                <p class="text-primary font-size-sm">It perfectly complements your outfits and showcases your sense of
                                                     style and fashion.
                </p>
                <p class="text-primary font-size-sm">
                    <span>Designer:</span>
                    <a href="#" class="text-primary text-underLine">LovelyPepa</a>
                </p>
            </div>
            <hr class="hr-light m-x-10x">
            <div class="product-price">
                <span class="font-size-lx text-primary">$47.95</span>
                <span class="font-size-sm text-common">＄69.95</span>
                <span class="font-size-sm text-primary">(51% off)</span>
                <a class="text-primary pull-xs-right" href="#"><i class="iconfont icon-share icon-size-xm"></i></a>
            </div>
            <div class="text-warming font-size-xs p-x-15x">Warming: Women’s Ring</div>
        </article>
        <!-- 产品 其他信息 -->
        <section>
            <!-- 添加到购物车 立即购买 -->
            <aside class="container-fluid bg-white p-y-10x p-x-15x m-b-10x">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-primary-outline btn-block">Add To Bag</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-primary btn-block">Buy Now</a>
                    </div>
                </div>
            </aside>
            <!-- 选择商品参数 -->
            <aside class="bg-white m-b-10x">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                    Select
                <span class="flex flex-alignCenter flex-fullJustified">
                    <span class="m-r-10x">Size Color</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </span>
                </a>
            </aside>
            <!-- 产品描述 -->
            <aside class="bg-white p-x-15x p-y-10x m-b-10x">
                <p class="font-size-md text-main"><strong>Description</strong></p>
                <p class="font-size-sm text-primary">Metal: Alloy/Gold-plated<br>
                                                     Flower Dimension: 25*15 mm<br>
                                                     About EverMarker :</p>
                <a class="flex flex-alignCenter flex-fullJustified font-size-xs text-common" href="#">
                    show more
                    <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                </a>
            </aside>
            <!-- 用户 Q & A -->
            <aside class="product-secondaryInfo">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                    Ask a Question <i class="iconfont icon-arrow-right icon-size-xm text-common"></i></a>
            </aside>
            <aside class="product-secondaryInfo">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                    Size Guide
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
                <hr class="hr-base">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                    Shipping, Returns, Payments
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
            </aside>
            <!-- 版权信息 -->
            <!-- TODO -->
            <aside class="product-secondaryInfo p-a-15x">
                <div class="media m-a-0">
                    <div class="media-left media-middle">
                        <img class="media-object" src="/images/icon/icon-guarantee.png" srcset="/images/icon/icon-guarantee@2x.png 2x, /images/icon/icon-guarantee@3x.png 3x" alt="">
                    </div>
                    <div class="media-body media-middle">
                        <p class="font-size-sm text-primary m-a-0 p-r-2">MOTIF guarantee quality merchandise and return
                                                                         service</p>
                    </div>
                </div>
            </aside>
            <!-- 添加购物车 -->
            <aside class="product-secondaryInfo container-fluid p-y-10x p-x-15x">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-primary-outline btn-block">Add To Bag</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-primary btn-block">Buy Now</a>
                    </div>
                </div>
            </aside>
            <!-- 推荐商品 -->
            <aside class="m-b-20x">
                <article class="font-size-md text-primary p-x-15x"><strong>More Like This</strong></article>
                <div class="container-fluid p-a-10x">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="productList-item">
                                <div class="image-bg">
                                    <div class="image-container">
                                        <img class="img-fluid" src="/images/product/product1.jpg" alt="商品的名称">
                                        <div class="price-off"><strong class="font-size-sm">OFF 49%</strong></div>
                                    </div>
                                </div>
                                <div class="price-caption">
                                    <span class="font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="productList-item">
                                <div class="image-bg">
                                    <div class="image-container">
                                        <img class="img-fluid" src="/images/product/product2.jpg" alt="商品的名称">
                                        <div class="price-off"><strong class="font-size-sm">OFF 89%</strong></div>
                                    </div>
                                </div>
                                <div class="price-caption">
                                    <span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="productList-item">
                                <div class="image-bg">
                                    <div class="image-container">
                                        <img class="img-fluid" src="/images/product/product3.jpg" alt="商品的名称">
                                    </div>
                                </div>
                                <div class="price-caption">
                                    <span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="productList-item">
                                <div class="image-bg">
                                    <div class="image-container">
                                        <img class="img-fluid" src="/images/product/product4.jpg" alt="商品的名称">
                                    </div>
                                </div>
                                <div class="price-caption">
                                    <span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </section>
    </section>
<!-- 页脚 功能链接 Start-->
	@include('footer')
<!-- 页脚 功能链接 End-->

</body>
<script src="scripts/vendor.js"></script>

<script src="/scripts/shoppingDetail.js"></script>

</html>
