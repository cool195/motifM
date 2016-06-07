/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    var options = {
        closeOnOutsideClick: false,
        hashTracking: true
    };

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

    // 触发编辑地址事件 更改按钮样式
    $('#btnEdit').on('click', function () {
        // 修改状态
        if ($(this).hasClass('btn-edit')) {
            $(this).removeClass('btn-edit').addClass('btn-done').html('Done');
            $('#addressList').addClass('editing');
        } else {
            //修改完成状态
            $(this).removeClass('btn-done').addClass('btn-edit').html('Edit');
            $('#addressList').removeClass('editing');
        }
    });

    // 删除送货地址
    function deladdress(aid) {
        openLoading();
        $.ajax({
            url: '/useraddr/delUserAddress',
            type: 'DELETE',
            data: { cmd: 'del', aid: aid }
        }).done(function () {
            console.log('success');
            closeLoading();
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // 初始化 模态框
    $('#addressDialog').remodal(options);

    // 触发 删除点
    $('[data-remodal-target="modal"]').click(function (e) {
        // 暂存数据到模态框
        $('#addressDialog').data('aid', $(e.target).data('aid'));
        console.log('open');
    });

    // 关闭模态框后 去除模态框中的数据
    $('#addressDialog').on('closed', function () {
        $(this).removeData('aid');
        console.log('close');
    });

    // 模态框 确认删除
    $('#addressDialog').on('confirmation', function () {
        var aid = $(this).data('aid');
        console.info(aid);
        deladdress(aid);
    });
})(jQuery);
//# sourceMappingURL=profileSetting-addressList.js.map
