$(document).ready(function(){
    if (ltie7){
        ieInput()
    }
    if (ltie8){
        
    }
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
    
    $(".frame_label:has(.niceRadio)").live('click', function() {
        var $this = $(this);
        changeRadio($this.find('> span:eq(0)'));
    });
    
    $('.menu-main').menuPacket2({
        item: $('.menu-main').find('td'),
        duration: 300,
        drop: '.frame-item-menu > ul',
        dropWidth: 456
    })
    
    $(".items-complect").nStCheck({
        wrapper: $(".frame-label:has(.niceCheck)"),
        elCheckWrap: '.niceCheck'
    });
    
    $('.drop').drop();

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
            'padding' : '15px',
            'margin' : 0,
            'overlayOpacity' : 0.7,
            'overlayColor' : '#000',
            'showNavArrows' : true,
            'scrolling' : 'no'
        })
    }catch(e){}
    
    listtable();
    
    $('[data-rel="cloneAddPaste"]').cloneAddPaste({
        pasteAfter: 'parent.parent',
        pasteWhat: $('[data-rel="whoCloneAddPaste"]'),
        evPaste: 'click',
        effectIn: 'slideDown',
        effectOff: 'slideUp',
        duration: 300,
        wherePasteAdd: 'form',
        whatPasteAdd: '<input type="hidden" name="bla-bla">',
        before: function(el){
            el.find('.icon-replay-comment').toggleClass('icon-replay-comment2')
        },
        after: function(el, elInserted){

        }
    });
    
    $('.tabs').tabs({
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
            el.children('div').css('width', starW*value)
        }
    });
    $('.niceRadio').nStRadio({
        after:function(input){
            console.log(input);
        }
    });
    //видалити
    $('.compareDelete').click(function(){
        $(this).parents('li').remove();
        $('.frame-tabs-ref > div').equalHorizCell('refresh');
    });
    try{
        $('.cycle ul').cycle({
            fx:         'fade',
            timeout:    3500,
            next: '#next_slide',
            prev: '#prev_slide',
            pager:      '.pager',
            pagerAnchorBuilder: function(idx, slide) { 
                return '<a href="#"></a>'            ; 
            }
        })
    }catch(e){}
})

def_min = 0;
def_max = 10000;
cur_min = 2000;
cur_max = 10000;
totalProducts = 5;