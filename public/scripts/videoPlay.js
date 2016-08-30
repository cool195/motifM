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
if ($('.ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);
    $('.designer-beginPlayer').css('display', 'block');

    // 加载视频
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/player_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

}
var player;
function onYouTubeIframeAPIReady() {
    var PlayId = $('#ytplayer').data('playid');
    player = new YT.Player('ytplayer', {
        height: MediaHeight,
        width: Width,
        videoId: PlayId,
        playerVars: {'autoplay': 1, 'controls': 2, 'showinfo': 0, 'fs': 0, 'playsinline': 1},
        events: {
            'onReady': onPlayerReady
        }
    });
}

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady(event) {
    $('.bg-player').css('display', 'none');
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
