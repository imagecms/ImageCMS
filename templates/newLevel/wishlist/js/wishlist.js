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
function removeItem(el, data) {
    if (data.answer == 'success')
        el.closest(genObj.parentBtnBuy).fadeOut(function(){
            $(this).remove();
        })
}
$(document).ready(function() {
    $('.btn-edit-photo-wishlist input[type="file"]').change(function(e) {
        var file = this.files[0],
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
        var btns = $(this).closest('[data-rel="list-item"]').find('.' + genObj.btnBuyCss + ' ' + genObj.btnBuy);
        if ($.existsN(btns)) {
            $.fancybox.showActivity();
            btns.each(function() {
                Shop.Cart.add(Shop.composeCartItem($(this)), this, false);
            })
        }
        else{
            togglePopupCart($(this))
        }
    })

    $('.' + genObj.toWishlist).data({'always': true, 'data': {"ignoreWrap": true}}).live('click.toWish', function() {
        var id = $(this).data('prodid'),
                vid = $(this).data('varid'),
                price = $(this).data('price');
        Shop.WishList.add(id, vid, price, $(this));
    });
})