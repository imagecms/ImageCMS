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
});