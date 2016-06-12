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
                    <a class="btn btn-primary-outline btn-sm" id="address-edit">Edit</a>
                    <!-- 修改状态 -->
                    <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
                </article>

                <!-- 地址列表 -->
                <aside class="bg-white m-b-10x">
                @foreach($data['list'] as $addr)
                    <hr class="hr-base m-a-0">
                    <a href="/user/addrmod?addr={{base64_encode(json_encode($addr))}}">
                    <div class="addressList-container font-size-sm" id="primaryItem" data-address="" data-aid="101">
                         <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return" data-url-return="return" data-url-edit="edit">
                                <div>
                                    <div></div>
                                    <div>{{$addr['email']}}</div>
                                    <div>{{$addr['detail_address1']}}  @if(!empty($addr['detail_address2'])) {{$addr['detail_address2']}} @endif</div>
                                    <div>{{$addr['city']}}, {{$addr['zip']}} {{$addr['zip']}}</div>
                                    <div>{{$addr['country']}}</div>
                                    <div>@if(!empty($addr['telephone'])) {{$addr['telephone']}} @endif</div>
                                </div>
                            @if($addr['isDefault'])
                                 <span class="text-common p-r-20x">Primary</span>
                                 <div class="flex flex-alignCenter"><i class="iconfont icon-size-sm text-common del-icon"></i></div>
                            @endif
                        </div>
                    </div>
                    </a>
                @endforeach
                </aside>

                <aside class="bg-white">
                    <a class="flex flex-alignCenter text-primary p-a-15x" href="/user/addradd">
                        <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                        <span class="font-size-sm">Add a New Address</span>
                    </a>
                </aside>
                <aside class="p-a-15x">
                    <div class="btn btn-block btn-primary" data-role="submit">Continue</div>
                </aside>
            </section>

            <!-- 页脚 功能链接 start-->
            @include('footer')
            <!-- 页脚 功能链接 end-->
        </div>
    </div>

    <!-- 弹出选择 size color Engraving -->
    <!-- TODO remodal 有多余的样式 需要整理 -->
    <!-- 删除将要购买的商品 -->
    <!-- TODO remodal 有多余的样式 需要整理 -->
    <div class="remodal remodal-md modal-content" data-remodal-id="modal" id="modalDialog">
        <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
            Are you sure you want to remove <br> this item from your bag?
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
