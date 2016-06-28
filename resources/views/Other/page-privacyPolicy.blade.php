<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Privacy Policy</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">


    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

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
    <div class="body-container">
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        @include('navigator')
    @endif
    <!-- 隐私政策 -->
        <section>
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Privacy Policy</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>SECTION 1 - WHAT DO WE DO WITH YOUR INFORMATION?</strong></p>
                    <p class="m-b-15x">When you purchase something from our store, as part of the buying and selling
                        process, we collect
                        the personal information you give us such as your name, address and email address.<br>
                        When you browse our store, we also automatically receive your computer’s internet protocol (IP)
                        address in order to provide us with information that helps us learn about your browser and
                        operating system.<br>
                        Email marketing (if applicable): With your permission, we may send you emails about our store,
                        new products and other updates.</p>

                    <p class="m-b-15x"><strong>SECTION 2 - CONSENT</strong></p>
                    <p class="m-b-15x">How do you get my consent?<br>
                        When you provide us with personal information to complete a transaction, verify your credit
                        card, place an order, arrange for a delivery or return a purchase, we imply that you consent to
                        our collecting it and using it for that specific reason only.<br>
                        If we ask for your personal information for a secondary reason, like marketing, we will either
                        ask you directly for your expressed consent, or provide you with an opportunity to say no.</p>
                    <p class="m-b-15x">How do I withdraw my consent?<br>
                        If after you opt-in, you change your mind, you may withdraw your consent for us to contact you,
                        for the continued collection, use or disclosure of your information, at anytime, by contacting
                        us at service@motif.com or mailing us at:<br>
                        <a href="#" class="text-underLine text-primary">Motif</a><br>
                        <a href="#" class="text-underLine text-primary">160 Greentree Drive, Suite #101, Dover, DE
                            19904.</a></p>

                    <p class="m-b-15x"><strong>SECTION 3 - DISCLOSURE</strong></p>
                    <p class="m-b-15x">We may disclose your personal information if we are required by law to do so or
                        if you violate
                        our Terms of Service.</p>

                    <p class="m-b-15x"><strong>SECTION 4 – PAYMENT</strong></p>
                    <p class="m-b-15x">If you choose a direct payment gateway to complete your purchase, then Motif.me
                        stores your
                        credit card data. It is encrypted through the Payment Card Industry Data Security Standard
                        (PCI-DSS). Your purchase transaction data is stored only as long as is necessary to complete
                        your purchase transaction. After that is complete, your purchase transaction information is
                        deleted.<br>
                        All direct payment gateways adhere to the standards set by PCI-DSS as managed by the PCI
                        Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American
                        Express and Discover.<br>
                        PCI-DSS requirements help ensure the secure handling of credit card information by our store and
                        its service providers.
                    </p>

                    <p class="m-b-15x"><strong>SECTION 5 - THIRD-PARTY SERVICES</strong></p>
                    <p class="m-b-15x">In general, the third-party providers used by us will only collect, use and
                        disclose your
                        information to the extent necessary to allow them to perform the services they provide to
                        us.<br>
                        However, certain third-party service providers, such as payment gateways and other payment
                        transaction processors, have their own privacy policies in respect to the information we are
                        required to provide to them for your purchase-related transactions.<br>
                        For these providers, we recommend that you read their privacy policies so you can understand the
                        manner in which your personal information will be handled by these providers.<br>
                        In particular, remember that certain providers may be located in or have facilities that are
                        located a different jurisdiction than either you or us. So if you elect to proceed with a
                        transaction that involves the services of a third-party service provider, then your information
                        may become subject to the laws of the jurisdiction(s) in which that service provider or its
                        facilities are located.<br>
                        As an example, if you are located in Canada and your transaction is processed by a payment
                        gateway located in the United States, then your personal information used in completing that
                        transaction may be subject to disclosure under United States legislation, including the Patriot
                        Act.<br>
                        Once you leave our store’s website or are redirected to a third-party website or application,
                        you are no longer governed by this Privacy Policy or our website’s Terms of Service.
                    </p>
                    <p class="m-b-15x">Links<br>
                        When you click on links on our store, they may direct you away from our site. We are not
                        responsible for the privacy practices of other sites and encourage you to read their privacy
                        statements.<br>
                        Google analytics:<br>
                        Our store uses Google Analytics to help us learn about who visits our site and what pages are
                        being looked at.
                    </p>

                    <p class="m-b-15x"><strong>SECTION 6 - SECURITY</strong></p>
                    <p class="m-b-15x">To protect your personal information, we take reasonable precautions and follow
                        industry best
                        practices to make sure it is not inappropriately lost, misused, accessed, disclosed, altered or
                        destroyed.<br>
                        If you provide us with your credit card information, the information is encrypted using secure
                        socket layer technology (SSL) and stored with a AES-256 encryption. Although no method of
                        transmission over the Internet or electronic storage is 100% secure, we follow all PCI-DSS
                        requirements and implement additional generally accepted industry standards.
                    </p>

                    <p class="m-b-15x"><strong>SECTION 7 - COOKIES</strong></p>
                    <p class="m-b-15x">A cookie is a piece of text stored by a User’s web browser, they enable the
                        browser to remember
                        passwords, orders and preferences when visiting a website. We use cookies to save your
                        preferences, process shopping cart items and design scoring.
                    </p>

                    <p class="m-b-15x"><strong>SECTION 8 - AGE OF CONSENT</strong></p>
                    <p class="m-b-15x">By using this site, you represent that you are at least the age of majority in
                        your state or
                        province of residence, or that you are the age of majority in your state or province of
                        residence and you have given us your consent to allow any of your minor dependents to use this
                        site.
                    </p>

                    <p class="m-b-15x"><strong>SECTION 9 - CHANGES TO THIS PRIVACY POLICY</strong></p>
                    <p class="m-b-15x">We reserve the right to modify this privacy policy at any time, so please review
                        it frequently.
                        Changes and clarifications will take effect immediately upon their posting on the website. If we
                        make material changes to this policy, we will notify you here that it has been updated, so that
                        you are aware of what information we collect, how we use it, and under what circumstances, if
                        any, we use and/or disclose it.<br>
                        If our store is acquired or merged with another company, your information may be transferred to
                        the new owners so that we may continue to sell products to you.
                    </p>

                    <p class="m-b-15x"><strong>QUESTIONS AND CONTACT INFORMATION</strong></p>
                    <p class="m-b-15x">If you would like to: access, correct, amend or delete any personal information
                        we have about
                        you, register a complaint, or simply want more information contact our Privacy Compliance
                        Officer at service@motif.me or by mail at
                    </p>
                    <p class="m-b-15x text-underLine"><strong>Motif<br>
                            [Re: Privacy Compliance Officer]<br>
                            160 Greentree Drive, Suite #101, Dover, DE 19904.</strong>
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
