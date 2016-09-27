<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skip Designer</title>
</head>
<body>
@include('check.tagmanager')
<button id="btnClick"></button>
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
    var url = '';
    if (Device === 1) {
        url = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a25acca5c8c39f&network_id=5033&device_id=device_id&site_id=1";
    } else if (Device === 0) {
        url = "https://c89mm.app.goo.gl/Y2QC";
    } else {
        url = "http://m.motif.me";
    }

    $('#btnClick').on('click', function () {
        window.location.href = url
    });


    $('#btnClick').click();
</script>
</body>
</html>
