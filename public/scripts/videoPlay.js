/**
 * Created by lhyin on 16/6/01.
 */

/* eslint-disable */
'use strict';

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;

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
if ($('#ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);
    $('#ytplayer').find('.loading').removeClass('loading-hidden');

    // 加载视频
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/player_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}
var player;
var PlayId = $('#ytplayer').data('playid');

function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
        height: MediaHeight,
        width: Width,
        videoId: PlayId,
        //playerVars: {'autoplay': 0},
        events: {
            'onReady': onPlayerReady,
            'onError': onPlayerError
        }
    });
}

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady(event) {
    if (autoplay == 0) {
        event.target.stopVideo();
    } else {
        event.target.playVideo();
    }
    event.target.mute();
}

// 视频播放失败
function onPlayerError(event) {
    event.target.playVideo();
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
