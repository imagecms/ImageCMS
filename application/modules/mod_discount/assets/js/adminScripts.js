$(document).ready(
        function() {
    
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

        $('.forHide').hide();
        $('#'+discountType+'Block').show();
    })

    /**
     * Change discount value type (percent or fixed)
     */
    $('#selectTypeValue').bind('change',function (){
        var selectElement = $(this);
        valueType = selectElement.find("option:selected").val();
        
        $('#valueInput').val('');
        if (valueType == 1)
            $('#typeValue').text('%');
        else 
            $('#typeValue').text(currencySymbolJS);
    })

    /**
     * Generate discount key and insert into input 
     */
    $('#generateDiscountKey').bind('click', function (){
        $.ajax({
            type: 'POST',
            url:'generateDiscountKey',
            success: function(response) {
                if (response != null)
                    $('#discountKey').val(response);
            }
        });
    })

     /**
      *  Autocomplete users
      */
        if($('#usersForDiscount').length){
            $('#usersForDiscount').autocomplete({
                source: 'autoCompliteUsers?limit=25',
                select: function(event, ui) {
                    userData = ui.item;
                },
                close: function() {
                    $('#discountUserId').val(userData.id);
                }
            });
        }

        /**
         * Autocomplete products
         */
        if($('#productForDiscount').length){
            $('#productForDiscount').autocomplete({
                source: 'autoCompliteProducts?limit=25',
                select: function(event, ui) {
                    productsData = ui.item;
                },
                close: function() {
                 $('#discountProductId').val(productsData.id);
                }
            });
        }


        /**
         * Make input only for numbers. If type of value == percent, then (1-100), if type of value == fixed, then type int. 
         */
         $('#valueInput').bind('keyup',function(){
            var typeOfValue = $('#selectTypeValue').val();
            var value = $(this).val(); 
            var regexp = /[^0-9]/gi;
            value = value.replace(regexp, '');
            
            // Can not begin from 0
            if (parseInt(value) == 0)
                value = '';
            $(this).val(value);
            
            // Percent
            if (typeOfValue == 1){
                if (parseInt(value) >100){
                    $(this).val(100);
                }
            }
         })
         
         /**
          * Make input only numbers (int)
          */
        $('.onlyNumbersInput').bind('keyup',function(){
            var value = $(this).val(); 
            var regexp = /[^0-9]/gi;
            value = value.replace(regexp, '');
            $(this).val(value);
        })

})
