<footer class="p-y-20x">
    <div class="text-center font-size-sm p-y-5x">
        @if(Session::has('user'))
            <a href="/user/signout" class="text-primary">Sign Out</a>
        @else
            <a href="/login" class="text-primary">Login/Register</a>
        @endif
    </div>
    <div class="field-content m-t-15x m-b-20x">
        <div class="field-text font-size-sm">
            Follow Us:&nbsp;
        </div>
        <div class="field-items">
            <a class="share-btn" href="https://instagram.com/motif.jewelry/">
                <img src="/images/icon/ins.png" srcset="/images/icon/ins@2x.png 2x,/images/icon/ins@3x.png 3x">
            </a>
            <a class="share-btn" href="https://www.facebook.com/Motif-862363260557363/">
                <img src="/images/icon/facebook.png" srcset="/images/icon/facebook@2x.png 2x,/images/icon/facebook@3x.png 3x">
            </a>
            <a class="share-btn" href="https://plus.google.com/u/0/113666794179158439426">
                <img src="/images/icon/google.png" srcset="/images/icon/google@2x.png 2x,/images/icon/google@3x.png 3x">
            </a>
        </div>
    </div>
    <div class="field-content">
        <div class="field-text font-size-sm">
            Download:
        </div>
        <div class="field-items">
            <a href="https://itunes.apple.com/cn/app/id1125850409" class="btn btn-secondary btn-xs">
                <img class="img-fluid m-x-auto" src="/images/icon/icon-appStore.png"
                     srcset="/images/icon/icon-appStore@2x.png 2x, /images/icon/icon-appStore@3x.png 3x">
            </a>
            <a href="https://play.google.com/store/apps/details?id=me.motif.motif" class="btn btn-secondary btn-xs">
                <img class="img-fluid m-x-auto" src="/images/icon/icon-googlePlay.png"
                     srcset="/images/icon/icon-googlePlay@2x.png 2x, /images/icon/icon-googlePlay@3x.png 3x">
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
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/aboutmotif">About MOTIF</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/privacynotice">Privacy Notice</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/termsconditions">Terms & Conditions</a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="foot-list-group font-size-sm">
                    <div class="list-group-item list-group-itemText-lg text-primary"><strong>HELP & SERVICE</strong>
                    </div>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/contactus">Contact Us</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/faq">FAQ</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/payments">Payments</a>
                    <a class="list-group-item list-group-itemText-lg text-primary" href="/shippingreturns">Shipping &
                        Returns</a>
                </div>

            </div>
        </div>
        <hr class="hr-dark m-t-20x m-b-15x">
    </div>
    <div class="text-common text-center font-size-sm">Copyright © 2016 MOTIF Inc. All rights reserved.</div>
</footer>
<!-- App 下载提示 -->
<nav class="navbar-fixed-bottom bg-download p-y-10x p-x-15x flex flex-fullJustified flex-alignCenter">
    <div class="flex flex-alignCenter">
        <a class="p-r-20x p-y-15x" id="closeDownloading">
            <i class="iconfont icon-cross text-common"></i>
        </a>
        <div class="p-r-15x">
            <img src="/images/icon/icon-motif.png" srcset="/images/icon/icon-motif@2x.png 2x,/images/icon/icon-motif@3x.png 3x">
        </div>
        <span class="p-r-15x font-size-sm text-primary">Find More With MOTIF App</span>
    </div>
    <div class="font-size-sm"><a data-role="downloading">DOWNLOAD</a></div>
</nav>
