var wishList = {};
wishList = {
    itemWL: '.item-WL',
    btnBuy: '.btnBuyWishList',
    countProdsWL: '.countProdsWL',
    genPriceProdsWL: '.genPriceProdsWL',
    frameWL: '[data-rel="list-item"]',
    curCount: 0,
    cAddPrWL: 0,
    items: [],
    all: function() {
        return JSON.parse(localStorage.getItem('wishList')) ? JSON.parse(localStorage.getItem('wishList')) : [];
    },
    count: function() {
        return JSON.parse(localStorage.getItem('wishList')) ? JSON.parse(localStorage.getItem('wishList')).length : inServerWishList;
    },
    add: function(id, varid) {
        wishList.items = wishList.all();
        var key = id + '_' + varid;
        if (wishList.items.indexOf(key) === -1) {
            wishList.items.push(key);
            localStorage.setItem('wishList', JSON.stringify(wishList.items));
        }
    },
    rm: function(id, varid) {
        wishList.items = wishList.all();
        var key = id + '_' + varid;
        if (wishList.items.indexOf(key) != -1) {
            wishList.items = _.without(wishList.items, key);
            localStorage.setItem('wishList', JSON.stringify(wishList.items));
        }
    }

};
function deleteImage(el) {
    el.parent().remove();
    var img = $('#wishlistphoto img');
    img.attr('src', img.data('src'));
}
function changeDataWishlist(el) {
    $('[data-wishlist-name]').each(function() {
        var $this = $(this);
        $this.html(el.closest('form').find('[name=' + $this.data('wishlistName') + ']').val());
    });
}
function createWishList(el, data) {
    if (data.answer == 'success') {
        location.reload();
    }
}
function reload(el, data) {
    if (data.answer == 'success') {
        location.reload();
    }
}
function addToWL(el, data) {
    if (data.answer == 'success') {
        var btnWish = wishList.curEl.closest(genObj.btnWish),
                id = btnWish.parent().data('id'),
                varid = btnWish.parent().data('varid');
        wishList.add(id, varid);
        wishList.curEl = '';
        processWish();
        wishListCount();
    }
}
function removeItem(el, data) {
    if (data.answer == 'success') {
        var li = el.closest(genObj.parentBtnBuy),
                infoBut = li.find(genObj.infoBut),
                id = infoBut.data('id'),
                varid = infoBut.data('varid');
        li.hide().remove();
        processWishPage();
        wishList.rm(id, varid);
        processWish();
        wishListCount();
    }
}
function removeWL(el, data) {
    if (data.answer == 'success') {
        var frame = el.closest(wishList.frameWL),
                WlsItems = frame.find(wishList.itemWL),
                cWlsItems = WlsItems.length;
        var li = frame.find(genObj.parentBtnBuy);
        li.each(function() {
            var infoBut = $(this).find(genObj.infoBut),
                    id = infoBut.data('id'),
                    varid = infoBut.data('varid');
            wishList.rm(id, varid);
        });
        frame.hide().remove();
        processWish();
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
function processWishPage() {
    $(wishList.frameWL).each(function() {
        var $this = $(this),
                btnBuyLC = 0,
                tempC = 0,
                tempP = 0,
                genSum = 0,
                btnBuyI = $this.find(genObj.btnBuy);
        btnBuyI.each(function() {
            tempC = parseInt($(this).closest(genObj.parentBtnBuy).find(genObj.plusMinus).val());
            if (isNaN(tempC))
                return false;
            btnBuyLC += tempC;
            tempP = parseInt($(this).data('price'));
            genSum += tempP * tempC;
        });
        var btnBuyL = btnBuyI.length,
                btnCartL = $this.find('.' + genObj.btnCartCss + ' ' + genObj.btnBuy).length,
                btnBuy = $this.find(wishList.btnBuy),
                genPrice = $this.find(wishList.genPriceProdsWL);
        $this.find(wishList.countProdsWL).text(btnBuyLC);
        $this.find(genObj.plurProd).text(pluralStr(btnBuyLC, plurProd));
        genPrice.text(genSum);
        if (btnBuyL == btnCartL) {
            changeBtnBuyWL(btnBuy, true);
        }
        else {
            changeBtnBuyWL(btnBuy, false);
        }
    });
}
$(document).live('scriptDefer', function() {
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
    processWishPage();
    $(wishList.btnBuy).click(function() {
        var $this = $(this),
                btns = $this.closest(wishList.frameWL).find('.' + genObj.btnBuyCss + ' ' + genObj.btnBuy);
        if ($.existsN(btns)) {
            $.fancybox.showActivity();
            wishList.curCount = btns.length;
            wishList.curElBuy = $this;
            btns.each(function() {
                Shop.Cart.add(Shop.composeCartItem($(this)), this, false);
            });
        }
        else {
            togglePopupCart($this);
        }
    });
    $(document).on('after_add_to_cart', function(e) {
        wishList.cAddPrWL++;
        if (wishList.cAddPrWL == wishList.curCount) {
            wishList.cAddPrWL = 0;
            wishList.curCount = 0;
            changeBtnBuyWL(wishList.curElBuy, true);
        }
    });
    $(document).on('processPageEnd change_count_product', function(e) {
        processWishPage();
    });
    $('.' + genObj.inWishlist).live('click.inWish', function() {
        document.location.href = '/wishlist';
    });
    if (!isLogin) {
        $('.' + genObj.toWishlist).unbind('click.drop').data({'always': true, 'data': {"ignoreWrap": true}}).on('click.toWish', function(e) {
            $.drop('showDrop')($('[data-drop="#notification"]'), e, '', true);
            $(document).trigger({type: 'drop.successJson', el: $('#notification'), datas: {'answer': true, 'data': text.error.notLogin}});
        });
    }
    else {
        $('.' + genObj.toWishlist).data({'always': true, 'data': {"ignoreWrap": true}}).on('click.toWish', function(e) {
            wishList.curEl = $(this);
        });
    }
    if ($.exists("#datepicker"))
        try {
            $("#datepicker").datepicker({"dateFormat": "yy-mm-dd"});
        } catch (err) {
        }
});