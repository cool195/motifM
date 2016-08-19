<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Card</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/paymentMethod-addCard.css{{'?v='.config('app.version')}}">

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
    <!-- 添加支付方式 -->
        <section class="reserve-height">
            <article class="bg-white p-x-15x p-y-10x font-size-sm">
                <div class="text-primary">Billing Descriptor</div>
                <div class="text-primary Paywith-orderInfo">Order Amount: <span>0.01 USD</span></div>
                <div class="text-primary Paywith-orderInfo">Order No.: <span>test201608160998</span></div>
            </article>

            <form class="cardform-container" id="card-container" method="post">
                <div class="p-x-15x p-b-10x p-t-15x font-size-md text-main"><strong>Card Number</strong></div>
                <div class="cardinfo-wrapper font-size-sm">
                    <div class="cardinfo-item">
                        <input class="cardinfo-input" type="tel" value="" placeholder="Card Number" id="cardNum" maxlength="20">
                            <span class="card-image">
                                <img src="/images/payment/icon-cardCredit.png" srcset="/images/payment/icon-cardCredit@2x.png 2x,/images/payment/icon-cardCredit@3x.png 3x" alt="">
                            </span>
                    </div>
                </div>

                <div class="p-x-15x p-b-10x p-t-15x font-size-md text-main"><strong>Expiration Date</strong></div>
                <div class="cardinfo-wrapper font-size-sm">
                    <div class="cardinfo-item p-a-0">
                        <div class="row">
                            <div class="col-xs-6 border-right cardtime">
                                <input class="cardinfo-input" type="text" value="" placeholder="Month" maxlength="2">
                            </div>
                            <div class="col-xs-6 cardtime">
                                <input class="cardinfo-input" type="text" value="" placeholder="Year" maxlength="4">
                            </div>
                        </div>
                    </div>
                    <div class="cardinfo-item">
                        <input class="cardinfo-input" type="text" value="" placeholder="CVV" maxlength="4">
                            <span class="card-image icon-question">
                                <img src="/images/payment/icon-question.png" srcset="/images/payment/icon-question@2x.png 2x,/images/payment/icon-question@3x.png 3x" alt="">
                            </span>
                    </div>
                </div>

                <div class="p-a-15x">
                    <div class="m-b-15x"><div class="btn btn-primary btn-block" data-role="submit">Pay Now</div></div>
                    <div><div class="btn btn-primary btn-block disabled" data-role="Cancel">Cancel</div></div>
                </div>

            </form>

            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>We Accept</strong></div>
            <div class="bg-white m-b-15x p-x-15x p-y-10x">
                <div class="flex">
                        <span class="p-r-20x"><img src="/images/payment/icon-visa.png"
                                                   srcset="/images/payment/icon-visa@2x.png 2x,/images/payment/icon-visa@3x.png 3x"
                                                   alt=""></span>
                        <span class="p-r-20x"><img src="/images/payment/icon-mastercard.png"
                                                   srcset="/images/payment/icon-mastercard@2x.png 2x,/images/payment/icon-mastercard@3x.png 3x"
                                                   alt=""></span>
                        <span class="p-r-20x"><img src="/images/payment/icon-maestro.png"
                                                   srcset="/images/payment/icon-maestro@2x.png 2x,/images/payment/icon-maestro@3x.png 3x"
                                                   alt=""></span>
                </div>
            </div>

        </section>

        <!-- 弹出 CVV 帮助 -->
        <div class="remodal remodal-lg modal-content" data-remodal-id="cvvquestion-modal" id="cvvQuestionDialog">
            <div class="p-a-15x flex flex-fullJustified flex-alignCenter">
                <span class="font-size-md">What is CVV2?</span>
                <i class="iconfont icon-cross icon-size-md text-common" data-remodal-action="close"></i>
            </div>
            <div class="font-size-sm">
                <hr class="hr-base m-a-0">
                <div class="p-a-15x">
                    <img class="img-fluid" src="/images/payment/img-cvv.png" srcset="/images/payment/img-cvv@2x.png 2x,/images/payment/img-cvv@3x.png 3x" alt="">
                </div>
            </div>
        </div>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="loading">
    <div class="loading-modal">
        <div class="loader loader-white"></div>
        <div class="text-white font-size-md text-center m-t-20x">Applying Payment Method</div>
    </div>
</div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="success">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon-success.png" srcset="{{env('CDN_Static')}}/images/icon-success@2x.png 2x, {{env('CDN_Static')}}/images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x">Card Added</div>
    </div>
</div>
@if(isset($input) && !empty($input))
    <form id="infoForm" action="/braintree" method="get" hidden>
        @foreach($input as $name => $value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    </form>
@endif
</body>
<!-- BrainTree -->
<script src="{{env('CDN_Static')}}/scripts/braintree-2.24.1.min.js"></script>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/paymentMethod-addCard.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/creditCardType.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
