function log(val) {
    console.log(val)
}

$(function () {
    $(".sortableBaseMenu td").draggable({
        cursor: 'move',
        revert: true,
        zIndex: 10000,
        revertDuration: 0
    });

    $(".sortableBaseMenu td li").draggable({
        cursor: 'move',
        revert: true,
        revertDuration: 0
    });

    $(".sortableMenu td").droppable({
        hoverClass: "open",
        drop: function (event, ui) {
            var target = $(event.target).find('ul');
            var draggable = ui.draggable.clone();

            $(draggable).removeAttr('style');
            switch (draggable.prop('tagName')) {
                case 'LI':
                    $(draggable).prependTo(target);
                    $(event.target).addClass('open');

                    var draggableParent = ui.draggable.closest('tr');
                    if ($(this).closest('tr').is(draggableParent)) {
                        $(ui.draggable).remove();
                    }
                    break;
                case 'TD':
                    var draggableParent = ui.draggable.closest('tr');
                    if (!$(this).closest('tr').is(draggableParent)) {
                        $(draggable).insertAfter(event.target);
                    }
                    break;
            }
        }
    });

    $(".sortableMenu tr").sortable({
        axis: 'x'
    });

    $(".sortableMenu tr ul").live('mouseover', function () {
        $(".sortableMenu tr ul > li").draggable({
            connectToSortable: ".sortableMenu tr ul",
            cursor: 'move',
            revert: true,
            revertDuration: 0,
            drag: function () {
                $(this).closest('td').addClass('open');
            }
        });

        $(".sortableMenu tr ul").sortable({
            sort: function () {
                $(this).closest('td').addClass('open');
            }
        });
    });

    $(".sortableMenu tr ul > li").live('mousedown', function (event) {
        $(".sortableMenu tr ul > li").draggable("disable");
        $(".sortableMenu tr ul").sortable("enable");
    });

    $('.sortableMenu tr ul a').live('click', function () {
        return false;
    });

});


var AdminMenu = {
        uploadTariffs: function (el) {
            $('#loading').show();
            $.ajax({
                url: '/admin/components/init_window/admin_menu/uploadTariffsMenus',
                type: 'POST',
                data: {},
                success: function (data) {
                    $('.notifications').html(data);
                    $('#loading').hide();
                }
            });
        },
        save: function (el) {
            var corporate = $('.corporate table td');
            var professional = $('.professional table td');
            var premium = $('.premium table td');
            var data = {
                corporate: JSON.stringify(this.prepareItem(corporate)),
                professional: JSON.stringify(this.prepareItem(professional)),
                premium: JSON.stringify(this.prepareItem(premium)),
            };

            $.ajax({
                url: '/admin/components/init_window/admin_menu/saveMenu',
                type: 'POST',
                data: data,
                success: function (data) {
                    $('.notifications').html(data);
                    //setTimeout(location.reload(), '300');
                }
            });

        },
        saveTariffs: function (obj) {
            var tariffs = $('.tariff');
            var type = $('select[name="type"]').val();
            var tariffsMenus = {};

            var self = this;
            $(tariffs).each(function () {
                var tariffId = $(this).attr('tariff_id');
                var menuList = $(this).find('td');

                tariffsMenus[tariffId] = self.prepareItem(menuList);
            });

            $.ajax({
                url: '/admin/components/init_window/admin_menu/saveTariffsMenus',
                type: 'POST',
                data: {
                    tariffsMenus: JSON.stringify(tariffsMenus),
                    type: type
                },
                success: function (data) {
                    $('.notifications').html(data);
                }
            });
        },
        getData: function (obj) {
            return data = {
                'identifier': $(obj).attr('data-identifier'),
                'text': $(obj).attr('data-text'),
                'link': $(obj).attr('data-link'),
                'class': $(obj).attr('data-class'),
                'id': $(obj).attr('data-id'),
                'pjax': $(obj).attr('data-pjax'),
                'icon': $(obj).attr('data-icon'),
                'divider': $(obj).next('li').hasClass('divider') ? true : false,
                'callback': $(obj).attr('data-callback'),
            };
        },
        updateItemTitle: function (origin, translate) {
            $.ajax({
                url: '/admin/components/cp/admin_menu/ajaxUpdateItemTitle',
                type: 'POST',
                data: {
                    origin: origin,
                    translate: translate
                },
                success: function (data) {
                }
            });
        },
        setData: function (obj) {
            var inputs = $('.modal_edit_menu_item').find('input');

            $(inputs).each(function () {
                var inputId = $(this).data('id');
                var inputVal = $(this).val();
                $(obj).attr('data-' + inputId, inputVal);

                if (inputId === 'text') {
                    AdminMenu.updateItemTitle($(this).attr('data-origin'), inputVal);
                }
            });

            var pjax = $('.modal_edit_menu_item').find('select[data-id="pjax"]').val();
            var pjaxVal = pjax === 'yes' ? true : false;
            $(obj).attr('data-pjax', pjaxVal);

        },
        prepareItem: function (obj) {
            var data = {};
            var self = this;

            $(obj).each(function (iF) {

                data[iF] = self.getData(this);

                if ($(this).find(' > ul').prop('tagName') === 'UL') {
                    data[iF]['subMenu'] = {};
                    var nextLevel = $(this).find(' > ul');

                    $(nextLevel).find(' > li').each(function (iS) {
                        if (!$(this).hasClass('divider')) {
                            data[iF]['subMenu'][iS] = self.getData(this);

                            if ($(this).find(' > ul').prop('tagName') === 'UL') {

                                data[iF]['subMenu'][iS]['subMenu'] = {};

                                $(this).next().find(' > li').each(function (iT) {
                                    data[iF]['subMenu'][iS]['subMenu'][iT] = self.getData(this);
                                });
                            }
                        }
                    });
                }
            });

            return data;
        },
        updateItemData: function (obj) {
            var editItem = $('#workPlace .editing').first();
            this.setData(editItem);
            $('.modal').modal('hide');
        },
        openSubMenu: function (obj) {
            if ($(obj).prop('tagName') !== 'TD') {
                var parentTD = $(obj).closest('td');
                setTimeout(function () {
                    $(parentTD).addClass('open')
                }, '25');
            }
        }
    }
    ;


$(function () {
    $.contextMenu({
        trigger: 'none',
        selector: '.sortableMenu tr ul > li, .sortableMenu tr > td',
        itemData: '',
        zIndex: 10000000,
        items: {
            editMenuItem: {
                name: lang('Edit menu item'),
                callback: function (key, options) {
                    $('.modal').modal('show');
                    $('#workPlace .editing').removeClass();
                    $(this).addClass('editing');
                    var itemData = AdminMenu.getData(this);

                    for (var item in itemData) {
                        if ($('.modal input[data-id="' + item + '"]').length) {
                            $('.modal input[data-id="' + item + '"]').val(itemData[item]);
                        }

                        if (item === 'text') {
                            var text = $.trim($(this).find(' > a').text());
                            $('.modal input[data-id="' + item + '"]').val(text);
                            $('.modal input[data-id="' + item + '"]').attr('data-origin', itemData[item]);
                        }

                        if (item === 'pjax') {
                            $('.modal select[data-id="' + item + '"]').find('option:selected').removeAttr('selected');
                            var pjaxVal = itemData[item] === 'true' ? 'yes' : 'no';
                            $('.modal select[data-id="' + item + '"]').find('option[value="' + pjaxVal + '"]').attr('selected', 'selected');
                        }
                    }
                }
            },
            sep1: "---------",
            createBeforeMenuItem: {
                name: lang('Insert menu item before current'),
                callback: function (key, options) {
                    var self = this;
                    $.ajax({
                        url: '/admin/components/cp/admin_menu/ajaxGetNewMenuItem',
                        type: 'GET',
                        data: {
                            type: $(self).prop('tagName'),
                        },
                        success: function (data) {
                            if (data) {
                                $(data).insertBefore($(self));
                            }
                        }
                    });
                    AdminMenu.openSubMenu(this);
                }
            },
            createAfterMenuItem: {
                name: lang('Insert menu item after current'),
                callback: function (key, options) {
                    var self = this;
                    $.ajax({
                        url: '/admin/components/cp/admin_menu/ajaxGetNewMenuItem',
                        type: 'GET',
                        data: {
                            type: $(self).prop('tagName'),
                        },
                        success: function (data) {
                            if (data) {
                                $(data).insertAfter($(self));
                            }
                        }
                    });
                    AdminMenu.openSubMenu(this);
                }
            },
            sep2: "---------",
            insertBeforeDivider: {
                name: lang('Insert divider before menu item'),
                disabled: function () {
                    return $(this).prop('tagName') === 'TD';
                }

                ,
                callback: function (key, options) {
                    $('<li class="divider"></li>').insertBefore($(this));
                    AdminMenu.openSubMenu(this);
                }
            }
            ,
            insertAfterDivider: {
                name: lang('Insert divider after menu item'),
                disabled: function () {
                    return $(this).prop('tagName') === 'TD';
                }

                ,
                callback: function (key, options) {
                    $('<li class="divider"></li>').insertAfter($(this));
                    AdminMenu.openSubMenu(this);
                }
            }
            ,
            sep3: "---------",
            deleteMenuItem: {
                name: lang('Delete menu item'),
                callback: function (key, options) {
                    $(this).remove();
                    AdminMenu.openSubMenu(this);
                }
            },

        }
    });


    $('.sortableMenu tr ul > li').live('dblclick', function (e) {
        $(this).contextMenu();
        e.stopPropagation();
    });

    $('.sortableMenu tr > td').live('dblclick', function (e) {
        $(this).contextMenu();
    });

})
;