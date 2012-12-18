$(document).ready(function() {

    /*IMPORT EXPORT*/
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
                            showMessage('Успешно', 'Файл загружен. Слот ' + $chekedFile);
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

    $('input[name=csvfile]').live('change', function() {
        loadCsvAttributes($(this).val());
    })

    $('#makeImportForm').on('submit', function() {
        $chekedFile = $('input[name=csvfile]:checked').val();

        $names = '';
        $('.attrnameHolder').each(function(index) {
            $names = $names + $(this).attr('data-attrnames') + ',';
        })
        $('input[type=hidden].attributes').val($names);
        $('input[type=hidden].slothidden').val($chekedFile);

        $.ajax({
            url: "/admin/components/run/shop/system/import",
            type: 'post',
            data: $(this).serialize(),
            success: function(data) {
                showMessage('', data);
            }
        });
        return false;
    });
    $('.dropdown-attr a').live('click', function() {
        $startPoint = $(this).closest('div');
        $name = $(this).text();
        $attname = $(this).attr('data-attname');
        $names = '';
        $startPoint
                .find('.attrnameHolder')
                .text($name)
                .attr('data-attrnames', $attname)
                .end()
                .find('button')
                .attr('title', $name);
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

    $(".runExport").on("click", function() {
        $this = $('#makeExportForm');
        $.ajax({
            url: "/admin/components/run/shop/system/export",
            type: "post",
            data: $this.serialize(),
            success: function(msg) {
                if (msg == '')
                    $this.submit();
                else
                    showMessage("", msg);
            }
        });
    });
    /**/
});