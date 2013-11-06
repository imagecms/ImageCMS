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
    {literal}
    var genObj = {
    popupCart: '#popupCart',
    pageCart: '.page-cart',
    pM: '.paymentMethod',
    trCartKit: 'tr.row-kits',
    frameCount: '.frame-count', //селектор
    countOrCompl: '.countOrCompl', //селектор
    priceOrder: '[data-rel="priceOrder"]',
    priceAddOrder: '[data-rel="priceAddOrder"]',
    priceOrigOrder: '[data-rel="priceOrigOrder"]',
    minus: '.btn-minus > button',
    plus: '.btn-plus > button',
    parentBtnBuy: 'li, .item-product', //селектор
    compareIn: 'btn-comp-in', //назва класу
    wishIn: 'btn-wish-in', //назва класу
    btnWish: '.btn-wish',
    toWishlist: 'toWishlist', //назва класу
    inWishlist: 'inWishlist', //назва класу
    tinyWishList: '.tiny-wish-list',
    countTinyWishList: '.wishListCount',
    tinyCompareList: '.tiny-compare-list',
    countTinyCompareList: '.compareListCount',
    toCompare: 'toCompare', //назва класу
    inCompare: 'inCompare', //назва класу
    plurProd: '.plurProd',
    countBask: '.topCartCount',
    sumBask: '.topCartTotalPrice',
    addSumBask: '.topCartTotalAddPrice',
    tinyBask: '.tiny-bask', //селектор
    bask: '.bask', //селектор
    blockEmpty: '.empty',
    blockNoEmpty: '.no-empty',
    isAvail: 'pointer', //назва класу
    loginButton: '#loginButton', //селектор
    inCart: 'in-cart', //назва класу
    toCart: 'to-cart', //назва класу
    notAvail: 'not-avail', //назва класу
    infoBut: '.infoBut',
    btnBuy: '.btnBuy', //назва класу кнопка купити
    btnBuyCss: 'btn-buy', //назва класу
    btnCartCss: 'btn-cart', //назва класу
    frameNumber: '.frame-variant-code',
    frameVName: '.frame-variant-name',
    code: '.code',
    prefV: ".variant_",
    selVariant: '.variant',
    imgVC: '.vimg',
    imgVP: '#vimg',
    priceVariant: '.priceVariant',
    priceOrigVariant: '.priceOrigVariant',
    priceAddPrice: '.addCurrPrice',
    photoProduct: '.photoProduct',
    plusMinus: '[data-rel="plusminus"]',
    frameBasks: '.frame-bask', //order and popup
    frameChangeCount: '.frame-change-count',
    numberC: '.number', //количество на складе
    frameDiscount: '#discount',
    gift: '#gift',
    genDiscount: '.genDiscount',
    genSumDiscount: '.genSumDiscount',
    frameCurDiscount: '.frame-discount',
    frameGenDiscount: '.frame-gen-discount',
    shipping: 'span#shipping',
    finalAmountAdd: 'span#finalAmountAdd',
    finalAmount: 'span#finalAmount',
    totalPrice: 'span#totalPrice',
    showCart: '#showCart',
    certPrice: '#giftCertPrice',
    certFrame: '#giftCertSpan',
    orderDetails: '#orderDetails',
    orderDetailsTemplate: '#orderDetailsTemplate',
    textEl: '.text-el', //селектор
    msgF: '.msg',
    err: 'error', //клас
    scs: 'success', //клас
    info: 'info' //клас
};
    {/literal}
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