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

<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
            <!-- 主体内容 -->
    <div class="body-container productDetail-container" style="padding-top: 44px">
        @inject('wishlist', 'App\Http\Controllers\Shopping\ShoppingController')
        @include('navigator', ['pageScope'=>'store'])
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
                                    <img src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         style="display: none">
                                    <img class="img-fluid swiper-lazy"
                                         data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         alt="">
                                    <img class="img-fluid preloader"
                                         src="{{env('CDN_Static')}}/images/product/bg-product@750.png" alt="">
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
                    <div class="swiper-pagination text-right p-r-20x font-size-sm" id="baseImg-pagination"></div>
                </div>
            </div>
        {{--    @if(Session::has('user'))
                <span class="wish-item p-r-10x p-t-10x"><i
                            class="iconfont1 text-primary btn-wish btn-wished @if(in_array($data['spu'], $wishlist->wishlist())){{'active'}}@endif"
                            data-spu="{{$data['spu']}}"></i></span>
            @else
                <a class="wish-item p-r-10x p-t-10x" href="javascript:;"><i
                            class="iconfont1 text-primary btn-wish btn-wished" data-actionspu="{{$data['spu']}}"></i></a>
                @endif--}}

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
                    {{--<fieldset class="p-x-15x p-y-10x">
                        <div class="flex flex-fullJustified flex-alignCenter">
                            <span class="text-primary font-size-sm">Qty:</span>
                            <div class="btn-group flex" id="item-count">
                                <div class="btn btn-cartCount btn-sm disabled" data-item="minus">
                                    --}}{{--<i class="iconfont icon-minus"></i>--}}{{--
                                    <i class="iconfont1 icon-arrow-bottom1 icon-size-sm"></i>
                                </div>
                                <div class="btn btn-cartCount btn-sm" data-num="num">1</div>

                                <div class="btn btn-cartCount btn-sm" data-item="add">
                                    --}}{{--<i class="iconfont icon-add"></i>--}}{{--
                                    <i class="iconfont1 icon-arrow-up1 icon-size-sm"></i>
                                </div>
                            </div>
                        </div>
                    </fieldset>--}}
                </section>

                <!-- Add to Bag 按钮 -->
                @inject('editsavelist', 'App\Http\Controllers\Designer\DesignerController')
                <section class="addToBag-info">
                    <hr class="hr-base m-a-0">
                    <fieldset class="container-fluid p-a-15x">
                        <!-- 添加 购物车 控制按钮显示 -->
                        <div class="text-center m-b-5x font-size-sm">This item is available for immediate shipping</div>
                        <button class="btn btn-red btn-block btn-addToSave @if(0 == $data['isNetRed'] && !in_array($data['spu'], $editsavelist->editSaveList())) disabled @endif"
                                data-spu="{{$data['spu']}}"
                                data-issaved="@if(in_array($data['spu'], $editsavelist->editSaveList())){{1}}@else{{0}}@endif">@if(in_array($data['spu'], $editsavelist->editSaveList())){{'SAVED'}}@else{{'SAVE'}}@endif</button>
                        {{--<a href=javascript:;" class="notesLogin btn btn-primary btn-block"--}}
                        {{--@if(!$data['sale_status'] || $data['isPutOn']==0) disabled--}}
                        {{--@endif>Add to Bag--}}
                        {{--</a>--}}
                        {{--@endif--}}
                    </fieldset>
                </section>

                <!-- 产品 其他信息 -->
                <section class="m-b-20x">
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
                   {{-- <aside class="product-secondaryInfo">
                        <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                           href="/askshopping?skiptype=3&id={{$data['spu']}}">
                            Inquiries
                            <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                        </a>
                    </aside>--}}
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
        <div class="text-white font-size-md text-center" id="error-info"></div>
    </div>
</div>

<img src='{{ config('app.clk_url') }}/log.gif?time={{time()}}&t=pv.100001&m=H5_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::has('user') ? Session::get('user.uuid') : $_COOKIE['uid']}}&v={"spu":{{$data['spu']}},"main_sku":{{$data['skuPrice']['sku']}},"price":{{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }},"version":"1.0.1","ver":"9.2","src":"H5"}&ref={{$_SERVER['HTTP_REFERER']}}' hidden>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/storeDetail.js{{'?v='.config('app.version')}}"></script>
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

</script>

@include('global')
</html>
