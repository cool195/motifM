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

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;
var $ClickPlayer;

var Width = $(window).width(),
    MediaHeight = Width * MediaScale;

if ($('.ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);
}
var player;

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
                    playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'rel': 0},
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


