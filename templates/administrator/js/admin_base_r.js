var pagesAdmin = new Object({
    quickAddCategory:function(){
        if ($('#fast_add_form').valid())
        $('#fast_add_form').ajaxSubmit({
            success: function(responseText){
                responseObj = JSON.parse(responseText);
                //console.log(responseObj);
                $('.modal').modal('hide');
                if (responseObj.data)
                {
                    showMessage('Категория добавлена успешно');
                    $('#category_selectbox').load('/admin/categories/update_fast_block/'+responseObj.data);
                }
                else
                    $('.notifications').append(responseText);
            }
            });
    return false;
    },
});