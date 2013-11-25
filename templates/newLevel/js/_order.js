if (selectDeliv)
    var methodDeliv = '#method_deliv';
else
    var methodDeliv = '[name = "deliveryMethodId"]';
function renderOrderDetails() {
    $(genObj.orderDetails).html(_.template($(genObj.orderDetailsTemplate).html(), {
        cart: Shop.Cart
    }));
    $(document).trigger({
        'type': 'renderorder.after',
        'el': $(genObj.orderDetails)
    })
    initShopPage(false);
    recountCartPage();
}

function changeDeliveryMethod(id) {
    $(genObj.pM).next().show();
    $.get('/shop/cart_api/getPaymentsMethods/' + id, function(dataStr) {
        var data = JSON.parse(dataStr),
                replaceStr = '';
        if (selectPayment)
            replaceStr = _.template('<div class="lineForm"><select id="paymentMethod" name="paymentMethodId"><% _.each(data, function(item) { %><option value="<%-item.id%>"><%-item.name%></option> <% }) %></select></div>', {
                data: data
            });
        else {
            replaceStr = _.template('<div class="frame-radio"><% var i=0 %><% _.each(data, function(item) { %> <div class="frame-label"><span class = "niceRadio b_n"><input type = "radio" name = "paymentMethodId" value = "<%-item.id%>" <% if (i == 0){ %>checked = "checked"<% i++} %> /></span><div class = "name-count"><span class = "text-el"><%-item.name%></span></div><div class="help-block"><%=item.description%></div></div> <% }) %></div>', {
                data: data
            });
        }
        $(genObj.pM).html(replaceStr);
        $(genObj.pM).next().hide();
        if (selectPayment)
            cuselInit($(genObj.pM), '#paymentMethod');
        else
            $(genObj.pM).nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
                        //,classRemove: 'b_n'//if not standart
            });
    });
}
function displayOrderSum(obj) {
    var discount = Shop.Cart.discount,
            kitDiscount = parseFloat(Shop.Cart.kitDiscount),
            finalAmount = Shop.Cart.getFinalAmount();

    if (Shop.Cart.koefCurr == undefined) {
        var sumBask = parseFloat(Shop.Cart.totalPrice).toFixed(pricePrecision),
                addSumBask = parseFloat(Shop.Cart.totalAddPrice).toFixed(pricePrecision);
        Shop.Cart.koefCurr = addSumBask / sumBask;
    }
    
    if (discount != null && discount != 0)
        finalAmount = finalAmount - discount['result_sum_discount_convert'];
    if (kitDiscount != 0)
        finalAmount = finalAmount - kitDiscount;
    finalAmount = finalAmount > Shop.Cart.shipping ? finalAmount : Shop.Cart.shipping;

    $(genObj.totalPrice).html(parseFloat(Shop.Cart.getTotalPriceOrigin()).toFixed(pricePrecision));
    $(genObj.finalAmount).html(parseFloat(finalAmount).toFixed(pricePrecision));
    $(genObj.finalAmountAdd).html((Shop.Cart.koefCurr * finalAmount).toFixed(pricePrecision));
    $(genObj.shipping).html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));

    if (obj != null) {
        if (parseFloat(obj.result_sum_discount_convert) > 0)
            $(genObj.frameGenDiscount).show();
        else
            $(genObj.frameGenDiscount).hide();
    }
    else
        $(genObj.frameGenDiscount).hide();
}
function recountCartPage() {
    Shop.Cart.totalRecount();
    var ca = "";
    if (selectDeliv)
        ca = $(genObj.frameDelivery).find('span.cuselActive');
    else
        ca = $(methodDeliv).filter(':checked');
    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
    if ($.isFunction(window.loadCertificat)) {
        loadCertificat(Shop.Cart.gift);
    }
    hideInfoDiscount();
    getDiscount();
}
function hideInfoDiscount() {
    var frameDiscountO = $(genObj.frameDiscount);
    frameDiscountO.empty();
    frameDiscountO.next(preloader).show(); //preloader
}
function displayInfoDiscount(tpl) {
    var frameDiscountO = $(genObj.frameDiscount);
    frameDiscountO.html(tpl);
    frameDiscountO.next(preloader).hide(); //preloader
}
function applyGift() {
    $(genObj.gift).find(preloader).show();
    var gift = 0;
    $.ajax({
        url: '/mod_discount/gift/get_gift_certificate',
        data: 'key=' + $('[name=giftcert]').val(),
        type: "GET",
        success: function(data) {
            if (data != '')
                gift = JSON.parse(data);
            $(genObj.gift).find(preloader).hide();
            Shop.Cart.gift = gift;
            recountCartPage();
        }
    });
    return false;
}

function renderGiftInput(tpl) {
    if (tpl == '')
        $(genObj.gift).empty();
    else
        $(genObj.gift).html(tpl);
}
function giftError(msg) {
    $(genObj.gift).children(genObj.msgF).remove()
    if (msg) {
        $(genObj.gift).append(message.error(msg));
        drawIcons($(genObj.gift).find(selIcons))
    }
}
function renderGiftSucces(tpl, gift) {
    $(genObj.certPrice).html(gift.value)
    $(genObj.certFrame).show()
    $(genObj.gift).children(genObj.msgF).remove();
    $(genObj.gift).html(tpl);
}

function initOrder() {
    if (selectDeliv) {
        cuselInit($(genObj.frameDelivery), methodDeliv);
        $(methodDeliv).on('change.methoddeliv', function() {
            var activeVal = $(genObj.frameDelivery).find('span.cuselActive').attr('val');
            changeDeliveryMethod(activeVal);
            recountCartPage();
        });
    }
    else {
        $(".check-variant-delivery").nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio',
            //classRemove: 'b_n', //if not standart
            before: function(el) {
                $(document).trigger('showActivity');
                $('[name="' + $(el).find('input').attr('name') + '"]').attr('disabled', 'disabled');
            },
            after: function(el, start) {
                if (!start) {
                    var activeVal = el.find('input').val();
                    changeDeliveryMethod(activeVal);
                    recountCartPage();
                    $('[name="' + $(el).find('input').attr('name') + '"]').removeAttr('disabled')
                }
            }
        });
    }

    if (selectPayment)
        cuselInit($(genObj.pM), '#paymentMethod');

    else
        $(genObj.pM).nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio'
                    //,classRemove: 'b_n'//if not standart
        });

    $(document).on('render_popup_cart', function() {
        recountCartPage();
    });
    $(document).on('sync_cart', function() {
        renderOrderDetails();
    });
    $(document).on('count_changed', function() {
        recountCartPage();
    });
    $(document).on('cart_rm', function(data) {
        recountCartPage()
    });
    $(document).on('discount.display', function(e) {
        displayInfoDiscount(e.tpl);
    });

    renderOrderDetails();
}
function initOrderTrEv() {
    $(document).on('discount.renderGiftInput', function(e) {
        renderGiftInput(e.tpl);
    });
    $(document).on('discount.giftError', function(e) {
        giftError(e.datas)
    });
    $(document).on('discount.renderGiftSucces', function(e) {
        renderGiftSucces(e.tpl, e.datas);
    });
    $(document).on('displayDiscount', function(e) {
        displayOrderSum(e.obj);
    });
}
$(document).on('scriptDefer', function() {
    initOrder();
})