/**
 * Created by lhyin on 16/10/19.
 */
/*global jQuery*/

'use strict';
(function ($) {
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

    // AddressList begin
    // 点击 添加地址
    $('#btn-toAddAddress').on('click', function () {
        toPage($('.shipping-editorAddress'));
        initAddAddressForm(1, 0);
    });

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

    function switchSelect($Edit) {
        var $IconFont = $('.addressItem-info').find('.iconfont');
        if ($Edit.hasClass('active')) {
            $IconFont.removeClass('icon-arrow-right').addClass('icon-radio');
        } else {
            $IconFont.removeClass('icon-radio').addClass('icon-arrow-right');
        }
    }

    function switchLink($Edit) {
        var $LinkList = $('.addressItem-info');

        if ($Edit.hasClass('active')) {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-return');
                $(val).data('action', Link);
            });
        } else {
            $.each($LinkList, function (index, val) {
                var Link = $(val).data('url-edit');
                $(val).data('action', Link);
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

    $('[data-role="submit"]').on('click', function () {
        var Action = $(this).data('action');
        $('#infoForm').attr('action', Action);
        $('#infoForm').submit();
    });

    $('[data-role="add"]').on('click', function () {
        var Action = $(this).data('action');
        $('#infoForm').attr('action', Action);
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
    function deleteAddress(AddressID) {
        // TODO loading 动画
        openLoading();

        $.ajax({
                url: '/addresses',
                type: 'DELETE',
                data: {
                    aid: AddressID
                }
            })
            .done(function () {
                location.reload();
            })
            .always(function () {
                closeLoading();
            });
    }

    // 删除按钮
    $('.addressList-delete').on('click', function (e) {
        var AddressID = $(e.target).parents('.addressList-container').data('address');
        $('#modalDialog').data('address', AddressID);
    });

    $('.addressItem-info').on('click', function () {
        var Action = $(this).data('action');
        // 当前点击项所对应的 Aid
        var Aid = $(this).parents('.addressList-container').data('address');

        if (Action === 'return') {
            $('.icon-radio.active').removeClass('active');
            $(this).find('.icon-radio').addClass('active');
            $('input[name="aid"]').val(Aid); // 需要提交的项
        } else if (Action === 'edit') {
            // 跳转到编辑页面
            //$('input[name="eid"]').val(Aid); // 需要修改的项
            //var $InfoForm = $('#infoForm');
            //$InfoForm.attr('action', '/cart/addrmod');
            //$InfoForm.submit();

            // 编辑地址
            toPage($('.shipping-editorAddress'));

        }

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
        var AddressID = $('#modalDialog').data('address');
        if (AddressID === undefined || AddressID === null || AddressID === '') {
            return;
        }
        deleteAddress(AddressID);
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

    // 初始化 添加/修改地址表单 （根据地址 id 获取地址信息）
    // Type 1:添加地址  2:修改地址
    // AddressId 0:添加地址  其他:修改地址
    function initAddAddressForm(Type, AddressId) {
        if (Type === 1 && AddressId === 0) {
            // 添加地址
            if ($('.addressItem-info').length <= 0) {
                $('.radio-checkBox').addClass('open');
            } else {
                $('.radio-checkBox').removeClass('open');
            }
            //初始化 修改地址 from 表单
            $('input[name="email"]').val('');
            $('input[name="name"]').val('');
            $('input[name="city"]').val('');
            $('input[name="state"]').val('');
            $('input[name="tel"]').val('');
            $('input[name="addr1"]').val('');
            $('input[name="addr2"]').val('');
            $('input[name="zip"]').val('');
            $('#btn-submitEditorAddress').addClass('disabled');
            //$('select[name="country"]').prop('selectedIndex', 0);


            // 初始化 国家,洲
            var Country = $('select[name="country"] option:selected').text();
            initCityState(Country, '');
        } else {
            // 修改地址
            $.ajax({
                    url: '/address/' + AddressId,
                    type: 'GET'
                })
                .done(function (data) {
                    //初始化 修改地址 from 表单
                    $('input[name="email"]').val(data.email);
                    $('input[name="name"]').val(data.name);
                    $('input[name="city"]').val(data.city);
                    $('input[name="state"]').val(data.state);
                    $('input[name="tel"]').val(data.telephone);
                    $('input[name="addr1"]').val(data.detail_address1);
                    $('input[name="addr2"]').val(data.detail_address2);
                    $('input[name="zip"]').val(data.zip);
                    $('select[name="country"]').val(data.country);

                    // 初始化 国家,洲
                    initCityState(data.country, data.state);

                    if (data.isDefault == 1) {
                        $('.isDefault').addClass('active');
                    } else {
                        $('.isDefault').removeClass('active');
                    }
                    $('.address-save').removeClass('disabled');

                })
        }
    }

    // 初始化 国家,洲
    function initCityState(Country, State) {
        // CountryId  国家Id
        // SelectType 国家对应洲类型
        var CountryId = $('select[name="country"] > option[value="' + Country + '"]').data('id');
        var SelectType = $('select[name="country"] > option[value="' + Country + '"]').data('type');
        if (SelectType != undefined && SelectType === 0) {
            // 洲为选填
            $('.state-info').html('<input type="text" name="state" class="form-control contrlo-lg text-primary" placeholder="State (optional)">');
            $('input[name="state"]').val(State);
        } else if (SelectType != undefined && SelectType === 1) {
            // 洲为必填
            $('.state-info').html('<input type="text" name="state" class="form-control contrlo-lg text-primary address-state" placeholder="State"><div class="warning-info flex flex-alignCenter text-warning p-t-5x off"> <i class="iconfont icon-caveat icon-size-md p-r-5x"></i> <span class="font-size-base">Please enter your State !</span> </div>');
            $('input[name="state"]').val(State);
        } else {
            // 洲为下拉列选择
            // 获取 洲 列表
            $.ajax({
                    url: '/statelist/' + CountryId,
                    type: 'GET'
                })
                .done(function (data) {
                    $('.state-info').html('<select name="state" class="form-control contrlo-lg select-country"></select>');
                    // 添加选项
                    $.each(data, function (n, value) {
                        var StateNameId = value['state_name_sn'];
                        var StateNameEn = value['state_name_en'];
                        $("<option></option>").val(StateNameId).text(StateNameEn).appendTo($("select"));
                    });
                    if (State != "") {
                        $('select[name="state"]').val(State);
                    }
                })
        }
    }

    // AddAddress end


})(jQuery);

