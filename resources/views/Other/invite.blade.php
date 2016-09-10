<!DOCTYPE html>
<html lang="en">
<head>
    <title>Get $20 as your accessories finance on Motif</title>
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/vendor.css{{'?v='.config('app.version')}}">
    <script src="{{env('CDN_Static')}}/scripts/vendor/modernizr.js{{'?v='.config('app.version')}}"></script>
    <script src="{{env('CDN_Static')}}/scripts/vendor/fastclick.js{{'?v='.config('app.version')}}"></script>
    <meta property="og:image" content="http://test.m.motif.me/images/background/invite.jpg"/>
    <meta property="og:title" content="Get $20 as your accessories finance on Motif">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/login.css{{'?v='.config('app.version')}}">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
</head>
<body>
@include('check.tagmanager')
<div id="body-content">
    @include('nav')
    <div class="body-container">
        @include('navigator', ['pageScope'=>true])

        <div class="invite-container">
            <img style="z-index: -1000" src="http://test.m.motif.me/images/background/invite.jpg" />
            <div class="text-center">
                <div class="m-b-20x">USE CODE: {{$code}}</div>
                <div class="m-b-20x p-b-10x"><span class="invite-arrow"></span></div>
                <div class="p-x-20x p-y-10x bg-primary font-size-sm" onclick="invite();"><span class="p-x-10x">DOWNLOAD MOTIF</span>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function switchDevice() {
        var Agent = navigator.userAgent;
        if (/iPhone/i.test(Agent)) {
            return 1;
        } else if (/Android/i.test(Agent) || /Linux/i.test(Agent)) {
            return 0;
        } else {
            return -1;
        }
    }

    function invite() {
        var Device = switchDevice();
        if (Device === 1) {
            window.location.href = "https://itunes.apple.com/us/app/id1125850409";
        } else if (Device === 0) {
            window.location.href = "https://play.google.com/store/apps/details?id=me.motif.motif";
        } else {
            window.location.href = "http://m.motif.me";
        }
    }

</script>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
</html>
