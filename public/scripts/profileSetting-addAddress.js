/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

'use strict';
(function($) {
    // 设置默认地址 开关按钮
    $('.radio-checkBox').on('click', function() {
        $(this).toggleClass('open');

        if ($(this).hasClass('open')) {
            $('#address-primary').prop('checked', true);
        } else {
            $('#address-default').prop('checked', true);
        }
    });
    //
    function openAddSuccess() {
        $('#success').toggleClass('loading-hidden');
        setTimeout(function() {
            $('#success').toggleClass('loading-open');
        }, 25);
    }
    //
    function closeAddSuccess() {
        $('#success').addClass('loading-close');
        setTimeout(function() {
            $('#success').toggleClass('loading-hidden loading-open').removeClass('loading-close');
        }, 500);
    }
    // loading 打开
    function openLoading() {
        $('.loading').toggleClass('loading-hidden');
        setTimeout(function() {
            $('.loading').toggleClass('loading-open');
        }, 25);
    }

    // loading 隐藏
    function closeLoading() {
        $('.loading').addClass('loading-close');
        setTimeout(function() {
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
            .done(function(data) {
                if (data.success) {
                    openAddSuccess();
                    setTimeout(function() {
                        closeAddSuccess();
                        window.location.href = data.redirectUrl;
                    }, 1500);
                }
            })
            .always(function() {
                closeLoading();
            });
    }

    // 表单非空验证
    function checkInput() {
        var Result = true;
        $('input[data-optional="false"]').each(function() {
            if ($(this).val() === '' && !$(this).data('optional')) {
                Result = $(this);
                return false;
            }
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
    $('#country').on('click', function() {
        selectCountry();
    });

    // 输入框非空验证
    $('input[data-optional="false"]').on('blur keyup', function() {
        var $Error = checkInput();
        if ($Error === true) {
            $('.warning-info').addClass('hidden-xs-up');
            $('#btn-addAddress').removeClass('disabled');
        } else {
            $('.warning-info').removeClass('hidden-xs-up');
            $('.warning-info').children('span').text('Please enter your ' + $Error.data('role') + ' !');
            $('#btn-addAddress').addClass('disabled');
        }
    });

    // 点击提交表单
    $('#btn-addAddress').on('click', function(e) {
        if (!$(e.target).hasClass('disabled')) {
            addUserAddress();
        }
    });

    // 退出添加
    $('#Cancel').on('click', function () {
        $('#infoForm').attr('action', $('#Cancel').attr('data-action'));
        $('#infoForm').submit();
    });

    $(document).ready(function () {
        var $Error = checkInput();
        if ($Error === true) {
            $('#btn-addAddress').removeClass('disabled');
        }
    });
})(jQuery);

//# sourceMappingURL=profileSetting-addAddress.js.map
