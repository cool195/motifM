<!DOCTYPE html>
<html lang="en">
<head>
    <title>FAQ</title>
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
        <section class="m-b-20x p-b-20x">
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>FAQ</strong>
            </article>
            <div class="bg-white m-b-10x">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Manage Account</strong></div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>What if I forget my login password?</strong></p>
                    <p class="m-b-0">Click on “Forgot Password” at the Sign in page, and fill in your registered email
                        then we’ll
                        email you a link to easily reset your password.</p>
                </div>
            </div>
            <div class="bg-white m-b-10x">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Ordering, Processing and Shipping</strong>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>Can I change the order information before the product is
                            shipped?</strong></p>
                    <p class="m-b-15x">Yes, please send us an email WITHIN 24 HOURS of ordering. We can change it for
                        you before we
                        engrave the item or ship your package out.</p>

                    <p class="m-b-15x"><strong>How long will my package be shipped after I place the
                            order?</strong></p>
                    <p class="m-b-15x">For non-personalized products, we need 4 business days to process, while for
                        personalized
                        products, such as name necklaces and pendants, it may take 7-15 business days to process.</p>

                    <p class="m-b-15x"><strong>Where do you ship from?</strong></p>
                    <p class="m-b-15x">Our warehouse is based in China, so we ship from China.</p>

                    <p class="m-b-15x"><strong>How long does the shipping takes? Why I can’t get any tracking
                            information with the tracking number given?</strong></p>
                    <p class="m-b-15x">Option 1. Registered Airmail (7-20 business days)<br>
                        Option 2. Standard Shipping (5-8 business days)<br>
                        Option 3. Expedited Shipping (3-4 business days)</p>
                    <p class="m-b-15x">As for Registered Airmail, the Logistics website may not update so frequently,
                        therefore we
                        suggest you check the status after 3-5 days of receiving the tracking information.</p>

                    <p class="m-b-15x"><strong>How can I track my order?</strong></p>
                    <p class="m-b-0">We will send one order confirmation email to you after you complete your purchase.
                        When your
                        package is shipped, you will get a shipping confirmation email from us with the tracking
                        information.</p>
                </div>
            </div>

            <div class="bg-white m-b-10x">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Taxes and Fees.</strong>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>Do I need to pay tax for the products?</strong></p>
                    <p class="m-b-15x">You are responsible for determining and paying the appropriate government taxes, fees,
                        and service charges resulting from a transaction occurring through the Service.  We are
                        not responsible for collecting, reporting, paying, or remitting to you any such taxes, fees,
                        or service charges. All transactions through the Service are in U.S. dollars.</p>
                </div>
            </div>

            <div class="bg-white m-b-10x">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Return & Exchange</strong>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>What should I do if I get the wrong-size ring?</strong></p>
                    <p class="m-b-15x">If you receive the wrong-size ring, please contact our customer service for help,
                        we’d love to
                        exchange the size for non-personalized rings. However, you are responsible for all shipping fees
                        (exceptions may apply).</p>
                    <p class="m-b-15x">Unfortunately, we can’t exchange rings which are engraved or customized,
                        therefore, we suggest
                        that you follow our Size Guide and carefully choose the correct size.</p>

                    <p class="m-b-15x"><strong>What can I do if I get an empty box?</strong></p>
                    <p class="m-b-15x">We carefully check all shipments and we make sure never to send an empty box out.
                        We suggest that
                        you contact the delivery service which delivered the package, as they were the last ones to
                        handle it. If they don’t have the product, please contact us with a picture of the box as soon
                        as possible.</p>

                    <p class="m-b-15x"><strong>Can I return a product because I just don’t like or want
                            it?</strong></p>
                    <p class="m-b-0">Yes, we offer a 30 day free return if you are not 100% satisfied with your
                        purchase. We can help
                        you return the product, but we reserve the right to charge shipping & handling, and restocking
                        fees. For more details, please visit our Return <a href="mailto:service@motif.me"
                                                                           class="text-underLine">Policy</a> Page.</p>
                </div>
            </div>

{{--            <div class="bg-white m-b-10x">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Other Queries</strong>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>Do you carry big size rings?</strong></p>
                    <p class="m-b-15x">Yes! We can make larger rings for some certain category.</p>
                    <p class="m-b-15x">However, there may be a $50-80 USD surcharge for customization and 15-20 days are
                        needed for
                        production. Please contact our customer service for details service@motif.me.</p>

                    <p class="m-b-15x"><strong>How can I contact your customer service?</strong></p>
                    <p class="m-b-0">Please email us at service@motif.me. Normally our service team will reply you
                        within24 hours, but
                        during the busy season or long holidays, it may take longer to respond. However, no emails will
                        be left unanswered.</p>
                </div>
            </div>--}}

            <div class="bg-white">
                <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Personalized Jewelry FAQs</strong>
                </div>
                <hr class="hr-base m-y-0">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>1. What kind of personalization services do you offer?</strong></p>
                    <p class="m-b-15x">For now, we only offer engraving service. There will be an engraving box on the
                        Personalized
                        Products detail page.</p>

                    <p class="m-b-15x"><strong>2. Is personalized jewelry more expensive?</strong></p>
                    <p class="m-b-15x">Not really, we offer personalization service and you can find all the
                        personalized jewelry in the
                        personalized category. We will only charge a couple of dollars for the personalization
                        workmanship.</p>

                    <p class="m-b-15x"><strong>3. What characters can be engraved?</strong></p>
                    <p class="m-b-15x">Dates, names, words, and simple patterns can all be engraved.</p>

                    <p class="m-b-15x"><strong>4. What part of rings, necklaces and bracelets can be
                            engraved?</strong></p>
                    <p class="m-b-15x">Please note that engravings can only be done on the insides of rings and
                        bracelets and on the
                        backs of pendants.</p>

                    <p class="m-b-15x"><strong>5. How many characters can be engraved?</strong></p>
                    <p class="m-b-15x">In order for the words to be legible, please keep the number of characters within
                        15.</p>

                    <p class="m-b-15x"><strong>6. How long it will take to process personalized jewelry?</strong></p>
                    <p class="m-b-15x">Personalized items usually take up to 7-15 days as we do need time to meet your
                        specifications.</p>

                    <p class="m-b-15x"><strong>7. Can you make a ring, necklace or bracelet if I just give you a
                            picture?</strong></p>
                    <p class="m-b-15x">Yes, we can make jewelry according to pictures you send to us and your other
                        requirements, and we
                        will do our best to meet your specifications. For more info., please feel free to contact us at
                        <a href="mailto:service@motif.me" class="text-underLine">service@motif.me</a>.</p>

                    <p class="m-b-15x"><strong>8. Can I return it if I don’t like it?</strong></p>
                    <p class="m-b-15x">Sorry, personalized jewelry cannot be returned unless it’s a quality issue.
                        Because personalized
                        jewelry is made according to your requirements, once it has been made it cannot be sold to
                        others.</p>

                    <p class="m-b-0">For any further queries, please feel free to contact us at <a
                                href="mailto:service@motif.me" class="text-underLine">service@motif.me</a>.
                        Normally our service team will reply within24 hours, but during the busy season or long holidays,
                        it may take longer to respond. However, no emails will be left unanswered.
                    </p>
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
