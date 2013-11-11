/*declaration shop functions*/
//variants
function tovarCategoryChangeVariant(el) {
    el = el == undefined ? body : el;
    /*Variants in Category*/
    el.find('[id ^= сVariantSwitcher_]').on('change', function() {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy),
        btnInfo = liBlock.find(genObj.prefV + productId + ' ' + genObj.infoBut),
        vMediumImage = btnInfo.attr('data-mediumImage'),
        vId = btnInfo.attr('data-id'),
        vName = btnInfo.attr('data-vname'),
        vPrice = btnInfo.attr('data-price'),
        vOrigPrice = btnInfo.attr('data-origPrice'),
        vAddPrice = btnInfo.attr('data-addPrice'),
        vNumber = btnInfo.attr('data-number'),
        vStock = btnInfo.attr('data-maxcount');
        
        if (vMediumImage.search(/nophoto/) == -1)
            liBlock.find(genObj.imgVC).attr('src', vMediumImage).attr('alt', vName);
        
        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
        if (vOrigPrice != '')
            liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.priceAddPrice).html(vAddPrice);
        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId + ' ' + genObj.infoBut));
    });
/*/Variants in Category*/
}
function tovarChangeCount(el) {
    el = el == undefined ? body : el;
    el.find('.frame-count-buy ' + genObj.plusMinus).keyup(function(e) {
        var $this = $(this);
        condTooltip = checkProdStock && $this.val() > $this.data('max');
        if (condTooltip)
            $this.closest(genObj.numberC).tooltip();
        
        $this.closest(genObj.frameCount).next().children().attr('data-count', $this.val())
        $(document).trigger({ //for wishlist
            'type': 'change_count_product', 
            'el': $this
        });
    });
    el.find(genObj.plusMinus).plusminus({
        prev: 'prev.children(:eq(1)).children',
        next: 'prev.children(:eq(0)).children',
        after: function(e, el, input) {
            if (checkProdStock && input.val() == input.data('max'))
                el.closest(genObj.numberC).tooltip();
            
            input.closest(genObj.frameCount).next().children().attr('data-count', input.val())
        
            $(document).trigger({ //for wishlist
                'type': 'change_count_product',
                'el': input
            });
        }
    });
}
function pasteItemsTovars(el) {
    el.find("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazyload
    drawIcons(el.find(selIcons));
    btnbuyInitialize(el);
    processBtnBuyCount(el);
    el.find('[data-drop]').drop($.extend({}, optionsDrop));
}
function processComp() {
    //comparelist checking
    var comparelist = Shop.CompareList.all();
    $('.' + genObj.toCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) !== -1) {
            var $this = $(this);
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
    $('.' + genObj.inCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) === -1) {
            var $this = $(this);
            $this.addClass(genObj.toCompare).removeClass(genObj.inCompare).parent().removeClass(genObj.compareIn).end().attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
        }
    });
}
function processWish() {
    var wishlist = wishList.all();
    $(genObj.btnWish).each(function() {
        var $this = $(this),
        $thisP = $this.parent();
        if (wishlist.indexOf($thisP.data('id') + '_' + $thisP.data('varid')) !== -1) {
            $this.addClass(genObj.wishIn);
            $this.find('.' + genObj.toWishlist).hide();
            $this.find('.' + genObj.inWishlist).show();
        }
        else {
            $this.removeClass(genObj.wishIn);
            $this.find('.' + genObj.toWishlist).show();
            $this.find('.' + genObj.inWishlist).hide();
        }
    });
}
function processCarts() {
    if ($(genObj.popupCart).is(':visible') || orderDetails) {
        if (Shop.Cart.length() == 0) {
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_b').addClass('d_n');
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_n').addClass('d_b');
        }
        else {
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_n').addClass('d_b');
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_b').addClass('d_n');
        }
    }
}
function processBtnBuyCount(el) {
    //update page content
    //update products count
    el = el == undefined ? body : el;
    var keys = [];
    _.each(Shop.Cart.getAllItems(), function(item) {
        keys.push(item.id + '_' + item.vId);
    });
    //update all product buttons
    el.find(':not(.' + genObj.btnCartCss + ') ' + genObj.btnBuy).each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) != -1) {
            $this.parent().removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).children().removeAttr('disabled').find(genObj.textEl).html(inCart);
            decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
            $this.unbind('click.buy').bind('click.buy', function(e) {
                $(document).trigger('showActivity');
                initShopPage(true);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.toCart).addClass(genObj.inCart);
        }
    }).removeAttr('disabled');
    el.find('.' + genObj.btnCartCss + ' ' + genObj.btnBuy).each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) == -1) {
            $this.parent().removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).children().removeAttr('disabled').find(genObj.textEl).html(toCart)
            decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
            $this.unbind('click.buy').bind('click.buy', function(e) {
                $(document).trigger('showActivity');
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem, e.button == undefined ? false : true);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart).addClass(genObj.toCart);
        }
    }).removeAttr('disabled');
    el.find('[data-rel="frameplusminus"]').each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) != -1) {
            var input = $this.find('input');
            $this.find('button').attr('disabled', 'disabled');
            input.val(JSON.parse(localStorage.getItem('cartItem_' + key)).count).attr('readonly', 'readonly').attr('disabled', 'disabled');
        }
        else {
            var input = $this.find('input');
            $this.find('button').removeAttr('disabled');
            input.removeAttr('readonly disabled').val('1');
            $this.closest(genObj.frameCount).next().children().attr('data-count', '1')
        }
    })
    $(document).trigger({
        'type': 'processPageEnd'
    });
}
function getDiscount() {
    //        if (!$.exists('#countDisc'))
    //            body.append('<div id="countDisc" style="position:absolute;left: 50px;top: 150px;z-index:1000;">0</div>')
    //        $('#countDisc').text(parseInt($('#countDisc').text()) + 1);
    var k = true;
    if (!orderDetails)
        k = false;
    $(document).trigger('showActivity');
    $.ajax({
        type: 'GET',
        url: '/shop/cart_api/get_kit_discount',
        success: function(data) {
            var kitDiscount = parseFloat(data);
            Shop.Cart.kitDiscount = isNaN(kitDiscount) ? 0 : kitDiscount;
            
            if (!$.isFunction(window.getDiscountBack))
                displayDiscount(null);
            
            if (k && !$.isFunction(window.getDiscountBack)){
                displayInfoDiscount('');
                renderGiftInput('');
            }
            
            if (!discountInPopup && !k)
                return false;
            else if ($.isFunction(window.getDiscountBack)) {
                getDiscountBack(k);
            }
        }
    });
}
function displayDiscount(obj) {
    Shop.Cart.totalRecount();
    Shop.Cart.discountProduct = 0;
    var tempdisc = false;
    if (obj != null)
        tempdisc =  parseFloat(obj.sum_discount_product) != 0 && obj.sum_discount_product != null;
    var discC = tempdisc || parseFloat(Shop.Cart.kitDiscount) != 0;
    if (discC) {
        if (obj != null)
            Shop.Cart.discountProduct += parseFloat(obj.sum_discount_product == null ? 0 : obj.sum_discount_product);
        Shop.Cart.discountProduct += Shop.Cart.kitDiscount;
        $(genObj.genDiscount).each(function() {
            $(this).html(Shop.Cart.discountProduct.toFixed(pricePrecision));
        });
        $(genObj.genSumDiscount).each(function() {
            $(this).html(Shop.Cart.totalPriceOrigin.toFixed(pricePrecision));
        });
        $(genObj.frameCurDiscount).show();
    }
    else {
        $(genObj.frameCurDiscount).hide();
    }
    if (obj != null){
        if (parseFloat(obj.result_sum_discount_convert) > 0)
            $(genObj.frameGenDiscount).show();
        else 
            $(genObj.frameGenDiscount).hide();
    }
    else
        $(genObj.frameGenDiscount).hide();
    countSumBask();
    $(document).trigger('hideActivity');
};
function btnbuyInitialize(el) {
    el.find(genObj.btnBuy).unbind('click.buy').bind('click.buy', function(e) {
        $(document).trigger('showActivity');
        $(this).attr('disabled', 'disabled');
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem, e.button == undefined ? false : true);
        decorElemntItemProduct($(this).closest(genObj.parentBtnBuy));
        return true;
    }).removeAttr('disabled');
}

function initShopPage(showWindow, item) {
    $(genObj.popupCart).html(Shop.Cart.renderPopupCart());
    
    if ($(genObj.popupCart).is(':visible'))
        dropBaskResize();
    if (showWindow || $(genObj.popupCart).is(':visible'))
        $(document).trigger({
            type: 'render_popup_cart',
            el: $(genObj.popupCart)
        });
    $(genObj.frameBasks + ' ' + genObj.plusMinus).plusminus({
        prev: 'prev.children(:eq(1)).children',
        next: 'prev.children(:eq(0)).children',
        ajax: true,
        after: function(e, el, input) {
            chCountInCart(el.closest(genObj.frameChangeCount), true, input);
        }
    });
    function chCountInCart($this, btn, input) {
        var pd = $this,
        cartItem = new Shop.cartItem({
            id: pd.data('prodid'),
            vId: pd.data('varid'),
            price: pd.data('price'),
            addprice: pd.data('addprice'),
            origprice: pd.data('origprice'),
            kit: pd.data('kit')
        });
        if (input == undefined)
            var input = pd.closest(genObj.frameCount).find('input');
        var inputVal = input.val(),
        condTooltip = '';
        if (!btn)
            condTooltip = checkProdStock && inputVal > input.data('max');
        else
            condTooltip = checkProdStock && inputVal >= input.data('max')

        if (condTooltip) {
            pd.closest(genObj.numberC).tooltip();
            inputVal = input.data('max');
            $(document).trigger('hideActivity');
        }
        cartItem.count = inputVal;
        if (inputVal != '')
            Shop.Cart.chCount(cartItem, function() {
                input.focus();
            });
        var pdTrs = $('[data-id =' + pd.closest('tr[data-id]').data('id') + ']')
        pdTrs.each(function() {
            pdTr = $(this);
            var word = cartItem.kit ? kits : pcs;
            if ($.existsN(pdTr.closest(genObj.orderDetails)))
                word = cartItem.kit ? pluralStr(inputVal, plurKits) : pluralStr(inputVal, plurProd);
            pdTr.find(genObj.priceOrder).html((cartItem.count * cartItem.price).toFixed(pricePrecision));
            pdTr.find(genObj.priceAddOrder).html((cartItem.count * cartItem.addprice).toFixed(pricePrecision));
            pdTr.find(genObj.priceOrigOrder).html((cartItem.count * cartItem.origprice).toFixed(pricePrecision));
            pdTr.find(genObj.plusMinus).val(cartItem.count).text(cartItem.count);
            pdTr.find(genObj.countOrCompl).html(word);
        })
    }
    $(genObj.frameBasks + ' input').off('maxminValue').on('maxminValue', function(e){
        var e = e.event,
        $this = $(this);
        if (!e)
            var e = window.event;
        var key = e.keyCode;
        if (key == 0 || key == 8 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == undefined)
            chCountInCart($this.prev('div'));
    })
    if (showWindow) {
        togglePopupCart();
    }
}
function rmFromPopupCart(context, isKit) {
    $(document).trigger('showActivity');
    if (typeof isKit != 'undefined' && isKit == true)
        var tr = $(context).closest(genObj.trCartKit);
    else
        var tr = $(context).closest('tr');
    var cartItem = new Object();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');
    cartItem.kitId = tr.data('kitid');
    Shop.Cart.rm(cartItem).totalRecount();
}
function togglePopupCart() {
    $(document).trigger('showActivity');
    $(genObj.showCart).trigger({
        type: 'click'
    });
    return false;
}
function checkSyncs() {
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }

    if (inServerCart != NaN)
    {
        if (Shop.Cart.length() != inServerCart)
            Shop.Cart.sync();
    }
    if (inServerWishList != NaN)
    {
        if (wishList.all().length != inServerWishList)
            wishList.sync();
    }
}
function countSumBask() {
    Shop.Cart.totalRecount();
    //    if (!$.exists('#countDisc'))
    //            body.append('<div id="countDisc" style="position:absolute;left: 50px;top: 150px;z-index:1000;">0</div>')
    //        $('#countDisc').text(parseInt($('#countDisc').text()) + 1);
    var length = Shop.Cart.length();
    if (!length) {
        $(genObj.tinyBask + '.' + genObj.isAvail).removeClass(genObj.isAvail);
        $(genObj.tinyBask + ' ' + genObj.blockEmpty).show();
        $(genObj.tinyBask + ' ' + genObj.blockNoEmpty).hide();
    }
    else if (length) {
        $(genObj.tinyBask).addClass(genObj.isAvail);
        $(genObj.tinyBask + ' ' + genObj.blockEmpty).hide();
        $(genObj.tinyBask + ' ' + genObj.blockNoEmpty).show();
    }
    $(genObj.countBask).each(function() {
        $(this).html(length);
    });
    var sumBask = parseFloat(Shop.Cart.totalPrice),
    addSumBask = parseFloat(Shop.Cart.totalAddPrice);
    Shop.Cart.koefCurr = addSumBask / sumBask;
    $(genObj.sumBask).each(function() {
        var temp = 0;
        if (Shop.Cart.totalPriceOrigin.toFixed(pricePrecision) == Shop.Cart.totalPrice.toFixed(pricePrecision))
            temp = Shop.Cart.discountProduct;
        $(this).html((sumBask - temp).toFixed(pricePrecision));
    });
    $(genObj.addSumBask).each(function() {
        $(this).html(addSumBask.toFixed(pricePrecision));
    })
    $(genObj.bask + ' ' + genObj.plurProd).each(function() {
        $(this).html(pluralStr(length, plurProd));
    });
}
function compareListCount() {
    var count = Shop.CompareList.all().length;
    if (count > 0)
        $(genObj.tinyCompareList).show()
    else
        $(genObj.tinyCompareList).hide()
    $(genObj.countTinyCompareList).each(function() {
        $(this).html(count);
    })
    Shop.CompareList.count = count;
    $(document).trigger({
        'type': 'change_count_cl'
    });
}
function wishListCount() {
    var count = wishList.all().length;
    if (count > 0) {
        $(genObj.tinyWishList).show();
    }
    else {
        $(genObj.tinyWishList).hide();
    }
    $(genObj.countTinyWishList).each(function() {
        $(this).html(count);
    });
    wishList.count = count;
    $(document).trigger({
        'type': 'change_count_wl'
    });
}
function existsVnumber(vNumber, liBlock) {
    if ($.trim(vNumber) != '') {
        var $number = liBlock.find(genObj.frameNumber).show()
        $number.find(genObj.code).html(vNumber);
    } else {
        liBlock.find(genObj.frameNumber).hide()
    }
}
function existsVnames(vName, liBlock) {
    if ($.trim(vName) != '') {
        var $vname = liBlock.find(genObj.frameVName).show()
        $vname.find(genObj.code).html(vName);
    } else {
        liBlock.find(genObj.frameVName).hide()
    }
}
function condProduct(vStock, liBlock, btnBuy) {
    liBlock.removeClass(genObj.notAvail + ' ' + genObj.inCart + ' ' + genObj.toCart);
    if (vStock == 0)
        liBlock.addClass(genObj.notAvail);
    else if (btnBuy.parent().hasClass(genObj.btnCartCss))
        liBlock.addClass(genObj.inCart)
    else
        liBlock.addClass(genObj.toCart)
}
/*declaration shop functions*/

/*declaration front functions*/
function pluralStr(i, str) {
    function plural(a) {
        if (a % 10 == 1 && a % 100 != 11)
            return 0
        else if (a % 10 >= 2 && a % 10 <= 4 && (a % 100 < 10 || a % 100 >= 20))
            return 1
        else
            return 2;
    }

    switch (plural(i)) {
        case 0:
            return str[0];
        case 1:
            return str[1];
        default:
            return str[2];
    }
}
function serializeForm(el) {
    var $this = $(el);
    return $this.data('data', $this.closest('form').serialize());
}
if (!$.isFunction($.fancybox)) {
    var loadingTimer, loadingFrame = 1;
    body.append(loading = $('<div id="fancybox-loading"><div></div></div>'));
    _animate_loading = function() {
        if (!loading.is(':visible')) {
            clearInterval(loadingTimer);
            return;
        }

        $('div', loading).css('top', (loadingFrame * -40) + 'px');
        loadingFrame = (loadingFrame + 1) % 12;
    };
    $.fancybox = function() {
        };
    $.fancybox.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.fancybox.hideActivity = function() {
        loading.hide();
    };
}
function banerResize(el) {
    $(el).each(function() {
        var $this = $(this).css('height', '');
        if ($this.hasClass('resize')) {
            var h = 0;
            $this.find('img').each(function() {
                var $thisH = $(this).height()
                h = $thisH > h ? $thisH : h;
            });
            $this.css('height', h + $this.children().outerHeight() - $this.children().height())
        }
        else {
            var img = $this.find('img');
            img.css('margin-left', -img.filter(':visible').css('max-width', 'none').width() / 2);
        }
    });
}
function removePreloaderBaner(el) {
    var el = el.find('img[data-original]'),
    elL = el.length,
    i = 0;
    el.each(function() {
        var $this = $(this);
        $this.attr('src', $this.attr('data-original')).load(function() {
            $(this).fadeIn();
            $('.baner').find(preloader).remove();
            i++;
            if (i == elL) {
                banerResize('.baner:has(.cycle)');
                $('.baner').find(preloader).remove();
            }
        })
    })
}
function initCarouselJscrollPaneCycle(el) {
    el.find('.horizontal-carousel .carousel_js:not(.baner):not(.frame-scroll-pane):visible').myCarousel(carousel);
    el.find('.vertical-carousel .carousel_js:visible').myCarousel($.extend({}, carousel));
    if ($.exists(selScrollPane)) {
        el.find(selScrollPane).each(function() {
            var $this = $(this),
            api = $this.jScrollPane(scrollPane),
            api = api.data('jsp');
            $this.on('mousewheel', function(e, b, c, delta) {
                if (delta == -1 && api.getContentWidth() - api.getContentPositionX() != api.getContentPane().width())
                {
                    //            ширина блоку товару разом з мергінами
                    api.scrollByX(scrollPane.arrowButtonSpeed);
                    return false;
                }
                if (delta == 1 && api.getContentPositionX() != 0) {
                    api.scrollByX(-scrollPane.arrowButtonSpeed);
                    return false;
                }

            })
        })
    }
    el.find('.baner').each(function(){
        var $this = $(this),
        cycle = $this.find('.cycle'),
        next = $this.find('.next'),
        prev = $this.find('.prev');
        
        if (cycle.find('li').length > 1) {
            cycle.cycle($.extend({}, optionsCycle, {
                'next': next, 
                'prev': prev
            })).hover(function() {
                cycle.cycle('pause');
            }, function() {
                cycle.cycle('resume');
            });
            $(next).add(prev).show();
        }
        removePreloaderBaner(cycle); //cycle - parent for images
    })
}
function hideDrop(drop, form, durationHideForm) {
    var drop = $(drop);
    var closedrop = setTimeout(function() {
        drop.drop('closeDrop', drop);
    }, durationHideForm - 500/*time fadeout drop see on site*/)
    setTimeout(function() {
        drop.find(genObj.msgF).hide().remove();
        form.show();
        $(document).trigger({
            type: 'drop.show', 
            el: drop, 
            dropC: drop.find(drop.data('dropContent')).first()
        });
    }, durationHideForm)

    //    if close "esc" or click on body
    $(document).off('drop.beforeClose').on('drop.beforeClose', function(e) {
        clearTimeout(closedrop);
        if (e.el.is(drop)) {
            e.el.find(genObj.msgF).hide().remove();
            form.show();
        }
    })
}
function showHidePart(el, absolute, time) {
    if (time == undefined)
        time = 300;
    el.each(function() {
        var $this = $(this),
        $thisH = isNaN(parseInt($this.css('max-height'))) ? parseInt($this.css('height')) : parseInt($this.css('max-height')),
        $item = $this.children(),
        sumHeight = 0;
        $this.data('maxHeight', $thisH);
        $item.each(function() {
            tempH = $(this).outerHeight(true);
            sumHeight += tempH;
        })
        if (sumHeight > $thisH) {
            $this.css({
                'max-height': 'none', 
                'height': $thisH
            });
            var btn = $this.next(),
            textEl = btn.find(genObj.textEl);
            btn.addClass('d_i-b hidePart');
            if (!btn.is('[data-trigger]')) {
                textEl.html(textEl.data('show'))
                btn.toggle(function() {
                    var $thisB = $(this).addClass('showPart').removeClass('hidePart'),
                    textEl = $thisB.find(genObj.textEl);
                    sHH = 0;
                    $this.parents('li').children(':not(.wrapper-h)').each(function(){
                        sHH += $(this).outerHeight(true);
                    });
                    $thisB.prev().stop().animate({
                        'height': sumHeight
                    }, time, function() {
                        var sH = 0;
                        $this.parents('li').children(':not(.wrapper-h)').each(function(){
                            sH += $(this).outerHeight(true);
                        });
                        $this.data('heightDecor', sHH);
                        var wrapperH = $this.parent().nextAll('.wrapper-h');
                        wrapperH.css({
                            'width': '100%', 
                            'height': sH
                        }).fadeIn(time);
                        wrapperH.addClass('active')
                        $(this).removeClass('cut-height').addClass('full-height');
                        textEl.hide().html(textEl.data('hide')).fadeIn(time)
                    });
                },
                function() {
                    var $thisB = $(this).removeClass('showPart').addClass('hidePart'),
                    textEl = $thisB.find(genObj.textEl);
                    $thisB.parent().nextAll('.wrapper-h').animate({
                        'height': $this.data('heightDecor')
                    }, time, function(){
                        $(this).removeClass('active').fadeOut(time)
                    });
                    $thisB.prev().stop().animate({
                        'height': $thisH
                    }, time, function() {
                        $(this).removeClass('full-height').addClass('cut-height');
                        textEl.hide().html(textEl.data('show')).fadeIn(time)
                    });
                });
            }
        }
    });
    if (absolute){
        var sH = 0,
        li = el.parents('ul').children();
        li.each(function(){
            var $this = $(this),
            tempH = $this.outerHeight(),
            sH = tempH > sH ? tempH : sH;
            $this.append('<div class="wrapper-h"></div>')
        }).css('height', sH)
        
    }
}
function dropBaskResize() {
    var popupCart = $(genObj.popupCart);
    $(document).trigger({
        type: 'drop.show', 
        el: popupCart, 
        dropC: popupCart.find(popupCart.data('dropContent')).first()
    });
    wnd.trigger('resize.drop');
}
function decorElemntItemProduct(el) {
    if (!el)
        el = $('.animateListItems > li');
    if ($.existsN(el.closest('.animateListItems'))) {
        function curFunc() {
            el.each(function() {
                var $thisLi = $(this),
                sumH = 0,
                sumW = 0,
                decEl = $thisLi.find('.decor-element').css('height', '100%'),
                decElH = decEl.height(),
                decElW = decEl.width(),
                noVisT = $thisLi.find('.no-vis-table'),
                noVisTL = noVisT.length,
                $thisS = $thisLi.data('pos').match(/top|bottom|left|right/)[0];
                $thisLi.css('overflow', 'hidden');
                noVisT.each(function() {
                    var $this = $(this);
                    if ($thisS) {
                        var descW = $thisLi.find('.description').width()
                        switch ($thisS) {
                            case 'top':
                                $this.parent().css('top', sumH)
                                sumH = sumH + $this.outerHeight(true);
                                break;
                            case 'left':
                                $this.parent().css({
                                    'left': descW, 
                                    'top': sumH
                                })
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                break;
                        }
                    }
                })
                $thisLi.css({
                    'width': '', 
                    'height': '',
                    'overflow': ''
                });
                switch ($thisS) {
                    case 'top':
                        decEl.css({
                            'height': sumH + decElH
                        })
                        break;
                    case 'left':
                        decEl.css({
                            'width': sumW / noVisTL + decElW, 
                            'height': sumH > decElH ? sumH : decElH
                        })
                        break;
                }
            });
            wnd.scroll(); //if lazyload
        }
        setTimeout(curFunc, 400)
    }
}

function drawIcons(selIcons) {
    selIcons.each(function() {
        var $this = $(this),
        $thisW = $this.width(),
        $thisH = $this.height(),
        $thisT = parseInt($this.css('margin-top')),
        $thisL = parseInt($this.css('margin-left')),
        className = $this.attr('class').match(/(icon_)/).input.split(' ')[0];
        if (!$.existsN($this.children('svg'))) {
            if (icons[className] != undefined) {
                var paper = Raphael($this[0], $thisW, $thisH);
                s = paper.path(icons[className]).attr({
                    fill: $this.css('color'),
                    stroke: "none"
                });
                var k = ($thisW - 1) / s.getBBox().width;
                s.scale(k, k);
                s.translate(-$thisL, -$thisT)
                $this.css({
                    'margin-top': 0,
                    'margin-left': 0,
                    'position': 'relative'
                });
            }
        }
    })
}

function itemUserToolbar() {
    this.show = function(itemsUT, btn, hideSet, btnUp) {
        btn.on('click.UT', function() {
            var $this = $(this),
            dataRel = $this.data('rel');
            setcookie('condUserToolbar', dataRel, 0, '/')
            if (dataRel == 0) {
                $this.hide().next().show();
                itemsUT.children(hideSet).hide();
                itemsUT.stop().animate({
                    'width': btn.width()
                })
            }
            else {
                $this.hide().prev().show();
                itemsUT.stop().animate({
                    'width': '100%'
                }, function() {
                    itemsUT.children(hideSet).show();
                })
            }
        }).not('.activeUT').trigger('click.UT');
        wnd.off('scroll.UT').on('scroll.UT', function() {
            if (wnd.scrollTop() > wnd.height())
                btnUp.fadeIn();
            else
                btnUp.fadeOut();
        })
        itemsUT.fadeIn();
        return itemsUT;
    },
    this.resize = function(itemsUT, btnUp) {
        var btnW = btnUp.outerWidth(true),
        bodyW = body.width(),
        itemsUT = $(itemsUT),
        itemsUTCW = itemsUT.children().width();
        if ((bodyW - itemsUTCW) / 2 > btnW && wnd.scrollTop() > wnd.height())
            btnUp.fadeIn();
        else
            btnUp.fadeOut();
        itemsUT.css('width', bodyW)
        return itemsUT;
    }
}
function reinitializeScrollPane(el) {
    if ($.exists(selScrollPane)) {
        wnd.on('resize.scroll', function() {
            el.find(selScrollPane).each(function() {
                $(this).jScrollPane(scrollPane);
                var api = $(this).data('jsp');
                var throttleTimeout;
                if ($.browser.msie) {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                }
                else {
                    api.reinitialise();
                }
            });
        })
    }
}
function ieInput(els) {
    if (els == undefined || els == null)
        els = $(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])');
    els.not(':hidden').not('.visited').each(function() {
        var $this = $(this);
        $this.css({
            'width': function() {
                return 2 * $this.width() - $this.outerWidth();
            },
            'height': function() {
                return 2 * $this.height() - $this.outerHeight();
            }
        }).addClass('visited');
    });
}
function cuselInit(el, sel){
    var el = el == undefined ? body : el,
    sel = sel == undefined ? cuselOptions.changedEl : sel;
    if ($.existsN(el.find(cuselOptions.changedEl)) && $.isFunction(window.cuSel)) {
        cuSel($.extend({}, cuselOptions, {
            changedEl: sel
        }));
        if (ltie7)
            ieInput(el.find('.cuselText'));
    }
}
/*/declaration front functions*/