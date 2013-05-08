$(document).ready(function() {
    try{
        var kW = 0.8;
        $(".various").fancybox({
            'autoDimensions': false,
            'padding'       : 0,
            'height'        : 650,
            'width': $(document).width()*kW,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            onComplete: function(){
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                $("#fancybox-wrap").unbind('mousewheel.fb');
                
                function heightDesrcCharc(){
                    var $rightFrameProduct = $('#right_popup_product'),
                    $whoClonded = '.frame_tabs',
                    $rightFrameProductW = ($(document).width()*kW-parseInt($rightFrameProduct.css('padding-left'))*2)*$rightFrameProduct.data('width')/100-9,
                    $elWrapCH = $rightFrameProduct.find($whoClonded),
                    $elWrapCHH = $elWrapCH.css('width', $rightFrameProductW).actual('height'),
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
                }
                heightDesrcCharc();
                
                $('#photoGroup').click(function(e){
                    e.preventDefault();
                }).after('<br/>');
                
                $('.popup_product').fadeIn(200);
                
                if ($.exists('.lineForm')) {
                    cuSel(paramsSelect);
                }
                
                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
                
                function thumbsPhotoToggle(){
                    $('.item_tovar .frame_thumbs > li > a').bind('click', function(e){
                        var $this = $(this);
                        $this.parent().siblings().removeClass('active').end().addClass('active');
                    
                        //if cloudZomm not initialize
                        e.preventDefault();
                        $('#photoGroup').find('img').attr('src', $this.attr('href'));
                    })
                }
                thumbsPhotoToggle();
                
                processPage();
                checkSyncs();
                processWish();
                recountCartPage();
            },
            onClosed: function(){
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    }catch(err){}
});