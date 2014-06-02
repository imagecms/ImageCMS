var isTouch = 'ontouchstart' in document.documentElement,
        activeClass = 'active',
        clonedC = 'cloned';
var wnd = $(window),
        body = $('body');
var returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.existsN = function(nabir) {
    return (nabir.length > 0);
}
$.fn.setCursorPosition = function(pos) {
    if (!isTouch)
        this.each(function() {
            this.select();
            try {
                this.setSelectionRange(pos, pos);
            } catch (err) {
            }

        });
    return this;
};
var ie = $.browser.msie,
        ieV = $.browser.version,
        ltie7 = ie && (ieV <= 7),
        ltie8 = ie && (ieV <= 8);

function ieInput(els) {
    els = $('input[type="text"], textarea, input[type="password"]');

    els.not(':hidden').not('.visited').not('.notvis').each(function() {
        var $this = $(this);
        $this.css('width', '100%').css({
            'width': function() {
                return 2 * $this.width() - $this.outerWidth();
            },
            'height': function() {
                return 2 * $this.height() - $this.outerHeight();
            }
        }).addClass('visited');
    });
}
function setcookie(name, value, expires, path, domain, secure) {
    var today = new Date();
    today.setTime(today.getTime());

    if (expires)
    {
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date(today.getTime() + (expires));

    document.cookie = name + "=" + encodeURIComponent(value) +
            ((expires) ? ";expires=" + expires_date.toGMTString() : "") +
            ((path) ? ";path=" + path : "") +
            ((domain) ? ";domain=" + domain : "") +
            ((secure) ? ";secure" : "");
}

(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                item: this.find('li'),
                duration: 300,
                drop: 'li > ul'
            }, options);

            var sH = 0;

            var menu = $(this),
                    menuW = menu.width(),
                    menuItem = settings.item,
                    drop = settings.drop;
            item_menu_l = menuItem.length,
                    dropW = settings.dropWidth,
                    duration = time_dur_m = settings.duration;

            menuItem.each(function(index) {
                var $this = $(this),
                        $thisW = $this.width(),
                        $thisL = $this.position().left,
                        drop = $this.find(settings.drop),
                        $thisH = $this.height();
                if ($thisH > sH)
                    sH = $thisH;

                if (menuW - $thisL < dropW) {
                    drop.css('right', menuW - $thisW - $thisL).addClass('right-drop');
                }
                else {
                    drop.css('left', $thisL);
                }
            }).css('height', sH);

            menuItem.find('.helper:first').css('height', sH)

            $('.not-js').removeClass('not-js');

            menuItem.hover(
                    function() {
                        var $this = $(this),
                                $thisDrop = $this.find(settings.drop);
                        if ($this.index() == 0)
                            $this.addClass('first_h');
                        if ($this.index() == item_menu_l - 1)
                            $this.addClass('last_h');
                        hover_t_o = setTimeout(function() {
                            $thisDrop.fadeIn(200);
                            if ($thisDrop.length != 0)
                                menu.addClass('hover');
                        }, time_dur_m);
                    }, function() {
                var $this = $(this),
                        $thisDrop = $this.find(settings.drop);
                $(settings.drop).stop().fadeOut(200);
                $('.first_h, .last_h').removeAttr('class');
                clearTimeout(hover_t_o);
                if ($thisDrop.length != 0)
                    menu.removeClass('hover');
            });
            menu.hover(
                    function() {
                        return time_dur_m = 0;
                    },
                    function() {
                        return time_dur_m = duration;
                    });
        }
    };
    $.fn.menuCorporate = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.tooltip');
        }
    };
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var optionsDrop = $.extend({
                exit: '[data-closed = "closed-js"]',
                effon: 'show',
                effoff: 'hide',
                duration: 200,
                place: 'center',
                dataSource: $('[data-drop]'),
                dropContent: null,
                placement: 'noinherit',
                modal: false,
                confirm: false,
                always: false,
                animate: false,
                moreoneNC: true,
                timeclosemodal: false,
                before: function() {
                },
                after: function() {
                },
                close: function() {
                },
                closed: function() {
                }
            }, options);
            var settings = optionsDrop,
                    exit = $(settings.exit),
                    modal = settings.modal,
                    confirm = settings.confirm,
                    always = settings.always,
                    arrDrop = [];
            $(this).add($('[data-drop]')).unbind('click.drop').on('click.drop', function(e) {
                methods.closeModal();
                function confirmF() {
                    if ($.inArray(elSet.source, arrDrop) != 0 || newModal || newAlways) {
                        arrDrop.push(elSet.source);
                        if (!newModal)
                            elSetSource.remove();
                        $.ajax({
                            type: "post",
                            data: elSet.data,
                            url: elSet.source,
                            dataType: elSet.type ? elSet.type : 'html',
                            success: function(data) {
                                if (elSet.type != 'html' && elSet.type != undefined && newModal) {
                                    if (elSet.callback != undefined)
                                        eval(elSet.callback)($this, data, elSetSource);
                                    $(document).trigger({type: 'drop.successJson', el: elSetSource, datas: data})
                                }
                                else {
                                    $(document).trigger({type: 'drop.successHtml', el: elSetSource, datas: data})
                                    if (elSet.callback != undefined)
                                        eval(elSet.callback)($this, data, elSetSource);
                                    body.append(data);
                                }
                                elSetSource = $(elSet.drop);
                                methods.init.call(elSetSource.find('[data-drop]'), $.extend({}, optionsDrop));
                                methods.showDrop($this, e, optionsDrop, true);
                            }})
                    }
                }
                var $this = $(this);
                if (!$this.is('[disabled]')) {
                    $(document).trigger({'type': 'drop.click', 'el': $this})
                    e.stopPropagation();
                    e.preventDefault();
                    var elSet = $this.data();
                    var elSetSource = $(elSet.drop),
                            newModal = elSet.modal || modal,
                            newConfirm = elSet.confirm || confirm,
                            newAlways = elSet.always || always;
                    if ($.existsN(elSetSource) && !newModal && !newAlways) {
                        if (!$.existsN(elSetSource.parent('body')) && elSet.place != 'inherit')
                            body.append(elSetSource)
                        methods.showDrop($this, e, optionsDrop, false);
                    }
                    else if ((elSet.source || newAlways)) {
                        if (!newConfirm)
                            confirmF();
                        else {
                            methods.showDrop($('[data-drop="#confirm"]').data('callback', elSet.callback), e, settings, false);
                            $('[data-button-confirm]').focus().on('click.drop', function() {
                                methods.closeDrop($('#confirm'));
                                confirmF();
                            })
                        }

                    }
                    return false;
                }
            })
            exit.live('click', function() {
                methods.closeDrop($(this).closest('[data-elrun]'));
            })
        },
        closeModal: function() {
            $('[data-elrun]:visible').each(function() {
                if ($(this).data('modal'))
                    methods.closeDrop($(this))
            })
        },
        showDrop: function($this, e, settings, isajax) {
            if (!e)
                var e = window.event;
            var settings = !settings ? optionsDrop : settings,
                    isajax = !isajax ? false : true,
                    elSet = $this.data(),
                    place = elSet.place || settings.place,
                    placement = elSet.placement || settings.placement,
                    $thisEOff = elSet.effectOff || settings.effoff,
                    $thisD = elSet.duration != undefined ? elSet.duration.toString() : elSet.duration || settings.duration,
                    $thisA = elSet.animate != undefined ? elSet.animate : settings.animate,
                    $thisEOn = elSet.effectOn || settings.effon,
                    overlayColor = elSet.overlaycolor || settings.overlayColor,
                    overlayOpacity = elSet.overlayopacity != undefined ? elSet.overlayopacity.toString() : elSet.overlayopacity || settings.overlayOpacity,
                    modal = elSet.modal || settings.modal,
                    timeclosemodal = elSet.timeclosemodal || settings.timeclosemodal,
                    confirm = elSet.confirm || settings.confirm,
                    moreoneNC = elSet.moreoneNC || settings.moreoneNC,
                    dropContent = elSet.dropContent || settings.dropContent,
                    before = elSet.before || settings.before,
                    after = elSet.after || settings.after,
                    close = elSet.close || settings.close,
                    closed = elSet.closed || settings.closed,
                    elSetSource = $(elSet.drop),
                    $thisSource = elSet.drop;
            $this.parent().addClass(activeClass);
            $($thisSource).data({
                'effect-off': $thisEOff,
                'elrun': $thisSource,
                'place': place,
                'placement': placement,
                'duration': $thisD,
                'dropContent': dropContent,
                'animate': $thisA,
                'close': close,
                'closed': closed,
                'overlayOpacity': overlayOpacity,
                'overlayColor': overlayColor,
                'modal': modal,
                'confirm': confirm,
                'timeclosemodal': timeclosemodal,
                'moreoneNC': moreoneNC
            }).attr('data-elrun', $thisSource);
            var condOverlay = overlayColor != undefined && overlayOpacity != undefined && overlayOpacity != '0';
            if (condOverlay) {
                if (!$.exists('.overlayDrop')) {
                    body.append('<div class="overlayDrop" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;z-index: 1101;"></div>')
                }
                optionsDrop.dropOver = $('.overlayDrop').css({
                    'background-color': overlayColor,
                    'opacity': overlayOpacity
                });
            }
            else {
                optionsDrop.dropOver == undefined;
            }
            if (elSetSource.is('.' + activeClass) && e.button != undefined) {
                methods.closeDrop(elSetSource);
            }
            else {
                before($this, elSetSource, isajax);
                if (!moreoneNC || elSetSource.data('modal')) {
                    var objJ = $([]);
                    $('[data-elrun]:visible').each(function() {
                        if (($(this).data('overlayOpacity') != '0' && $(this).data('moreoneNC') != 'true'))
                            objJ = objJ.add($(this));
                    })
                    methods.closeDrop(objJ);
                }

                if (e.button == undefined && place != "center")
                    wnd.scrollTop($this.offset().top);
                var wndW = wnd.width();
                if (elSetSource.actual('width') > wndW)
                    elSetSource.css('width', wndW - 40);
                else
                    elSetSource.removeAttr('style');
                if (place == 'noinherit')
                    methods.positionDrop($this, placement, place);
                var dC = elSetSource.find(elSetSource.data('dropContent')).first();
                if (place == 'center')
                    methods.dropCenter(elSetSource);

                var dropTimeout = '';
                wnd.on('resize.drop', function() {
                    clearTimeout(dropTimeout);
                    dropTimeout = setTimeout(function() {
                        methods.dropCenter(elSetSource)
                    }, 300)
                });

                if (condOverlay) {
                    optionsDrop.dropOver.show().unbind('click.drop').on('click.drop', function(e) {
                        e.stopPropagation();
                        methods.closeDrop(false);
                    })
                }
                elSetSource.addClass(place);
                elSetSource[$thisEOn]($thisD, function(e) {
                    var $this = $(this);
                    $(document).trigger({type: 'drop.contentHeight', el: dC, drop: $this});
                    $this.addClass(activeClass);
                    if (!confirm && modal && timeclosemodal)
                        setTimeout(function() {
                            methods.closeDrop($this)
                        }, timeclosemodal)
                    if (place == 'center' && !(elSet.modal || modal)) {
                        if ($(document).height() - wnd.height() > 0) {
                            optionsDrop.wST = wnd.scrollTop();
                            methods.scrollEmulate();
                        }
                    }
                    after($this, elSetSource, isajax);
                });
                $(document).trigger({'type': 'drop.show', el: elSetSource})
            }
            body.add($('iframe').contents().find('body')).unbind('click.drop').unbind('keydown.drop').on('click.drop', function(e) {
                if (((e.which || e.button == 0) && e.relatedTarget == null) && !$.existsN($(e.target).closest('[data-elrun]'))) {
                    methods.closeDrop(false);
                }
                else
                    return true;
            }).on('keydown.drop', function(e) {
                if (!e)
                    var e = window.event;
                key = e.keyCode;
                if (key == 27) {
                    methods.closeDrop(false);
                }
            });
        },
        closeDrop: function(sel) {
            $('[data-button-confirm]').unbind('click.drop');
            var drop = sel == undefined || !sel ? $('[data-elrun].' + activeClass) : sel;
            if ($.existsN(drop)) {
                drop.each(function() {
                    var drop = $(this),
                            overlayColor = drop.data('overlayColor'),
                            overlayOpacity = drop.data('overlayOpacity') != undefined ? drop.data('overlayOpacity').toString() : drop.data('overlayOpacity'),
                            condOverlay = overlayColor != undefined && overlayOpacity != undefined && overlayOpacity != '0';
                    if (drop.data('modal') || sel || condOverlay) {
                        $(document).trigger({'type': 'drop.beforeClose', 'el': drop})
                        drop.removeClass(activeClass + ' ' + drop.data('place')).each(function() {
                            var $this = $(this),
                                    $thisEOff = $this.data('effect-off'),
                                    $thisD = $this.data('duration');
                            $thisB = $('.' + activeClass + ' > [data-drop = "' + $this.attr('data-elrun') + '"]');
                            if ($this.data('close') != undefined)
                                $this.data('close')($thisB, $(this));
                            $thisB.parent().removeClass(activeClass);
                            var $thisHref = $thisB.attr('href');
                            if ($thisHref != undefined) {
                                var $thisHrefL = $thisHref.length,
                                        wLH = location.hash,
                                        wLHL = wLH.length;
                                try {
                                    var indH = wLH.match($thisHref + '(?![a-z])').index;
                                    location.hash = wLH.substring(0, indH) + wLH.substring(indH + $thisHrefL, wLHL)
                                } catch (err) {
                                }
                            }
                            optionsDrop.dropOver = $('.overlayDrop');
                            if (optionsDrop.dropOver.is(':visible'))
                                methods.scrollEmulateRemove();
                            console.log($this.data())
                            $this[$thisEOff]($thisD, function() {
                                $(this).removeAttr('style');
                                if ($this.data('closed') != undefined)
                                    $this.data('closed')($thisB, $(this));
                                $(document).trigger({'type': 'drop.hide', el: $this})
                            });
                        });
                    }
                })
            }
            wnd.unbind('resize.drop');
        },
        dropCenter: function(elSetSource) {
            if (elSetSource.data('place') == 'center') {
                var method = elSetSource.data('animate') ? 'animate' : 'css';
                elSetSource.css({'bottom': 'auto', 'right': 'auto'})[method]({
                    'top': (body.height() - elSetSource.actual('outerHeight')) / 2 + wnd.scrollTop(),
                    'left': (body.width() - elSetSource.actual('outerWidth')) / 2 + wnd.scrollLeft()
                }, {
                    queue: false
                });
            }
            return elSetSource;
        },
        positionDrop: function(el, placement, place) {
            var $this = el;
            if ($this == undefined)
                $this = $(this);
            if (placement == undefined)
                placement = $this.data('placement');
            if (place == undefined)
                place = $this.data('place');
            var elSetSource = $($this.data().drop),
                    $thisP = place,
                    dataSourceH = 0,
                    dataSourceW = 0,
                    $thisW = $this.width(),
                    $thisH = $this.height();
            if ($thisP == 'noinherit') {
                var $thisPMT = placement.toLowerCase().split(' ');
                if ($thisPMT[0] == 'bottom' || $thisPMT[1] == 'bottom')
                    dataSourceH = elSetSource.actual('height');
                if ($thisPMT[0] == 'top' || $thisPMT[1] == 'top')
                    dataSourceH = $thisH;
                if ($thisPMT[0] == 'left' || $thisPMT[1] == 'left')
                    dataSourceW = 0;
                if ($thisPMT[0] == 'right' || $thisPMT[1] == 'right')
                    dataSourceW = -elSetSource.actual('width') + $thisW;
                $thisT = $this.offset().top + dataSourceH;
                $thisL = $this.offset().left + dataSourceW;
                if ($thisL < 0)
                    $thisL = 0;
                elSetSource.css({
                    'bottom': 'auto',
                    'top': $thisT,
                    'left': $thisL
                });
                if ($thisPMT[0] == 'bottom' || $thisPMT[1] == 'bottom')
                    elSetSource.css({
                        'top': 'auto',
                        'bottom': body.height() - $thisT + dataSourceH + $thisH
                    });
            }
        },
        scrollEmulate: function() {
            var conDropOver = optionsDrop.dropOver != undefined;
            body.addClass('isScroll');
            body.prepend('<div class="scrollEmulation" style="position: absolute;right: 0;top: ' + wnd.scrollTop() + 'px;height: 100%;width: 17px;overflow-y: scroll;z-index:10000;"></div>');
            if (isTouch && conDropOver)
                optionsDrop.dropOver.on('touchmove.drop', function(e) {
                    return false;
                });
        },
        scrollEmulateRemove: function() {
            var conDropOver = optionsDrop.dropOver != undefined;
            body.removeClass('isScroll');
            wnd.scrollTop(optionsDrop.wST);
            if (conDropOver)
                optionsDrop.dropOver.hide();
            $('.scrollEmulation').remove();
            if (isTouch && conDropOver)
                optionsDrop.dropOver.unbind('touchmove.drop');
        }
    };
    $.fn.drop = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.drop');
        }
    };
    $.drop = function(m) {
        return methods[m];
    };
})(jQuery);

(function($) {
    $.fn.actual = function() {
        if (arguments.length && typeof arguments[0] == 'string') {
            var dim = arguments[0],
                    clone = $(this).clone().addClass(clonedC);
            if (arguments[1] == undefined)
                clone.css({
                    position: 'absolute',
                    top: '-9999px'
                }).show().appendTo(body).find('*:not([style*="display:none"])').show();
            var dimS = clone[dim]();
            clone.remove();
            return dimS;
        }
        return undefined;
    };
})(jQuery)
var ImageCMSApi = {
    defSet: function() {
        return imageCmsApiDefaults;
    },
    formAction: function(url, selector, obj) {
        //collect data from form
        var DS = $.extend($.extend({}, this.defSet()), obj);
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        //send api request to api controller
        $(document).trigger({
            'type': 'showActivity'
        });
        $.ajax({
            type: "POST",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                $(document).trigger({
                    'type': 'hideActivity'
                });
                $(document).trigger({
                    'type': 'imageapi.success',
                    'obj': DS,
                    'el': form,
                    'message': obj
                });
                if (obj !== null) {
                    var form = $(selector);
                    returnMsg("[status]:" + obj.status);
                    returnMsg("[message]: " + obj.msg);

                    obj.refresh = obj.refresh != undefined ? obj.refresh.toString() : obj.refresh;
                    obj.redirect = obj.redirect != undefined ? obj.redirect.toString() : obj.redirect;

                    var cond = (obj.refresh && obj.refresh === 'true' && obj.redirect === 'false') || (obj.redirect && obj.redirect !== 'false' && obj.redirect !== '');
                    if (cond)
                        $(document).trigger({
                            'type': 'imageapi.before_refresh_reload',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    if (typeof DS.callback === 'function')
                        DS.callback(obj.msg, obj.status, form, DS);
                    else if (obj.status === true && !cond)
                        setTimeout((function() {
                            form.parent().find(DS.msgF).fadeOut(function() {
                                $(this).remove();
                            });
                            if (DS.hideForm)
                                form.show();
                        }), DS.durationHideForm);

                    setTimeout(function() {
                        if (obj.refresh === 'true' && obj.redirect === 'false')
                            location.reload();
                        if (obj.refresh === 'false' && obj.redirect !== '' && obj.redirect !== 'false')
                            location.href = obj.redirect;
                    }, DS.durationHideForm);

                    if ($.trim(obj.msg) !== '' && obj.validations === undefined) {
                        if (DS.hideForm)
                            form.hide();
                        var type = obj.status === true ? 'success' : 'error';
                        if (DS.messagePlace === 'ahead')
                            $(message[type](obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace === 'behind')
                            $(message[type](obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    }
                    if (obj.cap_image) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations) {
                        ImageCMSApi.sendValidations(obj.validations, form, DS, obj);
                    }
                    $(form).find(':input').off('input.imageapi').on('input.imageapi', function() {
                        var $this = $(this),
                                form = $this.closest('form'),
                                $thisТ = $this.attr('name'),
                                elMsg = form.find('[for=' + $thisТ + ']');
                        if ($.exists(elMsg)) {
                            $this.removeClass(DS.err + ' ' + DS.scs);
                            elMsg.remove();
                            $(document).trigger({
                                'type': 'imageapi.hidemsg',
                                'el': form,
                                'obj': DS,
                                'message': obj
                            });
                            $this.focus();
                        }
                    });
                }
                return this;
            }
        }).done(function() {
            returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $(selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    sendValidations: function(validations, selector, DS, obj) {
        /**
         * for displaying validation messages 
         * in the form, which needs validation, for each validate input
         * 
         * */
        var sel = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] !== "") {
                    var input = sel.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, sel));
                }
                if (i === Object.keys(validations).length) {
                    $(document).trigger({
                        'type': 'imageapi.pastemsg',
                        'el': sel,
                        'obj': DS,
                        'message': obj
                    });
                    var finput = sel.find(':input.' + DS.err + ':first');
                    console.log(':input.' + DS.err + ':first')
                    finput.setCursorPosition(finput.val().length);
                }
                i++;
            }
        } else {
            return false;
        }
    },
    addCaptcha: function(cI, DS) {
        /**
         * add captcha block if needed
         * @param {type} captcha_image
         */
        DS.captchaBlock.html(DS.captcha(cI));
        return false;
    }
};