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
    <li>
        <a href="motif://o.c?a=promolist&code=1234">Promolist-Code</a>
        <a href="motif://o.c?a=promolist">Promolist</a>
        <a href="motif://o.c?a=invitefriend">Invitefriend</a>
    </li>
</ul>
</div>
</body>
</html>
