$(document).ready(function(){
    $('.withProductType').click(function(){
        $('.prodTypeDescWrap').toggle();
    })
    $('.prodTypeDescWrap').click(function(){
        $(this).hide();
    });
    
    $('.colorPick a.color_vars').click(function(){
        var id = $(this).attr('data-varid');
        var vSImg = '/uploads/shop/'+currentProdId+'_vS'+id+'.jpg';
        var vMImg = '/uploads/shop/'+currentProdId+'_vM'+id+'.jpg';        
        $('.l_descr_good a').eq(0).attr('href', vMImg).find('img').attr('src', vSImg);
        $.ajax({
            type:'post',
            url:'/shop/ajax/getProductVariantPrice/'+id,
            success: function(data){
                $(".c_descr_good #price_aj").html(data);
            }
            
        })
        $.ajax({
            type:'post',
            url:'/shop/ajax/getInCart/'+id,
            success: function(data){
                if (data == 'yes')
                {
                    $('#in_cart').attr('class', 'alreadyIn');
                    $('#in_cart').attr('href', '/shop/cart');
                    $('#in_cart').text('Уже в корзине');
                }
                else
                {
                    $('#in_cart').attr('class', '');
                    $('#in_cart').attr('href', '#');
                    $('#in_cart').text('Купить');
                }
            }
            
        })
        $.ajax({
            type:'post',
            url:'/shop/ajax/getName/'+id,
            success: function(data){
                $('#notifyProductVariantName').text(data);
            }
            
        })
        $('.colorPick').removeClass('colorActive');
        $('#variantId').val($(this).data('varid'));
        $(this).parent('div').addClass('colorActive');
        return false;
    })
    $('.colorPick a.disabl').click(function(){
        return false;
    });


    $('.l_descr_good a[rel="thumbs"]').fancybox({
        titlePosition : 'inside',
        titleFormat : formatTitle
    });

    //Cообщить о появлении
    $(".report").click(function(){
        $('#notifyProductVariantName').text($(this).data('proname'));
        $('#variantIds').val($(this).data('varid'));
        $('#fproductId').val($(this).data('prodid'));
    }).fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false
    });

    $("#productForm select[name='variantId']").change(function(){
        $("#report form").find('input[name="variantId"]').val($(this).find('option:selected').val());
    });
    $("#report form").find('input[name="variantId"]').val($('#productForm').find('input[name="variantId"]').val());

    $("#report form").validate({
        submitHandler:  function() {

            $.fancybox.showActivity();

            $.ajax({
                type	: "POST",
                url	: "/shop/cart/sendNotifyingRequest",
                data	: $('#report form').serialize(),
                success: function(data) {
                    $.fancybox(data);
                }
            });

            return false;
        }
    });

    //Добвление в корзину
    $('.c_descr_good a, .fancy_info .button a').live('click',function(){
        if ($(this).attr('href').length == 1)
        {
            $.fancybox.showActivity();
            $.ajax({
                type: "POST",
                data: $(".good_desc form").serialize(),
                url: "/shop/cart/add",
                success: function(){
                    $('.c_descr_good a').addClass('alreadyIn').attr('href','/shop/cart').text('Уже в корзине');
                    $(".cart").load('/shop/ajax/getCartDataHtml');
                    $.fancybox({
                        'href': '/shop/cart'
                    });
                }
            });
            return false;
        }
    });
    
    //Добвление в корзину
    $('.kitButton').live('click',function(){
        if ($(this).attr('href').length == 1)
        {
            $.fancybox.showActivity();
            $.ajax({
                type: "POST",
                data: {
                    kitId : $(this).data('kitid')
                    },
                url: "/shop/cart/add/ShopKit",
                success: function(){                    
                    $(".cart").load('/shop/ajax/getCartDataHtml');
                    $.fancybox({
                        'href': '/shop/cart'
                    });
                }
            });
            return false;
        }
    });

    $('#cart_popup #count').live('keypress',function(){
        setTimeout(function () {
            $('#cart_popup').delay('4000').submit();
            
        }, 1000);
        
    })

    $('#cart_popup').live('submit',function(){

        $.ajax({
            type	: "POST",
            cache	: false,
            url		: $(this).attr('action'),
            data	: $(this).serialize(),
            success: function() {
                $(".cart").load('/shop/ajax/getCartDataHtml');
                $.fancybox({
                    'href': '/shop/cart'
                });
            }
        });
        return false;
    });

    $('#cart_popup .first_child a').live('click',function(){
        console.log($('#cart_popup .first_child a').length);
        $.ajax({
            type	: "POST",
            cache	: false,
            url		: $(this).attr('href'),
            data	: $(this).serializeArray(),
            success: function() {
                if(window.location.pathname == '/shop/cart' && $('#cart_popup .first_child a').length == 1)
                {
                    document.location.href = '/';
                }
                $(".cart").load('/shop/ajax/getCartDataHtml');
                $.fancybox({
                    'href': '/shop/cart'
                });
            }
        });
        return false;
    });

    $('.goods_left > ul > li > span').click(function(){
        $(this).next('ul').slideToggle();
        $(this).toggleClass('expanded').find('span').toggleClass('notjs');
    });

    var tabContainers = $('div.tabs > div');
    tabContainers.hide().filter(':first').show();

    $('div.tabs ul.tabNavigation a').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).show();
        $('div.tabs ul.tabNavigation a').removeClass('selected');
        $(this).addClass('selected').blur();        
        if($(this).hasClass('vectMeProdPhoto') && $('#fourth a').length == 0)
        {
            $.ajax({
                type: "POST",
                url: "",
                dataType: "json",
                data: "is_ajax_request=true",
                success: function(msg){
                    $.each(msg, function(i, val){
                        $('#fourth').append('<a rel="group2" title="" href="/uploads/shop/'+val+'"><img height="100" src="/uploads/shop/'+val+'"></a>');
                    });
                    $('a[rel="group2"]').fancybox({
                        titlePosition : 'inside',
                        titleFormat : formatTitle
                    });                    
                },
                complete: function(){
                    $('#fourth').addClass('nobackgr');
                }
            });
        }
        return false;
    }).filter(':first').click();
    
    $('.filter dl').each(function(){
        $(this).find('label').each(function(){
            if ($(this).width() > 98) $(this).parent().addClass('one_column');
        })
    })
    $('.filter label input').change(function(){
        if ($(this).is(':checked')) $(this).parent().addClass('active');
        else $(this).parent().removeClass('active');
    })
    $('.pun_fil').click(function(){
        chk_filter = $(this).attr('data-name');
        $('input.'+chk_filter).attr('checked',false).parents('form').submit();
        return false;
    })
    $('.delete_price').click(function(){
        $('input[name=rp]').val($('input[name=rp]').attr('data-default'));
        $('input[name=lp]').val($('input[name=lp]').attr('data-default'));
        $(this).parents('form').submit();
        return false;
    })

    $('#commentForm').validate({
        submitHandler: function(){
            $.fancybox.showActivity();
            $.ajax({
                type: "POST",
                data: $('#commentForm').serialize(),
                //  url: '/',
                success: function(data){
                    $("#commentForm").html('<br />Спасибо за Ваш комментарий. Он появится после модерации.');
                    $.fancybox.hideActivity();
                }
            });
                
            return false;
        }     
    });

    $('.r_descr_good .js').fancybox({
        'width' : 500,
        'height' : 50
    });
       
    $("#variantId").change(function(){
        var id = $(this).val();
        var vSImg = '/uploads/shop/'+currentProdId+'_vS'+id+'.jpg';
        var vMImg = '/uploads/shop/'+currentProdId+'_vM'+id+'.jpg';
        $('.l_descr_good a:first-child').attr('href', vMImg).find('img').attr('src', vSImg);
        $.ajax({
            type:'post',
            url:'/shop/ajax/getProductVariantPrice/'+id,
            success: function(data){
                $(".c_descr_good #price_aj").html(data);
            }
            
        })
        $.ajax({
            type:'post',
            url:'/shop/ajax/getInCart/'+id,
            success: function(data){
                if (data == 'yes')
                {
                    $('#in_cart').attr('class', 'alreadyIn');
                    $('#in_cart').attr('href', '/shop/cart');
                    $('#in_cart').text('Уже в корзине');
                }
                else
                {
                    $('#in_cart').attr('class', '');
                    $('#in_cart').attr('href', '#');
                    $('#in_cart').text('Купить');
                }
            }
            
        })
        $.ajax({
            type:'post',
            url:'/shop/ajax/getName/'+id,
            success: function(data){
                $('#notifyProductVariantName').text(data);
            }
            
        })        
    })



});

function formatTitle(title, currentArray, currentIndex, currentOpts) {
// return '<div class="fancy_info"><div class="fancy_title">'+title+'&nbsp'+$('#notifyProductVariantName').text()+'</div><div class="fancy_price">'+parseInt($('.c_descr_good > span').text())+' <span>'+$('.c_descr_good span span').text()+'</span></div><div class="button"><a href="#">Купить</a></div></div>';

}