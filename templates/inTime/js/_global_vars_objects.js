var
        isTouch = 'ontouchstart' in document.documentElement,
        wnd = $(window),
        body = $('body'),
        ie = $.browser.msie,
        ieV = $.browser.version,
        ltie7 = ie && (ieV <= 7),
        ltie8 = ie && (ieV <= 8),
        checkProdStock = checkProdStock == "" ? false : true,
        hrefCategoryProduct = hrefCategoryProduct != undefined ? hrefCategoryProduct : undefined;

var optionsMenu = {
    item: 'td',
    duration: 200,
    drop: '.frame-item-menu > .frame-drop-menu',
    //direction: 'left', //when menu place left and drop go to right (if vertical menu)

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
if (typeMenu === 'col')
    optionsMenu.countColumn = 5; //if not drop-side
if (typeMenu === 'row') {
    optionsMenu.sub2Frame = '.frame-l2'; //if drop-side
    optionsMenu.dropWidth = 475; //if not define than will be actual width needs when drop-side
}
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
        return '<li><a href="#">'+$(slide).data('description')+'</a></li>';
    }
};
var optionsDrop = {
    overlayColor: '#000',
    overlayOpacity: 0.6,
    place: 'center', //noinherit(default) || inherit(ex. for ViewedProducts)
    durationOn: 500,
    durationOff: 200,
    dropContent: '.drop-content',
    dropFooter: '.drop-footer',
    dropHeader: '.drop-header',
    animate: true,
    timeclosemodal: 2000,
    modalPlace: '.notification',
    moreOne: false,
    closeClick: true,
    closeEsc: true,
    position: 'absolute',
    confirmBtnDrop: '#confirm',
    scroll: true,
    limitSize: true,
    limitContentSize: true,
    scrollContent: true,
    keyNavigate: true,
    cycle: true
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
var icons = {
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