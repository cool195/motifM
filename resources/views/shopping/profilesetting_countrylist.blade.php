<!DOCTYPE html>
<html lang="en">
<head>
    <title>Country List</title>
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
    <!-- 国家列表 -->
        <section class="p-b-10x">
            <article class="p-x-15x p-y-10x font-size-md text-main">
                <strong>Select Country</strong>
            </article>
            <aside class="bg-white m-b-10x">
                @if(isset($commonlist))
                    @foreach($commonlist as $c)
                        <a class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x"
                           href="{{$route}}?country={{base64_encode(json_encode($c))}}" data-cid="{{$c['country_id']}}">
                            <span>{{$c['country_name_en']}}</span>
                        </a>
                        <hr class="hr-base">
                    @endforeach
                @endif
            </aside>
            <aside class="bg-white">
                @if(isset($list))
                    @foreach($list as $l)
                        <a class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x"
                           href="{{$route}}?country={{base64_encode(json_encode($l))}}" data-cid="{{$l['country_id']}}">
                            <span>{{ $l['country_name_en'] }}</span>
                        </a>
                        <hr class="hr-base">
                    @endforeach
                @endif
            </aside>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="/scripts/vendor.js"></script>

@include('global')
</html>
