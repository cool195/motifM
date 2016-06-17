<?php error_reporting(0)?>
<nav class="nav-menu">
    <ul class="nav bg-white m-t-10x">
        <li class="nav-item">
            <a href="/daily" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-daily icon-size-md p-r-15x"></i><span>Daily</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="/designer" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-designer icon-size-md p-r-15x"></i><span>Designer</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="/shopping" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-shopping icon-size-md p-r-15x"></i><span>Shopping</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
    </ul>
    <ul class="nav bg-white m-t-10x">
        @if(!Session::has('user'))
            <li class="nav-item">
                <a href="/login"
                   class="flex flex-alignCenter flex-fullJustified p-a-15x">
                    <div class="font-size-sm text-primary flex flex-alignCenter"><i
                                class="iconfont icon-signout icon-size-md p-r-15x"></i><span>Login/Register</span>
                    </div>
                    <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
                </a>
                <hr class="hr-base m-a-0">
            </li>
        @endif
        <li class="nav-item">
            <a href="/order/orderlist" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-book icon-size-md p-r-15x"></i><span>Orders</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="/cart" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-shopbag icon-size-md p-r-15x"></i><span>Shopping Bag</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-like icon-size-md p-r-15x"></i><span>Wishlist</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-follow icon-size-md p-r-15x"></i><span>Following</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="/user/setting" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-setting icon-size-md p-r-15x"></i><span>Settings</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        @if(Session::has('user'))
            <li class="nav-item">
                <a href="/user/signout"
                   class="flex flex-alignCenter flex-fullJustified p-a-15x">
                    <div class="font-size-sm text-primary flex flex-alignCenter"><i
                                class="iconfont icon-signout icon-size-md p-r-15x"></i><span>Sign Out</span>
                    </div>
                    <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
                </a>
                <hr class="hr-base m-a-0">
            </li>
        @endif
    </ul>
    <ul class="nav bg-white m-t-10x">
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-download icon-size-md p-r-15x"></i><span>Download MOTIF</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
    </ul>
    <ul class="nav bg-white m-t-10x m-b-10x">
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-help icon-size-md p-r-15x"></i><span>FAQ & Help</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x">
                <div class="font-size-sm text-primary flex flex-alignCenter"><i
                            class="iconfont icon-talks icon-size-md p-r-15x"></i><span>Customer Support</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            <hr class="hr-base m-a-0">
        </li>
    </ul>
</nav>
