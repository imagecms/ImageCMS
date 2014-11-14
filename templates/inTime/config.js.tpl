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
{$openLevels = getOpenLevels()}
{if $openLevels}
    {if $openLevels == 'all'}
        {$menuClass = 'col'}
    {else:}
        {$menuClass = 'row'}
    {/if}
{else:}
    {$menuClass = 'row'}
{/if}
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
            typePage = "{$CI->core->core_data['data_type']}",
            typeMenu = "{$menuClass}";

    {literal}
        text = {
            search: function(text) {
                return '{/literal}{lang("Введите более", 'inTime')} {literal}' + ' ' + text + '{/literal} {lang("символов", 'inTime')}'{literal};
                        },
                        error: {
                            notLogin: '{/literal}{lang("В список желаний могут добавлять только авторизированные пользователи", 'inTime')}'{literal},
                                        fewsize: function(text) {
                                            return '{/literal}{lang("Выберите размер меньше или равно", 'inTime')} {literal}' + ' ' + text + '{/literal} {lang("пикселей", 'inTime')}'{literal};
                                                        },
                                                        enterName: '{/literal}{lang("Введите название", 'inTime')}'{literal}
                                                                }
                                                            }
    {/literal}
        text.inCart = '{lang('В корзине','inTime')}';
        text.pc = '{lang('шт','inTime')}.';
        text.quant = '{lang('Кол-во','inTime')}:';
        text.sum = '{lang('Сумма','inTime')}:';
        text.toCart = '{lang('Купить','inTime')}';
        text.pcs = '{lang('Количество:')}';
        text.kits = '{lang('Комплектов:')}';
        text.captchaText = '{lang('Код протекции')}';
        text.plurProd = ['{lang("товар",'inTime')}', '{lang("товара",'inTime')}', '{lang("товаров",'inTime')}'];
        text.plurKits = ['{lang("набор",'inTime')}', '{lang("набора",'inTime')}', '{lang("наборов",'inTime')}'];
        text.plurComments = ['{lang("отзыв",'inTime')}', '{lang("отзыва",'inTime')}', '{lang("отзывов",'inTime')}'];
</script>
