<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios')){{'FAQ'}}@else{{'MOTIF'}}@endif</title>
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
                            <!-- FQA -->
                    <section class="m-b-20x p-b-20x reserve-height">
                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>FAQ</strong></div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-0">For any further queries not addressed below, please feel free to contact us at service@motif.me. Normally, our service team will reply within 24 hours, and all emails will be replied to.</p>
                            </div>
                        </div>
                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Account Management</strong></div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>What if I forget my login password?</strong></p>
                                <p class="m-b-0">Click on “Forgot Password” at the Sign in page, and fill in your
                                    registered email
                                    then we’ll
                                    email you a link to easily reset your password.</p>
                            </div>
                        </div>
                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Shipping & Tracking</strong>
                            </div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>When will my order ship?</strong></p>
                                <p class="m-b-15x">We process and ship orders Monday through Friday. Orders are usually fulfilled and shipped within 2-3 business days of purchase, unless otherwise noted. Shipping time for pre-order/personalized pieces may take longer, details of which can be found in the product description. When your order ships, we will email you a shipping confirmation with tracking information. Please check your spam folder if you did not receive any email. You can track your order by logging into your Motif account and select "Orders".
                                </p>
                                <p class="m-b-15x"><strong>Do you ship internationally?</strong></p>
                                <p class="m-b-15x">Yes, Motif currently ships to 30+ countries and we are always adding more. Please check our Shipping Policy for list of countries that we ship to. We even offer free International Expedited Shipping for orders over USD $79.
                                </p>
                                <p class="m-b-15x"><strong>How long will it take for my order to arrive?</strong></p>
                                <p class="m-b-15x">We provide three options for delivery:
                                    <br>
                                    Option 1. Registered Airmail (10-15 business days upon receiving shipping confirmation)
                                    <br>
                                    Option 2. Expedited Shipping (3-7 business days upon receiving shipping confirmation)
                                </p>
                                <p class="m-b-15x">Please note: For countries other than US, Canada and Australia, Registered Airmail may take up to 22 business days to arrive due to local dispatch or other reasons</p>

                                <p class="m-b-15x"><strong>How can I track my order?</strong></p>
                                <p class="m-b-0">We will send one order confirmation email to you after you complete
                                    your purchase.
                                    When your
                                    package is shipped, you will get a shipping confirmation email from us with the
                                    tracking
                                    information.You can also track your order by signing into your Motif account on our app and website, and select "Orders".</p>
                                <p class="m-b-0">Please note that for Registered Airmail, their tracking system can sometimes be slow to update, and you may not see your order appear for a few days.
                                </p>
                            </div>
                        </div>

                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Order & Payment</strong>
                            </div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>Can I make changes to my order?</strong></p>
                                <p class="m-b-15x">Yes, please send us an email WITHIN 24 HOURS of ordering. We will try our best to make changes for you before we engrave the item or ship your package out.
                                </p>
                                <p class="m-b-15x"><strong>Where Is my order confirmation?
                                    </strong></p>
                                <p class="m-b-15x">As soon as your order is approved, you will receive an email confirmation to the email address you entered on your order.  If for some reason you did not receive an email, please check your spam folder and add service@motif.me to your safe sender list.
                                    <br>
                                    You can also check your order status by signing into your Motif account on our app and website.
                                </p>
                                <p class="m-b-15x"><strong>What methods of payment do you accept?
                                    </strong></p>
                                <p class="m-b-15x">We accept Visa, Mastercard, American Express, JCB, PayPal, and Apple Pay.
                                </p>

                                <p class="m-b-15x"><strong>Why is my order detail showing “Payment Error”?
                                    </strong></p>
                                <p class="m-b-15x">If you cancelled the payment process anytime during the checkout process, the incomplete order will be temporarily labeled “Payment Error”. Do not worry, simply click “Check Out” on the order detail page again, and you will be able to pay for your items and complete the order. You can view your order history and choose to complete any incomplete order by signing into your Motif profile, and click on “Orders” page.
                                </p>

                                <p class="m-b-15x"><strong>Why was my order cancelled?
                                    </strong></p>
                                <p class="m-b-15x">
                                    Our system is currently setup in a way that each attempted checkout is viewed as a separate order. If you cancelled the payment process during the checkout process, your incomplete order will be moved to your “Orders” page within your Motif profile, along with all the items that you were trying to order, and any applied promo codes. You can view your order history and choose to complete any cancelled order there.<br>
                                    Your order can also be cancelled if your payment is declined by your bank, credit card company, PayPal, or Apple Pay. If you wish to place the order again, simply place the order again through by signing in to your Motif profile, click “Orders”, and select the order you wish to process.<br>
                                    In rare cases, the item you ordered may have became out of stock and is no longer available. If an item in your order does become unavailable, you will be contacted within 24 to 48 hours regarding the cancellation. If your order contains additional items, these items will still be shipped to you and only the unavailable item will be removed from your order.<br>
                                </p>

                                <p class="m-b-15x"><strong>Why was my payment declined?
                                    </strong></p>
                                <p class="m-b-15x">Most payments are declined due to billing information entered not matching the address your bank has on file. Please be sure to check that your payment details match what your bank has on file, and if that still does not work, please send us an email at service@motif.me and we will try our best to help.
                                </p>

                                <p class="m-b-15x"><strong>Why does it look like I was charged more than once?
                                    </strong></p>
                                <p class="m-b-15x">Unless you received an order confirmation, we did not charge your card. If your credit card was declined, you may see pending transactions for each attempt to submit a payment. This is a common bank practice handling credit card transactions to ensure sufficient funds and account authenticity. The pending transaction will clear up within 3-5 business days, depending on your bank, and will never turn into a charge. You will always get an email confirmation for every charge that we make, when an order is successfully placed on our site.
                                </p>

                                <p class="m-b-15x"><strong>Do I need to pay tax for the products?
                                    </strong></p>
                                <p class="m-b-15x">You are responsible for determining and paying the appropriate government taxes, fees, and service charges resulting from a transaction occurring through the Service.  We are not responsible for collecting, reporting, paying, or remitting to you any such taxes, fees, or service charges. All transactions through the Service are in U.S. dollars.
                                </p>
                            </div>
                        </div>

                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Return & Exchange</strong>
                            </div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>What should I do if my ring does not fit?</strong></p>
                                <p class="m-b-15x">If you receive a ring that does not fit, please contact our customer service for help, we’d love help you exchange the size of any non-personalized rings; however, you will be responsible for shipping fees generated (exceptions may apply).</p>
                                <p class="m-b-15x">Unfortunately, we can’t exchange rings which are engraved or customized, therefore, we suggest that you follow our Size Guide and carefully choose the correct size.</p>

                                <p class="m-b-15x"><strong>I’ve changed my mind. Can I return a product if don’t want it anymore?</strong></p>
                                <p class="m-b-15x">Yes, we offer a 30 day free return if you are not 100% satisfied with your purchase. We can help you return the product, but we reserve the right to charge shipping & handling, and restocking fees. For more details, please visit our Return <a href="/template/23"
                            </div>
                        </div>

                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Promo Code & Referral Credit</strong>
                            </div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>My promo code is gone after I cancelled an order, help!</strong></p>
                                <p class="m-b-15x">If you applied a promo code to an order, and ended up not completing the checkout process for that order, promo codes designated for first-time purchase may be gone when you try to place a new order. To retrieve your original order with applied discount, sign in to your Motif profile, click on “Orders” page, and retrieve your order.</p>
                            </div>
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x"><strong>I have referral credit, how do I use it?</strong></p>
                                <p class="m-b-15x">Simply sign into your Motif account, go to your profile, and click on “Promotions”. You will find all your coupons and referral vouchers there. Choose the credit you want to use upon checkout, and the amount will automatically be deducted from any qualifying order.</p>
                            </div>
                        </div>

                        <div class="bg-white m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Need more help?</strong>
                            </div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">For any further queries, please feel free to contact us at service@motif.me. Normally our service team will reply within24 hours, but during the busy season or long holidays, it may take longer to respond. However, no emails will be left unanswered.</p>
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
