jQuery(document).ready(function(){
    $(window).on({
        resize:function(){
            $('.fancy').css('height',$(document).height());
        }
    });
    $('.place_hold').each(function(){
        $(this).attr('def_value',$(this).val())
    });
    $('.place_hold').bind({
        focus : function()
        {
            if ($(this).attr('def_value') == $(this).val()){
                $(this).val('');
            }
        },
        blur : function()
        {
            if ($(this).val() == ''){
                $(this).val($(this).attr('def_value'));
            }
        }
    });
    var tabContainers = $('.tabs > div');
    tabContainers.hide().filter(':first').show();
    $('.tabs li').click(function ()
    {
        tabContainers.hide();
        tabContainers.filter($(this).children().attr('href')).show();
        $('.tabs li').siblings().removeClass('active');
        $(this).addClass('active').blur();
        return false;
    }).filter(':first').click();
    
    if(!$('article').length && !$('#with_out_article').length) $('body').css('background-color','#EDEDED');
    
    duration=500;
    $('.left_menu > li:has(ul)').click(function(){
        $this=$(this);
        $this_ul=$this.find('ul');
        $this_arr=$this.find('.arrow_left_menu');
        $this_arr.fadeOut(duration/2, function(){
            $this_arr.fadeIn(duration/2).toggleClass('up');
        })
        $this_ul.slideToggle(duration);
        $this_arr.fadeOut(duration, function(){
            $this.toggleClass('active');
        })
        return false;
    });
    
    $('#fancy_button').click(function(){
        if ($('.fancy').length){
            $('.fancy').css({
                'height':$(document).height(),
                'opacity':'0.8'
            }).fadeIn(duration,function(){
                $('.fancy').removeClass('d_n')
            });
            $('.content_fancy').fadeIn(duration,function(){
                $('.fancy').removeClass('d_n')
            });
            $('.close').click(function(){
                $this=$(this);
                $this.parent().prev().add($this.parent()).fadeOut(duration,function(){
                    $('.fancy').addClass('d_n');
                    $('.content_fancy').addClass('d_n');
                });
            });
        }
        $('.fancy').click(function(){
            $('.close').click();
        });
    });
    
    $('body').keydown(function(event){
        if (event.which==27){
            $('.close').click();
        }
    });
    if ($.browser.webkit) $('.f_s_18.tahoma.m_r_23').css('top','4px');
    
    $('nav > ul > li:last-child').addClass('last_child');
    $('nav > ul > li').hover(
        function(){
            $(this).children('a').css('behavior','url(PIE/PIE.htc)');
        },
        function(){
            $(this).children('a').css('behavior','none');
        }
    );
});
$(window).load(function(){
    $("#jc_1").jCarouselLite({
        btnNext: "#right_arrow",
        btnPrev: "#left_arrow",
        mouseWheel: true,
        visible:4,
        circular:false
    });
});