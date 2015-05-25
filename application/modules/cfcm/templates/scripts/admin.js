$(document).ready(function() {

    $('#type').live('change', function() {
        var notDeleted = ['label', 'help_text','required','type','validation','groups', 'field_name', 'in_search'];
        $.ajax({
            dataType: 'text',
            url: base_url + 'admin/components/cp/cfcm/getFormFields/' + $(this).val(),
            success: function(data) {
                $('input, select').each(function() {
                    if ($.inArray($(this).attr('id'), notDeleted) === -1 && !$(this).closest('.chosen-container').length) {
                        $(this).closest('.control-group').remove();
                    }
                });
                
                if ($.trim(data)) {
                    $(data).insertAfter($('#type').closest('.control-group'));
                }
                
            }
        });
    });
});