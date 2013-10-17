/*
 *imagecms frontend plugins
 ** @author Domovoj
 * @copyright ImageCMS (c) 2013, Avgustus <domovoj1@gmail.com>
 */
var isTouch = 'ontouchstart' in document.documentElement,
activeClass = 'active',
disabledClass = 'disabled',
clonedC = 'cloned';
wnd = $(window),
    body = $('body'),
    checkProdStock = checkProdStock == "" ? false : true;
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
}

String.prototype.trimMiddle = function()
{
    var r = /\s\s+/g;
    return $.trim(this).replace(r, ' ');
}
String.prototype.pasteSAcomm = function() {
    var r = /\s,/g;
    return this.replace(r, ',');
}

$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.existsN = function(nabir) {
    return (nabir.length > 0);
}
$.testNumber = function(e) {
    if (!e)
        var e = window.event;
    var key = e.keyCode;
    if (key == null || key == 0 || key == 8 || key == 13 || key == 9 || key == 46 || key == 37 || key == 39)
        return true;
    if ((key >= 48 && key <= 57) || (key >= 96 && key <= 105)) {
        return true;
    }
    else
        return false;
}
$.onlyNumber = function(el) {
    body.on('keydown', el, function(e) {
        if (!$.testNumber(e)) {
            $(this).tooltip();
            return false;
        }
        else{
            $(this).tooltip('remove');
        }
    });
}
$.fn.pricetext = function(e, rank) {
    var $this = $(this);
    rank != undefined ? rank = rank : rank = true;
    $(document).trigger({
        type: 'textanimatechange', 
        el: $this, 
        ovalue: parseFloat($this.text().replace(/\s+/g, '')), 
        nvalue: e, 
        rank: rank
    })
    return $this;
}
$.fn.setCursorPosition = function(pos) {
    this.each(function() {
        this.select();
        try{
            this.setSelectionRange(pos, pos);
        }catch(err){}
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
        if (cond && step != 0)
            $this.text(rank ? temp.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : temp)
        else {
            $this.text(rank ? nv.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') : nv)
            clearInterval(numb)
            temp = nv;
        }
    }, 1)

})
function setcookie(name, value, expires, path, domain, secure)
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
    if (c_start == -1)
        c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1)
        c_value = null;
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
            c_end = c_value.length;
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}

(function($) {
    var methods = {
        init: function(options) {
            if ($.existsN($(this))) {
                var settings = $.extend({
                    wrapper: $(".frame-label:has(.niceCheck)"),
                    elCheckWrap: '.niceCheck',
                    evCond: false,
                    classRemove: null,
                    before: function() {
                    },
                    after: function() {
                    }
                }, options);
                var frameChecks = $(this),
                wrapper = settings.wrapper,
                elCheckWrap = settings.elCheckWrap,
                evCond = settings.evCond,
                classRemove = settings.classRemove,
                frameChecks = frameChecks.selector.split(','),
                after = settings.after;
                $.map(frameChecks, function(i, n) {
                    var frameChecks = $(i.replace(' ', ''));
                    frameChecks.each(function() {
                        var thisFrameChecks = $(this);
                        thisFrameChecks.find(elCheckWrap).each(function() {
                            var $this = $(this).removeClass(classRemove),
                            $thisInput = $this.children();
                            if (!$thisInput.is('[disabled="disabled"]')) {
                                methods.changeCheckStart($this, $thisInput);
                            }
                            else {
                                methods.checkUnChecked($this, $thisInput)
                                methods.CheckallDisabled($this, $thisInput);
                            }
                        })
                    }).find(wrapper).unbind('click.nstcheck').on('click.nstcheck', function(e) {
                        var $this = $(this),
                        $thisD = $this.is('.disabled'),
                        nstcheck = $this.find(elCheckWrap);
                        if (nstcheck.length == 0)
                            nstcheck = $this
                        if (!$thisD) {
                            if (!evCond) {
                                methods.changeCheck(nstcheck);
                                after(frameChecks, $this, nstcheck, e);
                            }
                            else {
                                settings.before(frameChecks, $this, nstcheck, e);
                            }
                        }
                    });
                    var form = frameChecks.closest('form');
                    form.find('[type="reset"]').unbind('click.nstcheck').on('click.nstcheck', function() {
                        methods.changeCheckallreset(form.find(elCheckWrap));
                    });
                });
                wrapper.find('input').unbind('change.nstCheck mousedown.nstCheck click.nstCheck keyup.nstCheck').on('change.nstCheck mousedown.nstCheck click.nstCheck', function(e) {
                    $(this).closest(wrapper).trigger('click.nstcheck');
                    return false;
                }).on('keyup.nstCheck', function(e) {
                    if (e.keyCode == 32)
                        $(this).closest(wrapper).trigger('click.nstcheck');
                })
            }
        },
        changeCheckStart: function(el, input) {
            var el = el,
            input = input;
            if (input.attr("checked") != undefined) {
                methods.checkChecked(el, input);
            }
            else {
                methods.checkUnChecked(el, input);
            }
        },
        checkChecked: function(el, input) {
            var el = el;
            if (el == undefined)
                el = this;
            var input = input;
            if (input == undefined)
                input = $(this).find("input");
            el.addClass(activeClass).parent().addClass(activeClass);
            input.attr("checked", 'checked');
            $(document).trigger({
                'type': 'nstCheck.CC', 
                'el': el, 
                'input': input
            });
        },
        checkUnChecked: function(el, input) {
            var el = el;
            if (el == undefined)
                el = this;
            var input = input;
            if (input == undefined)
                input = $(this).find("input");
            el.removeClass(activeClass).parent().removeClass(activeClass);
            input.removeAttr("checked");
            $(document).trigger({
                'type': 'nstCheck.CUC', 
                'el': el, 
                'input': input
            });
        },
        changeCheck: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            var input = el.find("input");
            if (input.attr("checked") == undefined) {
                methods.checkChecked(el, input);
            }
            else {
                methods.checkUnChecked(el, input);
            }
        },
        changeCheckallchecks: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                var input = el.find("input");
                el.addClass(activeClass).parent().addClass(activeClass);
                input.attr("checked", "checked");
            })
        },
        changeCheckallreset: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                var input = el.find("input");
                el.removeClass(activeClass).parent().removeClass(activeClass);
                input.removeAttr("checked");
            });
        },
        CheckallDisabled: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                var input = el.find("input");
                el.removeClass(activeClass).addClass('disabled').parent().addClass('disabled').removeClass(activeClass);
                input.attr('disabled', 'disabled').removeAttr('checked');
            });
        },
        CheckallEnabled: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                var input = el.find("input");
                el.removeClass('disabled').parent().removeClass('disabled');
                input.removeAttr('disabled');
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
})($);
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
            var $this = $(this);
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
                            if (e.which == 0)
                                methods.radioCheck(input.parent(), input, after, false);
                        })
                    })
                    $this.find(wrapper).unbind('click.radio').on('click.radio', function(e) {
                        if (!$(this).find('input').is(':disabled')) {
                            before($(this));
                            methods.changeRadio($(this).find(elCheckWrap), after, false);
                        }
                    });
                    input.on('mousedown change', function(e) {
                        return false;
                    })
                })
            }
        },
        changeRadioStart: function(el, classRemove, after, start)
        {
            var input = el.find("input");
            if (input.is(":checked")) {
                methods.radioCheck(el, input, after, start);
            }
            if (input.is(":disabled")) {
                methods.radioDisabled(el, input);
            }
            el.removeClass(classRemove);
            return false;
        },
        changeRadio: function(el, after, start)
        {
            var input = el.find("input");
            methods.radioCheck(el, input, after, start);
        },
        radioCheck: function(el, input, after, start) {
            el.addClass(activeClass).removeClass(disabledClass);
            el.parent().addClass(activeClass).removeClass(disabledClass);
            input.attr("checked", true);
            $(input.data('link')).focus();
            input.closest('form').find('[name=' + input.attr('name') + ']').not(input).each(function() {
                methods.radioUnCheck($(this).parent(), $(this))
            });
            after(el, start);
            $(document).trigger({
                'type': 'nStRadio.RC', 
                'el': el, 
                'input': input
            });
        },
        radioUnCheck: function(el, input) {
            el.removeClass(activeClass);
            el.parent().removeClass(activeClass);
            input.attr("checked", false);
            $(document).trigger({
                'type': 'nStRadio.RUC', 
                'el': el, 
                'input': input
            });
        },
        radioDisabled: function(el, input) {
            input.attr('disabled', 'disabled');
            el.removeClass(activeClass).addClass(disabledClass);
            el.parent().removeClass(activeClass).addClass(disabledClass);
        },
        radioUnDisabled: function(el, input) {
            input.removeAttr('disabled');
            el.removeClass(activeClass + ' ' + disabledClass);
            el.parent().removeClass(activeClass + ' ' + disabledClass);
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
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                item: 'ul > li',
                duration: 300,
                searchPath: "/shop/search/ac",
                inputString: $('#inputString'),
                minValue: 3,
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
                        html = _.template($('#searchResultsTemplate').html(), {
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
                        $thisS.unbind('click.autocomplete').on('click.autocomplete', function(e) {
                            e.stopImmediatePropagation();
                        })
                        body.unbind('click.autocomplete').on('click.autocomplete', function(event) {
                            closeFrame();
                        }).unbind('keydown.autocomplete').on('keydown.autocomplete', function(e) {
                            if (!e)
                                var e = window.event;
                            if (e.keyCode == 27) {
                                closeFrame();
                            }
                        });
                    });
                    if (inputString.val().length == 0)
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
                    if (code == 38 || code == 40)
                    {
                        if (code == 38)
                        {
                            selectorPosition -= 1;
                        }
                        if (code == 40)
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
                    if (code == 13)
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
                })
            }
            
            function closeFrame() {
                $(document).trigger({
                    'type': 'autocomplete.close', 
                    'el': $thisS
                });
                $thisS.stop(true, false).fadeOut(durationA);
                $thisS.unbind('click.autocomplete');
                body.unbind('click.autocomplete').unbind('keydown.autocomplete');
            }
            
            var $thisS = $(this),
            blockEnter = settings.blockEnter,
            itemA = settings.item,
            durationA = settings.duration,
            searchPath = settings.searchPath,
            selectorPosition = -1,
            inputString = settings.inputString,
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
                    if (code != 27 && code != 40 && code != 38 && code != 39 && code != 37 && code != 13 && inputValL != 0 && $.trim($this.val()) != "")
                        postSearch();
                    else if (inputValL == 0)
                        closeFrame();
                }
                else{
                    if (code == 13 && !blockEnter)
                        submit.closest('form').submit();
                    else
                        $(document).trigger({
                            type: 'autocomplete.fewLength', 
                            el: $this, 
                            value: minValue
                        });
                }
                if (inputString.val().length <= minValue && blockEnter)
                    submit.unbind('click.autocomplete').on('click.autocomplete', function(e) {
                        e.preventDefault();
                        inputString.focus();
                        $(document).trigger({
                            type: 'autocomplete.fewLength', 
                            el: inputString, 
                            value: minValue
                        });
                    })
                else {
                    submit.unbind('click.autocomplete');
                }
            }).blur(function() {
                closeFrame();
            });
            inputString.keypress(function(event) {
                if (!event)
                    var event = window.event;
                var code = event.keyCode;
                if (code == 13 && $(this).val().length <= minValue)
                    return false;
            })
        }
    }
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
})($);
(function($) {
    var methods = {
        init: function(options) {
            var tooltip = $('.tooltip').not('.' + clonedC),
            settings = $.extend({
                title: this.attr('data-title'),
                otherClass: false,
                effect: 'notalways',
                textEl: '.text-el'
            }, options);
            var $this = $(this), textEl = $this.find(settings.textEl);
            if (textEl.is(':visible') && $.existsN(textEl))
                return false;
            tooltip.text(settings.title);
            if (settings.otherClass !== false)
                tooltip.addClass(settings.otherClass);
            if (settings.effect == 'always' && !$.exists('.' + settings.otherClass + 'tooltip')) {
                tooltip = tooltip.clone();
                tooltip.addClass(settings.otherClass + 'tooltip').appendTo(body);
            }
            var tempeff = false;
            if (settings.effect == 'notalways') {
                tooltip.hide();
                tempeff = 'stop';
            }
            if (tempeff) {
                tooltip.css({
                    'left': Math.ceil(this.offset().left - (tooltip.actual('outerWidth') - this.outerWidth()) / 2),
                    'top': this.offset().top - tooltip.actual('outerHeight')
                }).stop(true, false).fadeIn(300, function() {
                    $(document).trigger({
                        'type': 'tooltip.show', 
                        'el': $(this)
                    });
                });
            }
            else {
                tooltip.css({
                    'left': Math.ceil(this.offset().left - (tooltip.actual('outerWidth') - this.outerWidth()) / 2),
                    'top': this.offset().top - tooltip.actual('outerHeight')
                }).fadeIn(300, function() {
                    $(document).trigger({
                        'type': 'tooltip.show', 
                        'el': $(this)
                    });
                });
            }
            $this.unbind('mouseout.tooltip').on('mouseout.tooltip', function() {
                $(this).tooltip('remove');
            })
            $this.filter(':input').unbind('blur.tooltip').on('blur.tooltip', function() {
                $(this).tooltip('remove');
            })
        
        },
        remove: function() {
            $('.tooltip').stop(true, false).fadeOut(300, function() {
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
    body.on('mouseover', '[data-rel="tooltip"]', function() {
        $(this).tooltip();
    }).on('mouseout', '[data-rel="tooltip"]', function() {
        $(this).tooltip('remove');
    })
})($);
/*plugin menuImageCms for main menu shop*/
(function($) {
    var methods = {
        _position: function(menuW, $thisL, dropW, drop, $thisW, countColumn, sub2, direction) {
            if ((menuW - $thisL < dropW && dropW < menuW && direction != 'left') || direction == 'right') {
                drop.removeClass('left-drop')
                if (drop.children().children().length >= countColumn && !sub2)
                    drop.css('right', 0).addClass('right-drop');
                else {
                    var right = menuW - $thisW - $thisL;
                    if ($thisL + $thisW < dropW){
                        right = menuW - dropW;
                    }
                    drop.css('right', right).addClass('right-drop');
                }
            } else if (direction != 'right' || direction == 'left') {
                drop.removeClass('right-drop')
                if (sub2 && dropW > menuW)
                    drop.css('left', $thisL).addClass('left-drop');
                else if (drop.children().children().length >= countColumn || dropW >= menuW)
                    drop.css('left', 0).addClass('left-drop');
                else
                    drop.css('left', $thisL).addClass('left-drop');
            }
        },
        init: function(options) {
            var menu = $(this);
            if ($.existsN(menu)) {
                var sH = 0,
                settings = $.extend({
                    item: $(this).find('li:first'),
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
                    activeFl: activeClass,
                    parentTl: 'li',
                    refresh: false,
                    otherPage: undefined,
                    vertical: false
                }, options);
                var menuW = menu.width(),
                menuItem = settings.item,
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
                        $this.closest(activeFl.split(' ')[0]).removeClass(activeClass);
                        $this.removeClass(activeClass);
                    });
                    var locHref = location.href;
                    var locationHref = otherPage != undefined ? otherPage : locHref
                    menu.find('a[href="' + locationHref + '"]').each(function() {
                        var $this = $(this);
                        $this.closest(activeFl.split(' ')[0]).addClass(activeClass);
                        $this.closest(parentTl.split(' ')[0]).addClass(activeClass).prev().addClass(activeClass);
                        $this.addClass(activeClass);
                    })
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
                            })
                            numbColumn = $.unique(numbColumn).sort();
                            var numbColumnL = numbColumn.length;
                            if (numbColumnL > 1) {
                                if ($.inArray('0', numbColumn) == 0){
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
                                    else{
                                        $this.closest('li').addClass('x' + numbColumnL).attr('data-x', numbColumnL);
                                    }
                                
                                })
                                columnsObj.remove();
                            }
                        })
                    }
                    if (columnPart && !sub2Frame)
                        dropOJ.each(function() {
                            var $this = $(this),
                            columnsObj = $this.find(':regex(class,' + columnClassPref + '([0-9]+))'),
                            numbColumn = [];
                            columnsObj.each(function(i) {
                                numbColumn[i] = $(this).attr('class').match(/([0-9]+)/)[0];
                            })
                            numbColumn = $.unique(numbColumn).sort();
                            var numbColumnL = numbColumn.length;
                            if (numbColumnL > 1) {
                                if ($.inArray('0', numbColumn) == 0){
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
                        })
                    $(document).trigger({
                        type: 'columnRenderComplete', 
                        el: dropOJ
                    })
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
                
                $('.not-js').removeClass('not-js');
                var hoverTO = '';
                function closeMenu() {
                    var $thisDrop = menu.find(drop);
                    if ($thisDrop.length != 0)
                        menu.removeClass(hM);
                    
                    if (evLS == 'toggle' || evLF == 'toggle'){
                        menu.find('.' + hM).click()
                        dropOJ.hide();
                    }
                    
                    $('.firstH, .lastH').removeClass('firstH lastH');
                    
                    clearTimeout(hoverTO);
                }
                menuItem.unbind(evLF)[evLF](
                    function(e) {
                        clearTimeout(hoverTO);
                        closeMenu();
                        var $this = $(this),
                        $thisI = $this.index();
                        $this = $(this).addClass(hM),
                        $thisDrop = $this.find(drop);
                        
                        if ($thisI == 0)
                            $this.addClass('firstH');
                        if ($thisI == itemMenuL - 1)
                            $this.addClass('lastH');
                        if ($(e.relatedTarget).is(menuItem) || $.existsN($(e.relatedTarget).parents(menuItem)) || $this.data('kk') == 0)
                            k[$thisI] = true;
                        if (k[$thisI]) {
                            hoverTO = setTimeout(function() {
                                $thisDrop[effOn](durationOn, function() {
                                    $this.data('kk', $this.data('kk') + 1);
                                    $(document).trigger({
                                        type: 'menu.showDrop', 
                                        el: $thisDrop
                                    })
                                    if ($thisDrop.length != 0)
                                        menu.addClass(hM);
                                    if (sub2Frame) {
                                        var listDrop = $thisDrop.children();
                                        if (!listDrop.is('[data-height]')) {
                                            var sumHL1 = listDrop.height(),
                                            dropW = $thisDrop.width();
                                            listDrop.attr('data-height', sumHL1);
                                            isSub2W = $thisDrop.find(sub2Frame).addClass('is-side').actual('width');
                                        }
                                        listDrop.children().each(function() {
                                            var $this = $(this),
                                            isSub2 = $this.find(sub2Frame);
                                            if ($.existsN(isSub2)) {
                                            $this.css('overflow', 'hidden');
                                            var sumHL2 = isSub2.show().height();
                                            isSub2.hide();
                                            $this.css('overflow', '');
                                            if (sumHL2 > sumHL1)
                                            var koef = Math.ceil(sumHL2 / sumHL1);
                                            if (koef != undefined) {
                                            subWL2 = isSub2W * koef;
                                            if (subWL2 + dropW > menuW) subWL2 = menuW - dropW;
                                            isSub2.css('width', dropW);
                                            }
                                            }
                                            }).unbind(evLS)[evLS](function(e) {
                                            var $this = $(this),
                                            subFrame = $this.find(sub2Frame);
                                            if (e.type != 'click' && evLS != 'toggle') {
                                                $this.siblings().removeClass(hM);
                                            }
                                            if ($.existsN(subFrame)) {
                                                if (e.type == 'click' && evLS == 'toggle') {
                                                    e.stopPropagation();
                                                    $this.siblings().filter('.' + hM).click();
                                                    $this.addClass(hM);
                                                }
                                                else{
                                                    $this.has(sub2Frame).addClass(hM);
                                                }
                                                $thisDrop.css('width', '');
                                                listDrop.add(subFrame).css('height', '');
                                                var dropW = $this.parent().parent().width(),
                                                sumW = dropW + subFrame.width(),
                                                subHL2 = subFrame.height(),
                                                dropDH = listDrop.data('height');
                                                if (subHL2 < dropDH)
                                                    subHL2 = dropDH;
                                                
                                                if (animatesub3){
                                                    listDrop.stop(true, false).animate({
                                                        'height': subHL2
                                                    }, durationOnS);
                                                }
                                                else
                                                    listDrop.css('height', subHL2);
                                                if (animatesub3)
                                                    $thisDrop.stop(true, false).animate({
                                                        'width': sumW
                                                    }, durationOnS);
                                                else
                                                    $thisDrop.css('width', sumW);
                                                
                                                subFrame[effOnS](durationOnS, function(){
                                                    subFrame.css('height', subHL2);
                                                });
                                            }
                                            else return true;
                                        }, function(e){
                                            if (e.type == 'click' && evLS == 'toggle') {
                                                e.stopPropagation();
                                            }
                                            var $this = $(this),
                                            subFrame = $this.find(sub2Frame);
                                            if ($.existsN(subFrame)) {
                                                subFrame.hide();
                                                $thisDrop.stop().css('width', '')
                                                listDrop.add(subFrame).stop().css('height', '')
                                                $this.removeClass(hM)
                                            }
                                        });
                                    }
                                });
                            }, timeDurM);
                        }
                    }, function(e) {
                        var $this = $(this),
                        $thisI = $this.index();
                        k[$thisI] = true;
                        if ($this.index() == 0)
                            $this.removeClass('firstH');
                        if ($this.index() == itemMenuL - 1)
                            $this.removeClass('lastH');
                        var $thisDrop = $this.find(drop);
                        if ($.existsN($thisDrop)) {
                            $thisDrop.stop(true, false)[effOff](durationOff);
                        }
                        $this.removeClass(hM);
                    });
                menu.unbind('hover')['hover'](
                    function(e) {
                        menuItem.each(function() {
                            $(this).data('kk', 0);
                        })
                        timeDurM = 0;
                    },
                    function(e) {
                        closeMenu();
                        menuItem.each(function() {
                            $(this).data('kk', -1);
                        })
                        timeDurM = duration;
                    });
                body.unbind('click.menu').on('click.menu', function(e) {
                    closeMenu();
                }).unbind('keydown.menu').on('keydown.menu', function(e) {
                    if (!e)
                        var e = window.event;
                    if (e.keyCode == 27) {
                        closeMenu();
                    }
                });
                dropOJ.find('a').unbind('click.menuref').on('click.menuref', function(e) {
                    if (evLS == 'toggle') {
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
                menuItem.find('a:first').unbind('click.menuref').on('click.menuref', function(e) {
                    if (!$.existsN($(this).closest(menuItem).find(drop)))
                        e.stopPropagation();
                });
            }
            return menu;
        },
        refresh: function() {
            methods.init.call($(this), $.extend({}, optionsMenu, {
                refresh: true
            }));
            return $(this);
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
})($);
/*plugin menuImageCms end*/
/*plugin tabs*/
(function($) {
    var methods = {
        init: function(options) {
            var $this = $(this);
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
                    refs[index] = navTabsLi[index].children();
                    attrOrdata[index] = refs[index].attr('href') != undefined ? 'attr' : 'data';
                    var tempO = $([]),
                    tempO2 = $([]),
                    tempRefs = [];
                    refs[index].each(function(ind) {
                        var tHref = $(this)[attrOrdata[index]]('href');
                        tempO = tempO.add($(tHref));
                        tempO2 = tempO2.add('[data-id=' + tHref + ']');
                        tempRefs.push(tHref);
                    })
                    tabsDiv[index] = tempO;
                    tabsId[index] = tempO2;
                    regRefs[index] = tempRefs;
                    refs[index].unbind('click.tabs').on('click.tabs', function(e) {
                        wST = wnd.scrollTop();
                        var $this = $(this);
                        var resB = settings.before($this);
                        if (resB == undefined || resB == true) {
                            if ($this.is('a'))
                                e.preventDefault();
                            var condRadio = $thiss.data('type') == 'radio',
                            condStart = !e.start;
                            if (!$this.parent().hasClass('disabled')) {
                                var $thisA = $this[attrOrdata[index]]('href'),
                                $thisAOld = navTabsLi[index].filter('.' + activeClass).children()[attrOrdata[index]]('href'),
                                $thisAO = $($thisA),
                                $thisS = $this.data('source'),
                                $thisData = $this.data('data'),
                                $thisSel = $this.data('selector'),
                                $thisDD = $this.data('drop') != undefined;
                                function tabsDivT() {
                                    tabsDiv[index].add(tabsId[index])[effectOff](durationOff).removeClass(activeClass);
                                    $thisAO.add('[data-id=' + $thisA + ']')[effectOn](durationOn, function() {
                                        settings.after($thiss, $thisA, $thisAO.add('[data-id=' + $thisA + ']'));
                                    }).addClass(activeClass);
                                }
                                if (!$thisDD) {
                                    if (!condRadio || e.button == 0) {
                                        navTabsLi[index].removeClass(activeClass);
                                        $this.parent().addClass(activeClass);
                                        if (!condRadio) {
                                            if (e.start && $thisS != undefined)
                                                tabsDivT()
                                            if ($thisS != undefined && !$thisAO.hasClass('visited')) {
                                                $thisAO.addClass('visited');
                                                $(document).trigger({
                                                    'type': 'tabs.beforeload', 
                                                    "els": tabsDiv[index], 
                                                    "el": $thisAO
                                                });
                                                if ($thisData != undefined)
                                                    $.ajax({
                                                        type: 'post',
                                                        url: $thisS,
                                                        data: $thisData,
                                                        success: function(data) {
                                                            tabsDivT();
                                                            $thisAO.find($thisSel).html(data)
                                                            $(document).trigger({
                                                                'type': 'tabs.afterload', 
                                                                "els": tabsDiv[index], 
                                                                "el": $thisAO
                                                            })
                                                        }
                                                    })
                                                else
                                                    $thisAO.load($thisS, function() {
                                                        $(document).trigger({
                                                            'type': 'tabs.afterload', 
                                                            "els": tabsDiv[index], 
                                                            "el": $thisAO
                                                        })
                                                        tabsDivT()
                                                    })
                                            }
                                            else {
                                                tabsDivT()
                                            }
                                            
                                            if (e.scroll)
                                                wnd.scrollTop($this.offset().top);
                                            $(document).trigger({
                                                'type': 'tabs.showtabs', 
                                                'el': $thisAO
                                            })
                                        }
                                        else {
                                            setcookie('listtable', $this.parent().index(), 0, '/');
                                            settings.after($thiss);
                                        }
                                    }
                                }
                                var wLH = window.location.hash;
                                var reg = null;
                                try {
                                    reg = wLH.match($thisAOld)[0];
                                } catch (err) {
                                    reg = null;
                                }
                                if ((!condRadio && attrOrdata[index] != 'data') || (($.inArray($thisA, regRefs[index]) > -1 && reg != null))) {
                                    if (condStart) {
                                        var reg = null,
                                        temp = wLH;
                                        try {
                                            reg = wLH.match(new RegExp(regRefs[index].join('|').toString()));
                                        } catch (err) {
                                            reg = null;
                                        }
                                        if (reg != null) {
                                            if (wLH.indexOf($thisA) == -1) {
                                                temp = temp.replace(reg, $thisA)
                                            }
                                            else {
                                                temp += $thisA;
                                            }
                                        }
                                        else {
                                            temp += $thisA;
                                        }
                                        window.location.hash = temp;
                                    }
                                    else if (!$thisDD && k) {
                                        window.location.hash = $.unique(tabs.hashs[0]).join('');
                                        k = false;
                                    }
                                    if ($thisDD && !condStart)
                                        $this.trigger('click.drop')
                                }
                                
                                else if (e.button == 0 && $thiss.data('elchange') != undefined) {
                                    refs[index].each(function() {
                                        var $thisDH = $(this).data('href');
                                        if ($thisDH == $thisA)
                                            $($thiss.data('elchange')).addClass($thisA)
                                        else
                                            $($thiss.data('elchange')).removeClass($thisDH)
                                    })
                                }
                            }
                            return false;
                        }
                    })
                    if (thisL - 1 == index)
                        methods.location(regRefs, refs);
                });
                wnd.on('hashchange', function(e) {
                    function scrollTop(wST) {
                        if (e.scroll || e.scroll == undefined)
                            wnd.scrollTop(wST);
                        wST = wnd.scrollTop();
                    }
                    
                    //chrome bug
                    if ($.browser.webkit)
                        scrollTop(wST - 100);
                    scrollTop(wST);
                    return false;
                })
            }
            return $this;
        },
        location: function(regrefs, refs) {
            var hashs1 = [],
            hashs2 = [];
            if (location.hash == '')
            {
                var i = 0,
                j = 0;
                _.map(refs, function(n, i) {
                    var $this = n.first(),
                    attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';
                    if ($this.data('drop') == undefined && attrOrdataL != 'data') {
                        hashs1[i] = $this[attrOrdataL]('href');
                        i++;
                    }
                    else if (attrOrdataL == 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                })
                var hashs = [hashs1, hashs2];
            }
            else {
                _.map(refs, function(n, i) {
                    var j = 0,
                    $this = n.first(),
                    attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';
                    if (attrOrdataL == 'data') {
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
                    var ch = t.substr(i, m)
                    if (ch == s) {
                        res += 1;
                        i = i + m
                        pos[res - 1] = t.indexOf(s, i - m)
                    } else
                        i++
                }
                var i = 0;
                while (i < pos.length) {
                    hashs1[i] = t.substring(pos[i], pos[i + 1]);
                    i++;
                }
                var hashs = [hashs1, hashs2];
            }
            tabs = new Object();
            tabs.hashs = hashs;
            methods.startCheck(regrefs, tabs.hashs);
        },
        startCheck: function(regrefs, hashs) {
            var hashs = hashs[0].concat(hashs[1]),
            regrefsL = regrefs.length,
            sim = 0;
            $.map(regrefs, function(n, k) {
                var i = 0,
                hashs2 = [].concat(hashs);
                $.map(hashs, function(n, j) {
                    if ($.inArray(n, regrefs[k]) >= 0)
                        i++;
                    if ($.inArray(n, regrefs[k]) >= 0 && i > 1) {
                        hashs2.splice(hashs2.indexOf(n), 1)
                    }
                })
                if (hashs2.join() == hashs.join())
                    sim++;
                if (hashs2.join() != hashs.join() || sim == regrefsL)
                    $.map(hashs2, function(n, i) {
                        var attrOrdataNew = "";
                        $('[href=' + n + ']').length == 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                        $('[' + attrOrdataNew + '=' + n + ']').trigger({
                            'type': 'click.tabs', 
                            'start': true
                        });
                    });
            });
        }
    }
    $.fn.tabs = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on $.tabs');
        }
    }
    $.tabs = function(m) {
        return methods[m];
    };
})($);
/*/plugin tabs end*/
(function($) {
    $.fn.actual = function() {
        if (arguments.length && typeof arguments[0] == 'string') {
            var dim = arguments[0];
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
}($));
(function($) {
    var methods = {
        init: function(options) {
            var optionsDrop = $.extend({
                exit: '[data-closed = "closed-js"]',
                effon: 'show',
                effoff: 'hide',
                duration: 200,
                place: 'center',
                dropContent: null,
                placement: 'noinherit',
                modal: false,
                confirm: false,
                confirmSel: '#confirm',
                overlayOpacity: '0',
                overlayColor: '#fff',
                always: false,
                animate: false,
                timeclosemodal: 2000,
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
            modal = settings.modal,
            confirm = settings.confirm,
            confirmSel = settings.confirmSel,
            always = settings.always,
            arrDrop = [];
            $(this).add($('[data-drop]')).unbind('click.drop').on('click.drop', function(e) {
                $(document).trigger({
                    'type': 'drop.click', 
                    'el': $this
                })
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
                            beforeSend: function(){
                                $(document).trigger({
                                    'type': 'showActivity'
                                })  
                            },
                            dataType: elSet.type ? elSet.type : 'html',
                            success: function(data) {
                                if (elSet.type != 'html' && elSet.type != undefined && newModal) {
                                    $(document).trigger({
                                        type: 'drop.successJson', 
                                        el: elSetSource, 
                                        datas: data
                                    })
                                }
                                else {
                                    $(document).trigger({
                                        type: 'drop.successHtml', 
                                        el: elSetSource, 
                                        datas: data
                                    })
                                    if (elSet.place != 'inherit' && elSet.place != 'noinherit') {
                                        if (!$.exists('.for-center')) {
                                            body.append('<div class="for-center" style="position: absolute;left: 0;top: 0;z-index: 1103;width: 100%;height: 100%;dispaly:none;"></div>');
                                        }
                                        $('.for-center').append(data)
                                    }
                                    else
                                        body.append(data)
                                }
                                elSetSource = $(elSet.drop);
                                methods.init.call(elSetSource.find('[data-drop]'), $.extend({}, optionsDrop));
                                methods.showDrop($this, e, optionsDrop, true, data);
                            }
                        })
                    }
                }
                var $this = $(this),
                elSet = $this.data(),
                elSetSource = $(elSet.drop);
                
                if ($.existsN($this.closest('[data-elrun]')) && elSet.start == undefined)
                    methods.closeDrop($this.closest('[data-elrun]'));
                if ($.existsN($('[data-elrun].center:visible')) && elSet.start == undefined)
                    methods.closeDrop($('[data-elrun].center:visible'));
                
                if (!$this.is('[disabled]')) {
                    e.stopPropagation();
                    e.preventDefault();
                    var newModal = elSet.modal || modal,
                    newConfirm = elSet.confirm || confirm,
                    newAlways = elSet.always || always;
                    
                    if (elSet.start != undefined)
                        var res = eval(elSet.start)($this, elSetSource);
                    if (elSet.start != undefined && !res)
                        return false;
                    if (elSet.start == undefined || (elSet.start != undefined && res)) {
                        if ($.existsN(elSetSource) && !newModal && !newAlways) {
                            if (!$.existsN(elSetSource.parent('.for-center')) && elSet.place != 'inherit')
                            {
                                if (elSet.place != 'inherit' && elSet.place != 'noinherit') {
                                    if (!$.exists('.for-center')) {
                                        body.append('<div class="for-center" style="position: absolute;left: 0;top: 0;z-index: 1103;width: 100%;height: 100%;dispaly:none;"></div>');
                                    }
                                    $('.for-center').append(elSetSource)
                                }
                                else if (!$.existsN(elSetSource.parent('body'))) {
                                    elSetSource.appendTo(body);
                                }
                            }
                            methods.showDrop($this, e, optionsDrop, false);
                        }
                        else if ((elSet.source || newAlways)) {
                            if (!newConfirm)
                                confirmF();
                            else {
                                methods.showDrop($('[data-drop="' + confirmSel + '"]').data('callback', elSet.callback), e, settings, false);
                                $('[data-button-confirm]').focus().on('click.drop', function() {
                                    methods.closeDrop($(confirmSel));
                                    confirmF();
                                })
                            }
                        
                        }
                        else {
                            methods.showDrop($this, e, optionsDrop, false);
                        }
                    }
                    return false;
                }
            })
            return $(this);
        },
        closeModal: function() {
            $('[data-elrun]:visible').each(function() {
                if ($(this).data('modal'))
                    methods.closeDrop($(this))
            })
        },
        showDrop: function($this, e, set, isajax, data) {
            if (!e)
                var e = window.event;
            var set = !set ? optionsDrop : set,
            isajax = !isajax ? false : true,
            elSet = $this.data(),
            place = elSet.place || set.place,
            callback = elSet.callback,
            placement = elSet.placement || set.placement,
            $thisEOff = elSet.effectOff || set.effoff,
            $thisD = elSet.duration != undefined ? elSet.duration.toString() : elSet.duration || set.duration,
            $thisA = elSet.animate != undefined ? elSet.animate : set.animate,
            $thisEOn = elSet.effectOn || set.effon,
            overlayColor = elSet.overlaycolor || set.overlayColor,
            overlayOpacity = elSet.overlayopacity != undefined ? elSet.overlayopacity.toString() : elSet.overlayopacity || set.overlayOpacity,
            modal = elSet.modal || set.modal,
            timeclosemodal = elSet.timeclosemodal || set.timeclosemodal,
            confirm = elSet.confirm || set.confirm,
            dropContent = elSet.dropContent || set.dropContent,
            start = elSet.start,
            before = set.before,
            after = set.after,
            close = set.close,
            closed = set.closed,
            $thisSource = elSet.drop,
            elSetSource = $($thisSource);
            
            $this.attr('data-drop', $this.data('drop')).parent().addClass(activeClass);
            elSetSource.data({
                'effectOn': $thisEOn,
                'effectOff': $thisEOff,
                'elrun': $this,
                'place': place,
                'placement': placement,
                'duration': $thisD,
                'dropContent': dropContent,
                'animate': $thisA,
                'before': before,
                'after': after,
                'close': close,
                'closed': closed,
                'overlayOpacity': overlayOpacity,
                'overlayColor': overlayColor,
                'modal': modal,
                'confirm': confirm,
                'timeclosemodal': timeclosemodal,
                'callback': callback
            }).attr('data-elrun', $thisSource);
            elSetSource.off('click.drop', set.exit).on('click.drop', set.exit, function() {
                methods.closeDrop($(this).closest('[data-elrun]'));
            })
            var overlayColor = overlayColor,
            overlayOpacity = overlayOpacity != undefined ? overlayOpacity.toString() : overlayOpacity,
            condOverlay = overlayColor != undefined && overlayOpacity != undefined && overlayOpacity != '0';
            if (condOverlay){
                if (!$.exists('.overlayDrop')) {
                    body.append('<div class="overlayDrop" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;z-index: 1101;"></div>')
                }
                optionsDrop.dropOver = $('.overlayDrop').css({
                    'background-color': overlayColor,
                    'opacity': overlayOpacity
                });
            }
            if (elSetSource.hasClass(activeClass) && e.button != undefined) {
                methods.closeDrop(elSetSource);
            }
            else {
                before($this, elSetSource, isajax);
                $(document).trigger({
                    type: 'dropbefore', 
                    el: $this, 
                    drop: elSetSource
                });
                if (elSetSource.data('modal')) {
                    var objJ = $([]);
                    $('[data-elrun]:visible').each(function() {
                        if (($(this).data('overlayOpacity') != '0'))
                            objJ = objJ.add($(this));
                    })
                    if ($.existsN(objJ))
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
                    methods.positionDrop(elSetSource, placement, place);
                
                if (place == 'center')
                    methods.dropCenter(elSetSource);
                
                var dropTimeout = '';
                wnd.off('resize.drop').on('resize.drop', function() {
                    clearTimeout(dropTimeout);
                    dropTimeout = setTimeout(function() {
                        methods.positionDrop(elSetSource);
                        methods.dropCenter(elSetSource);
                    }, 300)
                });
                if (condOverlay)
                    optionsDrop.dropOver.show().add($('.for-center')).unbind('click.drop').on('click.drop', function(e) {
                        if ($(e.target).is(optionsDrop.dropOver) || $(e.target).is('.for-center')) {
                            methods.closeDrop(elSetSource);
                        }
                    })
                elSetSource.addClass(place);
                function _show() {
                    elSetSource.stop()[$thisEOn]($thisD, function(e) {
                        var $thisD = $(this),
                        dC = elSetSource.find(elSetSource.data('dropContent')).first();
                        $thisD.addClass(activeClass);
                        
                        if ((!confirm && modal) || typeof data == 'object')
                            optionsDrop.closeDropTime= setTimeout(function() {
                                methods.closeDrop($thisD)
                            }, timeclosemodal)
                        
                        $(document).trigger({
                            type: 'dropafter', 
                            elC: $this,
                            el: $thisD,
                            isajax: isajax,
                            data: data,
                            elSet: elSet,
                            dropC: dC
                        });
                        after($this, $thisD, isajax, data, elSet, dC);
                        var cB = elSet.href != undefined ? set.hrefOptions.callback : elSet.callback
                        if (cB != undefined)
                            eval(cB)($this, $thisD, isajax, data, elSet, dC)
                    });
                }
                if (place == 'center' && !(elSet.modal || modal)) {
                    $('.for-center').stop(true, false).show();
                    if ($(document).height() - wnd.height() > 0) {
                        optionsDrop.wST = wnd.scrollTop();
                        methods.scrollEmulate();
                    }
                }
                if (elSet.href != undefined)
                    $('<img src="' + elSet.href + '">').load(function() {
                        var $this = $(this),
                        place = elSet.placeHref || set.hrefOptions.placeHref,
                        bS = elSet.beforeShowHref || set.hrefOptions.beforeShowHref;
                        $(place).empty();
                        $this.appendTo(place);
                        eval(bS)($this, elSetSource);
                        _show();
                        $this.unbind('load');
                    });
                else {
                    _show();
                }
            }
            body.unbind('click.drop').unbind('keydown.drop').on('click.drop', function(e) {
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
            return new Array($this, e, set, isajax, data);
        },
        closeDrop: function(sel) {
            clearTimeout(optionsDrop.closeDropTime);
            $('[data-button-confirm]').unbind('click.drop');
            var drop = sel == undefined || !sel ? $('[data-elrun].' + activeClass) : sel;
            if ($.existsN(drop)) {
                drop.each(function() {
                    var drop = $(this),
                    overlayColor = drop.data('overlayColor'),
                    overlayOpacity = drop.data('overlayOpacity') != undefined ? drop.data('overlayOpacity').toString() : drop.data('overlayOpacity'),
                    condOverlay = overlayColor != undefined && overlayOpacity != undefined && overlayOpacity != '0';
                    if (drop.data('modal') || sel || condOverlay || drop.data('place') == 'noinherit') {
                        $(document).trigger({
                            'type': 'drop.beforeClose', 
                            'el': drop
                        })
                        drop.each(function() {
                            var $this = $(this),
                            $thisB = $this.data('elrun');
                            if ($thisB != undefined){
                                $thisB.parent().removeClass(activeClass);
                                var $thisEOff = $this.data('effect-off'),
                                $thisD = $this.data('duration');
                                
                                if ($this.data('close') != undefined)
                                    $this.data('close')($thisB, $(this));
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
                                
                                methods.scrollEmulateRemove($thisD);
                                $this.removeClass(activeClass);
                                $('.for-center').stop(true, false).fadeOut($thisD);
                                $this.stop()[$thisEOff]($thisD, function() {
                                    var $this = $(this);
                                    $this.removeClass(drop.data('place'));
                                    if ($this.data('closed') != undefined)
                                        $this.data('closed')($thisB, $(this));
                                    $(document).trigger({
                                        'type': 'drop.hide', 
                                        el: $this
                                    })
                                });
                            }
                        });
                    }
                })
            }
            wnd.unbind('resize.drop');
            return sel;
        },
        dropCenter: function(elSetSource) {
            if (elSetSource.data('place') == 'center') {
                var method = elSetSource.data('animate') ? 'animate' : 'css';
                if (!elSetSource.data('modal'))
                    elSetSource[method]({
                        'margin-top': (body.height() - elSetSource.actual('outerHeight')) / 2
                    }, {
                        queue: false
                    });
                else
                    elSetSource.css({
                        'bottom': 'auto', 
                        'right': 'auto'
                    })[method]({
                        'top': (body.height() - elSetSource.actual('outerHeight')) / 2 + wnd.scrollTop(),
                        'left': (body.width() - elSetSource.actual('outerWidth')) / 2 + wnd.scrollLeft()
                    }, {
                        queue: false
                    });
            }
            return elSetSource;
        },
        positionDrop: function(el, placement, place) {
            var elSetSource = el;
            if (elSetSource == undefined)
                elSetSource = $(this);
            if (place == undefined)
                place = elSetSource.data('place');
            if (place == 'noinherit') {
                if (placement == undefined)
                    placement = elSetSource.data('placement');
                var $this = elSetSource.data().elrun,
                dataSourceH = 0,
                dataSourceW = 0,
                $thisW = $this.width(),
                $thisH = $this.height();
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
            return new Array(el, placement, place);
        },
        scrollEmulate: function() {
            try {
                clearInterval(scrollemulatetimeout);
            } catch (err) {
            }
            $('.for-center').css('top', wnd.scrollTop());
            var conDropOver = optionsDrop.dropOver != undefined;
            body.addClass('isScroll');
            body.prepend('<div class="scrollEmulation" style="position: absolute;right: 0;top: ' + wnd.scrollTop() + 'px;height: 100%;width: 17px;overflow-y: scroll;z-index:10000;"></div>');
            if (isTouch && conDropOver)
                optionsDrop.dropOver.on('touchmove.drop', function(e) {
                    return false;
                });
        },
        scrollEmulateRemove: function(dur) {
            var dur = !dur ? 0 : dur,
            conDropOver = optionsDrop.dropOver != undefined;
            if (conDropOver)
                optionsDrop.dropOver.hide();
            scrollemulatetimeout = setTimeout(function() {
                body.removeClass('isScroll');
                wnd.scrollTop(optionsDrop.wST);
                $('.scrollEmulation').remove();
                if (isTouch && conDropOver)
                    optionsDrop.dropOver.unbind('touchmove.drop');
            }, dur)
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
})($);
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                prev: 'prev',
                next: 'next',
                ajax: false,
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
                    $thisPrev = $this,
                    $thisNext = $this,
                    regS = '', regM = '';
                    $.each(prev, function(i, v) {
                        regS = v.match(/\(.*\)/);
                        if (regS != null) {
                            regM = regS['input'].replace(regS[0], '');
                            regS = regS[0].substring(1, regS[0].length - 1)
                        }
                        if (regS == null)
                            regM = v;
                        $thisPrev = $thisPrev[regM](regS);
                    })
                    $.each(next, function(i, v) {
                        regS = v.match(/\(.*\)/);
                        if (regS != null) {
                            regM = regS['input'].replace(regS[0], '');
                            regS = regS[0].substring(1, regS[0].length - 1)
                        }
                        if (regS == null)
                            regM = v;
                        $thisNext = $thisNext[regM](regS);
                    })
                    $thisNext.unbind('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisPrev.removeAttr('disabled', 'disabled')
                        if (!el.is(':disabled')) {
                            var input = $this,
                            inputVal = parseInt(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input);
                                if (isNaN(inputVal))
                                    input.val(1);
                                else
                                    input.val(inputVal + 1);
                                if (ajax && !checkProdStock)
                                    $(document).trigger({
                                        'type': 'showActivity'
                                    })
                                
                                if (ajax && inputVal + 1 <= input.data('max') && checkProdStock)
                                    $(document).trigger({
                                        'type': 'showActivity'
                                    })
                                if (ajax && inputVal + 1 == input.data('max'))
                                    $thisNext.attr('disabled', 'disabled')
                                
                                if (checkProdStock)
                                    input.maxminValue(e);
                                settings.after(e, el, input);
                            }
                        }
                    })
                    $thisPrev.unbind('click.pM').on('click.pM', function(e) {
                        var el = $(this);
                        $thisNext.removeAttr('disabled', 'disabled')
                        if (!el.is(':disabled')) {
                            var input = $this,
                            inputVal = parseInt(input.val());
                            if (!isTouch)
                                input.focus();
                            if (!input.is(':disabled')) {
                                settings.before(e, el, input);
                                if (isNaN(inputVal))
                                    input.val(1)
                                else if (inputVal > 1) {
                                    if (ajax) {
                                        $(document).trigger({
                                            'type': 'showActivity'
                                        })
                                    }
                                    input.val(inputVal - 1)
                                    if (ajax && inputVal - 1 == input.data('min'))
                                        $thisPrev.attr('disabled', 'disabled')
                                }
                                
                                settings.after(e, el, input);
                            }
                        }
                    })
                })
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
(function($) {
    var methods = {
        init: function(e, f) {
            var $this = $(this), $thisVal = $this.val(),
            $max = parseInt($this.attr('data-max'));
            
            if ($thisVal > $max && checkProdStock) {
                $this.val($max);
                if (typeof f == 'function')
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
    $.maxminValue = function(m) {
        return methods[m];
    };
    body.off('keyup.max', '[data-max]').on('keyup.max', '[data-max]', function(e) {
        $(this).trigger({
            'type': 'maxminValue', 
            'event': e
        });
        $(this).maxminValue(e);
    })
})($);
body.off('keypress', '[data-min]').on('keypress', '[data-min]', function(e) {
    var key = e.keyCode,
    keyChar = parseInt(String.fromCharCode(key));
    var $this = $(this),
    $min = $this.attr('data-min');
    if ($this.val() == "" && keyChar == 0) {
        $this.val($min);
        return false;
    }
});

/*plugin myCarousel use jQarousel with correction behavior prev and next buttons*/
(function($) {
    var methods = {
        init: function(options) {
            if ($.existsN($(this))) {
                var $jsCarousel = $(this);
                var settings = $.extend({
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
                nS = '.mycarousel';
                $jsCarousel.each(function() {
                    var $this = $(this),
                    $item = $this.find(content).children().children(item + ':visible'),
                    $content = $this.find(content),
                    $itemL = $item.filter(':visible').length,
                    $itemW = $item.outerWidth(true),
                    $itemH = $item.outerHeight(true),
                    $thisPrev = $this.find(prev),
                    $thisNext = $this.find(next),
                    $marginR = $itemW - $item.outerWidth(),
                    $marginB = $itemH - $item.outerHeight(),
                    contW = $content.width(),
                    contH = $content.height(),
                    groupButton = $this.find(groupButtons);
                    settings.before($this);
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
                            vertical: vertical
                        }
                        $this.jcarousel($.extend(
                            mainO
                            , addO)).addClass('iscarousel');
                        $thisNext.add($thisPrev).css('display', 'inline-block');
                        groupButton.append($thisNext.add($thisPrev));
                        groupButton.append($thisNext.add($thisPrev));
                        if (isTouch && isHorz) {
                            $this.unbind('touchstart' + nS).on('touchstart' + nS, function(e) {
                                sP = e.originalEvent.touches[0];
                                sP = sP.pageX;
                            });
                            $this.unbind('touchmove' + nS).on('touchmove' + nS, function(e) {
                                e.stopPropagation();
                                e.preventDefault();
                                eP = e.originalEvent.touches[0];
                                eP = eP.pageX;
                            });
                            $this.unbind('touchend' + nS).on('touchend' + nS, function(e) {
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
                            $this.unbind('touchstart' + nS).on('touchstart' + nS, function(e) {
                                sP = e.originalEvent.touches[0];
                                sP = sP.pageY;
                            });
                            $this.unbind('touchmove' + nS).on('touchmove' + nS, function(e) {
                                e.stopPropagation();
                                e.preventDefault();
                                eP = e.originalEvent.touches[0];
                                eP = eP.pageY;
                            });
                            $this.unbind('touchend' + nS).on('touchend' + nS, function(e) {
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
                        if (isHorz)
                            $item.parent().css('width', $itemW * $itemL);
                        if (isVert) {
                            $item.parent().css('height', $itemH * $itemL);
                            $content.css('height', 'auto');
                        }
                        $thisNext.add($thisPrev).hide();
                    }
                    if (body.lazyload() == body) {
                        $thisNext.add($thisPrev).on('click', function(e) {
                            if (!$(this).is('[disabled="disabled"]'))
                                wnd.scroll(); // for lazyload
                        })
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
    }
    $.myCarousel = function(m) {
        return methods[m];
    };
})($);
/*
*imagecms shop plugins
**/
if (!Array.indexOf) {
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0); i < this.length; i++) {
            if (this[i] == obj) {
                return i;
            }
        }
        return -1;
    }
}
var Shop = {
    //var Cart = new Object();
    currentItem: {},
    Cart: {
        totalPrice: 0,
        totalAddPrice: 0,
        totalCount: 0,
        totalPriceOrigin: 0,
        discount: 0,
        kitDiscount: 0,
        popupCartSelector: 'script#cartPopupTemplate',
        shipping: 0,
        shipFreeFrom: 0,
        giftCertPrice: 0,
        add: function(cartItem, show) {
            //trigger before_add_to_cart
            $(document).trigger({
                type: 'before_add_to_cart',
                cartItem: _.clone(cartItem)
            });
            //
            var data = {
                'quantity': cartItem.count,
                'productId': cartItem.id,
                'variantId': cartItem.vId
            };
            var url = '/shop/cart_api/add';
            if (cartItem.kit) {
                data = {
                    'quantity': cartItem.count,
                    'kitId': cartItem.kitId
                };
                url += '/ShopKit';
            }
            
            $.post(url, data,
                function() {
                    try {
                        Shop.Cart._add(cartItem, show);
                    //save item to storage
                    } catch (e) {
                        return;
                    }
                });
            return;
        },
        _add: function(cartItem, show) {
            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
                currentItem.count += cartItem.count;
            else
                currentItem = cartItem;
            this.save(currentItem);
            ////trigger after_add_to_cart
            $(document).trigger({
                type: 'after_add_to_cart',
                cartItem: _.clone(cartItem),
                show: show
            });
            $(document).trigger({
                type: 'cart_changed'
            });
            //
            return this;
        },
        rm: function(cartItem) {
            if (cartItem.kitId)
                var key = 'ShopKit_' + cartItem.kitId;
            else
                var key = 'SProducts_' + cartItem.id + '_' + cartItem.vId;
            $.getJSON('/shop/cart_api/delete/' + key, function() {
                localStorage.removeItem('cartItem_' + cartItem.id + '_' + cartItem.vId);
                Shop.Cart.totalRecount();
                $(document).trigger({
                    type: 'cart_rm',
                    cartItem: cartItem
                });
                $(document).trigger({
                    type: 'cart_changed'
                });
            });
            return this;
        },
        chCount: function(cartItem, f) {
            Shop.Cart.currentItem = this.load(cartItem.storageId());
            if (Shop.Cart.currentItem) {
                if (Shop.Cart.currentItem.count != cartItem.count){
                    Shop.Cart.currentItem.count = cartItem.count;
                    Shop.currentCallbackFn = f;
                    if (cartItem.kit)
                        var postName = 'kits[ShopKit_' + Shop.Cart.currentItem.kitId + ']';
                    else
                        var postName = 'products[SProducts_' + cartItem.id + '_' + cartItem.vId + ']';
                    var postData = {
                        recount: 1
                    };
                    postData[postName] = cartItem.count;
                    $.post('/shop/cart_api/recount', postData, function(data) {
                        var dataObj = JSON.parse(data);
                        if (dataObj.hasOwnProperty('count'))
                            Shop.Cart.currentItem.count = dataObj.count;
                        Shop.Cart.save(Shop.Cart.currentItem);
                        (Shop.currentCallbackFn());
                        $(document).trigger({
                            type: 'count_changed',
                            cartItem: _.clone(cartItem)
                        });
                        $(document).trigger({
                            type: 'cart_changed'
                        });
                    });
                    return this.totalRecount();
                }
            }
        },
        clear: function() {
            $.getJSON('/shop/cart_api/clear',
                function() {
                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        localStorage.removeItem(items[i].storageId());
                    delete items;
                    $(document).trigger({
                        type: 'cart_changed'
                    });
                    $(document).trigger({
                        type: 'cart_clear'
                    });
                    Shop.Cart.totalRecount();
                }
                );
        },
        //work with storage
        load: function(key) {
            try {
                return new Shop.cartItem(JSON.parse(localStorage.getItem(key)));
            } catch (e) {
                return false;
            }
        },
        save: function(cartItem) {
            if (!cartItem.storageId().match(/undefined/)) {
                localStorage.setItem(cartItem.storageId(), JSON.stringify(cartItem));
                this.totalRecount();
            }
            return this;
        },
        getAllItems: function() {
            var pattern = /cartItem_*/;
            var items = [];
            for (var i = 0; i < localStorage.length; i++) {
                var key = localStorage.key(i);
                try {
                    if (key.match(pattern))
                        items.push(this.load(key));
                } catch (err) {
                }
            }
            return items;
        },
        length: function() {
            var pattern = /cartItem_*/;
            var length = 0;
            for (var i = 0; i < localStorage.length; i++) {
                try {
                    if (localStorage.key(i).match(pattern)){
                        var tempC = parseInt(JSON.parse(localStorage.getItem(localStorage.key(i))).count)
                        tempC = isNaN(tempC) ? 0 : tempC;
                        length += tempC;
                    }
                } catch (err) {
                    length += 0;
                }
            }
            return length;
        },
        totalRecount: function() {
            var items = this.getAllItems();
            this.totalPrice = 0;
            this.totalAddPrice = 0;
            this.totalCount = 0;
            this.totalPriceOrigin = 0;
            for (var i = 0; i < items.length; i++) {
                var item = items[i],
                itemC = item.count == '' ? 0 : item.count;
                if (item.origprice != '')
                    this.totalPriceOrigin += item.origprice * itemC;
                else
                    this.totalPriceOrigin += item.price * itemC;
                this.totalPrice += item.price * itemC;
                this.totalAddPrice += item.addprice * itemC;
                this.totalCount += parseInt(itemC);
            }
            return this;
        },
        getTotalPrice: function() {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPrice;
            else
                return this.totalPrice;
        },
        getTotalAddPrice: function() {
            if (this.totalAddPrice == 0)
                return this.totalRecount().totalAddPrice;
            else
                return this.totalAddPrice;
        },
        getTotalPriceOrigin: function() {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPriceOrigin;
            else
                return this.totalPriceOrigin;
        },
        getFinalAmount: function() {
            if (this.shipFreeFrom >= 0)
                if (this.shipFreeFrom <= this.getTotalPriceOrigin())
                    this.shipping = 0;
            return (this.totalRecount().totalPriceOrigin + this.shipping - parseFloat(this.giftCertPrice)) >= 0 ? (this.totalRecount().totalPriceOrigin + this.shipping - parseFloat(this.giftCertPrice)) : 0;
        },
        renderPopupCart: function(selector) {
            if (typeof selector == 'undefined' || selector == '')
                selector = this.popupCartSelector;
            return template = _.template($(selector).html(), Shop.Cart);
        },
        sync: function() {
            $(document).trigger({
                type: 'before_sync_cart'
            });
            $.getJSON('/shop/cart_api/sync', function(data) {
                if (typeof(data) == 'object') {
                    var pattern = /cartItem_*/;
                    var items = Shop.Cart.getAllItems();
                    
                    for (var i = 0; i < items.length; i++) {
                        try {
                            if (localStorage.key(i).match(pattern))
                                localStorage.removeItem('cartItem_' + items[i]['id'] + '_' + items[i]['vId']);
                        }catch(err){}
                    }
                    delete items;
                    _.each(_.keys(data.data.items), function(key) {
                        localStorage.setItem(key, JSON.stringify(data.data.items[key]));
                    });
                    $(document).trigger({
                        type: 'sync_cart'
                    });
                }
                $(document).trigger({
                    type: 'end_sync_cart'
                });
                if (data == false)
                    Shop.Cart.clear();
            });
        },
        updatePage: function() {
        }
    },
    cartItem: function(obj) {
        if (typeof obj == 'undefined' || obj == false)
            obj = {
                id: false,
                vId: false,
                name: false,
                count: false,
                kit: false,
                maxcount: 0,
                number: '',
                vname: false,
                url: false
            };
        return prototype = {
            id: obj.id ? obj.id : 0,
            vId: obj.vId ? obj.vId : 0,
            price: obj.price ? obj.price : 0,
            prices: obj.prices ? obj.prices : 0,
            addprice: obj.addprice ? obj.addprice : 0,
            addprices: obj.addprices ? obj.addprices : 0,
            origprice: obj.origprice ? obj.origprice : 0,
            origprices: obj.origprices ? obj.origprices : 0,
            name: obj.name ? obj.name : '',
            count: obj.count ? obj.count : 1,
            kit: obj.kit ? obj.kit : false,
            kitId: obj.kitId ? obj.kitId : 0,
            maxcount: obj.maxcount ? obj.maxcount : 0,
            number: obj.number ? obj.number : 0,
            vname: obj.vname ? obj.vname : '',
            url: obj.url ? obj.url : '',
            img: obj.img ? obj.img : '',
            prodstatus: obj.prodstatus ? obj.prodstatus : '',
            storageId: function() {
                return 'cartItem_' + this.id + '_' + this.vId;
            }
        };
    },
    composeCartItem: function($context) {
        var cartItem = new Shop.cartItem();
        cartItem.id = $context.data('prodid');
        cartItem.vId = $context.data('varid');
        cartItem.count = $context.attr('data-count');
        cartItem.price = $context.data('price');
        cartItem.prices = $context.data('prices');
        cartItem.addprice = $context.data('addprice');
        cartItem.addprices = $context.data('addprices');
        cartItem.origprice = $context.data('origprice')
        cartItem.origprices = $context.data('origprices')
        cartItem.name = $context.data('name');
        cartItem.kit = $context.data('kit');
        cartItem.kitId = $context.data('kitid');
        cartItem.maxcount = $context.data('maxcount');
        cartItem.number = $context.data('number');
        cartItem.vname = $context.data('vname');
        cartItem.url = $context.data('url');
        cartItem.img = $context.data('img');
        cartItem.prodstatus = $context.data('prodstatus');
        return cartItem;
    },
    CompareList: {
        items: [],
        all: function() {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add: function(key) {
            this.items = this.all();
            if (this.items.indexOf(key) === -1) {
                $.get('/shop/compare_api/add/' + key, function(data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items.push(key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_add',
                                dataObj: dataObj
                            });
                        }
                    } catch (e) {
                    }
                });
            }
        },
        rm: function(key, el) {
            this.items = JSON.parse(localStorage.getItem('compareList')) ? JSON.parse(localStorage.getItem('compareList')) : [];
            if (this.items.indexOf(key) !== -1) {
                
                this.items = _.without(this.items, key);
                this.items = this.all();
                $.get('/shop/compare_api/remove/' + key, function(data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items = _.without(Shop.CompareList.items, key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_rm',
                                dataObj: dataObj
                            });
                        }
                    } catch (e) {
                    }
                });
            }
            $(document).trigger({
                type: 'delete_compare',
                el: $(el)
            });
        },
        sync: function() {
            $.getJSON('/shop/compare_api/sync', function(data) {
                if (typeof(data) == 'object' || typeof(data) == 'Array') {
                    localStorage.setItem('compareList', JSON.parse(data));
                    $(document).trigger({
                        type: 'compare_list_sync'
                    });
                }
                else
                if (data === false) {
                    localStorage.removeItem('compareList');
                    $(document).trigger({
                        type: 'compare_list_sync'
                    });
                }
            });
        }
    }
};
if (typeof(wishList) != 'object')
    var wishList = {
        all: function() {
            try {
                return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : []
            } catch (err) {
                return [];
            }
        },
        sync: function() {
            $.post('/wishlist/wishlistApi/sync', function(data) {
                localStorage.setItem('wishList', data);
                $(document).trigger({
                    'type': 'wish_list_sync'
                });
            })
        }
    }
/**
* AuthApi ajax client
* Makes simple request to api controllers and get return data in json
* 
* @author Avgustus
* @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
* 
* Get JSON object with fields list:
*      'status'    -   true/false - if the operation was successful,
*      'msg'       -   info message about result,
*      'refresh'   -   true/false - if true refreshes the page,
*      'redirect'  -   url - redirects to needed url
*    
* List of api methods:
*      Auth.php:
*          '/auth/authapi/login',
*          '/auth/authapi/logout',
*          '/auth/authapi/register',
*          '/auth/authapi/forgot_password',
*          '/auth/authapi/reset_password',
*          '/auth/authapi/change_password',
*          '/auth/authapi/cancel_account',
*          '/auth/authapi/banned',
*          '/shop/ajax/getApiNotifyingRequest',
*          '/shop/callbackApi'
* 
**/

var ImageCMSApi = {
    defSet: function() {
        return imageCmsApiDefaults;
    },
    returnMsg: function(msg) {
        if (window.console) {
            console.log(msg);
        }
    },
    formAction: function(url, selector, obj) {
        //collect data from form
        var DS = $.extend($.extend({}, this.defSet()), obj)
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        //send api request to api controller
        $(document).trigger({
            'type': 'showActivity'
        });
        $.ajax({
            type: "post",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                ImageCMSApi.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                $(document).trigger({
                    'type': 'hideActivity'
                });
                if (obj !== null) {
                    var form = $(selector);
                    ImageCMSApi.returnMsg("[status]:" + obj.status);
                    ImageCMSApi.returnMsg("[message]: " + obj.msg);
                    if (typeof DS.callback == 'function')
                        DS.callback(obj.msg, obj.status, form, DS);
                    else
                        setTimeout((function() {
                            form.parent().find(DS.msgF).fadeOut(function() {
                                $(this).remove();
                            });
                            if (DS.hideForm)
                                form.show();
                        }), DS.durationHideForm);
                    if ((obj.refresh == true || obj.refresh == 'true') && (obj.redirect == false || obj.redirect == 'false'))
                        location.reload();
                    if ((obj.refresh == 'false' || obj.refresh == false) && (obj.redirect == true || obj.redirect != ''))
                        location.href = obj.redirect;
                    if (obj.status == true) {
                        if (DS.hideForm)
                            form.hide();
                        if (DS.messagePlace == 'ahead')
                            $(message.success(obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace == 'behind')
                            $(message.success(obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg', 
                            'el': form.parent()
                        })
                    }
                    if (obj.cap_image != 'undefined' && obj.cap_image != null) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations != 'undefined' && obj.validations != null) {
                        ImageCMSApi.sendValidations(obj.validations, selector, DS);
                    }
                    $(form).find(':input').unbind('input.imageapi').on('input.imageapi', function() {
                        var $this = $(this),
                        form = $this.closest('form'),
                        $thisТ = $this.attr('name'),
                        elMsg = form.find('[for=' + $thisТ + ']');
                        if ($.exists(elMsg)) {
                            $this.removeClass(DS.err + ' ' + DS.scs);
                            elMsg.hide();
                            $(document).trigger({
                                'type': 'imageapi.hidemsg', 
                                'el': form
                            })
                        }
                    });
                }
                return this;
            }
        }).done(function() {
            ImageCMSApi.returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            ImageCMSApi.returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $(selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    /**
* for displaying validation messages 
* in the form, which needs validation, for each validate input
* 
* */
    sendValidations: function(validations, selector, DS) {
        var thisSelector = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] != "") {
                    var input = thisSelector.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, thisSelector));
                    var finput = thisSelector.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
                if (i == Object.keys(validations).length)
                    $(document).trigger({
                        'type': 'imageapi.pastemsg', 
                        'el': thisSelector
                    })
                i++;
            }
        } else {
            return false;
        }
    },
    /**
* add captcha block if needed
* @param {type} captcha_image
*/
    addCaptcha: function(cI, DS) {
        DS.captchaBlock.html(DS.captcha(cI));
        return false;
    }
}