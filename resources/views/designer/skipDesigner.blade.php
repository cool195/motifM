<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skip Designer</title>
</head>
<body>
@include('check.tagmanager')
<script type="text/javascript">

    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

    if(isiOS){
        function ios(){
            var ifr = document.createElement("iframe");
            ifr.src = "motif://o.c?a=orderdetail&id=92"; /***打开app的协议，有ios同事提供***/
            ifr.style.display = "none";
            document.body.appendChild(ifr);
            window.setTimeout(function(){
                document.body.removeChild(ifr);
                window.location.href = "https://control.kochava.com/v1/cpi/click?campaign_id=komotif-kvced5a25acca5c8c39f&network_id=5033&device_id=device_id&site_id=1"; /***下载app的地址***/
            },2000)
        };
    }

    if(isAndroid) {
        function android() {
            window.location.href = "motif://o.c?a=orderdetail&id=92";
            /***打开app的协议，有安卓同事提供***/
            window.setTimeout(function () {
                window.location.href = "https://c89mm.app.goo.gl/Y2QC";
                /***打开app的协议，有安卓同事提供***/
            }, 2000);
        };
    }

//    function switchDevice() {
//        var Agent = navigator.userAgent;
//        if (/iPhone/i.test(Agent)) {
//            return 1;
//        } else if (/Android/i.test(Agent) || /Linux/i.test(Agent)) {
//            return 0;
//        } else {
//            return -1;
//        }
//    }
//
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
