function deleteImage(el) {
    el.parent().remove();
    var img = $('#wishlistphoto img');
    img.attr('src', img.data('src'));
}
function changeDataWishlist(el) {
    $('[data-wishlist-name]').each(function() {
        var $this = $(this);
        $this.html(el.closest('form').find('[name=' + $this.data('wishlistName') + ']').val())
    })
}
function createWishList(el, data) {
    if (data.answer == 'success')
        location.reload();
}
function reload(el, data) {
    if (data.answer == 'success')
        location.reload();
}
$(document).ready(function() {
    $('.btn-edit-photo-wishlist input[type="file"]').change(function(e) {
        file = this.files[0],
                img = document.createElement("img"),
                reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        };
        reader.readAsDataURL(file);
        $('#wishlistphoto').html($(img));
        $('[data-wishlist="do_upload"]').removeAttr('disabled');
    });
    $('.btnBuyWishList').click(function() {
        $.fancybox.showActivity();
        $(this).closest('.drop-wishlist-items').find('.' + genObj.btnBuyCss + ' ' + genObj.btnBuy).each(function() {
            var cartItem = Shop.composeCartItem($(this));
            Shop.Cart.add(cartItem, this, false);
        })
    })

    $('.' + genObj.toWishlist).data({'always': true, 'data': {"ignoreWrap": true}}).live('click.toWish', function() {
        $.fancybox.showActivity();
        var id = $(this).data('prodid'),
                vid = $(this).data('varid'),
                price = $(this).data('price');
        Shop.WishList.add(id, vid, price, $(this));
    });
})