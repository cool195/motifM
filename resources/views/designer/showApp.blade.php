<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(2 == $designer['designer_type']){{'Designer'}}@else{{'The Edit'}}@endif</title>
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
                    'actionField': {'list': '{{'designer_'.$designer['nickname'].'_'.$designer['designer_id'].(strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? '_android' : '_ios')}}'},      // Optional list property.
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
                    'list': '{{'designer_'.$designer['nickname'].'_'.$designer['designer_id'].(strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? '_android' : '_ios')}}',
                    'position': '{{$k}}'
                },
                    @endforeach
                    @endif
                    @endif
                    @endforeach

                    @if(isset($productAll['data']['list']))
                    @foreach($productAll['data']['list'] as $value)
                {
                    'name': '{{$value['main_title']}}',       // Name or ID is required.
                    'id': '{{$value['spu']}}',
                    'price': '{{number_format($value['skuPrice']['sale_price']/100,2)}}',
                    'brand': '{{$designer['nickname']}}',
                    'category': 'designerDetail',
                    'variant': '',
                    'list': '{{strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? 'designer_android_'.$designer['nickname'] : 'designer_ios_'.$designer['nickname']}}',
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
<div id="body-content"
     data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=page.100001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{$maidian['uuid']}}&ref=&v={"skipType":2,"skipId":"{{$designer['designer_id']}}","expid":"0","version":"1.0.1","ver":"9.2","src":"H5","utm_medium":"{{$maidian['utm_medium']}}","utm_source":"{{$maidian['utm_source']}}","mdeviceid":"{{$maidian['uuid']}}"}'>
    {{--主体内容--}}
    <div class="body-container app-container" style="padding-top:0px">
        {{--designerDetail 设计师详情--}}
        <section class="reserve-height" id="gaProductClick">
            @if(isset($designer['detailVideoPath']))
                {{--视频--}}
                <div class="designer-media bg-white">
                    <div class="player-item" data-playid="{{$designer['detailVideoPath']}}"
                         data-designerid="{{$designer['designer_id']}}">
                        <div id="ytplayer" class="ytplayer" data-playid="{{$designer['detailVideoPath']}}"></div>
                        <div class="bg-player">
                            <img class="bg-img" src="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}"
                                 alt="">
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
                {{--图片--}}
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

            {{--设计师 文字信息--}}
            <div class="bg-white p-a-5x">
                @if($designer['designer_id']==114)
                    <div class="font-size-sm text-primary p-t-10x p-b-15x p-x-15x" style="border-bottom: solid 1px #ccc;">
                        <div class="text-center">
                            <div class="font-size-md">Follow Michaela to be notified when<br> this collection is available</div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <div class="font-size-base text-main"><strong>{{$designer['nickname']}}</strong></div>
                    <div class="flex flex-alignCenter">
                        <span class="p-r-15x">
                            @if(Session::get('user.pin'))
                                @if($designer['followStatus'])
                                    {{--<div class="btn btn-sm btn-primary" id="follow"
                                         data-followid="{{$designer['designer_id']}}">Following</div>--}}
                                @else
                                    {{--<div class="btn btn-sm btn-follow active" id="follow"
                                         data-followid="{{$designer['designer_id']}}">Follow</div>--}}
                                @endif
                            @else
                                {{--<div class="btn btn-sm btn-follow active sendLogin upFollow"
                                     data-des="{{$designer['designer_id']}}">Follow</div>--}}
                            @endif
                        </span>
                        <span>
                            @if($designer['osType']=='ios')
                                <a id="shareDesigner" href="#"><img
                                            src="{{env('CDN_Static')}}/images/icon/share-ios.png"
                                            srcset="{{env('CDN_Static')}}/images/icon/share-ios@2x.png 2x,{{env('CDN_Static')}}/images/icon/share-ios@3x.png 3x"></a>
                            @else
                                <a id="shareDesigner" href="#"><img
                                            src="{{env('CDN_Static')}}/images/icon/share-android.png"
                                            srcset="{{env('CDN_Static')}}/images/icon/share-android@2x.png 2x,{{env('CDN_Static')}}/images/icon/share-android@3x.png 3x"></a>
                            @endif
                        </span>
                    </div>

                </div>
                {{--<div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>--}}
                {{--<hr class="hr-base m-a-0">--}}
                <div class="font-size-sm text-primary p-a-10x">
                    <div class="message-info">
                        <p class="m-b-0">{{$designer['describe']}}</p>
                    </div>
                    <a class="flex flex-alignCenter flex-fullJustified font-size-xs p-t-5x text-common btn-showMore">
                        <span class="showMore">Show More</span>
                        <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                    </a>
                </div>
                @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']) || !empty($designer['blog_link']))
                    <div class="p-x-15x p-t-5x p-b-15x">
                        @endif
                        @if(!empty($designer['instagram_link']))
                            <a href="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=outurl&url={{$designer['instagram_link']}}"
                               target="_blank"
                               class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/ins.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/ins@2x.png 2x,{{env('CDN_Static')}}/images/designer/ins@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['snapchat_link']))
                            <a href="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=outurl&url={{$designer['snapchat_link']}}"
                               target="_blank"
                               class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/snapchat.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/snapchat@2x.png 2x,{{env('CDN_Static')}}/images/designer/snapchat@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['youtube_link']))
                            <a href="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=outurl&url={{$designer['youtube_link']}}"
                               target="_blank"
                               class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/youtube.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/youtube@2x.png 2x,{{env('CDN_Static')}}/images/designer/youtube@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['facebook_link']))
                            <a href="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=outurl&url={{$designer['facebook_link']}}"
                               target="_blank"
                               class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/facebook.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/facebook@2x.png 2x,{{env('CDN_Static')}}/images/designer/facebook@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['blog_link']))
                            <a href="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=outurl&url={{$designer['blog_link']}}"
                               target="_blank"
                               class="p-r-20x SocialMedia">
                                <img src="{{env('CDN_Static')}}/images/designer/blog.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/blog@2x.png 2x,{{env('CDN_Static')}}/images/designer/blog@3x.png 3x">
                            </a>
                        @endif

                        @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']) || !empty($designer['blog_link']))
                    </div>
                @endif
            </div>

            {{--预售信息--}}
            @if($designer['prompt_info']['datePrompt'])
                @if($designer['prompt_info']['datePrompt']['endDate'] > time()*1000)
                    <section class="limited limited-data"
                             data-begintime="{{$designer['prompt_info']['datePrompt']['startDate']}}"
                             data-endtime="{{$designer['prompt_info']['datePrompt']['endDate']}}"
                             data-lefttime="{{$designer['prompt_info']['datePrompt']['endDate']-time()*1000}}">
                        <div class="bg-white">
                            <div class="limited-subtitle"><span
                                        class="p-l-15x p-r-10x bg-limited"><strong>{{$designer['prompt_info']['datePrompt']['title']}}</strong></span>
                            </div>

                            <div>
                                <div class="p-x-15x p-t-5x">
                                    <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                         srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                            <span class="text-primary font-size-sm">Orders Close <span
                                                        class="time_show"></span></span>
                                </div>
                                <div class="p-x-15x p-y-5x m-x-15x">
                                    <progress class="progress progress-primary" id="limited-progress" value=""
                                              max="10000">
                                        0%
                                    </progress>
                                </div>
                            </div>

                        </div>
                    </section>
                @else
                    <section class="limited">
                        <div class="bg-white">
                            <div class="limited-subtitle"><span
                                        class="p-l-15x p-r-10x bg-limited"><strong>{{$designer['prompt_info']['datePrompt']['title']}}</strong></span>
                            </div>
                            <div>
                                <div class="p-x-15x p-t-5x">
                                    <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                         srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                    <span class="text-primary font-size-sm">Orders Closed</span>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
            @if($designer['prompt_info']['textPrompt'])
                <section class="limited">
                    <div class="bg-white">
                        <div class="limited-subtitle">
                                    <span class="p-l-15x p-r-10x bg-limited">
                                    <strong>{{$designer['prompt_info']['textPrompt']['title']}}</strong></span></div>
                        <div class="p-x-15x p-t-10x p-b-15x text-primary font-size-sm">
                            {{$designer['prompt_info']['textPrompt']['content']}}
                        </div>
                    </div>
                </section>
            @endif
            {{--设计师 对应商品--}}
            <aside class="bg-white">
                @if(isset($product['infos']))
                    @foreach($product['infos'] as $k=>$value)
                        @if($value['type']=='banner' || (!isset($value['spus']) && $value['type']=='product'))
                            {{--第一个 banner 图--}}
                            @if(!isset($value['skipType']) || empty($value['skipId']))
                                <a href="javascript:void(0)">
                                    @else
                                        <a data-link="@if($value['skipType']=='1')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=designer_detail&from_id=' + $designer['designer_id'] + '&a=outurl&url='.urlencode($value['skipId'])}}@endif"
                                           data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                           data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                           href="javascript:void(0)">
                                            @endif
                                            <div class="p-y-5x">
                                                <img class="img-fluid"
                                                     src="{{env('APP_Api_Image')}}/n2/{{$value['imgPath']}}">
                                            </div>
                                        </a>
                                        @elseif($value['type']=='title')
                                            {{--标题--}}
                                            <a data-link="@if($value['skipType']=='1')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=designer_detail&from_id=' + $designer['designer_id'] + '&a=outurl&url='.urlencode($value['skipId'])}}@endif"
                                               data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                               data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                               href="javascript:void(0)">
                                                <div class="p-x-15x p-y-10x text-primary">
                                                    <strong>{{$value['value']}}</strong>
                                                </div>
                                            </a>
                                        @elseif($value['type']=='boxline')
                                            <hr class="hr-base m-x-5x m-y-0">
                                        @elseif($value['type']=='context')
                                            {{--描述--}}
                                            <a data-link="@if($value['skipType']=='1')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=designer_detail&from_id=' + $designer['designer_id'] + '&a=outurl&url='.urlencode($value['skipId'])}}@endif"
                                               data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                               data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":"{{$value['skipType']}}","skipId":"{{$value['skipId']}}","expid":0,"index":"{{$k}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                               href="javascript:void(0)">
                                                <div class="p-x-15x p-y-10x text-primary font-size-sm">
                                                    {{$value['value']}}
                                                </div>
                                            </a>
                                        @elseif($value['type']=='product')
                                            @if($value['style']=='box-vertical')
                                                {{-- 商品列表竖向 --}}
                                                @if(isset($value['spus']))
                                                    <div data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":1,"skipId":"{{ implode("_", $value['spus']) }}","expid":0,"index":"{{$key}}","version":"1.0.1","ver":"9.2","src":"H5"}'></div>
                                                    @foreach($value['spus'] as $spu)
                                                        <div class="p-x-15x p-y-10x">
                                                            <a data-link="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$spu}}"
                                                               data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","expid":0,"index":"{{$key}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                                               href="javascript:void(0)" data-spu="{{$spu}}"
                                                               data-title="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}"
                                                               data-price="{{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}">
                                                                <img class="img-fluid img-lazy"
                                                                     src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                                     data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                     alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @else
                                                {{-- 商品列表横向 --}}
                                                <div class="container-fluid p-x-0 bg-topic"
                                                     data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":1,"skipId":"{{ implode("_", $value['spus']) }}","expid":0,"index":"{{$key}}","version":"1.0.1","ver":"9.2","src":"H5"}'>
                                                    <div class="row m-a-0 productList">
                                                        @if(isset($value['spus']))
                                                            @foreach($value['spus'] as $key => $spu)
                                                                <div class="col-xs-6 p-a-0">
                                                                    <div class="topic-product-item productList-item">
                                                                        <a data-link="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$spu}}"
                                                                           data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","expid":0,"index":"{{$key}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                                                           href="javascript:void(0)" data-spu="{{$spu}}"
                                                                           data-title="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}"
                                                                           data-price="{{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}">
                                                                            <div class="image-container">
                                                                                {{--<img class="img-fluid img-lazy"--}}
                                                                                     {{--data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"--}}
                                                                                     {{--src="{{env('CDN_Static')}}/images/product/bg-product@336.png"--}}
                                                                                     {{--alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">--}}

                                                                                <div class="swiper-container productList-swiper">
                                                                                    <div class="swiper-wrapper">
                                                                                        <div class="swiper-slide">
                                                                                            <img class="img-fluid swiper-lazy"
                                                                                                 data-src="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                                                 alt="">
                                                                                            <img class="img-fluid preloader"
                                                                                                 src="{{env('CDN_Static')}}/images/product/bg-product@336.png" alt="">
                                                                                        </div>
                                                                                        {{--循环图片 begin--}}
                                                                                        @foreach($product['spuInfos'][$spu]['image_paths'] as $swiperImage)
                                                                                            <div class="swiper-slide">
                                                                                                <img class="img-fluid img-lazy"
                                                                                                     src="{{env('APP_Api_Image')}}/n2/{{$swiperImage}}"
                                                                                                     alt="">
                                                                                            </div>
                                                                                        @endforeach
                                                                                        {{--循环图片 begin--}}
                                                                                    </div>
                                                                                    <div class="swiper-pagination"></div>
                                                                                </div>

                                                                                @if(1 == $product['spuInfos'][$spu]['spuBase']['sale_type'])
                                                                                    {{--预售产品 预定信息--}}
                                                                                    @if($product['spuInfos'][$spu]['stockStatus']=='NO' || $product['spuInfos'][$spu]['spuBase']['isPutOn']==0)
                                                                                        <a data-link="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$spu}}"
                                                                                           data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","expid":0,"index":"{{$key}}","version":"1.0.1","ver":"9.2","src":"H5"}'
                                                                                           href="javascript:void(0)"
                                                                                           data-spu="{{$spu}}"
                                                                                           data-title="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}"
                                                                                           data-price="{{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}">
                                                                                            <div class="preorderSold-info" style="z-index: 100">
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
                                                                                <span class="wish-item p-r-10x"
                                                                                      data-id="{{$spu}}"
                                                                                      id="{{'wish'.$spu}}"><i
                                                                                            class="iconfont1 text-primary btn-wish"></i></span>
                                                                            @else
                                                                                <a class="wish-item p-r-10x"
                                                                                   href="javascript:;"><i
                                                                                            class="iconfont1 text-primary btn-wish sendLogin"
                                                                                            data-id="{{$spu}}"></i></a>
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
                                        <div class="container-fluid p-x-0 bg-topic">
                                            <div class="row m-a-0 productList">
                                                @foreach($productAll['data']['list'] as $value)
                                                    <div class="col-xs-6 p-a-0">
                                                        <div class="topic-product-item productList-item">
                                                            <a data-clk='{{ $value['clk'] }}'
                                                               data-link="motif://o.c?from=designer_detail&from_id={{$designer['designer_id']}}&a=pd&spu={{$value['spu']}}"
                                                               data-impr="{{ $value['impr'] }}"
                                                               href="javascript:void(0)"
                                                               data-spu="{{$value['spu']}}"
                                                               data-title="{{$value['main_title']}}"
                                                               data-price="{{number_format($value['skuPrice']['sale_price']/100,2)}}">
                                                                <div class="image-container">
                                                                    {{--<img class="img-fluid img-lazy"--}}
                                                                         {{--data-original="{{env('APP_Api_Image')}}/n2/{{$value['main_image_url']}}"--}}
                                                                         {{--src="{{env('CDN_Static')}}/images/product/bg-product@336.png"--}}
                                                                         {{--alt="{{$value['main_title']}}">--}}

                                                                    <div class="swiper-container productList-swiper">
                                                                        <div class="swiper-wrapper">
                                                                            <div class="swiper-slide">
                                                                                <img class="img-fluid swiper-lazy"
                                                                                     data-src="{{env('APP_Api_Image')}}/n2/{{$value['main_image_url']}}"
                                                                                     alt="">
                                                                                <img class="img-fluid preloader"
                                                                                     src="{{env('CDN_Static')}}/images/product/bg-product@336.png" alt="">
                                                                            </div>
                                                                            {{--循环图片 begin--}}
                                                                            @foreach($value['image_paths'] as $swiperImage)
                                                                                <div class="swiper-slide">
                                                                                    <img class="img-fluid img-lazy"
                                                                                         src="{{env('APP_Api_Image')}}/n2/{{$swiperImage}}"
                                                                                         alt="">
                                                                                </div>
                                                                            @endforeach
                                                                            {{--循环图片 begin--}}
                                                                        </div>
                                                                        <div class="swiper-pagination"></div>
                                                                    </div>


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
                                                                    <span class="wish-item p-r-10x"
                                                                          data-id="{{$value['spu']}}"
                                                                          id="{{'wish'.$value['spu']}}"><i
                                                                                class="iconfont1 text-primary btn-wish"></i></span>
                                                                @else
                                                                    <a class="wish-item p-r-10x" href="javascript:;"><i
                                                                                class="iconfont1 text-primary btn-wish sendLogin"
                                                                                data-id="{{$value['spu']}}"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if($designer['designer_id']==99)
                                        <div class="font-size-sm text-primary p-y-15x p-x-15x">
                                            <div class="text-center">
                                                <div>Love this collection? Follow Rae for early access to shop future
                                                    collections.
                                                </div>
                                                <div class="p-t-15x">
                                                    @if(Session::get('user.pin'))
                                                        @if($designer['followStatus'])
                                                            {{--<div class="btn btn-sm btn-primary" id="followapp"
                                                                 data-followid="{{$designer['designer_id']}}">Following
                                                            </div>--}}
                                                        @else
                                                            {{--<div class="btn btn-sm btn-follow active" id="followapp"
                                                                 data-followid="{{$designer['designer_id']}}">Follow
                                                            </div>--}}
                                                        @endif
                                                    @else
                                                        {{--<div class="btn btn-sm btn-follow active sendLogin downFollow"
                                                             data-des="{{$designer['designer_id']}}">Follow
                                                        </div>--}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                            @endif


            </aside>

        </section>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
<input type="hidden" id="spuArray" value="{{$designer['spuArray']}}">
<input type="hidden" id="wishspu" value="">
<input type="hidden" id="followDes" value="">
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/designerDetail.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/JockeyJS.js"></script>
<script>
    $('#followapp').on('click', function () {
        $this = $(this)
        $.ajax({
            url: '/followDesigner/' + $this.data('followid'),
            type: 'GET'
        })
                .done(function (data) {
                    if (data.success) {
                        if ($this.hasClass('active')) {
                            $this.html('Following');
                            $this.toggleClass('active');
                            $this.addClass('btn-primary').removeClass('btn-follow');

                            $('#follow').html('Following');
                            $('#follow').toggleClass('active');
                            $('#follow').addClass('btn-primary').removeClass('btn-follow');
                        } else {
                            $this.html('Follow');
                            $this.toggleClass('active');
                            $this.addClass('btn-follow').removeClass('btn-primary');

                            $('#follow').html('Follow');
                            $('#follow').toggleClass('active');
                            $('#follow').addClass('btn-follow').removeClass('btn-primary');
                        }
                    }
                })
    });

    $('#follow').on('click', function () {
        $this = $(this)
        $.ajax({
            url: '/followDesigner/' + $this.data('followid'),
            type: 'GET'
        })
                .done(function (data) {
                    if (data.success) {
                        if ($this.hasClass('active')) {
                            $this.html('Following');
                            $this.toggleClass('active');
                            $this.addClass('btn-primary').removeClass('btn-follow');

                            $('#followapp').html('Following');
                            $('#followapp').toggleClass('active');
                            $('#followapp').addClass('btn-primary').removeClass('btn-follow');
                        } else {
                            $this.html('Follow');
                            $this.toggleClass('active');
                            $this.addClass('btn-follow').removeClass('btn-primary');

                            $('#followapp').html('Follow');
                            $('#followapp').toggleClass('active');
                            $('#followapp').addClass('btn-follow').removeClass('btn-primary');
                        }
                    }
                })
    });

    @if($designer['pushspu'])
        Jockey.send("action", {
        name: "updateWish",
        token: "key",
        data: {"spu": "{{$designer['pushspu']}}", "isAdd": true}
    });
            @endif
    var actionsShow = [{"icon": "", "name": "wish"}, {"icon": "", "name": "bag"}]
    Jockey.send("action", {
        name: "showActions",
        token: "key",
        data: {"actions": actionsShow}
    });

    Jockey.on("action", function (action) {
        alert('进入页面');
        //login
        if (action.name == "authInfo") {
            alert('进入 authInfo');
            alert("token:"+ action.data.token +"-----pin:"+action.data.pin+"-----email:"+action.data.email);
            var f = '{{strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? 'f=android' : 'f=ios'}}';
            window.location.href = "/designer/{{$designer['designer_id']}}?f=" + f + "&des=" + $('#followDes').val() + "&wishspu=" + $('#wishspu').val() + "&token=" + action.data.token + "&pin=" + action.data.pin + "&email=" + action.data.email + "&name=" + decodeURIComponent(action.data.name)
        }
        else if (action.name == "addWish") {
            var spus = action.data.spu.split(',');
            $.each(spus, function (n, value) {
                $('#wish' + value).html('<i class="iconfont1 text-primary btn-wish active"></i>');
            });
        }
    });

    //login send
    $('.sendLogin').on('click', function () {
        $('#wishspu').val($(this).data('id'));
        $('#followDes').val($(this).data('des'));
        Jockey.send("action", {
            name: "login",
            token: "key",
        });
    });

    $('#shareDesigner').on('click', function () {
        Jockey.send("action", {
            name: "share",
            token: "key",
            data: {
                "title": "Look at this on MOTIF:",
                "content": "{{ $designer['nickname'] }}",
                "image": "{{env('APP_Api_Image')}}/n2/{{$designer['main_img_path']}}",
                "url": "https://m.motif.me/designer/{{$designer['designer_id']}}"
            }
        });
    });

    $('.wish-item').on('click', function () {
        $this = $(this);
        var cmd = true;
        if ($this.find('i').hasClass('active')) {
            cmd = false;
            $this.html('<i class="iconfont1 text-primary btn-wish"></i>');
        } else {
            if (!$this.find('i').hasClass('sendLogin')) {
                $this.html('<i class="iconfont1 text-primary btn-wish active"></i>');
            }
        }
        Jockey.send("action", {
            name: "updateWish",
            token: "key",
            data: {"spu": $this.data('id').toString(), "isAdd": cmd}
        });
        $.ajax({
            url: '/wish/' + $this.data('id'),
            type: 'GET'
        });
    });

            {{--App 发版一周后打开--}}
            @if(Session::get('user.pin'))
    var spuStr = $('#spuArray').val().replace("[", "");
    spuStr = spuStr.replace("]", "");
    Jockey.send("action", {
        name: "checkWish",
        token: "key",
        data: {"spu": spuStr, "callback": 'addWish'}
    });
    @endif


</script>
@include('global')
<script src="{{env('CDN_Static')}}/scripts/videoPlay.js{{'?v='.config('app.version')}}"></script>
</html>
