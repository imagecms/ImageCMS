$(document).ready(function() {
    $("a.articleHistoryControl").on('click', function() {
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            async: false,
            type: "get",
            dataType: "text",
            complete: function(data) {
                location.reload();
            }
        });

    });

    $("a.compareWithOriginal").on('click', function() {
        var oldText = $(this)
                .parent()
                .parent()
                .siblings(".article-data")
                .text();
        showCamparsion(oldText);

    });

    function showCamparsion(someOldText) {
        var currentText = $(".article-data.active-article-status").text();

        var dmp = new diff_match_patch();
        var res = dmp.diff_main(someOldText, currentText);
        var diffHtmlResult = dmp.diff_prettyHtml(res);

        $("#articles_diff .modal-body")
                .empty()
                .html(diffHtmlResult);
        $("#articles_diff").modal("show");
    }


    $(".role_checkbox").on('click', function() {
        var val = $(this).hasClass('active') ? 0 : 1;
        $(this).find(".edit_value").val(val);
    });

    $('.documentationUpdateMenuCategory').bind('click', function() {
        var id = $(this).data('id');
        var newValue = $(this).closest('.categoryMenuBlock').find('.js_price').val();

        console.log(id);
        console.log(newValue);
        $.ajax({
            url: '/admin/components/cp/documentation/ajaxUpdateMenuCategory',
            async: false,
            type: "post",
            data: "id=" + id + "&newValue=" + newValue,
            success: function(response) {
                if (response === 'true') {
                    showMessage(lang('Message'), lang('Changes saved'))
                } else {
                    showMessage(lang('Message'), lang('Changes not saved'), 'r')
                }
            }
        });
    });


    /* --- "ACCORDION" FOR HISTORY OF CHANGES --- */

    $('.showFullText').click(function() {
        $('.history_row.collapsed').show();
        $(this).parents('.history_row.collapsed').hide();
        $('.article-view').hide();
        
        if ($(this).parents('.history_row.collapsed').hasClass('main-article')) {
            $('.article-view.main-article').show();
            return;
        }
        
        var hid = $(this).parents('.history_row.collapsed').data('id');
        $('.article-view.history[data-id="' + hid + '"]').show();
    });

    $('.compareWithOriginalCollapsed').click(function() {
        var hid = $(this).parents('.history_row.collapsed').data('id');
        var oldText = $('.article-view.history[data-id="' + hid + '"]').find('.article-data').text();
        showCamparsion(oldText);
    });

    $('.hideFullText').click(function() {
        $('.history_row.collapsed').show();
        $('.article-view').hide();
    });
    
    /* --- End of "ACCORDION" FOR HISTORY OF CHANGES --- */

});




