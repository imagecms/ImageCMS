$(document).ready(function(){

    /**
     * Add product to cart functionality
     * @event ckick
     * @return event     
     * @description 
     *      Adds product, specified by ID in "data"-parameter to cart
     * @usage
     *      Add the following structure to yor code: 
     *      "<a href="#" data-prodid="12" data-varid="21" class="goBuy">Buy product</a>"
     *      Where 'data-prodid' - product ID and 'data-varid' - variant ID
     */
    $('.buy a.goBuy').on('click',function(){
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
                    .addClass('goToCart')
                    .html('Оформить <br/> заказ')
                    .attr('href', '/shop/cart')
                    .unbind('click')
                    .parent('div')
                        .removeClass('button_gs')
                        .addClass('button_middle_blue');
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    /*   End of Event   */
    
    
    $('.buy a.goNotifMe').on('click', function(){        
        var $content = '<h2 style="background-color: #fff;">Hi!</h2><p style="background-color: #fff;">TODO: Show notification message</p>';
        $.fancybox($content, {
            'autoDimensions'	: false,
			'width'         	: 350,
			'height'        	: 'auto',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
            'onClosed'		: function() {$.fancybox.close();}        
            }
        );
        return false;
    })
    /*   End of Event   */    
    
    $('.cusel-scroll-pane span').on('click',function(){
        $(this).parents('form').submit();
    })
    
});