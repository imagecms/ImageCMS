var productPhotoCZoom = productPhotoCZoom != undefined,
productPhotoDrop = productPhotoDrop != undefined,
productPhotoFancybox = productPhotoFancybox != undefined,
hrefCategoryProduct = hrefCategoryProduct != undefined ? hrefCategoryProduct : undefined;

var orderDetails = $.exists('#orderDetails'),
//if select
//methodDeliv = $('#method_deliv'),
//if radio
methodDeliv = $('[name = "deliveryMethodId"]'),
isTouch = 'ontouchstart' in document.documentElement,
wnd = $(window),
body = $('body'),
ie = $.browser.msie,
ieV = $.browser.version,
ltie7 = ie && (ieV <= 7),
ltie8 = ie && (ieV <= 8);

var optionsMenu = {
    item: $('.menu-main').find('td'),
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
    maxC: 9,
    effectOn: 'slideDown',
    effectOff: 'slideUp',
    effectOnS: 'fadeIn',
    effectOffS: 'fadeOut',
    durationOn: 200,
    durationOff: 100,
    durationOnS: 200,
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
    item: 'li',
    prev: '.prev',
    next: '.next',
    content: '.content-carousel',
    groupButtons: '.group-button-carousel',
    vCarousel: '.vertical-carousel',
    hCarousel: '.horizontal-carousel'
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
        if ($.existsN(el.find('.carousel_js:not(.iscarousel)')))
            el.find('.carousel_js:not(.iscarousel)').myCarousel(carousel);
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
    effon: 'show',
    effoff: 'hide',
    duration: 500,
    modalPlace: '.notification',
    modalDelay: 500,
    dropContent: '.drop-content',
    animate: false,
    timeclosemodal: 1000,
    confirmSel: '#confirm',
    hrefOptions: {
        next: '#photo .next', //only in scripts
        prev: '#photo .prev', //only in scripts
        placeHref: '#photo .drop-content-photo .inside-padd',
        callback: 'onComplete',
        beforeShowHref: 'beforeShowHref',
        cycle: false
    }
};
var productStatus = {
    action: '<span class="product-status action"></span>',
    hit: '<span class="product-status hit"></span>',
    hot: '<span class="product-status nowelty"></span>',
    disc: function(disc) {
        return '<span class="product-status discount"><span class="text-el">' + disc.toFixed(0) + '%</span></span>';
    }
}
imageCmsApiDefaults = {
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
cleaverFilterObj = {
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
}
icons = {
    icon_enter: "M18.386,16.009l0.009-0.006l-0.58-0.912c1.654-2.226,1.876-5.319,0.3-7.8c-2.043-3.213-6.303-4.161-9.516-2.118c-3.212,2.042-4.163,6.302-2.12,9.517c1.528,2.402,4.3,3.537,6.944,3.102l0.424,0.669l0.206,0.045l0.779-0.447l-0.305,1.377l2.483,0.552l-0.296,1.325l1.903,0.424l-0.68,3.06l1.406,0.313l-0.424,1.906l4.135,0.918l0.758-3.392L18.386,16.009z M10.996,8.944c-0.685,0.436-1.593,0.233-2.029-0.452C8.532,7.807,8.733,6.898,9.418,6.463s1.594-0.233,2.028,0.452C11.883,7.6,11.68,8.509,10.996,8.944z",
    icon_reg: "M20.771,12.364c0,0,0.849-3.51,0-4.699c-0.85-1.189-1.189-1.981-3.058-2.548s-1.188-0.454-2.547-0.396c-1.359,0.057-2.492,0.792-2.492,1.188c0,0-0.849,0.057-1.188,0.397c-0.34,0.34-0.906,1.924-0.906,2.321s0.283,3.058,0.566,3.624l-0.337,0.113c-0.283,3.283,1.132,3.68,1.132,3.68c0.509,3.058,1.019,1.756,1.019,2.548s-0.51,0.51-0.51,0.51s-0.452,1.245-1.584,1.698c-1.132,0.452-7.416,2.886-7.927,3.396c-0.511,0.511-0.453,2.888-0.453,2.888h26.947c0,0,0.059-2.377-0.452-2.888c-0.512-0.511-6.796-2.944-7.928-3.396c-1.132-0.453-1.584-1.698-1.584-1.698s-0.51,0.282-0.51-0.51s0.51,0.51,1.02-2.548c0,0,1.414-0.397,1.132-3.68H20.771z",
    icon_skype: "M28.777,18.438c0.209-0.948,0.318-1.934,0.318-2.944c0-7.578-6.144-13.722-13.724-13.722c-0.799,0-1.584,0.069-2.346,0.2C11.801,1.199,10.35,0.75,8.793,0.75c-4.395,0-7.958,3.562-7.958,7.958c0,1.47,0.399,2.845,1.094,4.024c-0.183,0.893-0.277,1.814-0.277,2.76c0,7.58,6.144,13.723,13.722,13.723c0.859,0,1.699-0.078,2.515-0.23c1.119,0.604,2.399,0.945,3.762,0.945c4.395,0,7.957-3.562,7.957-7.959C29.605,20.701,29.309,19.502,28.777,18.438zM22.412,22.051c-0.635,0.898-1.573,1.609-2.789,2.115c-1.203,0.5-2.646,0.754-4.287,0.754c-1.971,0-3.624-0.346-4.914-1.031C9.5,23.391,8.74,22.717,8.163,21.885c-0.583-0.842-0.879-1.676-0.879-2.479c0-0.503,0.192-0.939,0.573-1.296c0.375-0.354,0.857-0.532,1.432-0.532c0.471,0,0.878,0.141,1.209,0.422c0.315,0.269,0.586,0.662,0.805,1.174c0.242,0.558,0.508,1.027,0.788,1.397c0.269,0.355,0.656,0.656,1.151,0.89c0.497,0.235,1.168,0.354,1.992,0.354c1.135,0,2.064-0.241,2.764-0.721c0.684-0.465,1.016-1.025,1.016-1.711c0-0.543-0.173-0.969-0.529-1.303c-0.373-0.348-0.865-0.621-1.465-0.807c-0.623-0.195-1.47-0.404-2.518-0.623c-1.424-0.306-2.634-0.668-3.596-1.076c-0.984-0.419-1.777-1-2.357-1.727c-0.59-0.736-0.889-1.662-0.889-2.75c0-1.036,0.314-1.971,0.933-2.776c0.613-0.8,1.51-1.423,2.663-1.849c1.139-0.422,2.494-0.635,4.027-0.635c1.225,0,2.303,0.141,3.201,0.421c0.904,0.282,1.668,0.662,2.267,1.13c0.604,0.472,1.054,0.977,1.335,1.5c0.284,0.529,0.43,1.057,0.43,1.565c0,0.49-0.189,0.937-0.563,1.324c-0.375,0.391-0.851,0.589-1.408,0.589c-0.509,0-0.905-0.124-1.183-0.369c-0.258-0.227-0.523-0.58-0.819-1.09c-0.342-0.65-0.756-1.162-1.229-1.523c-0.463-0.351-1.232-0.529-2.292-0.529c-0.984,0-1.784,0.197-2.379,0.588c-0.572,0.375-0.85,0.805-0.85,1.314c0,0.312,0.09,0.574,0.273,0.799c0.195,0.238,0.471,0.447,0.818,0.621c0.36,0.182,0.732,0.326,1.104,0.429c0.382,0.106,1.021,0.263,1.899,0.466c1.11,0.238,2.131,0.506,3.034,0.793c0.913,0.293,1.703,0.654,2.348,1.072c0.656,0.429,1.178,0.979,1.547,1.635c0.369,0.658,0.558,1.471,0.558,2.416C23.371,20.119,23.049,21.148,22.412,22.051z",
    icon_mail: "M28.516,7.167H3.482l12.517,7.108L28.516,7.167zM16.74,17.303C16.51,17.434,16.255,17.5,16,17.5s-0.51-0.066-0.741-0.197L2.5,10.06v14.773h27V10.06L16.74,17.303z",
    icon_search: "M29.772,26.433l-7.126-7.126c0.96-1.583,1.523-3.435,1.524-5.421C24.169,8.093,19.478,3.401,13.688,3.399C7.897,3.401,3.204,8.093,3.204,13.885c0,5.789,4.693,10.481,10.484,10.481c1.987,0,3.839-0.563,5.422-1.523l7.128,7.127L29.772,26.433zM7.203,13.885c0.006-3.582,2.903-6.478,6.484-6.486c3.579,0.008,6.478,2.904,6.484,6.486c-0.007,3.58-2.905,6.476-6.484,6.484C10.106,20.361,7.209,17.465,7.203,13.885z",
    icon_cleaner: "M29.02,11.754L8.416,9.473L7.16,4.716C7.071,4.389,6.772,4.158,6.433,4.158H3.341C3.114,3.866,2.775,3.667,2.377,3.667c-0.686,0-1.242,0.556-1.242,1.242c0,0.686,0.556,1.242,1.242,1.242c0.399,0,0.738-0.201,0.965-0.493h2.512l5.23,19.8c-0.548,0.589-0.891,1.373-0.891,2.242c0,1.821,1.473,3.293,3.293,3.293c1.82,0,3.294-1.472,3.297-3.293c0-0.257-0.036-0.504-0.093-0.743h5.533c-0.056,0.239-0.092,0.486-0.092,0.743c0,1.821,1.475,3.293,3.295,3.293s3.295-1.472,3.295-3.293c0-1.82-1.473-3.295-3.295-3.297c-0.951,0.001-1.801,0.409-2.402,1.053h-7.136c-0.601-0.644-1.451-1.052-2.402-1.053c-0.379,0-0.738,0.078-1.077,0.196l-0.181-0.685H26.81c1.157-0.027,2.138-0.83,2.391-1.959l1.574-7.799c0.028-0.145,0.041-0.282,0.039-0.414C30.823,12.733,30.051,11.86,29.02,11.754zM25.428,27.994c-0.163,0-0.295-0.132-0.297-0.295c0.002-0.165,0.134-0.297,0.297-0.297s0.295,0.132,0.297,0.297C25.723,27.862,25.591,27.994,25.428,27.994zM27.208,20.499l0.948-0.948l-0.318,1.578L27.208,20.499zM12.755,11.463l1.036,1.036l-1.292,1.292l-1.292-1.292l1.087-1.087L12.755,11.463zM17.253,11.961l0.538,0.538l-1.292,1.292l-1.292-1.292l0.688-0.688L17.253,11.961zM9.631,14.075l0.868-0.868l1.292,1.292l-1.292,1.292l-0.564-0.564L9.631,14.075zM9.335,12.956l-0.328-1.24L9.792,12.5L9.335,12.956zM21.791,16.499l-1.292,1.292l-1.292-1.292l1.292-1.292L21.791,16.499zM21.207,14.5l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,14.5zM18.5,15.791l-1.293-1.292l1.292-1.292l1.292,1.292L18.5,15.791zM17.791,16.499L16.5,17.791l-1.292-1.292l1.292-1.292L17.791,16.499zM14.499,15.791l-1.292-1.292l1.292-1.292l1.292,1.292L14.499,15.791zM13.791,16.499l-1.292,1.291l-1.292-1.291l1.292-1.292L13.791,16.499zM10.499,17.207l1.292,1.292l-0.785,0.784l-0.54-2.044L10.499,17.207zM11.302,20.404l1.197-1.197l1.292,1.292L12.5,21.791l-1.131-1.13L11.302,20.404zM13.208,18.499l1.291-1.292l1.292,1.292L14.5,19.791L13.208,18.499zM16.5,19.207l1.292,1.292L16.5,21.79l-1.292-1.291L16.5,19.207zM17.208,18.499l1.292-1.292l1.291,1.292L18.5,19.79L17.208,18.499zM20.499,19.207l1.292,1.292L20.5,21.79l-1.292-1.292L20.499,19.207zM21.207,18.499l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,18.499zM23.207,16.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,16.499zM25.207,14.499l1.292-1.292L27.79,14.5l-1.291,1.292L25.207,14.499zM24.499,13.792l-1.156-1.156l2.082,0.23L24.499,13.792zM21.791,12.5l-1.292,1.292L19.207,12.5l0.29-0.29l2.253,0.25L21.791,12.5zM14.5,11.791l-0.152-0.152l0.273,0.03L14.5,11.791zM10.5,11.792l-0.65-0.65l1.171,0.129L10.5,11.792zM14.5,21.207l1.205,1.205h-2.409L14.5,21.207zM18.499,21.207l1.206,1.206h-2.412L18.499,21.207zM22.499,21.207l1.208,1.207l-2.414-0.001L22.499,21.207zM23.207,20.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,20.499zM25.207,18.499l1.292-1.291l1.291,1.291l-1.291,1.292L25.207,18.499zM28.499,17.791l-1.291-1.292l1.291-1.291l0.444,0.444l-0.429,2.124L28.499,17.791zM29.001,13.289l-0.502,0.502l-0.658-0.658l1.016,0.112C28.911,13.253,28.956,13.271,29.001,13.289zM13.487,27.994c-0.161,0-0.295-0.132-0.295-0.295c0-0.165,0.134-0.297,0.295-0.297c0.163,0,0.296,0.132,0.296,0.297C13.783,27.862,13.651,27.994,13.487,27.994zM26.81,22.414h-1.517l1.207-1.207l0.93,0.93C27.243,22.306,27.007,22.428,26.81,22.414z",
    icon_arrow: "M11.166,23.963L22.359,17.5c1.43-0.824,1.43-2.175,0-3L11.166,8.037c-1.429-0.826-2.598-0.15-2.598,1.5v12.926C8.568,24.113,9.737,24.789,11.166,23.963z",
    icon_arrow_n: "M10.129,22.186 16.316,15.999 10.129,9.812 13.665,6.276 23.389,15.999 13.665,25.725z",
    icon_arrow_p: "M21.871,9.814 15.684,16.001 21.871,22.188 18.335,25.725 8.612,16.001 18.335,6.276z",
    icon_time: "M15.5,2.374C8.251,2.375,2.376,8.251,2.374,15.5C2.376,22.748,8.251,28.623,15.5,28.627c7.249-0.004,13.124-5.879,13.125-13.127C28.624,8.251,22.749,2.375,15.5,2.374zM15.5,25.623C9.909,25.615,5.385,21.09,5.375,15.5C5.385,9.909,9.909,5.384,15.5,5.374c5.59,0.01,10.115,4.535,10.124,10.125C25.615,21.09,21.091,25.615,15.5,25.623zM8.625,15.5c-0.001-0.552-0.448-0.999-1.001-1c-0.553,0-1,0.448-1,1c0,0.553,0.449,1,1,1C8.176,16.5,8.624,16.053,8.625,15.5zM8.179,18.572c-0.478,0.277-0.642,0.889-0.365,1.367c0.275,0.479,0.889,0.641,1.365,0.365c0.479-0.275,0.643-0.887,0.367-1.367C9.27,18.461,8.658,18.297,8.179,18.572zM9.18,10.696c-0.479-0.276-1.09-0.112-1.366,0.366s-0.111,1.09,0.365,1.366c0.479,0.276,1.09,0.113,1.367-0.366C9.821,11.584,9.657,10.973,9.18,10.696zM22.822,12.428c0.478-0.275,0.643-0.888,0.366-1.366c-0.275-0.478-0.89-0.642-1.366-0.366c-0.479,0.278-0.642,0.89-0.366,1.367C21.732,12.54,22.344,12.705,22.822,12.428zM12.062,21.455c-0.478-0.275-1.089-0.111-1.366,0.367c-0.275,0.479-0.111,1.09,0.366,1.365c0.478,0.277,1.091,0.111,1.365-0.365C12.704,22.344,12.54,21.732,12.062,21.455zM12.062,9.545c0.479-0.276,0.642-0.888,0.366-1.366c-0.276-0.478-0.888-0.642-1.366-0.366s-0.642,0.888-0.366,1.366C10.973,9.658,11.584,9.822,12.062,9.545zM22.823,18.572c-0.48-0.275-1.092-0.111-1.367,0.365c-0.275,0.479-0.112,1.092,0.367,1.367c0.477,0.275,1.089,0.113,1.365-0.365C23.464,19.461,23.3,18.848,22.823,18.572zM19.938,7.813c-0.477-0.276-1.091-0.111-1.365,0.366c-0.275,0.48-0.111,1.091,0.366,1.367s1.089,0.112,1.366-0.366C20.581,8.702,20.418,8.089,19.938,7.813zM23.378,14.5c-0.554,0.002-1.001,0.45-1.001,1c0.001,0.552,0.448,1,1.001,1c0.551,0,1-0.447,1-1C24.378,14.949,23.929,14.5,23.378,14.5zM15.501,6.624c-0.552,0-1,0.448-1,1l-0.466,7.343l-3.004,1.96c-0.478,0.277-0.642,0.889-0.365,1.365c0.275,0.479,0.889,0.643,1.365,0.367l3.305-1.676C15.39,16.99,15.444,17,15.501,17c0.828,0,1.5-0.671,1.5-1.5l-0.5-7.876C16.501,7.072,16.053,6.624,15.501,6.624zM15.501,22.377c-0.552,0-1,0.447-1,1s0.448,1,1,1s1-0.447,1-1S16.053,22.377,15.501,22.377zM18.939,21.455c-0.479,0.277-0.643,0.889-0.366,1.367c0.275,0.477,0.888,0.643,1.366,0.365c0.478-0.275,0.642-0.889,0.366-1.365C20.028,21.344,19.417,21.18,18.939,21.455z",
    icon_phone_header: "M22.065,18.53c-0.467-0.29-1.167-0.21-1.556,0.179l-3.093,3.092c-0.389,0.389-1.025,0.389-1.414,0L9.05,14.848c-0.389-0.389-0.389-1.025,0-1.414l2.913-2.912c0.389-0.389,0.447-1.075,0.131-1.524L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29c0,0-4.134,3.281-4.134,6.295c0,12.335,10,22.334,22.334,22.334c3.015,0,5.948-5.533,5.948-5.533c0.258-0.486,0.087-1.122-0.38-1.412L22.065,18.53z",
    icon_phone_footer: "M20.755,1H10.62C9.484,1,8.562,1.921,8.562,3.058v24.385c0,1.136,0.921,2.058,2.058,2.058h10.135c1.136,0,2.058-0.922,2.058-2.058V3.058C22.812,1.921,21.891,1,20.755,1zM14.659,3.264h2.057c0.101,0,0.183,0.081,0.183,0.18c0,0.1-0.082,0.18-0.183,0.18h-2.057c-0.1,0-0.181-0.081-0.181-0.18C14.478,3.344,14.559,3.264,14.659,3.264zM13.225,3.058c0.199,0,0.359,0.162,0.359,0.36c0,0.198-0.161,0.36-0.359,0.36c-0.2,0-0.36-0.161-0.36-0.36S13.025,3.058,13.225,3.058zM15.688,28.473c-0.796,0-1.44-0.646-1.44-1.438c0-0.799,0.645-1.439,1.44-1.439s1.44,0.646,1.44,1.439S16.483,28.473,15.688,28.473zM22.041,24.355c0,0.17-0.139,0.309-0.309,0.309H9.642c-0.17,0-0.308-0.139-0.308-0.309V6.042c0-0.17,0.138-0.309,0.308-0.309h12.09c0.17,0,0.309,0.138,0.309,0.309V24.355z",
    icon_phone_product: "M22.065,18.53c-0.467-0.29-1.167-0.21-1.556,0.179l-3.093,3.092c-0.389,0.389-1.025,0.389-1.414,0L9.05,14.848c-0.389-0.389-0.389-1.025,0-1.414l2.913-2.912c0.389-0.389,0.447-1.075,0.131-1.524L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29c0,0-4.134,3.281-4.134,6.295c0,12.335,10,22.334,22.334,22.334c3.015,0,5.948-5.533,5.948-5.533c0.258-0.486,0.087-1.122-0.38-1.412L22.065,18.53z",
    icon_exit: "M24.086,20.904c-1.805,3.113-5.163,5.212-9.023,5.219c-5.766-0.01-10.427-4.672-10.438-10.435C4.636,9.922,9.297,5.261,15.063,5.25c3.859,0.007,7.216,2.105,9.022,5.218l3.962,2.284l0.143,0.082C26.879,6.784,21.504,2.25,15.063,2.248C7.64,2.25,1.625,8.265,1.624,15.688c0.002,7.42,6.017,13.435,13.439,13.437c6.442-0.002,11.819-4.538,13.127-10.589l-0.141,0.081L24.086,20.904zM28.4,15.688l-7.15-4.129v2.297H10.275v3.661H21.25v2.297L28.4,15.688z",
    icon_times_drop: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times_cart: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_wish: "M24.132,7.971c-2.203-2.205-5.916-2.098-8.25,0.235L15.5,8.588l-0.382-0.382c-2.334-2.333-6.047-2.44-8.25-0.235c-2.204,2.203-2.098,5.916,0.235,8.249l8.396,8.396l8.396-8.396C26.229,13.887,26.336,10.174,24.132,7.971z",
    icon_wish_list: "M24.132,7.971c-2.203-2.205-5.916-2.098-8.25,0.235L15.5,8.588l-0.382-0.382c-2.334-2.333-6.047-2.44-8.25-0.235c-2.204,2.203-2.098,5.916,0.235,8.249l8.396,8.396l8.396-8.396C26.229,13.887,26.336,10.174,24.132,7.971z",
    icon_compare_list: "M21.786,12.876l7.556-4.363l-7.556-4.363v2.598H2.813v3.5h18.973V12.876zM10.368,18.124l-7.556,4.362l7.556,4.362V24.25h18.974v-3.501H10.368V18.124z",
    icon_compare: "M21.786,12.876l7.556-4.363l-7.556-4.363v2.598H2.813v3.5h18.973V12.876zM10.368,18.124l-7.556,4.362l7.556,4.362V24.25h18.974v-3.501H10.368V18.124z",
    icon_already_show: "M14.075,9.531c0,0-2.705-1.438-5.158-1.438c-2.453,0-4.862,0.593-4.862,0.593L3.971,9.869c0,0,0.19,0.19,0.528,0.53c0.338,0.336,0.486,3.741,1.838,5.094c1.353,1.354,4.82,1.396,5.963,0.676c1.14-0.718,2.241-3.466,2.241-4.693c0-0.38,0-0.676,0-0.676c0.274-0.275,1.615-0.303,1.917,0c0,0,0,0.296,0,0.676c0,1.227,1.101,3.975,2.241,4.693c1.144,0.72,4.611,0.678,5.963-0.676c1.355-1.353,1.501-4.757,1.839-5.094c0.338-0.34,0.528-0.53,0.528-0.53l-0.084-1.183c0,0-2.408-0.593-4.862-0.593c-2.453,0-5.158,1.438-5.158,1.438C16.319,9.292,14.737,9.32,14.075,9.531z",
    icon_info: "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466z M14.757,8h2.42v2.574h-2.42V8z M18.762,23.622H16.1c-1.034,0-1.475-0.44-1.475-1.496v-6.865c0-0.33-0.176-0.484-0.484-0.484h-0.88V12.4h2.662c1.035,0,1.474,0.462,1.474,1.496v6.887c0,0.309,0.176,0.484,0.484,0.484h0.88V23.622z",
    icon_home: "M27.812,16l-3.062-3.062V5.625h-2.625v4.688L16,4.188L4.188,16L7,15.933v11.942h17.875V16H27.812zM16,26.167h-5.833v-7H16V26.167zM21.667,23.167h-3.833v-4.042h3.833V23.167z",
    icon_list_cat: "M4.082,4.083v2.999h22.835V4.083H4.082zM4.082,20.306h22.835v-2.999H4.082V20.306zM4.082,13.694h22.835v-2.999H4.082V13.694zM4.082,26.917h22.835v-2.999H4.082V26.917z",
    icon_table_cat: "M4.083,14H14V4.083H4.083V14zM17,4.083V14h9.917V4.083H17zM17,26.917h9.917v-9.918H17V26.917zM4.083,26.917H14v-9.918H4.083V26.917z",
    icon_delivery: "M17.078,22.004l-1.758-4.129l-2.007,4.752l-7.519-3.289l0.174,3.905l9.437,4.374l10.909-5.365l-0.149-4.989L17.078,22.004zM29.454,6.619L18.521,3.383l-3.006,2.671l-3.091-2.359L1.546,8.199l3.795,3.048l-3.433,5.302l10.879,4.757l2.53-5.998l2.257,5.308l11.393-5.942l-3.105-4.709L29.454,6.619zM15.277,14.579l-9.059-3.83l9.275-4.101l9.608,3.255L15.277,14.579z",
    icon_payment: "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466z M17.255,23.88v2.047h-1.958v-2.024c-3.213-0.44-4.621-3.08-4.621-3.08l2.002-1.673c0,0,1.276,2.223,3.586,2.223c1.276,0,2.244-0.683,2.244-1.849c0-2.729-7.349-2.398-7.349-7.459c0-2.2,1.738-3.785,4.137-4.159V5.859h1.958v2.046c1.672,0.22,3.652,1.1,3.652,2.993v1.452h-2.596v-0.704c0-0.726-0.925-1.21-1.959-1.21c-1.32,0-2.288,0.66-2.288,1.584c0,2.794,7.349,2.112,7.349,7.415C21.413,21.614,19.785,23.506,17.255,23.88z",
    icon_comment: "M16,5.333c-7.732,0-14,4.701-14,10.5c0,1.982,0.741,3.833,2.016,5.414L2,25.667l5.613-1.441c2.339,1.317,5.237,2.107,8.387,2.107c7.732,0,14-4.701,14-10.5C30,10.034,23.732,5.333,16,5.333z",
    icon_success: "M2.379,14.729 5.208,11.899 12.958,19.648 25.877,6.733 28.707,9.561 12.958,25.308z",
    icon_error: "M26.711,14.086L16.914,4.29c-0.778-0.778-2.051-0.778-2.829,0L4.29,14.086c-0.778,0.778-0.778,2.05,0,2.829l9.796,9.796c0.778,0.777,2.051,0.777,2.829,0l9.797-9.797C27.488,16.136,27.488,14.864,26.711,14.086zM14.702,8.981c0.22-0.238,0.501-0.357,0.844-0.357s0.624,0.118,0.844,0.353c0.221,0.235,0.33,0.531,0.33,0.885c0,0.306-0.101,1.333-0.303,3.082c-0.201,1.749-0.379,3.439-0.531,5.072H15.17c-0.135-1.633-0.301-3.323-0.5-5.072c-0.198-1.749-0.298-2.776-0.298-3.082C14.372,9.513,14.482,9.22,14.702,8.981zM16.431,21.799c-0.247,0.241-0.542,0.362-0.885,0.362s-0.638-0.121-0.885-0.362c-0.248-0.241-0.372-0.533-0.372-0.876s0.124-0.638,0.372-0.885c0.247-0.248,0.542-0.372,0.885-0.372s0.638,0.124,0.885,0.372c0.248,0.247,0.372,0.542,0.372,0.885S16.679,21.558,16.431,21.799z",
    icon_edit: "M25.31,2.872l-3.384-2.127c-0.854-0.536-1.979-0.278-2.517,0.576l-1.334,2.123l6.474,4.066l1.335-2.122C26.42,4.533,26.164,3.407,25.31,2.872zM6.555,21.786l6.474,4.066L23.581,9.054l-6.477-4.067L6.555,21.786zM5.566,26.952l-0.143,3.819l3.379-1.787l3.14-1.658l-6.246-3.925L5.566,26.952z",
    icon_remove: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z"
};
var genObj = {
    popupCart: '#popupCart',
    pageCart: '.page-cart',
    pM: $('.paymentMethod'),
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
    frameDiscount: $('#discount'),
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
var cuselOptions = {
    changedEl: ".lineForm:visible select",
    visRows: 100,
    scrollArrows: false
};
var message = {
    success: function(text) {
        return '<div class = "msg"><div class = "' + genObj.scs + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    error: function(text) {
        return '<div class = "msg"><div class = "' + genObj.err + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    info: function(text) {
        return '<div class = "msg"><div class = "' + genObj.info + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    }
};
var lazyload = {
    effect: "fadeIn"
}

/*declaration shop functions*/

//variants
function tovarChangeVariant(el) {
    el = el == undefined ? body : el;
    /**Variants in Product*/
    el.find('#variantSwitcher').on('change', function() {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy),
        btnInfo = liBlock.find(genObj.prefV + productId + ' ' + genObj.infoBut),
        vId = btnInfo.attr('data-id'),
        vName = btnInfo.attr('data-vname'),
        vNumber = btnInfo.attr('data-number'),
        vPrice = btnInfo.attr('data-price'),
        vAddPrice = btnInfo.attr('data-addPrice'),
        vOrigPrice = btnInfo.attr('data-origPrice'),
        vLargeImage = btnInfo.attr('data-largeImage'),
        vMainImage = btnInfo.attr('data-mainImage'),
        vStock = btnInfo.attr('data-maxcount');
        
        if (vMainImage.search(/nophoto/) == -1){
            $(genObj.photoProduct).attr('href', vLargeImage);
            $(genObj.imgVP).attr('src', vMainImage).attr('alt', vName);
        }
        if (vOrigPrice != '')
            liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.priceAddPrice).html(vAddPrice);
        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + productId + ' ' + genObj.infoBut));
        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
    });
    /**Variants in Category*/
    el.find('[id ^= сVariantSwitcher_]').on('change', function() {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy),
        btnInfo = liBlock.find(genObj.prefV + productId + ' ' + genObj.infoBut),
        vMediumImage = btnInfo.attr('data-mediumImage'),
        vId = btnInfo.attr('data-id'),
        vName = btnInfo.attr('data-vname'),
        vPrice = btnInfo.attr('data-price'),
        vOrigPrice = btnInfo.attr('data-origPrice'),
        vAddPrice = btnInfo.attr('data-addPrice'),
        vNumber = btnInfo.attr('data-number'),
        vStock = btnInfo.attr('data-maxcount');
        
        if (vMediumImage.search(/nophoto/) == -1)
            liBlock.find(genObj.imgVC).attr('src', vMediumImage).attr('alt', vName);
        
        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
        if (vOrigPrice != '')
            liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.priceAddPrice).html(vAddPrice);
        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId + ' ' + genObj.infoBut));
    });
}
function tovarChangeCount(el) {
    el = el == undefined ? body : el;
    el.find('.frame-count-buy ' + genObj.minus + ',.frame-count-buy ' + genObj.plus).bind('click.changeCount', function() {
        var $this = $(this),
        input = $this.closest(genObj.frameChangeCount).next();
        $this.closest(genObj.frameCount).next().children().attr('data-count', input.val())
        
        $(document).trigger({ //for wishlist
            'type': 'change_count_product',
            'el': input
        });
    })
    el.find('.frame-count-buy ' + genObj.plusMinus).keyup(function(e) {
        var $this = $(this),
        condTooltip = checkProdStock && $this.val() >= $this.data('max');

        if (condTooltip)
            $this.closest(genObj.numberC).tooltip();
        
        $this.closest(genObj.frameCount).next().children().attr('data-count', $this.val())
        $(document).trigger({ //for wishlist
            'type': 'change_count_product', 
            'el': $this
        });
    });
}
function pasteItemsTovars(el) {
    el.find("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazyload
    drawIcons(el.find(selIcons));
    btnbuyInitialize(el);
    processBtnBuyCount(el);
    el.find('[data-drop]').drop($.extend({}, optionsDrop));
}
function processComp() {
    //comparelist checking
    var comparelist = Shop.CompareList.all();
    $('.' + genObj.toCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) !== -1) {
            var $this = $(this);
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
    $('.' + genObj.inCompare).each(function() {
        if (comparelist.indexOf($(this).data('prodid')) === -1) {
            var $this = $(this);
            $this.addClass(genObj.toCompare).removeClass(genObj.inCompare).parent().removeClass(genObj.compareIn).end().attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
        }
    });
}
function processWish() {
    var wishlist = wishList.all();
    $(genObj.btnWish).each(function() {
        var $this = $(this),
        $thisP = $this.parent();
        if (wishlist.indexOf($thisP.data('id') + '_' + $thisP.data('varid')) !== -1) {
            $this.addClass(genObj.wishIn);
            $this.find('.' + genObj.toWishlist).hide();
            $this.find('.' + genObj.inWishlist).show();
        }
        else {
            $this.removeClass(genObj.wishIn);
            $this.find('.' + genObj.toWishlist).show();
            $this.find('.' + genObj.inWishlist).hide();
        }
    });
}
function processCarts() {
    if ($(genObj.popupCart).is(':visible') || orderDetails) {
        if (Shop.Cart.length() == 0) {
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_b').addClass('d_n');
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_n').addClass('d_b');
        }
        else {
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockNoEmpty).removeClass('d_n').addClass('d_b');
            $(genObj.popupCart).add(genObj.pageCart).find(genObj.blockEmpty).removeClass('d_b').addClass('d_n');
        }
    }
}
function processBtnBuyCount(el) {
    //update page content
    //update products count
    el = el == undefined ? body : el;
    Shop.Cart.totalRecount();
    var keys = [];
    _.each(Shop.Cart.getAllItems(), function(item) {
        keys.push(item.id + '_' + item.vId);
    });
    //update all product buttons
    el.find(':not(.' + genObj.btnCartCss + ') ' + genObj.btnBuy).each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) != -1) {
            $this.parent().removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).children().removeAttr('disabled').find(genObj.textEl).html(inCart);
            decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
            $this.unbind('click.buy').bind('click.buy', function(e) {
                $(document).trigger('showActivity');
                initShopPage(true);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.toCart).addClass(genObj.inCart);
        }
    }).removeAttr('disabled');
    el.find('.' + genObj.btnCartCss + ' ' + genObj.btnBuy).each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) == -1) {
            $this.parent().removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).children().removeAttr('disabled').find(genObj.textEl).html(toCart)
            decorElemntItemProduct($this.closest(genObj.parentBtnBuy));
            $this.unbind('click.buy').bind('click.buy', function(e) {
                $(document).trigger('showActivity');
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem, e.button == undefined ? false : true);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart).addClass(genObj.toCart);
        }
    }).removeAttr('disabled');
    el.find('[data-rel="frameplusminus"]').each(function() {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        if (keys.indexOf(key) != -1) {
            var input = $this.find('input');
            $this.find('button').attr('disabled', 'disabled');
            input.val(JSON.parse(localStorage.getItem('cartItem_' + key)).count).attr('readonly', 'readonly').attr('disabled', 'disabled');
        }
        else {
            var input = $this.find('input');
            $this.find('button').removeAttr('disabled');
            input.removeAttr('readonly disabled').val('1');
            $this.closest(genObj.frameCount).next().children().attr('data-count', '1')
        }
    })
    $(document).trigger({
        'type': 'processPageEnd'
    });
}
function getDiscount(k) {
    //    if (!$.exists('#countDisc'))
    //        body.append('<div id="countDisc" style="position:absolute;left: 50px;top: 150px;z-index:1000;">0</div>')
    //    $('#countDisc').text(parseInt($('#countDisc').text()) + 1);
    $(document).trigger('showActivity');
    if (!discountInPopup && !k)
        return false;
    else if ($.isFunction(window.getDiscountBack)) {
        getDiscountBack(k);
    }
}
function getKitDiscount() {
    var _kit_disc = 0;
    
    $(document).trigger('showActivity');
    $.ajax({
        async: false,
        type: 'post',
        url: '/shop/cart_api/get_kit_discount',
        success: function(data) {
            _kit_disc = data;
            $(document).trigger('hideActivity');
        }
    })
    return _kit_disc;
}
function hideInfoDiscount() {
    var frameDiscountO = genObj.frameDiscount;
    frameDiscountO.empty();
    frameDiscountO.next(preloader).show(); //preloader
}
function displayInfoDiscount(tpl) {
    var frameDiscountO = genObj.frameDiscount;
    frameDiscountO.html(tpl);
    frameDiscountO.next(preloader).hide(); //preloader
    $(document).trigger('hideActivity');
}
function displayDiscount(obj) {
    var kitDiscount = parseFloat(getKitDiscount());
    kitDiscount = isNaN(kitDiscount) ? 0 : kitDiscount;
    Shop.Cart.kitDiscount = kitDiscount;
    var tempdisc = false;
    if (obj != null)
        tempdisc =  parseFloat(obj.sum_discount_product) != 0 && obj.sum_discount_product != null;
    var discC = tempdisc || parseFloat(Shop.Cart.kitDiscount) != 0;
    if (discC) {
        $(genObj.genDiscount).each(function() {
            var gend = 0;
            if (obj != null)
                gend += parseFloat(obj.sum_discount_product == null ? 0 : obj.sum_discount_product);
            gend += kitDiscount;
            $(this).html(gend.toFixed(pricePrecision));
        });
        $(genObj.genSumDiscount).each(function() {
            $(this).html(Shop.Cart.totalPriceOrigin.toFixed(pricePrecision));
        });
        $(genObj.frameCurDiscount).show();
    }
    else {
        $(genObj.frameCurDiscount).hide();
    }
    if (obj != null){
        if (parseFloat(obj.result_sum_discount_convert) > 0)
            $(genObj.frameGenDiscount).show();
        else 
            $(genObj.frameGenDiscount).hide();
    }
    else
        $(genObj.frameGenDiscount).hide();
}
function applyGift(el) {
    $(genObj.gift).find(preloader).show();
    var gift = 0;
    $.ajax({
        url: '/mod_discount/gift/get_gift_certificate',
        data: 'key=' + $('[name=giftcert]').val(),
        type: "POST",
        success: function(data) {
            if (data != '')
                gift = JSON.parse(data);
            $(genObj.gift).find(preloader).hide();
            Shop.Cart.gift = gift;
            recountCartPage(selectDeliv, methodDeliv);
        }
    });
    return false;
}

function renderGiftInput(tpl) {
    if (tpl == '')
        $(genObj.gift).empty();
    else
        $(genObj.gift).html(tpl);
}
function giftError(msg) {
    $(genObj.gift).children(genObj.msgF).remove()
    if (msg) {
        $(genObj.gift).append(message.error(msg));
        drawIcons($(genObj.gift).find(selIcons))
    }
}
function renderGiftSucces(tpl, gift) {
    $(genObj.certPrice).html(gift.value)
    $(genObj.certFrame).show()
    $(genObj.gift).children(genObj.msgF).remove();
    $(genObj.gift).html(tpl);
}
function btnbuyInitialize(el) {
    el.find(genObj.btnBuy).unbind('click.buy').bind('click.buy', function(e) {
        $(document).trigger('showActivity');
        $(this).attr('disabled', 'disabled');
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem, e.button == undefined ? false : true);
        decorElemntItemProduct($(this).closest(genObj.parentBtnBuy));
        return true;
    }).removeAttr('disabled');
}

function initShopPage(showWindow, item) {
    Shop.Cart.totalRecount();
    $(genObj.popupCart).html(Shop.Cart.renderPopupCart());
    $(genObj.tinyBask).each(function() {
        if (item) {
            var $this = $(this),
            cartLeft = $this.offset().left,
            cartTop = $this.offset().top;
            var img = $('[data-prodid="' + item.id + '"][data-varid="' + item.vId + '"]' + genObj.infoBut).closest(genObj.parentBtnBuy).find(genObj.imgVC + ',' + genObj.imgVP),
            imgL = img.offset().left,
            imgT = img.offset().top,
            len = Math.sqrt(Math.pow((cartLeft - imgL), 2) + Math.pow((cartTop - imgT), 2));
            fImg = $('<div style="width: 70px;height: 70px;display:none;position:absolute;left:' + imgL + 'px;top:' + imgT + 'px;z-index:10000;"></div>');
            fImg.append(img.clone()).appendTo(body).css('opacity', 0.5).show().animate({
                'left': cartLeft + 50, 
                top: cartTop + 150
            }, len * 1.5, function() {
                $(this).fadeOut(300, function() {
                    $(this).remove();
                });
            });
        }
    })
    if ($(genObj.popupCart).is(':visible'))
        dropBaskResize();
    if (showWindow || $(genObj.popupCart).is(':visible'))
        $(document).trigger({
            type: 'render_popup_cart',
            el: $(genObj.popupCart)
        });
    $(genObj.frameBasks + ' ' + genObj.plusMinus).plusminus({
        prev: 'prev.children(:eq(1)).children',
        next: 'prev.children(:eq(0)).children',
        ajax: true,
        after: function(e, el, input) {
            chCountInCart(el.closest(genObj.frameChangeCount), true, input);
        }
    });
    function chCountInCart($this, btn, input) {
        var pd = $this,
        cartItem = new Shop.cartItem({
            id: pd.data('prodid'),
            vId: pd.data('varid'),
            price: pd.data('price'),
            addprice: pd.data('addprice'),
            origprice: pd.data('origprice'),
            kit: pd.data('kit')
        });
        if (input == undefined)
            var input = pd.closest(genObj.frameCount).find('input');
        var inputVal = input.val(),
        condTooltip = '';
        if (!btn)
            condTooltip = checkProdStock && inputVal > input.data('max');
        else
            condTooltip = checkProdStock && inputVal >= input.data('max')

        if (condTooltip) {
            pd.closest(genObj.numberC).tooltip();
            inputVal = input.data('max');
            $(document).trigger('hideActivity');
        }
        cartItem.count = inputVal;
        Shop.Cart.chCount(cartItem, function() {
            input.focus();
        });
        var pdTrs = $('[data-id =' + pd.closest('tr[data-id]').data('id') + ']')
        pdTrs.each(function() {
            pdTr = $(this);
            var word = cartItem.kit ? kits : pcs;
            if ($.existsN(pdTr.closest(genObj.orderDetails)))
                word = cartItem.kit ? pluralStr(inputVal, plurKits) : pluralStr(inputVal, plurProd);
            pdTr.find(genObj.priceOrder).html((cartItem.count * cartItem.price).toFixed(pricePrecision));
            pdTr.find(genObj.priceAddOrder).html((cartItem.count * cartItem.addprice).toFixed(pricePrecision));
            pdTr.find(genObj.priceOrigOrder).html((cartItem.count * cartItem.origprice).toFixed(pricePrecision));
            pdTr.find(genObj.plusMinus).val(cartItem.count).text(cartItem.count);
            pdTr.find(genObj.countOrCompl).html(word);
        })
    }
    $(genObj.frameBasks + ' input').off('maxminValue').on('maxminValue', function(e){
        var e = e.event,
        $this = $(this);
        if (!e)
            var e = window.event;
        var key = e.keyCode;
        if (key == 0 || key == 8 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))
            chCountInCart($this.prev('div'));
    })
    $(genObj.frameBasks + ' input').unbind('keyup.count').on('keyup.count', function(e) {
        });
    if (showWindow) {
        togglePopupCart();
    }
}
function rmFromPopupCart(context, isKit) {
    $(document).trigger('showActivity');
    if (typeof isKit != 'undefined' && isKit == true)
        var tr = $(context).closest(genObj.trCartKit);
    else
        var tr = $(context).closest('tr');
    var cartItem = new Object();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');
    cartItem.kitId = tr.data('kitid');
    Shop.Cart.rm(cartItem).totalRecount();
}
function togglePopupCart() {
    $(document).trigger('showActivity');
    $(genObj.showCart).trigger({
        type: 'click'
    });
    return false;
}

function renderOrderDetails() {
    $(genObj.orderDetails).html(_.template($(genObj.orderDetailsTemplate).html(), {
        cart: Shop.Cart
    }));
    $(document).trigger({
        'type': 'renderorder.after', 
        'el': $(genObj.orderDetails)
    })
    initShopPage(false);
    $(document).trigger('hideActivity');
}

function changeDeliveryMethod(id, selectDeliv) {
    genObj.pM.next().show();
    $.get('/shop/cart_api/getPaymentsMethods/' + id, function(dataStr) {
        data = JSON.parse(dataStr);
        var replaceStr = '';
        if (selectDeliv)
            replaceStr = _.template('<div class="lineForm"><select id="paymentMethod" name="paymentMethodId"><% _.each(data, function(item) { %><option value="<%-item.id%>"><%-item.name%></option> <% }) %></select></div>', {
                data: data
            });
        else {
            replaceStr = _.template('<div class="frame-radio"><% var i=0 %><% _.each(data, function(item) { %> <div class="frame-label"><span class = "niceRadio b_n"><input type = "radio" name = "paymentMethodId" value = "<%-item.id%>" <% if (i == 0){ %>checked = "checked"<% i++} %> /></span><div class = "name-count"><span class = "text-el"><%-item.name%></span></div><div class="help-block"><%=item.description%></div></div> <% }) %></div>', {
                data: data
            });
        }
        genObj.pM.html(replaceStr);
        genObj.pM.next().hide();
        if (selectDeliv)
            cuselInit(genObj.pM, '#paymentMethod');
        else
            genObj.pM.nStRadio({
                wrapper: $(".frame-radio > .frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
    });
}

function recountCartPage(selectDeliv, methodDeliv) {
    var ca = "";
    if (selectDeliv)
        ca = $('span.cuselActive');
    else
        ca = methodDeliv.filter(':checked');
    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
    if ($.isFunction(window.loadCertificat) && orderDetails) {
        loadCertificat();
    }
    if ($.isFunction(window.getDiscountBack) && orderDetails) {
        hideInfoDiscount();
        getDiscount(true);
    }

    var discount = Shop.Cart.discount,
    kitDiscount = parseFloat(Shop.Cart.kitDiscount),
    finalAmount = Shop.Cart.getFinalAmount();
    if (discount != null && discount != 0)
        finalAmount = finalAmount - discount['result_sum_discount_convert'];
    if (kitDiscount != 0)
        finalAmount = finalAmount - kitDiscount;
    if (Shop.Cart.gift != undefined && Shop.Cart.gift != 0 && !Shop.Cart.gift.error)
        finalAmount = finalAmount - Shop.Cart.gift.value;
    if (finalAmount - Shop.Cart.shipping < 0)
        finalAmount = Shop.Cart.shipping;
    $(genObj.totalPrice).html(parseFloat(Shop.Cart.getTotalPriceOrigin()).toFixed(pricePrecision));
    $(genObj.finalAmount).html(parseFloat(finalAmount).toFixed(pricePrecision));
    $(genObj.finalAmountAdd).html((Shop.Cart.koefCurr * finalAmount).toFixed(pricePrecision));
    $(genObj.shipping).html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));
}
function checkSyncs() {
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }

    if (inServerCart != NaN)
    {
        if (Shop.Cart.length() != inServerCart)
            Shop.Cart.sync();
    }
    if (inServerWishList != NaN)
    {
        if (wishList.all().length != inServerWishList)
            wishList.sync();
    }
}
function countSumBask() {
    var length = Shop.Cart.length();
    if (!length) {
        $(genObj.tinyBask + '.' + genObj.isAvail).removeClass(genObj.isAvail);
        $(genObj.tinyBask + ' ' + genObj.blockEmpty).show();
        $(genObj.tinyBask + ' ' + genObj.blockNoEmpty).hide();
    }
    else if (length) {
        $(genObj.tinyBask).addClass(genObj.isAvail);
        $(genObj.tinyBask + ' ' + genObj.blockEmpty).hide();
        $(genObj.tinyBask + ' ' + genObj.blockNoEmpty).show();
    }
    $(genObj.countBask).each(function() {
        $(this).html(length);
    });
    var sumBask = parseFloat(Shop.Cart.totalRecount().totalPrice).toFixed(pricePrecision),
    addSumBask = parseFloat(Shop.Cart.totalRecount().totalAddPrice).toFixed(pricePrecision);
    Shop.Cart.koefCurr = addSumBask / sumBask;
    $(genObj.sumBask).each(function() {
        $(this).html(sumBask);
    });
    $(genObj.addSumBask).each(function() {
        $(this).html(addSumBask);
    })
    $(genObj.bask + ' ' + genObj.plurProd).each(function() {
        $(this).html(pluralStr(length, plurProd));
    });
}
function compareListCount() {
    var count = Shop.CompareList.all().length;
    if (count > 0)
        $(genObj.tinyCompareList).show()
    else
        $(genObj.tinyCompareList).hide()
    $(genObj.countTinyCompareList).each(function() {
        $(this).html(count);
    })
    Shop.CompareList.count = count;
    $(document).trigger({
        'type': 'change_count_cl'
    });
}
function wishListCount() {
    var count = wishList.all().length;
    if (count > 0) {
        $(genObj.tinyWishList).show();
    }
    else {
        $(genObj.tinyWishList).hide();
    }
    $(genObj.countTinyWishList).each(function() {
        $(this).html(count);
    });
    wishList.count = count;
    $(document).trigger({
        'type': 'change_count_wl'
    });
}
function existsVnumber(vNumber, liBlock) {
    if ($.trim(vNumber) != '') {
        var $number = liBlock.find(genObj.frameNumber).show()
        $number.find(genObj.code).html(vNumber);
    } else {
        liBlock.find(genObj.frameNumber).hide()
    }
}
function existsVnames(vName, liBlock) {
    if ($.trim(vName) != '') {
        var $vname = liBlock.find(genObj.frameVName).show()
        $vname.find(genObj.code).html(vName);
    } else {
        liBlock.find(genObj.frameVName).hide()
    }
}
function condProduct(vStock, liBlock, btnBuy) {
    liBlock.removeClass(genObj.notAvail + ' ' + genObj.inCart + ' ' + genObj.toCart);
    if (vStock == 0)
        liBlock.addClass(genObj.notAvail);
    else if (btnBuy.parent().hasClass(genObj.btnCartCss))
        liBlock.addClass(genObj.inCart)
    else
        liBlock.addClass(genObj.toCart)
}
/*declaration shop functions*/

/*declaration front functions*/
function pluralStr(i, str) {
    function plural(a) {
        if (a % 10 == 1 && a % 100 != 11)
            return 0
        else if (a % 10 >= 2 && a % 10 <= 4 && (a % 100 < 10 || a % 100 >= 20))
            return 1
        else
            return 2;
    }

    switch (plural(i)) {
        case 0:
            return str[0];
        case 1:
            return str[1];
        default:
            return str[2];
    }
}
function serializeForm(el) {
    var $this = $(el);
    return $this.data('data', $this.closest('form').serialize());
}
if (!$.isFunction($.fancybox)) {
    var loadingTimer, loadingFrame = 1;
    body.append(loading = $('<div id="fancybox-loading"><div></div></div>'));
    _animate_loading = function() {
        if (!loading.is(':visible')) {
            clearInterval(loadingTimer);
            return;
        }

        $('div', loading).css('top', (loadingFrame * -40) + 'px');
        loadingFrame = (loadingFrame + 1) % 12;
    };
    $.fancybox = function() {
        };
    $.fancybox.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.fancybox.hideActivity = function() {
        loading.hide();
    };
}
function banerResize(el) {
    $(el).each(function() {
        var $this = $(this).css('height', '');
        if ($this.hasClass('resize')) {
            var h = 0;
            $this.find('img').each(function() {
                var $thisH = $(this).height()
                h = $thisH > h ? $thisH : h;
            });
            $this.css('height', h + $this.children().outerHeight() - $this.children().height())
        }
        else {
            var img = $this.find('img');
            img.css('margin-left', -img.filter(':visible').css('max-width', 'none').actual('width') / 2);
        }
    });
}
function removePreloaderBaner(el) {
    var el = el.find('img[data-original]'),
    elL = el.length,
    i = 0;
    el.each(function() {
        var $this = $(this);
        $this.attr('src', $this.attr('data-original')).load(function() {
            $(this).fadeIn();
            $('.baner').find(preloader).remove();
            i++;
            if (i == elL) {
                banerResize('.baner:has(.cycle)');
                $('.baner').find(preloader).remove();
            }
        })
    })
}
function initCarouselJscrollPaneCycle(el) {
    el.find('.horizontal-carousel .carousel_js:not(.baner):not(.frame-scroll-pane):visible').myCarousel(carousel);
    el.find('.vertical-carousel .carousel_js:visible').myCarousel($.extend({}, carousel));
    if ($.exists(selScrollPane)) {
        el.find(selScrollPane).each(function() {
            var $this = $(this),
            api = $this.jScrollPane(scrollPane),
            api = api.data('jsp');
            $this.on('mousewheel', function(e, b, c, delta) {
                if (delta == -1 && api.getContentWidth() - api.getContentPositionX() != api.getContentPane().width())
                {
                    //            ширина блоку товару разом з мергінами
                    api.scrollByX(scrollPane.arrowButtonSpeed);
                    return false;
                }
                if (delta == 1 && api.getContentPositionX() != 0) {
                    api.scrollByX(-scrollPane.arrowButtonSpeed);
                    return false;
                }

            })
        })
    }

    var cycle = el.find('.cycle'),
    next = '.baner .next',
    prev = '.baner .prev';
    if (cycle.find('li').length > 1) {
        cycle.cycle({
            speed: 600,
            timeout: 5000, 
            fx: 'fade',
            pauseOnPagerHover: true,
            next: next,
            prev: prev,
            pager: '.pager',
            pagerAnchorBuilder: function(idx, slide) {
                return '<a href="#"></a>';
            }
        }).hover(function() {
            cycle.cycle('pause');
        }, function() {
            cycle.cycle('resume');
        });
        $(next + ',' + prev).show();
    }
    removePreloaderBaner(cycle); //cycle - parent for images
    $('.baner').each(function() {
        var $this = $(this);
        if (!$this.hasClass('resize'))
            $(this).find('img').each(function() {
                var $this = $(this);
                $this.css('margin-left', -$this.css('max-width', 'none').actual('width') / 2);
            });
    });
}
function hideDrop(drop, form, durationHideForm) {
    var drop = $(drop);
    var closedrop = setTimeout(function() {
        drop.drop('closeDrop', drop);
    }, durationHideForm - 500/*time fadeout drop see on site*/)
    setTimeout(function() {
        drop.find(genObj.msgF).hide().remove();
        form.show();
        $(document).trigger({
            type: 'dropafter', 
            el: drop, 
            dropC: drop.find(drop.data('dropContent')).first()
        });
    }, durationHideForm)

    //    if close "esc" or click on body
    $(document).off('drop.beforeClose').on('drop.beforeClose', function(e) {
        clearTimeout(closedrop);
        if (e.el.is(drop)) {
            e.el.find(genObj.msgF).hide().remove();
            form.show();
        }
    })
}
function showHidePart(el, absolute) {
    el.each(function() {
        var $this = $(this),
        $thisH = isNaN(parseInt($this.css('max-height'))) ? parseInt($this.css('height')) : parseInt($this.css('max-height')),
        $item = $this.children(),
        sumHeight = 0;
        $this.data('maxHeight', $thisH);
        $item.each(function() {
            tempH = $(this).outerHeight();
            sumHeight += tempH;
        })
        if (sumHeight > $thisH) {
            $this.css({
                'max-height': 'none', 
                'height': $thisH
            });
            var btn = $this.next(),
            textEl = btn.find(genObj.textEl);
            btn.addClass('d_i-b hidePart');
            if (!btn.is('[data-trigger]')) {
                textEl.html(textEl.data('show'))
                btn.toggle(function() {
                    var $thisB = $(this).addClass('showPart').removeClass('hidePart'),
                    textEl = $thisB.find(genObj.textEl);
                    sHH = 0;
                    $this.parents('li').children(':not(.wrapper-h)').each(function(){
                        sHH += $(this).height();
                    });
                    $thisB.prev().stop().animate({
                        'height': sumHeight
                    }, 300, function() {
                        var sH = 0;
                        $this.parents('li').children(':not(.wrapper-h)').each(function(){
                            sH += $(this).height();
                        });
                        $this.data('heightDecor', sHH);
                        var wrapperH = $this.parent().nextAll('.wrapper-h');
                        wrapperH.css({
                            'width': '100%', 
                            'height': sH
                        }).fadeIn();
                        wrapperH.addClass('active')
                        $(this).removeClass('cut-height').addClass('full-height');
                        textEl.hide().html(textEl.data('hide')).fadeIn(200)
                    });
                },
                function() {
                    var $thisB = $(this).removeClass('showPart').addClass('hidePart'),
                    textEl = $thisB.find(genObj.textEl);
                    $thisB.parent().nextAll('.wrapper-h').animate({
                        'height': $this.data('heightDecor')
                    }, 300, function(){
                        $(this).removeClass('active').fadeOut()
                    });
                    $thisB.prev().stop().animate({
                        'height': $thisH
                    }, 300, function() {
                        $(this).removeClass('full-height').addClass('cut-height');
                        textEl.hide().html(textEl.data('show')).fadeIn(200)
                    });
                });
            }
        }
    });
    if (absolute){
        var sH = 0;
        var li = el.parents('ul').children();
        li.each(function(){
            var $this = $(this);
            tempH = $this.outerHeight();
            sH = tempH > sH ? tempH : sH;
            $this.append('<div class="wrapper-h"></div>')
        }).css('height', sH)
        
    }
}
function dropBaskResize() {
    var popupCart = $(genObj.popupCart);
    $(document).trigger({
        type: 'dropafter', 
        el: popupCart, 
        dropC: popupCart.find(popupCart.data('dropContent')).first()
    });
}
function decorElemntItemProduct(el) {
    if (!el)
        el = $('.animateListItems > li');
    if ($.existsN(el.closest('.animateListItems'))) {
        function curFunc() {
            el.each(function() {
                var $thisLi = $(this),
                sumH = 0,
                sumW = 0,
                decEl = $thisLi.find('.decor-element').css('height', '100%'),
                decElH = decEl.height(),
                decElW = decEl.width(),
                noVisT = $thisLi.find('.no-vis-table'),
                noVisTL = noVisT.length,
                $thisS = $thisLi.data('pos').match(/top|bottom|left|right/)[0];
                $thisLi.css('overflow', 'hidden');
                noVisT.each(function() {
                    var $this = $(this);
                    if ($thisS) {
                        var descW = $thisLi.find('.description').width()
                        switch ($thisS) {
                            case 'top':
                                $this.parent().css('top', sumH)
                                sumH = sumH + $this.outerHeight(true);
                                break;
                            case 'left':
                                $this.parent().css({
                                    'left': descW, 
                                    'top': sumH
                                })
                                sumH = sumH + $this.outerHeight(true);
                                sumW = sumW + $this.outerWidth(true);
                                break;
                        }
                    }
                })
                $thisLi.css({
                    'width': '', 
                    'height': '',
                    'overflow': ''
                });
                switch ($thisS) {
                    case 'top':
                        decEl.css({
                            'height': sumH + decElH
                        })
                        break;
                    case 'left':
                        decEl.css({
                            'width': sumW / noVisTL + decElW, 
                            'height': sumH > decElH ? sumH : decElH
                        })
                        break;
                }
            });
            wnd.scroll(); //if lazyload
        }
        setTimeout(curFunc, 400)
    }
}

function drawIcons(selIcons) {
    selIcons.each(function() {
        var $this = $(this),
        $thisW = $this.width(),
        $thisH = $this.height(),
        $thisT = parseInt($this.css('margin-top')),
        $thisL = parseInt($this.css('margin-left')),
        className = $this.attr('class').match(/(icon_)/).input.split(' ')[0];
        if (!$.existsN($this.children('svg'))) {
            if (icons[className] != undefined) {
                var paper = Raphael($this[0], $thisW, $thisH);
                s = paper.path(icons[className]).attr({
                    fill: $this.css('color'),
                    stroke: "none"
                });
                var k = ($thisW - 1) / s.getBBox().width;
                s.scale(k, k);
                s.translate(-$thisL, -$thisT)
                $this.css({
                    'margin-top': 0,
                    'margin-left': 0,
                    'position': 'relative'
                });
            }
        }
    })
}

function itemUserToolbar() {
    this.show = function(itemsUT, btn, hideSet, btnUp) {
        btn.on('click.UT', function() {
            var $this = $(this),
            dataRel = $this.data('rel');
            setcookie('condUserToolbar', dataRel, 0, '/')
            if (dataRel == 0) {
                $this.hide().next().show();
                itemsUT.children(hideSet).hide();
                itemsUT.stop().animate({
                    'width': btn.width()
                })
            }
            else {
                $this.hide().prev().show();
                itemsUT.stop().animate({
                    'width': '100%'
                }, function() {
                    itemsUT.children(hideSet).show();
                })
            }
        }).not('.activeUT').trigger('click.UT');
        wnd.off('scroll.UT').on('scroll.UT', function() {
            if (wnd.scrollTop() > wnd.height())
                btnUp.fadeIn();
            else
                btnUp.fadeOut();
        })
        itemsUT.fadeIn();
        return itemsUT;
    },
    this.resize = function(itemsUT, btnUp) {
        var btnW = btnUp.outerWidth(true),
        bodyW = body.width(),
        itemsUT = $(itemsUT),
        itemsUTCW = itemsUT.children().width();
        if ((bodyW - itemsUTCW) / 2 > btnW && wnd.scrollTop() > wnd.height())
            btnUp.fadeIn();
        else
            btnUp.fadeOut();
        itemsUT.css('width', bodyW)
        return itemsUT;
    }
}
if (productPhotoCZoom) {
    function margZoomLens() {
        $(genObj.photoProduct).find('img').each(function() {
            var $this = $(this)
            mT = Math.ceil(($this.parent().outerHeight() - $this.height()) / 2);
            mL = Math.ceil(($this.parent().outerWidth() - $this.width()) / 2);
            $('#forCloudZomm').empty().append('.cloud-zoom-lens{margin:' + mT + 'px 0 0 ' + mL + 'px;}.mousetrap{top:' + mT + 'px !important;left:' + mL + 'px !important;}')
        })
        $('.left-product').off('mouseover', '.mousetrap').on('mouseover', '.mousetrap', function() {
            var cloudzoomlens = $('.cloud-zoom-lens');
            if (cloudzoomlens.width() > $(genObj.photoProduct).width()) {
                $(this).remove();
                cloudzoomlens.remove();
                $('#xBlock').empty();
            }
        });
    }
}
function reinitializeScrollPane(el) {
    if ($.exists(selScrollPane)) {
        wnd.on('resize.scroll', function() {
            el.find(selScrollPane).each(function() {
                $(this).jScrollPane(scrollPane);
                var api = $(this).data('jsp');
                var throttleTimeout;
                if ($.browser.msie) {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                }
                else {
                    api.reinitialise();
                }
            });
        })
    }
}
function ieInput(els) {
    if (els == undefined || els == null)
        els = $(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])');
    els.not(':hidden').not('.visited').each(function() {
        var $this = $(this);
        $this.css({
            'width': function() {
                return 2 * $this.width() - $this.outerWidth();
            },
            'height': function() {
                return 2 * $this.height() - $this.outerHeight();
            }
        }).addClass('visited');
    });
}
function onComplete(el, elS, isajax, data, elSet) {
    function resizePhoto() {
        fancyFrame.css({
            'height': elS.height() - itemGal.closest('.frame-fancy-gallery').height() - fancyTitle.outerHeight() - fancyFooter.outerHeight() - 20, 
            'padding': '10px 0'
        })
    }
    function condBtn(acA) {
        if (!cycle) {
            if (acA == 0)
                prev.attr('disabled', 'disabled');
            if (acA == itemGalL - 1)
                next.attr('disabled', 'disabled');
        }
    }
    function btnSClick(btn) {
        thumbsAP.removeClass('active');
        if (btn.is(prev))
            next.removeAttr('disabled');
        else
            prev.removeAttr('disabled');
        var curHref = mainImg.attr('src');
        acA = ($.inArray(curHref, optionsDrop.hrefOptions.thumbs));
        if (btn.is(prev)) {
            if (cycle) {
                if (acA != 0)
                    acA = acA - 1;
                else
                    acA = itemGalL - 1;
            }
            else {
                if (acA != 0)
                    acA = acA - 1;
                if (acA == 0)
                    prev.attr('disabled', 'disabled');
            }
        }
        else {
            if (cycle) {
                if (acA != itemGalL - 1)
                    acA = acA + 1;
                else
                    acA = 0;
            }
            else {
                if (acA != itemGalL - 1)
                    acA = acA + 1;
                if (acA == itemGalL - 1)
                    next.attr('disabled', 'disabled');
            }
        }
        thumbsA.eq(acA).parent().addClass('active');
        mainImg.attr('src', optionsDrop.hrefOptions.thumbs[acA]);
    }
    var next = $(optionsDrop.hrefOptions.next),
    prev = $(optionsDrop.hrefOptions.prev),
    cycle = optionsDrop.hrefOptions.cycle,
    fancyFooter = elS.find('.drop-footer').append($('.frame-prices-buy').clone(true)),
    frameThumbs = $('.frame-thumbs'),
    frameButton = frameThumbs.children('.group-button-carousel'),
    fancyTitle = elS.find('.drop-header'),
    carGal = frameThumbs.children('.content-carousel').clone(true).insertAfter(fancyTitle).wrap('<div class="frame-fancy-gallery frame-thumbs horizontal-carousel"></div>').wrap('<div class="fancy-gallery carousel_js"></div>').after(frameButton.clone()),
    itemThumbs = carGal.find('.items-thumbs'),
    itemGal = carGal.find('.items-thumbs > li'),
    itemGalL = itemGal.length,
    thumbsA = $(itemGal).find('a'),
    thumbsAP = thumbsA.parent(),
    fancyFrame = elS.find('.drop-content-photo'),
    mainImg = fancyFrame.find('img');
    
    fancyTitle.find('.title').text(elSet.title);
    elS.find(genObj.plusMinus).plusminus({
        prev: 'prev.children(:eq(1)).children',
        next: 'prev.children(:eq(0)).children',
        after: function(e, el, input) {
            if (checkProdStock && input.val() == input.data('max'))
                el.closest(genObj.numberC).tooltip();
        }
    });
    itemThumbs.removeAttr('style').children().removeAttr('style');
    if ($.existsN(itemThumbs.parent('.jcarousel-clip')))
        itemThumbs.unwrap();
    optionsDrop.hrefOptions.thumbs = new Array();
    thumbsA.each(function() {
        optionsDrop.hrefOptions.thumbs.push($(this).attr('href'))
    })

    var acA = ($.inArray(mainImg.attr('src'), optionsDrop.hrefOptions.thumbs)),
    pActEl = acA < itemGalL ? acA : acA - itemGalL,
    adding = {
        start: pActEl
    };
    
    if (itemGalL) {
        var btns = prev.add(next).removeAttr('disabled').fadeIn();

        itemGal.eq(pActEl).addClass('active');
        carGal.parent().myCarousel($.extend({}, carousel, {
            adding: adding
        }));
        thumbsA.off('click').on('click', function(e) {
            e.preventDefault();
            btns.removeAttr('disabled');
            thumbsAP.removeClass('active');
            $(this).parent().addClass('active');
            var href = $(this).attr('href'),
            acA = ($.inArray(href, optionsDrop.hrefOptions.thumbs));
            mainImg.attr('src', href);
            condBtn(acA);
        })
        next.add(prev).off('click').on('click', function(e) {
            btnSClick($(this))
        });
        condBtn(acA);
    }

    resizePhoto();
    wnd.off('resize.photo').on('resize.photo', function() {
        resizePhoto();
    });
    elS.children()[elS.data().effectOn](200);
}
function beforeShowHref(el, elS) {
    elS.children().hide();
    elS.find('.drop-content-photo .inside-padd').prepend('<span class="helper"></span>')
}
function cuselInit(el, sel){
    var el = el == undefined ? body : el,
    sel = sel == undefined ? '.lineForm:visible select' : sel;
    if ($.existsN(el.find('.lineForm:visible'))) {
        cuSel($.extend({}, cuselOptions, {
            changedEl: sel
        }));
        if (ltie7)
            ieInput(el.find('.cuselText'));
    }
}
/*/declaration front functions*/
function init() {
    /*call general functions and plugins*/
    cuselInit();
    /*call general functions and plugins*/
    
    /*call functions for shop objects*/
    checkSyncs();
    btnbuyInitialize(body);//where find
    processBtnBuyCount();
    initShopPage(false);
    countSumBask();
    tovarChangeVariant();
    //if !selectDeliv
    $(".check-variant-delivery").nStRadio({
        wrapper: $(".frame-radio > .frame-label"),
        elCheckWrap: '.niceRadio',
        //classRemove: 'b_n', //if not standart
        before: function(el) {
            $(document).trigger('showActivity');
            $('[name="' + $(el).find('input').attr('name') + '"]').attr('disabled', 'disabled');
        },
        after: function(el, start) {
            if (!start) {
                var activeVal = el.find('input').val();
                changeDeliveryMethod(activeVal, selectDeliv);
                recountCartPage(selectDeliv, methodDeliv);
                $('[name="' + $(el).find('input').attr('name') + '"]').removeAttr('disabled')
            }
        }
    });
    genObj.pM.nStRadio({
        wrapper: $(".frame-radio > .frame-label"),
        elCheckWrap: '.niceRadio'
    //,classRemove: 'b_n'//if not standart
    });
    $(document).on('discount.display', function(e) {
        displayDiscount(e.discount);
        displayInfoDiscount(e.tpl);        
    });
    if (orderDetails) {
        renderOrderDetails();
        $(document).on('discount.renderGiftInput', function(e){
            renderGiftInput(e.tpl);
        });
        $(document).on('discount.giftError', function(e){
            giftError(e.data)
        });
        $(document).on('discount.renderGiftSucces', function(e){
            renderGiftSucces(e.tpl, e.data);
        });
        recountCartPage(selectDeliv, methodDeliv);
    }
    processWish();
    processComp();
    compareListCount();
    wishListCount();
    /*/ call functions for shop objects*/
    
    if (isTouch)
        body.addClass('isTouch');
    
    /*call front plugins and functions*/
    $.onlyNumber('.number input');
    if (ltie7) {
        ieInput();
        ieInput($('.photo-block, .frame-baner-start_page .content-carousel, .cloud-zoom-lens, .items-user-toolbar'));
    }

    optionsDrop.before = function(el, dropEl, isajax) {
        var dropEl = $(dropEl);
        if (dropEl.hasClass('drop-report')) {
            var dropElRep = dropEl.find('[data-rel="pastehere"]');
            dropElRep.html(_.template($('#reportappearance').html(), {
                item: Shop.composeCartItem(el)
            }));

            dropElRep.append($('[data-clone="data-report"]').clone(true).removeClass('d_n'));
            dropElRep.find('input[name="ProductId"]').val(el.data('prodid'));
            return el;
        }
        if (dropEl.hasClass('frame-already-show')) {
            dropEl.parent().css('z-index', 1102);
        }
        dropEl.find('label.' + genObj.err + ', label.' + genObj.scs).hide();
        dropEl.find(':input').removeClass(genObj.scs + ' ' + genObj.err);
    };
    optionsDrop.after = function(el, dropEl, isajax) {
        drawIcons(dropEl.find(selIcons));

        dropEl.find("img.lazy:not(.load)").lazyload(lazyload);
        wnd.scroll(); //for lazyload

        var carouselInDrop = dropEl.find('.carousel_js');
        if ($.existsN(carouselInDrop) && !carouselInDrop.hasClass('visited') && !dropEl.is('#photo')) {
            carouselInDrop.addClass('visited')
            carouselInDrop.myCarousel(carousel);
        }
        if (dropEl.hasClass('drop-wishlist')) {
            dropEl.nStRadio({
                wrapper: $(".frame-label"),
                elCheckWrap: '.niceRadio'
            //,classRemove: 'b_n'//if not standart
            });
        }
        if ($.existsN(dropEl.find('[onsubmit*="ImageCMSApi"]'))) {
            var input = dropEl.find('form input[type="text"]:first');
            input.setCursorPosition(input.val().length);
        }
        cuselInit(dropEl, '.drop:visible .lineForm select');
    };
    optionsDrop.close = function(el, dropEl) {};
    optionsDrop.closed = function(el, dropEl) {
        var dC = $(dropEl.find(dropEl.data('dropContent'))).data('jsp');
        if (dC != undefined)
            dC.destroy();
        if ($(dropEl).hasClass('frame-already-show'))
            $('.frame-user-toolbar').css({
                'width': body.width(), 
                'z-index': 100
            })
        if ($('#fancybox-wrap').is(':visible'))
            $.drop('scrollEmulate')();
        if ($(dropEl).is('#photo')) {
            $(dropEl).find('.drop-header .title').empty().end().find('.frame-fancy-gallery').remove().end().find('.frame-prices-buy').remove().end().find('.drop-content-photo .inside-padd').empty();
        }
    }
    $('.menu-main').menuImageCms(optionsMenu);
    $('.footer-category-menu').find('[href="' + $('.frame-item-menu.active > .frame-title > .title').attr('href') + '"]').parent().addClass('active');
    $('[data-drop]').drop($.extend({}, optionsDrop));
    $('.tabs').tabs({
        after: function(el) {
            if (el.hasClass('tabs-compare-category')) {
                optionCompare.compareChangeCategory();
            }
            if (el.hasClass('tabs-list-table')) {
                decorElemntItemProduct();
            }
            if (el.hasClass('tabs-product')) {
                showHidePart($('.patch-product-view'));
                showHidePart($('.frame-list-comment__icsi-css.sub-2'));
            }
        }
    });
    
    /*changecount product in category and product*/
    $('.items-catalog '+genObj.plusMinus + ', .item-product '+genObj.plusMinus).plusminus({
        prev: 'prev.children(:eq(1)).children',
        next: 'prev.children(:eq(0)).children',
        after: function(e, el, input) {
            if (checkProdStock && input.val() == input.data('max'))
                el.closest(genObj.numberC).tooltip();
        }
    });
    tovarChangeCount();
    /*/changecount product in category and product*/
    
    $('#suggestions').autocomplete({
        minValue: 3,
        blockEnter: false        
    });
    drawIcons($(selIcons));
    showHidePart($('.sub-category'));
    showHidePart($('.patch-product-view'));
    showHidePart($('.frame-list-comment__icsi-css.sub-2'));
    var userTool = new itemUserToolbar(),
    btnToUp = $('.btn-to-up');
    btnToUp.click(function() {
        $("html, body").animate({
            scrollTop: "0"
        });
    })
    userTool.show($('.items-user-toolbar'), $('.btn-toggle-toolbar > button'), '.box-1, .box-2, .box-3', btnToUp);
    userTool.resize($('.frame-user-toolbar'), btnToUp);
    if ($.existsN($('.animateListItems.table')))
        decorElemntItemProduct();
    var frLabL = $('.frame-label').length;
    $('.frame-label:has(.lineForm)').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': frLabL - index
        })
    });
    initCarouselJscrollPaneCycle(body);
    if ($.exists(optionCompare.frameCompare))
        $(optionCompare.frameCompare).equalHorizCell(optionCompare); //because rather call and call carousel twice
    reinitializeScrollPane(body);
    $("img.lazy").lazyload(lazyload);
    wnd.scroll(); //for lazy load start initialize
    if (productPhotoCZoom) {
        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
        body.append('<style id="forCloudZomm"></style>')
        margZoomLens();
        $(genObj.photoProduct).find('img').load(function() {
            margZoomLens();
        })
    }
    if (productPhotoFancybox && !productPhotoCZoom && !productPhotoDrop) {
        try {
            var frameAddImgThumb = $('[data-rel="mainThumbPhoto"]').children();
            if (!$(genObj.photoProduct).is('[rel="group"]'))
                $(genObj.photoProduct).click(function(e) {
                    e.preventDefault();
                    frameAddImgThumb.find('a').click();
                })
            $('[rel="group"]').fancybox({
                'padding': 5,
                'margin': 0,
                'overlayOpacity': 0.7,
                'overlayColor': '#212024',
                'autoDimensions': false,
                'width': wnd.width() * 0.95,
                'height': wnd.height() * 0.90,
                'type': 'iframe',
                'titlePosition': 'inside',
                'onComplete': function() {
                    $.drop('scrollEmulate')();
                    var fancyC = $('#fancybox-content');
                    fancyC.prepend('<div class="wOverlay"></div>');
                    fancyC.append('<div class="fancy-footer"></div>');
                    var fancyFooter = $('.fancy-footer').append($('.frame-prices-buy').clone(true)),
                    frameThumbs = $('.frame-thumbs'),
                    frameButton = frameThumbs.children('.group-button-carousel')
                    carGal = frameThumbs.children('.content-carousel').clone(true).prependTo(fancyC).wrap('<div class="frame-fancy-gallery frame-thumbs horizontal-carousel"></div>').wrap('<div class="fancy-gallery carousel_js"></div>').after(frameButton.clone()),
                    fancyTitle = $('#fancybox-title');
                    fancyC.find(genObj.plusMinus).plusminus({
                        prev: 'prev.children(:eq(1)).children',
                        next: 'prev.children(:eq(0)).children',
                        after: function(e, el, input) {
                            if (checkProdStock && input.val() == input.data('max'))
                                el.closest(genObj.numberC).tooltip();
                        }
                    });
                    var itemThumbs = carGal.find('.items-thumbs');
                    itemThumbs.removeAttr('style').children().removeAttr('style').end().prepend(frameAddImgThumb.clone(true).removeClass('d_n'));
                    if ($.existsN(itemThumbs.parent('.jcarousel-clip')))
                        itemThumbs.unwrap();
                    fancyTitle.prependTo(fancyC);
                    var itemGal = carGal.find('.items-thumbs > li'),
                    itemGalL = itemGal.length;
                    var pActEl = arguments[1] < itemGalL ? arguments[1] : arguments[1] - itemGalL;
                    var adding = {
                        start: pActEl
                    }
                    itemGal.eq(pActEl).addClass('active');
                    carGal.parent().myCarousel($.extend($.extend({}, carousel), {
                        adding: adding
                    }));
                    var fancyFrame = $('#fancybox-frame');
                    fancyFrame.css({
                        'height': fancyFrame.height() - itemGal.closest('.frame-fancy-gallery').height() - fancyTitle.outerHeight() - fancyFooter.outerHeight() - 20, 
                        'padding': '10px 0'
                    })

                    fancyFrame.load(function() {
                        var $this = $(this.contentWindow.document.getElementsByTagName('body')[0]);
                        $this.append('<style>' + forThumbFancybox + '</style>');
                        $this.find('img').before('<span class="helper"></span>');
                        $('.wOverlay').fadeOut(200);
                    })
                    $("#fancybox-wrap").unbind('mousewheel.fb');
                },
                onClosed: function() {
                    $.drop('scrollEmulateRemove')();
                }
            })

        } catch (e) {
        }
    }
    /*/call front plugins and functions*/
    
    /*sample of events shop*/
    if ($.existsN(methodDeliv) && selectDeliv)
        methodDeliv.on('change.methoddeliv', function() {
            var activeVal = $('span.cuselActive').attr('val');
            changeDeliveryMethod(activeVal, selectDeliv);
            recountCartPage(selectDeliv, methodDeliv);
        });
    var catalogForm = $('#catalog_form')
    $('#sort').on('change.orderproducts', function() {
        $('input[name=order]').val($(this).val())
        catalogForm.submit();
    });
    $('#sort2').on('change.countvisibleproducts', function() {
        $('input[name=user_per_page]').val($(this).val())
        catalogForm.submit();
    });
    $(document).on('render_popup_cart', function() {
        if (!orderDetails)
            getDiscount(false);
        if (orderDetails)
            recountCartPage(selectDeliv, methodDeliv);
    })

    $(document).on('sync_cart', function() {
        if (orderDetails) {
            renderOrderDetails();
            //shipping changing, re-render cart page
            recountCartPage(selectDeliv, methodDeliv);
        }
        processCarts();
        processBtnBuyCount();
        countSumBask();
        initShopPage(false);
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    })

    $('#bask_block').on('click.toTiny', genObj.tinyBask + '.' + genObj.isAvail, function() {
        initShopPage(true);
    })
    $(document).on('cart_changed', function() {
        processCarts();
        processBtnBuyCount();
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    });
    $(document).on('cart_clear', function() {
        initShopPage(false);
        countSumBask();
    });
    $(document).on('count_changed', function() {
        if (!orderDetails)
            getDiscount(false);
        if (orderDetails)
            recountCartPage(selectDeliv, methodDeliv);
        countSumBask();
    });
    $(document).on('after_add_to_cart', function(e) {
        initShopPage(e.show);
        //initShopPage(false, e.cartItem); //for animate img to tinybask
        getDiscount(false);
        countSumBask();
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
    });
    $(document).on('cart_rm', function(data) {
        if (!data.cartItem.kitId)
            $('[data-id="popupProduct_' + data.cartItem.id + '_' + data.cartItem.vId + '"]').remove();
        else
            $('[data-id="popupKit_' + data.cartItem.kitId + '"]').remove();
        processCarts();
        countSumBask();
        dropBaskResize();
        if (Shop.Cart.length() > 0)
            getDiscount(false);
        if (orderDetails)
            recountCartPage(selectDeliv, methodDeliv)
    });
    $(genObj.parentBtnBuy).on('click.toCompare', '.' + genObj.toCompare,  function() {
        $(document).trigger('showActivity');
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });
    $(genObj.parentBtnBuy).on('click.inCompare', '.' + genObj.inCompare, function() {
        document.location.href = '/shop/compare';
    });
    $(document).on('compare_list_add', function(e) {
        if (e.dataObj.success == true) {
            var $this = $('.' + genObj.toCompare + '[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).parent().addClass(genObj.compareIn).end().attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        $this.tooltip();
    });
    $(document).on('compare_list_add compare_list_rm compare_list_sync', function() {
        $(document).trigger('hideActivity');
        compareListCount();
    });
    $(document).on('compare_list_sync', function() {
        processComp();
    });
    $(document).on('wish_list_sync', function() {
        processWish();
        wishListCount();
    });
    $(document).on('change_count_cl change_count_wl', function(e) {
        if (wishList.count + Shop.CompareList.count + countViewProd > 0)
            $('.content-user-toolbar').fadeIn()
        else
            $('.content-user-toolbar').fadeOut()
    });
    
    /*/sample of events shop/*/
    
    /*sample of events front*/
    $(document).on('lazy.after', function(e) {
        e.el.addClass('load');
    });
    $(document).on('dropafter', function(e) {
        var wndH = wnd.height(),
        el = e.dropC,
        elDrop = e.el;
        if ($.existsN(el)) {
            el.jScrollPane(scrollPane);
            var elC = el.find('.jspPane'),
            elCH = elC.outerHeight(),
            api = el.data('jsp');
            var footerHeader = elDrop.find('.drop-header').outerHeight(true) + elDrop.find('.drop-footer').outerHeight(true);
            if (elDrop.data('place') != 'center' && elDrop.data('place') != 'inherit') {
                if (elDrop.data('placement').search(/top/) == 0) {
                    var mayHeight = $(document).height() - elDrop.offset().top - footerHeader;
                    if (mayHeight > elCH)
                        el.css('height', elCH)
                    else
                        el.css('height', mayHeight - 20)
                    if (el.outerHeight() == elCH)
                        api.destroy();
                }
                if (elDrop.data('placement').search(/bottom/) == 0) {
                    el.css('height', '');
                    var refer = $('[data-drop="' + elDrop.data('elrun') + '"]'),
                    mayHeight = refer.offset().top - wnd.scrollTop() - footerHeader - 40,
                    minh = parseInt(el.css('height'));
                    if (mayHeight > elCH)
                        el.css('height', elCH)
                    else
                        el.css('height', mayHeight < minh ? minh : mayHeight)
                    if (el.outerHeight() == elCH)
                        api.destroy();
                    $.drop('positionDrop')(refer);
                }
            }
            else {
                if (elCH + footerHeader > wndH)
                    el.css('height', wndH - footerHeader - 40);
                else
                    el.css('height', elCH);
            }
            api.reinitialise();
            $.drop('dropCenter')(elDrop);
        }
    });
    $(document).on('tabs.beforeload', function(e) {
        e.els.filter('.active').append('<div class="' + preloader.replace('.', '') + '"></div>')
    });
    $(document).on('tabs.afterload', function(e) {
        pasteItemsTovars(e.el);
        e.els.find(preloader).remove();
    });
    //    if carousel in compare
    //    $('#compare').change(function() {
    //        var $this = $(this);
    //        $($this.val()).siblings().hide().end().show();
    //        optionCompare.compareChangeCategory();
    //    }).change();

    $(document).on('autocomplete.fewLength', function(e) {
        e.el.tooltip({
            'title': text.search(e.value)
        });
    });
   
    var dropContentTimeout = "";
    wnd.on('resize.dropContent', function() {
        clearTimeout(dropContentTimeout);
        setTimeout(function() {
            $('[data-elrun]:visible').each(function() {
                var $this = $(this),
                dropContent = $this.find($this.data('dropContent'));
                if ($.existsN(dropContent))
                    $(document).trigger({
                        type: 'dropafter', 
                        el: $this, 
                        dropC: dropContent
                    })
            })
        }, 300)
    });
    if (productPhotoCZoom || productPhotoDrop) {
        $('.item-product .items-thumbs > li > a').on('click.thumb', function(e) {
            e.preventDefault();
            var $this = $(this);
            $this.parent().siblings().removeClass('active').end().addClass('active');
        });
    }
    if ((!productPhotoDrop && !productPhotoCZoom && !productPhotoDrop) || productPhotoDrop) {
        $('.item-product .items-thumbs > li > a').on('click.thumb', function(e) {
            e.preventDefault();
            var $this = $(this);
            $(genObj.photoProduct).attr('href', $this.attr('href')).find('img').attr('src', $this.attr('href')).end().click(function(e) {
                e.preventDefault()
            });
            if (productPhotoDrop) {
                $(genObj.photoProduct).data({
                    'effectOn': 'fadeIn',
                    'drop': '#photo', 
                    'href': $(genObj.photoProduct).attr('href'), 
                    title: $(genObj.photoProduct).attr('title')
                }).drop(optionsDrop);
            }
        });
    }
    if (productPhotoDrop) {
        $(genObj.photoProduct).data({
            'effectOn': 'fadeIn',
            'drop': '#photo', 
            'href': $(genObj.photoProduct).attr('href'), 
            title: $(genObj.photoProduct).attr('title')
        }).drop(optionsDrop);
    }
    if (productPhotoDrop && productPhotoCZoom) {
        $('.left-product').on('click.mousetrap', '.mousetrap', function() {
            var $this = $(this),
            prev = $this.prev();
            $this.data({
                'effectOn': 'fadeIn',
                'drop': '#photo', 
                'href': prev.attr('href'), 
                title: prev.attr('title')
            }).drop(optionsDrop).trigger('click.drop');
        });
    }
    try {
        $('a.fancybox').fancybox();
    } catch (e) {
    }
    $(document).on('drop.successJson', function(e) {
        if (e.el.is('#notification')) {
            if (e.datas.answer == "success")
                e.el.find(optionsDrop.modalPlace).empty().append(message.success(e.datas.data))
            else
                e.el.find(optionsDrop.modalPlace).empty().append(message.error(e.datas.data))
        }
    });
    $(document).on('rendercomment.after', function(e) {
        showHidePart(e.el.find('.frame-list-comment__icsi-css.sub-2'));
        showHidePart(e.el.find('.product-comment'));
        e.el.find(preloader).remove();
    });
    $(document).on('render_popup_cart autocomplete.after rendercomment.after imageapi.pastemsg showCleaverFilter tabs.afterload renderorder.after', function(e) {
        if (e.el.is(':visible'))
            drawIcons(e.el.find(selIcons))
    });
    $(document).on('imageapi.pastemsg imageapi.hidemsg', function(e) {
        var $this = e.el.closest('[data-elrun]'),
        dropContent = $this.find($this.data('dropContent'));
        $(document).trigger({
            type: 'dropafter', 
            el: $this, 
            dropC: dropContent
        });
    });
    $(document).on('autocomplete.before showActivity before_sync_cart', function(e) {
        $.fancybox.showActivity();
    })
    $(document).on('autocomplete.after dropafter drop.hide hideActivity sync_cart end_sync_cart cart_changed', function(e) {
        $.fancybox.hideActivity();
    })

    $(document).on('comments.showformreply tabs.showtabs dropafter', function(e) {
        if (ltie7)
            ieInput(e.el.find(':input:not(button):not([type="button"]):not([type="reset"]):not([type="submit"])'));
    })
    $(document).on('comments.beforeshowformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css({
            'max-height': 'none', 
            'height': 'auto'
        });
        var sumH = (patchCom.outerHeight() > patchCom.data('maxHeight') ? patchCom.data('maxHeight') : patchCom.outerHeight()) + e.el.outerHeight();
        patchCom.css({
            'height': sumH, 
            'max-height': sumH
        })
    })
    $(document).on('comments.beforehideformreply', function(e) {
        var patchCom = e.el.closest('.patch-product-view');
        patchCom.css('max-height', patchCom.data('maxHeight'))
    })
    $(document).on('menu.showDrop', function(e) {
        if (ltie7)
            ieInput($('.frame-drop-menu .frame-l2 > ul > li'));
    });
    body.on('click.trigger', '[data-trigger]', function(e) {
        var $thisT = $(this);
        $($thisT.data('trigger')).trigger({
            type: "click",
            scroll: $thisT.data('scroll') != undefined || false,
            trigger: true
        });
    });
    $(document).on('widget_ajax', function(e) {
        initCarouselJscrollPaneCycle(e.el);
        reinitializeScrollPane(e.el);
        pasteItemsTovars(e.el);
    });
    /*/sample of events front*/

    wnd.focus(function() {
        processBtnBuyCount();
        checkSyncs();
        processComp();
        processWish();
        compareListCount();
        wishListCount();
        
        //initShopPage(false);
        if ($(genObj.popupCart).is(':visible'))
            $.drop('closeDrop')($(genObj.popupCart))
        
        processCarts();
        countSumBask();
        if (orderDetails) {
            renderOrderDetails();
            recountCartPage(selectDeliv, methodDeliv);
        }
    })
}
var genTimeout = "";
wnd.resize(function() {
    clearTimeout(genTimeout);
    genTimeout = setTimeout(function() {
        var userTool = new itemUserToolbar();
        userTool.resize($('.frame-user-toolbar'), $('.btn-to-up'));
        $('.menu-main').menuImageCms('refresh');
        if ($.exists(optionCompare.frameCompare))
            $(optionCompare.frameCompare).equalHorizCell('refresh', optionCompare);
        banerResize('.baner:has(.cycle)');
    }, 300)
});