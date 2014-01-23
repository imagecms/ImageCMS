function get_discount() {

    var _discount = 0;
    $.ajax({
        async: false,
        url: lang+'/mod_discount/discount_api/get_discount_api',
        type: "POST",
        success: function(data) {
            if (data != '') {
                _discount = JSON.parse(data);
                $.post(lang+'/mod_discount/discount_api/get_discount_tpl_from_json_api', {json: data}, function(tpl) {
                    $('#Discount').html(tpl).show();
                })
            }
        }
    });

    if (Shop.Cart.discount != undefined)
        Shop.Cart.discount = _discount;

}

function load_certificat() {
    var gift = 0;
    if (Shop.Cart.gift == undefined)
        $('#gift').load(lang+'/mod_discount/gift/render_gift_input');
    else {
        gift = Shop.Cart.gift;
        if (gift.error) {
            $('#gift p.error').remove();
            $('<p class="error">' + gift.mes + '</p>').insertAfter('#gift [name=giftcert]')
        } else {
            $.get(lang+'/mod_discount/gift/render_gift_succes', {json: JSON.stringify(gift)}, function(tpl) {
                $('#gift').html(tpl)
            });
            $('#giftCertPrice').html(gift.value);

            $('#giftCertSpan').show();

        }
    }


}

function applyGift(el) {

    var gift = 0;
    $.ajax({
        async: false,
        url: lang+'/mod_discount/gift/get_gift_certificate',
        data: 'key=' + $('[name=giftcert]').val(),
        type: "POST",
        success: function(data) {

            if (data != '')
                gift = JSON.parse(data);

        }
    });

    if (Shop.Cart.discount != undefined)
        Shop.Cart.gift = gift;

    recountCartPage();
    return false;
}


$(document).ready(function() {

});
