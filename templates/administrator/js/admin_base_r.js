var pagesAdmin = new Object({
    quickAddCategory:function(){
        if ($('#fast_add_form').valid())
        $('#fast_add_form').ajaxSubmit({
            success: function(responseText){
                responseObj = JSON.parse(responseText);
                $('.modal').modal('hide');
                if (responseObj.data)
                {
                    showMessage('','Категория добавлена успешно');
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
        var categoryId = $("#category_selectbox").val();
        
        $.ajax({url:"/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/0/page",
                type: 'GET',
                headers:{
                    'X-PJAX': 'X-PJAX'
                },
                complete: function(data){
                    $("#cfcm_fields_block").html(data.responseText);
                }
                });
    },
    loadCFEditPage:function()
    {
        var updatePageId = $('#edit_page_form').data('pageid');
        var categoryId = $("#category_selectbox").val();
        $.ajax({url:"/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/" + updatePageId + "/page",
                type: 'GET',
                headers:{
                    'X-PJAX': 'X-PJAX'
                },
                complete: function(data){
                    $("#cfcm_fields_block").html(data.responseText);
                }
            });
    },
    confirmListAction:function(actionURL)
    {
        //event.preventDefault();
        var pagesArray = {};
        //var actionURL = $(this).attr('url');
        var checkedPages = $('.pages-table > tbody').children('tr').children('td.t-a_c').find('input:checked');
        
        checkedPages.each(function(){
            pagesArray[$(this).attr('data-id')] = 'chkb_'+$(this).attr('data-id');
        });
        
        if (checkedPages.size() < 1)
            return false;
        
        var newCat = false;
        if ($('#CopyMoveCategorySelect'))
            newCat = $('#CopyMoveCategorySelect').val();
            
        $.post(actionURL, {pages:pagesArray, new_cat:newCat}, function(data){
            $('.modal').modal('hide');
            $('.notifications').append(data);
            
            });
    },
    
    updDialogMove:function()
    {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/move')");
    },
    
    updDialogCopy:function()
    {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/copy')");
    },
    
    initialize:function()
    {
        if ($('#edit_page_form').length)
            this.loadCFEditPage();
            
        if ($('#add_page_form').length)
            this.loadCFAddPage();
    }
});


var CFAdmin = new Object({
        deleteOne:function(label){
            $.post('/admin/components/cp/cfcm/delete_field/'+label, {}, function(data){
                $('.notifications').append(data);
            });
        },
        deleteOneGroup:function(id){
            $.post('/admin/components/cp/cfcm/delete_group/'+id, {}, function(data){
                $('.notifications').append(data);
            });
        }, 
    });


pagesAdmin.initialize();

