/*
 *imagecms shop plugins
 **/
if (!Array.indexOf)
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0); i < this.length; i++) {
            if (this[i] === obj) {
                return i;
            }
        }
        return -1;
    };
if (!Object.keys)
    Object.prototype.keys = function(obj) {
        var keys = [];
        for (var i in obj) {
            if (obj.hasOwnProperty(i))
                keys.push(i);
        }
        return keys;
    };
var Shop = {
    Cart: {
        baseUrl: siteUrl + 'shop/cart/api/',
        xhr: {
        },
        add: function(obj, id, kit) {
            var method = kit ? 'addKit' : 'addProductByVariantId';
            $(document).trigger({
                'type': 'beforeAdd.Cart',
                'id': id,
                'kit': kit
            });
            if (this.xhr['add' + id])
                this.xhr['add' + id].abort();
            this.xhr['add' + id] = $.ajax({
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
            if (this.xhr['remove' + id])
                this.xhr['remove' + id].abort();
            this.xhr['remove' + id] = $.getJSON(this.baseUrl + method + '/' + id, function(data) {
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
            if (this.xhr['amount' + id])
                this.xhr['amount' + id].abort();
            this.xhr['amount' + id] = $.ajax({
                'type': 'post',
                'url': this.baseUrl + 'getAmountInCart',
                'data': {
                    'id': id,
                    'instance': kit ? 'ShopKit' : 'SProducts'
                },
                success: function(data) {
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
            if (this.xhr['count' + id])
                this.xhr['count' + id].abort();
            this.xhr['count' + id] = $.ajax({
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
            if (this.xhr['payment'])
                this.xhr['payment'].abort();
            this.xhr['payment'] = $.get(siteUrl + 'shop/order/getPaymentsMethodsTpl/' + id + '/' + tpl, function(data) {
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
            if (this.xhr[obj.template])
                this.xhr[obj.template].abort();
            this.xhr[obj.template] = $.ajax({
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
                cartItem[i] = data[i];
            return cartItem;
        }
    },
    CompareList: {
        items: [],
        all: function() {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add: function(key) {
            var _self = this;
            _self.items = _self.all();
            $(document).trigger({
                type: 'before_add_to_compare'
            });
            if (_self.items.indexOf(key) === -1) {
                $.getJSON(siteUrl + 'shop/compare_api/add/' + key, function(data) {
                    if (data.success) {
                        data.id = key;
                        _self.items.push(key);
                        localStorage.setItem('compareList', JSON.stringify(_self.items));
                        $(document).trigger({
                            type: 'compare_list_add',
                            dataObj: data
                        });
                        returnMsg("=== add Compare Item. call compare_list_add ===");
                    }
                    else {
                        returnMsg("=== Error. add Compare ===");
                        $(document).trigger('hideActivity');
                    }
                    try {
                        var dataObj = JSON.parse(data);

                    } catch (e) {
                    }
                });
            }
            return _self;
        },
        rm: function(key, el) {
            var _self = this;
            _self.items = _self.all();
            $(document).trigger({
                type: 'before_delete_compare'
            });
            if (_self.items.indexOf(key) !== -1) {
                _self.items = _.without(_self.items, key);
                _self.items = _self.all();
                $.getJSON(siteUrl + 'shop/compare_api/remove/' + key, function(data) {
                    if (data.success) {
                        data.id = key;
                        _self.items = _.without(_self.items, key);
                        localStorage.setItem('compareList', JSON.stringify(_self.items));
                        $(document).trigger({
                            type: 'compare_list_rm',
                            dataObj: data,
                            el: $(el)
                        });
                        returnMsg("=== remove Compare Item. call compare_list_rm ===");
                    }
                    else {
                        returnMsg("=== Error. remove Compare Item ===");
                        $(document).trigger('hideActivity');
                    }
                });
            }
            return _self;
        },
        sync: function() {
            $.getJSON(siteUrl + 'shop/compare_api/sync', function(data) {
                if (typeof data === 'object' || typeof data === 'Array') {
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
            return this;
        }
    }
};
if (typeof (wishList) !== 'object')
    var wishList = {
        all: function() {
            try {
                return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [];
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
            });
        }
    };
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
        var DS = $.extend($.extend({}, this.defSet()), obj);
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
                    'obj': DS,
                    'el': form,
                    'message': obj
                });
                if (obj !== null) {
                    var form = $(selector);
                    returnMsg("[status]:" + obj.status);
                    returnMsg("[message]: " + obj.msg);

                    obj.refresh = obj.refresh != undefined ? obj.refresh.toString() : obj.refresh;
                    obj.redirect = obj.redirect != undefined ? obj.redirect.toString() : obj.redirect;

                    var cond = (obj.refresh && obj.refresh === 'true' && obj.redirect === 'false') || (obj.redirect && obj.redirect !== 'false' && obj.redirect !== '');
                    if (cond)
                        $(document).trigger({
                            'type': 'imageapi.before_refresh_reload',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    if (typeof DS.callback === 'function')
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
                        if (obj.refresh === 'true' && obj.redirect === 'false')
                            location.reload();
                        if (obj.refresh === 'false' && obj.redirect !== '' && obj.redirect !== 'false')
                            location.href = obj.redirect;
                    }, DS.durationHideForm);

                    if ($.trim(obj.msg) !== '' && obj.validations === undefined) {
                        if (DS.hideForm)
                            form.hide();
                        var type = obj.status === true ? 'success' : 'error';
                        if (DS.messagePlace === 'ahead')
                            $(message[type](obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace === 'behind')
                            $(message[type](obj.msg)).appendTo(form.parent());
                        $(document).trigger({
                            'type': 'imageapi.pastemsg',
                            'el': form,
                            'obj': DS,
                            'message': obj
                        });
                    }
                    if (obj.cap_image) {
                        ImageCMSApi.addCaptcha(obj.cap_image, DS);
                    }
                    if (obj.validations) {
                        ImageCMSApi.sendValidations(obj.validations, form, DS, obj);
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
                                'el': form,
                                'obj': DS,
                                'message': obj
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
    sendValidations: function(validations, selector, DS, obj) {
        /**
         * for displaying validation messages 
         * in the form, which needs validation, for each validate input
         * 
         * */
        var sel = $(selector);
        if (typeof validations === 'object') {
            var i = 1;
            for (var key in validations) {
                if (validations[key] !== "") {
                    var input = sel.find('[name=' + key + ']');
                    input.addClass(DS.err);
                    input[DS.cMsgPlace](DS.cMsg(key, validations[key], DS.err, sel));
                }
                if (i === Object.keys(validations).length) {
                    $(document).trigger({
                        'type': 'imageapi.pastemsg',
                        'el': sel,
                        'obj': DS,
                        'message': obj
                    });
                    var finput = sel.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
                i++;
            }
        } else {
            return false;
        }
    },
    addCaptcha: function(cI, DS) {
        /**
         * add captcha block if needed
         * @param {type} captcha_image
         */
        DS.captchaBlock.html(DS.captcha(cI));
        return false;
    }
};