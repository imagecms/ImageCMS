var Order = {
    initGift: function() {
        $(document).on('beforeGetTpl.Cart', function(e) {
            if (e.obj.template == 'cart_order')
                $(genObj.orderDetails).find(preloader).show();
        });
        $(genObj.giftButton).click(function(e) {
            Shop.Cart.getTpl({
                ignoreWrap: '1',
                template: 'cart_order',
                gift: $(genObj.gift).val(),
                deliveryMethodId: function(){
                    if (selectDeliv)
                        return $(genObj.dM).val()
                    else
                        return $(genObj.dM).filter(':checked').val()
                }
            });
        })
        $(genObj.gift).keydown(function(e) {
            if (e.keyCode == 13) {
                $(genObj.giftButton).trigger('click')
                e.preventDefault();
            }
        })
    },
    initOrder: function() {
        if (selectDeliv) {
            cuselInit($(genObj.frameDelivery), $(genObj.dM));
            $(genObj.dM).on('change.methoddeliv', function() {
                Shop.Cart.getTpl({
                    ignoreWrap: '1',
                    template: 'cart_order',
                    gift: $(genObj.gift).val(),
                    deliveryMethodId: $(this).val()
                });
                Shop.Cart.getPayment($(this).val(), '');
            });
        }
        else {
            $(genObj.frameDelivery).nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
                        ,classRemove: 'b_n' //if not standart
                ,
                after: function(el, start) {
                    if (!start) {
                        var input = $(el).find('input');
                        Shop.Cart.getTpl({
                            ignoreWrap: '1',
                            template: 'cart_order',
                            gift: $(genObj.gift).val(),
                            deliveryMethodId: input.val()
                        });
                        Shop.Cart.getPayment(input.val(), '');
                    }
                }
            });
        }

        if (selectPayment)
            cuselInit($(genObj.framePaymentMethod), $(genObj.pM));

        else
            $(genObj.framePaymentMethod).nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
                        ,classRemove: 'b_n'//if not standart
            });
    }
}
$(document).on('scriptDefer', function() {
    Order.initOrder();
    $(document).on('beforeGetPayment.Cart', function(e) {
        $(genObj.submitOrder).attr('disabled', 'disabled');
        $(genObj.framePaymentMethod).next().show();
    });
    $(document).on('getPayment.Cart', function(e) {
        $(genObj.framePaymentMethod).html(e.datas).next().hide();
        $(genObj.submitOrder).removeAttr('disabled');
        if (selectPayment)
            cuselInit($(genObj.framePaymentMethod), $(genObj.pM));
        else {
            $(genObj.framePaymentMethod).nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
            ,classRemove: 'b_n'//if not standart
            });
        }

        $(document).trigger('hideActivity');
    });
    $(document).on('getTpl.Cart', function(e) {
        if (e.obj.template == 'cart_order') {
            $(genObj.orderDetails).empty().append(e.datas);
            $(genObj.orderDetails).find('[data-drop]').drop();
            
            Order.initGift();
            
            if (totalItemsBask == 0){
                $('.pageCart').find(genObj.blockEmpty).show().end().find(genObj.blockNoEmpty).hide();
            }
        }
    });
});
function initOrderTrEv() {
    Order.initGift();
    $(".maskPhoneFrame input").mask("+99 (999) 999-99-99");
}