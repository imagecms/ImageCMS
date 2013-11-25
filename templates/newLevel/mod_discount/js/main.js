function getDiscountBack(discTpl) {
    var _discount = 0;
    $.ajax({
        url: '/mod_discount/discount_api/get_discount_api',
        type: "GET",
        success: function(data) {
            _discount = data != '' ? JSON.parse(data) : null;
            if (data != '') {
                if (discTpl) {
                    $.get('/mod_discount/discount_api/get_discount_tpl_from_json_api', {
                        json: data
                    }, function(tpl) {
                        $(document).trigger({
                            'type': 'discount.display', 
                            'discount': _discount, 
                            'tpl': tpl
                        });
                    })
                }
                else {
                    $(document).trigger({
                        'type': 'discount.display',
                        'discount': _discount, 
                        'tpl': ''
                    });
                }
            }
            else {
                $(document).trigger({
                    'type': 'discount.display', 
                    'discount': _discount, 
                    'tpl': ''
                });
            }
        }
    }).fail(function(){
        $(document).trigger({
            'type': 'discount.display', 
            'discount': null, 
            'tpl': ''
        });
    })
}

function loadCertificat(gift) {
    $(document).trigger({
        'type': 'discount.load_certificate'
    });
    if (gift != undefined) {
        if (gift.error) {
            $(document).trigger({
                'type': 'discount.giftError', 
                'datas': gift.mes
            });
        } else {
            $.get('/mod_discount/gift/render_gift_succes', {
                json: JSON.stringify(gift)
            }, function(tpl) {
                $(document).trigger({
                    'type': 'discount.renderGiftSucces', 
                    'datas': gift, 
                    'tpl': tpl
                });
            })
        }
    }
    else {
        $.get('/mod_discount/gift/render_gift_input', function(tpl) {
            $(document).trigger({
                'type': 'discount.renderGiftInput', 
                'tpl': tpl
            });
        });
    }
}