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

                <aside class="">
                    <form method="">
                        <fieldset class="bg-white m-b-10x">
                            <div class="flex flex-alignCenter flex-fullJustified">
                                <input class="form-control form-control-block p-a-15x font-size-sm" type="text" placeholder="Card Number">
                                <div class="p-x-15x flex flex-alignCenter">
                                    <i class="iconfont icon-delete icon-size-md text-common p-r-10x"></i>
                                <span><img src="/images/payment/icon-card.png" srcset="/images/payment/icon-card@2x.png 2x,/images/payment/icon-card@3x.png 3x" alt=""></span>
                                </div>
                            </div>
                            <hr class="hr-base m-a-0">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 border-right">
                                        <div class="flex flex-alignCenter flex-fullJustified p-x-10x">
                                            <div class="flex flex-alignCenter flex-fullJustified">
                                                <span class="text-primary font-size-sm p-r-15x">Expires</span>
                                                <input class="form-control form-control-block p-y-15x p-x-0 font-size-sm" type="text" placeholder="MM/YY">
                                            </div>
                                            <span><i class="iconfont icon-delete icon-size-md text-common"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="flex flex-alignCenter flex-fullJustified p-x-10x">
                                            <div class="flex flex-alignCenter">
                                                <span class="text-primary font-size-sm p-r-15x">CVV</span>
                                                <input class="form-control form-control-block p-y-15x p-x-0 font-size-sm" type="text" placeholder="CVV">
                                            </div>
                                            <span><i class="iconfont icon-delete icon-size-md text-common"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-base m-a-0">
                            <div class="text-warning flex flex-alignCenter p-a-15x">
                                <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                                <span class="font-size-sm">Warming: Women’s Ring</span>
                            </div>
                        </fieldset>
                        <div class="bg-white p-a-15x">
                            <div class="font-size-md text-main m-b-10x"><strong>Acceptable Bank Cards</strong></div>
                            <div class="flex flex-fullJustified">
                            <span><img src="/images/payment/icon-americanexpress.png" srcset="/images/payment/icon-americanexpress@2x.png 2x,/images/payment/icon-americanexpress@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-discover.png" srcset="/images/payment/icon-discover@2x.png 2x,/images/payment/icon-discover@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-duversclub.png" srcset="/images/payment/icon-duversclub@2x.png 2x,/images/payment/icon-duversclub@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-jcb.png" srcset="/images/payment/icon-jcb@2x.png 2x,/images/payment/icon-jcb@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-maestro.png" srcset="/images/payment/icon-maestro@2x.png 2x,/images/payment/icon-maestro@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-mastercard.png" srcset="/images/payment/icon-mastercard@2x.png 2x,/images/payment/icon-mastercard@3x.png 3x" alt=""></span>
                            <span><img src="/images/payment/icon-visa.png" srcset="/images/payment/icon-visa@2x.png 2x,/images/payment/icon-visa@3x.png 3x" alt=""></span>
                            </div>
                        </div>
                        <div class="p-a-15x">
                            <a href="#" class="btn btn-primary btn-block btn-sm">Change</a>
                        </div>
                    </form>
                </aside>
            </section>
            <!-- Add animations on Braintree Hosted Fields events -->

            <!-- Card numbers
			4111 1111 1111 1111: Visa
			5555 5555 5555 4444: MasterCard
			3714 496353 98431: American Express
			-->
            <section>
                <div class="cardform-container">
                    <form id="card-form">
                        <div class="cardinfo-card-number">
                            <label class="cardinfo-label p-a-15x" for="card-number">
                                <div class="input-wrapper" id="card-number"></div>
                                <div id="card-image"></div>
                            </label>
                        </div>
                        <hr class="hr-base m-a-0">
                        <div class="cardinfo-wrapper">
                            <div class="cardinfo-exp-date p-a-15x">
                                <label class="cardinfo-label" for="expiration-date">
                                    <span class="flex-fixedShrink p-r-10x">Valid Thru</span>
                                    <div class="input-wrapper" id="expiration-date"></div>
                                </label>
                            </div>
                            <div class="cardinfo-cvv p-a-15x">
                                <label class="cardinfo-label" for="cvv">
                                    <span class="flex-fixedShrink p-r-10x">CVV</span>
                                    <div class="input-wrapper" id="cvv"></div>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-a-15x">
                    <input id="button-pay" class="btn btn-primary btn-block btn-sm" type="submit" value="Change">
                </div>
            </section>
            <!-- Load the required client component. -->
            <script src="https://js.braintreegateway.com/web/3.0.0-beta.7/js/client.min.js"></script>

            <!-- Load Hosted Fields component. -->
            <script src="https://js.braintreegateway.com/web/3.0.0-beta.7/js/hosted-fields.min.js"></script>

            <!-- 页脚 功能链接 -->
            @include('footer')
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/vendor.js"></script>

</html>
