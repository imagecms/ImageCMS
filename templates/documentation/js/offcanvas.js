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

        var url = window.location.origin;
        var len = url.length;
        var lastChar = url.substr(len - 1, len);
        var newLocation = lastChar != '#' ? url : url.substr(0, len - 1);
        window.location = newLocation; // власне переадресація

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

$('.left-menu-out-sec > li').has('ul').addClass('has-sub');
$('.left-menu-out-sec > li').has('ul > .active').addClass('has-sub-not-active');
$('.tree_menu > ul > .active').has('ul > .active').addClass('has-sub-not-active');
