<script>

    /*      shop  variables (from PHP to JS)    */
    var curr = '{$CS}',
    pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
    checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}",
    inCart = '<span class="text-el">{lang('already_in_basket')}</span>',
    toCart = '<span class="text-el">{lang('s_buy')}</span>',
    pcs = 'шт.',
    kits = 'компл.',

    /*      Shop synchronization data       */
    inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
    inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}"),
    inServerCompare = parseInt("{count($CI->session->userdata('shopForCompare'))}"),

    /*      custom classNames for shop buttons      */
    btnBuyClass = 'buyButton',
    btnToCartClass = 'toCart',
    btnInCartClass = 'inCart',
    popupCartSelector = 'script#cartPopupTemplate';
</script>