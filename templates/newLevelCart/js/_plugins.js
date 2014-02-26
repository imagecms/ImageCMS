/*
 *imagecms frontend plugins
 ** @author Domovoj
 * @copyright <domovoj1@gmail.com>
 */
var isTouch = 'ontouchstart' in document.documentElement,
        aC = 'active',
        dC = 'disabled',
        fC = 'focus',
        сC = 'cloned',
        wnd = $(window),
        body = $('body');
$.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
            validLabels = /^(data|css):/,
            attr = {
                method: matchParams[0].match(validLabels) ?
                        matchParams[0].split(':')[0] : 'attr',
                property: matchParams.shift().replace(validLabels, '')
            },
    regexFlags = 'ig',
            regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g, ''), regexFlags);
    return regex.test($(elem)[attr.method](attr.property));
};
String.prototype.trimMiddle = function()
{
    var r = /\s\s+/g;
    return $.trim(this).replace(r, ' ');
};
String.prototype.isNumeric = function() {
    return !isNaN(parseFloat(this)) && isFinite(this);
};
String.prototype.pasteSAcomm = function() {
    var r = /\s,/g;
    return this.replace(r, ',');
};
$.exists = function(selector) {
    return $(selector).length > 0 && $(selector) instanceof jQuery;
};
$.existsN = function(nabir) {
    return nabir.length > 0 && nabir instanceof jQuery;
};
getChar = function(e) {
    if (e.which == null) {  // IE
        if (e.keyCode < 32)
            return null;
        return String.fromCharCode(e.keyCode)
    }

    if (e.which != 0 && e.charCode != 0) { // non IE
        if (e.which < 32)
            return null;
        return String.fromCharCode(e.which);
    }

    return null;
}
returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
$.fn.testNumber = function(add) {
    $(this).off('keypress.testNumber').on('keypress.testNumber', function(e) {
        $this = $(this);
        if (e.ctrlKey || e.altKey || e.metaKey)
            return;
        var chr = getChar(e);
        if (chr == null)
            return;
        if (!isNaN(parseFloat(chr)) || $.inArray(chr, add) != -1) {
            $this.trigger({
                type: 'testNumber',
                'res': true
            });
            return true;
        }
        else {
            $this.trigger({
                type: 'testNumber',
                'res': false
            });
            return false;
        }
    });
};
$.fn.pricetext = function(e, rank) {
    var $this = $(this);
    rank = rank !== undefined ? rank : true;
    $(document).trigger({
        type: 'textanimatechange',
        el: $this,
        ovalue: parseFloat($this.text().replace(/\s+/g, '')),
        nvalue: e,
        rank: rank
    });
    return $this;
};
$.fn.setCursorPosition = function(pos) {
    this.each(function() {
        this.select();
        try {
            this.setSelectionRange(pos, pos);
        } catch (err) {
        }

    });
    return this;
};
$.fn.getCursorPosition = function() {
    var el = $(this).get(0),
            pos = 0;
    if ('selectionStart' in el) {
        pos = el.selectionStart;
    } else if ('selection' in document) {
        el.focus();
        var Sel = document.selection.createRange();
        var SelLength = document.selection.createRange().text.length;
        Sel.moveStart('character', -el.value.length);
        pos = Sel.text.length - SelLength;
    }
    return pos;
};
/*plugin actual*/
(function($) {
    $.fn.actual = function() {
        if (arguments.length && typeof arguments[0] === 'string') {
            var dim = arguments[0],
                    clone = this.clone().addClass(сC);
            if (arguments[1] === undefined)
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
})(jQuery);
/*/plugin actual end*/
$(document).on('textanimatechange', function(e) {
    var $this = e.el,
            nv = e.nvalue,
            ov = e.ovalue,
            rank = e.rank,
            dif = nv - ov,
            temp = ov;
    if (dif > 0) {
        var ndif = dif,
                step = Math.floor(dif / 100);
    }
    else
    {
        ndif = Math.abs(dif),
                step = -Math.floor(ndif / 100);
    }
    var cond = '',
            numb = setInterval(function() {
                temp += step;
                cond = temp < nv;
                if (dif < 0)
                    cond = temp > nv;
                if (cond && step !== 0)
                    $this.text(rank ? temp.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : temp);
                else {
                    $this.text(rank ? nv.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : nv);
                    clearInterval(numb);
                    temp = nv;
                }
            }, 1);
});
function setCookie(name, value, expires, path, domain, secure)
{
    var today = new Date();
    today.setTime(today.getTime());
    if (expires)
    {
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expiresDate = new Date(today.getTime() + (expires));
    document.cookie = name + "=" + encodeURIComponent(value) +
            ((expires) ? ";expires=" + expiresDate.toGMTString() : "") + ((path) ? ";path=" + path : "") +
            ((domain) ? ";domain=" + domain : "") +
            ((secure) ? ";secure" : "");
}
function getCookie(c_name)
{
    var c_value = document.cookie,
            c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start === -1)
        c_start = c_value.indexOf(c_name + "=");
    if (c_start === -1)
        c_value = null;
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end === -1)
            c_end = c_value.length;
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}
/*plugin nstCheck*/
(function($) {
    var nS = "nstcheck",
            methods = {
                init: function(options) {
                    if ($.existsN(this)) {
                        var settings = $.extend({
                            wrapper: $("label:has(.niceCheck)"),
                            elCheckWrap: '.niceCheck',
                            evCond: false,
                            classRemove: '',
                            resetChecked: false,
                            trigger: function() {
                            },
                            after: function() {
                            }
                        }, options);
                        var frameChecks = $(this),
                                wrapper = settings.wrapper,
                                elCheckWrap = settings.elCheckWrap,
                                evCond = settings.evCond,
                                classRemove = settings.classRemove,
                                after = settings.after,
                                trigger = settings.trigger,
                                resetChecked = settings.resetChecked;
                        frameChecks.find(elCheckWrap).removeClass(dC + ' ' + aC + ' ' + fC);
                        //init event click on wrapper change state
                        frameChecks.find(wrapper).removeClass(dC + ' ' + aC + ' ' + fC).off('click.' + nS).on('click.' + nS, function(e) {
                            var $this = $(this),
                                    nstcheck = $this.find(elCheckWrap);
                            if (!$.existsN(nstcheck))
                                nstcheck = $this;
                            if (!$this.hasClass(dC)) {
                                if (!evCond) {
                                    methods.changeCheck(nstcheck);
                                    after(frameChecks, $this, nstcheck, e);
                                }
                                else {
                                    trigger(frameChecks, $this, nstcheck, e);
                                }
                            }
                            e.preventDefault();
                        });
                        //init event reset
                        frameChecks.closest('form').each(function() {
                            var $this = $(this);
                            if (resetChecked)
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function(e) {
                                    methods.checkAllReset($this.find(elCheckWrap).filter('.' + aC));
                                });
                            else {
                                var checked = $([]);
                                $this.find('input:checked').each(function() {
                                    checked = checked.add($(this).closest(elCheckWrap));
                                });
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function(e) {
                                    var wrap = $this.find(elCheckWrap);
                                    methods.checkAllReset(wrap.not(checked));
                                    methods.checkAllChecks(wrap.not('.' + aC).filter(checked));
                                    e.preventDefault();
                                });
                            }
                        });
                        //init events input
                        wrapper.find('input').off('mousedown.' + nS).on('mousedown.' + nS, function(e) {
                            e.stopPropagation();
                            e.preventDefault()
                            if (e.button == 0)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('click.' + nS).on('click.' + nS, function(e) {
                            e.stopPropagation();
                            e.preventDefault()
                        }).off('keyup.' + nS).on('keyup.' + nS, function(e) {
                            if (e.keyCode === 32)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('focus.' + nS).on('focus.' + nS, function(e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).addClass(fC);
                        }).off('blur.' + nS).on('blur.' + nS, function(e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).removeClass(fC);
                        }).off('change.' + nS).on('change.' + nS, function(e) {
                            e.preventDefault()
                        });
                        //init states of checkboxes
                        frameChecks.find(elCheckWrap).each(function() {
                            var $this = $(this).removeClass(classRemove).addClass(nS),
                                    input = $this.find('input');
                            methods._changeCheckStart($this);
                            if (input.is(':focus'))
                                input.trigger('focus.' + nS);
                            if (input.is(':disabled'))
                                methods.checkAllDisabled($this);
                            else
                                methods.checkAllEnabled($this);
                        });
                    }
                },
                _changeCheckStart: function(el) {
                    if (el === undefined)
                        el = this;
                    el.find("input").is(":checked") ? methods.checkChecked(el) : methods.checkUnChecked(el);
                },
                checkChecked: function(el) {
                    if (el === undefined)
                        el = this;
                    el.addClass(aC).parent().addClass(aC).end().find("input").attr("checked", "checked");
                    el.find('input').trigger({
                        'type': nS + '.cc',
                        'el': el
                    });
                },
                checkUnChecked: function(el) {
                    if (el === undefined)
                        el = this;
                    el.removeClass(aC).parent().removeClass(aC).end().find("input").removeAttr("checked");
                    el.find('input').trigger({
                        'type': nS + '.cuc',
                        'el': el
                    });
                },
                changeCheck: function(el)
                {
                    if (el === undefined)
                        el = this;
                    if (el.find("input").attr("checked") != undefined) {
                        methods.checkUnChecked(el);
                    }
                    else {
                        methods.checkChecked(el);
                    }
                },
                checkAllChecks: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        methods.checkChecked($(this));
                    });
                },
                checkAllReset: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        methods.checkUnChecked($(this));
                    });
                },
                checkAllDisabled: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        var $this = $(this);
                        $this.addClass(dC).parent().addClass(dC).end().find("input").attr('disabled', 'disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ad',
                            'el': $this
                        });
                    });
                },
                checkAllEnabled: function(el)
                {
                    (el === undefined ? this : el).each(function() {
                        var $this = $(this);
                        $this.removeClass(dC).parent().removeClass(dC).end().find("input").removeAttr('disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ae',
                            'el': $this
                        });
                    });
                }
            };
    $.fn.nStCheck = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.nStCheck');
        }
    };
    $.nStCheck = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstCheck end*/
/*plugin nstRadio*/
(function($) {
    var nS = "nstradio",
            methods = {
                init: function(options) {
                    var optionsRadio = $.extend({
                        wrapper: $(".frame-label:has(.niceRadio)"),
                        elCheckWrap: '.niceRadio',
                        classRemove: null,
                        before: function() {
                        },
                        after: function() {
                        }
                    }, options),
                            settings = optionsRadio;
                    var $this = this;
                    if ($.existsN($this)) {
                        $this.each(function() {
                            var $this = $(this),
                                    after = settings.after,
                                    before = settings.before,
                                    classRemove = settings.classRemove,
                                    wrapper = settings.wrapper,
                                    elCheckWrap = settings.elCheckWrap,
                                    input = $this.find(elCheckWrap).find('input');
                            $this.find(elCheckWrap).each(function() {
                                methods.changeRadioStart($(this), classRemove, after, true);
                            });
                            input.each(function() {
                                var input = $(this);
                                $(input.data('link')).focus(function(e) {
                                    if (e.which === 0)
                                        methods.radioCheck(input.parent(), after, false);
                                });
                            });
                            $this.find(wrapper).off('click.' + nS).on('click.' + nS, function(e) {
                                var input = $(this).find('input');
                                if (!input.is(':disabled') && !input.is(':checked')) {
                                    before($(this));
                                    methods.changeRadio($(this).find(elCheckWrap), after, false);
                                }
                            });
                            input.off('click.' + nS).off('change.' + nS).on('click.' + nS + ' change.' + nS, function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                            });
                            input.off('mousedown.' + nS).on('mousedown.' + nS, function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                $(this).closest(wrapper).trigger('click.' + nS);
                            });
                        });
                    }
                },
                changeRadioStart: function(el, classRemove, after, start)
                {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    if (input.is(":checked")) {
                        methods.radioCheck(el, after, start);
                    }
                    if (input.is(":disabled")) {
                        methods.radioDisabled(el);
                    }
                    el.removeClass(classRemove);
                    return false;
                },
                changeRadio: function(el, after, start)
                {
                    if (el === undefined)
                        el = this;
                    methods.radioCheck(el, after, start);
                },
                radioCheck: function(el, after, start) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    el.addClass(aC).removeClass(dC);
                    el.parent().addClass(aC).removeClass(dC);
                    input.attr("checked", true);
                    $(input.data('link')).focus();
                    input.closest('form').find('[name=' + input.attr('name') + ']').not(input).each(function() {
                        methods.radioUnCheck($(this).parent());
                    });
                    after(el, start);
                    $(document).trigger({
                        'type': 'nStRadio.RC',
                        'el': el,
                        'input': input
                    });
                },
                radioUnCheck: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    el.removeClass(aC);
                    el.parent().removeClass(aC);
                    input.attr("checked", false);
                    $(document).trigger({
                        'type': 'nStRadio.RUC',
                        'el': el,
                        'input': input
                    });
                },
                radioDisabled: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.attr('disabled', 'disabled');
                    el.removeClass(aC).addClass(dC);
                    el.parent().removeClass(aC).addClass(dC);
                },
                radioUnDisabled: function(el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.removeAttr('disabled');
                    el.removeClass(aC + ' ' + dC);
                    el.parent().removeClass(aC + ' ' + dC);
                }
            };
    $.fn.nStRadio = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.nStRadio');
        }
    };
    $.nStRadio = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstRadio end*/
/*plugin autocomplete*/
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                item: 'ul > li',
                duration: 300,
                searchPath: siteUrl + locale + "shop/search/ac",
                inputString: $('#inputString'),
                minValue: 3,
                underscoreLayout: '#searchResultsTemplate',
                blockEnter: true
            }, options);
            function postSearch() {
                $(document).trigger({
                    'type': 'autocomplete.before',
                    'el': inputString
                });
                $.post(searchPath, {
                    queryString: inputString.val()
                }, function(data) {
                    try {
                        var dataObj = JSON.parse(data),
                                html = _.template($(underscoreLayout).html(), {
                                    'items': dataObj
                                });
                    } catch (e) {
                        var html = e.toString();
                    }
                    $thisS.html(html);
                    $thisS.fadeIn(durationA, function() {
                        $(document).trigger({
                            'type': 'autocomplete.after',
                            'el': $thisS,
                            'input': inputString
                        });
                        $thisS.off('click.autocomplete').on('click.autocomplete', function(e) {
                            e.stopImmediatePropagation();
                        });
                        body.off('click.autocomplete').on('click.autocomplete', function(event) {
                            closeFrame();
                        }).off('keydown.autocomplete').on('keydown.autocomplete', function(e) {
                            if (!e)
                                var e = window.event;
                            if (e.keyCode === 27) {
                                closeFrame();
                            }
                        });
                    });
                    if (inputString.val().length === 0)
                        closeFrame();
                    selectorPosition = -1;
                    var itemserch = $thisS.find(itemA);
                    itemserch.mouseover(function() {
                        var $this = $(this);
                        $this.addClass('selected');
                        selectorPosition = $this.index();
                        lookup(itemserch, selectorPosition);
                    }).mouseleave(function() {
                        $(this).removeClass('selected');
                    });
                    lookup(itemserch, selectorPosition);
                });
            }
            function lookup(itemserch, selectorPosition) {
                inputString.keyup(function(event) {
                    if (!event)
                        var event = window.event;
                    var code = event.keyCode;
                    if (code === 38 || code === 40)
                    {
                        if (code === 38)
                        {
                            selectorPosition -= 1;
                        }
                        if (code === 40)
                        {
                            selectorPosition += 1;
                        }

                        if (selectorPosition < 0)
                        {
                            selectorPosition = itemserch.length - 1;
                        }
                        if (selectorPosition > itemserch.length - 1)
                        {
                            selectorPosition = 0;
                        }
                        itemserch.removeClass('selected');
                        itemserch.eq(selectorPosition).addClass('selected');
                        return false;
                    }

                    // Enter pressed
                    if (code === 13)
                    {
                        var itemserchS = itemserch.filter('.selected');
                        if ($.existsN(itemserchS))
                            itemserchS.each(function(i, el) {
                                window.location = $(el).attr('href');
                                window.location = $(el).find('a').attr('href');
                            });
                        else {
                            $thisS.closest('form').submit();
                        }
                    }
                    return false;
                });
            }

            function closeFrame() {
                $(document).trigger({
                    'type': 'autocomplete.close',
                    'el': $thisS
                });
                $thisS.stop(true, false).fadeOut(durationA);
                $thisS.off('click.autocomplete');
                body.off('click.autocomplete').off('keydown.autocomplete');
            }

            var $thisS = this,
                    blockEnter = settings.blockEnter,
                    itemA = settings.item,
                    durationA = settings.duration,
                    searchPath = settings.searchPath,
                    selectorPosition = -1,
                    inputString = settings.inputString,
                    underscoreLayout = settings.underscoreLayout,
                    minValue = settings.minValue;
            var submit = inputString.closest('form').find('[type="submit"]');
            if (blockEnter)
                submit.on('click.autocomplete', function(e) {
                    e.preventDefault();
                    inputString.focus();
                    $(document).trigger({
                        type: 'autocomplete.fewLength',
                        el: inputString,
                        value: minValue
                    });
                });
            inputString.keyup(function(event) {
                var $this = $(this);
                var inputValL = $this.val().length;
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (inputValL > minValue) {
                    $this.tooltip('remove');
                    if (code !== 27 && code !== 40 && code !== 38 && code !== 39 && code !== 37 && code !== 13 && inputValL !== 0 && $.trim($this.val()) !== "")
                        postSearch();
                    else if (inputValL === 0)
                        closeFrame();
                }
                else {
                    if (code === 13 && !blockEnter)
                        submit.closest('form').submit();
                    else
                        $(document).trigger({
                            type: 'autocomplete.fewLength',
                            el: $this,
                            value: minValue
                        });
                }
                if (inputString.val().length <= minValue && blockEnter)
                    submit.off('click.autocomplete').on('click.autocomplete', function(e) {
                        e.preventDefault();
                        inputString.focus();
                        $(document).trigger({
                            type: 'autocomplete.fewLength',
                            el: inputString,
                            value: minValue
                        });
                    });
                else {
                    submit.off('click.autocomplete');
                }
            }).blur(function() {
                closeFrame();
            });
            inputString.keypress(function(event) {
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (code === 13 && $(this).val().length <= minValue)
                    return false;
            });
        }
    };
    $.fn.autocomplete = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.autocomplete');
        }
    };
    $.autocomplete = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin autocomplete end*/
/*plugin tooltip*/
(function($) {
    var nS = 'tooltip',
            sel = '.tooltip',
            methods = {
                def: {
                    otherClass: false,
                    effect: '',
                    textEl: '.text-el',
                    placement: 'top',
                    offsetX: 10,
                    offsetY: 10,
                    tooltip: false,
                    sel: '.tooltip',
                    durationOn: 300,
                    durationOff: 200
                },
                init: function(options, e) {
                    var settings = $.extend(methods.def, options),
                            $this = this,
                            elSet = $this.data(),
                            title = elSet.title || settings.title,
                            otherClass = elSet.otherClass || settings.otherClass,
                            effect = elSet.effect || settings.effect,
                            textEl = elSet.textEl || settings.textEl,
                            placement = elSet.placement || settings.placement,
                            offsetX = elSet.offsetX || settings.offsetX,
                            offsetY = elSet.offsetY || settings.offsetY,
                            durationOn = elSet.durationOn || settings.durationOn,
                            durationOff = elSet.durationOff || settings.durationOff,
                            sel = elSet.tooltip || methods.def.sel,
                            tooltip = $(sel).not('.' + сC);
                    if (effect !== 'always')
                        $this.data({
                            'title': title,
                            'otherClass': otherClass,
                            'effect': effect,
                            'textEl': textEl,
                            'placement': placement,
                            'offsetX': offsetX,
                            'offsetY': offsetY,
                            'tooltip': sel,
                            'durationOn': durationOn,
                            'durationOff': durationOff
                        });
                    else
                        $this.data({
                            'title': ''
                        });
                    textEl = $this.find(textEl);
                    if (textEl.is(':visible') && $.existsN(textEl))
                        return $this;
                    tooltip.html(title);
                    if (otherClass) {
                        if (!$.exists('.' + otherClass))
                            tooltip = tooltip.addClass(otherClass).appendTo(body);
                        else
                            tooltip = $('.' + otherClass);
                    }

                    if (effect === 'mouse')
                        this.off('mousemove.' + nS).on('mousemove.' + nS, function(e) {
                            tooltip.css({
                                'left': methods.left($(this), tooltip, placement, e.pageX, effect, offsetX),
                                'top': methods.top($(this), tooltip, placement, e.pageY, effect, offsetY)
                            });
                        });
                    tooltip.removeClass('top bottom right left').addClass(placement);
                    tooltip.css({
                        'left': methods.left(this, tooltip, placement, this.offset().left, effect, offsetX),
                        'top': methods.top(this, tooltip, placement, this.offset().top, effect, offsetY)
                    }).fadeIn(durationOn, function() {
                        $(document).trigger({
                            'type': 'tooltip.show',
                            'el': $(this).css('opacity', 1)
                        });
                    });
                    $this.off('mouseleave.' + nS).on('mouseleave.' + nS, function(e) {
                        var el = $(this);
                        if (effect !== 'always')
                            el.tooltip('remove', e);
                    });
                    $this.filter(':input').off('blur.' + nS).on('blur.' + nS, function(e) {
                        $(this).tooltip('remove', e);
                    });

                    return $this;
                },
                left: function(el, tooltip, placement, left, eff, offset) {
                    if (placement === 'left')
                        return Math.ceil(left - (eff === 'mouse' ? offset : tooltip.actual('outerWidth') - offset));
                    if (placement === 'right')
                        return Math.ceil(left + (eff === 'mouse' ? offset : el.outerWidth() + offset));
                    else
                        return Math.ceil(left - (eff === 'mouse' ? offset : (tooltip.actual('outerWidth') - el.outerWidth()) / 2));
                },
                top: function(el, tooltip, placement, top, eff, offset) {
                    if (placement === 'top')
                        return Math.ceil(top - (eff === 'mouse' ? offset : tooltip.actual('outerHeight') - offset));
                    if (placement === 'bottom')
                        return Math.ceil(top + (eff === 'mouse' ? offset : tooltip.actual('outerHeight') + offset));
                    else {
                        return Math.ceil(top - (eff === 'mouse' ? offset : (tooltip.actual('outerHeight') - el.outerHeight()) / 2));
                    }
                },
                remove: function(e) {
                    var $this = this;
                    if ($this.length !== 0 && $this['data'] !== undefined) {
                        var data = $this.data(),
                                selA = $([]);
                        if (data.otherClass)
                            selA = $(data.otherClass);
                        if (data.tooltip !== '.tooltip')
                            selA = selA.add($(data.tooltip));
                        var durOff = $this.data('durationOff');
                        if ($.existsN(selA))
                            var sel = selA;
                    }
                    else
                        durOff = methods.def.durationOff;
                    $(sel || methods.def.sel).stop().fadeOut(durOff, function() {
                        $(document).trigger({
                            'type': 'tooltip.hide',
                            'el': $(this)
                        });
                    });
                    return $this;
                }
            };
    $.fn.tooltip = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.tooltip');
        }
    };
    $.tooltip = function(m) {
        return methods[m];
    };
    body.on('mouseenter.' + nS, '[data-rel="tooltip"]', function(e) {
        if ($(e.relatedTarget).has('[data-rel="tooltip"]'))
            $(sel).hide();
        $(this).tooltip({}, e);
    }).on('click.' + nS + ' mouseup.' + nS, function(e) {
        if ($(this).data('effect') == 'always')
            $.tooltip('remove')(e);
    });
    if (!$.exists(sel))
        body.append('<span class="tooltip"></span>');
})(jQuery);
/*plugin tooltip end*/
/*plugin menuImageCms for main menu shop*/
(function($) {
    var methods = {
        _position: function(menuW, $thisL, dropW, drop, $thisW, countColumn, sub2, direction) {
            if ((menuW - $thisL < dropW && dropW < menuW && direction !== 'left') || direction === 'right') {
                drop.removeClass('left-drop');
                if (drop.children().children().length >= countColumn && !sub2)
                    drop.css('right', 0).addClass('right-drop');
                else {
                    var right = menuW - $thisW - $thisL;
                    if ($thisL + $thisW < dropW) {
                        right = menuW - dropW;
                    }
                    drop.css('right', right).addClass('right-drop');
                }
            } else if (direction !== 'right' || direction === 'left') {
                drop.removeClass('right-drop');
                if (sub2 && dropW > menuW)
                    drop.css('left', $thisL).addClass('left-drop');
                else if (drop.children().children().length >= countColumn || dropW >= menuW)
                    drop.css('left', 0).addClass('left-drop');
                else
                    drop.css('left', $thisL).addClass('left-drop');
            }
        },
        init: function(options) {
            this.each(function() {
                var menu = $(this);
                if ($.existsN(menu)) {
                    var sH = 0,
                            optionsMenu = $.extend({
                                item: 'li:first',
                                direction: null,
                                effectOn: 'fadeIn',
                                effectOff: 'fadeOut',
                                effectOnS: 'fadeIn',
                                effectOffS: 'fadeOut',
                                duration: 0,
                                drop: 'li > ul',
                                countColumn: 'none',
                                columnPart: false,
                                columnPart2: false,
                                maxC: 10,
                                sub3Frame: 'ul ul',
                                columnClassPref: 'column_',
                                columnClassPref2: 'column2_',
                                durationOn: 0,
                                durationOff: 0,
                                durationOnS: 0,
                                animatesub3: false,
                                dropWidth: null,
                                sub2Frame: null,
                                evLF: 'hover',
                                evLS: 'hover',
                                hM: 'hoverM',
                                menuCache: false,
                                activeFl: aC,
                                parentTl: 'li',
                                refresh: false,
                                otherPage: undefined,
                                vertical: false
                            }, options);
                    menu.data('options', optionsMenu);
                    var settings = optionsMenu,
                            menuW = menu.width(),
                            menuItem = menu.find(settings.item),
                            direction = settings.direction,
                            drop = settings.drop,
                            dropOJ = menu.find(drop),
                            effOn = settings.effectOn,
                            effOff = settings.effectOff,
                            effOnS = settings.effectOnS,
                            countColumn = settings.countColumn,
                            columnPart = settings.columnPart,
                            columnPart2 = settings.columnPart2,
                            maxC = settings.maxC,
                            sub3Frame = settings.sub3Frame,
                            columnClassPref = settings.columnClassPref,
                            columnClassPref2 = settings.columnClassPref2,
                            itemMenuL = menuItem.length,
                            dropW = settings.dropWidth,
                            sub2Frame = settings.sub2Frame,
                            duration = timeDurM = settings.duration,
                            durationOn = settings.durationOn,
                            durationOff = settings.durationOff,
                            durationOnS = settings.durationOnS,
                            animatesub3 = settings.animatesub3,
                            evLF = settings.evLF,
                            evLS = settings.evLS,
                            hM = settings.frAClass,
                            refresh = settings.refresh,
                            menuCache = settings.menuCache,
                            activeFl = settings.activeFl,
                            parentTl = settings.parentTl,
                            otherPage = settings.otherPage,
                            vertical = settings.vertical;
                    if (menuCache && !refresh) {
                        menu.find('a').each(function() {//if start without cache and remove active item
                            var $this = $(this);
                            $this.closest(activeFl.split(' ')[0]).removeClass(aC);
                            $this.removeClass(aC);
                        });
                        var locHref = location.href,
                                locationHref = otherPage !== undefined ? otherPage : locHref;
                        menu.find('a[href="' + locationHref + '"]').each(function() {
                            var $this = $(this);
                            $this.closest(activeFl.split(' ')[0]).addClass(aC);
                            $this.closest(parentTl.split(' ')[0]).addClass(aC).prev().addClass(aC);
                            $this.addClass(aC);
                        });
                    }
                    if (isTouch) {
                        evLF = 'toggle';
                        evLS = 'toggle';
                    }
                    if (!refresh) {
                        if (columnPart2) {
                            dropOJ.find(sub3Frame).each(function() {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref2 + '([0-9]+))'),
                                        numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(new RegExp(columnClassPref2 + '([0-9]+)'))[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL > 1) {
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var currC = columnsObj.filter('.' + n),
                                                classCuurC = currC.first().attr('class');
                                        $this.children().append('<li class="' + classCuurC + '" data-column="' + n + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append(currC.clone());
                                        numbColumnL = numbColumnL > maxC ? maxC : numbColumnL;
                                        if (sub2Frame)
                                            $this.addClass('x' + numbColumnL);
                                        else {
                                            $this.closest('li').addClass('x' + numbColumnL).attr('data-x', numbColumnL);
                                        }
                                    });
                                    columnsObj.remove();
                                }
                            });
                        }
                        if (columnPart && !sub2Frame)
                            dropOJ.each(function() {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref + '([0-9]|-1+))'),
                                        numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(/([0-9]|-1+)/)[0];
                                })
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL == 1 && $.inArray('0', numbColumn) == -1 || numbColumnL > 1) {
                                    if ($.inArray('-1', numbColumn) == 0) {
                                        numbColumn.shift();
                                        numbColumn.push('-1');
                                    }
                                    if ($.inArray('0', numbColumn) == 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var $thisLi = columnsObj.filter('.' + columnClassPref + n),
                                                sumx = 0;
                                        $thisLi.each(function() {
                                            var datax = $(this).attr('data-x');
                                            sumx = parseInt(datax == 0 || datax == undefined ? 1 : datax) > sumx ? parseInt(datax == 0 || datax == undefined ? 1 : datax) : sumx;
                                        })
                                        $this.children().append('<li class="x' + sumx + '" data-column="' + n + '" data-x="' + sumx + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append($thisLi.clone());
                                    })
                                    columnsObj.remove();
                                }
                                var sumx = 0;
                                $this.children().children().each(function() {
                                    var datax = $(this).attr('data-x');
                                    sumx = sumx + parseInt(datax == 0 || datax == undefined ? 1 : datax);
                                });
                                sumx = sumx > maxC ? maxC : sumx;
                                $this.addClass('x' + sumx);
                            });
                        $(document).trigger({
                            type: 'columnRenderComplete',
                            el: dropOJ
                        });
                    }
                    var k = [];
                    if (!vertical)
                        menuItem.add(menuItem.find('.helper:first')).css('height', '');
                    menuItem.each(function(index) {
                        var $this = $(this),
                                $thisW = $this.width(),
                                $thisL = $this.position().left,
                                $thisH = $this.height(),
                                $thisDrop = $this.find(drop);
                        k[index] = false;
                        if ($thisH > sH)
                            sH = $thisH;
                        if ($.existsN($thisDrop)) {
                            if (!dropW) {
                                menu.css('overflow', 'hidden');
                                var dropW2 = $thisDrop.show().width();
                                $thisDrop.hide();
                                menu.css('overflow', '');
                            }
                            else
                                var dropW2 = dropW;
                            methods._position(menuW, $thisL, dropW2, $thisDrop, $thisW, countColumn, sub2Frame, direction);
                        }
                        $this.data('kk', 0);
                    }).css('height', sH);
                    if (!vertical)
                        menuItem.find('.helper:first').css('height', sH);
                    menu.removeClass('not-js');
                    var hoverTO = '';
                    function closeMenu() {
                        var $thisDrop = menu.find(drop);
                        if ($thisDrop.length !== 0)
                            menu.removeClass(hM);
                        if (evLS === 'toggle' || evLF === 'toggle') {
                            menu.find('.' + hM).click();
                            dropOJ.hide();
                        }

                        $('.firstH, .lastH').removeClass('firstH lastH');
                        clearTimeout(hoverTO);
                    }
                    if (evLF === 'toggle')
                        evLF = 'click';
                    if (evLS === 'toggle')
                        evLS = 'click';
                    menuItem.off(evLF)[evLF](
                            function(e) {
                                var $this = $(this);
                                if ($this.data("show") === "no" || $this.data("show") === undefined) {
                                    $this.data("show", "yes");
                                    clearTimeout(hoverTO);
                                    closeMenu();
                                    var $thisI = $this.index(),
                                            $thisDrop = $this.find(drop);
                                    $this.addClass(hM);
                                    if ($thisI === 0)
                                        $this.addClass('firstH');
                                    if ($thisI === itemMenuL - 1)
                                        $this.addClass('lastH');
                                    if ($(e.relatedTarget).is(menuItem) || $.existsN($(e.relatedTarget).parents(menuItem)) || $this.data('kk') === 0)
                                        k[$thisI] = true;
                                    if (k[$thisI]) {
                                        hoverTO = setTimeout(function() {
                                            $thisDrop[effOn](durationOn, function(e) {
                                                $this.data('kk', $this.data('kk') + 1);
                                                $(document).trigger({
                                                    type: 'menu.showDrop',
                                                    el: $thisDrop
                                                });
                                                if ($thisDrop.length !== 0)
                                                    menu.addClass(hM);
                                                if (sub2Frame) {
                                                    var listDrop = $thisDrop.children();
                                                    $thisDrop.find(sub2Frame).addClass('is-side');
                                                    listDrop.children().off(evLS)[evLS](function(e) {
                                                        var $this = $(this);
                                                        if ($this.data("show") === "no" || $this.data("show") === undefined) {
                                                            $this.data("show", "yes");
                                                            subFrame = $this.find(sub2Frame);
                                                            if (e.type !== 'click' && evLS !== 'toggle') {
                                                                $this.siblings().removeClass(hM);
                                                            }
                                                            if ($.existsN(subFrame)) {
                                                                if (e.type === 'click' && evLS === 'toggle') {
                                                                    e.stopPropagation();
                                                                    $this.siblings().filter('.' + hM).click();
                                                                    $this.addClass(hM);
                                                                }
                                                                else {
                                                                    $this.has(sub2Frame).addClass(hM);
                                                                }

                                                                $thisDrop.css('width', '');
                                                                listDrop.add(subFrame).css('height', '');
                                                                var dropW = $thisDrop.width(),
                                                                        sumW = dropW + subFrame.width(),
                                                                        subHL2 = subFrame.outerHeight(),
                                                                        dropDH = listDrop.height();
                                                                var addH = listDrop.outerHeight() - dropDH;
                                                                if (subHL2 < dropDH)
                                                                    subHL2 = dropDH;
                                                                if (animatesub3) {
                                                                    listDrop.animate({
                                                                        'height': subHL2
                                                                    }, {
                                                                        queue: false,
                                                                        duration: durationOnS,
                                                                        complete: function() {
                                                                            $thisDrop.animate({
                                                                                'width': sumW,
                                                                                'height': subHL2 + addH
                                                                            }, {
                                                                                queue: false,
                                                                                duration: durationOnS
                                                                            });
                                                                        }
                                                                    });
                                                                }
                                                                else {
                                                                    listDrop.css('height', subHL2);
                                                                    $thisDrop.css({
                                                                        'height': subHL2 + addH,
                                                                        'width': sumW
                                                                    });
                                                                }
                                                                subFrame[effOnS](durationOnS, function() {
                                                                    subFrame.css('height', subHL2);
                                                                });
                                                            }
                                                            else
                                                                return true;
                                                        }
                                                        else {
                                                            $this.data("show", "no");
                                                            if (e.type === 'click' && evLS === 'toggle') {
                                                                e.stopPropagation();
                                                            }
                                                            var subFrame = $this.find(sub2Frame);
                                                            if ($.existsN(subFrame)) {
                                                                subFrame.hide();
                                                                $thisDrop.stop().css({
                                                                    'width': '',
                                                                    'height': ''
                                                                });
                                                                listDrop.add(subFrame).stop().css('height', '');
                                                                $this.removeClass(hM);
                                                            }
                                                        }
                                                    });
                                                }
                                            });
                                        }, timeDurM);
                                    }
                                }
                                else {
                                    $this.data("show", "no");
                                    var $thisI = $this.index();
                                    k[$thisI] = true;
                                    if ($this.index() === 0)
                                        $this.removeClass('firstH');
                                    if ($this.index() === itemMenuL - 1)
                                        $this.removeClass('lastH');
                                    var $thisDrop = $this.find(drop);
                                    if ($.existsN($thisDrop)) {
                                        $thisDrop.stop(true, false)[effOff](durationOff);
                                    }
                                    $this.removeClass(hM);
                                }
                            });
                    menu.off('hover')['hover'](
                            function(e) {
                                menuItem.each(function() {
                                    $(this).data('kk', 0);
                                });
                                timeDurM = 0;
                            },
                            function(e) {
                                closeMenu();
                                menuItem.each(function() {
                                    $(this).data('kk', -1);
                                });
                                timeDurM = duration;
                            });
                    body.off('click.menu').on('click.menu', function(e) {
                        closeMenu();
                    }).off('keydown.menu').on('keydown.menu', function(e) {
                        if (!e)
                            var e = window.event;
                        if (e.keyCode === 27) {
                            closeMenu();
                        }
                    });
                    dropOJ.find('a').off('click.menuref').on('click.menuref', function(e) {
                        if (evLS === 'toggle') {
                            if ($.existsN($(this).next()) && sub2Frame) {
                                e.preventDefault();
                                return true;
                            }
                            e.stopPropagation();
                            return true;
                        }
                        else
                            e.stopPropagation();
                    });
                    menuItem.find('a:first').off('click.menuref').on('click.menuref', function(e) {
                        e.preventDefault();
                        if (!$.existsN($(this).closest(menuItem).find(drop)))
                            e.stopPropagation();
                    });
                }
            });
            return this;
        },
        refresh: function() {
            methods.init.call(this, $.extend({}, this.data('options'), {
                refresh: true
            }));
            return this;
        }
    };
    $.fn.menuImageCms = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.menuImageCms');
        }
    };
    $.menuImageCms = function(m) {
        return methods[m];
    };
})(jQuery);
/*plugin menuImageCms end*/
/*plugin tabs*/
(function($) {
    var methods = {
        index: 0,
        init: function(options) {
            var $this = this;
            if ($.existsN($this)) {
                var settings = $.extend({
                    effectOn: 'show',
                    effectOff: 'hide',
                    durationOn: '0',
                    durationOff: '0',
                    before: function() {
                    },
                    after: function() {
                    }
                }, options);
                var tabsDiv = [],
                        tabsId = [],
                        navTabsLi = [],
                        regRefs = [],
                        thisL = this.length,
                        k = true,
                        refs = [],
                        attrOrdata = [];
                $this.each(function() {
                    var index = methods.index,
                            $thiss = $(this),
                            data = $thiss.data(),
                            effectOn = data.effectOn || settings.effectOn,
                            effectOff = data.effectOff || settings.effectOff,
                            durationOn = +(data.durationOn ? data.durationOn.toString() : data.durationOn || settings.durationOn ? settings.durationOn.toString() : settings.durationOn),
                            durationOff = +(data.durationOff ? data.durationOff.toString() : data.durationOff || settings.durationOff ? settings.durationOff.toString() : settings.durationOff);
                    navTabsLi[index] = $thiss.children();
                    refs[index] = navTabsLi[index].children(':first-child');
                    attrOrdata[index] = refs[index].attr('href') !== undefined ? 'attr' : 'data';
                    var tempO = $([]),
                            tempO2 = $([]),
                            tempRefs = [];
                    methods.index += 1;
                    refs[index].each(function(ind) {
                        var tHref = $(this)[attrOrdata[index]]('href');
                        if (tHref.indexOf('#') !== -1) {
                            tempO = tempO.add($(tHref));
                            tempO2 = tempO2.add('[data-id=' + tHref + ']');
                            tempRefs.push(tHref);
                        }
                    });
                    tabsDiv[index] = tempO;
                    tabsId[index] = tempO2;
                    regRefs[index] = tempRefs;
                    refs[index].off('click.tabs').on('click.tabs', function(e) {
                        wST = wnd.scrollTop();
                        var $this = $(this),
                                resB = settings.before($this);
                        if (resB === undefined || resB === true) {
                            if ($this.is('a'))
                                e.preventDefault();
                            var cookie = $thiss.data('cookie') !== undefined,
                                    toggle = $thiss.data('type') === 'toggle',
                                    condStart = e.start;
                            if (!$this.parent().hasClass('disabled')) {
                                var $thisA = $this[attrOrdata[index]]('href'),
                                        $thisAOld = navTabsLi[index].filter('.' + aC).children()[attrOrdata[index]]('href'),
                                        $thisAOld = $thisAOld == $thisA ? undefined : $thisAOld,
                                        $thisAO = $($thisA),
                                        $thisS = $this.data('source') || $this.attr('href'),
                                        $thisData = $this.data('data'),
                                        $thisSel = $this.data('selector');
                                function tabsDivT() {
                                    var showBlock = $thisAO.add($('[data-id=' + $thisA + ']')),
                                            addDiv = toggle ? ($thisAO.is(':visible') && !condStart ? $([]) : showBlock) : showBlock;
                                    if ($thisA.indexOf('#') !== -1 && !$thisAO.is(':visible')) {
                                        showBlock[effectOn](durationOn, function() {
                                            settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                        }).addClass(aC);
                                    }
                                    else if ($thisA.indexOf('#') === -1)
                                        settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                    tabsDiv[index].add(tabsId[index]).not(addDiv)[effectOff](durationOff).removeClass(aC);
                                }
                                var activeP = $this.parent();
                                navTabsLi[index].not(activeP).removeClass(aC);
                                if (activeP.hasClass(aC) && toggle)
                                    activeP.removeClass(aC);
                                else
                                    activeP.addClass(aC);
                                if (!condStart && $thisS !== undefined)
                                    tabsDivT();
                                if ($thisS !== undefined && !$thisAO.hasClass('visited')) {
                                    $thisAO.addClass('visited');
                                    $(document).trigger({
                                        'type': 'tabs.beforeload',
                                        "els": tabsDiv[index],
                                        "el": $thisAO
                                    });
                                    if ($thisData !== undefined)
                                        $.ajax({
                                            type: 'post',
                                            url: $thisS,
                                            data: $thisData,
                                            success: function(data) {
                                                tabsDivT();
                                                $thisAO.find($thisSel).html(data);
                                                $(document).trigger({
                                                    'type': 'tabs.afterload',
                                                    "els": tabsDiv[index],
                                                    "el": $thisAO
                                                });
                                            }
                                        });
                                    else
                                        $thisAO.load($thisS, function() {
                                            $(document).trigger({
                                                'type': 'tabs.afterload',
                                                "els": tabsDiv[index],
                                                "el": $thisAO
                                            });
                                            tabsDivT();
                                        });
                                }
                                else {
                                    tabsDivT();
                                }

                                if (e.scroll)
                                    $('html, body').scrollTop($this.offset().top);
                                $(document).trigger({
                                    'type': 'tabs.showtabs',
                                    'el': $thisAO
                                });
                                if (cookie) {
                                    setCookie($thiss.data('cookie') === undefined ? 'cookie' + index : $thiss.data('cookie'), $this.data('href'), 0, '/');
                                }
                                var wLH = window.location.hash,
                                        i = 0;
                                _.map(regRefs[index], function(n, j) {
                                    _.map(methods.hashs[0], function(m, j) {
                                        if (m == n)
                                            i++;
                                    });
                                });
                                if (attrOrdata[index] !== 'data' || i > 0 || cookie) {
                                    if (!condStart) {
                                        var temp = wLH;
                                        if (!toggle) {
                                            if ($thisAOld !== undefined) {
                                                if (wLH.indexOf($thisAOld) !== -1) {
                                                    temp = temp.replace($thisAOld, $thisA);
                                                }
                                                else if ($thisA !== $thisAOld && wLH.indexOf($thisA) === -1) {
                                                    temp += $thisA;
                                                }
                                            }
                                            else if (wLH.indexOf($thisA) === -1) {
                                                temp += $thisA;
                                            }
                                        }
                                        else {
                                            temp = temp.replace($thisAOld, $thisA);
                                        }
                                        window.location.hash = temp;
                                    }
                                    else if (k) {
                                        window.location.hash = _.uniq(methods.hashs[0]).join('');
                                        k = false;
                                    }
                                }
                                if ($thiss.data('elchange') !== undefined) {
                                    refs[index].each(function() {
                                        var $thisDH = $(this).data('href');
                                        if ($thisDH === $thisA)
                                            $($thiss.data('elchange')).addClass($thisA);
                                        else
                                            $($thiss.data('elchange')).removeClass($thisDH);
                                    });
                                }
                            }
                            return false;
                        }
                    });
                    if (thisL - 1 === index)
                        methods.location(regRefs, refs);
                });
                wnd.off('hashchange.tabs').on('hashchange.tabs', function(e) {
                    e.preventDefault();
                    _.map(location.hash.split('#'), function(i, n) {
                        if (i !== '') {
                            var el = $('[data-href="#' + i + '"], [href="#' + i + '"]');
                            if (!$.existsN(el.closest('[data-type="toggle"]'))) {
                                if (!el.parent().hasClass(aC))
                                    el.trigger('click.tabs');
                            }
                        }
                    });
                });
            }
            return $this;
        },
        location: function(regrefs, refs) {
            var hashs1 = [],
                    hashs2 = [];
            if (location.hash === '')
            {
                var i = 0,
                        j = 0;
                _.map(refs, function(n, i) {
                    var $this = n.first(),
                            attrOrdataL = $this.attr('href') !== undefined ? 'attr' : 'data';
                    if (attrOrdataL !== 'data') {
                        hashs1[i] = $this[attrOrdataL]('href');
                        i++;
                    }
                    else if (attrOrdataL === 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                });
                var hashs = [hashs1, hashs2];
            }
            else {
                _.map(refs, function(n, i) {
                    var j = 0,
                            $this = n.first(),
                            attrOrdataL = $this.attr('href') !== undefined ? 'attr' : 'data';
                    if (attrOrdataL === 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                });
                var t = location.hash,
                        s = '#',
                        m = s.length, res = 0,
                        i = 0, pos = [];
                while (i < t.length - 1)
                {
                    var ch = t.substr(i, m);
                    if (ch === s) {
                        res += 1;
                        i = i + m;
                        pos[res - 1] = t.indexOf(s, i - m);
                    } else
                        i++;
                }
                i = 0;
                while (i < pos.length) {
                    hashs1[i] = t.substring(pos[i], pos[i + 1]);
                    i++;
                }
                var hashs = [hashs1, hashs2];
            }
            methods.hashs = hashs;
            methods.startCheck(regrefs, methods.hashs);
        },
        startCheck: function(regrefs, hashs) {
            var hash = hashs[0].concat(hashs[1]),
                    regrefsL = regrefs.length,
                    sim = 0;
            $.map(regrefs, function(n, k) {
                var i = 0,
                        hashs2 = [].concat(hash);
                $.map(hash, function(n, j) {
                    if ($.inArray(n, regrefs[k]) >= 0)
                        i++;
                    if ($.inArray(n, regrefs[k]) >= 0 && i > 1) {
                        hashs2.splice(hashs2.indexOf(n), 1);
                    }
                });
                if (hashs2.join() === hash.join())
                    sim++;
                if (hashs2.join() !== hash.join() || sim === regrefsL)
                    $.map(hashs2, function(n, i) {
                        var attrOrdataNew = "";
                        $('[href=' + n + ']').length === 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                        if ($.inArray(n, hashs[0]) === -1 && $.existsN($('[' + attrOrdataNew + '=' + n + ']').parent().siblings('.' + aC))) {
                            $('[' + attrOrdataNew + '=' + n + ']').parent().siblings('.' + aC).children().trigger({
                                'type': 'click.tabs',
                                'start': true
                            });
                        }
                        else {
                            $('[' + attrOrdataNew + '=' + n + ']').trigger({
                                'type': 'click.tabs',
                                'start': true
                            });
                        }
                    });
            });
        }
    };
    $.fn.tabs = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.tabs');
        }
    };
    $.tabs = function(m) {
        return methods[m];
    };
})(jQuery);
/*/plugin tabs end*/
/*plugin drop*/
(function($) {
    var methods = {
        init: function(options) {
            this.each(function() {
                var el = $(this).drop('destroy'),
                        trigger = methods._checkProp(el.data(), options, 'trigger'),
                        triggerOn = methods._checkProp(el.data(), options, 'triggerOn'),
                        triggerOff = methods._checkProp(el.data(), options, 'triggerOff');
                methods._modalTrigger($.extend({}, options, el.data()));
                var rel = this.rel;
                if (rel !== undefined && rel !== '') {
                    rel = rel.replace(methods._reg(), '');
                    var source = el.data('source') || el.attr('href');
                    if (source !== undefined) {
                        if (!$.drop.dP.galleries[rel])
                            $.drop.dP.galleries[rel] = new Array();
                        $.drop.dP.galleries[rel].push(source);
                    }
                }

                el.data({
                    'drp': options
                });
                var href = el.data('href') || el.attr('href');
                if (href && window.location.hash.indexOf(href) !== -1 && !$.drop.dP.hrefs[href])
                    methods.open(options, undefined, el, undefined);
                if (/#/.test(href) && !$.drop.dP.hrefs[href])
                    $.drop.dP.hrefs[href] = el;

                if (triggerOn && triggerOff)
                    el.attr('trigger-on', triggerOn).attr('trigger-off', triggerOff).addClass('isDrop').on(triggerOn + '.' + $.drop.nS + ' ' + triggerOff + '.' + $.drop.nS, function(e) {
                        e.stopPropagation();
                        e.preventDefault();
                    }).on(triggerOn + '.' + $.drop.nS, function(e) {
                        methods.open(options, undefined, $(this), e);
                    }).on(triggerOff + '.' + $.drop.nS, function(e) {
                        methods.close($(el.attr('data-drop')));
                    });
                else
                    el.attr('trigger', trigger).addClass('isDrop').on(trigger + '.' + $.drop.nS, function(e) {
                        if (el.parent().hasClass(aC))
                            methods.close($(el.attr('data-drop')));
                        else
                            methods.open(options, undefined, $(this), e);

                        e.stopPropagation();
                        e.preventDefault();
                    });
            });
            for (var i in $.drop.dP.galleries)
                if ($.drop.dP.galleries[i].length <= 1)
                    delete $.drop.dP.galleries[i];
            return $(this);
        },
        destroy: function(el, trigger) {
            el = el ? el : this;
            el.each(function() {
                var el = $(this);
                if (trigger === undefined)
                    trigger = el.attr('trigger');
                el.removeAttr('trigger').removeData('trigger').removeData('drp').removeClass('isDrop').off(trigger + '.' + $.drop.nS);
                var drop = $(el.attr('data-drop'));
                drop.removeData('drp');
            });
            return el;
        },
        get: function(el, set, e, hashChange) {
            if (!el)
                el = this;
            if (!set)
                set = el.data('drp');
            var elSet = el.data(),
                    source = methods._checkProp(elSet, set, 'source') || el.attr('href'),
                    always = methods._checkProp(elSet, set, 'always'),
                    modal = methods._checkProp(elSet, set, 'modal'),
                    type = methods._checkProp(elSet, set, 'type'),
                    datas = methods._checkProp(elSet, set, 'datas');
            var rel = null;
            if (el.get(0).rel !== undefined)
                rel = el.get(0).rel.replace(methods._reg(), '');

            function _update(data) {
                $.drop.hideActivity();
                if (!always && !modal)
                    $.drop.dP.drops[source.replace(methods._reg(), '')] = data;

                var drop = methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), methods._checkProp(elSet, set, 'pattern'), $.drop.dP.curDefault, rel);
                drop.attr('pattern', 'yes');
                drop.find($(methods._checkProp(elSet, set, 'placePaste')).add($($.drop.dPP.placePaste))).html(data);
                methods._show(el, e, set, data, hashChange);
            }

            if ($.drop.dP.drops[source.replace(methods._reg(), '')]) {
                methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), $.drop.dP.drops[source.replace(methods._reg(), '')], undefined, rel);
                methods._show(el, e, set, false, hashChange);
                return el;
            }

            if (elSet.drop !== undefined) {
                $.ajax({
                    type: type,
                    data: datas,
                    url: source,
                    beforeSend: function() {
                        if (!methods._checkProp(elSet, set, 'moreOne'))
                            methods._closeMoreOne(el);

                        $.drop.showActivity();
                    },
                    dataType: modal ? 'json' : 'html',
                    success: function(data) {
                        $.drop.hideActivity();
                        if (!always && !modal)
                            $.drop.dP.drops[source.replace(methods._reg(), '')] = data;

                        if (modal) {
                            methods._pasteModal(el, data, set, rel, hashChange);
                        }
                        else {
                            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), data, undefined, rel);
                            var drop = $(elSet.drop);
                            $(document).trigger({
                                type: 'successHtml.' + $.drop.nS,
                                el: drop,
                                datas: data
                            });
                            methods._show(el, e, set, data, hashChange);
                        }
                    }
                });
            }
            else {
                $.drop.dP.curDefault = $.drop.dP.defaultClassBtnDrop + (rel ? rel : (source ? source.replace(methods._reg(), '') : (new Date()).getTime()));
                el.data('drop', '.' + $.drop.dP.curDefault).attr('data-drop', '.' + $.drop.dP.curDefault);

                $.drop.showActivity();
                if (source.match(/jpg|gif|png|bmp|jpeg/))
                    $('<img src="' + source + '" style="max-height: 100%;"/>').load(function() {
                        _update($(this));
                    });
                else
                    $.ajax({
                        type: type,
                        url: source,
                        data: datas,
                        dataType: 'html',
                        success: function(data) {
                            _update(data);
                        }
                    });
            }
            return el;
        },
        open: function(opt, datas, $this, e, hashChange) {
            e = e ? e : window.event;
            if (!$this) {
                if ($(this).hasClass('isDrop'))
                    $this = this;
                else {
                    if (datas) {
                        if (!$.exists('[data-drop="' + $.drop.dP.modalBtnDrop + '"]')) {
                            $this = $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', $.drop.dP.modalBtnDrop).data({
                                'drop': $.drop.dP.modalBtnDrop,
                                'modal': true
                            });
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, $this.data()), $.drop.dP.patternNotif);
                        }
                        else
                            $this = $('[data-drop="' + $.drop.dP.modalBtnDrop + '"]');
                    }
                    else {
                        var sourcePref = opt.source.replace(methods._reg(), '');

                        if (!$.exists('.refer' + $.drop.dP.defaultClassBtnDrop + sourcePref)) {
                            $this = $('<div><button class="refer' + ($.drop.dP.defaultClassBtnDrop + sourcePref) + '"></button></div>').appendTo(body).hide().children();
                        }
                        else
                            $this = $('.refer' + $.drop.dP.defaultClassBtnDrop + sourcePref);
                    }
                }
            }
            $this.each(function() {
                var $this = $(this),
                        elSet = $this.data(),
                        moreOne = methods._checkProp(elSet, opt, 'moreOne'),
                        confirmBtnDrop = methods._checkProp(elSet, opt, 'confirmBtnDrop'),
                        promptBtnDrop = methods._checkProp(elSet, opt, 'promptBtnDrop'),
                        source = methods._checkProp(elSet, opt, 'source') || $this.attr('href'),
                        drop = $(elSet.drop),
                        start = elSet.start;
                elSet.source = source;
                function _confirmF() {
                    if (!$.existsN(drop) || modal || always) {
                        if (datas !== undefined && modal)
                            methods._pasteModal($this, datas, opt, undefined, hashChange);
                        else
                            methods.get($this, opt, e, hashChange);
                    }
                    else
                        methods._show($this, e, opt, false, hashChange);
                }

                if (!$this.parent().hasClass(aC)) {
                    if (!moreOne && !start)
                        methods._closeMoreOne($this);

                    if (!$this.is(':disabled')) {
                        var modal = methods._checkProp(elSet, opt, 'modal'),
                                confirm = methods._checkProp(elSet, opt, 'confirm'),
                                prompt = methods._checkProp(elSet, opt, 'prompt'),
                                always = methods._checkProp(elSet, opt, 'always');
                        if (start && !eval(start)($this, drop))
                            return false;

                        if ($.existsN(drop) && !modal && !always && !confirm && !prompt) {
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, elSet), drop);
                            methods._show($this, e, opt, false, hashChange);
                        }
                        else if (prompt || source || always || confirm || datas !== undefined) {
                            if (!confirm && !prompt)
                                _confirmF();
                            else {//for cofirm && prompt
                                if (confirm) {
                                    var confirmPattern = methods._checkProp(elSet, opt, 'patternConfirm');
                                    if (!$.exists('[data-drop="' + confirmBtnDrop + '"]'))
                                        $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', confirmBtnDrop).data({
                                            'drop': confirmBtnDrop,
                                            'confirm': true
                                        });
                                    if (!$.exists(confirmBtnDrop))
                                        methods._pasteDrop($.extend({}, $.drop.dP, opt, $('[data-drop="' + confirmBtnDrop + '"]').data()), confirmPattern);
                                    else
                                        methods._pasteDrop($.extend({}, $.drop.dP, opt, $('[data-drop="' + confirmBtnDrop + '"]').data()), $(confirmBtnDrop));

                                    methods._show($('[data-drop="' + confirmBtnDrop + '"]'), e, opt, false, hashChange);
                                    $(methods._checkProp(elSet, opt, 'confirmActionBtn')).focus().off('click.' + $.drop.nS).on('click.' + $.drop.nS, function() {
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
                                    var promptPattern = methods._checkProp(elSet, opt, 'patternPrompt');
                                    if (!$.exists('[data-drop="' + promptBtnDrop + '"]'))
                                        $('<div><button></button></div>').appendTo(body).hide().children().attr('data-drop', promptBtnDrop).data({
                                            'drop': promptBtnDrop,
                                            'prompt': true,
                                            'promptInputValue': methods._checkProp(elSet, opt, 'promptInputValue')
                                        });
                                    if (!$.exists(promptBtnDrop))
                                        methods._pasteDrop($.extend({}, $.drop.dP, opt, $('[data-drop="' + promptBtnDrop + '"]').data()), promptPattern);
                                    else
                                        methods._pasteDrop($.extend({}, $.drop.dP, opt, $('[data-drop="' + promptBtnDrop + '"]').data()), $(promptBtnDrop));

                                    methods._show($('[data-drop="' + promptBtnDrop + '"]'), e, opt, false, hashChange);
                                    $(methods._checkProp(elSet, opt, 'promptActionBtn')).focus().off('click.' + $.drop.nS).on('click.' + $.drop.nS, function() {
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
                        }
                        else //for validations
                            methods._pasteModal($this, $this.data('datas'), opt, undefined, hashChange);
                    }
                }
                else
                    methods.close($($this.data('drop')));
            });
            return $this;
        },
        close: function(sel, hashChange, f) {
            if (!sel)
                sel = this.self ? this.self : this;
            var drop = sel instanceof jQuery ? sel : $('[data-elrun].' + aC);

            if ((drop instanceof jQuery) && $.existsN(drop)) {
                clearTimeout($.drop.dP.closeDropTime);
                drop.each(function() {
                    var drop = $(this),
                            set = drop.data('drp');
                    if (set && drop.is(':visible') && (set.modal || sel || set.place !== 'inherit' || set.inheritClose)) {
                        var $thisB = set.elrun;
                        if ($thisB !== undefined) {
                            var $thisEOff = set.effectOff,
                                    durOff = set.durationOff;
                            if (set.scroll) {
                                methods._checkMethod(function() {
                                    methods.scroll.remove();
                                });
                            }
                            function _hide() {
                                $thisB.parent().removeClass(aC);
                                var $thisHref = $thisB.data('href');

                                if ($thisHref) {
                                    clearTimeout($.drop.dP.curHashTimeout);
                                    $.drop.dP.curHash = hashChange ? $thisHref : null;

                                    var wLH = location.hash;
                                    location.hash = wLH.replace($thisHref, '');

                                    $.drop.dP.curHashTimeout = setTimeout(function() {
                                        $.drop.dP.curHash = null;
                                    }, 400);
                                }

                                drop.removeClass(aC);

                                methods.placeAfterClose(drop, $thisB, set);

                                if (set.forCenter)
                                    set.forCenter.stop(true, false).fadeOut(durOff);
                                drop[$thisEOff](durOff, function() {
                                    if (set.dropOver && !f)
                                        set.dropOver.fadeOut(durOff);

                                    var $this = methods._resetStyleDrop($(this));

                                    $this.removeClass(set.place);
                                    if (set.closed !== undefined)
                                        set.closed($thisB, $this);
                                    if (set.elClosed !== undefined)
                                        eval(set.elClosed)($thisB, $this);
                                    if (isTouch)
                                        set.dropOver.off('touchmove.' + $.drop.nS);
                                    $this.add($(document)).trigger({
                                        type: 'closed.' + $.drop.nS,
                                        el: $thisB,
                                        drop: $this
                                    });
                                    var dC = $this.find($($this.data('drp').dropContent).add($($.drop.dPP.dropContent))).data('jsp');
                                    if (dC)
                                        dC.destroy();
                                    if (f)
                                        f();
                                });
                            }
                            drop.add($(document)).trigger({
                                type: 'close.' + $.drop.nS,
                                el: $thisB,
                                drop: drop
                            });
                            var close = set.elClose !== undefined ? set.elClose : set.close;
                            if (close !== undefined) {
                                if (typeof close === 'string')
                                    var res = eval(close)($thisB, $(this));
                                else
                                    var res = close($thisB, $(this));
                                if (res === false && res !== true) {
                                    if (window.console)
                                        console.log(res);
                                }
                                else
                                    _hide();
                            }
                            else
                                _hide();
                       }
                    }
                });
            }
            return sel;
        },
        center: function(drop, start) {
            if (drop === undefined)
                drop = this.self ? this.self : this;
            drop.each(function() {
                var drop = $(this);
                if (drop.data('drp') && !drop.data('drp').droppableIn) {
                    var method = drop.data('drp').animate && !start ? 'animate' : 'css',
                            dropV = drop.is(':visible'),
                            w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                            h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                            top = (body.height() - h) / 2,
                            left = (body.width() - w) / 2;
                    drop[method]({
                        'top': (top > 0 ? top : 0) + (!drop.data('drp').scroll ? wnd.scrollTop() : 0),
                        'left': (left > 0 ? left : 0) + (!drop.data('drp').scroll ? wnd.scrollLeft() : 0)
                    }, {
                        duration: drop.data('drp').durationOn,
                        queue: false
                    });
                }
            });
            return drop;
        },
        _resetStyleDrop: function(drop) {
            return drop.css({
                'width': '',
                'height': '',
                'top': '',
                'left': '',
                'bottom': '',
                'right': '',
                'position': ''
            });
        },
        _checkFloat: function() {
            for (var i = 0, temp = false; i < arguments.length; i++)
                temp = temp || (arguments[i] !== undefined && arguments[i] !== null ? arguments[i].toString() : arguments[i]);
            return +temp;
        },
        _checkProp: function(elSet, opt, prop) {
            var optP = undefined;
            try {
                optP = opt[prop];
            } catch (err) {
            }
            if ($.drop.dP[prop] !== undefined && $.drop.dP[prop] !== null && ($.drop.dP[prop].toString().toLowerCase() === 'false' || $.drop.dP[prop].toString().toLowerCase() === 'true'))
                return (/^true$/i).test(elSet[prop] !== undefined && elSet[prop] !== null ? elSet[prop].toString().toLowerCase() : elSet[prop]) || (/^true$/i).test(optP !== undefined && optP !== null ? optP.toString().toLowerCase() : optP) || $.drop.dP[prop];
            else
                return elSet[prop] || optP || $.drop.dP[prop];
        },
        _closeMoreOne: function($this) {
            if ($.existsN($this.closest('[data-elrun]')) && !$this.data('modal'))
                methods.close($this.closest('[data-elrun]'));
            if ($.exists('[data-elrun].center:visible, [data-elrun].noinherit:visible'))
                methods.close($('[data-elrun].center:visible, [data-elrun].noinherit:visible'));
        },
        _modalTrigger: function(opt) {
            $(document).off('successJson.' + $.drop.nS).on('successJson.' + $.drop.nS, function(e) {
                if (e.datas) {
                    if (e.datas.answer === "success")
                        e.el.find(opt.modalPlace || $.drop.dP.modalPlace + ',' + $.drop.dPP.modalPlace).empty().append((opt.message || $.drop.dP.message).success(e.datas.data));
                    else if (e.datas.answer === "error")
                        e.el.find(opt.modalPlace || $.drop.dP.modalPlace + ',' + $.drop.dPP.modalPlace).empty().append((opt.message || $.drop.dP.message).error(e.datas.data));
                    else
                        e.el.find(opt.modalPlace || $.drop.dP.modalPlace + ',' + $.drop.dPP.modalPlace).empty().append((opt.message || $.drop.dP.message).info(e.datas.data));
                }
            });
        },
        _pasteModal: function(el, data, set, rel, hashChange) {
            var elSet = el.data(),
                    drop = $(elSet.drop);
            methods._modalTrigger($.extend({}, set, elSet));
            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), drop, undefined, rel);
            $(document).trigger({
                type: 'successJson.' + $.drop.nS,
                el: drop,
                datas: data
            });
            methods._show(el, undefined, set, data, hashChange);
        },
        _reg: function() {
            return /[^a-zA-Z0-9]+/ig;
        },
        _pasteDrop: function(set, drop, addClass, rel) {
            if (drop instanceof jQuery && drop.attr('pattern'))
                drop.find(drop.data('drp').placePaste).empty().append($.drop.dP.drops[set.source.replace(methods._reg(), '')]);

            addClass = addClass ? addClass : '';
            rel = rel ? rel : '';

            if (set.place === 'inherit') {
                if (set.placeInherit)
                    drop = $(drop).appendTo($(set.placeInherit).empty());
            }
            else {
                function _for_center(rel) {
                    body.append('<div class="forCenter" data-rel="' + rel + '" style="left: 0;top:0;width: 100%;dispaly:none;overflow: auto;overflow-x: hidden;position: absolute;"></div>');
                }
                if (set.place === 'noinherit')
                    drop = $(drop).appendTo(body);
                else {
                    var sel = '[data-rel="' + set.drop + '"].forCenter';
                    if (!$.exists(sel)) {
                        _for_center(set.drop);
                    }
                    var forCenter = $(sel).empty();
                    drop = $(drop).appendTo(forCenter);
                }
            }
            return (set.drop ? (set.drop.indexOf($.drop.dP.defaultClassBtnDrop) ? drop : drop.filter($.drop.dP.defaultClassBtnDrop)) : drop).addClass(addClass).attr('data-rel', rel).attr('data-elrun', set.drop);
        },
        _pasteContent: function($this, drop, contentHeader, dropHeader, contentContent, dropContent, contentFooter, dropFooter) {
            if (contentFooter) {
                var footer = drop.find($(dropFooter).add($($.drop.dPP.dropFooter)));
                if (typeof contentFooter === 'string' || typeof contentFooter === 'object')
                    footer.empty().append(contentFooter);
                else if (typeof contentFooter === 'function')
                    contentFooter(footer, $this, drop);
            }
            if (contentHeader) {
                var header = drop.find($(dropHeader).add($($.drop.dPP.dropHeader)));
                if (typeof contentHeader === 'string' || typeof contentHeader === 'object')
                    header.empty().append(contentHeader);
                else if (typeof contentHeader === 'function')
                    contentHeader(header, $this, drop);
            }
            if (contentContent) {
                var content = drop.find($(dropContent).add($($.drop.dPP.dropContent)));
                if (typeof contentContent === 'string' || typeof contentContent === 'object')
                    content.empty().append(contentContent);
                else if (typeof contentContent === 'function')
                    contentContent(content, $this, drop);
            }
        },
        _show: function($this, e, set, data, hashChange) {
            if ($this === undefined)
                $this = this;
            if (e === undefined)
                e = window.event;
            var elSet = $this.data(),
                    self = $this.get(0);
            set = $.extend({}, $.drop.dP, set ? set : elSet.drp);

            var rel = null;
            if (self.rel !== undefined)
                rel = self.rel.replace(methods._reg(), '');

            var
                    //float
                    $thisD = methods._checkFloat(elSet.durationOn, set.durationOn),
                    $thisDOff = methods._checkFloat(elSet.durationOff, set.durationOff),
                    overlayOpacity = methods._checkFloat(elSet.overlayOpacity, set.overlayOpacity),
                    timeclosemodal = methods._checkFloat(elSet.timeclosemodal, set.timeclosemodal),
                    //string
                    exit = elSet.exit || set.exit,
                    trigger = elSet.trigger || set.trigger,
                    triggerOn = elSet.triggerOn || set.triggerOn,
                    triggerOff = elSet.triggerOff || set.triggerOff,
                    place = elSet.place || set.place,
                    placement = elSet.placement || set.placement,
                    $thisEOff = elSet.effectOff || set.effectOff,
                    $thisEOn = elSet.effectOn || set.effectOn,
                    overlayColor = elSet.overlayColor || set.overlayColor,
                    position = elSet.position || set.position,
                    placeBeforeShow = elSet.placeBeforeShow || set.placeBeforeShow,
                    placeAfterClose = elSet.placeAfterClose || set.placeAfterClose,
                    next = elSet.next || set.next,
                    prev = elSet.prev || set.prev,
                    source = elSet.source || set.source || $this.attr('href'),
                    selSource = elSet.drop,
                    dropContent = elSet.dropContent || set.dropContent,
                    dropHeader = elSet.dropHeader || set.dropHeader,
                    dropFooter = elSet.dropFooter || set.dropFooter,
                    placePaste = elSet.placePaste || set.placePaste || $.drop.dPP.placePaste,
                    placeInherit = elSet.placeInherit || set.placeInherit,
                    dropFilter = elSet.dropFilter || set.dropFilter,
                    type = elSet.type || set.type,
                    //function || object || string
                    contentHeader = elSet.contentHeader !== undefined ? elSet.contentHeader.toString() : (set.contentHeader !== undefined ? set.contentHeader : false),
                    contentContent = elSet.contentContent !== undefined ? elSet.contentContent.toString() : (set.contentContent !== undefined ? set.contentContent : false),
                    contentFooter = elSet.contentFooter !== undefined ? elSet.contentFooter.toString() : (set.contentFooter !== undefined ? set.contentFooter : false),
                    //boolean
                    scrollCenter = methods._checkProp(elSet, set, 'scrollCenter'),
                    modal = methods._checkProp(elSet, set, 'modal'),
                    confirm = methods._checkProp(elSet, set, 'confirm'),
                    prompt = methods._checkProp(elSet, set, 'prompt'),
                    promptInputValue = methods._checkProp(elSet, set, 'promptInputValue'),
                    always = methods._checkProp(elSet, set, 'always'),
                    $thisA = methods._checkProp(elSet, set, 'animate'),
                    moreOne = methods._checkProp(elSet, set, 'moreOne'),
                    closeClick = methods._checkProp(elSet, set, 'closeClick'),
                    closeEsc = methods._checkProp(elSet, set, 'closeEsc'),
                    droppable = methods._checkProp(elSet, set, 'droppable'),
                    cycle = methods._checkProp(elSet, set, 'cycle'),
                    scroll = methods._checkProp(elSet, set, 'scroll'),
                    limitSize = methods._checkProp(elSet, set, 'limitSize'),
                    limitContentSize = methods._checkProp(elSet, set, 'limitContentSize'),
                    scrollContent = methods._checkProp(elSet, set, 'scrollContent'),
                    inheritClose = methods._checkProp(elSet, set, 'inheritClose'),
                    droppableLimit = methods._checkProp(elSet, set, 'droppableLimit'),
                    keyNavigate = methods._checkProp(elSet, set, 'keyNavigate'),
                    dataPrompt = elSet.dataPrompt,
                    //function
                    //string
                    start = elSet.start,
                    elBefore = elSet.before,
                    elAfter = elSet.after,
                    elClose = elSet.close,
                    elClosed = elSet.closed,
                    //object of function
                    before = set.before,
                    after = set.after,
                    close = set.close,
                    closed = set.closed,
                    drop = $('[data-elrun="' + selSource + '"]');

            if (dropFilter)
                drop = methods._filterSource($this, dropFilter);
            $this.attr({
                'data-drop': selSource
            }).parent().addClass(aC);
            $.drop.dP.durationOff = $thisDOff;
            $.drop.dP.durationOn = $thisD;
            var drp = drop.data('drp') ? drop.data('drp') : {};
            drop.data({
                'drp': $.extend(drp, {
                    'exit': exit,
                    'trigger': trigger,
                    'triggerOn': triggerOn,
                    'triggerOff': triggerOff,
                    'effectOn': $thisEOn,
                    'position': position,
                    'placeBeforeShow': placeBeforeShow,
                    'placeAfterClose': placeAfterClose,
                    'effectOff': $thisEOff,
                    'elrun': $this,
                    'place': place,
                    'placement': placement,
                    'durationOn': $thisD,
                    'durationOff': $thisDOff,
                    'dropContent': dropContent,
                    'dropHeader': dropHeader,
                    'dropFooter': dropFooter,
                    'animate': $thisA,
                    'start': start,
                    'before': before,
                    'after': after,
                    'elBefore': elBefore,
                    'elAfter': elAfter,
                    'close': close,
                    'elClose': elClose,
                    'closed': closed,
                    'elClosed': elClosed,
                    'overlayOpacity': overlayOpacity,
                    'overlayColor': overlayColor,
                    'modal': modal,
                    'confirm': confirm,
                    'prompt': prompt,
                    'promptInputValue': promptInputValue,
                    'timeclosemodal': timeclosemodal,
                    'moreOne': moreOne,
                    'closeClick': closeClick,
                    'closeEsc': closeEsc,
                    'droppable': droppable,
                    'source': source,
                    'prev': prev,
                    'next': next,
                    'type': type,
                    'cycle': cycle,
                    'always': always,
                    'droppableIn': false,
                    'contentHeader': contentHeader,
                    'contentContent': contentContent,
                    'contentFooter': contentFooter,
                    'scroll': scroll,
                    'placePaste': placePaste,
                    'limitSize': limitSize,
                    'limitContentSize': limitContentSize,
                    'scrollContent': scrollContent,
                    'inheritClose': inheritClose,
                    'placeInherit': placeInherit,
                    'scrollCenter': scrollCenter,
                    'droppableLimit': droppableLimit,
                    'keyNavigate': keyNavigate,
                    'dropFilter': dropFilter,
                    'dataPrompt': dataPrompt,
                    'methods': $.extend({
                        'self': drop,
                        'elrun': $this
                    }, $.drop.methods())
                })
            });
            drop.attr('data-elrun', selSource).off('click.' + $.drop.nS, exit).on('click.' + $.drop.nS, exit, function() {
                methods.close($(this).closest('[data-elrun]'));
            });
            methods._checkMethod(function() {
                methods.galleries($this, set, methods);
            });
            var overlays = $('.overlayDrop').css('z-index', 1103),
                    condOverlay = overlayOpacity !== 0;
            if (condOverlay) {
                if (!$.exists('[data-rel="' + selSource + '"].overlayDrop')) {
                    body.append('<div class="overlayDrop" data-rel="' + selSource + '" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;"></div>');
                }
                drop.data('drp').dropOver = $('[data-rel="' + selSource + '"].overlayDrop');
                drop.data('drp').dropOver.css({
                    'background-color': overlayColor,
                    'opacity': overlayOpacity,
                    'z-index': overlays.length + 1103
                });
            }
            $('.forCenter').css('z-index', 1104);
            var forCenter = $('[data-rel="' + selSource + '"].forCenter');
            if (forCenter) {
                drop.data('drp').forCenter = forCenter;
                forCenter.add(drop).css('z-index', overlays.length + 1104);
                forCenter.css('height', function() {
                    return scroll ? '100%' : $(document).height();
                });
            }
            methods._pasteContent($this, drop, contentHeader, dropHeader, contentContent, dropContent, contentFooter, dropFooter);
            before($this, drop, data);
            if (elBefore !== undefined)
                eval(elBefore)($this, drop, data);
            drop.add($(document)).trigger({
                'type': 'before.' + $.drop.nS,
                'el': $this,
                'drop': drop,
                'datas': data
            });
            var ev = (selSource ? selSource : '').replace(methods._reg(), '');
            wnd.off('resize.' + $.drop.nS + ev).on('resize.' + $.drop.nS + ev, function() {
                methods._checkMethod(function() {
                    methods.limitSize(drop);
                });
                methods._checkMethod(function() {
                    methods.heightContent(drop);
                });
                if (place !== 'inherit')
                    methods[place](drop);
            });
            if (condOverlay) {
                drop.data('drp').dropOver.stop().fadeIn($thisD / 2);

                if (closeClick)
                    drop.data('drp').dropOver.add(forCenter).off('click.' + $.drop.nS).on('click.' + $.drop.nS, function(e) {
                        e.stopPropagation();
                        if ($(e.target).is(drop.data('drp').dropOver) || $(e.target).is('.forCenter')) {
                            methods.close($($(e.target).attr('data-rel')));
                        }
                    });
                if (isTouch)
                    drop.data('drp').dropOver.on('touchmove.' + $.drop.nS, function(e) {
                        return false;
                    });
            }
            drop.addClass(place);
            methods._positionType(drop);
            methods._checkMethod(function() {
                methods.limitSize(drop);
            });
            methods._checkMethod(function() {
                methods.heightContent(drop);
            });

            if (forCenter) {
                forCenter.fadeIn($thisD);
            }
            if (forCenter) {
                forCenter.css('top', function() {
                    return scroll ? wnd.scrollTop() : 0;
                });
            }
            if (condOverlay && scroll) {
                methods._checkMethod(function() {
                    methods.scroll.create();
                });
            }

            methods.placeBeforeShow(drop, $this, methods, place, placeBeforeShow);

            var href = $this.data('href');
            if (href) {
                clearTimeout($.drop.dP.curHashTimeout);
                $.drop.dP.curHash = !hashChange ? href : null;

                var wlh = window.location.hash;
                if (href.indexOf('#') !== -1 && (new RegExp(href + '#|' + href + '$').exec(wlh) === null))
                    window.location.hash = wlh + href;

                $.drop.dP.curHashTimeout = setTimeout(function() {
                    $.drop.dP.curHash = null;
                }, 400);
            }
            if (place !== 'inherit')
                methods._checkMethod(function() {
                    methods[place](drop);
                });
            if (prompt) {
                drop.find($.drop.dP.promptInput).focus().val(promptInputValue);
                drop.find('form').off('submit.' + $.drop.nS).on('submit.' + $.drop.nS, function(e) {
                    e.preventDefault();
                });
            }
            $(next).add($(prev)).css('height', drop.actual('height'));

            drop[$thisEOn]($thisD, function(e) {
                var drop = $(this),
                        drp = drop.data('drp');
                $.drop.dP.curDrop = drop;
                if ($.existsN(drop.find('[data-drop]')))
                    methods.init.call(drop.find('[data-drop]'));
                drop.addClass(aC);
                if (modal && timeclosemodal)
                    $.drop.dP.closeDropTime = setTimeout(function() {
                        methods.close(drop);
                    }, timeclosemodal);
                var cB = elAfter;
                if (cB !== undefined) {
                    eval(cB)($this, drop, data);
                }
                after($this, drop, data);
                drop.add($(document)).trigger({
                    'type': 'after.' + $.drop.nS,
                    'el': $this,
                    'drop': drop,
                    'datas': data
                });
                if (droppable && place !== 'inherit')
                    methods._checkMethod(function() {
                        methods.droppable(drop);
                    });

                if (drp.forCenter) {
                    drp.forCenter.off('scroll.emulateScroll' + $.drop.nS + ev).on('scroll.emulateScroll' + $.drop.nS + ev, function(e) {
                        $('.scrollEmulation').scrollTop($(this).scrollTop());
                    });
                }
                wnd.off('scroll.' + $.drop.nS + ev).on('scroll.' + $.drop.nS + ev, function(e) {
                    if (place === 'center' && scrollCenter) {
                        wnd.on('scroll.' + $.drop.nS, function(e) {
                            methods.center(drop);
                        });
                    }
                });
            });
            body.off('click.' + $.drop.nS + ev).on('click.' + $.drop.nS + ev, function(e) {
                if (closeClick)
                    if (!$.existsN($(e.target).closest('[data-elrun]'))) {
                        methods.close(false);
                    }
                    else
                        return true;
            });
            body.off('keydown.' + $.drop.nS + ev);
            if (closeEsc)
                body.on('keydown.' + $.drop.nS + ev, function(e) {
                    var key = e.keyCode;
                    if (key === 27) {
                        methods.close(false);
                    }
                });
            if (rel && keyNavigate && methods.galleries)
                body.off('keydown.navigate' + $.drop.nS + ev).on('keydown.navigate' + $.drop.nS + ev, function(e) {
                    var key = e.keyCode;
                    if (key === 37)
                        $(prev).trigger('click.' + $.drop.nS);
                    if (key === 39)
                        $(next).trigger('click.' + $.drop.nS);
                });
        },
        _checkMethod: function(f) {
            try {
                f();
            } catch (e) {
                var method = f.toString().match(/\.\S*\(/);
                returnMsg('need connect ' + method[0].substring(1, method[0].length - 1) + ' method');
            }
        },
        _positionType: function(drop) {
            var data = drop.data('drp');
            if (data.place !== 'inherit') {
                drop.css({
                    'position': data.position
                });
            }
        },
        _filterSource: function(btn, s) {
            var source = s.split(').'),
                    regS, regM = '';

            $.each(source, function(i, v) {
                regS = (v[v.length - 1] != ')' ? v + ')' : v).match(/\(.*\)/);
                regM = regS['input'].replace(regS[0], '');
                regS = regS[0].substring(1, regS[0].length - 1);
                btn = btn[regM](regS);
            });
            return btn;
        }
    };
    $.fn.drop = function(method) {
        if (methods[method]) {
            if (!/_/.test(method))
                return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
            else
                $.error('Method ' + method + ' is private on $.drop');
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.drop');
        }
    };
    $.dropInit = function(m) {
        this.nS = 'drop';
        this.method = function(m) {
            if (!/_/.test(m))
                return methods[m];
        };
        this.methods = function() {
            var newM = {};
            for (var i in methods) {
                if (!/_/.test(i))
                    newM[i] = methods[i];
            }
            return newM;
        };
        this.dPP = {
            dropContent: '.drop-content-default',
            dropHeader: '.drop-header-default',
            dropFooter: '.drop-footer-default',
            placePaste: '.placePaste',
            modalPlace: '.drop-notification-default'
        };
        this.dP = {
            contentHeader: null,
            contentFooter: null,
            contentContent: null,
            start: null,
            placeInherit: null,
            message: {
                success: function(text) {
                    return '<div class = "msg js-msg"><div class = "success"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                error: function(text) {
                    return '<div class = "msg js-msg"><div class = "error"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                info: function(text) {
                    return '<div class = "msg js-msg"><div class = "info"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                }
            },
            trigger: 'click',
            triggerOn: '',
            triggerOff: '',
            exit: '[data-closed = "closed-js"]',
            effectOn: 'fadeIn',
            effectOff: 'fadeOut',
            place: 'center',
            placement: 'top left',
            overlayColor: '#fff',
            position: 'absolute',
            placeBeforeShow: 'center center',
            placeAfterClose: 'center center',
            before: function() {
            },
            after: function() {
            },
            close: function() {
            },
            closed: function() {
            },
            pattern: '<div class="drop drop-style drop-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default"></div><div class="drop-content-default"><button class="drop-prev" type="button"  style="display:none;font-size: 30px;position:absolute;width: 35%;left: 20px;top:0;text-align: left;"><</button><button class="drop-next" type="button" style="display:none;font-size: 30px;position:absolute;width: 35%;right: 20px;top:0;text-align: right;">></button><div class="inside-padd placePaste" style="padding: 20px 40px;text-align: center;"></div></div><div class="drop-footer-default"></div></div>',
            modalBtnDrop: '#drop-notification-default',
            defaultClassBtnDrop: 'drop-default-',
            patternNotif: '<div class="drop drop-style" id="drop-notification-default" style="background-color: #fff;"><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;"></div><div class="drop-content-default"><div class="inside-padd drop-notification-default"></div></div><div class="drop-footer-default"></div></div>',
            confirmBtnDrop: '#drop-confirm-default',
            confirmActionBtn: '[data-button-confirm]',
            patternConfirm: '<div class="drop drop-style" id="drop-confirm-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Confirm</div><div class="drop-content-default"><div class="inside-padd" style="padding: 20px 40px;text-align: center;"><div class="drop-btn-confrim" style="margin-right: 10px;"><button type="button" data-button-confirm><span class="text-el">confirm</span></button></div><div class="drop-btn-cancel"><button type="button" data-closed="closed-js"><span class="text-el">cancel</span></button></div></div></div><div class="drop-footer-default"></div></div>',
            promptBtnDrop: '#drop-prompt-default',
            promptActionBtn: '[data-button-prompt]',
            promptInput: '[name="promptInput"]',
            patternPrompt: '<div class="drop drop-style" id="drop-prompt-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Prompt</div><div class="drop-content-default"><form class="inside-padd" style="padding: 20px 40px;text-align: center;"><input type="text" name="promptInput"/><div class="drop-btn-prompt" style="margin-right: 10px;"><button type="button" data-button-prompt><span class="text-el">ok</span></button></div><div class="drop-btn-cancel"><button type="submit" data-closed="closed-js"><span class="text-el">cancel</span></button></div></form></div><div class="drop-footer-default"></div></div>',
            promptInputValue: '',
            next: '.drop-next',
            prev: '.drop-prev',
            type: 'post',
            overlayOpacity: 0.7,
            durationOn: 200,
            durationOff: 100,
            timeclosemodal: 2000,
            scrollCenter: false,
            modal: false,
            confirm: false,
            prompt: false,
            always: false,
            animate: false,
            moreOne: false,
            closeClick: false,
            closeEsc: false,
            droppable: false,
            cycle: false,
            scroll: false,
            limitSize: false,
            limitContentSize: false,
            scrollContent: false,
            droppableLimit: false,
            inheritClose: false,
            keyNavigate: false,
            hrefs: {},
            drops: {},
            galleries: {},
            curHash: null,
            curHashTimeout: null,
            dropFilter: null
        };
        this.setParameters = function(options) {
            $.extend($.drop.dP, options);
        };
        this.setMethods = function(ms) {
            $.extend(methods, ms);
        };
    };

    var el = $('<div/>').appendTo(body).css({
        'height': 100,
        'width': 100,
        'overflow': 'scroll'
    }).wrap($('<div style="width:0;height:0;overflow:hidden;"></div>'));
    $.dropInit.prototype.widthScroll = el.width() - el.get(0).clientWidth + 1;
    el.parent().remove();

    var loadingTimer, loadingFrame = 1;
    body.append(loading = $('<div id="fancybox-loading"><div></div></div>'));
    var _animate_loading = function() {
        if (!loading.is(':visible')) {
            clearInterval(loadingTimer);
            return;
        }
        $('div', loading).css('top', (loadingFrame * -40) + 'px');
        loadingFrame = (loadingFrame + 1) % 12;
    };
    $.dropInit.prototype.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.dropInit.prototype.hideActivity = function() {
        loading.hide();
    };
    $.drop = new $.dropInit();
    var wLH = window.location.hash;

    wnd.off('hashchange.' + $.drop.nS).on('hashchange.' + $.drop.nS, function(e) {
        e.preventDefault();
        var wLHN = window.location.hash;
        if (!$.drop.dP.curHash) {
            for (var i in $.drop.dP.hrefs) {
                if (wLH.indexOf(i) === -1 && wLHN.indexOf(i) !== -1) {
                    methods.open(undefined, undefined, $.drop.dP.hrefs[i], e, true);
                }
                else
                    methods.close($($.drop.dP.hrefs[i].data('drop')), true);
            }
        }
        wLH = wLHN;
    });
})(jQuery);
/*/plugin drop end*/
/*plugin plusminus*/
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                prev: 'prev',
                next: 'next',
                step: 1,
                checkProdStock: false,
                after: function() {
                },
                before: function() {
                },
                hover: function() {
                }
            }, options);
            if (this.length > 0) {
                return this.each(function() {
                    var $this = $(this),
                            $thisVal = $this.val(),
                            prev = settings.prev.split('.'),
                            next = settings.next.split('.'),
                            checkProdStock = settings.checkProdStock,
                            step = settings.step,
                            max = +$this.data('max'),
                            min = +$this.data('min');
                    function _checkBtn(type) {
                        var btn = $this,
                                regS = '',
                                regM = '';
                        $.each(type, function(i, v) {
                            regS = v.match(/\(.*\)/);
                            if (regS !== null) {
                                regM = regS['input'].replace(regS[0], '');
                                regS = regS[0].substring(1, regS[0].length - 1);
                            }
                            if (regS === null)
                                regM = v;
                            btn = btn[regM](regS);
                        });
                        return btn;
                    }

                    var $thisPrev = _checkBtn(prev),
                            $thisNext = _checkBtn(next);
                    if (max != '' && $thisVal >= max && checkProdStock) {
                        $this.val(max);
                        $thisNext.attr('disabled', 'disabled');
                    }
                    if (min != '' && $thisVal <= min && checkProdStock) {
                        $this.val(min);
                        $thisPrev.attr('disabled', 'disabled');
                    }
                    $thisNext.add($thisPrev).off('hover').hover(function(e) {
                        settings.hover(e, $(this), $this, $(this).is($thisNext) ? 'next' : 'prev');
                    })
                    $thisNext.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisPrev.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseFloat(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input, 'next');
                                var nextVal = +(inputVal + step).toFixed(10);
                                if (isNaN(inputVal))
                                    input.val(min || 1);
                                else
                                    input.val(nextVal);
                                if (nextVal === max && checkProdStock) {
                                    el.attr('disabled', 'disabled');
                                }
                                settings.after(e, el, input, 'next');
                            }
                        }
                    });
                    $thisPrev.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisNext.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseFloat(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input, 'prev');
                                var nextVal = +(inputVal - step).toFixed(10);
                                if (isNaN(inputVal))
                                    input.val(min || 1);
                                else if (inputVal > min || 1) {
                                    input.val(nextVal);
                                    if (nextVal === min && checkProdStock)
                                        el.attr('disabled', 'disabled');
                                }
                                settings.after(e, el, input, 'prev');
                            }
                        }
                    });
                });
            }
        }
    };
    $.fn.plusminus = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.plusminus');
        }
    };
    $.plusminus = function(m) {
        return methods[m];
    };
})($);
/*/plugin plusminus end*/
/*plugin maxminValue*/
(function($) {
    var methods = {
        init: function(e, f) {
            var $this = this,
                    $thisVal = $this.val(),
                    set = $.maxminValue.settings,
                    $max = parseInt($this.attr('data-max'));
            if ($thisVal > $max && set.addCond) {
                $this.val($max);
                if (typeof f === 'function')
                    f();
                return $max;
            }
            else
                return false;
        }
    };
    $.fn.maxminValue = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.maxminValue');
        }
    };
    $.maxminValue = {
        settings: {
            addCond: false
        }
    };
    $.maxminValue = function(m) {
        return methods[m];
    };
    body.off('keypress.max', '[data-max]').on('keypress.max', '[data-max]', function(e) {
        var el = $(this);
        setTimeout(function() {
            var res = el.maxminValue(e);
            el.trigger({
                'type': 'maxminValue',
                'event': e,
                'res': res
            });
        }, 0);
    });
    body.off('keypress', '[data-min]').on('keypress', '[data-min]', function(e) {
        var key = e.keyCode,
                keyChar = parseInt(String.fromCharCode(key));
        var $this = $(this),
                $min = $this.attr('data-min');
        if ($this.val() === "" && keyChar === 0) {
            $this.val($min);
            return false;
        }
    });
    body.off('keyup', '[data-min]').on('keyup', '[data-min]', function(e) {
        var $this = $(this),
                $min = $this.attr('data-min');
        if ($this.val() === "0") {
            $this.val($min);
            $this.trigger({
                'type': 'maxminValue',
                'event': e
            });
            return false;
        }
        else {
            if (e.which != null) {  // IE
                if (e.keyCode == 46 || e.keyCode == 8)
                    $this.trigger({
                        'type': 'maxminValue',
                        'event': e
                    });
            }
            else if (e.which != 0 && e.charCode != 0) { // non IE
                if (e.keyCode == 46 || e.keyCode == 8)
                    $this.trigger({
                        'type': 'maxminValue',
                        'event': e
                    });
            }
        }
    });
})(jQuery);
/*/plugin maxminValue end*/
/*plugin myCarousel use jQarousel with correction behavior prev and next buttons*/
(function($) {
    var methods = {
        init: function(options) {
            if ($.existsN(this)) {
                var $jsCarousel = this,
                        settings = $.extend({
                            item: 'li',
                            prev: '.prev',
                            next: '.next',
                            content: '.c-carousel',
                            groupButtons: '.b-carousel',
                            vCarousel: '.v-carousel',
                            hCarousel: '.h-carousel',
                            adding: {},
                            before: function() {
                            },
                            after: function() {
                            }
                        }, options);
                var item = settings.item,
                        prev = settings.prev,
                        next = settings.next,
                        content = settings.content,
                        groupButtons = settings.groupButtons,
                        hCarousel = settings.hCarousel,
                        vCarousel = settings.vCarousel,
                        addO = settings.adding,
                        nS = 'mycarousel';
                $jsCarousel.each(function() {
                    var $this = $(this);
                    settings.before($this);
                    var m = 'show';
                    if (addO.refresh || $this.hasClass('iscarousel'))
                        m = 'children';
                    var $content = $this.find(content),
                            $items = $content.children()[m]().children(item),
                            $itemL = $items.length,
                            $itemW = $items.outerWidth(true),
                            $itemH = $items.outerHeight(true),
                            $thisPrev = $this.find(prev),
                            $thisNext = $this.find(next),
                            $marginR = $itemW - $items.outerWidth(),
                            $marginB = $itemH - $items.outerHeight(),
                            contW = $content.width(),
                            contH = $content.height(),
                            groupButton = $this.find(groupButtons);
                    var $countV = (contW / $itemW).toFixed(1);
                    var k = false, isVert = $.existsN($this.closest(vCarousel)),
                            isHorz = $.existsN($this.closest(hCarousel)),
                            condH = $itemW * $itemL - $marginR > contW && isHorz,
                            condV = ($itemH * $itemL - $marginB > contH) && isVert;
                    var vertical = condV ? true : false;
                    if (condH || condV)
                        k = true;
                    if (k) {
                        var mainO = {
                            buttonNextHTML: $thisNext,
                            buttonPrevHTML: $thisPrev,
                            visible: $countV,
                            scroll: 1,
                            vertical: vertical,
                            itemVisibleInCallback: function() {
                                wnd.scroll();
                            }
                        };
                        $this.jcarousel($.extend(
                                mainO
                                , addO)).addClass('iscarousel');
                        $thisNext.add($thisPrev).css('display', 'inline-block');
                        groupButton.append($thisNext.add($thisPrev));
                        groupButton.append($thisNext.add($thisPrev));
                        if (isTouch && isHorz) {
                            $this.off('touchstart.' + nS).on('touchstart.' + nS, function(e) {
                                sP = e.originalEvent.touches[0];
                                sP = sP.pageX;
                            });
                            $this.off('touchmove.' + nS).on('touchmove.' + nS, function(e) {
                                e.stopPropagation();
                                e.preventDefault();
                                eP = e.originalEvent.touches[0];
                                eP = eP.pageX;
                            });
                            $this.off('touchend.' + nS).on('touchend.' + nS, function(e) {
                                e.stopPropagation();
                                if (Math.abs(eP - sP) > 200) {
                                    if (eP - sP > 0)
                                        $thisPrev.click();
                                    else
                                        $thisNext.click();
                                }
                            });
                        }
                        if (isTouch && isVert) {
                            $this.off('touchstart.' + nS).on('touchstart.' + nS, function(e) {
                                sP = e.originalEvent.touches[0];
                                sP = sP.pageY;
                            });
                            $this.off('touchmove.' + nS).on('touchmove.' + nS, function(e) {
                                e.stopPropagation();
                                e.preventDefault();
                                eP = e.originalEvent.touches[0];
                                eP = eP.pageY;
                            });
                            $this.off('touchend.' + nS).on('touchend.' + nS, function(e) {
                                e.stopPropagation();
                                if (Math.abs(eP - sP) > 200) {
                                    if (eP - sP > 0)
                                        $thisPrev.click();
                                    else
                                        $thisNext.click();
                                }
                            });
                        }
                    }
                    else {
                        if (isHorz) {
                            $items.parent().css('width', $itemW * $itemL);
                        }
                        if (isVert) {
                            $items.parent().css('height', $itemH * $itemL);
                            $content.css('height', 'auto');
                        }
                        $thisNext.add($thisPrev).hide();
                    }
                    settings.after($this);
                });
            }
            return $jsCarousel;
        }
    };
    $.fn.myCarousel = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.myCarousel');
        }
    };
    $.myCarousel = function(m) {
        return methods[m];
    };
})(jQuery);
/*/plugin myCarousel use jQarousel with correction behavior prev and next buttons end*/