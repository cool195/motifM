/**
 * Created by yinlinghui on 16/6/8.
 */
/*global jQuery template*/

'use strict';
(function ($) {
    // 加载动画显示
    function loadingShow() {
        $('#dailyContainer').find('.loading').show();
    }

    // 加载动画隐藏
    function loadingHide() {
        $('#dailyContainer').find('.loading').hide();
    }

    // ajax 请求 获取 daily 数据
    function getDailyList() {
        //  $DailyContainer 列表容器
        //  PageNum 当前页码数
        var $DailyContainer = $('#dailyContainer'),
            PageNum = $DailyContainer.data('pagenum');
        // 判断是否还有数据要加载
        if (PageNum === -1) {
            return;
        }

        // 判断当前选项卡是否在加载中
        if ($DailyContainer.data('loading') === true) {
            return;
        } else {
            $DailyContainer.data('loading', true);
        }

        var NextNum = ++PageNum;

        loadingShow();
        $.ajax({
            url: '/daily',
            data: {cmd: 'list', pagenum: NextNum, pagesize: 3}
        })
            .done(function (data) {
                console.info(data);
                if (data.data === null || data.data === '') {

                } else if (data.data.list === null || data.data.list === '' || data.data.list === undefined) {
                    $DailyContainer.data('pagenum', -1);
                }else{
                    // 遍历模板 插入页面
                    appendDailyList(data.data);
                    // 页数 +1
                    $DailyContainer.data('pagenum', PageNum);
                    console.info('当前页码数为' + PageNum);

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        container: $('#dailyContainer'),
                        effect: 'fadeIn'
                    });
                }
            })
            .always(function () {
                console.log('Ajax请求结束');

                $DailyContainer.data('loading', false);
                loadingHide();
            })
    }

    // 将数据插入到模板中
    function appendDailyList(DailyList) {
        var TplHtml = template('tpl-daily', DailyList);
        // 把 字符串 转义成 HTML
        var StageCache = $.parseHTML(TplHtml);
        // 将 html 插入页面相应位置
        $('.daily-content').append(StageCache);
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        // 首次加载
        getDailyList();
        $(window).scroll(function () {
            pullLoading();
            console.log('滚动条滚动');
        });
    });


    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax & scrollMax <= 100 + scrollCurrent) {
            getDailyList();
        }
    }

})(jQuery);


//# sourceMappingURL=daily.js.map
