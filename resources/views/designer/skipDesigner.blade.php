<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skip Designer</title>
</head>
<body>
@include('check.tagmanager')

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
        url = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a40b7b7adfe749&network_id=5033&device_id=device_id&site_id=1";
    } else if (Device === 0) {
        url = "https://c89mm.app.goo.gl/0XdJ";
    } else {
        url = "http://m.motif.me/designer/99";
    }
    window.location.href = url

//    if (Device === 1) {
//        window.location.href = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
//        setTimeout(function() {
//            window.location.href = "http://m.motif.me/designer/99";
//        }, 2000);
//    } else if (Device === 0) {
//        window.location.href = "motif://o.c?a=url&url=http://m.motif.me/designer/99";
//        setTimeout(function() {
//            window.location.href = "http://m.motif.me/designer/99";
//        }, 2000);
//    } else {
//        window.location.href = "http://m.motif.me/designer/99";
//    }
</script>
</body>
</html>
