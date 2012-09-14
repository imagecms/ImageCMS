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
        
        console.log(positionsArray);
        
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
        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            success: function(result){
                $('#mainContent').html(result);
            }
        });
    });
    
});