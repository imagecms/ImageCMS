var activeClass = 'active',
cloned = '.cloned';
clonedC = 'cloned',
    wnd = $(window),
    body = $('body');
/*
 *imagecms frontend plugins
 **/
function plural_str(i, str){
    function plural (a){
        if ( a % 10 == 1 && a % 100 != 11 ) return 0
        else if ( a % 10 >= 2 && a % 10 <= 4 && ( a % 100 < 10 || a % 100 >= 20)) return 1
        else return 2;
    }

    switch (plural(i)) {
        case 0:
            return str[0];
        case 1:
            return str[1];
        default:
            return str[2];
    }
}

jQuery.exists = function(selector) {
    return ($(selector).length > 0);
}
jQuery.exists_nabir = function(nabir) {
    return (nabir.length > 0);
}
function setcookie(name, value, expires, path, domain, secure)
{
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
var ie = jQuery.browser.msie,
ieV = jQuery.browser.version,
ltie7 = ie && (ieV <= 7),
ltie8 = ie && (ieV <= 8);

function ieInput(els) {
    els = $('input[type="text"], textarea, input[type="password"]');

    els.not(':hidden').not('.visited').not('.notvis').each(function() {
        $this = $(this);
        $this.css({
            'width': function() {
                return 2 * $this.width() - $this.outerWidth();
            },
            'height': function() {
                return 2 * $this.height() - $this.outerHeight();
            }
        }).addClass('visited');
    });
}
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))) {
                var settings = $.extend({
                    wrapper: $(".frame-label:has(.niceCheck)"),
                    elCheckWrap: '.niceCheck',
                    evCond: false,
                    before: function() {
                        return true;
                    }
                }, options);
                var frameChecks = $(this);
                wrapper = settings.wrapper;
                elCheckWrap = settings.elCheckWrap;
                evCond = settings.evCond;
                frameChecks = frameChecks.selector.split(',')
                $.map(frameChecks, function(i, n) {
                    thisFrameChecks = $(i.replace(' ', ''));
                    thisFrameChecks.each(function() {
                        $(this).find(elCheckWrap).each(function() {
                            var $this = $(this).removeClass('b_n');
                            var $thisInput = $this.children()

                            if (!$thisInput.is('[disabled="disabled"]'))
                                methods.changeCheckStart($this, $thisInput);
                            else {
                                methods.checkUnChecked($this, $thisInput)
                                methods.CheckallDisabled($this, $thisInput);
                            }
                        })
                    }).find(wrapper).unbind('click').on('click', function() {
                        var $this = $(this),
                        $thisD = $this.is('.disabled'),
                        nstcheck = $this.find(elCheckWrap);
                        if (nstcheck.length == 0)
                            nstcheck = $this

                        if (!$thisD) {
                            if (!evCond)
                                methods.changeCheck(nstcheck);
                            else
                                settings.before(thisFrameChecks, $this, nstcheck);
                        }
                    });
                })
            }
        },
        changeCheckStart: function(el, input) {
            var el = el,
            input = input;
            if (input.attr("checked")) {
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
                input = this.find("input");
            el.addClass('active').parent().addClass('active');
            input.attr("checked", true);
        },
        checkUnChecked: function(el, input) {
            var el = el;
            if (el == undefined)
                el = this;
            var input = input;
            if (input == undefined)
                input = this.find("input");
            el.removeClass('active').parent().removeClass('active');
            input.attr("checked", false);
        },
        changeCheck: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            var input = el.find("input");
            if (!input.attr("checked")) {
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
                el.addClass('active').parent().addClass('active');
                input.attr("checked", true);
            })
        },
        changeCheckallreset: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                input = el.find("input");
                el.removeClass('active').parent().removeClass('active');
                input.attr("checked", false);
            });
        },
        CheckallDisabled: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                input = el.find("input");
                el.removeClass('active').addClass('disabled').parent().addClass('disabled').removeClass('active');
                input.attr('disabled', 'disabled').removeAttr('checked');
            });
        },
        CheckallEnabled: function(el)
        {
            var el = el;
            if (el == undefined)
                el = this;
            el.each(function() {
                input = el.find("input");
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
            $.error('Method ' + method + ' does not exist on jQuery.nStCheck');
        }
    };
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))) {
                var settings = $.extend({
                    after: function() {
                        return true;
                    }
                }, options);
                var after = settings.after,
                $this = $(this);
                $(this).each(function() {
                    methods.changeRadioStart($(this), after);
                });
            }
            $this.parent().unbind('click').on('click', function() {
                methods.changeRadio($(this).children($this), after);
            });
        },
        changeRadioStart: function(el, after)
        {
            var el = el,
            input = el.find("input");
            if (input.attr("checked")) {
                methods.radioCheck(el, input, after);
            }
            el.removeClass('b_n');
            return false;
        },
        changeRadio: function(el, after)
        {
            var el = el,
            input = el.find("input");
            methods.radioCheck(el, input, after);
        },
        radioCheck: function(el, input, after) {
            var el = el,
            input = input;
            el.addClass('active');
            el.parent().addClass('active');
            input.attr("checked", true);
            input.closest('form').find('[name=' + input.attr('name') + ']').not(input).each(function() {
                methods.radioUnCheck($(this).parent(), $(this))
            })

            after(input);
        },
        radioUnCheck: function(el, input) {
            var el = el,
            input = input;
            el.removeClass('active');
            el.parent().removeClass('active');
            input.attr("checked", false);
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
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                item: 'ul > li',
                duration: 300,
                searchPath: "/shop/search/ac",
                inputString: $('#inputString')
            }, options);

            $thisS = $(this);
            itemA = settings.item;
            durationA = settings.duration;
            searchPath = settings.searchPath;
            selectorPosition = -1;
            inputString = settings.inputString.keyup(function(event) {
                if (event.keyCode != 27)
                    methods.lookup(event);
            }).blur(function() {
                $thisS.fadeOut(durationA);
            });
            body.live('click', function(event) {
                event.stopPropagation();
                if ($(event.target).parents().last().is($thisS) || $(event.target).is($thisS))
                    return;
                else
                    $thisS.fadeOut(durationA);

            }).live('keydown', function(e) {
                var key, keyChar;
                if (!e)
                    var e = window.event;

                if (e.keyCode)
                    key = e.keyCode;
                else if (e.which)
                    key = e.which;

                if (key == 27) {
                    $thisS.fadeOut(durationA);
                }
            });
        },
        lookup: function(event) {
            try {
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

                    itemserch.each(function(i, el) {
                        $(el).removeClass('selected');
                        if (i == selectorPosition)
                        {
                            $(el).addClass('selected');
                        }
                    });

                    return false;
                }

                // Enter pressed
                if (code == 13)
                {
                    itemserch.each(function(i, el) {
                        if ($(el).hasClass('selected'))
                        {
                            window.location = $(el).attr('href');
                            window.location = $(el).find('a').attr('href');
                        }
                    });
                }
            }
            catch (err) {
            }

            if (inputString.val().length == 0)
            {
                $thisS.fadeOut(durationA);
            }
            else
            {
                $.fancybox.showActivity();
                $.post(searchPath, {
                    queryString: inputString.val()
                }, function(data) {
                    $.fancybox.hideActivity();
                    $thisS.fadeIn(durationA);
                    try {
                        var dataObj = JSON.parse(data),
                        html = _.template($('#searchResultsTemplate').html(), {
                            'items': dataObj
                        });
                    } catch (e) {
                        var html = e.toString();

                    }
                    $thisS.html(html);
                    selectorPosition = -1;

                    itemserch = $thisS.find(itemA);
                    itemserch.each(function(i, el) {
                        $(el).mouseover(function() {
                            itemserch.removeClass('selected');
                            $(this).addClass('selected');
                            selectorPosition = i;
                        });
                    });
                });
            }
        }
    }
    $.fn.autocomlete = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.autocomlete');
        }
    };
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                title: this.attr('data-title'),
                otherClass: false,
                effect: 'notalways',
                me: true
            }, options);

            var $this = $(this),
            text_el = $this.find(genObj.textEl),
            me = settings.me;

            if (text_el.is(':visible') && $.exists_nabir(text_el) && me)
                return false;
            
            var tooltip = $('.tooltip').not(cloned);

            if (settings.effect == 'always') {
                tooltip.text(settings.title)
            }

            if (settings.otherClass !== false)
                tooltip.addClass(settings.otherClass);
            if (settings.effect == 'notalways')
                tooltip.hide();

            tooltip.css({
                'left': Math.ceil(this.offset().left - (tooltip.actual('outerWidth') - this.outerWidth()) / 2),
                'top': this.offset().top - tooltip.actual('outerHeight')
            }).fadeIn(300);

            $this.filter(':input').unbind('blur').blur(function() {
                $('.tooltip').fadeOut(300);
            })
            body.unbind('click.tooltip').live('click.tooltip', function(event) {
                event.stopPropagation();
                if ($(event.target).parents().is($this) || $(event.target).is($this))
                    return;
                else{
                    $('.tooltip').fadeOut(300);
                }
            })
        },
        remove: function( ) {
            $('.tooltip').fadeOut(300);
        }
    };
    $.fn.tooltip = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.tooltip');
        }
    };
    $('[data-rel="tooltip"]').live('mouseenter', function() {
        $(this).tooltip();
    }).live('mouseleave', function() {
        $(this).tooltip('remove');
    })
})(jQuery);
/*plugin menuImageCms for main menu shop*/
(function($) {
    var methods = {
        position: function(menuW, $thisL, dropW, drop, $thisW, countColumn){
            if (menuW - $thisL < dropW) {
                drop.removeClass('left-drop')
                if (drop.children().children().length >= countColumn)
                    drop.css('right', 0).addClass('right-drop');
                else{
                    var right = menuW - $thisW - $thisL;

                    if ($thisL - $thisW < dropW) right = menuW - dropW;

                    drop.css('right', right).addClass('right-drop');
                }
            }
            else {
                drop.removeClass('right-drop')
                if (drop.children().children().length >= countColumn)
                    drop.css('left', 0).addClass('left-drop');
                else
                    drop.css('left', $thisL).addClass('left-drop');
            }
        },
        init: function(options) {
            if ($.exists_nabir($(this))){
                var sH = 0,
                menu = $(this);
                var settings = $.extend({
                    item: this.find('li'),
                    effectOn: 'fadeIn',
                    effectOff: 'fadeOut',
                    duration: 0,
                    drop: 'li > ul',
                    countColumn: 'none',
                    durationOn: 0,
                    durationOff: 0,
                    dropWidth: null,
                    sub2Frame: null
                }, options);
            
                var menuW = menu.width(),
                menuItem = settings.item,
                drop = settings.drop,
                effOn = settings.effectOn,
                effOff = settings.effectOff,
                countColumn = settings.countColumn,
                item_menu_l = menuItem.length,
                dropW = settings.dropWidth,
                sub2Frame = settings.sub2Frame,
                duration = time_dur_m = settings.duration,
                durationOn = settings.durationOn,
                durationOff = settings.durationOff;
                
                if (!dropW) dropW = parseInt(menuW/3);

                menuItem.each(function(index) {
                    var $this = $(this),
                    $thisW = $this.width(),
                    $thisL = $this.position().left,
                    drop = $this.find(settings.drop),
                    $thisH = $this.height();
                    if ($thisH > sH)
                        sH = $thisH;
                    
                    methods.position(menuW, $thisL, dropW, drop, $thisW, countColumn);
                    
                }).css('height', sH);
                menuItem.find('.helper:first').css('height', sH)

                $('.not-js').removeClass('not-js');
                var hover_t_o = '';
                menuItem.unbind('hover').hover(
                    function() {
                        var $this = $(this),
                        $thisDrop = $this.find(settings.drop);
                        if ($this.index() == 0)
                            $this.addClass('first_h');
                        if ($this.index() == item_menu_l - 1)
                            $this.addClass('last_h');
                        hover_t_o = setTimeout(function() {
                            $thisDrop[effOn](durationOn, function(){
                                if ($thisDrop.length != 0)
                                    menu.addClass('hover');
                                
                                if (sub2Frame){
                                    var listDrop = $thisDrop.children();
                                    
                                    if (!listDrop.is('[data-height]')){
                                        var sumHL1 = listDrop.height(),
                                        dropW = $thisDrop.width();
                                        listDrop.attr('data-height', sumHL1);
                                        isSub2W = $thisDrop.find(sub2Frame).addClass('is-side').actual('width');
                                    }
                                    
                                    listDrop.children().each(function(){
                                        var $this = $(this),
                                        isSub2 = $this.find(sub2Frame);
                                        
                                        if ($.exists_nabir(isSub2)){
                                            var sumHL2 = isSub2.actual('height');
                                            
                                            if (sumHL2 > sumHL1) var koef = Math.ceil(sumHL2 / sumHL1);
                                            
                                            if (koef != undefined){
                                                subWL2 = isSub2W * koef;
                                                if (subWL2 + dropW >  menuW){
                                                    subWL2 = menuW - dropW;
                                                }
                                                
                                                isSub2.css('width', dropW);
                                            }
                                        }
                                    }).unbind('hover').hover(function(){
                                        var subFrame = $(this).find(sub2Frame),
                                        dropW = $(this).parent().parent().width(),
                                        sumW = dropW+subFrame.width(),
                                        subHL2 = subFrame.height(),
                                        dropDH = $thisDrop.children().data('height');
                                        
                                        if (subHL2 < dropDH) subHL2 = dropDH;
                                        
                                        $thisDrop.css('width', sumW);
                                        $thisDrop.children().add(subFrame).css('height', subHL2);
                                    },function(){
                                        var subFrame = $(this).find(sub2Frame);
                                        $thisDrop.css('width', '')
                                        $thisDrop.children().add(subFrame).css('height', '')
                                    })
                                    
                                }
                            });
                        }, time_dur_m);
                    }, function() {
                        var $this = $(this),
                        $thisDrop = $this.find(drop);
                        $(drop).hide();
                        $('.first_h, .last_h').removeAttr('class');
                        clearTimeout(hover_t_o);
                        if ($thisDrop.length != 0)
                            menu.removeClass('hover');
                    });
                menu.unbind('hover').hover(
                    function() {
                        return time_dur_m = 0;
                    },
                    function() {
                        return time_dur_m = duration;
                    });
            }
        },
        refresh: function(){
            methods.init.call($(this), optionsMenu);
        }
    };
    $.fn.menuImageCms = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.menuImageCms');
        }
    };
})(jQuery);
/*plugin menuImageCms end*/
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))){
                var settings = $.extend({
                    effectOn:'show',
                    effectOff:'hide',
                    durationOn: 0,
                    durationOff: 0,
                    before: function() {
                        return true;
                    },
                    after: function() {
                        return true;
                    }
                }, options);
                $this = this;
                var tabs_div = [],
                tabs_id=[],
                nav_tabs_li = [],
                reg_refs = [];
                refs = [];
                attrOrdata = [];
                this_l = this.length;
                k = true;

                var wST = wnd.scrollTop();
                
                return this.each(function(index) {
                    var $thiss = $(this),
                    effectOn = settings.effectOn,
                    effectOff = settings.effectOff,
                    durationOn = settings.durationOn,
                    durationOff = settings.durationOff;
                
                    nav_tabs_li[index] = $thiss.children();
                    refs[index] = nav_tabs_li[index].children();
                    attrOrdata[index] = refs[index].attr('href') != undefined ? 'attr' : 'data';

                    var temp_obj = $([]),
                    temp_obj2 = $([]);

                    refs[index].each(function(ind) {
                        var this_href = $(this)[attrOrdata[index]]('href');
                        if (ind == 0) {
                            reg_refs[index] = "";
                            temp_obj = temp_obj.add($(this_href));
                            temp_obj2 = temp_obj2.add('[data-id='+this_href+']');
                            reg_refs[index] += this_href;
                        }
                        else {
                            temp_obj = temp_obj.add($(this_href));
                            temp_obj2 = temp_obj2.add('[data-id='+this_href+']');
                            reg_refs[index] += '|' + this_href;
                        }
                    })
                    tabs_div[index] = temp_obj;
                    tabs_id[index] = temp_obj2;
                    reg_refs[index] = new RegExp(reg_refs[index]);
                    
                    refs[index].bind('click.tabs', function(event) {
                        var $this = $(this);
                        settings.before();
                        event.preventDefault();
                                               
                        var condRadio = $thiss.data('type') != 'itemsView';
                        
                        if (!$this.parent().hasClass('disabled')) {
                            var $thisA = $this[attrOrdata[index]]('href'),
                            $thisDD = $this.data('drop') == undefined;
                            if ($thisDD) {
                                nav_tabs_li[index].removeClass('active');
                                $this.parent().addClass('active');
                                if (condRadio) {
                                    tabs_div[index].add(tabs_id[index])[effectOff](durationOff).removeClass('active');
                                    $($thisA).add('[data-id='+$thisA+']')[effectOn](durationOn).addClass('active');
                                    if (ltie7)
                                        ieInput();
                                }
                                else {
                                    setcookie('listtable', $this.parent().index(), 0, '/');
                                }
                            }
                            if (condRadio) {
                                if (attrOrdata[index] != 'data') {
                                    if (event.which || event.button == 0) {
                                        var wLH = window.location.hash;
                                        temp = wLH;
                                        try {
                                            if (wLH.indexOf($thisA) == -1) {
                                                temp = temp.replace(wLH.match(reg_refs[index])[0], $thisA)
                                            }
                                            if (wLH.charAt(wLH.indexOf($thisA)) != '') {
                                                temp += $thisA;
                                            }
                                            window.location.hash = temp;
                                        } catch (e) {
                                            window.location.hash += $thisA;
                                        }
                                    }
                                    else if ($thisDD && k) {
                                        window.location.hash = hashs[0].join('');
                                        k = false;
                                    }
                                    if (!$thisDD) $this.trigger('click.drop')
                                }
                            }
                            else {
                                refs[index].each(function(){
                                    var $thisDH = $(this).data('href');
                                    if ($thisDH == $thisA) $($thiss.data('elchange')).addClass($thisA)
                                    else $($thiss.data('elchange')).removeClass($thisDH)
                                })
                            }
                        }
                        
                        
                        if (event.which || event.button == 0) {
                            settings.after($thiss);
                        }
                    })

                    if (this_l - 1 == index) {
                        methods.location();
                        methods.startCheck();
                    }
                });


                wnd.bind('hashchange', function(event) {
                    methods.location();
                    methods.startCheck();
                    function scroll_top(wST) {
                        wnd.scrollTop(wST);
                    }

                    //chrome bug
                    if ($.browser.webkit)
                        scroll_top(wST - 100);

                    scroll_top(wST);
                })
            }
        },
        location: function() {
            hashs = [];
            hashs2 = [];

            if (location.hash == '')
            {
                var i = 0,
                j = 0;
                $(refs).each(function(index) {
                    var index = index;
                    $this = refs[index].first(),
                    attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';

                    if ($this.data('drop') == undefined && attrOrdataL != 'data') {
                        hashs[i] = $this[attrOrdataL]('href');
                        i++;
                    }
                    else if (attrOrdataL == 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                })
                return hashs = [hashs, hashs2];
            }
            else {
                $(refs).each(function(index) {
                    var index = index,
                    j = 0;

                    $this = refs[index].first(),
                    attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';

                    if (attrOrdataL == 'data') {
                        hashs2[j] = $this[attrOrdataL]('href');
                        j++;
                    }
                });
                var t = location.hash,
                s = '#',
                m = s.length,
                res = 0,
                i = 0;
                pos = [];

                while (i < t.length - 1)
                {
                    var ch = t.substr(i, m)
                    if (ch == s) {
                        res += 1;
                        i = i + m
                        pos[res - 1] = t.indexOf(s, i - m)
                    }
                    else
                        i++
                }
                var i = 0;
                while (i < pos.length) {
                    hashs[i] = t.substring(pos[i], pos[i + 1]);
                    i++;
                }
                return hashs = [hashs, hashs2];
            }
        },
        startCheck: function() {
            $(hashs[1].join(',')).each(function(index) {
                $(this).trigger('click.tabs');
            });
            $.map(hashs[0], function(n, i) {
                $('[href=' + n + ']').length == 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                $('[' + attrOrdataNew + '=' + n + ']').trigger('click.tabs');
            });
        }
    };
    $.fn.tabs = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.tabs');
        }
    }
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({}, options),
            mouseWhell = settings.mouseWhell;
            elEven = settings.elEven;
            elEvens = $(settings.right).find(elEven);
            onlyDif = settings.onlyDif;
            allParams = settings.allParams;
            hoverParent = settings.hoverParent;
            this.each(function(index) {
                var $this = $(this),
                visThis = $this.is(':visible');
                if (visThis) {
                    var left = $this.find(settings.left),
                    right = $this.find(settings.right);
                    li_i_length = left.length;
                }

                if (visThis && !$this.is('[data-equalHorizCell]')) {
                    var h = 0,
                    li_i_h = [],
                    frameScroll = $this.find(settings.frameScroll),
                    frame_scrollC = frameScroll.children(),
                    frame_scrollCL = frame_scrollC.length;
                    scrollNSP = settings.scrollNSP && $.exists(frameScroll);
                    scrollNSPT = settings.scrollNSPT;
                    for (var j = 0; j < li_i_length; j++) {
                        nab = $([]);
                        right.each(function() {
                            nab = nab.add($(this).find(elEven).eq(j))
                        })
                        var tempNabir = left.eq(j).add(nab);
                        tempNabir.each(function(index) {
                            var this_ch = $(this);
                            li_i_h[index] = this_ch.outerHeight();
                            li_i_h[index] > h ? h = li_i_h[index] : h = h;
                        });
                        tempNabir.add(tempNabir.find('.helper')).css('height', h).attr('data-equalHorizCell', '');
                        li_i_h = [];
                        h = 0;
                    }
                    var w = 0;
                    frameScroll.children().each(function() {
                        w += $(this).outerWidth(true);
                    })
                    frameScroll.css('width', w);
                    frameScrollP = frameScroll.parent();
                    frameScrollPW = frameScrollP.width();
                    var scrollW = w - frameScroll.parent().width();
                    if (scrollNSP) {
                        scrollNSPT = $this.find(scrollNSPT);
                        topScrollNSP = scrollNSPT.position().top + scrollNSPT.height();
                        $this.children('.scrollNSP').remove();
                        $this.append('<div class="scrollNSP" style = "overflow:auto;"><div style="width:' + w + 'px;"></div></div>')
                    }
                    var firstScrl = frameScroll.parent(),
                    secScrl = $([]);
                    if (scrollNSP) {
                        secScrl = $this.children('.scrollNSP');
                        secScrl.css({
                            'width': frameScrollPW,
                            'top': topScrollNSP
                        })
                    }

                    if (mouseWhell) {
                        firstScrl.add(secScrl).unbind('mousewheel').bind('mousewheel', function(event, delta, deltaX, deltaY) {
                            $thisSL = $(this).scrollLeft();
                            if ($thisSL != scrollW && deltaY < 0) {
                                firstScrl.add(secScrl).scrollLeft($thisSL + w / frame_scrollCL);
                                return false;
                            }
                            if ($thisSL > 0 && deltaY > 0) {
                                firstScrl.add(secScrl).scrollLeft($thisSL - w / frame_scrollCL);
                                return false;
                            }
                        });
                    }
                    firstScrl.add(secScrl).scrollLeft('0');
                    secScrl.unbind('scroll').bind('scroll', function() {
                        $thisSL = $(this).scrollLeft();
                        firstScrl.add(secScrl).scrollLeft($thisSL);
                    });
                    $this.attr('data-equalHorizCell', '');
                }
                if (visThis) {
                    var right = right.find(hoverParent),
                    left = left.parent(hoverParent).children();
                    left.each(function(ind) {
                        if (ind % 2 == 0)
                            $(this).removeClass('evenC').addClass('oddC');
                        else
                            $(this).removeClass('oddC').addClass('evenC')
                    });
                    right.each(function() {
                        $(this).find(elEven).each(function(ind) {
                            if (ind % 2 == 0)
                                $(this).removeClass('evenC').addClass('oddC');
                            else
                                $(this).removeClass('oddC').addClass('evenC')
                        });
                    });
                    methods.hoverComprasion(left, right);
                    onlyDif.die('click').live('click', function() {
                        methods.onlyDifM(left, right);
                    })
                    allParams.die('click').live('click', function() {
                        methods.allParamsM(left, right);
                    })
                }
            })
        },
        refresh: function() {
            $('[data-equalHorizCell]').removeAttr('data-equalHorizCell').filter(':not([data-refresh])').removeAttr('style');
            $(this).equalHorizCell(optionCompare)
        },
        headComprasion: function() {
            compHead = $('.comprasion_head');
            if (compHead.attr('data-equalHorizCell') != undefined && compHead.height() > left.first().height() - 70)
                compHead.find('.tabs').css('height', left.first().height() - 70);
            else
                compHead.find('.tabs').css('height', left.first().height() - 70).attr('data-equalHorizCell');
        },
        hoverComprasion: function(left, right) {
            left.add(right.find(elEven)).hover(function() {
                var $this = $(this),
                index = $this.index(),
                nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(index))
                })
                $([]).add(left.eq(index)).add(nab).addClass('hover')
            },
            function() {
                var $this = $(this),
                index = $this.index(),
                nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(index))
                })
                $([]).add(left.eq(index)).add(nab).removeClass('hover')
            });
        },
        onlyDifM: function(left, right) {
            li_i_h = [];
            var genObjC = $([]);
            tempText = '';
            k = 0;
            for (var j = 0; j < li_i_length; j++) {
                nab = $([]);
                right.each(function() {
                    nab = nab.add($(this).find(elEven).eq(j))
                })
                var tempNabir = nab;
                tempNabir.each(function(index) {
                    var this_ch = $(this);
                    li_i_h[index] = $.trim(this_ch.text());
                    if (tempText == li_i_h[index])
                        k++;
                    tempText = li_i_h[index];
                });
                if (k == tempNabir.length - 1 && k != 0)
                    genObjC = genObjC.add(left.eq(j)).add(tempNabir);
                li_i_h = [];
                k = 0;
                tempText = '';
            }
            right.each(function() {
                $(this).find(elEven).not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 == 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC')
                });
            });
            left.not(genObjC).removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 == 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC')
            });
            genObjC.hide();
        },
        allParamsM: function(left, right) {
            left.removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 == 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC')
            }).show();
            right.each(function() {
                $(this).find(elEven).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 == 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC')
                }).show();
            });
        }
    };
    $.fn.equalHorizCell = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.equalHorizCell');
        }
    };
})(jQuery);
(function($) {
    $.fn.actual = function() {
        if (arguments.length && typeof arguments[0] == 'string') {
            var dim = arguments[0];

            clone = $(this).clone().addClass(clonedC).appendTo('body');
            
            clone.css({
                position: 'absolute',
                top: '-9999px'
            }).show();
            
            var dimS = clone[dim]();

            
            clone.remove();

            return dimS;
        }
        return undefined;
    };
}(jQuery));
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))){
                settings = $.extend({
                    exit: '[data-closed = "closed-js"]',
                    effon: 'show',
                    effoff: 'hide',
                    duration: 200,
                    place: 'center',
                    placement: 'noinherit',
                    before: function() {
                        return true;
                    },
                    after: function() {
                        return true;
                    },
                    close: function() {
                        return true;
                    }
                }, options);

                var $thisD = this,
                selector = $thisD.selector,
                dataSource = $('[data-drop]'),
                exit = $(settings.exit),
                effon = settings.effon,
                effoff = settings.effoff,
                duration = settings.duration,
                place = settings.place,
                placement = settings.placement,
                overlayColor = settings.overlayColor,
                overlayOpacity = settings.overlayOpacity;

                dataSource.live('click.drop', function(event) {
                    $.fancybox.showActivity();
                    event.stopPropagation();
                    event.preventDefault();
                    
                    var $this = $(this);
                    if ($(event.target).parents('[data-simple="yes"]').length == 0){//for propagation with tabs
                        elSet = $this.data();
                        
                        function showDrop(elSetSource, isajax){
                            var place = elSet.place ||  settings.place,
                            placement = elSet.placement || settings.placement,
                            $thisEOff = elSet.effectOff || effoff,
                            $thisD = elSet.duration || duration;
                            
                            $this.each(function() {
                                var $this = $(this),
                                $thisSource = elSet.drop;
                        
                                $this.attr('data-placement', placement);
                                $this.attr('data-place', place);
                                $($thisSource).attr('data-effect-off', $thisEOff).attr('data-duration', $thisD).attr('data-elrun', $thisSource);
                            });
                    
                            var $thisEOn = elSet.effectOn || effon,
                            $thisEOff = elSet.effectOff || effoff,
                            $thisD = elSet.duration || duration,
                            overlayColor = elSet.overlaycolor || settings.overlayColor,
                            overlayOpacity = elSet.overlayopacity || settings.overlayOpacity;

                            condOverlay = overlayColor != undefined && overlayOpacity != undefined && place == "center";
                            if (condOverlay) {
                                if (!$.exists('.overlayDrop')) {
                                    body.append('<div class="overlayDrop" style="display:none;position:fixed;width:100%;height:100%;left:0;top:0;z-index: 1001;"></div>')
                                }
                                drop_over = $('.overlayDrop');
                                drop_over.css({
                                    'background-color': overlayColor,
                                    'opacity': overlayOpacity
                                });
                            }
                            else
                                drop_over = $([]);

                            if (elSetSource.is('.' + activeClass)) {
                                methods.triggerBtnClick(elSetSource, selector);
                            }
                            else {
                                settings.before($this, elSetSource, isajax);
                            
                                $thisDrop = $this.closest('[data-elrun]');
                                if ($.exists_nabir($thisDrop)) methods.triggerBtnClick($thisDrop, selector);
                            
                                if (event.button == undefined && place != "center") wnd.scrollTop($this.offset().top);

                                var wndW = wnd.width();
                                if (elSetSource.actual('width') > wnd.width()) elSetSource.css('width', wndW-40);
                                else elSetSource.removeAttr('style');
                    
                                methods.positionDrop($this, placement, place);
                            
                                if (place == "center") methods.dropScroll(elSetSource);

                                
                                if (condOverlay) {
                                    drop_over.show()
                                    drop_over.unbind('click').bind('click', function(e){
                                        e.stopPropagation();
                                        methods.triggerBtnClick(false,selector);
                                    })
                                }
                                elSetSource[$thisEOn]($thisD, function() {
                                    elSetSource.addClass(activeClass);
                                    if (ltie7)
                                        ieInput();
                                    settings.after($this, elSetSource, isajax);
                                });
                            }
                            $.fancybox.hideActivity();
                        }
                        
                        $this.parent().addClass(activeClass);
                        elSetSource = $(elSet.drop);
                        if ($.exists_nabir(elSetSource)){
                            showDrop(elSetSource);
                        }
                        else{
                            if (elSet.source){
                                $.post(elSet.source, function(data){
                                    $.fancybox.hideActivity();
                                    body.append(data);
                                    elSetSource = $(elSet.drop);
                                    showDrop(elSetSource, true);
                                    dataSource = $('[data-drop]');
                                })
                            }
                        }
                    }
                })
                exit.live('click', function(){
                    methods.triggerBtnClick($(this).closest('[data-elrun]'), selector);
                })
                body.live('click', function(event) {
                    event.stopPropagation();
                    if (event.button == 0 && event.relatedTarget == null){
                        if ($(event.target).parents().is(selector) || $(event.target).is(selector) || $(event.target).is(exit))
                            return;
                        else
                        {
                            methods.triggerBtnClick(false,selector);
                        }
                    }
                }).live('keydown', function(e) {
                    var key, keyChar;
                    if (!e)
                        var e = window.event;

                    if (e.keyCode)
                        key = e.keyCode;
                    else if (e.which)
                        key = e.which;

                    if (key == 27) {
                        methods.triggerBtnClick(false,selector);
                    }
                });
            }
        },
        triggerBtnClick: function(sel, selector) {
            if (!sel) var drop = $('[data-elrun].' + activeClass);
            else var drop = sel;
            
            drop.removeClass(activeClass).each(function() {
                var $this = $(this),
                $thisEOff = $this.attr('data-effect-off'),
                $thisD = $this.attr('data-duration');
                
                var $thisB = $('.' + activeClass + ' > [data-drop = "' + $this.attr('data-elrun') + '"]');
                $thisB.parent().removeClass(activeClass);
                
                var $thisHref = $thisB.attr('href');
                if ($thisHref != undefined) {
                    var $thisHrefL = $thisHref.length,
                    wLH = location.hash,
                    wLHL = wLH.length;
                    try {
                        var indH = wLH.match($thisHref + '(?![a-z])').index;
                        location.hash = wLH.substring(0, indH) + wLH.substring(indH + $thisHrefL, wLHL)
                    } catch (err) {}
                }
                
                if ($thisB.data('place') == 'center' && !$.exists_nabir($(selector+'.'+activeClass))) {
                    if ($(document).height()-wnd.height() > 0){
                        drop_over.removeClass('drop_overlay_fixed');
                        body.removeClass('isScroll')
                    }
                    drop_over.hide();
                }
                $this[$thisEOff]($thisD, function(){
                    $(this).removeAttr('style');
                    settings.close($thisB, $this);
                });
            });
            wnd.unbind('resize.drop');
        },
        dropScroll: function(elSetSource) {
            elSetSource.css({
                'top': (wnd.height() - elSetSource.actual('height')) / 2 + wnd.scrollTop(),
                'left': (wnd.width() - elSetSource.actual('width')) / 2 + wnd.scrollLeft()
            }, {
                queue: false
            });
        },
        positionDrop: function($this, placement, place){
            var $this = $this;
            if ($this == undefined) $this = $(this);
            if (placement == undefined) placement = $this.data('placement');
            if (place == undefined) place = $this.data('place');
            
            var elSetSource = $($this.data().drop);
            
            var $thisP = place;
            dataSourceH = 0,
            dataSourceW = 0,
            $thisW = $this.width(),
            $thisH = $this.height();

            if ($thisP == 'noinherit') {
                var $thisPMT = placement.toLowerCase().split(' ');

                if ($thisPMT[0] == 'bottom' || $thisPMT[1] == 'bottom')
                    dataSourceH = -elSetSource.actual('height');

                if ($thisPMT[0] == 'top' || $thisPMT[1] == 'top')
                    dataSourceH = $thisH;

                if ($thisPMT[0] == 'left' || $thisPMT[1] == 'left')
                    dataSourceW = 0;

                if ($thisPMT[0] == 'right' || $thisPMT[1] == 'right')
                    dataSourceW = -elSetSource.actual('width') + $thisW;
                

                $thisT = $this.offset().top + dataSourceH;
                $thisL = $this.offset().left + dataSourceW;
                if ($thisL < 0) $thisL = 0;

                elSetSource.css({
                    'top': $thisT,
                    'left': $thisL
                });
                if ($thisL == 0) elSetSource.css('margin-left', 0);
            }
            if ($thisP == 'center') {
                if ($(document).height()-wnd.height() > 0){
                    body.addClass('isScroll');
                    drop_over.addClass('drop_overlay_fixed');
                }
            }
            wnd.bind('resize.drop', function(){
                methods.dropScroll(elSetSource)
            });
        //if (this instanceof $) methods.dropScroll($($(this).data('drop')));
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
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var settings = $.extend({
                prev: '',
                next: ''
            }, options);
            if (this.length > 0) {
                return this.each(function() {
                    var $this = $(this),
                    prev = settings.prev.split('.'),
                    next = settings.next.split('.'),
                    $thisPrev = $this,
                    $thisNext = $this,
                    regS = '',
                    regM = '';

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

                    $thisNext.click(function() {
                        var input = $this.focus();
                        var inputVal = parseInt(input.val());

                        if (isNaN(inputVal))
                            input.val(1);
                        else
                            input.val(inputVal + 1);
                    })
                    $thisPrev.click(function() {
                        var input = $this.focus();
                        var inputVal = parseInt(input.val());
                                                
                        if (isNaN(inputVal))
                            input.val(1)
                        else if (inputVal > 1)
                            input.val(inputVal - 1)
                        
                    })
                    $this.die('keyup').live('keyup', function() {
                        if (checkProdStock)
                            $(this).maxValue();
                    })
                    $this.closest(genObj.frameCount).tooltip('remove');
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
            $.error('Method ' + method + ' does not exist on jQuery.plusminus');
        }
    };
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            var $this = $(this);
            var $min = $(this).attr('data-min');
            var $max = parseInt($(this).attr('data-max'));

            $thisVal = $this.val();
            if ($thisVal == '') {
                $this.keypress(function(event) {
                    var key, keyChar;
                    if (!event)
                        var event = window.event;

                    if (event.keyCode)
                        key = event.keyCode;
                    else if (event.which)
                        key = event.which;

                    keyChar = String.fromCharCode(key);
                    if ($thisVal == '' && keyChar == 0)
                        return false;
                })
            }
            else if ($thisVal <= $min)
                $this.val($min);

            if (typeof $max == 'integer' && $max != 0)
                if ($thisVal > $max)
                    $thisVal = $max;
        }
    };

    $.fn.minValue = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.minValue');
        }
    };
    $('[data-min]').live('keyup', function() {
        $(this).minValue();
    })
})(jQuery);


(function($) {
    var methods = {
        init: function(options) {
            var $this = $(this),
            $max = parseInt($(this).attr('data-max'));

            $thisVal = $this.val();

            if ($thisVal > $max) {
                $this.val($max);
                return true;
            }
            else
                return false;
        }
    };
    $.fn.maxValue = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.maxValue');
        }
    };
})(jQuery);

/*plugin myCarousel use jQarousel with correction behavior prev and next buttons*/
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))) {
                var $js_carousel = $(this);
                var settings = $.extend({
                    item: 'li',
                    prev: '.prev',
                    next: '.next',
                    content: '.content-carousel',
                    groupButtons: '.group-button-carousel',
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
                adding = settings.adding;
					
                $js_carousel.each(function(index) {
                    var $this = $(this),
                    $item = $this.find(content).children().children(item),
                    $item_l = $item.length,
                    $item_w = $item.outerWidth(true),
                    $this_prev = $this.find(prev),
                    $this_next = $this.find(next),
                    $marginR = $item_w - $item.outerWidth(),
                    cont_width = $this.find(content).width(),
                    group_button = $this.find(groupButtons);

                    settings.before($this);
                    
                    var $count_visible = (cont_width / $item_w).toFixed(1);
                    if ($item_w * $item_l - $marginR > cont_width) {
                        var main_obj = {
                            buttonNextHTML: $this_next,
                            buttonPrevHTML: $this_prev,
                            visible: $count_visible,
                            scroll: 1
                        }
                        $this.jcarousel($.extend(
                            adding
                            , main_obj));

                        $this_next.add($this_prev).css('display', 'inline-block');
                        group_button.append($this_next.add($this_prev));
                    }
                    else {
                        $this_next.add($this_prev).hide();
                    }
                    settings.after($this);
                });
            }
            return $js_carousel;
        }
    };
    $.fn.myCarousel = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.myCarousel');
        }
    }
})(jQuery);
/*
     *imagecms shop plugins
     **/
if (!Array.indexOf) {
    Array.prototype.indexOf = function (obj, start) {
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
    Cart:{
        totalPrice:0,
        totalCount:0,
        popupCartSelector:'script#cartPopupTemplate',
        countChanged:false,
        shipping:0,
        shipFreeFrom:0,
        giftCertPrice: 0,

        add:function (cartItem) {
            //trigger before_add_to_cart
            $(document).trigger({
                type:'before_add_to_cart',
                cartItem:_.clone(cartItem)
            });
            //
            var data = {
                'quantity':cartItem.count,
                'productId':cartItem.id,
                'variantId':cartItem.vId
            };
            var url = '/shop/cart_api/add';

            if (cartItem.kit) {
                data = {
                    'quantity':cartItem.count,
                    'kitId':cartItem.kitId
                };

                url += '/ShopKit';
            }

            Shop.currentItem = cartItem;
            $.post(url, data,
                function (data) {
                    try {
                        responseObj = JSON.parse(data);

                        //save item to storage
                        Shop.Cart._add(Shop.currentItem);
                    } catch (e) {
                        return;
                    }
                });
            return;

        },
        _add:function (cartItem) {

            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
                currentItem.count += cartItem.count;
            else
                currentItem = cartItem;

            this.save(currentItem);


            ////trigger after_add_to_cart
            $(document).trigger({
                type:'after_add_to_cart',
                cartItem:_.clone(cartItem)
            });

            $(document).trigger({
                type:'cart_changed'
            });
            //

            return this;
        },
        rm:function (cartItem) {
            Shop.currentItem = this.load('cartItem_' + cartItem.id + '_' + cartItem.vId);

            if (Shop.currentItem.kit)
                var key = 'ShopKit_' + Shop.currentItem.kitId;
            else
                var key = 'SProducts_' + Shop.currentItem.id+'_'+Shop.currentItem.vId;

            //Shop.currentItem = cartItem;
            $.getJSON('/shop/cart_api/delete/' + key, function () {
                localStorage.removeItem('cartItem_' + Shop.currentItem.id +'_'+ Shop.currentItem.vId);

                Shop.Cart.totalRecount();

                $(document).trigger({
                    type:'cart_rm',
                    cartItem: Shop.currentItem
                });

                $(document).trigger({
                    type:'cart_changed'
                });
            });

            return this;
        },
        chCount:function (cartItem, f) {
            Shop.Cart.currentItem = this.load(cartItem.storageId());
            if (Shop.Cart.currentItem) {

                Shop.Cart.currentItem.count = cartItem.count;

                //this.countChanged = true;

                Shop.currentCallbackFn = f;

                if (cartItem.kit)
                    var postName = 'kits[ShopKit_'+Shop.Cart.currentItem.kitId+']';
                else
                    var postName = 'products[SProducts_'+cartItem.id+'_'+cartItem.vId+']';

                var postData = {
                    recount:1
                };
                postData[postName] = cartItem.count;
                $.post('/shop/cart_api/recount', postData, function(data){

                    var dataObj = JSON.parse(data);
                    if (dataObj.hasOwnProperty('count'))
                        Shop.Cart.currentItem.count = dataObj.count;

                    Shop.Cart.save(Shop.Cart.currentItem);

                    (Shop.currentCallbackFn () );

                    $(document).trigger({
                        type:'count_changed',
                        cartItem:_.clone(cartItem)
                    });

                    $(document).trigger({
                        type:'cart_changed'
                    });

                });

                return this.totalRecount();

            }
        },

        clear:function () {
            $.getJSON('/shop/cart_api/clear',
                function () {
                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        localStorage.removeItem(items[i].storageId());
                    delete items;

                    $(document).trigger({
                        type:'cart_changed'
                    });

                    Shop.Cart.totalRecount();
                }
                );
        },

        //work with storage
        load:function (key) {
            try {
                return new Shop.cartItem(JSON.parse(localStorage.getItem(key)));
            } catch (e) {
                return false;
            }
        },

        save:function (cartItem) {
            if (!cartItem.storageId().match(/undefined/)) {
                localStorage.setItem(cartItem.storageId(), JSON.stringify(cartItem));
                this.totalRecount();

                ////trigger cart_changed
                $(document).trigger({
                    type:'cart_changed'
                });
            //
            }
            return this;
        },

        getAllItems:function () {
            var pattern = /cartItem_*/;

            var items = [];
            for (var i = 0; i < localStorage.length; i++) {

                var key = localStorage.key(i);
                try{
                    if (key.match(pattern))
                        items.push(this.load(key));
                }catch(err){}
            }
            return items;
        },

        length:function () {
            var pattern = /cartItem_*/;
            var length = 0;
            for (var i = 0; i < localStorage.length; i++)
                if (localStorage.key(i).match(pattern))
                    length++;

            return length;
        },

        totalRecount:function () {
            var items = this.getAllItems();

            this.totalPrice = 0;
            this.totalCount = 0;
            
            for (var i = 0; i < items.length; i++) {
                this.totalPrice += items[i].price * items[i].count;
                this.totalCount += parseInt(items[i].count);
            }

            return this;
        },

        getTotalPrice:function () {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPrice;
            else
                return this.totalPrice;
        },

        getFinalAmount:function () {
            if (this.shipFreeFrom > 0)
                if (this.shipFreeFrom <= this.getTotalPrice())
                    this.shipping = 0.0;

            return (this.getTotalPrice() + this.shipping - parseFloat(this.giftCertPrice))>=0?(this.getTotalPrice() + this.shipping - parseFloat(this.giftCertPrice)):0;
        },

        renderPopupCart:function (selector) {
            if (typeof selector == 'undefined' || selector == '')
                selector = this.popupCartSelector;

            return template = _.template($(selector).html(), Shop.Cart);
        },

        sync: function (){
            $.getJSON('/shop/cart_api/sync', function(data){
                if (typeof(data) == 'object'){

                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        if (!items[i].kit)
                            localStorage.removeItem('cartItem_'+items[i]['id']+'_'+items[i]['vId']);
                    delete items;

                    _.each(_.keys(data.data.items), function(key) {
                        if (!data.data.items[key].kit)
                            localStorage.setItem(key, JSON.stringify(data.data.items[key]));
                        else
                        {
                            try {
                                var kit = Shop.Cart.load('cartItem_'+items[i]['id']+'_'+items[i]['vId']);
                                kit.count = data.data.items[key].count;
                                Shop.Cart.save('cartItem_'+kit['id']+'_'+kit['vId']);
                            }catch(err){}
                        }
                    });

                    $(document).trigger({
                        type:'cart_changed'
                    });
                }
                if ( data ==  false )
                    Shop.Cart.clear();
            });
        },

        updatePage:function () {

        }
    },
    cartItem:function (obj) {
        if (typeof obj == 'undefined' || obj == false)
            obj = {
                id:false,
                vId:false,
                name:false,
                count:false,
                kit:false,
                maxcount:0,
                number:'',
                vname:false,
                url:false
            };

        return prototype = {
            id:obj.id ? obj.id : 0,
            vId:obj.vId ? obj.vId : 0,
            price:obj.price ? obj.price : 0,
            name:obj.name ? obj.name : '',
            count:obj.count ? obj.count : 1,
            kit:obj.kit ? obj.kit : false,
            prices:obj.prices ? obj.prices : 0,
            kitId:obj.kitId ? obj.kitId : 0,
            maxcount:obj.maxcount ? obj.maxcount : 0,
            number:obj.number ? obj.number : 0,
            vname:obj.vname ? obj.vname : '',
            url:obj.url ? obj.url : '',
            img:obj.img ? obj.img : '',
            storageId:function () {
                return 'cartItem_' + this.id + '_' + this.vId;
            }
        };
    },

    composeCartItem:function ($context) {
        var cartItem = new Shop.cartItem();

        cartItem.id = $context.data('prodid');
        cartItem.vId = $context.data('varid');
        cartItem.price = parseFloat($context.data('price')).toFixed(pricePrecision);
        cartItem.name = $context.data('name');
        cartItem.kit = $context.data('kit');
        cartItem.prices = $context.data('prices');
        cartItem.kitId = $context.data('kitid');
        cartItem.maxcount = $context.data('maxcount');
        cartItem.number = $context.data('number');
        cartItem.vname = $context.data('vname');
        cartItem.url = $context.data('url'); 
        cartItem.img = $context.data('img');
        return cartItem;
    },

    //settings manager
    Settings:{
        get:function (key) {
            return localStorage.getItem(key);
        },
        set:function (key, value) {
            localStorage.setItem(key, value);
            return this;
        }
    },

    WishList:{
        items:[],
        all:function () {
            return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [];
        },
        add:function (key, vid, price, curentEl) {
            Shop.WishList.items = this.all();
            localStorage.setItem('wishList_'+key+'_'+vid, JSON.stringify({
                id: key, 
                vid: vid, 
                price: price
            }));
            if (this.items.indexOf(key) == -1) {
                $.post('/shop/wish_list_api/add', {
                    productId_:key,
                    variantId_:vid
                }, function (data) {
                    try {
                        var dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.WishList.items.push(key);
                            //localStorage.setItem('wishList', JSON.stringify(Shop.WishList.items));
                            var arr = JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [];
                            arr.push(key+'_'+vid)
                            localStorage.setItem('wishList', JSON.stringify(arr));
                            
                            if (Shop.WishList.items.length != dataObj.count) {
                                Shop.WishList.sync();
                                return;
                            }
                            $(document).trigger({
                                type:'wish_list_add',
                                dataObj:dataObj
                            });
                        }
                        else {
                            if (dataObj.errors.match('not_logged_in')) {
                                $(loginButton).click();
                            }
                        }
                    } catch (e) {}
                });
            }
        },

        rm:function (key, el, vid, price) {
            this.items = this.all();
            
            $.get('/shop/wish_list_api/delete/' + key + '_' + vid, function (data) {
                try {
                    dataObj = JSON.parse(data);
                    dataObj.id = key;

                    if (dataObj.success == true) {
                        Shop.WishList.items = _.without(Shop.WishList.items, key + '_' + vid);
                        localStorage.setItem('wishList', JSON.stringify(Shop.WishList.items));

                        $(document).trigger({
                            type:'wish_list_rm',
                            dataObj:dataObj
                        });

                    }
                } catch (e) {}
            });
            deleteWishListItem($(el),key, vid, price);
        },
        sync: function(){
            $.getJSON('/shop/wish_list_api/sync', function(data){
                if (typeof(data) == 'Array' || typeof(data) == 'object') {
                    localStorage.setItem('wishList', JSON.stringify(data));
                }
                if (data === false) {
                    localStorage.setItem('wishList', []);
                }

                $(document).trigger({
                    type:'wish_list_sync'
                });
            });
        }
    },

    CompareList:{
        items:[],
        all:function () {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add:function (key) {
            this.items = this.all();
            if (this.items.indexOf(key) === -1) {
                $.get('/shop/compare_api/add/' + key, function (data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;

                        if (dataObj.success == true) {
                            Shop.CompareList.items.push(key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));

                            $(document).trigger({
                                type:'compare_list_add',
                                dataObj:dataObj
                            });

                        }
                    } catch (e) {}
                });
            }
        },

        rm:function (key, el) {
            this.items = JSON.parse(localStorage.getItem('compareList')) ? JSON.parse(localStorage.getItem('compareList')) : [];

            if (this.items.indexOf(key) !== -1) {

                this.items = _.without(this.items, key);
                this.items = this.all();

                $.get('/shop/compare_api/remove/' + key, function (data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;

                        if (dataObj.success == true) {
                            Shop.CompareList.items = _.without(Shop.CompareList.items, key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));

                            $(document).trigger({
                                type:'compare_list_rm',
                                dataObj:dataObj
                            });
                        }
                    } catch (e) {}
                });
            }
            deleteComprasionItem($(el));
        },
        sync: function(){
            $.getJSON('/shop/compare_api/sync', function(data){
                if (typeof(data) == 'object' || typeof(data) == 'Array') {
                    localStorage.setItem('compareList', JSON.parse(data));

                    $(document).trigger({
                        type:'compare_list_sync'
                    });
                }
                else
                if(data === false) {
                    localStorage.removeItem('compareList');

                    $(document).trigger({
                        type:'compare_list_sync'
                    });
                }
            });
        }
    }
};
    /*      ========        Document Ready          ==========      */