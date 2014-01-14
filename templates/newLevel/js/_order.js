if (selectDeliv)
    var methodDeliv = '#method_deliv';
else
    var methodDeliv = '[name = "deliveryMethodId"]';
var Order = {
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
});
function initOrderTrEv() {
    Order.giftSubmit();
    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}