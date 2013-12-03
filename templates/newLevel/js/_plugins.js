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
$.testNumber = function(e) {
    if (!e)
        var e = window.event;
    var key = e.keyCode;
    if (key === null || key === 0 || key === 8 || key === 13 || key === 9 || key === 46 || key === 37 || key === 39)
        return true;
    if ((key >= 48 && key <= 57) || (key >= 96 && key <= 105)) {
        return true;
    }
    else
        return false;
};
$.onlyNumber = function(el) {
    body.on('keydown', el, function(e) {
        if (!$.testNumber(e)) {
            $(this).tooltip();
            return false;
        }
        else {
            $(this).tooltip('remove');
        }
    });
};
$.fn.pricetext = function(e, rank) {
    var $this = $(this),
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
/*plugin nstCehck*/
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
                trigger = settings.trigger

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
                    var $this = $(this),
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
/*plugin nstCehck end*/
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
                        durationOffS: 0,
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
                    effOffS = settings.effectOffS,
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
                    durationOffS = settings.durationOffS,
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
                                columnsObj = $this.find(':regex(class,' + columnClassPref + '([0-9]+))'),
                                numbColumn = [];
                                columnsObj.each(function(i) {
                                    numbColumn[i] = $(this).attr('class').match(/([0-9]+)/)[0];
                                });
                                numbColumn = _.uniq(numbColumn).sort();
                                var numbColumnL = numbColumn.length;
                                if (numbColumnL === 1 && $.inArray('0', numbColumn) === -1 || numbColumnL > 1) {
                                    if ($.inArray('0', numbColumn) === 0) {
                                        numbColumn.shift();
                                        numbColumn.push('0');
                                    }
                                    $.map(numbColumn, function(n, i) {
                                        var $thisLi = columnsObj.filter('.' + columnClassPref + n),
                                        sumx = 0;
                                        $thisLi.each(function() {
                                            var datax = $(this).attr('data-x');
                                            sumx = parseInt(datax === 0 || datax === undefined ? 1 : datax) > sumx ? parseInt(datax === 0 || datax === undefined ? 1 : datax) : sumx;
                                        });
                                        $this.children().append('<li class="x' + sumx + '" data-column="' + n + '" data-x="' + sumx + '"><ul></ul></li>');
                                        $this.find('[data-column="' + n + '"]').children().append($thisLi.clone());
                                    });
                                    columnsObj.remove();
                                }
                                var sumx = 0;
                                $this.children().children().each(function() {
                                    var datax = $(this).attr('data-x');
                                    sumx = sumx + parseInt(datax === 0 || datax === undefined ? 1 : datax);
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
                    durationOn: 0,
                    durationOff: 0,
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
                    effectOn = settings.effectOn,
                    effectOff = settings.effectOff,
                    durationOn = settings.durationOn,
                    durationOff = settings.durationOff;
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
                        var $this = $(this);
                        var resB = settings.before($this);
                        if (resB === undefined || resB === true) {
                            if ($this.is('a'))
                                e.preventDefault();
                            var cookie = $thiss.data('cookie') !== undefined,
                            toggle = $thiss.data('type') === 'toggle',
                            condStart = e.start;
                            if (!$this.parent().hasClass('disabled')) {
                                var $thisA = $this[attrOrdata[index]]('href'),
                                $thisAOld = navTabsLi[index].filter('.' + aC).children()[attrOrdata[index]]('href'),
                                $thisAO = $($thisA),
                                $thisS = $this.data('source'),
                                $thisData = $this.data('data'),
                                $thisSel = $this.data('selector'),
                                $thisDD = $this.data('drop') !== undefined;
                                function tabsDivT() {
                                    var showBlock = $thisAO.add($('[data-id=' + $thisA + ']')),
                                    addDiv = toggle ? $([]) : showBlock;
                                    tabsDiv[index].add(tabsId[index]).not(addDiv)[effectOff](durationOff).removeClass(aC);
                                    if (!($thisAO.is(':visible') && toggle))
                                        if (!$thisAO.is(':visible'))
                                            showBlock[effectOn](durationOn, function() {
                                                settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                            }).addClass(aC);
                                }
                                if (!$thisDD) {
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
                                }
                                var wLH = window.location.hash;
                                try {
                                    var reg = wLH.match($thisAOld)[0];
                                } catch (err) {
                                    var reg = null;
                                }
                                if ((!cookie && attrOrdata[index] !== 'data') || (($.inArray($thisA, regRefs[index]) > -1 && reg !== null))) {
                                    if (!condStart) {
                                        var reg = $thisAOld !== undefined,
                                        temp = wLH;
                                        if (reg) {
                                            if (wLH.indexOf($thisA) === -1) {
                                                temp = temp.replace($thisAOld, $thisA);
                                            }
                                            else if ($thisA !== $thisAOld) {
                                                temp += $thisA;
                                            }
                                            if (!(activeP.hasClass(aC) && toggle)) {
                                                temp = temp.replace($thisA, '');
                                            }
                                        }
                                        else {
                                            temp += $thisA;
                                        }
                                        window.location.hash = temp;
                                    }
                                    else if (!$thisDD && k) {
                                        window.location.hash = _.uniq(methods.hashs[0]).join('');
                                        k = false;
                                    }
                                    if ($thisDD && condStart)
                                        $this.trigger('click.drop');
                                }
                                else if ($thiss.data('elchange') !== undefined) {
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
                wnd.on('hashchange', function(e) {
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
                        //                        if (i !== '') {
                        //                            var el = $('[data-href="#' + i + '"], [href="#' + i + '"]');
                        //                            if (el.data('drop') === undefined)
                        //                                el.trigger('click.tabs');
                        //                        }
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
                    if ($this.data('drop') === undefined && attrOrdataL !== 'data') {
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
/*plugin drop*/
(function($) {
    var methods = {
        defaultParams: {
            trigger: 'click',
            exit: '[data-closed = "closed-js"]',
            effon: 'show',
            effoff: 'hide',
            durationOn: 200,
            durationOff: 100,
            place: 'center',
            dropContent: null,
            dropHeader: null,
            dropFooter: null,
            placement: undefined,
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
            before: function() {
            },
            after: function() {
            },
            close: function() {
            },
            closed: function() {
            },
            start: undefined
        },
        init: function(options) {
            var settings = $.extend(methods.defaultParams, options);
            this.add($('[data-drop]')).each(function() {
                var el = $(this),
                trigger = (settings.trigger || el.data('trigger')).toString();

                el.off(trigger + '.drop').on(trigger + '.drop', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    methods.open($(this), e, settings)
                });
            });
            return $(this);
        },
        get: function(el, e) {
            if (el == undefined)
                el = this;
            var elSet = el.data(),
            drop = $(elSet.drop);
            $.ajax({
                type: "post",
                data: elSet.data,
                url: elSet.source,
                beforeSend: function() {
                    $(document).trigger({
                        'type': 'showActivity'
                    });
                },
                dataType: elSet.type ? elSet.type : 'html',
                success: function(data) {
                    if (elSet.type !== 'html' && elSet.type !== undefined && modal) {
                        $(document).trigger({
                            type: 'drop.successJson',
                            el: drop,
                            datas: data
                        });
                        methods._pasteDrop($.extend({}, methods.defaultParams, elSet), drop);
                    }
                    else {
                        $(document).trigger({
                            type: 'drop.successHtml',
                            el: drop,
                            datas: data
                        });
                        methods._pasteDrop($.extend({}, methods.defaultParams, elSet), data);
                    }
                    methods.init.call(drop.find('[data-drop]'), $.extend({}, methods.defaultParams));
                    methods._show(el, e, methods.defaultParams, true, data);
                }
            });
        },
        open: function($this, e, settings) {
            if (e == undefined)
                e = window.event;
            if (settings == undefined)
                settings = methods.defaultParams;
            if ($this == undefined)
                $this = this;

            var moreOne = settings.moreOne,
            confirmSel = settings.confirmSel;
            methods.closeModal();
            function _confirmF() {
                if (!$.existsN(drop) || modal || always) {
                    if (!modal)
                        drop.remove();
                    methods.get($this, e);
                }
            }
            var elSet = $this.data(),
            drop = $(elSet.drop),
            start = elSet.start !== undefined ? elSet.start : settings.start;
            if (!$this.parent().hasClass(aC)) {
                if (!(elSet.moreOne || moreOne) && start === undefined) {
                    if ($.existsN($this.closest('[data-elrun]')) && !elSet.modal)
                        methods.close($this.closest('[data-elrun]'));
                    if ($.existsN($('[data-elrun].center:visible, [data-elrun].noinherit:visible')))
                        methods.close($('[data-elrun].center:visible, [data-elrun].noinherit:visible'));
                }

                if (!$this.is(':disabled')) {
                    var modal = elSet.modal || settings.modal,
                    confirm = elSet.confirm || settings.confirm,
                    always = elSet.always || settings.always;
                    if (start !== undefined) {
                        var res = eval(start)($this, drop);
                        if (!res)
                            return false;
                    }
                    if (start === undefined || (start !== undefined && res)) {
                        if ($.existsN(drop) && !modal && !always && !confirm) {
                            methods._pasteDrop($.extend({}, settings, elSet), drop);
                            methods._show($this, e, methods.defaultParams, false);
                        }
                        else if (elSet.source || always || confirm) {
                            if (!confirm)
                                _confirmF();
                            else {
                                methods._pasteDrop($.extend({}, settings, $('[data-drop="' + confirmSel + '"]').data()), $(confirmSel));
                                methods._show($('[data-drop="' + confirmSel + '"]').data({
                                    'elrun': $this
                                }), e, methods.defaultParams, false);
                                $('[data-button-confirm]').focus().on('click.drop', function() {
                                    if (elSet.after)
                                        $(confirmSel).data('elClosed', elSet.after)
                                    methods.close($(confirmSel));
                                    $this.data('confirm', false);
                                    if (elSet.source)
                                        _confirmF();
                                });
                            }
                        }
                        else {//for front validations
                            methods._pasteDrop($.extend({}, settings, elSet), drop);
                            methods._show($this, e, methods.defaultParams, false);
                        }
                    }
                }
            }
            else
                methods.close($($this.data('drop')));

            return $this;
        },
        _pasteDrop: function(elSet, drop) {
            if (elSet.place !== 'inherit') {
                function _for_center(rel) {
                    body.append('<div class="for-center" rel="' + elSet.drop + '" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;dispaly:none;overflow: hidden;"></div>');
                }
                if (typeof drop !== 'string') {
                    if (!$.existsN(drop.parent('.for-center')) && elSet.place !== 'noinherit') {
                        if (drop.data('forCenter') === undefined) {
                            _for_center(elSet.drop);
                            drop.data('forCenter', $('[rel="' + elSet.drop + '"].for-center'));
                        }
                        drop.data('forCenter').append(drop);
                    }
                    else if (elSet.place === 'noinherit')
                        body.append(drop);
                }
                else {
                    if (elSet.place === 'noinherit')
                        body.append(drop);
                    else {
                        var sel = '[rel="' + elSet.drop + '"].for-center';
                        if (!$.exists(sel)) {
                            _for_center(elSet.drop);
                        }
                        var forCenter = $(sel);
                        forCenter.append(drop);
                        $(elSet.drop).data('forCenter', forCenter);
                    }
                }
            }
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
            
            if (drop.data('dropContent')){
                var el = drop.find(drop.data('dropContent')).filter(':first');


                if ($.existsN(el)) {
                    var docH = $(document).height(),
                    refer = drop.data('elrun');
                    if (!dropV) {
                        drop.show();
                        if (drop.data('forCenter'))
                            drop.data('forCenter').show();
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
                    footerHeader = drop.find(drop.data('dropHeader')).outerHeight(true) + drop.find(drop.data('dropFooter')).outerHeight(true);

                    if (drop.data('place') == 'noinherit') {
                        var mayHeight = 0,
                        placement = eval(drop.data('placement'));

                        if (typeof eval(placement) == 'object') {
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
                        if (drop.data('forCenter'))
                            drop.data('forCenter').hide();
                    }
                }
            }
        },
        _show: function($this, e, set, isajax, data) {
            if ($this === undefined)
                $this = this;
            if (e === undefined)
                e = window.event;
            var set = !set ? methods.defaultParams : set,
            isajax = !isajax ? false : true,
            elSet = $this.data(),
            trigger = elSet.trigger || set.trigger,
            place = elSet.place || set.place,
            placement = elSet.placement || set.placement,
            $thisEOff = elSet.effectOff || set.effoff,
            $thisD = elSet.durationOn !== undefined ? elSet.durationOn.toString() : elSet.durationOn || set.durationOn,
            $thisDOff = elSet.durationOff !== undefined ? elSet.durationOff.toString() : elSet.durationOff || set.durationOff,
            $thisA = elSet.animate !== undefined ? elSet.animate : set.animate,
            $thisEOn = elSet.effectOn || set.effon,
            overlayColor = elSet.overlayColor || set.overlayColor,
            overlayOpacity = elSet.overlayOpacity !== undefined ? elSet.overlayOpacity.toString() : elSet.overlayOpacity || set.overlayOpacity,
            modal = elSet.modal || set.modal,
            timeclosemodal = elSet.timeclosemodal || set.timeclosemodal,
            confirm = elSet.confirm || set.confirm,
            dropContent = elSet.dropContent || set.dropContent,
            dropHeader = elSet.dropHeader || set.dropHeader,
            dropFooter = elSet.dropFooter || set.dropFooter,
            position = elSet.position !== undefined ? elSet.position : set.position,
            placeBeforeShow = elSet.placeBeforeShow || set.placeBeforeShow,
            placeAfterClose = elSet.placeAfterClose || set.placeAfterClose,
            moreOne = elSet.moreOne || set.moreOne,
            delayAfter = elSet.delayAfter || set.delayAfter,
            closeClick = elSet.closeClick || set.closeClick,
            closeEsc = elSet.closeEsc || set.closeEsc,
            start = elSet.start,
            elBefore = elSet.before,
            elAfter = elSet.after,
            before = set.before,
            after = set.after,
            close = set.close,
            elClose = elSet.close,
            closed = set.closed,
            elClosed = elSet.closed,
            selSource = elSet.drop,
            drop = $(selSource);
            $this.attr('data-drop', $this.data('drop')).parent().addClass(aC);
            methods.defaultParams.durationOff = $thisDOff;
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
                'closeEsc': closeEsc
            }).attr('data-elrun', selSource);
            drop.off('click.drop', set.exit).on('click.drop', set.exit, function() {
                methods.close($(this).closest('[data-elrun]'));
            });
            var condOverlay = (overlayOpacity !== undefined ? overlayOpacity.toString() : overlayOpacity) !== '0';
            if (condOverlay) {
                if (!$.exists('[rel="' + selSource + '"].overlayDrop')) {
                    body.append('<div class="overlayDrop" rel="' + selSource + '" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;"></div>');
                }
                var overlays = $('.overlayDrop');
                overlays.css('z-index', 1103);
                drop.data('dropOver', $('[rel="' + selSource + '"].overlayDrop'));
                drop.data('dropOver').css({
                    'background-color': overlayColor,
                    'opacity': overlayOpacity,
                    'z-index': overlays.length + 1103
                });
                if (drop.data('forCenter')) {
                    $('.for-center').css('z-index', 1104);
                    drop.data('forCenter').css('z-index', overlays.length + 1104);
                }
            }
            if (drop.hasClass(aC)) {
                methods.close(drop);
            }
            else {
                methods.heightContent(drop);
                before($this, drop, isajax, data, elSet);
                if (elBefore !== undefined)
                    eval(elBefore)($this, drop, isajax, data, elSet);
                $(document).trigger({
                    'type': 'drop.before',
                    'el': $this,
                    'drop': drop,
                    'isajax': isajax,
                    'datas': data,
                    'elSet': elSet
                });
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
                wnd.off('resize.drop').on('resize.drop', function() {
                    clearTimeout(dropTimeout);
                    dropTimeout = setTimeout(function() {
                        if (place === 'noinherit')
                            methods.noinherit(drop);
                        if (place === 'center')
                            methods.center(drop);
                    }, 300);
                });
                if (condOverlay) {
                    drop.data('dropOver').fadeIn($thisD / 2);
                    if (closeClick)
                        drop.data('dropOver').add(drop.data('forCenter')).off('click.drop').on('click.drop', function(e) {
                            if ($(e.target).is(drop.data('dropOver')) || $(e.target).is('.for-center')) {
                                methods.close($($(e.target).attr('rel')));
                            }
                        });
                    if (isTouch)
                        drop.data('dropOver').on('touchmove.drop', function(e) {
                            return false;
                        });
                }

                drop.addClass(place);
                function _forCenterTop() {
                    if (drop.data('forCenter')) {
                        drop.data('forCenter').css('top', methods.defaultParams.wST);
                    }
                }
                function _show() {
                    if (place !== 'inherit') {
                        function _pos() {
                            drop.css({
                                'top': -drop.actual('outerHeight'),
                                'left': -drop.actual('outerWidth')
                            });
                            if ($thisPMT[0] === 'bottom' || $thisPMT[1] === 'bottom')
                                drop.css('top', wnd.height());
                            if ($thisPMT[0] === 'right' || $thisPMT[1] === 'right')
                                drop.css('left', wnd.width());
                            if ($thisPMT[0] === 'center' && $thisPMT[1] === 'center') {
                                methods[place](drop, true);
                            }
                            if ($thisPMT[0] === 'inherit')
                                drop.css({
                                    'left': $this.offset().left + wnd.scrollLeft(),
                                    'top': $this.offset().top + wnd.scrollTop()
                                });
                        }
                        var $thisPMT = placeBeforeShow.toLowerCase().split(' '),
                        tempPl = eval(placement);

                        if (typeof tempPl == 'object')
                            if (tempPl.top != undefined && tempPl.left != undefined)
                                _pos()
                        if (typeof tempPl == 'undefined' || typeof tempPl == 'string')
                            _pos();
                    }

                    methods[place](drop);

                    drop[$thisEOn]($thisD, function(e) {
                        var drop = $(this);
                        drop.addClass(aC);
                        if (!confirm && modal)
                            methods.defaultParams.closeDropTime = setTimeout(function() {
                                methods.close(drop);
                            }, timeclosemodal);
                        methods.limitSize(drop);
                        var cB = elAfter;
                        if (cB !== undefined) {
                            eval(cB)($this, drop, isajax, data, elSet);
                        }
                        after($this, drop, isajax, data, elSet);
                        $(document).trigger({
                            'type': 'drop.after',
                            'el': $this,
                            'drop': drop,
                            'isajax': isajax,
                            'datas': data,
                            'elSet': elSet
                        });
                    });
                }
                methods.defaultParams.wST = wnd.scrollTop();
                if (drop.data('forCenter')) {
                    drop.data('forCenter').fadeIn($thisD);
                }
                else {
                    if (drop.data('dropOver'))
                        drop.css('z-index', parseFloat(drop.data('dropOver').css('z-index')) + 1);
                }

                _forCenterTop();
                if (condOverlay) {
                    if ($(document).height() - wnd.height() > 0) {
                        methods.scrollEmulate();
                    }
                }
                methods.positionType(drop);
                _show();
            }
            body.off('click.drop').off('keydown.drop').on('click.drop', function(e) {
                if (closeClick)
                    if (!$.existsN($(e.target).closest('[data-elrun]')) && !($(e.target).is(drop.data('dropOver')) || $(e.target).is('.for-center'))) {
                        methods.close(false);
                    }
                    else
                        return true;
            });
            if (closeEsc)
                body.off('keydown.drop').on('keydown.drop', function(e) {
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
        close: function(sel, datas) {
            if (sel === undefined)
                sel = this;
            clearTimeout(methods.defaultParams.closeDropTime);
            $('[data-button-confirm]').off('click.drop');
            var cond = sel === undefined || !sel,
            drop = cond ? $('[data-elrun].' + aC) : sel;
            if (!cond)
                body.off('click.drop keydown.drop keydown.drop')
            if ($.existsN(drop)) {
                drop.each(function() {
                    var drop = $(this),
                    data = drop.data(),
                    condOverlay = (data.overlayOpacity !== undefined ? data.overlayOpacity.toString() : data.overlayOpacity) !== '0';
                    if (data.modal || sel || condOverlay || data.place === 'noinherit') {
                        $thisB = data.elrun;
                        if ($thisB !== undefined) {
                            var $thisEOff = data.effectOff,
                            durOff = data.durationOff;
                            methods.scrollEmulateRemove();
                            function _hide() {
                                $thisB.parent().removeClass(aC);
                                var $thisHref = $thisB.attr('href');
                                if ($thisHref !== undefined) {
                                    var $thisHrefL = $thisHref.length,
                                    wLH = location.hash,
                                    wLHL = wLH.length;
                                    try {
                                        var indH = wLH.match($thisHref + '(?![a-z])').index;
                                        location.hash = wLH.substring(0, indH) + wLH.substring(indH + $thisHrefL, wLHL);
                                    } catch (err) {
                                    }
                                }

                                drop.removeClass(aC);
                                var method = data.animate ? 'animate' : 'css';
                                var $thisPMT = data.placeAfterClose.toLowerCase().split(' ');
                                var l = 0, t = 0;
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
                                        data.dropOver.off('touchmove.drop');
                                    $(document).trigger({
                                        type: 'drop.closed',
                                        el: $thisB,
                                        drop: $this,
                                        datas: datas
                                    });
                                    var dC = $this.find($this.data('dropContent')).data('jsp');
                                    if (dC !== undefined) {
                                        dC.destroy();
                                    }
                                });
                            }
                            $(document).trigger({
                                type: 'drop.close',
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
                            wnd.off('resize.drop');
                        }
                    }
                });
            }
        },
        center: function(drop, start) {
            if (drop === undefined)
                drop = this;

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

            return drop;
        },
        noinherit: function(drop, start) {
            if (drop === undefined)
                drop = this;
            start = start === undefined ? true : false;
            var method = drop.data('animate') && start ? 'animate' : 'css',
            placement = eval(drop.data('placement')),
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

            return drop;
        },
        scrollEmulate: function() {
            var dur = methods.defaultParams.durationOn;
            try {
                clearInterval(methods.defaultParams.scrollemulatetimeout);
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
                    $('.for-center').on('touchmove.drop', function(e) {
                        return false;
                    });
                $(document).trigger({
                    'type': 'drop.scrollEmulate'
                });
            }, dur);
        },
        scrollEmulateRemove: function() {
            var dur = methods.defaultParams.durationOff;
            methods.defaultParams.scrollemulatetimeout = setTimeout(function() {
                body.removeClass('isScroll').css({
                    'overflow': '',
                    'margin-right': ''
                });
                ;
                wnd.scrollTop(methods.defaultParams.wST);
                $('.scrollEmulation').remove();
                if (isTouch)
                    $('.for-center').off('touchmove.drop');
                $(document).trigger({
                    'type': 'drop.scrollEmulateRemove'
                });
            }, dur);
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
    $.drop = function(m) {
        return methods[m];
    };
})(jQuery);
/*/plugin drop end*/
/*plugin plusminus*/
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                prev: 'prev',
                next: 'next',
                ajax: false,
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
                    ajax = settings.ajax,
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
                                if (ajax && !checkProdStock)
                                    $(document).trigger({
                                        'type': 'showActivity'
                                    });
                                if (ajax && inputVal + step <= input.data('max') && checkProdStock)
                                    $(document).trigger({
                                        'type': 'showActivity'
                                    });
                                if (ajax && inputVal + step === input.data('max'))
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
                                else if (inputVal > parseFloat(input.data('min')) || 1) {
                                    if (ajax) {
                                        $(document).trigger({
                                            'type': 'showActivity'
                                        });
                                    }
                                    input.val(inputVal - step);
                                    if (ajax && inputVal - step === input.data('min'))
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
    body.off('keyup.max', '[data-max]').on('keyup.max', '[data-max]', function(e) {
        $(this).trigger({
            'type': 'maxminValue',
            'event': e
        });
        $(this).maxminValue(e);
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
                var
                item = settings.item,
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