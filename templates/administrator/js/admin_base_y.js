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
                        if (obj.success == true) {
                            $('#fileselect').show();

                        }
                    } catch (e) {
                    }
                    return true;
                }
            };
            $(selector).ajaxSubmit(options);
        }
    });

    $('#makeImportForm').on('submit', function() {
        console.log('dasd');
        return false;
    });
    $('.dropdown-attr a').on('click', function() {
        console.log($(this).closest('div').find('.attrnameHolder').text($(this).text()));
        console.log($(this).attr('data-attName'));
    })
});