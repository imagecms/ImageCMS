function changethema(el) {

    $('#logo').attr('src', '/templates/newLevel/' + $(el).val() + '/screenshot.png')

}

$(document).ready(function() {
    $('.propertiesTypes').die().live('change', function() {
        var checked = $(this).attr('checked');
        var url = '/new_level/admin/addPropertyType';

        if (!checked) {
            url = '/new_level/admin/removePropertyType';
        }

        var value = $(this).val();
        var propertyId = $(this).data('properti_id');
        $.ajax({
            type: 'POST',
            data: {
                type: value,
                propertyId: propertyId
            },
            url: url,
            success: function(data) {
                showMessage(lang('Message'), lang('Property type updated'));
            }
        });
    });

    $('.cattegoryColumnSaveButtonMod').die().live('click', function() {
        var savedSelect = $(this).parent().find('select');
        var data = $(this).parent().find('select').val();
        var column = $(this).data('column');

        $('.ColumnsSelect').each(function() {
            if (this.id != savedSelect.data('id')) {
                $(this).find('option:selected').each(function() {
                    if ($.inArray($(this).val(), data) > -1) {
                        $(this).removeAttr('selected');
                    }
                });
            }

        });

        $.ajax({
            type: "POST",
            data: {
                categories_ids: data,
                column: column
            },
            url: '/new_level/admin/saveCategories',
            success: function(res) {
                showMessage(lang('Message'), lang('Column') + column + lang('updated'));
            }
        });
    });

    $('table.propertyTypes .icon-edit').live('click', function() {
        var editor = $(this).closest('tr').find('div.propertyType');
        var editValue = editor.text();
        editor.empty();
        editor.parent().find('.typeEdit').css('display', 'block').val(editValue);
        $(this).closest('tr').find('.icon-refresh').parent('button').css('display', 'inline-block');

    });

    $('table.columns .icon-edit').live('click', function() {
        var editor = $(this).closest('tr').find('div.columns');
        var editValue = editor.text();
        editor.empty();
        editor.parent().find('.columnEdit').css('display', 'block').val(editValue);
        $(this).closest('tr').find('.icon-refresh').parent('button').css('display', 'inline-block');

    });

    $('table.propertyTypes + .addType').live('click', function() {
        $('.addTypeContainer').css('display', 'block');
    });

    $('table.columns + .addColumn').live('click', function() {
        $('.addColumnContainer').css('display', 'block');
    });

    $('.themeSave').die().live('click', function() {
        var theme = $('#template').val();
        $.ajax({
            type: 'POST',
            data: {
                theme: theme
            },
            url: '/new_level/admin/get_thema',
            success: function(data) {
                showMessage(lang('Message'), lang('Data successfully saved'));
            }
        });
    });

});

var PropertiesTypes = {
    delete: function(type, curElement) {
        $.ajax({
            type: 'POST',
            data: {
                type: type
            },
            url: '/new_level/admin/deletePropertyType',
            success: function(data) {
                curElement.closest('tr').remove();
                showMessage(lang('Message'), lang('Type of property successfully removed'));
            }
        });
    },
    edit: function(curElement, oldType) {
        var newType = curElement.parent('div').find('.typeEdit').val();
        $.ajax({
            type: 'POST',
            data: {
                oldType: oldType,
                newType: newType
            },
            url: '/new_level/admin/editPropertyType',
            success: function(data) {
                curElement.parent('div').text(newType);
                showMessage(lang('Message'), lang('Type of property successfully updated'));
            }
        });
    },
    add: function(curElement) {
        var newType = curElement.parent('div').find('.typeAdd').val();
        $.ajax({
            type: 'POST',
            data: {
                newType: newType
            },
            url: '/new_level/admin/addType',
            success: function(data) {
                curElement.parent('div').find('.typeAdd').val('');
                $('.addTypeContainer').css('display', 'none');
                $(data).insertBefore('table.propertyTypes .addTypeContainer');
                showMessage(lang('Message'), lang('Type of property successfully added'));
            }
        });
    }
};


var Columns = {
    delete: function(column, curElement) {
        $.ajax({
            type: 'POST',
            data: {
                column: column
            },
            url: '/new_level/admin/deleteColumn',
            success: function(data) {
                curElement.closest('tr').remove();
                showMessage(lang('Message'), lang('Column') + column + lang('removed'));
            }
        });
    },
    edit: function(curElement, oldColumn) {
        var newColumn = curElement.parent('div').find('.columnEdit').val();
        $.ajax({
            type: 'POST',
            data: {
                oldColumn: oldColumn,
                newColumn: newColumn
            },
            url: '/new_level/admin/editColumn',
            success: function(data) {
                curElement.parent('div').text(newColumn);
                showMessage(lang('Message'), lang('Column successfully removed'));
            }
        });
    },
    add: function(curElement) {
        var newColumn = curElement.parent('div').find('.columnAdd').val();
        $.ajax({
            type: 'POST',
            data: {
                newColumn: newColumn
            },
            url: '/new_level/admin/addColumn',
            success: function(data) {
                curElement.parent('div').find('.columnAdd').val('');
                $('.addColumnContainer').css('display', 'none');
                $(data).insertBefore('table.columns .addColumnContainer');
                showMessage(lang('Message'), lang('Column') + newColumn + lang('successfully added'));
            }
        });
    }
};
