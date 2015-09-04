$(document).ready(function () {

});

function senToDel() {
    $.post('/admin/components/init_window/mod_advice/del').done(function (result) {
        console.log(result)
        showMessage(lang('Message'), lang('Banner (s) successfully removed'));
    });
}