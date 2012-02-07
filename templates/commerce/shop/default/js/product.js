$(function(){
    // Init light box
    $('.lightbox').lightbox();

    // Init star rating
    $('.hover-star').rating({
        callback: function(value, link) {
            $.ajax({
                type: "POST",
                data: "pid="+currentProductId+"&val=" + value,
                url:'/shop/ajax/rate'
            });

            $('.hover-star').rating('readOnly', true);
        }
    });
});

function ajaxAddToCart()
{
    $.ajax({
        type: "POST",
        data: $("#productForm").serialize(),
        url: "/shop/cart/add",
        success: function(){$("#mycart").load('/shop/ajax/getCartDataHtml')}
    });

    $("#cartNotify").css('display', 'block');
    setTimeout(function() {  $("#cartNotify").css('display', 'none') }, 2000);
}

function ajaxAddToWishList()
{
    $.ajax({
        type: "POST",
        data: $("#productForm").serialize(),
        url: "/shop/wish_list/add",
        success: function(){$("#mywishlist").load('/shop/ajax/getWishListDataHtml')}
    });

    $("#wishListNotify").css('display', 'block');
    setTimeout(function() {  $("#wishListNotify").css('display', 'none') }, 2000);
}