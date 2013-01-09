$(document).ready(function(){
    
    $('.colorPick a').click(function(){
        $('.colorPick').removeClass('colorActive');
        $('#variantId').val($(this).data('varid'));
        $(this).parent('div').addClass('colorActive');
        return false;
    })



    $('.l_descr_good a[rel="thumbs_noprice"]').fancybox({
        titlePosition : 'inside',
		titleFormat : formatTitleNoPrice
		
    });
	
    $('.l_descr_good a[rel="thumbs"]').fancybox({
        titlePosition : 'inside',
        titleFormat : formatTitle
    });	

    //Cообщить о появлении
    $(".report").fancybox({
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
                    $('.c_descr_good a').addClass('alreadyIn').attr('href','http://www.sportek.net/shop/cart').text('Уже в корзине');
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
        setTimeout(function () {$('#cart_popup').delay('4000').submit();
            
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
                        $('#fourth').append('<a rel="group2" title="" href="http://www.sportek.net/uploads/shop/'+val+'"><img height="100" src="http://www.sportek.net/uploads/shop/'+val+'"></a>');});
                    $('a[rel="group2"]').fancybox({titlePosition : 'inside',titleFormat : formatTitle});                    
                },
                complete: function(){$('#fourth').addClass('nobackgr');}
            });
        }
        return false;
    }).filter(':first').click();

    $('#commentForm').validate();

    $('.r_descr_good .js').fancybox({
        'width' : '350px',
        'height' : 50
    });

});
function formatTitleNoPrice(title, currentArray, currentIndex, currentOpts) {
    return '<div class="fancy_info"><div class="fancy_title">'+title+'&nbsp'+$('#notifyProductVariantName').text()+'</div><div class="fancy_price">'+parseInt($('.c_descr_good > span').text())+' <span>'+$('.c_descr_good span span').text()+'</span></div></div>';

}
function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return '<div class="fancy_info"><div class="fancy_title">'+title+'&nbsp'+$('#notifyProductVariantName').text()+'</div><div class="fancy_price">'+parseInt($('.c_descr_good > span').text())+' <span>'+$('.c_descr_good span span').text()+'</span></div><div class="button"><a href="#">Купить</a></div></div>';

}