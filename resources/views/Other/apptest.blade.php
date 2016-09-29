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
    </ul>
</div>
</body>

</html>
