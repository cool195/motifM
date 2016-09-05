/**
 * Created by lhyin on 16/6/01.
 */

/* eslint-disable */
'use strict';

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;

var Width = $(window).width(),
    MediaHeight = Width * MediaScale;

if ($('#ytplayer').length > 0) {
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
var PlayId = $('#ytplayer').data('playid');
function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
        height: MediaHeight,
        width: Width,
        videoId: PlayId,
        playerVars: {'autoplay': 0,'controls': 2, 'showinfo': 0},
        events: {
            'onReady': onPlayerReady
        }
    });
}

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady(event) {
    $('.bg-player').css('display', 'none');
}

