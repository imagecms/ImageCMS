function processWish() {
    //wishlist checking
    var wishlist = Shop.WishList.all();
    $('.' + genObj.toWishlist).each(function() {
        if (wishlist.indexOf($(this).data('prodid')) !== -1) {
            var $this = $(this);
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });

    //comparelist checking
    var comparelist = Shop.CompareList.all();
    $('.' + genObj.toCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) !== -1) {
            var $this = $(this);
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).addClass(genObj.compareIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
}

function processPage() {
    //update page content
    //update products count
    Shop.Cart.totalRecount();

    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');
    if (!Shop.Cart.totalCount)
        $('.' + genObj.tinyBask + '.' + genObj.isAvail).removeClass(genObj.isAvail);
    else if (Shop.Cart.totalCount && !$('.' + genObj.tinyBask).hasClass(genObj.isAvail)) {
        $('.' + genObj.tinyBask).addClass(genObj.isAvail).on('click', function() {
            initShopPage();
        })
    }

    var keys = [];
    _.each(Shop.Cart.getAllItems(), function(item) {
        keys.push(item.id + '_' + item.vId);
    });

    //update all product buttons
    $(genObj.btnBuy).each(function() {
        var key = $(this).data('prodid') + '_' + $(this).data('varid');
        if (keys.indexOf(key) != -1) {
            $(this).removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).removeAttr('disabled').html(inCart).unbind('click').on('click', function() {
                Shop.Cart.countChanged = false;
                togglePopupCart();
            }).closest(genObj.parentBtnBuy).addClass(genObj.inCart);
        }
    });
    $(genObj.btnBuy + '.' + genObj.btnCartCss).each(function() {
        var key = $(this).data('prodid') + '_' + $(this).data('varid');
        if (keys.indexOf(key) == -1) {
            $(this).removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).html(toCart).removeAttr('disabled').unbind('click').on('click', function() {
                Shop.Cart.countChanged = false;
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart);
        }
    });
}

function initShopPage(showWindow) {
    if (Shop.Cart.countChanged == false) {

        Shop.Cart.totalRecount();

        $('#popupCart').html(Shop.Cart.renderPopupCart()).hide();

        $('[data-rel="plusminus"]').plusminus({
            prev: 'prev.children(:eq(1))',
            next: 'prev.children(:eq(0))'
        });


        function chCountInCart($this) {
            var pd = $this;
            var cartItem = new Shop.cartItem({
                id: pd.data('prodid'),
                vId: pd.data('varid'),
                price: pd.data('price'),
                kit: pd.data('kit')
            });

            if (checkProdStock && pd.closest(genObj.frameCount).find('input').val() >= pd.closest(genObj.frameCount).find('input').data('max')) {
                pd.closest(genObj.frameCount).find('input').val(pd.closest(genObj.frameCount).find('input').data('max'));
                pd.closest(genObj.frameCount).tooltip();
            }

            cartItem.count = pd.closest(genObj.frameCount).find('input').val();

            var word = cartItem.kit ? kits : pcs;
            pd.closest('tr').find(genObj.countOrCompl).html(word);

            Shop.Cart.chCount(cartItem, function() {
            });


            $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');
            totalPrice = cartItem.count * cartItem.price;
            pd.closest('tr').find(genObj.priceOrder).html(totalPrice.toFixed(pricePrecision));

            $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));

            if (pd.closest(genObj.frameCount).find('input').val() == 1)
                pd.closest(genObj.frameCount).find(genObj.minus).attr('disabled', 'disabled');
            else
                pd.closest(genObj.frameCount).find(genObj.minus).removeAttr('disabled');
        }
        // change count
        $(genObj.frameCount + ' ' + genObj.minus + ', ' + genObj.frameCount + ' ' + genObj.plus).die('click').live('click', function() {
            chCountInCart($(this).closest('div'));
        });

        $(genObj.frameCount + 'input').die('keyup').live('keyup', function() {
            chCountInCart($(this).prev('div'));
        });

        if (typeof showWindow == 'undefined' || showWindow != false)
            $('#showCart').click();
    }
}
;

function rmFromPopupCart(context, isKit) {
    if (typeof isKit != 'undefined' && isKit == true)
        var tr = $(context).closest(genObj.trCartKit);
    else
        var tr = $(context).closest('tr');

    var cartItem = new Shop.cartItem();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');

    Shop.Cart.rm(cartItem).totalRecount();
}
;

function togglePopupCart() {
    $('#showCart').click();
    return false;
}

function renderOrderDetails() {
    $('#orderDetails').html(_.template($('#orderDetailsTemplate').html(), {
        cart: Shop.Cart
    }));
}

function changeDeliveryMethod(id) {
    $.get('/shop/cart_api/getPaymentsMethods/' + id, function(dataStr) {
        data = JSON.parse(dataStr);
        var replaceStr = _.template('<select id="paymentMethod" name="paymentMethodId"><% _.each(data, function(item) { %><option value="<%-item.id%>"><%-item.name%></option> <% }) %></select> ', {
            data: data
        });
        $(genObj.pM).html(replaceStr);

        cuSel({
            changedEl: '#paymentMethod'
        });
    });
}


function recountCartPage() {
    var ca = $('span.cuselActive');
    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
    delete ca;

    $('span#totalPrice').html(parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision));
    $('span#finalAmount').html(parseFloat(Shop.Cart.getFinalAmount()).toFixed(pricePrecision));
    $('span#shipping').html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));

    $('span.curr').html(curr);
}

function emptyPopupCart() {
    $(genObj.emptyCarthideElement).hide();
    $(genObj.emptyCartshowElement).removeClass('d_n').show();
}

function checkCompareWishLink() {
    var wishListFrame = $('#wishListData'),
            compareListFrame = $('#compareListData'),
            refS = '[data-rel="ref"]',
            notRefS = '[data-rel="notref"]';

    if (Shop.WishList.all().length) {
        wishListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        wishListFrame.find(notRefS).addClass('d_n');
    }
    else {
        wishListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        wishListFrame.find(notRefS).removeClass('d_n');
    }

    if (Shop.CompareList.all().length) {
        compareListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        compareListFrame.find(notRefS).addClass('d_n');
    }
    else {
        compareListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        compareListFrame.find(notRefS).removeClass('d_n');
    }
}

function checkSyncs() {
    alert()
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }
    if (inServerWish != NaN)
    {
        if (Shop.WishList.all().length != inServerWish)
            Shop.WishList.sync();
    }
    if (inServerCart != NaN)
    {
        if (Shop.Cart.getAllItems().length != inServerCart)
            Shop.Cart.sync();
    }
}
;

$(document).ready(function() {
    processPage();
    checkSyncs();
    processWish();
    recountCartPage();
    if (window.location.href.match(/cart/))
        changeDeliveryMethod($('#method_deliv').val());
    $('#popupCart').html(Shop.Cart.renderPopupCart())

    //click 'add to cart'
    $('.' + genObj.btnBuyCss).not('.psPay').on('click', function() {
        Shop.Cart.countChanged = false;
        $(this).attr('disabled', 'disabled');
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem);
        return true;
    });

    if ($('#orderDetails'))
        renderOrderDetails();

    //Shop.Cart.countChanged = true;
    initShopPage(false);
    //Shop.Cart.countChanged = false;

    //shipping changing, re-render cart page
    if ($('#method_deliv'))
        $('#method_deliv').on('change', function() {
            recountCartPage();
            changeDeliveryMethod($('span.cuselActive').attr('val'));
        });

    if ($('#orderDetails'))
        renderOrderDetails();

    //shipping changing, re-render cart page
    if ($('#method_deliv'))
        $('#method_deliv').on('change', function() {
            recountCartPage();
        });

    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');


    $('.' + genObj.tinyBask + '.' + genObj.isAvail).on('click', function() {
        initShopPage();
    });

    checkCompareWishLink();

    //cart content changed
    $(document).live('cart_changed', function() {

        //Shop.Cart.totalRecount();
        processPage();
        renderOrderDetails();
        if ($('#method_deliv'))
            recountCartPage();
        //update popup cart
        //$('table.table_order.preview_order td:last-child span:last-child').last().html(Shop.Cart.totalPrice.toFixed(pricePrecision));
        //
        $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));
        if (Shop.Cart.totalCount == 0)
            emptyPopupCart();
    });


    $(document).on('after_add_to_cart', function(event) {
        initShopPage();
        Shop.Cart.countChanged = false;
    });

    $(document).on('cart_rm', function(data) {
        if (!data.cartItem.kit)
            $('#popupProduct_' + data.cartItem.id + '_' + data.cartItem.vId).remove();
        else
            $('#popupKit_' + data.cartItem.kitId).remove();
    });

    $('.' + genObj.toCompare).on('click', function() {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });

    $('.' + genObj.toWishlist).on('click', function() {
        var id = $(this).data('prodid');
        var vid = $(this).data('varid');
        Shop.WishList.add(id, vid);
    });

    $('.' + genObj.inWishlist).die('click').live('click', function() {
        document.location.href = '/shop/wish_list';
    });

    $('.' + genObj.inCompare).die('click').live('click', function() {
        document.location.href = '/shop/compare';
    });

    /*      Wish-list event listeners       */

    $(document).on('wish_list_add', function(e) {
        if (e.dataObj.success == true) {
            $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
            var $this = $('.' + genObj.toWishlist + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        checkCompareWishLink();
        $this.tooltip();
    });


    $(document).on('compare_list_add', function(e) {
        if (e.dataObj.success == true) {
            $('#compareListCount').html('(' + Shop.WishList.all().length + ')');
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }

        $('#compareCount').html('(' + Shop.CompareList.all().length + ')');

        checkCompareWishLink();
        $this.tooltip();
    });

    $(document).on('compare_list_add wish_list_rm compare_list_rm compare_list_sync', function() {
        checkCompareWishLink();
    });
    /*     refresh page after sync      */
    $(document).on('wish_list_sync compare_list_sync', function() {
        processWish();
    });

    $(document).on('compare_list_rm compare_list_sync', function() {
        $('#compareCount').html('(' + Shop.CompareList.all().length + ')');
    });

    $(document).on('wish_list_rm wish_list_sync', function() {
        $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
    });

    $('#applyGiftCert').on('click', function(event) {
        event.preventDefault()

        $('input[name=checkCert]').val(1)
        $.post('/shop/cart_api/getGiftCert', {giftcert: $('input[name=giftcert]').val(), checkCert: $('input[name=checkCert]').val()}, function(data) {

            try {
                var dataObj = JSON.parse(data);

                Shop.Cart.giftCertPrice = dataObj.cert_price;

                if (Shop.Cart.giftCertPrice > 0)
                {// apply certificate
                    $('#giftCertPrice').html(parseFloat(Shop.Cart.giftCertPrice).toFixed(pricePrecision) + ' ' + curr);
                    $('#giftCertSpan').show();
                    //$('input[name=giftcert], #applyGiftCert').attr('disabled', 'disabled')
                }

                Shop.Cart.totalRecount();
                recountCartPage();
            } catch (e) {
                //console.error('Checking gift certificate filed. '+e.message);
            }

        })

        return false;
    });
    //variants

    function existsVnumber(vNumber, liBlock) {
        if ($.trim(vNumber) != '') {
            var $number = liBlock.find(genObj.frameNumber).show()
            $number.find(genObj.code).html('(' + vNumber + ')');
        } else {
            var $number = liBlock.find(genObj.frameNumber).show()
            $number.find(genObj.code).html(' ');
        }
    }
    function existsVnames(vName, liBlock) {
        if ($.trim(vName) != '') {
            var $vname = liBlock.find(genObj.frameVName).show()
            $vname.find(genObj.code).html('(' + vName + ')');
        } else {
            var $vname = liBlock.find(genObj.frameVName).hide()
            $vname.find(genObj.code).html(' ');
        }
    }
    function condProduct(vStock, liBlock, btnBuy) {
        liBlock.removeClass(genObj.notAvail).removeClass(genObj.inCart);

        if (vStock == 0)
            liBlock.addClass(genObj.notAvail);

        if (btnBuy.hasClass(genObj.btnCartCss))
            liBlock.addClass(genObj.inCart)
    }

    $('#variantSwitcher').live('change', function() {
        var productId = $(this).attr('value'),
                liBlock = $(this).closest(genObj.parentBtnBuy);

        var vId = $(genObj.prefV + productId).attr('data-id'),
                vName = $(genObj.prefV + productId).attr('data-vname'),
                vPrice = $(genObj.prefV + productId).attr('data-price'),
                vOrigPrice = $(genObj.prefV + productId).attr('data-origPrice'),
                vNumber = $(genObj.prefV + productId).attr('data-number'),
                vLargeImage = $(genObj.prefV + productId).attr('data-largeImage'),
                vMainImage = $(genObj.prefV + productId).attr('data-mainImage'),
                vStock = $(genObj.prefV + productId).attr('data-stock');

        $(genObj.photoProduct).attr('href', vLargeImage);
        $(genObj.imgVP).attr('src', vMainImage).attr('alt', vName);
        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);

        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);

        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + productId + genObj.btnBuy));

        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
    });

    /**Variants in Category*/
    $('[id ^= сVariantSwitcher_]').live('change', function() {
        var productId = $(this).attr('value'),
                liBlock = $(this).closest(genObj.parentBtnBuy);

        var vMediumImage = liBlock.find(genObj.prefV + productId).attr('data-mediumImage'),
                vId = $(genObj.prefV + productId).attr('data-id'),
                vName = liBlock.find(genObj.prefV + productId).attr('data-vname'),
                vPrice = liBlock.find(genObj.prefV + productId).attr('data-price'),
                vOrigPrice = liBlock.find(genObj.prefV + productId).attr('data-origPrice'),
                vNumber = liBlock.find(genObj.prefV + productId).attr('data-number'),
                vStock = liBlock.find(genObj.prefV + productId).attr('data-stock');


        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();

        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.imgVC).attr('src', vMediumImage).attr('alt', vName);

        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);

        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId + genObj.btnBuy));
    });

});
