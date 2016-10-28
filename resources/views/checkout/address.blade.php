<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet"
          href="{{env('CDN_Static')}}/styles/profileSetting-addAddress.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet"
          href="{{env('CDN_Static')}}/styles/orderCheckout-addressList.css{{'?v='.config('app.version')}}">
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

        <div class="checkout-container" id="addressFrom" data-url="{{'/checkout/shipping?from='.$from}}">
            <!-- 1.SHIPPING 添加/修改地址 -->
            <div class="pageview shipping-editorAddress @if(empty($address)) active @endif" id="shipping-editorAddress"
                 data-aid="">
                <section class="p-b-20x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title"><strong>SHIP TO</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-y-10x hidden-xs-up">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs"></span>
                    </div>
                    <form class="bg-white" id="addAddressForm" name="addressInfo">
                        <!-- checkout sitting list -->
                        <fieldset>
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option"
                                 id="btn-toCountryList" data-type="{{ $country['commonlist'][0]['child_type']}}"
                                 data-id="{{ $country['commonlist'][0]['country_id']}}"
                                 data-childlabel="{{ $country['commonlist'][0]['child_label']}}"
                                 data-zipcode="{{ $country['commonlist'][0]['zipcode_label']}}">
                                <span>Country</span>
                                <div>
                                    <span id="countryName" data-oldcountry="{{ $country['commonlist'][0]['country_name_en'] }}">{{ $country['commonlist'][0]['country_name_en'] }}</span>
                                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                    <input type="text" name="country" hidden
                                           value="{{$country['commonlist'][0]['country_name_en']}}">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <input name="email" type="hidden" data-role="email"
                                   value="{{Session::get('user.login_email')}}"
                                   placeholder="Email Address">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="name" type="text"
                                   maxlength="32" data-optional="false" data-role="name"
                                   value="" placeholder="Name">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1" type="text"
                                   data-optional="false" data-role="street"
                                   value="" placeholder="Street1">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2" type="text"
                                   data-optional="true" value=""
                                   placeholder="Street2 (optional)">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="city" type="text"
                                   data-optional="false" data-role="city"
                                   value="" placeholder="City">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <!-- state -->
                        <fieldset>
                            <div class="state-info">
                            </div>
                        </fieldset>

                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="zip" type="text"
                                   maxlength="10" data-optional="false" data-role="zip code"
                                   value=""
                                   placeholder="Zip Code">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="tel"
                                   maxlength="20" data-optional="false" data-role="Phone"
                                   value="" placeholder="Phone">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset id="makePrimary">
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                                 href="#">
                                @if(empty($address))
                                    <span>Default Address</span>
                                    <input type="radio" name="isd" id="address-default" hidden value="1" checked="checked">
                                @else
                                    <span>Make Default</span>
                                    <div class="radio-checkBox open">
                                        <div class="radio-checkItem"></div>
                                        <input type="radio" name="isd" id="address-default" hidden value="0">
                                        <input type="radio" name="isd" id="address-primary" hidden value="1" checked="checked">
                                    </div>
                                @endif

                            </div>
                            <hr class="hr-base m-a-0">
                        </fieldset>
                    </form>
                    <!-- Done 按钮 -->
                    <div class="container-fluid p-x-10x p-y-15x">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn btn-primary-outline btn-block" id="btn-cancelEditorAddress">Cancel</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn btn-primary btn-block" id="btn-submitEditorAddress">Done</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- 1.SHIPPING 地址列表/选择地址 -->
            <div class="pageview shipping-chooseAddress @if(!empty($address)) active @endif"
                 id="shipping-chooseAddress">

                <section class="p-b-15x reserve-height">
                    <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter bg-title">
                        <span class="font-size-md text-main"><strong>Shipping Address</strong></span>
                        <a class="btn btn-primary-outline btn-sm" id="address-edit">Edit</a>
                        <!-- 修改状态 -->
                        <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
                    </article>
                    <hr class="hr-base m-a-0">
                    <!-- 地址列表 -->
                    <aside class="bg-white">
                        @foreach($address as $value)
                            <div class="addressList-container font-size-sm" id=""
                                 data-address="{{$value['receiving_id']}}"
                                 data-aid="{{$value['receiving_id']}}">
                                @if(1 !== $value['isDefault'])
                                    <div class="addressList-delete switch" data-remodal-target="modal">
                                        <i class="iconfont icon-delete icon-size-md text-warning"></i>
                                    </div>
                                @endif
                                <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return"
                                     data-url-return="return" data-url-edit="edit" data-url="/user/addrmod/503">
                                    <div>
                                        @if($value['isDefault']==1)
                                            <div class="text-common">Default Shipping Address</div>
                                        @endif
                                        <div>{{$value['name']}}</div>
                                        <div>{{$value['detail_address1']}} {{$value['detail_address2']}}</div>
                                        <div>{{$value['city']}} {{$value['state']}} {{$value['zip']}}</div>
                                        <div>{{$value['country']}}</div>
                                        <div>{{$value['telephone']}}</div>
                                    </div>
                                    <div class="flex flex-alignCenter">
                                        @if($value['isDefault']==1)
                                            <span class="text-common p-r-10x">Default</span>
                                        @endif
                                        <i class="iconfont icon-radio icon-size-sm text-common @if(Session::get('user.checkout.address.receiving_id')==$value['receiving_id']) active @endif"></i>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </aside>
                    <div class="hr-between"></div>
                    <aside class="bg-white">
                        <div class="flex flex-alignCenter text-primary p-a-15x" id="btn-toAddAddress">
                            <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                            <span class="font-size-sm">Add New Address</span>
                        </div>
                    </aside>
                    <hr class="hr-base m-a-0">
                    {{--<aside class="p-a-15x">--}}
                        {{--<div class="btn btn-block btn-primary" data-url="{{'/checkout/shipping'}}" id="submit-address">Continue</div>--}}
                    {{--</aside>--}}
                </section>

                <!-- 删除地址 确认框 -->
                <div class="remodal remodal-md modal-content" data-remodal-id="modal" id="modalDialog" data-address="">
                    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
                        <div class="font-size-base">Remove Shipping Address</div>
                        Are you sure you want to remove this address?
                    </div>
                    <div class="btn-group flex">
                        <div class="btn remodal-btn flex-width" data-remodal-action="confirm">Remove</div>
                        <div class="btn remodal-btn flex-width" data-remodal-action="cancel">Cancel</div>
                    </div>
                </div>
            </div>
            <!-- 选择 country -->
            <div class="pageview shipping-chooseCountry" id="shipping-chooseCountry">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter bg-title">
                        <span class="font-size-md text-main"><strong>Select Country</strong></span>
                        <a class="btn btn-primary-outline btn-sm" id="cancel-country">Cancel</a>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">

                        @foreach($country['commonlist'] as $value)
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-15x country-item"
                                 data-cid="{{$value['country_id']}}" data-cname="{{$value['country_name_en']}}"
                                 data-type="{{$value['child_type']}}" data-childlabel="{{$value['child_label']}}"
                                 data-zipcode="{{$value['zipcode_label']}}">
                                <span>{{$value['country_name_en']}}</span>
                                <i class="iconfont icon-check icon-size-sm text-common"></i>
                            </div>
                            <hr class="hr-base m-a-0">
                        @endforeach

                    </aside>
                    <div class="p-t-10x bg-title"></div>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">

                        @foreach($country['list'] as $value)
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x country-item"
                                 data-cid="{{$value['country_id']}}" data-cname="{{$value['country_name_en']}}"
                                 data-type="{{$value['child_type']}}" data-childlabel="{{$value['child_label']}}"
                                 data-zipcode="{{$value['zipcode_label']}}">
                                <span>{{ $value['country_name_en'] }}</span>
                                <i class="iconfont icon-check icon-size-sm text-common"></i>
                            </div>
                            <hr class="hr-base">
                        @endforeach

                    </aside>
                </section>
            </div>
            <!-- 选择 state -->
            <div class="pageview shipping-chooseState" id="shipping-chooseState">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter bg-title">
                        <span class="font-size-md text-main"><strong>Select State</strong></span>
                        <a class="btn btn-primary-outline btn-sm" id="cancel-state">Cancel</a>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white statelist-info"></aside>
                </section>
            </div>

            <!-- loading -->
            <div class="loading loading-screen loading-switch loading-hidden" id="loading">
                <div class="loader loader-screen"></div>
            </div>
        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/checkout.js{{'?v='.config('app.version')}}"></script>
@include('global')

<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</html>
