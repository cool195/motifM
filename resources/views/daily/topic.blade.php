<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="topic" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Topic</title>
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
    <!-- daily 详细内容 -->
        <section class="bg-white p-b-10x">
        @foreach($topic as $k=>$value)
            @if($value['type']=='banner')
                <!-- 第一个 banner 图 -->
                    <div class="">
                        <img class="img-fluid" src="{{$value['imgPath']}}" alt="">
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
                            <img class="img-fluid" src="{{$value['imgPath']}}" alt="">
                        </div>
                    @else
                        {{-- 商品列表横向 --}}
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
                    @endif
                @endif
            @endforeach
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>


</html>
