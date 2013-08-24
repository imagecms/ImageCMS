var wishList = {};
wishList = {
    itemWL: '.item-WL',
    btnBuy: '.btnBuyWishList',
    countProdsWL: '.countProdsWL',
    genPriceProdsWL: '.genPriceProdsWL',
    frameWL: '[data-rel="list-item"]',
    curCount: 0,
    cAddPrWL: 0,
    count: inServerWishList
}
function wishListCount() {
    var count = wishList.count;
    if (count > 0)
        $(genObj.tinyWishList).show()
    else
        $(genObj.tinyWishList).hide()
    $(genObj.countTinyWishList).each(function() {
        $(this).html(count);
    })
    wishList.count = count;
    $(document).trigger({'type': 'change_count_wl'});
}
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
function addToWL(el, data) {
    if (data.answer == 'success') {
        var btnWish = wishList.curEl.closest(genObj.btnWish),
                id = btnWish.data('id'),
                varid = btnWish.data('varid');
        $(genObj.btnWish + '[data-id="' + id + '"][data-varid="' + varid + '"]').each(function() {
            $(this).closest(genObj.btnWish).find('.' + genObj.toWishlist).hide().end().find('.' + genObj.inWishlist).show()
            wishList.curEl = '';
            wishList.count = wishList.count + 1;
            wishListCount();
        })
    }
}
function removeItem(el, data) {
    if (data.answer == 'success') {
        el.closest(genObj.parentBtnBuy).hide();
        $(this).remove();
        processWish($(this).find(genObj.btnBuy).data('price'));
        wishList.count = wishList.count - 1;
        wishListCount();
    }
}
function removeWL(el, data) {
    if (data.answer == 'success') {
        var frame = el.closest(wishList.frameWL),
                WlsItems = frame.find(wishList.itemWL),
                cWlsItems = WlsItems.length;

        frame.hide();
        $(this).remove();
        wishList.count = wishList.count - cWlsItems;
        wishListCount();
    }
}
function changeBtnBuyWL(btnBuy, cond) {
    var textEL = btnBuy.find(genObj.textEl);
    if (cond) {
        btnBuy.parent().removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss);
        textEL.text(textEL.data('cart'));
    }
    else {
        btnBuy.parent().removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss);
        textEL.text(textEL.data('buy'));
    }
}
function processWish(price) {
    $(wishList.frameWL).each(function() {
        var $this = $(this),
                btnBuyL = $this.find(genObj.btnBuy).length,
                btnCartL = $this.find('.' + genObj.btnCartCss + ' ' + genObj.btnBuy).length,
                btnBuy = $this.find(wishList.btnBuy),
                genPrice = $this.find(wishList.genPriceProdsWL);

        $this.find(wishList.countProdsWL).text(btnBuyL);
        if (price)
            genPrice.text(genPrice.text() - price);

        if (btnBuyL == btnCartL) {
            changeBtnBuyWL(btnBuy, true);
        }
        else {
            changeBtnBuyWL(btnBuy, false);
        }
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
    processWish();
    $(wishList.btnBuy).click(function() {
        var $this = $(this),
                btns = $this.closest(wishList.frameWL).find('.' + genObj.btnBuyCss + ' ' + genObj.btnBuy);
        if ($.existsN(btns)) {
            $.fancybox.showActivity();
            wishList.curCount = btns.length;
            wishList.curElBuy = $this;
            btns.each(function() {
                Shop.Cart.add(Shop.composeCartItem($(this)), this, false);
            })
        }
        else {
            togglePopupCart($this)
        }
    })
    $(document).on('after_add_to_cart', function(e) {
        wishList.cAddPrWL++;
        if (wishList.cAddPrWL == wishList.curCount) {
            wishList.cAddPrWL = 0;
            wishList.curCount = 0;
            changeBtnBuyWL(wishList.curElBuy, true)
        }
    })
    $(document).on('processPageEnd', function(e) {
        processWish();
    })
    $('.' + genObj.inWishlist).live('click.inWish', function() {
        document.location.href = '/wishlist';
    });
    if (!isLogin)
        $('.' + genObj.toWishlist).unbind('click.drop').data({'always': true, 'data': {"ignoreWrap": true}}).on('click.toWish', function(e) {
            $.drop('showDrop')($('[data-drop="#notification"]'), e, '', true);
            $(document).trigger({type: 'drop.successJson', el: $('#notification'), datas: {'answer': true, 'data': text.error.notLogin}})
        })
    else
        $('.' + genObj.toWishlist).data({'always': true, 'data': {"ignoreWrap": true}}).on('click.toWish', function(e) {
            wishList.curEl = $(this);
        })
})