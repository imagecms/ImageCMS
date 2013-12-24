var
        isTouch = 'ontouchstart' in document.documentElement,
        wnd = $(window),
        body = $('body'),
        ie = $.browser.msie,
        ieV = $.browser.version,
        ltie7 = ie && (ieV <= 7),
        ltie8 = ie && (ieV <= 8),
        orderDetails = $.exists('#orderDetails'),
        checkProdStock = checkProdStock == "" ? false : true,
        hrefCategoryProduct = hrefCategoryProduct != undefined ? hrefCategoryProduct : undefined;

var optionsMenu = {
    item: 'td',
    duration: 200,
    drop: '.frame-item-menu > .frame-drop-menu',
    //direction: 'left', //when menu place left and drop go to right (if vertical menu)
    countColumn: 5, //if not drop-side

    //sub2Frame: '.frame-l2', //if drop-side
    //dropWidth: 475, //if not define than will be actual width needs when drop-side

    //if need column partition level 2
    columnPart: true,
    columnClassPref: 'column_',
    //if need column partition level 3
    columnPart2: true,
    columnClassPref2: 'column2_',
    maxC: 5,
    effectOn: 'slideDown',
    effectOff: 'slideUp',
    effectOnS: 'fadeIn',
    effectOffS: 'fadeOut',
    durationOn: 200,
    durationOff: 100,
    durationOnS: 100,
    durationOffS: 100,
    animatesub3: true,
    sub3Frame: '.frame-l2',
    evLF: 'hover',
    evLS: 'hover',
    frAClass: 'hoverM', //active class

    menuCache: true,
    activeFl: '.frame-item-menu > .frame-title > a', //
    parentTl: '.frame-l2', //prev a level 2
    otherPage: hrefCategoryProduct, //for product [undefined or value not other]

    vertical: false
};
var scrollPane = {
    animateScroll: true,
    showArrows: true,
    arrowButtonSpeed: 256
};
var carousel = {
    prev: '.prev',
    next: '.next',
    content: '.content-carousel',
    groupButtons: '.group-button-carousel',
    vCarousel: '.vertical-carousel',
    hCarousel: '.horizontal-carousel'
};
var optionsCycle = {
    speed: 600,
    timeout: 5000,
    fx: 'fade',
    pauseOnPagerHover: true,
    pagerAnchorBuilder: function(idx, slide) {
        return '<a href="#"></a>';
    }
};
var optionCompare = {
    frameCompare: '.frame-tabs-compare > div',
    left: '.left-compare li',
    right: '.items-compare > li',
    elEven: 'li',
    frameScroll: '.items-compare',
    mouseWhell: true,
    scrollNSP: true, //show scroll
    jScrollPane: true,
    scrollNSPT: '.items-catalog',
    onlyDif: $('[data-href="#only-dif"]'),
    allParams: $('[data-href="#all-params"]'),
    hoverParent: '.compare-characteristic',
    after: function(el) {
        $('.comprasion-head').css('height', el.find(optionCompare.scrollNSPT).height())
        //        if carousel in compare
        if ($.existsN(el.find('.carousel-js-css:not(.iscarousel)')))
            el.find('.carousel-js-css:not(.iscarousel)').myCarousel(carousel);
        wnd.scroll(); //for lazy
    },
    compareChangeCategory: function() {
        if ($.exists(optionCompare.frameCompare)) {
            $(optionCompare.frameCompare).equalHorizCell(optionCompare);
            if (optionCompare.onlyDif.parent().hasClass('active'))
                optionCompare.onlyDif.click();
            else
                optionCompare.allParams.click();
        }
    },
    scrollPane: {
        animateScroll: true,
        showArrows: true,
        arrowButtonSpeed: 250
    }
};
var optionsDrop = {
    overlayColor: '#000',
    overlayOpacity: '0.6',
    place: 'center', //noinherit(default) || inherit(ex. for ViewedProducts)
    durationOn: 500,
    durationOff: 200,
    modalPlace: '.notification',
    dropContent: '.drop-content',
    dropFooter: '.drop-footer',
    dropHeader: '.drop-header',
    animate: true,
    placeBeforeShow: 'center center',
    placeAfterClose: 'center center',
    timeclosemodal: 2000,
    delayAfter: -500,
    confirmSel: '#confirm',
    moreOne: false,
    closeClick: true,
    closeEsc: true,
    position: 'absolute'
};
var productStatus = {
    action: '<span class="product-status action"></span>',
    hit: '<span class="product-status hit"></span>',
    hot: '<span class="product-status nowelty"></span>',
    disc: function(disc) {
        return '<span class="product-status discount"><span class="text-el">' + disc.toFixed(0) + '%</span></span>';
    }
};
var imageCmsApiDefaults = {
    msgF: '.msg',
    err: 'error', //клас
    scs: 'success', //клас
    hideForm: true,
    messagePlace: 'ahead', // behind
    durationHideForm: 3000,
    cMsgPlace: 'after', //place error
    captcha: function(ci) {
        return '<div class="frame-label"><span class="title">' + text.captchaText + '</span>\n\
                        <span class="frame-form-field">\n\
                            <input type="text" name="captcha" value="' + text.captchaText + '"/> \n\
                            <span class="help-block" id="for_captcha_image">' + ci + '</span>\n\
                        </span></div>'
    },
    captchaBlock: '#captcha_block',
    cMsg: function(name, text, classN, form) {
        form.find('[for="' + name + '"]').remove();
        return '<label for="' + name + '" class="for_validations ' + classN + '">' + text + '</label>';
    }
// callback (callback accept (msg, status, form, DS)) where DS - imageCmsApiDefaults and "any other" ex. report_appereance has drop:".drop-report" if callback return true form hide 
// any other
};
var cleaverFilterObj = {
    elClosed: '.icon_times_apply',
    elCount: '#apply-count',
    effectIn: 'fadeIn',
    effectOff: 'fadeOut',
    duration: '300',
    location: 'right', //if vertical has be left
    //addingClass: 'left',//if vertical has be left
    elPos: '.frame-group-checks .frame-label',
    dropDownEff: 'slideToggle',
    dropDownEffDur: '400',
    currentPosScroll: [],
    dropDownArr: []
};

var cuselOptions = {
    changedEl: ".lineForm:visible select",
    visRows: 100,
    scrollArrows: false
};
var message = {
    success: function(text) {
        return '<div class = "msg js-msg"><div class = "success ' + genObj.scs + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    error: function(text) {
        return '<div class = "msg js-msg"><div class = "error ' + genObj.err + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    info: function(text) {
        return '<div class = "msg js-msg"><div class = "info ' + genObj.info + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    }
};
var lazyload = {
    effect: "fadeIn"
};
var optionsPlusminus = {
    prev: 'prev.children(:eq(1)).children',
    next: 'prev.children(:eq(0)).children',
    checkProdStock: checkProdStock
}
$.maxminValue.settings = {
    addCond: checkProdStock
}