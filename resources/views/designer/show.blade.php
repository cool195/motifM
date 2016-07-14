<!DOCTYPE html>
<html lang="en">
<head>

    <title>Designer Detail</title>
    @include('head')
    <link rel="stylesheet" href="/styles/designerDetail.css">
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
                <!-- designerDetail 设计师详情 -->
        <section class="reserve-height">
            <!-- 视频/图片-->
            <img src="{{ env('APP_Api_Image').'/n1/'.$designer['main_image_url'] }}" style="display: none">
            <div class="designer-media flex flex-justifyCenter flex-alignCenter">
                <img class="designer-placeImg" src="/images/designer/placeholder.jpg" alt="" hidden>
                @if($designer['path_type']==2)
                    <div id="ytplayer" data-playid="{{$designer['img_video_path']}}">
                        <div class="loading loading-screen loading-transprant loading-hidden">
                            <div class="">
                                <div class="loader"></div>
                                <div class="text-white font-size-md text-center m-t-10x">Loading</div>
                            </div>
                        </div>
                    </div>
                @else
                    <img src="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}" alt=""
                         class="designer-realImg" hidden>
                    <img class="img-fluid img-lazy designer-Img"
                         data-original="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}"
                         src="/images/designer/bg-designer@750x550.png" alt="">
                @endif
            </div>

            <!-- 设计师 文字信息 -->
            <div class="bg-white p-a-5x">
                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <p class="font-size-base text-main"><strong>{{$designer['nickname']}}</strong></p>
                </div>
                {{--<div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>--}}
                {{--<hr class="hr-base m-a-0">--}}
                <div class="font-size-sm text-primary p-a-10x">
                    <div class="message-info">
                        <p class="m-b-0">{{$designer['describe']}}</p>
                    </div>
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm p-t-5x text-common btn-showMore">
                        <span class="showMore">Show More</span>
                        <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                    </a>
                </div>
                <div class="p-x-10x p-t-5x p-b-15x">
                    @if(!empty($designer['instagram_link']))
                        <a href="{{$designer['instagram_link']}}" target="_blank" class="p-r-20x SocialMedia">
                            <img src="/images/designer/ins.png"
                                 srcset="/images/designer/ins@2x.png 2x,/images/designer/ins@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['snapchat_link']))
                        <a href="{{$designer['snapchat_link']}}" target="_blank" class="p-r-20x SocialMedia">
                            <img src="/images/designer/snapchat.png"
                                 srcset="/images/designer/snapchat@2x.png 2x,/images/designer/snapchat@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['youtube_link']))
                        <a href="{{$designer['youtube_link']}}" target="_blank" class="p-r-20x SocialMedia">
                            <img src="/images/designer/youtube.png"
                                 srcset="/images/designer/youtube@2x.png 2x,/images/designer/youtube@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['facebook_link']))
                        <a href="{{$designer['facebook_link']}}" target="_blank" class="p-r-20x SocialMedia">
                            <img src="/images/designer/facebook.png"
                                 srcset="/images/designer/facebook@2x.png 2x,/images/designer/facebook@3x.png 3x">
                        </a>
                    @endif
                </div>
            </div>
            <!-- 设计师 对应模版商品 -->
            <aside class="bg-white p-b-10x">
                @if(isset($product['infos']))
                @foreach($product['infos'] as $k=>$value)
                @if($value['type']=='banner' || (!isset($value['spus']) && $value['type']=='product'))
                        <!-- 第一个 banner 图 -->
                <a href="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                    data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'
                    data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'>
                    <div @if($k!=0)class="p-y-10x"@endif>
                        <img class="img-fluid"
                             src="{{env('APP_Api_Image')}}/n2/{{$value['imgPath']}}">
                    </div>
                </a>
                @elseif($value['type']=='title')
                        <!-- 标题 -->
                <a href="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                   data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'
                   data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'>
                    <div class="p-x-15x p-y-10x text-primary">
                        <strong>{{$value['value']}}</strong>
                    </div>
                </a>
                @elseif($value['type']=='boxline')
                    <hr class="hr-base m-x-5x m-y-0">
                    @elseif($value['type']=='context')
                            <!-- 描述 -->
                    <a href="@if($value['skipType']=='1')/detail/{{$value['skipId']}}{{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')/shopping#{{$value['skipId']}}@else{{$value['imgUrl']}}@endif"
                       data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'
                       data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'>
                        <div class="p-x-15x p-y-10x text-primary font-size-sm">
                            {{$value['value']}}
                        </div>
                    </a>
                @elseif($value['type']=='product')
                    @if($value['style']=='box-vertical')
                        {{-- 商品列表竖向 --}}
                        @if(isset($value['spus']))
                            @foreach($value['spus'] as $spu)
                                <div class="p-x-15x p-y-10x">
                                    <a href="/detail/{{$spu}}">
                                        <img class="img-fluid img-lazy"
                                             src="/images/product/bg-product@336.png"
                                             data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                             alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    @else
                        {{-- 商品列表横向 --}}
                        <div class="container-fluid p-x-15x">
                            <div class="row">
                                @if(isset($value['spus']))
                                    @foreach($value['spus'] as $spu)
                                        <div class="col-xs-6">
                                            <a href="/detail/{{$spu}}"
                                               data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":1,"skipId"{{$spu}},"expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}'
                                               data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":{{$spu}},expid":0,"version":"1.0.1","ver":"9.2","src":"H5"}' >
                                                <div class="p-t-10x">
                                                    <img class="img-thumbnail img-lazy"
                                                         src="/images/product/bg-product@336.png"
                                                         data-original="{{env('APP_Api_Image')}}/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                         alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                    <div class="p-y-10x">
                                                        <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                        @if($product['spuInfos'][$spu]['skuPrice']['sale_price'] != $product['spuInfos'][$spu]['skuPrice']['price'])
                                                            <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($product['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
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
                    <div class="container-fluid p-x-15x" data-impr="{{ $productAll['data']['impr'] }}">
                        <div class="row">
                            @foreach($productAll['data']['list'] as $value)
                                <div class="col-xs-6">
                                    <a href="/detail/{{$value['spu']}}" data-clk="{{ $value['clk'] }}"
                                       data-impr="{{ $value['impr'] }}">
                                        <div class="p-t-10x">
                                            <img class="img-thumbnail img-lazy"
                                                 src="/images/product/bg-product@336.png"
                                                 data-original="{{env('APP_Api_Image')}}/n2/{{$value['main_image_url']}}"
                                                 alt="{{$value['main_title']}}">
                                            <div class="p-y-10x">
                                                <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($value['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                    <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($value['skuPrice']['price']/100,2)}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
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
<script src="/scripts/vendor.js"></script>
<script src="/scripts/designerDetail.js"></script>
<script src="/scripts/videoPlay.js"></script>
@include('global')
</html>
