$(document).ready(function() {
    var carousel = {
        prev: '.prev',
        next: '.next',
        content: '.content-carousel',
        groupButtons: '.group-button-carousel',
        vCarousel: '.vertical-carousel',
        hCarousel: '.horizontal-carousel'
    };
    var cuselOptions = {
        changedEl: ".lineForm:visible select",
        visRows: 100,
        scrollArrows: false
    };
    if ($.fn.myCarousel) {
        $('.horizontal-carousel .carousel-js-css:not(.cycleFrame):not(.frame-scroll-pane):visible').myCarousel(carousel);
        $('.vertical-carousel .carousel-js-css:visible').myCarousel(carousel);
    }

    if ($.fn.drop) {
        var optionsDrop = {
            overlayColor: '#000',
            overlayOpacity: 0.6,
            durationOn: 500,
            durationOff: 200,
            closeClick: true,
            closeEsc: true,
            scroll: false,
        };
        $.drop.setParameters(optionsDrop);
        $.drop.extendDrop('droppable', 'noinherit', 'heightContent', 'scroll', 'limitSize', 'galleries', 'placeBeforeShow', 'placeAfterClose', 'confirmPrompt');
        $('[data-drop-filter]').drop({place: 'inherit', overlayOpacity: 0});
        $('[data-drop').drop();
    }

    if ($.exists(cuselOptions.changedEl) && $.isFunction(window.cuSel))
        cuSel(cuselOptions);

    var catalogForm = $('#catalogForm');
    $('#sort').on('change.orderproducts', function() {
        catalogForm.find('input[name=order]').val($(this).val());
        catalogForm.submit();
    });

    $('body').on('click.trigger', '[data-trigger]', function(e) {
        var $thisT = $(this);
        $($thisT.data('trigger')).trigger({
            type: "click",
            scroll: $thisT.data('scroll') !== undefined || false,
            trigger: true
        });
    });

    if ($.fn.nStCheck)
        $('.frame-labels').nStCheck();

    if ($.fn.cycle)
        $('.cycle').cycle({
            speed: 600,
            timeout: 5000,
            fx: 'fade',
            pauseOnPagerHover: true,
            pager: $('.pager'),
            pagerAnchorBuilder: function(idx, slide) {
                return '<a href="#">' + $(slide).data('description') + '</a>';
            }
        }).hover(function() {
            $('.cycle').cycle('pause');
        }, function() {
            $('.cycle').cycle('resume');
        });

    $('.addPrice').on('nstcheck.cc nstcheck.cuc', function() {
        var price = $('.priceVariant');
        $(this).is(":checked") ? price.text(price.data('price') + (+$(this).val())) : price.text(price.data('price'));
    });
});