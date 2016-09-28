'use strict';
/* global jQuery */

(function ($) {
    // loading 打开
    function openLoading() {
        $('.loading').toggleClass('loading-hidden');
        setTimeout(function () {
            $('.loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('.loading').addClass('loading-close');
        setTimeout(function () {
            $('.loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    $('.updateFollow').on('click', function (e) {
        var $this = $(this);
        var did = $this.data('did');
        openLoading();
        $.ajax({
                url: '/followDesigner/' + did,
                type: 'GET'
            })
            .done(function (data) {
                if (data.success) {
                    $('[data-followingdid="' + did + '"]').remove();
                }
            })
            .always(function () {
                //if ($('.followlist-item').length <= 0) {
                //    $('#emptyFollowlist').removeClass('hidden-xs-up');
                //}
                closeLoading();
            });

    });

    // 图片延迟加载
    $(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

})(jQuery);
