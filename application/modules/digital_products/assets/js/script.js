$(document).ready(function() {

    var identifier = window.location.pathname.split('/').pop();

    $.get('/digital_products/get_link/'+identifier, function(data){
        $('.item_tovar').append(data);
    });
    
});