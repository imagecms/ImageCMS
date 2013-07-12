wnd = $(window);
body = $('body');
mainBody = $('.main-body');

$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir){
    return (nabir.length > 0);
}

var ie = $.browser.msie,
ieV = $.browser.version,
ltie7 = ie&&(ieV <= 7),
ltie8 = ie&&(ieV <= 8);

var optionCompare = {
    left : '.leftDescription li',
    right : '.comprasion_tovars_frame > li',
    elEven : 'li',
    frameScroll: '.comprasion_tovars_frame',
    mouseWhell: false,
    scrollNSP: true,
    scrollNSPT: '.items-catalog',
    onlyDif: $('[data-href="#only-dif"]'),
    allParams: $('[data-href="#all-params"]'),
    hoverParent: '.characteristic'
};
function ieInput(els){
    els = $('input[type="text"], textarea, input[type="password"]');
            
    els.not(':hidden').not('.visited').not('.notvis').each(function(){
        $this = $(this);
        $this.css('width', '100%').css({
            'width': function(){
                return 2*$this.width()-$this.outerWidth();
            },
            'height': function(){
                return 2*$this.height()-$this.outerHeight();
            }
        }).addClass('visited');
    });
};
function setcookie(name, value, expires, path, domain, secure)
{
    var today = new Date();
    today.setTime( today.getTime() );

    if ( expires )
    {
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date( today.getTime() + (expires) );

    document.cookie = name + "=" + encodeURIComponent( value ) +
    ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
    ( ( path ) ? ";path=" + path : "" ) +
    ( ( domain ) ? ";domain=" + domain : "" ) +
    ( ( secure ) ? ";secure" : "" );
}
function listtable(){
    var tooltip =$('.items-catalog:not(.list) .btn-def > button, .items-catalog:not(.list) .btn-order[data-title] > button').not('[data-drop]');
    $('.items-catalog .btn-def > button, .items-catalog .btn-order[data-title] > button').not('[data-drop]').unbind('mouseenter').unbind('mouseleave');
    tooltip.mouseenter(function(){
        $(this).tooltip();
    }).mouseleave(function(){
        $(this).tooltip('remove');
    });
}
    
(function($){
    var methods = {
        init : function(options) {
            var settings = $.extend({
                wrapper: $(".frame-label:has(.niceCheck)"),
                elCheckWrap: '.niceCheck',
                evCond: false, 
                before: function(){
                    return true;
                }
            }, options);
                
            var frameChecks = $(this);
            if ($.exists_nabir(frameChecks)){
                wrapper = settings.wrapper;
            
                elCheckWrap = settings.elCheckWrap;
                evCond = settings.evCond;
                
                frameChecks = frameChecks.selector.split(',')
                $.map(frameChecks, function(i, n){
                    thisFrameChecks = $(i.replace(' ', ''));
                    thisFrameChecks.each(function() {
                        $(this).find(elCheckWrap).each(function(){
                            var $this = $(this).removeClass('b_n');
                            var $thisInput = $this.children()
                       
                            if (!$thisInput.is('[disabled="disabled"]'))
                                methods.changeCheckStart($this, $thisInput);
                            else{
                                methods.checkUnСhecked($this, $thisInput)
                                methods.CheckallDisabled($this, $thisInput);
                            } 
                        })
                    }).find(wrapper).unbind('click').on('click', function() {
                        var $this = $(this),
                        $thisD = $this.is('.disabled'),
                        nstcheck = $this.find(elCheckWrap);
                        
                        if(nstcheck.length == 0) nstcheck = $this
                        
                        if (!$thisD){
                            if (!evCond)
                                methods.changeCheck(nstcheck);
                            else
                                settings.before(thisFrameChecks, $this, nstcheck);
                        }
                    });
                })
            }
        },
        changeCheckStart : function(el, input){
            var el = el,
            input = input;
            if (input.attr("checked")) {
                methods.checkСhecked(el, input);
            }
            else {
                methods.checkUnСhecked(el, input);
            }
        },
        checkСhecked: function(el, input) {
            var el = el;
            if (el == undefined) el = this;
            var input = input;
            if (input == undefined) input = this.find("input");
            el.addClass('active').parent().addClass('active');
            input.attr("checked", true);
        },
        checkUnСhecked: function(el, input) {
            var el = el;
            if (el == undefined) el = this;
            var input = input;
            if (input == undefined) input = this.find("input");
            el.removeClass('active').parent().removeClass('active');
            input.attr("checked", false);
        },
        changeCheck: function(el)
        {
            var el = el;
            if (el == undefined) el = this;
            var input = el.find("input");
            if (!input.attr("checked")) {
                methods.checkСhecked(el, input);
            }
            else {
                methods.checkUnСhecked(el, input);
            }
        },
        changeCheckallchecks: function(el)
        {
            var el = el;
            if (el == undefined) el = this;
            el.each(function(){
                var input = el.find("input");
                el.addClass('active').parent().addClass('active');
                input.attr("checked", true);
            })
        },
        changeCheckallreset: function(el)
        {
            var el = el;
            if (el == undefined) el = this;
            el.each(function(){
                input = el.find("input");
                el.removeClass('active').parent().removeClass('active');
                input.attr("checked", false);
            });
        },
        CheckallDisabled: function(el)
        {
            var el = el;
            if (el == undefined) el = this;
            el.each(function(){
                input = el.find("input");
                el.removeClass('active').addClass('disabled').parent().addClass('disabled').removeClass('active');
                input.attr('disabled', 'disabled').removeAttr('checked');
            });
        },
        CheckallEnabled: function(el)
        {
            var el = el;
            if (el == undefined) el = this;
            el.each(function(){
                input = el.find("input");
                el.removeClass('disabled').parent().removeClass('disabled');
                input.removeAttr('disabled');
            });
        }
    };
    $.fn.nStCheck = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.nStCheck' );
        }
    };
})(jQuery);
(function($){
    var methods = {
        init : function(options) {
            var settings = $.extend({
                after: function(){
                    return true;
                }
            }, options);
            
            after = settings.after;
            
            var $this = $(this);
            
            if ($.exists_nabir($this)) {
                $(this).each(function() {
                    methods.changeRadioStart($(this));
                });
            }
            $this.parent().unbind('click').on('click', function() {
                methods.changeRadio($(this).children($this));
            });
        },
        changeRadioStart: function(el)
        {
            var el = el,
            input = el.find("input");
            if (input.attr("checked")) {
                methods.radioCheck(el, input);
            }
            el.removeClass('b_n');
            return false;
        },
        changeRadio: function(el)
        {
            var el = el,
            input = el.find("input");
            methods.radioCheck(el, input);
        },
        radioCheck: function(el, input) {
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
        radioUnCheck: function (el, input) {
            var el = el,
            input = input;

            el.removeClass('active');
            el.parent().removeClass('active');
            input.attr("checked", false);
        }
    };
    $.fn.nStRadio = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.nStRadio');
        }
    };
})(jQuery);
(function($){
    var methods = {
        init : function(options) {
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
            
            if (settings.effect == 'notalways') {
                $('.tooltip').remove()
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
(function($){
    var methods = {
        init : function(options) {
            var settings = $.extend({
                pasteAfter: $(this),
                pasteWhat: $('[data-rel="whoCloneAddPaste"]'),
                evPaste: 'click',
                effectIn: 'fadeIn',
                effectOff: 'fadeOut',
                wherePasteAdd: this,
                whatPasteAdd: '<input type="hidden">',
                duration: 300,
                before: function(el){
                    return;
                },
                after: function(el, elInserted){
                    return;
                }
            }, options);
            var $this = $(this);
                
            pasteAfter = settings.pasteAfter;
            pasteWhat = settings.pasteWhat;
            evPaste = settings.evPaste;
            effectIn = settings.effectIn;
            effectOff = settings.effectOff;
            duration = settings.duration;
            wherePasteAdd = settings.wherePasteAdd;
            whatPasteAdd = settings.whatPasteAdd;
            before = settings.before;
            after = settings.after;
                
            pasteAfter = pasteAfter.split('.'),
                
            $this.on(evPaste, function(){
                methods.evClick($(this))
            })
        },
        evClick: function($this){
            var pasteAfter2 = $this;
            $.each(pasteAfter, function(i, v){
                pasteAfter2 = pasteAfter2[v]();
            })
                
            var insertedEl = pasteAfter2.next(),
            pasteAfterEL = pasteAfter2;
                
            before($this);
                
            if (!pasteAfterEL.hasClass('already')) {
                pasteAfterEL.after(pasteWhat.clone().hide().find(wherePasteAdd).prepend(whatPasteAdd).end()).addClass('already');
                pasteAfterEL.next()[effectIn](duration, function(){
                    if (ltie7) ieInput();
                })
                after($this, pasteAfterEL.next());
            }
            else if (insertedEl.is(':visible')) insertedEl[effectOff](duration);
            else if (!insertedEl.is(':visible')) insertedEl[effectIn](duration);
              
        }
    };
    $.fn.cloneAddPaste = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.cloneaddpaste' );
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
   
(function($){
    var methods = {
        init : function(options) {
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
                    
                    methods.positionDrop($this, elSet, elSetSource);
            
                    $this.addClass(activeClass);
                    drop_over.show();
                    elSetSource[elSetOn](elSetDuration, function(){
                        elSetSource.addClass(activeClass);
                        if (ltie7) ieInput();
                        settings.after(this, elSetSource);
                    });
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
        },
        positionDrop: function($this, elSet, elSetSource){
            if ($this == undefined){
                $this = $(this);

                var elSet = $this.data(),
                elSetSource = $(elSet.drop);
            }
            
            var $thisP = $this.data('place') || elSet.place;
            dataSourceH = 0,
            dataSourceW = 0,
            $thisW = $this.width();
            $thisH = $this.height();
            if ($thisP == 'noinherit') {
                var $thisPMT = ($this.data('placement') || elSet.place).toLowerCase().split(' ');

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

                elSetSource.css({
                    'top': $thisT,
                    'left': $thisL
                });
            }
            if ($thisP == 'center') {
                function dropScroll() {
                    elSetSource.animate({
                        'top': (wnd.height() - elSetSource.height()) / 2 + wnd.scrollTop(),
                        'left': (wnd.width() - elSetSource.width()) / 2 + wnd.scrollLeft()
                    }, {
                        queue: false
                    });
                }
                wnd.unbind('scroll resize', dropScroll).bind('scroll resize', dropScroll).scroll();
            }
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
                item : this.find('li'),
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
                
            menuItem.each(function(index){
                var $this = $(this),
                $thisW = $this.width(),
                $thisL = $this.position().left,
                drop = $this.find(settings.drop),
                    
                $thisH = $this.height();
                if ($thisH > sH) sH = $thisH;
                    
                if (menuW - $thisL < dropW) {
                    drop.css('right', menuW-$thisW-$thisL).addClass('right-drop');
                }
                else{
                    drop.css('left', $thisL);
                } 
            }).css('height', sH);
                
            menuItem.find('.helper:first').css('height', sH)
                    
            $('.not-js').removeClass('not-js');
                
            menuItem.hover(
                function(){
                    var $this = $(this),
                    $thisDrop = $this.find(settings.drop);
                    if ($this.index() == 0) $this.addClass('first_h');
                    if ($this.index() == item_menu_l - 1) $this.addClass('last_h');
                    hover_t_o = setTimeout(function(){
                        $thisDrop.fadeIn(200);
                        if ($thisDrop.length != 0) menu.addClass('hover');
                    }, time_dur_m);
                },function(){
                    var $this = $(this),
                    $thisDrop = $this.find(settings.drop);
                    $(settings.drop).stop().fadeOut(200);
                    $('.first_h, .last_h').removeAttr('class');
                    clearTimeout(hover_t_o);
                    if ($thisDrop.length != 0) menu.removeClass('hover');
                });
            menu.hover(
                function(){
                    return time_dur_m = 0;
                },
                function(){
                    return time_dur_m = duration;
                });
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
                var $thisUl = $(this),
                condRadio = $thisUl.data('type') != 'radio';
                nav_tabs_li[index] = $thisUl.children();
                refs[index] = nav_tabs_li[index].children().filter('[href], [data-href]');
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
                            if (condRadio){
                                tabs_div[index].hide().removeClass('active');
                                $($thisA).show().addClass('active');
                                if (ltie7) ieInput();
                            }
                            else{
                                setcookie('listtable', $this.parent().index(), 0, '/');
                            }
                        }
                        if (condRadio){
                            if (attrOrdata[index] != 'data'){
                                if (event.which || event.button == 0) {
                                    var wLH = window.location.hash;
                                    temp = wLH;
                                    try{
                                        if (wLH.indexOf($thisA) == -1){
                                            var tempW = wLH.match(reg_refs[index]);
                                            temp = temp.replace(wLH.match(tempW[0]), $thisA)
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
                        else {
                            $($thisUl.data('elchange')).toggleClass($thisUl.data('elchtglcls'))
                            listtable();
                        }
                    }
                    if (event.which || event.button == 0) {
                        settings.after($thisUl);
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
                return hashs = [hashs, []];
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
            var settings = $.extend({
                wrapper: this,
                item: 'li',
                prev: '.prev',
                next: '.next',
                content: '.content-carousel',
                before: function(){}
            }, options);
                
            var $js_carousel = settings.wrapper;
            if ($.exists_nabir($js_carousel)){
                item = settings.item,
                prev = settings.prev,
                next = settings.next,
                content = settings.content,
                $item = [],
                $item_l = [],
                $item_w = [],
                $this_carousel = [],
                $this_prev = [],
                $this_next = [],
                $marginR = [],
                cont_width = [];

                $js_carousel.each(function(index) {
                    $this = $(this);
                    $this_carousel[index] = $this;
                    $item[index] = $this.find(item);
                    $item_l[index] = $item[index].length;
                    $item_w[index] = $item[index].outerWidth(true);
                    $this_prev[index] = $this.find(prev);
                    $this_next[index] = $this.find(next);
                    $marginR[index] = $item_w[index]-$item[index].outerWidth();
                    cont_width[index] = $this.find(content).width();
                })
               
                settings.before();
        
                $js_carousel.each(function(index) {
                    var index = index,
                    $count_visible = (cont_width / ($item_w[index])).toFixed(1);
                    
                    if ($item_w[index] * $item_l[index] - $marginR[index] > cont_width[index]) {
                        $this_carousel[index].jcarousel({
                            buttonNextHTML: $this_next[index],
                            buttonPrevHTML: $this_prev[index],
                            visible: $count_visible,
                            scroll: 1
                        })
                        $this_next[index].add($this_prev[index]).show();
                    }
                    else {
                        $this_next[index].add($this_prev[index]).css('display', 'none');
                    }
                });
            }
        }
    };
    $.fn.myCarousel = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.myCarousel' );
        }
    }
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
                if (visThis){
                    var left = $this.find(settings.left),
                    right = $this.find(settings.right);
                    li_i_length = left.length;
                }
				
                if (visThis && !$this.is('[data-equalHorizCell]')){
                    var h=0,
                    li_i_h = [],
                    frameScroll = $this.find(settings.frameScroll),
                    frame_scrollC = frameScroll.children(),
                    frame_scrollCL = frame_scrollC.length;
                        
                    scrollNSP = settings.scrollNSP && $.exists(frameScroll);
                    scrollNSPT = settings.scrollNSPT;

                    for (var j = 0; j < li_i_length; j++){
                        nab = $([]);
                        right.each(function(){
                            nab = nab.add($(this).find(elEven).eq(j))
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
                        $this.children('.scrollNSP').remove();
                        $this.append('<div class="scrollNSP" style = "overflow:auto;"><div style="width:'+w+'px;"></div></div>')
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
                        firstScrl.add(secScrl).unbind('mousewheel').bind('mousewheel', function(event, delta, deltaX, deltaY) {
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
                    firstScrl.add(secScrl).scrollLeft('0');
                        
                    secScrl.unbind('scroll').bind('scroll', function() {
                        $thisSL = $(this).scrollLeft();
                        firstScrl.add(secScrl).scrollLeft($thisSL);
                    });
                    $this.attr('data-equalHorizCell','');
                }
                if (visThis){
                    var right = right.find(hoverParent),
                    left = left.parent(hoverParent).children();
					
                    left.each(function(ind){
                        if (ind%2==0) $(this).addClass('oddC');
                        else $(this).addClass('evenC')
                    });

                    right.each(function(){
                        $(this).find(elEven).each(function(ind){
                            if (ind%2==0) $(this).addClass('oddC');
                            else $(this).addClass('evenC')
                        });
                    });
					
                    methods.hoverComprasion(left, right);
                        
                    onlyDif.die('click').live('click', function(){
                        methods.onlyDifM(left, right);
                    })
                    allParams.die('click').live('click', function(){
                        methods.allParamsM(left, right);
                    })
                }
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
        },
        hoverComprasion: function(left, right){
            left.add(right.find(elEven)).hover(function(){
                var $this = $(this),
                index = $this.index(),
                nab = $([]);
				
                right.each(function(){
                    nab = nab.add($(this).find(elEven).eq(index))
                })
                $([]).add(left.eq(index)).add(nab).addClass('hover')
            },
            function(){
                var $this = $(this),
                index = $this.index(),
                nab = $([]);
                right.each(function(){
                    nab = nab.add($(this).find(elEven).eq(index))
                })
                $([]).add(left.eq(index)).add(nab).removeClass('hover')
            });
        },
        onlyDifM: function(left, right){
            li_i_h = [];
            genObj = $([]);
            tempText = '';
            k = 0; 
            for (var j = 0; j < li_i_length; j++){
                nab = $([]);
                right.each(function(){
                    nab = nab.add($(this).find(elEven).eq(j))
                })
                var tempNabir = nab;
                tempNabir.each(function(index){
                    var this_ch = $(this);
                    li_i_h[index] = $.trim(this_ch.text());

                    if (tempText == li_i_h[index]) k++;
                    tempText = li_i_h[index];
                });
				
                if (k == tempNabir.length-1 && k!=0) genObj = genObj.add(left.eq(j)).add(tempNabir);
				  
                li_i_h = [];
                k = 0;
                tempText = '';
            }
			
            right.each(function(){
                $(this).find(elEven).not(genObj).removeClass('evenC').removeClass('oddC').each(function(ind){
                    if (ind%2==0) $(this).addClass('oddC');
                    else $(this).addClass('evenC')
                });
            });
            left.not(genObj).removeClass('evenC').removeClass('oddC').each(function(ind){
                if (ind%2==0) $(this).addClass('oddC');
                else $(this).addClass('evenC')
            });
		
            genObj.hide();
        },
        allParamsM: function(left, right){
            left.removeClass('evenC').removeClass('oddC').each(function(ind){
                if (ind%2==0) $(this).addClass('oddC');
                else $(this).addClass('evenC')
            }).show();
            
            right.each(function(){
                $(this).find(elEven).removeClass('evenC').removeClass('oddC').each(function(ind){
                    if (ind%2==0) $(this).addClass('oddC');
                    else $(this).addClass('evenC')
                }).show();
            });
        }
    };
    $.fn.equalHorizCell = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.equalHorizCell' );
        }
    };
})(jQuery);
(function($){
    var methods = {
        init : function(options) {
            var settings = $.extend({
                item : 'ul > li',
                duration: 300,
                searchPath: "/shop/search",
                inputString: $('#inputString')
            }, options);
                
            $thisS = $(this);
            itemA = settings.item;
            durationA = settings.duration;
            searchPath = settings.searchPath;
            selectorPosition = -1;
            inputString = settings.inputString.keyup(function(event){
                methods.lookup(event);
            }).blur(function(){
                $thisS.fadeOut(durationA);
            });
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
                    $thisS.html(data);
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
(function($){
    var methods = {
        init : function(options) {
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
                        settings.afterClick($this, rating, width);
                        return false;
                    });
                }
            })
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