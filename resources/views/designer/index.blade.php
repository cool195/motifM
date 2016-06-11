<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>designer</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
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
                <div class="p-a-0 swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($recdesigner as $value)
                            <div class="designer-item swiper-slide p-x-5x">
                                <a class="" href="/designer/{{$value['designerId']}}">
                                    <img class="img-fluid"
                                         src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$value['mainImg']}}">
                                    <div class="designer-text font-size-sm text-center">{{$value['name']}}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>

            <!-- 设计师及其商品列表 -->
            <div id="designerContainer" data-pagenum="0" data-loading="false">
                <div class="designer-content">
                </div>
                <div class="loading" style="display: none">
                    <div class="loader"></div>
                </div>
            </div>

        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<!-- 模板 -->
<template id="tpl-designer">
    @{{ each list }}
    <aside class="bg-white m-b-10x">
        <div class=""><a href="/designer/@{{$value.designerId}}"><img class="img-fluid img-lazy"
                                                                      data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n1/@{{ $value.mainImg }}"
                                                                      src="/images/product/bg-product@750.png"
                                                                      alt="@{{ $value.name }}"></a></div>
        <div class="p-x-10x p-y-15x swiper-container" id="designer-container">
            <div class="swiper-wrapper productList@{{ $value.designerId }}">
                @{{ each $value.products }}
                <div class="designer-item swiper-slide p-x-5x">
                    <a href="/detail/@{{$value.spu}}">
                        <img class="img-fluid img-lazy"
                             data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n1/@{{ $value.mainImage }}"
                             src="/images/product/bg-product@70.png">
                    </a>
                </div>
                @{{ /each }}
            </div>
        </div>
    </aside>
    @{{ /each }}
</template>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/designer.js"></script>
</html>
