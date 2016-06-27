<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Add New Card</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/paymentMethod-addCard.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- 添加支付方式 -->
        <section>
            <article class="p-x-15x p-y-10x">
                <span class="font-size-md text-main"><strong>Add New Card</strong></span>
            </article>

            <!-- Add animations on Braintree Hosted Fields events -->

            <!-- Card numbers
            4111 1111 1111 1111: Visa
            5555 5555 5555 4444: MasterCard
            3714 496353 98431: American Express
            -->
            <form class="cardform-container" id="card-container" method="post" data-token="{{$token}}">
                <div class="cardinfo-wrapper font-size-sm">
                    <div class="cardinfo-item">
                        <input class="cardinfo-input" type="tel" data-braintree-name="number"
                               value="" placeholder="Card Number" id="cardNum" maxlength="20">
                        <span class="card-image" id="card-type"></span>
                    </div>
                </div>
                <div class="cardinfo-wrapper font-size-sm">
                    <div class="cardinfo-item">
                        <label class="cardinfo-label flex-fixedShrink">Expires</label>
                        <input class="cardinfo-input" type="text" data-braintree-name="expiration_date"
                               value="" placeholder="MM/YY" maxlength="8">
                    </div>
                    <div class="cardinfo-item">
                        <label class="cardinfo-label flex-fixedShrink">CVV</label>
                        <input class="cardinfo-input" type="tel" data-braintree-name="cvv" value=""
                               placeholder="CVV" maxlength="4">
                    </div>
                </div>
                <div class="warning-info off text-warning flex flex-alignCenter p-a-15x">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-sm">Warming: Women’s Ring</span>
                </div>

                <div class="p-a-15x">
                    <input class="btn btn-primary btn-block" type="submit" value="Add">
                </div>
            </form>

            <div class="bg-white m-b-15x p-a-15x">
                <div class="font-size-md text-main m-b-10x"><strong>Acceptable Bank Cards</strong></div>
                <div class="flex flex-fullJustified">
                    <span><img src="/images/payment/icon-americanexpress.png"
                               srcset="/images/payment/icon-americanexpress@2x.png 2x,/images/payment/icon-americanexpress@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-discover.png"
                               srcset="/images/payment/icon-discover@2x.png 2x,/images/payment/icon-discover@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-duversclub.png"
                               srcset="/images/payment/icon-duversclub@2x.png 2x,/images/payment/icon-duversclub@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-jcb.png"
                               srcset="/images/payment/icon-jcb@2x.png 2x,/images/payment/icon-jcb@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-maestro.png"
                               srcset="/images/payment/icon-maestro@2x.png 2x,/images/payment/icon-maestro@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-mastercard.png"
                               srcset="/images/payment/icon-mastercard@2x.png 2x,/images/payment/icon-mastercard@3x.png 3x"
                               alt=""></span>
                    <span><img src="/images/payment/icon-visa.png"
                               srcset="/images/payment/icon-visa@2x.png 2x,/images/payment/icon-visa@3x.png 3x" alt=""></span>
                </div>
            </div>

        </section>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-transprant loading-hidden">
    <div class="loading-modal">
        <div class="loader loader-white"></div>
        <div class="text-white font-size-md text-center m-t-20x">Applying Payment Method</div>
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
<script src="/scripts/braintree-2.24.1.min.js"></script>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/paymentMethod-addCard.js"></script>
<script src="/scripts/creditCardType.js"></script>
@include('global')
</html>
