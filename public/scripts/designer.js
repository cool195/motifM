/**
 * Created by yinlinghui on 16/6/8.
 */
/*global jQuery Swiper template*/

'use strict';

(function ($, Swiper) {
    // 加载动画显示
    function loadingShow() {
        $('#designerContainer').find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide() {
        $('#designerContainer').find('.loading').hide();
    }

    // 图片延迟加载
    $('img.img-lazy').lazyload({
        threshold: 200,
        container: $('#designerContainer'),
        effect: 'fadeIn'
    });

    // ajax 请求 获取 推荐设计师列表 数据
    function getDesignerList() {
        //  $DesignerContainer 列表容器
        //  Start 当前页开始条数
        //  Size 当前页显示条数
        var $DesignerContainer = $('#designerContainer'),
            Start = $DesignerContainer.data('start'),
            Size = 10;
        // 判断是否还有数据要加载
        if (Start === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DesignerContainer.data('loading') === true) {
            return;
        } else {
            $DesignerContainer.data('loading', true);
        }


        loadingShow();
        $.ajax({
            url: '/designer',
            data: {cmd: 'designerinfolist', start: Start, size: Size}
        }).done(function (data) {
            if (data.data === null || data.data === '') {
                return;
            } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                $DesignerContainer.data('start', -1);
            } else {
                // 遍历模板 插入页面

                appendDesignerList(data.data);

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


                // 判断当前页是否是最后一页
                // CurrentSize 当前页显示条数
                // StartNum 下一页开始条数
                var CurrentSize = data.data.list.length,
                    StartNum = data.data.start;
                if (CurrentSize < Size) {
                    $DesignerContainer.data('start', -1);
                } else {
                    $DesignerContainer.data('start', StartNum);
                }

                // 初始化 swiper
                initSwiper();

                // 图片延迟加载
                $('img.img-lazy').lazyload({
                    threshold: 1000,
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
        }).always(function () {
            $DesignerContainer.data('loading', false);
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

    // 将数据插入到模板中 设计师
    function appendDesignerList(DesignerList) {
        var TplHtml = template('tpl-designer', DesignerList);
        // 把 字符串 转义成 HTML
        var StageCache = $.parseHTML(TplHtml);
        // 将 html 插入页面相应位置
        $('.designer-content').append(StageCache);
    }

    // 初始化 Swiper
    function initSwiper() {
        var designerSwiper = new Swiper('.swiper-container', {
            freeMode: true,
            slidesPerView: 'auto',
            freeModeMomentumRatio: .5
        });
    }

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 300 + scrollCurrent) {
            getDesignerList();
        }
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getDesignerList();
        initSwiper();
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
        console.log('load true');
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

})(jQuery, Swiper);
