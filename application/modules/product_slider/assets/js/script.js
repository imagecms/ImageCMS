function margZoomLens() {
    $('#wrap').find('img').each(function() {
        var $this = $(this)
        mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2);
        mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);
        $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}')
    })
}
$(document).ready(function() {
    try {
        var kW = 0.6;
        $(".various").fancybox({
            'autoDimensions': false,
            'padding': 0,
            'height': 586,
            'width': 950,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            onComplete: function() {
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                $("#fancybox-wrap").unbind('mousewheel.fb');

                function heightDesrcCharc() {
                    var $rightFrameProduct = $('#right_popup_product'),
                            $whoClonded = '.frame_tabs',
                            frameWDesc = $('.frame_w_desc'),
                            $rightFrameProductW = ($(document).width() * kW - parseInt($rightFrameProduct.css('padding-left')) * 2) * $rightFrameProduct.data('width') / 100 - 9,
                            $elWrapCH = $rightFrameProduct.find($whoClonded),
                            elWrapCHMH = 586 - 90 - frameWDesc.css('width', $rightFrameProductW).actual('height'),
                            $elWrapCHH = $elWrapCH.css('width', $rightFrameProductW).actual('height'),
                            $elsCH = $elWrapCH.children();

                    if ($elWrapCHH > elWrapCHMH) {
                        var lostH = $elWrapCHH - elWrapCHMH;
                        $elsCH.each(function() {
                            var $this = $(this),
                                    $thisI = $this.index(),
                                    thisH = $($whoClonded).filter('.cloned').children().eq($thisI).height();

                            if ($this.data('height') < thisH) {
                                $this.height(thisH - lostH);
                                $this.addClass('hideAfter');
                            }
                        })
                    }
                    $elWrapCH.css('height', elWrapCHMH);
                }
                heightDesrcCharc();

                $('#photoGroup').click(function(e) {
                    e.preventDefault();
                });

                $('.popup_product').fadeIn(200);

                if ($.exists('.lineForm')) {
                    cuSel(paramsSelect);
                }

                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();

                function thumbsPhotoToggle() {
                    $('.item_tovar .frame_thumbs > li > a').bind('click', function(e) {
                        var $this = $(this);
                        $this.parent().siblings().removeClass('active').end().addClass('active');
                        $('.mousetrap').remove();

                        //if cloudZomm not initialize
//                        e.preventDefault();
//                        $('#photoGroup').find('img').attr('src', $this.attr('href'));
                    })
                }
                thumbsPhotoToggle();

                processPage();
                checkSyncs();
                processWish();
                recountCartPage();
                checkCompareWishLink();
                wishListCount();
                compareListCount();

                initBtnBuy();
                margZoomLens();
                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
                body.append('<style id="forCloudZomm"></style>')
                $('#photoGroup').find('img').load(function() {
                    console.log(1)
                    margZoomLens();
                })
            },
            onClosed: function() {
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    } catch (err) {
    }
})