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
            <article class="font-size-md text-main p-a-10x bg-title"><strong>Coupons & promotions</strong></article>
            <hr class="hr-base m-a-0">
            <fieldset>
                <div class="warning-info flex text-warning flex-alignCenter text-left p-a-15x" hidden>
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-xs"></span>
                </div>
                <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="coupon"
                       placeholder="Promotional Code" value="">
            </fieldset>
            <hr class="hr-base m-a-0">
            <div class="p-a-15x">
                <div class="btn btn-primary btn-block disabled" data-role="submit">Apply</div>
            </div>

            <!-- 优惠券列表 -->
            <div class="p-a-15x">
                @inject('getDate', 'App\Services\Publicfun')
                @foreach($couponlist['list'] as $value)
                    <div class="promotion-item @if($value['usable']){{'bindidcode'}}@endif" data-bindid="{{$value['bind_id']}}">
                        <div class="mask"></div>
                        <div class="promotion-info @if($value['usable']){{'bg-promotion'}}@else{{'bg-promotionOver'}}@endif p-a-10x">
                            <div class="promotion-title text-white"><strong>{{$value['cp_title']}}</strong></div>
                            <div class="font-size-sm text-white">{{$value['prompt_words']}}</div>
                            <span class="bg-point-right"></span>
                            <span class="bg-point-left"></span>
                            <ul class="promotion-style">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span class="promotion-radio @if($bindid == $value['bind_id'] || ($value['selected'] && empty($bindid))){{'active'}}@endif">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                        </div>
                        <div class="promotion-time text-primary p-a-10x text-right font-size-sm">Expires: {{ $getDate->getMyDate(date('Y-m-d H:i',substr($value['expiry_time'],0,10))) }}
                        </div>
                    </div>
                @endforeach
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
        <input type="hidden" name="bindid" value="">
        @foreach($input as $name=>$value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addCoupon.js{{'?v='.config('app.version')}}"></script>
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
