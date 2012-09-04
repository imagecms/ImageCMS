// Scripts for cart.tpl
function changePaymentMethod(id)
{
    document.getElementById('paymentMethodId').value = id;
}
function changeDeliveryMethod(id, free)
{
    document.getElementById('deliveryMethodId').value = id;
    if (free == true)
    {
        document.getElementById('totalPriceText').innerHTML = totalPrice + ' ' + currencySymbol;
    }
    else
    {
        var result = parseFloat(deliveryMethods_prices[id]) + parseFloat(totalPrice);
        document.getElementById('totalPriceText').innerHTML = result.toFixed(2).toString() + ' ' + currencySymbol;
    }
    $('#paymentMethods').html('<img src="/templates/commerce/shop/default/style/images/ui-anim_basic_16x16.gif" />');
    $.ajax({
        url: "/shop/cart/getPaymentsMethods/"+id,
        success: function(html){
            if(html){
                $("#paymentMethods").html(html);
            }
        }
    });
}