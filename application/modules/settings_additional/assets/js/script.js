function ChangeProductOn(el,id, pid){
    $.post('/settings_additional/ProductOn',{status: $(el).attr('rel'), id:id, product_id:pid}, function(data){
        if ($(el).attr('rel') == 'true')
            $(el).addClass('disable_tovar').attr('rel', false);
        else
            $(el).removeClass('disable_tovar').attr('rel', true);
    })
}
function ChangeProductInStock(el,id, pid){
    $.post('/settings_additional/InStock',{status: $(el).attr('rel'), id:id, product_id:pid}, function(data){
        if ($(el).attr('rel') == 'true')
            $(el).addClass('disable_tovar').attr('rel', false);
        else
            $(el).removeClass('disable_tovar').attr('rel', true);
    })
}


