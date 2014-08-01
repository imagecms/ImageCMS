$(document).ready(function() {

    /*IMPORT EXPORT*/
    $("#importcsvfile").unbind('change').bind('change', function() {
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
                            showMessage(langs.error, obj.error);
                        if (obj.success == true) {
                            showMessage(langs.success, langs.fileLoaded + $chekedFile);
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
    $("input[name='csvfile']").unbind('change').bind('change', function() {
        var fileNum = $(this).val();
        loadCsvAttributes(fileNum);
    });




    $('#makeImportForm').unbind('submit').bind('submit', function() {
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
            success: function(obj) {
                buildImportReport(obj);
            }
        });
        return false;
    });
    function buildImportReport($obj) {
        try {
            $object = jQuery.parseJSON($obj);
            if ($object.error != null)
                showMessage('', $object.message);
            else if ($object.success != null) {
                showMessage('', $object.message);
            }
        }
        catch (err) {
            showMessage('', langs.scriptErrorTellAdmin);
        }
//                $('.importProcess').fadeOut(100);
//                $('.importRaport').fadeIn(100);
    }

    $('.dropdown-attr a').unbind('click').bind('click', function() {
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



    $(".runExport").unbind("click").click(function() {
        $(".runExport").button('loading');
        $.ajax({
            url: "/admin/components/run/shop/system/export",
            type: "post",
            data: $('#makeExportForm').serialize(),
            success: function(data) {
                switch (data) {
                    case "csv":
                    case "xls":
                    case "xlsx":
                        $("#makeExportForm input[name='formed_file_type']").val(data);
                        $('#makeExportForm').submit();
                        break;
                    default:
                        showMessage("", data);
                }
            },
            complete: function(xhr) {
                $(".runExport").button('reset');
            }
        });
    });


    $("#showCatProps").unbind("click").click(function() {
        showCatProp();
    });


    function showCatProp() {
        var catData = $('#selectedCats').serialize();

        if (!catData) {
            // empty - show message
            $("#pleaseSelectCats").fadeIn(100);
            return;
        }

        var time = new Date().getTime(); // disable caching
        $.ajax({
            url: "/admin/components/run/shop/system/getCategoryProperties/" + time,
            type: 'post',
            data: catData,
            beforeSend: function() {
                $('#showCatProps').button('loading');
                $('.properties_result .serverResponse').remove();
            },
            success: function(data) {
                $('.properties_result').append(data);
                initNiceCheck();
            },
            complete: function() {
                $("#showCatProps").button('reset');
                $("#pleaseSelectCats").hide();
            }
        });
    }





});
