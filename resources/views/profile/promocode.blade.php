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
            <article class="font-size-md text-main p-a-10x bg-title"><strong>Promotion Code</strong></article>
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
                    <div class="promotion-item">
                        <div class="mask"></div>
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

            <!-- 邀请好友 -->
            <aside class="bg-white m-t-20x">
                <hr class="hr-base m-a-0">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/invitefriends">
                    <div class="flex flex-alignCenter">
                            <span class="p-r-15x">
                                <img src="{{env('CDN_Static')}}/images/icon/gift-small.png" srcset="{{env('CDN_Static')}}/images/icon/gift-small@2x.png 2x,{{env('CDN_Static')}}/images/icon/gift-small@3x.png 3x">
                            </span>
                        <span>Share Motif with friends. They get $20 off, and you will too after their first purchase.</span>
                    </div>
                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                </a>
            </aside>
            <hr class="hr-base m-a-0">
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

    function getCookie(name) {
        var arr = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)(;|$)'));
        if (arr != null) {
            $('div[data-role="submit"]').removeClass('disabled');
            setCookie(name, '');
            return unescape(arr[2]);
        }
        return null;
    }
    function setCookie(name, value) {
        var exp = new Date();
        exp.setTime(0);
        document.cookie = name + '=' + escape(value) + ';path=/;expires=' + exp.toGMTString();
    }

    $('input[name="coupon"]').val(getCookie('sharecode'))

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
