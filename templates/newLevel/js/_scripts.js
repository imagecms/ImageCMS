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
    checkSyncs();
    processBtnBuyCount();
    initShopPage(false);
    tovarCategoryChangeVariant();

    doc.on('discount.display', function(e) {
        Shop.Cart.discount = e.discount;
        displayDiscount(Shop.Cart.discount);
    });
    getDiscount();

    processWish();
    processComp();
    compareListCount();
    wishListCount();
    /*/ call functions for shop objects*/

    /*call front plugins and functions*/
    $.onlyNumber(genObj.numberC + ' input');
    if (ltie7) {
        ieInput();
        ieInput($('.photo-block, .frame-baner-start_page .content-carousel, .cloud-zoom-lens, .items-user-toolbar'));
    }

    optionsDrop.before = function(el, dropEl, isajax) {
        var dropEl = $(dropEl);
        if (dropEl.hasClass('drop-report')) {
            var dropElRep = dropEl.find('[data-rel="pastehere"]');
            dropElRep.html(_.template($('#reportappearance').html(), {
                item: Shop.Cart.composeCartItem(el)
            }));

            dropElRep.append($('[data-clone="data-report"]').clone(true).removeClass('d_n'));
            dropElRep.find('input[name="ProductId"]').val(el.data('prodid'));
            return el;
        }

        if (dropEl.hasClass('frame-already-show')) {
            var zInd = parseFloat(dropEl.data('dropOver').css('z-index')) + 1;
            dropEl.parent().css('z-index', zInd);
            dropEl.prev().css('z-index', zInd + 1);
        }
        if ($('.frame-already-show').is(':visible') && dropEl.data('dropOver'))
            $('.frame-user-toolbar').css('z-index', dropEl.data('dropOver').css('z-index') - 1)

        dropEl.find('label.' + genObj.err + ', label.' + genObj.scs).hide();
        dropEl.find(':input').removeClass(genObj.scs + ' ' + genObj.err);
    };
    optionsDrop.after = function(el, dropEl, isajax) {
        drawIcons(dropEl.find(selIcons));

        dropEl.find("img.lazy:not(.load)").lazyload(lazyload);
        wnd.scroll(); //for lazyload

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
        var carouselInDrop = dropEl.find('.carousel-js-css');
        if ($.existsN(carouselInDrop) && !carouselInDrop.hasClass('visited') && !dropEl.is('#photo')) {
            carouselInDrop.addClass('visited')
            carouselInDrop.myCarousel(carousel);
        }
        cuselInit(dropEl, '.drop:visible .lineForm select');
    };
    optionsDrop.close = function(el, dropEl) {
    };
    optionsDrop.closed = function(el, dropEl) {
        var dC = $(dropEl.find(dropEl.data('dropContent'))).data('jsp');
        if (dC != undefined)
            dC.destroy();

        if ($(dropEl).hasClass('frame-already-show')) {
            $('.frame-user-toolbar').css({
                'width': body.width(),
                'z-index': ''
            });
            dropEl.prev().css('z-index', '');
        }
        if ($('#fancybox-wrap').is(':visible'))
            $.drop('scrollEmulate')();
    }
    $('.menu-main').menuImageCms(optionsMenu);
    $('.footer-category-menu').find('[href="' + $('.frame-item-menu.active > .frame-title > .title').attr('href') + '"]').parent().addClass('active');
    $('[data-drop]').drop(optionsDrop);
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
    var catalogForm = $('#catalogForm')
    $('#sort').on('change.orderproducts', function() {
        catalogForm.find('input[name=order]').val($(this).val())
        catalogForm.submit();
    });
    $('#sort2').on('change.countvisibleproducts', function() {
        catalogForm.find('input[name=user_per_page]').val($(this).val())
        catalogForm.submit();
    });
    doc.on('render_popup_cart', function() {
        getDiscount();
    })

    doc.on('sync_cart', function() {
        processCarts();
        processBtnBuyCount();
        initShopPage(false);
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    })

    $('#bask_block').on('click.toTiny', genObj.tinyBask + '.' + genObj.isAvail, function() {
        initShopPage(true);
    })
    doc.on('cart_clear', function() {
        initShopPage(false);
        countSumBask();
        processCarts();
    });
    doc.on('count_changed', function(e) {
        getDiscount();
        processBtnBuyCount(body);
    });
    doc.on('after_add_to_cart', function(e) {
        initShopPage(e.show);
        //initShopPage(false, e.cartItem); //for animate img to tinybask
        getDiscount();
        processBtnBuyCount();
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    });
    doc.on('cart_rm', function(data) {
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
    $(genObj.parentBtnBuy).on('click.toCompare', '.' + genObj.toCompare, function() {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });
    $(genObj.parentBtnBuy).on('click.inCompare', '.' + genObj.inCompare, function() {
        document.location.href = '/shop/compare';
    });
    doc.on('compare_list_add', function(e) {
        if (e.dataObj.success == true) {
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        $this.tooltip();
    });
    doc.on('compare_list_add compare_list_rm compare_list_sync', function() {
        compareListCount();
    });
    doc.on('compare_list_sync', function() {
        processComp();
    });
    doc.on('wish_list_sync', function() {
        processWish();
        wishListCount();
    });
    doc.on('change_count_cl change_count_wl', function(e) {
        if (wishList.count + Shop.CompareList.count + countViewProd > 0)
            $('.content-user-toolbar').fadeIn()
        else
            $('.content-user-toolbar').fadeOut()
    });

    /*/sample of events shop/*/

    /*sample of events front*/
    doc.on('lazy.after', function(e) {
        e.el.addClass('load');
    });
    doc.on('drop.after', function(e) {
        var wndH = wnd.height(),
                elDrop = e.drop.css('height', ''),
                el = elDrop.find(elDrop.data('dropContent')).filter(':first');

        if ($.existsN(el)) {
            el.jScrollPane(scrollPane);
            var elC = el.find('.jspPane'),
                    elCH = elC.outerHeight(),
                    api = el.data('jsp');
            var footerHeader = elDrop.find('.drop-header').outerHeight(true) + elDrop.find('.drop-footer').outerHeight(true);
            if (elDrop.data('place') != 'center' && elDrop.data('place') != 'inherit') {
                if (elDrop.data('placement').search(/top/) == 0) {
                    var mayHeight = doc.height() - elDrop.offset().top - footerHeader;
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
            if (elDrop.data('place') == 'center')
                elDrop.drop('dropCenter');
        }
    });
    doc.on('tabs.beforeload', function(e) {
        e.els.filter('.active').append('<div class="' + preloader.replace('.', '') + '"></div>')
    });
    doc.on('tabs.afterload', function(e) {
        pasteItemsTovars(e.el);
        e.els.find(preloader).remove();
    });

    //if select in compare
    $('#compare').change(function() {
        var $this = $(this);
        $($this.val()).siblings().hide().end().show();
        optionCompare.compareChangeCategory();
    }).change();

    doc.on('autocomplete.fewLength', function(e) {
        e.el.tooltip({
            'title': text.search(e.value)
        });
    });

    var dropContentTimeout = "";
    wnd.on('resize.dropContent', function() {
        clearTimeout(dropContentTimeout);
        setTimeout(function() {
            $('[data-elrun]:visible').each(function() {
                var $this = $(this);
                doc.trigger({
                    type: 'drop.after',
                    drop: $this
                })
            })
        }, 300)
    });
    try {
        $('a.fancybox').fancybox();
    } catch (e) {
    }
    doc.on('drop.successJson', function(e) {
        if (e.el.is('#notification')) {
            if (e.datas.answer == "success")
                e.el.find(optionsDrop.modalPlace).empty().append(message.success(e.datas.data))
            else
                e.el.find(optionsDrop.modalPlace).empty().append(message.error(e.datas.data))
        }
    });
    doc.on('rendercomment.after', function(e) {
        showHidePart(e.el.find('.frame-list-comment__icsi-css.sub-2'));
        showHidePart(e.el.find('.product-comment'));
        e.el.find(preloader).remove();
    });
    doc.on('render_popup_cart autocomplete.after rendercomment.after imageapi.pastemsg showCleaverFilter tabs.afterload renderorder.after', function(e) {
        if (e.el.is(':visible'))
            drawIcons(e.el.find(selIcons))
    });
    doc.on('imageapi.pastemsg imageapi.hidemsg', function(e) {
        var $this = e.el.closest('[data-elrun]');
        doc.trigger({
            type: 'drop.after',
            drop: $this
        });
    });
    doc.on('imageapi.before_refresh_reload', function(e) {
        var drop = e.el.closest('[data-elrun]');

        if (drop.data('durationOff') != undefined)
            setTimeout(function() {
                if ($.existsN(drop))
                    $.drop('closeDrop')(drop);
            }, e.obj.durationHideForm - drop.data('durationOff') > 0 ? e.obj.durationHideForm - drop.data('durationOff') : e.obj.durationHideForm)
    });
    doc.on('autocomplete.before showActivity before_sync_cart before_add_to_compare discount.load_certificate', function(e) {
        $.fancybox.showActivity();
    })
    doc.on('autocomplete.after drop.after drop.closed hideActivity sync_cart end_sync_cart compare_list_add compare_list_rm compare_list_sync count_changed cart_clear cart_rm discount.renderGiftInput discount.giftError discount.renderGiftSucces imageapi.success', function(e) {
        $.fancybox.hideActivity();
    })

    doc.on('comments.showformreply tabs.showtabs drop.after', function(e) {
        if (ltie7)
            ieInput(e.el.find(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])'));
    })
    doc.on('comments.beforeshowformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css({
            'height': 'auto'
        });

        var sumH = (patchCom.outerHeight() < patchCom.data('maxHeight') ? patchCom.data('maxHeight') : patchCom.outerHeight()) + e.el.outerHeight();

        patchCom.css({
            'height': sumH,
            'max-height': sumH
        })
    })
    doc.on('comments.beforehideformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css({'max-height': 'none', 'height': patchCom.height() - e.el.outerHeight()})
    })
    doc.on('menu.showDrop', function(e) {
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
    doc.on('widget_ajax', function(e) {
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
        });
    var genTimeout = "";
    wnd.resize(function() {
        clearTimeout(genTimeout);
        genTimeout = setTimeout(function() {
            var userTool = new itemUserToolbar();
            userTool.resize($('.frame-user-toolbar'), $('.btn-to-up'));
            $('.menu-main').menuImageCms('refresh');
            if ($.exists(optionCompare.frameCompare))
                $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
            banerResize('.baner:has(.cycle)');
        }, 300)
    });
}