$(document).ready(function() {

    if(parseInt($('.p_bot').css('height')) < 600)
    {var winHeight = $(window).height();
        winHeight = winHeight - 498;
        winHeight += "px"
        $('.p_bot').css('min-height', winHeight);};

    $('.h_contacts a, .auth_menu .js, .auth_links a').fancybox();

    var count = 0;
    var autocomplete = $( ".search .text_field input" ).autocomplete({
        source: "/shop/search",
        minLength: 2,
        select: function( event, ui ) {window.location.href = ui.item.url;return false;},
        open: function(event, ui){count = 0;return false;}}).data( "autocomplete" );

    autocomplete
    ._renderItem = function( ul, item ) {
        var currencySymbol = 'грн.';
        if (count++ == 4){
            $(".ui-autocomplete").append("<div class='ac_allresults'><a href='/shop/search?text="+item.term+"'>Показать все результаты</a></div>");
            console.log(count);}
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .prepend( "<div class=\"image\"><img src=\"/uploads/shop/" + item.image + "\" alt=\""+item.label+"\" border=\"0\"></div>"+"<a href=\"" + item.url + "\">" +item.label+"</a>"+"<div class=\"itrm_price\">" + item.price + " " +currencySymbol +"</div>" )
        .prependTo( ul );}

    $('.s_result_form select').change(function(){$('.s_result_form').submit();})
    
    $("#work").fancybox({type: 'ajax'});
    
    $("#form_call").validate({
            submitHandler: function(){
                $.fancybox.showActivity();
                $.ajax({
                    type: "POST",
                    data: $("#form_call").serialize(),
                    url: '/shop/call_to_me',
                    success: function(data){
                        $("#call_to_me").load('/shop/sucess_mes');
                        $.fancybox.hideActivity();
                    }
                });
                
                return false;
            }     
    })
    

});
