<!DOCTYPE html>
<html lang="en">
<head>
    <title>shopping</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingList.css{{'?v='.config('app.version')}}">
</head>
<body>
<input type="text" id="productClick-name" value="name" hidden>
<input type="text" id="productClick-spu" value="1" hidden>
<input type="text" id="productClick-price" value="1" hidden>
<script type="text/javascript">
    function onProductClick() {
        var name = document.getElementById('productClick-name').value;
        var spu = document.getElementById('productClick-spu').value;
        var price = document.getElementById('productClick-price').value;
        dataLayer.push({
            'event': 'productClick',
            'ecommerce': {
                'click': {
                    'actionField': {'list': 'shopping list'},      // Optional list property.
                    'products': [{
                        'name': name,                      // Name or ID is required.
                        'id': spu,
                        'price': price,
                        'brand': 'Motif',
                        'category': '',
                        'variant': '',
                        'position': ''
                    }]
                }
            },
        });
    }

    //shoppinglist 产品埋点
    function onImpressProduct(item) {

        var json = [];
        for(var key in item){
            json.push({"name":item[key].main_title,"id":item[key].spu,"price":(item[key].skuPrice.sale_price/100).toFixed(2),"brand":"Motif","list":"shopping list"});
        }
        dataLayer.push({
            'event': 'impressProduct',
            'ecommerce': {
                'currencyCode': 'EUR',
                'impressions': json
            }
        });
    }
</script>

@include('check.tagmanager')
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
<!-- 外层容器-->
<div id="body-content">
    @include('nav')
    <div class="body-container">
        <!-- 头部导航 -->
        @include('navigator')
        <nav class="navbar-fixed-top swiper-container bg-gray" id="tabIndex-container">
            <ul class="nav nav-tabs swiper-wrapper">
                @if(isset($categories))
                    @foreach($categories as $key => $c)
                        <li class="nav-item swiper-slide" data-tab-index="{{ $c['category_id'] }}"
                            id="{{ $c['category_id'] }}">
                            <a class="nav-flex flex-alignCenter underLine-item text-primary m-x-15x p-y-10x nav-productType @if($key!=0) inactive @endif"
                               data-categoryid="{{ $c['category_id'] }}">
                                <img class="img-fluid img-icon" src="{{env('APP_Api_Image')}}/n1/{{$c['img_path'] }}"
                                     srcset="{{env('APP_Api_Image')}}/n1/{{$c['img_path'] }} 2x,{{env('APP_Api_Image')}}/n0/{{$c['img_path'] }} 3x">
                                <img class="img-fluid img-icon-active"
                                     src="{{env('APP_Api_Image')}}/n1/{{$c['img_path2'] }}"
                                     srcset="{{env('APP_Api_Image')}}/n1/{{$c['img_path2'] }} 2x, {{env('APP_Api_Image')}}/n0/{{$c['img_path2'] }} 3x">
                                <span class="font-size-xs m-l-5x">{{ $c['category_name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
        <section class="swiper-container p-b-10x reserve-height" id="tabs-container">
            <div class="swiper-wrapper">
                @if(isset($categories))
                    @foreach($categories as $c)
                        <div class="swiper-slide" data-loading="false" data-pagenum="0">
                            <div class="container-fluid p-t-10x">
                                <div class="row productList">
                                </div>
                            </div>
                            <div class="loading" style="display: none">
                                <div class="loader"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- 下载 App Download MOTIF -->
<div class="remodal remodal-md modal-content" data-remodal-id="download-modal" id="downloadModal">
    <div class="text-right p-x-15x p-t-15x" data-remodal-action="close">
        <i class="iconfont icon-cross icon-size-md text-common"></i>
    </div>
    <!-- 提示: 打开 app -->
    <div class="view-content" hidden>
        <div class="font-size-base">Function Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-5x">
            We supply this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <a class="btn btn-primary btn-block" href="">View in MOTIF App</a>
        </div>
    </div>
    <!-- 提示: 下载 app -->
    <div class="download-content" hidden>
        <div class="font-size-base">Function Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-5x">
            We supply this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <a class="btn btn-primary btn-block" data-role="downloading">Download MOTIF App
            </a>
        </div>
    </div>
    <!-- 提示: 不支持此设备 -->
    <div class="app-content" hidden>
        <div class="font-size-base">Device Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            Your device is not supported.<br>It's available in stores below.
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-5x p-b-15x">
            <div class="field-items">
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="{{env('CDN_Static')}}/images/icon/icon-appStore.png"
                         srcset="{{env('CDN_Static')}}/images/icon/icon-appStore@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-appStore@3x.png 3x">
                </a>
                <a href="#" class="btn btn-secondary btn-xs">
                    <img src="{{env('CDN_Static')}}/images/icon/icon-googlePlay.png"
                         srcset="{{env('CDN_Static')}}/images/icon/icon-googlePlay@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-googlePlay@3x.png 3x">
                </a>
            </div>
        </div>
    </div>
</div>

</body>

<!-- 模板 -->
<template id="tpl-product">
    @{{ each list }}
    <div class="col-xs-6 p-a-0">
        <div class="productList-item">
            <div class="image-bg">
                <div class="image-container">
                    <a data-link="/detail/@{{ $value.spu }}" data-impr="@{{ $value.impr }}" data-clk="@{{ $value.clk }}"
                       href="javascript:void(0)" data-spu="@{{ $value.spu }}" data-title="@{{ $value.main_title }}"
                       data-price="@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}">
                        <img class="img-fluid img-lazy"
                             data-original="{{env('APP_Api_Image')}}/n1/@{{ $value.main_image_url }}"
                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                             alt="@{{ $value.main_title }}">
                    </a>

                    @{{ if $value.sale_type == 1 }}
                        {{--预售产品 预定信息--}}
                        <span class="preorder-info font-size-xs">Limited Edition</span>
                    @{{ /if }}
                </div>
            </div>
            <div class="price-caption">

                @{{ if $value.skuPrice.sale_price !== $value.skuPrice.price }}
                <span class="font-size-sm m-l-5x text-red">
                    <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong>
                </span>
                <span class="font-size-xs text-common text-throughLine">$@{{ ($value.skuPrice.skuPromotion.price/100).toFixed(2) }}</span>
                @{{ else }}
                <span class="font-size-sm m-l-5x">
                    <strong>$@{{ ($value.skuPrice.sale_price/100).toFixed(2) }}</strong>
                </span>
                @{{ /if }}
                @if(Session::has('user'))
                    <span class="wish-item p-r-10x" ><i
                                class="iconfont text-common btn-wish @{{ if $value.isWished == 1  }} active @{{ /if }}"
                                data-spu="@{{ $value.spu }}"></i></span>
                @else
                    <a class="wish-item p-r-10x" href="javascript:;"><i class="iconfont text-common btn-wish" data-actionspu="@{{ $value.spu }}"></i></a>
                @endif
            </div>
        </div>
    </div>
    @{{ /each }}
</template>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/shoppingList.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
