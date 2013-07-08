function ChangeProductOn(el, id, pid) {
    $.post('/settings_additional/ProductOn', {status: $(el).attr('rel'), id: id, product_id: pid}, function(data) {
        if ($(el).attr('rel') == 'true')
            $(el).addClass('disable_tovar').attr('rel', false);
        else
            $(el).removeClass('disable_tovar').attr('rel', true);
    })
}
function ChangeProductInStock(el, id, pid) {
    $.post('/settings_additional/InStock', {status: $(el).attr('rel'), id: id, product_id: pid}, function(data) {
        if ($(el).attr('rel') == 'true')
            $(el).addClass('disable_tovar').attr('rel', false);
        else
            $(el).removeClass('disable_tovar').attr('rel', true);
    })
}


function changelogo(el) {
    $('#logo').attr('src', '/templates/' + $(el).val() + '/screenshot.png');

    $.post('/admin/components/init_window/settings_additional/change_sub_style', {templ: $(el).val()}, function(data) {
        dani = JSON.parse(data);
        $('#substyle').empty();
        $('#substyle').append('<option value="0">--не определено--</option>');
        for (var i in dani) {
            $('#substyle').append('<option value="'+dani[i]+'">'+dani[i]+'</option>');
        }

    })
}

