<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Daily</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/daily.css">

    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
    <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
        <!-- daily 首页列表 -->
        <section>
            <!-- banner 图 -->
            <!-- 图文 -->
            @foreach($daily as $value)
                @if($value['type'] == 1)
                    <div class="bg-white m-b-10x">
                        <a href="@if($value['skipType']==1)/detail/@elseif($value['skipType']==2)/designer/@elseif($value['skipType']==3)/topic/@elseif($value['skipType']==4)/shopping#/@endif{{$value['skipId']}}"><img class="img-fluid" src="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$value['imgPath']}}"></a>
                    </div>
                @else
                    <a href="@if($value['skipType']==1)/detail/@elseif($value['skipType']==2)/designer/@elseif($value['skipType']==3)/topic/@elseif($value['skipType']==4)/shopping#/@endif{{$value['skipId']}}">
                        <div class="bg-white m-b-10x">
                            <div><img class="img-fluid" src="https://s3-us-west-1.amazonaws.com/emimagetest/n0/{{$value['imgPath']}}"></div>
                            <div class="p-a-15x">
                                <h6 class="text-main font-size-base m-b-5x"><strong>{{$value['title']}}</strong></h6>
                                <div class="text-primary font-size-sm">{{$value['subTitle']}}
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>
</body>
<script src="scripts/vendor.js"></script>


</html>
