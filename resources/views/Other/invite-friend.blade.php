<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Confirm</title>
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
        @include('navigator')
                <!-- 订单结算确认信息 -->
        <section class="reserve-height bg-white flex flex-alignCenter flex-justifyCenter">
            <article class="bg-white m-b-10x text-center">
                <div class="text-center p-y-20x">
                    <img src="/images/icon/gift-big.png" srcset="/images/icon/gift-big@2x.png 2x,/images/icon/gift-big@3x.png 3x">
                </div>
                <div class="text-center text-primary font-size-sm p-t-20x p-b-10x">Share Motif with friends.<br/> They get $20 off, and you will<br/> too after their first purchase.
                    <a href="/saleinfo" class="text-primary text-underLine">Details</a></div>
            </article>
        </section>

        <!-- 订单完成 邀请好友 -->
        <aside class="bg-white">
            <div class="p-x-20x p-b-10x">
                <div class="font-size-sm text-primary">Share your Invite code</div>
            </div>
            {{--<div class="p-x-20x p-b-20x">--}}
                {{--<a href="/shopping" class="btn btn-primary btn-block">Invite Contacts</a>--}}
            {{--</div>--}}
        </aside>
        <aside class="bg-white">
            <div class="p-x-20x p-b-20x text-center">
                <span class="text-primary font-size-lg">{{$code}}</span>
            </div>
        </aside>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
