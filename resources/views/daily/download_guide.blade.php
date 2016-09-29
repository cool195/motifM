<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>THE RAEVIEWER X MOTIF</title>
  <link rel="apple-touch-icon" href="{{env('CDN_Static')}}/images/guide/apple-touch-icon.png">
  <link rel="stylesheet" href="http://pc.motif.me/styles/vendor.css">
  <style>
    .guide-title {
      position: relative;
      top: 25px;
      z-index: 3;
    }
    .guide-content {
      color: #000;
      background: url("{{env('CDN_Static')}}/images/guide/guide-bg.jpg") repeat;
      overflow: auto;
      min-height: 80vh;
    }
    .guide-content .bg {
      margin-top: 148px;
      margin-bottom: 144px;
      background: rgba(198, 198, 200, 0.6);
      min-height: 380px;
    }
    .guide-content .content {
      background: rgba(238, 238, 238, 0.9);
    }
    .guide-content .phone-img {
      position: absolute;
      top: -70px;
      left: 80px;
      width: 260px;
    }
    .sanBold {
      font-family: "sanfranciscodisplay bold";
    }
    footer {
      background-color: #171a2b;
      padding: 1.875rem 0;
    }
  </style>

</head>
<body class="bg-white">
@include('check.tagmanager')
<div class="container">
  <div class="guide-title m-t-10x">
    <img src="{{env('CDN_Static')}}/images/guide/guide-title@2x.png">
  </div>
</div>
<div class="guide-content">
  <div class="bg">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-1 p-y-40x">
          <div class="content p-a-40x text-center">
            <div class="font-size-lg p-t-5x p-x-15x">VIEW <span class="sanBold">RAEVIEW’S “KOREATOWN” COLLECTION</span><br> WITH YOUR MOBILE DEVICE!</div>
            <div class="font-size-md p-t-20x p-x-20x">Follow The Raeviewer on our free Motif app<br> and be notified when her collection launches.</div>
          </div>
          <div class="m-t-40x text-center">
            <a href="https://itunes.apple.com/us/app/id1125850409" class="m-r-20x"><img src="{{env('CDN_Static')}}/images/guide/app1@2x.png" width="189"></a>
            <a href="https://play.google.com/store/apps/details?id=me.motif.motif"><img src="{{env('CDN_Static')}}/images/guide/goo1@2x.png" width="189"></a>
          </div>
        </div>
        <div class="col-xs-5">
          <div class="phone-img"><img src="{{env('CDN_Static')}}/images/guide/phone1.png" width="100%"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-2">
        <a href="http://m.motif.me"><img src="{{env('CDN_Static')}}/images/guide/logo-white.png"></a>
      </div>
      <div class="col-xs-7 text-white font-size-lg text-center">
        <div class="p-t-10x">Exclusive accessory designs from your favorite Instagrammers & YouTubers</div>
      </div>
      <div class="col-xs-3 text-center p-t-10x">
        <a href="https://www.instagram.com/motifme/"><img src="{{env('CDN_Static')}}/images/guide/ins@2x.png"></a>
        <a href="https://www.facebook.com/motifme" class="m-l-20x"><img src="{{env('CDN_Static')}}/images/guide/fac@2x.png"></a>
        <a href="https://www.pinterest.com/motifme/" class="m-l-20x"><img src="{{env('CDN_Static')}}/images/guide/pin@2x.png"></a>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
