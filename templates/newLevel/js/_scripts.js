function init() {
    if (isTouch)
        body.addClass('isTouch');
    else
        body.addClass('notTouch');
    
    /*call general functions and plugins*/
    cuselInit(body, '#sort, #sort2, #compare, [id ^= сVariantSwitcher_]');
    /*call general functions and plugins*/
    
    /*call functions for shop objects*/
    checkSyncs();
    btnbuyInitialize(body);//where find
    processBtnBuyCount();
    initShopPage(false);
    tovarCategoryChangeVariant();
    //if !selectDeliv
    $(document).on('discount.display', function(e) {
        displayDiscount(e.discount);
    });
    getDiscount();

    processWish();
    processComp();
    compareListCount();
    wishListCount();
    /*/ call functions for shop objects*/
    
    /*call front plugins and functions*/
    $.onlyNumber('.number input');
    if (ltie7) {
        ieInput();
        ieInput($('.photo-block, .frame-baner-start_page .content-carousel, .cloud-zoom-lens, .items-user-toolbar'));
    }

    optionsDrop.before = function(el, dropEl, isajax) {
        var dropEl = $(dropEl);
        if (dropEl.hasClass('drop-report')) {
            var dropElRep = dropEl.find('[data-rel="pastehere"]');
            dropElRep.html(_.template($('#reportappearance').html(), {
                item: Shop.composeCartItem(el)
            }));

            dropElRep.append($('[data-clone="data-report"]').clone(true).removeClass('d_n'));
            dropElRep.find('input[name="ProductId"]').val(el.data('prodid'));
            return el;
        }
        if (dropEl.hasClass('frame-already-show')) {
            dropEl.parent().css('z-index', 1102);
        }
        dropEl.find('label.' + genObj.err + ', label.' + genObj.scs).hide();
        dropEl.find(':input').removeClass(genObj.scs + ' ' + genObj.err);
    };
    optionsDrop.after = function(el, dropEl, isajax) {
        drawIcons(dropEl.find(selIcons));

        dropEl.find("img.lazy:not(.load)").lazyload(lazyload);
        wnd.scroll(); //for lazyload

        var carouselInDrop = dropEl.find('.carousel_js');
        if ($.existsN(carouselInDrop) && !carouselInDrop.hasClass('visited') && !dropEl.is('#photo')) {
            carouselInDrop.addClass('visited')
            carouselInDrop.myCarousel(carousel);
        }
        if (dropEl.hasClass('drop-wishlist')) {
            dropEl.nStRadio({
                wrapper: $(".frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
        }
        if ($.existsN(dropEl.find('[onsubmit*="ImageCMSApi"]'))) {
            var input = dropEl.find('form input[type="text"]:first');
            input.setCursorPosition(input.val().length);
        }
        cuselInit(dropEl, '.drop:visible .lineForm select');
    };
    optionsDrop.close = function(el, dropEl) {};
    optionsDrop.closed = function(el, dropEl) {
        var dC = $(dropEl.find(dropEl.data('dropContent'))).data('jsp');
        if (dC != undefined)
            dC.destroy();
        if ($(dropEl).hasClass('frame-already-show'))
            $('.frame-user-toolbar').css({
                'width': body.width(), 
                'z-index': 100
            })
        if ($('#fancybox-wrap').is(':visible'))
            $.drop('scrollEmulate')();
    }
    $('.menu-main').menuImageCms(optionsMenu);
    $('.footer-category-menu').find('[href="' + $('.frame-item-menu.active > .frame-title > .title').attr('href') + '"]').parent().addClass('active');
    $('[data-drop]').drop($.extend({}, optionsDrop));
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
                showHidePart($('.frame-list-comment__icsi-css.sub-2'));
            }
        }
    });
    
    /*changecount product in category and product*/
    tovarChangeCount($('.items-catalog, .item-product'));
    /*/changecount product in category and product*/
    
    $('#suggestions').autocomplete({
        minValue: 3,
        blockEnter: false        
    });
    drawIcons($(selIcons));
    showHidePart($('.sub-category'));
    showHidePart($('.patch-product-view'));
    showHidePart($('.frame-list-comment__icsi-css.sub-2'));
    var userTool = new itemUserToolbar(),
    btnToUp = $('.btn-to-up');
    btnToUp.click(function() {
        $("html, body").animate({
            scrollTop: "0"
        });
    })
    userTool.show($('.items-user-toolbar'), $('.btn-toggle-toolbar > button'), '.box-1, .box-2, .box-3', btnToUp);
    userTool.resize($('.frame-user-toolbar'), btnToUp);
    if ($.existsN($('.animateListItems.table')))
        decorElemntItemProduct();
    var frLabL = $('.frame-label').length;
    $('.frame-label:has(.lineForm)').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': frLabL - index
        })
    });
    initCarouselJscrollPaneCycle(body);
    if ($.exists(optionCompare.frameCompare))
        $(optionCompare.frameCompare).equalHorizCell(optionCompare); //because rather call and call carousel twice
    reinitializeScrollPane(body);
    $("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazy load start initialize
    /*/call front plugins and functions*/
    
    /*sample of events shop*/
    var catalogForm = $('#catalog_form')
    $('#sort').on('change.orderproducts', function() {
        $('input[name=order]').val($(this).val())
        catalogForm.submit();
    });
    $('#sort2').on('change.countvisibleproducts', function() {
        $('input[name=user_per_page]').val($(this).val())
        catalogForm.submit();
    });
    $(document).on('render_popup_cart', function() {
        getDiscount();
    })

    $(document).on('sync_cart', function() {
        processCarts();
        processBtnBuyCount();
        initShopPage(false);
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    })

    $('#bask_block').on('click.toTiny', genObj.tinyBask + '.' + genObj.isAvail, function() {
        initShopPage(true);
    })
    $(document).on('cart_clear', function() {
        initShopPage(false);
        countSumBask();
        processCarts();
    });
    $(document).on('count_changed', function() {
        getDiscount();
    });
    $(document).on('after_add_to_cart', function(e) {
        initShopPage(e.show);
        //initShopPage(false, e.cartItem); //for animate img to tinybask
        getDiscount();
        processBtnBuyCount();
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    });
    $(document).on('cart_rm', function(data) {
        if (!data.cartItem.kitId)
            $('[data-id="popupProduct_' + data.cartItem.id + '_' + data.cartItem.vId + '"]').remove();
        else
            $('[data-id="popupKit_' + data.cartItem.kitId + '"]').remove();
        processCarts();
        processBtnBuyCount();
        dropBaskResize();
        if (Shop.Cart.length() > 0 && !orderDetails)
            getDiscount();
    });
    $(genObj.parentBtnBuy).on('click.toCompare', '.' + genObj.toCompare,  function() {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });
    $(genObj.parentBtnBuy).on('click.inCompare', '.' + genObj.inCompare, function() {
        document.location.href = '/shop/compare';
    });
    $(document).on('compare_list_add', function(e) {
        if (e.dataObj.success == true) {
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        $this.tooltip();
    });
    $(document).on('compare_list_add compare_list_rm compare_list_sync', function() {
        compareListCount();
    });
    $(document).on('compare_list_sync', function() {
        processComp();
    });
    $(document).on('wish_list_sync', function() {
        processWish();
        wishListCount();
    });
    $(document).on('change_count_cl change_count_wl', function(e) {
        if (wishList.count + Shop.CompareList.count + countViewProd > 0)
            $('.content-user-toolbar').fadeIn()
        else
            $('.content-user-toolbar').fadeOut()
    });
    
    /*/sample of events shop/*/
    
    /*sample of events front*/
    $(document).on('lazy.after', function(e) {
        e.el.addClass('load');
    });
    $(document).on('drop.show', function(e) {
        var wndH = wnd.height(),
        el = e.dropC,
        elDrop = e.el;
        if ($.existsN(el)) {
            el.jScrollPane(scrollPane);
            var elC = el.find('.jspPane'),
            elCH = elC.outerHeight(),
            api = el.data('jsp');
            var footerHeader = elDrop.find('.drop-header').outerHeight(true) + elDrop.find('.drop-footer').outerHeight(true);
            if (elDrop.data('place') != 'center' && elDrop.data('place') != 'inherit') {
                if (elDrop.data('placement').search(/top/) == 0) {
                    var mayHeight = $(document).height() - elDrop.offset().top - footerHeader;
                    if (mayHeight > elCH)
                        el.css('height', elCH)
                    else
                        el.css('height', mayHeight - 20)
                    if (el.outerHeight() == elCH)
                        api.destroy();
                }
                if (elDrop.data('placement').search(/bottom/) == 0) {
                    el.css('height', '');
                    var refer = $('[data-drop="' + elDrop.data('elrun') + '"]'),
                    mayHeight = refer.offset().top - wnd.scrollTop() - footerHeader - 40,
                    minh = parseInt(el.css('height'));
                    if (mayHeight > elCH)
                        el.css('height', elCH)
                    else
                        el.css('height', mayHeight < minh ? minh : mayHeight)
                    if (el.outerHeight() == elCH)
                        api.destroy();
                    $.drop('positionDrop')(refer);
                }
            }
            else {
                if (elCH + footerHeader > wndH)
                    el.css('height', wndH - footerHeader - 40);
                else
                    el.css('height', elCH);
            }
            api.reinitialise();
        }
    });
    $(document).on('tabs.beforeload', function(e) {
        e.els.filter('.active').append('<div class="' + preloader.replace('.', '') + '"></div>')
    });
    $(document).on('tabs.afterload', function(e) {
        pasteItemsTovars(e.el);
        e.els.find(preloader).remove();
    });
    //    if carousel in compare
    //    $('#compare').change(function() {
    //        var $this = $(this);
    //        $($this.val()).siblings().hide().end().show();
    //        optionCompare.compareChangeCategory();
    //    }).change();

    $(document).on('autocomplete.fewLength', function(e) {
        e.el.tooltip({
            'title': text.search(e.value)
        });
    });
   
    var dropContentTimeout = "";
    wnd.on('resize.dropContent', function() {
        clearTimeout(dropContentTimeout);
        setTimeout(function() {
            $('[data-elrun]:visible').each(function() {
                var $this = $(this),
                dropContent = $this.find($this.data('dropContent'));
                if ($.existsN(dropContent))
                    $(document).trigger({
                        type: 'drop.show', 
                        el: $this, 
                        dropC: dropContent
                    })
            })
        }, 300)
    });
    try {
        $('a.fancybox').fancybox();
    } catch (e) {
    }
    $(document).on('drop.successJson', function(e) {
        if (e.el.is('#notification')) {
            if (e.datas.answer == "success")
                e.el.find(optionsDrop.modalPlace).empty().append(message.success(e.datas.data))
            else
                e.el.find(optionsDrop.modalPlace).empty().append(message.error(e.datas.data))
        }
    });
    $(document).on('rendercomment.after', function(e) {
        showHidePart(e.el.find('.frame-list-comment__icsi-css.sub-2'));
        showHidePart(e.el.find('.product-comment'));
        e.el.find(preloader).remove();
    });
    $(document).on('render_popup_cart autocomplete.after rendercomment.after imageapi.pastemsg showCleaverFilter tabs.afterload renderorder.after', function(e) {
        if (e.el.is(':visible'))
            drawIcons(e.el.find(selIcons))
    });
    $(document).on('imageapi.pastemsg imageapi.hidemsg', function(e) {
        var $this = e.el.closest('[data-elrun]'),
        dropContent = $this.find($this.data('dropContent'));
        $(document).trigger({
            type: 'drop.show', 
            el: $this, 
            dropC: dropContent
        });
    });
    $(document).on('imageapi.before_refresh_reload', function(e){
        var drop = e.el.closest('[data-elrun]');
        
        if (drop.data('durationOff') != undefined)
            setTimeout(function(){
                if ($.existsN(drop))
                    $.drop('closeDrop')(drop);
            }, e.obj.durationHideForm - drop.data('durationOff') > 0 ? e.obj.durationHideForm - drop.data('durationOff') : e.obj.durationHideForm)
    });
    $(document).on('autocomplete.before showActivity before_sync_cart before_add_to_compare discount.load_certificate', function(e) {
        $.fancybox.showActivity();
    })
    $(document).on('autocomplete.after drop.show drop.hide hideActivity sync_cart end_sync_cart compare_list_add compare_list_rm compare_list_sync count_changed cart_clear cart_rm discount.renderGiftInput discount.giftError discount.renderGiftSucces imageapi.success', function(e) {
        $.fancybox.hideActivity();
    })

    $(document).on('comments.showformreply tabs.showtabs drop.show', function(e) {
        if (ltie7)
            ieInput(e.el.find(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])'));
    })
    $(document).on('comments.beforeshowformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css({
            'max-height': 'none', 
            'height': 'auto'
        });
        var sumH = (patchCom.outerHeight() > patchCom.data('maxHeight') ? patchCom.data('maxHeight') : patchCom.outerHeight()) + e.el.outerHeight();
        patchCom.css({
            'height': sumH, 
            'max-height': sumH
        })
    })
    $(document).on('comments.beforehideformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css('max-height', patchCom.data('maxHeight'))
    })
    $(document).on('menu.showDrop', function(e) {
        if (ltie7)
            ieInput($('.frame-drop-menu .frame-l2 > ul > li'));
    });
    body.on('click.trigger', '[data-trigger]', function(e) {
        var $thisT = $(this);
        $($thisT.data('trigger')).trigger({
            type: "click",
            scroll: $thisT.data('scroll') != undefined || false,
            trigger: true
        });
    });
    $(document).on('widget_ajax', function(e) {
        initCarouselJscrollPaneCycle(e.el);
        reinitializeScrollPane(e.el);
        pasteItemsTovars(e.el);
    });
    /*/sample of events front*/

    if (!$.browser.opera)
        wnd.focus(function() {
            processBtnBuyCount();
            checkSyncs();
            processCarts();
                
            processComp();
            processWish();
            compareListCount();
            wishListCount();
        
            //initShopPage(false);
            if ($(genObj.popupCart).is(':visible'))
                $.drop('closeDrop')($(genObj.popupCart))
        
            if (orderDetails)
                renderOrderDetails();
        //            $.ajax({
        //                'url': siteUrl+locale+'auth/login', 
        //                'complete': function(o){
        //                    if (o.status == 200 && isLogin)
        //                        location.reload();
        //                }
        //            });
        });
}