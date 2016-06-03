        <section>
            <article class="font-size-md text-main p-y-10x p-x-15x"><strong>Order Details</strong></article>

            <!-- 订单主要信息:日期、订单号、总金额 -->
            <article class="bg-white font-size-sm p-y-10x p-x-15x m-b-10x">
                <div class="flex text-primary">
                    <span class="orderInfo-subTitle flex-fixedShrink">Order date</span>
                    <span>{{$data['create_time']}}</span>
                </div>
                <div class="flex text-primary">
                    <span class="orderInfo-subTitle flex-fixedShrink">Order #</span>
                    <span>{{$data['sub_order_no']}}</span>
                </div>
                <div class="flex text-primary">
                    <span class="orderInfo-subTitle flex-fixedShrink">Order total</span>
                    <span>${{$data['total_amount']}}({{ $data['item_qtty'] }} item)</span>
                </div>
            </article>

            <!-- 订单商品列表 -->
            <aside class="bg-white m-b-10x">
                <!-- 正常订单 下单日期 -->
                <div class="p-y-10x p-x-15x">
                    <span class="font-size-sm text-primary"><strong>ORDER PLACED:</strong> {{$data['create_time']}} </span>
                </div>

                <!-- 被取消的订单 取消原因、取消日期 -->
                <!--<div class="p-a-10x">-->
                <!--<div class="font-size-sm text-primary"><strong>CANCELLED:</strong> <span>Apr 14, 2016</span></div>-->
                <!--<div class="font-size-sm text-primary"><div>Order payment failed:</div>-->
                <!--<div>Apr 15, 2016 - Apr 17, 2016 </div></div>-->
                <!--</div>-->

                <hr class="hr-base m-y-0 m-l-15x">
                @foreach($data['lineOrderList'] as $lineOrderList)
                <div class="flex p-y-10x p-x-15x">
                    <div class="flex-fixedShrink">
                        <img class="img-thumbnail" src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$lineOrderList['img_path'] }}" width="70px" height="70px">
                    </div>
                    <!-- TODO 缩略号的兼容性不好, 需要改样式 -->
                    <div class="p-x-10x order-product-title">
                        <h6 class="text-main font-size-md text-truncate">
                            <strong>{{$lineOrderList['main_title']}}</strong>
                        </h6>
                        <aside class="text-primary font-size-sm">
                            <div><span>Size: </span><span>11</span></div>
                            <div><span>Color: </span><span>Black</span></div>
                            <div><span>Qty: </span><span>{{$lineOrderList['sale_qtty']}}</span></div>
                        </aside>
                    </div>
                </div>
                <hr class="hr-base m-y-0 m-l-15x">
                @endforeach
                <!-- 正常订单 跟踪货物 -->
                <a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-y-10x p-x-15x">
                    Track Shipment
                    <i class="iconfont icon-arrow-right icon-size-xm text-common p-r-10x"></i>
                </a>

                <!-- 被取消的订单 重新购买按钮 -->
                <!--<div class="p-a-10x">-->
                <!--<a href="#" class="btn btn-primary btn-block btn-sm" type="bottom">Buy Again</a>-->
                <!--</div>-->

            </aside>

            <!-- 订单地址、物流、支付 等信息 -->
            <aside class="bg-white m-b-10x">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Ships to</span>
                    <div>
                        <div>{{ $data['userAddr']['email'] }}</div>
                        <div>{{ $data['userAddr']['detail_address1'] }}</div>
                        <div>{{ $data['userAddr']['detail_address2'] }}</div>
                        <div>{{$data['userAddr']['city']." ".$data['userAddr']['state']." ".$data['userAddr']['zip'] }}</div>
                        <div>{{$data['userAddr']['country']}}</div>
                    </div>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Delivery</span>
                    <span>{{$data['logistics_name']}} +14.5$</span>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Pay with</span>
                    <span>{{ $data['pay_type'] }}</span>
                </div>
                <hr class="hr-base">
                <div class="flex font-size-sm text-primary p-y-10x p-x-15x">
                    <span class="orderInfo-subTitle flex-fixedShrink">Message to Us</span>
                    <div>
                        <div id="messageInfo">
                            <p>{{ $data['status_explain'] }}</p>
                        </div>
                        <a class="flex flex-alignCenter flex-fullJustified font-size-xs text-common" id="btnShowMore">
                            <span id="showMore">Show More</span>
                            <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- 订单金额 -->
            <aside class="bg-white m-b-10x">
                <div class="p-a-10x">
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Items({{ $data['item_qtty'] }})</span><span>${{$data['pay_amount']}}</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Extra</span><span>$21</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Shipping to 10000</span><span>${{ $data['freight_amount'] }}</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Discount</span><span>-{{ $data['promot_discount_amount'] }}%</span>
                    </div>
                    <div class="flex flex-fullJustified text-primary font-size-sm">
                        <span>Coupon</span><span>-${{ $data['cps_amount'] }}</span>
                    </div>
                    <div class="flex flex-fullJustified p-t-10x text-primary font-size-sm">
                        <span><strong>Order Total</strong></span><span><strong>${{ $data['total_amount'] }}</strong></span>
                    </div>
                </div>
                <hr class="hr-base m-a-0">
                <!-- 服务质量保证 -->
                <div class="media m-a-0 p-a-10x">
                    <div class="media-left media-middle">
                        <img class="media-object" src="/images/icon/icon-guarantee.png" srcset="/images/icon/icon-guarantee@2x.png 2x, /images/icon/icon-guarantee@3x.png 3x" alt="">
                    </div>
                    <div class="media-body media-middle">
                        <p class="font-size-sm text-primary m-a-0 p-r-2">MOTIF guarantee quality merchandise and
                                                                         return
                                                                         service</p>
                    </div>
                </div>
            </aside>

            <!-- 联系客服 -->
            <aside class="bg-white m-b-10x p-a-10x">
                <a href="#" class="btn btn-primary btn-block btn-sm" type="submit">Contact Service</a>
            </aside>

        </section>