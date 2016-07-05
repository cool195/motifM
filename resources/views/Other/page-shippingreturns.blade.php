<!DOCTYPE html>
<html lang="en">
<head>
    <title>Returns Shipping</title>
    @include('head')

</head>
<body>
@include('check.tagmanager')
        <!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
    @endif
            <!-- 主体内容 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        <div class="body-container">
            @include('navigator')
            @else
                <div class="body-container" style="padding-top:0px">
                    @endif
                            <!-- 物流、退货、支付 说明 -->
                    <section class="m-b-20x p-b-20x">
                        <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Returns Shipping</strong>
                        </article>
                        <div class="bg-white  m-b-10x">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Shipping</strong></div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">Our estimated delivery dates are based on the following factors:
                                    processing time
                                    for your order, the shipping options you've chosen and the destination address. You
                                    can
                                    calculate delivery estimates by taking the processing time for your order and adding
                                    the
                                    delivery time based on the shipping method you've chosen.
                                </p>
                                <p class="m-b-15x"><strong>For Non-Personalized items:</strong></p>
                                <div class="m-b-15x">
                                    <table class="table text-center">
                                        <thead class="thead-default">
                                        <tr>
                                            <th class="">Shipping Method</th>
                                            <th class="">Shipping Cost</th>
                                            <th class="text-center">Processing Time for Non-Personalized Items</th>
                                            <th class="text-center">Time from Shipping until delivery</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Registered Airmail</td>
                                            <td>Free</td>
                                            <td>2-4 business days</td>
                                            <td>7-15 business days</td>
                                        </tr>
                                        <tr>
                                            <td>Expedited Shipping</td>
                                            <td>20 US Dollars</td>
                                            <td>2-4 business days</td>
                                            <td>3-4 business days</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    {{--<table class="table text-left">--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Method</th>--}}
                                    {{--<td>Registered Airmail</td>--}}
                                    {{--<td>Expedited Shipping</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Cost</th>--}}
                                    {{--<td>Free</td>--}}
                                    {{--<td>20 US Dollars</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Processing Time for Non-Personalized Items</th>--}}
                                    {{--<td colspan="2">4 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Time</th>--}}
                                    {{--<td>7-20 business days</td>--}}
                                    {{--<td>3-4 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Time from placing to receiving order</th>--}}
                                    {{--<td>11-24 business days</td>--}}
                                    {{--<td>7-8 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--</table>--}}
                                </div>

                                <p class="m-b-15x"><strong>For Non-Personalized items:</strong></p>
                                <div class="m-b-15x">
                                    <table class="table text-center">
                                        <thead class="thead-default">
                                        <tr>
                                            <th class="">Shipping Method</th>
                                            <th class="">Shipping Cost</th>
                                            <th class="text-center">Processing Time for Personalized Items</th>
                                            <th class="text-center">Time from Shipping until delivery</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Registered Airmail</td>
                                            <td>Free</td>
                                            <td>7 business days</td>
                                            <td>7-15 business days</td>
                                        </tr>
                                        <tr>
                                            <td>Expedited Shipping</td>
                                            <td>20 US Dollars</td>
                                            <td>7 business days</td>
                                            <td>3-4 business days</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--<table class="table text-left">--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Method</th>--}}
                                    {{--<td>Registered Airmail</td>--}}
                                    {{--<td>Expedited Shipping</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Cost</th>--}}
                                    {{--<td>Free</td>--}}
                                    {{--<td>20 US Dollars</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Processing Time for Personalized Items</th>--}}
                                    {{--<td colspan="2">7-15 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Shipping Time</th>--}}
                                    {{--<td>7-20 business days</td>--}}
                                    {{--<td>3-4 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<th>Time from placing to receiving order</th>--}}
                                    {{--<td>14-30 business days</td>--}}
                                    {{--<td>10-19 business days</td>--}}
                                    {{--</tr>--}}
                                    {{--</table>--}}
                                </div>
                                <p class="m-b-15x">
                                    Note: For countries beside the US, Canada and Australia, Registered Airmail may take
                                    up to
                                    22 business days to arrive due to local dispatch or other reasons. Motif makes every
                                    attempt
                                    to deliver your items within the specified time; however, we are not responsible for
                                    any
                                    failure to deliver within that time.
                                </p>
                                <p class="m-b-0">
                                    If you need your package to arrive by a specific date, we strongly recommend you use
                                    expedited shipping which is much faster and guaranteed.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white">
                            <div class="p-x-15x p-y-10x font-size-md text-main"><strong>Returns</strong></div>
                            <hr class="hr-base m-y-0">
                            <div class="p-a-15x font-size-sm text-primary">
                                <p class="m-b-15x">We want to make sure you’re 100% satisfied with your purchases, if
                                    you are not
                                    happy for any reason, email your request to <a href="mailto:service@motif.me"
                                                                                   class="text-underLine">service@motif
                                        .me</a> and
                                    return your item within 30 days of delivery for a full refund or exchange. Without
                                    email
                                    notification or if 30 days have gone by, unfortunately, we can’t process any refund
                                    or exchange.
                                </p>
                                <p class="m-b-15x"><strong>To be eligible for a return:</strong></p>
                                <p class="m-b-15x">
                                    Your item must be unused and in the same condition that you received it. It must
                                    also be in
                                    the original packaging with the receipt or proof of purchase.
                                </p>

                                <p class="m-b-15x"><strong>Non-returnable items:</strong></p>
                                <p>
                                    Customized items (e.g. engraved items)<br>
                                    Final sale items<br>
                                    Gift cards<br>
                                    Coupon discounts
                                </p>

                                <p class="m-b-15x"><strong>There are certain situations where only partial refunds are
                                        granted
                                        (if applicable)</strong></p>
                                <p class="m-b-15x">
                                    a) Any item not in its original condition, is damaged or missing parts for reasons
                                    not due
                                    to our error.<br>
                                    b) Any item that is returned more than 30 days after delivery.
                                </p>

                                <p class="m-b-15x"><strong>Refunds (if applicable)</strong></p>
                                <p class="m-b-15x">Upon receipt of items, the credit or debit card originally used for
                                    the
                                    purchase will be credited with the cost of the goods minus the delivery charges
                                    (exceptions
                                    may apply). We will process your refund within 3 business days of receipt. Your
                                    credit card
                                    company may take 4-7 working days to credit your account.</p>

                                <p class="m-b-15x"><strong>Late or missing refunds (if applicable)</strong></p>
                                <p class="m-b-15x">
                                    a) If you haven’t received a refund yet, first check your bank account again.<br>
                                    b) Then contact your credit card company, it may take some time before your refund
                                    is
                                    officially posted.<br>
                                    c) Next contact your bank. There is often some processing time before a refund is
                                    posted.<br>
                                    d) If you’ve done all of this and you still have not received your refund yet,
                                    please
                                    contact us at <a href="mailto:service@motif.me" class="text-underLine">service@motif
                                        .me</a>.
                                </p>

                                <p class="m-b-15x"><strong>Exchanges (if applicable)</strong></p>
                                <p class="m-b-15x">We only replace items if they are defective, damaged or the wrong
                                    items. If
                                    you need to exchange it for the same item, send us an application email at <a
                                            href="mailto:service@motif.me" class="text-underLine">service@motif.me</a>.
                                </p>

                                <p class="m-b-15x"><strong>Shipping</strong></p>
                                <p class="m-b-15x">After your application is approved, please follow the Return
                                    Instruction email from Customer Service and send your product to: 1937 Davis Street,
                                    Ste. B Unit 30，San Leandro CA 94577-1226.</p>
                                <p class="m-b-15x">You will be responsible for the shipping costs for returning your
                                    item. Shipping costs are non-refundable. If you receive a refund, the cost of return
                                    shipping will be deducted from your refund (exceptions may apply).</p>
                                <p class="m-b-15x">If you are shipping an item over $50, you should consider using a
                                    trackable
                                    shipping service or purchasing shipping insurance. We don’t guarantee that we will
                                    receive
                                    your returned items.</p>
                                <p class="m-b-15x">Depending on where you live, the time it may take for your exchanged
                                    product
                                    to reach you, may vary.</p>
                                <p class="m-b-0">For any further queries, please email us at service@motif.me.</p>
                            </div>
                        </div>

                    </section>
                    <!-- 页脚 功能链接 -->
                    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
                        @include('footer')
                    @endif
                </div>
        </div>
</body>
<script src="scripts/vendor.js"></script>
@include('global')
</html>
