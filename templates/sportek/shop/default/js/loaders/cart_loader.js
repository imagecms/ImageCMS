$(document).ready(function(){
    $('.callFB').click(function(){$.fancybox({'href': '/shop/cart'});})
    
    $('#deliveryMethods select').bind('change',function(){
        $.ajax({
            url: "/shop/cart/getPaymentsMethods/"+$(this).find('option:selected').val(),
            success: function(html){
                if(html){
                    $("#paymentMethods").html(html);
                }
            }
        });
    });

    $('#order_info_form').validate();
    $('#second #loginFormOrder').validate({
        submitHandler: function(target) {
            $('.userError').hide();
            $.ajax({
                type: "POST",
                url: "/auth",
                dataType: "json",
                data: "isAsyncReq=true&username="+target.username.value+"&password="+target.password.value,
                success: function(msg){
                    if(msg.isError == 0){
                        window.location.reload();                        
                    }else{
                        $('.userError').text(msg.message).show();

                    }
                }
            });

            console.log(target.username.value);
            console.log(target.password.value);
            return false;
        },
        onkeyup: function(){
            $('.userError').hide();
        }
    });

    $('.small_padd .js').fancybox({width: '300px'});

});