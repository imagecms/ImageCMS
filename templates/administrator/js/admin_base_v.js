function change_page_status(page_id) {
    $.ajax({
        type: 'POST',
        url: base_url + 'admin/pages/ajax_change_status/' + page_id,
        onComplete: function(response) { }
    });
}

$(document).ready(function(){
    
});