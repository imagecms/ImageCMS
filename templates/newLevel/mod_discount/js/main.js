function get_discount() {
    var _discount = 0;
    $.ajax({
        async: false,
        url: '/mod_discount/discount_api/get_discount_api',
        type: "POST",
        success: function(data) {
            if (data != '') {
                _discount = JSON.parse(data);
                $(document).trigger({type: 'get_discount_api', obj: _discount})
                $.post('/mod_discount/discount_api/get_discount_tpl_from_json_api', {json: data}, function(tpl) {
                    $(document).trigger({type: 'get_discount_tpl_from_json_api', tpl: tpl})
                })
            }
        }
    })
    Shop.Cart.discount = _discount;
}

function load_certificat() {
    var gift = 0;
    if (Shop.Cart.gift == undefined)
        $.post('/mod_discount/gift/render_gift_input', function(tpl){
           $(document).trigger({type: 'render_gift_input', 'tpl': tpl}) 
        });
    else {
        gift = Shop.Cart.gift;
        if (gift.error) {
            $('#gift p.error').remove();
            $('<p class="error">' + gift.mes + '</p>').insertAfter('#gift [name=giftcert]')
        } else {
            $.post('/mod_discount/gift/render_gift_succes', {json: JSON.stringify(gift)}, function(tpl) {
                $('#gift').html(tpl)
            })
            $('#giftCertPrice').html(gift.value)
            $('#giftCertSpan').show()
        }
    }


}

function applyGift(el) {
    var gift = 0;
    $.ajax({
        async: false,
        url: '/mod_discount/gift/get_gift_certificate',
        data: 'key=' + $('[name=giftcert]').val(),
        type: "POST",
        success: function(data) {
            if (data != '')
                gift = JSON.parse(data);
        }
    })

    Shop.Cart.gift = gift;
    recountCartPage(selectDeliv, methodDeliv());
    return false;
}


$(document).ready(function() {

});
