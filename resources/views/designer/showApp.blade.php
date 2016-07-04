<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$designer['nickname']}}</title>
    @include('head')
    <link rel="stylesheet" href="/styles/designerDetail.css">
</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 主体内容 -->
    <div class="body-container" style="padding-top:0px">
        <!-- designerDetail 设计师详情 -->
        <section>
            <!-- 视频/图片 -->
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
                    <img src="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$designer['img_video_path']}}" alt=""
                         class="designer-realImg" hidden>
                    <img class="img-fluid img-lazy designer-Img"
                         data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$designer['img_video_path']}}"
                         src="/images/designer/bg-designer@750x550.png" alt="">
                @endif
            </div>

            <!-- 设计师 文字信息 -->
            <div class="bg-white p-a-5x">
                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <div class="font-size-base text-main"><strong>{{$designer['nickname']}}</strong></div>
                    <div class="flex flex-alignCenter">
                        <span class="p-r-20x">
                            @if(Session::get('user.pin'))
                                <a href="#" data-followid="{{$designer['designer_id']}}"
                                   class="btn btn-follow btn-sm @if(!$designer['followStatus']) active @endif"
                                   id="follow">@if($designer['followStatus']){{'Following'}}@else{{'Follow'}}@endif</a>
                            @else
                                <a href="#" class="btn btn-follow btn-sm active" id="sendLogin">Follow</a>
                            @endif
                        </span>
                    </div>

                </div>
                <div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>
                <hr class="hr-base m-a-0">
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
                        <a href="motif://o.c?a=outurl&url={{$designer['instagram_link']}}" target="_blank"
                           class="p-r-20x">
                            <img src="/images/designer/ins.png"
                                 srcset="/images/designer/ins@2x.png 2x,/images/designer/ins@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['snapchat_link']))
                        <a href="motif://o.c?a=outurl&url={{$designer['snapchat_link']}}" target="_blank"
                           class="p-r-20x">
                            <img src="/images/designer/snapchat.png"
                                 srcset="/images/designer/snapchat@2x.png 2x,/images/designer/snapchat@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['youtube_link']))
                        <a href="motif://o.c?a=outurl&url={{$designer['youtube_link']}}" target="_blank"
                           class="p-r-20x">
                            <img src="/images/designer/youtube.png"
                                 srcset="/images/designer/youtube@2x.png 2x,/images/designer/youtube@3x.png 3x">
                        </a>
                    @endif
                    @if(!empty($designer['facebook_link']))
                        <a href="motif://o.c?a=outurl&url={{$designer['facebook_link']}}" target="_blank"
                           class="p-r-20x">
                            <img src="/images/designer/facebook.png"
                                 srcset="/images/designer/facebook@2x.png 2x,/images/designer/facebook@3x.png 3x">
                        </a>
                    @endif
                </div>
            </div>

            <!-- 设计师 对应商品 -->
            <aside class="bg-white p-b-10x">
            @if(isset($product['infos']))
                @foreach($product['infos'] as $k=>$value)
                    @if($value['type']=='banner' || (!isset($value['spus']) && $value['type']=='product'))
                        <!-- 第一个 banner 图 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.$value['imgUrl']}}@endif">
                                <div @if($k!=0)class="p-y-10x"@endif>
                                    <img class="img-fluid"
                                         src="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$value['imgPath']}}">
                                </div>
                            </a>
                    @elseif($value['type']=='title')
                        <!-- 标题 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.$value['imgUrl']}}@endif">
                                <div class="p-x-15x p-y-10x text-primary">
                                    <strong>{{$value['value']}}</strong>
                                </div>
                            </a>
                        @elseif($value['type']=='boxline')
                            <hr class="hr-base m-x-5x m-y-0">
                        @elseif($value['type']=='context')
                        <!-- 描述 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.$value['imgUrl']}}@endif">
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
                                                     src="/images/product/bg-product@336.png"
                                                     data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
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
                                                    <a href="motif://o.c?a=pd&spu={{$spu}}">
                                                        <div class="p-t-10x">
                                                            <img class="img-thumbnail img-lazy"
                                                                 src="/images/product/bg-product@336.png"
                                                                 data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
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
                    <div class="container-fluid p-x-15x">
                        <div class="row">
                            @foreach($productAll['data']['list'] as $value)
                                <div class="col-xs-6">
                                    <a href="motif://o.c?a=pd&spu={{$value['spu']}}">
                                        <div class="p-t-10x">
                                            <img class="img-thumbnail img-lazy"
                                                 src="/images/product/bg-product@336.png"
                                                 data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$value['main_image_url']}}"
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
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>

</body>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/designerDetail.js"></script>
<script src="/scripts/videoPlay.js"></script>
<script src="/scripts/JockeyJS.js"></script>
<script>
    var actionsShow = [{"icon": "", "name": "share"}]
    Jockey.send("action", {
        name: "showActions",
        token: "key",
        data: {"actions": actionsShow}
    });

    Jockey.on("action", function (action) {
        //share
        if (action.name == "menuClick" && action.data.name == "share") {
            Jockey.send("action", {
                name: "share",
                token: "key",
                data: {
                    "title": "Designer",
                    "content": "Designer test info",
                    "image": "",
                    "url": "http://m.motif.me/designer/{{$designer['designer_id']}}"
                }
            });
        }
        //login
        else if (action.name == "authInfo") {
            //ajax post session info
            $.ajax({
                url: '/rsyncLogin',
                type: 'POST',
                data: {
                    token: action.data.token,
                    pin: action.data.pin,
                    email: action.data.email,
                    name: decodeURIComponent(action.data.name),
                    uuid: action.data.uuid
                },
                success: function (data) {
                    if (data.success) {
                        window.location.href="http://m.motif.me/designer/{{$designer['designer_id']}}?rsync=1"
                    }
                }
            })
        }
    });

    //login send
    $('#sendLogin').on('click', function () {
        Jockey.send("action", {
            name: "login",
            token: "key",
        });
    })
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
