<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/profileSetting-addAddress.css{{'?v='.config('app.version')}}">
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
            <!-- 2.PAYMENT -->
            <!-- 选择支付方式 -->
            <div class="pageview shipping-payment active" id="shipping-payment">
                <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                    <span class="p-x-15x">1.SHIPPING</span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x active">2.PAYMENT</span><strong><i
                                class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                    <span class="p-x-15x">3.REVIEW</span>
                </div>
                <hr class="hr-light m-a-0">
                <!-- 选择支付方式 -->
                <div class="text-primary">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x">
                        <span>Pay With Credit Card</span>
                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                    </div>
                    <!-- card 列表 -->
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-l-20x p-r-15x p-y-5x bg-title cardList">
                        <div class="p-l-10x">Card: <span>6262 *** *** *** 3424</span><br>EXP: <span>12/19</span></div>
                        <i class="iconfont icon-check icon-size-md text-common"></i>
                    </div>
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-l-20x p-r-15x p-y-5x bg-title cardList">
                        <div class="p-l-10x">Card: <span>6262 *** *** *** 3424</span><br>EXP: <span>12/19</span></div>
                        <i class="iconfont icon-check icon-size-md text-common"></i>
                    </div>

                    <hr class="hr-base m-a-0">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x">
                        <span>Pay With PayPal</span>
                        <i class="iconfont icon-check icon-size-md text-common"></i>
                    </div>
                    <hr class="hr-base m-a-0">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x">
                        <span>Pay With Apple Pay</span>
                        <i class="iconfont icon-check icon-size-md text-common"></i>
                    </div>
                    <hr class="hr-base m-a-0">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x">
                        <span>Promotion Code</span>
                        <div>
                            <span>20% OFF</span>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                        </div>
                    </div>
                    <hr class="hr-base m-a-0">
                </div>

                <!-- Coutinue 按钮 -->
                <div class="text-primary choose-method">
                    <hr class="hr-base m-a-0">
                    <!-- Continue 按钮 -->
                    <div class="p-a-15x submit-payment">
                        <div class="btn btn-primary btn-block" id="submit-payment">Continue</div>
                    </div>
                </div>

            </div>
            <!-- 添加卡 -->
            <div class="pageview shipping-addCard hidden" id="shipping-addCard">
                <!-- 可支付的卡列表 -->
                <div class="text-center p-t-10x p-b-5x">
                    <span class="m-x-10x img-card active"><img src="{{env('CDN_Static')}}/images/payment/icon-visa.png"
                                               srcset="{{env('CDN_Static')}}/images/payment/icon-visa@2x.png 2x, {{env('CDN_Static')}}/images/payment/icon-visa@3x.png 3x"
                                               alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card"><img src="{{env('CDN_Static')}}/images/payment/icon-maestro.png"
                                               srcset="{{env('CDN_Static')}}/images/payment/icon-maestro@2x.png 2x, {{env('CDN_Static')}}/images/payment/icon-maestro@3x.png 3x"
                                               alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card"><img src="{{env('CDN_Static')}}/images/payment/icon-americanexpress.png"
                                               srcset="{{env('CDN_Static')}}/images/payment/icon-americanexpress@2x.png 2x, {{env('CDN_Static')}}/images/payment/icon-americanexpress@3x.png 3x"
                                               alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card"><img src="{{env('CDN_Static')}}/images/payment/icon-jcb.png"
                                               srcset="{{env('CDN_Static')}}/images/payment/icon-jcb@2x.png 2x, {{env('CDN_Static')}}/images/payment/icon-jcb@3x.png 3x"
                                               alt="">
                    <div class="mask"></div>
                    </span>
                </div>
                <hr class="hr-base m-a-0">

                <!-- 填写卡号 日期 CVV -->
                <form class="cardform-container" id="card-container" method="post" data-token="{{$token}}">
                    <div class="cardinfo-wrapper font-size-sm">
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="tel" data-braintree-name="number"
                                   value="" placeholder="Card Number" data-role="Card Number" data-optional="" id="cardNum" maxlength="20">
                        </div>
                    </div>
                    <div class="cardinfo-wrapper font-size-sm">
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="text" data-braintree-name="expiration_date"
                                   value="" placeholder="MM/YY" data-role="expires" data-optional="" maxlength="8">
                        </div>
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="tel" data-braintree-name="cvv" value=""
                                   placeholder="CVV" data-optional="" maxlength="4">
                        </div>
                    </div>
                    <!-- 错误提示信息 -->
                    <div class="warning-info off text-warning flex flex-alignCenter p-a-15x">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs">错误提示信息</span>
                    </div>
                    <hr class="hr-base m-a-0">
                </form>

                <!-- BILLING ADRESS -->
                <div class="text-primary">
                    <section class="p-b-20x reserve-height">
                        <div class="p-y-10x p-x-15x font-size-sm bg-title"><strong>BILLING ADRESS</strong></div>
                        <hr class="hr-base m-a-0">
                        <div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-b-10x hidden-xs-up">
                            <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                            <span class="font-size-xs"></span>
                        </div>
                        <form class="bg-white" id="addressInfo" name="addressInfo" method="get" action="/cart/countrylist">
                            <!-- 个人中心 sitting list -->
                            <fieldset>
                                <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
                                    <span>Same as Shipping Address?</span>
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
                            <hr class="hr-base m-a-0">
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
                        </form>
                        <hr class="hr-base m-a-0">
                        <!-- Done 按钮 -->
                        <div class="p-a-15x editor-address">
                            <div class="btn btn-primary btn-block" id="btn-editorAddress">Save</div>
                        </div>
                    </section>
                </div>

            </div>
            <!-- promotion code -->
            <div class="pageview shipping-promotion hidden" id="shipping-promotion">
                <section class="m-b-20x reserve-height">
                    <article class="font-size-md text-main p-a-10x bg-title"><strong>Promotion Code</strong></article>
                    <hr class="hr-base m-a-0">

                    <fieldset>
                        <div class="warning-info flex text-warning flex-alignCenter text-left p-a-15x" hidden>
                            <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                            <span class="font-size-xs"></span>
                        </div>
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="coupon"
                               placeholder="Promotional Code" value="">
                    </fieldset>
                    <hr class="hr-base m-a-0">
                    <div class="p-a-15x">
                        <div class="btn btn-primary btn-block disabled" data-role="submit">Apply</div>

                    </div>

                    <!-- 优惠券列表 -->
                    <div class="p-a-15x">
                        @inject('getDate', 'App\Services\Publicfun')
                        @foreach($couponlist['list'] as $value)
                            <div class="promotion-item">
                                <div class="mask"></div>
                                <div class="promotion-info bg-promotion p-a-10x">
                                    <div class="promotion-title text-white"><strong>{{$value['cp_title']}}</strong></div>
                                    <div class="font-size-sm text-white">{{$value['prompt_words']}}</div>
                                    <span class="bg-point-right"></span>
                                    <span class="bg-point-left"></span>
                                    <ul class="promotion-style">
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                            <span class="promotion-radio">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                                </div>
                                <div class="promotion-time text-primary p-a-10x text-right font-size-sm">Expire: {{ $getDate->getMyDate(date('Y-m-d H:i',substr($value['expiry_time'],0,10))) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- 邀请好友 -->
                    <aside class="bg-white m-t-20x">
                        <hr class="hr-base m-a-0">
                        <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="/invitefriends">
                            <div class="flex flex-alignCenter">
                            <span class="p-r-15x">
                                <img src="{{env('CDN_Static')}}/images/icon/gift-small.png" srcset="{{env('CDN_Static')}}/images/icon/gift-small@2x.png 2x,{{env('CDN_Static')}}/images/icon/gift-small@3x.png 3x">
                            </span>
                                <span>Share Motif with friends. They get $20 off, and you will too after their first purchase.</span>
                            </div>
                            <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                        </a>
                    </aside>
                    <hr class="hr-base m-a-0">
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
