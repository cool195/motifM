<!DOCTYPE html>
<html lang="en">
<head>
    <title>designer</title>
    @include('head')
    <link rel="stylesheet" href="/styles/designer.css">
</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- designer 设计师首页 -->
        <section class="reserve-height">
            <!-- 设计师列表 -->
            <article class="bg-white p-y-15x m-b-10x">
                <h5 class="font-size-base text-main p-x-15x m-b-10x"><strong>DESIGNERS</strong></h5>
                <div class="p-a-0 swiper-container">
                    <div class="swiper-wrapper">
                        @if(isset($recdesigner))
                            @foreach($recdesigner as $value)
                                <div class="designer-item swiper-slide p-r-10x">
                                    <a class="" href="/designer/{{$value['designerId']}}">
                                        <img class="img-fluid"
                                             src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$value['avatar']}}">
                                        {{--<div class="designer-text font-size-sm text-center">{{$value['name']}}</div>--}}
                                    </a>
                                </div>
                            @endforeach
                        @endif
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
                                                                      data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n2/@{{ $value.listImg }}"
                                                                      src="/images/product/bg-product@750.png"
                                                                      alt="@{{ $value.name }}"></a></div>
        <div class="p-x-10x p-y-15x swiper-container" id="designer-container">
            <div class="swiper-wrapper productList@{{ $value.designerId }}">
                @{{ each $value.products }}
                <div class="designer-item swiper-slide p-x-5x">
                    <a href="/detail/@{{$value.spu}}">
                        <img class="img-fluid"
                             src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/@{{ $value.mainImage }}">
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
@include('global')
</html>
