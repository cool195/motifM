<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    @include('head')
    <link rel="stylesheet" href="/styles/profileSetting-changePassword.css">

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
        <!-- 修改密码 -->
        <section class="reserve-height">
            <form method="" id="changePassword">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Change Password</strong></article>
                <!-- 个人中心 sitting list -->

                <div class="warning-info text-warning font-size-sm flex flex-alignCenter text-left p-x-15x m-b-10x off">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span>Sorry, this email has already been registered.</span>
                </div>
                <fieldset class="bg-white">
                    <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="Current Password" name="oldpw">
                    <hr class="hr-base m-a-0">
                    <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="New Password (6 characters min)" name="pw">
                    <hr class="hr-base m-a-0">
                    <input class="form-control form-control-block p-a-15x font-size-sm" type="password" placeholder="Confirm New Password" data-role="confirmPwd">
                </fieldset>
                <div class="p-a-15x">
                    <div href="#" class="btn btn-primary btn-block disabled" data-role="submit">Change Password</div>
                </div>
            </form>
        </section>
        <!-- 页脚 功能链接 start-->
        @include('footer')
        <!-- 页脚 功能链接 ends-->
    </div>
</div>

<!-- 提示成功修改密码 -->
<div class="remodal remodal-lg modal-content" data-remodal-id="changePwd-modal" id="changePwdDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <span class="font-size-base">Password Change Complete!</span><br>Please log
        in again!
    </div>
    <hr class="hr-base m-a-0">
    <div class="btn-group flex">
        <a href="" class="btn remodal-btn flex-width text-primary" id="confirmPwd">OK</a>
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/profileSetting-changePassword.js"></script>
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
