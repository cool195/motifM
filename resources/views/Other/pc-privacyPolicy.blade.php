<!DOCTYPE html>
<html lang="en">
<head>
    <title>Privacy Policy</title>
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
            <header class="navbar-fixed-top" id="header">
                <nav class="navbar navbar-full bg-primary">
                    <ul class="nav navbar-primary" style="height: 44px;">
                        <li class="nav-item">
                        </li>
                        <li class="nav-item nav-logo">
                            <a  href="/daily">
                                <img class="motif-logo" src="/images/logo/logo.png"
                                     srcset="/images/logo/logo@2x.png 2x,/images/logo/logo@3x.png 3x"></a>
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>
                </nav>
            </header>
            @else
                <div class="body-container" style="padding-top:0px">
                    @endif
                            <!-- 隐私政策 -->
                    <section class="m-b-20x p-b-20x reserve-height">
                        <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Privacy Notice</strong>
                        </article>
                        <div class="bg-white">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">Thank you for visiting the privacy notice of Motif Group LLC
                                    (“MOTIF”, sometimes
                                    referred to as “we”, “our” and “us”). This notice (sometimes referred to as this
                                    “policy”) describes the types of information we may collect from you or that you may
                                    provide when you use our website (“Website”), any of our mobile applications
                                    (“Apps”) or our social media pages (“Social Media”, and together with our Website
                                    and Apps, “Our Services”), our practices regarding your information and how we will
                                    treat it.</p>
                                <p class="m-b-15x">We may change this policy from time to time. If we make any material
                                    changes to this
                                    policy, we will notify you only by posting an announcement on Our Services. Your
                                    continued use of Our Services after we make changes is deemed to be acceptance of
                                    those changes, so please check this policy periodically for updates.</p>

                                <p class="m-b-15x"><strong class="text-underLine">1. Information We May Collect About
                                        You and How We Collect It</strong></p>
                                <p class="m-b-15x">We may collect several types of information from and about you, including
                                    information:</p>
                                <p class="m-b-15x">(a) By which you may be personally identified, such as your name, address, email
                                    address, telephone number, photograph, credit card number or any other identifier
                                    allowing you to be contacted; and</p>
                                <p class="m-b-15x">(b) That is about you or your device, such as usage details, IP addresses and
                                    information collected through cookies (together with subdivision (a) above,
                                    “Personal Information”).</p>
                                <p class="m-b-15x">We may collect this information from a variety of sources, which may include:</p>
                                <p class="m-b-15x">(a) Directly from you if and when you provide it to us, by registering for or
                                    utilizing Our Services; </p>
                                <p class="m-b-15x">(b) Our official Social Media, including, but not limited to, Facebook and Instagram;
                                    and</p>
                                <p class="m-b-15x">(c) Automatically as you navigate through Our Services through automatic data
                                    collection technologies, such as Google Analytics. </p>


                                <p class="m-b-15x"><strong class="text-underLine">2. Information We Collect through
                                        Automatic Data Collection Technologies</strong></p>
                                <p class="m-b-15x">As you navigate through and interact with Our Services, we may use
                                    automatic data collection technologies that help us personalize and continually
                                    improve Our Services and your experience on Our Services. We may collect certain
                                    information about your devices, browsing actions and patterns, including:</p>
                                <p class="m-b-15x">(a) Details of your visits to Our Services, including traffic data, location data,
                                    logs and other communication data and the resources that you access and use on Our
                                    Services; and</p>
                                <p class="m-b-15x">(b) Information about your computer, tablet, mobile device and internet connection,
                                    including your IP address, operating system, browser type and unique identifier for
                                    your device. </p>
                                <p class="m-b-15x">The information that we may collect automatically is intended to be statistical data
                                    and may include Personal Information. As mentioned before, it helps us improve Our
                                    Services by delivering a better and more personalized experience, including by
                                    enabling us to:</p>
                                <p class="m-b-15x">(a) Estimate audience size and usage patterns;</p>
                                <p class="m-b-15x">(b) Store information about your preferences, allowing us to customize Our Services
                                    according to your individual interests in the future if appropriate; and</p>
                                <p class="m-b-15x">(c) Recognize you when you return to Our Services.</p>
                                <p class="m-b-15x">The technologies we may use for this automatic data collection may include:</p>
                                <p class="m-b-15x">(a) <strong>Cookies (or browser cookies)</strong>. Unless you have adjusted your
                                    browser setting so
                                    that it will refuse cookies, we may issue cookies when you direct your browser to
                                    Our Services. A cookie is a small file placed on the hard drive of your computer.
                                    You may refuse to accept browser cookies by activating the appropriate setting on
                                    your browser. However, if you select this setting you may be unable to access
                                    certain parts of Our Services.</p>
                                <p class="m-b-15x">(b) <strong>Flash Cookies</strong>. Certain features of Our Services may use local
                                    stored objects (or
                                    Flash cookies) to collect and store information about your preferences and
                                    navigation to, from and on Our Services. </p>
                                <p class="m-b-15x">California Business & Professions Code Section 22575(b) provides that California
                                    residents are entitled to know how we respond to “Do Not Track” browser settings or
                                    signals. We do not currently take actions to respond to Do Not Track signals. It is
                                    our view that a uniform technological standard has not yet been developed. We may
                                    adopt a standard once one is created.</p>

                                <p class="m-b-15x"><strong class="text-underLine">3. How We Use Your
                                        Information</strong></p>
                                <p class="m-b-15x">We use information that we collect or that you provide to us:</p>
                                <p class="m-b-15x">(a) To present Our Services to you;</p>
                                <p class="m-b-15x">(b) To provide you with information, products or services that you
                                    request from us;</p>
                                <p class="m-b-15x">(c) To fulfill any other purpose for which you provide it;</p>
                                <p class="m-b-15x">(d) To notify you about changes to Our Services or any products or
                                    services we offer;</p>
                                <p class="m-b-15x">(e) To allow you to participate in interactive features on Our
                                    Services;</p>
                                <p class="m-b-15x">(f) To publish our own marketing and promotional materials;</p>
                                <p class="m-b-15x">(g) In any other way we may describe when you provide the
                                    information; or</p>
                                <p class="m-b-15x">(h) For any other purpose with your consent.</p>
                                <p class="m-b-15x">We may also use your information to contact you about Our Services
                                    that may be of
                                    interest to you. If you do not want us to use your information in this way, please
                                    do not sign up for our subscription services. If you have already received emails
                                    through our subscription services, and you wish to discontinue the services, you may
                                    send us an email at service@motif.me stating your request.</p>

                                <p class="m-b-15x"><strong class="text-underLine">4. Disclosure of Your
                                        Information</strong></p>
                                <p class="m-b-15x">We may disclose Personal Information that we collect or you provide:
                                </p>
                                <p class="m-b-15x">(a) To fulfill the purpose for which you provide it;</p>
                                <p class="m-b-15x">(b) Within MOTIF (including its affiliates);</p>
                                <p class="m-b-15x">(c) To contractors, service providers and other third parties we use
                                    to support Our
                                    Services and who are bound by contractual obligations and/or applicable data privacy
                                    and security laws to keep your Personal Information confidential, including our
                                    third party service providers who process credit card payments and third parties who
                                    collect persistent identifiers on Our Services (including, for example, <a
                                            class="text-underLine" href="https://www.google.com/analytics/"> Google
                                        Analytics</a>, <a class="text-underLine"
                                                          href="https://mixpanel.com/">Mixpanel</a>, <a
                                            class="text-underLine" href="https://www.kochava.com/">Kochava</a> and <a
                                            class="text-underLine" href="https://blog.kissmetrics.com/">Kissmetrics</a>);
                                </p>
                                <p class="m-b-15x">NOTE: IF YOU DO NOT WANT YOUR PERSONAL INFORMATION TO BE REPORTED TO
                                    GOOGLE
                                    ANALYTICS, MIXPANEL, OR KISSMETRICS, YOU CAN INSTALL THE FOLLOWING: <a
                                            class="text-underLine" href="https://tools.google.com/dlpage/gaoptout">
                                        GOOGLE ANALYTICS
                                        OPT-OUT</a>; <a class="text-underLine" href="https://mixpanel.com/optout/">MIXPANEL
                                        OPT-OUT</a>; <a class="text-underLine"
                                                        href="https://www.kissmetrics.com/user-privacy/">KISSMETRICS
                                        OPT-OUT</a>. IF YOU DO NO WANT YOUR PERSONAL
                                    INFORMATION TO BE REPORTED TO KOCHAVA, PLEASE CONTACT US.</p>
                                <p class="m-b-15x">(d) To a buyer or other successor in interest in the event of a
                                    merger, divestiture,
                                    restructuring, reorganization, dissolution or other sale or transfer of some or all
                                    of our assets, whether as a going concern or as part of bankruptcy, liquidation or
                                    similar proceeding, in which Personal Information held by us about users is among
                                    the assets transferred;</p>
                                <p class="m-b-15x">(e) To publish our own marketing and promotional materials;</p>
                                <p class="m-b-15x">(f) For any other purpose disclosed by us when you provide the
                                    information; or</p>
                                <p class="m-b-15x">(g) For any other purpose with your consent.</p>
                                <p class="m-b-15x">We may also disclose your Personal Information:</p>
                                <p class="m-b-15x">(a) To comply with any court order, law or legal process, including
                                    to respond to any government or regulatory request;</p>
                                <p class="m-b-15x">(b) To enforce or apply our <a href="/termsconditions"
                                                                                  class="text-underLine"> Terms &
                                        Conditions</a> and other agreements,
                                    including for billing and collection purposes; or</p>
                                <p class="m-b-15x">(c) If we believe disclosure is necessary or appropriate to protect
                                    our rights, property or safety and that of others. </p>


                                <p class="m-b-15x"><strong class="text-underLine">5. Your California Privacy
                                        Rights</strong></p>
                                <p class="m-b-15x">California Civil Code Section § 1798.83 permits users of Our Services
                                    that are California residents to request certain information regarding our
                                    disclosure of Personal Information to third parties for their direct marketing
                                    purposes, if applicable. To make such a request, please send an email to
                                    service@motif.me. If you believe any of the information we possess about you is
                                    incorrect, please send an email to service@motif.me.
                                </p>

                                <p class="m-b-15x"><strong class="text-underLine">6. Children’s Privacy</strong></p>
                                <p class="m-b-15x">Our Services are not directed toward or intended for use by children
                                    under the age of 13, and we do not knowingly collect Personal Information from
                                    children under the age of 13.
                                </p>

                                <p class="m-b-15x"><strong class="text-underLine">7. Data Security </strong></p>
                                <p class="m-b-15x">We have implemented technological and security measures to reduce the
                                    risk of loss, misuse or unauthorized disclosure of your Personal Information.
                                    Although we implement such measures to protect your Personal Information, we cannot
                                    guarantee the security of your Personal Information transmitted to Our Services, or
                                    thereafter. Any transmission of Personal Information is at your own risk. It is
                                    important for you to protect against unauthorized access to your password and to
                                    your computer or mobile device. Be sure to sign-off when finished using a shared
                                    computer or mobile device, and you are strongly encouraged to use other reasonable
                                    measures to secure your sensitive information.
                                </p>

                                <p class="m-b-15x"><strong class="text-underLine">8. Links to Other Websites and
                                        Companies</strong></p>
                                <p class="m-b-15x">We may provide (and permit other parties to provide) links to other
                                    websites or resources. By use of Our Services, you acknowledge and agree that (a) we
                                    have no control of such websites and resources, (b) we are not responsible for the
                                    availability of such websites or resources, and (c) we do not endorse and are not
                                    responsible or liable for any content, advertising, products or other materials on
                                    or available from such websites or resources. You further acknowledge and agree that
                                    we shall not be responsible or liable, directly or indirectly, for any damage or
                                    loss caused or alleged to be caused by or in connection with use of or reliance on
                                    any such content, goods or services available on or through any such website or
                                    resource.
                                </p>

                                <p class="m-b-15x"><strong class="text-underLine">9. Social Media Pages</strong></p>
                                <p class="m-b-15x">We may have Social Media pages and/or accounts on Facebook, Twitter,
                                    Instagram and any other Social Media platforms, which permit you to post public
                                    messages or responses to articles, comments or other postings. You should be aware
                                    that by submitting such a posting, including any Personal Information in connection
                                    with it, it is likely to become public.
                                </p>
                                <p class="m-b-15x">We reserve the right to remove any posting or content in a posting on
                                    our Social Media pages at our sole and absolute discretion.
                                </p>

                                <p class="m-b-15x"><strong class="text-underLine">10. Contact Information and Refusal to
                                        Consent</strong></p>
                                <p class="m-b-15x">To ask questions or comment about this privacy notice and our privacy
                                    practices, including reviewing and requesting changes to any of your collected
                                    Personal Information, contact us at service@motif.me
                                </p>
                                <p class="m-b-0">If you do not consent to the collection, use and
                                    disclosure of your Personal Information, please do not provide us with Personal
                                    Information. If you have any additional questions, please contact us at the above
                                    email address or telephone number.
                                </p>
                            </div>
                        </div>

                    </section>
                    <!-- 页脚 功能链接 -->
                    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
                        <footer class="p-y-10x">
                            <div class="links-group container-fluid p-x-0 flex flex-fullJustified">
                                <a class="font-size-sm text-primary text-underLine" href="/pcprivacypolicy">Privacy Notice</a>
                                <a class="font-size-sm text-primary text-underLine" href="/pctermsservice">Terms & Conditions</a>
                            </div>
                            <div class="text-primary text-center font-size-sm p-t-5x">Copyright © 2016 Motif Group LLC. All rights reserved.</div>
                        </footer>
                    @endif
                </div>
        </div>
</body>
<script src="scripts/vendor.js"></script>
@include('global')
</html>
