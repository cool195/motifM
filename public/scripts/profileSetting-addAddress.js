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

    // 增加用户收货地址
    function addUserAddress() {
        openLoading();
        // 获取表单数据
        $.ajax({
            url: '/useraddr/addUserAddress',
            type: 'POST',
            data: $('#addressInfo').serialize()
        })
            .done(function (data) {
                if (data.success) {
                    console.log('success');
                    window.location.href = data.redirectUrl;
                }
            })
            .fail(function () {
                console.log('error');
            })
            .always(function () {
                closeLoading();
                console.log('complete');
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
    $('#country').on('click', function (e) {
        selectCountry();
    });
    // 点击提交表单
    $('#btn-addAddress').on('click', function (e) {
        $(e.target).removeClass('disabled');
        // 表单非空验证
        if (checkInput()) {
            addUserAddress();
        } else {
            $(e.target).addClass('disabled');
        }
    });


    // 退出添加
    $('#Cancel').on('click', function () {

    });
})(jQuery);


//# sourceMappingURL=profileSetting-addAddress.js.map
