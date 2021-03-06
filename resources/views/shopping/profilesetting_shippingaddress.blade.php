<!DOCTYPE html>
<html lang="en">
<head>
    <title>SHIPPING ADDRESS</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/profileSetting-addressList.css">

    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css">

</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
        <section class="p-b-15x reserve-height">
            <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter bg-title">
                <span class="font-size-md text-main"><strong>Shipping Address</strong></span>
                @if(!empty($data['list']))
                    <a class="btn btn-primary-outline btn-sm" id="address-edit">Edit</a>
                @endif
                <!-- 修改状态 -->
                <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
            </article>
            <hr class="hr-base m-a-0">

            <!-- 地址列表 -->
            <aside class="bg-white">
                @if(isset($data['list']))
                    @foreach($data['list'] as $addr)
                        <div class="addressList-container font-size-sm" id="primaryItem" data-address=""
                             data-aid="{{$addr['receiving_id']}}">
                            @if(1 !== $addr['isDefault'])
                                <div class="addressList-delete switch" data-remodal-target="modal">
                                    <i class="iconfont icon-delete icon-size-md text-primary"></i>
                                </div>
                            @endif
                            <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return"
                                 data-url-return="return" data-url-edit="edit"
                                 data-url="/user/addrmod/{{$addr['receiving_id']}}">
                                <div>
                                    <div>{{$addr['name']}}</div>
                                    <div>{{$addr['detail_address1']}}</div>
                                    @if(!empty($addr['detail_address2'])) <div>{{$addr['detail_address2']}}</div> @endif
                                    <div>{{$addr['city']}}, {{$addr['state']}} {{$addr['zip']}}</div>
                                    <div>{{$addr['country']}}</div>
                                    <div>@if(!empty($addr['telephone'])) {{$addr['telephone']}} @endif</div>
                                </div>

                                    <div class="flex flex-alignCenter">
                                        @if(1 == $addr['isDefault'])
                                            <span class="text-common p-r-20x">Default</span>
                                        @endif
                                        <i class="iconfont icon-size-sm text-common"></i>
                                    </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </aside>
            {{--<div class="hr-between"></div>--}}
            <hr class="hr-dark m-a-0">
            <aside class="bg-white">
                <a class="flex flex-alignCenter text-primary p-a-15x"
                   href="@if(empty($data['list'])){{'/user/addradd?first=1'}}@else{{'/user/addradd'}}@endif">
                    <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                    <span class="font-size-sm">Add New Address</span>
                </a>
            </aside>
            <hr class="hr-base m-a-0">
        </section>

        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
<div class="remodal remodal-md modal-content" data-remodal-id="modal" id="modalDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <div class="font-size-base">Remove Shipping Address</div>
        Are you sure you want to remove this address?
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/profileSetting-addressList.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
