<!-- php vars to js -->
{if $is_logged_in == '1'}
    {$is_logged_in = 1}
    {$wish_list = $CI->load->module('wishlist')}
    {$countWL = $wish_list->getUserWishListItemsCount($CI->dx_auth->get_user_id())}
{else:}
    {$is_logged_in = 0}
    {$countWL = 0}
{/if}
{$cart = \Cart\BaseCart::getInstance()->getItems('SProducts')}
{if count($cart['data']) > 0}
    {foreach $cart['data'] as $item}
        {$arrCartId[] = $item->id}
    {/foreach}
{/if}
{$countSh = getProductViewsCount()}
<script type="text/javascript">
    {if $comp = $CI->session->userdata('shopForCompare')}
        {$cnt_comp = count($comp)}
    {else:}
        {$cnt_comp = 0}
    {/if}
        var curr = '{$CS}',
        cartItemsProductsId = {echo json_encode($arrCartId)},
        nextCs = '{echo $NextCS}',
        nextCsCond = nextCs == '' ? false : true,
        pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
        checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}", //use in plugin plus minus
        inServerCompare = parseInt("{$cnt_comp}"),
        inServerWishList = parseInt("{$countWL}"),
        countViewProd = parseInt("{$countSh}"),
        theme = "{$THEME}",
        siteUrl = "{echo site_url()}",
        colorScheme = "{$colorScheme}",
        isLogin = "{$is_logged_in}" === '1' ? true : false,
        typePage = "{$CI->core->core_data['data_type']}";

    {literal}
        text = {
        search: function(text) {
        return '{/literal}{lang("Введите более", 'lightRed')} {literal}' + ' ' + text + '{/literal} {lang("символов", 'lightRed')}'{literal};
        },
        error: {
        notLogin: '{/literal}{lang("В список желаний могут добавлять только авторизированные пользователи", 'lightRed')}'{literal},
        fewsize: function(text) {
        return '{/literal}{lang("Выберете размер меньше или равно", 'lightRed')} {literal}' + ' ' + text + '{/literal} {lang("пикселей", 'lightRed')}'{literal};
        },
        enterName: '{/literal}{lang("Введите название", 'lightRed')}'{literal}
        }
        }
    {/literal}
    text.inCart = '{lang('В корзине','lightRed')}';
    text.pc = '{lang('шт','lightRed')}.';
    text.quant = '{lang('Кол-во','lightRed')}:';
    text.sum = '{lang('Сумма','lightRed')}:';
    text.toCart = '{lang('Купить','lightRed')}';
    text.pcs = '{lang('Количество:')}';
    text.kits = '{lang('Комплектов:')}';
    text.captchaText = '{lang('Код протекции')}';
    text.plurProd = ['{lang("товар",'lightRed')}', '{lang("товара",'lightRed')}', '{lang("товаров",'lightRed')}'];
    text.plurKits = ['{lang("набор",'lightRed')}', '{lang("набора",'lightRed')}', '{lang("наборов",'lightRed')}'];
    text.plurComments = ['{lang("отзыв",'lightRed')}', '{lang("отзыва",'lightRed')}', '{lang("отзывов",'lightRed')}'];
</script>
