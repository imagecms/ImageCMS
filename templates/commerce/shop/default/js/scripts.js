$(document).ready(function() {
    jQuery.exists = function(selector) {
        return ($(selector).length > 0);
    }
    jQuery.exists_nabir = function(nabir) {
        return (nabir.length > 0);
    }
    var ie = jQuery.browser.msie,
    ieV = jQuery.browser.version,
    ltie7 = ie && (ieV <= 7),
    ltie8 = ie && (ieV <= 8);


    nav_tabs_li = $('.nav_tabs li');
    tabs_div = $('.tabs > div');
    if (location.hash == '')
    {
        var variable = 0;
    }
    else {
        var variable = $('[href=' + location.hash + ']').parent().index();
    }

    $('.nav_tabs li a').live('click', function(event) {
        event.stopPropagation();

        nav_tabs_li.removeClass('ui-tabs-selected');
        $(this).parent().addClass('ui-tabs-selected');
        tabs_div.hide();
        $($(this).attr('href')).show();
    }).filter(':eq(' + variable + ')').click();
    
    (function($){
        var methods = {
            init : function(options) {
                var settings = $.extend({
                    item : this.find('li'),
                    duration: 300,
                    drop: this.find('li > ul')
                }, options);
                
                var sH = 0;
                
                var menu = $(this);
                var menuW = menu.width();
                var menuItem = settings.item;
                var item_menu_l = menuItem.length;
                var drop = settings.drop;
                var dropW = 540;
                var duration = time_dur_m = settings.duration;
                
                menuItem.each(function(index){
                    var $this = $(this);
                    var $thisW = $this.width();
                    var $thisL = $this.position().left;
                    
                    var $thisH = $this.height()
                    if ($thisH > sH) sH = $thisH;
                    
                    if (menuW - $thisL < dropW) {
                        drop.eq(index).css('right', menuW-$thisW-$thisL).addClass('right-drop');
                    }
                    else drop.eq(index).css('left', $thisL)
                })
                menuItem.css('height', sH);
                menuItem.find('.title .helper').css('height', sH-4)
                    
                $('.not-js').removeClass('not-js');
                $('.frame-item-menu > ul > li').hover(function(){
                    var $this = $(this);
                    if (!$(this).hasClass('visited')){
                        $this.addClass('visited');
                        var $thisD = $this.children('div');
                        var $thisU = $this.find('ul');
                        var $thisUH=0;
                        $thisU.each(function(){
                            return $thisUH += $(this).outerHeight();
                        })
                        if ($thisD.outerHeight() < $thisUH) $thisD.css('height', $thisUH);
                    }
                })
                menuItem.hover(
                    function(){
                        var $this = $(this);
                        var $thisDrop = drop.eq($this.index());
                        if ($this.index() == 0) $this.addClass('first_h');
                        if ($this.index() == item_menu_l - 1) $this.addClass('last_h');
                        hover_t_o = setTimeout(function(){
                            $thisDrop.stop().fadeIn(200);
                            menu.addClass('hover');
                        }, time_dur_m);
                    },function(){
                        drop.stop().fadeOut(200);
                        $('.first_h, .last_h').removeAttr('class');
                        clearTimeout(hover_t_o);
                        menu.removeClass('hover');
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
        $.fn.menuPacket1 = function( method ) {
            if ( methods[method] ) {
                return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, arguments );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
            }
        };
    })(jQuery);
    $('.menu-main').menuPacket1({
        item: $('.menu-main').find('td'),
        duration: 300,
        drop: $('.menu-main').find('.frame-item-menu > ul')
    })

    $('.frame_rep_bug [type="submit"]').die('click').live('click', function() {
        var url = 'hostname=' + location.hostname + '&pathname=' + location.pathname + '&user_name=' + $('#user_name').text() + '&text=' + $('.frame_rep_bug textarea').val() + '&ip_address=' + $('.frame_rep_bug #ip_address').val();
        $.ajax({
            type: 'GET',
            url: 'admin/report_bug',
            data: url,
            success: function(data) {
                $('.frame_rep_bug').prepend('<div class="alert alert-success">Ваше повідомлення відправлено</div>');
                setTimeout(function() {
                    overlay.trigger('click')
                }, 2000)
            }
        })
        return false;
    });

    //    $('.nav_tabs li a').click(function() {
    //
    //        nav_tabs_li.removeClass('ui-tabs-selected');
    //        $(this).parent().addClass('ui-tabs-selected');
    //        tabs_div.hide();
    //        $($(this).attr('href')).show();
    //
    //        return false;
    //    }).filter(':first').click();

    $('.formCost input[type="text"], .count input').keypress(function(event) {
        var key, keyChar;
        if (!event)
            var event = window.event;

        if (event.keyCode)
            key = event.keyCode;
        else if (event.which)
            key = event.which;

        if (key == null || key == 0 || key == 8 || key == 13 || key == 9 || key == 46 || key == 37 || key == 39)
            return true;
        keyChar = String.fromCharCode(key);

        if (!/\d/.test(keyChar))
            return false;
    });

    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    if ($.exists('#slider')) {
        var def_min = $("#opt1").data("def_min");
        var def_max = $("#opt2").data("def_max");
        var cur_min = $("#minCost").val();
        var cur_max = $("#maxCost").val();
        jQuery("#slider").slider({
            min: def_min,
            max: def_max,
            values: [cur_min, cur_max],
            range: true,
            slide: function(event, ui) {

                jQuery("input#minCost").val(ui.values[0]);
                jQuery("input#maxCost").val(ui.values[1]);
            }
        });
        jQuery("input#minCost").change(function() {

            var value1 = jQuery("input#minCost").val();
            var value2 = jQuery("input#maxCost").val();
            if (parseInt(value1) > parseInt(value2)) {
                value1 = value2;
                jQuery("input#minCost").val(value1);
            }
            jQuery("#slider").slider("values", 0, value1);
        });
        jQuery("input#maxCost").change(function() {
            var value1 = jQuery("input#minCost").val();
            var value2 = jQuery("input#maxCost").val();

            if (value2 > def_max) {
                value2 = def_max;
                jQuery("input#maxCost").val(def_max)
            }

            if (parseInt(value1) > parseInt(value2)) {
                value2 = value1;
                jQuery("input#maxCost").val(value2);
            }
            jQuery("#slider").slider("values", 1, value2);
        });
    }
    /*
     $('.check_form input').change(function(){
     if($.exists_nabir($(this).parent(':not(.disabled)'))){
     $this=$(this);
     $this.parent().parents('form').find('.check_form').find('label.active').not($this.parent()).toggleClass('active').find('.apply').stop().hide(200);
     $this.parent().addClass('active');
     left=$this.parent().width();
     if(!$.exists_nabir($this.parent().find('.apply'))){
     win=$this.parent().append("<span class='apply'><span><span>"+'Найдено <span>345</span> товаров'+"</span><a href='#'>Показать</a></span></span>");
     $this.parent().find('.apply').stop().show(200);
     }
     else{
     $this.parent().find('.apply').stop().show(200);
     }
     win.find('.apply').css('left',left+7);
     }
     });
     */
    $('.comment_ajax_refer > a').click(function() {
        $this = $(this);
        $this.next().slideToggle(200, function() {
            $this.parent().toggleClass('visible');
        }).end().parent().parent().next().slideToggle(200).end().find('.blue_arrow').toggleClass('up');
        return false;
    });
    $('body').click(function(event) {
        if ($(event.target).parents().filter('.check_form label')[0] == undefined) {
            $('.apply').hide(200);
        }
    });
    $('body').keydown(function(event) {
        var key, keyChar;
        if (!event)
            var event = window.event;

        key = event.keyCode;
        if (key == 27)
        {
            $('.apply').hide(200);
        }
    });
    if (ltie8) {
        $('.list_desire:nth-child(even) span span').css({
            'width': '208px',
            'background-color': '#e6e6e6'
        });
        $('.list_desire:nth-child(even) span:nth-child(even) span').css('background-color', '#f7f7f7');
        $('.list_desire:nth-child(even) .frame_porivnjanja_tovar').css('width', '208px');
        $('.comparison_slider_left span:nth-child(even) span, .field_container_character span:nth-child(even) span').css({
            'background-color': '#fff',
            'min-height': '39px',
            'height': 'auto'
        });

        $('.characteristics tr:nth-child(odd) th').css('background-color', '#e6e6e6');
        $('.characteristics tr:nth-child(even) th').css('background-color', '#f5f5f5');
        $('.characteristics tr:nth-child(odd) td').css('background-color', '#efefef');

        $('..productPropertiesTable tr:nth-child(odd) th').css('background-color', '#e6e6e6');
        $('..productPropertiesTable tr:nth-child(even) th').css('background-color', '#f5f5f5');
        $('..productPropertiesTable tr:nth-child(odd) td').css('background-color', '#efefef');
    }

    $('#all').on('click', function() {

        $(document).ready(function() {

            for (var i = 1; i <= den; i++) {

                var target;
                $('.prod_dif').on('click', function() {
                    target = $('.todiff' + i).text();
                    return false;
                });

                first = $('.todiff' + i).eq(0).text();
                var res = true;
                $.each($('.todiff' + i), function(index, value) {
                    if (first != $(value).text()) {
                        res = false;
                        return false;
                    }
                })
                if (res) {
                    $('.todiff' + i).parent().hide("slow");
                    $('.todifff' + i).parent().hide("slow");
                }
                console.log(res);
            }

        })
    })

    $('.active').on('click', function() {
        $(document).ready(function() {
            $('span').show("slow");
        })

    })

    comprasion();

    if ($("a[rel=group]").length > 0) {
        $("a[rel=group]").fancybox({
            'padding': 0,
            'margin': 0,
            'overlayOpacity': 0.5,
            'overlayColor': '#000'
        });
    }
    var main_menu_w = $('.main_menu').width();
    var main_menu_l = $('.main_menu > ul > li').length;
    main_menu_l = Math.floor(main_menu_l / 2);
    $('.main_menu > ul > li:gt(' + (main_menu_l - 1) + ')').each(function() {
        var $this = $(this);
        $this_ul = $this.children('ul');
        var $this_w = $this.width();
        var $this_p_l = $this.position().left;
        $this_ul.css('right', main_menu_w - $this_p_l - $this_w - 2)
    })

});

$(window).load(function() {
    $('.cycle ul').cycle({
        speed: 600,
        timeout: 2000,
        fx: 'fade',
        pager: '.cycle .nav',
        pagerEvent: 'click',
        pauseOnPagerHover: true,
        next: '.cycle .next',
        prev: '.cycle .prev'
    }).hover(function() {
        $('.cycle ul').cycle('pause');
    }, function() {
        $('.cycle ul').cycle('resume');
    });

    var $js_carousel = $('.carousel_js'),
    $item = new Array();
    $item_l = new Array();
    $item_w = new Array();
    $this_carousel = new Array();
    $this_prev = new Array();
    $this_next = new Array();

    $js_carousel.each(function(index) {
        var index = index,
        $this = $(this);

        $item[index] = $this.find('li');
        $item_l[index] = $item[index].length;
        $item_w[index] = $item[index].outerWidth(true);
        $this_carousel[index] = $this.find('.carusel');
        $this_prev[index] = $this.find('.prev');
        $this_next[index] = $this.find('.next');
    })
    function carousel() {
        var cont_width = 940;
        $js_carousel.each(function(index) {
            var index = index,
            $count_visible = (cont_width / ($item_w[index])).toFixed(1);
            if ($item_w[index] * $item_l[index] > cont_width) {
                //$this_prev[index].add($this_next[index]).fadeIn();
                $this_carousel[index].jcarousel({
                    buttonNextHTML: $this_next[index],
                    buttonPrevHTML: $this_prev[index],
                    visible: $count_visible,
                    scroll: 1
                })
                $this_next[index].add($this_prev[index]).css('display', 'inline-block');
            }
            else {
                $this_carousel[index].width($item_w[index] * $item_l[index])
                $this_next[index].add($this_prev[index]).css('display', 'none');
            }
        });
    }
    carousel();
});
function comprasion(){
    if ($.exists('.field_container_character'))
    {
        h = 48;
        h2 = 43;
        $('.field_container_character').each(function() {
            var compSlider = $(this).closest('.comparison_slider');
            var tovar_frame = compSlider.find('.smallest_item');
            var compSliderLeft = compSlider.find('.comparison_slider_left');
            var max_h = 0;
            tovar_frame.each(function(){
                $thisH = $(this).height()
                if ($(this).height() > max_h) max_h = $thisH;
            }).css('height', max_h);
            compSliderLeft.css('top', max_h+46);
            
            $(this).find('span:even span').each(function() {
                $this = $(this);
                $this_h = $this.outerHeight();
                if ($this_h > h) {
                    $this.css('height', $this_h);
                    index2 = $this.parent().index();
                    li = $this.parent().parent().parent().siblings();
                    li.each(function() {
                        $('.comparison_slider_left > span').filter(function(index) {
                            return index == index2;
                        }).children().css('height', $this_h);
                        $(this).find('.field_container_character > span').filter(function(index) {
                            return index == index2;
                        }).children().css('height', $this_h);
                    });
                }
            });
            $(this).find('span:odd span').each(function() {
                $this = $(this);
                $this_h = $this.outerHeight();
                if ($this.outerHeight() > $this_h) {
                    $this.css('height', $this_h);
                    index2 = $this.index();
                    li = $this.parent().parent().parent().siblings();
                    li.each(function() {
                        $('.comparison_slider_left > span').filter(function(index) {
                            return index == index2;
                        }).children().css('height', $this_h);
                        $(this).find('.field_container_character > span').filter(function(index) {
                            return index == index2;
                        }).children().css('height', $this_h);
                    });
                }
            });
        });
    }

    width = 0;
    $('.comparison_slider_right li').each(function() {
        return width += $(this).outerWidth();
    });

    $('.comparison_slider_right').css('width', width);

    $(function() {
        $('.comparison_tovars').jScrollPane({
            'showArrows': true
        });
    });
}