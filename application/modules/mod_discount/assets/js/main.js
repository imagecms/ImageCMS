function get_discount() {

    var _discount = 0;
    $.ajax({
        async: false,
        url: '/mod_discount/discount_api/get_discount_api',
        type: "POST",
        success: function(data) {
            if (data != '') {
                _discount = JSON.parse(data);
                $.post('/mod_discount/discount_api/get_discount_tpl_from_json_api', {json: data}, function(tpl) {
                    $('#Discount').html(tpl).show();
                })
            }
        }
    });
<<<<<<< HEAD
    if (Shop.Cart.discount != undefined)
        Shop.Cart.discount = _discount;
=======
    Shop.Cart.discount = _discount;
>>>>>>> a5fe5475ac028608ec6cc04a05e46df6c6786301
}

function load_certificat() {
    var gift = 0;
    if (Shop.Cart.gift == undefined)
        $('#gift').load('/mod_discount/gift/render_gift_input');
    else {
        gift = Shop.Cart.gift;
        if (gift.error) {
            $('#gift p.error').remove();
            $('<p class="error">' + gift.mes + '</p>').insertAfter('#gift [name=giftcert]')
        } else {
            $.post('/mod_discount/gift/render_gift_succes', {json: JSON.stringify(gift)}, function(tpl) {
                $('#gift').html(tpl)
            });
            $('#giftCertPrice').html(gift.value);
<<<<<<< HEAD
            $('#giftCertSpan').show()
=======
            $('#giftCertSpan').show();
>>>>>>> a5fe5475ac028608ec6cc04a05e46df6c6786301
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
    });
<<<<<<< HEAD
    if (Shop.Cart.discount != undefined)
        Shop.Cart.gift = gift;
=======

    Shop.Cart.gift = gift;
>>>>>>> a5fe5475ac028608ec6cc04a05e46df6c6786301
    recountCartPage();
    return false;
}


$(document).ready(function() {

});
