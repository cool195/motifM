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
                        <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Payment</strong>
                        </article>
                        <div class="bg-white m-b-10x">
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">At the checkout, you can proceed as a guest or create an online
                                    account with us once you have placed your order. By creating an online account, you
                                    can enjoy a quicker checkout process in the future and save your delivery and
                                    payment details. If you are an existing customer, you will be able to log in to your
                                    account.
                                </p>
                                <div>
                                    <p class="m-b-15x"><strong>METHOD OF PAYMENT</strong></p>
                                    <p class="m-b-15x">
                                        <strong>PayPal:</strong> We accept PayPal as one method of payment. After
                                        clicking on PayPal
                                        Express Checkout, you will be redirected to PayPal where you can either create
                                        an account or login to an existing account and arrange payment of your order.
                                        You will be redirected to the website once your order is received.
                                    </p>
                                    <p class="m-b-15x">
                                        <strong>eCheck:</strong> We accept eCheck as well. With an eCheck, we could
                                        receive the payment in 5-7 business days depending on the regulations of your
                                        bank. Therefore, we consider the date of receiving the payment as your order
                                        date. We will process your order only after we receive your payment.
                                    </p>
                                    <p class="m-b-15x">
                                        <strong>Coupon Code:</strong> Please fill in the Coupon Code you have in the
                                        discount code box while making payment.
                                    </p>

                                    <p class="m-b-15x"><strong>Declined PayPal Transactions</strong></p>
                                    <p class="m-b-15x">
                                        There are several reasons your payment may have been declined by PayPal:
                                    </p>
                                    <p class="m-b-15x">
                                        1) Suspicion of fraud or incorrect billing information<br/>
                                        2) Invalid credit card or account linked to PayPal (or none linked)<br/>
                                        3) Insufficient funds
                                    </p>
                                    <p class="m-b-15x">
                                        For more information, please log in to your PayPal account, or contact PayPal
                                        Customer Support.
                                    </p>

                                    <p class="m-b-15x">
                                        If you are experiencing difficulties with your payment or order please contact
                                        our Customer Service Team via Live Chat or email <a
                                                href="mailto:service@motif.me" class="text-underLine">service@motif
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
