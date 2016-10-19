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
            <!-- 1.SHIPPING -->
            <!-- 1.SHIPPING SHIPTO/METHOD-->
            <div class="pageview shipping-shipTo active" id="shipping-shipTo">
                <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                    <span class="p-x-15x active">1.SHIPPING</span><strong><i class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">2.PAYMENT</span><strong><i class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">3.REVIEW</span>
                </div>
                <hr class="hr-light m-a-0">
                <!-- ship to -->
                <div class="text-primary">
                    <div class="p-y-10x p-x-15x font-size-sm"><strong>SHIP TO</strong></div>
                    <hr class="hr-base m-a-0">
                    <div class="p-y-10x p-x-15x font-size-sm flex flex-alignCenter flex-fullJustified">
                        <div class="">
                            <span>Ming</span><br>
                            <span>Beijing chao yang</span><br>
                            <span>Beijing, AK 10000</span><br>
                            <span>China</span><br>
                            <span>130 2784 8900</span>
                        </div>
                        <div class="text-underLine" id="edit-shipTp">Edit</div>
                    </div>
                    <hr class="hr-base m-a-0">
                </div>
                <!-- shipping method -->
                <div class="text-primary choose-method">
                    <div class="p-y-10x p-x-15x font-size-sm"><strong>SHIPPING METHOD</strong></div>
                    <hr class="hr-base m-a-0">
                    <div>
                        <div class="p-a-15x font-size-sm flex flex-alignCenter flex-fullJustified">
                            <span>Registered AirMail: 10-15 Days(FREE) $0.00</span>
                            <i class="iconfont icon-check icon-size-base"></i>
                        </div>
                        <hr class="hr-base m-a-0">
                        <div class="p-a-15x font-size-sm flex flex-alignCenter flex-fullJustified">
                            <span>Expedited Shipping: 3-7 Days $0.00</span>
                            <i class="iconfont icon-check icon-size-base hidden"></i>
                        </div>
                        <hr class="hr-base m-a-0">
                    </div>
                    <!-- Continue 按钮 -->
                    <div class="p-a-15x submit-shipping">
                        <div class="btn btn-primary btn-block" id="submit-shipping">Continue</div>
                    </div>
                </div>

            </div>
            <!-- 1.SHIPPING 添加/修改地址 -->
            <div class="pageview shipping-editorAddress hidden" id="shipping-editorAddress">
                <section class="p-b-20x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title"><strong>Add New Address</strong></article>
                    <hr class="hr-base m-a-0">
                    <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x hidden-xs-up">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs"></span>
                    </div>
                    <form class="bg-white" id="addressInfo" name="addressInfo" method="get" action="/cart/countrylist">
                        <!-- 个人中心 sitting list -->
                        <fieldset>
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option"
                                 id="country">
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
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="state" type="text"
                                       data-optional="true"
                                       value="{{$state['state_name_sn']}}"
                                       placeholder="{{$country['child_label']}}">
                            @elseif($country['child_type']==1)
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="state" type="text"
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
                                   value="{{ !empty($input['zip']) ? $input['zip'] : "" }}" placeholder="{{$country['zipcode_label']}}">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <input class="form-control form-control-block p-a-15x font-size-sm" name="tel" type="tel"
                                   maxlength="20" data-optional="false" data-role="Phone"
                                   value="{{!empty($input['tel']) ? $input['tel'] : ""}}" placeholder="Phone">
                        </fieldset>
                        <hr class="hr-base m-a-0">
                        <fieldset>
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                                <span>Make Default</span>
                                <div class="@if(!$first)radio-checkBox @endif @if($first || 1 == $input['isd']) open @endif">
                                    <div class="radio-checkItem"></div>
                                    @if($first || 1 == $input['isd'])
                                        <input type="radio" name="isd" id="address-default" hidden value="0">
                                        <input type="radio" name="isd" id="address-primary" hidden value="1" checked="checked">
                                    @else
                                        <input type="radio" name="isd" id="address-default" hidden value="0" checked="checked">
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
                    <div class="p-a-15x editor-address">
                        <div class="btn btn-primary btn-block" id="btn-editorAddress">Done</div>
                    </div>
                </section>
            </div>
            <!-- 1.SHIPPING 地址列表/选择地址 -->
            <div class="pageview shipping-chooseAddress hidden" id="shipping-chooseAddress">

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
                        <div class="addressList-container font-size-sm" id="" data-address="" data-aid="503">
                            <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return" data-url-return="return" data-url-edit="edit" data-url="/user/addrmod/503">
                                <div>
                                    <div class="text-common">Default Shipping Address</div>
                                    <div>Ming</div>
                                    <div>Beijing chao yang</div>
                                    <div>Beijing, AK 10000</div>
                                    <div>China</div>
                                    <div>152 0177 1879</div>
                                </div>
                                <div class="flex flex-alignCenter">
                                    <span class="text-common p-r-5x">Default</span>
                                    <i class="iconfont icon-size-sm text-common"></i>
                                </div>

                            </div>
                        </div>
                        <div class="addressList-container font-size-sm" id="" data-address="" data-aid="655">
                            <div class="addressList-delete switch" data-remodal-target="modal">
                                <i class="iconfont icon-delete icon-size-md text-warning"></i>
                            </div>
                            <div class="addressItem-info text-primary m-l-15x p-r-15x p-y-10x" data-action="return" data-url-return="return" data-url-edit="edit" data-url="/user/addrmod/655">
                                <div>
                                    <div>lei</div>
                                    <div>Beijing chao yang</div>
                                    <div>Beijing, AK 10000</div>
                                    <div>China</div>
                                    <div>152 0177 1879</div>
                                </div>
                                <div class="flex flex-alignCenter">
                                    <i class="iconfont icon-size-sm text-common"></i>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="hr-between"></div>
                    <aside class="bg-white">
                        <a class="flex flex-alignCenter text-primary p-a-15x" href="#">
                            <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                            <span class="font-size-sm">Add New Address</span>
                        </a>
                    </aside>
                    <hr class="hr-base m-a-0">
                    <aside class="p-a-15x">
                        <div class="btn btn-block btn-primary" data-role="submit">Continue</div>
                    </aside>
                </section>
            </div>
            <!-- 选择 country -->
            <div class="pageview shipping-chooseCountry hidden" id="shipping-chooseCountry">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title">
                        <strong>Select Country</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        {{--@if(isset($commonlist))--}}
                            {{--@foreach($commonlist as $c)--}}
                                {{--<div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-15x" data-country="{{base64_encode(json_encode($c))}}" data-cid="{{$c['country_id']}}">--}}
                                    {{--<span>{{$c['country_name_en']}}</span>--}}
                                {{--</div>--}}
                                {{--<hr class="hr-base m-a-0">--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                            <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-15x" data-country="{{base64_encode(json_encode($c))}}" data-cid="{{$c['country_id']}}">
                                <span>beijing</span>
                            </div>
                            <hr class="hr-base m-a-0">
                    </aside>
                    <div class="p-t-10x bg-title"></div>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        {{--@if(isset($list))--}}
                            {{--@foreach($list as $l)--}}
                                {{--<div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x" data-country="{{base64_encode(json_encode($l))}}" data-cid="{{$l['country_id']}}">--}}
                                    {{--<span>{{ $l['country_name_en'] }}</span>--}}
                                {{--</div>--}}
                                {{--<hr class="hr-base">--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                            <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x" data-country="{{base64_encode(json_encode($l))}}" data-cid="{{$l['country_id']}}">
                                <span>beijing</span>
                            </div>
                            <hr class="hr-base">
                    </aside>
                </section>
            </div>
            <!-- 选择 state -->
            <div class="pageview shipping-chooseState hidden" id="shipping-chooseState">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x font-size-md text-main bg-title">
                        <strong>Select State</strong>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">
                        @if(isset($commonlist))
                            @foreach($commonlist as $c)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x " data-state="{{base64_encode(json_encode($c))}}" data-cid="{{$c['state_id']}}">
                                    <span>{{$c['state_name_en']}}</span>
                                </div>
                                <hr class="hr-base">
                            @endforeach
                        @endif
                    </aside>
                    <aside class="bg-white">
                        @if(isset($list))
                            @foreach($list as $l)
                                <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x" data-state="{{base64_encode(json_encode($l))}}" data-cid="{{$l['state_id']}}">
                                    <span>{{ $l['state_name_en'] }}</span>
                                </div>
                                <hr class="hr-base">
                            @endforeach
                        @endif
                    </aside>
                </section>
            </div>

        </div>

    </div>
</div>

</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addressList.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
