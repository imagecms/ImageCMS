var inCart = 'Уже в корзине';
var toCart = 'В корзину';

var Shop = {
    //var Cart = new Object();
    Cart :{
        totalPrice : 0,
        popupCartSelector : 'script#cartPopupTemplate',
        
        add : function(cartItem){
            //trigger before_add_to_cart
            $(document).trigger({
                type: 'before_add_to_cart',
                cartItem: _.clone(cartItem)
            });
            //
            Shop.currentItem = cartItem;
            $.post('/shop/cart/add', {
                'quantity': cartItem.count,
                'productId': cartItem.id,
                'variantId': cartItem.vId},
                function(data){
                    try {
                        
                        responseObj = JSON.parse(data);
                        console.log(responseObj);
                        
                        //save item to storage
                        Shop.Cart._add(Shop.currentItem);
                    } catch (e){
                        return this;
                    }
                });

        },
        _add: function(cartItem){
//            console.log('adding');
//            console.log(cartItem);
            
            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
                currentItem.count += cartItem.count;
            else
                currentItem = cartItem;
            
//            console.log(cartItem);
            this.save(currentItem);
            
            
            ////trigger after_add_to_cart
            $(document).trigger({
                type: 'after_add_to_cart',
                cartItem: _.clone(cartItem)
            });
            //
            
            return this;
        },
        rm : function(cartItem){
            Shop.currentItem = cartItem;
            var sp = 'SProducts_';
            $.getJSON('/shop/cart_api/delete/'+sp+cartItem.id+'_'+cartItem.vId, function(data){
                
                localStorage.removeItem(Shop.currentItem.storageId());
                
                $(document).trigger({
                    type: 'cart_changed'
                });
            })
            
            
            
            return this;
        },        
        chCount : function(cartItem){
    
            var currentItem = this.load(cartItem.storageId());
            if (currentItem)
            {
                currentItem.count = cartItem.count;
                return this.save(currentItem);
            }
            else
                return this;
        },
           
        clear: function(){
            $.getJSON('/shop/cart_api/clear', 
                function(data){
                    var items = Shop.Cart.getAllItems();
                    for (var i=0; i<items.length; i++)
                        localStorage.removeItem(items[i].storageId());
                    
                    $(document).trigger({
                        type: 'cart_changed'
                    });
                
                    Shop.Cart.totalRecount();
                }
            );
        },
    
        //work with storage
        load : function(key)
        {
            try {
                return new Shop.cartItem( JSON.parse(localStorage.getItem(key)) );            
            } catch (e){
                return false;
            }
        },
        
        save : function(cartItem)
        {
            localStorage.setItem(cartItem.storageId(), JSON.stringify(cartItem));
            this.totalRecount();
            
            ////trigger cart_changed
            $(document).trigger({
                type: 'cart_changed'
            });
            //
            
            return this;
        },
            
        getAllItems : function()
        {
            var pattern = /cartItem_*/;
            
            var items = [];
            for (var i=0; i<localStorage.length; i++)
            {
                
                var key = localStorage.key(i);
                
                console.log(key);
                
                if (key.match(pattern))
                    items.push(this.load(key));
            }
            return items;
        },
            
        length : function()
        {
            var pattern = /cartItem_*/;
            var length = 0;
            for (var i=0; i<localStorage.length; i++)
                if (localStorage.key(i).match(pattern))
                    length ++;
            
            return length;
        },
            
        totalRecount : function()
        {
            var items = this.getAllItems();
            
            this.totalPrice = 0;
            for (var i=0; i<items.length; i++)
                this.totalPrice += items[i].price * items[i].count;
            
            return this;
        },
        
        getTotalPrice : function() 
        {
            if (this.totalPrice == 0)
                return this.totalRecount().totalPrice;
            else
                return this.totalPrice;
        },
    
        renderPopupCart : function(selector)
        {
            if (typeof selector == 'undefined' || selector == '')
                var selector = this.popupCartSelector;
            
            _.templateSettings.variable = "cart";
            var template = _.template($(selector).html());
            return template(Shop.Cart);
        },
    
        showPopupCart : function()
        {
            console.log('start rendering')
            var start = Date.now();
            $.fancybox(this.renderPopupCart());
            var delta = Date.now() - start;
            console.log('stop rendering, elapsed time: ' + delta);
        },
            
        updatePage : function()
        {
            
        }
    },
    cartItem :function(obj) {
        if (typeof obj == 'undefined' || obj == false)
            obj = {
                id : false,
                vId : false,
                name : false, 
                count: false
            };

        return prototype = {
            id : obj.id?obj.id:0,
            vId : obj.vId?obj.vId:0,
            price : obj.price?obj.price:0,
            name : obj.name?obj.name:'',
            count : obj.count?obj.count:1,
            storageId : function(){
                return 'cartItem_'+this.id+'_'+this.vId;
            }
        };
    },
        
    composeCartItem : function($context){
        var cartItem = new Shop.cartItem();

        cartItem.id = $context.data('prodid');
        cartItem.vId = $context.data('varid');
        cartItem.price = $context.data('price');
        cartItem.name = $context.data('name');

        return cartItem;
    },
        
    //settings manager
    Settings: {
        get: function(key){
            return localStorage.getItem(key);
        },
        set: function(key, value){
            localStorage.set(key, value);
            return this;
        }
    }
};


$(
function(){
  
    //global listeners
    
    //click 'add to cart'
    $('button.btn_buy').on('click', function(){
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem);
        return true;
    });

    //click 'go to cart'
//    $('button.btn_cart').on('click', function(){
//        var cartItem = Shop.Cart.showPopupCart();
//        return true;
//    });

    
    
    //cart content changed
    $(document).live('cart_changed', function(){
        //update page content
            //update products count
            $('div.cleaner>span>span:nth-child(3)').html(' ('+Shop.Cart.length()+')');
        
            var keys = [];
            _.each(Shop.Cart.getAllItems(), function(item){
                keys.push(item.id+'_'+item.vId);
            });
        
            //update all product buttons
            $('button.btn_buy').each(function(){
                var key = $(this).data('prodid')+'_'+$(this).data('varid');
                if (keys.indexOf(key) != -1)
                {
                    console.log($(this));
                    $(this).removeClass('btn_buy').addClass('btn_cart').html(inCart);
                }
            });
        
            $('button.btn_cart').each(function(){
                var key = $(this).data('prodid')+'_'+$(this).data('varid');
                if (keys.indexOf(key) == -1)
                {
                    console.log($(this));
                    $(this).removeClass('btn_cart').addClass('btn_buy').html(toCart);
                }
            });
        
    });

    $(document).on('before_add_to_cart', function(event){
        console.log(event);
    });

    $(document).on('after_add_to_cart', function(event){
        Shop.Cart.totalRecount();
        
        $('#popupCart').html(Shop.Cart.renderPopupCart()).hide();
        
        $('[data-rel="plusminus"]').plusminus({
        prev: 'prev.children(:eq(1))',
        next: 'prev.children(:eq(0))'
    })
        
        $('#showCart').click();
    });
}
);

//

function rmFromPopupCart(context)
{
    var tr = $(context).closest('tr');
    var cartItem = new Shop.cartItem();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');
    
    Shop.Cart.rm(cartItem);
    
    console.log(cartItem);
    
    tr.remove();
}