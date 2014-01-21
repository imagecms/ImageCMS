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
    Cart: {
        baseUrl: siteUrl + 'shop/cart/api/',
        totalPrice: 0,
        totalPriceAdd: 0,
        shipping: {
            freeFrom: 0,
            price: 0,
            sumSpec: 0,
            sumSpecMes: ""
        },
        add: function(obj, id, kit) {
            var method = kit ? 'addKit' : 'addProductByVariantId';
            $(document).trigger({
                'type': 'beforeAdd.Cart',
                'id': id,
                'kit': kit
            });
            $.ajax({
                'type': 'get',
                'url': this.baseUrl + method + '/' + id,
                'data': obj,
                success: function(data) {
                    $(document).trigger({
                        'type': 'add.Cart',
                        'datas': JSON.parse(data),
                        'id': id,
                        'kit': kit,
                        'obj': obj
                    });
                }
            });
            return this;
        },
        remove: function(id, kit) {
            var method = kit ? 'removeKit' : 'removeProductByVariantId';
            $(document).trigger({
                'type': 'beforeRemove.Cart',
                'id': id,
                'kit': kit
            });
            $.getJSON(this.baseUrl + method + '/' + id, function(data) {
                $(document).trigger({
                    'type': 'remove.Cart',
                    'datas': data,
                    'id': id,
                    'kit': kit
                });
            });
            return this;
        },
        getAmount: function(kit, id) {
            $(document).trigger({
                'type': 'beforeGetAmount.Cart',
                'kit': kit,
                'id': id
            });
            $.ajax({
                'type': 'post',
                'url': this.baseUrl + 'getAmountInCart',
                'data': {
                    'id': id,
                    'instance': kit ? 'ShopKit' : 'SProducts'
                },
                success: function(data){
                    $(document).trigger({
                        'type': 'getAmount.Cart',
                        'kit': kit,
                        'id': id,
                        'datas': data
                    });
                }
            });
            return this;
        },
        changeCount: function(count, id, kit) {
            var method = kit ? 'setQuantityKitById' : 'setQuantityProductByVariantId';
            $(document).trigger({
                'type': 'beforeChange.Cart',
                'count': count,
                'kit': kit,
                'id': id
            });
            $.ajax({
                'type': 'get',
                'url': this.baseUrl + method + '/' + id,
                'data': {
                    'quantity': count
                },
                success: function(data) {
                    $(document).trigger({
                        'type': 'сhange.Cart',
                        'datas': JSON.parse(data),
                        'count': count,
                        'kit': kit,
                        'id': id
                    });
                }
            });
            return this;
        },
        getPayment: function(id, tpl) {
            tpl = tpl ? tpl : '';
            $(document).trigger({
                'type': 'beforeGetPayment.Cart',
                'id': id,
                'datas': tpl
            });
            $.get(siteUrl + 'shop/order/getPaymentsMethodsTpl/' + id + '/' + tpl, function(data) {
                $(document).trigger({
                    'type': 'getPayment.Cart',
                    'id': id,
                    'datas': data
                });
            });
            return this;
        },
        getTpl: function(obj, objF) {
            $(document).trigger({
                'type': 'beforeGetTpl.Cart',
                'obj': obj,
                'objF': objF
            });
            $.ajax({
                'type': 'post',
                'url': siteUrl + 'shop/cart',
                'data': obj,
                success: function(data) {
                    $(document).trigger({
                        'type': 'getTpl.Cart',
                        'obj': obj,
                        'objF': objF,
                        'datas': data
                    });
                }
            });
            return this;
        },
        composeCartItem: function($context) {
            var cartItem = {},
            data = $context.data();
            for (var i in data)
                cartItem[i] = data[i]
            return cartItem;
        }
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
                $.get(siteUrl + 'shop/compare_api/add/' + key, function(data) {
                    try {
                        var dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items.push(key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_add',
                                dataObj: dataObj
                            });
                        }
                        returnMsg("=== add Compare Item. call compare_list_add ===");
                    } catch (e) {
                        returnMsg("=== Error. add Compare ===");
                        $(document).trigger('hideActivity');
                    }
                });
            }
        },
        rm: function(key, el) {
            this.items = this.all();
            if (this.items.indexOf(key) !== -1) {
                this.items = _.without(this.items, key);
                this.items = this.all();
                $.get(siteUrl + 'shop/compare_api/remove/' + key, function(data) {
                    try {
                        var dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.CompareList.items = _.without(Shop.CompareList.items, key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));
                            $(document).trigger({
                                type: 'compare_list_rm',
                                dataObj: dataObj
                            });
                        }
                        returnMsg("=== remove Compare Item. call compare_list_rm ===");
                    } catch (e) {
                        returnMsg("=== Error. remove Compare Item ===");
                        $(document).trigger('hideActivity');
                    }
                });
            }
            $(document).trigger({
                type: 'delete_compare',
                el: $(el)
            });
        },
        sync: function() {
            $.getJSON(siteUrl + 'shop/compare_api/sync', function(data) {
                if (typeof data == 'object' || typeof data == 'Array') {
                    localStorage.setItem('compareList', JSON.stringify(data));
                }
                else if (data === false) {
                    localStorage.removeItem('compareList');
                }
                $(document).trigger({
                    type: 'compare_list_sync',
                    dataObj: data
                });
                returnMsg("=== Compare sync. call compare_list_sync ===");
            });
        }
    }
};
if (typeof (wishList) != 'object')
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
                'type': 'wish_list_sync',
                dataObj: data
            });
            returnMsg("=== WishList sync. call wish_list_sync ===");
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
                returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                $(document).trigger({
                    'type': 'imageapi.success',
                    'object': obj
                });
                if (obj !== null) {
                    var form = $(selector);
                    returnMsg("[status]:" + obj.status);
                    returnMsg("[message]: " + obj.msg);
                    var cond = ((obj.refresh == true || obj.refresh == 'true') && (obj.redirect == false || obj.redirect == 'false')) || ((obj.refresh == 'false' || obj.refresh == false) && (obj.redirect == true || obj.redirect != ''));
                    if (cond)
                        $(document).trigger({
                            'type': 'imageapi.before_refresh_reload',
                            'el': form,
                            'obj': DS
                        });

                    if (typeof DS.callback == 'function')
                        DS.callback(obj.msg, obj.status, form, DS);
                    else if (obj.status === true && !cond)
                        setTimeout((function() {
                            form.parent().find(DS.msgF).fadeOut(function() {
                                $(this).remove();
                            });
                        if (DS.hideForm)
                            form.show();
                    }), DS.durationHideForm);

                    setTimeout(function() {
                        if ((obj.refresh == true || obj.refresh == 'true') && (obj.redirect == false || obj.redirect == 'false'))
                            location.reload();
                        if ((obj.refresh == 'false' || obj.refresh == false) && (obj.redirect == true || obj.redirect != ''))
                            location.href = obj.redirect;
                    }, DS.durationHideForm);

                    if ($.trim(obj.msg) !== '' && obj.validations === undefined) {
                        if (DS.hideForm)
                            form.hide();
                        var type = obj.status === true ? 'success' : 'error';
                        if (DS.messagePlace == 'ahead')
                            $(message[type](obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace == 'behind')
                            $(message[type](obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg',
                            'el': form.parent()
                        })
                    }
                    if (obj.cap_image != 'undefined' && obj.cap_image != null) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations != 'undefined' && obj.validations != null) {
                        ImageCMSApi.sendValidations(obj.validations, form, DS);
                    }
                    $(form).find(':input').off('input.imageapi').on('input.imageapi', function() {
                        var $this = $(this),
                        form = $this.closest('form'),
                        $thisТ = $this.attr('name'),
                        elMsg = form.find('[for=' + $thisТ + ']');
                        if ($.exists(elMsg)) {
                            $this.removeClass(DS.err + ' ' + DS.scs);
                            elMsg.remove();
                            $(document).trigger({
                                'type': 'imageapi.hidemsg',
                                'el': form
                            });
                            $this.focus();
                        }
                    });
                }
                return this;
            }
        }).done(function() {
            returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            returnMsg("=== Api request breake with error!!! ===");
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
        var sel = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] != "") {
                    var input = sel.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, sel));
                }
                if (i == Object.keys(validations).length) {
                    $(document).trigger({
                        'type': 'imageapi.pastemsg',
                        'el': sel.parent()
                    })
                    var finput = sel.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
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