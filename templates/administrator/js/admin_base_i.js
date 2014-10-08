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
                    showMessage(langs.error, langs.errorSomethingWereWrong);
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
                        showMessage(langs.error, langs.errorUrlAccess);
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
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="' + langs.turnOn + '"  data-off="' + langs.turnOff + '"><span class="prod-on_off autoload_ch" data-mid="{$module.id}"></span></div></td>')
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="' + langs.turnOff + '"  data-off="' + langs.turnOff + '"><span class="prod-on_off urlen_ch" data-mid="{$module.id}"></span></div></td>')
                    $('#mtbl').append(trin);
                    $this.parents('tr:first').remove();
                    if ($('tbody.nim').children('tr').contents().length === 0)
                    {
                        $('#nimt').remove();
                        $('#nimc').html('</br><div class="alert alert-info">' + langs.haveNotModulesToInstall + '</div>');
                    }
                    showMessage(langs.moduleInstall, langs.moduleSuccessInstall);
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
                    showMessage(langs.creatingWidget, langs.error + obj.message);
                } else {
                    var url = '/admin/widgets_manager';
                    showMessage(langs.creatingWidget, langs.createdSuccessfullyWidget);
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
                    showMessage(langs.creatingWidget, langs.error + obj.message);
                } else {
                    var url = '/admin/widgets_manager/create_tpl';
                    showMessage(langs.creatingWidget, langs.createdSuccessfullyWidget);
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
//            if (confirm(langs.deleteGroup))
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
//            if (confirm(langs.deleteGroup))
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
    //////////////sorting on site
    $('.edit_field_sort').live('click', function() {
        $(this).next(".text_field_block").toggle();
    });
    $('.save_button_field').live('click', function() {
        obj = $(this);
        id = $(this).attr('data-id');
        name = $(this).attr('data-name');
        text = $(this).prev('textarea').val();
        $.ajax({
            type: 'post',
            url: '/admin/components/run/shop/settings/ajaxUpdateFieldName',
            data: 'id=' + id + '&name=' + name + '&text=' + text,
            success: function(data) {
                obj.parent('.text_field_block').prev().html(text);
                obj.parent('.text_field_block').hide();
            }
        });

    });


    //////////////end sorting on site
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

    $('#translateProductUrl').live('click', function() {
        var str = $('#Name').attr('value');
        if (str)
            $.ajax({
                type: 'post',
                url: '/admin/components/run/shop/products/ajax_translit',
                data: 'str=' + str,
                success: function(data) {
                    $('#Url').attr('value', data);
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
        var name = prompt(langs.enterTemplateName, '');
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

    function save_positions(url, categoryId) {
        var arr = new Array();
        $('input[name=ids]').each(function() {
            arr.push($(this).val());
        });
        $.post(
                url,
                {
                    positions: arr,
                    categoryId: categoryId,
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
        $('#tpm_row' + $(this).attr('data-kid')).remove();
    });



    product = new Object;

    product.changeActive = function(bool) {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxChangeActive', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        });
    };

    product.toHit = function() {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/products/ajaxChangeHit', {
            ids: ids
        }, function(data) {
            $('.notifications').append(data);
        });
    };

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
        var categoryId = $(ui.item[0]).find('input[name="ids"]:first-child').val();
        var url = $(this).attr('data-url');
        save_positions(url, categoryId);
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
                    $('#pages_list_holder').html('<ul class="nav myTab nav-tabs nav-stacked">' + st + '</ul>');
                } else {
                    $('#pages_list_holder').html(langs.categoryHaveNotPage);
                }
            }
        });
    });

    $('#per_page').live('change', function() {
        $('#category_sel').trigger('change');
    });

    $('.page_title').live('click', function(event) {
        event.preventDefault();
        $('#page_id_holder').html($(this).attr('data-id'));
        $('#item_title').attr('value', $(this).attr('data-title'));
        $('#item_page_id').attr('value', $(this).attr('data-id'));
    });

    $('.link_type a').live('click', function(event) {
        event.preventDefault();
        var identif = $(this).attr('href').substr(1, $(this).attr('href').length);
        $('.submit_link').each(function() {
            $(this).attr('data-form', '#' + identif + '_form')
            $('input[name=item_type]').attr('value', identif);
        });
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

    $('.category_item').live('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        $('#cat_input').attr('value', id);
        $('#cat_id_holder').html(id);
        $('#item_cat_title').attr('value', title)
    });

    $('.module_item').live('click', function() {
        var mname = $(this).attr('data-mname');
        var murl = $(this).attr('data-murl');
        var title = $(this).html();
        var url_module = $("#item_url_image").val();
        $('input[name=mod_name]').attr('value', mname);
        $('#module_item_title').attr('value', title);
        $('#Img2').attr('value', murl);
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

// Properties filter start
    $('.property_list_order').live('click', function() {
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
        var url = $('#filter_form').attr('action');
        $.pjax({
            url: url + '?' + query_string,
            container: '#mainContent'
        });
    });

    $('.propFilterSelect').off('change').live('change', function(event) {
        var query_string = $('#filter_form').serialize();
        var url = $('#filter_form').attr('action');
        $.pjax({
            url: url + '?' + query_string,
            container: '#mainContent'
        });
    });

    $('.properties_filter_inputs').find('input').on('keypress', function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var query_string = $('#filter_form').serialize();
            var url = $('#filter_form').attr('action');

            $.pjax({
                url: url + '?' + query_string,
                container: '#mainContent'
            });
        }
    });

    // Properties filter end

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
            location.reload();
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
        clonedVarTr.find('.newImage').attr('name', 'image' + countVarRows);

        clonedVarTr.attr('id', 'ProductVariantRow_' + countVarRows);
        $('#variantHolder').append(clonedVarTr);
        $(window).scrollTop($(window).scrollTop() + 59);
    });

    /*------------------------- IMAGES -------------------------*/

    $('.delete_image').live('click', function() {
        var container = $(this).closest('td');
        //container.find('[name="variants[MainImageForDel][]"]');
        container.find(".deleteImage").attr("value", 1);
        container.find('[name="variants[mainPhoto][]"]').attr('value', '');
        container.find('img').attr('src', "/templates/administrator/images/select-picture.png");
        container.find('img').css('width', '50px');
    });
    $('.change_image').live('click', function() {
        $(this).closest('td').find('[type="file"]').attr('accept', "image/gif, image/jpeg, image/png").click();
    })


    $("button.deleteMainImages").die("click").live("click", function(event) {
        event.preventDefault();
        var container = $(this).parents("div.control-group");
        container.find("img").attr("src", "/templates/administrator/images/select-picture.png");
        container.find(".deleteImage").attr("value", 1);
        container.find("input[type=file]").attr("value", "");
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


    // on search button lick
    $("#search_images").live('click', search_images);
    // on enter
    $("#url_image").live('keypress', function(e) {
        if (e.which == 13) {
            search_images();
        }
    });


    function search_images() {
        var value = $("#url_image").val();
        // checking if value is URL
        if (value.length > 2) {
            var urlPattern = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
            if (value.match(urlPattern)) { // download by URL
                //getImages(value, "url");
                $.post("/admin/components/run/shop/products/get_images/url", {
                    q: value
                }, addUrlImage, 'json');
            } else { // search with google
                curPosition = 1;
                searchImages();
                //modalBodyMsg("Загрузка...");
                var loadingImg = '<img src="/templates/administrator/images/loader-2.gif" alt="Loading..."/>';
                modalBodyMsg(loadingImg);
            }
        } else {
            clearImageResults();
        }
    }
    // start search
    function searchImages(clear) {
        if (clear !== false) {
            $("#image_search_result").empty();
        }
        var value = $("#url_image").val();
        var loadingImg = '<img src="/templates/administrator/images/loader-2.gif" alt="Loading..."/>';
        modalBodyMsg(loadingImg);
        $.post("/admin/components/run/shop/products/get_images/search", {
            q: value,
            pos: curPosition
        }, addSearchedImages, 'json');
    }

    // removing thumbnails from preview images
    function clearImageResults() {
        $("#image_search_result")
                .empty()
                .html("<p class=\"images_empty_res\">Нет элементов для отображения</p>");
    }


    function addSearchedImages(images) {
        modalBodyMsg();
        var i = 0;
        for (var k in images) {
            var img = "<span class='img_span'><img id='" + k + "' class='searched_images' src='" + images[k] + "' /></span>";
            $("#image_search_result").append(img);
            i++;
        }
        if (i > 0) {
            //imgMessageBottom('');
            if ((curPosition + 8) < 40) {
                modalBodyMsg('<a id="loadMoreImages">Еще</a>');
            }
        } else {
            if (curPosition > 1) {
                //searchImages();
                //modalBodyMsg("Загрузка...");
            } else {
                modalBodyMsg("Нет результатов по вашему запросу");
            }
        }
    }

    // preview image by url
    function addUrlImage(data) {
        $("#image_search_result").empty();
        var img;
        if (data.url != '0') {
            img = "<span class='selected_image'><img class='image_by_url' src='" + data.url + "'></span>";
        } else {
            img = "<p>Not image</p>";
        }
        $("#image_search_result").append(img);
    }

    function modalBodyMsg(msg) {
        $(".more_button_paragraph").remove();
        if (typeof (msg) == 'string') {
            $("#image_search_result").append('<p class="more_button_paragraph">' + msg + '</p>');
            return;
        }
    }

    // selecting image by click
    $(".searched_images").live('click', function(e) {
        if (e.shiftKey) {
            if ($(this).parents("span.img_span").hasClass('selected_image')) {
                $(this).parents("span.img_span").removeClass('selected_image');
            } else {
                $(this).parents("span.img_span").addClass('selected_image');
            }
        } else {
            $("span.img_span").removeClass('selected_image');
            $(this).parents("span.img_span").addClass('selected_image');
        }

        var countOfSelected = $("span.img_span.selected_image").size();
        if (countOfSelected > 1) {
            $("#as_additional")
                    .attr("checked", "checked")
                    .attr("disabled", "disabled");
        } else {
            $("#as_additional").removeAttr("disabled");
        }
    });

    // image hover
    $(".searched_images").live('mouseover', function() {
        if (!$(this).parents("span.img_span").hasClass('hoveredImage')) {
            $(this).parents("span.img_span").addClass('hoveredImage')
        }
    });
    $(".searched_images").live('mouseout', function() {
        $(this).parents("span.img_span").removeClass('hoveredImage')
    });

    // adding event to open modal window
    $(".images_modal").live('click', function() {
        // for saving the position of images page
        curPosition = 1;
        trId = $(this).parents("tr").attr("id");
        var productName = $("input#Name").val();
        if (productName.length > 0) {
            $("#url_image").val(productName);
            //imgMessageBottom('');
            searchImages();
            var loadingImg = '<img src="/templates/administrator/images/loader-2.gif" alt="Loading..."/>';
            modalBodyMsg(loadingImg);
        } else {
            modalBodyMsg('Please specify the product name');
        }
        $("#as_additional").removeAttr("checked").removeAttr("disabled");
        $('#images_modal').modal();
    });

    $("#loadMoreImages").live('click', function() {
        if ((curPosition + 8) < 40) {
            curPosition += 8;
            searchImages(false);
        }
    });


    /*
     * Message to show bottom
     * @param string msg
     * @returns {@exp;@call;$@call;text}
     */
    function errorOnSave(msg) {
        if (typeof (msg) != 'string') {
            return;
        }
        $('#save_image').popover({
            placement: 'top',
            title: 'Ошибка',
            content: msg
        });
        $('#save_image').popover('show');
        setTimeout("$('#save_image').popover('hide').popover('destroy');", 3000);
    }

    // closes modal, adding url of image to cpecified product
    $("#save_image").live('click', function() {
        var selectedImages = $("span.selected_image");
        if (!$(selectedImages).size() > 0) {
            errorOnSave('Не выбрано ни одного изображения');
            return;
        }
        if ($('#as_additional').attr('checked')) {
            var urlArray = [];
            $(selectedImages).each(function() {
                urlArray.push($(this).find("img").attr("src"));
            });
            var res = addAdditionalImages(urlArray);
            if (res === true) {
                $('#images_modal').modal("hide");
                $("a[href='#additionalPics']").trigger('click');
            } else {
                errorOnSave(res);
            }
            return true;
        }

        // go furter if one image is selected
        var selectedImageUrl = $("span.selected_image img").attr("src");
        $("#" + trId + " input.inetImage").val(selectedImageUrl);
        // adding thumbnail
        var img = document.createElement("img");
        img.src = selectedImageUrl;
        $(img).addClass('img-polaroid').css({
            width: '50px',
            'max-heigth': '100%'
        });
        $("#" + trId).find('.control-group .controls img').remove().html(img);
        $("#" + trId).find('.control-group .controls').append(img);
        // hiding and clearing modal
        $('#images_modal').modal("hide");
        $("#url_image").val("");
        clearImageResults();
    });


    $('#url_image').live('mouseover', function() {
        $(this).tooltip();
    });

    $('#as_additional_container').live('mouseover', function() {
        $(this).tooltip();
    });

    // adding images as additional
    function addAdditionalImages(urlArray) {
        var freeUrlInputs = [];
        // getting free inputs (inf url and file inputs are empty)
        $(".additional_image_file").each(function() {
            var url = $(this).siblings("input.additional_image_url").val();
            var file = $(this).val();
            if (
                    file == "" && // new local file
                    url == "" && // or url
                    // image can be already set
                    !$(this).parents("div.control-group.span6").find(".controls .rmAddPic").size() > 0
                    ) {
                freeUrlInputs.push($(this).siblings("input.additional_image_url").attr('id'))
            }
        });

        if (urlArray.length > freeUrlInputs.length) {
            return "Недостаточно мест для изображений";
        }

        for (var i = 0; i < urlArray.length; i++) {
            var img = document.createElement("img");
            img.src = urlArray[i];
            $(img).addClass('img-polaroid').css({
                width: '50px',
                'max-heigth': '100%'
            });
            $("#" + freeUrlInputs[i]).val(urlArray[i]);
            $("#" + freeUrlInputs[i]).parents("div.control-group.span6").find(".controls").html(img);
        }
        return true;
    }




    /*------------------------- IMAGES -------------------------*/

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


    /** Check is GD lib is installed **/
    function checkGDIsInstalled() {
        var result = false;
        $.ajax({
            async: false,
            url: "/admin/components/run/shop/settings/checkGDLib/",
            type: "post",
            success: function(response) {
                responseArray = $.parseJSON(response);
                if (responseArray.status === true) {
                    result = true;
                }
            }
        });
        return result;
    }

    /** Resize all */
    $('#resizeAll').live('click', function() {

        /** Check gd lib **/
        if (!checkGDIsInstalled()) {
            showMessage(lang('Error'), lang('PHP GD library is not installed'), 'r')
            return;
        }

        window.onbeforeunload = (function() {
            return langs.waitForResizeEnding + '!';
        });
        /* */
        $.ajax({
            url: "/admin/components/run/shop/settings/getAllProductsVariantsIds",
            type: "post",
            async: false,
            success: function(data) {
                try {
                    var ids = $.parseJSON(data);
                    var countAll = ids.length;
                    var portion = 0;
                    var arrayForProcess = new Array();
                    var done = 0;

                    //Resize by array
                    function makeResize(array) {
                        data = JSON.stringify(array);
                        $.ajax({
                            url: "/admin/components/run/shop/settings/runResizeAllJsone",
                            type: "post",
                            dataType: 'jsone',
                            data: 'array=' + data,
                            complete: function() {
                                done += array.length;
                                $('.bar').css('width', ((done / countAll) * 100) + '%');
                                $('.bar').text(parseInt((done / countAll) * 100) + '%');

                                $('#progressLabel').html('<b>' + langs.resizeImagesForProducts + '</b> <br/>' + langs.allFindingProducts + ': ' + countAll + '  (' + langs.processed + ' : ' + done + ' )');
//                                console.log((done / countAll) * 100);
                                if (done == countAll) {
                                    $('#fixPage').fadeOut(100);
                                    if ($('#useAdditionalImages').attr('checked') != 'checked') {
                                        $('#progressBlock').fadeOut(1000);
                                        showMessage(langs.imagesUpdated, langs.completed);
                                    }
                                    window.onbeforeunload = null;
                                }
                            }
                        });
                    }
                    ;

                    $('#progressLabel').html('<b>' + langs.resizeProductsImages + '</b><br/>' + langs.productsFound + ': ' + countAll);
                    $('#progressBlock').fadeIn(100);

                    //Prepare portion of images
                    if ((countAll / 50) < 0) {
                        portion = 1;
                    } else {
                        portion = Math.ceil(countAll / 50);
                    }

                    //Disable page
                    $('#fixPage').fadeIn(100);
                    //Make resize
                    while (ids.length > 0) {
                        arrayForProcess = ids.splice(0, portion);
                        makeResize(arrayForProcess);
                    }

                } catch (e) {
                    console.log(e);
                }
            }
        });


        /* Additional images */
        if ($('#useAdditionalImages').attr('checked') == 'checked') {
            $.ajax({
                url: "/admin/components/run/shop/settings/getAllProductsIds",
                type: "post",
                success: function(data) {
                    if (data != 'false') {
                        var idsAdditional = $.parseJSON(data);
                        var countAllAdditional = idsAdditional.length;
                        var portionAdditional = 0;
                        var arrayForProcessAdditional = new Array();
                        var doneAdditional = 0;
                        //                        console.log(idsAdditional);

                        function makeResizeAdditional(array) {
                            data = JSON.stringify(array);
                            $.ajax({
                                url: "/admin/components/run/shop/settings/runResizeAllAdditionalJsone",
                                type: "post",
                                dataType: 'jsone',
                                data: 'array=' + data,
                                complete: function() {
                                    doneAdditional += array.length;
                                    $('.bar').css('width', ((doneAdditional / countAllAdditional) * 100) + '%');
                                    $('#progressLabel').html('<b>' + langs.additionalImagesResize + '</b><br/>' + langs.foundProdWithAdditionalImgs + ': ' + countAllAdditional + '  (' + langs.processed + ': ' + doneAdditional + ' )');
                                    //                                    console.log((doneAdditional / countAllAdditional) * 100);
                                    $('.bar').text(parseInt((doneAdditional / countAllAdditional) * 100) + '%');
                                    if (doneAdditional == countAllAdditional) {
                                        $('#fixPage').fadeOut(100);
                                        $('#progressBlock').fadeOut(1000);
                                        showMessage(langs.imagesUpdated, langs.completed);
                                        window.onbeforeunload = null;
                                    }
                                }
                            });
                        }
                        ;

                        $('#progressLabel').html('<b>' + langs.additionalImagesResize + '</b><br/>' + langs.foundProdWithAdditionalImgs + ': ' + countAllAdditional + '  (' + langs.processed + ': 0 )');
                        $('#progressBlock').fadeIn(100);
                        $('.bar').css('width', ((doneAdditional / countAllAdditional) * 100) + '%');

                        //Prepare portion of images
                        if ((countAllAdditional / 50) < 0) {
                            portionAdditional = 1;
                        } else {
                            portionAdditional = Math.ceil(countAllAdditional / 50);
                        }

                        //Disable page
                        $('#fixPage').fadeIn(100);
                        //Make resize
                        while (idsAdditional.length > 0) {
                            arrayForProcessAdditional = idsAdditional.splice(0, portionAdditional);
                            makeResizeAdditional(arrayForProcessAdditional);
                        }
                    } else {
                        $('#progressBlock').fadeOut(100);
                        showMessage(langs.imagesUpdated, langs.completed);
                    }
                }
            });
        }

    });


    /**
     * Resize by id
     */
    $('#resizeById').live('click', function() {

        console.log(checkGDIsInstalled());
        /** Check gd lib **/
        if (!checkGDIsInstalled()) {
            showMessage(lang('Error'), lang('PHP GD library is not installed'), 'r')
            return;
        }

        var id = $('#product_variant_name').val();
        showLoading();
        $.ajax({
            url: "/admin/components/run/shop/settings/runResizeById/" + id,
            type: "post",
            success: function(data) {
                showLoading();
                $('.notifications').append(data);
            }
        });
    });


    $('[name="checkPrices"]').live('click', function() {
        $.ajax({
            url: "/admin/components/run/shop/currencies/checkPrices",
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    })

    $('.runResize').live('click', function() {
        $.ajax({
            url: "/admin/components/cp/exchange/startImagesResize",
            type: "post",
            success: function(data) {
                $('.notifications').append(data);
            }
        });
    });

    $('.order_list_order').live('click', function() {
        $('input[name="orderMethod"]').val($(this).data('method'));
        if ($('input[name="orderCriteria"]').val() == 'ASC')
            $('input[name="orderCriteria"]').val('DESC')
        else
            $('input[name="orderCriteria"]').val('ASC');
        var query_string = $('form.listFilterForm').serialize();
        $.pjax({
            url: '/admin/components/run/shop/orders/index/?' + query_string,
            container: '#mainContent'
        });
    });



    // shop - settings - count of products on site
    $("#arrayFrontProductsPerPage").unbind('keyup').bind('keyup', function() {
        var currentValue = $(this).val();
        var pattern = /^[0-9\,[^\,\,]]+$/;
        if (!currentValue.match(pattern)) { // has banned symbols
            console.log(currentValue);
            var caretPosition = caret($(this)); // get the caret position
            var newValue = currentValue.replace(/[^0-9\,]{1,}/, '');
            var newValue = newValue.replace(/[\,]{2,}/, '');
            $(this).val(newValue);
            caret(this, caretPosition.begin)
        }
    });




    /*--------------------------------TA391-----------------------------------*/

    // font color field validator
    $("#watermark_text_color").live('keyup', colorFieldValidator);
    $("input#watermark_color").live('keyup', colorFieldValidator);


    function colorFieldValidator() {
        var currentValue = $(this).val();
        var pattern = /^[A-Za-z0-9]{1,6}$/;
        if (!currentValue.match(pattern)) { // has banned symbols
            var caretPosition = caret($(this)); // get the caret position
            var newValue = currentValue.substr(0, 6)
            newValue = newValue.replace(/[^A-Za-z0-9]/, '');
            $(this).val(newValue);
            caret(this, caretPosition.begin)
        }
    }


    // image watermark correlation
    $("#inputWatermarkInterest").live('keyup', function() {
        var currentValue = $(this).val();
        var pattern = /^[0-9]{1,3}$/;
        if (!currentValue.match(pattern) || parseInt(currentValue) > 100) { // has banned symbols
            var caretPosition = caret($(this)); // get the caret position
            var newValue = currentValue.replace(/[^0-9]/, '');
            if (parseInt(newValue) > 100) {
                newValue = newValue.substr(0, 3) == "100" ? "100" : newValue.substr(0, 2);
            }
            $(this).val(newValue);
            caret(this, caretPosition.begin)
        }
    });

    $("input[type='file'][name='watermark_font_path']").live("change", function() {
        var allowedFileExtentions = ['ttf', 'fnt', 'fon', 'otf'];
        var ext = $(this).val().split('.').pop().toLowerCase();
        var extentionIsAllowed = false;
        for (var i = 0; i < allowedFileExtentions.length; i++) {
            if (allowedFileExtentions[i] == ext) {
                extentionIsAllowed = true;
                break;
            }
        }

        if (extentionIsAllowed == false) {
            $(this).removeAttr("value");
            showMessage(langs.error, langs.onlyFontsFilesAllowed, "error");
        } else {
            $(".watermark_path_info").html($(this).val().split('\\').pop());
        }
    });

    /**
     * Getting/Setting caret position
     * @param node domObject
     * @param int begin
     * @param int end
     *
     */
    function caret(domObject, begin, end) {
        var range;

        if (typeof begin == 'number') {
            end = (typeof end === 'number') ? end : begin;
            return $(domObject).each(function() {
                if (domObject.setSelectionRange) {
                    domObject.setSelectionRange(begin, end);
                } else if (domObject.createTextRange) {
                    range = domObject.createTextRange();
                    range.collapse(true);
                    range.moveEnd('character', end);
                    range.moveStart('character', begin);
                    range.select();
                }
            });
        } else {
            if (domObject[0].setSelectionRange) {
                begin = domObject[0].selectionStart;
                end = domObject[0].selectionEnd;
            } else if (document.selection && document.selection.createRange) {
                range = document.selection.createRange();
                begin = 0 - range.duplicate().moveStart('character', -100000);
                end = begin + range.text.length;
            }
            return {begin: begin, end: end};
        }
    }


    // module Categories - Settings
    $("#watermark_padding2").live('keypress', function(eventData) {
        var ignoreCodes = [8, 109, 37, 38, 39, 40, 36, 35, 144, 17, 18, 9, 13, 16, 36, 17, 16]; // backspase, shift, minus, arrows...
        for (var i = 0; i < ignoreCodes.length; i++)
            if (ignoreCodes[i] == eventData.keyCode)
                return true;
        var keyChar = String.fromCharCode(eventData.which);
        var pattern = /^[0-9\-]+$/;
        if (keyChar.match(pattern)) {
            return true;
        }
        return false;
    });



    /* ----------------------- Siteinfo ---------------------------*/

    // for adding contacts rows in Admin panel - system - site config - site info
    $("#siteinfo_addcontact").die('click').live("click", addSiteInfoContactRow);

    function addSiteInfoContactRow() {
        var trs = $("#siteinfo_contacts_table tr").clone();
        var firstTr = trs[0];
        $(firstTr)
                .removeClass("siteinfo_first_contact_row")
                .find("textarea").empty();
        $(firstTr).find("input").val("");
        $("#siteinfo_contacts_table").append(firstTr);
        $(firstTr).tooltip({
            trigger: 'hover',
            placement: 'top'
        });
    }

    // for deleting contact rows
    $("#siteinfo_contacts_table .si_remove_contact_row").die('click').live("click", function() {
        //$("#site_info_tab").delegate("#siteinfo_contacts_table .si_remove_contact_row", "click", function() {
        var countOfRows = $("#site_info_tab #siteinfo_contacts_table tr").size();
        if (countOfRows > 1) {
            $(this).parents(".siteinfo_contact_row").remove();
        } else {
            $(this).parents(".siteinfo_contact_row").find("textarea").val("");
            $(this).parents(".siteinfo_contact_row").find("input").val("");
        }
    });

    // prewiew local image
    $('#site_info_tab input[type="file"]').die('change').live('change', function(e) {
        // checking if file is image
        var allowedFileExtentions = ['jpg', 'jpeg', 'png', 'ico', 'gif'];
        var ext = $(this).val().split('.').pop();
        var extentionIsAllowed = false;
        for (var i = 0; i < allowedFileExtentions.length; i++) {
            if (allowedFileExtentions[i] == ext) {
                extentionIsAllowed = true;
                break;
            }
        }
        if (extentionIsAllowed == false) {
            $(this).removeAttr("value");
            showMessage("Ошибка", "Можно загружать только изображения", "error");
            return;
        }

        // creating image preview
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
        $(this).closest('.control-group').find('.controls').html(img);
    });

    // delete image buttons
    $(".remove_btn").die('click').live("click", function() {
        //$("#site_info_tab").delegate('.remove_btn', "click", function() {
        // setting hidden input value to 1 delete for delete image on saving
        $(this).parents(".control-group").find("input.si_delete_image").val("1");
        // display some message about deleting
        $(this).parents(".control-group").find(".siteinfo_image_container")
                .empty()
                .html("<img class='img-polaroid' src='/templates/administrator/images/select-picture.png' />");
    });

    var siteInfoLocalesDataCache = {};
    $("#siteinfo_locale").die('change').live("change", function() {
        //$("#site_info_tab").delegate('#siteinfo_locale', 'change', function() {
        var locale = $(this).val();
        if (typeof siteInfoLocalesDataCache[locale] != 'undefined') {
            changeSiteInfoLocaleParams(siteInfoLocalesDataCache[locale]);
        } else {
            $.post('/admin/settings/getSiteInfoDataJson', {locale: locale}, changeSiteInfoLocaleParams, "json");
        }

    });


    function changeSiteInfoLocaleParams(params) {
        $('#siteinfo_companytype').val(params.siteinfo_companytype);
        $('#siteinfo_address').val(params.siteinfo_address);
        $('#siteinfo_mainphone').val(params.siteinfo_mainphone);
        $('#siteinfo_adminemail').val(params.siteinfo_adminemail);

        $('.si_remove_contact_row').trigger('click'); // deleting all contacts rows

        var i = 0;
        for (var k in params.contacts) {
            if (i > 0) {
                addSiteInfoContactRow();
            }
            $("#siteinfo_contacts_table tr:last-child .siteinfo_contactkey").val(k);
            $("#siteinfo_contacts_table tr:last-child .siteinfo_contactvalue").val(params.contacts[k]);
            i++;
        }
        siteInfoLocalesDataCache[params.locale] = params;
    }

    $('body').off('click.cache').on('click.cache', 'button.formSubmit', function() {
        delete(siteInfoLocalesDataCache);
        siteInfoLocalesDataCache = {};
    });


    /* --------------------- end of Siteinfo -------------------------*/




    /* --------------------- Backup -------------------------*/

    $(".backup_container #backup_save_settings").live('click', function() {
        var settings = {};

        $(".backup_container .backup_settings").each(function() {
            var id = $(this).attr("id");
            var value = $(this).val();
            settings[id] = value;
        });

        $.post(base_url + 'admin/backup/save_settings', settings, function(data) {
            //alert(data);
            $(".backup_container #backup_temp").html(data);
        });
    });

    $(".backup_container #backups_list .backup_lock").live("click", function() {
        var params = {};
        params.action = 'backup_lock';
        params.file = $(this).parents("tr").find(".backup_filename").text();
        params.locked = $(this).hasClass('active') ? "1" : "0";
        $.post(base_url + "admin/backup/file_actions", params, function() {
        }, "json");
    });

    $(".backup_container #backups_list .backup_delete").live("click", function() {
        var params = {};
        var tr = $(this).parents("tr").remove();
        params.action = 'backup_delete';
        params.file = $(this).parents("tr").find(".backup_filename").text();
        $.post(base_url + "admin/backup/file_actions", params, function(data) {
        }, "json");

    });

    $(".backup_container #backups_list .backup_download").live("click", function() {
        var file = $(this).parents("tr").find(".backup_filename").text();
        $("#download_file_form input").val(file);
        $("#download_file_form").submit();

    });

    /* --------------------- end of Backup -------------------------*/


    /*
     * Фільтр модулів
     */
    $('#modules_filter').live('keyup', function() {
        var inputValue = $(this).val().toLowerCase();
        if (inputValue == "") {
            $('.module_row').show();
            return;
        }
        $('.module_row').each(function() {
            var moduleName = $(this).find('.module_name').text().toLowerCase();
            var moduleDescription = $(this).find('.module_description').text().toLowerCase();
            if (
                    moduleName.indexOf(inputValue) != -1 ||
                    inputValue.indexOf(moduleName) != -1 ||
                    moduleDescription.indexOf(inputValue) != -1 ||
                    inputValue.indexOf(moduleDescription) != -1
                    ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // autosubmit brands filter-form 
    var filterChangeTimeout;
    $('form#brands_filter input').live('keyup', function() {
        clearTimeout(filterChangeTimeout);
        filterChangeTimeout = setTimeout(function() {
            var formData = $('form#brands_filter').serialize();
            $.pjax({url: location.pathname + '?' + formData, container: "#mainContent"});
        }, 1000);
    });


    $('select#template').live('change', function() {
        $.get(base_url + 'admin/settings/template_has_license', {template_name: $(this).val()}, function(response) {
            $('#license_link').hide();
            if (response == 1) {
                $('#license_link').show();
            } else {
                $('#license_link').hide();
            }
        })
    });


});

/*
 
 
 
 */