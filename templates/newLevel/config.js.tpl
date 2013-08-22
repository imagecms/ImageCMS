<!-- php vars to js -->
<script type="text/javascript">
    var product_parent_category = '{$parent_category}';
    var curr = '{$CS}',
            currNext = '{$NextCS}',
            nextCs = '{echo $NextCS}',
            pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
            checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}",
            inCart = 'В корзине',
            toCart = '{lang('s_buy')}',
            pcs = 'Количество:',
            kits = 'Комплектов:',
            captchaText = 'Код протекции';
    {if $comp = $CI->session->userdata('shopForCompare')}
        {$cnt_comp = count($comp)}
    {else:}
        {$cnt_comp = 0}
    {/if}
    var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
            inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}"),
            inServerCompare = parseInt("{$cnt_comp}"),
            theme = "{$THEME}";
    plurProd = ['товар', 'товара', 'товаров'];
    plurKits = ['Комплект', 'Комплекта', 'Комплектов'];
    plurComments = ['отзыв', 'отзыва', 'отзывов'];
    {literal}
        text = {
            search: function(text) {
                return 'Введите боллее ' + text + ' символов';
            }
        }
    {/literal}
</script>
