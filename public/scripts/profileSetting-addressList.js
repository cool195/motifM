/*global jQuery*/
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
                var Action = $(val).data('url-return');
                $(val).attr('data-action', Action);
            });
        } else {
            $.each($LinkList, function (index, val) {
                var Action = $(val).data('url-edit');
                $(val).attr('data-action', Action);
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
        openLoading();

        $.ajax({
            url: '/addresses',
            type: 'DELETE',
            data: {aid: AddressID}
        })
            .done(function (data) {
                if (data.success) {
                    location.reload();
                }
            })
            .always(function () {
                closeLoading();
            });
    }

    // 删除按钮
    $('.addressList-delete').on('click', function (e) {
        var AddressID = $(e.target).parents('.addressList-container').data('aid');
        $('#modalDialog').data('aid', AddressID);
    });

    $('.addressItem-info').on('click', function () {
        var Action = $(this).data('action');
        if (Action === 'return') {
            return;
        } else if (Action === 'edit') {
            window.location.href = $(this).data('url');
        }
    });


    $('div[data-role="submit"]').on('click', function () {
        // TODO 提交相应数据到后台
    });

    // 初始化 模态框
    $('#modalDialog').remodal({
        closeOnOutsideClick: false,
        hashTracking: false
    });

    $('#modalDialog').on('closed', function () {
        $(this).removeData('address');
    });

    $('#modalDialog').on('confirmation', function () {
        var AddressID = $(this).data('aid');
        if (AddressID === undefined || AddressID === null || AddressID === '') {
            return;
        }
        deleteAddress(AddressID);
    });

})(jQuery);


