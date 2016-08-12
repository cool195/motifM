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
                                     data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                     alt="">
                            </a>
                        </div>
                @elseif($value['type']=='multilink')
                    <!-- 锚点图 -->
                        <div class="m-y-10x">
                            <div class="hotspot-image" data-hotspot='@foreach($value['squas'] as $v){{'{"beginX":'.$v['startX'].',"beginY":'.$v['startY'].',"skipId":"'.$v['skipId'].'","skipType":"'.$v['skipType'].'","endX":'.$v['endX'].',"endY":'.$v['endY'].'},'}}@endforeach'>
                                <img class="img-fluid" src="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}">
                            </div>
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
                        <div data-impr='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{ Session::get('user.uuid') }}&v={"action":0,"skipType":1,"skipId":{{ implode("_", $value['spus']) }},"topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'></div>
                        @if($value['style']=='box-vertical')
                            {{-- 商品列表竖向 --}}
                            @if(isset($value['spus']))
                                @foreach($value['spus'] as $spu)
                                    <div class="p-x-15x p-y-10x">
                                        <a data-clk='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"action":1,"skipType":1,"skipId":{{$spu}},"topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'
                                           data-link="motif://o.c?a=pd&spu={{$spu}}" href="javascript:void(0)">
                                            <img class="img-fluid img-lazy"
                                                 data-original="{{env('APP_Api_Image')}}/n1/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                 src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                                 alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid=@endif{{$value['skipId']}}">
                                    <img class="img-fluid img-lazy"
                                         data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                         alt="">
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
                                                    <a data-clk='http://clk.motif.me/log.gif?t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::get('user.uuid')}}&v={"action":1,"skipType":1,"skipId":{{$spu}},"topicId":{{$topicID}},"expid":0,"ver":"1.0.1","src":"H5"}'
                                                       data-link="motif://o.c?a=pd&spu={{$spu}}" href="javascript:void(0)">
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
                                                            <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                            @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                                <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($topic['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                            @endif
                                                        </div>

                                                            @if(Session::get('user.pin'))
                                                                <span class="p-r-5x wish" data-id="{{$spu}}" id="{{'wish'.$spu}}"><i class="iconfont icon-like product-heart" ></i></span>
                                                            @else
                                                                <span class="p-r-5x"><i class="iconfont icon-like product-heart sendLogin"></i></span>
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
    </div>
</div>
<input type="hidden" id="spuArray" value="{{$topic['spuArray']}}">
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

                switch (value.skipType){
                    case '1':
                        url = 'motif://o.c?a=pd&spu=';
                        break;
                    case '2':
                        url = '/designer/';
                        break;
                    case '3':
                        url = '/topic/';
                        break;
                    case '4':
                        url = 'motif://o.c?a=shoppinglist&cid=';
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
                    } else if (actionName.name == "addWish") {
                        var spus = actionName.data.spu.split(',');
                        $.each(spus, function (n, value) {
                            $('#wish' + value).html('<i class="iconfont icon-onheart product-heart active"></i>');
                        });
                    } else if (actionName.name == "authInfo") {
                        window.location.href = "/topic/{{$topicID}}?token=" + actionName.data.token + "&pin=" + actionName.data.pin + "&email=" + actionName.data.email + "&name=" + decodeURIComponent(actionName.data.name);
                    }
                }
        );

        //login send
        $('.sendLogin').on('click', function () {
            Jockey.send("action", {
                name: "login",
                token: "key",
            });
        });

        $('.wish').on('click', function () {
            $this = $(this);
            $.ajax({
                url: '/wish/' + $this.data('id'),
                type: 'GET'
            })
                    .done(function (data) {
                        if (data.success) {
                            data.cmd ? $this.html('<i class="iconfont icon-onheart product-heart active"></i>') : $this.html('<i class="iconfont icon-like product-heart"></i>');;
                            Jockey.send("action", {
                                name: "updateWish",
                                token: "key",
                                data: {"spu": $this.data('id').toString(), "isAdd": data.cmd}
                            });
                        }
                    })
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
@endif
@include('global')
</html>
