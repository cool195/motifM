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
                    <a class="btn btn-primary-outline btn-sm" href="#">Edit</a>
                    <!-- 修改状态 -->
                    <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
                </article>

                <!-- 地址列表 -->
                <aside class="bg-white m-b-10x">
                @foreach($data['list'] as $addr)
                    <hr class="hr-base m-a-0">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x" href="#">
                        <div class="flex flex-alignCenter">
                            <div class="p-r-15x"><i class="iconfont icon-delete icon-size-md text-warming"></i></div>
                            <address class="m-b-0">
                                <div>{{$addr['email']}}</div>
                                <div>{{$addr['detail_address1']}} </div>
                                <div>{{$addr['city']}}, {{$addr['zip']}} {{$addr['zip']}}</div>
                                <div>{{$addr['country']}}</div>
                                <div>@if(isset($addr['telephone'])) {{$addr['telephone']}}  @endif</div>
                            </address>
                        </div>
                        @if(1 == $addr['isDefault'])
                        <div class="flex flex-alignCenter"><span class="text-common p-r-20x">Primary</span><i class="iconfont icon-check icon-size-sm text-common"></i></div>
                        @endif
                        <input hidden name="aid" value="{{$addr['receiving_id']}}"></input>
                    </a>
                @endforeach
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
</body>
<script src="scripts/vendor.js"></script>
</html>
