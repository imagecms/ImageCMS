$(document).ready(function() {
    try{
        $(".various").fancybox({
            'autoDimensions': false,
            'padding'       : 0,
            'width'         : 840,
            'height'        : 650,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            onComplete: function(){
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                    
            },
            onClosed: function(){
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    }catch(err){}
});