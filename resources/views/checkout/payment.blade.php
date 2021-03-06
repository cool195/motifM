<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>Order Checkout</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/orderCheckout.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet"
          href="{{env('CDN_Static')}}/styles/profileSetting-addAddress.css{{'?v='.config('app.version')}}">

</head>
<body>
<script type="text/javascript">
    function onCheckoutOption(step, checkoutOption) {
        dataLayer.push({
            'event': 'checkoutOption',
            'ecommerce': {
                'checkout_option': {
                    'actionField': {'step': step, 'option': checkoutOption}
                }
            }
        });
    }
</script>
@include('check.tagmanager')

<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
        @include('navigator', ['pageScope'=>true])

        <div class="checkout-container">
            <!-- 选择支付方式 -->
            <div class="pageview shipping-payment @if($from!='editcode'){{'active'}}@endif" id="shipping-payment"
                 data-ref="{{$from}}">
                @if($from!='review')
                    <div class="flex flex-alignCenter flex-justifyCenter font-size-sm p-y-15x steps">
                        <span class="p-x-15x">SHIPPING</span><strong><i
                                    class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                        <span class="p-x-15x active">PAYMENT</span><strong><i
                                    class="iconfont icon-arrow-right icon-size-xm"></i></strong>
                        <span class="p-x-15x">CONFIRMATION</span>
                    </div>
                    <hr class="hr-light m-a-0">
                @endif
                <div class="p-y-10x p-x-15x font-size-sm bg-title"><strong>PAYMENT METHOD</strong></div>
                <hr class="hr-base m-a-0">
            <!-- 选择支付方式 -->
                <div class="text-primary">
                    <!-- card 列表 -->
                    @foreach($payInfo as $value)
                        <div class="@if(Session::get('user.checkout.paywith.pay_type')==$value['pay_type']) active @endif flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x @if(isset($value['creditCards'])) btn-toAddCard @else clickPayWith @endif"
                             data-type="{{$value['pay_type']}}" data-card="0" data-method="{{$value['pay_method']}}">
                            <span>{{$value['pay_name']}}</span>
                            <i class="iconfont @if(isset($value['creditCards'])) icon-arrow-right @else icon-check @endif icon-size-md text-primary"></i>
                        </div>
                        @foreach($value['creditCards'] as $card)
                            <div class="card-item">
                                <div class="@if(Session::get('user.checkout.paywith.withCard.card_id')==$card['card_id']) active @endif flex flex-alignCenter flex-fullJustified font-size-sm m-l-20x p-r-15x p-y-5x cardList clickPayWith"
                                     data-type="{{$value['pay_type']}}" data-card="{{$card['card_id']}}">
                                    <div class="p-l-10x"><span>{{$card['card_number']}}</span>

                                        @if($card['card_type']=='Visa')
                                            <span class="p-l-10x"><img
                                                        src="{{env('CDN_Static')}}/images/payment/icon-visa.png{{'?v='.config('app.version')}}"
                                                        srcset="{{env('CDN_Static')}}/images/payment/icon-visa@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-visa@3x.png{{'?v='.config('app.version')}} 3x"
                                                        alt=""></span>
                                        @elseif($card['card_type']=='MasterCard')
                                            <span class="p-l-10x"><img
                                                        src="{{env('CDN_Static')}}/images/payment/icon-mastercard.png{{'?v='.config('app.version')}}"
                                                        srcset="{{env('CDN_Static')}}/images/payment/icon-mastercard@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-mastercard@3x.png{{'?v='.config('app.version')}} 3x"
                                                        alt=""></span>
                                        @elseif($card['card_type']=='AmericanExpress')
                                            <span class="p-l-10x"><img
                                                        src="{{env('CDN_Static')}}/images/payment/icon-americanexpress.png{{'?v='.config('app.version')}}"
                                                        srcset="{{env('CDN_Static')}}/images/payment/icon-americanexpress@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-americanexpress@3x.png{{'?v='.config('app.version')}} 3x"
                                                        alt=""></span>
                                        @elseif($card['card_type']=='JCB')
                                            <span class="p-l-10x"><img
                                                        src="{{env('CDN_Static')}}/images/payment/icon-jcb.png{{'?v='.config('app.version')}}"
                                                        srcset="{{env('CDN_Static')}}/images/payment/icon-jcb@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-jcb@3x.png{{'?v='.config('app.version')}} 3x"
                                                        alt=""></span>
                                        @endif
                                        <br>Exp <span>{{$card['month']}}/{{$card['year']}}</span>
                                        <br><span>&nbsp;</span>
                                    </div>
                                    <i class="iconfont icon-check icon-size-md text-primary"></i>
                                </div>
                                <span class="p-l-20x font-size-sm text-common text-underLine btn-deleteCard"
                                      data-remodal-target="deletecardmodal"
                                      data-cardid="{{$card['card_id']}}">Remove</span>
                            </div>
                        @endforeach
                        <hr class="hr-base m-a-0">
                    @endforeach
                    @if($from!='review')
                        <div class="p-y-10x p-x-15x font-size-sm bg-title"><strong>PROMOTION CODE</strong></div>
                        <hr class="hr-base m-a-0">
                        <div class="flex flex-alignCenter flex-fullJustified font-size-sm p-a-15x"
                             id="btn-toPromotionCode">
                            <span>{{Session::get('user.checkout.couponInfo')['cp_title'] ? Session::get('user.checkout.couponInfo')['cp_title'] : 'None'}}</span>
                            <div>
                                <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                            </div>
                        </div>
                        <hr class="hr-base m-a-0">
                    @endif
                </div>

                <!-- Coutinue 按钮 -->
                <div class="text-primary">
                    {{--<hr class="hr-base m-a-0">--}}
                    <!-- Continue 按钮 -->
                    <div class="p-a-15x submit-payment">
                        <div class="btn btn-primary btn-block submit-paymentbutton" data-url="{{'/checkout/review'}}">
                            @if($from!='review'){{'Continue'}}@else{{'Done'}}@endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- 添加卡 -->
            <div class="pageview shipping-addCard shipping-editorAddress" id="shipping-addCard">
                <!-- 可支付的卡列表 -->
                <div class="text-center p-t-10x p-b-5x">
                    <span class="m-x-10x img-card" id="img-visa" data-type="Visa"><img
                                src="{{env('CDN_Static')}}/images/payment/icon-visa.png{{'?v='.config('app.version')}}"
                                srcset="{{env('CDN_Static')}}/images/payment/icon-visa@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-visa@3x.png{{'?v='.config('app.version')}} 3x"
                                alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card" id="img-mastercard" data-type="MasterCard"><img
                                src="{{env('CDN_Static')}}/images/payment/icon-mastercard.png{{'?v='.config('app.version')}}"
                                srcset="{{env('CDN_Static')}}/images/payment/icon-mastercard@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-mastercard@3x.png{{'?v='.config('app.version')}} 3x"
                                alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card" id="img-amex" data-type="AmericanExpress"><img
                                src="{{env('CDN_Static')}}/images/payment/icon-americanexpress.png{{'?v='.config('app.version')}}"
                                srcset="{{env('CDN_Static')}}/images/payment/icon-americanexpress@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-americanexpress@3x.png{{'?v='.config('app.version')}} 3x"
                                alt="">
                    <div class="mask"></div>
                    </span>
                    <span class="m-x-10x img-card" id="img-jcb" data-type="JCB"><img
                                src="{{env('CDN_Static')}}/images/payment/icon-jcb.png{{'?v='.config('app.version')}}"
                                srcset="{{env('CDN_Static')}}/images/payment/icon-jcb@2x.png{{'?v='.config('app.version')}} 2x, {{env('CDN_Static')}}/images/payment/icon-jcb@3x.png{{'?v='.config('app.version')}} 3x"
                                alt="">
                    <div class="mask"></div>
                    </span>
                </div>
                <hr class="hr-base m-a-0">

                <!-- 填写卡号 日期 CVV -->
                <div class="card-wrapper" style="display: none;"></div>
                <form class="cardform-container" id="card-container" method="">
                    <div class="cardinfo-wrapper font-size-sm">
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="tel" data-braintree-name="number"
                                   value="" placeholder="Card Number" data-optional="false" data-role="card number"
                                   id="cardNum" maxlength="20" name="card">
                            <input name="card_type" type="hidden">
                            <input name="add_type" type="hidden">
                        </div>
                    </div>
                    <div class="cardinfo-wrapper font-size-sm">
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="tel" data-braintree-name="expiration_date"
                                   data-role="expiry"
                                   value="" placeholder="MM/YY" data-optional="false" maxlength="7" name="expiry">
                        </div>
                        <div class="cardinfo-item">
                            <input class="cardinfo-input" type="tel" data-braintree-name="cvv" value="" data-role="cvv"
                                   placeholder="CVV" maxlength="4" data-optional="false" name="cvv">
                        </div>
                    </div>
                    <!-- 错误提示信息 -->
                    <div class="warning-info text-warning flex flex-alignCenter p-a-15x hidden-xs-up" id="card-warning">
                        <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                        <span class="font-size-xs"></span>
                    </div>

                    <!-- Save 按钮 -->
                    <div class="container-fluid p-x-10x p-y-15x">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn btn-primary-outline btn-block btn-cancelAddCard">Cancel
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn btn-primary btn-block disabled btn-submitAddCard">Save
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-base m-a-0">

                    <!-- BILLING ADDRESS -->
                    <div class="text-primary">
                        <section class="p-b-20x reserve-height" id="cardAddress">
                            <div class="p-y-10x p-x-15x font-size-sm bg-title"><strong>BILLING ADDRESS</strong></div>
                            <hr class="hr-base m-a-0">
                            {{--<div class="warning-info off flex text-warning flex-alignCenter text-left p-x-15x p-y-10x hidden-xs-up">--}}
                            {{--<i class="iconfont icon-caveat icon-size-md p-r-5x"></i>--}}
                            {{--<span class="font-size-xs"></span>--}}
                            {{--</div>--}}

                            <fieldset>
                                <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x">
                                    <span>Same as Shipping Address?</span>
                                    <div class="radio-checkBox open" id="payment-checkBox">
                                        <div class="radio-checkItem"></div>
                                    </div>
                                </div>
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option"
                                     id="btn-toCountryList"
                                     data-oldcountry="{{Session::get('user.checkout.address.country')}}"
                                     data-newcountry="{{$country['commonlist'][0]['country_name_en']}}">
                                    <span>Country</span>
                                    <div>
                                        <span id="countryName">{{Session::get('user.checkout.address.country')}}</span>
                                        <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
                                        <input type="text" name="country" hidden
                                               value="{{Session::get('user.checkout.address.country')}}">
                                        <input type="text" name="csn" hidden value="">
                                    </div>
                                </div>
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="name"
                                       type="text"
                                       maxlength="32" data-optional="false" data-role="name"
                                       value="{{Session::get('user.checkout.address.name')}}" placeholder="Name"
                                       data-oldname="{{Session::get('user.checkout.address.name')}}">
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="addr1"
                                       type="text"
                                       data-optional="false" data-role="street"
                                       value="{{Session::get('user.checkout.address.detail_address1')}}"
                                       placeholder="Street1"
                                       data-oldaddr1="{{Session::get('user.checkout.address.detail_address1')}}">
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="addr2"
                                       type="text" data-role="street"
                                       data-optional="true"
                                       value="{{Session::get('user.checkout.address.detail_address2')}}"
                                       data-oldaddr2="{{Session::get('user.checkout.address.detail_address2')}}"
                                       placeholder="Street2 (optional)">
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="city"
                                       data-oldcity="{{Session::get('user.checkout.address.city')}}"
                                       type="text"
                                       data-optional="false" data-role="city"
                                       value="{{Session::get('user.checkout.address.city')}}" placeholder="City">
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                {{--动态加载州数据 state--}}
                                <div class="state-info" data-oldstate="{{Session::get('user.checkout.address.state')}}">
                                </div>
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="zip"
                                       data-oldzip="{{Session::get('user.checkout.address.zip')}}"
                                       type="text"
                                       maxlength="10" data-optional="false" data-role="zip code"
                                       value="{{Session::get('user.checkout.address.zip')}}"
                                       placeholder="{{--动态提示文案--}}">
                            </fieldset>
                            <hr class="hr-base m-a-0">
                            <fieldset>
                                <input class="form-control form-control-block p-a-15x font-size-sm" name="tel"
                                       data-oldtel="{{Session::get('user.checkout.address.telephone')}}"
                                       type="tel"
                                       maxlength="20" data-optional="false" data-role="Phone"
                                       value="{{Session::get('user.checkout.address.telephone')}}" placeholder="Phone">
                            </fieldset>

                            <hr class="hr-base m-a-0">
                        </section>
                    </div>
                    <!-- Save 按钮 -->
                    <div class="container-fluid p-x-10x p-y-15x">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn btn-primary-outline btn-block btn-cancelAddCard">Cancel
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn btn-primary btn-block disabled btn-submitAddCard">Save
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- promotion code -->
            <div class="pageview shipping-promotion @if($from=='editcode'){{'active'}}@endif" id="shipping-promotion">
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
                    <div class="container-fluid p-x-10x p-y-15x">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="btn btn-primary-outline btn-block" id="btn-cancelPromoCode">Cancel</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="btn btn-primary btn-block disabled" id="btn-submitPromoCode">Apply</div>
                            </div>
                        </div>
                    </div>

                    @if(Session::get('user.checkout.couponInfo.bind_id'))
                        <p class="m-b-5x p-x-10x font-size-sm text-red">You also have the following coupons.</p>
                    @endif

                    <!-- 优惠券列表 -->
                    <div class="p-x-15x p-b-15x">
                        @foreach($coupon['list'] as $value)
                            <div class="promotion-item @if($value['usable']){{'bindidcode'}}@endif"
                                 data-bindid="{{$value['bind_id']}}">
                                <div class="mask"></div>
                                <div class="promotion-info @if($value['usable']){{'bg-promotion'}}@else{{'bg-promotionOver'}}@endif p-a-10x">
                                    <div class="promotion-title text-white"><strong>{{$value['cp_title']}}</strong>
                                    </div>
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
                            <span class="promotion-radio @if($value['bind_id']==Session::get('user.checkout.couponInfo.bind_id')){{'active'}}@endif">
                                <i class="iconfont icon-check icon-size-md text-white"></i>
                            </span>
                                </div>
                                <div class="promotion-time text-primary p-a-10x text-right font-size-sm">
                                    Expires: {{date("M d, Y", ($value['expiry_time'] / 1000))}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="hr-base m-a-0">
                </section>

            </div>

            <!-- 选择 country -->
            <div class="pageview shipping-chooseCountry" id="shipping-chooseCountry">
                <section class="p-b-10x reserve-height">
                    <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter bg-title">
                        <span class="font-size-md text-main"><strong>Select Country</strong></span>
                        <a class="btn btn-primary-outline btn-sm" id="cancel-paymentCountry">Cancel</a>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white">

                        @foreach($country['commonlist'] as $value)
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-15x country-item"
                                 data-cid="{{$value['country_id']}}" data-cname="{{$value['country_name_en']}}"
                                 data-type="{{$value['child_type']}}" data-childlabel="{{$value['child_label']}}"
                                 data-zipcode="{{$value['zipcode_label']}}" data-csn="{{$value['country_name_sn']}}">
                                <span>{{$value['country_name_en']}}</span>
                                <i class="iconfont icon-check icon-size-sm text-primary"></i>
                            </div>
                            <hr class="hr-base m-a-0">
                        @endforeach

                    </aside>
                    {{--<div class="p-t-10x bg-title"></div>--}}
                    <hr class="hr-dark m-a-0">
                    <aside class="bg-white">

                        @foreach($country['list'] as $value)
                            <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x country-item"
                                 data-cid="{{$value['country_id']}}" data-cname="{{$value['country_name_en']}}"
                                 data-type="{{$value['child_type']}}" data-childlabel="{{$value['child_label']}}"
                                 data-zipcode="{{$value['zipcode_label']}}" data-csn="{{$value['country_name_sn']}}">
                                <span>{{ $value['country_name_en'] }}</span>
                                <i class="iconfont icon-check icon-size-sm text-primary"></i>
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
                        <a class="btn btn-primary-outline btn-sm" id="cancel-paymentState">Cancel</a>
                    </article>
                    <hr class="hr-base m-a-0">
                    <aside class="bg-white statelist-info"></aside>
                </section>
            </div>
            <!-- loading -->
            <div class="loading loading-screen loading-switch loading-hidden" id="loading">
                <div class="loader loader-screen"></div>
            </div>

            <div class="loading loading-screen loading-switch loading-hidden" id="checkout-failure">
                <div class="loading-modal">
                    <div class="text-white font-size-md text-center m-t-10x ErrorMessage"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- 删除卡 -->
<div class="remodal remodal-md modal-content" data-remodal-id="deletecardmodal" id="deleteCard-modalDialog"
     data-cardid="">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        Are you sure you want to remove this credit card?
    </div>
    <div class="btn-group flex">
        <div class="btn remodal-btn flex-width" data-remodal-action="confirm">Remove</div>
        <div class="btn remodal-btn flex-width" data-remodal-action="cancel">Cancel</div>
    </div>
</div>


</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/card.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/checkout.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/orderCheckout-addressList.js{{'?v='.config('app.version')}}"></script>
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
