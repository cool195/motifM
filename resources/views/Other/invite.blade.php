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
    <img style="z-index: -1000;display: block" width="1" height="0" src="{{env('CDN_Static')}}/images/background/invite.jpg"/>
    @include('nav')
    <div class="body-container bg-white">
        @include('navigator', ['pageScope'=>true])

        <div class="invite-container">
            <div class="bg-invite">
                <img class="img-fluid" src="{{env('CDN_Static')}}/images/background/bg-invite-up.jpg" alt="">
                <div class="text-center code">
                    <div class="m-b-10x text-white font-size-sm text-center">Claim your credit with promo code: <span class="text-primary">{{$code}}</span></div>
                    <div class="p-y-10x"><span class="p-x-20x p-y-10x bg-white font-size-sm clickcode" data-code="{{$code}}"><span class="text-primary">Register Now</span></span></div>
                </div>
            </div>
            <img class="img-fluid" src="{{env('CDN_Static')}}/images/background/bg-invite-down.jpg" alt="">
        </div>
        <div class="foot-invite p-b-15x">
            <div class="p-y-10x text-center text-primary font-size-sm"><strong>FREE US SHIPPING + EASY RETURNS</strong></div>
            <hr class="hr-base m-a-0">
            <div class="text-center font-size-xs p-t-10x">
                <a class="text-common p-x-10x" href="/aboutmotif">About Motif</a>
                <a class="text-common p-x-10x" href="/faq">FAQ</a>
                <a class="text-common p-x-10x" href="/termsconditions">Terms & Conditions</a>
            </div>
            <div class="text-center p-y-10x">
                <a class="p-x-10x" href="https://www.facebook.com/motifme"><img src="/images/icon/icon-fac.png" width="15" height="15" alt=""></a>
                <a class="p-x-10x" href="https://www.instagram.com/motifme/"><img src="/images/icon/icon-ins.png" width="15" height="15" alt=""></a>
                <a class="p-x-10x" href="https://www.pinterest.com/motifme/"><img src="/images/icon/icon-pin.png" width="15" height="15" alt=""></a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
<script type="text/javascript">

    $('.clickcode').on('click',function () {
        setCookie('sharecode', $(this).data('code'));
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
