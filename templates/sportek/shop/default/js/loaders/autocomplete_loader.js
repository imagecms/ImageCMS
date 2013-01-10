//$(function() {
//    $( ".search .text_field input" ).autocomplete({
//        source: "/shop/search",
//        minLength: 2,
//        select: function( event, ui ) {
//            return false;
//        },
//        open: function(event, ui){
//            return false;
//        }
//    })
//    .data( "autocomplete" )._renderItem = function( ul, item ) {
//        var currencySymbol = 'грн.';
//        return $( "<li></li>" )
//        .data( "item.autocomplete", item )
//        .append( "<div class=\"image\"><img src=\"/uploads/shop/" + item.image + "\" alt=\""+item.label+"\" border=\"0\"></div>"+"<a href=\"" + item.url + "\">" +item.label+"</a>"+"<div class=\"itrm_price\">" + item.price + " " +currencySymbol +"</div>" )
//        .appendTo( ul );
//    };
//});