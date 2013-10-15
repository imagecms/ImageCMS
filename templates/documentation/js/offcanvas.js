$(document).ready(function() {
    if ($(document).height() <= $(window).height()) {
        $(".navbar-inner").addClass("navbar-fixed-bottom");
    }

    $('[data-toggle=offcanvas]').click(function() {
        $('.row-offcanvas').toggleClass('active');
    });
});

