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
                
                var $mainFrameProduct = $('.popup_product'),
                $whoClonded = '.frame_tabs',
                $mainFrameProductW = ($(document).width()*0.8-parseInt($mainFrameProduct.css('padding-left'))*2)*$mainFrameProduct.data('width')/100-9,
                $elWrapCH = $mainFrameProduct.find($whoClonded),
                $elWrapCHH = $elWrapCH.css('width', $mainFrameProductW).actual('height'),
                $elsCH = $elWrapCH.children(),
                elWrapCHMH = $elWrapCH.data('height');
                
                if ($elWrapCHH > elWrapCHMH){
                    var lostH = $elWrapCHH-elWrapCHMH;
                    $elsCH.each(function(){
                        var $this = $(this),
                        $thisI = $this.index(),
                        thisH = $($whoClonded).filter('.cloned').children().eq($thisI).height();
                        
                        if ($this.data('height') < thisH){
                            $this.height(thisH-lostH);
                        }
                    })
                }
                $elWrapCH.css('height', elWrapCHMH);
                
                $('.popup_product').fadeIn(200);
                
                if ($.exists('.lineForm')) {
                    cuSel(paramsSelect);
                }
                
                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
                
                $('.item_tovar .frame_thumbs > li > a').bind('click', function(event){
                    var $this = $(this);
                    $this.parent().siblings().removeClass('active').end().addClass('active');
                    
                    //if cloudZomm not initialize
                        //event.preventDefault();
                        //$('#photoGroup').find('img').attr('src', $this.attr('href'));
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