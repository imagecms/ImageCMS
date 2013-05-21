function ChangeBannerSliderActive(obj, id) {
    $.post('/admin/components/init_window/banners/chose_active', {status: $(obj).attr('rel'), id: id}, function() {
        if ($(obj).attr('rel') == 'true')
            $(obj).addClass('disable_tovar').attr('rel', false);
        else
            $(obj).removeClass('disable_tovar').attr('rel', true);
    })

}

function DeleteSliderBanner() {
    var ids = new Array();
    $('[name=ids]:checked').each(function() {
        ids.push($(this).val());       
    })   
    $.post('/admin/components/init_window/banners/delete', {id: JSON.stringify(ids)}, function() {
        window.location.reload()
    })
}

function selectEntity(obj){
    var el = $(obj);
    var id = el.attr('data-id');
    var name = el.text();
    var type = $('#banner_type').val();
    var html = "<option disabled selected='selected' value='"+type+"_"+id+"' ondblclick='delEntity(this)'>"+type+' - '+name+"</option>";
    $('#data').append(html);
    
    var $s = $('#data');

    var optionTop = $s.find('[value="'+type+"_"+id+'"]').offset().top;
    var selectTop = $s.offset().top;

    $s.scrollTop($s.scrollTop() + (optionTop - selectTop));

    return false;
}

function delEntity(obj){
   
    $(obj).remove();
    return false;
   
}

$(document).ready(function(){
    if($('.slider').length){
       $('.slider').cycle();
    }
});
