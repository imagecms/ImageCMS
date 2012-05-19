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


    /**
    * Add to user wishlist
    */
    $('.addToWList').on('click', function(){
        var variantId = $(this).attr('data-varid');
        var productId = $(this).attr('data-prodid');
        $.fancybox.showActivity();
        $.ajax({
            type: "POST",
            data: 'productId = '+productId+'&variantId = '+variantId,
            url: "/shop/wish_list/add",
            success: function(){
                $("#wishListHolder").load('/shop/ajax/getWishListDataHtml').addClass('is_avail');
                $.fancybox.hideActivity();
            }
        });
        return false;
        //setTimeout(function() {  $("#wishListNotify").css('display', 'none') }, 2000);
    });


    /**
    * Add product for compare
    */
    $('.toCompare').on('click', function(){
        var productId = $(this).attr('data-prodid');
        var $this     = $(this);
        $.fancybox.showActivity();
        $.ajax({
            url: "/shop/compare/add/"+productId,
            success: function(){
                $("#compareHolder").load('/shop/ajax/getCompareDataHtml').addClass('is_avail');
                $.fancybox.hideActivity();
                $this
                    .text('Сравнить')
                    .removeClass('js')
                    .removeClass('gray')
                    .unbind('click');
            }
        });
        return false;
        //setTimeout(function() {  $("#wishListNotify").css('display', 'none') }, 2000);
    });



    $('a.goNotifMe').on('click', function(){
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

    $('.lineForm input[type=hidden]').on('change', function(){
        $(this).parents('form').submit();
    })

});