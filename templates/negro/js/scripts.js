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
$(document).ready(function(){
    if (ltie7){
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
        ieInput()
    }
    if (ltie8){
        
    }
    $('.formCost input[type="text"], .number input').live('keypress', function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        if (event.keyCode) key = event.keyCode;
        else if(event.which) key = event.which;

        if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==35 || key==36 || key==37 || key==39 ) return true;
        keyChar=String.fromCharCode(key);

        if(!/\d/.test(keyChar))	{
            $(this).tooltip();
            return false;
        }
        else $(this).tooltip('remove');
    });
    
    $(".frame_label:has(.niceRadio)").live('click', function() {
        var $this = $(this);
        changeRadio($this.find('> span:eq(0)'));
    });
    
    $('.menu-main').menuPacket2({
        item: $('.menu-main').find('td'),
        duration: 300,
        drop: '.frame-item-menu > ul',
		dropWidth:456,
		countColumn:4 //if not drop-side
    })
	
    
    $(".items-complect").nStCheck({
        wrapper: $(".frame-label:has(.niceCheck)"),
        elCheckWrap: '.niceCheck'
    });
    
     $('.hel-tit').click(function(){     
        $(this).next().slideToggle('300').end().toggleClass('up');
    });
    
    try{
        var params = {
            changedEl: ".lineForm select",
            visRows: 15,
            scrollArrows: true
        }
        cuSel(params);
    }catch(e){}
    try{
        $('[rel="group"]').fancybox({
            'padding' : 0,
            'margin' : 0,
            'overlayOpacity' : 0.7,
            'overlayColor' : '#000',
            'showNavArrows' : true,
            'scrolling' : 'no'
        })
    }catch(e){}

    $('.tabs').tabs({
	effectIn: 'fadeIn',
	after: function(el){
            if (el.parent().hasClass('comprasion_head')){
                $('.frame-tabs-ref > div').equalHorizCell(optionCompare);
                if (optionCompare.onlyDif.parent().hasClass('active')) optionCompare.onlyDif.click();
                else optionCompare.allParams.click();
            }
        }
	});
	
    $('.frame-tabs-ref > div').equalHorizCell(optionCompare);
    
    $('#suggestions').autocomlete();
	
	$(".star-big").starRating({
        width:26,
        afterClick: function(el, value, starW){
            el.children('div').css('width', starW*value);
            setRatec(value);
        }
    });
	
	$('.btn-cleaner').live('click', function(){
		var $this = $(this);
		if ($this.hasClass('disabled')) $this.tooltip();
		setTimeout(function(){$this.tooltip('remove')}, 1500)
	});
})
$(window).load(function(){
    $('.carousel_js').myCarousel({
        item: 'li',
        prev: '.prev',
        next: '.next',
        content: '.content-carousel',
        before: function(){
            var sH = 0;
            var brandsImg = $('.items-brands img')
            if ($.exists_nabir(brandsImg.closest('.carousel_js'))){
                $('.items-brands img').each(function(){
                    var $thisH = $(this).height()
                    if ($thisH > sH) sH = $thisH;
                })
                $('.items-brands .helper').css('height', sH);
            }
        }
    });
})