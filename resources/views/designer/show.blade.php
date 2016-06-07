<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Designer Detail</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

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
        <!-- designerDetail 设计师详情 -->
        <section>
            <!-- 视频/图片 -->
            <div class="">
                <iframe class="ytplayer img-fluid" type="text/html" width="100%" src="@if($designer['path_type']==1)https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$designer['main_img_path']}}@else {{$designer['img_video_path']}} @endif" frameborder="0" allowfullscreen></iframe>
            </div>

            <!-- 设计师 文字信息 -->
            <div class="bg-white p-a-5x">
                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <p class="font-size-base text-main"><strong>{{$designer['name']}}</strong></p>
                    <a href="#"><i class="iconfont icon-share icon-size-md text-primary"></i></a>
                </div>
                <div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>
                <hr class="hr-base m-a-0">
                <div class="font-size-sm text-primary p-a-10x">{{$designer['describe']}}</div>
                <div class="p-x-10x p-y-5x">
                    <a href="#" class="p-r-5x"><i class="iconfont icon-youtube icon-size-lg text-primary"></i></a>
                    <a href="#" class="p-r-5x"><i class="iconfont icon-facebook icon-size-lg text-primary"></i></a>
                    <a href="#" class="p-r-5x"><i class="iconfont icon-google icon-size-lg text-primary"></i></a>
                </div>
            </div>

            <!-- 设计师 对应商品 -->
            <aside class="bg-white p-b-10x">
                <!-- 商品图 -->
                <div class="p-y-10x"><img class="img-fluid" src="/images/designer/designer4.jpg" alt=""></div>
                <div class="p-y-10x"><img class="img-fluid" src="/images/designer/designer4.jpg" alt=""></div>

                <!-- 商品列表 -->
                <div class="container-fluid p-x-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 商品图 -->
                <div class="p-y-10x"><img class="img-fluid" src="/images/designer/designer4.jpg" alt=""></div>

                <!-- 商品列表 -->
                <div class="container-fluid p-x-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="p-t-10x">
                                <img class="img-thumbnail" src="/images/product/product2.jpg" alt="商品的名称">
                                <div class="p-y-10x">
                                    <span class="text-primary font-size-sm m-l-5x"><strong>$60.95</strong></span>
                                    <span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </section>
        <!-- 页脚 功能链接 -->
        <footer class="p-y-20x">
            <div class="field-content m-b-20x">
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
                            <div class="list-group-item list-group-itemText-lg text-primary"><strong>THE
                                    MOTIF</strong>
                            </div>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">About Motif</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Privacy
                                Poilcy</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Terms of
                                Services</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Contact Us</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Site Map</a>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="foot-list-group font-size-sm">
                            <div class="list-group-item list-group-itemText-lg text-primary"><strong>HELP &
                                    SERVICE</strong>
                            </div>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">FAQs</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Feedback</a>
                            <a class="list-group-item list-group-itemText-lg text-primary" href="#">Delivery &
                                Shipping</a>
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
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/designerDetail.js"></script>
</html>
