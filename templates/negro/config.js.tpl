<script>

    /*      shop  variables (from PHP to JS)    */
    var curr = '{$CS}';
    var pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}');
    var checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}";
    var inCart = '{lang('already_in_basket')}';
    var toCart = '<span class="icon-bask-buy"></span> {lang('s_buy')}';
    var pcs = 'шт.';
    var kits = 'компл.';

    /*      Shop synchronization data       */
    var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}");
    var inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}");
    var inServerCompare = parseInt("{count($CI->session->userdata('shopForCompare'))}");

    {literal}
    /*      custom classNames for shop buttons      */
    var btnBuyClass = 'buyButton';
    var btnToCartClass = 'toCart';
    var btnInCartClass = 'inCart';
    popupCartSelector = 'script#cartPopupTemplate';

    {/literal}
</script>