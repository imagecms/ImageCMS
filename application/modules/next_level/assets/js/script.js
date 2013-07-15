$(document).ready(function() {
    $('.propertiesTypes').live('change', function (){
        
        var value = $(this).val();
        var propertyId = $(this).data('properti_id');
        $.ajax({
            type: 'POST',
            data: {
                type: value,
                propertyId: propertyId
            },
            url: '/next_level/admin/addPropertyType',
            success: function(data) {
                showMessage('Сообщение', 'Тип свойства обновлен');
            }
        });
    });
    
    $('table.propertyTypes .icon-edit').live('click', function (){
        var editor = $(this).closest('tr').find('div.propertyType');
        var editValue = editor.text();
        editor.empty();
        editor.parent().find('.typeEdit').css('display', 'block').val(editValue);
        $(this).closest('tr').find('.icon-refresh').parent('button').css('display', 'inline-block');
        
    });
    $('table.propertyTypes + .addType').live('click', function (){
       $('.addTypeContainer').css('display','block');
        
    });
    
});
var PropertiesTypes = {
   delete: function(type, curElement){
                 $.ajax({
                    type: 'POST',
                    data: {
                        type: type
                    },
                    url: '/next_level/admin/deletePropertyType',
                    success: function(data) {
                        curElement.closest('tr').remove();
                        showMessage('Сообщение', 'Тип свойства успешно удален');
                    }
                });
            },
    edit: function(curElement, oldType){
            var newType = curElement.parent('div').find('.typeEdit').val();
            $.ajax({
                type: 'POST',
                data: {
                    oldType: oldType,
                    newType: newType
                },
                url: '/next_level/admin/editPropertyType',
                success: function(data) {
                    curElement.parent('div').text(newType);
                    showMessage('Сообщение', 'Тип свойства успешно обновлен');
                }
            });
        },
    add: function(curElement){
        var newType = curElement.parent('div').find('.typeAdd').val();
         $.ajax({
                type: 'POST',
                data: {
                    newType: newType
                },
                url: '/next_level/admin/addType',
                success: function(data) {
                    curElement.parent('div').find('.typeAdd').val('');
                    $('.addTypeContainer').css('display','none');
                    $(data).insertBefore('table.propertyTypes .addTypeContainer');
                    showMessage('Сообщение', 'Тип свойства успешно додано');
                }
            });
    }
};
 