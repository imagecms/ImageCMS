var Order = {
    giftSubmit: function() {
        $(document).on('beforeGetTpl.Cart', function(e) {
            if (e.obj.template == 'cart_order')
                $(genObj.orderDetails).find(preloader).show();
        });
        $('#giftButton').click(function(e) {
            Shop.Cart.getTpl({
                ignoreWrap: '1',
                template: 'cart_order',
                gift: $('[name="gift"]').val()
            });
        })
        $('[name="gift"]').keydown(function(e) {
            if (e.keyCode == 13) {
                $('#giftButton').trigger('click')
                e.preventDefault();
            }
        })
    },
    setDelivery: function() {
        $(genObj.priceDelivery).add(genObj.noPriceDelivery).hide();
        if (Shop.Cart.shipping) {
            if (Shop.Cart.shipping.sumSpec != '1') {
                var price = Shop.Cart.shipping.price,
                priceAdd = Shop.Cart.shipping.priceAdd;

                if (Shop.Cart.shipping.freeFrom <= Shop.Cart.totalPrice) {
                    price = 0;
                    priceAdd = 0;
                }
                $(genObj.deliveryPirce).text(price);
                $(genObj.deliveryPriceSumNextCS).text(priceAdd);
                $(genObj.priceDelivery).show();
            }
            else {
                $(genObj.noPriceDelivery).text(Shop.Cart.shipping.sumSpecMes).show();
            }
        }
    },
    getTotalPrice: function() {
        Shop.Cart.totalPrice = parseFloat($(genObj.finalAmount).text());
        Shop.Cart.totalPriceAdd = parseFloat($(genObj.finalAmountAdd).text());
    },
    setTotalPrice: function() {
        if (Shop.Cart.shipping) {
            if (Shop.Cart.shipping.sumSpec != '1') {
                var price = Shop.Cart.shipping.price,
                priceAdd = Shop.Cart.shipping.priceAdd;

                if (Shop.Cart.shipping.freeFrom <= Shop.Cart.totalPrice) {
                    price = 0;
                    priceAdd = 0;
                }

                $(genObj.finalAmount).text(parseFloat(Shop.Cart.totalPrice + parseFloat(price)).toFixed(pricePrecision));
                $(genObj.finalAmountAdd).text(parseFloat(Shop.Cart.totalPriceAdd + parseFloat(priceAdd)).toFixed(pricePrecision));
            }
            else {
                $(genObj.finalAmount).text(parseFloat(Shop.Cart.totalPrice).toFixed(pricePrecision));
                $(genObj.finalAmountAdd).text(parseFloat(Shop.Cart.totalPriceAdd).toFixed(pricePrecision));
            }
        }
    }
}
$(document).on('scriptDefer', function() {
    if (selectDeliv) {
        cuselInit($(genObj.frameDelivery), $(genObj.dM));
        $(genObj.dM).on('change.methoddeliv', function() {
            var $this = $(this);
            Shop.Cart.getPayment($this.val(), $("[val='" + $this.val() + "'][name='met_del']").data(), '');
        });
    }
    else {
        $(genObj.frameDelivery).nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n', //if not standart
            ,
            before: function(el) {
                $(document).trigger('showActivity');
            },
            after: function(el, start) {
                Shop.Cart.getTpl({
                    ignoreWrap: '1',
                    template: 'cart_order',
                    gift: $('[name="gift"]').val(),
                    deliveryId: $('[name="deliveryMethodId"]:checked').val()
                });
                if (!start) {
                    var input = $(el).find('input');
                    Shop.Cart.getPayment(input.val(), input.data(), '');
                }
            }
        });
    }
    if (selectDeliv)
        Shop.Cart.shipping = $("[val='" + $('[name="deliveryMethodId"]').val() + "'][name='met_del']").data();
    else
        Shop.Cart.shipping = $('[name="deliveryMethodId"]:checked').data()
    Order.getTotalPrice();
    Order.setDelivery();
    Order.setTotalPrice();

    if (selectPayment)
        cuselInit($(genObj.framePaymentMethod), $(genObj.pM));

    else
        $(genObj.pM).nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio'
        //,classRemove: 'b_n'//if not standart
        });

    $(document).on('beforeGetPayment.Cart', function(e) {
        Shop.Cart.shipping = e.obj;

        Order.setDelivery();
        Order.setTotalPrice();

        $(genObj.framePaymentMethod).next().show();
    });
    $(document).on('getPayment.Cart', function(e) {
        $(genObj.framePaymentMethod).html(e.datas).next().hide();
        if (selectPayment)
            cuselInit($(genObj.framePaymentMethod), $(genObj.pM));
        else {
            $(genObj.framePaymentMethod).nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
        }

        $(document).trigger('hideActivity');
    });
});
function initOrderTrEv() {
    Order.giftSubmit();
    $(document).on('getTpl.Cart', function(e) {
        if (e.obj.template == 'cart_order') {
            $(genObj.orderDetails).empty().append(e.datas);
            $(genObj.orderDetails).find('[data-drop]').drop();
            Order.giftSubmit();

            Order.getTotalPrice();
            Order.setDelivery();
            Order.setTotalPrice();
            
            if (!$.exists('.cart-product, .row-kits')){
                $('.pageCart').find(genObj.blockEmpty).show().end().find(genObj.blockNoEmpty).hide();
            }
        }
    });
    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}