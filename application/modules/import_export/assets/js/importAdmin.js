$(document).ready(function() {

    /*IMPORT*/
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
            url: "/admin/components/init_window/import_export/getImport/imports",
            type: 'post',     
            data: $(this).serialize(),
            success: function(obj) {
                var object = jQuery.parseJSON(obj);
                if (object.propertiesSegmentImport.countProductsInFile) {
                    importSegment(object.propertiesSegmentImport, $names);
                } else {
                    buildImportReport(obj);
                }
            }
        });
        return false;
    });

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
            url: "/admin/components/init_window/import_export/getImport/getAttributes",
            type: 'post',
            data: 'csvfile=' + val,
            success: function(data) {
                $('.attrHandler').html(data);
            }
        });
    }
    
    function importSegment(obj, attr, limit1) {
        limit = 10;
        var countProd = obj.countProductsInFile;
        $('#progressBlock').css("display", "block"); 
        if(limit1){
            i = limit + limit1;
        }else{
            i = limit;            
        }
        var x = i * 100 / countProd;
        $('#percent').css("width", Math.floor(x) + '%');
        $('#ratio').html(i + '/' + countProd);
        
        $.ajax({
                url: '/admin/components/init_window/import_export/getImport/segmentImport',
                type: 'post',
                data: {
                    csvfile: obj.csvfile,
                    attributes: attr,
                    delimiter: obj.delimiter,
                    enclosure: obj.enclosure,
                    encoding: obj.encoding,
                    import_type: obj.import_type,
                    language: obj.language,
                    currency: obj.currency,
                    offers: i,
                    limit: limit,
                    countProd: countProd
                },
                success: function() {
//                    var obj = obj;
                    if(i<=countProd){
                        importSegment(obj, attr, i);
                    }else{
                        $('#progressBlock').fadeOut('slow');
                    }
                }                
            });
//        buildImportReport(obj);            
    }

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
    }
});
