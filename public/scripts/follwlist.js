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
        var did = $this.data('did');
        openLoading();
        if (did != undefined) {
            $.ajax({
                    url: '/follow/' + did,
                    type: 'GET'
                })
                .done(function (data) {
                    if (data.success) {
                        if ('Following' == $(this).html()) {
                            $(this).html('Follow');
                            $(this).removeClass('active');
                            $(this).removeClass('btn-primary');
                            $(this).addClass('btn-primary-outline');
                        } else {
                            $(this).html('Following');
                            $(this).addClass('active');
                            $(this).removeClass('btn-primary-outline');
                            $(this).addClass('btn-primary');
                        }
                    }
                })
                .always(function () {
                    closeLoading();
                });
        } else {
            did = $this.data('actiondid')
            $.ajax({
                    url: '/noteaction',
                    type: 'get',
                    data: {
                        action: 'follow',
                        did: did
                    }
                })
                .done(function (data) {
                    window.location.href = '/login';
                })
                .always(function () {
                    closeLoading();
                });
        }
    });

    // 图片延迟加载
    $(function () {
        $('img.img-lazy').lazyload({
            threshold: 200,
            effect: 'fadeIn'
        });
    });

})(jQuery);
