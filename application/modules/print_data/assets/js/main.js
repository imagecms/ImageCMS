function printData(obj) {
    window.location.href = $(obj).attr('data-href')

}
$(document).ready(function() {
    
    
    $('#variantSwitcher').live('change', function() {
        var productId = $(this).attr('value');
        var vId = $('span.variant_' + productId).attr('data-id');

        var href = $('#print_btn').attr('data-href');
        var arr_href = href.split('/');
        arr_href[arr_href.length - 1] = vId;
        $('#print_btn').attr('data-href', arr_href.join('/'));


    });
})
