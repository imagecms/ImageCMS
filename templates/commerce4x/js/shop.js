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
                        //console.error(e.message);
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
            //console.log(cartItem);

            if (Shop.currentItem.kit)
                var key = 'ShopKit_' + Shop.currentItem.kitId;
            else
                var key = 'SProducts_' + Shop.currentItem.id+'_'+Shop.currentItem.vId;

            //Shop.currentItem = cartItem;
            $.getJSON('/shop/cart_api/delete/' + key, function () {
                //console.log('-- ');console.log(Shop.currentItem);console.log('cartItem_' + Shop.currentItem.id + Shop.currentItem.vId);
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

                var postData = {recount:1};
                postData[postName] = cartItem.count;
                $.post('/shop/cart_api', postData, function(data){

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

                //console.log(key);

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
            //console.log('start rendering');
            var start = Date.now();
            $.fancybox(this.renderPopupCart());
            var delta = Date.now() - start;
            //console.log('stop rendering, elapsed time: ' + delta);
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
                            //console.log(data.data.items[key]);
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

        /*find url*/
        var anchors = false;
        if (anchors = $context.closest('li').find('a')) {
            console.log(typeof anchors);
            _.each(anchors, function(anchor){
                if (typeof $(anchor).attr('href') != 'undefined')
                    if ($(anchor).attr('href').match('/product/'))
                        cartItem.url = $(anchor).attr('href');
            })
        }
        delete anchors;

        /*find image*/
        var images = false;
        if (images = $context.closest('li').find('img'))
            cartItem.img = $(images[0]).attr('src');
        delete  images;


        //check for product page
        if ($context.data('prodpage')) {
            if (!cartItem.url)
                cartItem.url = window.location.href;
            if (!cartItem.img)
                cartItem.img = $context.closest('.container').find('img').first().attr('src');
        }


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

            return JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [];
        },
        add:function (key, vid) {

            Shop.WishList.items = this.all();

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
                            localStorage.setItem('wishList', JSON.stringify(Shop.WishList.items));

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
                                $('#loginButton').click();
                                $('html, body').animate({
                                    scrollTop:0
                                }, 300);
                            }
                        }
                    } catch (e) {
                        //console.error('Error adding product to wishlist. Server\'s response is not valid JSON.');
                        //console.log(e)
                   }
                });
            }
        },

        rm:function (key, el) {
            this.items = this.all();
            $.get('/shop/wish_list_api/delete/' + key, function (data) {
                try {
                    dataObj = JSON.parse(data);
                    dataObj.id = key;

                    if (dataObj.success == true) {
                        Shop.WishList.items = _.without(Shop.WishList.items, key);
                        localStorage.setItem('wishList', JSON.stringify(Shop.WishList.items));

                        $(document).trigger({
                            type:'wish_list_rm',
                            dataObj:dataObj
                        });

                    }
                } catch (e) {
                    //console.error('Error remove product from wishlist. Server\'s response is notvalid JSON.');
                    //console.log(e.message);
                }
            });
            deleteWishListItem($(el));
        },
        sync: function(){
            $.getJSON('/shop/wish_list_api/sync', function(data){
                if (typeof(data) == 'Array' || typeof(data) == 'object') {
                    localStorage.setItem('wishList', JSON.stringify(data));

                    $(document).trigger({
                        type:'wish_list_sync'
                    });
                }
                if (data === false) {
                    localStorage.setItem('wishList', []);

                    $(document).trigger({
                        type:'wish_list_sync'
                    });
                }
            });
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
                    } catch (e) {
                        //console.error('Error add product to compareList. Server\'s response is notvalid JSON.');
                        //console.log(e.message);
                    }
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
                    } catch (e) {
                        //console.error('Error remove product from compareList. Server\'s response is notvalid JSON.');
                        //console.log(e.message);
                    }
                });
            }
            deleteComprasionItem($(el));
        },
        sync: function(){
            $.getJSON('/shop/compare_api/sync', function(data){
                //console.log(data);
                if (typeof(data) == 'object' || typeof(data) == 'Array') {
                    localStorage.setItem('compareList', JSON.stringify(data));

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

//


function processWish() {

    //wishlist checking
    var wishlist = Shop.WishList.all();
    $('button.toWishlist').each(function () {
        if (wishlist.indexOf($(this).data('prodid')) !== -1){
            var $this = $(this);
            $this.removeClass('toWishlist').addClass('inWishlist').addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });

    //comparelist checking
    var comparelist = Shop.CompareList.all();
    $('button.toCompare').each(function () {
        if (comparelist.indexOf($(this).data('prodid')) !== -1){
            var $this = $(this);
            $this.removeClass('toCompare').addClass('inCompare').addClass(genObj.compareIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
}

function processPage() {
    //update page content
    //update products count
    Shop.Cart.totalRecount();
    //console.log(Shop.Cart.totalCount);
    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');
    if (!Shop.Cart.totalCount)
        $('div.cleaner.isAvail').removeClass('isAvail');
    else if (Shop.Cart.totalCount && !$('div.cleaner').hasClass('isAvail')) {
        $('div.cleaner').addClass('isAvail').on('click', function () {
            location.href = '/shop/cart';
        })
    }


    var keys = [];
    _.each(Shop.Cart.getAllItems(), function (item) {
        keys.push(item.id + '_' + item.vId);
    });

    //update all product buttons
    $('button.btn_buy').not('.psPay').each(function () {
        var key = $(this).data('prodid') + '_' + $(this).data('varid');
        if (keys.indexOf(key) != -1) {
            $(this).removeClass('btn_buy').addClass('btn_cart').removeAttr('disabled').html(inCart).unbind('click').on('click', function(){
                Shop.Cart.countChanged = false;
                togglePopupCart();
            }).closest('li').addClass('in_cart');
        }
    });

    $('button.btn_cart').not('.toCompare, .inCompare, .toWishlist, .inWishlist, .psPay').each(function () {
        var key = $(this).data('prodid') + '_' + $(this).data('varid');
        if (keys.indexOf(key) == -1) {
            $(this).removeClass('btn_cart').addClass('btn_buy').html(toCart).removeAttr('disabled').unbind('click').on('click', function(){
                Shop.Cart.countChanged = false;
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem);
            }).closest('li').removeClass('in_cart');
        }
    });
}

function initShopPage(showWindow) {
    if (Shop.Cart.countChanged == false) {

        Shop.Cart.totalRecount();

        $('#popupCart').html(Shop.Cart.renderPopupCart()).hide();

        $('[data-rel="plusminus"]').plusminus({
            prev:'prev.children(:eq(1))',
            next:'prev.children(:eq(0))'
        });


        function chCountInCart($this) {
            var pd = $this;
            var cartItem = new Shop.cartItem({
                id:pd.data('prodid'),
                vId:pd.data('varid'),
                price:pd.data('price'),
                kit:pd.data('kit')
            });

            if (checkProdStock && pd.closest('div.frame_count').find('input').val() >= pd.closest('div.frame_count').find('input').data('max'))
                pd.closest('div.frame_count').find('input').val(pd.closest('div.frame_count').find('input').data('max'));
            //else

            cartItem.count = pd.closest('div.frame_count').find('input').val();


            var word = cartItem.kit ? kits : pcs;
            pd.closest('div.frame_count').next('span').html(word);

            Shop.Cart.chCount(cartItem, function(){});


            $('div.cleaner>span>span:nth-child(3)').html(' (' + Shop.Cart.totalCount + ')');
            totalPrice = cartItem.count * cartItem.price;
            pd.closest('tr').find('span.first_cash>span').last().html(totalPrice.toFixed(pricePrecision));

            $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));
            //
        }



        // change count
        $('div.frame_change_count>button').die('click').live('click', function(){
            chCountInCart($(this).closest('div'));
        });

        $('div.frame_change_count+input[type=text]').die('keyup').live('keyup', function(){
            chCountInCart($(this).prev('div'));
        });




        if (typeof showWindow == 'undefined' || showWindow != false)
            $('#showCart').click();

    }

};

function rmFromPopupCart(context, isKit) {
    if (typeof isKit != 'undefined' && isKit == true)
        var tr = $(context).closest('tr.cartKit');
    else
        var tr = $(context).closest('tr');

    var cartItem = new Shop.cartItem();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');

    Shop.Cart.rm(cartItem).totalRecount();
//tr.remove();
//    if ($('#popupCart tbody tr').length == 0)
//        $('#popupCart').html(_.template( $('#cartPopupTemplate').html() , {cart:Shop.Cart}));

};

function togglePopupCart() {
    $('#showCart').click();
}

function renderOrderDetails() {
    $('#orderDetails').html(_.template($('#orderDetailsTemplate').html(), {
        cart:Shop.Cart
    }));
}

function changeDeliveryMethod(id) {
    $.get('/shop/cart_api/getPaymentsMethods/' + id, function (dataStr) {
        data = JSON.parse(dataStr);
        var replaceStr = _.template('<select id="paymentMethod" name="paymentMethodId"><% _.each(data, function(item) { %><option value="<%-item.id%>"><%-item.name%></option> <% }) %></select> ', {
            data:data
        });
        $('div.pmDiv').closest('div').html(replaceStr);

        cuSel({
            changedEl:'#paymentMethod'
        });
    });
}


function recountCartPage() {
    var ca = $('span.cuselActive');
    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
    delete ca;

    $('span#totalPrice').html(parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision));
    $('span#finalAmount').html(parseFloat(Shop.Cart.getFinalAmount()).toFixed(pricePrecision));
    $('span#shipping').html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));

    $('span.curr').html(curr);
}

function emptyPopupCart() {
    $('#popupCart .inside_padd table, #shopCartPage').hide();
    $('#popupCart .inside_padd div.msg, #shopCartPageEmpty').removeClass('d_n').show();
}


/*      ========        Document Ready          ==========      */

function checkCompareWishLink() {
    var wishListFrame = $('#wishListData'),
    compareListFrame = $('#compareListData'),
    refS = '[data-rel="ref"]',
    notRefS = '[data-rel="notref"]';
        
    if (Shop.WishList.all().length) {
        wishListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        wishListFrame.find(notRefS).addClass('d_n');
    }
    else{
        wishListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        wishListFrame.find(notRefS).removeClass('d_n');
    }

    if (Shop.CompareList.all().length) {
        compareListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        compareListFrame.find(notRefS).addClass('d_n');
    }
    else {
        compareListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        compareListFrame.find(notRefS).removeClass('d_n');
    }
}


function checkSyncs(){
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }
    if (inServerWish != NaN)
    {
        if (Shop.WishList.all().length != inServerWish)
            Shop.WishList.sync();
    }
    if (inServerCart != NaN)
    {
        if (Shop.Cart.getAllItems().length != inServerCart)
            Shop.Cart.sync();
    }
};

$(document).ready(
    function () {
        processPage();
        checkSyncs();
        processWish();
        recountCartPage();
        if (window.location.href.match(/cart/))
            changeDeliveryMethod($('#method_deliv').val());
        $('#popupCart').html(Shop.Cart.renderPopupCart())
        //click 'add to cart'
        $('button.btn_buy').not('.psPay').on('click', function () {
            Shop.Cart.countChanged = false;
            $(this).attr('disabled', 'disabled');
            var cartItem = Shop.composeCartItem($(this));
            Shop.Cart.add(cartItem);
            return true;
        });

        if ($('#orderDetails'))
            renderOrderDetails();

        //Shop.Cart.countChanged = true;
        initShopPage(false);
        //Shop.Cart.countChanged = false;

        //shipping changing, re-render cart page
        if ($('#method_deliv'))
            $('#method_deliv').on('change', function () {
                recountCartPage();
                changeDeliveryMethod($('span.cuselActive').attr('val'));
            });

        if ($('#orderDetails'))
            renderOrderDetails();

        //shipping changing, re-render cart page
        if ($('#method_deliv'))
            $('#method_deliv').on('change', function () {
                recountCartPage();
            });

        $('div.cleaner>span>span:nth-child(3)').html(' (' + Shop.Cart.totalCount + ')');


        $('div.cleaner.isAvail').on('click', function () {
            window.location.href = '/shop/cart';
        });

        checkCompareWishLink();

        //click 'go to cart'
        //    $('button.btn_cart').on('click', function(){
        //        var cartItem = Shop.Cart.showPopupCart();
        //        return true;
        //    });

        //cart content changed
        $(document).live('cart_changed', function () {

            //Shop.Cart.totalRecount();
            processPage();
            renderOrderDetails();
            if ($('#method_deliv'))
                recountCartPage();
            //update popup cart
            //$('table.table_order.preview_order td:last-child span:last-child').last().html(Shop.Cart.totalPrice.toFixed(pricePrecision));
            //
            $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));
            if (Shop.Cart.totalCount == 0)
                emptyPopupCart();
        });


        $(document).on('after_add_to_cart', function (event) {
            initShopPage();
            Shop.Cart.countChanged = false;
        });

        $(document).on('cart_rm', function(data){
            if (!data.cartItem.kit)
                $('#popupProduct_'+data.cartItem.id+'_'+data.cartItem.vId).remove();
            else
                $('#popupKit_'+data.cartItem.kitId).remove();

        });


        $('button.toCompare').on('click', function () {
            var id = $(this).data('prodid');
            Shop.CompareList.add(id);
        });

        $('button.toWishlist').on('click', function () {
            var id = $(this).data('prodid');
            var vid = $(this).data('varid');
            Shop.WishList.add(id, vid);
        });

        $('button.inWishlist').die('click').live('click', function () {
            document.location.href = '/shop/wish_list';
        });

        $('button.inCompare').die('click').live('click', function () {
            document.location.href = '/shop/compare';
        });

        /*      Wish-list event listeners       */

        $(document).on('wish_list_add', function (e) {
            if (e.dataObj.success == true) {
                $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
                var $this = $('.toWishlist[data-prodid=' + e.dataObj.id + ']')
                $this.removeClass('toWishlist').addClass('inWishlist').addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
                $this.tooltip();
            }
            checkCompareWishLink();
            //chcss(genObj.compareIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
                $this.tooltip();

                checkCompareWishLink();
        });


        $(document).on('compare_list_add', function (e) {
            if (e.dataObj.success == true) {
                $('#compareListCount').html('(' + Shop.WishList.all().length + ')');
                var $this = $('.toCompare[data-prodid=' + e.dataObj.id + ']')
                $this.removeClass('toCompare').addClass('inCompare').addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
                $this.tooltip();
            }

            $('#compareCount').html('(' + Shop.CompareList.all().length + ')');

            checkCompareWishLink();
            //chcss(genObj.compareIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));

            $this.tooltip();

            checkCompareWishLink();
        });

        $(document).on('compare_list_rm', function () {
            $('#compareCount').html('(' + Shop.CompareList.all().length + ')');
            checkCompareWishLink();
        });

        $(document).on('wish_list_rm', function () {
            $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
            checkCompareWishLink();
        });

        $(document).on('compare_list_add', function () {
            checkCompareWishLink();
        });

        $(document).on('compare_list_sync', function () {
            $('#compareCount').html('(' + Shop.CompareList.all().length + ')');
            checkCompareWishLink();
        });

        /*     refresh page after sync      */
        $(document).on('wish_list_sync', function(){
            $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
            processWish();
        });
        $(document).on('compare_list_sync', function(){
            processWish();
        });

        /*  list-table buttons  */
    });

$(//gift certificate in cart
    function(){
        $('#applyGiftCert').on('click', function(){
            $('input[name=makeOrder]').val(0);
            $('input[name=checkCert]').val(1);
            $('#makeOrderForm').ajaxSubmit({
                url:'/shop/cart_api',
                success : function(data){
                    try {
                        var dataObj = JSON.parse(data);

                        Shop.Cart.giftCertPrice = dataObj.cert_price;

                        if (Shop.Cart.giftCertPrice > 0)
                        {// apply certificate
                            $('#giftCertPrice').html(parseFloat(Shop.Cart.giftCertPrice).toFixed(pricePrecision)+ ' '+curr);
                            $('#giftCertSpan').show();
                        //$('input[name=giftcert], #applyGiftCert').attr('disabled', 'disabled')
                        }

                        Shop.Cart.totalRecount();
                        recountCartPage();
                    } catch (e) {
                        //console.error('Checking gift certificate filed. '+e.message);
                    }
                }
            });

            $('input[name=makeOrder]').val(1);

            return false;
        });
    }
    )

//variants
$('#variantSwitcher').live('change', function () {
    var productId = $(this).attr('value');

    var vId = $('span.variant_' + productId).attr('data-id');
    var vName = $('span.variant_' + productId).attr('data-name');
    var vPrice = $('span.variant_' + productId).attr('data-price');
    var vOrigPrice = $('span.variant_' + productId).attr('data-origPrice');
    var vNumber = $('span.variant_' + productId).attr('data-number');
    var vMainImage = $('span.variant_' + productId).attr('data-mainImage');
    var vSmallImage = $('span.variant_' + productId).attr('data-smallImage');
    var vStock = $('span.variant_' + productId).attr('data-stock');


    $('#photoGroup').attr('href', vMainImage);
    $('#imageGroup').attr('src', vMainImage).removeClass().attr('alt', vName);
    $('#priceOrigVariant').html(vOrigPrice);
    $('#priceVariant').html(vPrice);
    if ($.trim(vNumber) != '') {
        $('#number').html('(Артикул ' + vNumber + ')');
    } else {
        $('#number').html(' ');
    }

    $('.variant').hide();
    $('.variant_' + vId).show();
});
