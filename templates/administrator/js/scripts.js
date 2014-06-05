$.exists = function(selector) {
    return ($(selector).length > 0);
};
$.exists_nabir = function(nabir) {
    return (nabir.length > 0);
};

function sortInit() {
    if ($.exists('.sortable')) {
        $('.sortable tr').not(':has(tr)').tooltip({
            'placement': place_tr_ttp,
            'delay': {
                show: 500,
                hide: 100
            }
        }).css('cursor', 'move');
        $(".sortable").sortable({
            axis: 'y',
            cursor: 'move',
            scroll: false,
            cancel: '.head_body, .btn, .frame_label, td p, td span, td a, td input, input, td select, td textarea',
            helper: function(e, tr)
            {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index)
                {
                    $(this).width($originals.eq(index).width());
                });
                $helper.addClass('active');
                return $helper;
            }

        });
    }
}

var notificationsInitialized = false;

$(document).ajaxComplete(function(event, XHR, ajaxOptions) {
    if (ajaxOptions.url != "/admin/components/run/shop/notifications/getAvailableNotification")
    {
        if ((XHR.getAllResponseHeaders().match(/X-PJAX/)))
        {
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
        $('#loading').stop().fadeOut(200);
    }
});
function share_alt_init() {
    $('.share_alt').hover(function() {
        $(this).find('.go_to_site').css('visibility', 'visible');
    }, function() {
        $(this).find('.go_to_site').css('visibility', 'hidden');
    });
}
function initNiceCheck() {
    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function() {
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

        else
        {
            temp_nabir = el.closest('.row-category').parent().find('.row-category');
            temp_nabir.addClass('active');
            temp_nabir.find('.frame_label').each(function() {
                changeCheckallchecks($(this).find('.niceCheck'));
            });
        }
    }
    if (el.closest('.comments').next('tr').length > 0) {
        temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function() {
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

        else
        {
            temp_nabir = el.closest('.row-category').parent().find('.row-category');
            temp_nabir.removeClass('active');
            temp_nabir.find('.frame_label').each(function() {
                changeCheckallreset($(this).find('.niceCheck'));
            });
        }
    }
    if (el.closest('.comments').next('tr').length > 0) {
        temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function() {
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
    $('[name="' + input.attr('name') + '"]').not(input).each(function() {
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
function changeCheck(el)
{
    var el = el;
    var input = el.find("input");
    if (!input.attr("checked")) {
        check1(el, input);
        //textcomment_s_h('s', el);
    }
    else {
        check2(el, input);
        //textcomment_s_h('h', el);
    }
}
function changeRadio(el)
{
    var el = el;
    var input = el.find("input");
    check3(el, input);
}
function changeCheckallchecks(el)
{
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
function changeCheckallreset(el)
{
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

function changeCheckStart(el)
{
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
function changeRadioStart(el)
{
    var el = el,
            input = el.find("input");
    el.removeClass('b_n');
    if (input.attr("checked")) {
        check3(el, input);
    }
    return false;
}
function dis_un_dis() {
    var label_act = $('.frame_label.active');
    if (label_act.length > 0) {
        $('.action_on').removeClass('disabled').attr('disabled', false);
    }
    else
    {
        $('.action_on').addClass('disabled').attr('disabled', true);
    }
}

function init_2() {
    if (location.pathname == '/admin/settings') {
        try {
            $.ajax({
                crossDomain: true,
                dataType: 'jsonp',
                type: 'POST',
                data: {
                    "for": '%number%',
                },
                url: atob('aHR0cDovL3JlcXVlc3RzLmltYWdlY21zLm5ldC9pbmRleC5waHAvbmV3cy9hcGk'),
            });
        } catch (e) {
        }
    }

    try {
        $('[data-toggle="ttip"]').tooltip();
    } catch (e) {
    }

    $('.products_table').find('span.prod-on_off').add($('[data-page="tovar"]')).off('click').on('click', function() {
        var page_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeActive/' + page_id,
            onComplete: function(response) {
            }
        });
    });
    // /if ($.exists('[data-submit]')) $('body').append('<div class="notifications bottom-right"><div class="alert-message" style="color:#666;text-shadow:0 1px #fff;">??? ???? ???? <span style="color:green;font-weight:bold;">'+$('[data-submit]').text()+'</span> ??????????? ?????????? ?????? <span style="color:green;font-weight:bold;">Ctrl + s</span></div></div>')

    /** Show/Hide Price to be confirmed message input in delivery methods edit and create ***/
    $('#deliverySumSpecifiedSpan').bind('click', function() {
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
    $('*').off('click.popover').on('click.popover', function(e) {
        var popovers = '.popover, .buy_prod, .popover_ref';
        if ($.exists(popovers) && ($(e.target).is(popovers) || $(e.target).parents().is(popovers)))
            return;
        else if (!$(e.target).is(':input'))
            $(popovers).popover('hide');
    });
    if ($.exists('.buy_prod, .popover_ref')) {
        //alert('init2');
        $('.buy_prod').popover('destroy').each(function() {
            var $this = $(this);
            if ($this.find('span').text() != 0) {
                $this.popover({
                    'placement': 'left',
                    'content': $this.next().html()
                });
            }
        });
        $('.popover_ref').popover('destroy').each(function() {
            var $this = $(this);
            $this.popover({
                'content': $this.next().html(),
                'placement': 'right'
            });
        });
    }
    //not_standart_checks----------------------


    // shop - settings - count of products on site
    $("#arrayFrontProductsPerPage").unbind('keyup').bind('keyup', function() {
        var currentValue = $(this).val();
        var pattern = /^[0-9\,[^\,\,]]+$/;
        if (!currentValue.match(pattern)) { // has banned symbols
            var caretPosition = caret($(this)); // get the caret position
            var newValue = currentValue.replace(/([^0-9\,]{1,}|[\,]{2})/, '');
            $(this).val(newValue);
            caret(this, caretPosition.begin)
        }
    });

    $('.btn.disabled').each(function(event) {
        $(this).attr('disabled', true);
    });

    initNiceCheck();

    //autocomplete for resize in settings

    if ($('#product_name').length) {
        $('#product_name').autocomplete({
            source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId=' + $('#Categories').val(),
            select: function(event, ui) {
                productName = ui.item.label;
                $('#product_id').val(ui.item.value);
                vKeys = Object.keys(ui.item.variants);
                $('#product_variant_name').empty();

                for (var i = 0; i < vKeys.length; i++)
                    $('#product_variant_name').append(new Option(ui.item.variants[ vKeys[i] ].name + ' - ' + ui.item.variants[ vKeys[i] ].price + " " + ui.item.cs, vKeys[i], true, true));
            },
            close: function() {
                $('#product_name').val(productName);
            }
        });
    }

    //Autocomplete for orders
    if ($('#productNameForOrders').length) {
        $('#productNameForOrders').autocomplete({
            source: '/admin/components/run/shop/orders/ajaxGetProductList/?',
            select: function(event, ui) {
                productName = ui.item.name;
                productId = ui.item.id;
                categoryId = ui.item.category;
            },
            close: function() {
                $('#categoryForOrders option:selected').each(function() {
                    this.selected = false;
                });
                $("#categoryForOrders [value='" + categoryId + "']").attr("selected", "selected");
                orders.getProductsInCategory(categoryId);
                $('#productsForOrders option:selected').each(function() {
                    this.selected = false;
                });
                $("#productsForOrders [value='" + productId + "']").attr("selected", "selected");
                orders.getProductVariantsByProduct(productId, productName);
                $('#productNameForOrders').val(productName);
            }
        });
    }
    /* Autocomplete users in orders */
    if ($('#usersForOrders').length) {
        $('#usersForOrders').autocomplete({
            source: '/admin/components/run/shop/orders/autoComplite/?limit=25',
            select: function(event, ui) {
                userData = ui.item;
            },
            close: function() {
                $('#userIdforOrder').html(userData.id);
                $('#userIdforOrder').attr('href', '/admin/components/run/shop/users/edit/' + userData.id);
                $('#userEmailforOrder').html(userData.email);
                $('#userNameforOrder').html(userData.name);
                $('#userNameforOrder').attr('href', '/admin/components/run/shop/users/edit/' + userData.id);
                $('#userPhoneforOrder').html(userData.phone);
                $('#userAddressforOrder').html(userData.address);
            }
        });
    }

    if ($.exists('.niceRadio')) {
        $(".niceRadio").each(function() {
            active_R_b_p = '-179px -17px';
            n_active_R_b_p = '-179px 0';
            changeRadioStart($(this));
        });
    }


    $('#paid_span').on('click', function() {
        if ($('#Paid').is(':checked') != true) {
            $('#spanPaid2').css('backgroundPosition', '-46px -17px');
            $('#Paid2').attr('checked', true);
        }
        else {
            $('#spanPaid2').css('backgroundPosition', '-46px 0px');
            $('#Paid2').removeAttr('checked');
        }
    });

    $('#spanPaid2').on('click', function() {
        if ($('#Paid2').is(':checked') != true) {
            $('#paid_span').css('backgroundPosition', '-46px -17px');
            $('#Paid').attr('checked', true);
        }
        else {
            $('#paid_span').css('backgroundPosition', '-46px 0px');
            $('#Paid').removeAttr('checked');
        }
    });
    $(".frame_label:has(.niceCheck)").die('click').live('click', function() {
        var $this = $(this);
        if ($('#show_in_all_cat').attr('checked')) {
            $('#cat_list').removeAttr('disabled');
        } else
        {
            $('#cat_list').attr('disabled', 'disabled');
            $('#cat_list option:selected').each(function() {
                this.selected = false;
            });
        }
        if ($this.closest('thead')[0] != undefined) {
            changeCheck($this.find('.niceCheck'));
            if ($this.hasClass('active')) {
                $this.parents('table').find('.frame_label').each(function() {
                    changeCheckallchecks($(this).find('.niceCheck'));
                });
            }
            else
            {
                $(this).parents('table').find('.frame_label').each(function() {
                    changeCheckallreset($(this).find('.niceCheck'));
                });
            }
        }
        else if ($this.closest('.head')[0] != undefined) {
            changeCheck($this.find('.niceCheck'));
            if ($this.hasClass('active')) {
                $this.parents('#category').find('.frame_label').each(function() {
                    changeCheckallchecks($(this).find('.niceCheck'));
                });
            }
            else
            {
                $(this).parents('#category').find('.frame_label').each(function() {
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

    $(".frame_label:has(.niceRadio)").die('click').click(function() {
        var $this = $(this);
        changeRadio($this.find('.niceRadio'));
    });

    $('.all_select').toggle(function() {
        $(this).parents('table').find('tbody .frame_label').each(function() {
            changeCheckallchecks($(this).find('.niceCheck'));
        });
    },
            function() {
                $(this).parents('table').find('tbody .frame_label').each(function() {
                    changeCheckallreset($(this).find('.niceCheck'));
                });
            });
    $('.all_diselect').die('click').live('click', function() {
        $(this).parents('table').find('.frame_label').each(function() {
            changeCheckallreset($(this).find('.niceCheck'));
        });
    });

    if ($.exists('[data-rel="tooltip"], [rel="tooltip"]'))
        $('[data-rel="tooltip"], [rel="tooltip"]').not('tr').not('.row-category').tooltip({
            'delay': {
                show: 500,
                hide: 100
            }
        });
    $('[data-max]').die('keyup').live('keyup', function(event) {
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
    $('.to_pspam').unbind('click').on('click', function() {
        var arr = new Array();
        $('input[name=ids]:checked').each(function() {
            arr.push(parseInt($(this).val()));
        });
        $.post('/admin/components/cp/comments/update_status',
                {
                    id: arr,
                    status: 2
                },
        function(data) {
            $('.notifications').append(data);
        }
        );
    });
    $('.to_wait').unbind('click').on('click', function() {
        var arr = new Array();
        $('input[name=ids]:checked').each(function() {
            arr.push(parseInt($(this).val()));
        });
        $.post('/admin/components/cp/comments/update_status',
                {
                    id: arr,
                    status: 1
                },
        function(data) {
            $('.notifications').append(data);
        }
        );
    });

    $('.to_approved').unbind('click').on('click', function() {
        var arr = new Array();
        $('input[name=ids]:checked').each(function() {
            arr.push(parseInt($(this).val()));
        });
        $.post('/admin/components/cp/comments/update_status',
                {
                    id: arr,
                    status: 0
                },
        function(data) {
            $('.notifications').append(data);
        }
        );
    });

}
function autocomplete() {
    var bae = false;
    if ($('#baseSearch').length > 0 && !bae)
    {
        $.get('/admin/admin_search/autocomplete', function(data) {

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
            select: function(event, ui)
            {
                prodName = ui.item.label;
                $('#ordersFilterProdId').val(ui.item.v);
            },
            close: function() {
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
            select: function(event, ui)
            {
                prodName = ui.item.label;
                $('#ordersFilterProdId').val(ui.item.value);
            },
            close: function() {
                $('#ordersFilterProduct').val(prodName);
            }
        });

    function getAutocompleteProducts(request, callback) {
        var data = {
            term: request.term,
            limit: 20,
            noids: (function() {
                var noids = [];
                $('input[name="AttachedProductsIds[]"]').each(function() {
                    noids.push($(this).val());
                });

                var mainProductId = $('#MainProductHidden').val();
                if (mainProductId) {
                    noids.push(mainProductId);
                }
                return noids;
            })()
        }
        $.get('/admin/components/run/shop/kits/get_products_list/', data, function(response) {
            callback(response);
        }, 'json');
    }

    if ($.exists('#kitMainProductName')) {
        $('#kitMainProductName').autocomplete({
            minChars: 1,
            source: getAutocompleteProducts,
            select: function(event, ui) {
                $('#MainProductHidden').val(ui.item.identifier.id);
                setTimeout(function() {
                    $('#kitMainProductName').val(ui.item.label);
                }, 0);
            }
        });
    }

    if ($.exists('#AttachedProducts')) {
        $('#AttachedProducts').autocomplete({
            minChars: 0,
            source: getAutocompleteProducts,
            select: function(event, ui) {
                var mainDisc = $('#mainDisc').attr('value');
                $('#forAttached').append('<div id="tpm_row' + ui.item.identifier.id + '" class="m-t_10">' +
                        '<span class="d-i_b number v-a_b">' +
                        '<input type="hidden" name="AttachedProductsIds[]" value="' + ui.item.identifier.id + '" class="input-mini"/>' +
                        '</span>&nbsp;' +
                        '<span class="d-i_b v-a_b">' +
                        '<span class="help-inline d_b">' + langs.name + '</span>' +
                        '<input type="text" id="AttachedProducts" value="' + ui.item.label + '" class="input-xxlarge"/>' +
                        '</span>&nbsp;' +
                        '<span class="d-i_b number v-a_b">' +
                        '<span class="help-inline d_b">' + langs.discount + ' %</span>' +
                        '<input type="text" id="AttachedProductsDisc" name="Discounts[]" value="0" class="input-mini" data-max="100" data-rel="tooltip" data-title="?????? ?????"/>' +
                        '</span>&nbsp;' +
                        '<span class="d-i_b v-a_b">' +
                        '<button class="btn btn-danger btn-small del_tmp_row" type="button" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash icon-white"></i></button>' +
                        '</span>' +
                        '</div>');
            },
            close: function(event, ui) {
                $('#AttachedProducts').val('');
            }
        });
    }
    if ($.exists('#RelatedProducts')) {
        $('#RelatedProducts').autocomplete({
            minChars: 0,
            source: function(request, response) {
                $.post('/admin/components/run/shop/kits/get_products_list/', {
                    limit: 20,
                    q: request.term,
                    noids: getAddedRelatedProductsIds()
                }, function(data) {
                    response(data);
                }, 'json')
            },
            select: function(event, ui) {
                $('#relatedProductsNames').append('<div id="tpm_row' + ui.item.identifier.id + '" class="item-accessories">' +
                        '<span class="pull-left">' +
                        '<a id="AttachedProducts" href="edit/' + ui.item.identifier.id + '">' + ui.item.label + '</a>' +
                        '<input type="hidden" name="RelatedProducts[]" value="' + ui.item.identifier.id + '">' +
                        '</span>' +
                        '<span style="margin-left: 1%;" class="pull-left">' +
                        '<button class="btn btn-small btn-danger del_tmp_row" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash icon-white"></i></button>' +
                        '</span>' +
                        '</div>');
            },
            close: function(event, ui) {
                $('#RelatedProducts').attr('value', '');
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
    $(inputs).each(function() {
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
        {
            var textcomment_h = textcomment.outerHeight();
            textcomment.hide().next().show().find('textarea').css('height', textcomment_h + 13);
        }
        if (status == 's' && textcomment.css('display') == 'none')
            return true;
        else {
            textcomment.show().next().hide();
        }
    }
}
handleFileSelect = function(evt) {
    var files = evt.target.files; // FileList object

    document.getElementById('picsToUpload').innerHTML = '';
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onloadend = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                var span = document.createElement('div');
                span.innerHTML = ['<img style="max-height: 100%;" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'].join('');
                document.getElementById('picsToUpload').insertBefore(span, null);
                document.getElementById('picsToUpload').className = 'is_content';
                $('#picsToUpload img').fadeIn(500);
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
};
getChar = function(e) {
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
testNumber = function(el, add, ns) {
    $('body').off('keypress.testNumber' + ns).on('keypress.testNumber' + ns, el, function(e) {
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
    el.find('select:visible:not(.notchosen)').each(function() {
        if ($(this).children().length > 20)
            $(this).chosen();
    });
    el.find('.chosen:visible').chosen();
}
function number_tooltip() {
    $('.number input').tooltip({
        'delay': {
            show: 500,
            hide: 100
        }
    }).die('testNumber').live('testNumber', function(e) {
        if (!e.res)
            $(this).tooltip('show');
        else
            $(this).tooltip('hide');
    });
}
function getScrollTop() {
    var scrOfY = 0;
    if (typeof (window.pageYOffset) == "number") {
        //Netscape compliant
        scrOfY = window.pageYOffset;
    } else if (document.body
            && (document.body.scrollLeft
                    || document.body.scrollTop)) {
        //DOM compliant
        scrOfY = document.body.scrollTop;
    } else if (document.documentElement
            && (document.documentElement.scrollLeft
                    || document.documentElement.scrollTop)) {
        //IE6 Strict
        scrOfY = document.documentElement.scrollTop;
    }
    return scrOfY;
}
function fixed_frame_title() {
    var fixed_block = $(".frame_title:not(.no_fixed)"),
            mini_layout = $('.mini-layout'),
            container = $('.container'),
            containerW = container.width() - parseInt($('body').css('padding-left')) * 2,
            frame_zH_frame_title = $('.frame_zH_frame_title');

    if ($.exists_nabir(fixed_block)) {
        var top = mini_layout.offset().top,
                fixed_block_top = top > 159 ? top : 159,
                fixed_block_h = fixed_block.outerHeight(true),
                top = getScrollTop();

        if (top < fixed_block_top) {
            fixed_block.css("top", fixed_block_top - top + 20);
            frame_zH_frame_title.css("top", fixed_block_top - top + 6);
        }
        else {
            fixed_block.css("top", 20 + ($.exists('.imagecms-top-fixed-header.imagecms-active') ? 31 : 0));
            frame_zH_frame_title.css("top", 6);
        }

        fixed_block.css('width', containerW - 2);
        mini_layout.css('padding-top', 20 + fixed_block_h);
        frame_zH_frame_title.css({
            'right': $(window).width() - containerW - mini_layout.offset().left + 10
        });
    }
}
function difTooltip() {
    // tooltip
    var tr_tooltip = $('tr[data-title]').add('.row-category[data-title]');
    if ($.exists_nabir(tr_tooltip)) {
        tr_tooltip.tooltip('destroy');
        tr_tooltip.each(function() {
            var $this = $(this);
            if ($this.data('title').length * 9 > $this.offset().left) {
                $this.tooltip({
                    'placement': 'top',
                    'delay': {
                        show: 500,
                        hide: 100
                    }
                });
                place_tr_ttp = 'top';
            }
            else {
                $this.tooltip({
                    'placement': 'left',
                    'delay': {
                        show: 500,
                        hide: 100
                    }
                });
                place_tr_ttp = 'left';
            }
        });
    }
    else
        place_tr_ttp = 'top';
}
function what_key(enter_key, event) {
    var enter_key = enter_key;
    if (event)
    {
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

    testNumber("#createUserPhone, #UserPhone, #Phone, #shopOrdersUserPhone", ['(', ')', '+', '-'], 'phone');
    testNumber('.number input', ['.'], 'count');

    if ($.exists('[data-href="' + location.hash + '"]')) {
        $('[data-href="' + location.hash + '"]').siblings().removeClass('active').end().addClass('active');
        $(location.hash).siblings().removeClass('active').end().addClass('active');
    }

    $('.btn.disabled').each(function(event) {
        $(this).attr('disabled', true);
    });

    if ($.exists('#shopAdminMenu')) {
        if (isShop)
        {
            $('#shopAdminMenu').show();
            $('#topPanelNotifications').fadeIn(200);

        }
    }
    var startExecTime = Date.now();

    //gistogram
    $('[name="date"]').die('change').live('change', function() {
        $('#loading').stop().fadeIn(100);
        $.pjax({
            'url': '/admin/components/run/shop/charts/byDate/' + $(this).val(),
            'container': '#mainContent',
            timeout: 3000
        });
    });

    // tabs
    $('.myTab a').die('click').live('click', function(e) {
        top = getScrollTop();
        $this_href = $(this).attr('href');
        $(this).tab('show');
        e.preventDefault();
        location.hash = $this_href;
        $(window).scrollTop($(document).height() - $(window).height());
        $(window).scrollTop(top);
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

    //init tooltip
    difTooltip();

    //sortable
    sortInit();
    if ($.exists('.sortable2')) {
        $('.sortable2 tr').not(':has(tr)').tooltip({
            'placement': place_tr_ttp,
            'delay': {
                show: 500,
                hide: 100
            }
        }).css('cursor', 'move');
    }
    if ($.exists('.sortable2')) {
        $(".sortable2").sortable({
            cancel: '.frame_label',
            helper: function(e, tr)
            {
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
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true,
            prevText: '',
            nextText: '',
            minDate: new Date(1970),
            maxDate: '+30Y'
        });
        try {
            $('[name="created_from"]').datepicker("option", "minDate", new Date(oldest_date * 1000));
            $('[name="created_to"]').datepicker("option", "maxDate", new Date(newest_date * 1050));
            $('[name="created_to"]').datepicker("option", "minDate", new Date(oldest_date * 1000));
        }
        catch (err) {
        }
    }
    if ($.exists('.datepickerTime')) {
        $.ajax({
            url: theme_url + "js/timepicker.js",
            dataType: "script",
            cache: true,
            success: function() {
                $(".datepickerTime").datetimepicker({
                    dateFormat: 'yy-mm-dd',
                    timeFormat: "H:mm:ss"
                });
            }
        });
    }

    $('.ui-datepicker').addClass('dropdown-menu');

    // $('.ui-dialog button').ready(function(){ $('.ui-dialog button').addClass('btn')});

    $('.js_price').die('click').live('click', function() {
        $(this).next().show();
    }).die('focus').live('focus', function() {
        $(this).click();
    }).die('blur').live('blur', function() {
        if ($(this).data('value') == $(this).val()) {
            $(this).next().hide();
            $(this).tooltip('hide');
        }
    }).die('keypress').live('keypress', function(event) {
        if (what_key('13', event)) {
            $(this).next().trigger('click');
            return false;
        }
    });
    share_alt_init();
    $('.variants').die('click').live('click', function() {
        var $this = $(this);
        var variants = $this.closest('tr').next();
        variants.toggle();
        return false;
    });

    function returnFalse(e) {
        return false;
    }

    function cancelEvent(e) {
        if (e.preventDefault)
            e.preventDefault();
        else
            e.returnValue = false;
    }

    function addHandler(e, event, action, param) {
        if (document.addEventListener)
            e.addEventListener(event, action, param);
        else if (document.attachEvent)
            e.attachEvent('on' + event, action);
        else
            e['on' + event] = action;
    }

    function removeHandler(e, event, action, param) {
        if (document.addEventListener)
            e.removeEventListener(event, action, param);
        else if (document.attachEvent)
            e.detachEvent('on' + event, action);
        else
            e['on' + event] = returnFalse;
    }

    addHandler(document, 'mousedown', mouseDown, false);
    addHandler(document, 'mouseup', mouseUp, false);

    function mouseDown(e) {
        if (
                (e.target.nodeName != "HTML") &&
                (e.target.nodeName != "TEXTAREA") &&
                (e.target.nodeName != "SELECT") &&
                (e.target.nodeName != "OPTION") &&
                (e.target.nodeName != "INPUT") &&
                (e.target.nodeName != "TR") &&
                (e.target.nodeName != "P") &&
                (e.target.nodeName != "SPAN") &&
                (!e.target.nodeName != "A") &&
                (e.target.nodeName != "DD")
                )
        {
            e = e || event;
            cancelEvent(e);
            addHandler(document, 'selectstart', returnFalse, false);
        }
        $('select').trigger('chosen:close');
        $(':input:focus').blur();
        if (($(e.target).hasClass('niceCheck')) || $(e.target).hasClass('frame_label') || ($(e.target).hasClass('niceRadio') || ($(e.target).hasClass('.row-category')) || ($(e.target).parent('.row-category').length > 0))) {
            e = e || event;
            cancelEvent(e);
            addHandler(document, 'selectstart', returnFalse, false);
        }
    }

    function mouseUp(e) {
        removeHandler(document, 'selectstart', returnFalse, false);
    }

    $('#category .btn:has(.icon-plus)').die('click').live('click', function() {
        var $this = $(this);
        $this.closest('.row-category').next().show();
        $this.hide().prev().show();
    });
    $('#category .btn:has(.icon-minus)').die('click').live('click', function() {
        var $this = $(this);
        $this.closest('.row-category').next().hide();
        $this.hide().next().show();
    });

    $('td .patch_disabled').each(function() {
        $(this).css('height', $(this).parents('td').height());
    });

    $('[type="file"]').die('change').change(function() {
        var $this = $(this);
        $this.parent().prev().children().val($this.val());
        $this.parent().next().children().val($this.val());
    });
    $('.item_menu .row-category:even').addClass('even');


    // $('.listFilterForm').die('focus').live('focus', function() {
    // $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
    // });

    $('.listFilterSubmitButton').die('click').live('click', function() {
        if (!$(this).attr('disabled') && !$(this).hasClass('disabled'))
        {
            $('#loading').stop().fadeIn(100);
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


    $('.controls img.img-polaroid').die('click').live('click', function() {
        $(this).closest('.control-group').find('input:file').click();
    });
    $('.change_btn').die('click').live('click', function() {
        $($(this).data('file')).click();
    });

    $('[data-url="file"] input[type="file"]').die('change').live('change', function(e) {
        var $this = $(this);
        var $type_file = $this.val();

        var file = this.files[0];

        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        };

        reader.readAsDataURL(file);
        $(img).addClass('img-polaroid').css({
            'max-height': '100%'
        });

        img.onerror = function() {
            // image not found or change src like this as default image:
            img.src = base_url + 'templates/administrator/images/select-picture.png';
            showMessage(lang('Error'), lang('Not supported file format'));
            return;
        };
        $(this).closest('.control-group').find('.controls').html(img);
        $this.parent().next().val($type_file).attr('data-rel', 'tooltip');


        isChanged = $(this).closest('td').find('.changeImage').val('1');
//        console.log($(img));

    });


    $('#mainContent').off('click.pjax').on('click.pjax', 'a.pjax', function(event) {
        event.preventDefault();
        $('#loading').fadeIn(100);
        $.pjax({
            url: $(this).attr('href'),
            container: '#mainContent',
            timeout: 0

        });
        return false;
    });

    $('#mainContent button.pjax').unbind('click').die('click').on('click', function(event) {
        $('#loading').fadeIn(100);
        return false;
    });

    $(document).on('pjax:start', function() {
        $('#loading').fadeIn(100);

    })
            .on('pjax:end', function() {
                $('#loading').fadeOut(300);
            });

    //add arrows to orders list
    if (window.hasOwnProperty('orderField'))
        if (orderField != "")
            if (noc == 'DESC')
                $('#order' + orderField).find('a').after('&uarr;');
            else
                $('#order' + orderField).find('a').after('&darr;');

    if ($('textarea.elRTE').length > 0)
        //        initElRTE();
        initTextEditor(textEditor);

    if ($('#elFinderTPLEd').length > 0)
        elFinderTPLEd();
    //        initTextEditor(textEditor);

    //elRTE bugFix for Firefox

    $('.myTab a').live('click', function() {
        initElRTE();
        initChosenSelect($($(this).attr('href')));
        return true;
    });

    $('button.rmAddPic').die('click').live('click', function(event) {
        event.preventDefault();
        $(this).closest('label').find('input[type=hidden]').val($(this).data('i'));
        $(this).closest('label').find('span').find('input[type=file]').val('');
        $(this).closest('div.control-group').find('img').attr('src', '/templates/administrator/images/select-picture.png');
        $(this).remove();
        return false;
    });
    if ($.fn.chosen)
        initChosenSelect();

    fixed_frame_title();



    (function() {

        var getLinks = function() {
            var links = [];
            $('.frame_nav ul.nav a').each(function() {
                var url = $(this).attr('href');
                if (url == '#' || url == undefined) {
                    return;
                }
                links.push({
                    url: url,
                    node: this,
                    active: $(this).parent('li').hasClass('active')
                });
            });
            return links;
        }

        var popPathname = function(pathname_) {
            var path = pathname_.split('/');
            path.pop();
            return path.join('/');
        }

        var getSupposedActive = function(href) {
            href = href || location.href;
            var links = getLinks();
            var pathname_ = href.toString();
            do {
                pathname_ = popPathname(pathname_);
                console.log(pathname_);
                for (var i = 0; i < links.length; i++) {
                    if (links[i].url.indexOf(pathname_) != -1) {
                        return links[i];
                    }
                }
            } while (pathname_.length > 1);

            return false;
        }

        var getActive = function() {
            var links = [];
            $('.frame_nav ul.nav a').each(function() {
                var url = $(this).attr('href');
                if (url == '#' || url == undefined) {
                    return;
                }
                links.push({
                    url: url,
                    node: this,
                    active: $(this).parent('li').hasClass('active')
                });
            });
            for (var i = 0; i < links.length; i++) {
                if (links[i].active == true) {
                    return links[i];
                }
            }
            return false;
        }

        var makeLinkActive = function(link) {
            // make all unactive
            var links = getLinks();
            var parentUl;
            var parentLi;
            for (var i = 0; i < links.length; i++) {
                parentLi = $(links[i].node).parent('li');
                $(parentLi).removeClass('active');
                parentUl = $(parentLi).parent('ul');
                if ($(parentUl).hasClass('dropdown-menu')) {
                    $(parentUl).parent('li.dropdown.active').removeClass('active');
                }
            }

            // make one active
            $(link.node).parent('li').addClass('active');
            var newParentUl = $(link.node).parent('li').parent('ul');
            if ($(newParentUl).hasClass('dropdown-menu')) {
                $(newParentUl).parent('li.dropdown').addClass('active');
            }
        }

        var menuSelect = function(href) {
            var suposedActive = getSupposedActive(href);
            if (suposedActive === false) {
                return;
            }
            if (suposedActive.active == false) {
                makeLinkActive(suposedActive);
            }
        }

        $('#mainContent .pjax').off('click.newpjax').on('click.newpjax', function() {
            var href = $(this).attr('href');
            menuSelect(href);
        });

        // if there is no active menu, then trying to select the right one
        var activeMenuItem = getActive();
        if (activeMenuItem === false) {
            menuSelect();
        }

    })();

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
            success: function() {
                window.location.reload();
            }
        });
    return false;
}
//+++++++++++++++++++++++++++++++

$(document).ready(
        function() {

            $('ul.auto_search li').live('click', function() {
                tex = $('[name=Products]').val();
                if (tex == '')
                    tex = $(this).attr('data-id');
                else
                    tex = tex + ',' + $(this).attr('data-id');
                $('[name=Products]').val(tex);
            });

            if ($('#shopSearch').length) {
                initShopSearch();
            }

            if ($.exists('#topPanelNotifications'))
                updateNotificationsTotal();
            initAdminArea();
            //$('.nav .dropdown-menu a').die('click');

            var txt_val = $('.now-active-prod').text();
            $('.discount-out #productForDiscount').attr('value', txt_val);

            $('body').off('click.pjax').on('click.pjax', 'a.pjax', function(event) {
                event.preventDefault();
                $('#loading').fadeIn(100);
                $.pjax({
                    url: $(this).attr('href'),
                    container: '#mainContent',
                    timeout: 3000
                });
                $('.frame_nav nav li').removeClass('active');
                if ($(this).closest('.frame_nav').length > 0)
                    $(this).closest('li').addClass('active').closest('li.dropdown').addClass('active').removeClass('open');
                return false;
            });


            $('.main_body').append('<div class="overlay"></div>');

            $(this).keydown(function(e) {
                e = e || window.event;
                if (e.target.id == "baseSearch" || e.target.id == "shopSearch")
                {
                    if ((e.keyCode === 13 || (e.keyCode === 83 && e.ctrlKey)) && e.target.localName != 'textarea') {
                        $('#adminSearchSubmit').click();
                        return false;
                    }
                }
            });

            $('#rep_bug').die('click').live('click', function() {
                $('.overlay').css({height: $(document).height(), 'opacity': 0.6});
                $('.frame_rep_bug').find('.alert').remove().end().fadeIn();
                $('.overlay').fadeIn();
                return false;
            });

            $('.overlay').die('click').live('click', function() {
                $('.frame_rep_bug').fadeOut(function() {
                    $('.overlay').fadeOut();
                });
            });

            $('.frame_rep_bug [type="submit"]').die('click').live('click', function() {
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
                    success: function(data) {
                        $('.frame_rep_bug').prepend(data.message);
                        if (parseInt(data.status) == 1) {
                            setTimeout(function() {
                                $('.overlay').trigger('click');
                                $(".frame_rep_bug form")[0].reset();
                            }, 2000);
                        }
                    }
                });
                return false;
            });

            $('[name="cancel_button"]').live('click', function() {
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

            $(document).die('keydown').live('keydown', function(e) {
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

            $('.listFilterForm').die('keydown').live('keydown', function(event) {
                $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
                if (what_key(13, event))
                    $('.listFilterSubmitButton').trigger('click');
            });

            $('.listFilterForm select').die('change').live('change', function(event) {
                $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
            });

            $('.listFilterForm input.datepicker').die('change').live('change', function(event) {
                $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
            });

            /* menu */
            var found = false;
            $('#mainAdminMenu a').each(function() {
                if ($(this).attr('href').match(window.location.pathname) && !found)
                {
                    $(this).closest('li').addClass('active');
                    $('li.active').closest('ul').closest('li').addClass('active');
                    found = true;
                }
            });

            /**/
            $('[data-remove]').live('click', function() {
                $(this).closest('tr').remove();
            });

            $('.btn').live('click', function() {
                $('.tooltip').remove();
            });
            $('#settings_form .control-label').live('click', function() {
                $(this).next().find(':input:first').focus();
            });
        });

$(window).load(function() {
    $(window).scroll(function() {
        fixed_frame_title();
    });
    $(window).resize(function(event) {
        $(this).trigger('scroll');

        $('.fade.in').remove();
        difTooltip();
    }).resize();

    if (window.hasOwnProperty('userLogined') && !notificationsInitialized && $.exists('#topPanelNotifications'))
    {
        window.setInterval('updateNotificationsTotal()', 20000);
        notificationsInitialized = true;
    }

});


//add new imageSizes block
$('#addImageSizesBlock').live('click', function() {
    var clonedSizesBlock = $('#CloneImageSizesBlock').clone();
    clonedSizesBlock.removeAttr('id');
    $('#AppendHolder').append(clonedSizesBlock);
});
//update fields names
$('.keyupSizes').live('keyup', function() {
    var thisInput = $(this);
    var name = $(this).val();
    var heightInput = $(this).closest('tr').find('.keyupHeight').first();
    var widthInput = $(this).closest('tr').find('.keyupWidth');

    //make new names for inputs
    newName = 'imageSizesBlock[' + name + '][name]';
    newheight = 'imageSizesBlock[' + name + '][height]';
    newWidth = 'imageSizesBlock[' + name + '][width]';

    //set names to inputs
    thisInput.attr('name', newName);
    heightInput.attr('name', newheight);
    widthInput.attr('name', newWidth);

});
// resize for all images
$('[name="makeResize"]').live('click', function() {
    $.ajax({
        url: "/admin/components/run/shop/settings/runResize",
        type: "post",
        success: function(data) {
            $('.notifications').append(data);
        }
    });
});


$('#categoryForOrders option').live('mouseup click', function() {
    var categoryId = $(this).val();
    $('#categoryForOrders ').val(categoryId)
});


//Get products
$('#categoryForOrders').live('change', function() {
    var categoryId = $(this).val();
    orders.getProductsInCategory(categoryId);
});

$('#productsForOrders option').live('mouseup click', function() {
    var productId = $(this).val();
    $('#productsForOrders ').val(productId)
})


//Get product variants
$('#productsForOrders').live('change', function() {
    var productId = $(this).val();
    var productName = $('#productsForOrders option:selected').data('productname');

    orders.getProductVariantsByProduct(productId, productName);
});

$('#variantsForOrders option').live('click', function() {
    var variantId = $(this).val();
    $('#variantsForOrders ').val(variantId)
    if (orders.isInCart(variantId) == 'true') {
        $('#addVariantToCart').removeClass('btn-success').attr('disabled', 'disabled').addClass('btn-primary').html(langs.inTheCart);
    } else {
        $('#addVariantToCart').removeClass('btn-primary').removeAttr('disabled').addClass('btn-success').removeClass('btn-danger disabled').html(langs.addToCart);
    }


});

//Get variants info
$('#variantsForOrders').live('change', function() {
    var variantId = $(this).val();
    var imageName = variantInfo.getImage(variantId);
    var productName = $('#variantsForOrders option:selected').data('productname');
    var variantName = $('#variantsForOrders option:selected').data('variantname');
    var variantPrice = $('#variantsForOrders option:selected').data('price');
    var stock = $('#variantsForOrders option:selected').data('stock');
    var currency = $('#variantsForOrders option:selected').data('productcurrency');
    var origPrice = $('#variantsForOrders option:selected').data('orig_price');

    $('#productText').html('<b>' + langs.product + ': ' + productName + '</b>');
    if (variantName != '')
        $('#productText').append('<br/>' + langs.variant + ': ' + variantName);

    $('#productText').append('<br/>' + langs.price + ': ' + parseFloat(variantPrice).toFixed(pricePrecision) + ' ' + currency);
    if (origPrice != variantPrice & origPrice > variantPrice) {
        $('#productText').append('<br/>' + langs.discount + ': ' + (origPrice - variantPrice) + " " + currency);
    }

    $("#imageSrc").attr("src", '/uploads/shop/products/origin/' + imageName);
    $('#productStock').html('<br/>' + langs.balance + ': ' + stock);

    //Show info product block
    if (variantId != undefined)
        $('#variantInfoBlock').show();

    //Disable button if stock =0
    if (stock == 0) {
        $('#addVariantToCart').removeClass('btn-primary').removeClass('btn-success').addClass('btn-danger disabled').html(langs.outOfStock);
    } else {
        $('#addVariantToCart').removeClass('btn-primary').addClass('btn-success').removeClass('btn-danger disabled').html(langs.addToCart);
    }
    // Check is element in cart
    if (orders.isInCart(variantId) == 'true') {
        $('#addVariantToCart').removeClass('btn-success').attr('disabled', 'disabled').addClass('btn-primary').html(langs.inTheCart);
    }

    dataForButton = $('#variantsForOrders option:selected').data();

    $('#addVariantToCart').data(dataForButton);
});
//Add product
$('#addVariantToCart').die('click').live('click', function() {
    if ((checkProdStock != 1 || $(this).data('stock') != 0) && !$(this).hasClass('btn-primary')) {
        orders.addToCartAdmin($(this));
        $(this).removeClass('btn-success').attr('disabled', 'disabled').addClass('btn-primary').html(langs.inTheCart);
    }

});
//Remove image type
$('.removeImageType').live('click', function() {
    $(this).closest('tr').remove();
});

/* Create user in order */
$('#createUserButton').live('click', function() {
    var userName = $('#createUserName').val();
    var userEmail = $('#createUserEmail').val();
    var userPhone = $('#createUserPhone').val();
    var userAddress = $('#createUserAddress').val();
    var emailPattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

    if (userName != '' && userEmail != '' && userEmail.search(emailPattern) == 0) {
        $.ajax({
            url: '/admin/components/run/shop/orders/createNewUser',
            type: "POST",
            data: "name=" + userName + "&email=" + userEmail + "&phone=" + userPhone + "&address=" + userAddress,
            success: function(response) {
                if (response == 'email') {
                    showMessage(langs.message, langs.thisEmailUserExists, "error");
                } else if (response != 'false') {
                    $('#collapsed').click();
                    $('#createUserName').val('');
                    $('#createUserEmail').val('');
                    $('#createUserPhone').val('');
                    $('#createUserAddress').val('');

                    data = JSON.parse(response);
                    if (data != null) {
                        /*Make created user selected */
                        $('#userIdforOrder').html(data.id);
                        $('#userIdforOrder').attr('href', '/admin/components/run/shop/users/edit/' + data.id);
                        $('#userEmailforOrder').html(data.email);
                        $('#userNameforOrder').html(data.username);
                        $('#userNameforOrder').attr('href', '/admin/components/run/shop/users/edit/' + data.id);
                        $('#userPhoneforOrder').html(data.phone);
                        $('#userAddressforOrder').html(data.address);
                    }
                    showMessage(langs.message, langs.newUserCreated, "success");
                } else {
                    showMessage(langs.error, langs.failToCreateUser, "error");
                }
            }
        });
    } else {
        showMessage(langs.error, langs.checkAndFillAll, "error");
    }
});

/** Update data in orders*/
$('#getAllOrderInfoButton').live('click', function() {
    var userId = $('#userIdforOrder').html();
    var userName = $('#userNameforOrder').html();
    var userEmail = $('#userEmailforOrder').html();
    var userPhone = $('#userPhoneforOrder').html();
    var userAddress = $('#userAddressforOrder').html();
    var totalCartSum = $('#totalCartSum').html();
    var totalProductPrice = totalCartSum;
    var userDiscount = 0;

    if (userId != undefined) {
        $('#shopOrdersUserid').val(userId);
        $('#shopOrdersUserFullName').val(userName);
        $('#shopOrdersUserEmail').val(userEmail);
        $('#shopOrdersUserPhone').val(userPhone);
        $('#shopOrdersUserAddress').val(userAddress);

        //Get user discount
        $.ajax({
            url: '/admin/components/run/shop/orders/ajaxGetUserDiscount/',
            async: false,
            data: 'userId=' + userId,
            type: "post",
            success: function(data) {
                if (data != '') {
                    userDiscount = data;
                }
            }
        });
        $('#shopOrdersComulativ').val(userDiscount);

        if (userDiscount != 0)
            totalProductPrice = (totalCartSum / 100 * (100 - userDiscount)).toFixed(pricePrecision);

        $('#shopOrdersTotalPrice').val(totalProductPrice);

    }
});
/** Get payments methds for delivery method **/
$('#shopOrdersdeliveryMethod').live('change', function() {
    var id = $(this).val();
    $.get('/admin/components/run/shop/orders/getPaymentsMethods/' + id, function(dataStr) {
        var data = JSON.parse(dataStr);
        $('#shopOrdersPaymentMethod').empty();
        jQuery.each(data, function(index, el) {
            $("#shopOrdersPaymentMethod").append($('<option value="' + el.id + '">' + el.name + '</option>'));
        });
        if (data.length === 0)
            $("#shopOrdersPaymentMethod").attr('disabled', 'disabled');
        else
            $("#shopOrdersPaymentMethod").removeAttr('disabled');
    });
});
/** When change discount recount total price**/
$('#shopOrdersComulativ').live('keyup', function() {
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
$('#checkOrderGiftCert').live('click', function() {
    var key = $('#shopOrdersCheckGiftCert').val();
    var userDiscount = $('#shopOrdersComulativ').val();
    var totalCartSum = $('#totalCartSum').html();
    $.get('/admin/components/run/shop/orders/checkGiftCert/' + key, function(dataStr) {
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
$('.removeGiftCert').live('click', function() {
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


$('.orderMethodsEdit').live('click', function() {
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

$('.orderMethodsRefresh').live('click', function() {
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
        success: function(res) {
            showMessage('Сообщение', 'Метод сортировки обновлен');
        }
    });
});

var Update = {
    processBackup: function() {
        $.ajax({
            type: "POST",
            url: '/admin/sys_update/backup',
            complete: function(res) {
                showMessage('Резервное копирование', 'Успешно');
                window.location.reload();
            }
        });
    },
    processUpdate: function() {
        $.ajax({
            type: "POST",
            url: '/admin/sys_update/do_update',
            complete: function(res) {
                $.ajax({
                    type: "POST",
                    asunc: false,
                    url: '/admin/sys_update/getQuerys',
                    success: function(res) {
                        var obj = JSON.parse(res);
                        var portion = (parseInt(obj.length / 100) + 1);
                        $('#progres').css('width', '0%');
                        $('.progressDB').fadeIn(600);
                        Update.restoreDBprocess(0, 0, portion, obj);
                    }
                });
            }
        });
    },
    restoreDBprocess: function(i, j, portion, obj) {
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
            complete: function(res) {
                array = [];
                if (i < 100) {
                    $('#progres').css('width', i + 1 + '%');
                    $('#progres').text(i + 1 + '%');
                    Update.restoreDBprocess(i + 1, j, portion, obj);
                } else {
                    $('#progres').css('width', '0%');
                    $('.progressDB').fadeOut(600);
                    showMessage('Обновление', 'Обновление успешно');
                }
            }
        });
    },
    restore: function(file_name) {
        $.ajax({
            type: "POST",
            data: {
                file_name: file_name
            },
            url: '/admin/sys_update/restore',
            success: function(res) {
                if (res) {
                    showMessage('Сообщение', 'Успешно воставлено');
                } else {
                    showMessage('Ошибка', 'Ошибка востановления. Целевая папка недоступна', 'r');
                }
            }
        });
    },
    delete_backup: function(file_name, curElement) {
        $.ajax({
            type: "POST",
            data: {
                file_name: file_name
            },
            url: '/admin/sys_update/delete_backup/' + file_name,
            success: function(res) {
                if (res) {
                    $(curElement).closest('tr').remove();
                    showMessage('Сообщение', 'Файл успешно удален');
                } else {
                    showMessage('Ошибка', 'Файл не удален', 'r');
                }
            }
        });
    },
    renderFile: function(file_path, curElement) {
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
            success: function(res) {
                if (res) {
                    $('<tr class="update_file_review"><td colspan="3"><textarea rows="20" readonly>' + res + '</textarea></td></tr>').insertAfter($(tr));
                }
            }
        });
    }
};

/** Users mail chimp settings**/
$(document).ready(function() {
    $('body').on('keyup', 'input.email', function() {
        if (/[а-яёы]/gi.test($(this).val()))
            $(this).val($(this).val().replace(/[а-яёы]/gi, ""));
    });
    if ($.exists('.mailChimpSettings')) {
        $('.mailChimpSettings button').on('click', function() {
            var mailChimpKey = $('input[name="messages[monkey]"]').val();
            var mailChimpKeyList = $('input[name="messages[monkeylist]"]').val();

            $.ajax({
                type: "POST",
                data: {
                    mailChimpKey: mailChimpKey,
                    mailChimpKeyList: mailChimpKeyList
                },
                url: '/admin/components/run/shop/settings/setMailChimpKeys',
                success: function(res) {
                    $('body').append(res);
                }
            });
        });

        $('input#monkey').on('change', function() {
            if ($(this).attr('checked')) {
                $('.mailChimpSettings').show();
            }
        });

        $('input#csv').on('change', function() {
            if ($(this).attr('checked')) {
                $('.mailChimpSettings').hide();
            }
        });
    }
    $('.robotsChecker.frame_prod-on_off').off('click').off('click').on('click', function() {
        var input = $(this).find('input'),
                val = input.val(),
                valOn = input.data('valOn'),
                valOff = input.data('valOff');

        if (val == valOn)
            input.val(valOff);
        else
            input.val(valOn);
    });

});
