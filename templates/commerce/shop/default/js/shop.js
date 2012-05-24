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
    $('.buy .goBuy').on('click',function(){
        $.fancybox.showActivity();
        var id_var  = $(this).attr('data-varid');
        var id      = $(this).attr('data-prodid');
        var $this   = $(this);
        $.ajax({
            type: 'post',
            data: "quantity="+1+"&productId="+id+"&variantId="+id_var,
            url: '/shop/cart/add',
            success: function(msg){
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if ($this.parent('div').hasClass('button_big_green'))
                {
                    $('.in_cart').html('Уже в корзине');
                    $this
                    .html('Оформить заказ');
                }
                else
                {
                    $this
                    .removeClass('goBuy')
                    .addClass('goToCart')
                    .html('Оформить <br/> заказ')
                    .parent('div')
                    .removeClass('button_gs')
                    .addClass('button_middle_blue');
                }
                $('.in_cart').html('Уже в корзине');
                $this
                .attr('href', '/shop/cart')
                .unbind('click');
                showResponse(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    /*   End of Event   */

    $('.loginAjax').on('click', function(){
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/auth/login',
            success: function(msg){                
                showResponse(msg);
                $.fancybox.hideActivity();
                $(".enter_reg").tabs();
            }
        });
        return false;
    });


    $('.center').delegate('.is_avail a.goCartData', 'click',function(){
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/shop/cart/add',
            success: function(msg){
                showResponse(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });

    /**
     * Add to user wishlist
     */
    $('.addToWList').on('click', function(){
        var $this= $(this);
        var variantId = $(this).attr('data-varid');
        var productId = $(this).attr('data-prodid');
        $.fancybox.showActivity();
        $.ajax({
            type: "POST",
            data: 'productId = '+productId+'&variantId = '+variantId,
            url: "/shop/wish_list/add",
            success: function(){
                $this.html('Уже в списке желаний').removeClass('js').removeClass('gray');
                $("#wishListHolder").load('/shop/ajax/getWishListDataHtml').addClass('is_avail');
                $.fancybox.hideActivity();
            }
        });
        return false;
    //setTimeout(function() { $("#wishListNotify").css('display', 'none') }, 2000);
    });


    /**
     * Add product for compare
     */
    $('.toCompare').on('click', function(){
        var productId = $(this).attr('data-prodid');
        var $this = $(this);
        $.fancybox.showActivity();
        $.ajax({
            url: "/shop/compare/add/"+productId,
            success: function(){
                $("#compareHolder").load('/shop/ajax/getCompareDataHtml').addClass('is_avail');
                $.fancybox.hideActivity();
                $this
                .html('Сравнить')
                //   .text('Сравнить')
                .removeClass('js')
                .removeClass('gray')
                .unbind('click');
            }
        });
        return false;
    //setTimeout(function() { $("#wishListNotify").css('display', 'none') }, 2000);
    });



    $('.goNotifMe').on('click', function(){
        $.fancybox.showActivity();
        var id_var  = $(this).attr('data-varid');
        var id      = $(this).attr('data-prodid');
        var $this   = $(this);
        $.ajax({
            type: 'post',
            data: "ProductId="+id,
            url: '/shop/ajax/getNotifyingRequest',
            success: function(msg){                
                showResponse(msg);
                bindNotifMeForm();
                $.fancybox.hideActivity();
            }
        }
        );

        return false;
    })
    /* End of Event */

    $('.lineForm input[type=hidden]').on('change', function(){
        $(this).parents('form').submit();
    });

    $('.plus_minus button').live('click', function(){
        $this = $(this);
        $target = $(this).parent().parent().find('input');
        $val = $target.val();
        $form = $(this).parents('form');
        if($(this).hasClass('count_up')){
            $target.val($val*1+1);
        }
        else{
            if($val != '1')
                $target.val($val*1-1);
        }
        $.fancybox.showActivity();
        $form.find('input[name=makeOrder]').val(0);
        $.ajax({
            type: 'post',
            data: $form.serialize() + '&recount=1',
            url: '/shop/cart',
            success: function(msg){
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if($this.hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);
                else
                    showResponse(msg);
                $form.find('input[name=makeOrder]').val(1);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });

    $('.delete_text').live('click', function(){
        $.fancybox.showActivity();
        $data = null
        $target = $(this).attr('href');
        $this = $(this);
        if($this.hasClass('inCartProducts'))
            $data = '&forCart=true'
        $.ajax({
            type: 'post',
            data: $data,
            url: $target,
            success: function(msg){
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if($this.hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);
                else
                    showResponse(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });

    $('.met_del').bind('click',function(){
        var nid = $(this);
        $('#deliveryMethodId').val(nid.val());
        $.ajax({
            url: "/shop/cart/getPaymentsMethods/"+nid.val(),
            success: function(msg){
                $("#paymentMethods").html(msg);
                $('#paymentMethodId').val($('.met_buy:eq(0)').val());
            //                var myv = nid.attr('data-price');
            //                if ((nid.attr('data-freefrom') != 0)&&($('#total_price').text() > nid.attr('data-freefrom')))
            //                    myv = '0';
            //                $('#delivery_price').text(myv);
            //                $('#gtprice').text(parseInt($('#total_price').text()) + parseInt(myv));
            //                $('#gtpricev').text(parseInt($('#total_pricev').text()) + Math.ceil(parseInt(myv)/$('#second_v').val()));
            }
        });
    });
    $('.met_buy').live('click',function(){
        $('#paymentMethodId').val($(this).val());
    });

    $('.showCallback').on('click', function(){
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/shop/shop/callback',
            success: function(msg){
                showResponse(msg);
                bindCallbackForm();
                $.fancybox.hideActivity();
            }
        });
        return false;
    })

    function bindNotifMeForm(){
        $('.order_call #notifMe').bind('submit',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/ajax/getNotifyingRequest',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindNotifMeForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindCallbackForm(){
        $('.order_call form').bind('submit',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/shop/callback',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindCallbackForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function showResponse(responseText, statusText, xhr, $form){
        try {
            var obj = $.parseJSON(responseText);
        } catch(e) {
        }

        if (typeof obj != 'undefined') {
            if (obj != null) {
                $.fancybox(obj.msg, {
                    'titleShow' : false,
                    'padding' : 0,
                    'margin' : 0,
                    'overlayOpacity' : 0.5,
                    'overlayColor' : '#000',
                    'transitionIn' : 'elastic',
                    'transitionOut' : 'elastic',
                    'showNavArrows' : false,
                    'onComplete' : function(){
                        setTimeout('$.fancybox.close()', 3000);
                    }
                });
            } else {
                $.fancybox(responseText, {
                    'titleShow' : false,
                    'padding' : 0,
                    'margin' : 0,
                    'overlayOpacity' : 0.5,
                    'overlayColor' : '#000',
                    'transitionIn' : 'elastic',
                    'transitionOut' : 'elastic',
                    'showNavArrows' : false
                });
            }
        }
        else {
            $.fancybox(responseText, {
                'titleShow' : false,
                'padding' : 0,
                'margin' : 0,
                'overlayOpacity' : 0.5,
                'overlayColor' : '#000',
                'transitionIn' : 'elastic',
                'transitionOut' : 'elastic',
                'showNavArrows' : false
            });
        }
    }
});