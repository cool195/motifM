<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Customer Support</title>
    <link rel="icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/profileSetting-customerSupport.css">

    <script src="/scripts/vendor/modernizr.js"></script>

    <script src="/scripts/vendor/fastclick.js"></script>

</head>

<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
    @include('nav')
    <!-- 主体内容 -->
    <div class="body-container">
        @include('navigator')
        <!-- 提交问题反馈 表单 -->
        <section class="m-b-20x">
            <form method="post" id="form-customerSupport">
                <article class="font-size-md text-main p-y-10x p-x-15x" data-type="{{$customers['feedback_type']}}"><strong>{{ $customers['feedback_name'] }}</strong></article>

                <div class="warning-info text-warning font-size-sm flex flex-alignCenter text-left p-x-15x m-b-10x off">
                    <i class="iconfont icon-caveat icon-size-md p-r-5x"></i>
                    <span>Warning:Please fill out all fieldes.</span>
                </div>
                <fieldset class="bg-white m-b-10x message-type" data-type="{{ $customers['feedback_type'] }}" data-stype="">
                    <a class="p-a-15x flex flex-alignCenter flex-fullJustified btn-massageType" href="#">
                        <span class="font-size-sm text-primary">Question Type</span>
                        <i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
                    </a>
                    <div class="messageType-list bg-white text-primary font-size-sm">
                        @foreach($customers['feedback'] as $feed)
                            <a class="message-item p-a-15x flex text-primary" data-message-stype="{{ $feed['feedback_sub_type'] }}">{{$feed['feedback_sub_name']}}</a>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset>
                    <input class="form-control form-control-block p-a-15x font-size-sm" name="email" id="email" type="text" value="{{ Session::get('user.login_email') }}" placeholder="Your Email">
                    <hr class="hr-base m-a-0">
                    <div class="message-info">
                        <textarea class="form-control form-control-block p-a-15x font-size-sm" id="content" placeholder="Message" name="content" rows="10" data-length="1000"></textarea>
                        <span class="message-wordNumber font-size-sm text-primary"><span id="wordNum">0</span>/1000</span>
                    </div>
                </fieldset>
                <div class="container-fluid p-a-15x">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="btn btn-primary-outline btn-block btn-sm" data-role="cancel">Cancel</a>
                        </div>
                        <div class="col-xs-6">
                            <div class="btn btn-primary btn-block btn-sm" data-role="submit">Send</div>
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
        <div class="font-size-base">Question sent!</div>
        <div class="p-t-5x">We will contact you as<br> soon as possible！</div>
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
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/profileSetting-customerSupport.js"></script>
</html>
