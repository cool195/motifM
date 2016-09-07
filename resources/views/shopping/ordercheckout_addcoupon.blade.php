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
                    <div class="promotion-item">
                        <div class="promotion-title p-t-15x p-x-10x p-b-5x">
                            <div class="text-white">10% OFF</div>
                            <div class="font-size-sm text-white">10% Off For You First Orde</div>
                        </div>
                        <div class="promotion-time bg-white p-a-10x text-right text-primary">Expire: Jul 31,2016</div>
                    </div>
                </div>

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
