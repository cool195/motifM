/**
 * Created by lhyin on 16/6/01.
 */

/* eslint-disable */
'use strict';

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;
var $ClickPlayer;

var Width = $(window).width(),
    MediaHeight = Width * MediaScale,
    autoplay = 0;
switch (switchDevice()) {
    case 1:
        autoplay = 0;
        break;
    case 0:
        autoplay = 1;
        break;
    case -1:
        autoplay = 1;
        break;
    default:
        break;
}
if ($('.ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);
    $('.designer-beginPlayer').css('display','block');
    //$('#ytplayer').find('.loading').removeClass('loading-hidden');

    // 加载视频
    //var tag = document.createElement('script');
    //tag.src = 'https://www.youtube.com/player_api';
    //var firstScriptTag = document.getElementsByTagName('script')[0];
    //firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}
var player;
function onYouTubeIframeAPIReady() {
    var PlayId = $('.ytplayer').data('playid');
    player = new YT.Player(PlayId, {
        height: MediaHeight,
        width: Width,
        videoId: PlayId,
        playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'fs': 0, 'playsinline': 1},
        events: {
            //'onReady': onPlayerReady,
            //'onError': onPlayerError,
            //'onStateChange': onPlayerStateChange
        }
    });
}



function playVideoTest() {
    var thiss = $('.bg-player');
    thiss.css('display', 'none');
    thiss.children('.bg-img').hide();
    thiss.children('.btn-beginPlayer').hide();
    thiss.siblings('.btn-morePlayer').show();
    //$(this).parents('.player-item').addClass('active');
    player.playVideo();
}

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady(event) {
    //if (autoplay == 0) {
    //    event.target.stopVideo();
    //} else {
    setTimeout(event.target.playVideo(), 6000);
    //}
    //event.target.mute();
}

// 视频播放失败
function onPlayerError(event) {
    event.target.playVideo();
}

var done = false;
function onPlayerStateChange(event) {
    if (event.data == 3 && !done) {
        setTimeout(playVideo, 5000);
        done = true;
    }
}
function playVideo() {
    player.playVideo();
}

function switchDevice() {
    var Agent = navigator.userAgent;
    if (/iPhone/i.test(Agent)) {
        return 1;
    } else if (/Android/i.test(Agent) || /Linux/i.test(Agent)) {
        return 0;
    } else {
        return -1;
    }
}

//# sourceMappingURL=videoPlay.js.map
