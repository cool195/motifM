<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Message</title>
    @include('head')
    <link rel="stylesheet" href="/styles/orderCheckout-message.css">


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
            <!-- 提交备注 表单 -->
            <section class="m-b-20x">
                <form id="infoForm" action="/cart/ordercheckout" method="get">
                    <fieldset>
                        <div class="message-info">
                            <textarea class="form-control form-control-block p-a-15x font-size-sm" name="remark" id="messageContent"  placeholder="Message to us" rows="12" data-length="1000">{{$remark}}</textarea>
                            <span class="message-wordNumber font-size-sm text-primary"><span id="wordNum">0</span>/1000</span>
                        </div>
                    </fieldset>
                    <div class="p-a-15x">
                        <button class="btn btn-primary btn-block btn-sm" type="submit">Save</button>
                    </div>
                    @if(isset($input) && !empty($input))
                        @foreach($input as $name =>$value)
                            <input type="hidden" name="{{$name}}" value="{{$value}}">
                        @endforeach
                    @endif
                </form>
            </section>

<!-- 页脚 功能链接 start-->
@include('footer')
<!-- 页脚 功能链接 end-->
        </div>
    </div>
    <!-- loading 效果 -->
    <div class="loading loading-screen loading-switch loading-hidden">
        <div class="loader loader-screen"></div>
    </div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/orderCheckout-message.js"></script>
@include('global')
</html>
