var Shop = {
    //var Cart = new Object();
    Cart :{
        totalPrice : 0,
        popupCartSelector : 'script#cartPopupTemplate',
        
        add : function(cartItem){
            //trigger before_add_to_cart
            $(document).trigger({
                type: 'before_add_to_cart',
                data: cartItem
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
            return this.save(currentItem);
        },
        rm : function(cartItem){
            if (typeof cartItem == 'Object')
                localStorage.removeItem(cartItem.storageId());
            else
                localStorage.removeItem(cartItem);
            return this.totalRecount();
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
            var items = this.getAllItems();
            for (var i=0; i<items.length; i++)
                localStorage.removeItem(items[i].storageId());
            
            return this;
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
        cartItem.name = $context.data('prodName');

        return cartItem;
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
    $('button.btn_cart').on('click', function(){
        var cartItem = Shop.Cart.totalRecount().showPopupCart();
        return true;
    });

    //cart content changed
    $(document).on('cart_changed', function(){
        alert('cart changed');
    });
}
);