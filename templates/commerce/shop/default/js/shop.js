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
    /*
    $("a.grouped_elements").fancybox({
        showNavArrows: true,
        cyclic: true
    });
    */
        var fancyOptions = {
        helpers	: {
            title: { type: 'inside' }    
        },
        beforeLoad: function() {
            var el, id = $(this.element).data('title-id');

            if (id) {
                el = $('#' + id);

                if (el.length) {
                    this.title = el.html();
                }
            }
        }
        };
        
        if ($('.fancybox-thumb').last().hasClass('withThumbs'))
            fancyOptions.helpers.thumbs = {
                    width	: 50,
                    height	: 50};
        if ($('.fancybox-thumb').last().hasClass('withButtons'))    
            fancyOptions.helpers.buttons = {};
            
        //console.log(fancyOptions);
   
        $('.fancybox-thumb').fancybox(fancyOptions);
   
    
    $('span.clickrate').on('click', function(){
        var val = $(this).attr('title');
        $.ajax({
            type: "POST",
            data: "pid="+currentProductId+"&val="+val,
            dataType: "json",
            url:'/shop/ajax/rate',
            success: function(obj){
                if(obj.classrate != null)
                    $('#'+currentProductId+'_star_rating').removeClass().addClass('rating '+obj.classrate+' star_rait');
            }            
        });
    });
    
    $('span.clicktemprate').on('click',function(){
        var rate = $(this).attr('title');
        var ratec;
        if (rate == 1) ratec = "onestar";
        if (rate == 2) ratec = "twostar";
        if (rate == 3) ratec = "threestar";
        if (rate == 4) ratec = "fourstar";
        if (rate == 5) ratec = "fivestar";
        $('#comment_block').removeClass().addClass('rating '+ratec+' star_rait');
        $('#ratec').attr('value', rate);
    });
    
    $('.usefullyes').on('click', function(){
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid="+comid,
            dataType: "json",
            url: '/comments/setyes',
            success: function(obj){
                $('#yesholder'+comid).html("("+obj.y_count+")");
            }
        }); 
    });
    
    $('.usefullno').on('click', function(){
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid="+comid,
            dataType: "json",
            url: '/comments/setno',
            success: function(obj){
                $('#noholder'+comid).html("("+obj.n_count+")");
            }
        }); 
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
            $('.loginAjax').trigger('click');
        }
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
    function bindgoNotifMe(){
        $('.goNotifMe').bind('click', function(){
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
            });
            return false;
        });
    }
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


      $('.showCallbackBottom').on('click', function(){
        
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/shop/shop/callbackBottom',
            success: function(msg){
                showResponse(msg);
                bindCallbackForm1();
                $.fancybox.hideActivity();
            }
        });
        return false;
    })
    
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



  
    
    $("#cartForm").validate();
    
    $('.met_del:checked').trigger('click');
    
    $("input.met_del").click(function(){
        recount();
    });
    
    $('.met_del:checked').each(function() {
        recount();
    });

    function recount(){
        $.fancybox.showActivity();
        $("#cartForm").find('input[name=makeOrder]').val(0);
        $.ajax({
            type: 'post',
            data: $("#cartForm").serialize() + '&recount=1',
            url: '/shop/cart',
            success: function(msg){
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if($('.plus_minus button').hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);                        
                else
                    showResponse(msg);
                $("#cartForm").find('input[name=makeOrder]').val(1);
                $.fancybox.hideActivity();
            }
        });
    }
      
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
    
    function bindGoBuy()
    {
        $('.buy .goBuy').bind('click',function(){
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
    
           function bindCallbackForm1(){
        $('.order_call form').bind('submit',function(){
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/shop/callbackBottom',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    showResponse(msg);
                    bindCallbackForm1();
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
    $('option.selectVar').on('click', function(){
        $.fancybox.showActivity();
        var vid = $(this).attr('value');
        var pid = $(this).attr('data-pid');
        var img = $(this).attr('data-img');
        var pr = $(this).attr('data-pr');
        var spr = $(this).attr('data-spr');
        var vnumber = $(this).attr('data-vnumber');
        var vname = $(this).attr('data-vname');
        var cs = $(this).attr('data-cs');
        var st = $(this).attr('data-st');
        var pp = $(this).attr('data-pp');
        $('#mim'+pid).addClass('smallpimagev');
        $('#vim'+pid).removeClass().attr('src', '/uploads/shop/'+img).attr('alt', vname);
        $('#code'+pid).html('Код '+vnumber);
        $('#pricem'+pid).html(pr);
        $('#prices'+pid).html(spr+' '+cs);
        $('#buy'+pid).attr('data-varid', vid);
        $('#buy'+pid).attr('data-prodid', pid);
        $.ajax({
            type: "post",
            data: "pid="+pid+"&vid="+vid+"&stock="+st+"&pp="+pp,
            dataType: "json",
            url: '/shop/category/getStyle',
            success: function(obj){
                $('#p'+pid).removeClass().addClass(obj.stclass+' buttons');
                $('#buy'+pid).removeClass().addClass(obj.stidentif).html(obj.stmsg).attr('href', obj.stlink).unbind('click');
                if (obj.stidentif == "goNotifMe") bindgoNotifMe();
                if (obj.stidentif == "goBuy") bindGoBuy();
                $.fancybox.hideActivity();
            }
        })
        return false;
    });
    $('.giftcertcheck').on('click', function(){
        recount();
    });

});