<!DOCTYPE html>
<html lang="en">
<head>

    <title>Add Coupon</title>
    @include('head')

</head>
<body>
@include('check.tagmanager')
    <!-- 外层容器 -->
    <div id="body-content">
        <!-- 展开的汉堡菜单 -->
        @include('nav')
        <!-- 主体内容 -->
        <div class="body-container">
            @include('navigator', ['pageScope'=>true])
            <!-- 添加coupon -->
            <section class="m-b-20x reserve-height">
                <article class="font-size-md text-main p-a-10x"><strong>Promotion code</strong></article>
                <fieldset>
                    <div class="warning-info flex text-warning flex-alignCenter text-left p-a-15x" hidden>
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs"></span>
                    </div>
                    <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="coupon" placeholder="Enter your code" value="{{$cps}}">
                </fieldset>
                <div class="p-a-15x">
                    <div class="btn btn-primary btn-block disabled" data-role="submit">Apply</div>
                </div>

                <!-- 优惠券列表 -->
                <div class="p-a-15x">
                    <div class="promotion-item" data-code="HOIBME">
                        <div class="promotion-info bg-promotion p-a-10x">
                            <div class="promotion-title text-white"><strong>10% OFF</strong></div>
                            <div class="font-size-sm text-white">10% Off For You First Orde</div>
                            <span class="bg-point-right"></span>
                            <span class="bg-point-left"></span>
                            <ul class="promotion-style">
                                <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
                            </ul>
                            <span class="promotion-radio active">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                        </div>
                        <div class="promotion-time text-primary p-a-10x text-right font-size-sm">Expire: Jul 31,2016</div>
                    </div>

                    <div class="promotion-item" data-code="UEBWOW">
                        <div class="promotion-info bg-promotion p-a-10x">
                            <div class="promotion-title text-white"><strong>$10 OFF</strong></div>
                            <div class="font-size-sm text-white">$10 Off For You First Orde</div>
                            <span class="bg-point-right"></span>
                            <span class="bg-point-left"></span>
                            <ul class="promotion-style">
                                <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
                            </ul>
                            <span class="promotion-radio">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                        </div>
                        <div class="promotion-time text-primary p-a-10x text-right font-size-sm">Expire: Jul 31,2016</div>
                    </div>

                    <div class="promotion-item" data-code="FIHDBH">
                        <div class="promotion-info bg-promotionOver p-a-10x">
                            <div class="promotion-title text-white"><strong>Free Shipping</strong></div>
                            <div class="font-size-sm text-white">10% Off For You First Orde</div>
                            <span class="bg-point-right"></span>
                            <span class="bg-point-left"></span>
                            <ul class="promotion-style">
                                <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
                            </ul>
                            <span class="promotion-radio hidden">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                        </div>
                        <div class="promotion-time text-common p-a-10x text-right font-size-sm">Free Shipping For your First Orde Over $100</div>
                    </div>
                </div>

                <!-- 邀请好友 -->
                <aside class="bg-white m-t-20x">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                        <div class="flex flex-alignCenter">
                            <span class="p-r-15x">
                                <img src="/images/icon/gift-small.png" srcset="/images/icon/gift-small@2x.png 2x,/images/icon/gift-small@3x.png 3x">
                            </span>
                            <span>Give a friend $20 on Motif,<br/>and get $20 when they order.</span>
                        </div>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </a>
                </aside>

            </section>
        </div>
    </div>

    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
<form id="infoForm" method="get" action="/cart/ordercheckout" method="get">
    @if(isset($input) && !empty($input))
        <input type="hidden" name="cps" value="">
        @foreach($input as $name=>$value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addCoupon.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
