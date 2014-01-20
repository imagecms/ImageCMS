$(document).ready(function() {
    if ($(document).height() <= $(window).height()) {
        $(".navbar-inner").addClass("navbar-fixed-bottom");
    }

    if ($('.tree_menu').find('ul:first .active').length === 0) {
        $('.tree_menu').find('ul:first>li:first ul:eq(0)').show();
        $('.tree_menu').find('ul:first>li:first ul:eq(1)').show();
    }

    $(".top_menu_documentation li .top-menu-item, .main_page_block_from_menu .top-menu-item").on('click', function() {
        var categoryMenu = $(this).data('category_menu');
        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear() + 1);

        var date = new Date();
        date.setTime(date.getTime() + 2000);

        document.cookie = "category_menu=" + categoryMenu + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        document.cookie = "clicked=1 ;expires=" + date.toGMTString() +  ";path=/";
//        window.location = window.location; // власне переадресація

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
