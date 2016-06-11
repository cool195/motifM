<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Change Profile</title>
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
            <!-- 个人中心 修改 Profile -->
            <section class="bg-minHeight">
                <form method="">
                    <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Change Profile</strong>
                        <div class="text-common font-size-sm p-t-10x">{{$user['login_email']}}</div>
                    </article>
                    <fieldset class="bg-white">
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="text" placeholder="{{$user['nickname']}}">
                    </fieldset>
                    <div class="p-a-15x">
                        <a href="#" class="btn btn-primary btn-block btn-sm">Change</a>
                    </div>
                </form>
            </section>

            <!-- 页脚 功能链接 -->
            @include('footer')
            <!-- 页脚 功能链接 -->

        </div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>
</html>
