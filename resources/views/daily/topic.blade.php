<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{$topic['title']}}</title>
    @include('head')
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
                    'actionField': {'list': 'topic'},      // Optional list property.
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

    dataLayer.push({
        'ecommerce': {
            'currencyCode': 'EUR',                       // Local currency is optional.
            'impressions': [
                    @foreach($topic['infos'] as $k=>$value)
                    @if($value['type']=='product')
                    @if(isset($value['spus']))
                    @foreach($value['spus'] as $spu)
                {
                    'name': '{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}',       // Name or ID is required.
                    'id': '{{$spu}}',
                    'price': '{{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}',
                    'brand': 'Motif',
                    'category': '',
                    'variant': '',
                    'list': 'topic',
                    'position': ''
                },
                @endforeach
                @endif
                @endif
                @endforeach
            ]
        }
    });
</script>
@include('check.tagmanager')
        <!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
            <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
                <!-- daily 详细内容 -->
        <section class="bg-white p-b-10x reserve-height">
            @inject('wishlist', 'App\Http\Controllers\Shopping\ShoppingController')
            @if(isset($topic['infos']))
            @foreach($topic['infos'] as $k=>$value)
            @if($value['type']=='banner')
                    <!-- 第一个 banner 图 -->
            <div @if($k!=0)class="p-y-10x"@endif>
                <a href="@if($value['skipType']=='1')/detail/@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')/shopping#@endif{{$value['skipId']}}">
                    <img class="img-fluid img-lazy"
                         data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                </a>
            </div>
            @elseif($value['type']=='multilink')
                    <!-- 锚点图 -->
            <div class="m-y-10x">
                <div class="hotspot-image"
                     data-hotspot='@foreach($value['squas'] as $v){{'{"beginX":'.$v['startX'].',"beginY":'.$v['startY'].',"skipId":"'.$v['skipId'].'","skipType":"'.$v['skipType'].'","endX":'.$v['endX'].',"endY":'.$v['endY'].'},'}}@endforeach'>
                    <img class="img-fluid" src="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}">
                </div>
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
                <div data-impr='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":"{{ implode("_", $value['spus']) }}","topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'></div>
                @if($value['style']=='box-vertical')
                    {{-- 商品列表竖向 --}}
                    @if(isset($value['spus']))
                        @foreach($value['spus'] as $spu)
                            <div class="p-x-15x p-y-10x">
                                <a data-clk='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'
                                   data-link="/detail/{{$spu}}" href="javascript:void(0)">
                                    <img class="img-fluid img-lazy"
                                         data-original="{{env('APP_Api_Image')}}/n1/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                         alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                </a>
                                @if(Session::has('user'))
                                    <span class="wish-item p-r-10x"><i class="iconfont text-common btn-wish btn-wished @if(in_array($spu, $wishlist->wishlist())){{'active'}}@endif" data-spu="{{$spu}}"></i></span>
                                @else
                                    <a class="wish-item p-r-10x" href="/login"><i class="iconfont text-common btn-wish"></i></a>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <a href="@if($value['skipType']=='1')/detail/@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')/shopping#@endif{{$value['skipId']}}">
                            <img class="img-fluid img-lazy"
                                 data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                                 src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                        </a>
                    @endif
                @else
                    {{-- 商品列表横向 --}}
                    <div class="container-fluid p-x-0 bg-topic">
                        <div class="row m-a-0 topic-product">
                            @if(isset($value['spus']))
                                @foreach($value['spus'] as $spu)
                                    <div class="col-xs-6 p-a-0">
                                        <div class="bg-white topic-product-item productList-item">
                                            <a data-clk='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'
                                               data-link="/detail/{{$spu}}" href="javascript:void(0)">
                                                <div class="image-container">
                                                    <img class="img-fluid img-lazy"
                                                         data-original="{{env('APP_Api_Image')}}/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                         src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                         alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                    @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                        <div class="price-off">
                                                            <img class="img-fluid"
                                                                 src="{{env('APP_Api_Image')}}/n1/{{ $topic['spuInfos'][$spu]['skuPrice']['skuPromotion']['logo_path']}}"
                                                                 alt="">
                                                        </div>
                                                    @endif
                                                </div>
                                            </a>
                                            <div class="p-a-10x flex flex-alignCenter flex-fullJustified">
                                                <div>

                                                    @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                        <span class="text-red font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                        <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($topic['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                    @else
                                                        <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                    @endif
                                                </div>
                                                @if(Session::has('user'))
                                                    <span class="wish-item p-r-10x"><i class="iconfont text-common btn-wish btn-wished @if(in_array($spu, $wishlist->wishlist())){{'active'}}@endif" data-spu="{{$spu}}"></i></span>
                                                @else
                                                    <a class="wish-item p-r-10x" href="/login"><i class="iconfont text-common btn-wish"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            @endif
            @endforeach
            @endif
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script>
    $(document).ready(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

    // 锚点图
    function getHotSpot() {
        $('.hotspot-image').each(function () {
            var $this = $(this);
            var obj = $(this).data('hotspot');
            // 获取最后一个字符
            var lastStr = obj.charAt(obj.length - 1);
            if (lastStr === ',') {
                obj = obj.substring(0, obj.length - 1);
            }
            // 转化为json
            var objJson = eval('[' + obj + ']');
            $.each(objJson, function (n, value) {
                var BeginX = value.beginX;
                var BeginY = value.beginY;
                var EndX = value.endX;
                var EndY = value.endY;
                var url = '';
                switch (value.skipType) {
                    case '1':
                        url = '/detail/';
                        break;
                    case '2':
                        url = '/designer/';
                        break;
                    case '3':
                        url = '/topic/';
                        break;
                    case '4':
                        url = '/shopping#';
                        break;
                }
                url += value.skipId;
                var parenta = $('<a></a>').attr('href', url);
                var childdiv = $('<div class="hotspot-spot"></div>').css({
                    width: (EndX - BeginX) * 100 + "%",
                    height: (EndY - BeginY) * 100 + "%",
                    left: BeginX * 100 + "%",
                    top: BeginY * 100 + "%"
                });
                parenta.prepend(childdiv).appendTo($this);
            });
        });
    }

    $(function () {
        getHotSpot();
    });
</script>
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
