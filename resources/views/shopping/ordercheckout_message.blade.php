<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Checkout Message</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/orderCheckout-message.css">

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
            <!-- 提交备注 表单 -->
            <section class="m-b-20x">
                <form method="">
                    <fieldset>
                        <div class="message-info">
                <textarea class="form-control form-control-block p-a-15x font-size-sm" placeholder="Message" rows="12"></textarea>
                            <span class="message-wordNumber font-size-sm text-primary">0/1000</span>
                        </div>
                    </fieldset>
                    <div class="p-a-15x">
                        <button class="btn btn-primary btn-block btn-sm" type="submit">Continue Shopping</button>
                    </div>
                </form>
            </section>

<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
</html>
