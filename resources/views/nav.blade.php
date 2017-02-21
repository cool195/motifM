
<nav class="nav-menu">
    <ul class="nav bg-white">
        <li class="nav-item">
            <a href="/daily" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-home icon-size-md p-r-15x"></i>--}}
                    <span>Home</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
    </ul>
    <ul class="nav bg-white">
        @if(!Session::has('user'))
            <li class="nav-item">
                <a href="/login"
                   class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                    <div class="font-size-sm text-primary flex flex-alignCenter">
                        {{--<i class="iconfont icon-login icon-size-md p-r-15x"></i>--}}
                        <span>Sign in/Register</span>
                    </div>
                    <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="/order/orderlist" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-book icon-size-md p-r-15x"></i>--}}
                    <span>Orders</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
            <li class="nav-item">
                <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x menu" data-remodal-target="download-modal" id="menu-following">
                    <div class="font-size-sm text-primary flex flex-alignCenter">
                        {{--<i class="iconfont icon-follow icon-size-md p-r-15x"></i>--}}
                        <span>Following</span></div>
                    <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
                </a>
            </li>
        <li class="nav-item">
            <a href="/promocode" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<img src="{{env('CDN_Static')}}/images/icon/promocode.png" srcset="{{env('CDN_Static')}}/images/icon/promocode@2x.png 2x,{{env('CDN_Static')}}/images/icon/promocode@3x.png 3x">--}}
                    <span>Coupons and Promotions</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/invitefriends" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<img src="{{env('CDN_Static')}}/images/icon/icon-gift.png" srcset="{{env('CDN_Static')}}/images/icon/icon-gift@2x.png 2x,{{env('CDN_Static')}}/images/icon/icon-gift@3x.png 3x">--}}
                    <span>Get $20 Off</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/user/setting" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-setting icon-size-md p-r-15x"></i>--}}
                    <span>Settings</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
            @if(Session::has('user'))
            @endif
        </li>
        @if(Session::has('user'))
            <li class="nav-item">
                <a href="/user/signout"
                   class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                    <div class="font-size-sm text-primary flex flex-alignCenter">
                        {{--<i class="iconfont icon-signout icon-size-md p-r-15x"></i>--}}
                        <span>Sign Out</span>
                    </div>
                    <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
                </a>
            </li>
        @endif
    </ul>
    <ul class="nav bg-white">
        <li class="nav-item">
            <a href="#" class="flex flex-alignCenter flex-fullJustified p-a-15x menu" data-remodal-target="download-modal" id="downloadingApp" data-role="downloading">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-download icon-size-md p-r-15x"></i>--}}
                    <span>Download Motif</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
    </ul>
    <ul class="nav bg-white m-b-10x">
        <li class="nav-item">
            <a href="/faq" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-help icon-size-md p-r-15x"></i>--}}
                    <span>FAQ & Help</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
        @if(1 == Session::get("user.netred"))
        <!--网红专有入口-->
        <li class="nav-item">
            <a href="/designer/store" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-talks icon-size-md p-r-15x"></i>--}}
                    <span>Create New Collection</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/designer/saved" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-talks icon-size-md p-r-15x"></i>--}}
                    <span>Manage Saved Collection</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a href="/feed" class="flex flex-alignCenter flex-fullJustified p-a-15x menu">
                <div class="font-size-sm text-primary flex flex-alignCenter">
                    {{--<i class="iconfont icon-talks icon-size-md p-r-15x"></i>--}}
                    <span>Customer Support</span></div>
                <span class="text-common"><i class="iconfont icon-arrow-right icon-size-sm"></i></span>
            </a>
        </li>
    </ul>
</nav>
<!-- 下载 App Download MOTIF -->
<div class="remodal remodal-md modal-content" data-remodal-id="download-modal" id="downloadModal">
    <div class="text-right p-x-15x p-t-15x" data-remodal-action="close">
        <i class="iconfont icon-cross icon-size-md text-common"></i>
    </div>
    <!-- 提示: 打开 app -->
    <div class="view-content" hidden>
        <div class="font-size-base">Function Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            We supply this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <a class="btn btn-primary btn-block btn-viewApp" href="">View in MOTIF App</a>
        </div>
    </div>
    <!-- 提示: 下载 app -->
    <div class="download-content" hidden>
        <div class="font-size-base">Function Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            We offer this function in the <br>MOTIF App,You can use there！
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <a class="btn btn-primary btn-block btn-downloadApp" data-role="downloading">Download MOTIF App
            </a>
        </div>
    </div>
    <!-- 提示: 不支持此设备 -->
    <div class="app-content" hidden>
        <div class="font-size-base">Device Not Supported</div>
        <div class="font-size-sm p-x-15x p-b-15x p-t-10x">
            Your device is not supported.<br>It's available in stores below.
        </div>
        <hr class="hr-base m-a-0">
        <div class="p-x-15x p-t-10x p-b-15x">
            <div class="field-items">
                <a href="#" class="btn btn-black btn-xs btn-downAppStore">
                    <img src="{{env('CDN_Static')}}/images/icon/icon-appStore.png" srcset="{{env('CDN_Static')}}/images/icon/icon-appStore@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-appStore@3x.png 3x">
                </a>
                <a href="#" class="btn btn-black btn-xs btn-downGooglePlay">
                    <img src="{{env('CDN_Static')}}/images/icon/icon-googlePlay.png" srcset="{{env('CDN_Static')}}/images/icon/icon-googlePlay@2x.png 2x, {{env('CDN_Static')}}/images/icon/icon-googlePlay@3x.png 3x">
                </a>
            </div>
        </div>
    </div>
</div>
