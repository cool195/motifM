<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Methods</title>
    @include('head')
    <link rel="stylesheet" href="/styles/paymentMethod.css">

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
    <!-- 支付方式 列表 -->
        <section class="reserve-height">
            <article class="p-x-15x p-y-10x flex flex-fullJustified flex-alignCenter">
                <span class="font-size-md text-main"><strong>Payment Method</strong></span>
                @if(count($methodlist['Card']) > 0)
                    <a class="btn btn-primary-outline btn-sm" id="payment-edit">Edit</a>
                @endif

                <!-- 修改状态 -->
                <!--<a class="btn btn-primary btn-sm" href="#">Done</a>-->
            </article>

            <!-- 支付方式列表 list -->
            <!-- 已绑定支付方式 状态 -->
            <!-- paypal -->
            @if(!empty($methodlist['PayPal']))
                @foreach($methodlist['PayPal'] as $value)
                    <aside class="payPal-container m-b-10x">
                        <div class="payment-item font-size-sm" data-token="{{$value['token']}}">
                            <div class="payment-delete switch" data-remodal-target="modal">
                                <i class="iconfont icon-delete icon-size-md text-warning"></i>
                            </div>
                            <div class="payment-info m-l-15x p-r-15x p-y-10x">
                                <div class="flex flex-alignCenter">
                                    <span class="cardImage-inline paypal"></span>
                                    <span class="m-l-10x">{{$value['showName']}}</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                @endforeach
            @else
            <!-- 没有绑定支付方式 状态 -->
                <aside class="payPal-container m-b-10x">
                    <div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x pay-option"
                         id="paypal" data-braintree="{{$token}}">
                        <div class="flex flex-alignCenter font-size-sm text-primary">
                            <span class="cardImage-inline unPaypal"></span>
                            <span class="m-l-10x">Paypal</span>
                        </div>
                        <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                        <div class="bg-option bg-pay"></div>
                    </div>
                </aside>
            @endif


        <!-- 信用卡 -->
            @if(!empty($methodlist['Card']))
                <aside class="cardCredit-container">
                    @foreach($methodlist['Card'] as $value)
                        <div class="payment-item font-size-sm" data-token="{{$value['token']}}">
                            <div class="payment-delete switch" data-remodal-target="modal">
                                <i class="iconfont icon-delete icon-size-md text-warning"></i>
                            </div>
                            <div class="payment-info m-l-15x p-r-15x p-y-10x">
                                <div class="flex flex-alignCenter">
                                    <span class="cardImage-inline {{array_get($methodlist['cardlist'],$value['cardType'])}}"></span>
                                    <span class="m-l-10x">{{$value['showName']}}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-base m-a-0">
                    @endforeach
                    <div class="bg-white">
                        @if(count($methodlist['Card']) < 5)
                        <a class="flex flex-alignCenter text-primary p-a-15x" href="/braintree/addcard">
                            <i class="iconfont icon-add icon-size-sm p-r-10x"></i>
                            <span class="font-size-sm">Add New Card</span>
                        </a>
                        @endif
                    </div>
                </aside>
            @else
{{--                <aside class="cardCredit-container m-b-10x">
                    <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x"
                       href="/braintree/addcard">
                        <div class="flex flex-alignCenter font-size-sm text-primary">
                            <span class="cardImage-inline cardCredit"></span>
                            <span class="m-l-10x">Direct debit/credit card</span>
                        </div>
                        <span><i class="iconfont icon-arrow-right icon-size-sm text-common"></i></span>
                    </a>
                </aside>--}}
            @endif
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
<!-- TODO remodal 有多余的样式 需要整理 -->
<div class="remodal remodal-md modal-content" data-remodal-id="modal" id="modalDialog">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <span class="font-size-base">Remove Payment Method</span><br>
        Are you sure you want to remove this payment method?
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
<!-- BrainTree -->
<script src="/scripts/braintree-2.24.1.min.js"></script>

<script src="/scripts/vendor.js"></script>

<script src="/scripts/paymentMethod-paypal.js"></script>
@include('global')
</html>
