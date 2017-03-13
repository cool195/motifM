<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ env('APP_Api_Image').'/n1/'.$data['main_image_url'] }}">
    <meta property="og:title" content="{{$data['main_title']}}">
    <title>{{$data['main_title']}}</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingDetail.css{{'?v='.config('app.version')}}">
    <!-- Google Analytics Content Experiment code -->
    <script>function utmx_section(){}function utmx(){}(function(){var
                k='130800691-10',d=document,l=d.location,c=d.cookie;
            if(l.search.indexOf('utm_expid='+k)>0)return;
            function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
            indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
                    length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
                    '<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
                            '://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
                    '&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
                    valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
                    '" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
    </script><script>utmx('url','A/B');</script>
    <!-- End of Google Analytics Content Experiment code -->
</head>
<body>

<!-- 1. Load the Content Experiments JavaScript Client -->
<script src="//www.google-analytics.com/cx/api.js?experiment=l_ymgFAvSr--l8p-GSWnyQ"></script>

<script>
    // 2. Choose the Variation for the Visitor
    var variation = cxApi.chooseVariation();
    window.onload = function(){
        // 3. Evaluate the result and update the image
        var img_warpper = document.getElementById('detail-productImgs');
        var swiperImgsA = document.getElementsByClassName('swiperImgs-A');
        var swiperImgsB = document.getElementsByClassName('swiperImgs-B');
        // variation=1:  添加详情图    variation=2:添加详情图,并去掉轮播的穿戴图
        if ( variation == 1) {
            img_warpper.style.display = "block";
        }else if (variation == 2){
            img_warpper.style.display = "block";
            swiperImgsB.style.display = "none";
            swiperImgsA.style.display = "block";
        }else {
            img_warpper.style.display = "none";
        }

    }
</script>

<!-- 4. Load ga.js and send a hit to Google Analytics -->
<script>

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-78914929-6']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>


<!-- 添加购物车 -->
<input type="text" id="addToCart-quantity" value="1" hidden>
<input type="text" id="addToCart-sku" value="1" hidden>

<!-- 点击商品 -->
<input type="text" id="productClick-name" value="name" hidden>
<input type="text" id="productClick-spu" value="1" hidden>
<input type="text" id="productClick-price" value="1" hidden>

<!-- tag manager 曝光埋点 -->
<input type="text" id="impressProduct-list" value="" hidden>
<script type="text/javascript">
    function onAddToCart() {
        var quantity = document.getElementById('addToCart-quantity').value;
        //var sku = document.getElementById('addToCart-sku').value;
        dataLayer.push({
            'event': 'addToCart',
            'ecommerce': {
                'currencyCode': 'EUR',
                'add': {
                    'products': [{
                        'name': '{{$data['main_title']}}',
                        'id': '{{ $data['spu'] }}',
                        'price': '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
                        'brand': 'Motif',
                        'category': '{{ $data['category_name'] }}',
                        'variant': '',
                        'quantity': quantity
                    }]
                }
            }
        });
    }

    function onProductClick() {
        var name = document.getElementById('productClick-name').value;
        var spu = document.getElementById('productClick-spu').value;
        var price = document.getElementById('productClick-price').value;
        dataLayer.push({
            'event': 'productClick',
            'ecommerce': {
                'click': {
                    'actionField': {'list': '{{'shopping Detail_'.$data['main_title'].'_'.$data['spu']}}'},      // Optional list property.
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

    // 商品详情
    dataLayer.push({
        'ecommerce': {
            'detail': {
                'actionField': {'list': '{{'shopping Detail_'.$data['main_title'].'_'.$data['spu']}}'},
                'products': [{
                    'name': '{{$data['main_title']}}',
                    'id': '{{ $data['spu'] }}',
                    'price': '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
                    'brand': 'Motif',
                    'category': '{{ $data['category_name'] }}',
                    'variant': ''
                }]
            }
        }
    });

    // detail 推荐商品列表 埋点
    {{--dataLayer.push({--}}
        {{--'ecommerce': {--}}
            {{--'currencyCode': 'EUR',                       // Local currency is optional.--}}
            {{--'impressions': [--}}
                    {{--@if(isset($recommended['list']))--}}
                    {{--@foreach($recommended['list'] as $key => $value)--}}
                    {{--@if($key < 20)--}}
                {{--{--}}
                    {{--'name': '{{ $value['main_title'] }}',       // Name or ID is required.--}}
                    {{--'id': '{{ $value['spu'] }}',--}}
                    {{--'price': '{{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}',--}}
                    {{--'brand': 'Motif',--}}
                    {{--'category': '',--}}
                    {{--'variant': '',--}}
                    {{--'list': '{{'shopping Detail_'.$data['main_title'].'_'.$data['spu']}}',--}}
                    {{--'position': ''--}}
                {{--},--}}
                {{--@endif--}}
                {{--@endforeach--}}
                {{--@endif--}}
            {{--]--}}
        {{--}--}}
    {{--});--}}
    var content_name = '{{$data['main_title']}}';
    var content_category = '{{ $data['category_name'] }}';
    var content_ids = ['{{$data['spu']}}'];
    var totalPrice = '{{number_format(($data['skuPrice']['sale_price'] / 100), 2)}}';
</script>
@include('check.tagmanager')

<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container productDetail-container">
    @inject('wishlist', 'App\Http\Controllers\Shopping\ShoppingController')
    @include('navigator')
    <!-- 图片详情 --><!-- 弹出图片轮播 -->
        <div class="product-detailImg fade">
            <div class="swiper-container p-b-20x" id="detailImg-swiper">
                <div class="swiper-wrapper p-b-20x">
                    @if(isset($data['productImages']))
                        @foreach($data['productImages'] as $image)
                            <div class="swiper-slide">
                                <!--去掉穿戴图, 只显示产品图-->
                                <div class="swiperImgs-A" style="display:none">
                                    @if($image['useness_type'] == 2)
                                        <img class="img-fluid swiper-lazy"
                                             data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                             alt="">
                                        <img class="img-fluid preloader"
                                             src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                    @endif
                                </div>
                                <div class="swiperImgs-B">
                                    @if($image['useness_type'] != 7)
                                    <img class="img-fluid swiper-lazy"
                                         data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         alt="">
                                    <img class="img-fluid preloader"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                    @endif
                                </div>
                                {{--视频--}}
                                @if(!empty($image['video_path']))
                                    <div class="bg-productPlayer flex flex-alignCenter flex-justifyCenter btn-productPlayer"
                                         data-ytbid="{{$image['video_path']}}">
                                        <img class="" src="{{env('CDN_Static')}}/images/daily/icon-player.png" alt="">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination text-white font-size-sm" id="detailImg-pagination"></div>
            </div>
        </div>
        <!-- 商品内容介绍 -->
        <section class="container-fluid p-x-0">
            <!-- 产品图片 -->
            <div class="product-baseImg">
                <!-- Swiper -->
                <!-- 页面上图片轮播 -->
                <div class="swiper-container" id="baseImg-swiper">
                    <div class="swiper-wrapper">
                        @if(isset($data['productImages']))
                            @foreach($data['productImages'] as $image)
                                <div class="swiper-slide">
                                    <div class="swiperImgs-A" style="display:none">
                                        @if($image['useness_type'] == 2)
                                        <img class="img-fluid swiper-lazy"
                                             data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}">
                                        <img class="img-fluid preloader"
                                             src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                        @endif
                                    </div>
                                    <div class="swiperImgs-B">
                                        @if($image['useness_type'] != 7)
                                        <img class="img-fluid swiper-lazy"
                                             data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}">
                                        <img class="img-fluid preloader"
                                             src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                        @endif
                                    </div>
                                    {{--视频--}}
                                    @if(!empty($image['video_path']))
                                        <div class="bg-productPlayer flex flex-alignCenter flex-justifyCenter btn-productPlayer"
                                             data-ytbid="{{$image['video_path']}}">
                                            <img class="" src="{{env('CDN_Static')}}/images/daily/icon-player.png">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide"></div>
                        @endif
                    </div>
                    <!-- 分页器 -->
                    <div class="swiper-pagination" id="baseImg-pagination"></div>
                </div>
            </div>
            @if(Session::has('user'))
                <span class="wish-item p-r-10x p-t-10x"><i
                            class="iconfont1 text-primary btn-wish btn-wished @if(in_array($data['spu'], $wishlist->wishlist())){{'active'}}@endif"
                            data-spu="{{$data['spu']}}"></i></span>
            @else
                <a class="wish-item p-r-10x p-t-10x" href="javascript:;"><i
                            class="iconfont1 text-primary btn-wish btn-wished" data-actionspu="{{$data['spu']}}"></i></a>
            @endif

            <!-- 产品 标题 简介 价格 基本信息 -->
            <article class="product-baseInfo bg-white">
                <div class="product-text">
                    <h6 class="text-main font-size-base avenirBold">{{$data['main_title']}}</h6>
                    <p class="text-primary font-size-sm">{{ $data['sub_title'] }} @if(isset($data['skuPrice']['skuPromotion']['promo_words'])){{$data['skuPrice']['skuPromotion']['promo_words']}}@endif</p>
                    @if(!empty($data['designer']))
                        <p class="text-primary font-size-sm">
                            <span>Designer:</span>
                            <a href="{{$data['designer']['designer_home_page']}}"
                               class="text-primary text-underLine">{{$data['designer']['designer_name']}}</a>
                        </p>
                    @endif
                </div>
                <hr class="hr-dark m-x-10x">
                <div class="product-price">
                    @if(isset($data['skuPrice']['skuPromotion']) && ($data['skuPrice']['skuPromotion']['price']>$data['skuPrice']['skuPromotion']['promot_price']))
                        <span class="font-size-lx text-primary" id="skuNewPrice">${{ number_format(($data['skuPrice']['skuPromotion']['promot_price'] / 100), 2) }}</span>
                        <span class="font-size-sm text-throughLine text-green">${{ number_format(($data['skuPrice']['skuPromotion']['price'] /100), 2) }}</span>
                    @else
                        <span class="font-size-lx text-primary" id="skuNewPrice">${{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}</span>
                    @endif
                </div>

                <div class="text-warning font-size-xs p-x-15x"
                     data-impr='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=rec.100002&m=OPEN_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={" action ":0,"cspus ":"{{ $data['skus']}}","expid ":0,"index ":1,"rec_type ":1,"spu":{{ $data['spu'] }},"ver ":"9.00 "}&sig=2291a58454115c8136169111738de65696add43d'>{{ $data['prompt_words'] }}</div>
            </article>

            <!-- 产品 预售信息 -->
            @if(1 == $data['sale_type'])
                @if($data['skuPrice']['skuPromotion']['remain_time'] >= 0 || !empty($data['spuStock']))
                    <section class="limited-content"
                             data-begintime="{{  $data['skuPrice']['skuPromotion']['start_time'] }}"
                             data-endtime="{{  $data['skuPrice']['skuPromotion']['end_time'] }}"
                             data-lefttime="@if($data['sale_status'] && $data['isPutOn']==1){{$data['skuPrice']['skuPromotion']['remain_time']}}@else{{'0'}}@endif"
                             data-qtty="{{$data['spuStock']['stock_qtty']}}">
                        <div class="bg-white">
                            <div class="limited-subtitle">
                            <span class="p-l-15x p-r-10x bg-limited">
                                <strong>LIMITED EDITION</strong>
                            </span>
                            </div>
                            @if($data['isPutOn'] !=1)
                                <div class="p-x-15x p-t-10x">
                                    <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                         srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                <span class="text-primary font-size-sm stock-qtty">
                                        Sold Out
                                </span>
                                </div>
                                <div class="p-x-15x p-t-10x">
                                    <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                         srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                    <span class="text-primary font-size-sm">Orders Closed</span>
                                </div>
                            @else
                                @if(!empty($data['spuStock']))
                                    <div class="p-x-15x p-y-10x">
                                        <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                             srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                             alt="">
                                <span class="text-primary font-size-sm stock-qtty">
                                    @if(($data['spuStock']['stock_qtty'] - $data['spuStock']['saled_qtty']) > 0)
                                        Only {{$data['spuStock']['stock_qtty'] - $data['spuStock']['saled_qtty']}}
                                        Left
                                    @else
                                        Sold Out
                                    @endif
                                </span>
                                    </div>
                                @endif

                                @if($data['skuPrice']['skuPromotion']['remain_time'] >= 0)
                                    @if($data['sale_status'])
                                        <div>
                                            <div class="p-x-15x p-t-5x">
                                                <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                                     srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                                     alt="">
                                        <span class="text-primary font-size-sm">Orders Close <span
                                                    class="time_show"></span></span>
                                            </div>
                                            <div class="p-x-15x p-y-5x m-x-15x">
                                                <progress class="progress progress-primary" id="limited-progress"
                                                          value=""
                                                          max="10000">0%
                                                </progress>
                                            </div>
                                        </div>
                                    @else
                                        <div class="p-x-15x p-t-10x">
                                            <img src="{{env('CDN_Static')}}/images/icon/icon-limited.png"
                                                 srcset="{{env('CDN_Static')}}/images/icon/icon-limited@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-limited@3x.png 3x"
                                                 alt="">
                                            <span class="text-primary font-size-sm">Orders Closed</span>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </section>
                @endif
            @endif
            @if($data['skuPrice']['skuPromotion']['pre_exp_descs'])
                @foreach($data['skuPrice']['skuPromotion']['pre_exp_descs'] as $value)
                    <section class="limited">
                        <div class="bg-white">
                            <div class="limited-subtitle">
                            <span class="p-l-15x p-r-10x bg-limited">
                                <strong>{{$value['desc_title']}}</strong>
                            </span></div>
                            <div class="p-x-15x p-y-10x text-primary font-size-sm">
                                {{$value['desc_value']}}
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif
            <section data-spu="{{$data['spu']}}" id="modalDialog" data-login="1" data-status="{{$data['status_code']}}" data-onlysku="@if(count($data['skus'])==1){{$data['skus'][0]}}@endif">
                <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-xs"></span>
                </div>
                @if(isset($data['spuAttrs']))
                    @foreach($data['spuAttrs'] as $value)
                        <fieldset class="p-x-15x p-y-10x text-left">
                            <div class="container-fluid p-a-0">
                                <div class="text-primary font-size-sm sparow" id="{{'spa'.$value['attr_type']}}"
                                     data-click="false"
                                     data-msg="{{$value['attr_type_value']}}">{{$value['attr_type_value']}}</div>
                                <div class="row">
                                    @if(isset($value['skuAttrValues']))
                                        @foreach($value['skuAttrValues'] as $skuValue)
                                            <div class="p-t-10x p-x-5x">
                                                <div class="btn btn-itemProperty btn-sm skarow @if(!$skuValue['stock']) disabled @endif"
                                                     id="{{$skuValue['attr_value_id']}}"
                                                     @if($skuValue['img_path'])
                                                     data-image="{{env('APP_Api_Image').'/n1/'.$skuValue['img_path']}}"
                                                     @endif
                                                     @if($skuValue['stock'])
                                                     data-spa="{{$value['attr_type']}}"
                                                     data-ska="{{$skuValue['attr_value_id']}}"
                                                        @endif
                                                >
                                                    {{$skuValue['attr_value']}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    @endforeach
                @endif

                @if(isset($data['vasBases']))
                    @foreach($data['vasBases'] as $vas)
                        @if(1 == $vas['vas_type'])
                            <fieldset class="p-x-15x p-y-10x text-left" data-vas-type="{{$vas['vas_type']}}">
                                <div class="text-primary font-size-sm m-b-10x">{{ $vas['vas_describe'] }} +
                                    ${{number_format(($vas['vas_price'] / 100), 2)}}</div>
                                <div class="flex flex-fullJustified flex-alignCenter">
                                    <input class="input-engraving form-control font-size-sm disabled" type="text"
                                           maxlength="20" placeholder="20 characters max"
                                           data-vas-type="{{$vas['vas_type']}}">
                                    {{--<input type="radio" name="vas_name" id="{{$vas['vas_id']}}" hidden>--}}
                                    <div class="iconfont icon-checkcircle text-common m-b-0 p-l-20x"
                                         id="{{$vas['vas_id']}}" data-vas-type="{{$vas['vas_type']}}"></div>
                                </div>
                            </fieldset>
                        @else
                            <fieldset class="p-x-15x p-y-10x text-left" data-vas-type="$vas['vas_type']">
                                <div class="flex flex-fullJustified flex-alignCenter">
                                    <div class="text-primary font-size-sm">{{ $vas['vas_describe'] }}+
                                        $4.5(optional)
                                    </div>
                                    {{--<input type="radio" name="vas_name2" id="{{$vas['vas_id']}}" hidden>--}}
                                    <div class="iconfont icon-checkcircle text-common m-b-0 p-l-20x"
                                         id="{{$vas['vas_id']}}" data-vas-type="$vas['vas_type']"></div>
                                </div>
                            </fieldset>
                        @endif
                    @endforeach
                @endif
                <fieldset class="p-x-15x p-y-10x">
                    <div class="flex flex-fullJustified flex-alignCenter">
                        <span class="text-primary font-size-sm">Qty:</span>
                        <div class="btn-group flex" id="item-count">
                            <div class="btn btn-cartCount btn-sm disabled" data-item="minus">
                                {{--<i class="iconfont icon-minus"></i>--}}
                                <i class="iconfont1 icon-arrow-bottom1 icon-size-sm"></i>
                            </div>
                            <div class="btn btn-cartCount btn-sm" data-num="num">1</div>

                            <div class="btn btn-cartCount btn-sm" data-item="add">
                                {{--<i class="iconfont icon-add"></i>--}}
                                <i class="iconfont1 icon-arrow-up1 icon-size-sm"></i>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </section>

            <!-- Add to Bag 按钮 -->
            <section class="addToBag-info">
                <hr class="hr-base m-a-0">
                <fieldset class="container-fluid p-a-10x">
                    <!-- 添加 购物车 控制按钮显示 -->
                    {{--@if(Session::has('user'))--}}
                    {{--<div class="text-center m-b-5x font-size-sm">This item is available for immediate shipping</div>--}}
                        <button class="btn btn-red btn-block up-btn-addToBag"
                                @if(!$data['sale_status'] || $data['isPutOn'] != 1 || $data['status_code'] != 100) disabled
                                @endif data-control="continue" data-role="continue" data-action="PATCH">Add to Bag
                        </button>
                    {{--@else--}}
                        {{--<a href="javascript:;" class="notesLogin btn btn-primary btn-block"--}}
                           {{--@if(!$data['sale_status'] || $data['isPutOn']==0) disabled--}}
                                {{--@endif>Add to Bag--}}
                        {{--</a>--}}
                    {{--@endif--}}
                </fieldset>
            </section>

            <!-- 产品 其他信息 -->
            <section>
                <!-- 包邮提示 -->
                <aside class="p-x-15x p-y-5x bg-free">
                    <div class="font-size-sm text-white text-center">
                        <img src="/images/icon/icon-car.png" srcset="/images/icon/icon-car@2x.png 2x,/images/icon/icon-car@3x.png 3x">
                        <span class="p-l-5x">Free expedited shipping for $79+ US orders.</span></div>
                </aside>

                <!-- 产品描述 -->
                <aside class="bg-white p-x-15x p-y-10x">
                    <p class="font-size-md text-main"><strong>Description</strong></p>
                    <div class="font-size-sm text-primary">
                        <div class="message-info">
                            <p class="m-b-0">{!! str_replace("\n", "<br/>",  $data['intro_short']) !!}</p>
                        </div>
                        <a class="flex flex-alignCenter flex-fullJustified font-size-xs p-t-5x text-common btn-showMore">
                            <span class="showMore">Show More</span>
                            <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                        </a>
                    </div>
                </aside>
                {{--详情图片--}}
                <div id="detail-productImgs" style="display: none;">
                        @foreach($data['productImages'] as $image)
                            @if($image['useness_type'] == 7)
                                <img class="img-fluid img-lazy" data-original="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}" src="{{env('CDN_Static')}}/images/product/bg-product@750.png">
                            @endif
                        @endforeach
                        @foreach($data['productImages'] as $image)
                                @if($image['useness_type'] == 2)
                                    <img class="img-fluid img-lazy" data-original="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}" src="{{env('CDN_Static')}}/images/product/bg-product@750.png">
                                @endif
                        @endforeach
                </div>

                <aside class="product-secondaryInfo">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                       href="/askshopping?skiptype=3&id={{$data['spu']}}">
                        Inquiries
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                </aside>
                <aside class="product-secondaryInfo">
                    @if(isset($data['templates']) && !empty($data['templates']))
                        @foreach($data['templates'] as $template)
                            <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                               href="/template/{{ $template['template_id'] }}">
                                {{ $template['template_title'] }}
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                            </a>
                        @endforeach
                    @endif
                </aside>


                <!-- 推荐商品 -->
                @if(!empty($recommended['list']))
                    <aside class="m-b-20x">
                        <article class="font-size-md text-primary p-x-15x p-b-10x p-t-20x bg-title"><strong>You May Also
                                Like</strong></article>
                        <div class="p-t-10x" id="recommend"
                             data-impr="{{ $recommended['impr'] }}">
                            <div class="productList">

                                <div class="swiper-container" id="recommend-productList">
                                    <div class="swiper-wrapper">
                                        @foreach($recommended['list'] as $key => $value)
                                            @if($key < 20)
                                                <div class="swiper-slide">
                                                    <div class="p-a-0 recommend-itme">
                                                        <div class="productList-item">
                                                            <div class="image-bg">
                                                                <div class="image-container">
                                                                    <a href="javascript:void(0)"
                                                                       data-link="/detail/{{ $value['seo_link'] }}"
                                                                       data-impr="{{ $value['impr'] }}"
                                                                       data-clk="{{ $value['clk'] }}"
                                                                       data-spu="{{ $value['spu'] }}"
                                                                       data-title="{{ $value['main_title'] }}"
                                                                       data-price="{{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}">
                                                                        <img class="img-fluid swiper-lazy"
                                                                             data-src="{{env('APP_Api_Image')}}/n1/{{ $value['main_image_url'] }}"
                                                                             alt="">
                                                                        <img class="img-fluid preloader"
                                                                             src="{{env('CDN_Static')}}/images/product/bg-product@336.png">
                                                                    </a>
                                                                    @if(1 == $value['sale_type'])
                                                                        {{--预售产品 预定信息--}}
                                                                        <span class="preorder-info font-size-xs">Limited Edition</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="font-size-sm product-title text-main">
                                                                {{ $value['main_title'] }}
                                                            </div>
                                                            <div class="price-caption">

                                                                @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                                    <span class="font-size-sm m-l-5x text-primary"><strong>${{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}</strong></span>
                                                                    <span class="font-size-xs text-green text-throughLine">${{ number_format(($value['skuPrice']['price'] / 100), 2) }}</span>
                                                                @else
                                                                    <span class="font-size-sm m-l-5x"><strong>${{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}</strong></span>
                                                                @endif
                                                                @if(Session::has('user'))
                                                                    <span class="wish-item p-r-5x"><i
                                                                                class="iconfont1 text-primary btn-wish btn-wished @if(in_array($value['spu'], $wishlist->wishlist())){{'active'}}@endif"
                                                                                data-spu="{{$value['spu']}}"></i></span>
                                                                @else
                                                                    <a class="wish-item p-r-5x" href="javascript:;"><i
                                                                                class="iconfont1 text-primary btn-wish btn-wished"
                                                                                data-actionspu="{{$value['spu']}}"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </aside>
                @endif
            </section>
        </section>

        <!-- 弹出选择 size color Engraving -->

        <!-- 页脚 功能链接 start-->

    <!-- 页脚 功能链接 end-->
        <div class="product-detailPlay fade">
            <div class="play-content bg-white">
                <div id="ytplayer" class="ytplayer" data-playid=""></div>
            </div>
        </div>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden" id="loading">
    <div class="loader loader-screen"></div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="success">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon-success.png"
                 srcset="{{env('CDN_Static')}}/images/icon-success@2x.png 2x, {{env('CDN_Static')}}/images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x">Item Added</div>
    </div>
</div>

<div class="loading loading-screen loading-transprant loading-hidden" style="z-index: 10001" id="selectmsg">
    <div class="loading-modal">
        <div class="text-white font-size-md text-center m-t-10x" id="selectspa"></div>
    </div>
</div>

<!-- 失败 loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="error">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon-success.png"
                 srcset="{{env('CDN_Static')}}/images/icon-success@2x.png 2x, {{env('CDN_Static')}}/images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x" id="error-info"></div>
    </div>
</div>

<img src='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=pv.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"spu":{{$data['spu']}},"main_sku":{{$data['skuPrice']['sku']}},"price":{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }},"version":"1.0.1","ver":"9.2","src":"H5"}&ref={{$_SERVER['HTTP_REFERER']}}' hidden>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/shoppingDetail.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    {{--设置cookie--}}
    function setCookie(name, value) {
        var Time = 24;
        var exp = new Date();
        exp.setTime(exp.getTime() + Time * 60 * 60 * 1000);
        document.cookie = name + '=' + escape(value) + ';expires=' + exp.toGMTString();
    }
    {{--读取cookie--}}
    function getCookie(name) {
        var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
        if (arr != null) {
            return unescape(arr[2]);
        }
        return null;
    }
    {{--未登录添加购物车操作--}}
    $('.notesLogin').on('click', function () {
        setCookie('notesLogin', 'AddBagAction');
        if ($('#addToCart-sku').val() != 1) {
            setCookie('AddBagSku', $('#addToCart-sku').val());
        }
        window.location.href = '/login';
    });

    if (getCookie('notesLogin') == 'AddBagAction' && !$('.notesLogin').hasClass('btn')) {
        if(getCookie('AddBagSku') != undefined && getCookie('AddBagSku') != ''){
            $('#modalDialog').data('login',2);
            $('#addToCart-sku').val(getCookie('AddBagSku'));
        }
        $('.up-btn-addToBag').click();
        setCookie('notesLogin', '');
        setCookie('AddBagSku', '');
        $('#modalDialog').data('login',1);
    }
</script>

<!-- Viewed Product 埋点 -->
<script>
    var _learnq = _learnq || [];
    _learnq.push(['track', 'Viewed Product', {
        Title: '{{$data['main_title']}}',
        ItemId: '{{ $data['spu'] }}',
        Categories: '{{ $data['category_name'] }}', // The list of categories is an array of strings.
        ImageUrl: '{{config('runtime.CDN_URL')}}/n0/{{ $data['main_image_url'] }}',
        Url: 'https://m.motif.me{{ $_SERVER['REQUEST_URI'] }}',
        Price: '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
        Brand: 'Motif h5'
    }]);
</script>

<script>
    var _learnq = _learnq || [];
    var trackAddToBag = function () {
        _learnq.push(['track', 'Add to Bag Successfully', {
            'SPU' : '{{$data['spu']}}',
            'Name' : '{{$data['main_title']}}',
            'ImageUrl' : '{{config('runtime.CDN_URL')}}/n0/{{ $data['main_image_url'] }}',
            'Url': 'https://m.motif.me{{ $_SERVER['REQUEST_URI'] }}',
            'ItemPrice' : '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
            'Categories' : '{{ $data['category_name'] }}',
            'Brand' : 'Motif h5'
        }]);
    };

    @if(Session::has('user'))
       $('#userEmail').val('{{Session::get('user.login_email')}}');
    @endif
</script>

@include('global')
</html>
