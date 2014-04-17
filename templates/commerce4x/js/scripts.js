var isTouch = 'ontouchstart' in document.documentElement,
        wnd = $(window),
        body = $('body'),
        mainBody = $('.mainBody');

var genObj = {
    textEl: '.text-el', //селектор
    emptyCarthideElement: '#popupCart .inside_padd table, #shopCartPage',
    emptyCartshowElement: '#popupCart .inside_padd div.msg, #shopCartPageEmpty',
    pM: '.paymentMethod',
    trCartKit: 'tr.cartKit',
    frameCount: '.frame_count', //селектор
    countOrCompl: '.countOrCompl', //селектор
    priceOrder: '.priceOrder',
    minus: '.minus',
    plus: '.plus',
    parentBtnBuy: 'li, [data-rel="frameP"]', //селектор
    wishListIn: 'btn_cart', //назва класу
    compareIn: 'btn_cart', //назва класу
    toWishlist: 'toWishlist', //назва класу
    inWishlist: 'inWishlist', //назва класу
    toCompare: 'toCompare', //назва класу
    inCompare: 'inCompare', //назва класу
    tinyBask: 'tiny_bask', //назва класу
    isAvail: 'isAvail', //назва класу
    loginButton: '#loginButton', //селектор
    inCart: 'in_cart', //назва класу
    notAvail: 'not_avail', //назва класу
    btnBuy: '.btnBuy', //назва класу кнопка купити
    btnBuyCss: 'btn_buy', //назва класу
    btnCartCss: 'btn_cart', //назва класу
    descr: '.description',
    frameNumber: '.frame_number',
    frameVName: '.frame_variant_name',
    code: '.code',
    prefV: ".variant_",
    selVariant: '.variant',
    imgVC: '.vimg',
    imgVP: '.vimg',
    priceVariant: '.priceVariant',
    priceOrigVariant: '.priceOrigVariant',
    photoProduct: '.photoProduct'
}
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
/**
 * js object for filter handling
 * @type type
 */

var FilterManipulation = {
    formId: "#filter",
    OnChangeSubmitSelectors: "[name='brand[]'], .propertyCheck, [name='category[]']",
    OnClickSublitSelectors: ".filterSubmit",
    filterSubmit: function() {
        $(FilterManipulation.formId).submit();
        $(FilterManipulation.OnChangeSubmitSelectors).attr('disabled', 'disabled');
    }
};

/**
 * handle products list order and per page event
 * @type type
 */

var orderSelect = {
    mainSelector: ".sort",
    orderSelector: "#sort",
    perPageSelector: "#sort2",
    filterForm: "form#filter",
    addHiddenFields: function() {
        $(orderSelect.filterForm + ' input[name="order"]').val($(orderSelect.orderSelector).val());
        $(orderSelect.filterForm + ' input[name="user_per_page"]').val($(orderSelect.perPageSelector).val());
        $(orderSelect.filterForm).submit();

    }

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

function deleteComprasionItem(el) {
    var $this = el,
            $thisI = $this.parents(genObj.parentBtnBuy),
            $thisP = $this.parents('[data-equalhorizcell]').last(),
            count_products = $thisP.find(optionCompare.right),
            gen_count_products = count_products.add($thisP.siblings().find(optionCompare.right)).length,
            count_productsL = count_products.length;

    $thisI.remove();

    if (count_productsL == 1) {
        var btn = $('[data-href="#' + $thisP.attr('id') + '"],[href="#' + $thisP.attr('id') + '"]').parent();
        $thisP.find(optionCompare.left).remove();

        if ($.exists_nabir(btn.next()))
            btn.next().children().click();
        else
            btn.prev().children().click();

        btn.remove();
    }
    if (gen_count_products == 1) {
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }

    $('.frame_tabsc > div').equalHorizCell('refresh');
    if (optionCompare.onlyDif.parent().hasClass('active'))
        optionCompare.onlyDif.click();
    else
        optionCompare.allParams.click();
}
function recountWishListTotalPrise(deletedItemPrice, id, vid) {

    var arr = JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [],
            arr = _.without(arr, id + '_' + vid);
    localStorage.setItem('wishList', JSON.stringify(arr));

    var wishListTotal = $('#wishListTotal');
    wishListTotal.text((wishListTotal.text() - deletedItemPrice).toFixed(pricePrecision));
}
function deleteWishListItem(el, id, vid, price) {
    recountWishListTotalPrise(price, id, vid);

    if (el.closest(genObj.parentBtnBuy).siblings().length == 0) {
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    el.closest(genObj.parentBtnBuy).remove();
}

function processWish() {
    //wishlist checking
    var WishList = Shop.WishList.all();
    $('.' + genObj.toWishlist).each(function() {
        if (WishList.indexOf($(this).data('prodid') + '_' + $(this).data('varid')) !== -1) {
            var $this = $(this);
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
    $('.' + genObj.inWishlist).each(function() {
        if (WishList.indexOf($(this).data('prodid') + '_' + $(this).data('varid')) === -1) {
            var $this = $(this);
            $this.addClass(genObj.toWishlist).removeClass(genObj.inWishlist).removeClass(genObj.wishListIn).attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
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
    $('.' + genObj.inCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) === -1) {
            var $this = $(this);
            $this.addClass(genObj.toCompare).removeClass(genObj.inCompare).removeClass(genObj.compareIn).attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
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
        var $this = $(this),
                key = $this.data('prodid') + '_' + $this.data('varid');

        if (keys.indexOf(key) != -1) {
            $this.removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).removeAttr('disabled').html(inCart).unbind('click').on('click', function() {
                Shop.Cart.countChanged = false;
                togglePopupCart();
            }).closest(genObj.parentBtnBuy).addClass(genObj.inCart);
        } else {
            $(this).removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).html(toCart).removeAttr('disabled').unbind('click').on('click', function() {
                Shop.Cart.countChanged = false;
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart);
        }
    });

//    $(genObj.btnBuy + '.' + genObj.btnBuyCss).each(function() {
//        var key = $(this).data('prodid') + '_' + $(this).data('varid');
//        if (keys.indexOf(key) == -1) {
//            $(this).removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).html(toCart).removeAttr('disabled').unbind('click').on('click', function() {
//                Shop.Cart.countChanged = false;
//                var cartItem = Shop.composeCartItem($(this));
//                Shop.Cart.add(cartItem);
//            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart);
//        }
//    });
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
            var totalPrice = cartItem.count * cartItem.price;

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

        $(genObj.frameCount + ' input').die('keyup').live('keyup', function() {
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

        if (!ltie8)
            cuSel({
                changedEl: '#paymentMethod'
            });
    });
}


function recountCartPage() {
    var ca = $('span.cuselActive');
    if (ltie8)
        ca = $('.met_del[selected]');

    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));

    if ($.isFunction(window.load_certificat)) {
        load_certificat();
    }

    if ($.isFunction(window.get_discount)) {
        get_discount();
    }


    var discount = Shop.Cart.discount;
    var finalAmount = parseFloat(Shop.Cart.getFinalAmount());

    if (discount != null && discount != 0)
        finalAmount = finalAmount - parseFloat(discount['result_sum_discount_convert']);


    if (Shop.Cart.gift != undefined && Shop.Cart.gift != 0 && !Shop.Cart.gift.error)
        finalAmount = finalAmount - parseFloat(Shop.Cart.gift.value);

    if (finalAmount - Shop.Cart.shipping < 0)
        finalAmount = Shop.Cart.shipping;

    $('span#totalPrice').html(parseFloat(Shop.Cart.getTotalPriceOrigin()).toFixed(pricePrecision));
    $('span#finalAmount').html(finalAmount.toFixed(pricePrecision));
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
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }

    if (inServerWish != NaN)
    {

        if (Shop.WishList.all().length != inServerWish) {
            Shop.WishList.sync();

        }
    }
    if (inServerCart != NaN)
    {
        if (Shop.Cart.getAllItems().length != inServerCart)
            Shop.Cart.sync();
    }
}
;
function wishListCount() {
    $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
}
function compareListCount() {
    $('#compareCount').html('(' + Shop.CompareList.all().length + ')');
}

$(document).ready(function() {
    //////////////
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

    $('.menu-main').menuPacket2(optionsMenu);

    if ($.exists('.lineForm')) {
        if (!($('#orderDetails').length > 0 && ltie8)) {
            var params = {
                changedEl: ".lineForm select",
                visRows: 100,
                scrollArrows: true
            }
            cuSel(params);
        }
    }

    $('.drop').drop({
        overlayColor: '#000',
        overlayOpacity: '0.6',
        place: 'center',
        effon: 'fadeIn',
        effoff: 'fadeOut',
        duration: 500,
        before: function(el, dropEl) {
            if ($(dropEl).hasClass('drop-report')) {

                $(dropEl).find(genObj.parentBtnBuy).remove();
                var elWrap = $(el).closest(genObj.parentBtnBuy).clone().removeAttr('style').removeAttr('class'),
                        dropEl = $(dropEl).find('.drop-content');

                //adding product info into form
                var formCont = $('#data-report');
                var productId = $(el).attr('data-prodid');

                //alert(productId);
                formCont.find('input[name="ProductId"]').val(productId)

                elWrap.find('.photo').prependTo(elWrap)

                if (!dropEl.parent().hasClass('active')) {
                    if (!$.exists_nabir(dropEl.find('.frame-search-thumbail')))
                        dropEl.append('<ul class="frame-search-thumbail items"></ul>');

                    dropEl.find('.frame-search-thumbail')
                            .append(elWrap)
                            .find('.top_tovar, .btn, .frame_response, .tabs, .share_tov, .frame_tabs, .variantProd ')
                            .remove()
                            .end()
                            .parent()
                            .find('[data-clone="data-report"]')
                            .remove()
                            .end()
                            .append($('[data-clone="data-report"]')
                            .clone()
                            .removeClass('d_n'));
                }
                return $(el);

            }
        },
        after: function(el, dropEl) {

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

    processPage();
    checkSyncs();
    processWish();
    recountCartPage();
    var methodDeliv = $('#method_deliv');
    if (window.location.href.match(/cart/) && $.exists_nabir(methodDeliv))
        changeDeliveryMethod(methodDeliv.val());
    $('#popupCart').html(Shop.Cart.renderPopupCart())

    //click 'add to cart'


    if ($('#orderDetails'))
        renderOrderDetails();

    //Shop.Cart.countChanged = true;
    initShopPage(false);
    //Shop.Cart.countChanged = false;

    //shipping changing, re-render cart page

    if ($('#orderDetails'))
        renderOrderDetails();

    if ($.exists_nabir(methodDeliv))
        methodDeliv.on('change', function() {
            recountCartPage();
            if (!ltie8)
                changeDeliveryMethod($('span.cuselActive').attr('val'));
            else
                changeDeliveryMethod($('.met_del[selected]').attr('value'));
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
        if ($.exists_nabir(methodDeliv))
            recountCartPage();

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

    $('.' + genObj.toCompare).live('click', function() {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });

    $('.' + genObj.toWishlist).live('click', function() {
        var id = $(this).data('prodid');
        var vid = $(this).data('varid');
        var price = $(this).data('price');
        Shop.WishList.add(id, vid, price, $(this));
    });

    $('.' + genObj.inWishlist).live('click', function() {
        document.location.href = '/shop/wish_list';
    });

    $('.' + genObj.inCompare).live('click', function() {
        document.location.href = '/shop/compare';
    });

    /*      Wish-list event listeners       */

    $(document).on('wish_list_add', function(e) {
        if (e.dataObj.success == true) {
            wishListCount();
            var $this = $('.' + genObj.toWishlist + '[data-varid=' + e.dataObj.varid + ']' + '[data-prodid=' + e.dataObj.id + ']');
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        checkCompareWishLink();
        $this.tooltip();
    });


    $(document).on('compare_list_add', function(e) {
        if (e.dataObj.success == true) {
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        compareListCount();

        checkCompareWishLink();
        $this.tooltip();
    });

    $(document).on('compare_list_add wish_list_rm compare_list_rm compare_list_sync', function() {
        checkCompareWishLink();
    });
    /*     refresh page after sync      */
    $(document).on('wish_list_sync compare_list_sync', function() {
        processWish();
        checkCompareWishLink();
    });

    $(document).on('compare_list_rm compare_list_sync', function() {
        compareListCount();
    });

    $(document).on('wish_list_rm wish_list_sync', function() {
        wishListCount();
    });

//    $('#applyGiftCert').on('click', function() {
//        $('input[name=makeOrder]').val(0);
//        $('input[name=checkCert]').val(1);
//        $('#makeOrderForm').ajaxSubmit({
//            url: '/shop/cart_api/getGiftCert',
//            success: function(data) {
//                try {
//                    var dataObj = JSON.parse(data);
//
//                    Shop.Cart.giftCertPrice = dataObj.cert_price;
//
//                    if (Shop.Cart.giftCertPrice > 0)
//                    {// apply certificate
//                        $('#giftCertPrice').html(parseFloat(Shop.Cart.giftCertPrice).toFixed(pricePrecision) + ' ' + curr);
//                        $('#giftCertSpan').show();
//                        //$('input[name=giftcert], #applyGiftCert').attr('disabled', 'disabled')
//                    }
//
//                    Shop.Cart.totalRecount();
//                    recountCartPage();
//                } catch (e) {
//                    //console.error('Checking gift certificate filed. '+e.message);
//                }
//            }
//        });
//
//        $('input[name=makeOrder]').val(1);
//
//        return false;
//    });
    //variants

    function existsVnumber(vNumber, liBlock) {
        if ($.trim(vNumber) != '') {
            var $number = liBlock.find(genObj.frameNumber).show()
            $number.find(genObj.code).html('(' + vNumber + ')');
        } else {
            var $number = liBlock.find(genObj.frameNumber).hide()
        }
    }
    function existsVnames(vName, liBlock) {
        if ($.trim(vName) != '') {
            var $vname = liBlock.find(genObj.frameVName).show()
            $vname.find(genObj.code).html('(' + vName + ')');
        } else {
            var $vname = liBlock.find(genObj.frameVName).hide()
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
        var productId = parseInt($(this).attr('value')),
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
        var productId = parseInt($(this).attr('value')),
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

    $(FilterManipulation.OnChangeSubmitSelectors).on('change', function() {
        FilterManipulation.filterSubmit();
    });

    $(FilterManipulation.OnClickSubmitSelectors).on('click', function(event) {
        event.preventDefault();
        FilterManipulation.filterSubmit();
    });

    $('span.filterLable').on('click', function() {
        var input = $(this).prev('.niceCheck').find('input').not('[disabled=disabled]');
        if (input.is(':checked')) {
            input.attr('checked', false);
            input.trigger('change');
        }
        else {
            input.attr('checked', 'checked');
            input.trigger('change');
        }
    });

    $(orderSelect.mainSelector + '.lineForm input[type="hidden"]').on('change', function() {
        orderSelect.addHiddenFields();
    });

    $('#sort').live('change', function() {
        $('input[name=order]').val($(this).val())
        $('form#filter').submit();
    });
    $('#sort2').live('change', function() {
        $('input[name=user_per_page]').val($(this).val())
        $('form#filter').submit();
    });

    $('.filter_by_cat').live('click', function() {
        $('input[name=category]').val($(this).attr('data-id'));
        $('form#filter').submit();
        return false;
    })

    $('.del_filter_item').bind('click', function() {
        //console.log($('input#' + $(this).attr('data-id')));
        var data = $(this).attr('data-id').split("/");
        $('input#' + $(this).attr('data-id')).click();
        return false;
    })

    $('.del_price').bind('click', function() {
        $('input[name=lp]').val($(this).attr('def_min'));
        $('input[name=rp]').val($(this).attr('def_max'));
        $('form#filter').submit();
        return false;
    })
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
        groupButtons: '.groupButton',
        before: function() {
            var sH = 0;
            var brandsImg = $('.frame_brand img')
            if ($.exists_nabir(brandsImg.closest('.carousel_js'))) {
                brandsImg.each(function() {
                    var $thisH = $(this).height()
                    if ($thisH > sH)
                        sH = $thisH;
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

    /*function for change activity elements alternate images on page seperate tovar (fancybox)*/
    function fancyboxProduct() {
        var itemThumbs = $('.item_tovar .frame_thumbs > li, .photoProduct'),
                itemThumbsL = itemThumbs.length;
        if ($.exists_nabir(itemThumbs)) {
            itemThumbs.click(function() {
                var $this = $(this);
                itemThumbs.removeClass('active');
                $this.addClass('active');
            })
            $('.fancybox-next').live('click', function() {
                var $this = itemThumbs.filter('.active'),
                        $thisI = itemThumbs.index($this);

                if (itemThumbs.index($this) != itemThumbsL - 1) {
                    $this.removeClass('active');
                    $(itemThumbs[$thisI + 1]).addClass('active');
                }
                else
                    itemThumbs.first().click()
            });
            $('.fancybox-prev').live('click', function() {
                var $this = itemThumbs.filter('.active'),
                        $thisI = itemThumbs.index($this);
                if (itemThumbs.index($this) != 0) {
                    $this.removeClass('active')
                    $(itemThumbs[$thisI - 1]).addClass('active')
                }
                else
                    itemThumbs.last().click()
            })
            $(".fancybox-wrap").unbind('mousewheel.fb');
        }
    }
    /*call function fancyboxProduct*/
    fancyboxProduct();

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
    try {
        $('a.fancybox').fancybox();
    } catch (err) {
    }
});
wnd.focus(function() {
    processPage();
    checkSyncs();
    processWish();
    //recountCartPage();
    checkCompareWishLink();
    wishListCount();
    compareListCount();
})
