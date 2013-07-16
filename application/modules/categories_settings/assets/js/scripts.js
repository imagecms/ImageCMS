$(document).ready(function() {
    $('#cattegoryColumnSaveButtonMod').die().live('click',function(){
        var data   = $('#cattegoryColumnMod').val();
        var contentId = $('#cattegoryIdMod').val();
        $.ajax({
            type: "POST",
            data:  'column='+data +'&categoryId='+contentId,
            url: '/categories_settings/ajaxSaveColumn',
            success: function(res){
                    $('.notifications').append(res);
                }
        })
    })
})
