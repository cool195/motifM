/**
 * Created by lhyin on 16/6/01.
 */
/*global jQuery*/

// 设置 视频比例
'use strict';
(function ($) {
    var MediaScale = '';
    // 初始化 图片/ 视频 显示比例
    function getMediaScale() {
        var $Img = $('.designer-placeImg');
        var NewImg = new Image();
        NewImg.src = $Img.attr("src");
        var ScaleWidth = NewImg.width,
            ScaleHeight = NewImg.height;
        MediaScale = ScaleHeight / ScaleWidth;
    }

    // 根据比例 初始化 图片/视频 外层高度
    function mediainit() {
        var Width = $(window).width(),
            MediaHeight = Width * MediaScale;
        // 初始化视频比例
        if ($('#ytplayer').length > 0) {
        } else if ($('.designer-Img').length > 0) {
            $('.designer-media').css('height', MediaHeight);
            // 初始化图片比例
            // 对比图片比例  让图片显示在固定区域
            var RealImg = getRealImg();
            var MediaFixedScale = MediaScale.toFixed(2);
            validateImgSize(RealImg.ImgWidth, RealImg.ImgHeight, RealImg.Scale, MediaFixedScale);
        }
    }

    $(window).resize(function () {
        mediainit();
    });

    // 得到图片的实际尺寸比例
    function getRealImg() {
        var $Img = $('.designer-realImg');
        var NewImg = new Image();
        var ImgObj = {};

        NewImg.src = $Img.attr("src");

        var ImgWidth = NewImg.width,
            ImgHeight = NewImg.height;

        // 获取图片的比例,小数点后面保留两位
        var RealScale = (ImgHeight / ImgWidth).toFixed(2);
        ImgObj['Scale'] = RealScale;
        ImgObj['ImgWidth'] = ImgWidth;
        ImgObj['ImgHeight'] = ImgHeight;
        console.info(ImgObj);
        return ImgObj;
    }


    // 图片实际宽高比 与 固定宽高比 做比较
    function validateImgSize(ImgWidth, ImgHeight, RealScale, MediaScale) {
        var $Img = $('.designer-Img');
        $Img.removeClass('img-fluid');
        //获取图片区域高度 宽度
        var Width = $(window).width(),
            MediaHeight = Width * MediaScale;
        if (ImgWidth < Width && ImgHeight < MediaHeight) {
            // 图片实际高度小与固定高度  并且 实际宽度小与固定宽度
            $('.designer-Img').removeClass('img-fluid');
        } else if (RealScale == MediaScale) {
            // 实际宽高比 等于 固定比
            $('.designer-Img').addClass('img-fluid');
        } else if (RealScale > MediaScale) {
            // 实际宽高比 大于 固定比
            $('.designer-Img').css({height: '100%', width: 'auto'});
        } else if (RealScale < MediaScale) {
            // 实际宽高比 小于 固定比
            $('.designer-Img').css({height: 'auto', width: '100%'});
        }
    }

    // 显示隐藏 message 更多内容
    $('.btn-showMore').on('click', function () {
        var $Message = $(this).siblings('.message-info');
        $Message.toggleClass('active');
        if ($Message.hasClass('active')) {
            $(this).children('.showMore').html('Show Less');
            $(this).children('.iconfont').removeClass('icon-arrow-bottom').addClass('icon-arrow-up');
        } else {
            $(this).children('.showMore').html('Show More');
            $(this).children('.iconfont').removeClass('icon-arrow-up').addClass('icon-arrow-bottom');
        }
    });

    $(document).ready(function () {
        // 图片延迟加载
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });

        if ($('.message-info').children('p').height() <= 144) {
            $('.btn-showMore').hide();
        }
    });

    window.onload = function () {
        getMediaScale();
        mediainit();
    };

    // follow 设计师
    function switchFollow($Follow) {
        if ($Follow.hasClass('active')) {
            $Follow.html('Following');
            $Follow.toggleClass('active');
            $Follow.addClass('btn-primary').removeClass('btn-follow');
        } else {
            $Follow.html('Follow');
            $Follow.toggleClass('active');
            $Follow.addClass('btn-follow').removeClass('btn-primary');
        }
    }

    $('#follow').on('click', function (e) {
        // 切换 Follow 按钮状态
        switchFollow($(e.target));
    })
})(jQuery);

//# sourceMappingURL=designerDetail.js.map
