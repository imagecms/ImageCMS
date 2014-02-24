$.dropInit.prototype.extendDrop = function() {
    var addmethods = {
        droppable: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                drop.off('mousedown.' + $.drop.nS).on('mousedown.' + $.drop.nS, function(e) {
                    if (!$(e.target).is(':input')) {
                        body.on('mouseup.' + $.drop.nS, function(e) {
                            drop.css('cursor', '');
                            body.off('selectstart.' + $.drop.nS + ' mousemove.' + $.drop.nS + ' mouseup.' + $.drop.nS);
                        });
                        var $this = $(this).css('cursor', 'move'),
                                left = e.pageX - $this.offset().left,
                                top = e.pageY - $this.offset().top,
                                w = $this.outerWidth(),
                                h = $this.outerHeight(),
                                wndW = wnd.width(),
                                wndH = wnd.height();
                        body.on('selectstart.' + $.drop.nS, function(e) {
                            e.preventDefault();
                        });
                        var condScroll = $.exists('.scrollEmulation');
                        body.on('mousemove.' + $.drop.nS, function(e) {
                            drop.data('drp').droppableIn = true;
                            var l = e.pageX - left,
                                    t = e.pageY - top;

                            if (!drop.data('drp').droppableLimit) {
                                l = l < 0 ? 0 : l;
                                t = t < 0 ? 0 : t;
                                var addW = condScroll ? $.drop.widthScroll : 0;
                                l = l + w + addW < wndW ? l : wndW - w - addW;
                                t = t + h < wndH ? t : wndH - h;
                            }
                            $this.css({
                                'left': l,
                                'top': t
                            })
                        })
                    }
                });
            });
            return drop;
        },
        noinherit: function(drop, start) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                if (drop.data('drp') && !drop.data('drp').droppableIn) {
                    var method = drop.data('drp').animate && !start ? 'animate' : 'css',
                            placement = drop.data('drp').placement,
                            $this = drop.data('drp').elrun,
                            t = 0,
                            l = 0,
                            $thisW = $this.width(),
                            $thisH = $this.height(),
                            $thisT = 0,
                            $thisL = 0;
                    if (typeof placement == 'object') {
                        var tempObj = {};
                        for (var key in placement) {
                            tempObj[key] = placement[key];
                        }
                        drop[method](tempObj, {
                            duration: drop.data('drp').durationOn,
                            queue: false
                        });
                    }
                    else {
                        var $thisPMT = placement.toLowerCase().split(' ');
                        if ($thisPMT[0] === 'bottom' || $thisPMT[1] === 'bottom')
                            t = -drop.actual('outerHeight');
                        if ($thisPMT[0] === 'top' || $thisPMT[1] === 'top')
                            t = $thisH;
                        if ($thisPMT[0] === 'left' || $thisPMT[1] === 'left')
                            l = 0;
                        if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                            l = -drop.actual('width') - $thisW;
                        if ($thisPMT[0] === 'center')
                            l = -drop.actual('width') / 2 + $thisW / 2;
                        if ($thisPMT[1] === 'center')
                            t = -drop.actual('height') / 2 + $thisH / 2;

                        $thisT = $this.offset().top + t;
                        $thisL = $this.offset().left + l;
                        if ($thisL < 0)
                            $thisL = 0;
                        drop[method]({
                            'bottom': 'auto',
                            'top': $thisT,
                            'left': $thisL
                        }, {
                            duration: drop.data('drp').durationOn,
                            queue: false
                        });
                    }
                }
            });
            return drop;
        },
        heightContent: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this),
                        drp = drop.data('drp');

                if (drp.limitContentSize) {
                    var dropV = drop.is(':visible'),
                            forCenter = drp.forCenter,
                            docH = $(document).height();
                    if (!dropV) {
                        drop.show();
                        if (forCenter)
                            forCenter.show();
                    }

                    if (drp.dropContent) {
                        var el = drop.find($(drp.dropContent).add($($.drop.dPP.dropContent))).filter(':visible');

                        if (el.data('jsp'))
                            el.data('jsp').destroy()

                        el = drop.find($(drp.dropContent).add($($.drop.dPP.dropContent))).filter(':visible').css({'height': ''});

                        if ($.existsN(el)) {
                            var refer = drp.elrun;

                            var api = false,
                                    elCH = el.css({'overflow': ''}).outerHeight();

                            if (drp.scrollContent) {
                                try {
                                    api = el.jScrollPane(scrollPane).data('jsp');
                                    if ($.existsN(el.find('.jspPane')))
                                        elCH = el.find('.jspPane').outerHeight();
                                } catch (err) {
                                    el.css('overflow', 'auto');
                                }
                            }

                            var dropH = drop.outerHeight(),
                                    dropHm = drop.height();

                            var footerHeader = drop.find($(drp.dropHeader).add($($.drop.dPP.dropHeader))).outerHeight() + drop.find($(drp.dropFooter).add($($.drop.dPP.dropFooter))).outerHeight();

                            if (drp.place == 'noinherit') {
                                var mayHeight = 0,
                                        placement = drp.placement;
                                if (typeof placement == 'object') {
                                    if (placement.top != undefined)
                                        mayHeight = (drp.scroll ? wnd.height() : docH) - placement.top - footerHeader - (dropH - dropHm);
                                    if (placement.bottom != undefined)
                                        mayHeight = placement.bottom - footerHeader - (dropH - dropHm);
                                }
                                else {
                                    if (placement.search(/top/) >= 0) {
                                        mayHeight = (drp.scroll ? wnd.height() : docH) - refer.offset().top - (drp.scroll ? wnd.scrollTop() : 0) - footerHeader - refer.outerHeight() - (dropH - dropHm);
                                    }
                                    if (placement.search(/bottom/) >= 0) {
                                        mayHeight = refer.offset().top - (drp.scroll ? wnd.scrollTop() : 0) - footerHeader - (dropH - dropHm);
                                    }
                                }
                                if (mayHeight > elCH)
                                    el.css('height', elCH);
                                else
                                    el.css('height', mayHeight);
                            }
                            else {
                                if (elCH + footerHeader > dropHm)
                                    el.css('height', dropHm - footerHeader);
                                else
                                    el.css('height', elCH);
                            }

                            if (api)
                                api.reinitialise();
                        }
                    }
                    if (!dropV) {
                        drop.hide();
                        if (forCenter)
                            forCenter.hide();
                    }
                }
            });
            return drop;
        },
        limitSize: function(drop) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                if (drop.data('drp').limitSize) {
                    if (drop.data('drp').place === 'center') {
                        drop.css({
                            'width': '',
                            'height': ''
                        });
                        var wndW = wnd.width(),
                                wndH = drop.data('drp').scroll ? wnd.height() : $(document).height();

                        var dropV = drop.is(':visible'),
                                w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                                h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                                ws = dropV ? drop.width() : drop.actual('width'),
                                hs = dropV ? drop.height() : drop.actual('height');

                        if (w > wndW)
                            drop.css('width', wndW - w + ws);
                        if (h > wndH)
                            drop.css('height', wndH - h + hs);
                    }
                }
            });
            return drop;
        },
        scroll: {
            create: function() {
                var dur = $.drop.dP.durationOn;
                try {
                    clearInterval($.drop.dP.scrollemulatetimeout);
                } catch (err) {
                }
                setTimeout(function() {
                    if (!isTouch) {
                        body.addClass('isScroll').css({
                            'overflow': 'hidden',
                            'margin-right': $.drop.widthScroll,
                            'margin-left': 1
                        });
                        //$('html').css('overflow', 'hidden');
                        body.prepend('<div class="scrollEmulation" style="position: fixed;right: 0;height: 100%;width: ' + $.drop.widthScroll + 'px;overflow-y: scroll;z-index:10000;"><div style="width: 1px;height: ' + $.drop.dP.curDrop.height() + 'px;"></div></div>');
                        $('.scrollEmulation').off('scroll.' + $.drop.nS).on('scroll.' + $.drop.nS, function() {
                            $.drop.dP.curDrop.data('drp').forCenter.scrollTop($(this).scrollTop());
                        });

                    }
                    if (isTouch)
                        $('.for-center').on('touchmove.' + $.drop.nS, function(e) {
                            return false;
                        });
                    $(document).trigger({
                        'type': 'scrollEmulate.' + $.drop.nS
                    });
                }, dur);
            },
            remove: function() {
                var dur = $.drop.dP.durationOff;
                $.drop.dP.scrollemulatetimeout = setTimeout(function() {
                    body.removeClass('isScroll').css({
                        'overflow': '',
                        'margin-right': '',
                        'margin-left': 0
                    });
                    //$('html').css('overflow', '');
                    $('.scrollEmulation').remove();
                    if (isTouch)
                        $('.for-center').off('touchmove.' + $.drop.nS);
                    $(document).trigger({
                        'type': 'scrollEmulateRemove.' + $.drop.nS
                    });
                }, dur);
            }
        },
        galleries: function($this, set, methods) {
            var elSet = $this.data(),
                    relO = $this.get(0).rel;

            if (relO != '' && relO !== undefined) {
                var source = elSet.source || set.source || $this.attr('href'),
                        next = elSet.next || set.next,
                        prev = elSet.prev || set.prev,
                        cycle = elSet.cycle || set.cycle,
                        rel = relO.replace(/[^a-zA-Z0-9]+/ig, ''),
                        relA = $.drop.dP.galleries[rel],
                        drop = $('[data-elrun][data-rel="' + rel + '"]');

                if (relA !== undefined) {
                    var relL = relA.length,
                            relP = $.inArray(source ? source : drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).find('img').attr('src'), relA);
                    $(prev).add($(next)).hide().attr('disabled', 'disabled');
                    if (relP >= 0 && relP !== relL - 1)
                        $(next).show().removeAttr('disabled');
                    if (relP <= relL - 1 && relP !== 0)
                        $(prev).show().removeAttr('disabled');
                    if (cycle)
                        $(prev).add($(next)).show().removeAttr('disabled');
                }
                $(prev).add($(next)).attr('data-rel', rel).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    var $thisB = $(this).attr('disabled', 'disabled'),
                            relNext = relP + ($thisB.is(prev) ? -1 : 1);
                    if (cycle) {
                        if (relNext >= relL)
                            relNext = 0;
                        if (relNext < 0)
                            relNext = relL - 1;
                    }
                    if (relA[relNext]) {
                        var $this = $('[data-source="' + relA[relP] + '"][rel], [href="' + relA[relP] + '"][rel]').filter(':last'),
                                $next = $('[data-source="' + relA[relNext] + '"][rel], [href="' + relA[relNext] + '"][rel]').filter(':last');

                        methods.close($($this.data('drop')), undefined, function() {
                            methods.open({}, undefined, $next);
                        });
                    }
                });
            }
        },
        placeBeforeShow: function(drop, $this, methods, place, placeBeforeShow) {
            if (place !== 'inherit') {
                var pmt = placeBeforeShow.toLowerCase().split(' '),
                        t = -drop.actual('outerHeight'),
                        l = -drop.actual('outerWidth');

                if (pmt[0] === 'center' || pmt[1] === 'center') {
                    methods._checkMethod(function() {
                        methods[place](drop, true)
                    });
                    t = drop.css('top');
                    l = drop.css('left');
                }
                if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                    t = wnd.height();
                if (pmt[0] === 'right' || pmt[1] === 'right')
                    l = wnd.width();
                if (pmt[0] === 'center' || pmt[1] === 'center') {
                    if (pmt[0] === 'left')
                        l = -drop.actual('outerWidth');
                    if (pmt[0] === 'right')
                        l = wnd.width();
                    if (pmt[1] === 'top')
                        t = -drop.actual('outerHeight');
                    if (pmt[1] === 'bottom')
                        t = wnd.height();
                }
                drop.css({
                    'left': l, 'top': t
                });
                if (pmt[0] === 'inherit')
                    drop.css({
                        'left': $this.offset().left,
                        'top': $this.offset().top
                    });
            }
        },
        placeAfterClose: function(drop, $this, set) {
            var
                    method = set.animate ? 'animate' : 'css',
                    pmt = set.placeAfterClose.toLowerCase().split(' '),
                    t = -drop.actual('outerHeight'),
                    l = -drop.actual('outerWidth');

            if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                t = wnd.height();
            if (pmt[0] === 'right' || pmt[1] === 'right')
                l = wnd.width();
            if (pmt[0] == 'center' || pmt[1] == 'center') {
                if (pmt[0] === 'left') {
                    l = -drop.actual('outerWidth');
                    t = drop.css('top');
                }
                if (pmt[0] === 'right') {
                    l = wnd.width();
                    t = drop.css('top');
                }
                if (pmt[1] === 'top') {
                    t = -drop.actual('outerHeight');
                    l = drop.css('left');
                }
                if (pmt[1] === 'bottom') {
                    t = wnd.height();
                    l = drop.css('left');
                }
            }
            if (pmt[0] !== 'center' || pmt[1] !== 'center')
                drop.stop()[method]({
                    'top': t,
                    'left': l
                }, {
                    queue: false
                });
            if (pmt[0] === 'inherit')
                drop.stop()[method]({
                    'left': $this.offset().left,
                    'top': $this.offset().top
                }, {
                    queue: false
                });
        }
    };
    var newMethods = {};
    for (var i = 0, length = arguments.length; i < length; i++) {
        if (arguments[i] in addmethods) {
            newMethods[arguments[i]] = addmethods[arguments[i]];
        }
    }
    this.setMethods(newMethods);
    return this;
};