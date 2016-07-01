<!DOCTYPE html>
<html lang="en">
<head>

    <title>@if(2==$skiptype) Contact Service @else Ask a Question @endif</title>
    @include('head')
    <link rel="stylesheet" href="/styles/shoppingDetail-askQuestion.css">

</head>

<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@include('nav')
<!-- 主体内容 -->
    <div class="body-container">
    @include('navigator')
    <!-- 提交问题反馈 表单 -->
        <section class="m-b-20x">
            <form method="post" id="form-askQuestion" action="/askshopping">
                <article class="font-size-md text-main p-y-10x p-x-15x"><strong>@if(2==$skiptype) Contact Service @elseif(3==$skiptype) Inquiries @else Ask a Question @endif</strong></article>
                <fieldset>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="skiptype" value="{{$skiptype}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="form-control form-control-block p-a-15x font-size-sm" id="email" name="email" type="text"
                           placeholder="Your Email" value="{{Session::get('user.login_email')}}">
                    <hr class="hr-base m-a-0">
                    <div class="message-info">
                        <textarea class="form-control form-control-block p-a-15x font-size-sm" name="content" id="content"
                                  placeholder="Message" rows="10" data-length="1000"></textarea>
                        <span class="message-wordNumber font-size-sm text-primary"><span
                                    id="wordNum">0</span>/1000</span>
                    </div>
                </fieldset>
                <div class="container-fluid p-a-15x">
                    <button class="btn btn-primary btn-block btn-sm" id="submit" data-spu="123">Send</button>
                </div>
            </form>
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

<script src="/scripts/shoppingDetail-askQuestion.js"></script>
@include('global')
</html>
