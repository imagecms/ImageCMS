/*declaration shop functions*/
//variants
var ShopFront = {
    Cart: {
        process: function() {
            if (Shop.Cart.length() == 0) {
                $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_b').addClass('d_n');
                $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_n').addClass('d_b');

                $(genObj.tinyBask).removeClass(genObj.isAvail);
                $(genObj.tinyBask).find(genObj.blockEmpty).show();
                $(genObj.tinyBask).find(genObj.blockNoEmpty).hide();
            }
            else {
                $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_n').addClass('d_b');
                $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_b').addClass('d_n');

                $(genObj.tinyBask).addClass(genObj.isAvail);
                $(genObj.tinyBask).find(genObj.blockEmpty).hide();
                $(genObj.tinyBask).find(genObj.blockNoEmpty).show();
            }
        },
        processBtnBuyCount: function(el) {
            //update page content
            //update products count
            el = el == undefined ? body : el;
            var keys = [];
            _.each(Shop.Cart.getAllItems(), function(item) {
                keys.push(item.id + '_' + item.vId);
            });
            //update all product buttons

            el.find(genObj.btnBuy).each(function() {
                var $this = $(this),
                key = $this.data('prodid') + '_' + $this.data('varid');
                if (keys.indexOf(key) == -1) {
                    $this.parent().removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).children().removeAttr('disabled').find(genObj.textEl).html(text.toCart)
                    decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
                    $this.unbind('click.buy').bind('click.buy', function(e) {
                        $(document).trigger('showActivity');
                        var cartItem = Shop.Cart.composeCartItem($(this));
                        Shop.Cart.add(cartItem, e.button == undefined ? false : true);
                    }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart).addClass(genObj.toCart);
                }
                else {
                    $this.parent().removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).children().removeAttr('disabled').find(genObj.textEl).html(text.inCart);
                    decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
                    $this.unbind('click.buy').bind('click.buy', function(e) {
                        $(document).trigger('showActivity');
                        ShopFront.Cart.initShopPage(true);
                    }).closest(genObj.parentBtnBuy).removeClass(genObj.toCart).addClass(genObj.inCart);
                }
            }).removeAttr('disabled');
            el.find(genObj.numberC).has(genObj.iPr).each(function() {
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
        },
        changeVariant: function(el) {
            el = el == undefined ? body : el;
            /*Variants in Category*/
            el.find(genObj.parentBtnBuy).find(genObj.changeVariantCategory).on('change', function() {
                var productId = parseInt($(this).attr('value')),
                liBlock = $(this).closest(genObj.parentBtnBuy),
                btnInfo = liBlock.find(genObj.prefV + productId).find(genObj.infoBut),
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
                ShopFront.Cart.existsVnumber(vNumber, liBlock);
                ShopFront.Cart.existsVnames(vName, liBlock);
                ShopFront.Cart.condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId).find(genObj.infoBut));
            });
        /*/Variants in Category*/
        },
        changeCount: function(el) {
            el = el == undefined ? body : el;
            el.find(genObj.plusMinus).filter(genObj.iPr).off('maxminValue').on('maxminValue', function(e) {
                var $this = $(this);

                var condTooltip = checkProdStock && e.res;
                if (condTooltip)
                    $this.closest(genObj.numberC).tooltip();

                $this.closest(genObj.frameCount).next().children().attr('data-count', $this.val())

                $(document).trigger({//for wishlist
                    'type': 'change_count_product',
                    'el': $this
                });
            });
            el.find(genObj.plusMinus).filter(genObj.iPr).plusminus($.extend({}, optionsPlusminus, {
                after: function(e, el, input) {
                    if (checkProdStock && input.val() == input.data('max'))
                        el.closest(genObj.numberC).tooltip();

                    input.closest(genObj.frameCount).next().children().attr('data-count', input.val())

                    $(document).trigger({//for wishlist
                        'type': 'change_count_product',
                        'el': input
                    });
                }
            }));
        },
        pasteItems: function(el) {
            el.find("img.lazy").lazyload(lazyload);
            wnd.scroll(); //for lazyload
            drawIcons(el.find(selIcons));
            ShopFront.Cart.processBtnBuyCount(el);
            el.find('[data-drop]').drop(optionsDrop);
        },
        initShopPage: function(showWindow, item) {
            $(genObj.popupCart).html(Shop.Cart.renderPopupCart());

            if ($(genObj.popupCart).is(':visible'))
                dropBaskResize();
            if (showWindow || $(genObj.popupCart).is(':visible'))
                $(document).trigger({
                    type: 'render_popup_cart',
                    el: $(genObj.popupCart)
                });
            $(genObj.frameBasks).find(genObj.plusMinus).plusminus($.extend({}, optionsPlusminus, {
                after: function(e, el, input) {
                    chCountInCart(el.closest(genObj.frameChangeCount), true, input);
                }
            }));
            function chCountInCart($this, btn, input) {
                var pd = $this,
                cartItem = new Shop.Cart.cartItem({
                    id: pd.data('prodid'),
                    vId: pd.data('varid'),
                    price: pd.data('price'),
                    addprice: pd.data('addprice'),
                    origprice: pd.data('origprice'),
                    kit: pd.data('kit')
                });
                if (input == undefined)
                    input = pd.closest(genObj.frameCount).find('input');
                var inputVal = input.val(),
                condTooltip = '';
                if (!btn)
                    condTooltip = btn;
                else
                    condTooltip = checkProdStock && inputVal >= input.data('max')

                if (condTooltip) {
                    pd.closest(genObj.numberC).tooltip();
                    inputVal = input.data('max');
                    $(document).trigger('hideActivity');
                }
                cartItem.count = inputVal;
                if (inputVal != ''){
                    var pos = input.getCursorPosition();
                    Shop.Cart.chCount(cartItem, function() {
                        input.setCursorPosition(pos, pos)
                    //input.focus();
                    });
                }
                var pdTrs = $('[data-id =' + pd.closest('tr[data-id]').data('id') + ']')
                pdTrs.each(function() {
                    pdTr = $(this);
                    var word = cartItem.kit ? text.kits : text.pcs;
                    if ($.existsN(pdTr.closest(genObj.orderDetails)))
                        word = cartItem.kit ? pluralStr(inputVal, text.plurKits) : pluralStr(inputVal, text.plurProd);
                    pdTr.find(genObj.priceOrder).html((cartItem.count * cartItem.price).toFixed(pricePrecision));
                    pdTr.find(genObj.priceAddOrder).html((cartItem.count * cartItem.addprice).toFixed(pricePrecision));
                    pdTr.find(genObj.priceOrigOrder).html((cartItem.count * cartItem.origprice).toFixed(pricePrecision));
                    pdTr.find(genObj.plusMinus).val(cartItem.count).text(cartItem.count);
                    pdTr.find(genObj.countOrCompl).html(word);
                })
            }
            testNumber($(genObj.frameBasks));
            $(genObj.frameBasks + ' input').off('maxminValue').on('maxminValue', function(e) {
                chCountInCart($(this).prev('div'), e.res, $(this));
            })
            if (showWindow) {
                ShopFront.Cart.togglePopup();
            }
        },
        rm: function(context, isKit) {
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
        },
        togglePopup: function() {
            $(document).trigger('showActivity');
            $(genObj.showCart).trigger({
                type: 'click'
            });
            return false;
        },
        countSum: function() {
            Shop.Cart.totalRecount();
            var length = Shop.Cart.length();

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
            $(genObj.tinyBask).add(genObj.popupCart).find(genObj.plurProd).each(function() {
                $(this).html(pluralStr(length, text.plurProd));
            });
        },
        existsVnumber: function(vNumber, liBlock) {
            if ($.trim(vNumber) != '') {
                var $number = liBlock.find(genObj.frameNumber).show()
                $number.find(genObj.code).html(vNumber);
            } else {
                liBlock.find(genObj.frameNumber).hide()
            }
        },
        existsVnames: function(vName, liBlock) {
            if ($.trim(vName) != '') {
                var $vname = liBlock.find(genObj.frameVName).show()
                $vname.find(genObj.code).html(vName);
            } else {
                liBlock.find(genObj.frameVName).hide()
            }
        },
        condProduct: function(vStock, liBlock, btnBuy) {
            liBlock.removeClass(genObj.notAvail + ' ' + genObj.inCart + ' ' + genObj.toCart);
            if (vStock == 0)
                liBlock.addClass(genObj.notAvail);
            else if (btnBuy.parent().hasClass(genObj.btnCartCss))
                liBlock.addClass(genObj.inCart)
            else
                liBlock.addClass(genObj.toCart)
        }
    },
    CompareList: {
        process: function() {
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
        },
        count: function() {
            var count = Shop.CompareList.all().length,
            btn = $(genObj.tinyCompareList).find('[data-href]').drop('destroy').off('click.tocompare');

            if (count > 0) {
                $(genObj.tinyCompareList).addClass(genObj.isAvail).find(genObj.blockNoEmpty).show().end().find(genObj.blockEmpty).hide();
                btn.on('click.tocompare', function() {
                    location.href = $(this).data('href');
                });
            }
            else {
                $(genObj.tinyCompareList).removeClass(genObj.isAvail).find(genObj.blockNoEmpty).hide().end().find(genObj.blockEmpty).show();
                btn.drop();
            }
            $(genObj.countTinyCompareList).each(function() {
                $(this).html(count);
            })
            Shop.CompareList.count = count;
            $(document).trigger({
                'type': 'change_count_cl'
            });
        }
    }

};
var DiscountFront = {
    getDiscount: function(a) {
        //            if (!$.exists('#countDisc'))
        //                body.append('<div id="countDisc" style="position:absolute;left: 50px;top: 150px;z-index:1000;">0</div>')
        //            $('#countDisc').text(parseInt($('#countDisc').text()) + 1);
        //            console.log(a)
        var k = true;
        if (!orderDetails)
            k = false;
        $(document).trigger('showActivity');
        $(document).trigger({
            'type': 'beforeDisplayDiscount'
        });
        $.ajax({
            type: 'GET',
            url: '/shop/cart_api/get_kit_discount',
            success: function(data) {
                var kitDiscount = parseFloat(data);
                Shop.Cart.kitDiscount = isNaN(kitDiscount) ? 0 : parseFloat(kitDiscount);

                if (!Discount)
                    DiscountFront.displayDiscount(null);

                if (k && !Discount) {
                    Order.displayInfoDiscount('');
                    Order.renderGiftInput('');
                }

                if (!discountInPopup && !k)
                    return false;
                else if (Discount) {
                    Discount.getDiscount(k);
                }
            }
        });
    },
    displayDiscount: function(obj) {
        Shop.Cart.totalRecount();
        Shop.Cart.discountProduct = 0;
        var tempdisc = false;
        if (obj != null)
            tempdisc = (parseFloat(obj.sum_discount_product) != 0 && obj.sum_discount_product != null) ? parseFloat(obj.sum_discount_product) : false;
        var discC = tempdisc || Shop.Cart.kitDiscount != 0;
        if (discC) {
            if (tempdisc)
                Shop.Cart.discountProduct += tempdisc;
            Shop.Cart.discountProduct += Shop.Cart.kitDiscount;

            $(genObj.curDiscount).each(function() {
                $(this).html(Shop.Cart.discountProduct.toFixed(pricePrecision));
            });
            $(genObj.genSumDiscount).each(function() {
                $(this).html(Shop.Cart.totalPriceOrigin.toFixed(pricePrecision));
            });
            $(genObj.frameDiscount).show();
        }
        else {
            $(genObj.frameDiscount).hide();
        }

        ShopFront.Cart.countSum();
        ShopFront.Cart.process();
        $(document).trigger('hideActivity');
        $(document).trigger({
            'type': 'displayDiscount',
            'obj': obj
        });
    }
}
var global = {
    processWish: function() {
        var wishlist = wishList.all();
        $(genObj.btnWish).each(function() {
            var $this = $(this);
            if (wishlist.indexOf($this.data('id').toString()) !== -1) {
                $this.addClass(genObj.wishIn);
                $this.find(genObj.toWishlist).hide();
                $this.find(genObj.inWishlist).show();
            }
            else {
                $this.removeClass(genObj.wishIn);
                $this.find(genObj.toWishlist).show();
                $this.find(genObj.inWishlist).hide();
            }
        });
    },
    wishListCount: function() {
        var count = wishList.all().length,
        btn = $(genObj.tinyWishList).find('[data-href]').drop('destroy').off('click.towish');

        if (count > 0) {
            $(genObj.tinyWishList).addClass(genObj.isAvail).find(genObj.blockNoEmpty).show().end().find(genObj.blockEmpty).hide();
            btn.on('click.towish', function() {
                location.href = $(this).data('href');
            });
        }
        else {
            $(genObj.tinyWishList).removeClass(genObj.isAvail).find(genObj.blockNoEmpty).hide().end().find(genObj.blockEmpty).show();
            btn.drop();
        }
        $(genObj.countTinyWishList).each(function() {
            $(this).html(count);
        });
        wishList.count = count;
        $(document).trigger({
            'type': 'change_count_wl'
        });
    },
    checkSyncs: function() {
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
    return $this.data('datas', $this.closest('form').serialize());
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
    var img = el.find('img[data-original]'),
    imgL = img.length,
    i = 0;
    img.each(function() {
        var $this = $(this);
        $this.attr('src', $this.attr('data-original')).load(function() {
            $(this).fadeIn();
            el.find(preloader).remove();
            i++;
            if (i == imgL) {
                banerResize(el);
            }
        })
    })
}
function initCarouselJscrollPaneCycle(el) {
    function _jC() {
        clearInterval(_jCI);
        el.find('.horizontal-carousel .carousel-js-css:not(.cycleFrame):not(.frame-scroll-pane):visible').myCarousel(carousel);
        el.find('.vertical-carousel .carousel-js-css:visible').myCarousel(carousel);
    }
    var _jCI;
    if (body.myCarousel)
        _jC();
    else
        _jCI = setInterval(_jC, 100);

    function _sP() {
        clearInterval(_sPI);
        if ($.exists(selScrollPane)) {
            el.find(selScrollPane).filter(':visible').each(function() {
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
    }
    var _sPI;
    if (body.jScrollPane)
        _sP();
    else
        _sPI = setInterval(_sP, 100);

    function _c() {
        clearInterval(_cI);
        el.find('.cycleFrame').each(function() {
            var $this = $(this),
                    cycle = $this.find('.cycle'),
                    next = $this.find('.next'),
                    prev = $this.find('.prev');

            if (cycle.find('li').length > 1) {
                cycle.cycle('destroy').cycle($.extend({}, optionsCycle, {
                    'next': next,
                    'prev': prev,
                    'pager': $this.find('.pager'),
                    'after': function() {
                        wnd.scroll();
                    }
                })).hover(function() {
                    cycle.cycle('pause');
                }, function() {
                    cycle.cycle('resume');
                });
                $(next).add(prev).show();
            }
            removePreloaderBaner($('.baner:has(.cycle)')); //cycle - parent for images
        });
    }
    var _cI;
    if (body.cycle)
        _c();
    else
        _cI = setInterval(_c, 100);
}
function hideDrop(drop, form, durationHideForm) {
    var drop = $(drop),
    closedrop = setTimeout(function() {
        drop.drop('close');
    }, durationHideForm - drop.data('drp').durationOff);
    setTimeout(function() {
        drop.find(genObj.msgF).hide().remove();
        form.show();
        drop.drop('heightContent');
    }, durationHideForm)

    //    if close "esc" or click on body
    drop.off('closed.' + $.drop.nS).on('closed.' + $.drop.nS, function(e) {
        clearTimeout(closedrop);

        e.drop.find(genObj.msgF).hide().remove();
        form.show();
    })
}
function showHidePart(el, absolute, time, btnPlace) {
    if (!time)
        time = 300;
    if (!btnPlace)
        btnPlace = 'next';
    el.each(function() {
        var $this = $(this),
                $thisH = isNaN(parseInt($this.css('max-height'))) ? parseInt($this.css('height')) : parseInt($this.css('max-height')),
                $item = $this.children(),
                sumHeight = 0;
        $this.addClass('showHidePart').data('maxHeight', $thisH);
        $this.find('*').css('max-height', 'none');
        $item.each(function() {
            sumHeight += $(this).outerHeight(true);
        });
        $this.find('*').css('max-height', '');

        if (sumHeight > $thisH) {
            $this.css({
                'max-height': 'none',
                'height': $thisH
            });
            var btn = $this[btnPlace](),
                    textEl = btn.find(genObj.textEl);
            btn.addClass('d_i-b hidePart');
            if (!btn.is('[data-trigger]')) {
                textEl.html(textEl.data('show'));
                btn.off('click.showhidepart').on('click.showhidepart', function() {
                    var $thisB = $(this);
                    if ($thisB.data("show") === "no" || !$thisB.data("show")) {
                        $thisB.addClass('showPart').removeClass('hidePart');
                        var textEl = $thisB.find(genObj.textEl),
                                sHH = 0;
                        $this.parents('li').children(':not(.wrapper-h)').each(function() {
                            sHH += $(this).height();
                        });

                        $thisB.prev().stop().animate({
                            'height': sumHeight
                        }, time, function() {
                            var sH = 0;
                            $this.css('max-height', 'none').data('heightDecor', sHH).parents('li').children(':not(.wrapper-h)').each(function() {
                                sH += $(this).height();
                            });
                            $this.parent().nextAll('.wrapper-h').css({
                                'width': '100%',
                                'height': sH
                            }).fadeIn().addClass('active');
                            $(this).removeClass('cut-height').addClass('full-height');
                            textEl.hide().html(textEl.data('hide')).fadeIn(time);
                        });
                        $thisB.data('show', "yes");
                    }
                    else {
                        var $thisB = $(this).removeClass('showPart').addClass('hidePart'),
                                textEl = $thisB.find(genObj.textEl);
                        $thisB.parent().nextAll('.wrapper-h').animate({
                            'height': $this.data('heightDecor')
                        }, time, function() {
                            $(this).removeClass('active').fadeOut();
                        });
                        $thisB.prev().stop().animate({
                            'height': $thisH
                        }, time, function() {
                            $(this).css('max-height', 'none').removeClass('full-height').addClass('cut-height');
                            textEl.hide().html(textEl.data('show')).fadeIn(time);
                        });
                        $thisB.data('show', "no");
                    }
                });
            }
        }
        $this.parents('.showHidePart').each(function() {
            var sH = 0;
            $(this).children().each(function() {
                sH += $(this).outerHeight(true);
            });
            $(this).css({
                'max-height': $(this).data('maxHeight'),
                'height': sH
            });
        });
    });
    if (absolute) {
        var sH = 0;
        var li = el.parents('ul').children();
        li.each(function() {
            var $this = $(this);
            tempH = $this.outerHeight();
            sH = tempH > sH ? tempH : sH;
            $this.append('<div class="wrapper-h"></div>');
        }).css('height', sH);
    }
}
function dropBaskResize() {
    $(genObj.popupCart).drop('heightContent');
    wnd.trigger('resize.drop');
}
function decorElemntItemProduct(el) {
    try {
        clearTimeout(curFuncTime);
    } catch (err) {
    }
    if (!el)
        el = $('.animateListItems > li');
    if ($.existsN(el.closest('.animateListItems'))) {
        function curFunc() {
            clearTimeout(curFuncTime);
            el.each(function() {
                var $thisLi = $(this),
                sumH = 0,
                sumW = 0,
                decEl = $thisLi.find('.decor-element').css({
                    'height': '100%',
                    'width': '100%',
                    'position': 'absolute',
                    'right': 'auto',
                    'left': 0,
                    'bottom': 'auto',
                    'top': 0
                }),
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
                        if ($thisS == 'top')
                            $this.parent().css({
                                'position': 'relative',
                                'width': ''
                            });
                        else
                            $this.parent().css({
                                'position': 'absolute',
                                'width': '100%'
                            });
                        switch ($thisS) {
                            case 'top':
                                $this.parent().css('top', sumH)
                                sumH = sumH + $this.outerHeight(true);
                                break;
                            case 'bottom':
                                $this.parent().css('top', -(sumH + $this.outerHeight(true)))
                                sumH = sumH + $this.outerHeight(true);
                                decEl.css({
                                    'bottom': 0,
                                    'top': 'auto'
                                })
                                break;
                            case 'left':
                                $this.parent().css({
                                    'left': descW,
                                    'top': sumH
                                })
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                break;
                            case 'right':
                                $this.parent().css({
                                    'left': -descW,
                                    'top': sumH
                                })
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                decEl.css({
                                    'right': 0,
                                    'left': 'auto'
                                })
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
                    case 'bottom':
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
                    case 'right':
                        decEl.css({
                            'width': sumW / noVisTL + decElW,
                            'height': sumH > decElH ? sumH : decElH
                        })
                        break;
                }
            });
            wnd.scroll(); //if lazyload
        }
        var curFuncTime = setTimeout(curFunc, 400)
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
                var paper = Raphael($this[0], $thisW, $thisH),
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
            setCookie('condUserToolbar', dataRel, 0, '/')
            if (dataRel == 0) {
                $this.removeClass('activeUT').hide().next().show().addClass('activeUT');
                itemsUT.closest('.frame-user-toolbar').removeClass('active');
                itemsUT.stop().css('width', btn.width());
            }
            else {
                $this.removeClass('activeUT').hide().prev().show().addClass('activeUT');
                itemsUT.stop().css('width', '');
                itemsUT.closest('.frame-user-toolbar').addClass('active');
            }
        }).not('.activeUT').trigger('click.UT');
        wnd.off('scroll.UT').on('scroll.UT', function() {
            if (wnd.scrollTop() > wnd.height() && !btnUp.hasClass('non-v'))
                btnUp.fadeIn();
            else
                btnUp.hide();
        });
        return itemsUT;
    }
    , this.resize = function(itemsUT, btnUp) {
        itemsUT = $(itemsUT);
        var btnW = btnUp.show().outerWidth(true),
                itemsUTCW = itemsUT.children().width();
        btnUp.hide();
        if ((wnd.width() - itemsUTCW) / 2 > btnW)
            btnUp.show().removeClass('non-v');
        else
            btnUp.hide().addClass('non-v');
        return itemsUT;
    };
}
function reinitializeScrollPane(el) {
    if ($.exists(selScrollPane)) {
        wnd.on('resize.scroll', function() {
            el.find(selScrollPane).filter(':visible').each(function() {
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
function ieBoxSize(els) {
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
function cuselInit(el, sel) {
    var el = el == undefined ? body : el,
    sel = sel == undefined ? cuselOptions.changedEl : sel;
    if ($.existsN(el.find(cuselOptions.changedEl)) && $.isFunction(window.cuSel)) {
        cuSel($.extend({}, cuselOptions, {
            changedEl: sel
        }));
        if (ltie7)
            ieBoxSize(el.find('.cuselText'));
    }
}
function testNumber(el) {
    var el = el == undefined ? body : el;
           
    el.find(genObj.numberC + ' input').on('testNumber', function(e) {
        if (e.res)
            $(this).tooltip('remove');
        else {
            $(this).tooltip();
        }
    }).testNumber();
//    ['.']
}
/*/declaration front functions*/