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
    $('button.btn_buy:not(.psPay)').live('click', function () {
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


    $('button.toCompare').die('click').live('click', function () {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });

    $('button.toWishlist').die('click').live('click', function () {
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
            $this.removeClass('toWishlist').addClass('inWishlist').attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
                
            $this.each(function(){
                var $this = $(this);
                if ($this.closest(genObj.Wlist_other_wrap).length == 0) $this.addClass(genObj.wishListIn);
                else $this.addClass(genObj.WlistIn_other);
            })
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
            $this.removeClass('toCompare').addClass('inCompare').attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
                
            $this.each(function(){
                var $this = $(this);
                if ($this.closest(genObj.Clist_other_wrap).length == 0) $this.addClass(genObj.compareIn);
                else $this.addClass(genObj.ClistIn_other);
            })
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

$(function(){
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
})

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
