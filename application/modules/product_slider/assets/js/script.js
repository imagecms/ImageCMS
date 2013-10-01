var hF = 586;
function margZoomLens() {
    $('#wrap').find('img').each(function() {
        var $this = $(this)
        mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2);
        mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);
        $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}.cloud-zoom-big{height: ' + (hF - $('.frame_w_desc').height() - 90) + 'px !important}')
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
    $('[data-rel="viewFancyProduct"]').click(function() {
        $(this).closest(genObj.parentBtnBuy).find(genObj.imgVC).closest('a').click();
    });
    try {
        $(".various").fancybox({
            'autoDimensions': false,
            'padding': 0,
            'height': hF,
            'width': 950,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            onStart: function() {
                $('#fancybox-content').after('<div style="position:absolute;left:0;top:0;z-index:10000;width:100%;height:100%;background-color:#fff;"></div>');
            },
            onComplete: function() {
                $('#fancybox-close').text(text.close);
                $('#fancybox-left, #fancybox-right').addClass('product_slider_PN');
                $("#fancybox-wrap").unbind('mousewheel.fb');

                var popupProduct = $('.popup_product');

                function heightDesrcCharc() {
                    var $rightFrameProduct = $('#right_popup_product'),
                    $whoClonded = '.frame_tabs',
                    frameWDesc = $('.frame_w_desc'),
                    $elWrapCH = $rightFrameProduct.find($whoClonded),
                    elWrapCHMH = hF - 90 - frameWDesc.height(),
                    $elWrapCHH = $elWrapCH.height(),
                    $elsCH = $elWrapCH.children();

                    if ($elWrapCHH > elWrapCHMH) {
                        var losth = 0;
                        $elsCH.each(function() {
                            var $this = $(this),
                            thisH = $this.outerHeight(),
                            dataH = parseInt(elWrapCHMH * $this.data('height') / 100);
                            $this.attr({
                                'data-height': dataH, 
                                'data-orig-height': thisH
                            });

                            if (dataH < thisH) {
                                $this.height(dataH);
                                $this.addClass('hideAfter');
                            }
                            else {
                                losth += dataH - thisH;
                            }
                        })
                        var lH = $elsCH.filter('.hideAfter'),
                        partH = losth / lH.length;
                        lH.each(function() {
                            var $this = $(this),
                            newH = $this.outerHeight() + partH;
                            $this.css('height', newH);
                            if (newH >= $this.attr('data-orig-height'))
                                $this.removeClass('hideAfter');
                        });
                    }
                    $elWrapCH.css('height', elWrapCHMH);
                }
                heightDesrcCharc();

                $('#photoGroup').click(function(e) {
                    e.preventDefault();
                });

                popupProduct.fadeIn(200, function(){
                    changeVariant(popupProduct);
                    if ($.exists('.lineForm')) {
                        cuSel(paramsSelect);
                    }

                    function thumbsPhotoToggle() {
                        $('.item_tovar .frame_thumbs > li > a').bind('click', function(e) {
                            var $this = $(this);
                            $this.parent().siblings().removeClass('active').end().addClass('active');
                            if (zoom_off == 0 && !isTouch) {
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
                    if (zoom_off == 0 && !isTouch) {
                        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
                        body.append('<style id="forCloudZomm"></style>')
                        margZoomLens();
                        $('#photoGroup').find('img').load(function() {
                            margZoomLens();
                        })
                    }

                    $('#fancybox-content').next().fadeOut(function() {
                        $(this).remove();
                    });
                });
            },
            onClosed: function() {
                $('#fancybox-close').text('');
                $('#fancybox-left, #fancybox-right').removeClass('product_slider_PN');
            }
        });
    } catch (err) {
    }
})