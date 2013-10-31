$(document).ready(function() {
    if ($(document).height() <= $(window).height()) {
        $(".navbar-inner").addClass("navbar-fixed-bottom");
    }

    if ($('.tree_menu').find('ul:first .active').length === 0) {
        $('.tree_menu').find('ul:first>li:first ul:eq(0)').show();
        $('.tree_menu').find('ul:first>li:first ul:eq(1)').show();
    }

    $(".top_menu_documentation li a").on('click', function() {
        var categoryMenu = $(this).data('category_menu');
        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear() + 1);
        document.cookie = "category_menu=" + categoryMenu + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        window.location = window.location; // переадресація на ту саму сторінку
    });

    $('div.main_content img').each(function() {
        if (!$(this).parent('a').hasClass('fancybox'))
            $(this).wrap('<a class="fancybox" rel="group" href="' + $(this).attr('src') + '"></a');
    });

    if (!hasCRUDAccess)
        $(".fancybox").fancybox({
            padding: 0,
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
});

