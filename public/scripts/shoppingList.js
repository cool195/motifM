/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery Swiper template*/

'use strict';

(function ($, Swiper) {
    // 搜索条件
    var SearchType = "";

    // 产品类别
    var categoryType = 0;

    // 导航条自动隐藏
    $('#header').headroom({
        'tolerance': .5,
        'offset': 44,
        'classes': {
            // when above offset
            top: 'animated',
            // when below offset
            notTop: 'animated',
            // when at bottom of scoll area
            bottom: 'animated',
            // when not at bottom of scroll area
            notBottom: 'animated',
            // when element is initialised
            initial: 'animated',
            // when scrolling up
            pinned: 'slideInDown',
            // when scrolling down
            unpinned: 'slideOutUp'
        }
    }); 

    // 导航条自动隐藏
    $('#tabIndex-container').headroom({
        'tolerance': .5,
        'offset': 44,
        'classes': {
            // when above offset
            top: 'animated',
            // when below offset
            notTop: 'animated',
            // when at bottom of scoll area
            bottom: 'animated',
            // when not at bottom of scroll area
            notBottom: 'animated',
            // when element is initialised
            initial: 'animated',
            // when scrolling up
            pinned: 'tabIndexDown',
            // when scrolling down
            unpinned: 'tabIndexUp'
        }
    });

    //加载动画显示
    function loadingShow(){
        $('.loading').show();
    }
    //加载动画隐藏
    function loadingHide(){
        $('.loading').hide();
    }

    //显示/隐藏 二级菜单
    $('#nav-categoryTit').on('click', function () {
        var $searchContainer = $('.search-container');
        $searchContainer.toggleClass('active');
        $(this).toggleClass('active');
        if ($searchContainer.hasClass('active')) {
            $searchContainer.slideDown("fast");
            $('#productList-container').addClass('dark-mask');
        } else {
            $searchContainer.slideUp("fast");
            $('#productList-container').removeClass('dark-mask');
        }
        return false;
    });

    //选择二级菜单项
    $('.search-item').on('click', function () {
        $('.search-item').removeClass('active');
        $(this).addClass('active');
        $('.search-container').toggleClass('active');
        $('#nav-categoryTit').toggleClass('active');
        $('.search-container').slideUp("fast");

        $('#productList-container').removeClass('dark-mask');

        // 选择 产品类别
        categoryType = $(this).data('categoryid');
        $('#productList-container').data('pagenum',0);
        $('#productList-container').data('loading', false);

        //改变显示的分类标题
        $('#nav-categoryTit').html($(this).data('categoryname'));

        getProductList(2);
    });


    // 页面初始化
    (function initBody() {
        getProductList(1);
    })();

    /**
     * 加载商品列表, ajax请求
     * @need appendProductsList()
     * type 加载方式 1:继续加载  2:重新加载(新的搜索条件)
     */

    function getProductList(type){
        var $ProductListontainer = $('#productList-container'),
            Size = 20;

        // 判断当前选项卡是否在加载中
        if ($ProductListontainer.data('loading') === true) {
            return;
        } else {
            $ProductListontainer.data('loading', true);
        }
        //  PageNum 当前页码数
        if (type === 1) {
            var PageNum = $ProductListontainer.data('pagenum');
        } else {
            var PageNum = 0;
        }

        //判断是否还有数据要加载
        if (PageNum === -1){
            return;
        }

        // 当前选项卡所要加载的分页页码
        var NextPage = ++PageNum;

        //当前激活的分类ID
        var CategoryId = $('.search-item.active').data('categoryid');

        //显示loading动画
        loadingShow();

        // 筛选搜索条件
        var Url;
        if (SearchType != '') {
            console.log('SearchType==='+SearchType);
            Url = '/products?extra_kv=sea:' + SearchType;
        } else {
            Url = '/products';
        }

        // ajax 请求加载数据
        $.ajax({
            url: Url,
            data: {
                pagenum: NextPage,
                pagesize: Size,
                cid: CategoryId
            }
        }).done(function (data) {
            if (data.success) {
                //onImpressProduct(data.data.list);
                if (data.data === null || data.data === '' || data.data.list.length === 0) {
                    $ProductListontainer.data('pagenum', -1);
                } else {
                    console.log(categoryType);
                    console.log(Url);
                    // 遍历模板 插入页面
                    appendProductsList(data.data, type);
                    $ProductListontainer.data('pagenum', NextPage);

                    $.ajax({
                        url: data.data.impr
                    });

                    // 图片延迟加载
                    $('img.img-lazy').lazyload({
                        threshold: 200,
                        container: $('#productList-container'),
                        effect: 'fadeIn'
                    });

                    //给模板a标签绑定事件
                    $('[data-clk]').unbind('click');
                    $('[data-clk]').bind('click', function () {
                        var $this = $(this);

                        $('#productClick-name').val($this.data('title'));
                        $('#productClick-spu').val($this.data('spu'));
                        $('#productClick-price').val($this.data('price'));

                        //onProductClick();

                        if (undefined !== $this.data('link')) {
                            $.ajax({
                                url: $this.data('clk'),
                                type: "GET"
                            });
                            setTimeout(function () {
                                window.location.href = $this.data('link');
                            }, 100);
                        }
                    })
                }
            }
        }).always(function () {
            // 隐藏加载动画
            loadingHide();
            // 请求结束, loading = false
            $ProductListontainer.data('loading', false);
        })
    }

    // 遍历 data 生成html 插入到页面
    function appendProductsList(ProductsList, type) {
        var TplHtml = template('tpl-product', ProductsList);
        var StageCache = $.parseHTML(TplHtml);
        if (type === 1){
            $('#productList-container').find('.row').append(StageCache);
        }else if (type === 2){
            $('.productList').each(function () {
                $(this).html('');
            });
            $('#productList-container').find('.row').html(StageCache);
        }

    }

    // 选中 筛选条件
    $('.btn-sortBy').on('change', function () {
        //$('.btn-sortBy').children('option').first().hide();
        //$('.btn-sortBy').children('option').eq(1).attr("selected", "selected");

        var $currentOption = $(".btn-sortBy option:selected");
        //$currentOption.text('Sort By');
        
        //改变选中的文本
        if ( $('.btn-sortBy option').value === 0){
            $(".btn-sortBy option").attr("selected",true);
        }else{
            $(".btn-sortBy option").attr("selected",false);
        }
        if ( $currentOption.data('searchtext') == 'reset'){
            // 重置
            SearchType = '';
            // 隐藏搜索条件
            $('.lowTo-info').html(SearchType);
            $('.lowTo').addClass('disabled');
        }else{
            console.log($(this).val());
            // 搜索条件
            SearchType = $currentOption.data('search');
            // 显示搜索条件
            $('.lowTo-info').html($currentOption.data('searchtext'));
            $('.lowTo').removeClass('disabled');


        }
        $('#productList-container').data('pagenum', 0);
        $('#productList-container').data('loading', false);
        getProductList(2);

    });

    // 下拉加载
    function pullLoading() {
        // scrollCurrent    当前滚动距离
        // scrollMax        最大滚动距离
        var scrollCurrent = window.pageYOffset,
            scrollMax = $(document).height() - $(window).height();
        // 当页面在底部区域时, 触发加载事件
        if (scrollCurrent !== scrollMax && scrollMax <= 300 + scrollCurrent) {
            getProductList(1);
        }
    }

    // 为页面绑定 滚动条事件
    $(document).ready(function () {
        $(window).scroll(function () {
            $('img.img-lazy').each(function () {
                var Src = $(this).attr('src'),
                    Original = $(this).attr('data-original');
                if (Src === Original) {
                    $(this).removeClass('img-lazy');
                }
            });
            pullLoading();
        });
    });

    // 点击 wish
    $('#productList-container').on('click', '.btn-wish', function (e) {
        var $this = $(e.target);
        var spu = $(e.target).data('spu');
        if (spu != undefined) {
            if (!$this.hasClass('active')) {
                $this.addClass('active');
            } else {
                $this.removeClass('active');
            }
            $.ajax({
                url: '/updateWish',
                type: 'post',
                data: {spu: spu}
            });
        } else {
            spu = $this.data('actionspu');
            $.ajax({
                    url: '/notesaction',
                    type: 'get',
                    data: {
                        action: 'wish',
                        spu: spu
                    }
                })
                .done(function (data) {
                    window.location.href = '/login';
                });
        }
    });

})(jQuery, Swiper);
