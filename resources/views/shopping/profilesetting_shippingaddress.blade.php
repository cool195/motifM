<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Address List</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/profileSetting-addressList.css">

    <link rel="stylesheet" href="/styles/remodal.css">

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
            <section class="p-b-15x">
                <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter">
                    <span class="font-size-md text-main"><strong>Shipping Address</strong></span>
                    <a class="btn btn-sm btn-edit" id="btnEdit">Edit</a>
                </article>

                <!-- 地址列表 -->
                <aside class="bg-white m-b-10x" id="addressList">
                    <div class="flex flex-alignCenter p-x-15x p-y-10x">
                        <a class="p-r-15x delAddress" data-aid="111" data-remodal-target="modal"><i class="iconfont icon-delete icon-size-md text-warming" data-aid="111"></i></a>
                        <a class="flex flex-alignCenter flex-fullJustified flex-width font-size-sm text-primary" href="#">
                            <div class="flex flex-alignCenter">

                                <address class="m-b-0">
                                    <div>民李</div>
                                    <div>Beijing chao yang</div>
                                    <div>Beijing, AK 10000</div>
                                    <div>中国</div>
                                    <div>130 1105 1863</div>
                                </address>
                            </div>
                            <div class="flex flex-alignCenter"><span class="text-common p-r-20x">Primary</span><i class="iconfont icon-size-sm text-common del-icon"></i></div>
                        </a>
                    </div>
                    <hr class="hr-base m-a-0">
                    <div class="flex flex-alignCenter p-x-15x p-y-10x">
                        <a class="p-r-15x delAddress" data-remodal-target="modal"><i class="iconfont icon-delete icon-size-md text-warming" data-aid="222"></i></a>
                        <a class="flex flex-alignCenter flex-fullJustified flex-width font-size-sm text-primary" href="#">
                            <div class="flex flex-alignCenter">

                                <address class="m-b-0">
                                    <div>民李</div>
                                    <div>Beijing chao yang</div>
                                    <div>Beijing, AK 10000</div>
                                    <div>中国</div>
                                    <div>130 1105 1863</div>
                                </address>
                            </div>
                            <div class="flex flex-alignCenter"><i class="iconfont icon-size-sm text-common del-icon"></i></div>
                        </a>
                    </div>
                </aside>

                <aside class="bg-white">
                    <a class="flex flex-alignCenter text-primary p-a-15x" href="#">
                        <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                        <span class="font-size-sm">Add a New Address</span>
                    </a>
                </aside>
            </section>

            <!-- 页脚 功能链接 start-->
            @include('footer')
            <!-- 页脚 功能链接 end-->
        </div>
    </div>

    <!-- 删除送货地址列表中的地址 -->
    <div class="remodal remodal-md modal-content" data-remodal-id="modal" id="addressDialog">
        <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
            Are you sure you want to delete <br> this item from your address list?
        </div>
        <div class="btn-group flex">
            <div class="btn remodal-btn flex-width" data-remodal-action="confirm">Remove</div>
            <div class="btn remodal-btn flex-width" data-remodal-action="cancel">Cancel</div>
        </div>
    </div>

    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/profileSetting-addressList.js"></script>
</html>
