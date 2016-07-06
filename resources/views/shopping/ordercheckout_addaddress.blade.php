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
        @include('nav', ['pageScope'=>true])
        <!-- 主体内容 -->
        <div class="body-container">
            @include('navigator')
            <!-- 添加地址 -->
            <section class="p-b-20x">
                <article class="p-x-15x p-y-10x font-size-md text-main"><strong>Add New Address</strong></article>
                <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x hidden-xs-up">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span class="font-size-sm"></span>
                </div>
                <form class="bg-white" id="addressInfo" name="addressInfo" method="get" action="/cart/countrylist">
                    <!-- 个人中心 sitting list -->
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="email" type="text" data-optional="false" data-role="email" value="{{!empty($input['email']) ? $input['email'] : Session::get('user.login_email')}}" placeholder="Email Address">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="name" type="text" maxlength="32" data-optional="false" data-role="name" value="{{ !empty($input['name']) ? $input['name'] : "" }}" placeholder="Your Name">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1" type="text" data-optional="false" data-role="street"  value="{{!empty($input['addr1']) ? $input['addr1'] : ""}}" placeholder="Street1">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2" type="text" data-optional="true" value="{{!empty($input['addr2']) ? $input['addr2'] : ""}}" placeholder="Street2 (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="city" type="text" data-optional="false" data-role="city" value="{{!empty($input['city']) ? $input['state'] : ""}}" placeholder="City">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="state" type="text" data-optional="true" value="{{!empty($input['state']) ? $input['state'] : ""}}" placeholder="State (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="zip" type="tel" maxlength="10" data-optional="false" data-role="zip code" value="{{ !empty($input['zip']) ? $input['zip'] : "" }}" placeholder="Zip Code">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="tel" maxlength="20" data-optional="true" value="{{!empty($input['tel']) ? $input['tel'] : ""}}" placeholder="Phone (optional)">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" id="country">
                        <span>Country</span>
                            <div>
                                <span>@if(!empty($country)) {{ $country['country_name_en'] }}  @endif</span>
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                <input type="text" name="country" hidden value="@if(!empty($country)) {{$country['country_name_en']}} @endif">
                            </div>
                        </div>
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <fieldset>
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                            <span>Make Primary</span>
                            <div class="radio-checkBox @if($first || 1 == $input['isd']) open @endif">
                                <div class="radio-checkItem"></div>
                                @if($first || 1 == $input['isd'])
                                    <input type="radio" name="isd" id="address-default" hidden value="0">
                                    <input type="radio" name="isd" id="address-primary" hidden value="1" checked="checked">
                                @else
                                    <input type="radio" name="isd" id="address-default" hidden value="0" checked="checked">
                                    <input type="radio" name="isd" id="address-primary" hidden value="1" >
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="route" value="/cart/addradd">
                    @if(isset($checkout) && !empty($checkout))
                        @foreach($checkout as $name => $value)
                            <input type="hidden" name="{{$name}}" value="{{ $value }}">
                        @endforeach
                    @endif
                </form>
                <div class="container-fluid p-x-10x p-y-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <div data-action="/cart/addresslist" class="btn btn-primary-outline btn-block btn-sm" id="Cancel">Cancel</div>
                        </div>
                        <div class="col-xs-6">
                            <div class="btn btn-primary btn-block btn-sm disabled" id="btn-addAddress">Save</div>
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

<script src="/scripts/orderCheckout-addAddress.js"></script>
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
