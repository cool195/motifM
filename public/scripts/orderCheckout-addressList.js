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
        } else {
            $Edit.html('Done');
            $Edit.toggleClass('active');
            $Edit.addClass('btn-primary').removeClass('btn-primary-outline');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchSelect($Edit) {
        var $IconFont = $('.addressItem-info').find('.iconfont');
        if ($Edit.hasClass('active')) {
            $IconFont.removeClass('icon-arrow-right').addClass('icon-radio');
        } else {
            $IconFont.removeClass('icon-radio').addClass('icon-arrow-right');
        }
    }

    /**
     *
     * @param $Edit
     */
    function switchLink($Edit) {
        var $LinkList = $('.addressItem-info');

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

    $('#address-edit').on('click', function (e) {
        // 可选的状态切换
        switchSelect($(e.target));

        // 跳转链接的切换
        switchLink($(e.target));

        // 切换按钮以及叉号状态
        switchEdit($(e.target));

        $('.addressList-delete').toggleClass('switch');
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
    function deleteAddress(AddressID) {
        // TODO loading 动画
        openLoading();

        $.ajax({
            url: '/addresses',
            type: 'DELETE',
            data: { aid: AddressID }
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
    $('.addressList-delete').on('click', function (e) {
        var AddressID = $(e.target).parents('.addressList-container').data('address');
        $('#modalDialog').data('address', AddressID);
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
        var AddressID = $(this).data('address');
        if (AddressID === undefined || AddressID === null || AddressID === '') {
            console.log('AddressID 没有值');
            return;
        }
        deleteAddress(AddressID);
    });
})(jQuery);
//# sourceMappingURL=orderCheckout-addressList.js.map