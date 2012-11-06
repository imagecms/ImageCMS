$(document).ready(function() {
    $('#importcsvfile').on('change', function() {
        var selector = $(this).closest('form');
        $chekedFile = $('input[name=csvfile]:checked').val();
        selector.append('<input type="hidden" name="csvfile" value="' + $chekedFile + '"/>');
        $(selector).validate()
        if ($(selector).valid()) {
            var options = {
                success: function(data) {
                    try {
                        var obj = JSON.parse(data);
                        if (obj.error)
                            showMessage('Ошибка', obj.error);
                        if (obj.success == true) {
                            showMessage('Успешно', 'Файл загружен. Слот '+ $chekedFile);
                            if (obj.filesInfo.product_csv_1csv != '')
                                $('span[data-file=product_csv_1csv]').text(obj.filesInfo.product_csv_1csv);
                            if (obj.filesInfo.product_csv_2csv != '')
                                $('span[data-file=product_csv_2csv]').text(obj.filesInfo.product_csv_2csv);
                            if (obj.filesInfo.product_csv_3csv != '')
                                $('span[data-file=product_csv_3csv]').text(obj.filesInfo.product_csv_3csv);
                            loadCsvAttributes($chekedFile);
                        }
                    } catch (e) {
                    }
                    return true;
                }
            };
            $(selector).ajaxSubmit(options);
        }
    });

    $('input[name=csvfile]').on('change', function() {
        loadCsvAttributes($(this).val());
    })

    $('#makeImportForm').on('submit', function() {
        console.log('dasd');
        return false;
    });
    $('.dropdown-attr a').live('click', function() {
        $startPoint = $(this).closest('div');
        $name = $(this).text();
        $startPoint
                .find('.attrnameHolder')
                .text($name)
                .end()
                .find('button')
                .attr('title', $name);
//        console.log($(this).attr('data-attName'));
    })
    function loadCsvAttributes(val)
    {
        $.ajax({
            url: "/admin/components/run/shop/system/getAttributes",
            type: 'post',
            data: 'csvfile=' + val,
            success: function(data) {
                $('.attrHandler').html(data);
            }
        });
    }
});