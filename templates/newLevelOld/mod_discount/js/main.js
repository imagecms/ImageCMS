var returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
var Discount = {
    getDiscount: function(discTpl) {
        var _discount = 0;
        $.ajax({
            url: '/mod_discount/discount_api/get_discount_api',
            type: "GET",
            success: function(data) {
                _discount = data !== '' ? JSON.parse(data) : null;
                if (data !== '') {
                    if (discTpl) {
                        $.get('/mod_discount/discount_api/get_discount_tpl_from_json_api', {
                            json: data
                        }, function(tpl) {
                            $(document).trigger({
                                'type': 'discount.display',
                                'discount': _discount,
                                'tpl': tpl
                            });
                            returnMsg('=== discount.display. tpl full. discount full ===');
                        });
                    }
                    else {
                        $(document).trigger({
                            'type': 'discount.display',
                            'discount': _discount,
                            'tpl': ''
                        });
                        returnMsg('=== discount.display. tpl empty. discount full ===');
                    }
                }
                else {
                    $(document).trigger({
                        'type': 'discount.display',
                        'discount': _discount,
                        'tpl': ''
                    });
                    returnMsg('=== discount.display. tpl empty. discount full ===');
                }
            }
        }).fail(function() {
            $(document).trigger({
                'type': 'discount.display',
                'discount': null,
                'tpl': ''
            });
            returnMsg('=== discount.display. tpl empty. discount null ===');
        });
    },
    loadCertificat: function(gift) {
        $(document).trigger({
            'type': 'discount.load_certificate'
        });
        $.get('/mod_discount/discount_api/render_gift_succes', {
            json: JSON.stringify(gift)
        }, function(tpl) {
            $(document).trigger({
                'type': 'discount.renderGiftSucces',
                'datas': gift,
                'tpl': tpl
            });
            returnMsg('=== discount.renderGiftSucces ===');
        });
    },
    renderGift: function(gift) {
        if (gift === undefined) {
            $.get('/mod_discount/discount_api/render_gift_input', function(tpl) {
                $(document).trigger({
                    'type': 'discount.renderGiftInput',
                    'tpl': tpl
                });
                returnMsg('=== discount.renderGiftInput ===');
            });
        }
    }
};