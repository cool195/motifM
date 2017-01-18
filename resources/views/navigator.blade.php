<header class="navbar-fixed-top detail-header" id="header">
    <nav class="navbar navbar-full bg-white">
        <ul class="nav navbar-primary nav-top">
            <li class="nav-item nav-logo">
                <a href="/">
                    <H1 style="line-height: 0;">
                    <img class="motif-logo" src="{{env('CDN_Static')}}/images/logo/logo.png" alt="Motif"
                         srcset="{{env('CDN_Static')}}/images/logo/logo@2x.png 2x,{{env('CDN_Static')}}/images/logo/logo@3x.png 3x"></H1></a>
            </li>
            <li class="nav-item nav-hamburger">
                <div class="nav-icon">
                    <i class="nav-tap iconfont icon-hamburger icon-size-lg text-primary" id="nav-menu-control"></i>
                </div>
            </li>
            @if(!isset($pageScope))
            <li class="nav-item nav-cart">
                <div style="width: 70px;">
                    <a href="/wish" class="head-wish">
                        <span class="nav-shoppingWish">
                            <i class="iconfont1 text-primary icon-heart2 nav-tap icon-size-lg"></i>
                        </span>
                    </a>
                    <div class="head-cart">
                        <span class="nav-shoppingCart" data-login="true">
                                {{--<img class="nav-tap" src="{{env('CDN_Static')}}/images/icon/icon-bag.png" srcset="{{env('CDN_Static')}}/images/icon/icon-bag@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-bag@3x.png 3x">--}}
                            <i class="iconfont1 text-primary icon-shop2 nav-tap icon-size-lg"></i>
                            <span class="shoppingCart-number" style="display: none">0</span>
                        </span>
                    </div>
                </div>
            </li>
            @endif
        </ul>
    </nav>
    @if($NavShowDaily || $NavShowDesigner || $NavShowShop)
        <hr class="hr-dark m-a-0">
        <nav class="navbar navbar-full bg-white">
            <ul class="nav navbar-primary nav-top p-t-10x p-b-5x font-size-sm text-center nav-menuList">
                <li class="nav-item col-xs-4">
                    <a href="/daily" class=" @if($NavShowDaily) active @endif text-primary bigNoodle font-size-lg">TRENDING</a>
                </li>
                <li class="nav-item col-xs-4">
                    <a href="/designer" class="@if($NavShowDesigner) active @endif text-primary bigNoodle font-size-lg">COLLECTIONS</a>
                </li>
                <li class="nav-item col-xs-4">
                    <a href="/shopping" class="@if($NavShowShop) active @endif text-primary bigNoodle font-size-lg">SHOP</a>
                </li>
            </ul>
        </nav>
    @endif

        <!-- 购物车列表 -->
        <div class="header-shoppingBag bg-white">
            <section class="cartList bg-white headerBag-list">
            </section>
            <hr class="hr-base m-b-0">
            <section class="shoppingBag-price bg-white p-a-10x">
                <div class="flex flex-fullJustified text-primary font-size-sm">
                    <span class="p-r-5x text-left"><strong>Bag Subtotal: </strong></span><span class="text-right"><strong id="headerBag-subTotal"></strong></span>
                </div>
                <a href="/cart" class="btn btn-red btn-block m-y-5x">View Shopping Bag(<span id="itemNum"></span> items)</a>
            </section>
        </div>
</header>

<template id="tpl-headerBag">
    @{{ each showSkus }}
    @{{ if $value.isPutOn != 1 }}
    <div class="cartList-item headerCartList p-a-10x disabled">
    @{{ else }}
    <div class="cartList-item headerCartList p-a-10x">
    @{{ /if }}
        <a href="/detail/@{{ $value.spu }}" class="inBag">
            <div class="productInfo flex">
                <div class="flex-fixedShrink">
                    <img class="img-thumbnail img-lazy"
                         src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                         data-original="{{env('APP_Api_Image')}}/n2/@{{ $value.main_image_url }}"
                         width="70px" height="70px">
                </div>
                <div class="p-l-10x flex-width">
                    <article class="flex flex-fullJustified">
                        <h6 class="text-main font-size-sm p-r-10x">
                            <strong>@{{ $value.main_title }}</strong></h6>
                        <span class="text-primary font-size-sm flex-fixedShrink">$@{{ ($value.sale_price/100).toFixed(2) }}</span>
                    </article>
                    <aside class="cartItem-secondaryInfo text-primary font-size-sm">
                        @{{ each $value.attrValues as valueattr index }}
                        <div><span>@{{ valueattr.attr_type_value }}: </span><span>@{{ valueattr.attr_value }}</span></div>
                        @{{ /each }}

                        @{{ each $value.showVASes as valuevas index }}
                        <div class="flex flex-fullJustified">
                            <div class="">
                                <span>@{{ valuevas.vas_name }}: </span><span>@{{ valuevas.user_remark }}</span>
                            </div>
                            <div class="">
                                $@{{ (valuevas.vas_price/100).toFixed(2) }}</div>
                        </div>
                        @{{ /each }}
                    </aside>
                </div>
                <div class="mask"></div>
            </div>
        </a>
        <div class="text-right text-primary font-size-sm">x @{{ $value.sale_qtty }}</div>
        @{{ if $value.stock_status == 0 ||  $value.stock_status == 2 || $value.isPutOn !=1}}
            <div class="text-warning font-size-xs">@{{ if $value.stock_status != 2}}Warning: @{{ /if }} @{{ $value.prompt_info }}</div>
        @{{ else if $value.sale_qtty == 50 }}
        <div class="text-warning font-size-xs">Warning: 50 items limit</div>
        @{{ /if }}
    </div>
    @{{ /each }}
</template>
