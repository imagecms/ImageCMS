if (selectDeliv)
    var methodDeliv = '#method_deliv';
else
    var methodDeliv = '[name = "deliveryMethodId"]';
var Order = {
}
$(document).on('scriptDefer', function() {
    if (selectDeliv) {
        cuselInit($(genObj.frameDelivery), methodDeliv);
    }
    else {
        
    }

//    if (selectPayment)
//        cuselInit($(genObj.pM), '#paymentMethod');
});
function initOrderTrEv() {
    $(".maskPhoneFrame input").mask("+9 (9999) 999-99-99");
}