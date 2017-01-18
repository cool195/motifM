<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ env('APP_Api_Image').'/n1/'.$topic['mainImg'] }}"/>
    <meta property="og:title" content="{{$topic['title']}}"/>
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
                    'actionField': {'list': '{{'topic_'.$topic['title'].'_'.$topicID.(strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? '_android' : '_ios')}}'},      // Optional list property.
                    'products': [{
                        'name': name,                      // Name or ID is required.
                        'id': spu,
                        'price': price,
                        'brand': '{{$topic['title']}}',
                        'category': 'topicApp',
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
                    @foreach($topic['infos'] as $value)
                    @if($value['type']=='product')
                    @if(isset($value['spus']))
                    @foreach($value['spus'] as $k=>$spu)
                {
                    'name': '{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}',       // Name or ID is required.
                    'id': '{{$spu}}',
                    'price': '{{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}',
                    'brand': '{{$topic['title']}}',
                    'category': 'topicApp',
                    'variant': '',
                    'list': '{{'topic_'.$topic['title'].'_'.$topicID.(strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? '_android' : '_ios')}}',
                    'position': '{{$k}}'
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
    <!-- 主体内容 -->
    <div class="body-container" style="padding-top:0px">
        <!-- daily 详细内容 -->
        <section class="bg-white reserve-height">
        @if(isset($topic['infos']))
            @foreach($topic['infos'] as $k=>$value)
                @if($value['type']=='banner')
                    <!-- 第一个 banner 图 -->
                        <div @if($k!=0)class="p-y-10x"@endif>
                            <a href="@if(!isset($value['skipId']))javascript:;@elseif($value['skipType']=='1')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=url&url={{urlencode('http://'.$_SERVER['HTTP_HOST'].'/designer/'.$value['skipId'])}}@elseif($value['skipType']=='3')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=url&url={{urlencode('http://'.$_SERVER['HTTP_HOST'].'/topic/'.$value['skipId'])}}@elseif($value['skipType']=='4')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=topic_detail&from_id=' . $topicID . '&a=outurl&url='.urlencode($value['skipId'])}}@endif">
                                <img class="img-fluid img-lazy"
                                     data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                     alt="">
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
                        <a href="@if($value['skipType']=='1')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=topic_detail&from_id=' . $topicID . '&a=outurl&url='.urlencode($value['skipId'])}}@endif">
                            <div class="p-x-15x p-y-10x text-primary">
                                <strong>{{$value['value']}}</strong>
                            </div>
                        </a>
                    @elseif($value['type']=='boxline')
                        <hr class="hr-base m-x-5x m-y-0">
                    @elseif($value['type']=='context')
                    <!-- 描述 -->
                        <a href="@if($value['skipType']=='1')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu={{$value['skipId']}}@elseif($value['skipType']=='2')/designer/{{$value['skipId']}}@elseif($value['skipType']=='3')/topic/{{$value['skipId']}}@elseif($value['skipType']=='4')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=shoppinglist&cid={{$value['skipId']}}@else{{'motif://o.c?from=topic_detail&from_id=' . $topicID . '&a=outurl&url='.urlencode($value['skipId'])}}@endif">
                            <div class="p-x-15x p-y-10x text-primary font-size-sm">
                                {{$value['value']}}
                            </div>
                        </a>

                @elseif($value['type']=='product')
                        <div data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":0,"skipType":1,"skipId":"{{ implode("_", $value['spus']) }}","topicId":"{{$topicID}}","expid":0,"ver":"1.0.1","src":"H5"}'></div>
                        @if($value['style']=='box-vertical')
                            {{-- 商品列表竖向 --}}
                            @if(isset($value['spus']))
                                @foreach($value['spus'] as $spu)
                                    <div class="p-x-15x p-y-10x">
                                        <a data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","topicId":"{{$topicID}}","expid":0,"ver":"1.0.1","src":"H5"}'
                                           data-link="motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu={{$spu}}" href="javascript:void(0)" data-spu="{{$spu}}" data-title="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}" data-price="{{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}">
                                            <img class="img-fluid img-lazy"
                                                 data-original="{{env('APP_Api_Image')}}/n1/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                 src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                                 alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <a href="@if(!isset($value['skipId']))javascript:;@elseif($value['skipType']=='1')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?from=topic_detail&from_id={{$topicID}}&a=shoppinglist&cid=@endif{{'motif://o.c?from=topic_detail&from_id=' . $topicID . '&a=outurl&url='.urlencode($value['skipId'])}}">
                                    <img class="img-fluid img-lazy"
                                         data-original="{{env('APP_Api_Image')}}/n1/{{$value['imgPath']}}"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png"
                                         alt="">
                                </a>
                            @endif
                        @else
                            {{-- 商品列表横向 --}}
                            <div class="container-fluid p-x-0 bg-topic">
                                <div class="row m-a-0 productList">
                                    @if(isset($value['spus']))
                                        @foreach($value['spus'] as $spu)
                                            <div class="col-xs-6 p-a-0">
                                                <div class="topic-product-item productList-item">
                                                    <a data-clk='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=daily.200001&m=H5_M2016-1&pin={{Session::get('user.pin')}}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"action":1,"skipType":1,"skipId":"{{$spu}}","topicId":"{{$topicID}}","expid":0,"ver":"1.0.1","src":"H5"}'
                                                       data-link="motif://o.c?from=topic_detail&from_id={{$topicID}}&a=pd&spu={{$spu}}" href="javascript:void(0)" data-spu="{{$spu}}" data-title="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}" data-price="{{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}">
                                                        {{--<div class="image-container">--}}
                                                            {{--<img class="img-fluid img-lazy"--}}
                                                                 {{--data-original="{{env('APP_Api_Image')}}/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"--}}
                                                                 {{--src="{{env('CDN_Static')}}/images/product/bg-product@336.png"--}}
                                                                 {{--alt="{{$topic['spuInfos'][$spu]['spuBase']['main_title']}}">--}}
                                                            {{--@if(1 == $topic['spuInfos'][$spu]['spuBase']['sale_type'])--}}
                                                                {{--预售产品 预定信息--}}
                                                                {{--<span class="preorder-info font-size-xs">Limited Edition</span>--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}

                                                        <div class="image-container">
                                                            <div class="swiper-container productList-swiper">
                                                                <div class="swiper-wrapper">
                                                                    <div class="swiper-slide">
                                                                        <img class="img-fluid swiper-lazy"
                                                                             data-src="{{env('APP_Api_Image')}}/n2/{{$topic['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                             alt="">
                                                                        <img class="img-fluid preloader"
                                                                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png" alt="">
                                                                    </div>
                                                                    {{--循环图片 begin--}}
                                                                    @foreach($topic['spuInfos'][$spu]['image_paths'] as $swiperImage)
                                                                        <div class="swiper-slide">
                                                                            <img class="img-fluid"
                                                                                 src="{{env('APP_Api_Image')}}/n2/{{$swiperImage}}"
                                                                                 alt="">
                                                                        </div>
                                                                    @endforeach
                                                                    {{--循环图片 begin--}}
                                                                </div>
                                                                <div class="swiper-pagination"></div>
                                                            </div>
                                                            @if(1 == $topic['spuInfos'][$spu]['spuBase']['sale_type'])
                                                                <span class="preorder-info font-size-xs">Limited Edition</span>
                                                            @endif
                                                        </div>

                                                    </a>
                                                    <div class="font-size-sm product-title text-main">
                                                        {{$topic['spuInfos'][$spu]['spuBase']['main_title']}}
                                                    </div>
                                                    <div class="price-caption">
                                                        <span>
                                                            @if($topic['spuInfos'][$spu]['skuPrice']['price'] != $topic['spuInfos'][$spu]['skuPrice']['sale_price'])
                                                                <span class="text-red font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                                <span class="font-size-xs text-common text-throughLine">${{number_format($topic['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                            @else
                                                                <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($topic['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                            @endif
                                                        </span>

                                                        @if(Session::has('user'))
                                                            <span class="wish-item p-r-10x" data-id="{{$spu}}" id="{{'wish'.$spu}}"><i class="iconfont1 text-primary btn-wish" data-spu="{{$spu}}"></i></span>
                                                        @else
                                                            <a class="wish-item p-r-10x" href="javascript:;"><i class="iconfont1 text-primary btn-wish sendLogin" data-id="{{$spu}}"></i></a>
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
<input type="hidden" id="wishspu" value="">
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/JockeyJS.js"></script>
<script>
    $(document).ready(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

    // swiper
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        paginationType: 'bullets',
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        onSlideChangeStart: function (swiper) {
            $(swiper.bullets).css('opacity', '0.6');
            setTimeout(function () {
                $(swiper.bullets).css('opacity', '0');
            }, 2000);
        },
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

    $('[data-clk]').on('click',function(){
        var $this = $(this);
        $('#productClick-name').val($this.data('title'));
        $('#productClick-spu').val($this.data('spu'));
        $('#productClick-price').val($this.data('price'));

        onProductClick();
    });
</script>
@if($shareFlag)
    <script>
        @if($topic['pushspu'])
            Jockey.send("action", {
            name: "updateWish",
            token: "key",
            data: {"spu": "{{$topic['pushspu']}}", "isAdd": true}
        });
        @endif
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
                                "url": "https://m.motif.me/topic/{{$topicID}}"
                            }
                        });
                    } else if (actionName.name == "addWish") {
                        var spus = actionName.data.spu.split(',');
                        $.each(spus, function (n, value) {
                            $('#wish' + value).html('<i class="iconfont1 text-primary btn-wish active"></i>');
                        });
                    } else if (actionName.name == "authInfo") {
                        var f = '{{strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') ? 'f=android' : 'f=ios'}}';
                        window.location.href = "/topic/{{$topicID}}?f="+f+"&wishspu="+$('#wishspu').val()+"&token=" + actionName.data.token + "&pin=" + actionName.data.pin + "&email=" + actionName.data.email + "&name=" + decodeURIComponent(actionName.data.name);
                    }
                }
        );

        //login send
        $('.sendLogin').on('click', function () {
            $('#wishspu').val($(this).data('id'));
            Jockey.send("action", {
                name: "login",
                token: "key",
            });
        });

        $('.wish-item').on('click', function () {
            $this = $(this);
            var cmd = true;
            if($this.find('i').hasClass('active')){
                cmd = false;
                $this.html('<i class="iconfont1 text-primary btn-wish"></i>');
            }else{
                if(!$this.find('i').hasClass('sendLogin')){
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
