/*global jQuery*/
'use strict';
(function($) {
    function openAddSuccess() {
        $('#success').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#success').toggleClass('loading-open');
        }, 25);
    }

    function closeAddSuccess() {
        $('#success').addClass('loading-close');
        setTimeout(function() {
            $('#success').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    // loading 打开
    function openLoading() {
        $('#loading').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('#loading').addClass('loading-close');
        setTimeout(function() {
            $('#loading').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }

    $('input[name="nick"]').on('keyup', function() {
        if ($(this).val() === '') {
            $('div[data-role="submit"]').addClass('disabled');
        } else {
            $('div[data-role="submit"]').removeClass('disabled');
        }
    });

    $('div[data-role="submit"]').on('click', function(e) {
        if (!$(e.target).hasClass('disabled')) {
            openLoading();
            $.ajax({
                    url: '/user/modifyUserInfo',
                    type: 'POST',
                    data: $('#changeProfile').serialize()
                })
                .done(function(data) {
                    if (data.success) {
                        closeLoading();
                        $('#nick').attr('placeholder', $('#nick').val());
                        $('#nick').val('');
                        openAddSuccess();
                        setTimeout(function() {
                            closeAddSuccess();
                            window.location.href = data.redirectUrl;
                        }, 1500);

                    }
                })
                .always(function() {
                    //closeLoading();
                });
        }
    });
})(jQuery);

//# sourceMappingURL=profileSetting-changeProfile.js.map
