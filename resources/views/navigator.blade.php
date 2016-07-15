<header class="navbar-fixed-top" id="header">
    <nav class="navbar navbar-full bg-primary">
        <ul class="nav navbar-primary">
            <li class="nav-item">
                <div class="nav-icon" id="nav-menu-control">
                    <i class="nav-tap iconfont icon-hamburger icon-size-lg"></i>
                </div>
            </li>
            <li class="nav-item nav-logo">
                <a  href="/daily">
                    <img class="motif-logo" src="{{env('CDN_Static')}}/images/logo/logo.png"
                        srcset="{{env('CDN_Static')}}/images/logo/logo@2x.png 2x,{{env('CDN_Static')}}/images/logo/logo@3x.png 3x"></a>
            </li>
            <li class="nav-item">
                <a href="/cart" class="head-cart">
                    <div class="nav-shoppingCart" data-login="@if(Session::has('user')){{'true'}}@else{{'false'}}@endif">
                        @if(!isset($pageScope))
                            <img class="nav-tap" src="{{env('CDN_Static')}}/images/icon/icon-bag.png" srcset="{{env('CDN_Static')}}/images/icon/icon-bag@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-bag@3x.png 3x">
                            <span class="shoppingCart-number" style="display: none;"></span>
                        @endif
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</header>
