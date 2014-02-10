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
                        var condH = $(document).height() > wnd.height() && drop.data('drp').place == 'center';
                        body.on('mousemove.' + $.drop.nS, function(e) {
                            drop.data('drp').droppableIn = true;
                            var l = e.pageX - left,
                                    t = e.pageY - top;
                            l = l < 0 ? 0 : l;
                            t = t < 0 ? 0 : t;
                            var addW = condH ? $.drop.widthScroll : 0;
                            l = l + w + addW < wndW ? l : wndW - w - addW;
                            t = t + h < wndH ? t : wndH - h;
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
                if (!drop.data('drp').droppableIn) {
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
                            t = -drop.actual('height') - $thisH;
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
                    var dropH = drop.outerHeight(),
                            dropHm = drop.height();

                    if (drp.dropContent) {
                        var el = drop.find($(drp.dropContent).add($($.drop.dPP.dropContent))).filter(':first');

                        el.css({
                            'height': '',
                            'overflow': ''
                        })

                        if (el.data('jsp'))
                            el.data('jsp').destroy()
                        if ($.existsN(el)) {
                            var refer = drp.elrun;

                            var api = false,
                                    elJP = el.css('overflow', '');

                            if (drp.scrollContent) {
                                try {
                                    el.jScrollPane(scrollPane);
                                    elJP = el.find('.jspPane');
                                    api = el.data('jsp');
                                } catch (err) {
                                    el.css('overflow', 'auto');
                                }
                            }
                            var elCH = elJP.height(),
                                    footerHeader = drop.find($(drp.dropHeader).add($($.drop.dPP.dropHeader))).outerHeight() + drop.find($(drp.dropFooter).add($($.drop.dPP.dropFooter))).outerHeight();

                            if (drp.place == 'noinherit') {
                                var mayHeight = 0,
                                        placement = drp.placement;
                                if (typeof placement == 'object') {
                                    if (placement.top != undefined)
                                        mayHeight = drp.overlayOpacity === '0' ? docH : wnd.height() - placement.top - footerHeader - (dropH - dropHm);
                                    if (placement.bottom != undefined)
                                        mayHeight = placement.bottom - footerHeader;
                                }
                                else {
                                    if (placement.search(/top/) >= 0) {
                                        mayHeight = drp.overlayOpacity === '0' ? docH : wnd.height() - refer.offset().top - footerHeader - refer.outerHeight() - (dropH - dropHm);
                                    }
                                    if (placement.search(/bottom/) >= 0) {
                                        mayHeight = refer.offset().top - footerHeader - refer.outerHeight();
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
                            'margin-right': $.drop.widthScroll
                        });
                        $('html').css('overflow', 'hidden');
                        body.prepend('<div class="scrollEmulation" style="position: absolute;right: 0;top: ' + wnd.scrollTop() + 'px;height: 100%;width: ' + $.drop.widthScroll + 'px;overflow-y: scroll;z-index:10000;"></div>');
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
                        'margin-right': ''
                    });
                    $('html').css('overflow', '');
                    wnd.scrollTop($.drop.dP.wST);
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
                var tempF = arguments.callee,
                        source = elSet.source || set.source || $this.attr('href'),
                        next = elSet.next || set.next,
                        prev = elSet.prev || set.prev,
                        cycle = elSet.cycle || set.cycle,
                        elChangeSource = elSet.changeSource,
                        place = elSet.place || set.place,
                        changeSource = set.changeSource,
                        rel = relO.replace(/[^a-zA-Z0-9]+/ig, ''),
                        relA = $.drop.dP.galleries[rel],
                        drop = $('[data-elrun][data-rel="' + rel + '"]');

                if (relA !== undefined) {
                    var relL = relA.length,
                            relP = $.inArray(source != undefined ? source : drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).find('img').attr('src'), relA);
                    $(prev).add($(next)).hide();
                    if (relP == 0)
                        $(next).show();
                    if (relP == relL - 1)
                        $(prev).show();
                    if ((relP > 0 && relP < relL - 1) || cycle)
                        $(prev).add($(next)).show();
                }
                $(prev).add($(next)).attr('data-rel', rel).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function() {
                    var $thisB = $(this).attr('disabled', 'disabled'),
                            relCur = relP + ($thisB.is(prev) ? -1 : 1);
                    if (cycle) {
                        if (relCur >= relL)
                            relCur = 0;
                        if (relCur < 0)
                            relCur = relL - 1;
                    }
                    source = relA[relCur];
                    var $this = $('[data-source="' + relA[relCur] + '"][rel], [href="' + relA[relCur] + '"][rel]').filter(':last'),
                            elSet = $this.data();
                    function _changeSource(data) {
                        var dropContent = elSet.dropContent || set.dropContent,
                                dropHeader = elSet.dropHeader || set.dropHeader,
                                dropFooter = elSet.dropFooter || set.dropFooter,
                                contentHeader = elSet.contentHeader != undefined ? elSet.contentHeader.toString() : (set.contentHeader != undefined ? set.contentHeader : false),
                                contentContent = elSet.contentContent != undefined ? elSet.contentContent.toString() : (set.contentContent != undefined ? set.contentContent : false),
                                contentFooter = elSet.contentFooter != undefined ? elSet.contentFooter.toString() : (set.contentFooter != undefined ? set.contentFooter : false);
                        methods._pasteContent($this, drop, contentHeader, dropHeader, contentContent, dropContent, contentFooter, dropFooter);
                        changeSource(data, $this, drop);
                        if (elChangeSource !== undefined)
                            eval(elChangeSource)(data, $this, drop);
                        drop.add($(document)).trigger({
                            'type': 'changeSource.' + $.drop.nS,
                            'el': $this,
                            'drop': drop,
                            'datas': data
                        });
                    }
                    if (source.match(/jpg|gif|png|bmp|jpeg/)) {
                        $('<img src="' + source + '" style="max-height: 100%;"/>').load(function() {
                            drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).empty().append($(this))
                            var $thisImg = $(this);
                            $thisB.removeAttr('disabled');
                            tempF($this, set, methods);

                            _changeSource($thisImg);
                            $thisImg.css('max-height', '');
                            methods._checkMethod(function() {
                                methods.limitSize(drop)
                            })
                            methods._checkMethod(function() {
                                methods.heightContent(drop)
                            })
                            $thisImg.css('max-height', '100%');
                            if (place != 'inherit')
                                methods._checkMethod(function() {
                                    methods[place](drop, true)
                                })
                        });
                    }
                    else {
                        function _tempF3(data) {
                            $thisB.removeAttr('disabled');
                            tempF(source);
                            _changeSource(data);
                            methods._checkMethod(function() {
                                methods.heightContent(drop)
                            })
                            methods._checkMethod(function() {
                                methods.limitSize(drop)
                            })
                            if (place != 'inherit')
                                methods._checkMethod(function() {
                                    methods[place](drop, true)
                                })
                        }

                        if (typeof $.drop.dP.galleriesContent[rel][source] !== 'undefined' && !(elSet.always || set.always)) {
                            drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).html($.drop.dP.galleriesContent[rel][source])
                            _tempF3($.drop.dP.galleriesContent[rel][source]);
                        }
                        else {
                            if ($.exists(source)) {
                                if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                                    $.drop.dP.galleriesContent[rel][source] = $(source).html();
                                drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).html($.drop.dP.galleriesContent[rel][source])
                            }
                            else
                                drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).load(source, function(data) {
                                    if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                                        $.drop.dP.galleriesContent[rel][source] = data;
                                    _tempF3(data);
                                });
                        }
                    }
                });
            }
        },
        placeBeforeShow: function(drop, $this, methods, place, placeBeforeShow) {
            if (place !== 'inherit') {
                var t = -drop.actual('outerHeight'),
                        l = -drop.actual('outerWidth');
                var pmt = placeBeforeShow.toLowerCase().split(' ');
                if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                    t = wnd.height() + wnd.scrollTop();
                if (pmt[0] === 'right' || pmt[1] === 'right')
                    l = wnd.width() + wnd.scrollLeft();
                if (pmt[0] === 'center' || pmt[1] === 'center') {
                    if (pmt[1] === 'left')
                        l = -drop.actual('outerWidth');
                    if (pmt[1] === 'right')
                        l = wnd.width() + wnd.scrollLeft();
                    if (pmt[0] === 'top')
                        t = -drop.actual('outerHeight');
                    if (pmt[0] === 'bottom')
                        t = wnd.height() + wnd.scrollTop();
                }
                drop.css({
                    'left': l,
                    'top': t
                });
                if (pmt[0] === 'center' && pmt[1] === 'center')
                    methods._checkMethod(function() {
                        methods[place](drop, true)
                    })
                if (pmt[0] === 'inherit')
                    drop.css({
                        'left': $this.offset().left + wnd.scrollLeft(),
                        'top': $this.offset().top + wnd.scrollTop()
                    });
            }
        },
        placeAfterClose: function(drop, $this, set) {
            var method = set.animate ? 'animate' : 'css',
            pmt = set.placeAfterClose.toLowerCase().split(' '),
                    l = 0, t = 0;
            if (pmt[0] === 'bottom' || pmt[1] === 'bottom')
                t = wnd.height();
            if (pmt[0] === 'right' || pmt[1] === 'right')
                l = wnd.width();
            if (pmt[0] == 'center' || pmt[1] == 'center') {
                if (pmt[1] === 'left') {
                    l = -drop.actual('outerWidth');
                    t = drop.css('top');
                }
                if (pmt[1] === 'right') {
                    l = wnd.width() + wnd.scrollLeft();
                    t = drop.css('top');
                }
                if (pmt[0] === 'top') {
                    t = -drop.actual('outerHeight');
                    l = drop.css('left');
                }
                if (pmt[0] === 'bottom') {
                    t = wnd.height() + wnd.scrollTop();
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
                    'left': $this.offset().left + wnd.scrollLeft(),
                    'top': $this.offset().top + wnd.scrollTop()
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
};