'use strict';

(function ($) {
    /**
     *
     * @param $Edit
     */
    function switchEdit($Edit) {
        if ($Edit.hasClass('active')) {
            $Edit.html('Edit');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary-outline').removeClass('btn-primary');
            $('div[data-role="submit"]').removeClass('hidden');
        } else {
            $Edit.html('Done');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary').removeClass('btn-primary-outline');
            $('div[data-role="submit"]').addClass('hidden');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchSelect($Edit) {
        var $IconFont = $('.payment-info').find('.iconfont');
        if ($Edit.hasClass('active')) {
            $IconFont.addClass('icon-radio');
        } else {
            $IconFont.removeClass('icon-radio');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchLink($Edit) {
        var $LinkList = $('.payment-info');

        if ($Edit.hasClass('active')) {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-return');
                $(val).attr('href', Link);
            });
        } else {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-edit');
                $(val).attr('href', Link);
            });
        }
    }

    $('#payment-edit').on('click', function (e) {
        // 可选的状态切换
        switchSelect($(e.target));

        // 跳转链接的切换
        switchLink($(e.target));

        // 切换按钮以及叉号状态
        switchEdit($(e.target));

        $('.payment-delete').toggleClass('switch');
    });

    $('[data-role="submit"]').on('click', function () {
        $('#infoForm').submit();
    });

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

    /**
     *
     * @param AddressId
     */
    function deleteAddress(PaymentToken) {
        // TODO loading 动画
        openLoading();

        $.ajax({
            url: ' /pay/del',
            type: 'DELETE',
            data: {
                methodtoken: PaymentToken
            }
        }).done(function () {
            console.log("success");
            return true;
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("complete");
            closeLoading();
        });
    }

    // 删除按钮
    $('.payment-delete').on('click', function (e) {
        var PaymentToken = $(e.target).parents('.payment-info').data('token');
        $('#modalDialog').data('address', PaymentToken);
    });
    $('.payment-info').on('click', function () {
        $('.icon-radio.active').removeClass('active');
        $(this).find('.icon-radio').addClass('active');
        var PaymentToken = $(this).parents('.payment-info').data('token');
        $('input[name="methodtoken"]').val(PaymentToken);
    });
    // 初始化 模态框
    $('#modalDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: true
    });

    $('#modalDialog').on('closed', function () {
        $(this).removeData('address');
        console.log('close');
    });
    $('#modalDialog').on('confirmation', function () {
        var PaymentToken = $(this).data('token');
        if (AddressID === undefined || AddressID === null || AddressID === '') {
            console.log('Token 没有值');
            return;
        }
        deleteAddress(PaymentToken);
    });
})(jQuery);
//# sourceMappingURL=orderCheckout-payment.js.map
