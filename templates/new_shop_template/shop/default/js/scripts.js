var isTouch = 'ontouchstart' in document.documentElement,
wnd = $(window);

function navPortait(){
    var frameM = $('.frame-menu-main');
    $('.nav').each(function(){
        var $this= $(this);
        if ($this.hasClass('navHorizontal')){
            var headerFon = $('.headerFon'),
            heightFon = 0,
            temp_height = $this.find('> li > *').height();
                
            if ($this.hasClass('navVertical')) $this.removeClass('navVertical');
            if (temp_height < $this.height()) $this.addClass('navVertical');
                
            if ($.exists_nabir(frameM) && !frameM.children().hasClass('vertical')){
                heightFon = frameM.offset().top+frameM.outerHeight(true)
                if ($.exists('.frame_baner')) heightFon = $('.frame_baner').height()/2+$('.frame_baner').offset().top;
                headerFon.css({
                    'height': heightFon,
                    'top':0
                });
            }
            else headerFon.css({
                'height': $('.headerContent').outerHeight(true)+$('header').height(),
                'top':0
            });
        }
    });
}

jQuery(document).ready(function(){
    jQuery.exists = function(selector) {
        return ($(selector).length > 0);
    }
    jQuery.exists_nabir = function(nabir){
        return (nabir.length > 0);
    }
    var	ie = jQuery.browser.msie,
    ieV = jQuery.browser.version,
    ltie7 = ie&&(ieV <= 7),
    ltie8 = ie&&(ieV <= 8);
    
    $('.formCost input[type="text"], .number input').live('keypress', function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        if (event.keyCode) key = event.keyCode;
        else if(event.which) key = event.which;

        if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
        keyChar=String.fromCharCode(key);

        if(!/\d/.test(keyChar))	{
            $(this).tooltip();
            return false;
        }
        else $(this).tooltip('remove');
    });
    if (ltie7){
        function ieInput(els){
            els = $('input[type="text"], textarea, input[type="password"]');
            
            els.not(':hidden').not('.visited').not('.notvis').each(function(){
                $this = $(this);
                $this.css({
                    'width': function(){
                        return 2*$this.width()-$this.outerWidth();
                    },
                    'height': function(){
                        return 2*$this.height()-$this.outerHeight();
                    }
                }).addClass('visited');
            });
        };
        ieInput()
    }
    
    var optionsMenu = {
        item: $('.menu-main td > .frame-item-menu > div'),
        duration: 200,
        drop: 'ul',
        itemSub: '.frame-item-menu > ul > li',
        frameSub: '.frame-item-menu > ul > li > div',
        effecton: 'fadeIn',
        effectoff: 'fadeOut'
    };
    var optionCompare = {
        left : '.leftDescription > li',
        right : '.comprasion_tovars_frame > li',
        rightel : 'li',
        frameScroll: '.comprasion_tovars_frame',
        mouseWhell: false,
        scrollNSP: true,
        scrollNSPT: '.items_catalog'
    };
    
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({
                    title : this.attr('data-title')
                }, options);
                
                $.ajaxSetup({
                    success: function(){
                        $('.tooltip').remove();
                    }
                })
                
                $('.tooltip').fadeOut(3000).delay(300).remove();
                $('body').append('<span class="tooltip" style="top:'+(this.offset().top-this.height()-3)+'px;">'+settings.title+'</span>');
                tooltip = $('.tooltip');
                var width_tooltip = tooltip.show().width()+5;
                tooltip.hide();
                tooltip.css('left', Math.ceil(this.offset().left-(width_tooltip-this.width())/2)).fadeIn(300);
                
                this.blur(function(){
                    $('.tooltip').fadeOut(3000).delay(300).remove();
                })
            },
            remove : function( ) {
                $('.tooltip').fadeOut(3000).delay(300).remove();
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
        $('[data-rel="tooltip"]').hover(function(){
            $(this).tooltip();
        },function(){
            $(this).tooltip('remove');
        })
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                if (options.menu == undefined)
                    var settings = $.extend({
                        item : this.find('li'),
                        duration: 300,
                        drop: 'li > ul',
                        itemSub:  this.find('li li'),
                        effecton: 'show',
                        effectoff: 'hide',
                        frameSub: 'li li div'
                    }, options);
                else
                    var settings = $.extend({}, options);
                
                var sH = 0,
                menu = "";
                                
                if (options.menu == undefined) menu = $(this)
                else menu = settings.menu;
                
                var menuW = menu.width(),
                menuItem = settings.item,
                vertical = false,
                menuItemSub = settings.itemSub,
                item_menu_l = menuItem.length,
                frameSub = $(settings.frameSub),
                dropW = 520;
                duration = time_dur_m = settings.duration;
                drop = menuItem.next(settings.drop);
                menuItemCltd = menuItem.closest('td');
                effecton = settings.effecton;
                effectoff = settings.effectoff;
                
                if (menu.hasClass('vertical')) vertical = true;
                
                menuItem.find('.helper:first').add(menuItemCltd).removeAttr('style');
                
                $thisOH = 0;
                menuItemCltd.each(function(index){
                    var $this = $(this),
                    $thisW = $this.width(),
                    $thisL = $this.position().left,
                    $drop = $this.find(drop).first(),
                    $thisH = $this.height();
                    if ($thisH > sH) {
                        sH = $thisH;
                    }
                    
                    if (!vertical){
                        if (menuW - $thisL < dropW) {
                            if ($thisL + $thisW > dropW) $drop.css('right', menuW-$thisW-$thisL).removeAttr('class').addClass('right-drop');
                            if ($thisW + $thisL < dropW) $drop.css({
                                'right': menuW-$thisW-$thisL, 
                                'left': 'auto'
                            }).removeAttr('class').addClass('top-drop');
                        }
                        else if (menuW - $thisL > dropW) {
                            $drop.css('left', $thisL).removeAttr('class');
                        }
                        if (dropW > wnd.width()) {
                            if ($thisL > (menuW-$thisW)/2) $drop.css({
                                'right': 0, 
                                'left': 'auto'
                            }).removeAttr('class').addClass('top-drop');
                            else
                                $drop.css({
                                    'right': 'auto', 
                                    'left': 0
                                }).removeAttr('class').addClass('top-drop');
                        }
                    }
                    else{
                        $drop.css({
                            'top': $thisOH,
                            'left': '100%'
                        }).removeAttr('class');
                        if (dropW+menuW > wnd.width()) $drop.css({
                            'left': 0
                        }).removeAttr('class');
                        if (dropW > wnd.width()) $drop.removeAttr('style').addClass('top-drop');
                    }
                    $thisOH += $this.outerHeight(true)+2;
                }).css('height', sH);
                
                menuItem.find('.helper:first').css('height', sH-4)
                
                $('.not-js').removeClass('not-js');
                
                evDrop = '';
                isTouch ? evDrop = 'toggle' : evDrop = 'mouseenter mouseleave';
                
                function itemSubEv(el, event){
                    var $this = el,
                    cond = $.exists_nabir($this.next('div'))
                    if (cond) {
                        event.preventDefault();
                        $thisP = $this.parent();
                        $thisC = $this.next('div');
                        $thisP.addClass('hover');
                        $thisC[effecton](duration);
                        $thisP.siblings().removeClass('hover').children('div').stop()[effectoff](duration)
                        $thisP.parent().addClass('hover');
                    }
                    else {
                        $this.parent().siblings().removeClass('hover').children('div').stop()[effectoff](duration)
                    }
                    if (isTouch && !cond) window.location.href = el.attr('href');
                }
                
                if (!isTouch) evDrop2 = 'hover';
                else evDrop2 = evDrop;
                var evDropF = evDrop.split(' ')[0];
                var evDropS = evDrop.split(' ')[1];
                
                $(menuItemSub + '> a').unbind(evDrop2)[evDrop2](function(event){
                    itemSubEv($(this), event);
                },function(event){
                    itemSubEv($(this), event);
                });
                function unhov(el){
                    var $this = el,
                    $thisDrop = $this.next();
                    $('.first_h, .last_h').removeAttr('class');
                    frameSub.add(drop.not($thisDrop)).stop()[effectoff](duration);
                    if ($thisDrop.length != 0) menu.removeClass('hover');
                }
                hover_t_o = '';
                function hov(el){
                    var $this = el,
                    $thisDrop = $this.next();
                    
                    menuItemCltd.removeClass('hover');
                    frameSub.add(drop.not($thisDrop)).stop()[effectoff](duration);
                    
                    $this = $this.closest('td').addClass('hover');
                    
                    if ($this.index() == 0) $this.addClass('first_h');
                    if ($this.index() == item_menu_l - 1) $this.addClass('last_h');
                    
                    hover_t_o = setTimeout(function(){
                        $thisDrop[effecton](duration);
                        if ($thisDrop.length != 0) menu.addClass('hover');
                    }, time_dur_m);
                    
                    if (!isTouch){
                        $thisDrop.hover(function(){
                            $(this)[effecton](duration);
                        },function(event){
                            clearTimeout(hover_t_o);
                            menu.find('.hover').removeClass('hover');
                            frameSub.hide();
                        })
                    }
                }
                if (isTouch) {
                    menuItem.unbind(evDrop)[evDrop](
                        function(){
                            hov($(this));
                        },function(){
                            unhov($(this));
                        });
                    menu[evDrop](
                        function(event){
                            time_dur_m = 0;
                        },
                        function(event){
                            time_dur_m = duration;
                        });
                }
                else{
                    menuItem.unbind(evDropF)[evDropF](
                        function(){
                        hov($(this));
                        }).unbind(evDropS)[evDropS](function(){
                        clearTimeout(hover_t_o);
                    })
                    
                    menu.unbind(evDropF)[evDropF](
                        function(event){
                        time_dur_m = 0;
                        }).unbind(evDropS)[evDropS](
                        function(event){
                            methods.fadeDrop();
                        });
                }
                drop.find('li li a').click(function(event){
                    event.stopPropagation();
                })
                $('body').click(function(){
                    methods.fadeDrop();
                })
            },
            refresh:function(){
                $(drop).removeClass('right-drop').removeAttr('style');
                methods.init($.extend({
                    menu: $('.menu-main')
                }, optionsMenu));
            },
            fadeDrop:function(){
                time_dur_m = duration;
                drop.hide();
                menuItemCltd.removeClass('hover')
                $('.first_h, .last_h').removeAttr('class');
            }            
        };
        $.fn.menuPacket2 = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
            }
        };
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                if ($.exists_nabir(this)){
                    var settings = $.extend({}, options);
                    
                    var rel = $(this),
                    body = $(' body'),
                    minCost = settings.minCost,
                    maxCost = settings.maxCost;
                    
                    if (options.minCost == undefined || options.maxCost == undefined) {
                        minCost = $('<input type="text"/>', {
                            value: cur_min
                        }).insertAfter(body).hide();
                        maxCost = $('<input type="text"/>', {
                            value: cur_max
                        }).insertAfter(body).hide();
                    }
                    
                    rel.slider({
                        min: def_min,
                        max: def_max,
                        values: [cur_min,cur_max],
                        range: true,
                        slide: function(event, ui){
                            minCost.val(ui.values[0]);
                            maxCost.val(ui.values[1]);
                        }
                    });
                    minCost.change(function(){
                        var value1=minCost.val();
                        var value2=maxCost.val();
                        if(parseInt(value1) > parseInt(value2)){
                            value1 = value2;
                            maxCost.val(value1);
                        }
                        rel.slider("values",0,value1);
                    }); 
                    maxCost.change(function(){
                        var value1=minCost.val();
                        var value2=maxCost.val();
                        
                        if (value2 > def_max) {
                            value2 = def_max;
                            maxCost.val(def_max)
                        }
                        
                        if(parseInt(value1) > parseInt(value2)){
                            value2 = value1;
                            maxCost.val(value2);
                        }
                        rel.slider("values",1,value2);
                    });
                }
            }
        }
        $.fn.sliderInit = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.sliderInit' );
            }
        };
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({
                    before: function(){
                        return true;
                    },
                    after: function(){
                        return true;
                    }
                }, options);
                $this = this;
                var tabs_div = [],
                nav_tabs_li = [],
                reg_refs = [];
                refs = [];
                attrOrdata = [];
                this_l = this.length;
                k=true;

                return this.each(function(index){
                    var $this = $(this);
                    nav_tabs_li[index] = $this.children();
                    refs[index] = nav_tabs_li[index].children();
                    attrOrdata[index] = refs[index].attr('href') != undefined ? 'attr' : 'data';
                    
                    temp_obj = $([]);
                    
                    refs[index].each(function(ind){
                        var this_href = $(this)[attrOrdata[index]]('href');
                        if (ind == 0) {
                            reg_refs[index] = "";
                            temp_obj = temp_obj.add($(this_href));
                            reg_refs[index] += this_href;
                        }
                        else {
                            temp_obj = temp_obj.add($(this_href));
                            reg_refs[index] += '|'+this_href;
                        }
                    })
                    tabs_div[index] = temp_obj;
                    reg_refs[index] = new RegExp(reg_refs[index]);
                    
                    refs[index].on('click', function(event) {
                        var $this = $(this);
                        settings.before();
                        event.preventDefault();
                        
                        if (!$this.parent().hasClass('active')){
   
                            wST = wnd.scrollTop();
                            $thisA = $this[attrOrdata[index]]('href');
                            if ($this.data('drop') == undefined){
                                nav_tabs_li[index].removeClass('active');
                                $this.parent().addClass('active');
                                tabs_div[index].hide().removeClass('active');
                                $($thisA).show().addClass('active');
                            }
                            if (attrOrdata[index] != 'data'){
                                if (event.which || event.button == 0) {
                                    var wLH = window.location.hash;
                                    temp = wLH;
                                    try{
                                        if (wLH.indexOf($thisA) == -1){
                                            temp = temp.replace(wLH.match(reg_refs[index])[0], $thisA)
                                        }
                                        if (wLH.charAt(wLH.indexOf($thisA)) != ''){
                                            temp += $thisA;
                                        }
                                        window.location.hash = temp;
                                    }catch(e){
                                        window.location.hash += $thisA;
                                    }
                                }
                                else if ($this.data('drop') == undefined && k) {
                                    window.location.hash = hashs[0].join('');
                                    k=false;
                                }
                            }
                        }
                        if (event.which || event.button == 0) {
                            settings.after();
                        }
                    });

                    if (this_l-1 == index) {
                        methods.location();
                        methods.startCheck();
                    }
                    
                    wnd.bind('hashchange', function(event){
                        methods.location();
                        methods.startCheck();
                        function scroll_top(wST){
                            wnd.scrollTop(wST);
                        }
                        
                        //chrome bug
                        if ($.browser.webkit) scroll_top(wST-100);
                        
                        scroll_top(wST);
                    })
                });
            },
            location: function(){
                hashs = [];
                hashs2 = [];
                
                if (location.hash == '')
                {
                    var i = 0,
                    j=0;
                    $(refs).each(function(index){
                        var index = index;
                        $this = refs[index].first(),
                        attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';
                        
                        if ($this.data('drop')==undefined && attrOrdataL != 'data'){
                            hashs[i] = $this[attrOrdataL]('href');
                            i++;
                        }
                        else if (attrOrdataL == 'data'){
                            hashs2[j] = $this[attrOrdataL]('href');
                            j++;
                        }
                    })
                    return hashs = [hashs, hashs2];
                }
                else {
                    $(refs).each(function(index){
                        var index = index,
                        j=0;
                        
                        $this = refs[index].first(),
                        attrOrdataL = $this.attr('href') != undefined ? 'attr' : 'data';
                        
                        if (attrOrdataL == 'data'){
                            hashs2[j] = $this[attrOrdataL]('href');
                            j++;
                        }
                    });
                    var t=location.hash,
                    s='#',
                    m=s.length,
                    res=0,
                    i=0;
                    pos=[];
                        
                    while (i < t.length-1)
                    {
                        var ch=t.substr(i,m)
                        if (ch==s){
                            res+=1;
                            i=i+m
                            pos[res-1] = t.indexOf(s, i-m)
                        }
                        else
                            i++
                    }
                    var i=0;
                    while (i < pos.length){
                        hashs[i] = t.substring(pos[i], pos[i+1]);
                        i++;
                    }
                    return hashs = [hashs, hashs2];
                }    
            },
            startCheck:function(){
                $(hashs[0].join(',')).each(function(index){
                    var $thisId = $(this).attr('id'),
                    attrOrdataNew = '';
                    
                    $('[href="#'+$thisId+'"]').length == 0 ? attrOrdataNew = 'data-href' : attrOrdataNew = 'href';
                    $('['+attrOrdataNew+'="#'+$thisId+'"]').trigger('click');
                });
                $(hashs[1].join(',')).each(function(index){
                    var $thisId = $(this).attr('id');
                    $('[data-href="#'+$thisId+'"]').trigger('click');
                });
            }
        };
        $.fn.tabs = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.tabs' );
            }
        }
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({}, options),
                mouseWhell = settings.mouseWhell,
                rightel = settings.rightel;
                
                this.each(function(index) {
                    var $this = $(this);
                    if ($this.is(':visible') && !$this.is('[data-equalHorizCell]')){
                        var h=0,
                        li_i_h = [],
                        frameScroll = $this.find(settings.frameScroll),
                        frame_scrollC = frameScroll.children(),
                        frame_scrollCL = frame_scrollC.length,
                        scrollNSP = settings.scrollNSP;
                        scrollNSPT = settings.scrollNSPT;
                        
                        left = $this.find(settings.left);
                        
                        var right = $this.find(settings.right),
                        li_i_length = left.length;
                        
                        for (var j = 0; j < li_i_length; j++){
                            nab = $([]);
                            right.each(function(){
                                nab = nab.add($(this).find(rightel).eq(j))
                            })
                            var tempNabir = left.eq(j).add(nab);
                            tempNabir.each(function(index){
                                var this_ch = $(this);
                                li_i_h[index] = this_ch.outerHeight();
                                li_i_h[index] > h ? h = li_i_h[index] : h = h;
                            });
                        
                            tempNabir.add(tempNabir.find('.helper')).css('height',h).attr('data-equalHorizCell','');
                        
                            li_i_h = [];
                            h=0;
                        }
                        var w = 0;
                        frameScroll.children().each(function(){
                            w += $(this).outerWidth(true);
                        })
                        frameScroll.css('width', w);
                        frameScrollP = frameScroll.parent();
                        frameScrollPW = frameScrollP.width();
                        var scrollW = w - frameScroll.parent().width();
                        
                        if (scrollNSP) {
                            scrollNSPT = $this.find(scrollNSPT);
                            topScrollNSP = scrollNSPT.position().top + scrollNSPT.height();
                            if (!$.exists_nabir($this.children('.scrollNSP'))) $this.append('<div class="scrollNSP" style = "overflow:auto;"><div style="width:'+w+'px;"></div></div>')
                        }
                        var firstScrl = frameScroll.parent(),
                        secScrl = $([]);
                        if (scrollNSP){
                            secScrl = $this.children('.scrollNSP');
                            secScrl.css({
                                'width':frameScrollPW, 
                                'top': topScrollNSP
                            })
                        }
                        
                        if (mouseWhell){
                            firstScrl.add(secScrl).bind('mousewheel', function(event, delta, deltaX, deltaY) {
                                $thisSL = $(this).scrollLeft();
                                if ($thisSL != scrollW && deltaY < 0){
                                    firstScrl.add(secScrl).scrollLeft($thisSL+w/frame_scrollCL);
                                    return false;
                                }
                                if ($thisSL > 0 && deltaY > 0){
                                    firstScrl.add(secScrl).scrollLeft($thisSL-w/frame_scrollCL);
                                    return false;
                                }
                            });
                        }
                        secScrl.bind('scroll', function() {
                            $thisSL = $(this).scrollLeft();
                            firstScrl.add(secScrl).scrollLeft($thisSL);
                        });
                        $this.attr('data-equalHorizCell','');
                    }
                    methods.headComprasion();
                })
            },
            refresh : function() {
                $('[data-equalHorizCell]').removeAttr('data-equalHorizCell').filter(':not([data-refresh])').removeAttr('style');
                $(this).equalHorizCell(optionCompare)
            },
            headComprasion: function(){
                compHead = $('.comprasion_head');
                if (compHead.attr('data-equalHorizCell') != undefined && compHead.height()>left.first().height()-70)
                    compHead.find('.tabs').css('height', left.first().height()-70);
                else
                    compHead.find('.tabs').css('height', left.first().height()-70).attr('data-equalHorizCell');
            }
        };
        $.fn.equalHorizCell = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
            }
        };
    })(jQuery);
    (function ($) {
        $.fn.actual = function () {
            $('.cloned').remove();
            if (arguments.length && typeof arguments[0] == 'string') {
                var dim = arguments[0];
                if (this.is('.active')) return this[dim]();
                var clone = $(this).clone().css({
                    position: 'absolute',
                    top: '-9999px',
                    display: 'block'
                }).addClass('cloned').appendTo('body');
                return clone[dim]();
            };
            return undefined;
        };
    }(jQuery));
    (function($){
        var methods = {
            init : function(options) {
                var body = $('body'),
                mainBody = $('.mainBody'),
                settings = $.extend({
                    cloned:  '.cloned',
                    activeClass: 'active',
                    exit: '[data-closed = "closed-js"]',
                    effon: 'show',
                    effoff: 'hide',
                    effdur: 500,
                    before: function(){
                        return true;
                    },
                    after: function(){
                        return true;
                    }
                }, options);
                
                var $thisD = this,
                selector = $thisD.selector,
                dataSource = $('[data-drop]'),
                cloned = settings.cloned,
                exit = settings.exit,
                effon = settings.effon,
                effoff = settings.effoff,
                effdur = settings.effdur,
                overlayColor = settings.overlayColor,
                overlayOpacity = settings.overlayOpacity;
                
                activeClass = settings.activeClass;

                dataSource.live('click', function(event){
                    event.stopPropagation();
                    event.preventDefault();
                   
                    var $this = $(this),
                    elSet = $this.data(),
                    elSetSource = $(elSet.drop),
                    elSetOn = elSet.effectOn || effon,
                    elSetOff = elSet.effectOff || effoff,
                    elSetDuration = elSet.duration || effdur,
                    overlayColor = elSet.overlaycolor || settings.overlayColor,
                    overlayOpacity = elSet.overlayopacity || settings.overlayOpacity;
                    
                    if (overlayColor != undefined || overlayOpacity != undefined){
                        if (!$.exists('.overlayDrop')){
                            mainBody.append('<div class="overlayDrop" style="position:absolute;width:100%;height:100%;left:0;top:0;z-index: 1001;"></div>')
                        }
                        drop_over = $('.overlayDrop');
                        drop_over.css({
                            'background-color': overlayColor, 
                            'opacity': overlayOpacity                            
                        });
                    }
                    else drop_over = $([]); 
                    
                    if (elSetSource.is('.'+activeClass)) {
                        $this.removeClass(activeClass)
                        elSetSource[elSetOff](elSetDuration, function(){
                            elSetSource.removeClass(activeClass).removeAttr('style')
                            drop_over[elSetOff](elSetDuration);
                        });
                        $thisHref = $(this).attr('href');
                        if ($thisHref!=undefined){
                            var $thisHrefL = $thisHref.length,
                            wLH = location.hash,
                            wLHL = wLH.length;
                            try{
                                indH = wLH.match($thisHref+'(?![a-z])').index;
                                location.hash = wLH.substring(0, indH)+wLH.substring(indH+$thisHrefL, wLHL)
                            }catch(err){}
                        }
                    }
                    else {
                        settings.before(this, elSetSource);
                        var $thisP = $this.data('place') || elSet.place,
                        dataSourceH = 0,
                        dataSourceW = 0,
                        $thisW = $this.width();
                        $thisH = $this.height();
                        if ($thisP == 'noinherit') {
                            var $thisPMT = ($this.data('placement')  || elSet.place).toLowerCase().split(' ');
            
                            if ($thisPMT[0] == 'bottom' || $thisPMT[1] == 'bottom')
                                dataSourceH = -elSetSource.actual('height');

                            if ($thisPMT[0] == 'top' || $thisPMT[1] == 'top')
                                dataSourceH = $thisH;

                            if ($thisPMT[0] == 'left' || $thisPMT[1] == 'left')
                                dataSourceW = 0;

                            if ($thisPMT[0] == 'right' || $thisPMT[1] == 'right')
                                dataSourceW = -elSetSource.actual('width')+$thisW;

                            $thisT = $this.offset().top + dataSourceH;
                            $thisL = $this.offset().left + dataSourceW;
                            
                            elSetSource.css({
                                'top': $thisT, 
                                'left': $thisL
                            });
                        }
                        if ($thisP == 'center') {
                            function dropScroll(){
                                elSetSource.animate({
                                    'top': (wnd.height()-elSetSource.height())/2+wnd.scrollTop(), 
                                    'left': (wnd.width()-elSetSource.width())/2+wnd.scrollLeft()
                                },{
                                    queue:false
                                });
                            }
                            wnd.unbind('scroll resize', dropScroll).bind('scroll resize', dropScroll).scroll();
                        }
            
                        $this.addClass(activeClass);
                        drop_over.show();
                        elSetSource[elSetOn](elSetDuration, function(){
                            elSetSource.addClass(activeClass);
                            if (ltie7) ieInput();
                        });
                        settings.after(this, elSetSource);
                    }
                    $(cloned).remove();
                }).each(function(){
                    var $this = $(this),
                    $thisS = $this.data('effect-off') || effoff,
                    $thisD = $this.data('duration') || effdur,
                    $thisSource = $this.data('drop'),
                    dataSource2 = $($thisSource);

                    dataSource2.attr('data-effect-off', $thisS).attr('data-duration', $thisD).attr('data-elrun', $thisSource);
                });
                
                $thisD.each(function(){
                    var $this = $(this);
                    $this.find(exit).on('click', function(){
                        $('[data-drop="'+$this.data('elrun')+'"]').click().parent().removeClass('active');
                    })
                })
                
                body.live('click', function(event) {
                    event.stopPropagation();
                    if ($(event.target).parents().is(selector) || $(event.target).is(selector)) return;
                    else methods.triggerBtnClick();
                    
                }).live('keydown', function(e){
                    var key, keyChar;
                    if(!e) var e = window.event;

                    if (e.keyCode) key = e.keyCode;
                    else if(e.which) key = e.which;
        
                    if (key == 27) {
                        methods.triggerBtnClick();
                    }
                });
            },
            triggerBtnClick: function(){
                $('[data-elrun].'+activeClass).each(function(){
                    $('[data-drop = "'+$(this).attr('data-elrun')+'"]').click().parent().removeClass('active');
                });
            }
        };
        $.fn.drop = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.drop');
            }
        };
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({
                    prev : '',
                    next : ''
                }, options);
                if (this.length > 0){
                    return this.each(function(){
                        var $this = $(this),
                        prev = settings.prev.split('.'),
                        next = settings.next.split('.'),
                        $thisPrev = $this,
                        $thisNext = $this,
                        regS = '',
                        regM = '';
                    
                        $.each(prev, function(i, v){
                            regS = v.match(/\(.*\)/);
                            if (regS != null){
                                regM = regS['input'].replace(regS[0], '');
                                regS = regS[0].substring(1, regS[0].length-1)
                            }
                            if (regS == null) regM = v;
                        
                            $thisPrev = $thisPrev[regM](regS);
                       
                        })
                        $.each(next, function(i, v){
                            regS = v.match(/\(.*\)/);
                            if (regS != null){
                                regM = regS['input'].replace(regS[0], '');
                                regS = regS[0].substring(1, regS[0].length-1)
                            }
                            if (regS == null) regM = v;
                        
                            $thisNext = $thisNext[regM](regS);
                       
                        })
                    
                        $thisNext.click(function(){
                            var input = $this.focus();
                            var inputVal = parseInt(input.val());

                            if (isNaN(inputVal)) input.val(1)
                            else input.val(inputVal+1)
                            if (input.val() > 1) $thisPrev.removeAttr('disabled');
                            else $thisPrev.attr('disabled', 'disabled');
                        })
                        $thisPrev.click(function(){
                            var input = $this.focus();
                            var inputVal = parseInt(input.val());

                            if (isNaN(inputVal)) input.val(1)
                            else if(inputVal > 1) input.val(inputVal-1)
        
                            if (input.val() == 1) $thisPrev.attr('disabled', 'disabled');
                            else $thisPrev.removeAttr('disabled');
                        })
                    })
                }
            }
        };
        $.fn.plusminus = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.plusminus' );
            }
        };
    })(jQuery);
    (function($){
        var methods = {
            init : function(options) {
                var $this = $(this);
                var $min = $(this).attr('data-min');
                
                $thisVal = $this.val();
                if ($thisVal == '') {
                    $this.keypress(function(event){
                        var key, keyChar;
                        if(!event) var event = window.event;

                        if (event.keyCode) key = event.keyCode;
                        else if(event.which) key = event.which;

                        keyChar=String.fromCharCode(key);
                        if ($thisVal == '' && keyChar == 0) return false;
                    })
                }
                else if ($thisVal < $min) $this.val($min);
            }
        };
        $.fn.minValue = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.minValue' );
            }
        };
        $('[data-min]').live('keyup', function(){
            $(this).minValue();
        })
    })(jQuery);
    
    $('#slider').sliderInit({
        minCost: $('#minCost'),
        maxCost: $('#maxCost')
    });
    
    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    $('.menu-main').menuPacket2(optionsMenu);
   
    $('.drop').drop({
        overlayColor: '#000',
        overlayOpacity: '0.6',
        before: function(el, dropEl){
            if ($(dropEl).hasClass('drop-report')){
                $(dropEl).find('li').remove();
                var elWrap = $(el).closest('li').clone().removeAttr('style'),
                dropEl = $(dropEl).find('.drop-content');
            
                elWrap.find('.photo').prependTo(elWrap)
            
                if (!dropEl.parent().hasClass('active')){
                    if (!$.exists_nabir(dropEl.find('.frame-search-thumbail'))) dropEl.append('<ul class="frame-search-thumbail items"></ul>');
                    dropEl.find('.frame-search-thumbail').append(elWrap).find('.prod_status, .btn, .frame_response').remove().end().parent().find('[data-clone="data-report"]').remove().end().append($('[data-clone="data-report"]').clone().removeClass('d_n'));
                }
            }
        }
    });
    $('.tabs').tabs({
        after: function(){
            $('.frame_tabsc > div').equalHorizCell(optionCompare);
        }
    });
    $('.frame_tabsc > div').equalHorizCell(optionCompare);
    
    $('[data-rel="plusminus"]').plusminus({
        prev: 'prev.children(:eq(1))',
        next: 'prev.children(:eq(0))'
    })
    
    try{
        $('a[rel="group"]').fancybox({
            'padding' : 45,
            'margin' : 0,
            'overlayOpacity' : 0.7,
            'overlayColor' : '#212024',
            'scrolling' : 'no'
        })
    }catch(err){}
    
    navPortait();
    
    $('[data-toggle="buttons-radio"] .btn').on('click', function(event){
        $(this).siblings().removeClass('active').end().addClass('active');
    })
    
    d_r_f_item = $('[data-radio-frame]').children();
    
    if ($.exists_nabir(d_r_f_item)) {
        d_r_f_item_class = d_r_f_item.attr('class').match(/span([0-9]+)/)[0];
        try{
            var span = $('.right').attr('class').match(/span([0-9]+)/)[0];
        }
        catch (err){}
    }
    $('.list_pic_btn .btn').on('click', function(){
        if ($(this).children().is('.icon-cat_list')){
            d_r_f_item.removeClass(d_r_f_item_class).addClass(span);
        }
        else {
            d_r_f_item.removeClass(span).addClass(d_r_f_item_class);
        }
    });
    
    var itemThumbs = $('.item_tovar .frame_thumbs > li');
    if ($.exists_nabir(itemThumbs)){
        itemThumbs.click(function(){
            var $this = $(this);
            $this.addClass('active').siblings().removeClass('active');
        })
        $('.fancybox-next').live('click', function(){
            $this = itemThumbs.filter('.active');
            if (!$this.is(':last-child')) $this.removeClass('active').next().addClass('active')
            else itemThumbs.first().click()
        })
        $('.fancybox-prev').live('click', function(){
            $this = itemThumbs.filter('.active');
            if (!$this.is(':first-child')) $this.removeClass('active').prev().addClass('active')
            else itemThumbs.last().click()
        })
    }
    var fr_lab_l = $('.frameLabel').length;
    $('.frameLabel').each(function(index){
        $(this).css({
            'position':'relative', 
            'z-index':fr_lab_l-index
        })
    });
    $('.frameLabel').has('.niceCheck.b_n').on('click', function(){
        var input = $(this).find('input').not('[disabled=disabled]');
        if (input.is(':checked')) input.attr('checked', false);
        else input.attr('checked', true);
    })
});
wnd.load(function(){
    if ($('.cycle li').length > 1){
        $('.cycle').cycle({ 
            speed:       600, 
            timeout:     2000,
            fx: 'fade',
            pager:      '.cycle .nav',
            pagerEvent: 'click',
            pauseOnPagerHover: true,
            next: '.frame_baner .next',
            prev: '.frame_baner .prev',
            pager:      '.pager',
            pagerAnchorBuilder: function(idx, slide) { 
                return '<a href="#"></a>';
            }
        }).hover(function(){
            $('.cycle').cycle('pause');
        }, function(){
            $('.cycle').cycle('resume');
        });
    }
    
    
    var $js_carousel = $('.carousel_js'),
    
    $frame_button = new Array();
    $item = new Array();
    $item_l = new Array();
    $item_w = new Array();
    $this_carousel = new Array();
    $this_prev = new Array();
    $this_next = new Array();
    
    $js_carousel.each(function(index){
        var index = index,
        $this = $(this);
        
        $frame_button[index] = $this.find('.groupButton')
        $item[index] = $this.find('.items:first > li');
        $item_l[index] = $item[index].length;
        $item_w[index] = $item[index].outerWidth(true);
        $this_carousel[index] = $this.find('.carousel');
        $this_prev[index] = $this.find('.btn_prev');
        $this_next[index] = $this.find('.btn_next');
    })
    function carousel(){
        var cont_width = $('.container').width();
        $js_carousel.each(function(index){
            var index = index,
            $count_visible = (cont_width /($item_w[index])).toFixed(1);
            if ($item_w[index]*$item_l[index]-($item_w[index]-$item[index].width()) > cont_width){
                $this_carousel[index].jcarousel({
                    buttonNextHTML: $this_next[index],
                    buttonPrevHTML: $this_prev[index],
                    visible: $count_visible,
                    scroll:1
                })
                $this_next[index].add($this_prev[index]).css('display', 'inline-block').appendTo($frame_button[index]);
            }
            else {
                $this_carousel[index].width($item_w[index]*$item_l[index])
                $this_next[index].add($this_prev[index]).css('display', 'none');
            }
            if ($(this).hasClass('frame_brand')){
                var sH = 0;
                var brandsImg = $('.frame_brand img')
                brandsImg.each(function(){
                    var $thisH = $(this).height()
                    if ($thisH > sH) sH = $thisH;
                })
                brandsImg.prev('.helper').css('height', sH);
            }
        });
    }
    
    carousel();
        
    wnd.resize(function(){
        carousel();
        navPortait();
        $('.frame_tabsc > div').equalHorizCell('refresh');
        $('.menu-main').menuPacket2('refresh');
    })
});
/*початкові зміні для слайдера*/
def_min=0;
def_max=10000;
cur_min=0;
cur_max=8000;
/**/