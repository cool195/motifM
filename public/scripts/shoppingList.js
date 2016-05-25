/**
 * Created by zhaozhe on 16/5/23.
 */
/*global jQuery Swiper*/

'use strict';

(function ($, Swiper) {
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

    // 选项卡导航
    var TabIndexSwiper = new Swiper('#tabIndex-container', {
        freeMode: true,
        slidesPerView: 'auto',
        freeModeMomentumRatio: .5,
        onTap: function onTap() {
            if ($(event.target).is('li') || $(event.target).is('a') || $(event.target).is('span')) {
                tabSwitch(TabIndexSwiper.clickedIndex);
            }
        }
    });

    // 选项卡容器
    var TabsContainerSwiper = new Swiper('#tabs-container', {
        onlyExternal: true
    });

    // 导航和选项卡容器 联动的方法
    function tabSwitch(index) {
        // 选项卡序号 移动
        TabIndexSwiper.slideTo(index, 500, false);
        // 选项卡 移动
        TabsContainerSwiper.slideTo(index, 500, false);
        // 为选项卡序号 更改样式
        $(TabIndexSwiper.slides).children('a').addClass('inactive');
        $(TabIndexSwiper.slides[index]).children('a').removeClass('inactive');
    }
})(jQuery, Swiper);
//# sourceMappingURL=shoppingList.js.map
