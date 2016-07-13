<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Address</title>
    @include('head')
    <link rel="stylesheet" href="/styles/profileSetting-addAddress.css">


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
            <!-- 添加地址 -->
            <section class="p-b-20x reserve-height">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Modify Address</strong></article>
                <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x hidden-xs-up">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-sm"></span>
                </div>
                <form class="bg-white" id="addressInfo" method="get" action="/user/countrylist">
                    <!-- 个人中心 sitting list -->
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="false" data-role="email" name="email" type="text" value="{{$input['email']}}" placeholder="Email Address">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="false" data-role="name" name="name" type="text" value="{{$input['name']}}" placeholder="Full Name">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="false" data-role="street" name="addr1" type="text" value="{{$input['detail_address1']}}" placeholder="Street1">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="true" name="addr2" type="text" value="{{$input['detail_address2']}}" placeholder="Street2 (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="false" data-role="city" name="city" type="text" value="{{$input['city']}}" placeholder="City">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" data-optional="true" name="state" name="state" type="text" value="{{$input['state']}}" placeholder="State (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" maxlength="10" data-optional="false" data-role="zip code" name="zip" type="text" value="{{$input['zip']}}" placeholder="Zip code">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" maxlength="20" data-optional="true" name="tel" type="text" value="{{$input['telephone']}}" placeholder="Phone (optional)">
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
                    <input name="route" value="/user/addrmod/{{$input['receiving_id']}}" type="hidden">
                </form>
                <div class="container-fluid p-x-10x p-y-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="/user/shippingaddress" class="btn btn-primary-outline btn-block" id="Cancel">Cancel</a>
                        </div>
                        <div class="col-xs-6">
                            <div class="btn btn-primary btn-block" id="btn-addAddress">Confirm</div>
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

<script src="/scripts/profileSetting-changeAddress.js"></script>
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
