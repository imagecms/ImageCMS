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
    loadCFAddPage:function()
    {
        categoryId = $("#category_selectbox").val();
        $("#cfcm_fields_block").load(base_url + "admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/0/page");
    },
    loadCFEditPage:function()
    {
        var updatePageId = $('#edit_page_form').data('pageid');
        categoryId = $("#category_selectbox").val();
        $("#cfcm_fields_block").load(base_url + "admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/" + updatePageId + "/page");
    },
    
    
    initialize:function()
    {
        if ($('#edit_page_form'))
            this.loadCFEditPage();
            
        if ($('#add_page_form'))
            this.loadCFAddPage();
    }
});

pagesAdmin.initialize();

