$(document).ready(function(){

    $(".js-fancybox").attr('rel', 'gallery').fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		openEffect	: 'none',
		closeEffect	: 'none',
        padding : [0,0,0,0]
	});

	$('.b-banner-main.js').removeClass('no-js').slick({
        dots: true,
        arrows: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow: '<i class="b-banner-main__prev g-arrow-l fa fa-angle-left fa-2x"></i>',
        nextArrow: '<i class="b-banner-main__next g-arrow-l fa fa-angle-right fa-2x"></i>',
        responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false
            }
        }
        ]
    });

    $('.b-gallery-w.js').slick({
        dots: false,
        arrows: false,
        adaptiveHeight: false,
        slidesToShow: 5,
        autoplay: false,
        autoplaySpeed: 4000,
        swipeToSlide: true,
        responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 960,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });

    $('.b-review-w.js').slick({
        dots: false,
        arrows: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        prevArrow: '<i class="b-review-w__prev g-arrow-m fa fa-angle-left fa-lg"></i>',
        nextArrow: ' <i class="b-review-w__next g-arrow-m fa fa-angle-right fa-lg"></i>'

    });

    $('.b-partner-w.js').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        prevArrow: '<i class="b-partner-w__prev g-arrow-m fa fa-angle-left fa-lg"></i>',
        nextArrow: ' <i class="b-partner-w__next g-arrow-m fa fa-angle-right fa-lg"></i>',
        responsive: [
            {
            breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.js-double-tap').doubleTapToGo();

    $('.b-toggle-menu.js').on('click', function(){
        $('.b-menu').toggleClass('js-toggle', 300, "easeOutSine");
    });

});
