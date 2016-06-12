<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Add Address</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/profileSetting-addAddress.css">

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
            <!-- 添加地址 -->
            <section class="p-b-20x">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Add New Address</strong></article>
                <form class="bg-white" id="addressInfo">
                    <!-- 个人中心 sitting list -->
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="name" type="text" placeholder="Full Name">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1" type="text" placeholder="Street1">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2" type="text" placeholder="Street2 (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="state" type="text" placeholder="State (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="city" type="text" placeholder="City">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="zip" type="text" placeholder="Zip code">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="text" placeholder="Phone (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="idnum" type="text" placeholder="IDnumber">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="">
                            <span>Country</span>
                            <div>
                                <span>中国（CN）</span>
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                <input type="text" name="country" hidden value="country_id">
                            </div>
                        </a>
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                            <span>Make Primary</span>
                            <div class="radio-checkBox">
                                <div class="radio-checkItem"></div>
                                <input type="radio" name="isd" id="address-default" hidden value="0" checked="checked">
                                <input type="radio" name="isd" id="address-primary" hidden value="1">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="container-fluid p-x-10x p-y-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="btn btn-primary-outline btn-block btn-sm" id="Cancel">Cancel</a>
                        </div>
                        <div class="col-xs-6">
                            <div class="btn btn-primary btn-block btn-sm" id="btn-addAddress">Confirm</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- 页脚 功能链接 -->
            @include('footer')
        </div>
    </div>

    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/profileSetting-addAddress.js"></script>
</html>
