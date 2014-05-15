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
    {literal}
        var genObj = {
        submitOrder: '#submitOrder',
        frameDelivery: '#frameDelivery',
        framePaymentMethod: '#framePaymentMethod',
        dM: '[name = "deliveryMethodId"]',
        pM: '#paymentMethod',
        gift: '[name="gift"]',
        giftButton: '#giftButton',
        parentBtnBuy: '.globalFrameProduct',
        loginButton: '#loginButton',
        tinyCompareList: '.tinyCompareList',
        countTinyCompareList: '.compareListCount',
        toCompare: 'toCompare',
        inCompare: 'inCompare',
        tinyWishList: '.tinyWishList',
        countTinyWishList: '.wishListCount',
        btnWish: '.btnWish',
        toWishlist: '.toWishlist',
        inWishlist: '.inWishlist',
        plurProd: '.plurProd',
        popupCart: '#popupCart',
        showCartPopup: '#showCartPopup',
        editCart: '.editCart',
        btnBask: '.btnBask',
        tinyBask: '#tinyBask',
        btnBuyKit: '.btnBuyKit',
        btnBuy: '.btnBuy',
        btnToCart: '.btn-buy',
        btnInCart: '.btn-cart',
        priceVariant: '.priceVariant',
        priceOrigVariant: '.priceOrigVariant',
        priceAddPrice: '.addCurrPrice',
        photoProduct: '#photoProduct',
        mainThumb: '#mainThumb',
        plusMinus: '.plusMinus',
        imgVC: '.vImg',
        imgVP: '.vImgPr',
        infoBut: '.infoBut',
        frameCount: '.frameCount',
        frameNumber: '.frameVariantCode',
        frameVName: '.frameVariantName',
        err: 'error',
        scs: 'success',
        info: 'info',
        prefV: ".js-variant-",
        selVariant: '.js-variant',
        blockEmpty: '.js-empty',
        blockNoEmpty: '.js-no-empty',
        code: '.js-code',
        numberC: '.js-number',
        msgF: '.js-msg',
        compareIn: 'btn-comp-in',
        wishIn: 'btn-wish-in',
        isAvail: 'pointer',
        inCart: 'in-cart',
        toCart: 'to-cart',
        notAvail: 'not-avail',
        textEl: '.text-el',
        changeVariantCategory: '[id ^= сVariantSwitcher_]',
        changeVariantProduct: '#variantSwitcher',
        orderDetails: '#orderDetails'
        };
    {/literal}
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
        selectDeliv = false,
        selectPayment = true,
        selIcons = '[class*=icon_]',
        preloader = '.preloader',
        typePage = "{$CI->core->core_data['data_type']}",
        selScrollPane = '.frame-scroll-pane .content-carousel';

    {literal}
        text = {
        search: function(text) {
        return '{/literal}{lang("Введите более", 'boxGreen')} {literal}' + ' ' + text + '{/literal} {lang("символов", 'boxGreen')}'{literal};
        },
        error: {
        notLogin: '{/literal}{lang("В список желаний могут добавлять только авторизированные пользователи", 'boxGreen')}'{literal},
        fewsize: function(text) {
        return '{/literal}{lang("Выберите размер меньше или равно", 'boxGreen')} {literal}' + ' ' + text + '{/literal} {lang("пикселей", 'boxGreen')}'{literal};
        },
        enterName: '{/literal}{lang("Введите название", 'boxGreen')}'{literal}
        }
        }
    {/literal}
    text.inCart = '{lang('В корзине','boxGreen')}';
    text.pc = '{lang('шт','boxGreen')}.';
    text.quant = '{lang('Кол-во','boxGreen')}:';
    text.sum = '{lang('Сумма','boxGreen')}:';
    text.toCart = '{lang('Купить','boxGreen')}';
    text.pcs = '{lang('Количество:')}';
    text.kits = '{lang('Комплектов:')}';
    text.captchaText = '{lang('Код протекции')}';
    text.plurProd = ['{lang("товар",'boxGreen')}', '{lang("товара",'boxGreen')}', '{lang("товаров",'boxGreen')}'];
    text.plurKits = ['{lang("набор",'boxGreen')}', '{lang("набора",'boxGreen')}', '{lang("наборов",'boxGreen')}'];
    text.plurComments = ['{lang("отзыв",'boxGreen')}', '{lang("отзыва",'boxGreen')}', '{lang("отзывов",'boxGreen')}'];
</script>
