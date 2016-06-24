<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Designer Detail</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <script src="/scripts/vendor/modernizr.js"></script>
    <script src="/scripts/vendor/fastclick.js"></script>
</head>
<body>
<!-- 外层容器 -->
<div id="body-content">
    <!-- 主体内容 -->
    <div class="body-container" style="padding-top:0px">
        <!-- designerDetail 设计师详情 -->
        <section>
            <!-- 视频/图片 -->
            <div class="designer-media flex flex-justifyCenter flex-alignCenter">
                <img class="designer-placeImg" src="/images/designer/placeholder.jpg" alt="" hidden>
                @if($designer['path_type']==2)
                    <div id="ytplayer" data-playid="{{$designer['img_video_path']}}"></div>
                @else
                    <img src="https://s3-us-west-1.amazonaws.com/emimagetest/n1/{{$designer['main_img_path']}}" alt=""
                         class="designer-realImg" hidden>
                    <img class="img-fluid img-lazy designer-Img"
                         data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n1/{{$designer['img_video_path']}}"
                         src="/images/product/bg-product@750.png" alt="">
                @endif
            </div>

            <!-- 设计师 文字信息 -->
            <div class="bg-white p-a-5x">
                <div class="flex flex-alignCenter flex-fullJustified p-x-10x p-t-10x">
                    <div class="font-size-base text-main"><strong>{{$designer['name']}}</strong></div>
                    <div class="flex flex-alignCenter">
                        <span class="p-r-20x">
                            @if(Session::get('user.pin'))
                                <a href="#" class="btn btn-follow btn-sm @if(!$designer['followStatus']) active @endif" id="follow">@if($designer['followStatus']){{'Following'}}@else{{'Follow'}}@endif</a>
                            @else
                                <a href="#" class="btn btn-follow btn-sm active" id="sendLogin">Follow</a>
                            @endif
                        </span>
                    </div>

                </div>
                <div class="font-size-sm text-primary p-a-10x">{{$designer['intro']}}</div>
                <hr class="hr-base m-a-0">
                <div class="font-size-sm text-primary p-a-10x">{{$designer['describe']}}</div>
                <div class="p-x-10x p-y-5x">
                    <a href="#" class="p-r-5x"><i class="iconfont icon-youtube icon-size-lg text-primary"></i></a>
                    <a href="#" class="p-r-5x"><i class="iconfont icon-facebook icon-size-lg text-primary"></i></a>
                    <a href="#" class="p-r-5x"><i class="iconfont icon-google icon-size-lg text-primary"></i></a>
                </div>
            </div>

            <!-- 设计师 对应商品 -->
            <aside class="bg-white p-b-10x">
            @if(isset($product['infos']))
                @foreach($product['infos'] as $k=>$value)
                    @if($value['type']=='banner')
                        <!-- 第一个 banner 图 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid=@endif{{$value['skipId']}}">
                                <div @if($k!=0)class="p-y-10x"@endif>
                                    <img class="img-fluid"
                                         src="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$value['imgPath']}}">
                                </div>
                            </a>
                    @elseif($value['type']=='title')
                        <!-- 标题 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid=@endif{{$value['skipId']}}">
                                <div class="p-x-15x p-y-10x text-primary">
                                    <strong>{{$value['value']}}</strong>
                                </div>
                            </a>
                        @elseif($value['type']=='boxline')
                            <hr class="hr-base m-x-5x m-y-0">
                        @elseif($value['type']=='context')
                        <!-- 描述 -->
                            <a href="@if($value['skipType']=='1')motif://o.c?a=pd&spu=@elseif($value['skipType']=='2')/designer/@elseif($value['skipType']=='3')/topic/@elseif($value['skipType']=='4')motif://o.c?a=shoppinglist&cid=@endif{{$value['skipId']}}">
                                <div class="p-x-15x p-y-10x text-primary font-size-sm">
                                    {{$value['value']}}
                                </div>
                            </a>
                        @elseif($value['type']=='product')
                            @if($value['style']=='box-vertical')
                                {{-- 商品列表竖向 --}}
                                @if(isset($value['spus']))
                                    @foreach($value['spus'] as $spu)
                                        <div class="p-x-15x p-y-10x">
                                            <a href="motif://o.c?a=pd&spu={{$spu}}">
                                                <img class="img-fluid img-lazy"
                                                     src="/images/product/bg-product@336.png"
                                                     data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                     alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            @else
                                {{-- 商品列表横向 --}}
                                <div class="container-fluid p-x-15x">
                                    <div class="row">
                                        @if(isset($value['spus']))
                                            @foreach($value['spus'] as $spu)
                                                <div class="col-xs-6">
                                                    <a href="motif://o.c?a=pd&spu={{$spu}}">
                                                        <div class="p-t-10x">
                                                            <img class="img-thumbnail img-lazy"
                                                                 src="/images/product/bg-product@336.png"
                                                                 data-original="https://s3-us-west-1.amazonaws.com/emimagetest/n2/{{$product['spuInfos'][$spu]['spuBase']['main_image_url']}}"
                                                                 alt="{{$product['spuInfos'][$spu]['spuBase']['main_title']}}">
                                                            <div class="p-y-10x">
                                                                <span class="text-primary font-size-sm m-l-5x"><strong>${{number_format($product['spuInfos'][$spu]['skuPrice']['sale_price']/100,2)}}</strong></span>
                                                                @if($product['spuInfos'][$spu]['skuPrice']['sale_price'] != $product['spuInfos'][$spu]['skuPrice']['price'])
                                                                    <span class="font-size-xs text-common text-throughLine m-l-5x">${{number_format($product['spuInfos'][$spu]['skuPrice']['price']/100,2)}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
            </aside>

        </section>
    </div>
</div>

</body>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/designerDetail.js"></script>
<script src="/scripts/videoPlay.js"></script>
<script src="/scripts/JockeyJS.js"></script>
<script>
    var actionsShow = [{"icon": "", "name": "share"}]
    Jockey.send("action", {
        name: "showActions",
        token: "key",
        data: {"actions": actionsShow}
    });

    Jockey.on("action", function (action) {
        //share
        if (action.name == "menuClick" && action.data.name == "share") {
            Jockey.send("action", {
                name: "share",
                token: "key",
                data: {
                    "title": "Designer",
                    "content": "Designer test info",
                    "image": "",
                    "url": "http://m.motif.me/designer/{{$designer['designer_id']}}"
                }
            });
        }
        //login
        else if (action.name == "authInfo") {
            //ajax post session info
            $.ajax({
                url: '/user/logincheck',
                type: 'POST',
                data: {
                    token: action.data.token,
                    pin: action.data.pin,
                    email: action.data.email,
                    name: decodeURIComponent(action.data.name),
                    uuid: action.data.uuid
                },
                success: function(data){
                    if (data.success) {
                        window.location.reload()
                    }
                }
            })
        }
    });

    //login send
    $('#sendLogin').on('click', function () {
        Jockey.send("action", {
            name: "login",
            token: "key",
        });
    })
</script>
</html>
