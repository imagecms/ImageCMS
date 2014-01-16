$.dropInit.prototype.extendDrop = function() {
    var methods = {
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
                    start = start === undefined ? true : false;
                    var method = drop.data('drp').animate && start ? 'animate' : 'css',
                    placement = drop.data('drp').placement,
                    $this = drop.data('drp').elrun,
                    dataSourceH = 0,
                    dataSourceW = 0,
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
                            dataSourceH = -drop.actual('height') - $thisH;
                        if ($thisPMT[0] === 'top' || $thisPMT[1] === 'top')
                            dataSourceH = $thisH;
                        if ($thisPMT[0] === 'left' || $thisPMT[1] === 'left')
                            dataSourceW = 0;
                        if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                            dataSourceW = -drop.actual('width') + $thisW;
                        $thisT = $this.offset().top + dataSourceH;
                        $thisL = $this.offset().left + dataSourceW;
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
                var drop = $(this);
                if (drop.data('drp').limitContentSize) {
                    var dropV = drop.is(':visible'),
                    wndH = wnd.height();
                    if (drop.data('drp').dropContent) {
                        var el = drop.find($(drop.data('drp').dropContent).add($($.drop.dPP.dropContent))).filter(':first').css('height', '');
                        if (el.data('jsp') != undefined)
                            el.data('jsp').destroy()

                        if ($.existsN(el)) {
                            var docH = $(document).height(),
                            forCenter = drop.data('drp').forCenter,
                            refer = drop.data('drp').elrun;
                            if (!dropV) {
                                drop.show();
                                if (forCenter)
                                    forCenter.show();
                            }

                            var api = false,
                            elC = el.css('overflow', '');
                            if (drop.data('drp').scrollContent){
                                try {
                                    el.jScrollPane(scrollPane);
                                    elC = el.find('.jspPane');
                                    api = el.data('jsp');
                                } catch (err) {
                                    elC.css('overflow', 'auto');
                                }
                            }
                            var elCH = elC.outerHeight(),
                            footerHeader = drop.find($(drop.data('drp').dropHeader).add($($.drop.dPP.dropHeader))).outerHeight(true) + drop.find($(drop.data('drp').dropFooter).add($($.drop.dPP.dropFooter))).outerHeight(true);
                            if (drop.data('drp').place == 'noinherit') {
                                var mayHeight = 0,
                                placement = drop.data('drp').placement;
                                if (typeof placement == 'object') {
                                    if (placement.top != undefined)
                                        mayHeight = docH - placement.top - footerHeader - (drop.outerHeight() - drop.height());
                                    if (placement.bottom != undefined)
                                        mayHeight = placement.bottom - footerHeader;
                                }
                                else {
                                    if (placement.search(/top/) >= 0) {
                                        mayHeight = docH - refer.offset().top - footerHeader - refer.outerHeight() - (drop.outerHeight() - drop.height());
                                    }
                                    if (placement.search(/bottom/) >= 0) {
                                        mayHeight = refer.offset().top - footerHeader - refer.outerHeight();
                                    }
                                }
                                if (mayHeight > elCH)
                                    el.css('height', elCH);
                                else
                                    el.css('height', mayHeight);
                                if (el.outerHeight() === elCH && api)
                                    api.destroy();
                            }
                            else {
                                if (elCH + footerHeader > wndH)
                                    el.css('height', wndH - footerHeader - 40);
                                else
                                    el.css('height', elCH);
                            }
                            if (api)
                                api.reinitialise();
                            if (drop.data('drp').place === 'center')
                                drop.drop('center');
                            if (!dropV) {
                                drop.hide();
                                if (forCenter)
                                    forCenter.hide();
                            }
                        }
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
                    drop.css({
                        'width': '',
                        'height': ''
                    });
                    drop.find('.placePaste img').css('max-height', 'none');
                    if (drop.data('drp').place === 'center') {
                        var wndW = wnd.width(),
                        wndH = wnd.height();
                        var dropV = drop.is(':visible'),
                        w = dropV ? drop.width() : drop.actual('width'),
                        h = dropV ? drop.height() : drop.actual('height');
                        if (w > wndW)
                            drop.css('width', wndW - 40);
                        if (h > wndH)
                            drop.css('height', wndH - 40);
                        drop.find('.placePaste img').css('max-height', '100%');
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
                        body.prepend('<div class="scrollEmulation" style="position: absolute;right: 0;top: ' + wnd.scrollTop() + 'px;height: 100%;width: '+$.drop.widthScroll+'px;overflow-y: scroll;z-index:10000;"></div>');
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
                    ;
                    wnd.scrollTop($.drop.dP.wST);
                    $('.scrollEmulation').remove();
                    if (isTouch)
                        $('.for-center').off('touchmove.' + $.drop.nS);
                    $(document).trigger({
                        'type': 'scrollEmulateRemove.' + $.drop.nS
                    });
                }, dur);
            }
        }
    }
    var newMethods = {};
    for (var i = 0, length = arguments.length; i < length; i++) {
        if (arguments[i] in methods) {
            newMethods[arguments[i]] = methods[arguments[i]];
        }
    }
    $.drop.setMethods(newMethods);
}