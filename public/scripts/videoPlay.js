/**
 * Created by lhyin on 16/6/01.
 */
/*global jQuery*/

// youtube 视频播放
// 视频比例
var MediaScale = 9 / 16;

var Width = $(window).width(),
    MediaHeight = Width * MediaScale;
if ($('#ytplayer').length > 0) {
    // 初始化 外边框尺寸
    $('.designer-media').css('height', MediaHeight);
    $('#ytplayer').find('.loading').removeClass('loading-hidden');

    // 加载视频
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;
    var PlayId = $('#ytplayer').data('playid');

    console.info(PlayId);
    function onYouTubePlayerAPIReady() {
        player = new YT.Player('ytplayer', {
            height: MediaHeight,
            width: Width,
            videoId: PlayId,
            autoplay: 1,
            events: {
                'onReady': onPlayerReady,
                'onError': onPlayerError
            }
        });
    }
}

// 设置 视频默认播放 和 关闭音量 和 视频继续播放
function onPlayerReady(event) {
    event.target.playVideo();
    event.target.mute();
}

// 视频播放失败
function onPlayerReady(event) {
    event.target.playVideo();
}



//# sourceMappingURL=videoPlay.js.map
