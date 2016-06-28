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
@include('check.tagmanager')
    <!-- 外层容器 -->
    <div id="body-content">
        <!-- 展开的汉堡菜单 -->
        @include('nav')
        <!-- 主体内容 -->
        <div class="body-container">
            @include('navigator', ['pageScope'=>true])
            <!-- 个人中心 修改 Profile -->
            <section class="bg-minHeight">
                <form method="" id="changeProfile">
                    <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Change Profile</strong>
                        <div class="text-common font-size-sm p-t-10x">{{$user['login_email']}}</div>
                    </article>
                    <fieldset class="bg-white">
                        <input class="form-control form-control-block p-a-15x font-size-sm" id="nick" name="nick" type="text" value="{{$user['nickname']}}" placeholder="{{$user['nickname']}}">
                    </fieldset>
                    <div class="p-a-15x">
                        <div class="btn btn-primary btn-block btn-sm" data-role="submit">Change</div>
                    </div>
                </form>
            </section>

            <!-- 页脚 功能链接 -->
            @include('footer')
            <!-- 页脚 功能链接 -->

        </div>
    </div>
    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>

</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/profileSetting-changeProfile.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
