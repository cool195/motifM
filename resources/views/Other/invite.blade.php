<!DOCTYPE html>
<html lang="en">
<head>
    <title>Get $20 off your first jewelry purchase! designed by the world’s top Fashion Bloggers,Instagrammers,and Digital Influencers.</title>
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/vendor.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/modernizr.js{{'?v='.config('app.version')}}"></script>
    <script src="{{env('CDN_Static')}}/scripts/vendor/fastclick.js{{'?v='.config('app.version')}}"></script>
    <meta property="og:image" content="{{env('CDN_Static')}}/images/background/invite.jpg"/>
    <meta property="og:title" content="Get $20 off your first jewelry purchase! designed by the world’s top Fashion Bloggers,Instagrammers,and Digital Influencers.">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/login.css{{'?v='.config('app.version')}}">
</head>
<body>
@include('check.tagmanager')
<div id="body-content">
    @include('nav')
    <div class="body-container">
        @include('navigator', ['pageScope'=>true])

        <div class="invite-container">

            <div class="text-center">
                <div class="m-b-20x">USE CODE: {{$code}}</div>
                <div class="p-x-20x p-y-10x bg-primary font-size-sm"><span
                            class="p-x-10x clickcode">{{$code}}</span>
                </div>
            </div>
        </div>
    </div>
</div>


<img style="z-index: -1000" width="1" src="{{env('CDN_Static')}}/images/background/invite.jpg"/>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script type="text/javascript">

    $('.clickcode').on('click',function () {
        setCookie('sharecode', $(this).html());
        window.location.href = '/login?url=%2Fpromocode';
    })

    function setCookie(name, value) {
        var Time = 24;
        var exp = new Date();
        exp.setTime(exp.getTime() + Time * 60 * 60 * 1000);
        document.cookie = name + '=' + escape(value) + ';path=/;expires=' + exp.toGMTString();
    }
</script>
</html>
