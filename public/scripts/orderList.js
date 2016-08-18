/*global jQuery template*/
'use strict';
(function($) {
    /**
     *
     * @param ProductsList
     */
    function appendProductsList(ProductsList) {
        var TplHtml = template('tpl-orderList', ProductsList);
        var StageCache = $.parseHTML(TplHtml);
        // TODO 插入页面相应位置
        $('#orderContainer').append(StageCache);
    }

    /**
     *
     */
    function listLoading() {
        var $OrderContainer = $('#orderContainer');

        // 判断当前选项卡是否在加载中
        if ($OrderContainer.data('loading') === true) {
            return;
        } else {
            $OrderContainer.data('loading', true);
        }

        var Page = $OrderContainer.data('pagenum');
        if (Page === -1) {
            return;
        }

        var NextPage = ++Page;
        // 显示加载动画
        $('#loading').show();

        // ajax 请求加载数据
        $.ajax({
                url: '/orders',
                data: {
                    num: NextPage,
                    size: 20
                }
            })
            .done(function(data) {
                if (data.data === null || data.data === '' || data.data.list.length === 0) {
                    // 没有数据要加载
                    $OrderContainer.data('pagenum', -1);
                    $('#emptyOrder').removeClass('hidden-xs-up');
                } else if (data.data.list.length > 0) {
                    // if (NextPage === 1) {
                    $('#emptyOrder').remove();
                    // } else {
                    // $('#emptyOrder').removeClass('hidden-xs-up');
                    // }

                    // 遍历模板 插入页面
                    appendProductsList(data.data);

                    // 加载页 页码+1
                    $OrderContainer.data('pagenum', NextPage);

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        container: $('#orderContainer'),
                        effect: 'fadeIn'
                    });
                }
            })
            // TODO failed 时的提示
            .always(function() {
                // 隐藏加载动画
                $('#loading').hide();
                // 请求结束, loading = false
                $OrderContainer.data('loading', false);

            });
    }

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax && scrollMax <= 300 + scrollCurrent) {
            listLoading();
        }
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function() {
        $(window).scroll(function() {
            pullLoading();
        });
    });
    window.onload = function() {
        listLoading();
    };

    // 初始化 弹出 paywith 选择框
    var Options = {
        closeOnOutsideClick: true,
        closeOnCancel: false,
        hashTracking: false
    };
    // 选择支付方式框
    var PayWithModal = $('[data-remodal-id="paywith-modal"]').remodal(Options);
    // 打开窗口
    //PayWithModal.open();
    // 关闭窗口
    //PayWithModal.close();

    $('#orderContainer').on('click','.checkoutPay',function () {
        $('#payAgain1').attr('href','/payAgain/'+$(this).data('orderid')+'/0');
        $('#payAgain2').attr('href','/payAgain/'+$(this).data('orderid')+'/1');
        PayWithModal.open();
    });
})(jQuery);

//# sourceMappingURL=orderList.js.map
