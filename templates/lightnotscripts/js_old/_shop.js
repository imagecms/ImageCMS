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
var returnMsg = function(msg) {
    if (window.console) {
        console.log(msg);
    }
};
var Shop = {
    //var Cart = new Object();
    currentItem: {},
    Cart: {
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
            return {
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
            var cartItem = new Shop.Cart.cartItem();
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

                    setTimeout(function() {
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
                        ImageCMSApi.sendValidations(obj.validations, form, DS);
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
                    var finput = sel.find(':input.' + DS.err + ':first');
                    finput.setCursorPosition(finput.val().length);
                }
                if (i == Object.keys(validations).length)
                    $(document).trigger({
                        'type': 'imageapi.pastemsg',
                        'el': sel.parent()
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