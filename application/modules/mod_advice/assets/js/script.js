$(document).ready(function () {

});

function senToDel() {
    $.post('/admin/components/init_window/mod_advice/del').done(function (result) {
        showMessage(lang('Message'), lang('Picture (s) successfully removed'));
    });
}