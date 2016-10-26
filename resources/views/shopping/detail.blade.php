<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ env('APP_Api_Image').'/n1/'.$data['main_image_url'] }}">
    <meta property="og:title" content="{{$data['main_title']}}">
    <title>{{$data['main_title']}}</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingDetail.css{{'?v='.config('app.version')}}">
</head>
<body>
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
        var sku = document.getElementById('addToCart-sku').value;
        dataLayer.push({
            'event': 'addToCart',
            'ecommerce': {
                'currencyCode': 'EUR',
                'add': {
                    'products': [{
                        'name': '{{$data['main_title']}}',
                        'id': '{{ $value['spu'] }}',
                        'sku': sku,
                        'price': '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
                        'brand': 'Motif',
                        'category': '',
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
                    'actionField': {'list': 'shopping Detail'},      // Optional list property.
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

    // detail 总商品浏览 埋点
    dataLayer.push({
        'ecommerce': {
            'detail': {
                'actionField': {'list': 'shopping Detail'},    // 'detail' actions have an optional list property.
                'products': [{
                    'name': '{{$data['main_title']}}',         // Name or ID is required.
                    'id': '{{ $data['spu'] }}',
                    'price': '{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}',
                    'brand': 'Motif',
                    'category': '',
                    'variant': ''
                }]
            }
        }
    });

    // detail 推荐商品列表 埋点
    dataLayer.push({
        'ecommerce': {
            'currencyCode': 'EUR',                       // Local currency is optional.
            'impressions': [
                    @if(isset($recommended['list']))
                    @foreach($recommended['list'] as $key => $value)
                    @if($key < 20)
                {
                    'name': '{{ $value['main_title'] }}',       // Name or ID is required.
                    'id': '{{ $value['spu'] }}',
                    'price': '{{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}',
                    'brand': 'Motif',
                    'category': '',
                    'variant': '',
                    'list': 'shopping Detail',
                    'position': ''
                },
                @endif
                @endforeach
                @endif
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
    @inject('wishlist', 'App\Http\Controllers\Shopping\ShoppingController')
    @include('navigator')
    <!-- 图片详情 --><!-- 弹出图片轮播 -->
        <div class="product-detailImg fade">
            <div class="swiper-container p-b-20x" id="detailImg-swiper">
                <div class="swiper-wrapper p-b-20x">
                    @if(isset($data['productImages']))
                        @foreach($data['productImages'] as $image)
                            <div class="swiper-slide">
                                <img class="img-fluid swiper-lazy"
                                     data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                     alt="">
                                <img class="img-fluid preloader"
                                     src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                {{--视频--}}
                                @if(!empty($image['video_path']))
                                    <div class="bg-productPlayer flex flex-alignCenter flex-justifyCenter">
                                        <img class="btn-productPlayer" src="{{env('CDN_Static')}}/images/daily/icon-player.png" alt="">
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
                                    <img src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         style="display: none">
                                    <img class="img-fluid swiper-lazy"
                                         data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         alt="">
                                    <img class="img-fluid preloader"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
                                    {{--视频--}}
                                    @if(!empty($image['video_path']))
                                        <div class="bg-productPlayer flex flex-alignCenter flex-justifyCenter">
                                            <img class="btn-productPlayer" src="{{env('CDN_Static')}}/images/daily/icon-player.png" data-ytbid="{{$image['video_path']}}">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide"></div>
                        @endif
                    </div>
                    <!-- 分页器 -->
                    <div class="swiper-pagination text-right p-r-20x font-size-sm" id="baseImg-pagination"></div>
                </div>
            </div>
            @if(Session::has('user'))
                <span class="wish-item p-r-10x p-t-10x"><i
                            class="iconfont text-common btn-wish btn-wished @if(in_array($data['spu'], $wishlist->wishlist())){{'active'}}@endif"
                            data-spu="{{$data['spu']}}"></i></span>
            @else
                <a class="wish-item p-r-10x p-t-10x" href="javascript:;"><i
                            class="iconfont text-common btn-wish btn-wished" data-actionspu="{{$data['spu']}}"></i></a>
            @endif
        <!-- 产品 标题 简介 价格 基本信息 -->
            <article class="product-baseInfo bg-white"
                     data-impr='http://clk.motif.me/log.gif?t=pv.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"spu":{{$data['spu']}},"main_sku":{{$data['skuPrice']['sku']}},"price":{{ $data['skuPrice']['sale_price'] }},"version":"1.0.1","ver":"9.2","src":"H5"}'>
                <div class="product-text">
                    <h6 class="text-main font-size-base">{{$data['main_title']}}</h6>
                    <p class="text-primary font-size-sm">{{ $data['sub_title'] }} @if(isset($data['skuPrice']['skuPromotion']['promo_words'])){{$data['skuPrice']['skuPromotion']['promo_words']}}@endif</p>
                    @if(!empty($data['designer']))
                        <p class="text-primary font-size-sm">
                            <span>Designer:</span>
                            <a href="{{$data['designer']['designer_home_page']}}"
                               class="text-primary text-underLine">{{$data['designer']['designer_name']}}</a>
                        </p>
                    @endif
                </div>
                <hr class="hr-light m-x-10x">
                <div class="product-price">
                    @if(isset($data['skuPrice']['skuPromotion']) && ($data['skuPrice']['skuPromotion']['price']>$data['skuPrice']['skuPromotion']['promot_price']))
                        <span class="font-size-lx text-red">${{ number_format(($data['skuPrice']['skuPromotion']['promot_price'] / 100), 2) }}</span>
                        <span class="font-size-sm text-throughLine text-common">${{ number_format(($data['skuPrice']['skuPromotion']['price'] /100), 2) }}</span>
                    @else
                        <span class="font-size-lx text-primary">${{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}</span>
                    @endif
                </div>

                <div class="text-warning font-size-xs p-x-15x"
                     data-impr='http://clk.motif.me/log.gif?t=rec.100002&m=OPEN_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={" action ":0,"cspus ":"{{ $data['skus']}}","expid ":0,"index ":1,"rec_type ":1,"spu":{{ $data['spu'] }},"ver ":"9.00 "}&sig=2291a58454115c8136169111738de65696add43d'>{{ $data['prompt_words'] }}</div>
            </article>
            <div class="hr-between"></div>

            <!-- 产品 预售信息 -->
            @if(1 == $data['sale_type'])

                @if(!isset($data['skuPrice']['skuPromotion']) || $data['skuPrice']['skuPromotion']['remain_time'] >= 0 || $data['isPutOn'] ==0 || !empty($data['spuStock']))
                    <section class="limited-content"
                             data-begintime="{{  $data['skuPrice']['skuPromotion']['start_time'] }}"
                             data-endtime="{{  $data['skuPrice']['skuPromotion']['end_time'] }}"
                             data-lefttime="@if($data['sale_status'] && $data['isPutOn']==1){{$data['skuPrice']['skuPromotion']['remain_time']}}@else{{'0'}}@endif"
                             data-qtty="{{$data['spuStock']['stock_qtty']}}">
                        <div class="bg-white">
                            <div class="p-x-15x limited-subtitle"><strong>LIMITED EDITION</strong></div>
                            @if(!isset($data['skuPrice']['skuPromotion']) || $data['isPutOn'] ==0 || !empty($data['spuStock']))
                                <div class="p-x-15x p-t-10x">
                                    <img src="/images/icon/icon-limited.png"
                                         srcset="/images/icon/icon-limited@2x.png 2x, /images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                    <span class="text-primary font-size-sm stock-qtty">@if(($data['spuStock']['stock_qtty'] - $data['spuStock']['saled_qtty'] > 0 && $data['sale_status']) && $data['isPutOn']==1)
                                            Only {{$data['spuStock']['stock_qtty'] - $data['spuStock']['saled_qtty']}}
                                            Left @else Sold Out @endif </span>
                                </div>
                            @endif
                            @if(($data['spuStock']['stock_qtty'] - $data['spuStock']['saled_qtty'])<=0 && $data['skuPrice']['skuPromotion']['remain_time'] >= 0)
                                <div class="p-x-15x p-t-10x">
                                    <img src="/images/icon/icon-limited.png"
                                         srcset="/images/icon/icon-limited@2x.png 2x, /images/icon/icon-limited@3x.png 3x"
                                         alt="">
                                    <span class="text-primary font-size-sm">Orders Closed</span>
                                </div>
                            @else
                                @if(!isset($data['skuPrice']['skuPromotion']) || $data['skuPrice']['skuPromotion']['remain_time'] >= 0 || $data['isPutOn'] ==0)
                                    <div>
                                        <div class="p-x-15x p-t-5x">
                                            <img src="/images/icon/icon-limited.png"
                                                 srcset="/images/icon/icon-limited@2x.png 2x, /images/icon/icon-limited@3x.png 3x"
                                                 alt="">
                                            <span class="text-primary font-size-sm">Orders Close <span
                                                        class="time_show"></span></span>
                                        </div>
                                        <div class="p-x-15x p-y-5x m-x-15x">
                                            @if(!$data['sale_status'] &&  $data['isPutOn']==1)
                                                <progress class="progress progress-primary" value="0" max="10000">0%
                                                </progress>
                                            @else
                                                <progress class="progress progress-primary" id="limited-progress" value=""
                                                          max="10000">0%
                                                </progress>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>
                        <div class="hr-between"></div>
                    </section>
                @endif
                @if($data['skuPrice']['skuPromotion']['ship_desc'])
                    <section class="limited">
                        <div class="bg-white">
                            <div class="p-x-15x limited-subtitle"><strong>PREORDER</strong></div>
                            <div class="p-x-15x p-t-10x p-b-15x text-primary font-size-sm">
                                Expected to ship on <strong>{{$data['skuPrice']['skuPromotion']['ship_desc']}}</strong>
                            </div>
                        </div>
                        <div class="hr-between"></div>
                    </section>
            @endif
        @endif

        <!-- 产品 其他信息 -->
            <section>
                <!-- 添加到购物车 立即购买 -->
                <aside class="container-fluid bg-white p-y-10x p-x-15x">
                    @if(Session::has('user'))
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-block up-btn-addToBag @if(!$data['sale_status'] || $data['isPutOn']==0) disabled @endif"
                                        data-control="openModal" data-action="PATCH">Add to Bag
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="javascript:;"
                                   class="notesLogin btn btn-primary btn-block up-btn-addToBag @if(!$data['sale_status'] || $data['isPutOn']==0) disabled @endif">
                                    Add to Bag </a>
                            </div>
                        </div>
                    @endif
                </aside>
                <hr class="hr-base m-a-0">
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
                <div class="hr-between"></div>
                <aside class="product-secondaryInfo">
                    @if(isset($data['templates']) && !empty($data['templates']))
                        @foreach($data['templates'] as $template)
                            <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                               href="/template/{{ $template['template_id'] }}">
                                {{ $template['template_title'] }}
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                            </a>
                            <hr class="hr-base m-a-0">
                        @endforeach
                    @endif
                </aside>


                <!-- 推荐商品 -->
                @if(!empty($recommended['list']))
                    <aside class="m-b-20x">
                        <article class="font-size-md text-primary p-x-15x p-y-10x bg-title"><strong>You May Also Like</strong></article>
                        <hr class="hr-base m-a-0">
                        <div class="container-fluid p-t-10x" id="recommend"
                             data-impr="{{ $recommended['impr'] }}">
                            <div class="row productList">

                                @foreach($recommended['list'] as $key => $value)
                                    @if($key < 20)
                                        <div class="col-xs-6 p-a-0">
                                            <div class="productList-item">
                                                <div class="image-bg">
                                                    <div class="image-container">
                                                        <a href="javascript:void(0)"
                                                           data-link="/detail/{{ $value['spu'] }}"
                                                           data-impr="{{ $value['impr'] }}"
                                                           data-clk="{{ $value['clk'] }}"
                                                           data-spu="{{ $value['spu'] }}"
                                                           data-title="{{ $value['main_title'] }}"
                                                           data-price="{{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}">
                                                            <img class="img-fluid img-lazy"
                                                                 data-original="{{env('APP_Api_Image')}}/n1/{{ $value['main_image_url'] }}"
                                                                 src="{{env('CDN_Static')}}/images/product/bg-product@336.png"
                                                                 alt="{{ $value['main_title'] }}">
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
                                                        <span class="font-size-sm m-l-5x text-red"><strong>${{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}</strong></span>
                                                        <span class="font-size-xs text-common text-throughLine">${{ number_format(($value['skuPrice']['price'] / 100), 2) }}</span>
                                                    @else
                                                        <span class="font-size-sm m-l-5x"><strong>${{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}</strong></span>
                                                    @endif
                                                    @if(Session::has('user'))
                                                        <span class="wish-item p-r-5x"><i
                                                                    class="iconfont text-common btn-wish btn-wished @if(in_array($value['spu'], $wishlist->wishlist())){{'active'}}@endif"
                                                                    data-spu="{{$value['spu']}}"></i></span>
                                                    @else
                                                        <a class="wish-item p-r-5x" href="javascript:;"><i
                                                                    class="iconfont text-common btn-wish btn-wished"
                                                                    data-actionspu="{{$value['spu']}}"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </aside>
                @endif
            </section>
        </section>

        <!-- 弹出选择 size color Engraving -->
        <div class="remodal p-a-0 modal-content" data-remodal-id="modal" id="modalDialog" data-spu="{{$data['spu']}}"
             data-status="{{$data['status_code']}}">
            <form action="">
                <div class="p-x-15x p-t-15x text-right">
                    <a data-remodal-action="close"><i class="iconfont icon-cross text-common icon-size-lg"></i>
                    </a>
                </div>
                <fieldset class="text-primary p-x-15x p-b-10x text-left">
                    <div class="font-size-base">
                        <strong id="skuNewPrice">${{number_format(($data['skuPrice']['sale_price'] / 100), 2)}}</strong>
                    </div>
                    <div class="font-size-sm" id="selectedOptions">
                        <span data-select>Select:</span>
                        <span data-select-options>
                        @if(isset($data['spuAttrs']))
                                @foreach($data['spuAttrs'] as $key => $attrs)
                                    @if((count($data['spuAttrs']) - 1) == $key)
                                        {{$attrs['attr_type_value']}}
                                    @else
                                        {{$attrs['attr_type_value'].", "}}
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </div>
                </fieldset>
                <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-xs"></span>
                </div>
                <hr class="hr-base m-a-0" data-onlysku="@if(count($data['skus'])==1){{$data['skus'][0]}}@endif">
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
                                                     data-spa="{{$value['attr_type']}}"
                                                     data-ska="{{$skuValue['attr_value_id']}}">
                                                    {{$skuValue['attr_value']}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <hr class="hr-base m-a-0">
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
                            <hr class="hr-base m-a-0">
                        @else
                            <fieldset class="p-x-15x p-y-10x text-left" data-vas-type="$vas['vas_type']">
                                <div class="flex flex-fullJustified flex-alignCenter">
                                    <div class="text-primary font-size-sm">{{ $vas['vas_describe'] }}+ $4.5(optional)
                                    </div>
                                    {{--<input type="radio" name="vas_name2" id="{{$vas['vas_id']}}" hidden>--}}
                                    <div class="iconfont icon-checkcircle text-common m-b-0 p-l-20x"
                                         id="{{$vas['vas_id']}}" data-vas-type="$vas['vas_type']"></div>
                                </div>
                            </fieldset>
                            <hr class="hr-base m-a-0">
                        @endif
                    @endforeach
                @endif
                <fieldset class="p-x-15x p-y-10x">
                    <div class="flex flex-fullJustified flex-alignCenter">
                        <span class="text-primary font-size-sm">Qty:</span>
                        <div class="btn-group flex" id="item-count">
                            <div class="btn btn-cartCount btn-sm disabled" data-item="minus">
                                <i class="iconfont icon-minus"></i>
                            </div>
                            <div class="btn btn-cartCount btn-sm" data-num="num">1</div>

                            <div class="btn btn-cartCount btn-sm"
                                 data-item="add">
                                <i class="iconfont icon-add"></i>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <hr class="hr-dark m-a-0">
                <fieldset class="container-fluid p-a-15x">
                    <!-- 添加 购物车 控制按钮显示 -->
                    <div class="btn btn-primary btn-block  hidden-xs-up"
                         data-control="continue" data-role="continue" data-action="">Continue
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- 页脚 功能链接 start-->
    @include('footer')
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
        window.location.href = '/login';
    });

    if (getCookie('notesLogin') == 'AddBagAction' && !$('.notesLogin').hasClass('btn')) {
        $('.up-btn-addToBag').click();
        setCookie('notesLogin', '');
    }
</script>
@include('global')
</html>
