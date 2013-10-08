function getDiscountBack(discTpl) {
    var _discount = 0;
    $.ajax({
        url: '/mod_discount/discount_api/get_discount_api',
        type: "POST",
        async: false,
        success: function(data) {
            _discount = data != '' ? JSON.parse(data) : null;
            Shop.Cart.discount = _discount;
            if (data != '') {
                if (discTpl) {
                    $.post('/mod_discount/discount_api/get_discount_tpl_from_json_api', {
                        json: data
                    }, function(tpl) {
                        $(document).trigger({'type': 'discount.display', 'discount': _discount, 'tpl': tpl});
                    })
                }
                else {
                    $(document).trigger({'type': 'discount.display', 'discount': _discount, 'tpl': ''});
                }
            }
            else {
                $(document).trigger({'type': 'discount.display', 'discount': _discount, 'tpl': ''});
            }
        }
    }).fail(function(){
        $(document).trigger({'type': 'discount.display', 'discount': null, 'tpl': ''});
    })
}

function loadCertificat() {
    var gift = 0;
    if (Shop.Cart.gift == undefined)
        $.get('/mod_discount/gift/render_gift_input', function(tpl) {
            $(document).trigger({'type': 'discount.renderGiftInput', 'tpl': tpl});
        });
    else {
        gift = Shop.Cart.gift;
        if (gift.error) {
            $(document).trigger({'type': 'discount.giftError', 'data': gift.mes});
        } else {
            $.get('/mod_discount/gift/render_gift_succes', {
                json: JSON.stringify(gift)
            }, function(tpl) {
                $(document).trigger({'type': 'discount.renderGiftSucces', 'data': gift, 'tpl': tpl});
            })
        }
    }
}