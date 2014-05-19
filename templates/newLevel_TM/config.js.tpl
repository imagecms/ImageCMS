<!-- php vars to js -->
{if $is_logged_in == '1'}
    {$is_logged_in = 1}
    {$wish_list = $CI->load->module('wishlist')}
    {$countWL = $wish_list->getUserWishListItemsCount($CI->dx_auth->get_user_id())}
{else:}
    {$is_logged_in = 0}
    {$countWL = 0}
{/if}
{$openLevels = getOpenLevels()}
{if $openLevels == 'all'}
    {$menuClass = 'col'}
{else:}
    {$menuClass = 'row'}
{/if}
{$countSh = getProductViewsCount()}
<script type="text/javascript">
    {literal}
        var genObj = {
            iPr: '.iPr',
            popupCart: '#popupCart',
            pageCart: '.pageCart',
            frameDelivery: '#frameDelivery',
            pM: '.paymentMethod',
            trCartKit: '.rowKits',
            frameCount: '.frameCount',
            countOrCompl: '.countOrCompl',
            priceOrder: '.priceOrder',
            priceAddOrder: '.priceAddOrder',
            priceOrigOrder: '.priceOrigOrder',
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
            countBask: '.topCartCount',
            sumBask: '.topCartTotalPrice',
            addSumBask: '.topCartTotalAddPrice',
            frameGift: "#frameGift",
            gift: '#gift',
            shipping: '#shipping',
            finalAmountAdd: '#finalAmountAdd',
            finalAmount: '#finalAmount',
            totalPrice: '#totalPrice',
            showCart: '#showCart',
            certPrice: '#giftCertPrice',
            certFrame: '#giftCertSpan',
            orderDetails: '#orderDetails',
            orderDetailsTemplate: '#orderDetailsTemplate',
            priceVariant: '.priceVariant',
            priceOrigVariant: '.priceOrigVariant',
            priceAddPrice: '.addCurrPrice',
            photoProduct: '#photoProduct',
            mainThumb: '#mainThumb',
            plusMinus: '.plusMinus',
            imgVC: '.vImg',
            imgVP: '.vImgPr',
            infoBut: '.infoBut',
            btnBuy: '.btnBuy',
            frameChangeCount: '.frameChangeCount',
            frameNumber: '.frameVariantCode',
            frameVName: '.frameVariantName',
            frameBasks: '.frameBask',
            genSumDiscount: '.genSumDiscount', //сумма скидки
            curDiscount: '.curDiscount', //сумма товаров без скидки
            frameDiscount: '.frameDiscount', //фрейм продуктовой скидки

            discount: '#discount', //общяя скидка на оформлении
            frameGenDiscount: '#frameGenDiscount', //фрейм общей скидки на оформлении
            frameGenSumDiscount: '#frameGenSumDiscount', //фрейм общей суммы без скидки

            tinyBask: '.tinyBask',
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
            btnBuyCss: 'btn-buy',
            btnCartCss: 'btn-cart',
            textEl: '.text-el',
            changeVariantCategory: '[id ^= сVariantSwitcher_]',
            changeVariantProduct: '#variantSwitcher'
        };
    {/literal}
    {if $comp = $CI->session->userdata('shopForCompare')}
        {$cnt_comp = count($comp)}
    {else:}
        {$cnt_comp = 0}
    {/if}
        var curr = '{$CS}',
                nextCs = '{echo $NextCS}',
                nextCsCond = nextCs == '' ? false : true;
        Discount = false,
                discountInPopup = true,
                pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
                checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}", //use in plugin plus minus
                inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
                inServerCompare = parseInt("{$cnt_comp}"),
                inServerWishList = parseInt("{$countWL}"),
                countViewProd = parseInt("{$countSh}"),
                theme = "{$THEME}",
                siteUrl = "{echo site_url()}",
                colorScheme = "{$colorScheme}",
                isLogin = "{$is_logged_in}" == '1' ? true : false,
                typeMenu = "{$menuClass}",
                selectDeliv = false,
                selectPayment = true,
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
                                            return '{/literal}{lang("Выберите размер меньше или равно", "newLevel")} {literal}' + ' ' + text + '{/literal} {lang("пикселей", "newLevel")}'{literal};
                                                        },
                                                        enterName: '{/literal}{lang("Введите название", "newLevel")}'{literal}
                                                                }
                                                            }
    {/literal}
        text.inCart = '{lang('В корзине','newLevel')}';
        text.pc = '{lang('шт','newLevel')}.';
        text.quant = '{lang('Кол-во','newLevel')}:';
        text.sum = '{lang('Сумма','newLevel')}:';
        text.toCart = '{lang('Купить','newLevel')}';
        text.pcs = '{lang('Количество:')}';
        text.kits = '{lang('Комплектов:')}';
        text.captchaText = '{lang('Код протекции')}';
        text.plurProd = ['{lang("товар","newLevel")}', '{lang("товара","newLevel")}', '{lang("товаров","newLevel")}'];
        text.plurKits = ['{lang("набор","newLevel")}', '{lang("набора","newLevel")}', '{lang("наборов","newLevel")}'];
        text.plurComments = ['{lang("отзыв","newLevel")}', '{lang("отзыва","newLevel")}', '{lang("отзывов","newLevel")}'];
</script>