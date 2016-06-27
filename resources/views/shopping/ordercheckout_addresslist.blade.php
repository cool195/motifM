<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Address List</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/orderCheckout-addressList.css">

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
            @include('navigator', ['pageScope'=>true])
            <section class="p-b-15x">
                <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter">
                    <span class="font-size-md text-main"><strong>Shipping Address</strong></span>
                    <a class="btn btn-primary-outline btn-sm" id="address-edit">Edit</a>
                    <!-- 修改状态 -->
                    <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
                </article>

                <!-- 地址列表 -->
                <aside class="bg-white m-b-10x">
                    @if(isset($data['list']))
                        @foreach($data['list'] as $addr)
                    <div class="addressList-container font-size-sm" id="primaryItem" data-address="{{ $addr['receiving_id'] }}">
                        @if(1 !== $addr['isDefault'])
                        <div class="addressList-delete switch" data-remodal-target="modal">
                            <i class="iconfont icon-delete icon-size-md text-warning"></i>
                        </div>
                        @endif
                        <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return" data-url-return="return" data-url-edit="edit">
                            <div>
                                <div>{{$addr['email']}}</div>
                                <div>{{$addr['detail_address1']}} @if(isset($addr['detail_address2'])) {{$addr['detail_address2']}} @endif</div>
                                <div>{{$addr['city']}}, {{$addr['state']}} {{$addr['zip']}}</div>
                                <div>{{$addr['country']}}</div>
                                <div>@if(isset($addr['telephone'])) {{$addr['telephone']}}  @endif</div>
                            </div>
                            <div class="flex flex-alignCenter">
                                @if(1 == $addr['isDefault']) <span class="text-common p-r-20x">Primary</span> @endif
                                <i class="iconfont icon-radio icon-size-sm text-common @if(1 == $addr['isDefault']) active @endif"></i>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                </aside>

                <aside class="bg-white">
                    <div class="flex flex-alignCenter text-primary p-a-15x" data-role="add" data-action="/cart/addradd">
                        <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                        <span class="font-size-sm">Add a New Address</span>
                    </div>
                </aside>
                <aside class="p-a-15x">
                    <div class="btn btn-block btn-primary" data-role="submit" data-action="/cart/ordercheckout">Continue</div>
                </aside>
            </section>

            <!-- 页脚 功能链接 -->
            @include('footer')
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
    <form id="infoForm" action="/cart/ordercheckout" method="get">
        <input type="hidden" name="aid" value="{{$aid}}">
        <input type="hidden" name="eid" value="{{$aid}}">
        @if(isset($input) && !empty($input))
            @foreach($input as $name => $value)
                <input type="hidden" name="{{$name}}" value="{{$value}}">
            @endforeach
        @endif
    </form>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout-addressList.js"></script>
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
