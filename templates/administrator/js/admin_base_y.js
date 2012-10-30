$(document).ready(function() {
    $('#importcsvfile').on('change', function() {
        var selector = $(this).closest('form');
        $(selector).validate()
        if ($(selector).valid())
        {
            var options = {
                success: function(data) {
                    try {
                        var obj = JSON.parse(data);
                        if (obj.error)
                            showMessage('Ошибка', obj.error);
                        if (obj.success == true)
                            alert('dasdas');
                    } catch (e) {
                    }
//                    var resp = document.createElement('div');
//                    resp.innerHTML = data;
//                    $(resp).find('p').remove();
//                    $('.notifications').append(resp);
//                    $(btn).removeClass('disabled').attr('disabled', false);
                    return true;
                }
            };
            $(selector).ajaxSubmit(options);
        }
    })
});