/*
     *imagecms shop plugins
     **/
if (!Array.indexOf) {
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0); i < this.length; i++) {
            if (this[i] == obj) {
                return i;
            }
        }
        return -1;
    }
}
var Shop = {
    //var Cart = new Object();
    currentItem: {},
    Cart: {
        totalPrice: 0,
        totalAddPrice: 0,
        totalCount: 0,
        totalPriceOrigin: 0,
        discount: 0,
        kitDiscount: 0,
        discountProduct: 0,
        popupCartSelector: 'script#cartPopupTemplate',
        shipping: 0,
        shipFreeFrom: 0,
        giftCertPrice: 0,
        gift: undefined,
        add: function(cartItem, show) {
            //trigger before_add_to_cart
            $(document).trigger({
                type: 'before_add_to_cart',
                cartItem: _.clone(cartItem)
            });
            //
            var data = {
                'quantity': cartItem.count,
                'productId': cartItem.id,
                'variantId': cartItem.vId
            };
            var url = siteUrl+'shop/cart_api/add';
            if (cartItem.kit) {
                data = {
                    'quantity': cartItem.count,
                    'kitId': cartItem.kitId
                };
                url += '/ShopKit';
            }
            
            $.get(url, data,
                function() {
                    try {
                        Shop.Cart._add(cartItem, show);
                    //save item to storage
                    } catch (e) {
                        return;
                    }
                });
            return;
        },
        _add: function(cartItem, show) {
            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
                currentItem.count += cartItem.count;
            else
                currentItem = cartItem;
            this.save(currentItem);
            ////trigger after_add_to_cart
            $(document).trigger({
                type: 'after_add_to_cart',
                cartItem: _.clone(cartItem),
                show: show
            });
            return this;
        },
        rm: function(cartItem) {
            if (cartItem.kitId)
                var key = 'ShopKit_' + cartItem.kitId;
            else
                var key = 'SProducts_' + cartItem.id + '_' + cartItem.vId;
            $.getJSON(siteUrl+'shop/cart_api/delete/' + key, function() {
                localStorage.removeItem('cartItem_' + cartItem.id + '_' + cartItem.vId);
                $(document).trigger({
                    type: 'cart_rm',
                    cartItem: cartItem
                });
            });
            return this;
        },
        chCount: function(cartItem, f) {
            Shop.Cart.currentItem = this.load(cartItem.storageId());
            if (Shop.Cart.currentItem) {
                if (Shop.Cart.currentItem.count != cartItem.count){
                    Shop.Cart.currentItem.count = cartItem.count;
                    Shop.currentCallbackFn = f;
                    if (cartItem.kit)
                        var postName = 'kits[ShopKit_' + Shop.Cart.currentItem.kitId + ']';
                    else
                        var postName = 'products[SProducts_' + cartItem.id + '_' + cartItem.vId + ']';
                    var postData = {
                        recount: 1
                    };
                    postData[postName] = cartItem.count;
                    $.post(siteUrl+'shop/cart_api/recount', postData, function(data) {
                        var dataObj = JSON.parse(data);
                        if (dataObj.hasOwnProperty('count'))
                            Shop.Cart.currentItem.count = dataObj.count;
                        Shop.Cart.save(Shop.Cart.currentItem);
                        (Shop.currentCallbackFn());
                        $(document).trigger({
                            type: 'count_changed',
                            cartItem: _.clone(cartItem)
                        });
                    });
                    return this.totalRecount();
                }
            }
        },
        clear: function() {
            $.getJSON(siteUrl+'shop/cart_api/clear',
                function() {
                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        localStorage.removeItem(items[i].storageId());
                    delete items;
                    $(document).trigger({
                        type: 'cart_clear'
                    });
                });
        },
        //work with storage
        load: function(key) {
            try {
                return new Shop.cartItem(JSON.parse(localStorage.getItem(key)));
            } catch (e) {
                return false;
            }
        },
        save: function(cartItem) {
            if (!cartItem.storageId().match(/undefined/)) {
                localStorage.setItem(cartItem.storageId(), JSON.stringify(cartItem));
                this.totalRecount();
            }
            return this;
        },
        getAllItems: function() {
            var pattern = /cartItem_*/;
            var items = [];
            for (var i = 0; i < localStorage.length; i++) {
                var key = localStorage.key(i);
                try {
                    if (key.match(pattern))
                        items.push(this.load(key));
                } catch (err) {
                }
            }
            return items;
        },
        length: function() {
            var pattern = /cartItem_*/;
            var length = 0;
            for (var i = 0; i < localStorage.length; i++) {
                try {
                    if (localStorage.key(i).match(pattern)){
                        var tempC = parseInt(JSON.parse(localStorage.getItem(localStorage.key(i))).count)
                        tempC = isNaN(tempC) ? 0 : tempC;
                        length += tempC;
                    }
                } catch (err) {
                    length += 0;
                }
            }
            return length;
        },
        totalRecount: function() {
            var items = this.getAllItems();
            this.totalPrice = 0;
            this.totalAddPrice = 0;
            this.totalCount = 0;
            this.totalPriceOrigin = 0;
            for (var i = 0; i < items.length; i++) {
                var item = items[i],
                itemC = item.count == '' ? 0 : item.count;
                if (item.origprice != '')
                    this.totalPriceOrigin += item.origprice * itemC;
                else
                    this.totalPriceOrigin += item.price * itemC;
                this.totalPrice += item.price * itemC;
                this.totalAddPrice += item.addprice * itemC;
                this.totalCount += parseInt(itemC);
            }
            return this;
        },
        getTotalPrice: function() {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPrice;
            else
                return this.totalPrice;
        },
        getTotalAddPrice: function() {
            if (this.totalAddPrice == 0)
                return this.totalRecount().totalAddPrice;
            else
                return this.totalAddPrice;
        },
        getTotalPriceOrigin: function() {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPriceOrigin;
            else
                return this.totalPriceOrigin;
        },
        getFinalAmount: function() {
            if (this.shipFreeFrom > 0)
                if (this.shipFreeFrom <= this.getTotalPriceOrigin())
                    this.shipping = 0;
            return (this.totalRecount().totalPriceOrigin + this.shipping - parseFloat(this.giftCertPrice)) >= 0 ? (this.totalRecount().totalPriceOrigin + this.shipping - parseFloat(this.giftCertPrice)) : 0;
        },
        renderPopupCart: function(selector) {
            if (typeof selector == 'undefined' || selector == '')
                selector = this.popupCartSelector;
            return _.template($(selector).html(), Shop.Cart);
        },
        sync: function() {
            $(document).trigger({
                type: 'before_sync_cart'
            });
            $.getJSON(siteUrl+'shop/cart_api/sync', function(data) {
                if (typeof(data) == 'object') {
                    var pattern = /cartItem_*/;
                    var items = Shop.Cart.getAllItems();
                    
                    for (var i = 0; i < items.length; i++) {
                        try {
                            if (localStorage.key(i).match(pattern))
                                localStorage.removeItem('cartItem_' + items[i]['id'] + '_' + items[i]['vId']);
                        }catch(err){}
                    }
                    delete items;
                    _.each(_.keys(data.data.items), function(key) {
                        localStorage.setItem(key, JSON.stringify(data.data.items[key]));
                    });
                    $(document).trigger({
                        type: 'sync_cart'
                    });
                }
                $(document).trigger({
                    type: 'end_sync_cart'
                });
                if (data == false)
                    Shop.Cart.clear();
            });
        }
    },
    cartItem: function(obj) {
        if (typeof obj == 'undefined' || obj == false)
            obj = {
                id: false,
                vId: false,
                name: false,
                count: false,
                kit: false,
                maxcount: 0,
                number: '',
                vname: false,
                url: false
            };
        return prototype = {
            id: obj.id ? obj.id : 0,
            vId: obj.vId ? obj.vId : 0,
            price: obj.price ? obj.price : 0,
            prices: obj.prices ? obj.prices : 0,
            addprice: obj.addprice ? obj.addprice : 0,
            addprices: obj.addprices ? obj.addprices : 0,
            origprice: obj.origprice ? obj.origprice : 0,
            origprices: obj.origprices ? obj.origprices : 0,
            name: obj.name ? obj.name : '',
            count: obj.count ? obj.count : 1,
            kit: obj.kit ? obj.kit : false,
            kitId: obj.kitId ? obj.kitId : 0,
            maxcount: obj.maxcount ? obj.maxcount : 0,
            number: obj.number ? obj.number : 0,
            vname: obj.vname ? obj.vname : '',
            url: obj.url ? obj.url : '',
            img: obj.img ? obj.img : '',
            prodstatus: obj.prodstatus ? obj.prodstatus : '',
            storageId: function() {
                return 'cartItem_' + this.id + '_' + this.vId;
            }
        };
    },
    composeCartItem: function($context) {
        var cartItem = new Shop.cartItem();
        cartItem.id = $context.data('prodid');
        cartItem.vId = $context.data('varid');
        cartItem.count = $context.attr('data-count');
        cartItem.price = $context.data('price');
        cartItem.prices = $context.data('prices');
        cartItem.addprice = $context.data('addprice');
        cartItem.addprices = $context.data('addprices');
        cartItem.origprice = $context.data('origprice')
        cartItem.origprices = $context.data('origprices')
        cartItem.name = $context.data('name');
        cartItem.kit = $context.data('kit');
        cartItem.kitId = $context.data('kitid');
        cartItem.maxcount = $context.data('maxcount');
        cartItem.number = $context.data('number');
        cartItem.vname = $context.data('vname');
        cartItem.url = $context.data('url');
        cartItem.img = $context.data('img');
        cartItem.prodstatus = $context.data('prodstatus');
        return cartItem;
    },
    CompareList: {
        items: [],
        all: function() {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add: function(key) {
            this.items = this.all();
            $(document).trigger({
                type: 'before_add_to_compare'
            });
            if (this.items.indexOf(key) === -1) {
                $.get(siteUrl+'shop/compare_api/add/' + key, function(data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items.push(key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_add',
                                dataObj: dataObj
                            });
                        }
                    } catch (e) {
                    }
                });
            }
        },
        rm: function(key, el) {
            this.items = JSON.parse(localStorage.getItem('compareList')) ? JSON.parse(localStorage.getItem('compareList')) : [];
            if (this.items.indexOf(key) !== -1) {
                
                this.items = _.without(this.items, key);
                this.items = this.all();
                $.get(siteUrl+'shop/compare_api/remove/' + key, function(data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items = _.without(Shop.CompareList.items, key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_rm',
                                dataObj: dataObj
                            });
                        }
                    } catch (e) {
                    }
                });
            }
            $(document).trigger({
                type: 'delete_compare',
                el: $(el)
            });
        },
        sync: function() {
            $.getJSON(siteUrl+'shop/compare_api/sync', function(data) {
                if (typeof(data) == 'object' || typeof(data) == 'Array') {
                    localStorage.setItem('compareList', JSON.parse(data));
                    $(document).trigger({
                        type: 'compare_list_sync'
                    });
                }
                else
                if (data === false) {
                    localStorage.removeItem('compareList');
                    $(document).trigger({
                        type: 'compare_list_sync'
                    });
                }
            });
        }
    }
};
if (typeof(wishList) != 'object')
    var wishList = {
        all: function() {
            try {
                return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : []
            } catch (err) {
                return [];
            }
        },
        sync: function() {
            $.get('/wishlist/wishlistApi/sync', function(data) {
                localStorage.setItem('wishList', data);
                $(document).trigger({
                    'type': 'wish_list_sync'
                });
            })
        }
    }
/**
     * AuthApi ajax client
     * Makes simple request to api controllers and get return data in json
     * 
     * @author Avgustus
     * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
     * 
     * Get JSON object with fields list:
     *      'status'    -   true/false - if the operation was successful,
     *      'msg'       -   info message about result,
     *      'refresh'   -   true/false - if true refreshes the page,
     *      'redirect'  -   url - redirects to needed url
     *    
     * List of api methods:
     *      Auth.php:
     *          '/auth/authapi/login',
     *          '/auth/authapi/logout',
     *          '/auth/authapi/register',
     *          '/auth/authapi/forgot_password',
     *          '/auth/authapi/reset_password',
     *          '/auth/authapi/change_password',
     *          '/auth/authapi/cancel_account',
     *          '/auth/authapi/banned',
     *          '/shop/ajax/getApiNotifyingRequest',
     *          '/shop/callbackApi'
     * 
     **/

var ImageCMSApi = {
    defSet: function() {
        return imageCmsApiDefaults;
    },
    returnMsg: function(msg) {
        if (window.console) {
            console.log(msg);
        }
    },
    formAction: function(url, selector, obj) {
        //collect data from form
        var DS = $.extend($.extend({}, this.defSet()), obj)
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        //send api request to api controller
        $(document).trigger({
            'type': 'showActivity'
        });
        $.ajax({
            type: "POST",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                ImageCMSApi.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                $(document).trigger({
                    'type': 'imageapi.success',
                    'object': obj
                });
                if (obj !== null) {
                    var form = $(selector);
                    ImageCMSApi.returnMsg("[status]:" + obj.status);
                    ImageCMSApi.returnMsg("[message]: " + obj.msg);
                    
                    if (((obj.refresh == true || obj.refresh == 'true') && (obj.redirect == false || obj.redirect == 'false')) || ((obj.refresh == 'false' || obj.refresh == false) && (obj.redirect == true || obj.redirect != '')))
                        $(document).trigger({
                            'type': 'imageapi.before_refresh_reload',
                            'el': form,
                            'obj': DS
                        });
                                        
                    if (typeof DS.callback == 'function')
                        DS.callback(obj.msg, obj.status, form, DS);
                    else
                        setTimeout((function() {
                            form.parent().find(DS.msgF).fadeOut(function() {
                                $(this).remove();
                            });
                            if (DS.hideForm)
                                form.show();
                        }), DS.durationHideForm);
                        
                    setTimeout(function(){
                        if ((obj.refresh == true || obj.refresh == 'true') && (obj.redirect == false || obj.redirect == 'false'))
                            location.reload();
                        if ((obj.refresh == 'false' || obj.refresh == false) && (obj.redirect == true || obj.redirect != ''))
                            location.href = obj.redirect;
                    }, DS.durationHideForm);
                    
                    if (obj.status == true) {
                        if (DS.hideForm)
                            form.hide();
                        if (DS.messagePlace == 'ahead')
                            $(message.success(obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace == 'behind')
                            $(message.success(obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg', 
                            'el': form.parent()
                        })
                    }
                    if (obj.cap_image != 'undefined' && obj.cap_image != null) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations != 'undefined' && obj.validations != null) {
                        ImageCMSApi.sendValidations(obj.validations, selector, DS);
                    }
                    $(form).find(':input').off('input.imageapi').on('input.imageapi', function() {
                        var $this = $(this),
                        form = $this.closest('form'),
                        $thisТ = $this.attr('name'),
                        elMsg = form.find('[for=' + $thisТ + ']');
                        if ($.exists(elMsg)) {
                            $this.removeClass(DS.err + ' ' + DS.scs);
                            elMsg.hide();
                            $(document).trigger({
                                'type': 'imageapi.hidemsg', 
                                'el': form
                            })
                        }
                    });
                }
                return this;
            }
        }).done(function() {
            ImageCMSApi.returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            ImageCMSApi.returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $(selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    /**
         * for displaying validation messages 
         * in the form, which needs validation, for each validate input
         * 
         * */
    sendValidations: function(validations, selector, DS) {
        var thisSelector = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] != "") {
                    var input = thisSelector.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, thisSelector));
                    var finput = thisSelector.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
                if (i == Object.keys(validations).length)
                    $(document).trigger({
                        'type': 'imageapi.pastemsg', 
                        'el': thisSelector
                    })
                i++;
            }
        } else {
            return false;
        }
    },
    /**
         * add captcha block if needed
         * @param {type} captcha_image
         */
    addCaptcha: function(cI, DS) {
        DS.captchaBlock.html(DS.captcha(cI));
        return false;
    }
}