function escapeHtml(unsafe) {
    return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
    .join('0');
}
return s.join(dec);
}

function checkLenghtStr(id, lenLeft, lenRight, key) {
    if (key != 37 && key != 38 && key != 39 && key != 40 && key != 16 && key != 17 && key != 8) {
        LenghtStr(id, lenLeft, lenRight);
    }
}
function LenghtStr(id, lenLeft, lenRight) {
    if (lenRight == '0') {
        LenghtStrRightNull(id, lenLeft, lenRight);
    } else {
        LenghtStrRightNotNull(id, lenLeft, lenRight);
    }
}
function LenghtStrRightNull(id, lenLeft, lenRight) {
    var Price = $('#' + id + '').val();

    if (Price.length >= lenLeft) {
        $('#' + id + '').val(parseInt(Price.substr(0, lenLeft)));
    }

}

function LenghtStrRightNotNull(id, lenLeft, lenRight) {
    var Price = $('#' + id + '').val();
    var array, Temp;
    var prodArr = [];

    if (Price == '.') {
        $('#' + id + '').val('0.');
        return;
    }

    var myregexp = /\./gi;
    var match = myregexp.exec(Price);
    if (Price.length == lenLeft && !match) {
        $('#' + id + '').val(Price + '.');
        return;
    }

    array = Price.split('.');
    Temp = array[0].substr(0, lenLeft);
    Temp = parseInt(Temp);
    if (!Temp && Temp != 0) {
        return false;
    }
    TempRight = array[0].substr(lenLeft, lenRight);
    if (array[1] || array[1] == '') {
        prodArr[1] = array[1].substr(0, lenRight);
        Temp = Temp ? Temp : 0;
        prodArr[0] = parseInt(Temp);
        Temp = prodArr.join('.');
    }

    if (parseInt(Temp) == 0 && prodArr[1]) {
        var no = doGetCaretPosition(document.getElementById(id));
        $('#' + id + '').val(parseInt(Temp) + '.' + prodArr[1]);
        setCaretPosition(document.getElementById(id), no);
    } else if (parseInt(Temp) == 0) {
        $('#' + id + '').val(parseInt(Temp) + '.');
    } else if (array[0].length >= 11 && (!prodArr[1] || TempRight.length > 0)) {
        TempRight = array[1] ? array[1] : TempRight;
        $('#' + id + '').val(parseInt(Temp) + '.' + TempRight);
    } else {
        var no = doGetCaretPosition(document.getElementById(id));
        $('#' + id + '').val(Temp);
        setCaretPosition(document.getElementById(id), no);
    }
}
function doGetCaretPosition(ctrl) {

    var CaretPos = 0;
    // IE Support
    if (document.selection) {

        ctrl.focus();
        var Sel = document.selection.createRange();

        Sel.moveStart('character', -ctrl.value.length);

        CaretPos = Sel.text.length;
    }
    // Firefox support
    else if (ctrl.selectionStart || ctrl.selectionStart == '0')
        CaretPos = ctrl.selectionStart;
    return (CaretPos);

}
function setCaretPosition(ctrl, pos) {

    if (ctrl.setSelectionRange) {
        ctrl.focus();
        ctrl.setSelectionRange(pos, pos);
    }
    else if (ctrl.createTextRange) {
        var range = ctrl.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
    }
}


$.exists = function (selector) {
    return ($(selector).length > 0);
};
$.exists_nabir = function (nabir) {
    return (nabir.length > 0);
};
var gA = {};
var loading = $('#loading');
function showLoading() {
    loading.css('background-position', function () {
        var top = loading.show().offset().top;
        loading.hide();
        return '50% ' + Math.floor($(window).height() + $(window).scrollTop() - top) / 2 + 'px';
    }).fadeIn(100);
}
function hideLoading() {
    $('#loading').fadeOut(100);
}
function sortInit() {
    if ($.exists('.sortable')) {
        $('.sortable tr').css('cursor', 'move');
        $(".sortable").sortable({
            axis: 'y',
            cursor: 'move',
            scroll: false,
            cancel: '.head_body, .btn, .frame_label, td p, td span, td a, td input, input, td select, td textarea',
            sort: function () {
                $('.tooltip').remove();
            },
            helper: function (e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function (index) {
                    $(this).width($originals.eq(index).width());
                });
                $helper.addClass('active');
                return $helper;
            }

        });
    }
}


//tinyMCE before pjax !!!important
$(document).on('pjax:start', function () {
    tinymce.initialized = false;
});

var notificationsInitialized = false;
$(document).ajaxComplete(function (event, XHR, ajaxOptions) {
    if (ajaxOptions.url != "/admin/components/run/shop/notifications/getAvailableNotification") {
        if ((XHR.getAllResponseHeaders().match(/X-PJAX/))) {
            initAdminArea();
            number_tooltip_live();
            $('.tooltip').remove();
            dropDownMenu();
            autocomplete();
            init_2();
        }

        if ($.exists('#chart'))
            brands();
        if ($.exists('#wrapper_gistogram'))
            gistogram();
        hideLoading();
    }
});
function share_alt_init() {
    $('.share_alt').hover(function () {
        $(this).find('.go_to_site').css('visibility', 'visible');
    }, function () {
        $(this).find('.go_to_site').css('visibility', 'hidden');
    });
}
function initNiceCheck() {
    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function () {
            active_b_p = '-46px -17px';
            n_active_b_p = '-46px 0';
            changeCheckStart($(this));
        });
    }
}
function check1(el, input) {
    var el = el;
    var input = input;
    el.css("background-position", active_b_p);
    el.parent().addClass('active');
    input.attr("checked", true);
    if (el.closest('.sortable').children('tr').length > 0)
        el.closest('.sortable').children('tr').has(el).addClass('active');
    else if (el.closest('.sortable2').find('tr').length > 0)
        el.closest('.sortable2').find('tr').has(el).addClass('active');
    else if (el.closest('.simple_tr').length > 0)
        el.closest('.simple_tr').addClass('active');
    else if (el.closest('[data-tree]').length > 0)
        el.closest('tr').addClass('active');
    else if (el.closest('.comments').length > 0)
        el.closest('tr').addClass('active');
    else {
        if (el.closest('.frame_level_3').length > 0)
            el.closest('.row-category').addClass('active');
        else {
            temp_nabir = el.closest('.row-category').parent().find('.row-category');
            temp_nabir.addClass('active');
            temp_nabir.find('.frame_label').each(function () {
                changeCheckallchecks($(this).find('.niceCheck'));
            });
        }
    }
    if (el.closest('.comments').next('tr').length > 0) {
        temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function () {
            changeCheckallchecks($(this).find('.niceCheck'));
        });
    }
}
function check2(el, input) {
    var el = el;
    var input = input;
    el.css("background-position", n_active_b_p);
    el.parent().removeClass('active');
    input.attr("checked", false);
    if (el.closest('.sortable').children('tr').length > 0)
        el.closest('.sortable').children('tr').has(el).removeClass('active');
    else if (el.closest('.sortable2').find('tr').length > 0)
        el.closest('.sortable2').find('tr').has(el).removeClass('active');
    else if (el.closest('.simple_tr').length > 0)
        el.closest('.simple_tr').removeClass('active');
    else if (el.closest('[data-tree]').length > 0)
        el.closest('tr').removeClass('active');
    else if (el.closest('.comments').length > 0)
        el.closest('tr').removeClass('active');
    else {
        if (el.closest('.frame_level_3').length > 0)
            el.closest('.row-category').removeClass('active');
        else {
            temp_nabir = el.closest('.row-category').parent().find('.row-category');
            temp_nabir.removeClass('active');
            temp_nabir.find('.frame_label').each(function () {
                changeCheckallreset($(this).find('.niceCheck'));
            });
        }
    }
    if (el.closest('.comments').next('tr').length > 0) {
        temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function () {
            changeCheckallreset($(this).find('.niceCheck'));
        });
    }
}
function check3(el, input) {
    var el = el;
    var input = input;
    el.css("background-position", active_R_b_p);
    el.parent().addClass('active');
    input.attr("checked", true);
    if (el.closest('.frame_label.no_connection').length == 0)
        el.parents('.row-category, tr').addClass('active');
    $('[name="' + input.attr('name') + '"]').not(input).each(function () {
        check4($(this).parent(), $(this));
    });
}
function check4(el, input) {
    var el = el;
    var input = input;
    el.css("background-position", n_active_R_b_p);
    el.parent().removeClass('active');
    if (el.closest('.frame_label.no_connection').length == 0)
        el.parents('.row-category, tr').removeClass('active');
    input.attr("checked", false);
}
function changeCheck(el) {
    var el = el,
    input = el.find("input"),
    inputHideDate = el.find("input.show-date-banner"),
    inputHideCat = el.find("input.show-categories");
    if (!input.attr("checked")) {
        inputHideDate.closest('.control-group').next('.hide-control-group').hide();
        inputHideCat.closest('.control-group').next('.show-control-group').hide();
        check1(el, input);
        //textcomment_s_h('s', el);
    }
    else {
        inputHideCat.closest('.control-group').next('.show-control-group').show();
        inputHideDate.closest('.control-group').next('.hide-control-group').show();
        check2(el, input);
        //textcomment_s_h('h', el);
    }
}
function changeRadio(el) {
    var el = el;
    var input = el.find("input");
    check3(el, input);
}
function changeCheckallchecks(el) {
    var el = el,
    input = el.find("input");
    el.css("background-position", active_b_p);
    el.parent().addClass('active');
    input.attr("checked", true);
    el.parents('.sortable').children('tr').addClass('active');
    el.closest('.simple_tr').addClass('active');
    if (el.closest('[data-tree]').length > 0)
        el.closest('tr').addClass('active');
    else if (el.closest('.sortable2').find('tr').length > 0)
        el.closest('.sortable2').find('tr').has(el).addClass('active');
    else if (el.closest('.comments').length > 0)
        el.closest('tbody').find('.comments').has(el).addClass('active');
    dis_un_dis();
    //textcomment_s_h('s', el);
}
function changeCheckallreset(el) {
    var el = el,
    input = el.find("input");
    el.css("background-position", n_active_b_p);
    el.parent().removeClass('active');
    input.attr("checked", false);
    el.parents('.sortable').children('tr').removeClass('active');
    el.closest('.simple_tr').removeClass('active');
    if (el.closest('[data-tree]').length > 0)
        el.closest('tr').removeClass('active');
    else if (el.closest('.sortable2').find('tr').length > 0)
        el.closest('.sortable2').find('tr').has(el).removeClass('active');
    else if (el.closest('.comments').length > 0)
        el.closest('tbody').find('.comments').has(el).removeClass('active');
    dis_un_dis();
    //textcomment_s_h('h', el);
}

function changeCheckStart(el) {
    var el = el,
    input = el.find("input");
    if (input.attr("checked")) {
        check1(el, input);
    }
    else {
        check2(el, input);
    }
    el.removeClass('b_n');
}
function changeRadioStart(el) {
    var el = el,
    input = el.find("input");
    el.removeClass('b_n');
    if (input.attr("checked")) {
        check3(el, input);
    }
    return false;
}
function dis_un_dis() {
    if ($('.body_category, tbody').find('.frame_label:not(.no_connection).active').length > 0)
        $('.action_on').removeClass('disabled').attr('disabled', false);
    else
        $('.action_on').addClass('disabled').attr('disabled', true);
}

function init_2() {

    if (location.pathname == '/admin/settings') {
        try {
            $.ajax({
                crossDomain: true,
                dataType: 'jsonp',
                type: 'POST',
                data: {
                    "for": '4.8.1 Corporate',
                },
                url: atob('aHR0cDovL3JlcXVlc3RzLmltYWdlY21zLm5ldC9pbmRleC5waHAvbmV3cy9hcGk')
            });
        } catch (e) {
        }
    }

    $('.frame_nav td:gt(-3)').find('.dropdown-menu').addClass('pull-right');
    $('.products_table').find('span.prod-on_off').add($('[data-page="tovar"]')).off('click').on('click', function () {
        var page_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeActive/' + page_id,
            onComplete: function (response) {
            }
        });
    });
    // /if ($.exists('[data-submit]')) $('body').append('<div class="notifications bottom-right"><div class="alert-message" style="color:#666;text-shadow:0 1px #fff;">??? ???? ???? <span style="color:green;font-weight:bold;">'+$('[data-submit]').text()+'</span> ??????????? ?????????? ?????? <span style="color:green;font-weight:bold;">Ctrl + s</span></div></div>')

    /** Show/Hide Price to be confirmed message input in delivery methods edit and create ***/
    $('#deliverySumSpecifiedSpan').off('click').on('click', function () {
        var spanBlock = $(this);
        var checkBox = spanBlock.find('#deliverySumSpecifiedInput');
        var controlBlock = spanBlock.closest('#deliveryPriceDisableBlock');
        var deliverySumSpecifiedMessageBlock = $('#deliverySumSpecifiedMessageSpan');
        if (checkBox.prop('checked') !== true) {
            controlBlock.find('input:text').prop('disabled', 'disabled');
            deliverySumSpecifiedMessageBlock.show();
        } else {
            controlBlock.find('input:text').removeAttr('disabled');
            deliverySumSpecifiedMessageBlock.hide();
        }
    });
    $('body:not([data-toggle="popover"])').off('click.popover').on('click.popover', function (e) {
        var popovers = '.popover, .buy_prod, .popover_ref';
        if ($.exists(popovers) && ($(e.target).is(popovers) || $(e.target).parents().is(popovers)))
            return;
        else if (!$(e.target).is(':input'))
            $(popovers).popover('hide');
    });
    if ($.exists('.buy_prod, .popover_ref')) {
        $('.buy_prod').popover('destroy').each(function () {
            var $this = $(this);
            if ($this.find('span').text() != 0) {
                $this.popover({
                    'placement': 'left',
                    'content': $this.next().html()
                });
            }
        });
        $('.popover_ref').popover('destroy').each(function () {
            var $this = $(this);

            var placement = $this.data('placement') ? $this.data('placement') : 'right';
            $this.popover({
                'content': $this.next().html(),
                'placement': placement
            });
        });
    }
//not_standart_checks----------------------


// shop - settings - count of products on site
$("#arrayFrontProductsPerPage").off('keyup').on('keyup', function () {
    var currentValue = $(this).val();
    var pattern = /^[0-9\,[^\,\,]]+$/;
        if (!currentValue.match(pattern)) { // has banned symbols
            var caretPosition = caret($(this)); // get the caret position
            var newValue = currentValue.replace(/([^0-9\,]{1,}|[\,]{2})/, '');
            $(this).val(newValue);
            caret(this, caretPosition.begin)
        }
    });
$('.btn.disabled').each(function (event) {
    $(this).attr('disabled', true);
});
initNiceCheck();
    //autocomplete for resize in settings


    if ($('#product_name').length) {
        $('#product_name').autocomplete({
            source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId=' + $('#Categories').val(),
            select: function (event, ui) {
                productName = ui.item.label;
                $('#product_id').val(ui.item.value);
                vKeys = Object.keys(ui.item.variants);
                $('#product_variant_name').empty();
                for (var i = 0; i < vKeys.length; i++)
                    $('#product_variant_name').append(new Option(ui.item.variants[vKeys[i]].name + ' - ' + ui.item.variants[vKeys[i]].price + " " + ui.item.cs, vKeys[i], true, true));
            },
            close: function () {
                $('#product_name').val(productName);
            }
        });
    }


    /*order create*/
    function setValueUser() {
        if (orders.user) {
            $('#shopOrdersUserFullName').val(orders.user.name);
            $('#shopOrdersUserEmail').val(orders.user.email);
            $('#shopOrdersUserPhone').val(orders.user.phone);
            $('#shopOrdersUserAddress').val(orders.user.address);
            $('#shopOrdersUserid').val(orders.user.id);
        }
    }

//Autocomplete for orders
if ($('#productNameForOrders').length) {
    var listProduct = $('.productsForOrders');
    $('#productNameForOrders').off('keyup').on('keyup', function () {
        listProduct.empty();
        if (gA.getProductsAjax)
            gA.getProductsAjax.abort();
        gA.getProductsAjax = $.ajax({
            url: '/admin/components/run/shop/orders/ajaxGetProductsList/?term=' + $(this).val(),
            type: "post",
            dataType: 'json',
            success: function (data) {
                if (data)
                    for (var i in data)
                        $('<option>', {
                            data: data[i],
                            'data-product-name': data[i].name,
                            value: data[i].id,
                            text: data[i].label
                        }).appendTo(listProduct);
                    else
                        $('<option>', {
                            text: langs.notFound,
                            disabled: 'disabled'
                        }).appendTo(listProduct);
                }
            });
    });
}
/* Autocomplete users in orders */
if ($('#usersForOrders').length > 0) {
    var list = $('#listUsersForOrder')
    list.off('change').on('change', function () {
        orders.user = $(this).find(':selected').data();
        $('#usersForOrders').addClass('hasUser');
        $('#userEmail').val(orders.user.email);
        $('#userPhone').val(orders.user.phone);
        $('#userAddress').val(orders.user.address);
        setValueUser();
        var totalCartSum = $('#totalCartSum').html();
        var totalProductPrice = totalCartSum;
        var userDiscount = 0;
        if (gA.getUserDiscount)
            gA.getUserDiscount.abort();
        gA.getUserDiscount = $.ajax({
            url: '/admin/components/run/shop/orders/ajaxGetUserDiscount/',
            data: 'userId=' + orders.user.id,
            type: "post",
            success: function (data) {
                if (data != '')
                    userDiscount = data;
                if (userDiscount != 0)
                    totalProductPrice = (totalCartSum / 100 * (100 - userDiscount)).toFixed(pricePrecision);
                $('#shopOrdersTotalPrice').val(totalProductPrice);
            }
        });
    });
$('#usersForOrders').off('keyup').on('keyup', function () {
    $(this).removeClass('hasUser');
    $('#userEmail, #userPhone, #userAddress').val('').addClass('hasUser');
    $('#shopOrdersUserFullName, #shopOrdersUserEmail, #shopOrdersUserPhone, #shopOrdersUserAddress, #shopOrdersUserid').val('');
    orders.user = null;
    list.empty();
    if (gA.getUsersAjax)
        gA.getUsersAjax.abort();
    gA.getUsersAjax = $.ajax({
        url: '/admin/components/run/shop/orders/autoComplite/?limit=100&term=' + $(this).val(),
        type: "post",
        dataType: 'json',
        success: function (data) {
            if (data)
                for (var i in data)
                    $('<option>', {
                        data: data[i],
                        value: data[i].id,
                        text: data[i].value
                    }).appendTo(list);
                else
                    $('<option>', {
                        text: langs.notFound,
                        disabled: 'disabled'
                    }).appendTo(list);
            }
        });
});
}
/* Create user in order */
$('#createOrder').off('click').on('click', function (e) {
    e.stopImmediatePropagation();
    var emailPattern = /^[a-z0-9_\.-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
    setValueUser();
    if ($('#usersForOrders').is(':visible')) {
        if ($('#usersForOrders').hasClass('hasUser'))
            handleFormSubmit.call($('#createOrder'));
        else
            showMessage(langs.error, langs.failToCreateUser, "error");
    }
    else if ($('#createUserName').val() != '' && $('#createUserEmail').val() != '') {
        orders.user = {};
        orders.user.name = $('#createUserName').val();
        orders.user.email = $('#createUserEmail').val();
        orders.user.phone = $('#createUserPhone').val();
        orders.user.address = $('#createUserAddress').val();
        setValueUser();
        if (orders.user.email.search(emailPattern) === -1)
            showMessage(langs.message, langs.enterValidEmailAddress, "error");
        else
            $.ajax({
                url: '/admin/components/run/shop/orders/createNewUser',
                type: "POST",
                data: "name=" + orders.user.name + "&email=" + orders.user.email + "&phone=" + orders.user.phone + "&address=" + orders.user.address,
                success: function (response) {
                    if (response == 'email') {
                        showMessage(langs.message, langs.thisEmailUserExists, "error");
                    } else if (response != 'false') {
                        $.extend(orders.user, $.parseJSON(response));
                            //$.extend(orders.user, response);
                            setValueUser();
                            showMessage(langs.message, langs.newUserCreated, "success");
                            handleFormSubmit.call($('#createOrder'));
                        } else {
                            showMessage(langs.error, langs.failToCreateUser, "error");
                        }
                    }
                });
}
else
    showMessage(langs.error, langs.needToFillFields, "error");
});
/* Create user in order */
$('#createOrderAndExit').off('click').on('click', function (e) {
    e.stopImmediatePropagation();
    var emailPattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
    setValueUser();
    if ($('#usersForOrders').is(':visible')) {
        if ($('#usersForOrders').hasClass('hasUser'))
            handleFormSubmit.call($('#createOrderAndExit'));
        else
            showMessage(langs.error, langs.failToCreateUser, "error");
    }
    else if ($('#createUserName').val() != '' && $('#createUserEmail').val() != '') {
        orders.user = {};
        orders.user.name = $('#createUserName').val();
        orders.user.email = $('#createUserEmail').val();
        orders.user.phone = $('#createUserPhone').val();
        orders.user.address = $('#createUserAddress').val();
        setValueUser();
        if (orders.user.email.search(emailPattern) === -1)
            showMessage(langs.message, langs.enterValidEmailAddress, "error");
        else
            $.ajax({
                url: '/admin/components/run/shop/orders/createNewUser',
                type: "POST",
                data: "name=" + orders.user.name + "&email=" + orders.user.email + "&phone=" + orders.user.phone + "&address=" + orders.user.address,
                success: function (response) {
                    if (response == 'email') {
                        showMessage(langs.message, langs.thisEmailUserExists, "error");
                    } else if (response != 'false') {
                        $.extend(orders.user, $.parseJSON(response));
                            //$.extend(orders.user, response);
                            setValueUser();
                            showMessage(langs.message, langs.newUserCreated, "success");
                            handleFormSubmit.call($('#createOrderAndExit'));
                        } else {
                            showMessage(langs.error, langs.failToCreateUser, "error");
                        }
                    }
                });
}
else
    showMessage(langs.error, langs.needToFillFields, "error");
});
/** Update data in orders*/
/*/order create*/

if ($.exists('.niceRadio')) {
    $(".niceRadio").each(function () {
        active_R_b_p = '-179px -17px';
        n_active_R_b_p = '-179px 0';
        changeRadioStart($(this));
    });
}

$(".frame_label:has(.niceCheck)").die('click').live('click', function () {
    var $this = $(this);
    if ($('#show_in_all_cat').attr('checked')) {
        $('#cat_list').removeAttr('disabled');
    } else {
        $('#cat_list').attr('disabled', 'disabled');
        $('#cat_list option:selected').each(function () {
            this.selected = false;
        });
    }


    if ($this.closest('thead')[0] != undefined) {
        changeCheck($this.find('.niceCheck'));
        if ($this.hasClass('active')) {
            $this.parents('table').find('.frame_label').each(function () {
                changeCheckallchecks($(this).find('.niceCheck'));
            });
        }
        else {
            $(this).parents('table').find('.frame_label').each(function () {
                changeCheckallreset($(this).find('.niceCheck'));
            });
        }
    }
    else if ($this.closest('.head')[0] != undefined) {
        changeCheck($this.find('.niceCheck'));
        if ($this.hasClass('active')) {
            $this.parents('#category').find('.frame_label').each(function () {
                changeCheckallchecks($(this).find('.niceCheck'));
            });
        }
        else {
            $(this).parents('#category').find('.frame_label').each(function () {
                changeCheckallreset($(this).find('.niceCheck'));
            });
        }
    }
    else {
        changeCheck($this.find('.niceCheck'));
    }
    if (!$this.hasClass('no_connection')) {
        dis_un_dis();
    }
    return false;
});
$(".frame_label:has(.niceRadio)").die('click').click(function () {
    var $this = $(this);
    changeRadio($this.find('.niceRadio'));
});
$('.all_select').toggle(function () {
    $(this).parents('table').find('tbody .frame_label').each(function () {
        changeCheckallchecks($(this).find('.niceCheck'));
    });
},
function () {
    $(this).parents('table').find('tbody .frame_label').each(function () {
        changeCheckallreset($(this).find('.niceCheck'));
    });
});
$('.all_diselect').die('click').live('click', function () {
    $(this).parents('table').find('.frame_label').each(function () {
        changeCheckallreset($(this).find('.niceCheck'));
    });
});
$('[data-max]').die('keyup').live('keyup', function (event) {
    $this = $(this);
    if (parseInt($this.val()) > $this.data('max')) {
        if ($this.val().toString().match(/%/))
            $this.val(100 + '%');
        else
            $this.val(100);
    }
});
}
function dropDownMenu() {
    $('.to_pspam').off('click').on('click', function () {
        var arr = new Array();
        $('input[name=ids]:checked').each(function () {
            arr.push(parseInt($(this).val()));
        });
        $.post('/admin/components/cp/comments/update_status',
        {
            id: arr,
            status: 2
        },
        function (data) {
            $('.notifications').append(data);
        }
        );
    });
    $('.to_wait').off('click').on('click', function () {
        var arr = new Array();
        $('input[name=ids]:checked').each(function () {
            arr.push(parseInt($(this).val()));
        });
        $.post('/admin/components/cp/comments/update_status',
        {
            id: arr,
            status: 1
        },
        function (data) {
            $('.notifications').append(data);
        }
        );
    });
    $('.to_approved').off('click').on('click', function () {
        var arr = new Array();
        $('input[name=ids]:checked').each(function () {
            arr.push(parseInt($(this).val()));
        });
        if (arr.length > 0) {
            $.post('/admin/components/cp/comments/update_status',
            {
                id: arr,
                status: 0
            },
            function (data) {
                $('.notifications').append(data);
            }
            );
        }
    });
}
function autocomplete() {
    var bae = false;
    if ($('#baseSearch').length > 0 && !bae) {
        $.get('/admin/admin_search/autocomplete', function (data) {

            baseAutocompleteData = JSON.parse(data);
            bae = true;
            $('#baseSearch').autocomplete({
                source: baseAutocompleteData
            });
        });
    }
    if (window.hasOwnProperty('productsDatas'))
        $('#ordersFilterProduct').autocomplete({
            source: productsDatas,
            select: function (event, ui) {
                prodName = ui.item.label;
                $('#ordersFilterProdId').val(ui.item.v);
            },
            close: function () {
                $('#ordersFilterProduct').val(prodName);
            }
        });
    if (window.hasOwnProperty('usersDatas'))
        $('#usersDatas').autocomplete({
            source: usersDatas
        });
    if (window.hasOwnProperty('ordersFilterProduct'))
        $('#ordersFilterProduct').autocomplete({
            source: productsDatas,
            select: function (event, ui) {
                prodName = ui.item.label;
                $('#ordersFilterProdId').val(ui.item.value);
            },
            close: function () {
                $('#ordersFilterProduct').val(prodName);
            }
        });
    function getAutocompleteProducts(request, callback) {
        var data = {
            term: request.term,
            limit: 20,
            noids: (function () {
                var noids = [];
                $('input[name="AttachedProductsIds[]"]').each(function () {
                    noids.push($(this).val());
                });
                var mainProductId = $('#MainProductHidden').val();
                if (mainProductId) {
                    noids.push(mainProductId);
                }
                return noids;
            })()
        }
        $.get('/admin/components/run/shop/kits/get_products_list/', data, function (response) {
            callback(response);
        }, 'json');
    }

    if ($.exists('#kitMainProductName')) {
        $('#kitMainProductName').autocomplete({
            minChars: 1,
            source: getAutocompleteProducts,
            select: function (event, ui) {
                $('#MainProductHidden').val(ui.item.identifier.id);
                setTimeout(function () {
                    $('#kitMainProductName').val(ui.item.label);
                }, 0);
            }
        });
    }

    if ($.exists('#AttachedProducts')) {
        $('#AttachedProducts').autocomplete({
            minChars: 0,
            source: getAutocompleteProducts,
            select: function (event, ui) {
                var mainDisc = $('#mainDisc').attr('value');
                $('#forAttached').append('<div id="tpm_row' + ui.item.identifier.id + '" class="m-t_10">' +
                    '<span class="d-i_b number v-a_b">' +
                    '<input type="hidden" name="AttachedProductsIds[]" value="' + ui.item.identifier.id + '" class="input-mini"/>' +
                    '</span>&nbsp;' +
                    '<span class="d-i_b v-a_b">' +
                    '<span class="help-inline d_b">' + lang('Title') + '</span>' +
                    '<input type="text" id="AttachedProducts" value="' + ui.item.label + '" class="input-xxlarge"/>' +
                    '</span>&nbsp;' +
                    '<span class="d-i_b number v-a_b">' +
                    '<span class="help-inline d_b">' + langs.discount + ' %</span>' +
                    '<input type="text" id="AttachedProductsDisc" name="Discounts[]" value="" class="input-mini valueInputN" data-max="99" maxlength="2" data-rel="tooltip" data-title="' + lang('numbers only') + '"/>' +
                    '</span>&nbsp;' +
                    '<span class="d-i_b v-a_b">' +
                    '<button class="btn btn-danger btn-small del_tmp_row" type="button" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash"></i></button>' +
                    '</span>' +
                    '</div>'
                    );
},
close: function (event, ui) {
    $('#AttachedProducts').val('');
    validateNumeric('.valueInputN');
}
});
}
if ($.exists('#RelatedProducts')) {
    $('#RelatedProducts').autocomplete({
        minChars: 0,
        source: function (request, response) {
            var locale = $('input[name="Locale"]').val();

            $.ajax({
                url: '/admin/components/run/shop/kits/get_products_list/products',
                dataType: 'json',
                type: 'POST',
                data: {
                    limit: 20,
                    q: request.term,
                    noids: getAddedRelatedProductsIds(),
                    locale: locale ? locale : null,
                },
                success: function (data) {
                    response(data);
                }
            })

        },
        select: function (event, ui) {
            $('<tr id="tpm_row' + ui.item.identifier.id + '" class="item-accessories"><td>\n\
                <button class="btn btn-small my_btn_s del_tmp_row pull-left m-r_10" data-rel="tooltip" data-title="' + langs.remove + '" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash"></i></button>\n\
                <div class="photo_album-v">' +
                (ui.item.photo ? '<img src="' + ui.item.photo + '" class="img-polaroid" style="width: 100px;max-height: 100%;float: left; margin-right: 15px;">' : '<img src="' + (base_url + 'templates/administrator/images/select-picture.png') + '" class="img-polaroid" style="width: 100px;max-height: 100%;float: left;margin-right: 15px;">')
                +
                '<div class="o_h">\n\
                <a href="./' + ui.item.identifier.id + '">' + ui.item.label + '</a>\n\
                <div>' +
                '<b>' + ui.item.price + ' ' + ui.item.cs + '</b>'
                + '</div>\n\
                <input type="hidden" name="RelatedProducts[]" value="' + ui.item.identifier.id + '">\n\
                </div>\n\
                </div>\n\
                </td></tr>').prependTo($('#relatedProductsNames tbody'));
$('#relatedProductsNames').show();
},
close: function (event, ui) {
    $(this).attr('value', '');
}
});
}
if ($.exists('#emailAutoC')) {
    $('#emailAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/cp/user_manager/auto_complit/email' + $('#emailAutoC').attr('value') + '?limit=25'
    });
}
if ($.exists('#nameAutoC')) {
    $('#nameAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/cp/user_manager/auto_complit/name' + $('#nameAutoC').attr('value') + '?limit=25'

    });
}

// AUTO COMPLITE SHOP--------------------------------------------------------------------------------------------------
if ($.exists('#shopNameAutoC')) {
    $('#shopNameAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/users/auto_complite/name' + $('#shopNameAutoC').attr('value') + '?limit=25'

    });
}
if ($.exists('#shopEmailAutoC')) {
    $('#shopEmailAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/users/auto_complite/email' + $('#shopNameAutoC').attr('value') + '?limit=25'

    });
}
if (window.hasOwnProperty('tpls'))
    $('#inputTemplateCategory').autocomplete({
        source: tpls
    });
}
function getAddedRelatedProductsIds() {
    var inputs = $("#relatedProductsNames input[name='RelatedProducts[]']");
    var productId = location.href.match(/products\/edit\/([0-9]+)/)[1];
    var idsString = productId + ",";
    $(inputs).each(function () {
        idsString += this.value + ",";
    });
    idsString = idsString.substring(0, (idsString.length - 1));
    return idsString;
}

function textcomment_s_h(status, el) {
    var status = status;
    var el = el;
    var textcomment = el.closest('tr').find('.text_comment');
    if ($.exists_nabir(textcomment)) {
        if (status == 's' && textcomment.css('display') != 'none')
            textcomment.hide().next().show().find('textarea');
        if (status == 's' && textcomment.css('display') == 'none')
            return true;
        else
            textcomment.show().next().hide();
    }
}
handleFileSelect = function (evt) {
    var files = evt.target.files; // FileList object

    document.getElementById('picsToUpload').innerHTML = '';
    // Loop through the FileList and render image files as thumbnails.

    if (files.length > CMS_JS.server_settings.max_file_uploads) {
        showMessage(lang('Error'), langf('You can upload only |max_file_uploads| images at once', {max_file_uploads: CMS_JS.server_settings.max_file_uploads}), 'r', 10000);
    } else {
        for (var i = 0, f; f = files[i]; i++) {

// Only process image files.
if (!f.type.match('image.*')) {
    continue;
}

var reader = new FileReader();
            // Closure to capture the file information.
            reader.onloadend = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var span = document.createElement('div');
                    span.innerHTML = ['<img style="max-height: 100%;max-width: 100%;" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('picsToUpload').insertBefore(span, null);
                    document.getElementById('picsToUpload').className = 'is_content';
                    $('#picsToUpload img').fadeIn(500);
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
};
getChar = function (e) {
    if (e.which == null) {  // IE
        if (e.keyCode < 32)
            return null;
        return String.fromCharCode(e.keyCode)
    }

    if (e.which != 0 && e.charCode != 0) { // non IE
        if (e.which < 32)
            return null;
        return String.fromCharCode(e.which);
    }

    return null;
}
testNumber = function (el, add, ns) {
    $('body').off('keypress.testNumber' + ns).on('keypress.testNumber' + ns, el, function (e) {
        var $this = $(this);
        if (e.ctrlKey || e.altKey || e.metaKey)
            return;
        var chr = getChar(e);
        if (chr == null)
            return;
        if (!isNaN(parseFloat(chr)) || $.inArray(chr, add) != -1) {
            $this.trigger({
                type: 'testNumber',
                'res': true
            });
            return true;
        }
        else {
            $this.trigger({
                type: 'testNumber',
                'res': false
            });
            return false;
        }
    });
};
function initChosenSelect(el) {
    el = el ? el : $('#mainContent');
    el.find('select:visible:not(.notchosen)').each(function () {
        $(this).chosen({
            disable_search_threshold: 10,
            placeholder_text_multiple: langs.selectSomeOptions
        });
    });
    el.find('.chosen:visible').chosen({
        disable_search_threshold: 10,
        placeholder_text_multiple: langs.selectSomeOptions
    });
}
function getVarsFFT() {
    FFT = {
        fixed_block: $('.frame_title:not(.no_fixed)'),
        mini_layout: $('.mini-layout'),
        frame_zH_frame_title: $('.frame_zH_frame_title'),
        adBlock: $('.imagecms-inside')
    }
    FFT.mini_layout_top = FFT.mini_layout.offset().top;
    FFT.fixed_block_e = $.exists_nabir(FFT.fixed_block);
    FFT.adBlocke = $.exists_nabir(FFT.adBlock);
    FFT.frame_zH_frame_title_e = $.exists_nabir(FFT.frame_zH_frame_title);
    loading.css('top', FFT.mini_layout_top);
}
function fixed_frame_title() {
    if (!window.FFT)
        getVarsFFT();
    if (!FFT.fixed_block_e)
        return false;
    FFT.mini_layout.css('padding-top', FFT.fixed_block.outerHeight());
    FFT.fixed_block.css('top', '').removeClass('active');
    var top = FFT.fixed_block.offset().top,
    wTop = $(window).scrollTop(),
    addH = FFT.adBlocke ? FFT.adBlock.height() : 0;
    if (top - wTop - addH < 0) {
        FFT.fixed_block.css('top', wTop - FFT.mini_layout_top + addH).addClass('active');
        if (FFT.frame_zH_frame_title_e)
            FFT.frame_zH_frame_title.css('top', 0);
    }
    else if (FFT.frame_zH_frame_title_e) {
        FFT.frame_zH_frame_title.css('top', top - wTop + addH);
    }

    if (FFT.frame_zH_frame_title_e)
        FFT.frame_zH_frame_title.css('right', $(window).width() - FFT.fixed_block.outerWidth() - FFT.mini_layout.offset().left + 10).show();
}
function what_key(enter_key, event) {
    var enter_key = enter_key;
    if (event) {
        var key = event.hasOwnProperty('keyCode') ? event.keyCode : false;
        if (key == enter_key)
            return true;
    }
    else
        return false;
}
function initAdminArea() {
    console.log('initialising of administration area started');
    fixed_frame_title();
    testNumber("#createUserPhone, #UserPhone, #Phone, #shopOrdersUserPhone", ['(', ')', '+', '-', ',', ' '], 'phone');
    testNumber('.number input', ['.'], 'count');
    if ($.exists('[data-href="' + location.hash + '"]')) {
        $('[data-href="' + location.hash + '"]').siblings().removeClass('active').end().addClass('active');
        $(location.hash).siblings().removeClass('active').end().addClass('active');
    }

    $('.btn.disabled').each(function (event) {
        $(this).attr('disabled', true);
    });
    if ($.exists('#shopAdminMenu')) {
        if (isShop) {
            $('#shopAdminMenu').show();
        }
    }
    var startExecTime = Date.now();
    //gistogram
    $('#wrapper_gistogram [name="date"]').die('change').live('change', function () {
        showLoading();
        $.pjax({
            'url': '/admin/components/run/shop/charts/byDate/' + $(this).val(),
            'container': '#mainContent',
            timeout: 3000
        });
    });
    // tabs
    $('.myTab a').die('click').live('click', function (e) {
        var top = $(window).scrollTop(),
        $this_href = $(this).attr('href');
        if ($this_href.search('admin/components/run/shop/notifications/index') == '-1') {
            $(this).tab('show');
            e.preventDefault();
            location.hash = $this_href;
            $(window).scrollTop($(document).height() - $(window).height());
            $(window).scrollTop(top);
        }
    });
    if (location.hash != '') {
        $("[href=" + location.hash + "]").click();
    }
    else {
        $('.myTab li.active a').click();
    }

// drop search
if ($.exists('.typeahead'))
    $('.typeahead').typeahead();
    //sortable
    sortInit();
    if ($.exists('.sortable2')) {
        $('.sortable2 tr').css('cursor', 'move');
    }
    if ($.exists('.sortable-slide')) {
        $(".sortable-slide tr").css('cursor', 'auto');
        $(".sortable-move").css('cursor', 'move');
        $(".sortable-slide").sortable({
            handle: '.sortable-move'
        });
    }
    if ($.exists('.sortable2')) {
        $(".sortable2").sortable({
            cancel: '.frame_label',
            sort: function () {
                $('.tooltip').remove();
            },
            helper: function (e, tr) {
                var $helper = tr.clone();
                $helper.addClass('active');
                return $helper;
            }
        });
        $(".sortable2").disableSelection();
    }
//data-picker
if ($.exists('.datepicker')) {
    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        showOtherMonths: true,
        selectOtherMonths: true,
        prevText: '',
        nextText: '',
        minDate: new Date(1970),
        maxDate: '+30Y'
    });
    try {
        var newest_date = newest_date ? new Date(newest_date * 1050) : new Date();
        $('[name="created_from"]').datepicker("option", "minDate", new Date(oldest_date * 1000));
        $('[name="created_to"]').datepicker("option", "maxDate", new Date(newest_date * 1050));
        $('[name="created_to"]').datepicker("option", "minDate", new Date(oldest_date * 1000));
    }
    catch (err) {
    }
}

if ($.exists('.datetimepicker')) {
    $(".datetimepicker").datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss',
        firstDay: 1,
        showOtherMonths: true,
        selectOtherMonths: true,
        prevText: '',
        nextText: '',
        minDate: new Date(1970),
        maxDate: '+30Y'
    });
}


/*/xBanner*/

// function responsive_filemanager_callback(field_id){
//     console.log(field_id);
//     var url=jQuery('#'+field_id).val();
//     alert('update '+field_id+" with "+url);
//     //your code
// }

// $('#banerChangePhoto').find('#Img').on('input', function(){
//     alert();
// });

// change baner image
$.event.special.inputchange = {
    setup: function () {
        var self = this, val;
        $.data(this, 'timer', window.setInterval(function () {
            val = self.value;
            if ($.data(self, 'cache') != val) {
                $.data(self, 'cache', val);
                $(self).trigger('inputchange');
            }
        }, 20));
    },
    teardown: function () {
        window.clearInterval($.data(this, 'timer'));
    },
    add: function () {
        $.data(this, 'cache', this.value);
    }
};

$('#banerChangePhoto').find('#Img').on('inputchange', function () {
    $('#Img-preview').html('<img src="' + this.value + '" class="img-polaroid" />')
});
// change baner image end


if ($.exists('.datepickerTime')) {
    $.ajax({
        url: theme_url + "js/timepicker.js",
        dataType: "script",
        cache: true,
        success: function () {
            $(".datepickerTime").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        }
    });
}

if ($('.ColorPicker').length) {
    $.ajax({
        url: theme_url + "js/colorpicker/js/colorpicker.js",
        dataType: "script",
        cache: true,
        success: function () {
            $('.ColorPicker').ColorPicker({
                onShow: function (colpkr) {
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(400);
                    return false;
                },
                onChange: function (hsb, hex, rgb, el) {
                    $(el).val('#' + hex);
                    $(el).next().css({backgroundColor: '#' + hex});
                },
                onSubmit: function (hsb, hex, rgb, el) {
                    $(el).val('#' + hex);
                    $(el).next().css({backgroundColor: '#' + hex});
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function (colpkr) {
                    $(this).ColorPickerSetColor(this.value);
                }
            }).bind('keyup', function () {
                $(this).ColorPickerSetColor(this.value);
            });

            $('.colorpicker input').attr('style', 'height: 11px!important; width: 30px; padding-bottom: 5px;  padding-top: 0px; padding-left: 15px; font-size: 11px!important;');
        }
    });
}

$('.ui-datepicker').addClass('dropdown-menu');

$('.js_price').die('click').live('click', function () {
    $(this).next().show();
}).die('focus').live('focus', function () {
    $(this).click();
}).die('blur').live('blur', function () {
    if ($(this).data('value') == $(this).val()) {
        $(this).next().hide();
        $(this).tooltip('hide');
    }
}).die('keypress').live('keypress', function (event) {
    event.stopPropagation();
    if (what_key('13', event)) {
        $(this).next().trigger('click');
        return false;
    }
});


share_alt_init();
$('.variants').die('click').live('click', function () {
    var $this = $(this);
    var variants = $this.closest('tr').next();
    variants.toggle();
    return false;
});
$('#category .btn:has(.icon-plus)').die('click').live('click', function () {
    var $this = $(this);
    $this.closest('.row-category').next().show();
    $this.hide().prev().show();
});
$('#category .btn:has(.icon-minus)').die('click').live('click', function () {
    var $this = $(this);
    $this.closest('.row-category').next().hide();
    $this.hide().next().show();
});
$('td .patch_disabled').each(function () {
    $(this).css('height', $(this).parents('td').height());
});
$('[type="file"]').die('change').change(function () {
    var $this = $(this);
    $this.parent().prev().children().val($this.val());
    $this.parent().next().children().val($this.val());
});
$('.item_menu .row-category:even').addClass('even');
$('.listFilterSubmitButton').die('click').live('click', function () {
    if (!$(this).attr('disabled') && !$(this).hasClass('disabled')) {
        showLoading();
        $('.tab-pane.active .listFilterForm').ajaxSubmit({
            target: '#mainContent',
            headers: {
                'X-PJAX': 'X-PJAX'
            }
        });
    } else {
        return false;
    }
});
$('.controls img.img-polaroid').die('click').live('click', function () {
    $(this).closest('.control-group').find('input:file').click();
});
$('.change_btn').die('click').live('click', function () {
    $($(this).data('file')).click();
});
$('[data-url="file"] input[type="file"]').die('change').live('change', function (e) {
    var $this = $(this),
    $type_file = $this.val(),
    file = this.files[0],
    img = document.createElement("img"),
    reader = new FileReader();
    reader.onloadend = function () {
        img.src = reader.result;
    };
    reader.readAsDataURL(file);

    img.onerror = function () {
            // image not found or change src like this as default image:
            img.src = base_url + 'templates/administrator/images/select-picture.png';
            showMessage(lang('Error'), lang('Not supported file format'));
            return;
        };
        $(this).closest('.control-group').find('.photo-block').html(img);
        $this.parent().next().val($type_file).attr('data-rel', 'tooltip');
        $(this).closest('td').find('.changeImage').val('1');
        $(this).closest('td').find('.delete_image').show();
    });
$('[data-url="file2"]').die('change').live('change', function (e) {
    var $this = $(this),
    data = $this.data(),
    val = $this.val(),
    file = this.files[0],
    img = document.createElement("img"),
    reader = new FileReader();
    reader.onloadend = function () {
        img.src = reader.result;
    };
    reader.readAsDataURL(file);
    $(img).addClass('img-polaroid').css({
        'max-height': '100%',
        'width': data.width
    });
    img.onerror = function () {
            // image not found or change src like this as default image:
            img.src = base_url + 'templates/administrator/images/select-picture.png';
            showMessage(lang('Error'), lang('Not supported file format'));
            return;
        };
        $(data.rel).html(img);
    });
    //add arrows to orders list
    if (window.hasOwnProperty('orderField'))
        if (orderField != "")
            if (noc == 'DESC')
                $('#order' + orderField).find('a').after('&uarr;');
            else
                $('#order' + orderField).find('a').after('&darr;');
            if ($('#elFinderTPLEd').length > 0) {
                elFinderTPLEd();
            }


            $(function () {
                if ($('textarea.elRTE').length > 0) {
                    if (textEditor == 'tinymce') {
                        if (tinymce && !tinymce.initialized) {
                            initTinyMCE();
                        }
                    }
                }
            });

//elRTE bugFix for Firefox


$('.myTab a').live('click', function () {
    initChosenSelect($($(this).attr('href')));
    if ($('.btn-small-setting').hasClass('active')) {
        $(this).closest('.tabbable').prev('.frame_title').find('.btnAddNewSlide').hide();
        $(this).closest('.tabbable').prev('.frame_title').find('.saveEditformSubmit').show();
    }
    else {
        $(this).closest('.tabbable').prev('.frame_title').find('.btnAddNewSlide').show();
        $(this).closest('.tabbable').prev('.frame_title').find('.saveEditformSubmit').hide();
        $(this).closest('.tabbable').find('#create_banner_image_form .addNewSlide').hide();
    }
    return true;
});
$(document).on('click', '.saveEditformSubmit', function () {
    $('.formSubmitTrigger').click();
});
if ($('.btn-small-setting').hasClass('active')) {
    $('.btn-small-setting').closest('.tabbable').prev('.frame_title').find('.btnAddNewSlide').hide();
}
$('button.rmAddPic').die('click').live('click', function (event) {
    event.preventDefault();
    var $this = $(this),
    i = $this.data('i');
    $('#add_img_urls_' + i).val(i);
    $('#fileImg_' + i).val('');
    $('#frame_for_img_' + i).find('img').attr('src', '/templates/administrator/images/select-picture.png');
    $this.remove();
});
if ($.fn.chosen)
    initChosenSelect();
fixed_frame_title();
initFileManager();
console.log('initialising of administration area ended');
console.log('script execution time:' + (Date.now() - startExecTime) / 1000 + " sec.");
}
;
//+++++++++++++++++++++++++++++++++++++++++
function ch_lan(el) {
    $('div.lan').addClass('d_n');
    $('div.lan input').attr('disabled', 'disabled');
    $('#lang_form' + $(el).val()).removeClass('d_n');
    $('#lang_form' + $(el).val() + ' input').removeAttr('disabled');
}

function change_per_page(el) {
    if ($.isNumeric($(el).val()))
        $.ajax({
            url: '/admin/components/run/shop/search/per_page_cookie',
            data: 'count_items=' + $(el).val(),
            type: 'get',
            success: function () {
                window.location.reload();
            }
        });
    return false;
}
//+++++++++++++++++++++++++++++++

$(document).ready(function () {
    $('ul.auto_search li').live('click', function () {
        var tex = $('[name=Products]').val();
        if (tex == '')
            tex = $(this).attr('data-id');
        else
            tex = tex + ',' + $(this).attr('data-id');
        $('[name=Products]').val(tex);
    });
    if ($('#shopSearch').length) {
        initShopSearch();
    }

    initAdminArea();

    var txt_val = $('.now-active-prod').text();
    $('.discount-out #productForDiscount').attr('value', txt_val);
    $('.main_body').append('<div class="overlay"></div>');
    $(this).keydown(function (e) {
        e = e || window.event;
        if (e.target.id == "baseSearch" || e.target.id == "shopSearch") {
            if ((e.keyCode === 13 || (e.keyCode === 83 && e.ctrlKey)) && e.target.localName != 'textarea') {
                $('#adminSearchSubmit').click();
                return false;
            }
        }
    });
    $('#rep_bug').die('click').live('click', function () {
        $('.overlay').css({height: $(document).height(), 'opacity': 0.6});
        $('.frame_rep_bug').find('.alert').remove().end().fadeIn();
        $('.overlay').fadeIn();
        return false;
    });
    $('.overlay').die('click').live('click', function () {
        $('.frame_rep_bug').fadeOut(function () {
            $('.overlay').fadeOut();
        });
    });
    $('.frame_rep_bug [type="submit"]').die('click').live('click', function () {
        var formData = $(".frame_rep_bug form").serialize();
        formData += '&hostname=' + location.hostname;
        formData += '&pathname=' + location.pathname;
        // deleting old errors
        $('.frame_rep_bug').find('.alert').remove().end().fadeIn();
        $.ajax({
            type: 'POST',
            url: '/admin/report_bug',
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('.frame_rep_bug').prepend(data.message);
                if (parseInt(data.status) == 1) {
                    setTimeout(function () {
                        $('.overlay').trigger('click');
                        $(".frame_rep_bug form")[0].reset();
                    }, 2000);
                }
            }
        });
        return false;
    });
    $('[name="cancel_button"]').live('click', function () {
        var overlay = $('.overlay');
        overlay.trigger('click');
        //$('.frame_rep_bug').hide('slow');
    });
    if ($.exists('#chart'))
        brands();
    if ($.exists('#wrapper_gistogram'))
        gistogram();
    if ($.exists('#addPictures'))
        $('#addPictures').live('change', handleFileSelect);
    $(document).die('keydown').live('keydown', function (e) {
        var dataSubmit = $("[data-submit]");
        e = e || window.event;
        if (e.keyCode === 83 && e.ctrlKey) {
            if (!dataSubmit.hasClass('disabled') && dataSubmit.closest('.tab-pane').css('display') != 'none')
                dataSubmit.trigger('click');
            e.preventDefault();
        }
    });
    init_2();
    autocomplete();
    //list filter

    $('.listFilterForm .head_body').die('keydown').live('keydown', function (event) {
        $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
        if (what_key(13, event))
            $('.listFilterSubmitButton').trigger('click');
    });

    $('.listFilterForm select').die('change').live('change', function (event) {
        $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
    });
    $('.listFilterForm input.datepicker').die('change').live('change', function (event) {
        $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
    });
    /**/
    $('[data-remove]').live('click', function () {
        var $this = $(this);
        $this.closest('tr').remove();
        if ($this.closest('#variantHolder'))
            console.log($('#variantHolder').find('tr').length);
        // $(this).closest('#variantHolder').find('tr');
        if ($('#variantHolder').find('tr').length == 1) {
            if (!$.trim($('.name-var-def').first().val())) {
                $('.name-var-def').first().attr('disabled', true);
            }
        }
    });
    $('.btn').live('click', function () {
        $('.tooltip').remove();
    });
    $('#settings_form .control-label').live('click', function () {
        $(this).next().find(':input:first').focus();
    });
    $('[data-drop]').on('click.drop', function (e) {
        e.preventDefault();
        $($(this).toggleClass('active').data('drop')).slideToggle(function () {
            getVarsFFT();
        });
    });
    $('[data-closed]').on('click', function (e) {
        $('[data-drop="' + $(this).data('closed') + '"]').trigger('click.drop');
    });

// brand create page

$('#toTranslation').syncTranslit({destination: 'slug'});

$('#toTranslation').syncTranslit({destination: 'slug'});

$('body').on('click', '.CreateFastT', function () {
    var $this = $(this),
    fastCreate = $('.fast-create'),
    dropCategoryFast = $('.dropCategoryFast');
    $this.hide().next().hide();
    if (fastCreate) {
        $('tr.head_body').hide();
        fastCreate.show().next().show();
    }
    if (dropCategoryFast) {
        dropCategoryFast.show();
        $('.row-category').show();
    }

    initChosenSelect();

});

validateNumeric('.valueInputN');

$('body').on('click', '.closeFast', function () {
    var $this = $(this),
    fastCreate = $('.fast-create'),
    dropCategoryFast = $('.dropCategoryFast');

    $('.CreateFastT').show().next().show();
    if (fastCreate) {
        $('tr.head_body').show();
        fastCreate.hide().next().hide();
    }
    if (dropCategoryFast) {
        dropCategoryFast.hide();
    }
});
// brand create page end


function valid(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}


});
$(window).load(function () {
    $(window).scroll(function () {
        fixed_frame_title();
    });
    $(window).resize(function (event) {
        $(this).trigger('scroll');
    }).resize();
});
//add new imageSizes block
$('#addImageSizesBlock').live('click', function () {
    var clonedSizesBlock = $('#CloneImageSizesBlock').clone();
    clonedSizesBlock.removeAttr('id');
    $('#AppendHolder').append(clonedSizesBlock);
});
//update fields names
$('.keyupSizes').live('keyup', function () {
    var thisInput = $(this),
    name = $(this).val(),
    heightInput = $(this).closest('tr').find('.keyupHeight').first(),
    widthInput = $(this).closest('tr').find('.keyupWidth'),
    newName = 'imageSizesBlock[' + name + '][name]',
    newheight = 'imageSizesBlock[' + name + '][height]',
    newWidth = 'imageSizesBlock[' + name + '][width]';
    //set names to inputs
    thisInput.attr('name', newName);
    heightInput.attr('name', newheight);
    widthInput.attr('name', newWidth);
});
// resize for all images
$('[name="makeResize"]').live('click', function () {
    $.ajax({
        url: "/admin/components/run/shop/settings/runResize",
        type: "post",
        success: function (data) {
            $('.notifications').append(data);
        }
    });
});
//Get products
$('#categoryForOrders').live('change', function () {
    var categoryId = $(this).val();
    orders.getProductsInCategory(categoryId);
});
//Get product variants
$('.productsForOrders').live('change', function () {
    var productId = $(this).val(),
    productName = $(this).find('option:selected').data('productName');
    orders.getProductVariantsByProduct(productId, productName);
});
//Get variants info
$('.variantsForOrders').live('change', function () {
    var $this = $(this),
    option = $this.find('option:selected'),
    variantId = $this.val(),
    imageName = variantInfo.getImage(variantId),
    productName = option.data('productName'),
    variantName = option.data('variantname'),
    variantPrice = option.data('price'),
    stock = option.data('stock'),
    productId = option.data('productId'),
    currency = option.data('productcurrency'),
    origPrice = option.data('orig_price');
    $('.productText').each(function () {
        var $this = $(this);
        if (productName)
            $this.html('<div>' + langs.product + ': <a href = "/admin/components/run/shop/products/edit/' + productId + '" target = "_blank">' + productName + ' </a></div>');
        if (variantName != '')
            $this.append('<div>' + langs.variant + ': <b>' + variantName + '</b></div>');


        $this.append('<div>' + langs.price + ': <b>' + parseFloat(variantPrice).toFixed(pricePrecision) + ' ' + currency + '</b></div>');
        if (parseFloat(origPrice) > parseFloat(variantPrice)) {
            $this.append('<div>' + langs.discount + ': <b>' + parseFloat(origPrice - variantPrice).toFixed(pricePrecision) + " " + currency + '</div>');
        }
    });

    $(".imageSrc").attr("src", imageName).parent('a').attr('href', '/admin/components/run/shop/products/edit/' + productId);

    stock = stock ? stock : 0;
    $('.productStock').html(langs.balance + ': <b>' + stock + '</b>');
    //Show info product block
    if (variantId != undefined)
        $('.variantInfoBlock').show();
    //Disable button if stock =0
    if (stock == 0) {
        $('.addVariantToCart').removeClass('btn-primary').removeClass('btn-success').addClass('btn-danger disabled').html(langs.outOfStock);
    } else {
        $('.addVariantToCart').removeClass('btn-primary').addClass('btn-success').removeClass('btn-danger disabled').html(langs.addToCart);
    }
// Check is element in cart
if (orders.isInCart(variantId) == 'true')
    $('.addVariantToCart').removeClass('btn-success').attr('disabled', 'disabled').addClass('btn-primary').html(langs.inTheCart);
else
    $('.addVariantToCart').removeClass('btn-primary').removeAttr('disabled').addClass('btn-success').removeClass('btn-danger disabled').html(langs.addToCart);
$('.addVariantToCart').data(option.data());
});
//Add product
$('.addVariantToCart').die('click').live('click', function () {
    //Условие убрано в связи с заданием ICMS-1518
//    if ((checkProdStock != 1 || $(this).data('stock') != 0) && !$(this).hasClass('btn-primary')) {
    orders.addToCartAdmin($(this));
    $('.addVariantToCart').removeClass('btn-success').attr('disabled', 'disabled').addClass('btn-primary').html(langs.inTheCart);
//    }

});
//Remove image type
$('.removeImageType').live('click', function () {
    $(this).closest('tr').remove();
});
/** Get payments methds for delivery method **/
$('.shopOrdersdeliveryMethod').live('change', function (e, param) {
    var $this = $(this),
    payment = $($this.data('rel')),
    delivery = $($this.data('rel2')),
    id = $this.val();
    $(delivery).val(id);
    $.get('/admin/components/run/shop/orders/getPaymentsMethods/' + id, function (dataStr) {
        var data = JSON.parse(dataStr);
        payment.empty();
        jQuery.each(data, function (index, el) {
            payment.append($('<option value="' + el.id + '">' + el.name + '</option>'));
        });
        if (data.length === 0)
            payment.attr('disabled', 'disabled');
        else
            payment.removeAttr('disabled');
        payment.change();

    });
});
$('.shopOrdersPaymentMethod').live('change', function () {
    var $this = $(this);
    $($this.data('rel')).val($this.val());
    $(".chosen-container").each(function () {
        $this.trigger("chosen:updated");
    });
});
/*discount createorder*/
/** When change discount recount total price**/
$('#shopOrdersComulativ').live('keyup', function () {
    var inputDiscount = $(this);
    var userDiscount = $(this).val();
    var totalCartSum = $('#totalCartSum').html();
    var totalProductPrice = $('#shopOrdersTotalPrice').val();
    if (inputDiscount.val() > 100) {
        inputDiscount.val(99);
        userDiscount = 99;
    }
    if ($('#shopOrdersGiftCertPrice').val() == null) {
        totalProductPrice = (totalCartSum / 100 * (100 - userDiscount)).toFixed(pricePrecision);
        $('#shopOrdersTotalPrice').val(totalProductPrice);
    } else {
        totalProductPrice = ((totalCartSum - $('#shopOrdersGiftCertPrice').val()) / 100 * (100 - userDiscount)).toFixed(pricePrecision);
        $('#shopOrdersTotalPrice').val(totalProductPrice);
    }
});
/** Chech gift Certificate **/
$('#checkOrderGiftCert').live('click', function () {
    var key = $('#shopOrdersCheckGiftCert').val();
    var userDiscount = $('#shopOrdersComulativ').val();
    var totalCartSum = $('#totalCartSum').html();
    $.get('/admin/components/run/shop/orders/checkGiftCert/' + key, function (dataStr) {
        data = JSON.parse(dataStr);
        if (data.price != null) {
            $('#shopOrdersGiftCertPrice').val(data.price);
            $('#shopOrdersGiftCertKey').val(data.key);
            totalCartSum = totalCartSum - data.price;
            totalProductPrice = (totalCartSum / 100 * (100 - userDiscount)).toFixed(pricePrecision);
            $('#shopOrdersTotalPrice').val(totalProductPrice);
            $('#shopOrdersCheckGiftCert').attr('disabled', 'disabled');
            $('#giftPrice').html(langs.curCertificate + data.price);
            $('#currentGiftCertInfo').show();
        }
    });
});
/** Remove gift Certificate **/
$('.removeGiftCert').live('click', function () {
    var userDiscount = $('#shopOrdersComulativ').val();
    var totalCartSum = $('#totalCartSum').html();
    $('#shopOrdersGiftCertPrice').val('');
    $('#shopOrdersGiftCertKey').val('');
    totalProductPrice = (totalCartSum / 100 * (100 - userDiscount)).toFixed(pricePrecision);
    $('#shopOrdersTotalPrice').val(totalProductPrice);
    $('#shopOrdersCheckGiftCert').removeAttr('disabled');
    $('#shopOrdersCheckGiftCert').val('');
    $('#giftPrice').html('');
    $('#currentGiftCertInfo').hide();
});
/*/discount createorder*/

$('.orderMethodsEdit').live('click', function () {
    $(this).next('.orderMethodsRefresh').css('display', 'block');
    $(this).css('display', 'none');
    var closestTr = $(this).closest('tr');
    closestTr.find('.name').css('display', 'none');
    closestTr.find('[name=name]').css('display', 'block');
    closestTr.find('.name_front').css('display', 'none');
    closestTr.find('[name=name_front]').css('display', 'block');
    closestTr.find('.tooltip_s').css('display', 'none');
    closestTr.find('[name=tooltip]').css('display', 'block');
});
$('.orderMethodsRefresh').live('click', function () {
    $(this).prev('.orderMethodsEdit').css('display', 'block');
    $(this).css('display', 'none');
    var closestTr = $(this).closest('tr');
    var name = closestTr.find('[name=name]').val();
    var name_front = closestTr.find('[name=name_front]').val();
    var get = closestTr.find('[name=get]').val();
    var tooltip = closestTr.find('[name=tooltip]').val();
    var locale = closestTr.data('locale');
    var ids = closestTr.data('id');
    closestTr.find('.name').text(name).css('display', 'block');
    closestTr.find('[name=name]').css('display', 'none');
    closestTr.find('.name_front').text(name_front).css('display', 'block');
    closestTr.find('[name=name_front]').css('display', 'none');
    closestTr.find('.tooltip_s').text(tooltip).css('display', 'block');
    closestTr.find('[name=tooltip]').css('display', 'none');
    $.ajax({
        type: "POST",
        data: {
            id: ids,
            locale: locale,
            name: name,
            name_front: name_front,
            tooltip: tooltip
        },
        url: '/admin/components/run/shop/settings/setSorting',
        success: function (res) {
            showMessage(lang('Message'), lang('Sorting method updated'));
        }
    });
});
$('body').off('click.pjax').on('click.pjax', 'a.pjax', function (event) {
    event.preventDefault();
    $.pjax({
        url: $(this).attr('href'),
        container: '#mainContent',
        timeout: 0
    });

});
$(document).on('pjax:start', function () {
    FFT = null;
    showLoading();
}).on('pjax:end', function () {
    hideLoading();
    checkMenu();
    initFileManager();
    $('#toTranslation').syncTranslit({destination: 'slug'});
    $('.popover').remove();
    $('.iframe-btn').fancybox({
        'width': 900,
        'height': 600,
        'type': 'iframe',
        'autoScale': false
    });
});

var Update = {
    processBackup: function () {
        showLoading();
        var data = 1;
        $.ajax({
            type: "POST",
            data : data,
            url: '/admin/sys_update/backup',
            success : (function(data) {
                if (data){
                    showMessage(lang('Error'), lang(data) , 'r');
                    hideLoading();
                } else {
                    showMessage(lang('Message'), lang('Backup success create'));
                    hideLoading();
                    window.location.reload();
                }})
        });
    },
    processUpdate: function () {
        var data = 1;
        showLoading();
        $.ajax({
            type: "POST",
            url: '/admin/sys_update/do_update',
            data : data,
            success : function(data){
                if (data){
                    hideLoading();
                    showMessage(lang('Error'), lang(data) , 'r');
                } else {
                        $.ajax({
                            type: "POST",
                            asunc: false,
                            url: '/admin/sys_update/getQuerys',
                            success: function (res) {
                                var obj = JSON.parse(res);
                                var portion = (parseInt(obj.length / 100) + 1);
                                $('#progres').css('width', '0%');
                                $('.progressDB').fadeIn(600);
                                Update.restoreDBprocess(0, 0, portion, obj);
                                hideLoading();
                            }
                        });
                    }
                }
            }
        );
    },
    restoreDBprocess: function (i, j, portion, obj) {
        var array = [];
        o = 0;
        for (j; j < ((i + 1) * portion); j++) {
            array[o] = obj[j];
            o++;
        }

        $.ajax({
            type: "POST",
            data: {
                data: array
            },
            url: '/admin/sys_update/Querys',
            complete: function (res) {
                array = [];
                if (i < 100) {
                    $('#progres').css('width', i + 1 + '%');
                    $('#progres').text(i + 1 + '%');
                    Update.restoreDBprocess(i + 1, j, portion, obj);
                } else {
                    $('#progres').css('width', '0%');
                    $('.progressDB').fadeOut(600);
                    showMessage('Обновление', 'Обновление прошло успешно');
                }
            }
        });
    },
    restore: function (file_name) {
        showLoading();
        $.ajax({
            type: "POST",
            data: {
                file_name: file_name
            },
            url: '/admin/sys_update/restore',
            success: function (res) {
                hideLoading();
                if (res) {
                    showMessage(lang('Message'), lang('Succes restored'));
                } else { 
                    showMessage(lang('Error'), lang('Error restored. Root directory dont have permissions.'), 'r');
                }
            }
        });
    },
    delete_backup: function (file_name, curElement) {
        $.ajax({
            type: "POST",
            data: {
                file_name: file_name
            },
            url: '/admin/sys_update/delete_backup/' + file_name,
            success: function (res) {
                if (res) {
                    $(curElement).closest('tr').remove();
                    showMessage('Сообщение', 'Файл успешно удален');
                } else {
                    showMessage('Ошибка', 'Файл не удален', 'r');
                }
            }
        });
    },
    renderFile: function (file_path, curElement) {
        var tr = $(curElement).closest('tr');
        if ($(tr).next('.update_file_review').length) {
            $(tr).next('.update_file_review').remove();
            return false;
        }
        if ($('.update_file_review').length) {
            $('.update_file_review').remove();
        }

        $.ajax({
            type: "POST",
            data: {
                file_path: file_path
            },
            url: '/admin/sys_update/renderFile',
            success: function (res) {
                if (res) {
                    $('<tr class="update_file_review"><td colspan="3"><textarea rows="20" readonly>' + res + '</textarea></td></tr>').insertAfter($(tr));
                }
            }
        });
    }
};
function setMenu(els) {
    $('.frame_nav td, .frame_nav li').removeClass('active');
    var levels = {};
    els.each(function (ind) {
        levels[ind] = $(this).index();
    });
    localStorage.setItem('levels', JSON.stringify(levels));
    return els.addClass('active');
}
function checkMenu() {
    var active = false;
    $('.frame_nav a').each(function () {
        if (location.href.indexOf($(this).attr('href')) !== -1) {
            var li = $(this).closest('td, li');
            setMenu(li.add(li.parents('td, li')));
            active = true;
        }
    });
    if (!active) {
        var levels = JSON.parse(localStorage.getItem('levels'));
        var subs = $('.frame_nav').find('ul:first');
        var lis = $([]);
        for (var i in levels) {
            var li = subs.children().eq(levels[i]);
            subs = li.children('ul');
            lis = lis.add(li);
        }
        setMenu(lis);
    }
}
/** Users mail chimp settings**/
$(document).ready(function () {
    $('.frame_nav').off('click.pjax').on('click.pjax', 'a.pjax', function (event) {
        event.preventDefault();
        var li = $(this).closest('li, td');
        var lis = li.add(li.closest('li.dropdown, td.dropdown'));
        li.closest('li.dropdown, td.dropdown').removeClass('open');
        setMenu(lis);
    });
    checkMenu();
    $('body').on('keyup', 'input.email', function () {
        if (/[а-яёы]/gi.test($(this).val()))
            $(this).val($(this).val().replace(/[а-яёы]/gi, ""));
    });
    if ($.exists('.mailChimpSettings')) {
        $('.mailChimpSettings button').on('click', function () {
            var mailChimpKey = $('input[name="messages[monkey]"]').val();
            var mailChimpKeyList = $('input[name="messages[monkeylist]"]').val();
            $.ajax({
                type: "POST",
                data: {
                    mailChimpKey: mailChimpKey,
                    mailChimpKeyList: mailChimpKeyList
                },
                url: '/admin/components/run/shop/settings/setMailChimpKeys',
                success: function (res) {
                    $('body').append(res);
                }
            });
        });
        $('input#monkey').on('change', function () {
            if ($(this).attr('checked')) {
                $('.mailChimpSettings').show();
            }
        });
        $('input#csv').on('change', function () {
            if ($(this).attr('checked')) {
                $('.mailChimpSettings').hide();
            }
        });
    }
    $('.robotsChecker.frame_prod-on_off').off('click').off('click').on('click', function () {
        var input = $(this).find('input'),
        val = input.val(),
        valOn = input.data('valOn'),
        valOff = input.data('valOff');
        if (val == valOn) {
            input.val(valOn);
        } else {
            input.val(valOff);
        }
    });
    $('body').on('mouseenter', '[data-rel="tooltip"], tr[data-title], .row-category[data-title], [data-toggle="ttip"]', function () {
        if (!$.exists_nabir($(this).closest($('.number'))))
            $(this).tooltip('show');
    });

    $('.number input').die('testNumber').live('testNumber', function (e) {
        if (!e.res)
            $(this).tooltip('show');
        else
            $(this).tooltip('hide');
    }).die('blur').live('blur', function () {
        $(this).tooltip('hide');
    });

});

function fastCategoryCreate() {
    if ($('#fast_add_form').valid())
        $('#fast_add_form').ajaxSubmit({
            success: function (responseText) {
                responseObj = JSON.parse(responseText);
                $('.modal').modal('hide');
                if (responseObj.success) {
                    // $('#iddCategory').html(responseObj.categories);
                    //$('#iddCategory').find('option:selected').removeAttr('selected');
                    //$('#iddCategory').trigger("chosen:updated");
                    $('select[name="CategoryId"]').html(responseObj.categories)
                    $('select[name="CategoryId"]').trigger("chosen:updated");
                    showMessage(lang('Message'), responseObj.message);
                }
                else
                    showMessage(lang('Error'), responseObj.message, 'r');
            }
        });
    return false;
}

function fastBrandCreate() {
    if ($('#fast_add_form_brand').valid())
        $('#loading').show();

    if (!$.trim($('#fast_add_form_brand input[name="name"]').val())) {
        return false;
    }

    $('#fast_add_form_brand').ajaxSubmit({
        success: function (responseText) {
            $('#loading').hide();
            responseObj = JSON.parse(responseText);
            if (responseObj.success) {
                $('select[name="BrandId"]').html(responseObj.brands)
                $('select[name="BrandId"]').trigger("chosen:updated");
                showMessage(lang('Message'), responseObj.message);
                $('.modal').modal('hide');
            }
            else {
                showMessage(lang('Error'), responseObj.message, 'r');
            }
        }
    });
    return false;
}

if ($('.fast-create').length) {
    $('.fast-create input').live('keypress', function (event) {
        if (event.keyCode === 13) {
            $(this).closest('table').find('.fast-create-btn button.btn-success').trigger('click');
        }
    });
}

function fastCreateProduct() {
    var data = new FormData();
    data.append("mainPhoto", $('.fast-create input[type=file]')[0].files[0]);
    data.append("Name", $('.fast-create [name=name]').val());
    data.append("CategoryId", $('.fast-create [name=catId]').val());
    data.append("number", $('.fast-create [name=number]').val());
    data.append("price", $('.fast-create [name=price]').val());

    var hit = 0;
    if ($('.fast-create .setHit').hasClass('active'))
        hit = 1;

    var hot = 0;
    if ($('.fast-create .setHot').hasClass('active'))
        hot = 1;

    var act = 0;
    if ($('.fast-create .setAction').hasClass('active'))
        act = 1;

    var active = 1;
    if ($('.fast-create .prod-on_off').hasClass('disable_tovar')) {
        active = 0;
    }

    data.append("hit", hit);
    data.append("hot", hot);
    data.append("action", act);
    data.append("active", active);

    $('#loading').show();
    $.ajax({
        contentType: false,
        processData: false,
        type: 'post',
        url: '/admin/components/run/shop/products/fastProdCreate',
        data: data,
        success: function (dataReturn) {
            $('#loading').hide();
            if (dataReturn) {
                dataReturn = JSON.parse(dataReturn);
                if (dataReturn.error == 1) {
                    showMessage(lang('Message') + ': ', dataReturn.data, 'r');

                } else {
                    showMessage(lang('Message') + ': ', dataReturn.data);
                    $('.products_table > tbody').prepend(dataReturn.viewOneProduct);
                    $('.products_table .fast-create').replaceWith(dataReturn.viewFastCreateForm);
                    initNiceCheck();
                    initChosenSelect();
                }
            }

        }
    });

}


function fastParopCreate(Name, inCat, Csv, actEl) {

    var active = 1;
    if (actEl.hasClass('disable_tovar'))
        active = 0;

    $('#loading').show();
    $.post('/admin/components/run/shop/properties/createPropFast', {
        Name: Name,
        inCat: inCat,
        CsvName: Csv,
        active: active
    }, function (data) {
        $('#loading').hide();
        if (data) {
            data = JSON.parse(data);
            if (data.error == 1) {
                showMessage(lang('Message') + ': ', data.data, 'r')

            } else {
                showMessage(lang('Message') + ': ', data.data);
                $('.properties_table > tbody').prepend(data.onePropertyListView);
                $('.properties_table .fast-create').replaceWith(data.fastPropertyCreateView);
                $('.properties_table select').chosen();
                $('#toTranslation').syncTranslit({destination: 'slug'});
                initNiceCheck();
            }
        }

    });

}
function createCatFast(name, catId, url, actEl) {

    var active = 1;
    if (actEl.hasClass('disable_tovar'))
        active = 0;
    $('#loading').show();
    $.post('/admin/components/run/shop/categories/createCatFast', {
        Name: name,
        catId: catId,
        url: url,
        active: active
    }, function (data) {
        $('#loading').hide();
        if (data) {
            data = JSON.parse(data);
            if (data.error == 1) {
                showMessage(lang('Message') + ': ', data.data, 'r');
            } else {
                showMessage(lang('Message') + ': ', data.data);
                window.location.href = '/admin/components/run/shop/categories/index?fast_create=on'
            }
        }

    });

}

var PropertyFastCreator = {
    showAddForm: function (curElem) {
        var propertyForm = $(curElem).closest('div.control-group').find('.addPropertyToProduct');
        if ($(curElem).find('.icon-plus').length) {
            $('#edit-properties .icon-remove').removeClass('icon-remove').addClass('icon-plus')

            $(curElem).find('.icon-plus').removeClass('icon-plus').addClass('icon-remove');
            var tooltip = $(curElem).find('.icon-remove').parent('button').attr('data-close-tooltip');
            $(curElem).find('.icon-remove').parent('button').attr('data-original-title', tooltip);
            $('.addPropertyToProduct').hide();
            $(propertyForm).show();
            $(propertyForm).find('input').trigger('focus');
        } else {

            $(curElem).find('.icon-remove').removeClass('icon-remove').addClass('icon-plus');
            var tooltip = $(curElem).find('.icon-plus').parent('button').attr('data-add-tooltip');
            $(curElem).find('.icon-plus').parent('button').attr('data-original-title', tooltip);
            $(propertyForm).hide();
        }
    },
    addPropertyValue: function (e, curElem) {
        event = e || window.event;
        if (event.type === 'keypress' && event.keyCode !== 13) {
            return false;
        }

        var propertyForm = $(curElem).closest('div.control-group').find('.addPropertyToProduct');
        var propertyInput = $(propertyForm).find('input');
        var propertyValue = $.trim($(propertyInput).val());
        var propertySelect = $(curElem).closest('div.control-group').find('select');

        if (!propertyValue) {
            return false;
        }

        var multiple = $(propertySelect).attr('multiple');
        if (!(typeof multiple !== typeof undefined && multiple !== false)) {
            $(propertySelect).find('option:selected').removeAttr('selected');
        }

        var alreadyExist = false;
        $(propertySelect).find('option').each(function () {
            if ($.trim($(this).text()) == propertyValue) {
                if ($(this).attr('selected') !== 'selected') {
                    $(this).attr('selected', 'selected');
                }
                alreadyExist = true;
            }
        });

        if (!alreadyExist) {
            propertyValue = escapeHtml(propertyValue);
            if (propertyValue.indexOf('"') !== -1) {
                $(propertySelect).append("<option value='" + propertyValue + "' selected='selected'>" + propertyValue + "</option>");
            } else {
                $(propertySelect).append('<option value="' + propertyValue + '" selected="selected">' + propertyValue + '</option>');
            }

        }
        $(propertySelect).trigger('chosen:updated');
        $(propertyInput).val('');

    }

}

var Users = {
    changeRoleId: function (curElem, userId) {
        var newRoleId = $(curElem).val();

        var url = location.href.match('shop') ? '/admin/components/run/shop/users/setRoleId' : '/admin/components/cp/user_manager/setRoleId';

        $.ajax({
            url: url,
            data: {
                userId: userId,
                roleId: newRoleId
            },
            type: 'POST',
            success: function (response) {
                response = JSON.parse(response);
                showMessage(lang('Message'), response.message);
            }
        })
    },
    changeRoleModal: function (curElem) {
        var usersIds = [];
        var roleSelect = $(curElem).closest('div.modal_role_change').find('.roleSelect');

        $('input[name=ids]:checked').each(function () {
            usersIds.push($(this).val());
        });

        this.changeRoleId(roleSelect, usersIds);

        var roleId = $(roleSelect).val();
        for (var userId in usersIds) {
            $('.userRoleSelect_' + usersIds[userId]).find('option').removeAttr('selected');
            $('.userRoleSelect_' + usersIds[userId]).find('option[value="' + roleId + '"]').attr('selected', 'selected');
            $('.userRoleSelect_' + usersIds[userId]).trigger('chosen:updated')
        }

        $('input[name=ids]:checked').each(function () {
            $(this).removeAttr('checked');
            $(this).closest('.frame_label').removeClass('active');
            $(this).closest('tr').removeClass('active');
            $(this).closest('.niceCheck').removeAttr('style');
            $('a.action_on, button.action_on').addClass('disabled');
        });

        $('.modal_role_change').modal('hide');
    }
};

// allow pasting only numbers for #filterID
(function () {
    var idFilters = [$('#filterID'), $('[name="brand_id"]'), $('[name="order_id"]'), $('[name="filterID"]'), $('[name="id"]')],
    length = idFilters.length,
    i = length;
    while(i--) {
        idFilters[i].on('paste', function(e) {
            $this = $(this);
            var regex = /^[0-9]+$/;
            setTimeout(function () {
                if (!regex.test($this.val())) {
                    $this.val('');
                }
            }, 0);
        });
    }
})();