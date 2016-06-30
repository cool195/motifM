/**
 * Created by zhaozhe on 16/5/24.
 */
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

    $('#send').click(function() {
        $.ajax({
                url: "/forgetpwd",
                type: "POST",
                data: $('#reset').serialize()
            })
            .done(function(data) {
                console.log("success");
                if (data.success) {

                    openAddSuccess();
                    setTimeout(function() {
                        closeAddSuccess();
                    }, 1500);

                    $('.warning-info').addClass('hidden-xs-up');

                    $('#successText').text(data.prompt_msg);
                    window.location.href = data.redirectUrl;
                } else {
                    $('.warning-info').removeClass('hidden-xs-up');
                    $('.warning-info').children('span').text(data.prompt_msg);
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    });


})(jQuery);

//# sourceMappingURL=resetPassword.js.map
