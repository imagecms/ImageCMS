function change_page_status(page_id) {
    $.ajax({
        type: 'POST',
        url: base_url + 'admin/pages/ajax_change_status/' + page_id,
        onComplete: function(response) { }
    });
}

$(document).ready(function(){
    $( ".pages-table" ).bind( "sortstop", function(event, ui) {
        var positionsArray = {};
        
        $('.pages-table > tbody').children('tr').each(function(){
            positionsArray['pages_pos['+$(this).index()+']'] = 'page'+$(this).attr('data-id')+'_'+$(this).index();
        });
        
        $.ajax({
            type: 'post',
            data: positionsArray,
            url: '/admin/pages/save_positions/',
            success: function(obj){
                if(obj.result){
                    //alert("positions changed successfull");
                }
            }
        });
    });
    
    $('a.ajax_load').click(function(event){
        event.preventDefault();
        $('#mainContent').load($(this).attr('href'));
        /*
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            success: function(result){
                $('#mainContent').html(result);
            }
        });
        */
    });
    
    $('#categorySelect').on('change', function(){
        //$('#mainContent').load($(this).attr('url')+$(this).val());
        window.location.href = $(this).attr('url')+$(this).val();
    });
    
    $('button.pages_action').click(function(event){
        event.preventDefault();
        var pagesArray = {};
        
        $('.pages-table > tbody').children('tr').children('td.t-a_c').find('input:checked').each(function(){
            pagesArray['pages['+$(this).attr('data-id')+']'] = 'chkb_'+$(this).attr('data-id');
        });
        
        if (parseInt($('#categorySelect').val(), 10) > 0)
            pagesArray['new_cat'] = $('#categorySelect').val();
        else
            pagesArray['new_cat'] = 0;
        
        $.ajax({
            type: 'post',
            data: pagesArray,
            url: $(this).attr('url'),
            success: function(result){
                //$('#mainContent').html(result);
                window.location.href = '/admin/pages/GetPagesByCategory/'+pagesArray['new_cat'];
            }
        });
    });
    
    $( "#pages_action_dialog" ).dialog("destroy");
    
    $("#pages_action_dialog").dialog({
        resizable: false,
        autoOpen: false,
        height:140,
        modal: true,
        buttons: {
                "Delete all items": function() {
                        $( this ).dialog( "close" );
                },
                Cancel: function() {
                        $( this ).dialog( "close" );
                }
        }
    });
    
});