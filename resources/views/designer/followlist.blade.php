<!DOCTYPE html>
<html lang="en">
<head>

    <title>Following List</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingCart.css{{'?v='.config('app.version')}}">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/remodal.css{{'?v='.config('app.version')}}">


</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    @include('nav')
    <div class="body-container">
        @include('navigator')
        <article class="font-size-md text-main p-a-10x"><strong>Following</strong></article>
        <!-- folloinglist 商品列表 -->
        <section class="reserve-height">
            <aside id="followingContainer" class="followList m-b-20x">

            @if(empty($followlist))
                <!-- 空 followinglist 提示信息 -->
                    <div class="shopbag-empty-content p-x-10x" id="emptyFollowlist">
                        <div class="container shopbag-emptyInfo">
                            <div class="m-b-20x p-b-5x"><i class="btn-shopbagEmpty iconfont icon-like"></i></div>
                            <p class="text-primary font-size-sm m-b-20x p-b-20x">Your folloinglist is empty!</p>
                        </div>
                    </div>
            @else
                <!-- 商品列表 -->
                    @foreach($followlist as $value)
                        <div class="followlist-item bg-white p-a-15x" data-followingdid="{{$value['userId']}}">
                            <div class="flex">
                                <div class="flex-fixedShrink">
                                    <a href="#">
                                        <img class="img-thumbnail img-lazy"
                                             src="{{env('CDN_Static')}}/images/product/bg-product@70.png"
                                             data-original="{{env('APP_Api_Image')}}/n2/{{$value['avatar']}}"
                                             width="70" height="70">
                                    </a>
                                </div>
                                <div class="p-l-10x flex-width">
                                    <article class="flex flex-fullJustified followlist-title">
                                        <a href="#"><h6 class="text-main font-size-md p-r-20x"><strong>{{$value['nickname']}}</strong>
                                            </h6></a>
                                <span class="text-primary font-size-sm flex-fixedShrink @if(empty($value['description'])){{'middle'}}@else{{'top'}}@endif">
                                    <a class="btn btn-primary btn-sm updateFollow" data-did="{{$value['userId']}}">Following</a>
                                </span>
                                    </article>
                                    <aside class="text-primary font-size-xs followlist-info">
                                        <a href="#" class="text-primary">{{$value['description']}}</a>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </aside>
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
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script src="{{env('CDN_Static')}}/scripts/follwlist.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
