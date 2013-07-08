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
    imgVP: '#vimg',
    priceVariant: '.priceVariant',
    priceOrigVariant: '.priceOrigVariant',
    photoProduct: '.photoProduct'
}

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
/*object for not standart select (plugin cusel)*/
var paramsSelect = {
    changedEl: ".lineForm select",
    visRows: 100,
    scrollArrows: true
}
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
function margZoomLens() {
    $('#wrap').find('img').each(function() {
        var $this = $(this),
                mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2),
                mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);

        $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}')
    })
}
function initBtnBuy() {
    $(genObj.btnBuy).on('click', function() {
        Shop.Cart.countChanged = false;
        $(this).attr('disabled', 'disabled');
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem);
        return true;
    });
}
function navPortait() {
    var frameM = $('.frame-menu-main');
    headerMenu = $('.headerMenu');

    var headerFon = $('.headerFon'),
            heightFon = 0,
            temp_height = $this.find('> li').outerHeight();

    if ($.exists_nabir(frameM) && !frameM.children().hasClass('vertical')) {
        heightFon = frameM.offset().top + frameM.outerHeight(true)
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
function deleteWishListItem(el, id, vid) {
    var deletedItemPrice = el.closest(genObj.parentBtnBuy).find(genObj.btnBuy).data('price');
    recountWishListTotalPrise(deletedItemPrice, id, vid);

    if (el.closest(genObj.parentBtnBuy).siblings().length == 0) {
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    el.closest(genObj.parentBtnBuy).remove();
}
def_min = $('span#opt1').data('def_min');
def_max = $('span#opt2').data('def_max');
cur_min = $('span#opt3').data('cur_min');
cur_max = $('span#opt4').data('cur_max');

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

    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    /*call plugin menuImageCms (jquery.imagecms.js)*/
    $('.menu-main').menuImageCms({
        item: $('.menu-main').find('td'),
        duration: 200,
        drop: '.frame-item-menu > ul',
        countColumn: 5, //if not drop-side
        effectOn: 'slideDown',
        effectOff: 'slideUp',
        durationOn: 200,
        durationOff: 100,
        //sub2Frame: '.frame-l2', //if drop-side
        dropWidth: 480,
        evLF: 'hover',
        evLS: 'hover',
        frAClass: 'hoverM'
    })

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
                if ($(el).data('placement') == 'top right') {
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

                if (!dropEl.parent().hasClass('active')) {
                    if (!$.exists_nabir(dropEl.find('.frame-search-thumbail')))
                        dropEl.append('<ul class="frame-search-thumbail items"></ul>');
                    dropEl.find('.frame-search-thumbail').append(elWrap).find('.add_func_btn, #xBlock, .top_tovar, .btn, .frame_response, .tabs, .share_tov, .frame_tabs, .variantProd ').remove().end().parent().find('[data-clone="data-report"]').remove().end().append($('[data-clone="data-report"]').clone().removeClass('d_n'));

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
    initBtnBuy();

    if ($('#orderDetails'))
        renderOrderDetails();

    //Shop.Cart.countChanged = true;
    initShopPage(false);
    //Shop.Cart.countChanged = false;

    //shipping changing, re-render cart page
    if ($.exists_nabir(methodDeliv))
        methodDeliv.on('change', function() {
            recountCartPage();
            changeDeliveryMethod($('span.cuselActive').attr('val'));
        });

    if ($('#orderDetails'))
        renderOrderDetails();

    //shipping changing, re-render cart page
    if ($.exists_nabir(methodDeliv))
        methodDeliv.on('change', function() {
            recountCartPage();
        });

    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');


    $('.' + genObj.tinyBask + '.' + genObj.isAvail).live('click', function() {
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

    $('#applyGiftCert').on('click', function() {
        $('input[name=makeOrder]').val(0);
        $('input[name=checkCert]').val(1);
        $('#makeOrderForm').ajaxSubmit({
            url: '/shop/cart_api/getGiftCert',
            success: function(data) {
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
            }
        });

        $('input[name=makeOrder]').val(1);

        return false;
    });
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
                liBlock = $(this).closest(genObj.parentBtnBuy),
                btn = $('.info' + genObj.prefV + productId);

        var vName = btn.attr('data-vname'),
                vPrice = btn.attr('data-price'),
                vOrigPrice = btn.attr('data-origPrice'),
                vNumber = btn.attr('data-number'),
                vLargeImage = btn.attr('data-largeImage'),
                vMainImage = btn.attr('data-mainImage'),
                vStock = btn.attr('data-stock');

        $(genObj.photoProduct).attr('href', vLargeImage);
        $(genObj.imgVP).attr('src', vMainImage).attr('alt', vName);
        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);

        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);

        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + productId + genObj.btnBuy));

        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + productId).show();
    });

    /**Variants in Category*/
    $('[id ^= сVariantSwitcher_]').live('change', function() {
        var productId = parseInt($(this).attr('value')),
                liBlock = $(this).closest(genObj.parentBtnBuy),
                btn = liBlock.find('.btn' + genObj.prefV + productId);

        var vMediumImage = btn.attr('data-mediumImage'),
                vName = btn.attr('data-vname'),
                vPrice = btn.attr('data-price'),
                vOrigPrice = btn.attr('data-origPrice'),
                vNumber = btn.attr('data-number'),
                vStock = btn.attr('data-stock');

        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + productId).show();

        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.imgVC).attr('src', vMediumImage).attr('alt', vName);

        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);

        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + productId + genObj.btnBuy));
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

    /*call plugin myCarousel (jquery.imagecms.js and jquery.jcarousel.min.js) */
    $('.carousel_js:not(.vertical_carousel)').myCarousel({
        item: 'li',
        prev: '.btn_prev',
        next: '.btn_next',
        content: '.carousel',
        before: function() {
            var sH = 0,
                    brandsImg = $('.frame_brand img');
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

    adding = {
        vertical: true
    };
    $('.vertical_carousel.carousel_js').myCarousel({
        adding: adding,
        item: '.items_catalog > li',
        prev: '.btn_prev',
        next: '.btn_next',
        content: '.carousel'
    });

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

    try {
        if (!isTouch) {
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
            body.append('<style id="forCloudZomm"></style>')
            margZoomLens();
            $('#photoGroup').find('img').load(function() {
                margZoomLens();
            })
        }
    } catch (err) {
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
    try {
        $('a.fancybox').fancybox();
    } catch (err) {
    }
});
wnd.focus(function() {
    processPage();
    checkSyncs();
    processWish();
    recountCartPage();
    checkCompareWishLink();
    wishListCount();
    compareListCount();
})

// проверяем поддержку position: fixed;[start]
var isFixedSupported = (function() {
    var isSupported = null;
    if (document.createElement) {
        var el = document.createElement("div");
        if (el && el.style) {
            el.style.position = "fixed";
            el.style.top = "10px";
            var root = document.body;
            if (root && root.appendChild && root.removeChild) {
                root.appendChild(el);
                isSupported = el.offsetTop === 10;
                root.removeChild(el);
            }
        }
    }
    return isSupported;
})();

window.onload = function() {
    if (!isFixedSupported) {
        document.body.className += ' no-fixed-supported';
    }
    window.scrollBy(0, 1);
}

var topbar = $('.fixed')[0];

var windowHeight = window.innerHeight;

window.ontouchstart = function(e) {
    if (event.target !== topbar) {
        topbar.style = "";
    }
}
function getViewport() {

    var viewPortWidth;
    var viewPortHeight;

    // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
    if (typeof window.innerWidth != 'undefined') {
        viewPortWidth = window.innerWidth,
                viewPortHeight = window.innerHeight
    }

// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
    else if (typeof document.documentElement != 'undefined'
            && typeof document.documentElement.clientWidth !=
            'undefined' && document.documentElement.clientWidth != 0) {
        viewPortWidth = document.documentElement.clientWidth,
                viewPortHeight = document.documentElement.clientHeight
    }

    // older versions of IE
    else {
        viewPortWidth = document.getElementsByTagName('body')[0].clientWidth,
                viewPortHeight = document.getElementsByTagName('body')[0].clientHeight
    }
    return [viewPortWidth, viewPortHeight];
}
if (isTouch)
    window.onscroll = function() {
        topbar.style.top = window.pageYOffset || docElem.scrollTop || body.scrollTop + getViewport()[1] + 'px';
    };