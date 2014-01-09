/*
 *imagecms frontend plugins
 ** @author Domovoj
 * @copyright ImageCMS (c) 2013, Avgustus <domovoj1@gmail.com>
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
String.prototype.pasteSAcomm = function() {
    var r = /\s,/g;
    return this.replace(r, ',');
};
$.exists = function(selector) {
    return ($(selector).length > 0);
};
$.existsN = function(nabir) {
    return (nabir.length > 0);
};
$.getChar = function(e) {
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
$.fn.testNumber = function(add) {
    $(this).off('keypress.testNumber').on('keypress.testNumber', function(e) {
        $this = $(this);
        if (e.ctrlKey || e.altKey || e.metaKey)
            return;
        var chr = $.getChar(e);
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
    $.existsN = function(nabir) {
        return (nabir.length > 0);
    };
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
                                checked = $([]);
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
    var methods = {
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
                    $this.find(wrapper).off('click.radio').on('click.radio', function(e) {
                        if (!$(this).find('input').is(':disabled')) {
                            before($(this));
                            methods.changeRadio($(this).find(elCheckWrap), after, false);
                        }
                    });
                    input.on('mousedown change', function(e) {
                        return false;
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
                setDefault: function() {
                    return {
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
                    };
                },
                init: function(options, e) {
                    var sel = '.tooltip',
                            settings = $.extend(methods.setDefault(), {
                                title: this.attr('data-title')
                            }, options),
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
                            sel = elSet.tooltip || sel,
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
                        return false;
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
                },
                left: function(el, tooltip, placement, left, eff, offset) {
                    if (placement === 'left')
                        return Math.ceil(left - (eff === 'mouse' ? offset : tooltip.actual('outerWidth')));
                    if (placement === 'right')
                        return Math.ceil(left + (eff === 'mouse' ? offset : el.outerWidth()));
                    else
                        return Math.ceil(left - (eff === 'mouse' ? offset : (tooltip.actual('outerWidth') - el.outerWidth()) / 2));
                },
                top: function(el, tooltip, placement, top, eff, offset) {
                    if (placement === 'top')
                        return Math.ceil(top - (eff === 'mouse' ? offset : tooltip.actual('outerHeight')));
                    if (placement === 'bottom')
                        return Math.ceil(top + (eff === 'mouse' ? offset : tooltip.actual('outerHeight')));
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
                            sel = selA;
                    }
                    else
                        durOff = methods.setDefault().durationOff;
                    $(sel).stop().fadeOut(durOff, function() {
                        $(document).trigger({
                            'type': 'tooltip.hide',
                            'el': $(this)
                        });
                    });
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
                            dropOJ = $(drop),
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
                                        columnsObj = $this.find(':regex(class,' + columnClassPref + '([-1-9]+))'),
                                        numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(/([-1-9]+)/)[0];
                                })
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL == 1 && $.inArray('0', numbColumn) == -1 || numbColumnL > 1) {
                                    if ($.inArray('0', numbColumn) >= 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    if ($.inArray('-1', numbColumn) == 0) {
                                        numbColumn.shift();
                                        numbColumn.push('-1');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var $thisLi = columnsObj.filter('.' + columnClassPref + n),
                                                sumx = 0;
                                        $thisLi.each(function() {
                                            var datax = $(this).attr('data-x');
                                            sumx = parseInt(datax == 0 || datax == undefined ? 1 : datax) > sumx ? parseInt(datax == 0 || datax == undefined ? 1 : datax) : sumx;
                                        })
                                        $this.children().append('<li class="x' + sumx + '" data-column="' + n + '"><ul></ul></li>');
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
                                            $thisDrop[effOn](durationOn, function() {
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
                $this.each(function(index) {
                    var $thiss = $(this),
                            data = $thiss.data(),
                            effectOn = settings.effectOn || data.effectOn,
                            effectOff = settings.effectOff || data.effectOff,
                            durationOn = parseInt(settings.durationOn || data.durationOn),
                            durationOff = parseInt(settings.durationOff || data.durationOff);
                    navTabsLi[index] = $thiss.children();
                    refs[index] = navTabsLi[index].children(':first-child');
                    attrOrdata[index] = refs[index].attr('href') !== undefined ? 'attr' : 'data';
                    var tempO = $([]),
                            tempO2 = $([]),
                            tempRefs = [];
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
                                    wnd.scrollTop($this.offset().top);
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
                                    if (condStart)
                                        $this.trigger($this.attr('data-trigger'));
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
                    function scrollTop(wST) {
                        if (e.scroll || e.scroll === undefined)
                            wnd.scrollTop(wST);
                        wST = wnd.scrollTop();
                    }
                    //chrome bug
                    if ($.browser.webkit)
                        scrollTop(wST - 100);
                    scrollTop(wST);
                    _.map(location.hash.split('#'), function(i, n) {
                        if (i !== '') {
                            var el = $('[data-href="#' + i + '"], [href="#' + i + '"]');
                            if (!$.existsN(el.closest('[data-type="toggle"]'))) {
                                if (!el.parent().hasClass(aC))
                                    el.trigger('click.tabs');
                            }
                        }
                    });
                    return false;
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
                        if ($.inArray(n, hashs[0]) == -1 && $.existsN($('[' + attrOrdataNew + '=' + n + ']').parent().siblings('.' + aC))) {
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
    var nS = 'drop';
    var methods = {
        init: function(options) {
            this.filter(':not(.isDrop)').each(function() {
                var el = $(this),
                        trigger = (methods.checkProp(el.data(), options, 'trigger')).toString();
                methods._modalTrigger($.extend({}, options, el.data()));
                var rel = this.rel;
                if (rel !== undefined && rel !== '') {
                    rel = rel.replace(/[^a-zA-Z0-9]+/ig, '');
                    var source = el.data('source') || el.attr('href');
                    if (source !== undefined) {
                        if (typeof $.drop.dP.galleries[rel] === 'undefined')
                            $.drop.dP.galleries[rel] = [];
                        $.drop.dP.galleries[rel].push(source);
                    }
                }

                el.addClass('isDrop');
                el.attr('data-trigger', trigger + '.' + nS).on(trigger + '.' + nS, function(e) {
                    if ($(this).hasClass('isDrop')) {
                        e.stopPropagation();
                        e.preventDefault();
                        methods.open($(this), options, e)
                    }
                });
                if (window.location.hash.indexOf(el.attr('href')) != -1)
                    methods.open(el, options)
            });
            for (i in $.drop.dP.galleries)
                if ($.drop.dP.galleries[i].length <= 1) {
                    delete $.drop.dP.galleries[i];
                }
            return $(this);
        },
        destroy: function(el, trigger) {
            if (el == undefined)
                el = this;
            if (trigger == undefined)
                trigger = el.attr('data-trigger');
            el.removeAttr('data-trigger').removeData('trigger').removeClass('isDrop').off(trigger + '.' + nS);
            var drop = $(el.attr('data-drop'));
            methods.close(drop);
            drop.removeData();
            return el;
        },
        checkProp: function(elSet, opt, prop, step) {
            var optP = undefined;
            try {
                optP = opt[prop];
            } catch (err) {
            }
            if (step) {
                var tempP = $.drop.dP[prop] !== undefined ? $.drop.dP[prop] : optP;
                return tempP !== undefined ? tempP : elSet[prop];
            }
            else
                return elSet[prop] || optP || $.drop.dP[prop];
        },
        _modalTrigger: function(opt) {
            $(document).off('successJson.' + nS).on('successJson.' + nS, function(e) {
                if (e.datas.answer === "success")
                    e.el.find(opt.modalPlace || $.drop.dP.modalPlace).empty().append((opt.message || $.drop.dP.message).success(e.datas.data));
                else
                    e.el.find(opt.modalPlace || $.drop.dP.modalPlace).empty().append((opt.message || $.drop.dP.message).message.error(e.datas.data));
            });
        },
        get: function(el, e, set, modal) {
            if (el == undefined)
                el = this;
            if (set == undefined)
                set = $.drop.dP;
            var elSet = el.data(),
                    source = elSet.source || el.attr('href');

            var rel = '';
            if (el.get(0).rel != undefined)
                rel = el.get(0).rel.replace(/[^a-zA-Z0-9]+/ig, '');
            if (typeof $.drop.dP.galleriesContent[rel] === 'undefined')
                $.drop.dP.galleriesContent[rel] = [];

            if (elSet.drop != undefined) {
                $.ajax({
                    type: "post",
                    data: elSet.data,
                    url: source,
                    beforeSend: function() {
                        $(document).trigger({
                            'type': 'showActivity'
                        });
                    },
                    dataType: elSet.type ? elSet.type : 'html',
                    success: function(data) {
                        if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                            $.drop.dP.galleriesContent[rel][source] = data;
                        if (elSet.type !== 'html' && elSet.type !== undefined && modal) {
                            methods._modalTrigger($.extend({}, set, elSet));
                            var drop = $(elSet.drop);
                            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), drop, undefined, rel);
                            $(document).trigger({
                                type: 'successJson.' + nS,
                                el: drop,
                                datas: data
                            });
                        }
                        else {
                            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), data, undefined, rel);
                            var drop = $(elSet.drop);
                            $(document).trigger({
                                type: 'successHtml.' + nS,
                                el: drop,
                                datas: data
                            });
                        }
                        methods.init.call(drop.find('[data-drop]:not(.isDrop)'), $.extend({}, $.drop.dP));
                        methods._show(el, e, true, set, data);
                    }
                });
            }
            else {
                $('.' + $.drop.dP.curDefault).remove();
                $.drop.dP.curDefault = (methods.checkProp(elSet, set, 'drop') + (new Date()).getTime()).toString().replace('.', '');

                var drop = methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), methods.checkProp(elSet, set, 'pattern'), methods.checkProp(elSet, set, 'drop').replace('.', '') + ' ' + $.drop.dP.curDefault, rel);
                if (source.match(/jpg|gif|png|bmp|jpeg/))
                    $('<img src="' + source + '" style="max-height: 100%;"/>').load(function(data) {
                        drop.find('.placePaste').append($(this))
                        methods._show(el, e, true, set, data);
                    })
                else
                    drop.find('.placePaste').load(source, function(data) {
                        if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                            $.drop.dP.galleriesContent[rel][source] = data;
                        methods._show(el, e, true, set, data);
                    })
            }
        },
        open: function($this, opt, e) {
            if (e == undefined)
                e = window.event;
            if ($this == undefined)
                $this = this;

            methods.closeModal();
            function _confirmF() {
                if (!$.existsN(drop) || modal || always) {
                    if (!modal)
                        drop.remove();
                    methods.get($this, modal, opt, e);
                }
            }
            var elSet = $this.data(),
                    moreOne = methods.checkProp(elSet, opt, 'moreOne'),
                    confirmSel = methods.checkProp(elSet, opt, 'confirmSel'),
                    source = methods.checkProp(elSet, opt, 'source') || $this.attr('href'),
                    drop = $(elSet.drop),
                    start = methods.checkProp(elSet, opt, 'start', true);

            if (!$this.parent().hasClass(aC)) {
                if (!(elSet.moreOne || moreOne) && start === undefined) {
                    if ($.existsN($this.closest('[data-elrun]')) && !elSet.modal)
                        methods.close($this.closest('[data-elrun]'));
                    if ($.existsN($('[data-elrun].center:visible, [data-elrun].noinherit:visible')))
                        methods.close($('[data-elrun].center:visible, [data-elrun].noinherit:visible'));
                }

                if (!$this.is(':disabled')) {
                    var modal = methods.checkProp(elSet, opt, 'modal'),
                            confirm = methods.checkProp(elSet, opt, 'confirm'),
                            always = methods.checkProp(elSet, opt, 'always');
                    if (start !== undefined) {
                        var res = eval(start)($this, drop);
                        if (!res)
                            return false;
                    }
                    if (start === undefined || (start !== undefined && res)) {
                        if ($.existsN(drop) && !modal && !always && !confirm) {
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, elSet), drop);
                            methods._show($this, e, false, opt, false);
                        }
                        else if (source || always || confirm) {
                            if (!confirm)
                                _confirmF();
                            else {//for cofirm
                                methods._pasteDrop($.extend({}, $.drop.dP, opt, $('[data-drop="' + confirmSel + '"]').data()), $(confirmSel));
                                methods._show($('[data-drop="' + confirmSel + '"]').data({
                                    'elrun': $this
                                }), e, false, opt, false);
                                $('[data-button-confirm]').focus().on('click.' + nS, function() {
                                    if (elSet.after)
                                        $(confirmSel).data('elClosed', elSet.after)
                                    methods.close($(confirmSel));
                                    $this.data('confirm', false);
                                    if (source)
                                        _confirmF();
                                });
                            }
                        }
                        else {//for validations
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, elSet), drop);
                            methods._show($this, e, false, opt, false);
                        }
                    }
                }
            }
            else
                methods.close($($this.data('drop')), '', $this);
            return $this;
        },
        _pasteDrop: function(set, drop, addClass, rel) {
            if (addClass == undefined)
                addClass = '';
            if (rel == undefined)
                rel = '';
            if (set.place !== 'inherit') {
                function _for_center(rel) {
                    body.append('<div class="for-center" data-rel="' + rel + '" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;dispaly:none;overflow: hidden;"></div>');
                }
                if (set.place === 'noinherit')
                    drop = $(drop).appendTo(body);
                else {
                    var sel = '[data-rel="' + set.drop + '"].for-center';
                    if (typeof drop !== 'string') {
                        if (!$.existsN(drop.parent('.for-center'))) {
                            if (drop.data('forCenter') === undefined) {
                                _for_center(set.drop);
                            }
                        }
                        var forCenter = $(sel);
                        drop = drop.appendTo(forCenter).data('forCenter', forCenter);
                    }
                    else {
                        if (!$.exists(sel)) {
                            _for_center(set.drop);
                        }
                        var forCenter = $(sel);
                        drop = $(drop).appendTo(forCenter).data('forCenter', forCenter);
                    }
                }
            }
            return drop.addClass(addClass).attr('data-rel', rel);
        },
        closeModal: function() {
            $('[data-elrun]:visible').each(function() {
                if ($(this).data('modal'))
                    methods.close($(this));
            });
        },
        heightContent: function(drop) {
            if (drop === undefined)
                drop = this;
            var dropV = drop.is(':visible'),
                    wndH = wnd.height();
            if (drop.data('dropContent')) {
                var el = drop.find($(drop.data('dropContent')).add($($.drop.dPP.dropContent))).filter(':first');
                if (el.data('jsp') != undefined)
                    el.data('jsp').destroy()

                if ($.existsN(el)) {
                    var docH = $(document).height(),
                            forCenter = drop.data('forCenter'),
                            refer = drop.data('elrun');
                    if (!dropV) {
                        drop.show();
                        if (forCenter)
                            forCenter.show();
                    }

                    var api = false,
                            elC = el.css('overflow', '');
                    try {
                        el.jScrollPane(scrollPane);
                        elC = el.find('.jspPane');
                        api = el.data('jsp');
                    } catch (err) {
                        elC.css('overflow', 'auto');
                    }
                    var elCH = elC.outerHeight(),
                            footerHeader = drop.find($(drop.data('dropHeader')).add($($.drop.dPP.dropHeader))).outerHeight(true) + drop.find($(drop.data('dropFooter')).add($($.drop.dPP.dropFooter))).outerHeight(true);
                    if (drop.data('place') == 'noinherit') {
                        var mayHeight = 0,
                                placement = drop.data('placement');
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
                    if (drop.data('place') === 'center')
                        drop.drop('center');
                    if (!dropV) {
                        drop.hide();
                        if (forCenter)
                            forCenter.hide();
                    }
                }
            }
        },
        _pasteContent: function($this, drop, contentHeader, dropHeader, contentContent, dropContent, contentFooter, dropFooter) {
            if (contentFooter) {
                var footer = drop.find($(dropFooter).add($($.drop.dPP.dropFooter)));
                if (typeof contentFooter == 'string' || typeof contentFooter == 'object')
                    footer.empty().append(contentFooter);
                else if (typeof contentFooter == 'function')
                    contentFooter(footer, $this, drop);
            }
            if (contentHeader) {
                var header = drop.find($(dropHeader).add($($.drop.dPP.dropHeader)));
                if (typeof contentHeader == 'string' || typeof contentHeader == 'object')
                    header.empty().append(contentHeader);
                else if (typeof contentHeader == 'function')
                    contentHeader(header, $this, drop);
            }
            if (contentContent) {
                var content = drop.find($(dropContent).add($($.drop.dPP.dropContent)));
                if (typeof contentContent == 'string' || typeof contentContent == 'object')
                    content.empty().append(contentContent);
                else if (typeof contentContent == 'function')
                    contentContent(content, $this, drop);
            }
        },
        _show: function($this, e, isajax, set, data) {
            if ($this === undefined)
                $this = this;
            if (e === undefined)
                e = window.event;
            set = $.extend({}, $.drop.dP, set);

            isajax = !isajax ? false : true;
            var elSet = $this.data(),
                    $thisD = elSet.durationOn !== undefined ? elSet.durationOn.toString() : elSet.durationOn || set.durationOn,
                    $thisDOff = elSet.durationOff !== undefined ? elSet.durationOff.toString() : elSet.durationOff || set.durationOff,
                    overlayOpacity = elSet.overlayOpacity !== undefined ? elSet.overlayOpacity.toString() : elSet.overlayOpacity || set.overlayOpacity,
                    $thisA = elSet.animate !== undefined ? elSet.animate : set.animate,
                    trigger = elSet.trigger || set.trigger,
                    place = elSet.place || set.place,
                    placement = elSet.placement || set.placement,
                    $thisEOff = elSet.effectOff || set.effectOff,
                    $thisEOn = elSet.effectOn || set.effectOn,
                    overlayColor = elSet.overlayColor || set.overlayColor,
                    modal = elSet.modal || set.modal,
                    timeclosemodal = elSet.timeclosemodal || set.timeclosemodal,
                    confirm = elSet.confirm || set.confirm,
                    position = elSet.position || set.position,
                    placeBeforeShow = elSet.placeBeforeShow || set.placeBeforeShow,
                    placeAfterClose = elSet.placeAfterClose || set.placeAfterClose,
                    moreOne = elSet.moreOne || set.moreOne,
                    delayAfter = elSet.delayAfter || set.delayAfter,
                    closeClick = elSet.closeClick || set.closeClick,
                    closeEsc = elSet.closeEsc || set.closeEsc,
                    droppable = elSet.droppable || set.droppable,
                    next = elSet.next || set.next,
                    prev = elSet.prev || set.prev,
                    cycle = elSet.cycle || set.cycle,
                    source = elSet.source || set.source || $this.attr('href'),
                    selSource = elSet.drop || set.drop,
                    tab = elSet.tab || set.tab,
                    dropContent = elSet.dropContent || set.dropContent,
                    dropHeader = elSet.dropHeader || set.dropHeader,
                    dropFooter = elSet.dropFooter || set.dropFooter,
                    contentHeader = elSet.contentHeader != undefined ? elSet.contentHeader.toString() : (set.contentHeader != undefined ? set.contentHeader : false),
                    contentContent = elSet.contentContent != undefined ? elSet.contentContent.toString() : (set.contentContent != undefined ? set.contentContent : false),
                    contentFooter = elSet.contentFooter != undefined ? elSet.contentFooter.toString() : (set.contentFooter != undefined ? set.contentFooter : false),
                    start = elSet.start,
                    changeSource = set.changeSource,
                    elChangeSource = elSet.changeSource,
                    elBefore = elSet.before,
                    elAfter = elSet.after,
                    before = set.before,
                    after = set.after,
                    close = set.close,
                    elClose = elSet.close,
                    closed = set.closed,
                    elClosed = elSet.closed,
                    drop = $(selSource);
            $this.attr({
                'data-drop': $this.data('drop')
            }).parent().addClass(aC);
            $.drop.dP.durationOff = $thisDOff;
            drop.data({
                'trigger': trigger,
                'effectOn': $thisEOn,
                'position': position,
                'placeBeforeShow': placeBeforeShow,
                'placeAfterClose': placeAfterClose,
                'effectOff': $thisEOff,
                'elrun': elSet.elrun || $this,
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
                'changeSource': changeSource,
                'elChangeSource': elChangeSource,
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
                'timeclosemodal': timeclosemodal,
                'moreOne': moreOne,
                'delayAfter': delayAfter,
                'closeClick': closeClick,
                'closeEsc': closeEsc,
                'droppable': droppable,
                'source': source,
                'prev': prev,
                'next': next,
                'cycle': cycle,
                'droppableIn': false,
                'contentHeader': contentHeader,
                'contentContent': contentContent,
                'contentFooter': contentFooter,
                'tab': tab
            }).attr('data-elrun', selSource);
            drop.off('click.' + nS, set.exit).on('click.' + nS, set.exit, function() {
                methods.close($(this).closest('[data-elrun]'));
            });
            (function(source) {
                var tempF = arguments.callee,
                        relO = $this.get(0).rel;

                if (relO != '' && relO !== undefined) {
                    var rel = relO.replace(/[^a-zA-Z0-9]+/ig, ''),
                            relA = $.drop.dP.galleries[rel],
                            drop = $('[data-elrun][data-rel="' + rel + '"]');
                    if (relA !== undefined) {
                        var relL = relA.length,
                                relP = $.inArray(source != undefined ? source : drop.find('.placePaste img').attr('src'), relA);
                        $(prev).add($(next)).hide();
                        if (relP == 0)
                            $(next).show();
                        if (relP == relL - 1)
                            $(prev).show();
                        if ((relP > 0 && relP < relL - 1) || cycle)
                            $(prev).add($(next)).show();
                    }
                    $(prev).add($(next)).attr('data-rel', rel).off('click.' + nS).on('click.' + nS, function() {
                        var $thisB = $(this).attr('disabled', 'disabled'),
                                relCur = relP + ($thisB.is(prev) ? -1 : 1);
                        if (cycle) {
                            if (relCur >= relL)
                                relCur = 0;
                            if (relCur < 0)
                                relCur = relL - 1;
                        }
                        source = relA[relCur];
                        var $this = $('[data-source="' + relA[relCur] + '"][rel], [href="' + relA[relCur] + '"][rel]').filter(':first'),
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
                            $(document).trigger({
                                'type': 'changeSource.' + nS,
                                'el': $this,
                                'drop': drop,
                                'datas': data
                            });
                        }
                        if (source.match(/jpg|gif|png|bmp|jpeg/))
                            $('<img src="' + source + '" style="max-height: 100%;"/>').load(function(data) {
                                drop.find('.placePaste').empty().append($(this))
                                $thisB.removeAttr('disabled');
                                tempF();
                                (function(data) {
                                    var tempF2 = arguments.callee;
                                    _changeSource(data);
                                    methods.limitSize(drop);
                                    methods.heightContent(drop);
                                    if (place != 'inherit')
                                        methods[place](drop, true);
                                    $(this).off('load.' + nS).on('load.' + nS, function() {
                                        tempF2($(this));
                                    });
                                })($(this));
                            });
                        else {
                            function _tempF3(data) {
                                $thisB.removeAttr('disabled');
                                tempF(source);
                                _changeSource(data);
                                methods.heightContent(drop);
                                methods.limitSize(drop);
                                if (place != 'inherit')
                                    methods[place](drop, true);
                            }

                            if (typeof $.drop.dP.galleriesContent[rel][source] !== 'undefined' && !(elSet.always || set.always)) {
                                drop.find('.placePaste').html($.drop.dP.galleriesContent[rel][source])
                                _tempF3($.drop.dP.galleriesContent[rel][source]);
                            }
                            else {
                                if ($.exists(source)) {
                                    console.log(drop.find('.placePaste'))
                                    if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                                        $.drop.dP.galleriesContent[rel][source] = $(source).html();
                                    drop.find('.placePaste').html($.drop.dP.galleriesContent[rel][source])
                                }
                                else
                                    drop.find('.placePaste').load(source, function(data) {
                                        if (typeof $.drop.dP.galleriesContent[rel][source] === 'undefined')
                                            $.drop.dP.galleriesContent[rel][source] = data;
                                        _tempF3(data);
                                    });
                            }
                        }
                    });
                }
            })(source)

            var overlays = $('.overlayDrop').css('z-index', 1103),
                    condOverlay = (overlayOpacity !== undefined ? overlayOpacity.toString() : overlayOpacity) !== '0';
            if (condOverlay) {
                if (!$.exists('[data-rel="' + selSource + '"].overlayDrop')) {
                    body.append('<div class="overlayDrop" data-rel="' + selSource + '" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;"></div>');
                }
                drop.data('dropOver', $('[data-rel="' + selSource + '"].overlayDrop'));
                drop.data('dropOver').css({
                    'background-color': overlayColor,
                    'opacity': overlayOpacity,
                    'z-index': overlays.length + 1103
                });
            }
            $('.for-center').css('z-index', 1104);
            var forCenter = drop.data('forCenter');
            if (forCenter) {
                forCenter.css('z-index', overlays.length + 1104);
            }
            else
                drop.css('z-index', 1105);
            if (drop.hasClass(aC)) {
                methods.close(drop);
            }
            else {
                var href = $this.attr('href');
                if (href !== undefined) {
                    var wlh = window.location.hash;
                    if (href.indexOf('#') !== -1 && (new RegExp(href + '#|' + href + '$').exec(wlh) === null))
                        window.location.hash = wlh + href;
                }

                methods._pasteContent($this, drop, contentHeader, dropHeader, contentContent, dropContent, contentFooter, dropFooter);

                before($this, drop, isajax, data, set);
                if (elBefore !== undefined)
                    eval(elBefore)($this, drop, isajax, data, set);
                $(document).trigger({
                    'type': 'before.' + nS,
                    'el': $this,
                    'drop': drop,
                    'isajax': isajax,
                    'datas': data,
                    'settings': set
                });
                methods.heightContent(drop);
                if (modal) {
                    var objJ = $([]);
                    $('[data-elrun]:visible').each(function() {
                        if (($(this).data('overlayOpacity') !== '0'))
                            objJ = objJ.add($(this));
                    });
                    if ($.existsN(objJ))
                        methods.close(objJ);
                }

                var dropTimeout = '';
                wnd.off('resize.' + nS).on('resize.' + nS, function() {
                    clearTimeout(dropTimeout);
                    dropTimeout = setTimeout(function() {
                        methods.limitSize(drop);
                        if (place !== 'inherit')
                            methods[place](drop);
                    }, 300);
                });
                if (condOverlay) {
                    drop.data('dropOver').fadeIn($thisD / 2);
                    if (closeClick)
                        drop.data('dropOver').add(forCenter).off('click.' + nS).on('click.' + nS, function(e) {
                            if ($(e.target).is(drop.data('dropOver')) || $(e.target).is('.for-center')) {
                                methods.close($($(e.target).attr('data-rel')));
                            }
                        });
                    if (isTouch)
                        drop.data('dropOver').on('touchmove.' + nS, function(e) {
                            return false;
                        });
                }

                drop.addClass(place);
                function _forCenterTop() {
                    if (forCenter) {
                        forCenter.css('top', $.drop.dP.wST);
                    }
                }
                function _show() {
                    if (place !== 'inherit') {
                        function _pos() {
                            drop.css({
                                'top': -drop.actual('outerHeight'),
                                'left': -drop.actual('outerWidth')
                            });
                            var $thisPMT = placeBeforeShow.toLowerCase().split(' ');
                            if ($thisPMT[0] === 'bottom' || $thisPMT[1] === 'bottom')
                                drop.css('top', wnd.height());
                            if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                                drop.css('left', wnd.width());
                            if ($thisPMT[0] === 'center' && $thisPMT[1] === 'center') {
                                if (place != 'inherit')
                                    methods[place](drop, true);
                            }
                            if ($thisPMT[0] === 'inherit')
                                drop.css({
                                    'left': $this.offset().left + wnd.scrollLeft(),
                                    'top': $this.offset().top + wnd.scrollTop()
                                });
                        }
                        var tempPl = typeof placement;
                        if (tempPl == 'object')
                            if (placement.top != undefined && placement.left != undefined)
                                _pos()
                        if (tempPl == 'string')
                            _pos();
                    }

                    if (place != 'inherit')
                        methods[place](drop);
                    drop[$thisEOn]($thisD, function(e) {
                        var drop = $(this);
                        drop.addClass(aC);
                        if (!confirm && modal)
                            $.drop.dP.closeDropTime = setTimeout(function() {
                                methods.close(drop);
                            }, timeclosemodal);
                        methods.limitSize(drop);
                        if (place != 'inherit')
                            methods[place](drop);

                        var cB = elAfter;
                        if (cB !== undefined) {
                            eval(cB)($this, drop, isajax, data, set);
                        }
                        after($this, drop, isajax, data, set);
                        $(document).trigger({
                            'type': 'after.' + nS,
                            'el': $this,
                            'drop': drop,
                            'isajax': isajax,
                            'datas': data,
                            'settings': set
                        });
                        if (droppable && place != 'inherit')
                            methods.droppable(drop);
                    });
                }
                $.drop.dP.wST = wnd.scrollTop();
                if (forCenter) {
                    forCenter.fadeIn($thisD);
                }

                _forCenterTop();
                if (condOverlay) {
                    methods.scrollEmulate();
                }
                methods.positionType(drop);
                _show();
            }
            body.off('click.' + nS).off('keydown.' + nS).on('click.' + nS, function(e) {
                if (closeClick)
                    if (!$.existsN($(e.target).closest('[data-elrun]')) && !($(e.target).is(drop.data('dropOver')) || $(e.target).is('.for-center'))) {
                        methods.close(false);
                    }
                    else
                        return true;
            });
            if (closeEsc)
                body.off('keydown.' + nS).on('keydown.' + nS, function(e) {
                    if (!e)
                        var e = window.event;
                    key = e.keyCode;
                    if (key === 27) {
                        methods.close(false);
                    }
                });
        },
        limitSize: function(drop) {
            if (drop === undefined)
                drop = this;
            drop.css({
                'width': '',
                'height': ''
            });
            drop.find('.placePaste img').css('max-height', 'none');
            if (drop.data('place') === 'center') {
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
        },
        positionType: function(drop) {
            var data = drop.data();
            if (data.place !== 'inherit') {
                drop.css({
                    'position': data.position
                });
            }
        },
        close: function(sel, datas, el) {
            if (sel === undefined)
                sel = this;
            clearTimeout($.drop.dP.closeDropTime);
            $('[data-button-confirm]').off('click.' + nS);
            var cond = sel === undefined || !sel,
                    drop = cond ? $('[data-elrun].' + aC) : sel;
            if (!cond)
                body.off('click.' + nS + ' keydown.' + nS);
            if ($.existsN(drop)) {
                drop.each(function() {
                    var drop = $(this),
                            data = Object.keys(drop.data()).length != 0 ? drop.data() : $.drop.dP,
                            condOverlay = (data.overlayOpacity !== undefined ? data.overlayOpacity.toString() : data.overlayOpacity) !== '0';
                    if (data.modal || sel || condOverlay || data.place === 'noinherit') {
                        var $thisB = data.elrun;
                        if (el)
                            $thisB = el;
                        if ($thisB !== undefined) {
                            var $thisEOff = data.effectOff,
                                    durOff = data.durationOff;
                            methods.scrollEmulateRemove();
                            function _hide() {
                                $thisB.parent().removeClass(aC);
                                var $thisHref = $thisB.attr('href');
                                if ($thisHref !== undefined) {
                                    var wLH = location.hash;
                                    location.hash = wLH.replace($thisHref, '');
                                }

                                drop.removeClass(aC);
                                var method = data.animate ? 'animate' : 'css',
                                        $thisPMT = data.placeAfterClose.toLowerCase().split(' '),
                                        l = 0, t = 0;
                                if ($thisPMT[0] === 'bottom' || $thisPMT[1] === 'bottom')
                                    t = wnd.height();
                                if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                                    l = wnd.width();
                                if ($thisPMT[0] !== 'center' && $thisPMT[1] !== 'center')
                                    drop.stop()[method]({
                                        'top': t,
                                        'left': l
                                    }, {
                                        queue: false
                                    });
                                if ($thisPMT[0] === 'inherit')
                                    drop.stop()[method]({
                                        'left': $thisB.offset().left + wnd.scrollLeft(),
                                        'top': $thisB.offset().top + wnd.scrollTop()
                                    }, {
                                        queue: false
                                    });
                                if (data.forCenter)
                                    data.forCenter.stop(true, false).fadeOut(durOff);
                                drop[$thisEOff](durOff, function() {
                                    if (data.dropOver)
                                        data.dropOver.fadeOut(durOff);
                                    var $this = $(this).css({
                                        'width': '',
                                        'height': '',
                                        'top': '',
                                        'left': '',
                                        'bottom': '',
                                        'right': '',
                                        'position': ''
                                    });
                                    $this.removeClass(data.place);
                                    if (data.closed !== undefined)
                                        data.closed($thisB, $this, datas);
                                    if (data.elClosed !== undefined)
                                        eval(data.elClosed)($thisB, $this, datas);
                                    if (isTouch)
                                        data.dropOver.off('touchmove.' + nS);
                                    $(document).trigger({
                                        type: 'closed.' + nS,
                                        el: $thisB,
                                        drop: $this,
                                        datas: datas
                                    });
                                    var dC = $this.find($($this.data('dropContent')).add($($.drop.dPP.dropContent))).data('jsp');
                                    if (dC !== undefined) {
                                        dC.destroy();
                                    }
                                });
                            }
                            $(document).trigger({
                                type: 'close.' + nS,
                                el: $thisB,
                                drop: drop,
                                datas: datas
                            });
                            var close = data.elClose !== undefined ? data.elClose : data.close;
                            if (close !== undefined) {
                                if (typeof close == 'string')
                                    var res = eval(close)($thisB, $(this), datas);
                                else
                                    var res = close($thisB, $(this), datas);
                                if (res === false && res !== true) {
                                    if (window.console)
                                        console.log(res);
                                }
                                else
                                    _hide();
                            }
                            else
                                _hide();
                            wnd.off('resize.' + nS);
                        }
                    }
                });
            }
            return sel;
        },
        center: function(drop, start) {
            if (drop === undefined)
                drop = this;
            if (!drop.data('droppableIn')) {
                start = start === undefined ? true : false;
                var method = drop.data('animate') && start ? 'animate' : 'css',
                        dropV = drop.is(':visible'),
                        w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                        h = dropV ? drop.outerHeight() : drop.actual('outerHeight');
                drop[method]({
                    'top': (body.height() - h) / 2,
                    'left': (body.width() - w) / 2
                }, {
                    duration: drop.data('durationOn'),
                    queue: false
                });
            }
            return drop;
        },
        noinherit: function(drop, start) {
            if (drop === undefined)
                drop = this;
            if (!drop.data('droppableIn')) {
                start = start === undefined ? true : false;
                var method = drop.data('animate') && start ? 'animate' : 'css',
                        placement = drop.data('placement'),
                        $this = drop.data('elrun'),
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
                        duration: drop.data('durationOn'),
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
                        duration: drop.data('durationOn'),
                        queue: false
                    });
                }
            }
            return drop;
        },
        scrollEmulate: function() {
            var dur = $.drop.dP.durationOn;
            try {
                clearInterval($.drop.dP.scrollemulatetimeout);
            } catch (err) {
            }
            setTimeout(function() {
                if (!isTouch) {
                    body.addClass('isScroll').css({
                        'overflow': 'hidden',
                        'margin-right': 17
                    });
                    body.prepend('<div class="scrollEmulation" style="position: absolute;right: 0;top: ' + wnd.scrollTop() + 'px;height: 100%;width: 17px;overflow-y: scroll;z-index:10000;"></div>');
                }
                if (isTouch)
                    $('.for-center').on('touchmove.' + nS, function(e) {
                        return false;
                    });
                $(document).trigger({
                    'type': 'scrollEmulate.' + nS
                });
            }, dur);
        },
        scrollEmulateRemove: function() {
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
                    $('.for-center').off('touchmove.' + nS);
                $(document).trigger({
                    'type': 'scrollEmulateRemove.' + nS
                });
            }, dur);
        },
        droppable: function(drop) {
            if (drop === undefined)
                drop = this;
            drop.off('mousedown.' + nS).on('mousedown.' + nS, function(e) {
                if (!$(e.target).is(':input')) {
                    body.on('mouseup.' + nS, function(e) {
                        drop.css('cursor', '');
                        body.off('selectstart.' + nS + ' mousemove.' + nS + ' mouseup.' + nS);
                    });
                    var $this = $(this).css('cursor', 'move'),
                            left = e.pageX - $this.offset().left,
                            top = e.pageY - $this.offset().top,
                            w = $this.outerWidth(),
                            h = $this.outerHeight(),
                            wndW = wnd.width(),
                            wndH = wnd.height();
                    body.on('selectstart.' + nS, function(e) {
                        e.preventDefault();
                    });
                    var condH = $(document).height() > wnd.height() && drop.data('place') == 'center';
                    body.on('mousemove.' + nS, function(e) {
                        drop.data('droppableIn', true);
                        var l = e.pageX - left,
                                t = e.pageY - top;
                        l = l < 0 ? 0 : l;
                        t = t < 0 ? 0 : t;
                        var addW = condH ? 17 : 0;
                        l = l + w + addW < wndW ? l : wndW - w - addW;
                        t = t + h < wndH ? t : wndH - h;
                        $this.css({
                            'left': l,
                            'top': t
                        })
                    })
                }
            });
            return drop;
        }
    };
    $.fn.drop = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.drop');
        }
    };
    $.dropInit = function(m) {
        this.method = function(m) {
            return methods[m];
        };
        this.methods = function() {
            return methods;
        };
        this.dPP = {
            dropContent: '.drop-content-default',
            dropHeader: '.drop-header-default',
            dropFooter: '.drop-footer-default',
        };
        this.dP = {
            contentHeader: null,
            contentFooter: null,
            contentContent: null,
            galleries: [],
            galleriesContent: [],
            message: {
                success: function(text) {
                    return '<div class = "msg js-msg"><div class = "success"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
                },
                error: function(text) {
                    return '<div class = "msg js-msg"><div class = "error"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
                },
                info: function(text) {
                    return '<div class = "msg js-msg"><div class = "info"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
                }
            },
            trigger: 'click',
            exit: '[data-closed = "closed-js"]',
            effectOn: 'fadeIn',
            effectOff: 'fadeOut',
            durationOn: 200,
            durationOff: 100,
            place: 'center',
            placement: 'top, left',
            modal: false,
            confirm: false,
            confirmSel: '#confirm',
            overlayOpacity: '0',
            overlayColor: '#fff',
            always: false,
            animate: false,
            timeclosemodal: 2000,
            position: true,
            placeBeforeShow: 'center center',
            placeAfterClose: 'center center',
            moreOne: false,
            delayAfter: 0,
            closeClick: false,
            closeEsc: false,
            droppable: false,
            before: function() {
            },
            after: function() {
            },
            close: function() {
            },
            closed: function() {
            },
            changeSource: function() {
            },
            start: undefined,
            drop: '.drop-default',
            pattern: '<div class="drop drop-style"><button type="button" class="icon_times_drop" data-closed="closed-js"></button><div class="drop-header-default"></div><div class="drop-content-default" style="height: 100%;"><button class="drop-prev" type="button"  style="display:none;font-size: 30px;position:absolute;left: 20px;top:50%;"><</button><button class="drop-next" type="button" style="display:none;font-size: 30px;position:absolute;right: 20px;top:50%;">></button><div class="inside-padd placePaste" style="height: 100%;"></div></div><div class="drop-footer-default"></div></div>',
            next: '.drop-next',
            prev: '.drop-prev',
            cycle: false,
            tab: false
        };
        this.setParameters = function(options) {
            $.extend($.drop.dP, options);
        };
    }
    $.drop = new $.dropInit();
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
                }
            }, options);
            if (this.length > 0) {
                return this.each(function() {
                    var $this = $(this),
                            prev = settings.prev.split('.'),
                            next = settings.next.split('.'),
                            checkProdStock = settings.checkProdStock,
                            step = settings.step,
                            $thisPrev = $this,
                            $thisNext = $this,
                            regS = '', regM = '';
                    $.each(prev, function(i, v) {
                        var regS = v.match(/\(.*\)/);
                        if (regS !== null) {
                            regM = regS['input'].replace(regS[0], '');
                            regS = regS[0].substring(1, regS[0].length - 1);
                        }
                        if (regS === null)
                            regM = v;
                        $thisPrev = $thisPrev[regM](regS);
                    });
                    $.each(next, function(i, v) {
                        regS = v.match(/\(.*\)/);
                        if (regS !== null) {
                            regM = regS['input'].replace(regS[0], '');
                            regS = regS[0].substring(1, regS[0].length - 1);
                        }
                        if (regS === null)
                            regM = v;
                        $thisNext = $thisNext[regM](regS);
                    });
                    $thisNext.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisPrev.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseInt(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input);
                                if (isNaN(inputVal))
                                    input.val(input.data('min') || 1);
                                else
                                    input.val(inputVal + step);
                                if (inputVal + step === input.data('max') && checkProdStock)
                                    $thisNext.attr('disabled', 'disabled');
                                if (checkProdStock)
                                    input.maxminValue(e);
                                settings.after(e, el, input);
                            }
                        }
                    });
                    $thisPrev.off('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisNext.removeAttr('disabled', 'disabled');
                        if (!el.is(':disabled')) {
                            var input = $this,
                                    inputVal = parseInt(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input);
                                if (isNaN(inputVal))
                                    input.val(input.data('min') || 1);
                                else if (inputVal > parseFloat(input.data('min') || 1)) {
                                    input.val(inputVal - step);
                                    if (inputVal - step === input.data('min') && checkProdStock)
                                        $thisPrev.attr('disabled', 'disabled');
                                }

                                settings.after(e, el, input);
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
    body.off('blur.max', '[data-max]').on('blur.max', '[data-max]', function(e) {
        var $this = $(this);
        if ($this.val() === '')
            $this.val($this.data('min'));
        $this.trigger({
            'type': 'maxminValue',
            'event': e
        });
        $(this).maxminValue(e);
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
                    if (addO.refresh && $this.hasClass('iscarousel'))
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