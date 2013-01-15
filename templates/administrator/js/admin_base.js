$(document).ready(function() {

//***************Scripts for modules table***************    

    //*****changes autoload for any module*****
    $('.autoload_ch').live('click', function() {
        var mid = $(this).attr('data-mid');
        var $this = $(this);
        $.ajax({
            type: 'post',
            data: 'mid=' + mid,
            dataType: "json",
            url: '/admin/components/change_autoload',
            success: function(obj) {
                if (obj.result === false) {
                    showMessage('Ошибка', 'Что-то пошло не так. Статус автозагрузки не изменен.');
                }
            }
        });
    });
    //*****changes autoload for any module*****

    //*****changes url access for any module*****
    $('.urlen_ch').live('click', function() {
        var mid = $(this).attr('data-mid');
        var murl = $(this).attr('data-murl');
        var mname = $(this).attr('data-mname');
        var $this = $(this);
        if (!$(this).hasClass('disabled')) {
            $.ajax({
                type: 'post',
                data: 'mid=' + mid,
                dataType: "json",
                url: '/admin/components/change_url_access',
                success: function(obj) {
                    if (obj.result === false) {
                        showMessage('Ошибка', 'Что-то пошло не так. Доступ по URL не изменен.');
                    } else {
                        if (obj.result.enabled === 1)
                        {
                            $this.parents('tr:first').children('td.urlholder').html('<a target="_blank" href="' + murl + '">' + mname + '</a>');
                        } else {
                            $this.parents('tr:first').children('td.urlholder').html(' - ');
                        }
                    }
                }
            });
        }
    });
    //*****changes url access for any module*****

    //*****module installing*****
    $('.mod_instal').live('click', function() {
        var mname = $(this).attr('data-mname');
        var $this = $(this);
        $.ajax({
            type: 'post',
            dataType: "json",
            url: '/admin/components/install/' + mname,
            success: function(obj) {
                if (obj.result === true) {
                    var trin = $this.parents('tr:first').clone();
                    trin.children('td.fdel').remove();
                    trin.children('td.fdel2').remove();
                    trin.append('<td><p> - <p></td>');
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="включить"  data-off="выключить"><span class="prod-on_off autoload_ch" data-mid="{$module.id}"></span></div></td>')
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="выключить"  data-off="выключить"><span class="prod-on_off urlen_ch" data-mid="{$module.id}"></span></div></td>')
                    $('#mtbl').append(trin);
                    $this.parents('tr:first').remove();
                    if ($('tbody.nim').children('tr').contents().length === 0)
                    {
                        $('#nimt').remove();
                        $('#nimc').html('</br><div class="alert alert-info">Нету модулей для установки</div>');
                    }
                    showMessage('Установка модуля', 'Модуль успешно установлен');
                    location.reload();
                }
            }
        });
    });
    //*****module installing*****

    //*****change module visibility in menu*****
    $('.show_in_menu').live('click', function() {
        var id = $(this).attr('data-mid');
        $.ajax({
            url: "/admin/components/change_show_in_menu",
            data: "id=" + id,
            type: "post",
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });
    //*****change module visibility in menu*****

//***************Scripts for modules table***************            

//***************Scripts for languages page***************

    //*****change language by default*****
    $('.lan_def').live('click', function() {
        if ($(this).hasClass('btn-primary active')) {
            return false;
        }
        var id = $(this).attr('data-id');
        var th = $(this);
        $.ajax({
            type: "post",
            url: "/admin/languages/set_default",
            data: "lang=" + id,
            success: function(data) {
                $('.lan_def').removeClass('btn-primary active');
                th.addClass('btn-primary active');
                $('.notifications').append(data);
            }
        });
    });
    //*****change language by default*****

//***************Scripts for languages page***************
    $('span.selwid').live('click', function() {
        var title = $(this).attr('data-title');
        var mname = $(this).attr('data-mname');
        var mmethod = $(this).attr('data-method');
        $('.selmod').html('<b>' + title + '</b>');
        $('#sw').attr('value', mname);
        $('#swm').attr('value', mmethod);
    });

    $('#inputType').live('change', function() {
        if ($(this).attr('value') === 'html')
        {
            $('#moduleholder').fadeOut(200, function() {
                $('#textareaholder').css('display', '');
                initElRTE();
            });
            $('#mod_name').fadeOut(200);

        } else {
            $('#textareaholder').fadeOut(200, function() {
                $('#moduleholder').css('display', '');
                $('#mod_name').css('display', '');
            });
        }
    });

    $('.submit_form').live('click', function() {
        var options = {
            dataType: "json",
            success: function(obj) {
                if (obj.result === false)
                {
                    showMessage('Создание виджета', 'Ошибка' + obj.message);
                } else {
                    var url = '/admin/widgets_manager';
                    showMessage('Создание виджета', 'Виджет успешно создан');
                    redirect_url(url);
                }
            }
        };
        $('#wid_cr_form').ajaxSubmit(options);
    });

    $('.submit_an_create').live('click', function() {
        var options = {
            dataType: "json",
            success: function(obj) {
                if (obj.result === false)
                {
                    showMessage('Создание виджета', 'Ошибка' + obj.message);
                } else {
                    var url = '/admin/widgets_manager/create_tpl';
                    showMessage('Создание виджета', 'Виджет успешно создан');
                    redirect_url(url);
                }
            }
        };
        $('#wid_cr_form').ajaxSubmit(options);
    });

    function redirect_url(url)
    {
        $(location).attr('href', url);
    }

    $('#cr_wid_page').live('click', function() {
        var url = '/admin/widgets_manager/create_tpl';
        redirect_url(url);
    });

    $('#watermark_type').live('change', function() {
        if ($(this).attr('value') === 'overlay') {
            $('.fortextblock').hide('slow', function() {
                $('.forimageblock').css('display', '');
            });
        }
        if ($(this).attr('value') === 'text') {
            $('.forimageblock').hide('slow', function() {
                $('.fortextblock').css('display', '');
            });
        }
    });

    $('.select_tpl').live('click', function() {
        var path = $(this).attr('data-path');
        $('img.tpl_image').removeClass('sel_template');
        $(this).children('img').addClass('sel_template');
        $('#systemTemplatePath').attr('value', path);
    });

    $('.select_mobile_tpl').live('click', function() {
        var path = $(this).attr('data-path');
        $('img.mobile_tpl_image').removeClass('sel_template');
        $(this).children('img').addClass('sel_template');
        $('#mobileTemplatePath').attr('value', path);
    });

    $('.currency_def').live('click', function() {
        var currency_id = $(this).data('currid');
        $.ajax({
            type: 'post',
            data: 'id=' + currency_id,
            url: '/admin/components/run/shop/currencies/makeCurrencyDefault',
            success: function(data) {
                if (data) {
                    $('.currency_def').removeClass('active');
                    $('#currdef' + currency_id).addClass('active');
                }
            }
        });
    });

    $('.currency_main').live('click', function() {
        var currency_id = $(this).data('currid');
        $.ajax({
            type: 'post',
            data: 'id=' + currency_id,
            url: '/admin/components/run/shop/currencies/makeCurrencyMain',
            success: function(data) {
                if (data) {
                    $('.currency_main').removeClass('active');
                    $('#currmain' + currency_id).addClass('active');
                }
            }
        });
    });

    //get values from niceCheck checkboxes
    function getcheckedvalues()
    {
        var arr = new Array();
        var inputs = $('.niceCheck').children('input');
        inputs.each(function() {
            var inp = $(this);
            if (inp.attr('checked') === 'checked')
            {
                if (inp.attr('value') != 'On') {
                    arr.push(inp.attr('value'));
                }
            }
        });
        return arr;
    }

//    $('#del_sel_group').live('click', function() {
//        if ($(this).hasClass('disabled')) {
//            return false;
//        } else {
//            if (confirm('Удалить группу?'))
//            {
//                var arr = getcheckedvalues();
//                $.post('/admin/components/run/shop/rbac/group_delete', {
//                    id: arr
//                },
//                        function(data) {
//                            $('.notifications').append(data);
//                        }
//                );
//            }
//        }
//    });
//
//    $('#del_sel_priv').live('click', function() {
//        if ($(this).hasClass('disabled')) {
//            return false;
//        } else {
//            if (confirm('Удалить группу?'))
//            {
//                var arr = getcheckedvalues();
//                $.post('/admin/components/run/shop/rbac/privilege_delete', {
//                    id: arr
//                },
//                        function(data) {
//                            $('.notifications').append(data);
//                        }
//                );
//            }
//        }
//    });

    $('.catfilter').live('change', function() {
        redirect_url('/admin/components/run/shop/properties/index/' + $(this).attr('value'));
//        $.pjax({
//            url: '/admin/components/run/shop/properties/index/' + $(this).attr('value'),
//            container: '#mainContent'
//        });
    });

    $('#generateButton').live('click', function() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: '/admin/components/run/shop/gifts/generateKey',
            success: function(obj) {
                $('#keyholder').attr('value', obj.key);
            }
        })
    });

    $('.ch_active').live('click', function() {
        var cid = $(this).attr('data-cid');
        var $this = $(this);
        $.ajax({
            type: 'post',
            url: '/admin/components/run/shop/gifts/ChangeActive/' + cid,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

//***************Scripts for comments***************

    $('.comment_update').live('click', function() {
        var id = $(this).attr('data-cid');
        var user_name = $('#u_ed' + id).attr('value');
        var user_mail = $('#m_ed' + id).attr('value');
        var status = $(this).attr('data-cstatus');
        var text = $('#edited_com_text' + id).attr('value');
        var text_plus = $('#edited_com_text_plus' + id).attr('value');
        var text_minus = $('#edited_com_text_minus' + id).attr('value');
        $.ajax({
            type: 'post',
            url: '/admin/components/cp/comments/update',
            data: 'id=' + id + '&user_name=' + user_name + '&user_mail=' + user_mail + '&text=' + text + '&status=' + status + '&text_plus=' + text_plus + '&text_minus=' + text_minus,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('.to_spam').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'post',
            url: '/admin/components/cp/comments/update_status',
            data: 'id=' + id + '&status=' + 2,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });
    dropDownMenu();

    $('#comment_delete').live('click', function() {
        if ($(this).hasClass('disabled')) {
        } else {
            var arr = getcheckedvalues();
            $.post('/admin/components/cp/comments/delete', {
                id: arr
            },
            function(data) {
                $('.notifications').append(data);
            }
            );
        }
    });

    $('.com_del').live('click', function() {
        var id = $(this).attr('data-id');
        $.post('/admin/components/cp/comments/delete', {
            id: id
        },
        function(data) {
            $('.notifications').append(data);
        }
        );
    });

    $('.to_approved').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'post',
            url: '/admin/components/cp/comments/update_status',
            data: 'id=' + id + '&status=' + 0,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('.to_waiting').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'post',
            url: '/admin/components/cp/comments/update_status',
            data: 'id=' + id + '&status=' + 1,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('.comment_update_cancel').live('click', function() {
        var id = $(this).attr('data-cid');
        textcomment_s_h('h', $(this));
        //$('#nc' + id).trigger('click');
    });

    $('.text_comment').live('click', function() {
        var id = $(this).parents('tr').attr('data-id');
        textcomment_s_h('s', $(this));
        //display_edit_fields(id);
    });

    function display_edit_fields(id)
    {
        $('#nc' + id).trigger('click');
    }

//***************Scripts for modules table***************

    $('#translateCategoryTitle').live('click', function() {
        var str = $('#inputName').attr('value');
        $.ajax({
            type: 'post',
            url: '/admin/components/run/shop/categories/ajax_translit',
            data: 'str=' + str,
            success: function(data) {
                $('#inputUrl').attr('value', data);
            }
        });
    });

    $('.cat_change_active').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: '/admin/components/run/shop/categories/changeActive',
            data: 'id=' + id,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('#create_tpl').live('click', function() {
        var name = prompt('Введите название шаблона', '');
        if (name != null && name != "") {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/admin/components/run/shop/categories/create_tpl",
                data: "filename=" + name,
                success: function(obj) {
                    $('.notifications').append(obj.responce);
                    if (obj.result) {
                        $('#inputTemplateCategory').attr('value', name);
                    }
                }
            });
        }
    });

    $('.prop_active').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "/admin/components/run/shop/properties/changeActive",
            data: "id=" + id,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    function save_positions(url) {
        var arr = new Array();
        $('input[name=ids]').each(function() {
            arr.push($(this).val());
        });
        $.post(
                url,
                {
                    positions: arr
                },
        function(data) {
            $('.notifications').append(data);
        });
    }

    //  sortstop blocks end    

    $('.kit_change_active').live('click', function() {
        var id = $(this).attr('data-kid');
        $.ajax({
            type: "post",
            url: "/admin/components/run/shop/kits/kit_change_active/" + id,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });

    $('.del_tmp_row').live('click', function() {
        var id = $(this).attr('data-kid');
        $('#tpm_row' + id).remove();
    });

    product = new Object;

    product.toHit = function() {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxChangeHit', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        }
        );
    };

    product.toNew = function()
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxChangeHot', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        }
        );
    };

    product.toAction = function() {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxChangeAction', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        }
        );
    }

    product.cloneTo = function() {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxCloneProducts', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        }
        );
    };

    product.toCategory = function() {
        $('.modal_move_to_cat').modal();
    }

    $(".save_positions").live("sortstop", function(event, ui) {
        var url = $(this).attr('data-url');
        save_positions(url);
    });

    $('.item_hidden').live('click', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "/admin/components/cp/menu/change_hidden",
            data: "id=" + id,
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('#category_sel').live('change', function() {
        var id = $(this).attr('value');
        var per_page = $('#per_page').attr('value');
        $.ajax({
            type: "post",
            dataType: "json",
            data: "per_page=" + per_page,
            url: "/admin/components/run/menu/get_pages/" + id + "/0",
            success: function(obj) {
                if (obj) {
                    var st = '';
                    $.each(obj.pages_list, function(index, value) {
                        st += '<li><a href="#" class="page_title" data-title="' + this.title + '" data-id="' + this.id + '">' + this.title + '</a></li>';
                    });
                    $('#pages_list_holder').html('<ul>' + st + '</ul>');
                } else {
                    $('#pages_list_holder').html('В категории нет страниц');
                }
            }
        });
    });

    $('#per_page').live('change', function() {
        $('#category_sel').trigger('change');
    });

    $('.page_title').live('click', function() {
        $('#page_id_holder').html($(this).attr('data-id'));
        $('#item_title').attr('value', $(this).attr('data-title'));
        $('#item_page_id').attr('value', $(this).attr('data-id'));
    });

    $('.link_type').live('change', function() {
        var identif = $(this).val();
        $('.edit_holder').hide();
        $('#' + identif).show();
        $('.submit_link').each(function() {
            $(this).attr('data-form', '#' + identif + '_form')
            $('input[name=item_type]').attr('value', identif);
        });
    });

    $('.category_item').live('click', function() {
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        $('#cat_input').attr('value', id);
        $('#cat_id_holder').html(id);
        $('#item_cat_title').attr('value', title)
    });

    $('.module_item').live('click', function() {
        var mname = $(this).attr('data-mname');
        var title = $(this).html();
        $('input[name=mod_name]').attr('value', mname);
        $('#module_item_title').attr('value', title);
        $('#module_name_holder').html(mname);

    });

    $('.product_list_order').live('click', function() {
        var column = $(this).attr('data-column');
        $('input[name=orderMethod]').attr('value', column);
        if ($('input[name=order]').attr('value') === '') {
            $('input[name=order]').attr('value', 'ASC');
        } else {
            if ($('input[name=order]').attr('value') === 'ASC') {
                $('input[name=order]').attr('value', 'DESC');
            } else {
                $('input[name=order]').attr('value', 'ASC');
            }
        }
        ;
        var query_string = $('#filter_form').serialize();
        $.pjax({
            url: '/admin/components/run/shop/search/index/?' + query_string,
            container: '#mainContent'
        });
    });
    ;

    $('.move_to_cat').live('click', function() {
        var catId = $('#moveCategoryId').attr('value');
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxMoveProducts', {
            ids: ids, categoryId: catId
        }, function(data) {
            $('.notifications').append(data);
        }
        );
    });

    $('.kit_del').live('click', function() {
        $('.modal_del_kit').modal();
    });

    $('.kit_del_ok').live('click', function() {
        var id = $('.kit_del').attr('data-kid');
        $.ajax({
            url: '/admin/components/run/shop/kits/kit_delete',
            data: 'ids=' + id,
            type: 'post',
            success: function(data) {
                $('.modal_del_kit').modal('hide');
                $('.notifications').append(data);
                location.reload();
            }
        });
    });


    $('#addVariant').live('click', function() {
        var clonedVarTr = $('.variantRowSample').find('tr').clone();
        var randId = Math.ceil(Math.random() * 1000000);
        var countVarRows = $('#variantHolder').children('tr').length;
        clonedVarTr.find('.random_id').attr('value', randId);
        clonedVarTr.find('[name="variants[mainPhoto][]"]').attr('name', 'variants[mainPhoto][' + randId + ']');
        clonedVarTr.find('[name="variants[smallPhoto][]"]').attr('name', 'variants[smallPhoto][' + randId + ']');

        clonedVarTr.attr('id', 'ProductVariantRow_' + countVarRows);
        $('#variantHolder').append(clonedVarTr);
    });

    $('.delete_image').live('click', function() {
        var container = $(this).parent('td');
        //container.find('[name="variants[MainImageForDel][]"]');
        if (container.find('[name="variants[MainImageForDel][]"]').length) {
            container.find('[name="variants[MainImageForDel][]"]').attr('value', 1);
            container.find('[name="variants[mainPhoto][]"]').attr('value', '');
        }
        if (container.find('[name="variants[SmallImageForDel][]"]').length) {
            container.find('[name="variants[SmallImageForDel][]"]').attr('value', 1);
            container.find('[name="variants[smallPhoto][]"]').attr('value', '');
        }
        container.find('img').attr('src', "/templates/administrator/images/select-picture.png");
    });

    $('button.deleteMainImages').die('click').live('click', function(event) {
        event.preventDefault();
        var container = $(this).parents('div.control-group');
        container.find('img').attr('src', "/templates/administrator/images/select-picture.png");
        container.find('input:hidden').attr('value', 1);
        container.find('input:file').attr('value', '');
        return false;
    });

    $('.item_parent_id').live('change', function() {
        var id = $(this).attr('value');
        var menu_id = $('[name="menu_id"]').attr('value');
        $.ajax({
            type: "post",
            url: "/admin/components/cp/menu/get_children_items/" + id + "/" + menu_id,
            success: function(data) {
                $('.position_after').html(data);
            }
        });
    });

    $('#mailVariables').live('click', function() {
        $('#mailText').elrte()[0].elrte.selection.insertHtml(' ' + $(this).val() + ' ');
    });

    $('[data-del="wares"]').live('click', function() {
        //event.preventDefault();
        $(this).parent('div').remove();
    });

    $('[data-clone="wares"]').live('click', function() {
        //event.preventDefault();
        $('.warehouse_line').clone().removeClass().attr('id', 'warehouse_line' + Math.floor(1000 * Math.random())).appendTo($('.warehouses_container'));
    });

    $('.openDlg').live('click', function() {
        $('#addPictures').trigger('click');
    });

});

function change_status(hrefFn) {
    $.post(hrefFn, {}, function(data) {
        $('.notifications').append(data)
    })
}
function export_csv() {
    $('.export').die('click').live('click', function() {

        if ($('input[name=export]:checked').val() == 'csv') {

            $('#exportUsers').submit();

            $('#loading').hide();
            return false;
        }
    });
}

$(document).ajaxComplete(function(event, XHR, ajaxOptions) {
    export_csv();
});

$(document).ready(function() {
    export_csv();

    $('#role_id').live('change', function() {
        var $roleId = $(this).find('option:selected').val();

        $.ajax({
            dataType: "html",
            headers: {
                'X-PJAX': 'X-PJAX'
            },
            url: '/admin/components/cp/user_manager/getRolesTable/' + $roleId,
            success: function(msg) {
                $('#privilege').html(msg);
            }
        });
    })


    if ($('select#type_select'))
        $('select#type_select').live('change', function() {
            if ($(this).val() != '2')
                $('#possVal').slideUp(200);
            else
                $('#possVal').slideDown(200);
        })


    $('.clearCashe').live('click', function() {
        $this = $(this);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: 'param=' + $this.attr('data-param'),
            url: $this.data('target'),
            success: function(obj) {
                //console.log(obj.color);
                if (obj.result == true)
                    showMessage(obj.message, '', obj.color);
                else
                    showMessage(obj.message, '', obj.color);
                //console.log(obj.fileCount);
                $('.filesCount').text(obj.filesCount);
            }
        });
    })

    $('.saveButton').live('click', function() {
        var idMenu = $(this).attr('idMenu');
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $('.saveForm').serialize(),
            url: '/admin/components/cp/menu/update_menu/' + idMenu,
            success: function(obj) {
                console.log(obj.color);
                if (obj.result == true)
                    showMessage(obj.title, obj.message);
                else
                    showMessage(obj.title, obj.message, 'r');

            }
        });

    });


    $('.createMenu').live('click', function() {
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $('.createMenuForm').serialize(),
            url: '/admin/components/cp/menu/create_menu/',
            success: function(obj) {

                if (obj.result == true) {

                    var url = '/admin/components/cp/menu/';
                    redirect_url(url);
                    showMessage(obj.title, obj.message);

                } else {

                    showMessage(obj.title, obj.message, 'r');
                }


            }
        });

    });

});


var delete_function = new Object({
    deleteFunction: function() {
        if ($('#banner_del').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_property').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_brand').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_cert').hasClass('disabled')) {
            return false;
        }
        if ($('#module_delete').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_wid').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_pm').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_warehouse').hasClass('disabled')) {
            return false;
        }
        if ($('#del_sel_role').hasClass('disabled')) {
            return false;
        }
        if ($('#user_del').hasClass('disabled')) {
            return false;
        }
        if ($('#del_in_search').hasClass('disabled')) {
            return false;
        }
        $('.modal_del').modal();

    },
    deleteFunctionConfirm: function(href)
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post(href, {
            ids: ids
        }, function(data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent'
            });
        });
        $('.modal_del').modal('hide');
        return true;
    }

});


function save_positions_variant(url) {
    var arr = new Array();
    $('input[name=idv]').each(function() {
        arr.push($(this).val());
    });
    $.post(
            url,
            {
                positions: arr
            },
    function(data) {
        $('.notifications').append(data);
    });

}

$(".save_positions_variant").live("sortstop", function(event, ui) {
    var url = $(this).attr('data-url');
    save_positions_variant(url);
});


var delete_functionS = new Object({
    deleteFunctionS: function() {
        if ($('#group_del').hasClass('disabled')) {
            return false;
        }
        $('.modal_dels').modal();
    },
    deleteFunctionConfirmS: function(href)
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post(href, {
            ids: ids
        }, function(data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent'
            });
        });
        $('.modal_dels').modal('hide');
        return true;
    }

});


var delete_currency_function = new Object({
    deleteFunction: function(cid) {
        $('#first').modal();
        id = cid;
        return id;
    },
    deleteFunctionConfirm: function(href)
    {
        var ids = new Array();
        ids = id;

        $.post(href, {
            ids: ids
        }, function(data) {
            if (data.recount) {
                $('#recount').modal();
                return false;
            }
            if (data.success) {
                $('#currency_tr' + id).remove();
            }
            $('.notifications').append(data.response);
        }, "json");
        $('#first').modal('hide');
        return true;
    },
    ajaxRecount: function(url) {
        $.ajax({
            type: "post",
            data: "id=" + id,
            url: url,
            success: function(data) {
                $('#mainContent').after(data);
                if (data.success) {
                    $('#currency_tr' + id).remove();
                }
            }
        });
        $('#recount').modal('hide');
        return true;
    }



});

var pagesAdmin = new Object({
    quickAddCategory: function() {
        if ($('#fast_add_form').valid())
            $('#fast_add_form').ajaxSubmit({
                success: function(responseText) {
                    responseObj = JSON.parse(responseText);
                    $('.modal').modal('hide');
                    if (responseObj.data)
                    {
                        showMessage('', 'Категория добавлена успешно');
                        $('#category_selectbox').load('/admin/categories/update_fast_block/' + responseObj.data);
                    }
                    else
                        $('.notifications').append(responseText);
                }
            });
        return false;
    },
    loadCFAddPage: function()
    {
        var categoryId = $("#category_selectbox").val();

        $.ajax({url: "/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/0/page",
            type: 'GET',
            headers: {
                'X-PJAX': 'X-PJAX'
            },
            complete: function(data) {
                $("#cfcm_fields_block").html(data.responseText);
            }
        });
    },
    loadCFEditPage: function()
    {
        var updatePageId = $('#edit_page_form').data('pageid');
        var categoryId = $("#category_selectbox").val();
        $.ajax({url: "/admin/components/cp/cfcm/form_from_category_group/" + categoryId + "/" + updatePageId + "/page",
            type: 'GET',
            headers: {
                'X-PJAX': 'X-PJAX'
            },
            complete: function(data) {
                $("#cfcm_fields_block").html(data.responseText);
            }
        });
    },
    confirmListAction: function(actionURL)
    {
        //event.preventDefault();
        var pagesArray = {};
        //var actionURL = $(this).attr('url');
        var checkedPages = $('.pages-table > tbody').children('tr').children('td.t-a_c').find('input:checked');

        checkedPages.each(function() {
            pagesArray[$(this).attr('data-id')] = 'chkb_' + $(this).attr('data-id');
        });

        if (checkedPages.size() < 1)
            return false;

        var newCat = false;
        if ($('#CopyMoveCategorySelect'))
            newCat = $('#CopyMoveCategorySelect').val();

        $.post(actionURL, {pages: pagesArray, new_cat: newCat}, function(data) {
            $('.modal').modal('hide');
            $('.notifications').append(data);

        });
    },
    updDialogMove: function()
    {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/move')");
    },
    updDialogCopy: function()
    {
        $('#confirmMove').attr('onclick', "pagesAdmin.confirmListAction('/admin/pages/move_pages/copy')");
    },
    initialize: function()
    {
        if ($('#edit_page_form').length)
            this.loadCFEditPage();

        if ($('#add_page_form').length)
            this.loadCFAddPage();
    }
});


var CFAdmin = new Object({
    deleteOne: function(label) {
        $.post('/admin/components/cp/cfcm/delete_field/' + label, {}, function(data) {
            $('.notifications').append(data);
        });
    },
    deleteOneGroup: function(id) {
        $.post('/admin/components/cp/cfcm/delete_group/' + id, {}, function(data) {
            $('.notifications').append(data);
        });
    },
});


pagesAdmin.initialize();



function change_page_status(page_id) {
//    $.ajax({
//        type: 'POST',
//        url: base_url + 'admin/pages/ajax_change_status/' + page_id,
//        onComplete: function(response) {
//            console.log(response);
//            $('.notifications').append(response);
//        }
//    });

    $.post(base_url + 'admin/pages/ajax_change_status/' + page_id, {}, function(data) {
        $('.notifications').append(data);
    })
}


$(document).ready(function() {
    $(".pages-table").live("sortstop", function(event, ui) {
        var positionsArray = {};

        $('.pages-table > tbody').children('tr').each(function() {
            positionsArray['pages_pos[' + $(this).index() + ']'] = 'page' + $(this).attr('data-id') + '_' + $(this).index();
        });

        $.ajax({
            type: 'post',
            data: positionsArray,
            url: '/admin/pages/save_positions/',
            success: function(obj) {
                if (obj.result) {
                }
            }
        });
    });

    $('a.ajax_load').click(function(event) {
        event.preventDefault();
        $('#mainContent').load($(this).attr('href'));
        /*
         $.ajax({
         type: 'get',
         url: $(this).attr('href'),
         success: function(result){
         $('#mainContent').html(result);
         }
         });
         */
    });

    $('#categorySelect').live('change', function() {
        //$('#mainContent').load($(this).attr('url')+$(this).val());
        $.pjax({url: $(this).attr('url') + $(this).val(), container: '#mainContent'});
        console.log($(this).val());
        //
        //window.location.href = $(this).attr('url')+$(this).val();
    });

    //$( "#pages_action_dialog" ).dialog("destroy");

    $('button.pages_action').click(function(event) {

    });

    // SHOP SCRIPTS

    $(".products_table").live("sortstop", function(event, ui) {
        var positionsArray = {};

        $('.products_table > tbody').children('tr').each(function() {
            positionsArray['pages_pos[' + $(this).index() + ']'] = 'page' + $(this).attr('data-id') + '_' + $(this).index();
        });
        /*
         $.ajax({
         type: 'post',
         data: positionsArray,
         url: '/admin/pages/save_positions/',
         success: function(obj){
         if(obj.result){
         }
         }
         });
         */
    });


    $('.products_table').find('span.prod-on_off').live('click', function() {
        var page_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeActive/' + page_id,
            onComplete: function(response) {
            }
        });
    });

    $('.products_table').find('button.setHit').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHit/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('.products_table').find('button.setHot').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHot/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('.products_table').find('button.setAction').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeAction/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    //$('.products_table').find('button.refresh_price').live('click', function() {
    $('button.refresh_price').live('click', function() {
        var btn = $(this);
        var variant = btn.attr('variant-id');
        var variantId = {};
        var price = btn.parent().find('input').val();

        variantId['price'] = price;

//        console.log(variant);

        if (typeof variant !== 'undefined' && variant !== false)
            variantId['variant'] = variant;

        $.ajax({
            type: 'POST',
            data: variantId,
            url: base_url + 'admin/components/run/shop/products/ajaxUpdatePrice/' + btn.attr('data-id'),
            success: function(data) {
                $('.notifications').append(data);
            }
        });

        //btn.toggleClass('btn-primary active');
    });

    $('.prodFilterSelect').live('change', function(event) {
        var query_string = $('#filter_form').serialize();
        $.pjax({
            url: '/admin/components/run/shop/search/index/?' + query_string,
            container: '#mainContent'
        });
    });

});