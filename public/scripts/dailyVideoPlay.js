/**
 * Created by lhyin on 16/6/01.
 */

/* eslint-disable */
'use strict';

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady($Player) {
    //event.target.playVideo();
    //event.target.mute();
    $Player.children('.bg-player').css('display','none');
}

// 视频播放失败
function onPlayerError(event) {
    event.target.playVideo();
}

// 改变视频状态
//function onPlayerStateChange(event,$Player){
//    if(event.data === 5){
//        $Player.children('.bg-player').css('display','none');
//    }
//}

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;
var $ClickPlayer;

var Width = $(window).width(),
    MediaHeight = Width * MediaScale;

if ($('.ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);

    // 加载视频
    //var tag = document.createElement('script');
    //tag.src = 'https://www.youtube.com/player_api';
    //var firstScriptTag = document.getElementsByTagName('script')[0];
    //firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}
var player;
// daily 页面
//$('.daily-content').on('click', '.bg-player', function () {
//    var PlayId = $(this).siblings('.ytplayer').data('playid');
//    player = new YT.Player(PlayId, {
//        height: MediaHeight,
//        width: Width,
//        videoId: PlayId,
//        playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'fs': 0, 'playsinline': 1},
//        events: {
//            'onReady': onPlayerReady,
//            'onError': onPlayerError
//        }
//    });
//
//    $ClickPlayer = $(this);
//    $(this).css('display', 'none');
//    $(this).children('.bg-img').hide();
//    $(this).children('.btn-beginPlayer').hide();
//    //$(this).siblings('.btn-morePlayer').show();
//    $(this).parents('.player-item').addClass('active');
//});

// designer 页面
//$('.designer-content').on('click', '.bg-player', function () {
//    var PlayId = $(this).siblings('.ytplayer').data('playid');
//    player = new YT.Player(PlayId, {
//        height: MediaHeight,
//        width: Width,
//        videoId: PlayId,
//        playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'fs': 0, 'playsinline': 1},
//        events: {
//            'onReady': onPlayerReady,
//            'onError': onPlayerError
//        }
//    });
//
//    $ClickPlayer = $(this);
//    $(this).css('display', 'none');
//    $(this).children('.bg-img').hide();
//    $(this).children('.btn-beginPlayer').hide();
//    //$(this).siblings('.btn-morePlayer').show();
//    $(this).parents('.player-item').addClass('active');
//});

// 判断是否离开曝光
$(document).on('scroll', function (event) {
    var $PlayerItem = $('.player-item');
    if ($PlayerItem.length !== 0) {
        $.each($PlayerItem, function (index, element) {
            if (switchPlayer(element) && $(element).hasClass('active')) {
                var $Player = $(element),
                    PlayerId = $Player.data('playid'),
                    isAdd = false;
                $Player.children('.bg-player').css('display', 'block');
                $Player.children('.bg-player').children('.bg-img').css('display', 'block');
                $Player.children('.bg-player').children('.btn-beginPlayer').css('display', 'block');
                $Player.removeClass('active');
                $Player.children('iframe').remove();
                if (!isAdd) {
                    $Player.prepend('<div id="' + PlayerId + '" class="ytplayer" data-playid="' + PlayerId + '"></div>');
                    isAdd = true;
                }
            }
        });
    }
});

// 判断是否在曝光处(在曝光处)
$(document).on('scroll', function () {
    var $PlayerItem = $('.player-item');
    if ($PlayerItem.length !== 0) {
        $.each($PlayerItem, function (index, element) {
            if (!switchPlayer(element) && !($(element).hasClass('active'))) {
                var $Player = $(element),
                    PlayerId = $Player.data('playid');
                //alert(PlayerId);
                player = new YT.Player(PlayerId, {
                    height: MediaHeight,
                    width: Width,
                    videoId: PlayerId,
                    playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0},
                    events: {
                        'onReady': onPlayerReady($Player)
                        //'onStateChange':onPlayerStateChange($Player)
                    }
                });

                //$ClickPlayer = $(this);
                //$(this).css('display', 'none');
                //$(this).children('.bg-img').hide();
                //$(this).children('.btn-beginPlayer').hide();
                //$(this).siblings('.btn-morePlayer').show();
                $(this).addClass('active');
            }
        });
    }
});

$(document).ready(function (){
    var $PlayerItem = $('.player-item');
    if ($PlayerItem.length !== 0) {
        $.each($PlayerItem, function (index, element) {
            if (!switchPlayer(element) && !($(element).hasClass('active'))) {
                var $Player = $(element),
                    PlayerId = $Player.data('playid');
                alert(PlayerId);
                player = new YT.Player(PlayerId, {
                    height: MediaHeight,
                    width: Width,
                    videoId: PlayerId,
                    playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0},
                    events: {
                        'onReady': onPlayerReady($Player)
                        //'onStateChange':onPlayerStateChange($Player)
                    }
                });
                $(this).addClass('active');
            }
        });
    }
});


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


