/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery*/

'use strict';

(function ($) {
    // 设置默认地址 开关按钮
    $('#bg-openClose').on('click', function () {
        var classname = $(this).attr('class') === 'close' ? 'open' : 'close';
        var btnclassname = $('#btn-openClose').attr('class') === 'btn-close' ? 'btn-open' : 'btn-close';
        $(this).attr('class', classname);
        $('#btn-openClose').attr('class', btnclassname);
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
        var name = $('#name').val();
        var addr1 = $('#addr1').val();
        var addr2 = $('#addr2').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var zip = $('#zip').val();
        var tel = $('#tel').val();
        var idnum = $('#idnum').val();
        var country = $('#country').data('country');
        var isd = 0;
        if ($('#bg-openClose').hasClass('open')) {
            isd = 1;
        }
        $.ajax({
            url: '/useraddr/addUserAddress',
            type: 'POST',
            data: {
                cmd: 'add',
                name: name,
                addr1: addr1,
                addr2: addr2,
                state: state,
                city: city,
                zip: zip,
                tel: tel,
                idnum: idnum,
                country: country,
                isd: isd
            }
        }).done(function () {
            console.log('success');
            window.history.back(-1);
        }).fail(function () {
            console.log('error');
        }).always(function () {
            closeLoading();
            console.log('complete');
        });
    }

    // 点击提交表单
    $('#btn-addAddress').click(function () {
        addUserAddress();
    });

    // 退出添加
    $('#Cancel').click(function () {
        window.history.back(-1);
    });
})(jQuery);
//# sourceMappingURL=profileSetting-addAddress.js.map
