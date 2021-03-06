<!DOCTYPE html>
<html lang="en">
<head>

    <title>@if(2==$skiptype) Contact Service @else Ask a Question @endif</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingDetail-askQuestion.css{{'?v='.config('app.version')}}">

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
        <section class="m-b-20x reserve-height">
            <form method="post" id="form-askQuestion" action="/askshopping">
                <article class="font-size-md text-main p-y-10x p-x-15x bg-title"><strong>@if(2==$skiptype) Contact Service @elseif(3==$skiptype) Inquiries @else Ask a Question @endif</strong></article>
                <hr class="hr-base m-a-0">
                <fieldset>
                    <input type="hidden" name="id" value="{{$id}}">
                    <input type="hidden" name="skiptype" value="{{$skiptype}}">
                    <input class="form-control form-control-block p-a-15x font-size-sm" id="email" name="email" type="text"
                           placeholder="Your Email" value="{{Session::get('user.login_email')}}">
                    <hr class="hr-base m-a-0">
                    <div class="message-info">
                        <textarea class="form-control form-control-block p-a-15x font-size-sm" name="content" id="content"
                                  placeholder="Message" rows="10" data-length="5000"></textarea>
                        <span class="message-wordNumber font-size-sm text-primary"><span id="wordNum">0</span>/5000</span>
                    </div>
                </fieldset>
                <hr class="hr-base m-a-0">
                <div class="container-fluid p-a-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{Session::has('referer') ? Session::get('referer') : '/order/orderlist'}}" class="btn btn-primary-outline btn-block" data-role="cancel">Cancel</a>
                        </div>
                        <div class="col-xs-6">
                            <div class="btn btn-primary btn-block" data-role="submit" data-spu="123">Send</div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!-- 页脚 功能链接 -->
        @include('footer')
    </div>
</div>

<!-- 提示添加成功 -->
<div class="remodal remodal-md modal-content" data-remodal-id="question-modal" id="askQuestion">
    <div class="font-size-sm p-t-20x p-x-15x p-b-15x">
        <div class="font-size-base">Submission successful</div>
        <div class="p-t-5x">We will contact you as soon as possible!</div>
    </div>
    <hr class="hr-base m-a-0">
    <div class="btn-group flex">
        <a href="" class="btn remodal-btn flex-width text-primary" id="confirmQuestion">OK</a>
    </div>
</div>

<!-- loading 效果 -->
<div class="loading loading-screen loading-switch loading-hidden">
    <div class="loader loader-screen"></div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>

<script src="{{env('CDN_Static')}}/scripts/shoppingDetail-askQuestion.js{{'?v='.config('app.version')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('global')
</html>
