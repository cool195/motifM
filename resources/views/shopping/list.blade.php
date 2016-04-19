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
    <!-- 头部导航 -->
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
    <nav class="navbar-fixed-top swiper-container bg-gray" id="tabIndex-container">
        <ul class="nav nav-tabs swiper-wrapper">
        <!--    <li class="nav-item swiper-slide active" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-all">
                    <span class="font-size-sm m-l-5x">ALL</span>
                </a>
            </li>
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-rings inactive">
                    <span class="font-size-sm m-l-5x">RINGS</span>
                </a>
            </li>
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-necklaces inactive">
                    <span class="font-size-sm m-l-5x">NECKLACES</span>
                </a>
            </li>
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-earrings inactive">
                    <span class="font-size-sm m-l-5x">EARRINGS</span>
                </a>
            </li>
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-hairjewelry inactive">
                    <span class="font-size-sm m-l-5x">HAIRJEWELRY</span>
                </a>
            </li>-->
			@foreach($categories as $c)	
            <li class="nav-item swiper-slide" data-tabindex="">
                <a class="nav-flex underLine-item text-primary m-x-15x p-y-10x p-l-20x iconimg-earrings inactive">
                    <span class="font-size-sm m-l-5x">{{ $c['category_name'] }}</span>
                </a>
            </li>
			@endforeach
        </ul>
    </nav>
    <section class="swiper-container p-b-10x" id="tabs-container" data-loading="">
        <div class="swiper-wrapper">
			@foreach($categories as $c)
            <div class="swiper-slide" data-loading="">
                <div class="container-fluid p-a-10x">
                    <div class="row">
                    </div>
                </div>
                <div class="loading" style="display: none">
                    <div class="loader"></div>
                </div>
            </div>
			@endforeach
        </div>
    </section>
    <!-- 页脚 功能链接 -->
    <footer class="p-y-20x">
        <div class="field-content m-t-15x m-b-20x">
            <div class="field-text font-size-sm">
                Follow Us:&nbsp;
            </div>
            <div class="field-items">
                <a class="share-btn">
                    <i class="iconfont icon-facebook icon-size-lg"></i>
                </a>
                <a class="share-btn">
                    <i class="iconfont icon-google icon-size-lg"></i>
                </a>
                <a class="share-btn">
                    <i class="iconfont icon-youtube icon-size-lg"></i>
                </a>
                <a class="share-btn">
                    <i class="iconfont icon-linkedin icon-size-lg"></i>
                </a>
                <a class="share-btn">
                    <i class="iconfont icon-twitter icon-size-lg"></i>
                </a>
            </div>
        </div>
        <div class="field-content">
            <div class="field-text font-size-sm">
                Download:
            </div>
            <div class="field-items">
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="/images/icon/icon-appStore.png" srcset="/images/icon/icon-appStore@2x.png 2x, /images/icon/icon-appStore@3x.png 3x">
                </a>
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="/images/icon/icon-googlePlay.png" srcset="/images/icon/icon-googlePlay@2x.png 2x, /images/icon/icon-googlePlay@3x.png 3x">
                </a>
            </div>
        </div>
        <div class="links-group container-fluid p-x-0">
            <hr class="hr-dark m-t-20x m-b-15x">
            <div class="row">
                <div class="col-xs-6">
                    <div class="list-group font-size-sm">
                        <div class="list-group-item list-group-itemText-lg text-primary"><strong>THE MOTIF</strong>
                        </div>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">About Motif</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Privacy Poilcy</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Terms of Services</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Contact Us</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Site Map</a>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="foot-list-group font-size-sm">
                        <div class="list-group-item list-group-itemText-lg text-primary"><strong>HELP & SERVICE</strong>
                        </div>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">FAQs</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Feedback</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Delivery & Shipping</a>
                        <a class="list-group-item list-group-itemText-lg text-primary" href="#">Returns</a>
                    </div>

                </div>
            </div>
            <hr class="hr-dark m-t-20x m-b-15x">
        </div>
        <div class="text-common text-center font-size-sm">Copyright @ 2016 EverMarker Inc. All rights
                                                          reserved.
        </div>
    </footer>
</body>
<!-- 模板 -->

 <template id="tpl-product">
     <% for (var i = 0; i < list.length; i++) { %>
     <div class="col-xs-6">
         <div class="productList-item">
             <div class="image-bg">
                 <div class="image-container">
                     <a href="/products/<%= list[i][spu] %>">
                         <img class="img-fluid" src="<%= list[i][main_img_url] %>" alt="<%= list[i][main_title] %>">
                         <% if (list[i][skuPrice][skuPromotion] !== undefined) %>
                         <div class="price-off">
                             <strong class="font-size-sm">OFF <%= list[i][skuPrice][skuPromotion] %>%</strong>
                         </div>
                         <% } %>
                     </a>
                 </div>
             </div>
             <div class="price-caption">
                 <span class="font-size-sm m-l-5x">
                     <strong>$<%= list[i][skuPrice][sale_price] %></strong>
                 </span>
                 <% if (list[i][skuPrice][skuPromotion] !== undefined) %>
                 <span class="font-size-xs text-common text-throughLine m-l-5x">$<%= list[i][skuPrice][price] }}</span>
                 <% } %>
             </span></div>
         </div>
     </div>
     <% } %>
 </template>


<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingList.js"></script>
</html>
