var pagesAdmin = new Object({
    quickAddCategory: function () {
        if ($('#fast_add_form').valid())
            $('#fast_add_form').ajaxSubmit({
                success: function (responseText) {
                    $('.modal').modal('hide');
                    if (responseText) {
                        $('#category_selectbox').html(responseText)
                        $('#category_selectbox').trigger("chosen:updated");
                    }
                    else {
                        //responseObj = JSON.parse(responseText);
                        $('.notifications').append(responseText);
                    }
                }
            });
        return false;
    },
    loadCFAddPage: function () {
        var categoryId = $("#category_selectbox").val();

        $.ajax({
            url: "/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/0/page",
            type: 'GET',
            headers: {
                'X-PJAX': 'X-PJAX'
            },
            complete: function (data) {
                $("#cfcm_fields_block").html(data.responseText);
                pagesAdmin.initEditor();

            }
        });
    },
    loadCFEditPage: function () {
        var updatePageId = $('#edit_page_form').data('pageid');
        var categoryId = $("#category_selectbox").val();
        $.ajax({
            url: "/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/" + updatePageId + "/page",
            type: 'GET',
            headers: {
                'X-PJAX': 'X-PJAX'
            },
            complete: function (data) {
                $("#cfcm_fields_block").html(data.responseText);
                pagesAdmin.initEditor();

            }
        });
    },
    initEditor: function(){
        $('.customTextArea').each(function(key,el){
            var id = $(el).attr('id');
            try{
                tinyMCE.execCommand('mceRemoveEditor', true, id);
                tinyMCE.execCommand('mceAddEditor', false, id);
            }catch (e){
            }
        });

    },
    confirmListAction: function (actionURL) {
        //event.preventDefault();
        var pagesArray = {};
        //var actionURL = $(this).attr('url');
        var checkedPages = $('.pages-table > tbody').children('tr').children('td.t-a_c').find('input:checked');

        checkedPages.each(function () {
            pagesArray[$(this).attr('data-id')] = 'chkb_' + $(this).attr('data-id');
        });

        if (checkedPages.size() < 1)
            return false;

        var newCat = false;
        if ($('#CopyMoveCategorySelect2'))
            newCat = $('#CopyMoveCategorySelect2').val();
        if ($('#CopyMoveCategorySelect') && newCat == 0)
            newCat = $('#CopyMoveCategorySelect').val();

        $.post(actionURL, {pages: pagesArray, new_cat: newCat}, function (data) {
            $('.modal').modal('hide');
            $('.notifications').append(data);

        });
    },

    updDialogMove: function () {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/move')");
    },

    updDialogCopy: function () {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/copy')");
    },

    initialize: function () {
        if ($('#edit_page_form').length)
            this.loadCFEditPage();

        if ($('#add_page_form').length)
            this.loadCFAddPage();
    }
});


var CFAdmin = new Object({
    deleteOne: function (label) {
        $.post('/admin/components/cp/cfcm/delete_field/' + label, {}, function (data) {
            $('.notifications').append(data);
        });
    },
    deleteOneGroup: function (id) {
        $.post('/admin/components/cp/cfcm/delete_group/' + id, {}, function (data) {
            $('.notifications').append(data);
        });
    },
});


$(document).on('pjax:end', function () {
    pagesAdmin.initialize();
});

