function get_discount() {

    var _discount = 0;
    $.ajax({
        async: false,
        url: '/mod_discount/discount_api/get_discount_api',
        type: "POST",
        success: function(data) {

            if (data != '') {
                _discount = JSON.parse(data);
                $.post('/mod_discount/discount_api/get_discount_tpl_api', {json: data}, function(tpl) {
                    $('#Discount').html(tpl).show();
                })
            }
        }
    })
    Shop.Cart.discount = _discount;
}


$(document).ready(function() {

});
