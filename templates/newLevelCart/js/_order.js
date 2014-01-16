if (selectDeliv)
    var methodDeliv = '#method_deliv';
else
    var methodDeliv = '[name = "deliveryMethodId"]';
var Order = {
    changeDeliveryMethod: function(id, tpl) {
        tpl = tpl ? tpl : '';
        $(genObj.pM).next().show();
        $.get('/shop/order/getPaymentsMethodsTpl/' + id + '/' + tpl, function(data) {
            $(genObj.framePaymentMethod).html(data).next().hide();
            if (selectPayment)
                cuselInit($(genObj.framePaymentMethod), $(genObj.pM));
            else
                $(genObj.framePaymentMethod).nStRadio({
                    wrapper: $(".frame-radio > .frame-label"),
                    elCheckWrap: '.niceRadio'
                //,classRemove: 'b_n'//if not standart
                });
        });
    },
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
        cuselInit($(genObj.frameDelivery), methodDeliv);
        $(methodDeliv).on('change.methoddeliv', function() {
            Order.changeDeliveryMethod($(this).val());
        });
    }
    else {
        $(".check-variant-delivery").nStRadio({
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
                    Order.changeDeliveryMethod(el.find('input').val());
                    $('[name="' + $(el).find('input').attr('name') + '"]').removeAttr('disabled')
                }
            }
        });
    }

    if (selectPayment)
        cuselInit($(genObj.framePaymentMethod), $(genObj.pM));

    else
        $(genObj.pM).nStRadio({
            wrapper: $(".frame-radio > .frame-label"),
            elCheckWrap: '.niceRadio'
        //,classRemove: 'b_n'//if not standart
        });
});
function initOrderTrEv() {
    Order.giftSubmit();
    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}