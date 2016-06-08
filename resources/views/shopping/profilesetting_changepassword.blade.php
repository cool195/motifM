<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Change Password</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
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
            <!-- 修改密码 -->
            <section class="bg-minHeight">
                <form method="">
                    <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Change Password</strong></article>
                    <!-- 个人中心 sitting list -->
                    <fieldset class="bg-white">
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="Current Password">
                        <hr class="hr-base m-a-0">
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="New Password (6 characters min)">
                        <hr class="hr-base m-a-0">
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="Confirm Password">
                    </fieldset>
                    <div class="p-a-15x">
                        <a href="#" class="btn btn-primary btn-block btn-sm">Change</a>
                    </div>
                </form>
            </section>
            <!-- 页脚 功能链接 -->
            @include('footer')
        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
</html>
