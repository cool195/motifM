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
                <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="coupon"
                       placeholder="Enter your code" value="">
            </fieldset>
            <div class="p-a-15x">
                <div class="btn btn-primary btn-block disabled" data-role="submit">Apply</div>
            </div>

            <!-- 优惠券列表 -->
            <div class="p-a-15x">
                @inject('getDate', 'App\Services\Publicfun')
                @foreach($couponlist['list'] as $value)
                    <div class="promotion-item">
                        <div class="promotion-info bg-promotion p-a-10x">
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
                            <span class="promotion-radio">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                        </div>
                        <div class="promotion-time text-primary p-a-10x text-right font-size-sm">Expire: {{ $getDate->getMyDate(date('Y-m-d H:i',substr($value['expiry_time'],0,10))) }}
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

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/promocode.js{{'?v='.config('app.version')}}"></script>
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
