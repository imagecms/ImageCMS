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
                        var condScroll = body.hasClass('isScroll');
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
                            });
                        });
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
                    if (typeof placement === 'object') {
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
            if (isTouch)
                return false;
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this),
                        drp = $.extend({}, drop.data('drp'));

                if (drp.limitContentSize) {
                    var dropV = drop.is(':visible'),
                            forCenter = drp.forCenter;
                    if (!dropV) {
                        drop.show();
                        if (forCenter)
                            forCenter.show();
                    }

                    if (drp.dropContent) {
                        var el = drop.find($(drp.dropContent)).filter(':visible');

                        if (el.data('jsp'))
                            el.data('jsp').destroy();

                        el = drop.find($(drp.dropContent)).filter(':visible').css({'height': ''});

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

                            var footerHeader = drop.find($(drp.dropHeader)).outerHeight() + drop.find($(drp.dropFooter)).outerHeight();

                            if (drp.place === 'noinherit') {
                                var mayHeight = 0,
                                        placement = drp.placement;
                                if (typeof placement === 'object') {
                                    if (placement.top !== undefined)
                                        mayHeight = wnd.height() - placement.top - footerHeader - (dropH - dropHm);
                                    if (placement.bottom !== undefined)
                                        mayHeight = placement.bottom - footerHeader - (dropH - dropHm);
                                }
                                else {
                                    if (placement.search(/top/) >= 0) {
                                        mayHeight = wnd.height() - refer.offset().top - footerHeader - refer.outerHeight() - (dropH - dropHm);
                                    }
                                    if (placement.search(/bottom/) >= 0) {
                                        mayHeight = refer.offset().top - footerHeader - (dropH - dropHm);
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
            if (isTouch)
                return false;
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
                                wndH = wnd.height();

                        var dropV = drop.is(':visible'),
                                w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                                h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                                ws = dropV ? drop.width() : drop.actual('width'),
                                hs = dropV ? drop.height() : drop.actual('height');

                        if (w + $.drop.widthScroll > wndW)
                            drop.css('width', wndW - w + ws - $.drop.widthScroll);
                        if (h > wndH)
                            drop.css('height', wndH - h + hs);
                    }
                }
            });
            return drop;
        },
        galleries: function($this, set, methods) {
            var elSet = $this.data(),
                    relO = $this.get(0).rel;

            if (relO !== '' && relO !== undefined) {
                var source = methods._checkProp(elSet, set, 'source') || $this.attr('href'),
                        next = methods._checkProp(elSet, set, 'next'),
                        prev = methods._checkProp(elSet, set, 'prev'),
                        cycle = methods._checkProp(elSet, set, 'cycle'),
                        rel = relO.replace(/[^a-zA-Z0-9]+/ig, ''),
                        relA = $.drop.drp.galleries[rel],
                        drop = $('[data-elrun][data-rel="' + rel + '"]');

                if (relA !== undefined) {
                    var relL = relA.length,
                            relP = $.inArray(source ? source : drop.find($(methods._checkProp(elSet, set, 'placePaste'))).find('img').attr('src'), relA);
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
                        methods[place](drop, true);
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
            if (pmt[0] === 'center' || pmt[1] === 'center') {
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
                    queue: false,
                    duration: set.durationOff
                });
            if (pmt[0] === 'inherit')
                drop.stop()[method]({
                    'left': $this.offset().left,
                    'top': $this.offset().top
                }, {
                    queue: false,
                    duration: set.durationOff
                });
        },
        confirmPrompt: function(source, methods, elSet, opt, hashChange, _confirmF, e) {
            var prompt = methods._checkProp(elSet, opt, 'prompt'),
                    confirm = methods._checkProp(elSet, opt, 'confirm');
            if (confirm) {
                var confirmBtnDrop = methods._checkProp(elSet, opt, 'confirmBtnDrop'),
                        confirmPattern = methods._checkProp(elSet, opt, 'patternConfirm');

                if (!$.exists('[data-drop="' + confirmBtnDrop + '"]'))
                    var confirmBtn = $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', confirmBtnDrop);
                else
                    confirmBtn = $('[data-drop="' + confirmBtnDrop + '"]');

                confirmBtn.data({
                    'drop': confirmBtnDrop,
                    'confirm': true
                });
                if (!$.exists(confirmBtnDrop))
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, confirmBtn.data()), confirmPattern);
                else
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, confirmBtn.data()), $(confirmBtnDrop));
                setTimeout(function() {
                    methods._show(confirmBtn, e, opt, false, hashChange);
                });
                $(methods._checkProp(elSet, opt, 'confirmActionBtn')).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    if (elSet.after)
                        $(confirmBtnDrop).data({
                            'drp': $.extend($(confirmBtnDrop).data('drp'), {
                                'elClosed': elSet.after
                            })
                        });
                    methods.close($(confirmBtnDrop));
                    if (source)
                        _confirmF();
                });
            }
            if (prompt) {
                var promptPattern = methods._checkProp(elSet, opt, 'patternPrompt'),
                        promptBtnDrop = methods._checkProp(elSet, opt, 'promptBtnDrop');

                if (!$.exists('[data-drop="' + promptBtnDrop + '"]'))
                    var promptBtn = $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', promptBtnDrop);
                else
                    promptBtn = $('[data-drop="' + promptBtnDrop + '"]');

                promptBtn.data({
                    'drop': promptBtnDrop,
                    'prompt': true,
                    'promptInputValue': methods._checkProp(elSet, opt, 'promptInputValue')
                });

                if (!$.exists(promptBtnDrop))
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, promptBtn.data()), promptPattern);
                else
                    methods._pasteDrop($.extend({}, $.drop.dP, opt, promptBtn.data()), $(promptBtnDrop));
                setTimeout(function() {
                    methods._show(promptBtn, e, opt, false, hashChange);
                }, 0);
                $(methods._checkProp(elSet, opt, 'promptActionBtn')).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                    e.stopPropagation();
                    if (elSet.after)
                        $(promptBtnDrop).data({
                            'drp': $.extend($(promptBtnDrop).data('drp'), {
                                'elClosed': elSet.after
                            })
                        });
                    methods.close($(promptBtnDrop));
                    function getUrlVars(url) {
                        var hash, myJson = {}, hashes = url.slice(url.indexOf('?') + 1).split('&');
                        for (var i = 0; i < hashes.length; i++) {
                            hash = hashes[i].split('=');
                            myJson[hash[0]] = hash[1];
                        }
                        return myJson;
                    }

                    elSet.dataPrompt = getUrlVars($(this).closest('form').serialize());
                    if (source)
                        _confirmF();
                });
            }
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