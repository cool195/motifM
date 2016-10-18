<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')){{'Motif Referral Program'}}@else{{'MOTIF'}}@endif</title>
    @include('head')

</head>
<body>
@include('check.tagmanager')
        <!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
    @endif
            <!-- 主体内容 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        <div class="body-container">
            @include('navigator')
            @else
                <div class="body-container" style="padding-top:0px">
                    @endif
                            <!-- 服务条款 -->
                    <section class="m-b-20x p-b-20x reserve-height">
                        <article class="font-size-md text-main p-x-15x p-y-10x bg-title"><strong>Motif Referral Program</strong>
                        </article>
                        <hr class="hr-base m-a-0">

                        <div class="bg-white">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>Anyone can Refer a Friend.</strong> Anyone with a registered Motif account can refer a friend. You do not need to have made a purchase prior to referring. Once your referred friend uses the promo code to make a qualifying purchase, the referral credit will be granted to your account. To qualify for the referral program, the referred person must (1) be a new customer, (2) use the referral promo code on checkout, and (3) complete a purchase with a subtotal of at least $35 prior to the promo code's expiration. Both the referral promo code and the referral credit cannot be combined with additional coupons.</p>

                                <p class="m-b-15x"><strong>Multiple referrals are welcomed! </strong>There is no limit to how many friends you may refer; however each referred friend can only use your referral code once.</p>

                                <p class="m-b-15x"></p>
                                <p class="m-b-15x">Both referral credit and referral code expires after 60 days from the date that credit was issued to your account. All transactions must be completed on the Motif app or site. A transaction that is subsequently cancelled does not qualify for referral credits. Referral credit cannot be applied to previous purchases, and is not redeemable for cash. The referral credit is not transferable. This incentive program is for a limited time only. The requirement and incentives are subject to change. Motif reserves the right to suspend your account and remove referrals should we notice any activity we determine as an abuse of the referral program.
                                </p>
                            </div>
                        </div>
                        <hr class="hr-base m-a-0">
                    </section>
                    <!-- 页脚 功能链接 -->
                    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
                        @include('footer')
                    @endif
                </div>
        </div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
