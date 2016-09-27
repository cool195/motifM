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
    if (Device === 1) {
        window.location.href = "https://itunes.apple.com/us/app/id1125850409";
    } else if (Device === 0) {
        window.location.href = "https://play.google.com/store/apps/details?id=me.motif.motif";
    } else {
        window.location.href = "http://m.motif.me";
    }

//    var Device = switchDevice();
//    if (Device === 1) {
//        window.location.href = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a25acca5c8c39f&network_id=5033&device_id=device_id&site_id=1";
//    } else if (Device === 0) {
//        window.location.href = "https://c89mm.app.goo.gl/Y2QC";
//    } else {
//        window.location.href = "http://m.motif.me";
//    }

</script>
</body>
</html>
