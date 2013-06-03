<!-- php vars to js -->
<script type="text/javascript">
    var curr = '{$CS}',
    pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
    checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}",
    inCart = '{lang('already_in_basket')}',
    toCart = '{lang('s_buy')}',
    pcs = 'шт.',
    kits = 'компл.',
    inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
    inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}"),
    inServerCompare = parseInt("{count($CI->session->userdata('shopForCompare'))}");
    
    {if $comp = $CI->session->userdata('shopForCompare')}
    {$cnt_comp = count($comp)}
    {else:}
    {$cnt_comp = 0}
    {/if}
    var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}");
    var inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}");
    var inServerCompare = parseInt("{$cnt_comp}");

    plurProd = ['&nbsp;товар', '&nbsp;товара', '&nbsp;товаров']
</script>
