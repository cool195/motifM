<header class="navbar-fixed-top" id="header">
    <nav class="navbar navbar-full">
        <ul class="nav navbar-primary nav-top">
            <li class="nav-item nav-logo">
                <a  href="/daily">
                    <img class="motif-logo" src="{{env('CDN_Static')}}/images/logo/logo.png"
                         srcset="{{env('CDN_Static')}}/images/logo/logo@2x.png 2x,{{env('CDN_Static')}}/images/logo/logo@3x.png 3x"></a>
            </li>
            <li class="nav-item nav-hamburger">
                <div class="nav-icon">
                    <i class="nav-tap iconfont icon-hamburger icon-size-lg" id="nav-menu-control"></i>
                </div>
            </li>
            @if(!isset($pageScope))
            <li class="nav-item nav-cart">
                <div style="width: 68px;">
                    <a href="/wish" class="head-wish">
                        <span class="nav-shoppingWish">
                            <i class="iconfont text-white icon-like nav-tap icon-size-md"></i>
                        </span>
                    </a>
                    <a href="/cart" class="head-cart">
                        <span class="nav-shoppingCart" data-login="true">
                                <img class="nav-tap" src="{{env('CDN_Static')}}/images/icon/icon-bag.png" srcset="{{env('CDN_Static')}}/images/icon/icon-bag@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-bag@3x.png 3x">
                                <span class="shoppingCart-number" style="display: none">0</span>
                        </span>
                    </a>
                </div>
            </li>
            @endif
        </ul>
    </nav>
    @if($NavShowDaily || $NavShowDesigner || $NavShowShop)
        <hr class="hr-dark m-a-0">
        <nav class="navbar navbar-full">
            <ul class="nav navbar-primary nav-top p-y-10x font-size-sm text-center nav-menuList">
                <li class="nav-item col-xs-4">
                    <a href="/daily" @if($NavShowDaily) class="active" @endif>DAILY</a>
                </li>
                <li class="nav-item col-xs-4">
                    <a href="/designer" @if($NavShowDesigner) class="active" @endif>DESIGNER</a>
                </li>
                <li class="nav-item col-xs-4">
                    <a href="/shopping" @if($NavShowShop) class="active" @endif>SHOP</a>
                </li>
            </ul>
        </nav>
    @endif
</header>

