<footer class="p-y-20x">
    <div class="text-center font-size-sm p-y-5x">
        @if(Session::has('user'))
            <a href="/user/signout" class="text-primary">Sign Out</a>
        @else
            <a href="/login" class="text-primary">Sign in/Register</a>
        @endif
    </div>
    <div class="field-content m-t-15x m-b-20x">
        <div class="field-text font-size-sm">
            Follow Us:&nbsp;
        </div>
        <div class="p-l-15x">
            <a class="share-btn" href="https://www.facebook.com/motifme">
                <img src="{{env('CDN_Static')}}/images/icon/facebook.png"
                     srcset="{{env('CDN_Static')}}/images/icon/facebook@2x.png 2x,{{env('CDN_Static')}}/images/icon/facebook@3x.png 3x">
            </a>
            <a class="share-btn" href="https://www.instagram.com/motifme/">
                <img src="{{env('CDN_Static')}}/images/icon/ins.png"
                     srcset="{{env('CDN_Static')}}/images/icon/ins@2x.png 2x,{{env('CDN_Static')}}/images/icon/ins@3x.png 3x">
            </a>
            <a class="share-btn" href="https://www.pinterest.com/motifme/">
                <img src="{{env('CDN_Static')}}/images/icon/pinterest.png"
                     srcset="{{env('CDN_Static')}}/images/icon/pinterest@2x.png 2x,{{env('CDN_Static')}}/images/icon/pinterest@3x.png 3x">
            </a>
        </div>
    </div>
    <div class="field-content">
        <div class="field-text font-size-sm">
            Download:
        </div>
        <div class="field-items">
            <a href="https://itunes.apple.com/us/app/id1125850409" class="btn btn-black btn-xs">
                <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon/icon-appStore.png"
                     srcset="{{env('CDN_Static')}}/images/icon/icon-appStore@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-appStore@3x.png 3x">
            </a>
            <a href="https://play.google.com/store/apps/details?id=me.motif.motif" class="btn btn-black btn-xs">
                <img class="img-fluid m-x-auto" src="{{env('CDN_Static')}}/images/icon/icon-googlePlay.png"
                     srcset="{{env('CDN_Static')}}/images/icon/icon-googlePlay@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-googlePlay@3x.png 3x">
            </a>
        </div>
    </div>
    <div class="links-group container-fluid p-x-0">
        <hr class="hr-dark m-t-20x m-b-15x">
        <div class="row">
            <div class="col-xs-6">
                <div class="list-group font-size-sm">
                    <div class="list-group-item list-group-itemText-lg text-primary"><strong>MOTIF</strong>
                    </div>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/aboutmotif">About Motif</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/privacynotice">Privacy
                        Notice</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/termsconditions">Terms &
                        Conditions</a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="foot-list-group font-size-sm">
                    <div class="list-group-item list-group-itemText-lg text-primary"><strong>HELP & SERVICE</strong>
                    </div>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/contactus">Contact Us</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/faq">FAQ</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/payments">Payments</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/template/23">Shipping &
                        Returns</a>
                </div>
            </div>
        </div>
        <hr class="hr-dark m-t-20x m-b-15x">
    </div>
    <div class="text-common text-center font-size-xs">Copyright © 2016 Motif Group LLC. All rights reserved.</div>
</footer>
<!-- App 下载提示 -->
<nav class="navbar-fixed-bottom bg-download p-y-5x p-x-10x" hidden>
    <div class="row flex flex-alignCenter">
        <div class="col-xs-9">
            <div class="flex flex-alignCenter">
                <a class="p-r-10x p-y-10x" id="closeDownloading">
                    <i class="iconfont icon-cross text-primary btn-closeDownload icon-size-xm"></i>
                </a>
                <div class="p-r-15x">
                    @if($designer['designer_id']==99)
                        <a href="/downapp"><img src="{{env('CDN_Static')}}/images/icon/icon-motif.png"
                                            srcset="{{env('CDN_Static')}}/images/icon/icon-motif@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-motif@3x.png 3x"
                                            width="40" height="40"></a>
                    @else
                        <a data-role="downloading"><img src="{{env('CDN_Static')}}/images/icon/icon-motif.png"
                                            srcset="{{env('CDN_Static')}}/images/icon/icon-motif@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-motif@3x.png 3x"
                                            width="40" height="40"></a>
                    @endif

                </div>
                @if($designer['designer_id']==99)
                    <a href="/downapp"><div class="p-r-5x font-size-xs text-primary">Use our free app for 20% off your first purchase!</div></a>
                @else
                    <a data-role="downloading"><div class="p-r-5x font-size-xs text-primary">Use our free app for 20% off your first purchase!</div></a>
                @endif

            </div>
        </div>
        <div class="col-xs-3">
            <div class="font-size-sm text-right">
                @if($designer['designer_id']==99)
                    <a class="btn btn-white btn-sm font-size-xs" href="/downapp">GET IT</a>
                @else
                    <a class="btn btn-white btn-sm font-size-xs" data-role="downloading">GET IT</a>
                @endif
            </div>
        </div>

    </div>
</nav>
