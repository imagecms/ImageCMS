/*
 *imagecms shop plugins
 **/
if (!Array.indexOf) {
    Array.prototype.indexOf = function (obj, start) {
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
    Cart:{
        totalPrice:0,
        totalCount:0,
        popupCartSelector:'script#cartPopupTemplate',
        countChanged:false,
        shipping:0,
        shipFreeFrom:0,
        giftCertPrice: 0,

        add:function (cartItem) {
            //trigger before_add_to_cart
            $(document).trigger({
                type:'before_add_to_cart',
                cartItem:_.clone(cartItem)
            });
            //
            var data = {
                'quantity':cartItem.count,
                'productId':cartItem.id,
                'variantId':cartItem.vId
            };
            var url = '/shop/cart_api/add';

            if (cartItem.kit) {
                data = {
                    'quantity':cartItem.count,
                    'kitId':cartItem.kitId
                };

                url += '/ShopKit';
            }

            Shop.currentItem = cartItem;
            $.post(url, data,
                function (data) {
                    try {
                        responseObj = JSON.parse(data);

                        //save item to storage
                        Shop.Cart._add(Shop.currentItem);
                    } catch (e) {
                        return;
                    }
                });
            return;

        },
        _add:function (cartItem) {

            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
                currentItem.count += cartItem.count;
            else
                currentItem = cartItem;

            this.save(currentItem);


            ////trigger after_add_to_cart
            $(document).trigger({
                type:'after_add_to_cart',
                cartItem:_.clone(cartItem)
            });

            $(document).trigger({
                type:'cart_changed'
            });
            //

            return this;
        },
        rm:function (cartItem) {
            Shop.currentItem = this.load('cartItem_' + cartItem.id + '_' + cartItem.vId);

            if (Shop.currentItem.kit)
                var key = 'ShopKit_' + Shop.currentItem.kitId;
            else
                var key = 'SProducts_' + Shop.currentItem.id+'_'+Shop.currentItem.vId;

            //Shop.currentItem = cartItem;
            $.getJSON('/shop/cart_api/delete/' + key, function () {
                localStorage.removeItem('cartItem_' + Shop.currentItem.id +'_'+ Shop.currentItem.vId);

                Shop.Cart.totalRecount();

                $(document).trigger({
                    type:'cart_rm',
                    cartItem: Shop.currentItem
                });

                $(document).trigger({
                    type:'cart_changed'
                });
            });

            return this;
        },
        chCount:function (cartItem, f) {

            Shop.Cart.currentItem = this.load(cartItem.storageId());
            if (Shop.Cart.currentItem) {

                Shop.Cart.currentItem.count = cartItem.count;

                //this.countChanged = true;

                Shop.currentCallbackFn = f;

                if (cartItem.kit)
                    var postName = 'kits[ShopKit_'+Shop.Cart.currentItem.kitId+']';
                else
                    var postName = 'products[SProducts_'+cartItem.id+'_'+cartItem.vId+']';

                var postData = {
                    recount:1
                };
                postData[postName] = cartItem.count;
                $.post('/shop/cart_api/recount', postData, function(data){

                    var dataObj = JSON.parse(data);
                    if (dataObj.hasOwnProperty('count'))
                        Shop.Cart.currentItem.count = dataObj.count;

                    Shop.Cart.save(Shop.Cart.currentItem);

                    (Shop.currentCallbackFn () );

                    $(document).trigger({
                        type:'count_changed',
                        cartItem:_.clone(cartItem)
                    });

                    $(document).trigger({
                        type:'cart_changed'
                    });

                });

                return this.totalRecount();

            }
        },

        clear:function () {
            $.getJSON('/shop/cart_api/clear',
                function () {
                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        localStorage.removeItem(items[i].storageId());
                    delete items;

                    $(document).trigger({
                        type:'cart_changed'
                    });

                    Shop.Cart.totalRecount();
                }
                );
        },

        //work with storage
        load:function (key) {
            try {
                return new Shop.cartItem(JSON.parse(localStorage.getItem(key)));
            } catch (e) {
                return false;
            }
        },

        save:function (cartItem) {
            if (!cartItem.storageId().match(/undefined/)) {
                localStorage.setItem(cartItem.storageId(), JSON.stringify(cartItem));
                this.totalRecount();

                ////trigger cart_changed
                $(document).trigger({
                    type:'cart_changed'
                });
            //
            }
            return this;
        },

        getAllItems:function () {
            var pattern = /cartItem_*/;

            var items = [];
            for (var i = 0; i < localStorage.length; i++) {

                var key = localStorage.key(i);

                if (key.match(pattern))
                    items.push(this.load(key));
            }
            return items;
        },

        length:function () {
            var pattern = /cartItem_*/;
            var length = 0;
            for (var i = 0; i < localStorage.length; i++)
                if (localStorage.key(i).match(pattern))
                    length++;

            return length;
        },

        totalRecount:function () {
            var items = this.getAllItems();

            this.totalPrice = 0;
            this.totalCount = 0;
            for (var i = 0; i < items.length; i++) {
                this.totalPrice += items[i].price * items[i].count;
                this.totalCount += parseInt(items[i].count);
            }

            return this;
        },

        getTotalPrice:function () {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPrice;
            else
                return this.totalPrice;
        },

        getFinalAmount:function () {
            if (this.shipFreeFrom > 0)
                if (this.shipFreeFrom <= this.getTotalPrice())
                    this.shipping = 0.0;

            return (this.getTotalPrice() + this.shipping - parseFloat(this.giftCertPrice))>=0?(this.getTotalPrice() + this.shipping - parseFloat(this.giftCertPrice)):0;
        },

        renderPopupCart:function (selector) {
            if (typeof selector == 'undefined' || selector == '')
                selector = this.popupCartSelector;

            template = _.template($(selector).html(), Shop.Cart);
            return template = _.template($(selector).html(), Shop.Cart);

        },

        showPopupCart:function () {
        //$.fancybox(this.renderPopupCart());
        },

        sync: function (){
            $.getJSON('/shop/cart_api/sync', function(data){
                if (typeof(data) == 'object'){

                    var items = Shop.Cart.getAllItems();
                    for (var i = 0; i < items.length; i++)
                        if (!items[i].kit)
                            localStorage.removeItem('cartItem_'+items[i]['id']+'_'+items[i]['vId']);
                    delete items;

                    _.each(_.keys(data.data.items), function(key) {
                        if (!data.data.items[key].kit)
                            localStorage.setItem(key, JSON.stringify(data.data.items[key]));
                        else
                        {
                            var kit = Shop.Cart.load('cartItem_'+items[i]['id']+'_'+items[i]['vId']);
                            kit.count = data.data.items[key].count;
                            Shop.Cart.save('cartItem_'+kit['id']+'_'+kit['vId']);
                        }
                    });

                    $(document).trigger({
                        type:'cart_changed'
                    });
                }
                if ( data ==  false )
                    Shop.Cart.clear();
            });
        },

        updatePage:function () {

        }
    },
    cartItem:function (obj) {
        if (typeof obj == 'undefined' || obj == false)
            obj = {
                id:false,
                vId:false,
                name:false,
                count:false,
                kit:false,
                maxcount:0,
                number:'',
                vname:false,
                url:false
            };

        return prototype = {
            id:obj.id ? obj.id : 0,
            vId:obj.vId ? obj.vId : 0,
            price:obj.price ? obj.price : 0,
            name:obj.name ? obj.name : '',
            count:obj.count ? obj.count : 1,
            kit:obj.kit ? obj.kit : false,
            prices:obj.prices ? obj.prices : 0,
            kitId:obj.kitId ? obj.kitId : 0,
            maxcount:obj.maxcount ? obj.maxcount : 0,
            number:obj.number ? obj.number : 0,
            vname:obj.vname ? obj.vname : '',
            url:obj.url ? obj.url : '',
            img:obj.img ? obj.img : '',
            storageId:function () {
                return 'cartItem_' + this.id + '_' + this.vId;
            }
        };
    },

    composeCartItem:function ($context) {
        var cartItem = new Shop.cartItem();

        cartItem.id = $context.data('prodid');
        cartItem.vId = $context.data('varid');
        cartItem.price = parseFloat($context.data('price')).toFixed(pricePrecision);
        cartItem.name = $context.data('name');
        cartItem.kit = $context.data('kit');
        cartItem.prices = $context.data('prices');
        cartItem.kitId = $context.data('kitid');
        cartItem.maxcount = $context.data('maxcount');
        cartItem.number = $context.data('number');
        cartItem.vname = $context.data('vname');
        cartItem.url = $context.data('url'); 
        cartItem.img = $context.data('img');
        return cartItem;
    },

    //settings manager
    Settings:{
        get:function (key) {
            return localStorage.getItem(key);
        },
        set:function (key, value) {
            localStorage.setItem(key, value);
            return this;
        }
    },

    WishList:{
        items:[],
        all:function () {
            return JSON.parse(localStorage.getItem('wishList_vid')) ? _.compact(JSON.parse(localStorage.getItem('wishList_vid'))) : [];
        },
        add:function (key, vid, price, curentEl) {
            Shop.WishList.items = this.all();
            //this.countTotalPrice( price, curentEl);
            localStorage.setItem('wishList_'+key+'_'+vid, JSON.stringify({
                id: key, 
                vid: vid, 
                price: price
            }));
            if (this.items.indexOf(key) == -1) {
                $.post('/shop/wish_list_api/add', {
                    productId_:key,
                    variantId_:vid
                }, function (data) {
                    try {
                        var dataObj = JSON.parse(data);
                        dataObj.id = key;
                        if (dataObj.success == true) {
                            Shop.WishList.items.push(key);
                            //localStorage.setItem('wishList', JSON.stringify(Shop.WishList.items));
                            var arr = JSON.parse(localStorage.getItem('wishList_vid')) ? _.compact(JSON.parse(localStorage.getItem('wishList_vid'))) : [];
                            arr.push(key+'_'+vid)
                            localStorage.setItem('wishList_vid', JSON.stringify(arr));
                            
                            if (Shop.WishList.items.length != dataObj.count) {
                                Shop.WishList.sync();
                                return;
                            }
                            $(document).trigger({
                                type:'wish_list_add',
                                dataObj:dataObj
                            });
                        }
                        else {
                            if (dataObj.errors.match('not_logged_in')) {
                                $(loginButton).click();
                            }
                        }
                    } catch (e) {}
                });
            }
        },

        rm:function (key, el, vid) {
            this.items = this.all();
            
            $.get('/shop/wish_list_api/delete/' + key + '_' + vid, function (data) {
                try {
                    dataObj = JSON.parse(data);
                    dataObj.id = key;

                    if (dataObj.success == true) {
                        Shop.WishList.items = _.without(Shop.WishList.items, key + '_' + vid);
                        localStorage.setItem('wishList_vid', JSON.stringify(Shop.WishList.items));

                        $(document).trigger({
                            type:'wish_list_rm',
                            dataObj:dataObj
                        });

                    }
                } catch (e) {}
            });
            deleteWishListItem($(el),key, vid);
        },
        sync: function(){
            $.getJSON('/shop/wish_list_api/sync', function(data){
                if (typeof(data) == 'Array' || typeof(data) == 'object') {
                    localStorage.setItem('wishList_vid', JSON.stringify(data));
                }
                if (data === false) {
                    localStorage.setItem('wishList_vid', []);
                }

                $(document).trigger({
                    type:'wish_list_sync'
                });
            });
        },
        countTotalPrice: function( price, curentEl){
            var inWishlist = curentEl.hasClass('inWishlist'); 
            if(!inWishlist){
                var totalPrice = localStorage.getItem('totalPrice');

                if(!totalPrice){
                    
                    localStorage.setItem('totalPrice',  parseFloat(price));
                }else{
                    localStorage.setItem('totalPrice', parseFloat(totalPrice) + parseFloat(price));
                }
            }
        }
    },

    CompareList:{
        items:[],
        all:function () {
            return JSON.parse(localStorage.getItem('compareList')) ? _.compact(JSON.parse(localStorage.getItem('compareList'))) : [];
        },
        add:function (key) {
            this.items = this.all();
            if (this.items.indexOf(key) === -1) {
                $.get('/shop/compare_api/add/' + key, function (data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;

                        if (dataObj.success == true) {
                            Shop.CompareList.items.push(key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));

                            $(document).trigger({
                                type:'compare_list_add',
                                dataObj:dataObj
                            });

                        }
                    } catch (e) {}
                });
            }
        },

        rm:function (key, el) {
            this.items = JSON.parse(localStorage.getItem('compareList')) ? JSON.parse(localStorage.getItem('compareList')) : [];

            if (this.items.indexOf(key) !== -1) {

                this.items = _.without(this.items, key);
                this.items = this.all();

                $.get('/shop/compare_api/remove/' + key, function (data) {
                    try {
                        dataObj = JSON.parse(data);
                        dataObj.id = key;

                        if (dataObj.success == true) {
                            Shop.CompareList.items = _.without(Shop.CompareList.items, key);
                            localStorage.setItem('compareList', JSON.stringify(Shop.CompareList.items));

                            $(document).trigger({
                                type:'compare_list_rm',
                                dataObj:dataObj
                            });
                        }
                    } catch (e) {}
                });
            }
            deleteComprasionItem($(el));
        },
        sync: function(){
            $.getJSON('/shop/compare_api/sync', function(data){
                if (typeof(data) == 'object' || typeof(data) == 'Array') {
                    localStorage.setItem('compareList', JSON.parse(data));

                    $(document).trigger({
                        type:'compare_list_sync'
                    });
                }
                else
                if(data === false) {
                    localStorage.removeItem('compareList');

                    $(document).trigger({
                        type:'compare_list_sync'
                    });
                }
            });
        }
    }
};
/*      ========        Document Ready          ==========      */