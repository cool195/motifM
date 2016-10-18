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
    <!-- 洲列表 -->
        <section class="p-b-10x reserve-height">
            <article class="p-x-15x p-y-10x font-size-md text-main bg-title">
                <strong>Select State</strong>
            </article>
            <hr class="hr-base m-a-0">
            <aside class="bg-white">
                @if(isset($commonlist))
                    @foreach($commonlist as $c)
                        <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x " data-state="{{base64_encode(json_encode($c))}}" data-cid="{{$c['state_id']}}">
                            <span>{{$c['state_name_en']}}</span>
                        </div>
                        <hr class="hr-base">
                    @endforeach
                @endif
            </aside>
            <aside class="bg-white">
                @if(isset($list))
                    @foreach($list as $l)
                        <div class="flex flex-alignCenter font-size-sm text-primary p-x-15x p-y-10x" data-state="{{base64_encode(json_encode($l))}}" data-cid="{{$l['state_id']}}">
                            <span>{{ $l['state_name_en'] }}</span>
                        </div>
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
<form id="infoForm" action="{{$route}}" method="get" hidden>
    <input type="hidden" name="state" value="">
    @if(isset($input) && !empty($input))
        @foreach($input as $name => $value)
            <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
    @endif
</form>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script>
$("[data-state]").on('click',function () {
    $('input[name="state"]').val($(this).data('state'));
    $('#infoForm').submit();
})
</script>
@include('global')
</html>
