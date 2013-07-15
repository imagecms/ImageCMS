var isTouch = 'ontouchstart' in document.documentElement,
wnd = $(window),
body = $('body'),
mainBody = $('.main-body');

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
(function($){
    var methods = {
        init : function(options) {
            if ($.exists_nabir($(this))){
                var settings = $.extend({
                    item : 'ul > li',
                    duration: 300,
                    searchPath: "/shop/search/ac",
                    inputString: $('#inputString')
                }, options);
                
                $thisS = $(this);
                itemA = settings.item;
                durationA = settings.duration;
                searchPath = settings.searchPath;
                selectorPosition = -1;
                inputString = settings.inputString.keyup(function(event){
                    if (event.keyCode != 27) methods.lookup(event);
                }).blur(function(){
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
            }
        },
        lookup: function(event){
            try{
                var code = event.keyCode;

                if(code == 38 || code == 40)
                {
                    if(code == 38)
                    {
                        selectorPosition -= 1;
                    }
                    if(code == 40)
                    {
                        selectorPosition += 1;
                    }

                    if(selectorPosition < 0)
                    {
                        selectorPosition = itemserch.length-1;
                    }
                    if(selectorPosition > itemserch.length-1)
                    {
                        selectorPosition = 0;
                    }

                    itemserch.each(function(i, el) {
                        $(el).removeClass('selected');
                        if(i == selectorPosition)
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
                        if($(el).hasClass('selected'))
                        {
                            window.location = $(el).attr('href');
                            window.location = $(el).find('a').attr('href');
                        }
                    });
                }
            }
            catch(err){}
                
            if(inputString.val().length == 0)
            {
                $thisS.fadeOut(durationA);
            }
            else
            {
                $.post(searchPath, {
                    queryString: inputString.val()
                }, function(data) {
                    $thisS.fadeIn(durationA);
                    try {
                        var dataObj = JSON.parse(data);
                        var html = _.template($('#searchResultsTemplate').html(), {
                            'items' : dataObj
                        });
                    } catch (e){
                        var html = e.toString();
                            
                    }
                    $thisS.html(html);
                    selectorPosition = -1;

                    itemserch = $thisS.find(itemA);
                    itemserch.each(function(i, el) {
                        $(el).mouseover(function(){
                            itemserch.removeClass('selected');
                            $(this).addClass('selected');
                            selectorPosition = i;
                        });
                    });
                });
            }
        }
    }
    $.fn.autocomlete = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.autocomlete');
        }
    };
})(jQuery);
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
(function($){
    var methods = {
        init : function(options) {
            if ($.exists_nabir($(this))) {
                var settings = $.extend({
                    title : this.attr('data-title'),
                    otherClass: false,
                    effect: 'notalways'
                }, options);
                
                $.ajaxSetup({
                    success: function(){
                        $('.tooltip').remove();
                    }
                })
                var $this = $(this),
                text_el = $this.find('.text-el');
            
                if (!text_el.is(':visible') && $.exists_nabir(text_el)){
                    if (settings.effect == 'notalways') {
                        $('.tooltip').remove();
                        body.append('<span class="tooltip">'+settings.title+'</span>');
                    }
            
                    var tooltip = $('.tooltip').not('.cloned');
            
                    if (settings.effect == 'always') {
                        if (!$.exists_nabir(tooltip)) {
                            body.append('<span class="tooltip">'+settings.title+'</span>');
                        }
                        else tooltip.text(settings.title)
                    }

                    if (settings.otherClass !== false) tooltip.addClass(settings.otherClass);
                    if (settings.effect == 'notalways') tooltip.hide();
                
                    tooltip.css({
                        'left': Math.ceil(this.offset().left-(tooltip.actual('outerWidth')-this.outerWidth())/2),
                        'top': this.offset().top-tooltip.actual('outerHeight')
                    }).fadeIn(300);
                
                    this.blur(function(){
                        $('.tooltip').fadeOut(300, function(){
                            $(this).remove()
                        });
                    })
                    body.live('click', function(event) {
                        event.stopPropagation();
                        $('.tooltip').fadeOut(300, function(){
                            $(this).remove()
                        });
                    })
                }
            }
        },
        remove : function( ) {
            $('.tooltip').fadeOut(300, function(){
                $(this).remove()
            });
        }
    };
    $.fn.tooltip = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
        }
    };
    $('[data-rel="tooltip"]').live('mouseenter', function(){
        $(this).tooltip();
    }).live('mouseleave', function(){
        $(this).tooltip('remove');
    })
})(jQuery);
/*plugin menuImageCms for main menu shop*/
(function($) {
    var methods = {
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
                    dropWidth: null
                }, options);
            
                var menuW = menu.width(),
                menuItem = settings.item,
                drop = settings.drop,
                effOn = settings.effectOn,
                effOff = settings.effectOff,
                drop = settings.drop,
                countColumn = settings.countColumn,
                item_menu_l = menuItem.length,
                dropW = settings.dropWidth,
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
                    if (menuW - $thisL < dropW) {
                        if (drop.children().length >= countColumn)
                            drop.css('right', 0).addClass('right-drop');
                        else
                            drop.css('right', menuW - $thisW - $thisL).addClass('right-drop');
                    }
                    else {
                        if (drop.children().length >= countColumn)
                            drop.css('left', 0);
                        else
                            drop.css('left', $thisL)
                    }
                }).css('height', sH);
                menuItem.find('.helper:first').css('height', sH)

                $('.not-js').removeClass('not-js');
                var hover_t_o = '';
                menuItem.hover(
                    function() {
                        var $this = $(this),
                        $thisDrop = $this.find(settings.drop);
                        if ($this.index() == 0)
                            $this.addClass('first_h');
                        if ($this.index() == item_menu_l - 1)
                            $this.addClass('last_h');
                        hover_t_o = setTimeout(function() {
                            $thisDrop[effOn](durationOn);
                            if ($thisDrop.length != 0)
                                menu.addClass('hover');
                        }, time_dur_m);
                    }, function() {
                        var $this = $(this),
                        $thisDrop = $this.find(settings.drop);
                        $(settings.drop).stop()[effOff](durationOff);
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

                return this.each(function(index) {
                    var $thiss = $(this),
                    effectOn = settings.effectOn,
                    effectOff = settings.effectOff,
                    durationOn = settings.durationOn,
                    durationOff = settings.durationOff;
                
                    condRadio = $thiss.data('type') != 'radio';
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
                    refs[index].on('click', function(event) {
                        var $this = $(this);
                        settings.before();
                        event.preventDefault();

                        if (!$this.parent().hasClass('active') && !$this.parent().hasClass('disabled')) {

                            wST = wnd.scrollTop();
                            $thisA = $this[attrOrdata[index]]('href');
                            if ($this.data('drop') == undefined) {
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
                                    else if ($this.data('drop') == undefined && k) {
                                        window.location.hash = hashs[0].join('');
                                        k = false;
                                    }
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
                        ;
                        if (event.which || event.button == 0) {
                            settings.after($thiss);
                        }
                    });

                    if (this_l - 1 == index) {
                        methods.location();
                        methods.startCheck();
                    }

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
                });
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
                var $thisId = $(this).attr('id');
                $('[data-href="#' + $thisId + '"]').trigger('click');
            });
            $(hashs[0].join(',')).each(function(index) {
                var $thisId = $(this).attr('id'),
                attrOrdataNew = '';

                $('[href="#' + $thisId + '"]').length == 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                $('[' + attrOrdataNew + '="#' + $thisId + '"]').trigger('click');
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
            if ($.exists_nabir($(this))){
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
                                $(this).addClass('oddC');
                            else
                                $(this).addClass('evenC')
                        });
                        right.each(function() {
                            $(this).find(elEven).each(function(ind) {
                                if (ind % 2 == 0)
                                    $(this).addClass('oddC');
                                else
                                    $(this).addClass('evenC')
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
            }
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
            console.log(1)
            li_i_h = [];
            genObj = $([]);
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
                    genObj = genObj.add(left.eq(j)).add(tempNabir);
                li_i_h = [];
                k = 0;
                tempText = '';
            }

            right.each(function() {
                $(this).find(elEven).not(genObj).removeClass('evenC').removeClass('oddC').each(function(ind) {
                    if (ind % 2 == 0)
                        $(this).addClass('oddC');
                    else
                        $(this).addClass('evenC')
                });
            });
            left.not(genObj).removeClass('evenC').removeClass('oddC').each(function(ind) {
                if (ind % 2 == 0)
                    $(this).addClass('oddC');
                else
                    $(this).addClass('evenC')
            });
            genObj.hide();
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
        if ($.exists_nabir($(this))){
            $('.cloned').remove();
            if (arguments.length && typeof arguments[0] == 'string') {
                var dim = arguments[0];
                var clone = $(this).clone().css({
                    position: 'absolute',
                    top: '-9999px',
                    display: 'block'
                }).addClass('cloned').appendTo('body');
                return clone[dim]();
            }
            ;
            return undefined;
        }
    };
}(jQuery));
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))){
                settings = $.extend({
                    cloned: '.cloned',
                    activeClass: 'active',
                    exit: '[data-closed = "closed-js"]',
                    effon: 'show',
                    effoff: 'hide',
                    effdur: 500,
                    before: function() {
                        return true;
                    },
                    after: function() {
                        return true;
                    }
                }, options);

                var $thisD = this,
                selector = $thisD.selector,
                dataSource = $('[data-drop]'),
                cloned = settings.cloned,
                exit = $(settings.exit),
                effon = settings.effon,
                effoff = settings.effoff,
                effdur = settings.effdur,
                overlayColor = settings.overlayColor,
                overlayOpacity = settings.overlayOpacity;

                activeClass = settings.activeClass;

                dataSource.live('click', function(event) {
                    event.stopPropagation();
                    event.preventDefault();
                
                    $(this).each(function() {
                        var $this = $(this),
                        $thisS = $this.data('effect-off') || effoff,
                        $thisD = $this.data('duration') || effdur,
                        $thisSource = $this.data('drop');
                        $($thisSource).attr('data-effect-off', $thisS).attr('data-duration', $thisD).attr('data-elrun', $thisSource);
                    });
                    if ($(event.target).parents('[data-simple="yes"]').length == 0){

                        $this = $(this);
                        elSet = $this.data();
                        elSetSource = $(elSet.drop);
                
                        var elSetOn = elSet.effectOn || effon,
                        elSetOff = elSet.effectOff || effoff,
                        elSetDuration = elSet.duration || effdur,
                        overlayColor = elSet.overlaycolor || settings.overlayColor,
                        overlayOpacity = elSet.overlayopacity || settings.overlayOpacity;

                        if (overlayColor != undefined || overlayOpacity != undefined) {
                            if (!$.exists('.overlayDrop')) {
                                mainBody.append('<div class="overlayDrop" style="position:absolute;width:100%;height:100%;left:0;top:0;z-index: 1001;"></div>')
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
                            $this.removeClass(activeClass)
                            elSetSource[elSetOff](elSetDuration, function() {
                                elSetSource.removeClass(activeClass).removeAttr('style')
                                drop_over[elSetOff](elSetDuration);
                            });
                            $thisHref = $(this).attr('href');
                            if ($thisHref != undefined) {
                                var $thisHrefL = $thisHref.length,
                                wLH = location.hash,
                                wLHL = wLH.length;
                                try {
                                    indH = wLH.match($thisHref + '(?![a-z])').index;
                                    location.hash = wLH.substring(0, indH) + wLH.substring(indH + $thisHrefL, wLHL)
                                } catch (err) {
                                }
                            }
                        }
                        else {
                            $newthis = settings.before(this, elSetSource);
                            if ($newthis != undefined) $this = $newthis;

                            var wndW = wnd.width();
                            if (elSetSource.actual('width') > wnd.width()) elSetSource.css('width', wndW-40);
                            else elSetSource.removeAttr('style');
                    
                            methods.positionDrop($this, elSet, elSetSource);

                            $this.addClass(activeClass);
                            drop_over.show();
                            elSetSource[elSetOn](elSetDuration, function() {
                                elSetSource.addClass(activeClass);
                                if (ltie7)
                                    ieInput();
                            });
                            settings.after(this, elSetSource);
                        }
                        $(cloned).remove();
                    }
                })
                exit.click(function(){
                    methods.triggerBtnClick($(this).closest('[data-elrun]'));
                })
                body.live('click', function(event) {
                    event.stopPropagation();
                    if ($(event.target).parents().is(selector) || $(event.target).is(selector) || $(event.target).is(exit))
                        return;
                    else
                        methods.triggerBtnClick();

                }).live('keydown', function(e) {
                    var key, keyChar;
                    if (!e)
                        var e = window.event;

                    if (e.keyCode)
                        key = e.keyCode;
                    else if (e.which)
                        key = e.which;

                    if (key == 27) {
                        methods.triggerBtnClick();
                    }
                });
            }
        },
        triggerBtnClick: function(sel) {
            if (!sel) sel = '[data-elrun].' + activeClass
            $(sel).each(function() {
                $('[data-drop = "' + $(this).attr('data-elrun') + '"]').click().parent().removeClass('active');
            }).removeClass('active');
            wnd.unbind('scroll resize', methods.dropScroll)
        },
        dropScroll: function() {
            elSetSource.animate({
                'top': (wnd.height() - elSetSource.height()) / 2 + wnd.scrollTop(),
                'left': (wnd.width() - elSetSource.width()) / 2 + wnd.scrollLeft()
            }, {
                queue: false
            });
        },
        positionDrop: function($this){
            var $this = $this;
            if ($this == undefined) $this = $(this);
            
            var elSet = $this.data(),
            elSetSource = $(elSet.drop);
            
            var $thisP = $this.attr('data-place');
            dataSourceH = 0,
            dataSourceW = 0,
            $thisW = $this.width();
            $thisH = $this.height();
            
            if ($thisP == 'noinherit') {
                var $thisPMT = $this.attr('data-placement').toLowerCase().split(' ');

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
                wnd.unbind('scroll resize', methods.dropScroll).bind('scroll resize', methods.dropScroll);
                methods.dropScroll();
            }
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
            if ($.exists_nabir($(this))) {
                var settings = $.extend({
                    prev: '',
                    next: ''
                }, options);
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
                            input.val(1)
                        else
                            input.val(inputVal + 1)
                        if (input.val() > 1)
                            $thisPrev.removeAttr('disabled');
                        else
                            $thisPrev.attr('disabled', 'disabled');

                        if (checkProdStock)
                            if (input.maxValue()) $thisNext.attr('disabled', 'disabled');
                    })
                    $thisPrev.click(function() {
                        var input = $this.focus();
                        var inputVal = parseInt(input.val());

                        $thisNext.removeAttr('disabled', 'disabled');
                        if (isNaN(inputVal))
                            input.val(1)
                        else if (inputVal > 1)
                            input.val(inputVal - 1)

                        if (input.val() == 1)
                            $thisPrev.attr('disabled', 'disabled');
                        else
                            $thisPrev.removeAttr('disabled');
                    })
                    $this.die('keyup').live('keyup', function(){
                        if (checkProdStock)
                            $(this).maxValue();
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
            $.error('Method ' + method + ' does not exist on jQuery.plusminus');
        }
    };
})(jQuery);
(function($) {
    var methods = {
        init: function(options) {
            if ($.exists_nabir($(this))){
                var $this = $(this);
                var $min = $(this).attr('data-min');
                var $max = parseInt( $(this).attr('data-max'));

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
                else if ($thisVal < $min)
                    $this.val($min);
            
                if (typeof $max == 'integer' && $max != 0)  
                    if ($thisVal > $max)
                        $thisVal = $max;
            }
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
            if ($.exists_nabir($(this))){
                var $this = $(this),
                $max = parseInt( $(this).attr('data-max'));

                $thisVal = $this.val();

                if ($thisVal >  $max) {
                    $this.val($max);
                    return true;
                }
                else return false;
            }
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

(function($){
    var methods = {
        init : function(options) {
            if ($.exists_nabir($(this))){
                var settings = $.extend({
                    width:0,
                    afterClick: function(){
                        return true;
                    }
                }, options);
                var width = settings.width;
                this.each(function(){
                    var $this = $(this);
                    if (!$this.hasClass('disabled')){
                        $this.hover (
                            function(){
                                $(this).append("<span></span>");
                            },
                            function()
                            {
                                $(this).find("span").remove();
                            });

                        var rating;

                        $this.mousemove (
                            function(e){
                                if (!e) e = window.event;
                                if (e.pageX){
                                    x = e.pageX;
                                } else if (e.clientX){
                                    x = e.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft) - document.documentElement.clientLeft;
	     
                                }
                                var posLeft = 0;
                                var obj = this;
                                while (obj.offsetParent)
                                {
                                    posLeft += obj.offsetLeft;
                                    obj = obj.offsetParent;
                                }
                                var offsetX = x-posLeft,
                                modOffsetX = 5*offsetX%this.offsetWidth;
                                rating = parseInt(5*offsetX/this.offsetWidth);

                                if(modOffsetX > 0) rating+=1;
		
                                jQuery(this).find("span").eq(0).css("width",rating*width+"px");

                            });

                        $this.click (function(){
                            settings.afterClick($this, rating);
                            return false;
                        });
                    }
                })
            }
        }
    }
    $.fn.starRating = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.starRating' );
        }
    }
})(jQuery);

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
                    $item = $this.find(item),
                    $item_l = $item.length,
                    $item_w = $item.outerWidth(true),
                    $this_prev = $this.find(prev),
                    $this_next = $this.find(next),
                    $marginR = $item_w - $item.outerWidth(),
                    cont_width = $this.find(content).width(),
                    group_button = $this.find(groupButtons);

                    settings.before($this);
                    
                    var $count_visible = (cont_width / ($item_w)).toFixed(1);
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

                        $this_next.add($this_prev).show();
                        $this.append(group_button.append($this_next.add($this_prev)));
                    }
                    else {
                        $this_next.add($this_prev).css('display', 'none');
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