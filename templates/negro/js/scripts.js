var isTouch = 'ontouchstart' in document.documentElement,
wnd = $(window),
body = $('body'),
mainBody = $('.mainBody');

var optionsMenu = {
    item: $('.menu-main').find('td'),
    duration: 200,
    drop: '.frame-item-menu > .frame-drop-menu',
    countColumn:5, //if not drop-side
    effectOn: 'slideDown',
    effectOff: 'slideUp',
    durationOn: 200,
    durationOff: 50
};
var optionCompare = {
    left : '.leftDescription li',
    right : '.comprasion_tovars_frame > li',
    elEven : 'li',
    frameScroll: '.comprasion_tovars_frame',
    mouseWhell: false,
    scrollNSP: true,
    scrollNSPT: '.items-catalog',
    onlyDif: $('[data-href="#only-dif"]'),
    allParams: $('[data-href="#all-params"]'),
    hoverParent: '.characteristic'
};
icons = {
    icon_enter: "M18.386,16.009l0.009-0.006l-0.58-0.912c1.654-2.226,1.876-5.319,0.3-7.8c-2.043-3.213-6.303-4.161-9.516-2.118c-3.212,2.042-4.163,6.302-2.12,9.517c1.528,2.402,4.3,3.537,6.944,3.102l0.424,0.669l0.206,0.045l0.779-0.447l-0.305,1.377l2.483,0.552l-0.296,1.325l1.903,0.424l-0.68,3.06l1.406,0.313l-0.424,1.906l4.135,0.918l0.758-3.392L18.386,16.009z M10.996,8.944c-0.685,0.436-1.593,0.233-2.029-0.452C8.532,7.807,8.733,6.898,9.418,6.463s1.594-0.233,2.028,0.452C11.883,7.6,11.68,8.509,10.996,8.944z",
    icon_reg: "M20.771,12.364c0,0,0.849-3.51,0-4.699c-0.85-1.189-1.189-1.981-3.058-2.548s-1.188-0.454-2.547-0.396c-1.359,0.057-2.492,0.792-2.492,1.188c0,0-0.849,0.057-1.188,0.397c-0.34,0.34-0.906,1.924-0.906,2.321s0.283,3.058,0.566,3.624l-0.337,0.113c-0.283,3.283,1.132,3.68,1.132,3.68c0.509,3.058,1.019,1.756,1.019,2.548s-0.51,0.51-0.51,0.51s-0.452,1.245-1.584,1.698c-1.132,0.452-7.416,2.886-7.927,3.396c-0.511,0.511-0.453,2.888-0.453,2.888h26.947c0,0,0.059-2.377-0.452-2.888c-0.512-0.511-6.796-2.944-7.928-3.396c-1.132-0.453-1.584-1.698-1.584-1.698s-0.51,0.282-0.51-0.51s0.51,0.51,1.02-2.548c0,0,1.414-0.397,1.132-3.68H20.771z",
    icon_header_phone: "M22.065,18.53c-0.467-0.29-1.167-0.21-1.556,0.179l-3.093,3.092c-0.389,0.389-1.025,0.389-1.414,0L9.05,14.848c-0.389-0.389-0.389-1.025,0-1.414l2.913-2.912c0.389-0.389,0.447-1.075,0.131-1.524L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29c0,0-4.134,3.281-4.134,6.295c0,12.335,10,22.334,22.334,22.334c3.015,0,5.948-5.533,5.948-5.533c0.258-0.486,0.087-1.122-0.38-1.412L22.065,18.53z",
    icon_skype: "M28.777,18.438c0.209-0.948,0.318-1.934,0.318-2.944c0-7.578-6.144-13.722-13.724-13.722c-0.799,0-1.584,0.069-2.346,0.2C11.801,1.199,10.35,0.75,8.793,0.75c-4.395,0-7.958,3.562-7.958,7.958c0,1.47,0.399,2.845,1.094,4.024c-0.183,0.893-0.277,1.814-0.277,2.76c0,7.58,6.144,13.723,13.722,13.723c0.859,0,1.699-0.078,2.515-0.23c1.119,0.604,2.399,0.945,3.762,0.945c4.395,0,7.957-3.562,7.957-7.959C29.605,20.701,29.309,19.502,28.777,18.438zM22.412,22.051c-0.635,0.898-1.573,1.609-2.789,2.115c-1.203,0.5-2.646,0.754-4.287,0.754c-1.971,0-3.624-0.346-4.914-1.031C9.5,23.391,8.74,22.717,8.163,21.885c-0.583-0.842-0.879-1.676-0.879-2.479c0-0.503,0.192-0.939,0.573-1.296c0.375-0.354,0.857-0.532,1.432-0.532c0.471,0,0.878,0.141,1.209,0.422c0.315,0.269,0.586,0.662,0.805,1.174c0.242,0.558,0.508,1.027,0.788,1.397c0.269,0.355,0.656,0.656,1.151,0.89c0.497,0.235,1.168,0.354,1.992,0.354c1.135,0,2.064-0.241,2.764-0.721c0.684-0.465,1.016-1.025,1.016-1.711c0-0.543-0.173-0.969-0.529-1.303c-0.373-0.348-0.865-0.621-1.465-0.807c-0.623-0.195-1.47-0.404-2.518-0.623c-1.424-0.306-2.634-0.668-3.596-1.076c-0.984-0.419-1.777-1-2.357-1.727c-0.59-0.736-0.889-1.662-0.889-2.75c0-1.036,0.314-1.971,0.933-2.776c0.613-0.8,1.51-1.423,2.663-1.849c1.139-0.422,2.494-0.635,4.027-0.635c1.225,0,2.303,0.141,3.201,0.421c0.904,0.282,1.668,0.662,2.267,1.13c0.604,0.472,1.054,0.977,1.335,1.5c0.284,0.529,0.43,1.057,0.43,1.565c0,0.49-0.189,0.937-0.563,1.324c-0.375,0.391-0.851,0.589-1.408,0.589c-0.509,0-0.905-0.124-1.183-0.369c-0.258-0.227-0.523-0.58-0.819-1.09c-0.342-0.65-0.756-1.162-1.229-1.523c-0.463-0.351-1.232-0.529-2.292-0.529c-0.984,0-1.784,0.197-2.379,0.588c-0.572,0.375-0.85,0.805-0.85,1.314c0,0.312,0.09,0.574,0.273,0.799c0.195,0.238,0.471,0.447,0.818,0.621c0.36,0.182,0.732,0.326,1.104,0.429c0.382,0.106,1.021,0.263,1.899,0.466c1.11,0.238,2.131,0.506,3.034,0.793c0.913,0.293,1.703,0.654,2.348,1.072c0.656,0.429,1.178,0.979,1.547,1.635c0.369,0.658,0.558,1.471,0.558,2.416C23.371,20.119,23.049,21.148,22.412,22.051z",
    icon_mail: "M28.516,7.167H3.482l12.517,7.108L28.516,7.167zM16.74,17.303C16.51,17.434,16.255,17.5,16,17.5s-0.51-0.066-0.741-0.197L2.5,10.06v14.773h27V10.06L16.74,17.303z",
    icon_search: "M29.772,26.433l-7.126-7.126c0.96-1.583,1.523-3.435,1.524-5.421C24.169,8.093,19.478,3.401,13.688,3.399C7.897,3.401,3.204,8.093,3.204,13.885c0,5.789,4.693,10.481,10.484,10.481c1.987,0,3.839-0.563,5.422-1.523l7.128,7.127L29.772,26.433zM7.203,13.885c0.006-3.582,2.903-6.478,6.484-6.486c3.579,0.008,6.478,2.904,6.484,6.486c-0.007,3.58-2.905,6.476-6.484,6.484C10.106,20.361,7.209,17.465,7.203,13.885z",
    icon_cleaner: "M29.02,11.754L8.416,9.473L7.16,4.716C7.071,4.389,6.772,4.158,6.433,4.158H3.341C3.114,3.866,2.775,3.667,2.377,3.667c-0.686,0-1.242,0.556-1.242,1.242c0,0.686,0.556,1.242,1.242,1.242c0.399,0,0.738-0.201,0.965-0.493h2.512l5.23,19.8c-0.548,0.589-0.891,1.373-0.891,2.242c0,1.821,1.473,3.293,3.293,3.293c1.82,0,3.294-1.472,3.297-3.293c0-0.257-0.036-0.504-0.093-0.743h5.533c-0.056,0.239-0.092,0.486-0.092,0.743c0,1.821,1.475,3.293,3.295,3.293s3.295-1.472,3.295-3.293c0-1.82-1.473-3.295-3.295-3.297c-0.951,0.001-1.801,0.409-2.402,1.053h-7.136c-0.601-0.644-1.451-1.052-2.402-1.053c-0.379,0-0.738,0.078-1.077,0.196l-0.181-0.685H26.81c1.157-0.027,2.138-0.83,2.391-1.959l1.574-7.799c0.028-0.145,0.041-0.282,0.039-0.414C30.823,12.733,30.051,11.86,29.02,11.754zM25.428,27.994c-0.163,0-0.295-0.132-0.297-0.295c0.002-0.165,0.134-0.297,0.297-0.297s0.295,0.132,0.297,0.297C25.723,27.862,25.591,27.994,25.428,27.994zM27.208,20.499l0.948-0.948l-0.318,1.578L27.208,20.499zM12.755,11.463l1.036,1.036l-1.292,1.292l-1.292-1.292l1.087-1.087L12.755,11.463zM17.253,11.961l0.538,0.538l-1.292,1.292l-1.292-1.292l0.688-0.688L17.253,11.961zM9.631,14.075l0.868-0.868l1.292,1.292l-1.292,1.292l-0.564-0.564L9.631,14.075zM9.335,12.956l-0.328-1.24L9.792,12.5L9.335,12.956zM21.791,16.499l-1.292,1.292l-1.292-1.292l1.292-1.292L21.791,16.499zM21.207,14.5l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,14.5zM18.5,15.791l-1.293-1.292l1.292-1.292l1.292,1.292L18.5,15.791zM17.791,16.499L16.5,17.791l-1.292-1.292l1.292-1.292L17.791,16.499zM14.499,15.791l-1.292-1.292l1.292-1.292l1.292,1.292L14.499,15.791zM13.791,16.499l-1.292,1.291l-1.292-1.291l1.292-1.292L13.791,16.499zM10.499,17.207l1.292,1.292l-0.785,0.784l-0.54-2.044L10.499,17.207zM11.302,20.404l1.197-1.197l1.292,1.292L12.5,21.791l-1.131-1.13L11.302,20.404zM13.208,18.499l1.291-1.292l1.292,1.292L14.5,19.791L13.208,18.499zM16.5,19.207l1.292,1.292L16.5,21.79l-1.292-1.291L16.5,19.207zM17.208,18.499l1.292-1.292l1.291,1.292L18.5,19.79L17.208,18.499zM20.499,19.207l1.292,1.292L20.5,21.79l-1.292-1.292L20.499,19.207zM21.207,18.499l1.292-1.292l1.292,1.292l-1.292,1.292L21.207,18.499zM23.207,16.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,16.499zM25.207,14.499l1.292-1.292L27.79,14.5l-1.291,1.292L25.207,14.499zM24.499,13.792l-1.156-1.156l2.082,0.23L24.499,13.792zM21.791,12.5l-1.292,1.292L19.207,12.5l0.29-0.29l2.253,0.25L21.791,12.5zM14.5,11.791l-0.152-0.152l0.273,0.03L14.5,11.791zM10.5,11.792l-0.65-0.65l1.171,0.129L10.5,11.792zM14.5,21.207l1.205,1.205h-2.409L14.5,21.207zM18.499,21.207l1.206,1.206h-2.412L18.499,21.207zM22.499,21.207l1.208,1.207l-2.414-0.001L22.499,21.207zM23.207,20.499l1.292-1.292l1.292,1.292l-1.292,1.292L23.207,20.499zM25.207,18.499l1.292-1.291l1.291,1.291l-1.291,1.292L25.207,18.499zM28.499,17.791l-1.291-1.292l1.291-1.291l0.444,0.444l-0.429,2.124L28.499,17.791zM29.001,13.289l-0.502,0.502l-0.658-0.658l1.016,0.112C28.911,13.253,28.956,13.271,29.001,13.289zM13.487,27.994c-0.161,0-0.295-0.132-0.295-0.295c0-0.165,0.134-0.297,0.295-0.297c0.163,0,0.296,0.132,0.296,0.297C13.783,27.862,13.651,27.994,13.487,27.994zM26.81,22.414h-1.517l1.207-1.207l0.93,0.93C27.243,22.306,27.007,22.428,26.81,22.414z",
    icon_arrow_n: "M10.129,22.186 16.316,15.999 10.129,9.812 13.665,6.276 23.389,15.999 13.665,25.725z",
    icon_arrow_p: "M21.871,9.814 15.684,16.001 21.871,22.188 18.335,25.725 8.612,16.001 18.335,6.276z",
    icon_time: "M15.5,2.374C8.251,2.375,2.376,8.251,2.374,15.5C2.376,22.748,8.251,28.623,15.5,28.627c7.249-0.004,13.124-5.879,13.125-13.127C28.624,8.251,22.749,2.375,15.5,2.374zM15.5,25.623C9.909,25.615,5.385,21.09,5.375,15.5C5.385,9.909,9.909,5.384,15.5,5.374c5.59,0.01,10.115,4.535,10.124,10.125C25.615,21.09,21.091,25.615,15.5,25.623zM8.625,15.5c-0.001-0.552-0.448-0.999-1.001-1c-0.553,0-1,0.448-1,1c0,0.553,0.449,1,1,1C8.176,16.5,8.624,16.053,8.625,15.5zM8.179,18.572c-0.478,0.277-0.642,0.889-0.365,1.367c0.275,0.479,0.889,0.641,1.365,0.365c0.479-0.275,0.643-0.887,0.367-1.367C9.27,18.461,8.658,18.297,8.179,18.572zM9.18,10.696c-0.479-0.276-1.09-0.112-1.366,0.366s-0.111,1.09,0.365,1.366c0.479,0.276,1.09,0.113,1.367-0.366C9.821,11.584,9.657,10.973,9.18,10.696zM22.822,12.428c0.478-0.275,0.643-0.888,0.366-1.366c-0.275-0.478-0.89-0.642-1.366-0.366c-0.479,0.278-0.642,0.89-0.366,1.367C21.732,12.54,22.344,12.705,22.822,12.428zM12.062,21.455c-0.478-0.275-1.089-0.111-1.366,0.367c-0.275,0.479-0.111,1.09,0.366,1.365c0.478,0.277,1.091,0.111,1.365-0.365C12.704,22.344,12.54,21.732,12.062,21.455zM12.062,9.545c0.479-0.276,0.642-0.888,0.366-1.366c-0.276-0.478-0.888-0.642-1.366-0.366s-0.642,0.888-0.366,1.366C10.973,9.658,11.584,9.822,12.062,9.545zM22.823,18.572c-0.48-0.275-1.092-0.111-1.367,0.365c-0.275,0.479-0.112,1.092,0.367,1.367c0.477,0.275,1.089,0.113,1.365-0.365C23.464,19.461,23.3,18.848,22.823,18.572zM19.938,7.813c-0.477-0.276-1.091-0.111-1.365,0.366c-0.275,0.48-0.111,1.091,0.366,1.367s1.089,0.112,1.366-0.366C20.581,8.702,20.418,8.089,19.938,7.813zM23.378,14.5c-0.554,0.002-1.001,0.45-1.001,1c0.001,0.552,0.448,1,1.001,1c0.551,0,1-0.447,1-1C24.378,14.949,23.929,14.5,23.378,14.5zM15.501,6.624c-0.552,0-1,0.448-1,1l-0.466,7.343l-3.004,1.96c-0.478,0.277-0.642,0.889-0.365,1.365c0.275,0.479,0.889,0.643,1.365,0.367l3.305-1.676C15.39,16.99,15.444,17,15.501,17c0.828,0,1.5-0.671,1.5-1.5l-0.5-7.876C16.501,7.072,16.053,6.624,15.501,6.624zM15.501,22.377c-0.552,0-1,0.447-1,1s0.448,1,1,1s1-0.447,1-1S16.053,22.377,15.501,22.377zM18.939,21.455c-0.479,0.277-0.643,0.889-0.366,1.367c0.275,0.477,0.888,0.643,1.366,0.365c0.478-0.275,0.642-0.889,0.366-1.365C20.028,21.344,19.417,21.18,18.939,21.455z",
    icon_phone_footer: "M20.755,1H10.62C9.484,1,8.562,1.921,8.562,3.058v24.385c0,1.136,0.921,2.058,2.058,2.058h10.135c1.136,0,2.058-0.922,2.058-2.058V3.058C22.812,1.921,21.891,1,20.755,1zM14.659,3.264h2.057c0.101,0,0.183,0.081,0.183,0.18c0,0.1-0.082,0.18-0.183,0.18h-2.057c-0.1,0-0.181-0.081-0.181-0.18C14.478,3.344,14.559,3.264,14.659,3.264zM13.225,3.058c0.199,0,0.359,0.162,0.359,0.36c0,0.198-0.161,0.36-0.359,0.36c-0.2,0-0.36-0.161-0.36-0.36S13.025,3.058,13.225,3.058zM15.688,28.473c-0.796,0-1.44-0.646-1.44-1.438c0-0.799,0.645-1.439,1.44-1.439s1.44,0.646,1.44,1.439S16.483,28.473,15.688,28.473zM22.041,24.355c0,0.17-0.139,0.309-0.309,0.309H9.642c-0.17,0-0.308-0.139-0.308-0.309V6.042c0-0.17,0.138-0.309,0.308-0.309h12.09c0.17,0,0.309,0.138,0.309,0.309V24.355z",
    icon_exit: "M24.086,20.904c-1.805,3.113-5.163,5.212-9.023,5.219c-5.766-0.01-10.427-4.672-10.438-10.435C4.636,9.922,9.297,5.261,15.063,5.25c3.859,0.007,7.216,2.105,9.022,5.218l3.962,2.284l0.143,0.082C26.879,6.784,21.504,2.25,15.063,2.248C7.64,2.25,1.625,8.265,1.624,15.688c0.002,7.42,6.017,13.435,13.439,13.437c6.442-0.002,11.819-4.538,13.127-10.589l-0.141,0.081L24.086,20.904zM28.4,15.688l-7.15-4.129v2.297H10.275v3.661H21.25v2.297L28.4,15.688z",
    icon_times_drop: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times_remove_cart: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z",
    icon_times_remove: "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248z"
}
var genObj = {
    textEl: '.text-el',//селектор
    emptyCarthideElement: '#popupCart .inside-padd table, #shopCartPage',
    emptyCartshowElement: '#popupCart .inside-padd div.msg, #shopCartPageEmpty',
    pM: '.paymentMethod',
    trCartKit: 'tr.cartKit',
    frameCount: '.frame-count',//селектор
    countOrCompl: '.countOrCompl',//селектор
    priceOrder: '.priceOrder',
    minus: '.btn-minus > button',
    plus: '.btn-plus > button',
    parentBtnBuy: 'li, [data-rel="frameP"]',//селектор
    wishListIn: 'btn-cart',//назва класу
    compareIn: 'btn-cart',//назва класу
    toWishlist: 'toWishlist',//назва класу
    inWishlist: 'inWishlist',//назва класу
    toCompare: 'toCompare',//назва класу
    inCompare: 'inCompare',//назва класу
    tinyBask: 'tiny-bask',//назва класу
    isAvail: 'isAvail',//назва класу
    loginButton: '#loginButton',//селектор
    inCart: 'in-cart',//назва класу
    notAvail: 'not-avail',//назва класу
    btnBuy: '.btnBuy',//назва класу кнопка купити
    btnBuyCss: 'btn-buy',//назва класу
    btnCartCss: 'btn-cart',//назва класу
    descr: '.description',
    frameNumber: '.frame-number',
    frameVName: '.frame-variant-name',
    code: '.code',
    prefV: ".variant_",
    selVariant: '.variant',
    imgVC: '.vimg',
    imgVP: '.vimg',
    priceVariant: '.priceVariant',
    priceOrigVariant: '.priceOrigVariant',
    photoProduct: '.photoProduct'
}

    
function draw_icons(selIcons){
    selIcons.each(function(){
        var $this = $(this),
        $thisW = $this.width(),
        $thisH = $this.height(),
        $thisT = parseInt($this.css('margin-top')),
        $thisL = parseInt($this.css('margin-left')),
        className = $this.attr('class').match(/(icon_)/).input.split(' ')[0];
        
        var paper = Raphael($this[0], $thisW, $thisH);
        if (icons[className] != undefined){
            s = paper.path(icons[className]).attr({
                fill: $this.css('color'),
                stroke: "none"
            })
            var k = ($thisW-1)/s.getBBox().width;
            s.scale(k,k);
            s.translate(-$thisL, -$thisT)
            $this.css({
                'margin-top': 0, 
                'margin-left': 0,
                'position': 'relative'
            });
        }
    })
}

function deleteComprasionItem(el){
    var $this = el,
    $thisI = $this.parents(genObj.parentBtnBuy),
    $thisP = $this.parents('[data-equalhorizcell]').last(),
    count_products = $thisP.find(optionCompare.right),
    gen_count_products = count_products.add($thisP.siblings().find(optionCompare.right)).length,
    count_productsL = count_products.length;
    
    $thisI.remove();
        
    if (count_productsL == 1) {
        var btn = $('[data-href="#'+$thisP.attr('id')+'"],[href="#'+$thisP.attr('id')+'"]').parent();
        $thisP.find(optionCompare.left).remove();
        
        if ($.exists_nabir(btn.next())) btn.next().children().click();
        else btn.prev().children().click();
                            
        btn.remove();
    }
    if (gen_count_products == 1){
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    
    $('.frame_tabsc > div').equalHorizCell('refresh');
    if (optionCompare.onlyDif.parent().hasClass('active')) optionCompare.onlyDif.click();
    else optionCompare.allParams.click();
}
function recountWishListTotalPrise(deletedItemPrice, id, vid){
    
    var arr = JSON.parse(localStorage.getItem('wishList')) ? _.compact(JSON.parse(localStorage.getItem('wishList'))) : [],
    
    arr = _.without(arr, id+'_'+vid);                        
    localStorage.setItem('wishList', JSON.stringify(arr));
    
    var wishListTotal = $('#wishListTotal');
    wishListTotal.text((wishListTotal.text()-deletedItemPrice).toFixed(pricePrecision));
} 
function deleteWishListItem(el, id, vid){
    var deletedItemPrice = el.closest(genObj.parentBtnBuy).find(genObj.btnBuy).data('price');
    recountWishListTotalPrise(deletedItemPrice, id, vid);
    
    if (el.closest(genObj.parentBtnBuy).siblings().length == 0){
        $('[data-body="body"]').hide()
        $('[data-body="message"]').show()
    }
    el.closest(genObj.parentBtnBuy).remove();
}
function processWish() {
    //wishlist checking
    var WishList = Shop.WishList.all();
    $('.'+genObj.toWishlist).each(function () {
        if (WishList.indexOf($(this).data('prodid')+'_'+$(this).data('varid')) !== -1){
            var $this = $(this);
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
    $('.'+genObj.inWishlist).each(function () {
        if (WishList.indexOf($(this).data('prodid')+'_'+$(this).data('varid')) === -1){
            var $this = $(this);
            $this.addClass(genObj.toWishlist).removeClass(genObj.inWishlist).removeClass(genObj.wishListIn).attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
        }
    });

    //comparelist checking
    var comparelist = Shop.CompareList.all();
    $('.'+genObj.toCompare).each(function () {
        if (comparelist.indexOf($(this).data('prodid')) !== -1){
            var $this = $(this);
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).addClass(genObj.compareIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
        }
    });
    $('.'+genObj.inCompare).each(function () {
        if (comparelist.indexOf($(this).data('prodid')) === -1){
            var $this = $(this);
            $this.addClass(genObj.toCompare).removeClass(genObj.inCompare).removeClass(genObj.compareIn).attr('data-title', $this.attr('data-firtitle')).find(genObj.textEl).text($this.attr('data-firtitle'));
        }
    });
}

function processPage() {
    //update page content
    //update products count
    Shop.Cart.totalRecount();

    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');
    if (!Shop.Cart.totalCount)
        $('.'+genObj.tinyBask+'.'+genObj.isAvail).removeClass(genObj.isAvail);
    else if (Shop.Cart.totalCount && !$('.'+genObj.tinyBask).hasClass(genObj.isAvail)) {
        $('.'+genObj.tinyBask).addClass(genObj.isAvail).on('click', function () {
            initShopPage();
        })
    }

    var keys = [];
    _.each(Shop.Cart.getAllItems(), function (item) {
        keys.push(item.id + '_' + item.vId);
    });

    //update all product buttons
    $(genObj.btnBuy).each(function () {
        var $this = $(this),
        key = $this.data('prodid') + '_' + $this.data('varid');
        
        if (keys.indexOf(key) != -1) {
            $this.removeClass(genObj.btnBuyCss).addClass(genObj.btnCartCss).removeAttr('disabled').html(inCart).unbind('click').on('click', function(){
                Shop.Cart.countChanged = false;
                togglePopupCart();
            }).closest(genObj.parentBtnBuy).addClass(genObj.inCart);
        }
    });
    $(genObj.btnBuy+'.'+genObj.btnCartCss).each(function () {
        var key = $(this).data('prodid') + '_' + $(this).data('varid');
        if (keys.indexOf(key) == -1) {
            $(this).removeClass(genObj.btnCartCss).addClass(genObj.btnBuyCss).html(toCart).removeAttr('disabled').unbind('click').on('click', function(){
                Shop.Cart.countChanged = false;
                var cartItem = Shop.composeCartItem($(this));
                Shop.Cart.add(cartItem);
            }).closest(genObj.parentBtnBuy).removeClass(genObj.inCart);
        }
    });
}

function initShopPage(showWindow) {
    if (Shop.Cart.countChanged == false) {
        Shop.Cart.totalRecount();

        $('#popupCart').html(Shop.Cart.renderPopupCart()).hide();

        $('[data-rel="plusminus"]').plusminus({
            prev:'prev.children(:eq(1))',
            next:'prev.children(:eq(0))'
        });


        function chCountInCart($this) {
            var pd = $this;
            var cartItem = new Shop.cartItem({
                id:pd.data('prodid'),
                vId:pd.data('varid'),
                price:pd.data('price'),
                kit:pd.data('kit')
            });

            if (checkProdStock && pd.closest(genObj.frameCount).find('input').val() >= pd.closest(genObj.frameCount).find('input').data('max')){
                pd.closest(genObj.frameCount).find('input').val(pd.closest(genObj.frameCount).find('input').data('max'));
                pd.closest(genObj.frameCount).tooltip();
            }

            cartItem.count = pd.closest(genObj.frameCount).find('input').val();

            var word = cartItem.kit ? kits : pcs;
            pd.closest('tr').find(genObj.countOrCompl).html(word);

            Shop.Cart.chCount(cartItem, function(){});

            $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');
            totalPrice = cartItem.count * cartItem.price;
            
            pd.closest('tr').find(genObj.priceOrder).html(totalPrice.toFixed(pricePrecision));

            $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));
            
            if (pd.closest(genObj.frameCount).find('input').val() == 1)
                pd.closest(genObj.frameCount).find(genObj.minus).attr('disabled', 'disabled');
            else
                pd.closest(genObj.frameCount).find(genObj.minus).removeAttr('disabled');
        }
        // change count
        $(genObj.frameCount +' '+ genObj.minus +', '+ genObj.frameCount +' '+ genObj.plus).die('click').live('click', function(){
            chCountInCart($(this).closest('div'));
        });

        $(genObj.frameCount +'input').die('keyup').live('keyup', function(){
            chCountInCart($(this).prev('div'));
        });

        if (typeof showWindow == 'undefined' || showWindow != false)
            $('#showCart').click();
    }
};

function rmFromPopupCart(context, isKit) {
    if (typeof isKit != 'undefined' && isKit == true)
        var tr = $(context).closest(genObj.trCartKit);
    else
        var tr = $(context).closest('tr');

    var cartItem = new Shop.cartItem();
    cartItem.id = tr.data('prodid');
    cartItem.vId = tr.data('varid');

    Shop.Cart.rm(cartItem).totalRecount();
};

function togglePopupCart() {
    $('#showCart').click();
    return false;
}

function renderOrderDetails() {
    $('#orderDetails').html(_.template($('#orderDetailsTemplate').html(), {
        cart:Shop.Cart
    }));
}

function changeDeliveryMethod(id) {
    $.get('/shop/cart_api/getPaymentsMethods/' + id, function (dataStr) {
        data = JSON.parse(dataStr);
        var replaceStr = _.template('<select id="paymentMethod" name="paymentMethodId"><% _.each(data, function(item) { %><option value="<%-item.id%>"><%-item.name%></option> <% }) %></select> ', {
            data:data
        });
        $(genObj.pM).html(replaceStr);

        cuSel({
            changedEl:'#paymentMethod'
        });
    });
}


function recountCartPage() {
    var ca = $('span.cuselActive');
    Shop.Cart.shipping = parseFloat(ca.data('price'));
    Shop.Cart.shipFreeFrom = parseFloat(ca.data('freefrom'));
    delete ca;

    $('span#totalPrice').html(parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision));
    $('span#finalAmount').html(parseFloat(Shop.Cart.getFinalAmount()).toFixed(pricePrecision));
    $('span#shipping').html(parseFloat(Shop.Cart.shipping).toFixed(pricePrecision));

    $('span.curr').html(curr);
}

function emptyPopupCart() {
    $(genObj.emptyCarthideElement).hide();
    $(genObj.emptyCartshowElement).removeClass('d_n').show();
}

function checkCompareWishLink() {
    var wishListFrame = $('#wishListData'),
    compareListFrame = $('#compareListData'),
    refS = '[data-rel="ref"]',
    notRefS = '[data-rel="notref"]';
        
    if (Shop.WishList.all().length) {
        wishListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        wishListFrame.find(notRefS).addClass('d_n');
    }
    else{
        wishListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        wishListFrame.find(notRefS).removeClass('d_n');
    }

    if (Shop.CompareList.all().length) {
        compareListFrame.find(refS).removeClass('d_n').find('a').removeClass('d_n');
        compareListFrame.find(notRefS).addClass('d_n');
    }
    else {
        compareListFrame.find(refS).addClass('d_n').find('a').addClass('d_n');
        compareListFrame.find(notRefS).removeClass('d_n');
    }
}

function checkSyncs(){
    if (inServerCompare != NaN)
    {
        if (Shop.CompareList.all().length != inServerCompare)
            Shop.CompareList.sync();
    }

    if (inServerWish != NaN)
    {
        
        if (Shop.WishList.all().length != inServerWish){
            Shop.WishList.sync();
            
        }
    }
    if (inServerCart != NaN)
    {
        if (Shop.Cart.getAllItems().length != inServerCart)
            Shop.Cart.sync();
    }
};
function wishListCount(){
    $('#wishListCount').html('(' + Shop.WishList.all().length + ')');
}
function compareListCount(){
    $('#compareCount').html('(' + Shop.CompareList.all().length + ')');
}
function existsVnumber(vNumber, liBlock){
    if ($.trim(vNumber) != '') {
        var $number = liBlock.find(genObj.frameNumber).show()
        $number.find(genObj.code).html('('+vNumber+')');
    } else {
        var $number = liBlock.find(genObj.frameNumber).hide()
    }
}
function existsVnames(vName, liBlock){
    if ($.trim(vName) != '') {
        var $vname = liBlock.find(genObj.frameVName).show()
        $vname.find(genObj.code).html('('+vName+')');
    } else {
        var $vname = liBlock.find(genObj.frameVName).hide()
    }
}
function condProduct(vStock, liBlock, btnBuy){
    liBlock.removeClass(genObj.notAvail).removeClass(genObj.inCart);
        
    if (vStock == 0) liBlock.addClass(genObj.notAvail);
        
    if (btnBuy.hasClass(genObj.btnCartCss)) liBlock.addClass(genObj.inCart)
}

jQuery(document).ready(function() {

    var catUrl = window.location.pathname + window.location.search;
    catUrl = catUrl.replace('shop/category', 'smart_filter/index');

    //console.log(catUrl)

    $.ajax({
        type: "GET",
        url: catUrl,
        success: function(msg) {
        //            $('.filter').html(msg);
        //            console.log(msg);
        }
    });

    $('.formCost input[type="text"], .number input').live('keypress', function(event) {
        var key, keyChar;
        if (!event)
            var event = window.event;

        if (event.keyCode)
            key = event.keyCode;
        else if (event.which)
            key = event.which;

        if (key == null || key == 0 || key == 8 || key == 13 || key == 9 || key == 46 || key == 37 || key == 39)
            return true;
        keyChar = String.fromCharCode(key);

        if (!/\d/.test(keyChar)) {
            $(this).tooltip();
            return false;
        }
        else
            $(this).tooltip('remove');
    });
    if (ltie7) {
        ieInput()
        ieInput($('.photo-block'));
    }

    if ($.exists('.lineForm')) {
        var params = {
            changedEl: ".lineForm select",
            visRows: 100,
            scrollArrows: true
        }
        cuSel(params);
    }
    /*call plugin menuImageCms (jquery.imagecms.js)*/
    $('.menu-main').menuImageCms(optionsMenu)

    $('.drop').drop({
        overlayColor: '#000',
        overlayOpacity: '0.6',
        place: 'center',
        effon: 'fadeIn',
        effoff: 'fadeOut',
        duration: '300',
        before: function(el, dropEl) {
            //check for drop-report
            if ($(dropEl).hasClass('drop-report')) {
                $(dropEl).removeClass('left-report').removeClass('top-right-report')

                if ($(el).offset().left < 322 - $(el).outerWidth()) {
                    $(el).attr('data-placement', 'bottom left');
                    $(dropEl).addClass('left-report');
                }
                else {
                    if ($(el).data('placement') != 'top right')
                        $(el).attr('data-placement', 'bottom right');
                }
                if ($(el).data('placement') == 'top right') {
                    $(dropEl).addClass('top-right-report');
                }

                $(dropEl).find('li').remove();
                var elWrap = $(el).closest('li').clone().removeAttr('style').removeAttr('class'),
                dropEl = $(dropEl).find('.drop-content');

                //adding product info into form
                var formCont = $('#data-report');
                var productId = $(el).attr('data-prodid');
                formCont.find('input[name="ProductId"]').val(productId)

                elWrap.find('.photo').prependTo(elWrap)

                if (!dropEl.parent().hasClass('active')) {
                    if (!$.exists_nabir(dropEl.find('.frame-search-thumbail')))
                        dropEl.append('<ul class="frame-search-thumbail items"></ul>');
                    dropEl.find('.frame-search-thumbail').append(elWrap).find('.top_tovar, .btn, .frame_response, .tabs, .share_tov, .frame_tabs, #variantProd').remove().end().parent().find('[data-clone="data-report"]').remove().end().append($('[data-clone="data-report"]').clone().removeClass('d_n'));
                }
                return $(el);
            }
        },
        after: function(el, dropEl) {
            var selIcons = $('[class*=icon_]');
            draw_icons($('#popupCart').find(selIcons));
        }
    });
    $('.tabs').tabs({
        after: function(el) {
            if (el.parent().hasClass('comprasion_head')) {
                $('.frame-tabs-ref > div').equalHorizCell(optionCompare);
                if (optionCompare.onlyDif.parent().hasClass('active'))
                    optionCompare.onlyDif.click();
                else
                    optionCompare.allParams.click();
            }
        }
    });

    $('.frame-tabs-ref > div').equalHorizCell(optionCompare);
    $('[data-rel="plusminus"]').plusminus({
        prev: 'prev.children(:eq(1))',
        next: 'prev.children(:eq(0))'
    })

    try {
        $('a[rel="group"]').fancybox({
            'padding': 45,
            'margin': 0,
            'overlayOpacity': 0.7,
            'overlayColor': '#212024',
            'scrolling': 'no'
        })
    } catch (err) {}
    
    try {
        $('a.fancybox').fancybox();
    } catch (err) {}
    
    var itemThumbs = $('.item_tovar .frame_thumbs > li');
    if ($.exists_nabir(itemThumbs)) {
        itemThumbs.click(function() {
            var $this = $(this);
            $this.addClass('active').siblings().removeClass('active');
        })
        $('.fancybox-next').live('click', function() {
            $this = itemThumbs.filter('.active');
            if (!$this.is(':last-child'))
                $this.removeClass('active').next().addClass('active')
            else
                itemThumbs.first().click()
        })
        $('.fancybox-prev').live('click', function() {
            $this = itemThumbs.filter('.active');
            if (!$this.is(':first-child'))
                $this.removeClass('active').prev().addClass('active')
            else
                itemThumbs.last().click()
        })
    }
    var fr_lab_l = $('.frame-label').length;
    $('.frame-label').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': fr_lab_l - index
        })
    });
    $('#suggestions').autocomlete();
    
    $('.sub-category').each(function(){
        var $this = $(this),
        $thisH = 2 * $this.height() - $this.outerHeight(),
        $item = $this.children(),
        sumHeight = 0;
      
        $item.each(function(){
            sumHeight += $(this).outerHeight(true);
        })
      
        if (sumHeight > $thisH) $this.next().toggle(function(){
            $(this).prev().animate({
                'height': sumHeight
            }, 300);
        },
        function(){
            $(this).prev().animate({
                'height': $thisH
            }, 300);
        })
    })
    $('[data-trigger]').click(function(){
        var $thisT = $(this),
        trigger = $thisT.data('trigger'),
        $this = $(trigger);
        
        $this.trigger('click');
        if ($this.data('place') != "center")
            $('html, body').animate({
                scrollTop:$this.offset().top
            }, ($thisT.offset().top-$this.offset().top)/10)
    })
    processPage();
    checkSyncs();
    processWish();
    recountCartPage();
    var methodDeliv = $('#method_deliv');
    if (window.location.href.match(/cart/) && $.exists_nabir(methodDeliv))
        changeDeliveryMethod(methodDeliv.val());
    $('#popupCart').html(Shop.Cart.renderPopupCart())
        
    //click 'add to cart'
    $(genObj.btnBuy).on('click', function () {
        Shop.Cart.countChanged = false;
        $(this).attr('disabled', 'disabled');
        var cartItem = Shop.composeCartItem($(this));
        Shop.Cart.add(cartItem);
        return true;
    });

    if ($('#orderDetails'))
        renderOrderDetails();

    //Shop.Cart.countChanged = true;
    initShopPage(false);
    //Shop.Cart.countChanged = false;

    //shipping changing, re-render cart page
    if ($.exists_nabir(methodDeliv))
        methodDeliv.on('change', function () {
            recountCartPage();
            changeDeliveryMethod($('span.cuselActive').attr('val'));
        });

    if ($('#orderDetails'))
        renderOrderDetails();

    //shipping changing, re-render cart page
    if ($.exists_nabir(methodDeliv))
        methodDeliv.on('change', function () {
            recountCartPage();
        });

    $('#topCartCount').html(' (' + Shop.Cart.totalCount + ')');


    //    $('.'+genObj.tinyBask+'.'+genObj.isAvail).on('click', function () {
    //        initShopPage();
    //    });

    checkCompareWishLink();

    //cart content changed
    $(document).live('cart_changed', function () {

        //Shop.Cart.totalRecount();
        processPage();
        renderOrderDetails();
        if ($.exists_nabir(methodDeliv))
            recountCartPage();
        
        $('#popupCartTotal').html(Shop.Cart.totalPrice.toFixed(pricePrecision));
        if (Shop.Cart.totalCount == 0)
            emptyPopupCart();
    });


    $(document).on('after_add_to_cart', function (event) {
        initShopPage();
        Shop.Cart.countChanged = false;
    });

    $(document).on('cart_rm', function(data){
        if (!data.cartItem.kit)
            $('#popupProduct_'+data.cartItem.id+'_'+data.cartItem.vId).remove();
        else
            $('#popupKit_'+data.cartItem.kitId).remove();
    });

    $('.'+genObj.toCompare).live('click', function () {
        var id = $(this).data('prodid');
        Shop.CompareList.add(id);
    });

    $('.'+genObj.toWishlist).live('click', function () {
        var id = $(this).data('prodid');
        var vid = $(this).data('varid');
        var price = $(this).data('price');
        Shop.WishList.add(id, vid, price, $(this));
    });

    $('.'+genObj.inWishlist).live('click', function () {
        document.location.href = '/shop/wish_list';
    });

    $('.'+genObj.inCompare).live('click', function () {
        document.location.href = '/shop/compare';
    });

    /*      Wish-list event listeners       */

    $(document).on('wish_list_add', function (e) {
        if (e.dataObj.success == true) {
            wishListCount();
            var $this = $('.'+genObj.toWishlist+'[data-varid=' + e.dataObj.varid + ']'+'[data-prodid=' + e.dataObj.id + ']');
            $this.removeClass(genObj.toWishlist).addClass(genObj.inWishlist).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        checkCompareWishLink();
        $this.tooltip();
    });


    $(document).on('compare_list_add', function (e) {
        if (e.dataObj.success == true) {
            var $this = $('.'+genObj.toCompare+'[data-prodid=' + e.dataObj.id + ']')
            $this.removeClass(genObj.toCompare).addClass(genObj.inCompare).addClass(genObj.wishListIn).attr('data-title', $this.attr('data-sectitle')).find(genObj.textEl).text($this.attr('data-sectitle'));
            $this.tooltip();
        }
        compareListCount();

        checkCompareWishLink();
        $this.tooltip();
    });

    $(document).on('compare_list_add wish_list_rm compare_list_rm compare_list_sync', function () {
        checkCompareWishLink();
    });
    /*     refresh page after sync      */
    $(document).on('wish_list_sync compare_list_sync', function(){
        processWish();
        checkCompareWishLink();
    });
        
    $(document).on('compare_list_rm compare_list_sync', function () {
        compareListCount();
    });

    $(document).on('wish_list_rm wish_list_sync', function () {
        wishListCount();
    });

    $('#applyGiftCert').on('click', function(){
        $('input[name=makeOrder]').val(0);
        $('input[name=checkCert]').val(1);
        $('#makeOrderForm').ajaxSubmit({
            url:'/shop/cart_api/getGiftCert',
            success : function(data){
                try {
                    var dataObj = JSON.parse(data);

                    Shop.Cart.giftCertPrice = dataObj.cert_price;

                    if (Shop.Cart.giftCertPrice > 0)
                    {// apply certificate
                        $('#giftCertPrice').html(parseFloat(Shop.Cart.giftCertPrice).toFixed(pricePrecision)+ ' '+curr);
                        $('#giftCertSpan').show();
                    //$('input[name=giftcert], #applyGiftCert').attr('disabled', 'disabled')
                    }

                    Shop.Cart.totalRecount();
                    recountCartPage();
                } catch (e) {
                //console.error('Checking gift certificate filed. '+e.message);
                }
            }
        });

        $('input[name=makeOrder]').val(1);

        return false;
    });
    //variants
    
    $('#variantSwitcher').live('change', function () {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy);
        
        var vId = $(genObj.prefV + productId).attr('data-id'),
        vName = $(genObj.prefV + productId).attr('data-vname'),
        vPrice = $(genObj.prefV + productId).attr('data-price'),
        vOrigPrice = $(genObj.prefV + productId).attr('data-origPrice'),
        vNumber = $(genObj.prefV + productId).attr('data-number'),
        vLargeImage = $(genObj.prefV + productId).attr('data-largeImage'),
        vMainImage = $(genObj.prefV + productId).attr('data-mainImage'),
        vStock = $(genObj.prefV + productId).attr('data-stock');

        $(genObj.photoProduct).attr('href', vLargeImage);
        $(genObj.imgVP).attr('src', vMainImage).attr('alt', vName);
        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);

        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        
        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + productId + genObj.btnBuy));

        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
    });

    /**Variants in Category*/
    $('[id ^= сVariantSwitcher_]').live('change', function () {
        var productId = parseInt($(this).attr('value')),
        liBlock = $(this).closest(genObj.parentBtnBuy);
       
        var vMediumImage = liBlock.find(genObj.prefV + productId).attr('data-mediumImage'),
        vId = $(genObj.prefV + productId).attr('data-id'),
        vName = liBlock.find(genObj.prefV + productId).attr('data-vname'),
        vPrice = liBlock.find(genObj.prefV + productId).attr('data-price'),
        vOrigPrice = liBlock.find(genObj.prefV + productId).attr('data-origPrice'),
        vNumber = liBlock.find(genObj.prefV + productId).attr('data-number'),
        vStock = liBlock.find(genObj.prefV + productId).attr('data-stock');
        
    
        liBlock.find(genObj.selVariant).hide();
        liBlock.find(genObj.prefV + vId).show();
        
        liBlock.find(genObj.priceOrigVariant).html(vOrigPrice);
        liBlock.find(genObj.priceVariant).html(vPrice);
        liBlock.find(genObj.imgVC).attr('src',vMediumImage).attr('alt', vName);
    
        existsVnumber(vNumber, liBlock);
        existsVnames(vName, liBlock);
        
        condProduct(vStock, liBlock, liBlock.find(genObj.prefV + vId+genObj.btnBuy));
    });
    
    $(FilterManipulation.OnChangeSubmitSelectors).on('change', function() {
        FilterManipulation.filterSubmit();
    });

    $(FilterManipulation.OnClickSubmitSelectors).on('click', function(event) {
        event.preventDefault();
        FilterManipulation.filterSubmit();
    });

    $('span.filterLable').on('click', function() {
        var input = $(this).prev('.niceCheck').find('input').not('[disabled=disabled]');
        if (input.is(':checked')) {
            input.attr('checked', false);
            input.trigger('change');
        }
        else {
            input.attr('checked', 'checked');
            input.trigger('change');
        }
    });

    $(orderSelect.mainSelector + '.lineForm input[type="hidden"]').on('change', function() {
        orderSelect.addHiddenFields();
    });

    $('#sort').live('change', function(){
        $('input[name=order]').val($(this).val())
        $('form#filter').submit();
    });
    $('#sort2').live('change', function(){
        $('input[name=user_per_page]').val($(this).val())
        $('form#filter').submit();
    });
    
    $('.filter_by_cat').live('click', function(){
        $('input[name=category]').val($(this).attr('data-id'));
        $('form#filter').submit();      
        return false;
    })
    
    $('.del_filter_item').bind('click', function(){
        $('input#'+$(this).attr('data-id')).click();
        return false;
    })
    
    $('.del_price').bind('click', function(){
        $('input[name=lp]').val($(this).attr('def_min'));
        $('input[name=rp]').val($(this).attr('def_max'));
        $('form#filter').submit();
        return false;
    })
    
    var selIcons = $('[class*=icon_]');
    draw_icons(selIcons);

});
wnd.load(function() {   
    $('.carousel_js:not(.frame-brands):not(.baner)').myCarousel({
        item: 'li',
        prev: '.prev',
        next: '.next',
        content: '.content-carousel',
        groupButtons: '.group-button-carousel',
        before: function(){
        //            var sH = 0;
        //            var brandsImg = $('.items-brands img')
        //            if ($.exists_nabir(brandsImg.closest('.carousel_js'))){
        //                $('.items-brands img').each(function(){
        //                    var $thisH = $(this).height()
        //                    if ($thisH > sH) sH = $thisH;
        //                })
        //                $('.items-brands .helper').css('height', sH);
        //            }
        }
    });
    if ($('.cycle li').length > 1) {
        $('.cycle').cycle({
            speed: 600,
            timeout: 2000,
            fx: 'fade',
            pauseOnPagerHover: true,
            next: '.baner .next',
            prev: '.baner .prev',
            pager:      '.pager',
            pagerAnchorBuilder: function(idx, slide) {
                return '<a href="#"></a>';
            }
        }).hover(function() {
            $('.cycle').cycle('pause');
        }, function() {
            $('.cycle').cycle('resume');
        });
        $('.baner .next, .baner .prev').show();
    }
    
    function fancyboxProduct(){
        var itemThumbs = $('.item_tovar .frame_thumbs > li, .photoProduct'),
        itemThumbsL = itemThumbs.length;
        if ($.exists_nabir(itemThumbs)) {
            itemThumbs.click(function() {
                var $this = $(this);
                itemThumbs.removeClass('active');
                $this.addClass('active');
            })
            $('.fancybox-next').live('click', function(){
                var $this = itemThumbs.filter('.active'),
                $thisI = itemThumbs.index($this);
            
                if (itemThumbs.index($this) != itemThumbsL-1){
                    $this.removeClass('active');
                    $(itemThumbs[$thisI+1]).addClass('active');
                }            
                else
                    itemThumbs.first().click()
            });
            $('.fancybox-prev').live('click', function() {
                var $this = itemThumbs.filter('.active'),
                $thisI = itemThumbs.index($this);
                if (itemThumbs.index($this) != 0){
                    $this.removeClass('active')
                    $(itemThumbs[$thisI-1]).addClass('active')
                }
                else
                    itemThumbs.last().click()
            })
            $(".fancybox-wrap").unbind('mousewheel.fb');
        }
    }
    /*call function fancyboxProduct*/
    fancyboxProduct();
    
    var fr_lab_l = $('.frameLabel').length;
    $('.frameLabel').each(function(index) {
        $(this).css({
            'position': 'relative',
            'z-index': fr_lab_l - index
        })
    });
});