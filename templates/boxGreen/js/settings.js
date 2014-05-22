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

var
        selectDeliv = false,
        selectPayment = true,
        selIcons = '[class*=icon_]',
        preloader = '.preloader',
        selScrollPane = '.frame-scroll-pane .content-carousel';

function initDownloadScripts(scripts, callback, customEvent) {
    function downloadJSAtOnload(scripts, callback, customEvent) {
        var cL = 0,
                scriptsL = scripts.length;

        $.map(scripts, function(i, n) {
            $.ajax({
                url: theme + 'js/' + i + '.js',
                dataType: "script",
                cache: true,
                complete: function() {
                    cL++;
                    if (cL === scriptsL)
                        if (callback) {
                            eval(callback)();
                            setTimeout(function() {
                                $(document).trigger({'type': customEvent});
                            }, 0);
                        }
                }
            });
        })
    }
    ;
    $(window).load(function() {
        downloadJSAtOnload(scripts, callback, customEvent);
    });
}