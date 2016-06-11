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
        @foreach($topic['infos'] as $k=>$value)
            @if($value['type']=='banner')
                <!-- 第一个 banner 图 -->
                    <div @if($k!=0)class="p-y-10x"@endif>
                        <a href="@if($value['skipType']=='1')/detail/@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')/shopping#@endif{{$value['skipId']}}">
                            <img class="img-fluid" src="{{$value['imgPath']}}" alt="">
                        </a>
                    </div>
            @elseif($value['type']=='title')
                <!-- 标题 -->
                    <a href="@if($value['skipType']=='1')/detail/@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')/shopping#@endif{{$value['skipId']}}">
                        <div class="p-x-15x p-y-10x text-primary">
                            <strong>{{$value['value']}}</strong>
                        </div>
                    </a>
                @elseif($value['type']=='boxline')
                    <hr class="hr-base m-x-5x m-y-0">
                @elseif($value['type']=='context')
                <!-- 描述 -->
                    <a href="@if($value['skipType']=='1')/detail/@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')/shopping#@endif{{$value['skipId']}}">
                        <div class="p-x-15x p-y-10x text-primary font-size-sm">
                            {{$value['value']}}
                        </div>
                    </a>
                @elseif($value['type']=='product')
                    @if($value['style']=='box-vertical')
                        {{-- 商品列表竖向 --}}
                        @foreach($value['spus'] as $spu)
                            <div class="p-x-15x p-y-10x">
                                <a href="/detail/{{$spu}}">
                                    <img class="img-fluid"
                                         src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                         alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                </a>
                            </div>
                        @endforeach
                    @else
                        {{-- 商品列表横向 --}}
                        <div class="container-fluid p-x-15x">
                            <div class="row">
                                @foreach($value['spus'] as $spu)
                                    <div class="col-xs-6">
                                        <a href="/detail/{{$spu}}">
                                            <div class="p-t-10x">
                                                <img class="img-thumbnail"
                                                     src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                     alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                <div class="p-y-10x">
                                                    <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                    <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($topic['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
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
