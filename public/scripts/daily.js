/**
 * Created by yinlinghui on 16/6/8.
 */
/*global jQuery template*/

'use strict';
(function ($) {
    // 加载动画显示
    function loadingShow() {
        $('#dailyContainer').find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide() {
        $('#dailyContainer').find('.loading').hide();
    }

    // ajax 请求 获取 daily 数据
    function getDailyList() {
        //  $DailyContainer 列表容器
        //  PageNum 当前页码数
        var $DailyContainer = $('#dailyContainer'),
            PageNum = $DailyContainer.data('pagenum');
        // 判断是否还有数据要加载
        if (PageNum === -1) {
            //getProductList();
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DailyContainer.data('loading') === true) {
            return;
        } else {
            $DailyContainer.data('loading', true);
        }

        var NextNum = ++PageNum;

        loadingShow();
        $.ajax({
                url: '/trending',
                data: {
                    cmd: 'list',
                    pagenum: NextNum,
                    pagesize: 10,
                    puton: $('#puton').val(),
                }
            })
            .done(function (data) {
                if (data.data === null || data.data === '') {
                    $DailyContainer.data('pagenum', -1);
                } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                    $DailyContainer.data('pagenum', -1);
                } else {
                    // 遍历模板 插入页面
                    appendDailyList('tpl-daily', data.data);

                    // 视频区域高度
                    var MediaScale = 9 / 16;
                    var Width = $(window).width(),
                        MediaHeight = Width * MediaScale;
                    if ($('.ytplayer').length > 0) {
                        // 初始化 外边框尺寸
                        $('.designer-media').css('height', MediaHeight);
                    }


                    loadJS('https://www.youtube.com/player_api', function(){
                        setTimeout(function(){
                            loadYoutube();
                        }, 1000);
                    });


                    // 页数 +1
                    $DailyContainer.data('pagenum', PageNum);

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        container: $('#dailyContainer'),
                        effect: 'fadeIn'
                    });

                    //给模板a标签绑定事件
                    $('[data-clk]').unbind('click');
                    $('[data-clk]').bind('click', function() {
                        var $this = $(this);
                        if(undefined !== $this.data('link')){
                            $.ajax({
                                url: $this.data('clk'),
                                type: "GET"
                            });
                            setTimeout(function() {
                                window.location.href = $this.data('link');
                            }, 100);
                        }
                    })
                }
            })
            .always(function () {
                $DailyContainer.data('loading', false);
                loadingHide();
            });
    }

    // 设置 视频默认播放 和 关闭音量 和 视频继续播放
    function onPlayerReady($Player) {
        //event.target.playVideo();
        //event.target.mute();
        $Player.children('.bg-player').css('display','none');
    }

    // 判断视频是否在曝光处
    function switchPlayer(Player) {
        // 当前视窗浏览位置
        var CurrentPosition = $(window).scrollTop() + $(window).height();
        // 元素本身聚顶部高度
        var ItemPositionBottom = $(Player).offset().top;
        // 如果是曝光项，加上本身的高度
        // 完全出现在视窗内时，再曝光
        var ItemPositionTop = ItemPositionBottom + $(Player).height();
        // 判断是否在视窗内
        if (ItemPositionBottom > CurrentPosition || ItemPositionTop < $(window).scrollTop()) {
            return true;
        } else {
            return false;
        }
    }

    // ajax 请求 获取 product 数据
    function getProductList() {
        //  $DailyContainer 列表容器
        //  ProductPageNum 产品当前页码数
        var $DailyContainer = $('#dailyContainer'),
            ProductPageNum = $DailyContainer.data('productpagenum');
        // 判断是否还有数据要加载
        if (ProductPageNum === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DailyContainer.data('loading') === true) {
            return;
        } else {
            $DailyContainer.data('loading', true);
        }
        var NextProductNum = ++ProductPageNum;

        loadingShow();
        $.ajax({
                url: '/recdata',
                data: {
                    pagenum: NextProductNum,
                    pagesize: 10
                }
            })
            .done(function (data) {
                if (data.data === null || data.data === '') {
                    $DailyContainer.data('productpagenum', -1);
                } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                    $DailyContainer.data('productpagenum', -1);
                } else {
                    // 遍历模板 插入页面
                    appendDailyList('tpl-product', data.data);
                    // 页数 +1
                    $DailyContainer.data('productpagenum', ProductPageNum);

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        container: $('#dailyContainer'),
                        effect: 'fadeIn'
                    });
                }
            })
            .always(function () {
                $DailyContainer.data('loading', false);
                loadingHide();
            });

    }

    // 将数据插入到模板中
    function appendDailyList(tpl, DailyList) {
        var TplHtml = template(tpl, DailyList);
        // 把 字符串 转义成 HTML
        var StageCache = $.parseHTML(TplHtml);
        // 将 html 插入页面相应位置
        $('.daily-content').append(StageCache);
    }

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 300 + scrollCurrent) {
            getDailyList();
        }
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getDailyList();
        $(window).scroll(function () {
            $('img.img-lazy').each(function () {
                var Src = $(this).attr('src'),
                    Original = $(this).attr('data-original');
                if (Src === Original) {
                    $(this).removeClass('img-lazy');
                }
            });
            pullLoading();
        });
    });



    function loadJS(src, callback){
        // 加载视频
        var tag = document.createElement('script');
        tag.src = src;
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        callback();
    }

    loadJS('https://www.youtube.com/player_api', function(){
        loadYoutube();
    });

    function loadYoutube() {
        var $PlayerItem = $('.player-item');
        if ($PlayerItem.length !== 0) {
            $.each($PlayerItem, function (index, element) {
                if (!switchPlayer(element) && !($(element).hasClass('active'))) {
                    var $Player = $(element),
                        PlayerId = $Player.data('playid');

                    if ( typeof(YT) != "undefined" && typeof(YT.Player) != "undefined"){
                    player = new YT.Player(PlayerId, {
                        height: MediaHeight,
                        width: Width,
                        videoId: PlayerId,
                        playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'rel': 0},
                        events: {
                            'onReady': onPlayerReady($Player)
                        }
                    });
                    }

                    $(this).addClass('active');
                }
            });
        }
    }

})(jQuery);
