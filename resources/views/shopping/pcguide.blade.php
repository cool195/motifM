<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Motif Exclusive Fashion Accessories Designed by the World’s Top Fashion Bloggers, Instagrammers and Digital
        Influencers</title>
    <meta name="keywords"
          content="fashion,style,shop,accessory,jewelry,watch,blogger,Instagram,designer,limited,edition,ecommerce,buy"/>

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/pc-main.css">
</head>

<body>
<!--[if lt IE 10]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<div class="bg">
    <div class="nav-content">
    @if($referer)
        <nav class="navbar">
            <div class="nav nav-url">
                <span>This URL is not supported by PC. Please use a mobile device to access this URL:&nbsp;</span>
                <div class="">
                    <span>{{$referer}}</span>
                    {{--<span class="btn btn-copy">copy url</span>--}}
                </div>
            </div>
        </nav>
    @endif
    </div>
    <div class="main-container">
        <div class="content p-t-3">
            <div class="container-fluid">
                <div class="row content-item p-b-3">
                    <div class="col-xs-6">
                        <section>
                            <div class="p-b-3">
                                <img class="" src="{{env('CDN_Static')}}/images/pc/img-title.png" alt="">
                            </div>
                            <ul class="list-unstyled p-y-3 text-main">
                                {{--<li class="flex-center m-b-2">--}}
                                    {{--<div class="item-title">Mobile URL:</div>--}}
                                    {{--<div><a class="text-main text-link" href="/">www.motif.me</a></div>--}}
                                {{--</li>--}}
                                <li class="flex-center m-b-2">
                                    <div class="item-title">Download:</div>
                                    <div>
                                        <a href="https://itunes.apple.com/us/app/id1125850409"
                                           class="btn btn-primary"><img src="{{env('CDN_Static')}}/images/pc/button-iphone.png" alt=""></a>

                                        <a href="https://play.google.com/store/apps/details?id=me.motif.motif"
                                           class="btn btn-primary"><img src="{{env('CDN_Static')}}/images/pc/button-google.png" alt=""></a>
                                    </div>
                                </li>
                                <li class="flex-center m-b-3">
                                    <div class="item-title">Follow Us:</div>
                                    <div>
                                        <a target="_blank" href="https://www.facebook.com/motifme" class="p-r-1 m-r-1"><img src="{{env('CDN_Static')}}/images/pc/icon-facebook.png" alt=""></a>
                                        <a target="_blank" href="https://www.instagram.com/motifme/" class="p-r-1 m-r-1"><img src="{{env('CDN_Static')}}/images/pc/icon-ins.png" alt=""></a>
                                        <a target="_blank" href="https://www.pinterest.com/motifme/" class="p-r-1 m-r-1"><img src="{{env('CDN_Static')}}/images/pc/icon-pinterest.png" alt=""></a>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-xs-6">
                        <img class="img-fluid" src="{{env('CDN_Static')}}/images/pc/img-phone.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center p-b-1 font-size-base">
        <div class="footer-content">
            <div class="footer-links">
                <a class="pull-left text-main text-link" href="/pcprivacypolicy">Privacy Notice</a>
                <a class="pull-right text-main text-link" href="/pctermsservice">Terms & Conditions</a>
            </div>
            <div class="text-main p-t-10x">Copyright © 2016 Motif Group LLC. All rights reserved.</div>
        </div>
    </div>
</div>
<footer></footer>
</body>

</html>
