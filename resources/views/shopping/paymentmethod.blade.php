<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Payment Methods</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">


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
    <!-- 支付方式 列表 -->
        <section>
            <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter">
                <span class="font-size-md text-main"><strong>Payment Methods</strong></span>
                <a class="btn btn-primary-outline btn-sm" href="#">Edit</a>
                <!-- 修改状态 -->
                <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
            </article>
            <!-- 支付方式列表 list -->
            <!-- 没有绑定支付方式 状态 -->
            <aside class="bg-white m-b-10x">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x" href="#">
                    <div class="font-size-sm text-primary">
                        <span class="p-r-15x"><img src="images/payment/icon-Paypal.png"
                                                   srcset="/images/payment/icon-Paypal@2x.png 2x,/images/payment/icon-Paypal@3x.png 3x"
                                                   alt=""></span>
                        <span>Paypal</span></div>
                    <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                </a>
            </aside>
            <aside class="bg-white m-b-10x">
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x" href="#">
                    <div class="font-size-sm text-primary">
                        <span class="p-r-15x"><img src="/images/payment/icon-card.png"
                                                   srcset="/images/payment/icon-card@2x.png 2x,/images/payment/icon-card@3x.png 3x"
                                                   alt=""></span>
                        <span>Direct debit/credit card</span></div>
                    <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                </a>
            </aside>

            <!-- 已绑定支付方式 状态 -->
            <aside class="bg-white m-b-10x">
                <div class="flex flex-alignCenter font-size-sm text-primary p-y-10x p-x-15x">
                    <div class="p-r-15x"><i class="iconfont icon-delete icon-size-md text-warning"></i></div>
                    <div class="font-size-sm text-primary">
                        <span class="p-r-15x"><img src="images/payment/icon-Paypal-active.png"
                                                   srcset="/images/payment/icon-Paypal-active@2x.png 2x,/images/payment/icon-Paypal-active@3x.png 3x"
                                                   alt=""></span>
                        <span>7668665121@qq.com</span></div>
                </div>
            </aside>
            <aside class="bg-white m-b-10x">
                <div class="flex flex-alignCenter font-size-sm text-primary p-a-15x">
                    <div class="p-r-15x"><i class="iconfont icon-delete icon-size-md text-warning"></i></div>
                    <div class="font-size-sm text-primary">
                        <span class="p-r-15x"><img src="images/payment/icon-americanexpress.png"
                                                   srcset="/images/payment/icon-americanexpress@2x.png 2x,/images/payment/icon-americanexpress@3x.png 3x"
                                                   alt=""></span>
                        <span>American Express ending 5155</span></div>
                </div>
                <hr class="hr-base m-a-0">
                <div class="bg-white">
                    <a class="flex flex-alignCenter text-primary p-a-15x" href="#">
                        <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                        <span class="font-size-sm">Add a New Card</span>
                    </a>
                </div>
            </aside>

        </section>

        <div class="">
            <div class="btn btn-block btn-primary" id="paypal">按钮</div>
            <script src="https://js.braintreegateway.com/js/braintree-2.24.1.min.js"></script>
        </div>
        <!-- 页脚 功能链接 -->
    @include('footer')
    <!-- 页脚 功能链接 -->
    </div>
</div>
</body>
<script src="/scripts/vendor.js"></script>
<script>
    var token = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJjZTRjNzVjZTkwMjRiNGVkMTYxMzlmNTlmODNiYmVmMjRmNDFjMjZjM2U3YjMyZmE0YzI5YzdmMjJiNDAyOTQ0fGNyZWF0ZWRfYXQ9MjAxNi0wNi0xM1QxMDo1NDozMy4wMzcxMDk3ODArMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";

    braintree.setup(token, "custom", {
        paypal: {
            singleUse: true,// 沙盒系统需要字段
            amount: 10.00, // 沙盒系统需要字段
            currency: 'USD',// 沙盒系统需要字段
            locale: 'en_us',// 沙盒系统需要字段
            headless: true
        },
        onReady: function (integration) {
            checkout = integration;
        },
        onPaymentMethodReceived: function (payload) {
            console.info('payload : ');
            console.info(payload);

            openLoading();
            // TODO
            $.ajax({
                url: '/braintree',
                type: 'POST',
                data: {nonc: payload.nonc}
            })
                    .done(function (data) {
                        if (data.success) {
                            console.log("success");
                        }
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        closeLoading();
                        console.log("complete");
                    });

        }
    });

    $('#paypal').on('click', function (event) {
        event.preventDefault();
        checkout.paypal.initAuthFlow();
    });
</script>
</html>
