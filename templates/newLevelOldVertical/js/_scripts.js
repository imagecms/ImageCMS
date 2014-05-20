function init() {
    var doc = $(document);

    body.removeClass('not-js');
    if (isTouch)
        body.addClass('isTouch');
    else
        body.addClass('notTouch');

    /*call general functions and plugins*/
    cuselInit(body, '#sort, #sort2, #compare, [id ^= сVariantSwitcher_]');
    /*call general functions and plugins*/

    /*call functions for shop objects*/
    global.checkSyncs();
    ShopFront.Cart.processBtnBuyCount();
    ShopFront.Cart.initShopPage(false);
    ShopFront.Cart.changeVariant();
    DiscountFront.getDiscount('start');
    global.processWish();
    ShopFront.CompareList.process();

    /*changecount product in category and product*/
    ShopFront.Cart.changeCount($('.items-catalog, .item-product'));
    /*/changecount product in category and product*/
    /*/ call functions for shop objects*/

    /*call front plugins and functions*/
    if (ltie7) {
        ieBoxSize();
        ieBoxSize($('.photo-block, .frame-baner-start_page .content-carousel, .cloud-zoom-lens, .items-user-toolbar'));
    }
    optionsDrop.before = function(el, drop, isajax) {
        drop.find('label.' + genObj.err + ', label.' + genObj.scs).hide();
        drop.find(':input').removeClass(genObj.scs + ' ' + genObj.err);

        if (drop.hasClass('drop-report')) {
            var dropRep = drop.find('[data-rel="pastehere"]');
            dropRep.html(_.template($('#reportappearance').html(), {
                item: Shop.Cart.composeCartItem(el)
            }));

            dropRep.append($('[data-clone="data-report"]').find(genObj.msgF).remove().end().clone(true).removeClass('d_n'));
            dropRep.find('input[name="ProductId"]').val(el.data('prodid'));
        }

        try {
            var fAS = $('.frame-already-show'),
            zInd = parseFloat(fAS.data('drp').dropOver.css('z-index'));
            fAS.prev().css('z-index', zInd + 3).closest('.frame-user-toolbar').css('z-index', zInd + 1);
        } catch (err) {
        }
    };
    optionsDrop.after = function(el, drop, isajax) {
        drawIcons(drop.find(selIcons));

        drop.find("img.lazy:not(.load)").lazyload(lazyload);
        wnd.scroll(); //for lazyload

        if (drop.hasClass('drop-wishlist')) {
            drop.nStRadio({
                wrapper: $(".frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
        }
        if ($.existsN(drop.find('[onsubmit*="ImageCMSApi"]'))) {
            var input = drop.find('form input[type="text"]:first');
            input.setCursorPosition(input.val().length);
        }
        var carouselInDrop = drop.find('.carousel-js-css');
        if ($.existsN(carouselInDrop) && !carouselInDrop.hasClass('visited') && !drop.is('#photo')) {
            carouselInDrop.addClass('visited');
            carouselInDrop.myCarousel(carousel);
        }
        cuselInit(drop, '.drop:visible .lineForm select');
    };
    optionsDrop.close = function(el, drop, data) {
    };
    optionsDrop.closed = function(el, drop, data) {
        if (drop.hasClass('frame-already-show')) {
            $('.frame-user-toolbar').css('z-index', '');
            drop.prev().css('z-index', '');
        }
    };
    $('.menu-main').menuImageCms(optionsMenu);
    $('.footer-category-menu').find('[href="' + $('.frame-item-menu.active > .frame-title > .title').attr('href') + '"]').parent().addClass('active');
    $.drop.setParameters(optionsDrop);
    $.drop.extendDrop('droppable', 'noinherit', 'heightContent', 'scroll', 'limitSize');
    $('[data-drop]').drop();

    ShopFront.CompareList.count();
    global.wishListCount();
    $('.tabs').tabs({
        after: function(el) {
            if (el.hasClass('tabs-compare-category')) {
                optionCompare.compareChangeCategory();
            }
            if (el.hasClass('tabs-list-table')) {
                decorElemntItemProduct();
            }
            if (el.hasClass('tabs-product')) {
                showHidePart($('.patch-product-view'));
                showHidePart($('.frame-list-comments.sub-2'));
            }
            wnd.scroll();
        }
    });

    $('#suggestions').autocomplete({
        minValue: 3,
        blockEnter: false
    });
    drawIcons($(selIcons));
    showHidePart($('.sub-category'));
    showHidePart($('.patch-product-view'));
    showHidePart($('.frame-list-comments.sub-2'));
    var userTool = new itemUserToolbar(),
    btnToUp = $('.btn-to-up');
    btnToUp.click(function() {
        $("html, body").animate({
            scrollTop: "0"
        });
    });
    userTool.show($('.items-user-toolbar'), $('.btn-toggle-toolbar > button'), '.box-1, .box-2, .box-3', btnToUp);
    userTool.resize($('.frame-user-toolbar'), btnToUp);
    if ($.existsN($('.animateListItems.table')))
        decorElemntItemProduct();
    var frLabL = $('.frame-label').length;
    $('.frame-label:has(.lineForm)').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': frLabL - index
        });
    });
    initCarouselJscrollPaneCycle(body);

    reinitializeScrollPane(body);
    testNumber();
    $("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazy load start initialize
    /*/call front plugins and functions*/

    /*sample of events shop*/
    var catalogForm = $('#catalogForm');
    $('#sort').on('change.orderproducts', function() {
        catalogForm.find('input[name=order]').val($(this).val());
        catalogForm.submit();
    });
    $('#sort2').on('change.countvisibleproducts', function() {
        catalogForm.find('input[name=user_per_page]').val($(this).val());
        catalogForm.submit();
    });
    doc.on('render_popup_cart', function() {
        DiscountFront.getDiscount('render_popup_cart');
    });

    doc.on('sync_cart', function() {
        ShopFront.Cart.process();
        ShopFront.Cart.processBtnBuyCount();
        ShopFront.Cart.initShopPage(false);
    });

    $('#bask_block').on('click.toTiny', genObj.tinyBask + '.' + genObj.isAvail, function() {
        ShopFront.Cart.togglePopup();
    });
    doc.on('cart_clear', function() {
        ShopFront.Cart.initShopPage(false);
        ShopFront.Cart.countSum();
        ShopFront.Cart.process();
        ShopFront.Cart.processBtnBuyCount();
    });
    doc.on('count_changed', function(e) {
        if (!orderDetails)
            DiscountFront.getDiscount('count_changed');
        ShopFront.Cart.processBtnBuyCount(body);
    });
    doc.on('beforeDisplayDiscount', function(e) {
        ShopFront.Cart.countSum();
        ShopFront.Cart.process();
    });

    doc.on('after_add_to_cart', function(e) {
        ShopFront.Cart.initShopPage(e.show);
        //ShopFront.Cart.initShopPage(false, e.cartItem); //for animate img to tinybask
        ShopFront.Cart.processBtnBuyCount();
        DiscountFront.getDiscount('after_add_to_cart');
    });
    doc.on('cart_rm', function(data) {
        if (!data.cartItem.kitId)
            $('[data-id="popupProduct_' + data.cartItem.id + '_' + data.cartItem.vId + '"]').remove();
        else
            $('[data-id="popupKit_' + data.cartItem.kitId + '"]').remove();
        ShopFront.Cart.processBtnBuyCount();
        dropBaskResize();
        if (Shop.Cart.length() > 0 && !orderDetails)
            DiscountFront.getDiscount('cart_rm');
        else
            ShopFront.Cart.process();
    });
    $(genObj.parentBtnBuy).on('click.toCompare', '.' + genObj.toCompare, function() {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });
    $(genObj.parentBtnBuy).on('click.inCompare', '.' + genObj.inCompare, function() {
        var pN = window.location.pathname,
        tab;

        if (pN.indexOf('category') !== -1)
            tab = pN.substr(pN.lastIndexOf('/') + 1, pN.length);
        else if (pN.indexOf('product') !== -1)
            tab = hrefCategoryProduct.substr(hrefCategoryProduct.lastIndexOf('/') + 1, hrefCategoryProduct.length)
        document.location.href = locale + '/shop/compare#tab_' + tab;
    });
    doc.on('compare_list_add', function(e) {
        if (e.dataObj.success === true) {
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']');
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        $this.tooltip();
    });
    doc.on('compare_list_add compare_list_rm compare_list_sync', function() {
        ShopFront.CompareList.count();
    });
    doc.on('compare_list_sync', function() {
        ShopFront.CompareList.process();
    });
    doc.on('wish_list_sync', function() {
        global.processWish();
        global.wishListCount();
    });
    doc.on('widget_ajax', function(e) {
        initCarouselJscrollPaneCycle(e.el);
        reinitializeScrollPane(e.el);

        e.el.find("img.lazy").lazyload(lazyload);
        wnd.scroll()

        ShopFront.Cart.pasteItems(e.el);
    });
    doc.on('discount.display', function(e) {
        Shop.Cart.discount = e.discount;
        DiscountFront.displayDiscount(Shop.Cart.discount);
    });
    /*/sample of events shop/*/

    /*sample of events front*/
    doc.on('lazy.after', function(e) {
        e.el.addClass('load');
    });
    doc.on('tabs.beforeload', function(e) {
        e.els.filter('.active').append('<div class="' + preloader.replace('.', '') + '"></div>');
    });
    doc.on('tabs.afterload', function(e) {
        ShopFront.Cart.pasteItems(e.el);
        e.els.find(preloader).remove();
    });
    doc.on('autocomplete.fewLength', function(e) {
        e.el.tooltip({
            'title': text.search(e.value)
        });
    });

    try {
        $('a.fancybox, [rel="group"]').fancybox();
    } catch (e) {
    }
    doc.on('rendercomment.after', function(e) {
        showHidePart(e.el.find('.frame-list-comments.sub-2'));
        showHidePart(e.el.find('.product-comment'));
        e.el.find('[data-drop]').drop(optionsDrop);
        e.el.find(preloader).remove();
    });
    doc.on('render_popup_cart autocomplete.after rendercomment.after imageapi.pastemsg showCleaverFilter tabs.afterload renderorder.after', function(e) {
        if (e.el.parent().is(':visible'))
            drawIcons(e.el.parent().find(selIcons));
    });
    doc.on('imageapi.pastemsg imageapi.hidemsg', function(e) {
        e.el.closest('[data-elrun]').drop('heightContent');
    });
    doc.on('imageapi.before_refresh_reload', function(e) {
        var drop = e.el.closest('[data-elrun]');
        if (drop.data('drp') && drop.data('drp').durationOff !== undefined)
            setTimeout(function() {
                if ($.existsN(drop))
                    drop.drop('close');
            }, e.obj.durationHideForm - drop.data('drp').durationOff > 0 ? e.obj.durationHideForm - drop.data('drp').durationOff : e.obj.durationHideForm);
    });
    doc.on('autocomplete.before showActivity before_add_to_compare discount.load_certificate', function(e) {
        $.fancybox.showActivity();
    });
    doc.on('autocomplete.after after.drop closed.drop hideActivity sync_cart end_sync_cart compare_list_add compare_list_rm compare_list_sync count_changed cart_clear cart_rm discount.renderGiftInput discount.giftError discount.renderGiftSucces imageapi.success', function(e) {
        $.fancybox.hideActivity();
    });

    doc.on('comments.showformreply tabs.showtabs after.drop', function(e) {
        if (ltie7)
            ieBoxSize(e.el.find(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])'));
    });
    doc.on('comments.beforeshowformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view'),
                h = patchCom.outerHeight(),
                elH = e.el.outerHeight();
        
        patchCom.css({
            'height': h + elH,
            'max-height': h + elH
        });
    });
    doc.on('comments.beforehideformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view'),
                h = patchCom.outerHeight(),
                elH = e.el.outerHeight();
        
        patchCom.css({
            'height': h - elH,
            'max-height': ''
        });
    });
    doc.on('menu.showDrop', function(e) {
        if (ltie7)
            ieBoxSize($('.frame-drop-menu .frame-l2 > ul > li'));
    });
    body.on('click.trigger', '[data-trigger]', function(e) {
        var $thisT = $(this);
        $($thisT.data('trigger')).trigger({
            type: "click",
            scroll: $thisT.data('scroll') !== undefined || false,
            trigger: true
        });
    });
    /*/sample of events front*/

    if (!$.browser.opera)
        wnd.focus(function() {
            ShopFront.Cart.processBtnBuyCount();
            global.checkSyncs();

            ShopFront.CompareList.process();
            global.processWish();
            ShopFront.CompareList.count();
            global.wishListCount();

            if (orderDetails)
                Order.renderOrderDetails();

            ShopFront.Cart.countSum();
            ShopFront.Cart.process();
        });
    var genTimeout = "";
    wnd.resize(function() {
        clearTimeout(genTimeout);
        genTimeout = setTimeout(function() {
            var userTool = new itemUserToolbar();
            userTool.resize($('.frame-user-toolbar'), $('.btn-to-up'));
            $('.menu-main').menuImageCms('refresh');
            banerResize('.baner:has(.cycle)');
        }, 300);
    });
}