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
                    helper = settings.helper,
                    nS = 'equal';
            $this.each(function(ind) {
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
                            var nab = $([]);
                            right.each(function() {
                                nab = nab.add($(this).find(elEven).eq(j));
                            });
                            var tempNabir = left.eq(j).add(nab);
                            tempNabir.each(function(index) {
                                var thisCh = $(this);
                                liH[index] = thisCh.outerHeight();
                                h = liH[index] > h ? liH[index] : h;
                            });
                            tempNabir.add(tempNabir.find(helper)).css('height', h).attr('data-equalHorizCell', '');
                            liH = [];
                            h = 0;
                        }
                        var w = 0;
                        frameScroll.children().each(function() {
                            w += $(this).outerWidth(true);
                        });
                        frameScroll.css('width', w);
                        var frameScrollP = frameScroll.parent(),
                                frameScrollPW = frameScrollP.width(),
                                scrollW = w - frameScrollPW;
                        if (scrollNSP && frameScrollCL !== 0) {
                            scrollNSPT = $this.find(scrollNSPT);
                            var topScrollNSP = scrollNSPT.position().top + scrollNSPT.height();
                            $this.children('.scrollNSP').remove();
                            $this.append('<div class="scrollNSP" style = "overflow:auto;"><div style="width:' + w + 'px;"></div></div>');
                        }
                        var firstScrl = frameScrollP.css('overflow', 'hidden'),
                                secScrl = $([]);
                        if (scrollNSP) {
                            secScrl = $this.children('.scrollNSP');
                            if (jScrollPane)
                                secScrl.addClass('jScrollPane');
                            secScrl.css({
                                'width': frameScrollPW,
                                'top': topScrollNSP
                            });
                        }
                        var api = '';
                        function initNSS() {
                            api = $(secScrl).jScrollPane(scrollPane);
                            api = api.data('jsp');
                            return api;
                        }
                        if (jScrollPane)
                            api = initNSS();
                        function scrollNst(deltaY, $thisSL) {
                            if ($thisSL !== scrollW && deltaY < 0) {
                                if (jScrollPane)
                                    api.scrollToX($thisSL + w / frameScrollCL);
                                else
                                    firstScrl.add(secScrl).scrollLeft($thisSL + w / frameScrollCL);
                            }
                            if ($thisSL > 0 && deltaY > 0) {
                                if (jScrollPane)
                                    api.scrollToX($thisSL - w / frameScrollCL);
                                else
                                    firstScrl.add(secScrl).scrollLeft($thisSL - w / frameScrollCL);
                            }
                        }
                        if ((mouseWhell || isTouch) && scrollW > 0) {
                            firstScrl.add(secScrl).off('mousewheel').on('mousewheel', function(event, delta, deltaX, deltaY) {
                                var $thisSL = $(this).scrollLeft();
                                if (jScrollPane)
                                    $thisSL = api.getContentPositionX();
                                scrollNst(deltaY, $thisSL);
                                if ($thisSL !== scrollW && $thisSL > 0)
                                    return false;
                            });
                            if (isTouch) {
                                firstScrl.off('touchstart.' + nS + ind + ' touchmove.' + nS + ind + ' touchend.' + nS + ind + '');
                                firstScrl.on('touchstart.' + nS + ind, function(e) {
                                    sP = e.originalEvent.touches[0];
                                    sP = sP.pageX;
                                });
                                firstScrl.on('touchmove.' + nS + ind, function(e) {
                                    e.stopPropagation();
                                    e.preventDefault();
                                    eP = e.originalEvent.touches[0];
                                    eP = eP.pageX;
                                });
                                firstScrl.on('touchend.' + nS + ind, function(e) {
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
                            api.scrollToX(0);
                        else
                            firstScrl.add(secScrl).scrollLeft('0');
                        if (scrollW > 0)
                            secScrl.off('scroll.' + nS + ind).on('scroll.' + nS + ind, function() {
                                var $thisSL = $(this).scrollLeft();
                                if (jScrollPane)
                                    $thisSL = api.getContentPositionX();
                                firstScrl.add(secScrl).scrollLeft($thisSL);
                            });
                        $this.attr('data-equalHorizCell', '');
                    }
                    var right = right.find(hoverParent),
                            left = left.parent(hoverParent).children();
                    left.each(function(ind) {
                        if (ind % 2 === 0)
                            $(this).removeClass('evenC').addClass('oddC');
                        else
                            $(this).removeClass('oddC').addClass('evenC');
                    });
                    right.each(function() {
                        $(this).find(elEven).each(function(ind) {
                            var $this = $(this),
                                    $thisCL = $this.children(':last');
                            $thisCL.text($thisCL.text().trimMiddle().pasteSAcomm());
                            if (ind % 2 === 0)
                                $this.removeClass('evenC').addClass('oddC');
                            else
                                $this.removeClass('oddC').addClass('evenC');
                        });
                    });
                    methods.hoverComprasion(left, right, elEven);
                    onlyDif.off('click.' + nS + ind).on('click.' + nS + ind, function() {
                        methods.onlyDifM(left, right, liLength, elEven);
                    });
                    allParams.off('click.' + nS + ind).on('click.' + nS + ind, function() {
                        methods.allParamsM(left, right, elEven);
                    });
                    onlyDif.parent('.' + aC).children().trigger('click.' + nS);
                    allParams.parent('.' + aC).children().trigger('click.' + nS);
                    after($this);
                }
            });
            return $this;
        },
        refresh: function(optionCompare) {
            var $this = $(this);
            $('[data-equalHorizCell]').removeAttr('data-equalHorizCell').filter(':not([data-refresh])').removeAttr('style');
            $this.equalHorizCell($.extend($.extend({}, optionCompare), {refresh: true}));
            return $this;
        },
        hoverComprasion: function(left, right, elEven) {
            left.add(right.find(elEven)).hover(function() {
                var $this = $(this),
                        index = $this.index(),
                        nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(index));
                });
                $([]).add(left.eq(index)).add(nab).addClass('hover');
            },
                    function() {
                        var $this = $(this),
                                index = $this.index(),
                                nab = $([]);
                        right.each(function() {
                            nab = nab.add($(this).find(elEven).eq(index));
                        });
                        $([]).add(left.eq(index)).add(nab).removeClass('hover');
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
                    nab = nab.add($(this).find(elEven).eq(j));
                });
                var tempNabir = nab;
                tempText = '';
                tempNabir.each(function(index) {
                    var thisCh = $(this);
                    liH[index] = thisCh.text();
                    if (tempText === liH[index])
                        k++;
                    tempText = liH[index];
                });
                if (k === tempNabir.length - 1 && k !== 0)
                    genObjC = genObjC.add(left.eq(j)).add(tempNabir);
                liH = [];
                k = 0;
                tempText = '';
            }
            right.each(function() {
                $(this).find(elEven).not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 === 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC');
                });
            });
            left.not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 === 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC');
            });
            genObjC.hide();
        },
        allParamsM: function(left, right, elEven) {
            left.removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 === 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC');
            }).show();
            right.each(function() {
                $(this).find(elEven).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 === 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC');
                }).show();
            });
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