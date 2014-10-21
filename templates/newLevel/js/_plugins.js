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
$.expr[':'].regex = function (elem, index, match) {
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
String.prototype.trimMiddle = function ()
{
    var r = /\s\s+/g;
    return $.trim(this).replace(r, ' ');
};
String.prototype.isNumeric = function () {
    return !isNaN(parseFloat(this)) && isFinite(this);
};
String.prototype.pasteSAcomm = function () {
    var r = /\s,/g;
    return this.replace(r, ',');
};
$.exists = function (selector) {
    return $(selector).length > 0 && $(selector) instanceof jQuery;
};
$.existsN = function (nabir) {
    return nabir.length > 0 && nabir instanceof jQuery;
};
getChar = function (e) {
    if (e.which === null) {  // IE
        if (e.keyCode < 32)
            return null;
        return String.fromCharCode(e.keyCode);
    }

    if (e.which !== 0 && e.charCode !== 0) { // non IE
        if (e.which < 32)
            return null;
        return String.fromCharCode(e.which);
    }
    return null;
};
returnMsg = function (msg) {
    if (window.console) {
        console.log(msg);
    }
};
$.fn.testNumber = function (add) {
    $(this).off('keypress.testNumber').on('keypress.testNumber', function (e) {
        var $this = $(this);
        if (e.ctrlKey || e.altKey || e.metaKey)
            return;
        var chr = getChar(e);
        if (chr === null)
            return;
        if (!isNaN(parseFloat(chr)) || $.inArray(chr, add) !== -1) {
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
$.fn.pricetext = function (e, rank) {
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
$.fn.setCursorPosition = function (pos) {
    if (!isTouch)
        this.each(function () {
            this.select();
            try {
                this.setSelectionRange(pos, pos);
            } catch (err) {
            }

        });
    return this;
};
$.fn.getCursorPosition = function () {
    var el = $(this).get(0),
            pos = 0;
    if ('selectionStart' in el) {
        pos = el.selectionStart;
    } else if ('selection' in document) {
        el.focus();
        var Sel = document.selection.createRange();
        Sel.moveStart('character', -el.value.length);
        pos = Sel.text.length - document.selection.createRange().text.length;
    }
    return pos;
};
/*plugin actual*/
(function ($) {
    $.fn.actual = function () {
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
$(document).on('textanimatechange', function (e) {
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
            numb = setInterval(function () {
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
(function ($) {
    var nS = "nstcheck",
            methods = {
                init: function (options) {
                    if ($.existsN(this)) {
                        var settings = $.extend({
                            wrapper: $("label:has(.niceCheck)"),
                            elCheckWrap: '.niceCheck',
                            evCond: false,
                            classRemove: '',
                            resetChecked: false,
                            trigger: function () {
                            },
                            after: function () {
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
                        frameChecks.find(wrapper).removeClass(dC + ' ' + aC + ' ' + fC).off('click.' + nS).on('click.' + nS, function (e) {
                            e.stopPropagation();
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
                        frameChecks.closest('form').each(function () {
                            var $this = $(this);
                            if (resetChecked)
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function (e) {
                                    methods.checkAllReset($this.find(elCheckWrap).filter('.' + aC));
                                });
                            else {
                                var checked = $([]);
                                $this.find('input:checked').each(function () {
                                    checked = checked.add($(this).closest(elCheckWrap));
                                });
                                $this.find('[type="reset"]').off('click.' + nS).on('click.' + nS, function (e) {
                                    var wrap = $this.find(elCheckWrap);
                                    methods.checkAllReset(wrap.not(checked));
                                    methods.checkAllChecks(wrap.not('.' + aC).filter(checked));
                                    e.preventDefault();
                                });
                            }
                        });
                        //init events input
                        wrapper.find('input').off('mousedown.' + nS).on('mousedown.' + nS, function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                            if (e.button === 0)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('click.' + nS).on('click.' + nS, function (e) {
                            e.stopPropagation();
                            e.preventDefault();
                        }).off('keyup.' + nS).on('keyup.' + nS, function (e) {
                            if (e.keyCode === 32)
                                $(this).closest(wrapper).trigger('click.' + nS);
                        }).off('focus.' + nS).on('focus.' + nS, function (e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).addClass(fC);
                        }).off('blur.' + nS).on('blur.' + nS, function (e) {
                            var $this = $(this);
                            $this.closest(wrapper).add($this.closest(elCheckWrap)).removeClass(fC);
                        }).off('change.' + nS).on('change.' + nS, function (e) {
                            e.preventDefault();
                        });
                        //init states of checkboxes
                        frameChecks.find(elCheckWrap).each(function () {
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
                _changeCheckStart: function (el) {
                    if (el === undefined)
                        el = this;
                    el.find("input").is(":checked") ? methods.checkChecked(el) : methods.checkUnChecked(el);
                },
                checkChecked: function (el) {
                    if (el === undefined)
                        el = this;
                    el.addClass(aC).parent().addClass(aC).end().find("input").attr("checked", "checked");
                    el.find('input').trigger({
                        'type': nS + '.cc',
                        'el': el
                    });
                },
                checkUnChecked: function (el) {
                    if (el === undefined)
                        el = this;
                    el.removeClass(aC).parent().removeClass(aC).end().find("input").removeAttr("checked");
                    el.find('input').trigger({
                        'type': nS + '.cuc',
                        'el': el
                    });
                },
                changeCheck: function (el)
                {
                    if (el === undefined)
                        el = this;
                    if (el.find("input").attr("checked") !== undefined) {
                        methods.checkUnChecked(el);
                    }
                    else {
                        methods.checkChecked(el);
                    }
                },
                checkAllChecks: function (el)
                {
                    (el === undefined ? this : el).each(function () {
                        methods.checkChecked($(this));
                    });
                },
                checkAllReset: function (el)
                {
                    (el === undefined ? this : el).each(function () {
                        methods.checkUnChecked($(this));
                    });
                },
                checkAllDisabled: function (el)
                {
                    (el === undefined ? this : el).each(function () {
                        var $this = $(this);
                        $this.addClass(dC).parent().addClass(dC).end().find("input").attr('disabled', 'disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ad',
                            'el': $this
                        });
                    });
                },
                checkAllEnabled: function (el)
                {
                    (el === undefined ? this : el).each(function () {
                        var $this = $(this);
                        $this.removeClass(dC).parent().removeClass(dC).end().find("input").removeAttr('disabled');
                        $this.find('input').trigger({
                            'type': nS + '.ae',
                            'el': $this
                        });
                    });
                }
            };
    $.fn.nStCheck = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.nStCheck');
        }
    };
    $.nStCheck = function (m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstCheck end*/
/*plugin nstRadio*/
(function ($) {
    var nS = "nstradio",
            methods = {
                init: function (options) {
                    var optionsRadio = $.extend({
                        wrapper: $(".frame-label:has(.niceRadio)"),
                        elCheckWrap: '.niceRadio',
                        classRemove: null,
                        before: function () {
                        },
                        after: function () {
                        }
                    }, options),
                            settings = optionsRadio;
                    var $this = this;
                    if ($.existsN($this)) {
                        $this.each(function () {
                            var $this = $(this),
                                    after = settings.after,
                                    before = settings.before,
                                    classRemove = settings.classRemove,
                                    wrapper = settings.wrapper,
                                    elCheckWrap = settings.elCheckWrap,
                                    input = $this.find(elCheckWrap).find('input');
                            $this.find(elCheckWrap).each(function () {
                                methods.changeRadioStart($(this), classRemove, after, true);
                            });
                            input.each(function () {
                                var input = $(this);
                                $(input.data('link')).focus(function (e) {
                                    if (e.which === 0)
                                        methods.radioCheck(input.parent(), after, false);
                                });
                            });
                            $this.find(wrapper).off('click.' + nS).on('click.' + nS, function (e) {
                                var input = $(this).find('input');
                                if (!input.is(':disabled') && !input.is(':checked')) {
                                    before($(this));
                                    methods.changeRadio($(this).find(elCheckWrap), after, false);
                                }
                            });
                            input.off('click.' + nS).off('change.' + nS).on('click.' + nS + ' change.' + nS, function (e) {
                                e.preventDefault();
                                e.stopPropagation();
                            });
                            input.off('mousedown.' + nS).on('mousedown.' + nS, function (e) {
                                e.preventDefault();
                                e.stopPropagation();
                                $(this).closest(wrapper).trigger('click.' + nS);
                            });
                        });
                    }
                },
                changeRadioStart: function (el, classRemove, after, start)
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
                changeRadio: function (el, after, start)
                {
                    if (el === undefined)
                        el = this;
                    methods.radioCheck(el, after, start);
                },
                radioCheck: function (el, after, start) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    el.addClass(aC).removeClass(dC);
                    el.parent().addClass(aC).removeClass(dC);
                    input.attr("checked", true);
                    $(input.data('link')).focus();
                    input.closest('form').find('[name=' + input.attr('name') + ']').not(input).each(function () {
                        methods.radioUnCheck($(this).parent());
                    });
                    after(el, start);
                    $(document).trigger({
                        'type': 'nStRadio.RC',
                        'el': el,
                        'input': input
                    });
                },
                radioUnCheck: function (el) {
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
                radioDisabled: function (el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.attr('disabled', 'disabled');
                    el.removeClass(aC).addClass(dC);
                    el.parent().removeClass(aC).addClass(dC);
                },
                radioUnDisabled: function (el) {
                    if (el === undefined)
                        el = this;
                    var input = el.find("input");
                    input.removeAttr('disabled');
                    el.removeClass(aC + ' ' + dC);
                    el.parent().removeClass(aC + ' ' + dC);
                }
            };
    $.fn.nStRadio = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.nStRadio');
        }
    };
    $.nStRadio = function (m) {
        return methods[m];
    };
})(jQuery);
/*plugin nstRadio end*/
/*plugin autocomplete*/
(function ($) {
    var methods = {
        init: function (options) {
            var settings = $.extend({
                item: 'ul > li',
                duration: 300,
                delay: 600,
                searchPath: "/shop/search/ac" + locale,
                inputString: $('#inputString'),
                minValue: 3,
                underscoreLayout: '#searchResultsTemplate',
                blockEnter: true
            }, options);
            var searchXhr = {};
            function postSearch() {
                $(document).trigger({
                    'type': 'autocomplete.before',
                    'el': inputString
                });
                if (searchXhr['search'])
                    searchXhr['search'].abort();
                searchXhr['search'] = $.ajax({
                    'type': 'post',
                    'url': searchPath,
                    'data': {
                        queryString: inputString.val()
                    },
                    'success': function (data) {
                        try {
                            var dataObj = JSON.parse(data),
                                    html = _.template($(underscoreLayout).html(), {
                                        'items': dataObj
                                    });
                        } catch (e) {
                            var html = e.toString();
                        }
                        $thisS.html(html);
                        $thisS.fadeIn(durationA, function () {
                            $(document).trigger({
                                'type': 'autocomplete.after',
                                'el': $thisS,
                                'input': inputString
                            });
                            $thisS.off('click.autocomplete').on('click.autocomplete', function (e) {
                                e.stopImmediatePropagation();
                            });
                            body.off('click.autocomplete').on('click.autocomplete', function (event) {
                                closeFrame();
                            }).off('keydown.autocomplete').on('keydown.autocomplete', function (e) {
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
                        itemserch.mouseover(function () {
                            var $this = $(this);
                            $this.addClass('selected');
                            selectorPosition = $this.index();
                            lookup(itemserch, selectorPosition);
                        }).mouseleave(function () {
                            $(this).removeClass('selected');
                        });
                        lookup(itemserch, selectorPosition);
                    }
                });
            }
            function lookup(itemserch, selectorPosition) {
                inputString.keyup(function (event) {
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
                            itemserchS.each(function (i, el) {
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
                    postTime,
                    blockEnter = settings.blockEnter,
                    itemA = settings.item,
                    durationA = settings.duration,
                    delay = settings.delay,
                    searchPath = settings.searchPath,
                    selectorPosition = -1,
                    inputString = settings.inputString,
                    underscoreLayout = settings.underscoreLayout,
                    minValue = settings.minValue;
            var submit = inputString.closest('form').find('[type="submit"]');
            if (blockEnter)
                submit.on('click.autocomplete', function (e) {
                    e.preventDefault();
                    inputString.focus();
                    $(document).trigger({
                        type: 'autocomplete.fewLength',
                        el: inputString,
                        value: minValue
                    });
                });
            inputString.keyup(function (event) {
                if (postTime)
                    clearTimeout(postTime);
                var $this = $(this);
                var inputValL = $this.val().length;
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (inputValL > minValue) {
                    $this.tooltip('remove');
                    if (code !== 27 && code !== 40 && code !== 38 && code !== 39 && code !== 37 && code !== 13 && inputValL !== 0 && $.trim($this.val()) !== "") {
                        postTime = setTimeout(postSearch, delay);
                    }
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
                    submit.off('click.autocomplete').on('click.autocomplete', function (e) {
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
            }).blur(function () {
                closeFrame();
            });
            inputString.keypress(function (event) {
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (code === 13 && $(this).val().length <= minValue)
                    return false;
            });
        }
    };
    $.fn.autocomplete = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.autocomplete');
        }
    };
    $.autocomplete = function (m) {
        return methods[m];
    };
})(jQuery);
/*plugin autocomplete end*/
/*plugin tooltip*/
(function ($) {
    var nS = 'tooltip',
            tooltip = '.tooltip',
            methods = {
                def: {
                    title: '',
                    otherClass: '',
                    effect: '',
                    textEl: '.text-el',
                    placement: 'top',
                    offsetX: 0,
                    offsetY: 0,
                    tooltip: '.tooltip',
                    durationOn: 300,
                    durationOff: 200,
                    show: false
                },
                init: function (options) {
                    this.each(function () {
                        if (!options)
                            options = {};
                        var $this = $(this),
                                elSet = $this.data(),
                                set = {};
                        for (var i in methods.def) {
                            var prop = (elSet[i] !== undefined ? elSet[i] : '').toString() || (options[i] !== undefined ? options[i] : '').toString() || methods.def[i].toString();
                            if (!isNaN(parseFloat(methods.def[i])) && isFinite(methods.def[i]))
                                set[i] = +(prop);
                            else
                                set[i] = prop;
                        }

                        if ($.exists(set.tooltip))
                            tooltip = $(set.tooltip);
                        else
                            tooltip = $(set.tooltip).appendTo(body);
                        if (set.effect !== 'always')
                            $this.data(set);
                        else
                            $this.data('title', '');
                        var textEl = $this.find(set.textEl);
                        if (textEl.is(':visible') && $.existsN(textEl))
                            return $this;
                        tooltip.html(set.title);
                        if (set.otherClass) {
                            if (!$.exists(set.tooltip + '.' + set.otherClass))
                                $(tooltip).first().clone().appendTo(body).addClass(set.otherClass);
                            tooltip = $(set.tooltip + '.' + set.otherClass).data(set);
                        }

                        if (set.effect === 'mouse')
                            $this.off('mousemove.' + nS).on('mousemove.' + nS, function (e) {
                                tooltip.html(set.title).show().css({
                                    'left': methods.left($(this), tooltip, set.placement, e.pageX, set.effect, set.offsetX),
                                    'top': methods.top($(this), tooltip, set.placement, e.pageY, set.effect, set.offsetY)
                                });
                            });
                        tooltip.removeClass('top bottom right left').addClass(set.placement);
                        tooltip.css({
                            'left': methods.left($this, tooltip, set.placement, $this.offset().left, set.effect, set.offsetX),
                            'top': methods.top($this, tooltip, set.placement, $this.offset().top, set.effect, set.offsetY)
                        });
                        if (set.show === 'true')
                            tooltip.fadeIn(set.durationOn);
                        $this.off('mouseleave.' + nS).on('mouseleave.' + nS, function (e) {
                            var el = $(this);
                            if (set.effect !== 'always')
                                el.tooltip('remove', e);
                        });
                        $this.filter(':input').off('blur.' + nS).on('blur.' + nS, function (e) {
                            $(this).tooltip('remove', e);
                        });
                    });
                    return this;
                },
                show: function (options) {
                    methods.init.call(this, $.extend({show: true}, options));
                },
                left: function (el, tooltip, placement, left, eff, offset) {
                    if (placement === 'left')
                        return Math.ceil(left - (eff === 'mouse' ? offset : tooltip.actual('outerWidth') - offset));
                    if (placement === 'right')
                        return Math.ceil(left + (eff === 'mouse' ? offset : el.outerWidth() + offset));
                    else
                        return Math.ceil(left - (eff === 'mouse' ? offset : (tooltip.actual('outerWidth') - el.outerWidth()) / 2));
                },
                top: function (el, tooltip, placement, top, eff, offset) {
                    if (placement === 'top')
                        return Math.ceil(top - (eff === 'mouse' ? offset : tooltip.actual('outerHeight') - offset));
                    if (placement === 'bottom')
                        return Math.ceil(top + (eff === 'mouse' ? offset : tooltip.actual('outerHeight') + offset));
                    else {
                        return Math.ceil(top - (eff === 'mouse' ? offset : (tooltip.actual('outerHeight') - el.outerHeight()) / 2));
                    }
                },
                remove: function (e) {
                    this.each(function () {
                        var $this = $(this),
                                tooltip = $(methods.def.tooltip);
                        if ($this instanceof jQuery && $this['data']) {
                            var data = $this.data(),
                                    durOff = $this.data('durationOff');
                            if (data.tooltip !== '.tooltip')
                                tooltip = tooltip.add($(data.tooltip));
                            if (data.otherClass)
                                tooltip = tooltip.add($('.' + data.otherClass));
                        }
                        else
                            durOff = methods.def.durationOff;
                        $(tooltip).stop().fadeOut(durOff, function () {
                            var $this = $(this);
                            if ($this.data('otherClass') && $this.data('otherClass') !== '')
                                $this.remove();
                        });
                    });
                    return this;
                }
            };
    $.fn.tooltip = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return handlerTooltip.call(this, arguments[0], null);
        } else {
            $.error('Method ' + method + ' does not exist on $.tooltip');
        }
    };
    $.tooltip = function (m) {
        return methods[m];
    };
    function handlerTooltip(o, e) {
        $(this).each(function () {
            if (e && $(e.relatedTarget).has('[data-rel="tooltip"]'))
                $(tooltip).hide();
            $(this).tooltip('init', o);
        });
        return $(this);
    }
    ;
    body.on('mouseenter.' + nS, '[data-rel="tooltip"]', function (e) {
        handlerTooltip.call(this, {show: true}, e);
    }).on('click.' + nS + ' mouseup.' + nS, function (e) {
        if ($(this).data('effect') === 'always')
            $.tooltip('remove')(e);
    });
    if (!$.exists(tooltip))
        body.append('<span class="tooltip"></span>');
})(jQuery);
/*plugin tooltip end*/
/*plugin menuImageCms for main menu shop*/
(function ($) {
    var methods = {
        _position: function (menuW, $thisL, dropW, drop, $thisW, countColumn, sub2, direction) {
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
        init: function (options) {
            this.each(function () {
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
                                classRemove: 'not-js',
                                vertical: false
                            }, options);
                    menu.data('options', optionsMenu);
                    var settings = optionsMenu,
                            menuW = menu.width(),
                            item = settings.item,
                            menuItem = menu.find(item),
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
                            duration = settings.duration,
                            timeDurM = settings.duration,
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
                            classRemove = settings.classRemove,
                            vertical = settings.vertical;
                    if (menuCache && !refresh) {
                        menu.find('a').each(function () {//if start without cache and remove active item
                            var $this = $(this);
                            $this.closest(activeFl.split(' ')[0]).removeClass(aC);
                            $this.removeClass(aC);
                        });
                        var locHref = location.origin + location.pathname,
                                locationHref = otherPage !== undefined ? otherPage : locHref;
                        menu.find('a[href="' + locationHref + '"]').each(function () {
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
                            dropOJ.find(sub3Frame).each(function () {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref2 + '([0-9]+))'),
                                        numbColumn = [];
                                columnsObj.each(function (i) {
                                    numbColumn[i] = $(this).attr('class').match(new RegExp(columnClassPref2 + '([0-9]+)'))[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL > 1) {
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function (n, i) {
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
                            dropOJ.each(function () {
                                var $this = $(this),
                                        columnsObj = $this.find(':regex(class,' + columnClassPref + '([0-9]|-1+))'),
                                        numbColumn = [];
                                columnsObj.each(function (i) {
                                    numbColumn[i] = $(this).attr('class').match(/([0-9]|-1+)/)[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL === 1 && $.inArray('0', numbColumn) === -1 || numbColumnL > 1) {
                                    if ($.inArray('-1', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('-1');
                                    }
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function (n, i) {
                                        var $thisLi = columnsObj.filter('.' + columnClassPref + n),
                                                sumx = 0;
                                        $thisLi.each(function () {
                                            var datax = +$(this).attr('data-x');
                                            sumx = parseInt(datax === 0 || !datax ? 1 : datax) > sumx ? parseInt(datax === 0 || !datax ? 1 : datax) : sumx;
                                        });
                                        $this.children().append('<li class="x' + sumx + '" data-column="' + n + '" data-x="' + sumx + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append($thisLi.clone());
                                    });
                                    columnsObj.remove();
                                }
                                var sumx = 0;
                                $this.children().children().each(function () {
                                    var datax = +$(this).attr('data-x');
                                    sumx = sumx + parseInt(datax === 0 || !datax ? 1 : datax);
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
                    menuItem.each(function (index) {
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
                                dropW2 = dropW;
                            methods._position(menuW, $thisL, dropW2, $thisDrop, $thisW, countColumn, sub2Frame, direction);
                        }
                        $this.data('kk', 0);
                    });
                    if (!vertical)
                        menuItem.css('height', sH);
                    if (!vertical)
                        menuItem.find('.helper:first').css('height', sH);
                    menu.removeClass(classRemove);
                    var hoverTO = '';
                    function closeMenu(el) {
                        if (el && $.existsN(el.parents(item)))
                            return false;
                        var $thisDrop = menu.find(drop);
                        if ($thisDrop.length !== 0)
                            menu.removeClass(hM);
                        if (evLS === 'click' || evLF === 'click') {
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
                    menuItem.off('click').off('hover')[evLF](function (e) {
                        var $this = $(this);
                        if (evLF === 'click')
                            e.stopPropagation();
                        if ($this.data("show") === "no" || !$this.data("show")) {
                            $this.data("show", "yes");
                            clearTimeout(hoverTO);
                            closeMenu($this);
                            var $thisI = $this.index(),
                                    $thisDrop = $this.find(drop).first();
                            $this.addClass(hM);
                            if ($thisI === 0)
                                $this.addClass('firstH');
                            if ($thisI === itemMenuL - 1)
                                $this.addClass('lastH');
                            if ($(e.relatedTarget).is(menuItem) || $.existsN($(e.relatedTarget).parents(menuItem)) || $this.data('kk') === 0)
                                k[$thisI] = true;
                            if (k[$thisI]) {
                                hoverTO = setTimeout(function () {
                                    $thisDrop[effOn](durationOn, function (e) {
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
                                            listDrop.children().off('click').off('hover')[evLS](function (e) {
                                                var $this = $(this);
                                                if (evLS === 'click')
                                                    e.stopPropagation();
                                                if ($this.data("show") === "no" || !$this.data("show")) {
                                                    $this.data("show", "yes");
                                                    subFrame = $this.find(sub2Frame);
                                                    if (e.type !== 'click' && evLS !== 'click') {
                                                        $this.siblings().removeClass(hM);
                                                    }
                                                    if ($.existsN(subFrame)) {
                                                        if (e.type === 'click' && evLS === 'click') {
                                                            e.stopPropagation();
                                                            $this.siblings().filter('.' + hM).click();
                                                            $this.addClass(hM);
                                                        }
                                                        else
                                                            $this.has(sub2Frame).addClass(hM);
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
                                                                complete: function () {
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
                                                        subFrame[effOnS](durationOnS, function () {
                                                            subFrame.css('height', subHL2);
                                                        });
                                                    }
                                                    else
                                                        return true;
                                                }
                                                else {
                                                    $this.data("show", "no");
                                                    if (e.type === 'click' && evLS === 'click') {
                                                        e.stopPropagation();
                                                    }
                                                    var subFrame = $this.find(sub2Frame);
                                                    if ($.existsN(subFrame)) {
                                                        subFrame.hide();
                                                        $thisDrop.css({
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
                            function (e) {
                                menuItem.each(function () {
                                    $(this).data('kk', 0);
                                });
                                timeDurM = 0;
                            },
                            function (e) {
                                closeMenu();
                                menuItem.removeData('show');
                                menuItem.each(function () {
                                    $(this).data('kk', -1);
                                });
                                timeDurM = duration;
                            });
                    body.off('click.menu').on('click.menu', function (e) {
                        closeMenu();
                    }).off('keydown.menu').on('keydown.menu', function (e) {
                        if (!e)
                            var e = window.event;
                        if (e.keyCode === 27) {
                            closeMenu();
                        }
                    });
                    dropOJ.find('a').off('click.menuref').on('click.menuref', function (e) {
                        if (evLS === 'click') {
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
                    menuItem.find('a:first').off('click.menuref').on('click.menuref', function (e) {
                        if (!$.existsN($(this).closest(item).find(drop)))
                            e.stopPropagation();
                        if (evLF === 'click' && $.existsN($(this).closest(item).find(drop)))
                            e.preventDefault();
                    });
                }
            });
            return this;
        },
        refresh: function (optionsMenu) {
            methods.init.call(this, $.extend({}, optionsMenu ? optionsMenu : this.data('options'), {
                refresh: true
            }));
            return this;
        }
    };
    $.fn.menuImageCms = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.menuImageCms');
        }
    };
    $.menuImageCms = function (m) {
        return methods[m];
    };
})(jQuery);
/*plugin menuImageCms end*/
/*plugin tabs*/
(function ($) {
    var methods = {
        index: 0,
        init: function (options) {
            var $this = this;
            if ($.existsN($this)) {
                var settings = $.extend({
                    effectOn: 'show',
                    effectOff: 'hide',
                    durationOn: '0',
                    durationOff: '0',
                    before: function () {
                    },
                    after: function () {
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
                $this.each(function () {
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
                    refs[index].each(function (ind) {
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
                    refs[index].off('click.tabs').on('click.tabs', function (e) {
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
                                        $thisAOld = $thisAOld === $thisA ? undefined : $thisAOld,
                                        $thisAO = $($thisA),
                                        $thisS = $this.data('source') || $this.attr('href'),
                                        $thisData = $this.data('data'),
                                        $thisSel = $this.data('selector');
                                function tabsDivT() {
                                    var showBlock = $thisAO.add($('[data-id=' + $thisA + ']')),
                                            addDiv = toggle ? ($thisAO.is(':visible') && !condStart ? $([]) : showBlock) : showBlock;
                                    if ($thisA.indexOf('#') !== -1 && !$thisAO.is(':visible')) {
                                        showBlock[effectOn](durationOn, function () {
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
                                            success: function (data) {
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
                                        $thisAO.load($thisS, function () {
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
                                _.map(regRefs[index], function (n, j) {
                                    _.map(methods.hashs[0], function (m, j) {
                                        if (m === n)
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
                                    refs[index].each(function () {
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
                wnd.off('hashchange.tabs').on('hashchange.tabs', function (e) {
                    e.preventDefault();
                    _.map(location.hash.split('#'), function (i, n) {
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
        location: function (regrefs, refs) {
            var hashs1 = [],
                    hashs2 = [];
            if (location.hash === '')
            {
                var i = 0,
                        j = 0;
                _.map(refs, function (n, i) {
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
                _.map(refs, function (n, i) {
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
        startCheck: function (regrefs, hashs) {
            var hash = hashs[0].concat(hashs[1]),
                    regrefsL = regrefs.length,
                    sim = 0;
            $.map(regrefs, function (n, k) {
                var i = 0,
                        hashs2 = [].concat(hash);
                $.map(hash, function (n, j) {
                    if ($.inArray(n, regrefs[k]) >= 0)
                        i++;
                    if ($.inArray(n, regrefs[k]) >= 0 && i > 1) {
                        hashs2.splice(hashs2.indexOf(n), 1);
                    }
                });
                if (hashs2.join() === hash.join())
                    sim++;
                if (hashs2.join() !== hash.join() || sim === regrefsL)
                    $.map(hashs2, function (n, i) {
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
    $.fn.tabs = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.tabs');
        }
    };
    $.tabs = function (m) {
        return methods[m];
    };
})(jQuery);
/*/plugin tabs end*/
/*plugin drop*/
(function ($) {
    var methods = {
        init: function (options) {
            this.each(function () {
                var el = methods.destroy($(this)),
                        elSet = el.data(),
                        trigger = methods._checkProp(elSet, options, 'trigger'),
                        triggerOn = methods._checkProp(elSet, options, 'triggerOn'),
                        triggerOff = methods._checkProp(elSet, options, 'triggerOff'),
                        condTrigger = methods._checkProp(elSet, options, 'condTrigger'),
                        modal = methods._checkProp(elSet, options, 'modal');
                if (modal)
                    methods._modalTrigger(el, elSet, options);
                var rel = this.rel;
                if (rel) {
                    rel = rel.replace(methods._reg(), '');
                    var source = el.data('source') || this.href;
                    if (source) {
                        if (!$.drop.drp.galleries[rel])
                            $.drop.drp.galleries[rel] = new Array();
                        $.drop.drp.galleries[rel].push(source);
                    }
                }

                el.data({
                    'drp': options
                }).addClass('isDrop');
                if (triggerOn || triggerOff)
                    el.data({'triggerOn': triggerOn, 'triggerOff': triggerOff}).on(triggerOn + '.' + $.drop.nS + ' ' + triggerOff + '.' + $.drop.nS, function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                    }).on(triggerOn + '.' + $.drop.nS, function (e) {
                        if (condTrigger && eval('(function(){' + condTrigger + '})()'))
                            methods.open(options, null, $(this), e);
                    }).on(triggerOff + '.' + $.drop.nS, function () {
                        methods.close($(el.attr('data-drop')));
                    });
                else
                    el.data('trigger', trigger).on(trigger + '.' + $.drop.nS, function (e) {
                        if (el.parent().hasClass(aC))
                            methods.close($(el.attr('data-drop')));
                        else
                            methods.open(options, null, $(this), e);
                        e.stopPropagation();
                        e.preventDefault();
                    });
                el.on('contextmenu.' + $.drop.nS, function (e) {
                    e.preventDefault();
                });
                var href = el.data('href');
                if (href && window.location.hash.indexOf(href) !== -1 && !$.drop.drp.hrefs[href])
                    methods.open(options, null, el, null);
                if (/#/.test(href) && !$.drop.drp.hrefs[href])
                    $.drop.drp.hrefs[href] = el;
            });
            for (var i in $.drop.drp.galleries)
                if ($.drop.drp.galleries[i].length <= 1)
                    delete $.drop.drp.galleries[i];
            return $(this);
        },
        destroy: function (el) {
            el = el ? el : this;
            el.each(function () {
                var el = $(this),
                        elSet = el.data();
                el.removeClass('isDrop');
                if (elSet.trigger)
                    el.off(elSet.trigger + '.' + $.drop.nS).removeData(elSet.trigger);
                if (elSet.triggerOn)
                    el.off(elSet.triggerOn + '.' + $.drop.nS).removeData(elSet.triggerOn);
                if (elSet.triggerOff)
                    el.off(elSet.triggerOff + '.' + $.drop.nS).removeData(elSet.triggerOff);
            });
            return el;
        },
        get: function (el, set, e, hashChange) {
            if (!el)
                el = this;
            if (!set)
                set = el.data('drp');
            var elSet = el.data(),
                    source = methods._checkProp(elSet, set, 'source') || el.attr('href'),
                    always = methods._checkProp(elSet, set, 'always'),
                    modal = methods._checkProp(elSet, set, 'modal'),
                    type = methods._checkProp(elSet, set, 'type'),
                    dataType = methods._checkProp(elSet, set, 'dataType'),
                    datas = methods._checkProp(elSet, set, 'datas');
            var rel = null;
            if (el.get(0).rel)
                rel = el.get(0).rel.replace(methods._reg(), '');
            function _update(data) {
                $.drop.hideActivity();
                if (!always && !modal)
                    $.drop.drp.drops[source.replace(methods._reg(), '')] = data;
                var drop = methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), methods._checkProp(elSet, set, 'pattern'), $.drop.drp.curDefault, rel);
                drop.attr('pattern', 'yes');
                drop.find($(methods._checkProp(elSet, set, 'placePaste'))).html(data);
                methods._show(el, e, set, data, hashChange);
            }

            if ($.drop.drp.drops[source.replace(methods._reg(), '')]) {
                methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), $.drop.drp.drops[source.replace(methods._reg(), '')], null, rel);
                methods._show(el, e, set, false, hashChange);
                return el;
            }
            if (elSet.drop)
                $.ajax({
                    type: type,
                    data: datas,
                    url: source,
                    beforeSend: function () {
                        if (!methods._checkProp(elSet, set, 'moreOne'))
                            methods._closeMoreOne();
                        $.drop.showActivity();
                    },
                    dataType: modal ? 'json' : dataType,
                    success: function (data) {
                        $.drop.hideActivity();
                        if (!always && !modal)
                            $.drop.drp.drops[source.replace(methods._reg(), '')] = data;
                        if (modal)
                            methods._pasteModal(el, data, set, rel, hashChange);
                        else {
                            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), data, null, rel);
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
            else {
                $.drop.drp.curDefault = methods._checkProp(elSet, set, 'defaultClassBtnDrop') + (rel ? rel : (source ? source.replace(methods._reg(), '') : (new Date()).getTime()));
                el.data('drop', '.' + $.drop.drp.curDefault).attr('data-drop', '.' + $.drop.drp.curDefault);
                $.drop.showActivity();
                if (source.match(/jpg|gif|png|bmp|jpeg/)) {
                    var img = new Image();
                    $(img).load(function () {
                        _update($(this));
                    });
                    img.src = source;
                }
                else
                    $.ajax({
                        type: type,
                        url: source,
                        data: datas,
                        dataType: dataType ? dataType : 'html',
                        success: function (data) {
                            _update(data);
                        }
                    });
            }
            return el;
        },
        open: function (opt, datas, $this, e, hashChange) {
            e = e ? e : window.event;
            if (!$this) {
                if ($(this).hasClass('isDrop'))
                    $this = this;
                else {
                    if (datas) {
                        var modalBtnDrop = methods._checkProp(null, opt, 'modalBtnDrop');
                        if (!$.exists('[data-drop="' + modalBtnDrop + '"]')) {
                            $this = $('<div><button data-drop="' + modalBtnDrop + '" data-modal="true"></button></div>').appendTo(body).hide().children();
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, $this.data()), methods._checkProp($this.data(), opt, 'patternNotif'));
                        }
                        else
                            $this = $('[data-drop="' + modalBtnDrop + '"]');
                        $this.data('datas', datas);
                        methods._modalTrigger($this, $this.data(), opt);
                    }
                    else {
                        var sourcePref = opt.source.replace(methods._reg(), ''),
                                defaultClassBtnDrop = methods._checkProp(null, opt, 'defaultClassBtnDrop');
                        if (!$.exists('.refer' + defaultClassBtnDrop + sourcePref))
                            $this = $('<div><button class="refer' + (defaultClassBtnDrop + sourcePref) + '"></button></div>').appendTo(body).hide().children();
                        else
                            $this = $('.refer' + defaultClassBtnDrop + sourcePref);
                    }
                }
            }
            $this.each(function () {
                var $this = $(this),
                        elSet = $this.data(),
                        moreOne = methods._checkProp(elSet, opt, 'moreOne'),
                        source = methods._checkProp(elSet, opt, 'source') || $this.attr('href'),
                        modal = methods._checkProp(elSet, opt, 'modal'),
                        always = methods._checkProp(elSet, opt, 'always'),
                        drop = $(elSet.drop),
                        dropFilter = methods._checkProp(elSet, opt, 'dropFilter'),
                        start = elSet.start;
                if (always && $.existsN(drop) && !modal) {
                    drop.remove();
                    delete $.drop.drp.drops[source.replace(methods._reg(), '')];
                }
                elSet.source = source; //may delete?
                if (dropFilter && !elSet.drop) {
                    drop = methods._filterSource($this, dropFilter);
                    var _classFilter = methods._checkProp(elSet, opt, 'defaultClassBtnDrop') + (new Date()).getTime();
                    $this.attr('data-drop', '.' + _classFilter);
                    elSet.drop = '.' + _classFilter;
                    drop.addClass(_classFilter);
                }
                function _confirmF() {
                    if (!$.existsN(drop) || $.existsN(drop) && source && !$.drop.drp.drops[source.replace(methods._reg(), '')] || modal || always) {
                        if (datas && modal)
                            methods._pasteModal($this, datas, opt, null, hashChange);
                        else
                            methods.get($this, opt, e, hashChange);
                    }
                    else
                        methods._show($this, e, opt, false, hashChange);
                }

                if (!$this.parent().hasClass(aC)) {
                    if (!moreOne && !start)
                        methods._closeMoreOne();
                    if (!$this.is(':disabled')) {
                        var confirm = methods._checkProp(elSet, opt, 'confirm'),
                                prompt = methods._checkProp(elSet, opt, 'prompt');
                        if (start && !eval(start)($this, drop))
                            return false;
                        if (($.existsN(drop) && !modal || source && $.drop.drp.drops[source.replace(methods._reg(), '')]) && !always && !confirm && !prompt) {
                            methods._pasteDrop($.extend({}, $.drop.dP, opt, elSet), $.existsN(drop) ? drop : $.drop.drp.drops[source.replace(methods._reg(), '')]);
                            methods._show($this, e, opt, false, hashChange);
                        }
                        else if (prompt || confirm || source || always) {
                            if (!confirm && !prompt)
                                _confirmF();
                            else//for cofirm && prompt
                                methods._checkMethod(function () {
                                    methods.confirmPrompt(source, methods, elSet, opt, hashChange, _confirmF, e);
                                });
                        }
                        else //for front validations
                            methods._pasteModal($this, datas, opt, null, hashChange);
                    }
                }
                else
                    methods.close($($this.data('drop')));
            });
            return $this;
        },
        close: function (sel, hashChange, f) {
            var sel2 = sel;
            if (!sel2)
                sel2 = this.self ? this.self : this;
            var drop = sel2 instanceof jQuery ? sel2 : $('[data-elrun].' + aC);
            if ((drop instanceof jQuery) && $.existsN(drop)) {
                clearTimeout($.drop.drp.closeDropTime);
                drop.each(function () {
                    var drop = $(this),
                            set = $.extend({}, drop.data('drp'));
                    if (set && drop.is(':visible') && (set.modal || sel || set.place !== 'inherit' || set.inheritClose || set.overlayOpacity !== 0)) {
                        var $thisB = set.elrun;
                        if ($thisB) {
                            var $thisEOff = set.effectOff,
                                    durOff = set.durationOff;
                            function _hide() {
                                $thisB.parent().removeClass(aC);
                                $thisB.each(function () {
                                    var $thisHref = $(this).data('href');
                                    if ($thisHref) {
                                        clearTimeout($.drop.drp.curHashTimeout);
                                        $.drop.drp.curHash = hashChange ? $thisHref : null;
                                        $.drop.drp.scrollTop = wnd.scrollTop();
                                        location.hash = location.hash.replace($thisHref, '');
                                        $.drop.drp.curHashTimeout = setTimeout(function () {
                                            $.drop.drp.curHash = null;
                                            $.drop.drp.scrollTop = null;
                                        }, 400);
                                    }
                                });
                                drop.removeClass(aC);
                                methods._checkMethod(function () {
                                    methods.placeAfterClose(drop, $thisB, set);
                                });
                                drop[$thisEOff](durOff, function () {
                                    var $this = $(this),
                                            ev = set.drop ? set.drop.replace(methods._reg(), '') : '';
                                    if (set.forCenter)
                                        set.forCenter.hide();
                                    wnd.off('resize.' + $.drop.nS + ev).off('scroll.' + $.drop.nS + ev);
                                    body.off('keyup.' + $.drop.nS + ev).off('keyup.' + $.drop.nS).off('click.' + $.drop.nS);
                                    var zInd = 0,
                                            drpV = null;
                                    $('[data-elrun]:visible').each(function () {
                                        var $this = $(this);
                                        if (parseInt($this.css('z-index')) > zInd) {
                                            zInd = parseInt($this.css('z-index'));
                                            drpV = $.extend({}, $this.data('drp'));
                                        }
                                    });
                                    if (drpV && drpV.overlayOpacity !== 0 && !isTouch)
                                        body.addClass('isScroll').css({
                                            'overflow': 'hidden',
                                            'margin-right': $.drop.widthScroll
                                        });
                                    else
                                        body.removeClass('isScroll').css({
                                            'overflow': '',
                                            'margin-right': ''
                                        });
                                    if (set.dropOver && !f)
                                        set.dropOver.fadeOut(durOff);
                                    methods._resetStyleDrop($(this));
                                    $this.removeClass(set.place);
                                    if (set.closed)
                                        set.closed($thisB, $this);
                                    if (set.elClosed)
                                        eval(set.elClosed)($thisB, $this);
                                    if (set.closedG)
                                        eval(set.closedG)($thisB, $this);
                                    $this.add($(document)).trigger({
                                        type: 'closed.' + $.drop.nS,
                                        el: $thisB,
                                        drop: $this
                                    });
                                    var dC = $this.find($(set.dropContent)).data('jsp');
                                    if (dC)
                                        dC.destroy();
                                    if (f)
                                        f();
                                    if (!$.exists('[data-elrun].center:visible, [data-elrun].noinherit:visible'))
                                        $('body, html').css('height', '');
                                });
                            }
                            drop.add($(document)).trigger({
                                type: 'close.' + $.drop.nS,
                                el: $thisB,
                                drop: drop
                            });
                            var close = set.elClose || set.close || set.closeG;
                            if (close) {
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
        center: function (drop, start) {
            if (!drop)
                drop = this.self ? this.self : this;
            drop.each(function () {
                var drop = $(this),
                        drp = drop.data('drp');
                if (drp && !drp.droppableIn) {
                    var method = drp.animate && !start ? 'animate' : 'css',
                            dropV = drop.is(':visible'),
                            w = dropV ? drop.outerWidth() : drop.actual('outerWidth'),
                            h = dropV ? drop.outerHeight() : drop.actual('outerHeight'),
                            top = Math.floor((wnd.height() - h) / 2),
                            left = Math.floor((wnd.width() - w - $.drop.widthScroll) / 2);
                    drop[method]({
                        'top': top > 0 ? top : 0,
                        'left': left > 0 ? left : 0
                    }, {
                        duration: drp.durationOn,
                        queue: false
                    });
                }
            });
            return drop;
        },
        _resetStyleDrop: function (drop) {
            return drop.css({
                'z-index': '',
                'width': '',
                'height': '',
                'top': '',
                'left': '',
                'bottom': '',
                'right': '',
                'position': ''
            });
        },
        _checkProp: function (elSet, opt, prop) {
            if (!elSet)
                elSet = {};
            if (!opt)
                opt = {};
            if (!isNaN(parseFloat($.drop.dP[prop])) && isFinite($.drop.dP[prop]))
                return +((elSet[prop] !== undefined && elSet[prop] !== null ? elSet[prop].toString() : elSet[prop]) || (opt[prop] !== undefined && opt[prop] !== null ? opt[prop].toString() : opt[prop]) || $.drop.dP[prop].toString());
            if ($.drop.dP[prop] !== undefined && $.drop.dP[prop] !== null && ($.drop.dP[prop].toString().toLowerCase() === 'false' || $.drop.dP[prop].toString().toLowerCase() === 'true'))
                return ((/^true$/i).test(elSet[prop] !== undefined && elSet[prop] !== null ? elSet[prop].toString().toLowerCase() : elSet[prop])) || ((/^true$/i).test(opt[prop] !== undefined && opt[prop] !== null ? opt[prop].toString().toLowerCase() : opt[prop])) || (elSet[prop] !== undefined && elSet[prop] !== null || opt[prop] !== undefined && opt[prop] !== null ? false : $.drop.dP[prop]);
            else
                return elSet[prop] || (opt[prop] ? opt[prop] : false) || $.drop.dP[prop];
            return this;
        },
        _closeMoreOne: function () {
            if ($.exists('[data-elrun].center:visible, [data-elrun].noinherit:visible'))
                methods.close($('[data-elrun].center:visible, [data-elrun].noinherit:visible'));
            return this;
        },
        _modalTrigger: function (el, elSet, set) {
            el.off('successJson.' + $.drop.nS).on('successJson.' + $.drop.nS, function (e) {
                if (e.datas) {
                    if (e.datas.answer === "success")
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').success(e.datas.data));
                    else if (e.datas.answer === "error")
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').error(e.datas.data));
                    else
                        e.el.find(methods._checkProp(elSet, set, 'modalPlace')).empty().append(methods._checkProp(elSet, set, 'message').info(e.datas.data));
                }
            });
            return this;
        },
        _pasteModal: function (el, datas, set, rel, hashChange) {
            var elSet = el.data(),
                    drop = $(elSet.drop);
            datas = datas || el.data('datas');
            methods._pasteDrop($.extend({}, $.drop.dP, set, elSet), drop, null, rel);
            el.trigger({
                type: 'successJson.' + $.drop.nS,
                el: drop,
                datas: datas
            });
            methods._show(el, null, set, datas, hashChange);
            return this;
        },
        _reg: function () {
            return /[^a-zA-Z0-9]+/ig;
        },
        _pasteDrop: function (set, drop, addClass, rel) {
            if (drop instanceof jQuery && drop.attr('pattern'))
                drop.find(drop.data('drp').placePaste).empty().append($.drop.drp.drops[set.source.replace(methods._reg(), '')]);
            addClass = addClass ? addClass : '';
            rel = rel ? rel : '';
            if (set.place === 'inherit') {
                if (set.placeInherit)
                    drop = $(drop).appendTo($(set.placeInherit).empty());
            }
            else {
                function _for_center(rel) {
                    body.append('<div class="forCenter" data-rel="' + rel + '" style="left: 0;width: 100%;display:none;height: 100%;position: absolute;height: 100%;overflow-x: auto;overflow-y: scroll;"></div>');
                }
                if (set.place === 'noinherit')
                    drop = $(drop).appendTo(body);
                else {
                    var sel = '[data-rel="' + set.drop + '"].forCenter';
                    if (!$.exists(sel))
                        _for_center(set.drop);
                    var drp = $(sel).find('[data-elrun]').data('drp') || {};
                    drop = $(drop).appendTo($(sel).empty());
                    drop.data('drp', drp);
                }
            }
            return drop.addClass(addClass).filter(set.drop).attr('data-rel', rel).attr('data-elrun', set.drop);
        },
        _pasteContent: function ($this, drop, opt) {
            function _pasteContent(content, place) {
                if (content) {
                    place = drop.find(place);
                    if (typeof content === 'string' || typeof content === 'number' || typeof content === 'object')
                        place.empty().append(content);
                    else if (typeof content === 'function')
                        content(place, $this, drop);
                }
            }
            _pasteContent(opt.contentHeader, opt.dropHeader);
            _pasteContent(opt.contentContent, opt.dropContent);
            _pasteContent(opt.contentFooter, opt.dropFooter);
            return this;
        },
        _show: function ($this, e, set, data, hashChange) {
            $this = $this ? $this : this;
            e = e ? e : window.event;
            var elSet = $this.data(),
                    rel = null,
                    opt = {},
                    self = $this.get(0);
            set = $.extend({}, set ? set : elSet.drp);
            if (self.rel)
                rel = self.rel.replace(methods._reg(), '');
            for (var i in $.drop.dP)
                opt[i] = methods._checkProp(elSet, set, i);
            //callbacks for element, options and global $.drop.dP
            opt.elStart = elSet.start;
            opt.elBefore = elSet.before;
            opt.elAfter = elSet.after;
            opt.elClose = elSet.close;
            opt.elClosed = elSet.closed;
            //
            opt.before = set.before;
            opt.after = set.after;
            opt.close = set.close;
            opt.closed = set.closed;
            //
            opt.beforeG = $.drop.dP.before;
            opt.afterG = $.drop.dP.after;
            opt.closeG = $.drop.dP.close;
            opt.closedG = $.drop.dP.closed;
            //
            opt.drop = elSet.drop;
            var drop = $('[data-elrun="' + opt.drop + '"]'),
                    drp = $.extend({}, drop.data('drp'));
            opt.elrun = drp.elrun ? drp.elrun.add($this) : $this;
            opt.rel = rel;
            $this.attr({
                'data-drop': opt.drop
            }).parent().addClass(aC);
            drop.data('drp', $.extend(drp, opt, {
                'methods': $.extend({}, {
                    'self': drop,
                    'elrun': opt.elrun
                }, $.drop.methods())
            }));
            methods._checkMethod(function () {
                methods.galleries($this, set, methods);
            });
            var overlays = $('.overlayDrop').css('z-index', 1103),
                    condOverlay = opt.overlayOpacity !== 0,
                    dropOver = null;
            if (condOverlay) {
                if (!$.exists('[data-rel="' + opt.drop + '"].overlayDrop'))
                    body.append('<div class="overlayDrop" data-rel="' + opt.drop + '" style="display:none;position:absolute;width:100%;left:0;top:0;"></div>');
                dropOver = $('[data-rel="' + opt.drop + '"].overlayDrop');
                drop.data('drp').dropOver = dropOver;
                dropOver.css('height', '').css({
                    'background-color': opt.overlayColor,
                    'opacity': opt.overlayOpacity,
                    'height': $(document).height(),
                    'z-index': overlays.length + 1103
                });
            }

            $('.forCenter').css('z-index', 1104);
            var forCenter = null,
                    objForC = $('[data-rel="' + opt.drop + '"].forCenter');
            if ($.existsN(objForC))
                forCenter = objForC;
            if (forCenter) {
                if (isTouch)
                    forCenter.css('height', '').css('height', $(document).height());
                drop.data('drp').forCenter = forCenter;
                forCenter.css('z-index', overlays.length + 1104);
            }
            drop.css('z-index', overlays.length + 1104);
            methods._pasteContent($this, drop, opt);
            if (opt.elBefore)
                eval(opt.elBefore)($this, drop, data);
            if (opt.before)
                opt.before($this, drop, data);
            if (opt.beforeG)
                opt.beforeG($this, drop, data);
            drop.add($(document)).trigger({
                'type': 'before.' + $.drop.nS,
                'el': $this,
                'drop': drop,
                'datas': data
            });
            drop.addClass(opt.place);
            methods._positionType(drop);
            if (!isTouch && opt.place !== 'inherit' && opt.overlayOpacity !== 0)
                body.addClass('isScroll').css({'overflow': 'hidden', 'margin-right': $.drop.widthScroll});
            methods._checkMethod(function () {
                methods.limitSize(drop);
            });
            methods._checkMethod(function () {
                methods.heightContent(drop);
            });
            if (forCenter)
                forCenter.css('top', wnd.scrollTop()).show();
            methods._checkMethod(function () {
                methods.placeBeforeShow(drop, $this, methods, opt.place, opt.placeBeforeShow);
            });
            if (opt.place !== 'inherit')
                methods._checkMethod(function () {
                    methods[opt.place](drop);
                });
            var href = $this.data('href');
            if (href) {
                clearTimeout($.drop.drp.curHashTimeout);
                $.drop.drp.curHash = !hashChange ? href : null;
                $.drop.drp.scrollTop = wnd.scrollTop();
                var wlh = window.location.hash;
                if (href.indexOf('#') !== -1 && (new RegExp(href + '#|' + href + '$').exec(wlh) === null))
                    window.location.hash = wlh + href;
                $.drop.drp.curHashTimeout = setTimeout(function () {
                    $.drop.drp.curHash = null;
                    $.drop.drp.scrollTop = null;
                }, 400);
            }
            if (opt.confirm) {
                function focusConfirm() {
                    $(opt.confirmActionBtn).focus();
                }
                setTimeout(focusConfirm, 0);
                drop.click(focusConfirm);
            }
            $(opt.next).add($(opt.prev)).css('height', drop.actual('height'));
            var ev = opt.drop ? opt.drop.replace(methods._reg(), '') : '';
            wnd.off('resize.' + $.drop.nS + ev).on('resize.' + $.drop.nS + ev, function () {
                methods._checkMethod(function () {
                    methods.limitSize(drop);
                });
                methods._checkMethod(function () {
                    methods.heightContent(drop);
                });
                if (opt.place !== 'inherit')
                    methods[opt.place](drop);
                setTimeout(function () {
                    if (dropOver)
                        dropOver.css('height', '').css('height', $(document).height());
                    if (forCenter && isTouch)
                        forCenter.css('height', '').css('height', $(document).height());
                }, 100);
            });
            if (condOverlay)
                dropOver.stop().fadeIn(opt.durationOn / 2);
            if (opt.closeClick)
                $(forCenter).add(dropOver).off('click.' + $.drop.nS + ev).on('click.' + $.drop.nS + ev, function (e) {
                    if ($(e.target).is('.overlayDrop') || $(e.target).is('.forCenter'))
                        methods.close($($(e.target).attr('data-rel')));
                });
            if (opt.prompt) {
                var input = drop.find(opt.promptInput).val(opt.promptInputValue);
                function focusInput() {
                    input.focus();
                }
                setTimeout(focusInput, 0);
                drop.find('form').off('submit.' + $.drop.nS + ev).on('submit.' + $.drop.nS + ev, function (e) {
                    e.preventDefault();
                });
                drop.click(focusInput);
            }
            drop.attr('data-elrun', opt.drop).off('click.' + $.drop.nS, opt.exit).on('click.' + $.drop.nS, opt.exit, function (e) {
                e.stopPropagation();
                methods.close($(this).closest('[data-elrun]'));
            });
            body.off('keyup.' + $.drop.nS);
            if (opt.closeEsc)
                body.on('keyup.' + $.drop.nS, function (e) {
                    var key = e.keyCode;
                    if (key === 27)
                        methods.close(false);
                });
            $('html').css('height', '100%');
            body.css('height', '100%').off('click.' + $.drop.nS).on('click.' + $.drop.nS, function (e) {
                if (opt.closeClick && !$.existsN($(e.target).closest('[data-elrun]')))
                    methods.close(false);
            });
            drop[opt.effectOn](opt.durationOn, function (e) {
                var drop = $(this);
                $.drop.drp.curDrop = drop;
                if ($.existsN(drop.find('[data-drop]')))
                    methods.init.call(drop.find('[data-drop]'));
                drop.addClass(aC);
                if (opt.modal && opt.timeclosemodal)
                    $.drop.drp.closeDropTime = setTimeout(function () {
                        methods.close(drop);
                    }, opt.timeclosemodal);
                var cB = opt.elAfter;
                if (cB)
                    eval(cB)($this, drop, data);
                if (opt.after)
                    opt.after($this, drop, data);
                if (opt.afterG)
                    opt.afterG($this, drop, data);
                drop.add($(document)).trigger({
                    'type': 'after.' + $.drop.nS,
                    'el': $this,
                    'drop': drop,
                    'datas': data
                });
                if (opt.droppable && opt.place !== 'inherit')
                    methods._checkMethod(function () {
                        methods.droppable(drop);
                    });
                wnd.off('scroll.' + $.drop.nS + ev).on('scroll.' + $.drop.nS + ev, function (e) {
                    if (opt.place === 'center')
                        methods.center(drop);
                });
                if (rel && opt.keyNavigate && methods.galleries)
                    body.off('keyup.' + $.drop.nS + ev).on('keyup.' + $.drop.nS + ev, function (e) {
                        $(this).off('keyup.' + $.drop.nS + ev);
                        var key = e.keyCode;
                        if (key === 37)
                            $(opt.prev).trigger('click.' + $.drop.nS);
                        if (key === 39)
                            $(opt.next).trigger('click.' + $.drop.nS);
                    });
            });
            return this;
        },
        _checkMethod: function (f) {
            try {
                f();
            } catch (e) {
                var method = f.toString().match(/\.\S*\(/);
                returnMsg('need connect ' + method[0].substring(1, method[0].length - 1) + ' method');
            }
            return this;
        },
        _positionType: function (drop) {
            if (drop.data('drp').place !== 'inherit')
                drop.css({
                    'position': drop.data('drp').position
                });
            return this;
        },
        _filterSource: function (btn, s) {
            var source = s.split(').'),
                    regS, regM = '';
            $.each(source, function (i, v) {
                regS = (v[v.length - 1] !== ')' ? v + ')' : v).match(/\(.*\)/);
                regM = regS['input'].replace(regS[0], '');
                regS = regS[0].substring(1, regS[0].length - 1);
                btn = btn[regM](regS);
            });
            return btn;
        }
    };
    $.fn.drop = function (method) {
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
    $.dropInit = function () {
        this.nS = 'drop';
        this.method = function (m) {
            if (!/_/.test(m))
                return methods[m];
        };
        this.methods = function () {
            var newM = {};
            for (var i in methods) {
                if (!/_/.test(i))
                    newM[i] = methods[i];
            }
            return newM;
        };
        this.dP = {
            source: null,
            dataPrompt: null,
            dropContent: '.drop-content-default',
            dropHeader: '.drop-header-default',
            dropFooter: '.drop-footer-default',
            placePaste: '.placePaste',
            modalPlace: '.drop-notification-default',
            datas: null,
            contentHeader: null,
            contentFooter: null,
            contentContent: null,
            start: null,
            placeInherit: null,
            condTrigger: null,
            dropFilter: null,
            message: {
                success: function (text) {
                    return '<div class = "msg js-msg"><div class = "success"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                error: function (text) {
                    return '<div class = "msg js-msg"><div class = "error"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>';
                },
                info: function (text) {
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
            before: function () {
            },
            after: function () {
            },
            close: function () {
            },
            closed: function () {
            },
            pattern: '<div class="drop drop-style drop-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default"></div><div class="drop-content-default"><button class="drop-prev" type="button"  style="display:none;font-size: 30px;position:absolute;width: 35%;left: 20px;top:0;text-align: left;"><</button><button class="drop-next" type="button" style="display:none;font-size: 30px;position:absolute;width: 35%;right: 20px;top:0;text-align: right;">></button><div class="inside-padd placePaste" style="padding: 20px 40px;text-align: center;"></div></div><div class="drop-footer-default"></div></div>',
            modalBtnDrop: '#drop-notification-default',
            defaultClassBtnDrop: 'drop-default',
            patternNotif: '<div class="drop drop-style" id="drop-notification-default" style="background-color: #fff;"><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;"></div><div class="drop-content-default"><div class="inside-padd drop-notification-default"></div></div><div class="drop-footer-default"></div></div>',
            confirmBtnDrop: '#drop-confirm-default',
            confirmActionBtn: '[data-button-confirm]',
            patternConfirm: '<div class="drop drop-style" id="drop-confirm-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Confirm</div><div class="drop-content-default"><div class="inside-padd" style="padding: 20px 40px;text-align: center;"><div class="drop-btn-confirm" style="margin-right: 10px;"><button type="button" data-button-confirm><span class="text-el">confirm</span></button></div><div class="drop-btn-cancel"><button type="button" data-closed="closed-js"><span class="text-el">cancel</span></button></div></div></div><div class="drop-footer-default"></div></div>',
            promptBtnDrop: '#drop-prompt-default',
            promptActionBtn: '[data-button-prompt]',
            promptInput: '[name="promptInput"]',
            patternPrompt: '<div class="drop drop-style" id="drop-prompt-default" style="background-color: #fff;"><button type="button" class="icon-times-drop" data-closed="closed-js" style="position: absolute;right: 5px;top: 5px;background-color: red;width: 10px;height: 10px;"></button><div class="drop-header-default" style="padding: 10px 20px;border-bottom: 1px solid #ccc;">Prompt</div><div class="drop-content-default"><form class="inside-padd" style="padding: 20px 40px;text-align: center;"><input type="text" name="promptInput"/><div class="drop-btn-prompt" style="margin-right: 10px;"><button type="button" data-button-prompt><span class="text-el">ok</span></button></div><div class="drop-btn-cancel"><button type="submit" data-closed="closed-js"><span class="text-el">cancel</span></button></div></form></div><div class="drop-footer-default"></div></div>',
            promptInputValue: '',
            next: '.drop-next',
            prev: '.drop-prev',
            type: 'post',
            dataType: null,
            overlayOpacity: 0.7,
            durationOn: 200,
            durationOff: 100,
            timeclosemodal: 2000,
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
            limitSize: false,
            limitContentSize: false,
            scrollContent: false,
            droppableLimit: false,
            inheritClose: false,
            keyNavigate: false
        };
        this.drp = {
            hrefs: {},
            drops: {},
            galleries: {},
            scrollemulatetimeout: null,
            curHash: null,
            curDrop: null,
            curHashTimeout: null,
            scrollTop: null
        };
        this.setParameters = function (options) {
            $.extend(this.dP, options);
        };
        this.setMethods = function (ms) {
            $.extend(methods, ms);
        };
    };
    var el = $('<div/>').appendTo(body).css({
        'height': 100,
        'width': 100,
        'overflow': 'scroll'
    }).wrap($('<div style="width:0;height:0;overflow:hidden;"></div>'));
    $.dropInit.prototype.widthScroll = el.width() - el.get(0).clientWidth;
    el.parent().remove();
    var loadingTimer, loadingFrame = 1,
            loading = $('<div id="fancybox-loading"><div></div></div>').appendTo(body),
            _animate_loading = function () {
                if (!loading.is(':visible')) {
                    clearInterval(loadingTimer);
                    return;
                }
                $('div', loading).css('top', (loadingFrame * -40) + 'px');
                loadingFrame = (loadingFrame + 1) % 12;
            };
    $.dropInit.prototype.showActivity = function () {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.dropInit.prototype.hideActivity = function () {
        loading.hide();
    };
    $.drop = new $.dropInit();
    var wLH = window.location.hash;
    wnd.off('hashchange.' + $.drop.nS).on('hashchange.' + $.drop.nS, function (e) {
        e.preventDefault();
        if ($.drop.drp.scrollTop)
            $('html, body').scrollTop($.drop.drp.scrollTop);
        var wLHN = window.location.hash;
        if (!$.drop.drp.curHash)
            for (var i in $.drop.drp.hrefs) {
                if (wLH.indexOf(i) === -1 && wLHN.indexOf(i) !== -1)
                    methods.open({}, null, $.drop.drp.hrefs[i], e, true);
                else
                    methods.close($($.drop.drp.hrefs[i].data('drop')), true);
            }
        wLH = wLHN;
    });
})(jQuery);
/*/plugin drop end*/
/*plugin plusminus*/
(function ($) {
    var methods = {
        init: function (options) {
            var settings = $.extend({
                prev: 'prev',
                next: 'next',
                step: 1,
                checkProdStock: false,
                after: function () {
                },
                before: function () {
                },
                hover: function () {
                }
            }, options);
            if (this.length > 0) {
                return this.each(function () {
                    var $this = $(this),
                            $thisVal = $this.val(),
                            checkProdStock = settings.checkProdStock,
                            step = settings.step,
                            max = +$this.data('max'),
                            min = +$this.data('min'),
                            prev = settings.prev,
                            next = settings.next;
                    function _checkBtn(type) {
                        var btn = $this,
                                regS = '',
                                regM = '';
                        $.each(type, function (i, v) {
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

                    var $thisPrev = typeof prev === 'string' ? _checkBtn(prev.split('.')) : prev,
                            $thisNext = typeof next === 'string' ? _checkBtn(next.split('.')) : next;
                    if (max !== '' && $thisVal >= max && checkProdStock) {
                        $this.val(max);
                        $thisNext.attr('disabled', 'disabled');
                    }
                    if (min !== '' && $thisVal <= min && checkProdStock) {
                        $this.val(min);
                        $thisPrev.attr('disabled', 'disabled');
                    }
                    $thisNext.add($thisPrev).off('hover').hover(function (e) {
                        settings.hover(e, $(this), $this, $(this).is($thisNext) ? 'next' : 'prev');
                    });
                    $thisNext.off('click.pM').on('click.pM', function (e) {
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
                    $thisPrev.off('click.pM').on('click.pM', function (e) {
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
                                else if (inputVal > (min || 1)) {
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
    $.fn.plusminus = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.plusminus');
        }
    };
    $.plusminus = function (m) {
        return methods[m];
    };
})($);
/*/plugin plusminus end*/
/*plugin maxminValue*/
(function ($) {
    var methods = {
        init: function (e, f) {
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
    $.fn.maxminValue = function (method) {
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
    $.maxminValue = function (m) {
        return methods[m];
    };
    body.off('keypress.max', '[data-max]').on('keypress.max', '[data-max]', function (e) {
        var el = $(this);
        setTimeout(function () {
            var res = el.maxminValue(e);
            el.trigger({
                'type': 'maxminValue',
                'event': e,
                'res': res
            });
        }, 0);
    });
    body.off('keypress', '[data-min]').on('keypress', '[data-min]', function (e) {
        var key = e.keyCode,
                keyChar = parseInt(String.fromCharCode(key));
        var $this = $(this),
                $min = $this.attr('data-min');
        if ($this.val() === "" && keyChar === 0) {
            $this.val($min);
            return false;
        }
    });
    body.off('keyup', '[data-min]').on('keyup', '[data-min]', function (e) {
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
            if (e.which !== null) {  // IE
                if (e.keyCode === 46 || e.keyCode === 8)
                    $this.trigger({
                        'type': 'maxminValue',
                        'event': e
                    });
            }
            else if (e.which !== 0 && e.charCode !== 0) { // non IE
                if (e.keyCode === 46 || e.keyCode === 8)
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
(function ($) {
    var methods = {
        init: function (options) {
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
                            before: function () {
                            },
                            after: function () {
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
                $jsCarousel.each(function () {
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
                            itemVisibleInCallback: function () {
                                wnd.scroll();
                            }
                        };
                        $this.jcarousel($.extend(
                                mainO
                                , addO)).addClass('iscarousel');
                        $thisNext.add($thisPrev).css('display', 'inline-block');
                        groupButton.append($thisNext.add($thisPrev));
                        groupButton.append($thisNext.add($thisPrev));
                        var elSet = $this.data();
                        function _handlTouch(type) {
                            if (isTouch && type) {
                                var f = 'pageX',
                                        s = 'pageY';
                                if (type === 'v') {
                                    f = 'pageY';
                                    s = 'pageX';
                                }

                                $this.off('touchstart.' + nS).on('touchstart.' + nS, function (e) {
                                    e = e.originalEvent.touches[0];
                                    elSet.sP = e[f];
                                    elSet.sPs = e[s];
                                });
                                $this.off('touchmove.' + nS).on('touchmove.' + nS, function (e) {
                                    e = e.originalEvent.touches[0];
                                    elSet.eP = e[f];
                                    elSet.ePs = e[s];
                                    e.preventDefault();
                                });
                                $this.off('touchend.' + nS).on('touchend.' + nS, function (e) {
                                    if (Math.abs(elSet.eP - elSet.sP) > Math.abs(elSet.ePs - elSet.sPs))
                                        e.preventDefault();
                                    if (Math.abs(elSet.eP - elSet.sP) > 200) {
                                        if (elSet.eP - elSet.sP > 0)
                                            $thisPrev.click();
                                        else
                                            $thisNext.click();
                                    }
                                });
                            }
                        }
                        var type = false;
                        if (isHorz)
                            type = 'h';
                        if (isVert)
                            type = 'v';
                        _handlTouch(type);
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
    $.fn.myCarousel = function (method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.myCarousel');
        }
    };
    $.myCarousel = function (m) {
        return methods[m];
    };
})(jQuery);
/*/plugin myCarousel use jQarousel with correction behavior prev and next buttons end*/