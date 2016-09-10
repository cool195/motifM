<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:image" content="{{ env('APP_Api_Image').'/n1/'.$designer['img_video_path'] }}"/>
    <meta property="og:title" content="{{$designer['nickname']}}"/>
    <title>Designer Detail</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/designerDetail.css{{'?v='.config('app.version')}}">
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
                    'actionField': {'list': 'designer'},      // Optional list property.
                    'products': [{
                        'name': name,                      // Name or ID is required.
                        'id': spu,
                        'price': price,
                        'brand': '{{$designer['nickname']}}',
                        'category': 'designerDetail',
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
                    @foreach($product['infos'] as $value)
                    @if($value['type']=='product')
                    @if(isset($value['spus']))
                    @foreach($value['spus'] as $k=>$spu)
                {
                    'name': '{{$product['spuInfos'][$spu]['spuBase']['main_title']}}',       // Name or ID is required.
                    'id': '{{$spu}}',
                    'price': '{{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}',
                    'brand': '{{$designer['nickname']}}',
                    'category': 'designerDetail',
                    'variant': '',
                    'list': '{{'designer_'.$designer['nickname']}}',
                    'position': '{{$k}}'
                },
                    @endforeach
                    @endif
                    @endif
                    @endforeach


                @if(isset($productAll['data']['list']))
                @foreach($productAll['data']['list'] as $k=>$value)
                {
                    'name': '{{$value['main_title']}}',       // Name or ID is required.
                    'id': '{{$value['spu']}}',
                    'price': '{{number_format($value['skuPrice']['sale_price']/100,2)}}',
                    'brand': '{{$designer['nickname']}}',
                    'category': 'designerDetail',
                    'variant': '',
                    'list': '{{'designer_'.$designer['nickname']}}',
                    'position': '{{$k}}'
                },
                @endforeach
                @endif

            ]
        }
    });
</script>
@include('check.tagmanager')
{{--外层容器--}}
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- designerDetail 设计师详情 -->
        <section class="reserve-height">
        @if(isset($designer['detailVideoPath']))
            <!-- 视频 -->
                <div class="designer-media bg-white">
                    <div class="player-item" data-playid="{{$designer['detailVideoPath']}}" data-designerid="{{$designer['designer_id']}}">
                        <div id="ytplayer" data-playid="{{$designer['detailVideoPath']}}"></div>
                        <div class="bg-player">
                            <img class="bg-img" src="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}" alt="">
                            <div class="btn-beginPlayer designer-beginPlayer">
                                <div class="loading loading-screen loading-transprant">
                                    <div class="">
                                        <div class="loader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="youtube_mask"></div>
                    </div>
                </div>
        @else
            <!-- 图片-->
                <div class="designer-media flex flex-justifyCenter flex-alignCenter">
                    <img class="designer-placeImg" src="{{env('CDN_Static')}}/images/designer/placeholder.jpg" alt=""
                         hidden>
                    <img src="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}" alt=""
                         class="designer-realImg" hidden>
                    <img style="height: 100%" class="img-fluid img-lazy designer-Img"
                         data-original="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}"
                         src="{{env('CDN_Static')}}/images/designer/bg-designer@750x550.png" alt="">
                </div>
        @endif
        <!-- 设计师 文字信息 -->
                <div class="bg-white">
                    <div class="flex flex-alignCenter flex-fullJustified p-x-15x p-t-15x">
                        <p class="font-size-base text-main"><strong>{{$designer['nickname']}}</strong></p>
                    </div>
                {{--<div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>--}}
                {{--<hr class="hr-base m-a-0">--}}
                <div class="font-size-sm text-primary p-y-10x p-x-15x">
                    <div class="message-info">
                        <p class="m-b-0">{{$designer['describe']}}</p>
                    </div>
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm p-t-5x text-common btn-showMore">
                        <span class="showMore">Show More</span>
                        <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                    </a>
                </div>
                @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']))
                    <div class="p-x-15x p-t-5x p-b-15x">
                        @endif
                        @if(!empty($designer['instagram_link']))
                            <a href="{{$designer['instagram_link']}}" target="_blank" class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/ins.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/ins@2x.png 2x,{{env('CDN_Static')}}/images/designer/ins@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['snapchat_link']))
                            <a href="{{$designer['snapchat_link']}}" target="_blank" class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/snapchat.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/snapchat@2x.png 2x,{{env('CDN_Static')}}/images/designer/snapchat@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['youtube_link']))
                            <a href="{{$designer['youtube_link']}}" target="_blank" class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/youtube.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/youtube@2x.png 2x,{{env('CDN_Static')}}/images/designer/youtube@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['facebook_link']))
                            <a href="{{$designer['facebook_link']}}" target="_blank" class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/facebook.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/facebook@2x.png 2x,{{env('CDN_Static')}}/images/designer/facebook@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['blog_link']))
                            <a href="{{$designer['blog_link']}}" target="_blank" class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/blog.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/blog@2x.png 2x,{{env('CDN_Static')}}/images/designer/blog@3x.png 3x">
                            </a>
                        @endif

                        @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']))
                    </div>
                @endif
                </div>

            <!-- 预售信息 -->
            <section class="limited-content" hidden>
                <div class="bg-white m-b-10x m-y-10x">
                    <div class="p-x-15x limited-subtitle"><strong>LIMITED EDITION</strong></div>
                        <div>
                            <div class="p-x-15x p-t-5x">
                                <img src="/images/icon/icon-limited.png"
                                     srcset="/images/icon/icon-limited@2x.png 2x, /images/icon/icon-limited@3x.png 3x"
                                     alt="">
                                <span class="text-primary font-size-sm">Orders Close <span class="time_show"></span></span>
                            </div>
                            <div class="p-x-15x p-y-5x m-x-15x">
                                    <progress class="progress progress-primary" id="limited-progress" value="" max="10000">0%</progress>
                            </div>
                        </div>
                </div>
            </section>
            <section class="limited" hidden>
                <div class="bg-white m-y-10x">
                    <div class="p-x-15x limited-subtitle"><strong>PREORDER</strong></div>
                    <div class="p-x-15x p-t-10x p-b-15x text-primary font-size-sm">
                        Expected to ship on <strong id="shipToDate"></strong>
                    </div>
                </div>
            </section>
            <!-- 设计师 对应模版商品 -->
                <aside class="bg-white">
                        @inject('wishlist', 'App\Http\Controllers\Shopping\ShoppingController')
                        @if(isset($product['infos']))
                            @foreach($product['infos'] as $k=>$value)
                                @if($value['type']=='banner' || (!isset($value['spus']) && $value['type']=='product'))
                                    <!-- 第一个 banner 图 -->
                                        @if(!isset($value['skipType']))
                                            <a href="javascript:void(0)">
                                        @else
                                            <a data-link="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                                               data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                               data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                               href="javascript:void(0)">
                                        @endif
                                            <div @if($k!=0)class="p-y-10x"@endif>
                                                <img class="img-fluid"
                                                     src="{{env('APP_Api_Image')}}/n2/{{$value['imgPath']}}">
                                            </div>
                                        </a>
                                @elseif($value['type']=='title')
                                    <!-- 标题 -->
                                        <a data-link="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                                           data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                           data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                           href="javascript:void(0)">
                                            <div class="p-x-15x p-y-10x text-primary">
                                                <strong>{{$value['value']}}</strong>
                                            </div>
                                        </a>
                                    @elseif($value['type']=='boxline')
                                        <hr class="hr-base m-x-5x m-y-0">
                                    @elseif($value['type']=='context')

                                            <!-- 描述 -->
                                    <a data-link="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                                       data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                       data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                       href="javascript:void(0)">
                                        <div class="p-x-15x p-y-10x text-primary font-size-sm">
                                            {{$value['value']}}
                                        </div>
                                    </a>
                                @elseif($value['type']=='product')
                                    @if($value['style']=='box-vertical')
                                        {{-- 商品列表竖向 --}}
                                        @if(isset($value['spus']))
                                            <div data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":{{ implode("_", $value['spus']) }},expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'></div>
                                            @foreach($value['spus'] as $spu)
                                                <div class="p-x-15x p-y-10x">
                                                    <a data-link="/detail/{{$spu}}"
                                                       data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":1,"skipId"{{$spu}},"expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                                       href="javascript:void(0)">
                                                        <img class="img-fluid img-lazy"
                                                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                             data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                             alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                    </a>
                                                    @if(Session::has('user'))
                                                        <span class="wish-item p-r-10x"><i class="iconfont text-common btn-wish btn-wished @if(in_array($spu, $wishlist->wishlist())) {{'active'}} @endif" data-spu="{{$spu}}"></i></span>
                                                    @else
                                                        <a class="wish-item p-r-10x" href="javascript:;"><i class="iconfont text-common btn-wish btn-wished"  data-actionspu="{{$spu}}"></i></a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    @else
                                        {{-- 商品列表横向 --}}
                                        <div class="container-fluid p-x-0 bg-topic"
                                             data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":{{ implode("_", $value['spus']) }},expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'>
                                            <div class="row m-a-0 productList">
                                                @if(isset($value['spus']))
                                                    @foreach($value['spus'] as $key => $spu)
                                                        <div class="col-xs-6 p-a-0">
                                                            @if($key==0 && $product['spuInfos'][$spu]['spuBase']['sale_type']==1 && isset($product['spuInfos'][$spu]['skuPrice']['skuPromotion']) && $product['spuInfos'][$spu]['spuBase']['isPutOn']==1 && $product['spuInfos'][$spu]['stockStatus']=='YES')
                                                                <p class="limited-data" hidden data-ship="{{$product['spuInfos'][$spu]['skuPrice']['skuPromotion']['ship_desc']}}" data-begintime="{{$product['spuInfos'][$spu]['skuPrice']['skuPromotion']['start_time']}}" data-endtime="{{$product['spuInfos'][$spu]['skuPrice']['skuPromotion']['end_time']}}" data-lefttime="{{$product['spuInfos'][$spu]['skuPrice']['skuPromotion']['remain_time']}}"></p>
                                                            @endif
                                                            <div class="topic-product-item productList-item">
                                                                <a data-link="/detail/{{$spu}}"
                                                                   data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":1,"skipId"{{$spu}},"expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                                                   href="javascript:void(0)">
                                                                    <div class="image-container">
                                                                        <img class="img-fluid img-lazy"
                                                                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                                             data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                             alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                                        @if(1 == $product['spuInfos'][$spu]['spuBase']['sale_type'])
                                                                            @if(!isset($product['spuInfos'][$spu]['skuPrice']['skuPromotion']) || $product['spuInfos'][$spu]['stockStatus']=='NO' || $product['spuInfos'][$spu]['spuBase']['isPutOn']==0)
                                                                                <a data-link="/detail/{{$spu}}"
                                                                                   data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":1,"skipId"{{$spu}},"expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                                                                   href="javascript:void(0)">
                                                                                    <div class="preorderSold-info">
                                                                                        <span class="font-size-xs">SOLD OUT</span>
                                                                                    </div>
                                                                                </a>
                                                                            @else
                                                                                <span class="preorder-info font-size-xs">Limited Edition</span>
                                                                            @endif

                                                                        @endif
                                                                    </div>
                                                                </a>
                                                                <div class="font-size-sm product-title text-main">
                                                                    {{$product['spuInfos'][$spu]['spuBase']['main_title']}}
                                                                </div>
                                                                <div class="price-caption">
                                                                    <span>
                                                                        @if($product['spuInfos'][$spu]['skuPrice']['sale_price'] != $product['spuInfos'][$spu]['skuPrice']['price'])
                                                                            <span class="text-red font-size-sm m-l-5x"><strong>${{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                                            <span class="font-size-xs text-common text-throughLine">${{number_format($product['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                                        @else
                                                                            <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                                        @endif
                                                                    </span>
                                                                    @if(Session::has('user'))
                                                                        <span class="wish-item p-r-10x"><i class="iconfont text-common btn-wish btn-wished @if(in_array($spu, $wishlist->wishlist())){{'active'}}@endif" data-spu="{{$spu}}"></i></span>
                                                                    @else
                                                                        <a class="wish-item p-r-10x" href="javascript:;"><i class="iconfont text-common btn-wish btn-wished" data-actionspu="{{$spu}}"></i></a>
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
                        @if(isset($productAll['data']['list']))
                            {{-- 商品列表横向 --}}
                            <div class="container-fluid p-x-0 bg-topic " data-impr="{{ $productAll['data']['impr'] }}">
                                <div class="row m-a-0 productList">
                                    @foreach($productAll['data']['list'] as $value)
                                        <div class="col-xs-6 p-a-0">
                                            <div class="topic-product-item productList-item">
                                                <a data-link="/detail/{{$value['spu']}}" data-clk="{{ $value['clk'] }}"
                                                   data-impr="{{ $value['impr'] }}" href="javascript:void(0)">
                                                    <div class="image-container">
                                                        <img class="img-fluid img-lazy"
                                                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                             data-original="{{env('APP_Api_Image')}}/n2/{{$value['main_image_url']}}"
                                                             alt="{{$value['main_title']}}">
                                                        @if(1 == $value['sale_type'])
                                                            {{--预售产品 预定信息--}}
                                                            <span class="preorder-info font-size-xs">Limited Edition</span>
                                                        @endif
                                                    </div>
                                                </a>
                                                <div class="font-size-sm product-title text-main">
                                                    {{$value['main_title']}}
                                                </div>
                                                <div class="price-caption">
                                                    <span>
                                                        @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                            <span class="text-red font-size-sm m-l-5x"><strong>${{number_format($value['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                            <span class="font-size-xs text-common text-throughLine">${{number_format($value['skuPrice']['price']/100,2)}}</span>
                                                        @else
                                                            <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($value['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                        @endif
                                                    </span>
                                                    @if(Session::has('user'))
                                                        <span class="wish-item p-r-10x"><i class="iconfont text-common btn-wish btn-wished @if(in_array($value['spu'], $wishlist->wishlist())){{'active'}}@endif" data-spu="{{$value['spu']}}"></i></span>
                                                    @else
                                                        <a class="wish-item p-r-10x" href="javascript:;"><i class="iconfont text-common btn-wish btn-wished" data-actionspu="{{$value['spu']}}"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                </aside>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>

<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/designerDetail.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@include('global')
<script src="{{env('CDN_Static')}}/scripts/videoPlay.js{{'?v='.config('app.version')}}"></script>
</html>
