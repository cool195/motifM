<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Profile</title>
    @include('head')

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
            <section class="reserve-height">
                <form method="" id="changeProfile">
                    <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Edit Profile</strong>
                        <div class="text-common font-size-sm p-t-10x">{{$user['login_email']}}</div>
                    </article>
                    <fieldset class="bg-white">
                        <input class="form-control form-control-block p-a-15x font-size-sm" id="nick" name="nick" type="text" value="{{$user['nickname']}}" placeholder="{{$user['nickname']}}">
                    </fieldset>
                    <div class="p-a-15x">
                        <div class="btn btn-primary btn-block" data-role="submit">Save</div>
                    </div>
                </form>
            </section>

            <!-- 页脚 功能链接 -->
            @include('footer')
            <!-- 页脚 功能链接 -->

        </div>
    </div>
<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden" id="loading">
    <div class="loader loader-screen"></div>
</div>
<!-- 用户修改成功后的提示 -->
<div class="loading loading-screen loading-transprant loading-hidden" id="success">
    <div class="loading-modal">
        <div class="">
            <img class="img-fluid m-x-auto" src="/images/icon-success.png"
                 srcset="/images/icon-success@2x.png 2x, /images/icon-success@3x.png 3x">
        </div>
        <div class="text-white font-size-md text-center m-t-10x">Update succeeded!</div>
    </div>
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
