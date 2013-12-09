function send(id) {
    $.ajax({
        type: "post",
        url: '/admin/components/init_window/mail_chimp/send/' + id,
        success: function(data) {
            showMessage('Успешно',"Кампания отправлена");
        }
    });
}