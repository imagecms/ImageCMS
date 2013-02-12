$(document).ready(function(){
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

    nav_tabs_li = $('.nav_tabs li');
    tabs_div = $('.tabs > div');
    
    $('.nav_tabs li a').one('click', function(event){
        event.stopPropagation();
        
        nav_tabs_li.removeClass('ui-tabs-selected');
        $(this).parent().addClass('ui-tabs-selected');
        tabs_div.hide();
        $($(this).attr('href')).show();
        
        $this = $($(this).attr('href')).children('.scroll-box');
                
        first_elem=$this.find('li:eq(0)');            
        width_elem=first_elem.outerWidth();            
        vidstup=first_elem.outerWidth(true)-width_elem;
        count_elem_2 = count_elem=$this.find('li').length;
        width=width_elem*count_elem;

        if (count_elem % 2 !=0){
            width=width+width_elem;
        }
        if (count_elem > 2) {
            width = width/2;
            count_elem_2 = count_elem/2;
        }
        if (count_elem <= 4) {
            width = width-30;
            $this.find('li').css('margin-right',15);
        }
        first_elem.parent().css('width',width+Math.round(count_elem)*vidstup);
        if (!$this.is('.jspScrollable') && count_elem > 4){
            $this.jScrollPane({
                'showArrows':true
            });
        }
        return false;
    }).filter(':first').click();
    
    $('.nav_tabs li a').click(function(){
        
        nav_tabs_li.removeClass('ui-tabs-selected');
        $(this).parent().addClass('ui-tabs-selected');
        tabs_div.hide();
        $($(this).attr('href')).show();

        return false;
    }).filter(':first').click();
    
    $('.formCost input[type="text"], .count input').keypress(function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        if (event.keyCode) key = event.keyCode;
        else if(event.which) key = event.which;

        if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
        keyChar=String.fromCharCode(key);

        if(!/\d/.test(keyChar))	return false;
    });
    
    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    if ($.exists('#slider')){
        jQuery("#slider").slider({
            min: def_min,
            max: def_max,
            values: [cur_min,cur_max],
            range: true,
            slide: function(event, ui){

                jQuery("input#minCost").val(ui.values[0]);
                jQuery("input#maxCost").val(ui.values[1]);
            }
        });
        jQuery("input#minCost").change(function(){

            var value1=jQuery("input#minCost").val();
            var value2=jQuery("input#maxCost").val();
            if(parseInt(value1) > parseInt(value2)){
                value1 = value2;
                jQuery("input#minCost").val(value1);
            }
            jQuery("#slider").slider("values",0,value1);
        });
        jQuery("input#maxCost").change(function(){
            var value1=jQuery("input#minCost").val();
            var value2=jQuery("input#maxCost").val();

            if (value2 > def_max) {
                value2 = def_max;
                jQuery("input#maxCost").val(def_max)
            }

            if(parseInt(value1) > parseInt(value2)){
                value2 = value1;
                jQuery("input#maxCost").val(value2);
            }
            jQuery("#slider").slider("values",1,value2);
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
    $('.comment_ajax_refer > a').click(function(){
        $this = $(this);
        $this.next().slideToggle(200,function(){
            $this.parent().toggleClass('visible');
        }).end().parent().parent().next().slideToggle(200).end().find('.blue_arrow').toggleClass('up');
        return false;
    });
    $('body').click( function(event) {
        if($(event.target).parents().filter('.check_form label')[0]==undefined){
            $('.apply').hide(200);
        }
    });
    $('body').keydown(function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        key = event.keyCode;
        if(key==27)
        {
            $('.apply').hide(200);
        }
    });
    if (ltie8){
        $('.list_desire:nth-child(even) span span').css({
            'width':'208px',
            'background-color':'#e6e6e6'
        });
        $('.list_desire:nth-child(even) span:nth-child(even) span').css('background-color','#f7f7f7');
        $('.list_desire:nth-child(even) .frame_porivnjanja_tovar').css('width','208px');
        $('.comparison_slider_left span:nth-child(even) span, .field_container_character span:nth-child(even) span').css({
            'background-color':'#fff',
            'min-height': '39px',
            'height':'auto'
        });

        $('.characteristics tr:nth-child(odd) th').css('background-color','#e6e6e6');
        $('.characteristics tr:nth-child(even) th').css('background-color','#f5f5f5');
        $('.characteristics tr:nth-child(odd) td').css('background-color','#efefef');
        
        $('..productPropertiesTable tr:nth-child(odd) th').css('background-color','#e6e6e6');
        $('..productPropertiesTable tr:nth-child(even) th').css('background-color','#f5f5f5');
        $('..productPropertiesTable tr:nth-child(odd) td').css('background-color','#efefef');
    }

 $('#all').on('click', function(){
       
     $(document).ready(function(){
         
         for(var i = 1; i<=den; i++){
         
         var target;
        $('.prod_dif').on('click', function(){
            target = $('.todiff'+i).text();
                return false;
        });
            
            first = $('.todiff'+i).eq(0).text();                
            var res = true;                
            $.each($('.todiff'+i), function(index, value){
                if(first != $(value).text()){
                    res = false;
                    return false;
                }
            })
            if(res){
                $('.todiff'+i).parent().hide("slow");
                $('.todifff'+i).parent().hide("slow");
            }
                console.log(res);
                    }
                        
     })  
        }) 
     
 $('.active').on('click', function(){
$(document).ready(function(){
    $('span').show("slow");
})
    
})    

    if ($.exists('.field_container_character'))
    {
        h=48;
        h2=43;
        $('.field_container_character').each(function(){
            $(this).find('span:even span').each(function(){
                $this=$(this);
                $this_h = $this.outerHeight();
                if ($this_h>h){
                    $this.css('height',$this_h);
                    index2=$this.parent().index();
                    li=$this.parent().parent().parent().siblings();
                    li.each(function(){
                        $('.comparison_slider_left > span').filter(function(index){
                            return index==index2;
                        }).children().css('height',$this_h);
                        $(this).find('.field_container_character > span').filter(function(index){
                            return index==index2;
                        }).children().css('height',$this_h);
                    });
                }
            });
            $(this).find('span:odd span').each(function(){
                $this=$(this);
                $this_h = $this.outerHeight();
                if ($this.outerHeight()>$this_h){
                    $this.css('height',$this_h);
                    index2=$this.index();
                    li=$this.parent().parent().parent().siblings();
                    li.each(function(){
                        $('.comparison_slider_left > span').filter(function(index){
                            return index==index2;
                        }).children().css('height',$this_h);
                        $(this).find('.field_container_character > span').filter(function(index){
                            return index==index2;
                        }).children().css('height',$this_h);
                    });
                }
            });
        });
    }
   
     width = 0;
    $('.comparison_slider_right li').each(function(){
        return width+=$(this).outerWidth();
    });
    
    $('.comparison_slider_right').css('width',width);
    
    $(function(){
        $('.comparison_tovars').jScrollPane({
            'showArrows':true
        });
    });      
    
    if ($("a[rel=group]").length > 0){
        $("a[rel=group]").fancybox({
            'padding' : 0,
            'margin' : 0,
            'overlayOpacity' : 0.5,
            'overlayColor' : '#000'
        });
    }
});
   
$(window).load(function(){
    $('.cycle ul').cycle({
        speed:       600,
        timeout:     2000,
        fx: 'fade',
        pager:      '.cycle .nav',
        pagerEvent: 'click',
        pauseOnPagerHover: true,
        next: '.cycle .next',
        prev: '.cycle .prev'
    }).hover(function(){
        $('.cycle ul').cycle('pause');
    }, function(){
        $('.cycle ul').cycle('resume');
    });
    $('.featured .carusel').jCarouselLite({
        btnNext: '.featured .next',
        btnPrev: '.featured .prev',
        visible: 3
    });
    $('.promotion .carusel').jCarouselLite({
        btnNext: '.promotion .next',
        btnPrev: '.promotion .prev',
        visible: 1
    });
    width_brand=0;
    $('.brand .carusel').jCarouselLite({
        btnNext: '.brand .next',
        btnPrev: '.brand .prev',
        visible: 6
    });
    $('.brand li').each(function(){
        width_brand+=$(this).outerWidth(true);
    });
    $('.brand ul').css('width',width_brand);
});