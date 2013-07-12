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
                showMessage('Тип свойства обновлен', 'Сообщение');
            }
        });
    });
});