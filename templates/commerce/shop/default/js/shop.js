$(document).ready(function(){

    $('.buy a.goBuy').live('click',function(){        
        $.fancybox.showActivity();
        var id_var  = $(this).attr('data-varid');
        var id      = $(this).attr('data-prodid');
        var $this   = $(this);            
        $.ajax({
            type: 'post',
            data: "quantity="+1+"&productId="+id+"&variantId="+id_var,
            url: '/shop/cart/add',
            success: function(){
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');                
                $this
                    .removeClass('goBuy')
                    .html('Оформить <br/> заказ')
                    .attr('href', '/shop/cart')
                    .parent('div')
                        .removeClass('button_gs')
                        .addClass('button_middle_blue');                        
                $.fancybox.hideActivity();
            }
        });
        return false;
    });

});