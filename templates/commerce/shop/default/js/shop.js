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
    $("a.grouped_elements").fancybox({
        showNavArrows: true,
        cyclic: true
    });

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
                if ($this.parent().hasClass('button_big_green'))
                {
                    $('.in_cart').html('Уже в корзине');
                    $this.parent().removeClass('button_big_green').addClass('button_big_blue')
                    $this.html('Оформить заказ');
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
                // $('.in_cart').html('Уже в корзине');
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
                bindLoginForm();
                bindRegisterLink();
                $.fancybox.hideActivity();
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
        var logged_in = $(this).attr('data-logged_in');
        $.fancybox.showActivity();
        console.log($(this).attr('data-logged_in'));
        if (logged_in == 'true'){
            $.ajax({
                type: "POST",
                data: 'productId = '+productId+'&variantId = '+variantId,
                url: "/shop/wish_list/add",
                success: function(){
                    $this.html('Уже в списке желаний').removeClass('js').removeClass('gray');
                    $this.attr('href','/shop/wish_list');
                    $this.unbind('click');
                    $("#wishListHolder").load('/shop/ajax/getWishListDataHtml').addClass('is_avail');
                    $.fancybox.hideActivity();
                }
            });
        }else{
            $('.loginAjax').trigger('click');
        }
        return false;
    //setTimeout(function() { $("#wishListNotify").css('display', 'none') }, 2000);
    });

    $('#towishlist').on('click', function(){
        var logged_in = $(this).attr('data-logged_in');
           if (logged_in != 'true'){
           $('.loginAjax').trigger('click');}
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

    $('.changeCurrency').on('change', function(){
        $(this).parents('form').submit();
    })

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
    function bindLoginForm(){
        $('.enter_form form').bind('submit',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/auth/login',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindLoginForm();
                    bindRegisterLink();
                    var obj = $.parseJSON(msg);
                    if (typeof obj != 'undefined') {
                        if (obj != null) {
                            $('.auth_data').html(obj.header);
                            $('.addToWList').bind('click');
                            $('.addToWList').attr('data-logged_in', 'true');
                            $.fancybox.resize();
                        }
                    }
                    $('.reg_me').bind('click', bindRegisterForm());
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindRegisterForm(){
        $('.enter_form form').bind('submit',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/auth/register',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindRegisterForm();
                    bindLoginLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }
    function bindRegisterLink(){
        $('.reg_me').bind('click',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/auth/register',
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindRegisterForm();
                    bindLoginLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }
    function bindLoginLink(){
        $('.auth_me').bind('click',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/auth/login',
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindLoginForm();
                    bindRegisterLink();
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