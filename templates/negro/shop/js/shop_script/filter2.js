(function($){
    var methods = {
        init : function(options) {
            if ($.exists_nabir(this)){
                var settings = $.extend({}, options);
                
                var rel = $(this),
                body = $(' body'),
                minCost = settings.minCost,
                maxCost = settings.maxCost;
                
                if (options.minCost === '' || options.maxCost === '') {
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
                        if ($(ui.handle).is('#left_slider')) $(ui.handle).tooltip({
                            'title':ui.values[0], 
                            'effect':'always', 
                            'otherClass':'tooltip-slider'
                        });
                        if ($(ui.handle).is('#right_slider')) $(ui.handle).tooltip({
                            'title':ui.values[1], 
                            'effect':'always', 
                            'otherClass':'tooltip-slider'
                        })
                        minCost.val(ui.values[0]);
                        maxCost.val(ui.values[1]);
                    },
                    stop: function(ui){
                        //ajaxRecount($(ui.target).attr('id'), true);
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
                minCost.add(maxCost).change(function(){
                    //ajaxRecount(slider.attr('id'), true);
                })
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
            cleaverFilterObj = {
                mainWraper: $(this),
                elClosed: $('.icon-times-apply'),
                elCount: $('#apply-count'),
                effectIn: 'fadeIn',
                effectOff: 'fadeOut',
                duration: '300',
                location: 'right',
                elPos: $('.block-filter .frame-label'),
                cleverFilterFunc: function(elPos, countTov, clas){
                    cleaverFilterObj.mainWraper.hide()
                    var left=0;
        
                    if (cleaverFilterObj.location == 'right') left = elPos.width()+elPos.offset().left;
                    if (cleaverFilterObj.location == 'left') left = elPos.offset().left-cleaverFilterObj.mainWraper.actual('width');
       
                    cleaverFilterObj.mainWraper.css({
                        'left': left, 
                        'top': elPos.offset().top
                    }).removeClass().addClass('apply').addClass(clas);
                    cleaverFilterObj.elCount.text(countTov);
        
                    cleaverFilterObj.mainWraper[cleaverFilterObj.effectIn](cleaverFilterObj.duration);
                }
            };
            (function (){
                cleaverFilterObj.elClosed.click(function(){
                    methods.triggerBtnClick();
                })
                $('body').live('click', function(event) {
                    event.stopPropagation();
                    if ($(event.target).parents().is(cleaverFilterObj.mainWraper) || $(event.target).is(cleaverFilterObj.mainWraper) || $(event.target).parents().is(cleaverFilterObj.elPos) || $(event.target).is(cleaverFilterObj.elPos)) return;
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
            })()
        },
        triggerBtnClick: function(){
            cleaverFilterObj.mainWraper[cleaverFilterObj.effectOff](cleaverFilterObj.duration);
        }
    };
    $.fn.cleaverFilterMethod = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.cleaverFilterMethod' );
        }
    }
})(jQuery);
function afterAjaxInitializeFilter(){
    var apply = $('.apply');
    slider = $('#slider');
    catalogForm = $('#catalog_form');
    slider.sliderInit({
        minCost: $('#minCost'),
        maxCost: $('#maxCost')
    });
    $(".block-filter").nStCheck({
        wrapper: $(".frame-label:has(.niceCheck)"),
        elCheckWrap: '.niceCheck',
        evCond:true,
        before: function(a, b, c){
            c.nStCheck('changeCheck');
            ajaxRecount(b.attr('id'), false);
        }
    });
    apply.cleaverFilterMethod();
    apply.find('a').click(function(){
        catalogForm.submit();
        return false;
    });

}
function ajaxRecount(el, slChk) {
    /*
    var $this = el,
    slChk = slChk;
    
    $cur_url = $('input[name=requestUri]').val();
       
    $.ajax({
        type: 'get',
        url: $cur_url,
        data: catalogForm.serialize(),
        beforeSend: function(){
            $.fancybox.showActivity();
        },
        success: function(msg){
            var otherClass = '';
            catalogForm.find('.popup_container').html(msg);
            afterAjaxInitializeFilter();
            $.fancybox.hideActivity();

            if (slChk) otherClass = 'apply-slider';
            
            cleaverFilterObj.cleverFilterFunc($('#'+$this), totalProducts, otherClass);
        }
    });    
    return false;
    */
   catalogForm.submit();
}
$(document).ready(function(){
    afterAjaxInitializeFilter();
});