/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

'use strict';
(function ($) {
    // 设置默认地址 开关按钮
    $('.radio-checkBox').on('click', function () {
        $(this).toggleClass('open');

        if ($(this).hasClass('open')) {
            $('#address-primary').prop('checked', true);
        } else {
            $('#address-default').prop('checked', true);
        }
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

    // 修改用户收货地址
    function changeAddress() {
        openLoading();
        // 获取表单数据
        $.ajax({
            url: '/addr/modify',
            type: 'POST',
            data: $('#addressInfo').serialize()
        })
            .done(function (data) {
                if (data.success) {
                    window.location.href = data.redirectUrl;
                }
            })
            .fail(function () {
            })
            .always(function () {
                closeLoading();
            });
    }

    // 表单非空验证
    function checkInput() {
        var Result = true;
        $('input[type="text"]').each(function () {
            if ($(this).val() === '') {
                Result = false;
                return Result;
            }
            // TODO 添加警告
        });
        return Result;
    }

    // 表单格式验证
    function selectCountry() {
        openLoading();
        // 获取表单数据
        $('#addressInfo').submit();
    }

    // 跳转页面,
    $('#country').on('click', function () {
        selectCountry();
    });
    // 点击提交表单
    $('#btn-addAddress').on('click', function (e) {
        $(e.target).removeClass('disabled');
        // 表单非空验证
        if (checkInput()) {
            changeAddress();
        } else {
            $(e.target).addClass('disabled');
        }
    });

    // 退出添加
    $('#Cancel').on('click', function () {

    });
})(jQuery);

//# sourceMappingURL=profileSetting-changeAddress.js.map
