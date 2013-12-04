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
            toWishlist: 'toWishlist',
            inWishlist: 'inWishlist',
            plurProd: '.plurProd',
            countBask: '.topCartCount',
            sumBask: '.topCartTotalPrice',
            addSumBask: '.topCartTotalAddPrice',
            frameDiscount: '#discount',
            gift: '#gift',
            curDiscount: '.curDiscount',
            genSumDiscount: '.genSumDiscount',
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
            frameCurDiscount: '.frameDiscount',
            frameGenDiscount: '.genDiscount',
            tinyBask: '.tinyBask',
            err: 'mError',
            scs: 'mSuccess',
            info: 'mInfo',
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
                selectPayment = false,
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