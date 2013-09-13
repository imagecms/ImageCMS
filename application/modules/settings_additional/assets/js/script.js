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

function zoomOn(el){
    
    $.post('/admin/components/init_window/settings_additionalZoom', {data:el},   function(data) {
        if (data == 1)
            $('el').addClass('active');
        else
            $('el').removeClass('active');
    })
    
}


function changelogo(el) {
    $('[name="templ"]').val($(el).data('templ'));
    $('.templ img').removeClass('br');
    $(el).addClass('br');
    

//
    $.post('/admin/components/init_window/settings_additional/change_sub_style', {templ: $(el).data('templ')}, function(data) {
        dani = JSON.parse(data);
        $('.substyle img').remove();
        $('[name="substyle"]').val();
        for (var i in dani) {
            $('.substyle').append('<img  class="" data-substyle="'+dani[i]+'" onclick="changesublogo(this)" id="logo" style="padding:5px; max-width: 200px" src="/templates/'+$(el).data('templ')+'/stylesets/'+dani[i]+'/screenshot.png" />');
        }

    })
}

function changesublogo(el) {
    $('[name="substyle"]').val($(el).data('substyle'));
    $('.substyle img').removeClass('br');
    $(el).addClass('br');


}

