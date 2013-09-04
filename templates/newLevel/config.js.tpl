<!-- php vars to js -->
{if $is_logged_in == '1'}
    {$is_logged_in = 1}
    {$wish_list = $CI->load->module('wishlist')}
    {$countWL = $wish_list->getUserWishListItemsCount($CI->dx_auth->get_user_id())}
{else:}
    {$is_logged_in = 0}
    {$countWL = 0}
{/if}
{$countSh = getProductViewsCount()}
<script type="text/javascript">
    {if $comp = $CI->session->userdata('shopForCompare')}
        {$cnt_comp = count($comp)}
    {else:}
        {$cnt_comp = 0}
    {/if}
    var curr = '{$CS}',
    nextCs = '{echo $NextCS}',
    pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
    checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}",//use in plugin plus minus
    inCart = 'В корзине',
    toCart = '{lang('Купить','newLevel')}',
    pcs = 'Количество:',
    kits = 'Комплектов:',
    captchaText = 'Код протекции',
    isLogin = "{$is_logged_in}" == '1' ? true : false,
    inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
    inServerCompare = parseInt("{$cnt_comp}"),
    inServerWishList = parseInt("{$countWL}"),
    countViewProd = parseInt("{$countSh}"),
    theme = "{$THEME}";
    plurProd = ['{lang("товар","newLevel")}', '{lang("товара","newLevel")}', '{lang("товаров","newLevel")}'];
    plurKits = ['{lang("набор","newLevel")}', '{lang("набора","newLevel")}', '{lang("наборов","newLevel")}'];
    plurComments = ['{lang("отзыв","newLevel")}', '{lang("отзыва","newLevel")}', '{lang("отзывов","newLevel")}'];

    {literal}
        text = {
        search: function(text) {
        return 'Введите боллее ' + text + ' символов';
        },
        error:{
        notLogin: "залогинтесь"
        }
        }
    {/literal}
</script>