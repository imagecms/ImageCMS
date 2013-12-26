/**
 * Cart
 * @type object
 */
Cart = {
    /**
     * Get payments methods by delivery method
     * @param {int} deliveryMethodId - delivery method id
     * @param {string} paymentMethodBlock - block id for adding payments method template
     * @param {string} paymentMethodSelectItemTemplate - id of template used for pmethods
     * @returns {undefined}
     */
    getPaymentSystems: function(el, deliveryMethodId, paymentMethodBlock, paymentMethodSelectItemTemplate) {
        /** Prepare default values **/
        if (paymentMethodBlock === undefined) {
            paymentMethodBlock = 'paymentMethodBlock';
        }
        if (paymentMethodSelectItemTemplate === undefined) {
            paymentMethodSelectItemTemplate = 'paymentMethodSelectItemTemplate';
        }

        /** Declarate variables **/
        var deliveryPriceClass = 'deliveryPriceSum'; // Class of element for displaying delivery price in main currency
        var deliveryPriceClassNextCS = 'deliveryPriceSumNextCS';// Class of element for displaying delivery price in additional currency
        var jArray;
        var jPaymentMethodBlock = $('#' + paymentMethodBlock);
        var jPaymentMethodSelectItemTemplate = $('#' + paymentMethodSelectItemTemplate);
        var jThisElement = $(el);
        var deliveryPrice = jThisElement.data('price');
        var deliveryPriceNextCS = jThisElement.data('pricenextcs');
        
        /** Prepare default values for delivery methods price**/
        if (deliveryPriceNextCS === undefined) {
            deliveryPriceNextCS = 0;
        }
        if (deliveryPrice === undefined) {
            deliveryPrice = 0;
        }

        /** Run ajax request **/
        $.ajax({
            async: false,
            type: 'get',
            url: 'order/getPaymentsMethods/' + deliveryMethodId,
            success: function(response) {
                /** Try parse json **/
                try {
                    jArray = $.parseJSON(response);
                } catch (e) {
                    console.log(e);
                }

                /** If no errors in response data then show payment methods**/
                if (jArray.success === true) {
                    jPaymentMethodBlock.show();
                    $(genObj.pM).html('');
                    $(genObj.pM).html(jPaymentMethodSelectItemTemplate.html());

                    /** Show delivery price **/
                    $('.' + deliveryPriceClass).html(deliveryPrice);
                    $('.' + deliveryPriceClassNextCS).html(deliveryPriceNextCS);

                    /** Add payment methods options to select **/
                    $(jArray.data).each(function(key, value) {
                        $('#' + paymentMethodBlock).find('select').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    /** Init cusel for select **/
                    cuselInit($(genObj.pM), '#paymentMethod');
                } else {
                    /** Log error **/
                    console.log(jArray.message);
                }
            }
        });
    }
};

