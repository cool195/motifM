<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invite Code</title>
    <meta property="og:image" content="/images/background/invite.jpg"/>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/login.css{{'?v='.config('app.version')}}">
</head>
<body>
@include('check.tagmanager')
<img src="/images/background/invite.jpg" alt="" hidden>

<div class="invite-container">
    <div class="text-center">
        <div class="m-b-20x p-b-10x"><span class="invite-arrow"></span></div>
        <div class="p-x-20x p-y-10x bg-primary font-size-sm" onclick="invite();"><span class="p-x-10x">DOWNLOAD MOTIF</span>
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
</html>
