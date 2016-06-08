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
            <!-- 视频/图片 正式上线将优酷视频改成改成img_video_path-->
            <div class="">
                <iframe class="ytplayer img-fluid" type="text/html" width="100%"
                        src="@if($designer['path_type']==2)http://player.youku.com/embed/XMTU5ODg3MzIzNg==@else https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$designer['main_img_path']}}@endif"
                        frameborder="0" allowfullscreen></iframe>
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
            @foreach($product['infos'] as $k=>$value)
                @if($value['type']=='banner')
                    <!-- 第一个 banner 图 -->
                        <div @if($k!=0)class="p-y-10x"@endif>
                            <img class="img-fluid" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$value['imgPath']}}" alt="">
                        </div>
                @elseif($value['type']=='title')
                    <!-- 标题 -->
                        <div class="p-x-15x p-y-10x text-primary">
                            <strong>{{$value['value']}}</strong>
                        </div>
                    @elseif($value['type']=='boxline')
                        <hr class="hr-base m-x-5x m-y-0">
                    @elseif($value['type']=='context')
                    <!-- 描述 -->
                        <div class="p-x-15x p-y-10x text-primary font-size-sm">
                            {{$value['value']}}
                        </div>
                    @elseif($value['type']=='product')
                        @if($value['style']=='box-vertical')
                            {{-- 商品列表竖向 --}}
                            <div class="p-x-15x p-y-10x">
                                <img class="img-fluid" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$value['imgPath']}}" alt="">
                            </div>
                        @else
                            {{-- 商品列表横向 --}}
                            <div class="container-fluid p-x-15x">
                                <div class="row">
                                    @foreach($value['spus'] as $spu)
                                        <div class="col-xs-6">
                                            <div class="p-t-10x">
                                                <img class="img-thumbnail" src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}" alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                <div class="p-y-10x">
                                                    <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                    <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($product['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
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
                        <img src="/images/icon/icon-appStore.png"
                             srcset="/images/icon/icon-appStore@2x.png 2x, /images/icon/icon-appStore@3x.png 3x">
                    </a>
                    <a href="#" class="btn btn-secondary btn-xs">
                        <img src="/images/icon/icon-googlePlay.png"
                             srcset="/images/icon/icon-googlePlay@2x.png 2x, /images/icon/icon-googlePlay@3x.png 3x">
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
