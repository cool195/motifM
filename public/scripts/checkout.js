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

    // shipping begin
    // 选择 shipping method
    $('.method-item').on('click', function () {
        $('.method-item').removeClass('active');
        $(this).addClass('active');
        //更新选择配送方式
        $.ajax({
            url: '/checkout/selShip/' + $(this).data('type'),
            type: 'GET',
        })
    });

    // 提交 shipping 信息 （continue 按钮)
    $('#submit-shipping').on('click', function () {
        window.location.href = $(this).data('url');
    });
    // shipping end

    // AddressList begin

    // 提交 Address 选择信息 （continue 按钮)
    $('#submit-address').on('click', function () {
        window.location.href = $(this).data('url')
    });

    // 点击 添加地址
    $('#btn-toAddAddress').on('click', function () {
        toPage($('.shipping-editorAddress'));
        $('#shipping-editorAddress').data('aid', '');
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
            //更新选择地址
            $.ajax({
                    url: '/checkout/selAddr/' + Aid,
                    type: 'GET',
                })

                .done(function (data) {
                    if (data.receiving_id == Aid) {
                        window.location.href = '/checkout/shipping';
                    }
                })
        } else if (Action === 'edit') {
            // 跳转到编辑页面
            //$('input[name="eid"]').val(Aid); // 需要修改的项
            //var $InfoForm = $('#infoForm');
            //$InfoForm.attr('action', '/cart/addrmod');
            //$InfoForm.submit();

            // 编辑地址
            $('#shipping-editorAddress').data('aid', Aid);
            toPage($('.shipping-editorAddress'));
            initAddAddressForm(2, Aid);
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

    // 点击选择 State
    $('.state-info').on('click', '#stateselect', function () {
        toPage($('.shipping-chooseState'));
    });

    // 初始化 添加/修改地址表单 （根据地址 id 获取地址信息）
    // Type 1:添加地址  2:修改地址
    // AddressId 0:添加地址  其他:修改地址
    function initAddAddressForm(Type, AddressId) {
        if (Type === 1 && AddressId === 0) {
            // 添加地址
            //初始化 修改地址 from 表单
            $('input[name="name"]').val('');
            $('input[name="city"]').val('');
            $('input[name="state"]').val('');
            $('input[name="tel"]').val('');
            $('input[name="addr1"]').val('');
            $('input[name="addr2"]').val('');
            $('input[name="zip"]').val('');
            $('#btn-submitEditorAddress').addClass('disabled');
            // 初始化 国家,洲
            var Country = $('#countryName').text();
            initCityState(Country, '');

            // 判断是否默认地址
            if ($('.addressItem-info').length > 0) {
                $('#makePrimary').removeAttr('hidden');
                $('.radio-checkBox').removeClass('open');
                $('#address-default').attr('checked', 'checked');
                $('#address-primary').removeAttr('checked');
            }

        } else {
            // 修改地址
            $.ajax({
                    url: '/address/' + AddressId,
                    type: 'GET'
                })
                .done(function (data) {
                    //初始化 修改地址 from 表单
                    $('input[name="name"]').val(data.name);
                    $('input[name="city"]').val(data.city);
                    $('input[name="state"]').val(data.state);
                    $('input[name="tel"]').val(data.telephone);
                    $('input[name="addr1"]').val(data.detail_address1);
                    $('input[name="addr2"]').val(data.detail_address2);
                    $('input[name="zip"]').val(data.zip);
                    $('#btn-submitEditorAddress').removeClass('disabled');

                    // 初始化 国家,洲
                    initCityState(data.country, data.state);

                    // 判断是否 是修改默认地址
                    if (data.isDefault == 1) {
                        $('#makePrimary').attr('hidden', 'hidden');
                    } else {
                        $('#makePrimary').removeAttr('hidden');
                        $('.radio-checkBox').removeClass('open');
                        $('#address-default').attr('checked', 'checked');
                        $('#address-primary').removeAttr('checked');
                    }
                })
        }
    }

    // 初始化 国家,洲
    function initCityState(Country, State) {
        // CountryId  国家Id
        // SelectType 国家对应洲类型
        var CountryId = $('[data-cname="' + Country + '"]').data('cid'),
            SelectType = $('[data-cname="' + Country + '"]').data('type'),
            ChildLabel = $('[data-cname="' + Country + '"]').data('childlabel'),
            ZipCode = $('[data-cname="' + Country + '"]').data('zipcode');
        // 初始化 ZipCode
        $('input[name="zip"]').attr('placeholder', ZipCode);
        // 初始化国家列表
        $('.country-item').removeClass('active');
        $('[data-cid=' + CountryId + ']').addClass('active');
        // 初始化国家信息
        $('#btn-toCountryList').data('id', CountryId);
        $('#btn-toCountryList').data('type', SelectType);
        $('#btn-toCountryList').data('childlabel', ChildLabel);
        $('#btn-toCountryList').data('zipcode', ZipCode);
        $('#countryName').html(Country);
        $('input[name="country"]').val(Country);

        if (SelectType != undefined && SelectType === 0) {
            // 洲为选填
            $('.state-info').html('<input type="text" name="state" data-optional="true" class="form-control form-control-block p-a-15x font-size-sm" placeholder="State (optional)">');
            $('input[name="state"]').val(State);
        } else if (SelectType != undefined && SelectType === 1) {
            // 洲为必填
            $('.state-info').html('<input type="text" name="state" data-optional="false" data-role="' + ChildLabel + '" class="form-control form-control-block p-a-15x font-size-sm address-state" placeholder="' + ChildLabel + '">');
            $('input[name="state"]').val(State);
        } else {
            // 初始化国家列表
            $('.country-item').removeClass('active');
            $('[data-cid=' + CountryId + ']').addClass('active');

            // 洲为下拉列选择
            // 获取 洲 列表
            var StateNameEn = '',
                StateNameSn = '';
            $.ajax({
                    url: '/statelist/' + CountryId,
                    type: 'GET'
                })
                .done(function (data) {
                    // 添加选项
                    $.each(data, function (n, value) {
                        StateNameEn = value['state_name_en'];
                        StateNameSn = value['state_name_sn'];
                        var StateId = value['state_id'];
                        if (n === 0) {
                            $('.state-info').html('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option" id="stateselect"> <span id="childLabel">' + ChildLabel + '</span> <div> <span id="stateName">' + StateNameEn + '</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i> </div><input type="text" name="state" data-optional="false" hidden value="' + StateNameSn + '"></div>');
                            $('.statelist-info').append('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x state-item active" data-statesn="' + StateNameSn + '" data-state="' + StateNameEn + '" data-sid="' + StateId + '"> <span>' + StateNameEn + '</span> <i class="iconfont icon-check icon-size-sm text-common"></i> </div> <hr class="hr-base">');
                        } else {
                            $('.statelist-info').append('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-x-15x p-y-10x state-item" data-statesn="' + StateNameSn + '" data-state="' + StateNameEn + '" data-sid="' + StateId + '"> <span>' + StateNameEn + '</span> <i class="iconfont icon-check icon-size-sm text-common"></i> </div> <hr class="hr-base">');
                        }
                        // 转化州 简写和非简写
                        if (State != "") {
                            if (StateNameSn === State) {
                                State = StateNameEn;
                            }
                        }
                    });
                    if (State != "") {
                        StateNameEn = State;
                        $('.state-info').html('<div class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x address-option" id="stateselect"> <span id="childLabel">' + ChildLabel + '</span> <div> <span id="stateName">' + StateNameEn + '</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i> </div><input type="text" name="state" data-optional="false" hidden value="' + StateNameSn + '"></div> </div>');

                        // 勾选中 选择
                        $('.state-item').removeClass('active');
                        $('[data-state="' + StateNameEn + '"]').addClass('active');
                    }
                })
        }
    }

    // 选择国家
    $('.country-item').on('click', function () {
        var CountryId = $(this).data('cid'),
            CountryName = $(this).data('cname'),
            CountryType = $(this).data('type'),
            ChildLabel = $(this).data('childlabel'),
            ZipCode = $(this).data('zipcode');
        // 赋值
        $('#btn-toCountryList').data('id', CountryId);
        $('#btn-toCountryList').data('type', CountryType);
        $('#btn-toCountryList').data('childlabel', ChildLabel);
        $('#btn-toCountryList').data('zipcode', ZipCode);
        $('#countryName').html(CountryName);
        $('input[name="country"]').val(CountryName);

        // 勾选中 选择
        $('.country-item').removeClass('active');
        $('[data-cid=' + CountryId + ']').addClass('active');

        // 初始化 州
        initCityState(CountryName, '');
        // 页面跳转
        toPage($('.shipping-editorAddress'));
    });

    // 选择州
    $('.statelist-info').on('click', '.state-item', function () {
        var StateId = $(this).data('sid'),
            StateNameEn = $(this).data('state'),
            StateNameSn = $(this).data('statesn');
        $('.state-info #stateName').html(StateNameEn);
        $('input[name="state"]').val(StateNameSn);

        // 勾选中 选择
        $('.state-item').removeClass('active');
        $('[data-sid=' + StateId + ']').addClass('active');

        // 页面跳转
        toPage($('.shipping-editorAddress'));
    });

    // TODO 表单验证
    // 表单非空验证
    function checkInput() {
        var Result = true;
        $('input[data-optional="false"]').each(function () {
            if ($(this).val() === '' && !$(this).data('optional')) {
                Result = $(this);
                return false;
            }
        });
        return Result;
    }

    // 输入框非空验证
    $('input[data-optional="false"]').on('blur keyup', function () {
        var $Error = checkInput();
        if ($Error === true) {
            $('.warning-info').addClass('hidden-xs-up');
            $('#btn-submitEditorAddress').removeClass('disabled');
        } else {
            $('.warning-info').removeClass('hidden-xs-up');
            $('.warning-info').children('span').text('Please enter your ' + $Error.data('role') + ' !');
            $('#btn-submitEditorAddress').addClass('disabled');
        }
    });

    // 提交表单（新增/修改地址）
    $('#btn-submitEditorAddress').on('click', function () {
        var Aid = $('#shipping-editorAddress').data('aid');
        if (Aid === '' || Aid === undefined) {
            // 添加地址
            $.ajax({
                    url: '/checkout/address',
                    type: 'POST',
                    data: $('#addAddressForm').serialize()
                })
                .done(function (data) {
                    if (data.success) {
                        window.location.href = '/checkout/shipping';
                    }
                })
        } else {
            $.ajax({
                    url: '/updateUserAddr/' + Aid,
                    type: 'POST',
                    data: $('#addAddressForm').serialize()
                })
                .done(function (data) {
                    if (data.success) {
                        window.location.href = '/checkout/shipping';
                    }
                })
        }
        window.location.reload();
    });

    // 取消修改国家
    $('#cancel-country').on('click', function () {
        toPage($('.shipping-editorAddress'));
    });
    // 取消修改州
    $('#cancel-state').on('click', function () {
        toPage($('.shipping-editorAddress'));
    });
    // AddAddress end

    // payment begin
    // 添加卡
    $('.btn-toAddCard').on('click', function () {
        toPage($('.shipping-addCard'));
        var CountryName = $('#btn-toCountryList').data('oldcountry');
        var StateName = $('.state-info').data('oldstate');
        // 初始化 国家,洲
        initCityState(CountryName, StateName);
    });

    // 取消添加卡信息
    $('#btn-cancelAddCard').on('click', function () {
        toPage($('.shipping-payment'));
    });

    // promotion code
    $('#btn-toPromotionCode').on('click', function () {
        toPage($('.shipping-promotion'));
    });

    // 取消添加 promotion code
    $('#btn-cancelPromoCode').on('click', function () {
        toPage($('.shipping-payment'));
    });

    // 验证卡输入信息
    $('#card-container').card({
        container: '.card-wrapper'
    });

    // 取消选择国家
    $('#cancel-paymentCountry').on('click', function () {
        toPage($('.shipping-addCard'));
    });
    // 取消选择州
    $('#cancel-paymentState').on('click', function () {
        toPage($('.shipping-addCard'));
    });

    // payment end


})(jQuery);
