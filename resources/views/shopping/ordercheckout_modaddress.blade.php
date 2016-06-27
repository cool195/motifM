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
            @include('navigator', ['pageScope'=>true])
            <!-- 添加地址 -->
            <section class="p-b-20x">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Modify Address</strong></article>
                <form class="bg-white" id="addressInfo" method="get" action="/cart/countrylist">
                    <!-- 个人中心 sitting list -->
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="email" type="text" value="{{$input['email']}}" placeholder="Email Address">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="name" type="text" value="{{$input['name']}}" placeholder="Full Name">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1" type="text" value="{{$input['detail_address1']}}" placeholder="Street1">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2" type="text" value="{{$input['detail_address2']}}" placeholder="Street2 (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="state" type="text" value="{{$input['state']}}" placeholder="State (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="city" type="text" value="{{$input['city']}}" placeholder="City">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="zip" type="text" value="{{$input['zip']}}" placeholder="Zip code">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="text" value="{{$input['telephone']}}" placeholder="Phone (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" id="country">
                            <span>Country</span>
                            <div>
                                <span>{{ $input['country']  }}</span>
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                <input type="text" name="country" hidden value="{{$input['country']}}">
                            </div>
                        </div>
                    </fieldset>
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                            <span>Make Primary</span>
                            <div class="radio-checkBox @if(1 == $input['isDefault']) open @endif">
                                <div class="radio-checkItem"></div>
                                @if(1 == $input['isDefault'])
                                    <input type="radio" name="isd" id="address-default" hidden value="0">
                                    <input type="radio" name="isd" id="address-primary" hidden value="1" checked="checked">
                                @else
                                    <input type="radio" name="isd" id="address-default" hidden value="0" checked="checked">
                                    <input type="radio" name="isd" id="address-primary" hidden value="1" >
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <input name="aid" value="{{$input['receiving_id']}}"  type="hidden" >
                    <input name="route" value="/cart/addrmod/" type="hidden">
                    @if(isset($checkout) && !empty($checkout))
                        @foreach($checkout as $name => $value)
                            @if("aid" !== $name)
                            <input type="hidden" name="{{$name}}" value="{{ $value }}">
                            @endif
                        @endforeach
                    @endif
                </form>
                <div class="container-fluid p-x-10x p-y-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <div data-action="/cart/addresslist" class="btn btn-primary-outline btn-block btn-sm" id="Cancel">Cancel</div>
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
    <form id="infoForm" action="/cart/addresslist" method="get" hidden>
        @if(isset($checkout) && !empty($checkout))
            @foreach($checkout as $name => $value)
                <input type="hidden" name="{{$name}}" value="{{ $value }}">
            @endforeach
        @endif
    </form>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout-changeAddress.js"></script>

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
