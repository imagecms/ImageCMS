var isTouch = 'ontouchstart' in document.documentElement;
var optionsMenu = {
    item: $('.menu-main td > .frame-item-menu > div'),
    duration: 400,
    drop: 'ul',
    itemSub: '.frame-item-menu > ul > li',
    frameSub: '.frame-item-menu > ul > li > div',
    effecton: 'fadeIn',
    effectoff: 'fadeOut'
};
var optionCompare = {
    left: '.leftDescription li',
    right: '.comprasion_tovars_frame > li',
    elEven: 'li',
    frameScroll: '.comprasion_tovars_frame',
    mouseWhell: false,
    scrollNSP: true,
    scrollNSPT: '.items_catalog',
    onlyDif: $('[data-href="#only-dif"]'),
    allParams: $('[data-href="#all-params"]'),
    hoverParent: '.characteristic'
};
var genObj = {
    textEl: '.text-el',//селектор
    frameCount: '.frame_count',//селектор
    parentBtnBuy: 'li, [data-rel="frameP"]',//селектор
    wishListIn: 'btn_cart',//назва класу
    compareIn: 'btn_cart',//назва класу
    toWishlist: 'toWishlist',//назва класу
    inWishlist: 'inWishlist',//назва класу
    toCompare: 'toCompare',//назва класу
    inCompare: 'inCompare',//назва класу
    tinyBask: 'tiny_bask',//назва класу
    isAvail: 'isAvail',//назва класу
    loginButton: '#loginButton',//селектор
    inCart: 'in_cart',//назва класу
    notAvail: 'not_avail',//назва класу
    btnBuy: 'btnBuy',//назва класу кнопка купити
    btnBuyCss: 'btn_buy',//назва класу
    btnCartCss: 'btn_cart',//назва класу
    descr: '.description',
    frameNumber: '.frame_number',
    frameVName: '.frame_variant_name',
    code: '.code'
}

function navPortait() {
    var frameM = $('.frame-menu-main');
    headerMenu = $('.headerMenu');

    $('.headerMenu').each(function() {
        var $this = $(this);
        if ($this.hasClass('navHorizontal')) {
            $('.frame-navbar').addClass('in');
            var headerFon = $('.headerFon'),
            heightFon = 0,
            temp_height = $this.find('> li').outerHeight();

            if ($this.hasClass('navVertical')) {
                $('.btn-navbar').hide();
                $this.removeClass('navVertical');
                $('.frame-navbar').addClass('in').show();
            }
            if (temp_height < $this.outerHeight()) {
                $('.btn-navbar').show();
                $('.frame-navbar').removeClass('in');
                $this.addClass('navVertical');
            }

            if ($.exists_nabir(frameM) && !frameM.children().hasClass('vertical')) {
                heightFon = frameM.offset().top + frameM.outerHeight(true)
                if ($.exists('.frame_baner'))
                    heightFon = $('.frame_baner').height() / 2 + $('.frame_baner').offset().top;
                headerFon.css({
                    'height': heightFon,
                    'top': 0
                });
            }
            else
                headerFon.css({
                    'height': $('.headerContent').outerHeight(true) + $('header').height(),
                    'top': 0
                });
        }
    });
}
    
function deleteComprasionItem(el){
    var $this = el,
    $thisI = $this.parents('li'),
    $thisP = $this.parents('[data-equalhorizcell]').last(),
    count_products = $thisP.find(optionCompare.right),
    gen_count_products = count_products.add($thisP.siblings().find(optionCompare.right)).length,
    count_productsL = count_products.length;
    
    $thisI.remove();
        
    if (count_productsL == 1) {
        var btn = $('[data-href="#'+$thisP.attr('id')+'"],[href="#'+$thisP.attr('id')+'"]').parent();
        $thisP.find(optionCompare.left).remove();
        
        if ($.exists_nabir(btn.next())) btn.next().children().click();
        else btn.prev().children().click();
                            
        btn.remove();
    }
    if (gen_count_products == 1){
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    
    $('.frame_tabsc > div').equalHorizCell('refresh');
}
function deleteWishListItem(el){
    if (el.parent().siblings().length == 0){
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    el.parent().remove();
}
def_min = $('span#opt1').data('def_min');
def_max = $('span#opt2').data('def_max');
cur_min = $('span#opt3').data('cur_min');
cur_max = $('span#opt4').data('cur_max');
$(document).ready(function() {
    $('.formCost input[type="text"], .number input').live('keypress', function(event) {
        var key, keyChar;
        if (!event)
            var event = window.event;

        if (event.keyCode)
            key = event.keyCode;
        else if (event.which)
            key = event.which;

        if (key == null || key == 0 || key == 8 || key == 13 || key == 9 || key == 46 || key == 37 || key == 39)
            return true;
        keyChar = String.fromCharCode(key);

        if (!/\d/.test(keyChar)) {
            $(this).tooltip();
            return false;
        }
        else
            $(this).tooltip('remove');
    });
    if (ltie7) {
        ieInput()
    }

    $('#slider').sliderInit({
        minCost: $('#minCost'),
        maxCost: $('#maxCost')
    });

    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    $('.menu-main').menuPacket2(optionsMenu);

    $('.drop').drop({
        overlayColor: '#000',
        overlayOpacity: '0.6',
        before: function(el, dropEl) {
            //check for drop-report
           
            if ($(dropEl).hasClass('drop-report')) {
                $(dropEl).removeClass('left-report').removeClass('top-right-report')
                
                if ($(el).offset().left < 322 - $(el).outerWidth()) {
                    $(el).attr('data-placement', 'bottom left');
                    $(dropEl).addClass('left-report');
                }
                else {
                    if ($(el).data('placement') != 'top right')
                        $(el).attr('data-placement', 'bottom right');
                }
                if ($(el).data('placement') == 'top right'){
                    $(dropEl).addClass('top-right-report');
                }
            
                $(dropEl).find(genObj.parentBtnBuy).remove();
                var elWrap = $(el).closest(genObj.parentBtnBuy).clone().removeAttr('style').removeAttr('class'),
                dropEl = $(dropEl).find('.drop-content');

                //adding product info into form
                var formCont = $('#data-report');
                var productId = $(el).attr('data-prodid');
                formCont.find('input[name="ProductId"]').val(productId)

                elWrap.find('.photo').prependTo(elWrap)
                
                $('.icon-times-enter').live('click', function(){
                    dropEl.parent().fadeOut(300);
                    $('.overlayDrop').fadeOut(100);
                });

                if (!dropEl.parent().hasClass('active')) {
                    if (!$.exists_nabir(dropEl.find('.frame-search-thumbail')))
                        dropEl.append('<ul class="frame-search-thumbail items"></ul>');
                    dropEl.find('.frame-search-thumbail').append(elWrap).find('.top_tovar, .btn, .frame_response, .tabs, .share_tov, .frame_tabs, .variantProd').remove().end().parent().find('[data-clone="data-report"]').remove().end().append($('[data-clone="data-report"]').clone().removeClass('d_n'));
                }
                return $(el);
            }
        },
        after: function(el, dropEl){
            
        }
    });
    $('.tabs').tabs({
        after: function(el) {
            if (el.parent().hasClass('comprasion_head')) {
                $('.frame_tabsc > div').equalHorizCell(optionCompare);
                if (optionCompare.onlyDif.parent().hasClass('active'))
                    optionCompare.onlyDif.click();
                else
                    optionCompare.allParams.click();
            }
        }
    });

    $('.frame_tabsc > div').equalHorizCell(optionCompare);
    $('[data-rel="plusminus"]').plusminus({
        prev: 'prev.children(:eq(1))',
        next: 'prev.children(:eq(0))'
    })

    try {
        $('a[rel="group"]').fancybox({
            'padding': 45,
            'margin': 0,
            'overlayOpacity': 0.7,
            'overlayColor': '#212024',
            'scrolling': 'no'
        })
    } catch (err) {
    }
});
wnd.load(function() {
    if ($('.cycle li').length > 1) {
        $('.cycle').cycle({
            speed: 600,
            timeout: 2000,
            fx: 'fade',
            pager: '.cycle .nav',
            pagerEvent: 'click',
            pauseOnPagerHover: true,
            next: '.frame_baner .next',
            prev: '.frame_baner .prev',
            pager:      '.pager',
            pagerAnchorBuilder: function(idx, slide) {
                return '<a href="#"></a>';
            }
        }).hover(function() {
            $('.cycle').cycle('pause');
        }, function() {
            $('.cycle').cycle('resume');
        });
    }

    $('.carousel_js:not(.vertical_carousel)').myCarousel({
        item: 'li',
        prev: '.btn_prev',
        next: '.btn_next',
        content: '.carousel',
        before: function(){
            var sH = 0;
            var brandsImg = $('.frame_brand img')
            if ($.exists_nabir(brandsImg.closest('.carousel_js'))){
                brandsImg.each(function(){
                    var $thisH = $(this).height()
                    if ($thisH > sH) sH = $thisH;
                })
                $('.frame_brand .helper').css('height', sH);
            }
        }
    });
    wnd.resize(function() {
        navPortait();
        $('.frame_tabsc > div').equalHorizCell('refresh');
        $('.menu-main').menuPacket2('refresh');
        var btn_not_avail = $('.btn_not_avail.active');
        if (btn_not_avail.length != 0)
            btn_not_avail.drop('positionDrop');
    })
    
    navPortait();
    var d_r_f_item = $('[data-radio-frame]');
    $('.list_pic_btn > .btn').click(function() {
        var $this = $(this);
        if ($this.hasClass('showAsList')) {
            d_r_f_item.addClass('list');
            setcookie('listtable', $this.index(), 1, '/');
        }
        else {
            d_r_f_item.removeClass('list');
            setcookie('listtable', $this.index(), 0, '/');
        }
        $this.siblings().removeClass('active').end().addClass('active');
    });
    
    var itemThumbs = $('.item_tovar .frame_thumbs > li');
    if ($.exists_nabir(itemThumbs)) {
        itemThumbs.click(function() {
            var $this = $(this);
            $this.addClass('active').siblings().removeClass('active');
        })
        $('.fancybox-next').live('click', function() {
            $this = itemThumbs.filter('.active');
            if (!$this.is(':last-child'))
                $this.removeClass('active').next().addClass('active')
            else
                itemThumbs.first().click()
        })
        $('.fancybox-prev').live('click', function() {
            $this = itemThumbs.filter('.active');
            if (!$this.is(':first-child'))
                $this.removeClass('active').prev().addClass('active')
            else
                itemThumbs.last().click()
        })
    }
    var fr_lab_l = $('.frameLabel').length;
    $('.frameLabel').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': fr_lab_l - index
        })
    });
    $('#suggestions').autocomlete();
    $('.btn-navbar').click(function() {
        var frameNavBar = $('.frame-navbar');
        if (!frameNavBar.hasClass('in'))
            frameNavBar.addClass('in').show();
        else
            frameNavBar.removeClass('in').hide();
    });
    /* Refresh when remove item from Compare */
    $('.frame_tabsc > div').equalHorizCell('refresh');
    /* End. Refresh when remove item from Compare */

    /*fancybox-based imagebox initialization*/
    try{
        $('a.fancybox').fancybox();
    }catch(err){}
    
});
