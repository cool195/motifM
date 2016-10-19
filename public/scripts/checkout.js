/**
 * Created by lhyin on 16/10/19.
 */
/*global jQuery*/

'use strict';
(function ($) {
    // AddressList begin
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

    // 公共方法 跳转到某页面
    function toPage($pageview) {
        $('.pageview').removeClass('active');
        $pageview.addClass('active');
    }

    // 点击 添加地址
    $('#btn-toAddAddress').on('click', function () {
        toPage($('.shipping-editorAddress'));
    });

    // AddressList end

    // AddAddress begin
    // 设置默认地址 开关按钮
    $('.radio-checkBox').on('click', function () {
        $(this).toggleClass('open');

        if ($(this).hasClass('open')) {
            $('#address-primary').prop('checked', true);
        } else {
            $('#address-default').prop('checked', true);
        }
    });

    // 点击 Cancel 按钮
    $('#btn-cancelEditorAddress').on('click', function () {
        toPage($('.shipping-chooseAddress'));
    });

    // 点击选择 Country
    $('#btn-toCountryList').on('click', function () {
        toPage($('.shipping-chooseCountry'));
    });

    // AddAddress end




















})(jQuery);

