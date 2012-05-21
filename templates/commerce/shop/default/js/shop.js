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
                if ($this.parent('div').hasClass('button_big_green'))
                {
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
                $this
                .attr('href', '/shop/cart')
                .unbind('click');
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
            'onClosed'		: function() {
                $.fancybox.close();
            }
        }
        );
        return false;
    })
    /*   End of Event   */

    $('.lineForm input[type=hidden]').on('change', function(){
        $(this).parents('form').submit();
    })

    $('.check_form input').on('change', ajaxRecount);
    function ajaxRecount(event) {
        var sidebarAjax = $('#sidebar-ajax');
        var $this = $(this);
        var filterResponse = '';
        $this.closest('form').ajaxSubmit({
            success: function(responseText, statusText, xhr, $form){
                filterResponse = $.parseJSON(responseText);
                for (x in filterResponse.brands)
                {
                    var brand = filterResponse.brands[x];
                    var selector = $('#brand_' + brand.id);
                    selector.parent().children().eq(2).text('(' + brand.count + ')');
                    //                    if (brand.check == 'false') {
                    //                        var checked = false;
                    //                    } else if (brand.check == 'true'){
                    //                        var checked = true;
                    //                    }
                    if (brand.disabled == 'false') {
                        selector.removeClass('not_disabled');
                    } else if (brand.disabled == 'true'){
                        selector.addClass('not_disabled');
                    }
                //selector.attr('checked', checked);
                //selector.attr('disabled', disabled);
                }

                for (x in filterResponse.properties)
                {
                    var property = filterResponse.properties[x];
                    var selector = $('#prop_' + property.id);
                    selector.parent().children().eq(2).text('(' + property.count + ')');
                    //                    if (property.check == 'false') {
                    //                        var checked = false;
                    //                    } else if (property.check == 'true'){
                    //                        var checked = true;
                    //                    }
                    if (property.disabled == 'false') {
                        selector.removeClass('not_disabled');
                    } else if (property.disabled == 'true'){
                        selector.addClass('not_disabled');
                    }
                //selector.attr('checked', checked);
                //selector.attr('disabled', disabled);
                }
                //sidebarAjax.html(responseText);
                //$('#minCost').val('900');
                var value1=jQuery(".price_block input#minCost").val();
                var value2=jQuery(".price_block input#maxCost").val();
                if(parseInt(value1) > parseInt(value2)){
                    value1 = value2;
                    jQuery(".price_block input#minCost").val(value1);
                }
                jQuery(".price_block #slider").slider("values",0,value1);	
                $this.parent().parent().parent().children('.check_form').find('div').hide();

                //$this.parent().removeClass('active');
                if ($this.parent().attr('class') == 'active')
                {
                    $this.parent().removeClass('active');
                }
                else
                {
                    $this.parent().addClass('active');
                }



                left=$this.parent().width();

                if ($this.is('input') && $this.attr('id') != 'minCost' && $this.attr('id') != 'maxCost') {
                    var divTotalCount = $this.parent().find('div');
                    if(!$.exists2(divTotalCount)){
                        win=$this.parent().append("<div class='f apply'><div><a id='sub_form' href='#'>Применить</a></div><div class='f_ing'>Найдено " + filterResponse.totalCount + "<i></i></div></div>");
                        $this.parent().find('div').show();
                    }
                    else{
                        divTotalCount.remove();
                        win=$this.parent().append("<div class='f apply'><div><a id='sub_form' href='#'>Применить</a></div><div class='f_ing'>Найдено " + filterResponse.totalCount + "<i></i></div></div>");
                        $this.parent().find('div').show();
                    }
                    win.find('>div').css({
                        'left':left+5,
                        'top':'-5px'
                    });
                    win.find('i').click(function(){
                        $(this).parent().parent().hide(1);
                        return false;
                    });
                } else {
                    console.log('1234');
                    $this = $('#maxCost');
                    var divTotalCount = $this.parent().find('div');
                    if(!$.exists2(divTotalCount)){
                        win=$this.parent().append("<div class='f apply'><div><a id='sub_form' href='#'>Применить</a></div><div class='f_ing'>Найдено " + filterResponse.totalCount + "<i></i></div></div>");
                        $this.parent().find('div').show();
                    }
                    else{
                        divTotalCount.remove();
                        win=$this.parent().append("<div class='f apply'><div><a id='sub_form' href='#'>Применить</a></div><div class='f_ing'>Найдено " + filterResponse.totalCount + "<i></i></div></div>");
                        $this.parent().find('div').show();
                    }
                    win.find('>div').css({
                        'left':left+5,
                        'top':'-5px'
                    });
                    win.find('i').click(function(){
                        $(this).parent().parent().hide(1);
                        return false;
                    });
                }
            }
        });
    }


});