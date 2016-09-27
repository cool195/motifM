<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skip Designer</title>
</head>
<body>
@include('check.tagmanager')
<script type="text/javascript">


    function ios() {
        var ifr = document.createElement("iframe");
        ifr.src = "motif://o.c?a=url&url="+encodeURI('http://m.motif.me/designer/92');
        /***打开app的协议，有ios同事提供***/
        ifr.style.display = "none";
        document.body.appendChild(ifr);
        window.setTimeout(function () {
            document.body.removeChild(ifr);
            window.location.href = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a25acca5c8c39f&network_id=5033&device_id=device_id&site_id=1";
            /***下载app的地址***/
        }, 3000)
    }


    function android() {
        window.open("motif://o.c?a=url&url="+encodeURI('http://m.motif.me/designer/92'));
        /***打开app的协议，有安卓同事提供***/
        window.setTimeout(function () {
            window.location.href = "https://c89mm.app.goo.gl/Y2QC";
            /***打开app的协议，有安卓同事提供***/
        }, 3000);
    }


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
    //
    var Device = switchDevice();
    if (Device === 1) {
        ios()
        //window.location.href = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a25acca5c8c39f&network_id=5033&device_id=device_id&site_id=1";
    } else if (Device === 0) {
        android()
        //window.location.href = "https://c89mm.app.goo.gl/Y2QC";
    } else {
        window.location.href = "http://m.motif.me";
    }

</script>
</body>
</html>
