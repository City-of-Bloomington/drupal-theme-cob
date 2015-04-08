"use strict";
jQuery(function ($) {
    var launcherClick = function(e)  {
            var openMenus   = $('.menuLinks.open'),
                menu        = $(e.target).siblings('.menuLinks');
            openMenus.removeClass('open');
            openMenus.addClass('closed');

            menu.removeClass('closed');
            menu.addClass('open');
            e.stopPropagation();
        },
        documentClick = function(e) {
            var openMenus   = $('.menuLinks.open');

            openMenus.removeClass('open');
            openMenus.addClass('closed');
        };
    $('.menuLauncher').on('click', launcherClick);
    $(document).on('click', documentClick);
});