Cart = {
    Items: 0,
    cartBtnBuy: '.btnBuy',
    cartPopSelector: '.cartPopup',
    classInCart: '.inCart',
    classToCart: '.toCart',
    summDelivery: 0,
    summDiscount: 0,
    summGift: 0,
    getItems: function() {
        $.post('/shop/cart_api/getItems', function(data) {
            if (data) {
                this.Items = null;
                this.Items = JSON.parse(data);
            }
        })
    },
    initBtn: function() {
        $(this.cartBtnBuy).each(function() {
            var key = $(this).data('id') + '_' + $(this).data('var');
            if (this.Items.indexOf[key] >= 0)
                $(this).die().removeClass('classToCart').addClass('classInCart').on('click', this.showCart())
            else
                $(this).die().removeClass('classInCart').addClass('classToCart').on('click', this.toCart($(this)))
        })
    },
    showCart: function() {
        $.post(lang + '/shop/cart_api/showCart', function(data) {
            $(this.cartPopSelector).html(data);
        })

    },
    toCart: function(product, showCart) {
        showCart = showCart || true;
        $(document).trigger({
            type: 'before_add_to_cart',
            cartItem: product
        });

        var data = {
            'quantity': 1,
            'productId': product.data('id'),
            'variantId': product.data('var')
        };
        var url = '/shop/cart_api/add'
        $.post(url, data, function() {
            if (showCart)
                this.showCart();
            this.Items.push(data['productId'] + '_' + data['variantId']);
            //this.getItems();
            this.initBtn();
            $(document).trigger({
                type: 'after_add_to_cart',
                cartItem: product
            });
        })
    },
    rm: function(product, showCart) {
        showCart = showCart || true;
        var key = 'SProducts_' + product.data('id') + '_' + product.data('var');
        $.post('/shop/cart_api/delete/' + key, function() {
            if (showCart)
                this.showCart();
            //this.Items.push(data['productId'] + '_' + data['variantId']);
            this.getItems();
            this.initBtn();
        })
    },

    recount: function(product, quantity, showCart) {
        showCart = showCart || true;
        var data = 'products[SProducts_' + product.data('id') + '_' + product.data('var') + '&quantity = ' + quantity + '&recount=1';

        $.ajax({
            type: "POST",
            url: "/shop/cart_api/recount",
            data: data,
            success: function() {
                if (showCart)
                    this.showCart();
                //this.Items.push(data['productId'] + '_' + data['variantId']);
                this.getItems();
                this.initBtn();
            }
        });

    }
}

$(document).ready(function(){
    Cart.getItems();
    Cart.initBtn();
})



