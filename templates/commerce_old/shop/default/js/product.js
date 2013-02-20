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

/**
 * Event on change product variant.
 * For more details see app/modules/shop/product.php::getJsCode()
 * @param variant Product variant id
 */
function display_variant_price(variant)
{
    selected_text = $('select[name="variantId"]').find("option:selected").text();
    document.getElementById('price').innerHTML = vPrices[variant] + currencySymbol;
    if (document.getElementById('notifyProductVariantName') != null){
        document.getElementById('notifyProductVariantName').innerHTML = selected_text;
    }

    if (vStocks[variant] < 1) {
        $('#send-request').css('display', 'block');
        $('#stock').html('Нет на складе');
        $('#stock').css('color', '#c0c0c0');
    } else{
        $('#send-request').css('display', 'none');
        $('#stock').html('Есть на складе');
        $('#stock').css('color', '');
    }

    if (vMImages[variant] != ''){
        $('#prImage img').attr("src", imagesPath + vMImages[variant]);
    }

    if (document.getElementById('orig_price') != null){
        document.getElementById('orig_price').innerHTML = vOldPrices[variant] + currencySymbol;
    }
    if (document.getElementById('economy') != null){
        document.getElementById('economy').innerHTML = vEconomy[variant];
    }
}

/**
 * Add product and its vatiant to cart
 */
function ajaxAddToCart(url, successUrl)
{
    $.ajax({
        type: "POST",
        data: $("#productForm").serialize(),
        url: url,
        success: function(){$("#mycart").load(successUrl)}
    });

    $("#cartNotify").css('display', 'block');
    setTimeout(function() {  $("#cartNotify").css('display', 'none') }, 2000);
}

/**
 * Add to user wishlist
 */
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

function ajaxAddKitToCart(kitId, url, successUrl)
{
	$.ajax({
        type: "POST",
        data: "kitId=" + kitId,
        url: url,
        success: function(){$("#mycart").load(successUrl)}
    });
}