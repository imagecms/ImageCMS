$(document).ready(function() {
    
    $('.cattegoryColumnSaveButtonMod').live('click',function(){
        var data   = $(this).parent().find('select').val();
        var column = $(this).data('column');
        $.ajax({
            type: "POST",
            data:  {
                categories_ids: data,
                column: column
            },
            url: '/categories_settings/admin/saveCategories',
            success: function(res) {
                   
            }
        });
    });
    
//    $('#cattegoryColumnSaveButtonMod').die().live('click',function(){
//        var data   = $('#cattegoryColumnMod').val();
//        var contentId = $('#cattegoryIdMod').val();
//        $.ajax({
//            type: "POST",
//            data:  'column='+data +'&categoryId='+contentId,
//            url: '/categories_settings/ajaxSaveColumn',
//            success: function(res){
//                    $('.notifications').append(res);
//                }
//        })
//    })
})
