<!DOCTYPE html>
<html lang="en">
<head>
    <title>App Test</title>
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/vendor.css{{'?v='.config('app.version')}}">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
</head>
<body>

<div id="body-content">
    <ul>
        <li><a href="motif://o.c?a=promolist&code=1234">Promolist-Code</a></li>
        <li><a href="motif://o.c?a=promolist">Promolist</a></li>
        <li><a href="motif://o.c?a=invitefriend">Invitefriend</a></li>
        <li><a href="motif://o.c?a=url&url=http://m.motif.me/designer/92">androidSkip</a></li>
        <li><a href="http://motif.me/designer/92">selfSkip</a></li>
        <li><a href="http://test.m.motif.me/downapp">Rae</a></li>
        <li><a href="http://test.m.motif.me/rae">Rae</a></li>

        <li><a href="javascript:;" id="skip">testSkip</a></li>
    </ul>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
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

    var Device = switchDevice();
    $('#skip').on('click',function () {
        if (Device === 1) {
            setTimeout(function() {
                window.location = "http://m.motif.me/designer/99";
            }, 2000);
            window.location = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
        } else if (Device === 0) {
            setTimeout(function() {
                window.location = "http://m.motif.me/designer/99";
            }, 2000);
            window.location = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
        } else {
            window.location = "http://m.motif.me/designer/99";
        }
    });


//    <meta http-equiv="refresh" content="1"; url="https://itunes.apple.com/us/app/motif-shopping-fashion-jewelry/id1125850409?l=zh&ls=1&mt=8">
//    <script> window.onload = function() {
//        setTimeout("window.location = 'https://itunes.apple.com/us/app/motif-shopping-fashion-jewelry/id1125850409?l=zh&ls=1&mt=8';", 1000);
//        window.location = "motif://o.c?a=url&url=http%3a%2f%2fm.motif.me%2fdesigner%2f99";
//    }
</script>
</html>
