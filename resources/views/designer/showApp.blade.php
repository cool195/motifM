<!DOCTYPE html>
<html lang="en">
<head>
    <title>DESIGNER</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/designerDetail.css">
</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 主体内容 -->
    <div class="body-container" style="padding-top:0px">
        <!-- designerDetail 设计师详情 -->
        <section class="reserve-height">
            <!-- 视频/图片 -->
            <div class="designer-media flex flex-justifyCenter flex-alignCenter">
                <img class="designer-placeImg" src="{{env('CDN_Static')}}/images/designer/placeholder.jpg" hidden>
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
                    <img src="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}" hidden>
                    <img style="height: 100%" class="img-fluid img-lazy designer-Img"
                         data-original="{{env('APP_Api_Image')}}/n2/{{$designer['img_video_path']}}"
                         src="{{env('APP_Api_Image')}}/n4/{{$designer['img_video_path']}}">
                @endif
            </div>

            <!-- 设计师 文字信息 -->
            <div class="bg-white p-a-5x">
                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <div class="font-size-base text-main"><strong>{{$designer['nickname']}}</strong></div>
                    <div class="flex flex-alignCenter">
                        <span class="p-r-20x">
                            @if(Session::get('user.pin'))
                                @if($designer['followStatus'])
                                    <a href="#" class="btn btn-sm btn-primary" id="follow"
                                       data-followid="{{$designer['designer_id']}}">Following</a>
                                @else
                                    <a href="#" class="btn btn-sm btn-follow active" id="follow"
                                       data-followid="{{$designer['designer_id']}}">Follow</a>
                                @endif
                            @else
                                <a href="#" class="btn btn-sm btn-follow active" id="sendLogin"
                                   data-followid="1">Follow</a>
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
                @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']))
                    <div class="p-x-10x p-t-5x p-b-15x">
                        @endif
                        @if(!empty($designer['instagram_link']))
                            <a href="motif://o.c?a=outurl&url={{$designer['instagram_link']}}" target="_blank"
                               class="p-r-20x">
                                <img src="{{env('CDN_Static')}}/images/designer/ins.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/ins@2x.png 2x,{{env('CDN_Static')}}/images/designer/ins@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['snapchat_link']))
                            <a href="motif://o.c?a=outurl&url={{$designer['snapchat_link']}}" target="_blank"
                               class="p-r-20x">
                                <img src="{{env('CDN_Static')}}/images/designer/snapchat.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/snapchat@2x.png 2x,{{env('CDN_Static')}}/images/designer/snapchat@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['youtube_link']))
                            <a href="motif://o.c?a=outurl&url={{$designer['youtube_link']}}" target="_blank"
                               class="p-r-20x">
                                <img src="{{env('CDN_Static')}}/images/designer/youtube.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/youtube@2x.png 2x,{{env('CDN_Static')}}/images/designer/youtube@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['facebook_link']))
                            <a href="motif://o.c?a=outurl&url={{$designer['facebook_link']}}" target="_blank"
                               class="p-r-20x">
                                <img src="{{env('CDN_Static')}}/images/designer/facebook.png"
                                     srcset="{{env('CDN_Static')}}/images/designer/facebook@2x.png 2x,{{env('CDN_Static')}}/images/designer/facebook@3x.png 3x">
                            </a>
                        @endif
                        @if(!empty($designer['instagram_link']) || !empty($designer['snapchat_link']) || !empty($designer['youtube_link']) || !empty($designer['facebook_link']))
                    </div>
            @endif


            <!-- 设计师 对应商品 -->
                <aside class="bg-white p-b-10x">
                    @if(isset($product['infos']))
                    @foreach($product['infos'] as $k=>$value)
                    @if($value['type']=='banner' || (!isset($value['spus']) && $value['type']=='product'))
                            <!-- 第一个 banner 图 -->
                    <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif"
                       data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                       data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'>
                        <div @if($k!=0)class="p-y-10x"@endif>
                            <img class="img-fluid"
                                 src="{{env('APP_Api_Image')}}/n2/{{$value['imgPath']}}">
                        </div>
                    </a>
                    @elseif($value['type']=='title')
                            <!-- 标题 -->
                    <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif"
                       data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                       data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'>
                        <div class="p-x-15x p-y-10x text-primary">
                            <strong>{{$value['value']}}</strong>
                        </div>
                    </a>
                    @elseif($value['type']=='boxline')
                        <hr class="hr-base m-x-5x m-y-0">
                    @elseif($value['type']=='context')
                                <!-- 描述 -->
                        <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif"
                           data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":{{$value['skipType']}},"skipId"{{$value['skipId']}},"expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                           data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":{{$value['skipType']}},"skipId":{{$value['skipId']}},expid":0,"index":{{$k}},"version":"1.0.1","ver":"9.2","src":"H5"}'>
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
                                        <a href="motif://o.c?a=pd&spu={{$spu}}">
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
                            <div class="container-fluid p-x-15x">
                                <div class="row">
                                    @if(isset($value['spus']))
                                        @foreach($value['spus'] as $key => $spu)
                                            <div class="col-xs-6">
                                                <a href="motif://o.c?a=pd&spu={{$spu}}"
                                                   data-clk='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":1,"skipType":1,"skipId"{{$spu}},"expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'
                                                   data-impr='http://clk.motif.me/log.gif?t=designer.400001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":{{$spu}},expid":0,"index":{{$key}},"version":"1.0.1","ver":"9.2","src":"H5"}'>
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
                                        <a href="motif://o.c?a=pd&spu={{$value['spu']}}" data-clk="{{ $value['clk'] }}"
                                           data-impr="{{ $value['impr'] }}">
                                            <div class="p-t-10x productList-item m-b-0">
                                                <div class="image-container">
                                                    <img class="img-thumbnail img-lazy"
                                                         src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                         data-original="{{env('APP_Api_Image')}}/n2/{{$value['main_image_url']}}"
                                                         alt="{{$value['main_title']}}">
                                                    @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                        <div class="price-off">
                                                            <img class="img-fluid"
                                                                 src="{{env('APP_Api_Image')}}/n0/{{ $value['skuPrice']['skuPromotion']['logo_path']}}"
                                                                 alt="">
                                                        </div>
                                                    @endif
                                                </div>
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
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>
<script src="{{env('CDN_Static')}}/scripts/designerDetail.js"></script>
<script src="{{env('CDN_Static')}}/scripts/videoPlay.js"></script>
<script src="{{env('CDN_Static')}}/scripts/JockeyJS.js"></script>
<script>
    var actionsShow = [{"icon": "", "name": "wish"}, {"icon": "", "name": "bag"}]
    Jockey.send("action", {
        name: "showActions",
        token: "key",
        data: {"actions": actionsShow}
    });

    Jockey.on("action", function (action) {
        //login
        if (action.name == "authInfo") {
            window.location.href = "http://m.motif.me/designer/{{$designer['designer_id']}}?token=" + action.data.token + "&pin=" + action.data.pin + "&email=" + action.data.email + "&name=" + decodeURIComponent(action.data.name)
        }
    });

    //login send
    $('#sendLogin').on('click', function () {
        Jockey.send("action", {
            name: "login",
            token: "key",
        });
    })

    $('#shareDesigner').on('click', function () {
        Jockey.send("action", {
            name: "share",
            token: "key",
            data: {
                "title": "Look at this on MOTIF:",
                "content": "{{ $designer['nickname'] }}",
                "image": "{{env('APP_Api_Image')}}/n2/{{$designer['main_img_path']}}",
                "url": "http://m.motif.me/designer/{{$designer['designer_id']}}"
            }
        });
    })


</script>
@include('global')
</html>
