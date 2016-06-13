<header class="navbar-fixed-top" id="header">
    <nav class="navbar navbar-full bg-primary">
        <ul class="nav navbar-primary">
            <li class="nav-item">
                <div class="nav-icon" id="nav-menu-control">
                    <i class="nav-tap iconfont icon-hamburger icon-size-lg"></i>
                </div>
            </li>
            <li class="nav-item nav-logo">
                <a><img src="/images/logo/logo.png"
                        srcset="/images/logo/logo@2x.png 2x,/images/logo/logo@3x.png 3x"></a>
            </li>
            <li class="nav-item">
                <a href="/shopping/cart">
                    <div class="nav-shoppingCart" data-login="@if(Cache::has('user')) true @else false @endif">
                        <i class="nav-tap iconfont icon-shopbag icon-size-lg"></i>
                        <span class="shoppingCart-number">0</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</header>
