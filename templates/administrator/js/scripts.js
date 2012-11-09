$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir) {
    return (nabir.length > 0);
}

var notificationsInitialized = false;

$(document).ajaxComplete(function(event, XHR, ajaxOptions) {
    if (ajaxOptions.url != "/admin/components/run/shop/notifications/getAvailableNotification")
    {
//        console.log(XHR.getAllResponseHeaders());
        if ((XHR.getAllResponseHeaders().match(/X-PJAX/)))
        {
            initAdminArea();
            init_2();
//        console.log(XHR.getAllResponseHeaders().split(" "));        
        
//        console.log(XHR.getAllResponseHeaders().match(/X-PJAX/));


            number_tooltip_live();
            fixed_frame_title();
            $('.tooltip').remove();
            dropDownMenu();
            autocomplete();
        }
        if ($.exists('#chart')) brands();
        if ($.exists('#wrapper_gistogram')) gistogram();

    }
});

function init_2() {
    $('#loading').css({
        'height': $(window).height(),
        'background-position': '50%' + ($(window).height() - $('#mainContent').offset().top) / 2 + 'px'
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
            })
        })
    }
    //not_standart_checks----------------------
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
    $('.btn.disabled').each(function(event) {
        $(this).attr('disabled', true);
    })

    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function() {
            active_b_p = '-46px -17px';
            n_active_b_p = '-46px 0';
            changeCheckStart($(this));
        });
    }
    if ($.exists('.niceRadio')) {
        $(".niceRadio").each(function() {
            active_R_b_p = '-179px -17px';
            n_active_R_b_p = '-179px 0';
            changeRadioStart($(this));
        });
    }
    $(".frame_label:has(.niceCheck)").die('click').live('click', function() {
        var $this = $(this);
        if ($this.closest('thead')[0] != undefined) {
            changeCheck($this.find('> span:eq(0)'))
            if ($this.hasClass('active')) {
                $this.parents('table').find('.frame_label').each(function() {
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
            else
            {
                $(this).parents('table').find('.frame_label').each(function() {
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
        else if ($this.closest('.head')[0] != undefined) {
            changeCheck($this.find('> span:eq(0)'))
            if ($this.hasClass('active')) {
                $this.parents('#category').find('.frame_label').each(function() {
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
            else
            {
                $(this).parents('#category').find('.frame_label').each(function() {
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
        else {
            changeCheck($this.find('> span:eq(0)'));
        }
        if (!$this.hasClass('no_connection')) {
            dis_un_dis();
        }
        return false;
    });

    $(".frame_label:has(.niceRadio)").die('click').click(function() {
        var $this = $(this);
        changeRadio($this.find('> span:eq(0)'));
    });
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
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
        }
        if (el.closest('.comments').next('tr').length > 0) {
            temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function() {
                changeCheckallchecks($(this).find('> span:eq(0)'));
            })
        }
    }
    function check2(el, input) {
        var el = el;
        var input = input;
        el.css("background-position", n_active_b_p);
        el.parent().removeClass('active');
        input.attr("checked", false);

        if (el.closest('.sortable').children('tr').length > 0)
            el.closest('.sortable').children('tr').has(el).removeClass('active')

        else if (el.closest('.sortable2').find('tr').length > 0)
            el.closest('.sortable2').find('tr').has(el).removeClass('active')

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
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
        if (el.closest('.comments').next('tr').length > 0) {
            temp_nabir = el.closest('.comments').next('tr:not(.comments)').find('.frame_label').each(function() {
                changeCheckallreset($(this).find('> span:eq(0)'));
            })
        }
    }
    function check3(el, input) {
        var el = el;
        var input = input;
        el.css("background-position", active_R_b_p);
        el.parent().addClass('active');
        input.attr("checked", true);
        el.parents('.row-category, tr').addClass('active');
        $('[name=' + input.attr('name') + ']').not(input).each(function() {
            check4($(this).parent(), $(this))
        })
    }
    function check4(el, input) {
        var el = el;
        var input = input;
        el.css("background-position", n_active_R_b_p);
        el.parent().removeClass('active');
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
            el.closest('.sortable2').find('tr').has(el).addClass('active')
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
            el.closest('.sortable2').find('tr').has(el).removeClass('active')
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
    $('.all_select').toggle(function() {
        $(this).parents('table').find('tbody .frame_label').each(function() {
            changeCheckallchecks($(this).find('> span:eq(0)'));
        })
    },
            function() {
                $(this).parents('table').find('tbody .frame_label').each(function() {
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            });
    $('.all_diselect').die('click').live('click', function() {
        $(this).parents('table').find('.frame_label').each(function() {
            changeCheckallreset($(this).find('> span:eq(0)'));
        })
    })

    if ($.exists('[data-rel="tooltip"], [rel="tooltip"]'))
        $('[data-rel="tooltip"], [rel="tooltip"]').not('tr').not('.row-category').tooltip({
            'delay': {
                show: 500,
                hide: 100
            }
        });
    $('[data-max]').die('keyup').live('keyup', function(event) {
        $this = $(this);
        if ($this.val() > $this.data('max')) {
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
    $('#kitMainProductName').autocomplete({
        minChars: 1,
        source: '/admin/components/run/shop/kits/get_products_list/' + $('#kitMainProductName').val() + '&limit=20',
        select: function(event, ui) {
            $('#MainProductHidden').attr('value', ui.item.identifier.id);
            $('#kitMainProductName').attr('value', ui.item.label);
        }
    });

    $('#AttachedProducts').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/kits/get_products_list/' + $('#AttachedProducts').attr('value') + '&limit=20',
        select: function(event, ui) {
            var mainDisc = $('#mainDisc').attr('value');
            $('#forAttached').append('<div id="tpm_row' + ui.item.identifier.id + '" class="m-t_10">' +
                    '<span class="d-i_b number v-a_t">' +
                    '<span class="help-inline d_b">ID</span>' +
                    '<input type="text" name="AttachedProductsIds[]" value="' + ui.item.identifier.id + '" class="input-mini"/>' +
                    '</span>&nbsp;' +
                    '<span  class="d-i_b v-a_t">' +
                    '<span class="help-inline d_b">Имя</span>' +
                    '<input type="text" id="AttachedProducts" value="' + ui.item.label + '" class="input-xxlarge"/>' +
                    '</span>&nbsp;' +
                    '<span  class="d-i_b number v-a_t">' +
                    '<span class="help-inline d_b">Скидка %</span>' +
                    '<input type="text" id="AttachedProductsDisc" name="Discounts[]" value="' + mainDisc + '" class="input-mini" data-max="100" data-rel="tooltip" data-title="только цифры"/>' +
                    '</span>&nbsp;' +
                    '<span  class="d-i_b v-a_t" style="margin-top:18px;">' +
                    '<button class="btn btn-danger btn-small del_tmp_row" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash icon-white"></i></button>' +
                    '</span>' +
                    '</div>');
        },
        close: function(event, ui) {
            $('#AttachedProducts').attr('value', '');
        }
    });

    $('#RelatedProducts').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/kits/get_products_list/' + $('#RelatedProducts').attr('value') + '&limit=20',
        select: function(event, ui) {
            $('#relatedProductsNames').append('<div id="tpm_row' + ui.item.identifier.id + '">' +
                    '<span style="width: 70%;margin-left: 1%;" class="pull-left">' +
                    '<input type="text" id="AttachedProducts" value="' + ui.item.label + '"/>' +
                    '<input type="hidden" name="RelatedProducts[]" value="' + ui.item.identifier.id + '">' +
                    '</span>' +
                    '<span style="width: 8%;margin-left: 1%;" class="pull-left">' +
                    '<button class="btn btn-small del_tmp_row" data-kid="' + ui.item.identifier.id + '"><i class="icon-trash"></i></button>' +
                    '</span>' +
                    '</div>');
        },
        close: function(event, ui) {
            $('#RelatedProducts').attr('value', '');
        }
    });
    $('#emailAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/cp/user_manager/auto_complit/email' + $('#emailAutoC').attr('value') + '?limit=25'
    });

    $('#nameAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/cp/user_manager/auto_complit/name' + $('#nameAutoC').attr('value') + '?limit=25'

    });

    //    AUTO COMPLITE SHOP--------------------------------------------------------------------------------------------------



    $('#shopNameAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/users/auto_complite/name' + $('#shopNameAutoC').attr('value') + '?limit=25'

    });

    $('#shopEmailAutoC').autocomplete({
        minChars: 0,
        source: '/admin/components/run/shop/users/auto_complite/email' + $('#shopNameAutoC').attr('value') + '?limit=25'

    });

    if (window.hasOwnProperty('tpls'))
        $('#inputTemplateCategory').autocomplete({
            source: tpls
        });
}
function textcomment_s_h(status, el) {
    var status = status;
    var el = el;
    var textcomment = el.closest('tr').find('.text_comment');
    if ($.exists_nabir(textcomment)) {
        if (status == 's' && textcomment.css('display') != 'none')
        {
            var textcomment_h = textcomment.outerHeight();
            console.log(textcomment)
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
                span.innerHTML = ['<img style="max-width:100px;" src="', e.target.result,
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
function number_tooltip() {
    $('.number input').tooltip({
        'delay': {
            show: 500,
            hide: 100
        }
    }).die('keypress').live('keypress', function(event) {
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
            $(this).tooltip('show');
            return false
        }
        else
            $(this).tooltip('hide');
    });
}
function getScrollTop() {
    var scrOfY = 0;
    if (typeof(window.pageYOffset) == "number") {
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
    fixed_block = $(".frame_title:not(.no_fixed)");
    mini_layout = $('.mini-layout');
    container = $('.container');

    if ($.exists_nabir(fixed_block)) {
        var fixed_block_top = mini_layout.offset().top;
        var fixed_block_h = fixed_block.outerHeight(true);

        var top = getScrollTop();

        if (top < fixed_block_top)
            fixed_block.css("top", fixed_block_top - top + 20);
        else
            fixed_block.css("top", 20);

        fixed_block.css('width', container.width() - 2);
        mini_layout.css('padding-top', 20 + fixed_block_h)
    }
}
function difTooltip() {
    //  tooltip
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
                })
                place_tr_ttp = 'top'
            }
            else {
                $this.tooltip({
                    'placement': 'left',
                    'delay': {
                        show: 500,
                        hide: 100
                    }
                })
                place_tr_ttp = 'left'
            }
        })
    }
    else
        place_tr_ttp = 'top'
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
    if ($.exists('#shopAdminMenu')) {
        if (isShop)
        {
            $('#shopAdminMenu').show();
            $('#topPanelNotifications').fadeIn(200);

        }
    }

    console.log('initialising of administration area started');
    var startExecTime = Date.now();

    //gistogram
    $('[name="date"]').die('change').live('change', function() {
        $.pjax({
            'url': '/admin/components/run/shop/charts/byDate/' + $(this).val(),
            'container': '#mainContent',
            timeout: 3000
        });
    });

    //  tabs
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

    //  drop search
    if ($.exists('.typeahead'))
        $('.typeahead').typeahead();

    //init tooltip
    difTooltip();

    //sortable
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
            cancel: '.head_body, .btn, .frame_label, td p, td span, td a, td input, td select',
            helper: function(e, tr)
            {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index)
                {
                    $(this).width($originals.eq(index).width())
                });
                $helper.addClass('active');
                return $helper;
            }

        });
    }
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
            nextText: ''
        });
    }
    $('.ui-datepicker').addClass('dropdown-menu');

    //    $('.ui-dialog button').ready(function(){ $('.ui-dialog button').addClass('btn')});

    //my
    $('html').die('click').live('click', function(event) {
        if ($(event.target).filter('.popover')[0] == undefined && $(event.target).parents('.popover')[0] == undefined && $(event.target).filter('.buy_prod')[0] == undefined && $(event.target).parents('.buy_prod')[0] == undefined && $(event.target).filter('.popover_ref')[0] == undefined && $(event.target).parents('.popover_ref')[0] == undefined) {
            if ($.exists('.popover, .buy_prod, .popover_ref')) {
                $(this).find('.popover').popover('hide');
                $(this).find('.buy_prod').popover('hide');
                $(this).find('.popover_ref').popover('hide');
            }
        }
        event.stopPropagation();
    });

    $('.js_price').die('click').live('click', function() {
        $(this).next().show();
    }).die('focus').live('focus', function() {
        $(this).click();
    }).die('blur').live('blur', function() {
        if ($(this).data('value') == $(this).val()) {
            $(this).next().hide();
            $(this).tooltip('hide');
        }
    }).die('keydown').live('keydown', function(event) {
        if (what_key('13', event)) {
            $(this).next().trigger('click');
        }
    });
    $('.share_alt').hover(function() {
        $(this).find('.go_to_site').css('visibility', 'visible');
    }, function() {
        $(this).find('.go_to_site').css('visibility', 'hidden');
    });
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
    })
    $('#category .btn:has(.icon-minus)').die('click').live('click', function() {
        var $this = $(this);
        $this.closest('.row-category').next().hide();
        $this.hide().next().show();
    })

    $('td .patch_disabled').each(function() {
        $(this).css('height', $(this).parents('td').height())
    })

    $('[type="file"]').die('change').change(function() {
        var $this = $(this);
        $this.parent().prev().children().val($this.val());
    });
    $('.item_menu .row-category:even').addClass('even');

    if (window.hasOwnProperty('userLogined') && !notificationsInitialized)
    {
        window.setInterval('updateNotificationsTotal()', 20000);
        notificationsInitialized = true;
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

    $('.listFilterForm').die('focus').live('focus', function() {
        $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
    });

    $('.listFilterSubmitButton').die('click').live('click', function() {
        if (!$(this).attr('disabled') && !$(this).hasClass('disabled'))
        {
            $('.listFilterForm').ajaxSubmit({
                target: '#mainContent'
            });
        }
    });


    $('.controls img.img-polaroid').die('click').live('click', function() {
        $(this).closest('.control-group').find('input:file').click();
    });

    $('[data-url="file"] input[type="file"]').die('change').live('change', function(e) {
        $this = $(this);
        $type_file = $this.val();

        var file = this.files[0];

        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        }

        reader.readAsDataURL(file);
        $(img).addClass('img-polaroid').css({
            width: '100px'
        });
        $(this).closest('.control-group').find('.controls').html(img);
        $this.parent().next().val($type_file).attr('data-rel', 'tooltip');

    });

    
    $('#mainContent a.pjax').die('click').click(function(event){
        event.preventDefault();
        $.pjax({
            url:$(this).attr('href'), 
            container:'#mainContent',
            timeout: 0

        })
        return false;
    });

    $(document).on('pjax:start', function() {
        $('#loading').stop().fadeIn(100)
    })
            .on('pjax:end', function() {
        $('#loading').stop().fadeOut(100)
    });


    //add arrows to orders list
    if (window.hasOwnProperty('orderField'))
        if (orderField != "")
            if (noc == 'DESC')
                $('#order' + orderField).find('a').after('&uarr;');
            else
                $('#order' + orderField).find('a').after('&darr;');

    if ($('textarea.elRTE').length > 0)
        initElRTE();

    if ($('#elFinderTPLEd').length > 0)
        elFinderTPLEd();

    //elRTE bugFix for Firefox

    $('.myTab a').live('click', function() {
        initElRTE();
        return true;
    });
    
    $('button.rmAddPic').die('click').live('click', function(event){
        event.preventDefault();
        $(this).closest('label').find('input[type=hidden]').val($(this).data('i'));
        $(this).closest('label').find('span').find('input[type=file]').val('');
        $(this).closest('div.control-group').find('img').attr('src', '/templates/administrator/images/select-picture.png');
        return false;
    });
    
    console.log('initialising of administration area ended');
    console.log('script execution time:' + (Date.now() - startExecTime) / 1000 + " sec.")
}
;
//    console.log('initialising of administration area ended');
//    
//}
// 

//console.log('script execution time:' + ( Date.now() - startExecTime)/1000  + " sec.");

$(document).ready(

    function(){
        if ($.exists('#topPanelNotifications')) updateNotificationsTotal();
        initAdminArea();
        //$('.nav .dropdown-menu a').die('click');

        $('a.pjax').not('#mainContent a.pjax').die('click').click(function(event){
            event.preventDefault();
            $.pjax({
                url:$(this).attr('href'), 
                container:'#mainContent',
                timeout: 3000
            });
            $('nav li').removeClass('active');
            $(this).closest('li').addClass('active').closest('li.dropdown').addClass('active').removeClass('open');
            return true;
        });
                
        
        $('.main_body').append('<div class="overlay"></div>');
    
        $(this).keydown(function (e) {
            e = e || window.event;
            if (e.target.id == "baseSearch" || e.target.id == "shopSearch")
            {
                if ( (e.keyCode === 13 || (e.keyCode === 83 && e.ctrlKey) ) && e.target.localName != 'textarea' ) {
                    $('#adminSearchSubmit').click();
                    return false;
                }
           }
        });


            $('a.pjax').die('click').click(function(event) {
                event.preventDefault();
                $.pjax({
                    url: $(this).attr('href'),
                    container: '#mainContent',
                    timeout: 3000
                });
                $('nav li').removeClass('active');
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

            if ($('#baseSearch').length)
            {
                $.get('/admin/admin_search/autocomplete', function(data) {
                    baseAutocompleteData = JSON.parse(data);
                    //                console.log(baseAutocompleteData);
                    $('#baseSearch').autocomplete({
                        source: baseAutocompleteData
                    });
                });
            }

            $('#rep_bug').die('click').live('click', function() {
                var overlay = $('.overlay');
                overlay.css({
                    'height': $(document).height(),
                    'opacity': 0.5
                });
                overlay.fadeIn(function() {
                    $('.frame_rep_bug').find('.alert').remove().end().fadeIn();
                });
                overlay.die('click').live('click', function() {
                    $('.frame_rep_bug').fadeOut(function() {
                        overlay.fadeOut();
                    })
                });
                return false;
            });
            $('.frame_rep_bug [type="submit"]').die('click').live('click', function() {
                var url = 'hostname=' + location.hostname + '&pathname=' + location.pathname + '&user_name=' + $('#user_name').text() + '&text=' + $('.frame_rep_bug textarea').val() + '&ip_address=' + $('.frame_rep_bug #ip_address').val();
                $.ajax({
                    type: 'GET',
                    url: 'admin/report_bug',
                    data: url,
                    success: function(data) {
                        $('.frame_rep_bug').prepend('<div class="alert alert-success">Ваше повідомлення відправлено</div>');
                        setTimeout(function() {
                            overlay.trigger('click')
                        }, 2000)
                    }
                })
                return false;
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
                if (e.ctrlKey)
            $('#baseSearch').blur();
                //if ((event.ctrlKey && event.shiftKey) || (event.shiftKey && event.altKey)) $('.baseSearch:first').focus();
                if (e.keyCode === 83 && e.ctrlKey) {
                    if (!dataSubmit.hasClass('disabled') && dataSubmit.closest('.tab-pane').css('display') != 'none')
                dataSubmit.trigger('click');
                    return false;
                }
            });

            init_2();
            autocomplete();
            //list filter

            $('.listFilterForm').die('keydown').live('keydown', function(event) {
                $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
                if (what_key(13, event))
                    $('.listFilterSubmitButton').trigger('click');
            })

            /*      menu        */
            var found = false;
            $('#mainAdminMenu a').each(function() {
                if ($(this).attr('href').match(window.location.pathname) && !found)
                {
                    //                console.log($(this));
                    $(this).closest('li').addClass('active');
                    $('li.active').closest('ul').closest('li').addClass('active');
                    found = true;
                }
            })

            /**/
            $('#baseSearch').focus();
        });

$(window).load(function() {
    $(window).resize(function(event) {
        fixed_frame_title();
        if ($.exists_nabir(fixed_block)) {
            fixed_block_h = fixed_block.outerHeight(true);
            fixed_block_top = mini_layout.offset().top;
            $(this).trigger('scroll');
        }
        $('.fade.in').remove();
        difTooltip();
        $('#loading').css({
            'height': $(window).height(),
            'background-position': '50%' + ($(window).height() - $('#mainContent').offset().top) / 2 + 'px'
        });
    }).resize();
    $(window).scroll(function() {
        fixed_frame_title();
    })
})
