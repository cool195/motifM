<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>shopping</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/styles/vendor.css">
    <link rel="stylesheet" href="/styles/shoppingList.css">
    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body class="body-tabs">
    <!-- App 下载提示 -->
    <!--<nav class="navbar-fixed-bottom bg-download p-y-10x p-x-15x flex flex-fullJustified flex-alignCenter">-->
    <!--<div class="flex flex-alignCenter">-->
    <!--<span class="p-r-20x"><a href="#"><i class="iconfont icon-cross text-common"></i></a></span>-->
    <!--<span class="p-r-15x"><img src="/images/icon/icon-motif.png"-->
    <!--srcset="/images/icon/icon-motif@2x.png 2x,/images/icon/icon-motif@3x.png 3x">-->
    <!--</span>-->
    <!--<span class="p-r-15x font-size-sm text-primary">Find More With MOTIF App</span>-->
    <!--</div>-->
    <!--<div class="font-size-sm"><a href="#">DOWNLOAD</a></div>-->
    <!--</nav>-->
<!-- 头部导航 start-->
	@include('navigator');
<!-- 头部导航 end-->
    <nav class="navbar-fixed-top swiper-container bg-gray" id="tabIndex-container">
        <ul class="nav nav-tabs swiper-wrapper">
      <!--      <li class="nav-item swiper-slide active">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-all">
                    <span class="font-size-sm m-l-5x">ALL</span>
                </a>
            </li>
            <li class="nav-item swiper-slide">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-rings inactive">
                    <span class="font-size-sm m-l-5x">RINGS</span>
                </a>
            </li>
            <li class="nav-item swiper-slide">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-necklaces inactive">
                    <span class="font-size-sm m-l-5x">NECKLACES</span>
                </a>
            </li>
            <li class="nav-item swiper-slide">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-earrings inactive">
                    <span class="font-size-sm m-l-5x">EARRINGS</span>
                </a>
            </li>
            <li class="nav-item swiper-slide">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-hairjewelry inactive">
                    <span class="font-size-sm m-l-5x">HAIRJEWELRY</span>
                </a>
            </li>-->
		@foreach($categories as $c)
            <li class="nav-item swiper-slide">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x">
                    <span class="font-size-sm m-l-5x">{{ $c['category_name'] }}</span>
                </a>
            </li>
		@endforeach
        </ul>
    </nav>
    <section class="swiper-container" id="tabs-container">
        <div class="swiper-wrapper">
		@foreach($categories as $c)
            <div class="swiper-slide">
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
                                    <span class="font-size-xs text-throughLine m-l-5x">$125.95</span>
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
                                    <span class="font-size-xs text-throughLine m-l-5x">$125.95</span>
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
                                    <span class="font-size-xs text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		@endforeach
        </div>
    </section>
<!-- 页脚 功能链接 Start-->
	@include('footer')
<!-- 页脚 功能链接 End-->

</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingList.js"></script>
</html>
