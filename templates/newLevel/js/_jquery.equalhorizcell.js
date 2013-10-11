(function($) {
    var methods = {
        init: function(options) {
            var $this = $(this),
                    settings = $.extend({
                refresh: false,
                after: function() {
                }
            }, options),
                    mouseWhell = settings.mouseWhell,
                    elEven = settings.elEven,
                    onlyDif = settings.onlyDif,
                    allParams = settings.allParams,
                    hoverParent = settings.hoverParent,
                    jScrollPane = settings.jScrollPane || false,
                    after = settings.after,
                    scrollPane = settings.scrollPane,
                    nS = '.equal';
            $this.each(function(index) {
                var $this = $(this),
                        visThis = $this.is(':visible');
                if (visThis) {
                    var left = $this.find(settings.left),
                            right = $this.find(settings.right),
                            liLength = left.length;
                    if (!$this.is('[data-equalHorizCell]')) {
                        var h = 0,
                                liH = [],
                                frameScroll = $this.find(settings.frameScroll),
                                frameScrollC = frameScroll.children(),
                                frameScrollCL = frameScrollC.length,
                                scrollNSP = settings.scrollNSP && $.exists(frameScroll),
                                scrollNSPT = settings.scrollNSPT;
                        for (var j = 0; j < liLength; j++) {
                            nab = $([]);
                            right.each(function() {
                                nab = nab.add($(this).find(elEven).eq(j))
                            })
                            var tempNabir = left.eq(j).add(nab);
                            tempNabir.each(function(index) {
                                var thisCh = $(this);
                                liH[index] = thisCh.outerHeight();
                                liH[index] > h ? h = liH[index] : h = h;
                            });
                            tempNabir.add(tempNabir.find('.helper')).css('height', h).attr('data-equalHorizCell', '');
                            liH = [];
                            h = 0;
                        }
                        var w = 0;
                        frameScroll.children().each(function() {
                            w += $(this).outerWidth(true);
                        })
                        frameScroll.css('width', w);
                        var frameScrollP = frameScroll.parent(),
                                frameScrollPW = frameScrollP.width(),
                                scrollW = w - frameScrollPW;
                        if (scrollNSP && frameScrollCL != 0) {
                            scrollNSPT = $this.find(scrollNSPT);
                            topScrollNSP = scrollNSPT.position().top + scrollNSPT.height();
                            $this.children('.scrollNSP').remove();
                            $this.append('<div class="scrollNSP" style = "overflow:auto;"><div style="width:' + w + 'px;"></div></div>')
                        }
                        var firstScrl = frameScrollP.css('overflow', 'hidden'),
                                secScrl = $([]);
                        if (scrollNSP) {
                            secScrl = $this.children('.scrollNSP');
                            if (jScrollPane)
                                secScrl.addClass('jScrollPane')
                            secScrl.css({
                                'width': frameScrollPW,
                                'top': topScrollNSP
                            })
                        }
                        var api = '';
                        function initNSS() {
                            api = $(secScrl).jScrollPane(scrollPane);
                            api = api.data('jsp');
                            return api;
                        }
                        if (jScrollPane)
                            api = initNSS();
                        function scrollNst(deltaY) {
                            if (jScrollPane)
                                $thisSL = api.getContentPositionX();
                            else
                                $thisSL = $(this).scrollLeft();
                            if ($thisSL != scrollW && deltaY < 0) {
                                if (jScrollPane)
                                    api.scrollToX($thisSL + w / frameScrollCL)
                                else
                                    firstScrl.add(secScrl).scrollLeft($thisSL + w / frameScrollCL);
                                return false;
                            }
                            if ($thisSL > 0 && deltaY > 0) {
                                if (jScrollPane)
                                    api.scrollToX($thisSL - w / frameScrollCL)
                                else
                                    firstScrl.add(secScrl).scrollLeft($thisSL - w / frameScrollCL);
                                return false;
                            }
                        }
                        if ((mouseWhell || isTouch) && scrollW > 0) {
                            firstScrl.add(secScrl).unbind('mousewheel').on('mousewheel', function(event, delta, deltaX, deltaY) {
                                scrollNst(deltaY);
                            });
                            if (isTouch) {
                                firstScrl.unbind('touchstart' + nS + ' touchmove' + nS + ' touchend' + nS + '');
                                firstScrl.on('touchstart' + nS, function(e) {
                                    sP = e.originalEvent.touches[0];
                                    sP = sP.pageX;
                                });
                                firstScrl.on('touchmove' + nS, function(e) {
                                    e.stopPropagation();
                                    e.preventDefault();
                                    eP = e.originalEvent.touches[0];
                                    eP = eP.pageX;
                                });
                                firstScrl.on('touchend' + nS, function(e) {
                                    e.stopPropagation();
                                    if (Math.abs(eP - sP) > 200) {
                                        if (eP - sP > 0) {
                                            scrollNst(1);
                                        }
                                        else {
                                            scrollNst(-1);
                                        }
                                    }
                                });
                            }
                        }
                        if (jScrollPane)
                            api.scrollToX(0)
                        else
                            firstScrl.add(secScrl).scrollLeft('0');
                        if (scrollW > 0)
                            secScrl.unbind('scroll' + nS).on('scroll' + nS, function() {
                                if (jScrollPane)
                                    $thisSL = api.getContentPositionX();
                                else
                                    $thisSL = $(this).scrollLeft();
                                firstScrl.add(secScrl).scrollLeft($thisSL);
                            });
                        $this.attr('data-equalHorizCell', '');
                    }
                    var right = right.find(hoverParent),
                            left = left.parent(hoverParent).children();
                    left.each(function(ind) {
                        if (ind % 2 == 0)
                            $(this).removeClass('evenC').addClass('oddC');
                        else
                            $(this).removeClass('oddC').addClass('evenC')
                    });
                    right.each(function() {
                        $(this).find(elEven).each(function(ind) {
                            var $this = $(this),
                                    $thisCL = $this.children(':last');
                            $thisCL.text($thisCL.text().trimMiddle().pasteSAcomm());
                            if (ind % 2 == 0)
                                $this.removeClass('evenC').addClass('oddC');
                            else
                                $this.removeClass('oddC').addClass('evenC')
                        });
                    });
                    methods.hoverComprasion(left, right, elEven);
                    onlyDif.unbind('click' + nS).on('click' + nS, function() {
                        methods.onlyDifM(left, right, liLength, elEven);
                    });
                    allParams.unbind('click' + nS).on('click' + nS, function() {
                        methods.allParamsM(left, right, elEven);
                    });
                    onlyDif.parent('.' + activeClass).children().trigger('click' + nS);
                    allParams.parent('.' + activeClass).children().trigger('click' + nS);
                    after($this);
                }
            })
            return $this;
        },
        refresh: function(optionCompare) {
            var $this = $(this);
            $('[data-equalHorizCell]').removeAttr('data-equalHorizCell').filter(':not([data-refresh])').removeAttr('style');
            $this.equalHorizCell($.extend($.extend({}, optionCompare), {refresh: true}))
            return $this;
        },
        hoverComprasion: function(left, right, elEven) {
            left.add(right.find(elEven)).hover(function() {
                var $this = $(this),
                        index = $this.index(),
                        nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(index))
                })
                $([]).add(left.eq(index)).add(nab).addClass('hover')
            },
                    function() {
                        var $this = $(this),
                                index = $this.index(),
                                nab = $([]);
                        right.each(function() {
                            nab = nab.add($(this).find(elEven).eq(index))
                        })
                        $([]).add(left.eq(index)).add(nab).removeClass('hover')
                    });
        },
        onlyDifM: function(left, right, liLength, elEven) {
            var liH = [],
                    genObjC = $([]),
                    tempText = '',
                    k = 0;
            for (var j = 0; j < liLength; j++) {
                var nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(j))
                })
                var tempNabir = nab,
                        tempText = '';
                tempNabir.each(function(index) {
                    var thisCh = $(this);
                    liH[index] = thisCh.text();
                    if (tempText == liH[index])
                        k++;
                    tempText = liH[index];
                });
                if (k == tempNabir.length - 1 && k != 0)
                    genObjC = genObjC.add(left.eq(j)).add(tempNabir);
                liH = [];
                k = 0;
                tempText = '';
            }
            right.each(function() {
                $(this).find(elEven).not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 == 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC')
                });
            });
            left.not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 == 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC')
            });
            genObjC.hide();
        },
        allParamsM: function(left, right, elEven) {
            left.removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 == 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC')
            }).show();
            right.each(function() {
                $(this).find(elEven).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 == 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC')
                }).show();
            })
        }
    };
    $.fn.equalHorizCell = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.equalHorizCell');
        }
    };
    $.equalHorizCell = function(m) {
        return methods[m];
    };
})(jQuery);
$(document).on('scriptDefer', function() {
    $(document).on('delete_compare', function(e) {
        var $this = e.el,
                $thisI = $this.parents(genObj.parentBtnBuy),
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
            $('.page-compare').find(genObj.blockEmpty).show()
            $('.page-compare').find(genObj.blockNoEmpty).hide()
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
    })
})