<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Cancellation Policy</title>
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
@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
@endif
<!-- 主体内容 -->
    <div class="body-container">
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        @include('navigator')
    @endif
    <!-- 取消政策 -->
        <section>
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Cancellation Policy</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x">Orders, except for personalized items, can be cancelled at no charge up until
                        shipment. </p>
                    <p class="m-b-15x">Generally, we will send the items out within 1-3 days of receiving payment, so
                        please submit the
                        cancellation request to customer service within 24 hours of placing your order. </p>
                    <p class="m-b-15x">Restocking/processing fees may apply to cancellations if the request is submitted
                        after 24 hours
                        (even if the item has not been shipped). </p>
                    <p class="m-b-15x">Orders that have already been shipped cannot be cancelled and will be treated as
                        returns.</p>
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
</html>
