function margZoomLens() {
    $('#wrap').find('img').each(function() {
        var $this = $(this)
        mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2);
        mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);
        $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}')
    })
    $('.mousetrap').die('mouseover').live('mouseover', function() {
        var cloudzoomlens = $('.cloud-zoom-lens')
        if (cloudzoomlens.width() > $(genObj.photoProduct).width()) {
            $(this).remove();
            cloudzoomlens.remove();
            $('#xBlock').empty();
        }
    });
}
$(document).ready(function() {
    try {
        $(".various").fancybox({
            'autoDimensions': false,
            'padding': 0,
            'height': 586,
            'width': 950,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            onComplete: function() {
                $('#fancybox-close').text('Закрыть');
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                $("#fancybox-wrap").unbind('mousewheel.fb');

                function heightDesrcCharc() {
                    var $rightFrameProduct = $('#right_popup_product'),
                            $whoClonded = '.frame_tabs',
                            frameWDesc = $('.frame_w_desc'),
                            $elWrapCH = $rightFrameProduct.find($whoClonded),
                            elWrapCHMH = 586 - 90 - frameWDesc.height(),
                            $elWrapCHH = $elWrapCH.height(),
                            $elsCH = $elWrapCH.children();
                            console.log(frameWDesc.height());

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

                changeVariant($('.popup_product'));
                if ($.exists('.lineForm')) {
                    cuSel(paramsSelect);
                }

                function thumbsPhotoToggle() {
                    $('.item_tovar .frame_thumbs > li > a').bind('click', function(e) {
                        if (zoom_off == 1) {
                            var $this = $(this);
                            $this.parent().siblings().removeClass('active').end().addClass('active');
                            $('.mousetrap').remove();
                        }
                        else {
                            e.preventDefault();
                            $('#photoGroup').find('img').attr('src', $this.attr('href'));
                        }
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
                if (zoom_off == 1) {
                    $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
                    body.append('<style id="forCloudZomm"></style>')
                    margZoomLens();
                    $('#photoGroup').find('img').load(function() {
                        margZoomLens();
                    })
                }
            },
            onClosed: function() {
                $('#fancybox-close').text('');
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    } catch (err) {
    }
})