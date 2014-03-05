if (selectDeliv)
    var methodDeliv = '#method_deliv';
else
    var methodDeliv = '[name = "deliveryMethodId"]';
var Order = {
    renderOrderDetails: function(a) {
        $(genObj.orderDetails).html(_.template($(genObj.orderDetailsTemplate).html(), {
            cart: Shop.Cart
        }));
        $(document).trigger({
            'type': 'renderorder.after',
            'el': $(genObj.orderDetails)
        })
        ShopFront.Cart.initShopPage(false);
        Order.recountCartPage('renderOrderDetails');

        if (a === 'start' && Discount)
            Discount.renderGift(Shop.Cart.gift);
        if (a !== 'start')
            DiscountFront.getDiscount('renderOrderDetails');
    },
    changeDeliveryMethod: function(id) {
        $(genObj.pM).next().show();
        $.get('/shop/cart_api/getPaymentsMethods/' + id, function(dataStr) {
            var data = JSON.parse(dataStr),
            replaceStr = '';
            if (selectPayment)
                replaceStr = _.template($('#orderPaymentSelect').html(), {
                    data: data
                });
            else {
                replaceStr = _.template($('#orderPaymentRadio').html(), {
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
    },
    displayOrderSum: function(obj) {
        var ca = "";
        if (selectDeliv)
            ca = $(genObj.frameDelivery).find('span.cuselActive');
        else
            ca = $(methodDeliv).filter(':checked');
        Shop.Cart.shipping = parseFloat(ca.data('price'));
        Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
        $(genObj.shipping).html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));
        
        var discount = Shop.Cart.discount,
        kitDiscount = parseFloat(Shop.Cart.kitDiscount),
        finalAmount = Shop.Cart.getFinalAmount();

        if (Shop.Cart.koefCurr == undefined) {
            var sumBask = parseFloat(Shop.Cart.totalPrice).toFixed(pricePrecision),
            addSumBask = parseFloat(Shop.Cart.totalAddPrice).toFixed(pricePrecision);
            Shop.Cart.koefCurr = addSumBask / sumBask;
        }

        if (discount != null && discount != 0)
            finalAmount = finalAmount - obj.result_sum_discount_convert;
        if (kitDiscount != 0)
            finalAmount = finalAmount - kitDiscount;
        finalAmount = finalAmount > Shop.Cart.shipping ? finalAmount : Shop.Cart.shipping;

        $(genObj.totalPrice).html(parseFloat(Shop.Cart.getTotalPriceOrigin()).toFixed(pricePrecision));
        $(genObj.finalAmount).html(parseFloat(finalAmount).toFixed(pricePrecision));
        $(genObj.finalAmountAdd).html((Shop.Cart.koefCurr * finalAmount).toFixed(pricePrecision));
        
        $(genObj.frameGenSumDiscount).hide();
        $(genObj.genSumDiscount).hide();
        $(genObj.totalPrice).hide();
        if ((obj != null && parseFloat(obj.result_sum_discount_convert) > 0) || kitDiscount != 0) {
            $(genObj.genSumDiscount).show();
            $(genObj.frameGenSumDiscount).show();
            $(genObj.totalPrice).show();
        }
    },
    recountCartPage: function(a) {
        Shop.Cart.totalRecount();
        
        Order.hideInfoDiscount();
        if (a !== 'renderOrderDetails')
            DiscountFront.getDiscount('recountCartPage');
    },
    hideInfoDiscount: function() {
        $(genObj.discount).empty().next(preloader).show();
    },
    displayInfoDiscount: function(tpl) {
        $(genObj.pageCart).find(genObj.frameDiscount).hide();
        $(genObj.frameGenDiscount).hide();
        
        if ($.trim(tpl) == '')
            $(genObj.pageCart).find(genObj.frameDiscount).show();

        if (!($.trim(tpl) == '' && Shop.Cart.discountProduct == 0))
            $(genObj.frameGenDiscount).show();

        $(genObj.discount).html(tpl).next(preloader).hide();
    },
    renderGiftInput: function(tpl) {
        if (tpl == '') {
            $(genObj.gift).empty();
            $(genObj.frameGift).hide();
        }
        else {
            $(genObj.gift).html(tpl);
            $(genObj.frameGift).show();
        }

        $('#giftButton').click(function(e) {
            $(genObj.gift).find(preloader).show();
            var gift = 0;
            $.ajax({
                url: '/mod_discount/discount_api/get_gift_certificate',
                data: 'key=' + $('[name=giftcert]').val(),
                type: "GET",
                success: function(data) {
                    if (data != '')
                        gift = JSON.parse(data);
                    $(genObj.gift).find(preloader).hide();
                    Shop.Cart.gift = gift;

                    if (gift.error) {
                        $(document).trigger({
                            'type': 'discount.giftError',
                            'datas': gift.mes
                        });
                    }
                    if (!gift.error && Discount)
                        Discount.loadCertificat(Shop.Cart.gift);
                }
            });
            e.preventDefault();
        })
        $('#giftInput').keydown(function(e) {
            if (e.keyCode == 13) {
                $('#giftButton').trigger('click')
                e.preventDefault();
            }
        })
    },
    giftError: function(msg) {
        $(genObj.gift).children(genObj.msgF).remove()
        if (msg) {
            $(genObj.gift).append(message.error(msg));
            drawIcons($(genObj.gift).find(selIcons))
        }
    },
    renderGiftSucces: function(tpl, gift) {
        $(genObj.certPrice).html(gift.value)
        $(genObj.certFrame).show()
        $(genObj.gift).children(genObj.msgF).remove();
        $(genObj.gift).html(tpl);
        Order.recountCartPage('renderGiftSucces');
    }
}
$(document).on('scriptDefer', function() {
    if (selectDeliv) {
        cuselInit($(genObj.frameDelivery), methodDeliv);
        $(methodDeliv).on('change.methoddeliv', function() {
            var activeVal = $(genObj.frameDelivery).find('span.cuselActive').attr('val');
            Order.changeDeliveryMethod(activeVal);
            Order.recountCartPage('change.methoddeliv');
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
                    Order.changeDeliveryMethod(activeVal);
                    Order.recountCartPage('change_delivery');
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

    $(document).on('sync_cart', function() {
        Order.renderOrderDetails();
    });
    $(document).on('count_changed', function() {
        Order.recountCartPage('count_changed');
    });
    $(document).on('cart_rm', function(data) {
        Order.recountCartPage('cart_rm')
    });
    $(document).on('discount.display', function(e) {
        Order.displayInfoDiscount(e.tpl);
    });

    Order.renderOrderDetails('start');
});
function initOrderTrEv() {
    $(document).on('discount.renderGiftInput', function(e) {
        Order.renderGiftInput(e.tpl);
    });
    $(document).on('discount.giftError', function(e) {
        Order.giftError(e.datas)
    });
    $(document).on('discount.renderGiftSucces', function(e) {
        Order.renderGiftSucces(e.tpl, e.datas);
    });
    $(document).on('displayDiscount', function(e) {
        Order.displayOrderSum(e.obj);
    });

    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}