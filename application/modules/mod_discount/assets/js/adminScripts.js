/**
 * Change is discount active or not
 */
$('.discounts_table').find('span.prod-on_off').add($('[data-page="tovar"]')).on('click', function() {
    var discount_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        data: 'id=' + discount_id, 
        url:'mod_discount/ajaxChangeActive',
        success: function(response) {
            if (response = 'true')
                showMessage('Статус изменен','','g')
        }
    });
});
/**
 * If check/unckech input for no limit count for discount
 */
$('.spanForNoLimit').bind('click',function(){
    var spanBlock = $(this);
    var checkBox = spanBlock.find('.noLimitCountCheck');
    var controlBlock = spanBlock.closest('.noLimitC');
    
    if (checkBox.prop('checked') == true){
        controlBlock.find('input:text').removeAttr('disabled');
    }else{
         controlBlock.find('input:text').prop('disabled','disabled');
         controlBlock.find('input:text').val('');
    }
})

/**
 * Show/hide blocks for every type of discount
 */
$('#selectDiscountType').bind('change',function (){
    var selectElement = $(this);
    discountType = selectElement.find("option:selected").val();
    
    console.log(selectElement.find("option:selected").val());
})

/**
 * Change discount value type (percent or fixed)
 */
$('#selectTypeValue').bind('change',function (){
    var selectElement = $(this);
    valueType = selectElement.find("option:selected").val();
    
    if (valueType == 1)
        $('#typeValue').text('%');
    else 
        $('#typeValue').text(currencySymbolJS);
    
    console.log(valueType);
    console.log(currencySymbolJS);
})




