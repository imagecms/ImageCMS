function printData(obj) {

    window.location.href = $(obj).attr('data-href');

}

$(document).on('afrer_change_variant', function(event) {
    var href = $('#print_btn').attr('data-href');
    var arr_href = href.split('/');
    arr_href[arr_href.length - 1] = event.vId;
    $('#print_btn').attr('data-href', arr_href.join('/'));

});