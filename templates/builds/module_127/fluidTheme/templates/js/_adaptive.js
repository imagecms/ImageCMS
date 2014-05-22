(function(wnd, body, isTouch) {
    $.exists = function(selector) {
        return $(selector).length > 0 && $(selector) instanceof jQuery;
    };
    $.existsN = function(nabir) {
        return nabir.length > 0 && nabir instanceof jQuery;
    };
    var constructAdaptive = function() {
    };
    constructAdaptive.prototype = {
        moveContent: function(el) {
            this.mediaQuires = {}
            , this.init = function() {
                var _self = this;
                this.mediaQuires = {};
                el.each(function(ind, val) {
                    var $this = $(this),
                            data = $this.data();
                    _self.mediaQuires[ind] = {};
                    _self.mediaQuires[ind]['mqContent'] = $this.html();
                    _self.mediaQuires[ind]['mqMainTarget'] = $this;
                    for (var i in data) {
                        if (/mq/.test(i)) {
                            $.map(data[i].toString().split('|'), function(val, j) {
                                if (!_self.mediaQuires[ind][i])
                                    _self.mediaQuires[ind][i] = [];
                                if (!/mqContent/.test(i))
                                    _self.mediaQuires[ind][i].push(val);
                            });
                        }
                    }
                });
                return _self;
            }
            , this.update = function(wWidth) {
                var _self = this;
                for (var i in _self.mediaQuires) {
                    $.map(_self.mediaQuires[i]['mqTarget'], function(val, ind) {
                        $(val).add(_self.mediaQuires[i].mqMainTarget).empty();
                        if (wWidth < +eval(_self.mediaQuires[i].mqMax[ind]) && wWidth >= +eval(_self.mediaQuires[i].mqMin[ind]))
                            $(val).html(_self.mediaQuires[i].mqContent);
                        else
                            _self.mediaQuires[i].mqMainTarget.html(_self.mediaQuires[i].mqContent);
                    });
                }
                return this;
            };
        },
        elemPoll: function(el) {
            this.mediaQuires = {}
            , this.isNumeric = function(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
            , this.init = function() {
                var _self = this;
                el.each(function(ind, val) {
                    var $this = $(this),
                            data = $this.data();
                    if (!_self.mediaQuires[ind])
                        _self.mediaQuires[ind] = {};
                    if (!_self.mediaQuires[ind]['target'])
                        _self.mediaQuires[ind]['target'] = $this;
                    for (var i in data) {
                        if (/mq/.test(i)) {
                            $.map(data[i].toString().split('|'), function(val, j) {
                                if (!_self.mediaQuires[ind][i])
                                    _self.mediaQuires[ind][i] = [];
                                _self.mediaQuires[ind][i].push(val);
                            });
                        }
                    }
                });
                return this;
            }
            , this.update = function() {
                var _self = this;
                for (var i in _self.mediaQuires) {
                    $.map(_self.mediaQuires[i]['mqElemPool'], function(val, ind) {
                        var pixel = parseFloat($(_self.mediaQuires[i].mqElemPool[ind]).css(_self.mediaQuires[i].mqPropPool[ind])),
                                addPixel = parseFloat(_self.mediaQuires[i].mqPropAdd ? eval(_self.mediaQuires[i].mqPropAdd[ind]) : 0);

                        $(_self.mediaQuires[i].target).css(
                                _self.mediaQuires[i].mqProp[ind],
                                +(
                                        (_self.mediaQuires[i].mqPropPref ? _self.mediaQuires[i].mqPropPref[ind] : '')
                                        + ((_self.isNumeric(pixel) ? pixel : 0)
                                                + (_self.isNumeric(addPixel) ? addPixel : 0))
                                        )
                                );
                    });
                }
                return this;
            };
        },
        cloudZoom: function(wWidth, width) {
            if ($.exists('.cloud-zoom')) {
                $('.mousetrap, .cloud-zoom-lens').remove();
                if (wWidth > width)
                    $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
            }
            return this;
        },
        getWindowWidth: function() {
            return wnd.width() + (wnd.height() < $(document).height() || body.css('overflow') === 'scroll' ? this.widthScroll : 0);
        },
        showHidePart: function(el, btnPlace, callback, time) {
            if (!time)
                time = 300;
            if (!btnPlace)
                btnPlace = 'next';
            if (btnPlace instanceof jQuery)
                btnPlace.hide();
            el.each(function() {
                var $this = $(this),
                        $thisH = isNaN(parseInt($this.css('max-height'))) ? parseInt($this.css('height')) : parseInt($this.css('max-height')),
                        sumHeight = 0;
                $this.addClass('showHidePart');
                var attrS = $this.attr('style');
                sumHeight = $this.removeAttr('style').css('max-height', 'none').outerHeight(true);
                $this.css('max-height', '').attr('style', attrS);
                var btn = typeof btnPlace === 'string' ? $this[btnPlace]() : btnPlace;
                btn.hide();
                if (sumHeight > $thisH) {
                    $this.css({
                        'max-height': 'none',
                        'height': $thisH
                    });
                    var textEl = btn.find(genObj.textEl);
                    btn.addClass('hidePart').show();
                    if (!btn.is('[data-trigger]')) {
                        textEl.html(textEl.data('show'));
                        btn.removeData('show').off('click.showhidepart').on('click.showhidepart', function() {
                            var $thisB = $(this);
                            if ($thisB.data("show") === "no" || !$thisB.data("show")) {
                                $thisB.addClass('showPart').removeClass('hidePart');
                                var textEl = $thisB.find(genObj.textEl);
                                $this.animate({
                                    'height': sumHeight
                                }, time, function() {
                                    $(this).removeClass('cut-height').addClass('full-height');
                                    textEl.hide().html(textEl.data('hide')).show(time);
                                    if (callback)
                                        callback($(this), $thisB, 'show');
                                });
                                $thisB.data('show', "yes");
                            }
                            else {
                                var $thisB = $(this).removeClass('showPart').addClass('hidePart'),
                                        textEl = $thisB.find(genObj.textEl);
                                $this.stop().animate({
                                    'height': $thisH
                                }, time, function() {
                                    $(this).css('max-height', 'none').removeClass('full-height').addClass('cut-height');
                                    textEl.hide().html(textEl.data('show')).show(time);
                                    if (callback)
                                        callback($(this), $thisB, 'hide');
                                });
                                $thisB.data('show', "no");
                            }
                        });
                    }
                }
                else
                    btn.removeClass('hidePart showPart');
            });
        }
    };
    var Adaptive = new constructAdaptive();
    var el = $('<div/>').appendTo(body).css({
        'height': 100,
        'width': 100,
        'overflow': 'scroll'
    }).wrap($('<div style="width:0;height:0;overflow:hidden;"></div>'));
    constructAdaptive.prototype.widthScroll = el.width() - el.get(0).clientWidth;
    el.parent().remove();

    constructAdaptive.prototype.resize = function(wWidth) {
        /*showHidePart*/
        this.showHidePart($('.accessories-height').removeAttr('style'));
        this.showHidePart($('.frame-frame-list-comments').removeAttr('style'), $('.showComment'));
        this.showHidePart($('.frame-comments-main-form').removeAttr('style'), $('.showCommentForm'), function(drop, el, show) {
            if (show === 'show')
                $('html, body').animate({'scrollTop': drop.offset().top});
        });
        this.showHidePart($('.filter-height').removeAttr('style'), 'prev');
        this.showHidePart($('.info-menu-page-height').removeAttr('style'), 'prev');
        if (wWidth < 768 && $('#items-catalog-main').not('.table')) {
            $('#items-catalog-main').removeClass('list tablemini').addClass('table');
            $('.tabs-list-table > li').removeClass('active').filter(':last').addClass('active');
        }
        /*/showHidePart*/

        /*tooltip*/
        if (tooltipP)
            clearTimeout(tooltipP);
        var tooltipP = setTimeout(function() {
            if (wWidth >= 1331)
                $('.icon_info_t').data('placement', 'left');
            if (wWidth < 1331)
                $('.icon_info_t').data('placement', 'right');
            if (wWidth < 480)
                $('.icon_info_t').data('placement', 'top');
        }, 200);
        /*/tooltip*/

        /*photoTovar*/
        if (wWidth <= 959 && $.exists('.item-product .items-thumbs.items li'))
            $('.photo-main-carousel .arrow').show();
        else
            $('.photo-main-carousel .arrow').hide();
        /*/photoTovar*/

        /*main-menu*/
        var menuMain = $('.menu-main');
        if (wWidth < 768) {
            menuMain.removeClass('menu-col-category');
            menuMain.addClass('menu-row-category');
            optionsMenu.evLF = 'toggle';
            optionsMenu.evLS = 'toggle';
            optionsMenu.sub2Frame = '.frame-l2';
        }
        else if (!isTouch) {
            menuMain.removeClass('menu-row-category');
            menuMain.addClass('menu-col-category');
            optionsMenu.evLF = 'hover';
            optionsMenu.evLS = 'hover';
            optionsMenu.sub2Frame = null;
        }
        if (menuTimeout)
            clearTimeout(menuTimeout);
        var menuTimeout = setTimeout(function() {
            menuMain.menuImageCms('refresh', optionsMenu);
        }, 350);
        /*main-menu*/

        return this;
    };
    $(document).ready(function() {
        var moveContent = new Adaptive.moveContent($('[data-mq-target]')),
                elemPoll = new Adaptive.elemPoll($('[data-mq-elem-pool]')),
                wWidth = Adaptive.getWindowWidth();
        elemPoll.init();
        $(document).on('columnRenderComplete', function() {
            moveContent.init();
            moveContent.update(wWidth);
            $('.menu-main').menuImageCms('refresh');
        });
        $(document).on('scriptDefer', function() {
            setTimeout(function() {
                Adaptive.resize(wWidth);
                elemPoll.update(wWidth);
                Adaptive.cloudZoom(wWidth, 960);
            }, 200);
        });

        /*photoTovar*/
        $('.photo-main-carousel .arrow').click(function() {
            var $this = $(this),
                    active = $('.item-product .items-thumbs.items li.active');
            if ($this.is('.prev')) {
                if ($.existsN(active.prev()))
                    active.prev().children().click();
                else
                    $('.item-product .items-thumbs.items li:last').children().click();
            }
            else {
                if ($.existsN(active.next()))
                    active.next().children().click();
                else
                    $('.item-product .items-thumbs.items li:first').children().click();
            }
        });
        /*/photoTovar*/

        wnd.resize(function() {
            wWidth = Adaptive.getWindowWidth();
            moveContent.update(wWidth);
            Adaptive.cloudZoom(wWidth, 768);
            if (elemPollP)
                clearTimeout(elemPollP);
            var elemPollP = setTimeout(function() {
                elemPoll.update(wWidth);
            }, 350);
            Adaptive.resize(wWidth);
        });
    });
    wnd.load(function() {
        var isFixedSupported = (function() {
            var isSupported = null;
            if (document.createElement) {
                var el = document.createElement("div");
                if (el && el.style) {
                    el.style.position = "fixed";
                    el.style.top = "10px";
                    var root = document.body;
                    if (root && root.appendChild && root.removeChild) {
                        root.appendChild(el);
                        isSupported = (el.offsetTop === 10);
                        root.removeChild(el);
                    }
                }
            }
            return isSupported;
        })();
        if (!isFixedSupported) {
            body.addClass('no-fixed-supported');
            var fixedBottom = $('.frame-user-toolbar'),
                    bottomBarHeight = fixedBottom.height(),
                    windowHeight = window.innerHeight;
            fixedBottom.css({
                'position': 'absolute',
                'bottom': 'auto'
            });
            window.ontouchmove = function(e) {
                if (e.target !== fixedBottom.get(0)) {
                    fixedBottom.hide();
                }
            };
            window.resize = function() {
                bottomBarHeight = fixedBottom.height();
                windowHeight = wnd.height();
            };
            window.onscroll = function() {
                var scrollTop = wnd.scrollTop();
                fixedBottom.css('top', scrollTop + windowHeight - bottomBarHeight).show();
            };
        }
        window.scrollBy(0, 1);
    });
})($(window), $('body'), 'ontouchstart' in document.documentElement);