function DeleteKey() {
    var ids = new Array();
    $('[name=ids]:checked').each(function() {
        ids.push($(this).val());
    })
    $.post('/admin/components/init_window/update/delete_user', {id: JSON.stringify(ids)}, function() {
        window.location.reload()
    })
}
function DeleteFile() {
    var ids = new Array();
    $('[name=ids]:checked').each(function() {
        ids.push($(this).val());
    })
    $.post('/admin/components/init_window/update/delete_file', {id: JSON.stringify(ids)}, function() {
        window.location.reload()
    })
}

$(document).ready(function(){
    $('.head_body input').on('keydown', function(event){

        if(event.keyCode==13) {
            $('#form_list').submit();
        }
        
    })
    
    $('.top_tr a').on('click', function(){

        $('[name=order]').val($(this).attr('href'));
        $('#form_list').submit();
        
        return false;
    })
    
    
})


