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
        discountInPopup = true,
        pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
        checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}", //use in plugin plus minus
        inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
        inServerCompare = parseInt("{$cnt_comp}"),
        inServerWishList = parseInt("{$countWL}"),
        countViewProd = parseInt("{$countSh}"),
        theme = "{$THEME}",
        inCart = '{lang('В корзине','newLevel')}',
        toCart = '{lang('Купить','newLevel')}',
        pcs = '{lang('Количество:')}',
        kits = '{lang('Комплектов:')}',
        captchaText = '{lang('Код протекции')}',
        isLogin = "{$is_logged_in}" == '1' ? true : false,
        plurProd = ['{lang("товар","newLevel")}', '{lang("товара","newLevel")}', '{lang("товаров","newLevel")}'],
        plurKits = ['{lang("набор","newLevel")}', '{lang("набора","newLevel")}', '{lang("наборов","newLevel")}'],
        plurComments = ['{lang("отзыв","newLevel")}', '{lang("отзыва","newLevel")}', '{lang("отзывов","newLevel")}'],
        
        selectDeliv = false,
        selIcons = '[class*=icon_]',
        preloader = '.preloader',
        selScrollPane = '.frame-scroll-pane .content-carousel';

    {literal}
        text = {
            search: function(text) {
                return '{/literal}{lang("Введите боллее", "newLevel")} {literal}' + ' ' + text + '{/literal} {lang("символов", "newLevel")}'{literal};
            },
            error: {
                notLogin: '{/literal}{lang("В список желаний могут добавлять только авторизированные пользователи", "newLevel")}'{literal},
                fewsize: function(text) {
                    return '{/literal}{lang("Выберете размер меньше или равно", "newLevel")} {literal}' + ' ' + text + '{/literal} {lang("пикселей", "newLevel")}'{literal};
                },
                enterName: '{/literal}{lang("Введите название", "newLevel")}'{literal}
            }
        }
    {/literal}
</script>