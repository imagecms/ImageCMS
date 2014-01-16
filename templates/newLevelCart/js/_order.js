var Order = {
    giftSubmit: function(tpl) {
        $('#giftButton').click(function(e) {
            $(this).closest('form').submit();
        })
        $('#giftInput').keydown(function(e) {
            if (e.keyCode == 13) {
                $('#giftButton').trigger('click')
                e.preventDefault();
            }
        })
    }
}
$(document).on('scriptDefer', function() {
    if (selectDeliv) {
        cuselInit($(genObj.frameDelivery), $(genObj.dM));
        $(genObj.dM).on('change.methoddeliv', function() {
            var $this = $(this);
            Shop.Cart.getPayment($this.val(), $("[val='"+$this.val()+"'][name='met_del']").data(), '');
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
                $('[name="' + $(el).find('input').attr('name') + '"]').attr('disabled', 'disabled');
            },
            after: function(el, start) {
                if (!start) {
                    var input = $(el).find('input');
                    Shop.Cart.getPayment(input.val(), input.data(), '');
                    $('[name="' + input.attr('name') + '"]').removeAttr('disabled')
                }
            }
        });
    }
    if (selectDeliv)
        Shop.Cart.shipping = $("[val='"+$('[name="deliveryMethodId"]').val()+"'][name='met_del']").data();
    else
        Shop.Cart.shipping = $('[name="deliveryMethodId"]:checked').data()

    if (selectPayment)
        cuselInit($(genObj.framePaymentMethod), $(genObj.pM));

    else
        $(genObj.pM).nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio'
        //,classRemove: 'b_n'//if not standart
        });
    
    $(document).on('beforeGetPayment.Cart', function(e){
        Shop.Cart.shipping = e.obj;

        $(genObj.framePaymentMethod).next().show();
    });
    $(document).on('afterGetPayment.Cart', function(e){
        $(genObj.framePaymentMethod).html(e.datas).next().hide();
        if (selectPayment)
            cuselInit($(genObj.framePaymentMethod), $(genObj.pM));
        else{
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
    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}