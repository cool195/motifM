<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$data['main_title']}}</title>
    @include('head')
    <link rel="stylesheet" href="/styles/shoppingDetail.css">
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
                                <img class="img-fluid preloader" src="/images/product/bg-product@750.png" alt="">
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
                                    <img src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}" style="display: none">
                                    <img class="img-fluid swiper-lazy"
                                         data-src="{{ env('APP_Api_Image').'/n1/'.$image['img_path'] }}"
                                         alt="">
                                    <img class="img-fluid preloader" src="/images/product/bg-product@750.png" alt="">
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

            <!-- 产品 标题 简介 价格 基本信息 -->
            <article class="product-baseInfo bg-white m-b-10x">
                <div class="product-text">
                    <h6 class="text-main">{{$data['main_title']}}</h6>
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
                    @if(isset($data['skuPrice']['skuPromotion']))
                        <span class="font-size-lx text-primary">${{ number_format(($data['skuPrice']['skuPromotion']['promot_price'] / 100), 2) }}</span>
                        <span class="font-size-sm text-throughLine text-common">${{ number_format(($data['skuPrice']['skuPromotion']['price'] /100), 2) }}</span>
                        <span class="font-size-sm text-primary">({{ $data['skuPrice']['skuPromotion']['display'] }})</span>
                    @else
                        <span class="font-size-lx text-primary">${{ number_format(($data['skuPrice']['sale_price'] / 100), 2) }}</span>
                    @endif
                </div>

                <div class="text-warning font-size-xs p-x-15x" data-impr='http://clk.motif.me/log.gif?t=rec.100002&m=OPEN_M2016-1&pin={{ Session::get('user.pin') }}&uuid={{Session::get('user.uuid')}}&v={" action ":0,"cspus ":{{ $data['skus'] }},"expid ":0,"index ":1,"rec_type ":1,"spu":{{ $data['spu'] }},"ver ":"9.00 "}&sig=2291a58454115c8136169111738de65696add43d'>{{ $data['prompt_words'] }}</div>
            </article>
            <!-- 产品 其他信息 -->
            <section>

                <!-- 选择商品参数 -->
                {{--@if(isset($data['spuAttrs']) || isset($data['vasBases']))--}}
                    {{--<aside class="bg-white m-b-10x">--}}
                        {{--<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"--}}
                           {{--data-remodal-target="modal" href="#">--}}
                            {{--<span data-select>Select</span>--}}
						{{--<span class="flex flex-alignCenter flex-fullJustified">--}}
							{{--<span class="m-r-10x" data-select-options>--}}
                                {{--@foreach($data['spuAttrs'] as $key => $attrs)--}}
                                    {{--@if((count($data['spuAttrs']) - 1) == $key)--}}
                                        {{--{{$attrs['attr_type_value']}}--}}
                                    {{--@else--}}
                                        {{--{{$attrs['attr_type_value'].", "}}--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}

							{{--</span>--}}
							{{--<i class="iconfont icon-arrow-right icon-size-xm text-common"></i>--}}
						{{--</span>--}}
                        {{--</a>--}}
                    {{--</aside>--}}
                {{--@endif--}}
            <!-- 添加到购物车 立即购买 -->
                <aside class="container-fluid bg-white p-y-10x p-x-15x m-b-10x">
                    @if(Session::has('user'))
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn btn-primary btn-block up-btn-addToBag" data-control="openModal" data-action="PATCH">Add to Bag</div>
                            </div>
                            {{--<div class="col-xs-6">--}}
                                {{--<div class="btn btn-primary btn-block" data-control="openModal" data-action="PUT">Buy Now</div>--}}
                            {{--</div>--}}
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/login" class="btn btn-primary btn-block up-btn-addToBag" id="addCart">Add to Bag</a>
                            </div>
                            {{--<div class="col-xs-6">--}}
                                {{--<a href="/login" class="btn btn-primary btn-block" id="buyNow">Buy Now</a>--}}
                            {{--</div>--}}
                        </div>
                    @endif
                </aside>
            <!-- 产品描述 -->
                <aside class="bg-white p-x-15x p-y-10x m-b-10x">
                    <p class="font-size-md text-main"><strong>Description</strong></p>
                    <div class="font-size-sm text-primary">
                        <div class="message-info">
                            <p class="m-b-0"><?php  echo str_replace("\n", "<br/>",  $data['intro_short']) ?></p>
                        </div>
                        <a class="flex flex-alignCenter flex-fullJustified font-size-sm p-t-5x text-common btn-showMore">
                            <span class="showMore">Show More</span>
                            <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                        </a>
                    </div>
                </aside>
                <!-- 用户 Q & A -->
                {{--<aside class="product-secondaryInfo">--}}
                    {{--<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"--}}
                       {{--href="/askshopping?skiptype=3&id={{$data['spu']}}">--}}
                        {{--Inquiries <i class="iconfont icon-arrow-right icon-size-xm text-common"></i></a>--}}
                {{--</aside>--}}
                <aside class="product-secondaryInfo">
                    @if(isset($data['templates']) && !empty($data['templates']))
                        @foreach($data['templates'] as $template)
                            <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                               href="/template/{{ $template['template_id'] }}">
                                {{ $template['template_title'] }}
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                            </a>
                            <hr class="hr-base">
                        @endforeach
                    @endif
                </aside>


                <!-- 推荐商品 -->
                <aside class="m-b-20x">
                    <article class="font-size-md text-primary p-x-15x"><strong>You May Also Like</strong></article>
                    <div class="container-fluid p-a-10x" data-impr="{{ $recommended['impr'] }}">
                        <div class="row">
                            @if(isset($recommended['list']))
                                @foreach($recommended['list'] as $key => $value)
                                    @if($key < 20)
                                        <div class="col-xs-6">
                                            <div class="productList-item">
                                                <div class="image-bg">
                                                    <div class="image-container">
                                                        <a href="/detail/{{ $value['spu'] }}"
                                                           data-impr="{{ $value['impr'] }}"
                                                           data-clk="{{ $value['clk'] }}">
                                                            <img class="img-fluid img-lazy"
                                                                 data-original="{{env('APP_Api_Image')}}/n1/{{ $value['main_image_url'] }}"
                                                                 src="/images/product/bg-product@336.png"
                                                                 alt="{{ $value['main_title'] }}">
                                                        </a>
                                                        @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                            <div class="price-off"><strong
                                                                        class="font-size-sm">{{$value['skuPrice']['skuPromotion']['display']}}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="price-caption">
                                                    <span class="font-size-sm m-l-5x"><strong>${{ number_format(($value['skuPrice']['sale_price'] / 100), 2) }}</strong></span>
                                                    @if($value['skuPrice']['sale_price'] != $value['skuPrice']['price'])
                                                        <span class="font-size-xs text-common text-throughLine m-l-5x">${{ number_format(($value['skuPrice']['price'] / 100), 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </aside>
                <!-- 添加购物车 -->
                <aside class="product-secondaryInfo container-fluid p-y-10x p-x-15x">
                    @if(Session::has('user'))
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn btn-primary btn-block down-btn-addToBag" data-control="openModal" data-action="PATCH">Add to
                                    Bag</div>
                            </div>
                            {{--<div class="col-xs-6">--}}
                                {{--<div class="btn btn-primary btn-block" data-control="openModal" data-action="PUT">Buy Now</div>--}}
                            {{--</div>--}}
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/login" class="btn btn-primary btn-block down-btn-addToBag" id="addCart">Add to Bag</a>
                            </div>
                            {{--<div class="col-xs-6">--}}
                                {{--<a href="/login" class="btn btn-primary btn-block" id="buyNow">Buy Now</a>--}}
                            {{--</div>--}}
                        </div>
                    @endif
                </aside>
            </section>
        </section>

        <!-- 弹出选择 size color Engraving -->
        <!-- TODO remodal 有多余的样式 需要整理 -->
        <div class="remodal p-a-0 modal-content" data-remodal-id="modal" id="modalDialog" data-spu="{{$data['spu']}}">
            <form action="">
                <div class="p-x-15x p-t-15x text-right">
                    <a data-remodal-action="close"><i class="iconfont icon-cross text-common icon-size-lg"></i>
                    </a>
                </div>
                <fieldset class="text-primary p-x-15x p-b-10x text-left">
                    <div class="font-size-base">
                        <strong>${{number_format(($data['skuPrice']['sale_price'] / 100), 2)}}</strong>
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
                    <span class="font-size-sm"></span>
                </div>
                <hr class="hr-base m-a-0">
                @if(isset($data['spuAttrs']))
                    @foreach($data['spuAttrs'] as $value)
                        <fieldset class="p-x-15x p-y-10x text-left">
                            <div class="container-fluid p-a-0">
                                <div class="text-primary font-size-sm">{{$value['attr_type_value']}}</div>
                                <div class="row">
                                    @if(isset($value['skuAttrValues']))
                                        @foreach($value['skuAttrValues'] as $skuValue)
                                            <div class="p-t-10x p-x-5x">
                                                {{-- TODO 赵哲更改模板 --}}
                                                <div class="btn btn-itemProperty btn-sm @if(!$skuValue['stock']) disabled @endif"
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
                                <div class="text-primary font-size-sm m-b-10x">{{ $vas['vas_describe'] }} + ${{number_format(($vas['vas_price'] / 100), 2)}}</div>
                                <div class="flex flex-fullJustified flex-alignCenter">
                                    <input class="input-engraving form-control font-size-sm disabled" type="text" maxlength="20" placeholder="20 characters max">
                                    {{--<input type="radio" name="vas_name" id="{{$vas['vas_id']}}" hidden>--}}
                                    <div class="iconfont icon-checkcircle text-common m-b-0 p-l-20x"
                                         id="{{$vas['vas_id']}}"></div>
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
                                         id="{{$vas['vas_id']}}"></div>
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

                            <div class="btn btn-cartCount btn-sm @if(!(!empty($data['vasBases']) && empty($data['spuAttrs'])))disabled @endif"  data-item="add">
                                <i class="iconfont icon-add"></i>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <hr class="hr-dark m-a-0">
                <fieldset class="container-fluid p-a-15x">
                    @if(Session::has('user'))
                            <!-- 添加 购物车 控制按钮显示 -->
                    <div class="btn btn-primary btn-block  hidden-xs-up @if(!(!empty($data['vasBases']) && empty($data['spuAttrs'])))disabled @endif" data-control="continue" data-role="continue" data-action="">Continue</div>
                    <div class="row" data-control="modalButton">
                        <div class="col-xs-12">
                            <div class="btn btn-primary btn-block @if(!(!empty($data['vasBases']) && empty($data['spuAttrs'])))disabled @endif"
                                 data-role="modalButton" data-action="PATCH">Add to Bag
                            </div>
                        </div>
                        {{--<div class="col-xs-6">--}}
                            {{--<div class="btn btn-primary btn-block @if(!(!empty($data['vasBases']) && empty($data['spuAttrs'])))disabled @endif"--}}
                                 {{--data-role="modalButton" data-action="PUT">Buy Now--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/login" class="btn btn-primary btn-block" id="addCart">Add to Bag</a>
                            </div>
                            {{--<div class="col-xs-6">--}}
                                {{--<a href="/login" class="btn btn-primary btn-block" id="buyNow">Buy Now</a>--}}
                            {{--</div>--}}
                        </div>
                    @endif
                </fieldset>
            </form>
        </div>


        <!-- 页脚 功能链接 start-->
    @include('footer')
    <!-- 页脚 功能链接 end-->
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
            <img class="img-fluid m-x-auto" src="/images/icon-success.png"
                 srcset="/images/icon-success@2x.png 2x, /images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x">Item Added</div>
    </div>
</div>

<!-- 失败 loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="error">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="/images/icon-success.png"
                 srcset="/images/icon-success@2x.png 2x, /images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x" id="error-info"></div>
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingDetail.js"></script>
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
