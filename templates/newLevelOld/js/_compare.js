var optionCompare = {
    helper: '.helper-comp',
    frameCompare: '.frame-tabs-compare > div',
    left: '.left-compare li',
    right: '.items-compare > li',
    elEven: 'li',
    frameScroll: '.items-compare',
    mouseWhell: true,
    scrollNSP: true, //show scroll
    jScrollPane: true,
    scrollNSPT: '.items-catalog',
    onlyDif: $('[data-href="#only-dif"]'),
    allParams: $('[data-href="#all-params"]'),
    hoverParent: '.compare-characteristic',
    after: function(el) {
        $('.comprasion-head').css('height', el.find(optionCompare.scrollNSPT).height())
        //        if carousel in compare
        if ($.existsN(el.find('.carousel-js-css:not(.iscarousel)')))
            el.find('.carousel-js-css:not(.iscarousel)').myCarousel(carousel);
        $(window).scroll(); //for lazy
    },
    compareChangeCategory: function() {
        if ($.exists(optionCompare.frameCompare)) {
            $(optionCompare.frameCompare).equalHorizCell(optionCompare);
            if (optionCompare.onlyDif.parent().hasClass('active'))
                optionCompare.onlyDif.click();
            else
                optionCompare.allParams.click();
        }
    },
    scrollPane: {
        animateScroll: true,
        showArrows: true,
        arrowButtonSpeed: 250
    }
};
$(document).on('sync_cart after_add_to_cart', function() {
    $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
});
$(window).resize(function() {
    $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
});
$(document).on('scriptDefer', function() {
    $(document).on('delete_compare', function(e) {
        var $this = e.el,
        $thisI = $this.parents('li'),
        $thisP = $this.parents('[data-equalhorizcell]').last(),
        productsC = $thisP.find(optionCompare.right),
        productsCGen = productsC.add($thisP.siblings().find(optionCompare.right)).length,
        productsCL = productsC.length;
        $thisI.remove();
        if (productsCL == 1) {
            var btn = $('[data-href="#' + $thisP.attr('id') + '"],[href="#' + $thisP.attr('id') + '"]').parent();
            $thisP.find(optionCompare.left).remove();
            if ($.existsN(btn.next()))
                btn.next().children().click();
            else
                btn.prev().children().click();
            btn.remove();
        }
        if (productsCGen == 1) {
            $('.page-compare').find(genObj.blockEmpty).show().end().find(genObj.blockNoEmpty).hide()
        }
        //    if carousel
        if ($.existsN($thisP.find('.jcarousel-list')))
            if ($thisP.find('.right-compare').width() == (productsCL - 1) * productsC.last().width()) {
                $thisP.find('.jcarousel-list').css('left', 0)
                $thisP.find('.group-button-carousel').children().hide()
            }

        $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
        if (optionCompare.onlyDif.parent().hasClass('active'))
            optionCompare.onlyDif.click();
        else
            optionCompare.allParams.click();
    });
    $(optionCompare.frameCompare).equalHorizCell(optionCompare); //because rather call and call carousel twice
    //if select in compare
    $('#compare').change(function() {
        var $this = $(this);
        $($this.val()).siblings().hide().end().show();
        optionCompare.compareChangeCategory();
    }).change();
});