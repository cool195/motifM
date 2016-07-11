<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
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
                            <!-- 物流、退货、支付 说明 -->
                    <section class="m-b-20x p-b-20x reserve-height">
                        <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Payments</strong>
                        </article>
                        <div class="bg-white m-b-10x">
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">At the checkout, you can proceed as a guest or create an online
                                    account with us
                                    once you have placed your order. By creating an online account, you can enjoy a
                                    quicker checkout
                                    process in the future and save your delivery and payment details. If you are an
                                    existing
                                    customer, you will be able to log in to your account.
                                </p>
                                <div>
                                    <p class="m-b-15x"><strong>METHODS OF PAYMENT</strong></p>
                                    <p class="m-b-15x">
                                        <strong>1) Credit card:</strong> We accept the following cards for payment of
                                        purchases made
                                        online
                                    </p>
                                    <p><img class="img-fluid" src="/images/payment/cards.png"
                                            srcset="/images/payment/cards@2x.png 2x, /images/payment/cards@3x.png 3x"
                                            alt=""></p>
                                    <p class="m-b-15x">Payment will be taken from your credit or debit card as soon as
                                        you have placed your order. To ensure safe shopping, we are GoDaddy SSL
                                        certified which will automatically create an encrypted connection with
                                        customer’s browser and protect all the sensitive information.
                                    </p>

                                    <p class="m-b-15x">
                                        <strong>2) PayPal:</strong> We also accept PayPal as a method of payment. If you
                                        select this option in the checkout, you will be redirected to PayPal where you
                                        can either create an account or login to an existing account and arrange payment
                                        of your order. You will be redirected to the website once your order is
                                        received.
                                    </p>

                                    <p class="m-b-15x"><strong>Declined PayPal Transactions</strong></p>
                                    <p class="m-b-15x">
                                        There are several reasons your payment may have been declined by PayPal:
                                    </p>
                                    <p class="m-b-15x">
                                        1) Suspicion of fraud or incorrect billing information<br>
                                        2) Invalid credit card or account linked to PayPal (or none linked)<br>
                                        3) Insufficient funds
                                    </p>
                                    <p class="m-b-15x">
                                        For more information, please log in to your PayPal account, or contact PayPal
                                        Customer
                                        Support.
                                    </p>

                                    <p class="m-b-15x">
                                        <strong>3) Coupon Code:</strong> Please fill in the Coupon Code you have in the
                                        box while
                                        making payment.
                                    </p>
                                    <p class="m-b-0">If you are experiencing difficulties with your payment or order
                                        please contact
                                        our Customer Service Team via Live Chat or email <a
                                                href="mailto:service@motif.me"
                                                class="text-underLine">service@motif
                                            .me</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- 页脚 功能链接 -->
                    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
                        @include('footer')
                    @endif
                </div>
        </div>
</body>
<script src="scripts/vendor.js"></script>
@include('global')
</html>
