jQuery(function($) {
    try {
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
            'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    } catch (err) {
    }
});
var WishListFront = {
    btnRemoveItem: '.btnRemoveItem',
    frameWL: '[data-rel="list-item"]',
    deleteImage: function(el) {
        el.parent().remove();
        var img = $('#wishlistphoto img');
        img.attr('src', img.data('src'));
    },
    changeDataWishlist: function(el) {
        $('[data-wishlist-name]').each(function() {
            var $this = $(this);
            $this.html(el.closest('form').find('[name=' + $this.data('wishlistName') + ']').val());
        });
    },
    createWishList: function(el, elS, data) {
        if (data) {
            if (data.answer == 'success') {
                location.reload();
            }
        }
    },
    validateWishPopup: function($this, elSetSource) {
        function removeErr() {
            name.next(genObj.msgF).remove();
            $(document).trigger({
                'type': 'imageapi.pastemsg',
                el: drop
            });
            drop.find('[type="submit"]').parent().removeClass('active');
            name.focus();
        }
        var name = $('[name="wishListName"]:last'),
        drop = name.closest('[data-elrun]');

        if (name.val() == "" && drop.find('[data-link]').is(':checked')) {
            removeErr();
            name.after(message.error(text.error.enterName));
            $(document).trigger('hideActivity');
            $(document).trigger({
                'type': 'imageapi.pastemsg',
                el: drop
            });
            name.unbind('keypress').keypress(function() {
                removeErr();
            });
            $('[data-link]').unbind('change').change(function() {
                removeErr();
            });
            name.focus();
            return false;
        }
        else {
            removeErr();
            name.unbind('keypress');
            return true;
        }
    },
    reload: function(el, elS, data) {
        if (data) {
            if (data.answer == 'success') {
                location.reload();
            }
        }
    },
    addToWL: function(el, elS, data) {
        if (data) {
            if (data.answer == 'success') {
                wishList.add(el.data('id'));
                global.processWish();
                global.wishListCount();
            }
        }
    },
    removeItem: function(el, elS, data) {
        if (data) {
            if (data.answer == 'success') {
                var li = el.closest(genObj.parentBtnBuy),
                id = el.data('id');
                li.remove();
                wishList.rm(id);
                global.processWish();
                global.wishListCount();
            }
        }
    },
    removeWL: function(el, elS, data) {
        if (data) {
            if (data.answer == 'success') {
                var frame = el.closest(WishListFront.frameWL),
                li = frame.find(genObj.parentBtnBuy);
                li.each(function() {
                    wishList.rm($(this).find(WishListFront.btnRemoveItem).data('id'));
                });
                frame.remove();
                global.processWish();
                global.wishListCount();
            }
        }
    }
};
var wishList = {
    add: function(id) {
        var items = wishList.all(),
        key = id.toString();
        if (items.indexOf(key) === -1) {
            items.push(key);
            localStorage.setItem('wishList', JSON.stringify(items));
        }
    },
    rm: function(id) {
        var items = wishList.all(),
        key = id.toString();
        if (items.indexOf(key) != -1) {
            items = _.without(items, key);
            localStorage.setItem('wishList', JSON.stringify(items));
        }
    },
    all: function() {
        try {
            return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : []
        } catch (err) {
            return [];
        }
    },
    sync: function() {
        $.post('/wishlist/wishlistApi/sync', function(data) {
            localStorage.setItem('wishList', data);
            $(document).trigger({
                'type': 'wish_list_sync',
                dataObj: data
            });
            returnMsg("=== WishList sync. call wish_list_sync ===");
        })
    }
};

$(document).on('scriptDefer', function() {
    var wishPhoto = $('#wishlistphoto');
    $('.btn-edit-photo-wishlist input[type="file"]').change(function(e) {
        var file = this.files[0],
        img = document.createElement("img"),
        reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        };
        reader.readAsDataURL(file);
        wishPhoto.html($(img));
        $(img).load(function() {
            if ($(this).actual('width') > wishPhoto.data('widht') || $(this).actual('height') > wishPhoto.data('height')) {
                $('[data-drop="#notification"].trigger').data({
                    'timeclosemodal': 3000, 
                    datas: {
                        'answer': true,
                        'data': text.error.fewsize(wishPhoto.data('width') + '&times' + wishPhoto.data('height'))
                    }
                }).drop('open').removeData('timeclosemodal');
                wishPhoto.empty();
                $(this).val('');
                $('[data-wishlist="do_upload"]').attr('disabled', 'disabled').parent().addClass('disabled');
            }
            else {
                $('[data-wishlist="do_upload"]').removeAttr('disabled').parent().removeClass('disabled');
            }
        });
    });
    $('body').on('click.inWish', genObj.inWishlist, function() {
        document.location.href = locale + '/wishlist';
    });
    if (!isLogin) {
        $(genObj.toWishlist).data('datas', {
            'answer': true,
            'data': text.error.notLogin
        });
    }
    else {
        $(genObj.toWishlist).data({
            'always': true,
            'datas': {
                "ignoreWrap": true
            }
        });
    }
    if ($.exists("#datepicker"))
        try {
            $("#datepicker").datepicker({
                "dateFormat": "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                yearRange: "1930:2030"
            });
        } catch (err) {
        }
});