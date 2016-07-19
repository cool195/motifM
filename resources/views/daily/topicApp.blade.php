<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$topic['title']}}</title>
    @include('head')
</head>

<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 主体内容 -->
    <div class="body-container" style="padding-top:0px">
        <!-- daily 详细内容 -->
        <section class="bg-white p-b-10x reserve-height">
        @if(isset($topic['infos']))
            @foreach($topic['infos'] as $k=>$value)
                @if($value['type']=='banner')
                    <!-- 第一个 banner 图 -->
                        <div @if($k!=0)class="p-y-10x"@endif>
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif">
                                <img class="img-fluid img-lazy"
                                     data-original="{{env('APP_Api_Image')}}/n0/{{$value['imgPath']}}"
                                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                     alt="">
                            </a>
                        </div>
                @elseif($value['type']=='title')
                    <!-- 标题 -->
                        <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif">
                            <div class="p-x-15x p-y-10x text-primary">
                                <strong>{{$value['value']}}</strong>
                            </div>
                        </a>
                    @elseif($value['type']=='boxline')
                        <hr class="hr-base m-x-5x m-y-0">
                    @elseif($value['type']=='context')
                    <!-- 描述 -->
                        <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?a=outurl&url='.urlencode($value['imgUrl'])}}@endif">
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
                                                 data-original="{{env('APP_Api_Image')}}/n0/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                 src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                                 alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid=@endif{{$value['skipId']}}">
                                    <img class="img-fluid img-lazy"
                                         data-original="{{env('APP_Api_Image')}}/n0/{{$value['imgPath']}}"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                         alt="">
                                </a>
                            @endif
                        @else
                            {{-- 商品列表横向 --}}
                            <div class="container-fluid p-x-15x">
                                <div class="row">
                                    @if(isset($value['spus']))
                                        @foreach($value['spus'] as $spu)
                                            <div class="col-xs-6">
                                                <a href="motif://o.c?a=pd&spu={{$spu}}">
                                                    <div class="p-t-10x productList-item m-b-0">
                                                        <div class="image-container">
                                                            <img class="img-thumbnail img-lazy"
                                                                 data-original="{{env('APP_Api_Image')}}/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                 src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                                 alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                            @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                                <div class="price-off">
                                                                    <img class="img-fluid" src="http://image.motif.me/n1/icon/motif/6036/300X300/d35e32ad392645b56a04df111ffef100.png" alt="">
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="p-y-10x">
                                                            <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                            @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                                <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($topic['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
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
        </section>
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js"></script>
<script src="{{env('CDN_Static')}}/scripts/JockeyJS.js"></script>
<script>
    $(document).ready(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });
</script>
@if($shareFlag)
    <script>
        var actionsShow = [{"icon": "", "name": "share"}]
        Jockey.send("action", {
            name: "showActions",
            token: "key",
            data: {"actions": actionsShow}
        });

        Jockey.on("action", function (actionName) {
                    if (actionName.name == "menuClick" && actionName.data.name == "share") {
                        Jockey.send("action", {
                            name: "share",
                            token: "key",
                            data: {
                                "title": "Look at this on Motif:",
                                "content": "{{$topic['title']}}",
                                "image": "",
                                "url": "http://m.motif.me/topic/{{$topicID}}"
                            }
                        });
                    }
                }
        );
    </script>
@endif
@include('global')
</html>
