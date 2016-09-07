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
        <section class="reserve-height bg-white">
            <article class="bg-white m-b-10x text-center">
                <div class="text-center p-y-20x">
                    <img src="/images/icon/gift-big.png" srcset="/images/icon/gift-big@2x.png 2x,/images/icon/gift-big@3x.png 3x">
                </div>
                <div class="text-center text-primary font-size-sm p-y-20x">Give a friend $20 on Motif,<br/>and get $20 when they order.</div>

                <div class="text-center p-y-20x">
                    <a href="/termsconditions" class="text-common font-size-sm">Terms & Conditions</a>
                </div>
            </article>
        </section>

        <!-- 订单完成 邀请好友 -->
        <aside>
            <div class="p-a-10x">
                <a href="/shopping" class="btn btn-primary btn-block">Invite Contacts</a>
            </div>
            <div class="p-a-20x hr-invite">
                <hr class="hr-dark m-x-20x">
                <span class="text-primary font-size-sm p-x-5x">or</span>
            </div>
            <div class="p-a-20x">
                <div class="text-center font-size-sm">Share your Invite code</div>
                <div class="text-center p-x-20x p-y-10x flex flex-alignCenter">
                    <input class="input-invite form-control font-size-sm" type="text" maxlength="20">
                    <span class="p-l-15x"><img src="/images/icon/share-ios@2x.png" srcset="/images/icon/share-ios@2x.png 2x,/images/icon/share-ios@3x.png 3x"></span>
                </div>
            </div>
        </aside>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@if(!empty($order['sub_order_no']))
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: $(".reserve-height").data('impr')
            }).done(function () {

            });
        })
    </script>
@endif
@include('global')
</html>
