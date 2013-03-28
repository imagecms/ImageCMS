// Scripts for cart.tpl
$(document).ready(function(){
    $('.fb_close').live('click',function(){
        $.fancybox.close();
    })
    
    ///////////////// remove cart item overlay ///////////////////////
    $('.delete_overlay_prod').live("click", function(){
        var href = $(this).data('href');
        var undo = $(this).data('undo');
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: href,
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(){
                $('#bask_block').load('/shop/ajax/getCartDataHtml', function(){
                    if ($.exists('#fancybox-content') && !$.exists('.left_order')) {
                        $('#fancybox-content').load('/shop/cart', function(){
                            fancyresize();
                            $.fancybox.hideActivity();
                        });
                    }
                    if ($.exists('.left_order')) {
                        $('.left_order').load('/shop/ajax/getCartProducts', function(){
                            reloadDeliveryBlock();
                            fancyresize();
                            $.fancybox.hideActivity();
                        });
                    } 
                });
                ////////// undo button goBuy ///////////////////////
                if ($.exists('.'+undo)) {
                    $('.'+undo).parent().find('.goBuy').removeClass('d_n');
                    $('.'+undo).addClass('d_n').removeClass('d_i-b');
                }
                ////////////////////////////////////////////////////
            }
        });
    })
    ////////////////////////////////////////////////////////////////
    
    /////////////// overlay cart data //////////////////////////////
    $('.cart_pop_quant').live("keyup",function(){
        total_score_overlay();
    })
    
    $('#order_form .plus').live("click",function(){
        elem =  $(this).prev().find('input');
        total = parseInt(elem.val());
        total++;
        elem.val(total);
        total_score_overlay();
    })
    $('#order_form .minus').live("click",function(){
        elem =  $(this).next().find('input');
        total = parseInt(elem.val());
        if(!(total > 1)) { 
            total = 1;
            $('.minus').attr('disabled','disabled');
        }
        else total--;
        elem.val(total);
        total_score_overlay();
    })
    ////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////
    $('.goCart').live("click", function(){
        $.fancybox({
            'href': '/shop/cart',
            'padding' : 0,
            'margin' : 0,
            'overlayOpacity' : 0.5,
            'overlayColor' : '#060e01',
            'showNavArrows' : false,
            'onComplete' : function(){
                fancyresize();
            }
        });
        return false;
    })
    

    ////////// add to Cart //////////////////////////////////////////////
    $('.goBuy').live('click',function(){
        var elemType = $(this).data('type');
        var quant = 1;
        if (id_kit = $(this).data('kitid')){
            data = "price="+$(this).data('price')+"&kitId="+id_kit;
            url = '/shop/cart/add/ShopKit';
        }else{
            var id_var  = $(this).attr('data-varid');
            var id = $(this).attr('data-prodid');
            data = "quantity="+quant+"&productId="+id+"&variantId="+id_var;
            url = '/shop/cart/add';
        }
        //alert("кількість:"+quant+", продукт:"+id+", варіант:"+id_var);
        //return false;
        var $this = $(this);
        $.ajax({
            type: 'post',
            data: data,
            url: url,
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(){
                $('#bask_block').load('/shop/ajax/getCartDataHtml', function(){
                    $.fancybox({
                        'href': '/shop/cart',
                        'padding' : 0,
                        'margin' : 0,
                        'overlayOpacity' : 0.5,
                        'overlayColor' : '#060e01',
                        'scrolling' : 'no',
                        'showNavArrows' : false,
                        'onStart' : $.fancybox.hideActivity(),
                        'onComplete' : function(){
                            fancyresize();
                        }                        
                    });
                });
                if(elemType != "check"){
                    $('.goBuy[data-varid="'+id_var+'"]').addClass('d_n').removeClass('d_i-b').parent().find('.goCart').removeClass('d_n');
                }
                if (id_kit){
                    $('.goBuy[data-kitid="'+id_kit+'"]').addClass('d_n').removeClass('d_i-b').parent().find('.goCart').removeClass('d_n');
                }
            }
        });
        return false;
    });
    
    ////////// Add to compare //////////////////////////////////////////////
    $('.toCompare').live('click', function() {
        var productId = $(this).data('prodid');
        var $this = $(this);
        $.ajax({
            url: "/shop/compare/add/" + productId,
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function() {
                $("#compareBlock").load('/shop/ajax/getCompareDataHtml');
                $this.parent().find('.goCompare').removeClass('d_n');
                $this.addClass('d_n');
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    
    ////////// Add to wishlist ////////////////////////////////////////////
    $('.toWList').live('click', function() {
        var $this = $(this);
        var variantId = $(this).data('varid');
        var productId = $(this).data('prodid');
        
        $.ajax({
            type: "POST",
            data: 'productId = ' + productId + '&variantId = ' + variantId,
            url: "/shop/wish_list/add",
            beforeSend:function(){
                $.fancybox.showActivity();
            },
            success: function() {
                $("#wishlistBlock").load('/shop/ajax/getWishListDataHtml');
                $this.parent().find('.goWList').removeClass('d_n');
                $this.addClass('d_n');
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    
    //////////// certificate //////////////////////////////////////////////
    $('.giftCertCheck').live('click', function(){
        if ($('[name="giftcert"]').val() != '') total_score_overlay();
    })
})

function fancyresize(){
    var wndH = $(window).height()
    $(".items-complect").nStCheck({
        wrapper: $(".frame-label:has(.niceCheck)"),
        elCheckWrap: '.niceCheck'
    });
    if ($('#fancybox-wrap').height() > wndH){
        $('.frame-scroll-cleaner').css('height', wndH-150);
        $.fancybox.resize();
    }
}

function total_score_overlay(){
    if ($.exists('input[name="makeOrder"]')) {
        $('input[name="makeOrder"]').val(0);
    }
    $.ajax({
        type: "POST",
        data: $('#order_form').serialize()+'&recount=1',
        url: "/shop/cart",
        beforeSend:function(){
            $.fancybox.showActivity();
        },
        success: function(msg){
            $('#bask_block').load('/shop/ajax/getCartDataHtml', function(){
                if ($.exists('#fancybox-content') && !$.exists('.left_order')) {
                    $('#fancybox-content').html(msg);
                    /*
                    $('#fancybox-content').load('/shop/cart', function(){
                        fancyresize();
                        $.fancybox.hideActivity();
                    });
                    */
                }
                if ($.exists('.left_order')){
                    $('.left_order').html(msg);
                    /*
                    $('.left_order').load('/shop/ajax/getCartProducts', function(){
                        reloadDeliveryBlock();
                        $.fancybox.hideActivity();
                    });
                    */
                }
            });
            if ($.exists('input[name="makeOrder"]')) {
                $('input[name="makeOrder"]').val(1);
            }
            $.fancybox.hideActivity();
        }
    });
}

function setActiveDeliveryMethod(elem){
    $('input[name=deliveryMethodId]').removeAttr('checked');
    $(elem).attr("checked", true);
    setAllowablePaymentMethods( $(elem).val() );
}

function setAllowablePaymentMethods(id){
    $('.payMethods').addClass('d_n');
    $('.deliv_id_' + id).removeClass('d_n');
    $('.deliv_id_' + id + ' input[type="radio"]:eq(0)').attr("checked", "checked");//
    //$('.deliv_id_' + id + ':eq(0)').click();
    summaryOrderPrice(cs);
}

function reloadDeliveryBlock(){
    if ($.exists('.delivery_popup_container')){
        var $Del_id = $('input[name=deliveryMethodId][checked=checked]').val();
        $('.delivery_popup_container').load('/shop/ajax/getDeliveryData', function(){
            setActiveDeliveryMethod( $('#input_dMethod_' + $Del_id) );
            $('.niceRadio').nStRadio({
                after:function(input){
                    if( $.exists_nabir($(input).closest('.is_deliveries'))){
                        setAllowablePaymentMethods( $(input).val() );
                    }
                }
            });
        });
    }
}

function summaryOrderPrice(cs){
    if ($.exists('input[name="makeOrder"]')) {
        deliveriPrice = parseFloat( $('input[name=deliveryMethodId][checked=checked]').data('price') );
        if(deliveriPrice > 0){
            $('#deliveryPrice').text(deliveriPrice+' '+cs);
            sum = totalFullPrice + deliveriPrice;
        }else if(deliveriPrice < 0){
            $('#deliveryPrice').text('тариф перевозчика');
            sum = totalFullPrice;
        }else{
            $('#deliveryPrice').text('бесплатно');
            sum = totalFullPrice;
        }
        $('#fullPrice').html(sum);
        if(discType != "none"){
            $('.totalWithDiscount').removeClass('d_n').addClass('d_i-b').find('.text-discount').text(userDiscount+'%').end().find('.totalProductPrice').text(totalProductPrice).end().find('.totalFullPrice').text(totalFullPrice);
        }
    //console.log($('#fullPrice'));
    }
}