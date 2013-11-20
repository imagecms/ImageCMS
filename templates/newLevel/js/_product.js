var productPhotoCZoom = window.productPhotoCZoom != undefined,
productPhotoDrop = window.productPhotoDrop != undefined;

function tovarChangeVariant(el) {
    el = el == undefined ? body : el;
    /*Variants in Product*/
    el.find('#variantSwitcher').on('change', function() {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy),
        btnInfo = liBlock.find(genObj.prefV + productId + ' ' + genObj.infoBut),
        vId = btnInfo.attr('data-id'),
        vName = btnInfo.attr('data-vname'),
        vNumber = btnInfo.attr('data-number'),
        vPrice = btnInfo.attr('data-price'),
        vAddPrice = btnInfo.attr('data-addPrice'),
        vOrigPrice = btnInfo.attr('data-origPrice'),
        vLargeImage = btnInfo.attr('data-largeImage'),
        vMainImage = btnInfo.attr('data-mainImage'),
        vStock = btnInfo.attr('data-maxcount');
        
        if (vMainImage.search(/nophoto/) == -1){
            $(genObj.photoProduct).add($(genObj.mainThumb)).attr('href', vLargeImage);
           
            $(genObj.imgVP).attr({
                'src': vMainImage,
                'alt': vName
            });
            $('.left-product .items-thumbs > li').removeClass('active').filter(':eq(0)').addClass('active');
        }
       
        if (vOrigPrice != '')
            liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.priceAddPrice).html(vAddPrice);
        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        condProduct(vStock, liBlock, btnInfo);
        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
        
        $('.mousetrap').remove();
        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
    });
/*/Variants in Product*/
}
function resizePhoto(drop, s, c) {
    var fancyFrame = $(hrefOptions.placeHref).parent(),
    img = fancyFrame.find('img');
    fancyFrame.css('height', '');
    img.css({
        'width': img.actual('width'), 
        'height': img.actual('height')
    });
    var dropV = drop.is(':visible') ? true : false;
    hD = dropV ? drop.height() : drop.actual('height');
    var dropH = hD > wnd.height() ? wnd.height() : hD,
    hNotC = 0;
    if (s != undefined)
        s();
    $(hrefOptions.header).add($(hrefOptions.footer)).add($(hrefOptions.gallery)).each(function(){
        hNotC += dropV ? $(this).outerHeight() : $(this).actual('outerHeight');
    });
    $(hrefOptions.header).add($(hrefOptions.footer)).add($(hrefOptions.gallery))
    mayHC = dropH - hNotC;
    fancyFrame.css({
        'height': mayHC - (fancyFrame.outerHeight() - fancyFrame.height())
    })
    img.css({
        'width': '', 
        'height': ''
    });
    if (c != undefined)
        c();
    $.drop('dropCenter')(drop);
}

function changePhoto(arg, fancyFrameInPH, href) {
    hrefOptions.curHref = href;
    var drop = arg[1];
    fancyFrameInPH.parent().addClass('p_r');
    fancyFrameInPH.after('<div class="preloader"></div>');
    $('<img src="' + href + '">').load(function(){
        $(hrefOptions.placeHref).find('img').remove();
        fancyFrameInPH.nextAll('.preloader').remove();
        fancyFrameInPH.after($(this).css('visibility', 'visible').hide().fadeIn());
        
        var carGal = drop.find('.content-carousel');
        
        $.drop('limitSize')(drop);
        resizePhoto(drop, function(){
            carGal.parent().myCarousel($.extend({}, carousel, {
                'adding':{
                    start: $.inArray(hrefOptions.curHref, hrefOptions.thumbs)
                }
            }));
            $.drop('dropCenter')(drop);
        });
    })
}
function beforeShowHref(el, drop, isajax, data, elSet) {
    var arg = arguments,
    cycle = hrefOptions.cycle;
    var obj = $.extend({}, elSet, hrefOptions, el.closest(genObj.parentBtnBuy).find(genObj.infoBut).data());
    frame = $('#photo');
    frame.html(_.template($('#framePhotoProduct').html(), obj));
    
    tovarChangeCount(frame);
    btnbuyInitialize(frame);
    processBtnBuyCount(frame);
    
    var next = $(hrefOptions.next),
    prev = $(hrefOptions.prev),
    img = $(hrefOptions.placeHref).find('img');
    hrefOptions.curHref = img.attr('src');
    
    var fancyFrameInPH = $(hrefOptions.placeHref).find('.helper');
    
    function condBtn(acA) {
        if (!cycle) {
            if (acA == 0)
                prev.attr('disabled', 'disabled');
            if (acA == itemGalL - 1)
                next.attr('disabled', 'disabled');
        }
    }
    function btnSClick(btn) {
        itemGal.removeClass('active');
        if (btn.is(prev))
            next.removeAttr('disabled');
        else
            prev.removeAttr('disabled');
        acA = ($.inArray(hrefOptions.curHref, hrefOptions.thumbs));
        if (btn.is(prev)) {
            if (cycle) {
                if (acA != 0)
                    acA = acA - 1;
                else
                    acA = itemGalL - 1;
            }
            else {
                if (acA != 0)
                    acA = acA - 1;
                if (acA == 0)
                    prev.attr('disabled', 'disabled');
            }
        }
        else {
            if (cycle) {
                if (acA != itemGalL - 1)
                    acA = acA + 1;
                else
                    acA = 0;
            }
            else {
                if (acA != itemGalL - 1)
                    acA = acA + 1;
                if (acA == itemGalL - 1)
                    next.attr('disabled', 'disabled');
            }
        }
        thumbsA.eq(acA).parent().addClass('active');
        changePhoto(arg, fancyFrameInPH, hrefOptions.thumbs[acA]);
    }
    
    var carGal = drop.find('.content-carousel');
    
    if ($.existsN(carGal.find('.items-thumbs').children())){
        carGal.closest('.horizontal-carousel').show();
        var itemGal = carGal.find('.items-thumbs > li').removeClass('active'),
        itemGalL = itemGal.length,
        thumbsA = itemGal.find('a');
        hrefOptions.thumbs = new Array();
        
        thumbsA.each(function() {
            hrefOptions.thumbs.push($(this).attr('href'))
        });
        
        var btns = prev.add(next).removeAttr('disabled').fadeIn(),
        acA = ($.inArray(img.attr('src'), hrefOptions.thumbs));
        itemGal.eq(acA).addClass('active');

        var itemGalUl = itemGal.parent();
        if ($.existsN(itemGalUl.parent('.jcarousel-clip')))
            itemGalUl.unwrap();
        
        thumbsA.off('click').on('click', function(e) {
            btns.removeAttr('disabled');
            itemGal.removeClass('active');
            $(this).parent().addClass('active')
            var href = $(this).attr('href'),
            acA = ($.inArray(href, hrefOptions.thumbs));
            e.preventDefault();
            changePhoto(arg, fancyFrameInPH, href);
            condBtn(acA);
        })
        btns.off('click').on('click', function(e) {
            btnSClick($(this))
        });
        condBtn(acA);
    }
    else
        carGal.closest('.horizontal-carousel').hide();
 
    wnd.unbind('resize.photo').bind('resize.photo', function() {
        resizePhoto(drop);
    });
}
function afterClosedPhoto(el, drop){
    drop.find('.addingphoto').remove();
}
function onComplete(el, drop, isajax, data, elSet) {
    drop.find('[data-drop]').drop(optionsDrop);
    
    var carGal = drop.find('.content-carousel');
    drop.find('.drop-content-photo img').css('visibility', 'visible');
    
    $.drop('limitSize')(drop);
    resizePhoto(drop, function(){
        carGal.parent().myCarousel($.extend({}, carousel, {
            'adding':{
                'start': $.inArray(hrefOptions.curHref, hrefOptions.thumbs)
            },
            after: function(el){
                el.find('ul').css('visibility', 'visible');
            }
        }));
    })
}

var hrefOptions = {
    next: '#photo .drop-content-photo .next',
    prev: '#photo .drop-content-photo .prev',
    placeHref: '#photo .drop-content-photo .inside-padd',
    header: '#photo .drop-header',
    footer: '#photo .drop-footer',
    gallery:  '#photo .frame-fancy-gallery',
    cycle: false,
    //    'frame' and other in extend optionsPhoto and this object
    footerContent: '.frame-prices-buy',
    galleryContent: '.items-thumbs'
};
var optionsPhoto = {
    effectOn: 'fadeIn',
    drop: '#photo',
    size: false,
    after: 'onComplete',
    before: 'beforeShowHref',
    closed: 'afterClosedPhoto'
};
function initPhoto(){
    if (productPhotoCZoom) {
        function margZoomLens() {
            $(genObj.photoProduct).find('img').each(function() {
                var $this = $(this),
                mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2),
                mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);
                $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}')
            })
            $('.left-product').off('mouseover', '.mousetrap').on('mouseover', '.mousetrap', function() {
                var cloudzoomlens = $('.cloud-zoom-lens');
                if (cloudzoomlens.width() > $(genObj.photoProduct).width()) {
                    $(this).remove();
                    cloudzoomlens.remove();
                    $('#xBlock').empty();
                }
            });
        }
    }

    if (productPhotoCZoom) {
        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
        body.append('<style id="forCloudZomm"></style>');
        margZoomLens();
        $(genObj.photoProduct).find('img').load(function() {
            margZoomLens();
        })
    }
    $('.item-product .items-thumbs > li > a').on('click.thumb', function(e) {
        e.preventDefault();
        var $this = $(this),
        href = $this.attr('href');
        
        $this.parent().siblings().removeClass('active').end().addClass('active');
        $(genObj.photoProduct).attr('href', href).find('img').attr('src', href);
    });
    if (productPhotoDrop) {
        $(genObj.photoProduct).on('click', function(){
            photo = $(this);
            photo.data($.extend({
                'frame': photo.closest(genObj.parentBtnBuy),
                'mainPhoto': photo.attr('href'), 
                'title': photo.attr('title')
            }, optionsPhoto)).drop(optionsDrop).trigger('click.drop').off('click.drop');
        })
    }
    if (productPhotoDrop && productPhotoCZoom) {
        $('.left-product').on('click.mousetrap', '.mousetrap', function() {
            var $this = $(this),
            photo = $this.prev();
            $this.data($.extend({
                'frame': photo.closest(genObj.parentBtnBuy), 
                'mainPhoto': photo.attr('href'), 
                'title': photo.attr('title')
            }, optionsPhoto)).drop(optionsDrop).trigger('click.drop');
        });
    }
}
function initPhotoTrEv(){
}
$(document).on('scriptDefer', function(){
    initPhoto();
    cuselInit(body, '#variantSwitcher');
    tovarChangeVariant();
})