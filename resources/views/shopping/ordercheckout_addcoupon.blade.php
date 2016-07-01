<!DOCTYPE html>
<html lang="en">
<head>

    <title>Add Coupon</title>
    @include('head')

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
            <!-- 添加coupon -->
            <section class="m-b-20x">
                <article class="font-size-md text-main p-a-10x"><strong>Promotion Code</strong></article>
                    <fieldset>
                        <div class="warning-info flex text-warning flex-alignCenter text-left p-a-15x" hidden>
                            <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                            <span class="font-size-sm"></span>
                        </div>
                        <input class="form-control form-control-block p-a-15x font-size-sm" type="text" name="coupon" placeholder="Enter your code" value="{{$cps}}">
                    </fieldset>
                    <div class="bg-white p-a-15x">
                        <div class="btn btn-primary btn-block btn-sm" data-role="submit">Apply</div>
                    </div>

            </section>
        </div>
    </div>
@include('footer')
    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
<form id="infoForm" method="get" action="/cart/ordercheckout" method="get">
    @if(isset($input) && !empty($input))
        <input type="hidden" name="cps" value="">
        @foreach($input as $name=>$value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>

</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout-addCoupon.js"></script>
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
