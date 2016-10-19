<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/profileSetting-addAddress.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout-addressList.css{{'?v='.config('app.version')}}">
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

        <div class="checkout-container">

            <!-- 1.SHIPPING 添加/修改地址 -->
            <div class="pageview shipping-editorAddress @if(empty($address)) active @endif" id="shipping-editorAddress">
                <section class="p-b-20x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title"><strong>Add New Address</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x hidden-xs-up">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs"></span>
                    </div>
                    <form class="bg-white" id="addressInfo" name="addressInfo" method="get" action="/cart/countrylist">
                        <!-- 个人中心 sitting list -->
                        <fieldset>
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option"
                                 id="btn-toCountryList">
                                <span>Country</span>
                                <div>
                                    <span>{{ $country['country_name_en'] }}</span>
                                    <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                    <input type="text" name="country" hidden value="{{$country['country_name_en']}}">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <input name="email" type="hidden" data-optional="true" data-role="email"
                                   value="{{!empty($input['email']) ? $input['email'] : Session::get('user.login_email')}}"
                                   placeholder="Email Address">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="name" type="text"
                                   maxlength="32" data-optional="false" data-role="name"
                                   value="{{ !empty($input['name']) ? $input['name'] : "" }}" placeholder="Name">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1" type="text"
                                   data-optional="false" data-role="street"
                                   value="{{!empty($input['addr1']) ? $input['addr1'] : ""}}" placeholder="Street1">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2" type="text"
                                   data-optional="true" value="{{!empty($input['addr2']) ? $input['addr2'] : ""}}"
                                   placeholder="Street2 (optional)">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="city" type="text"
                                   data-optional="false" data-role="city"
                                   value="{{$input['city']}}" placeholder="City">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input type="hidden" name="countryid" value="{{ $country['country_id'] }}">
                            <input type="hidden" name="countryState" value="{{ base64_encode(json_encode($country)) }}">
                            @if($country['child_type']==0)
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="state"
                                       type="text"
                                       data-optional="true"
                                       value="{{$state['state_name_sn']}}"
                                       placeholder="{{$country['child_label']}}">
                            @elseif($country['child_type']==1)
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="state"
                                       type="text"
                                       data-optional="false" value="{{$state['state_name_sn']}}" data-role="State"
                                       placeholder="{{$country['child_label']}}">
                            @else
                                <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option"
                                     id="stateselect">
                                    <span>{{ $country['child_label'] }}</span>
                                    <div>
                                        <span>{{ $state['state_name_sn'] }}</span>
                                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                        <input type="text" name="state" data-optional="false" hidden data-role="State"
                                               value="{{$state['state_name_sn']}}">
                                    </div>
                                    <div class="bg-option bg-country"></div>
                                </div>
                            @endif
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="zip" type="text"
                                   maxlength="10" data-optional="false" data-role="zip code"
                                   value="{{ !empty($input['zip']) ? $input['zip'] : "" }}"
                                   placeholder="{{$country['zipcode_label']}}">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="tel"
                                   maxlength="20" data-optional="false" data-role="Phone"
                                   value="{{!empty($input['tel']) ? $input['tel'] : ""}}" placeholder="Phone">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x"
                                 href="#">
                                <span>Make Default</span>
                                <div class="@if(!$first)radio-checkBox @endif @if($first || 1 == $input['isd']) open @endif">
                                    <div class="radio-checkItem"></div>
                                    @if($first || 1 == $input['isd'])
                                        <input type="radio" name="isd" id="address-default" hidden value="0">
                                        <input type="radio" name="isd" id="address-primary" hidden value="1"
                                               checked="checked">
                                    @else
                                        <input type="radio" name="isd" id="address-default" hidden value="0"
                                               checked="checked">
                                        <input type="radio" name="isd" id="address-primary" hidden value="1">
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
                    <hr class="hr-base m-a-0">
                    <!-- Done 按钮 -->
                    <div class="container-fluid p-x-10x p-y-15x">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn btn-primary-outline btn-block" id="btn-cancelEditorAddress">Cancel</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn btn-primary btn-block disabled" id="btn-submitEditorAddress">Done</div>
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
                            <div class="addressList-container font-size-sm" id="" data-address=""
                                 data-aid="{{$value['receiving_id']}}">
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
                                            <span class="text-common p-r-5x">Default</span>
                                        @endif
                                        <i class="iconfont icon-size-sm text-common"></i>
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
                    <aside class="p-a-15x">
                        <div class="btn btn-block btn-primary" data-role="submit">Continue</div>
                    </aside>
                </section>

                <!-- 删除地址 确认框 -->
                <div class="remodal remodal-md modal-content" data-remodal-id="modal" id="removeAddress-Dialog">
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
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title">
                        <strong>Select Country</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        @if(isset($commonlist))
                            @foreach($commonlist as $c)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-15x"
                                     data-country="{{base64_encode(json_encode($c))}}" data-cid="{{$c['country_id']}}">
                                    <span>{{$c['country_name_en']}}</span>
                                </div>
                                <hr class="hr-base m-a-0">
                            @endforeach
                        @endif
                    </aside>
                    <div class="p-t-10x bg-title"></div>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        @if(isset($list))
                            @foreach($list as $l)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x"
                                     data-country="{{base64_encode(json_encode($l))}}" data-cid="{{$l['country_id']}}">
                                    <span>{{ $l['country_name_en'] }}</span>
                                </div>
                                <hr class="hr-base">
                            @endforeach
                        @endif
                    </aside>
                </section>
            </div>
            <!-- 选择 state -->
            <div class="pageview shipping-chooseState" id="shipping-chooseState">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title">
                        <strong>Select State</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        @if(isset($commonlist))
                            @foreach($commonlist as $c)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x "
                                     data-state="{{base64_encode(json_encode($c))}}" data-cid="{{$c['state_id']}}">
                                    <span>{{$c['state_name_en']}}</span>
                                </div>
                                <hr class="hr-base">
                            @endforeach
                        @endif
                    </aside>
                    <aside class="bg-white">
                        @if(isset($list))
                            @foreach($list as $l)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x"
                                     data-state="{{base64_encode(json_encode($l))}}" data-cid="{{$l['state_id']}}">
                                    <span>{{ $l['state_name_en'] }}</span>
                                </div>
                                <hr class="hr-base">
                            @endforeach
                        @endif
                    </aside>
                </section>
            </div>

            <!-- loading -->
            <div class="loading loading-screen loading-switch loading-hidden">
                <div class="loader loader-screen"></div>
            </div>
        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addressList.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/Checkout.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
