<!DOCTYPE html>
<html lang="en">
<head>
    <title>App Test</title>
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/vendor.css{{'?v='.config('app.version')}}">
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
        <li><a href="https://www.motif.me/cassandra?utm_medium=juchao&utm_source=fb">cassTest</a></li>
        <li><a href="motif://o.c?a=url&url=http%3A%2F%2Fm.motif.me%2Fdesigner%2F103">103</a></li>
        <li><a href="javascript:;" id="skip">testSkip</a></li>
        @if($mobile)
            <li>is mobile</li>
        @else
            <li>is pc</li>
        @endif
        <li>
            <a href="https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a40b7b7adfe749&network_id=5033&device_id=device_id&site_id=1">kochava</a>
        </li>

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
    $('#skip').on('click', function () {
        if (Device === 1) {
            setTimeout(function () {
                window.location = "http://m.motif.me/designer/99";
            }, 2000);
            window.location = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
        } else if (Device === 0) {
            setTimeout(function () {
                window.location = "http://m.motif.me/designer/99";
            }, 2000);
            window.location = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
        } else {
            window.location = "http://m.motif.me/designer/99";
        }
    });
</script>
</html>
