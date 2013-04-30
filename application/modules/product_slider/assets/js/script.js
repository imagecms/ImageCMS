$(document).ready(function() {
    try{
        $(".various").fancybox({
            'autoDimensions': false,
            'padding'       : 0,
            'height'        : 650,
            'width': $(document).width()*0.8,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            onComplete: function(){
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                $('.popup_product');
                
                $('.popup_product').fadeIn(200);
                
                if ($.exists('.lineForm')) {
                    cuSel(paramsSelect);
                }
                
                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({
                 'zoomWidth':$('.item_tovar .span7').width(),
                 'adjustY': $('.pos_cloud_big').position().top
                });
                $('.item_tovar .frame_thumbs > li > a').bind('click', function(){
                    $(this).parent().siblings().removeClass('active').end().addClass('active');
                    $('#cloud-zoom-big').css('width', $('.item_tovar .span7').width());
                })
                $('#photoGroup').after('<br/>')
                
                processPage();
                checkSyncs();
                processWish();
                recountCartPage();
                
                $("#fancybox-wrap").unbind('mousewheel.fb');
            },
            onClosed: function(){
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    }catch(err){}
});