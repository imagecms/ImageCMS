function con(val) {
    console.log(val)
}

$(function () {
    $(".drag li").draggable({
        helper: "clone",
        cursor: 'move',
        drag: function () {
        }
    });

    $(".drop").droppable({
        accept: ".drag li",
        drop: function (event, ui) {
            var identifier = ui.draggable.attr('identifier');
            var parent = ui.draggable.attr('parent');
            var dragEl = ui.draggable.clone();

            if (parent) {
                var parentInList = $(event.target).find('li[identifier="' + parent + '"]');
                if ($(parentInList).length) {
                    if ($(parentInList).next().prop("tagName") === 'UL') {
                        if (!$(parentInList).next().find('li[identifier="' + identifier + '"]').length) {
                            $(dragEl).appendTo($(parentInList).next());
                        }
                    } else {
                        var parentUl = $('<ul></ul>').insertAfter(parentInList);
                        $(dragEl).appendTo(parentUl);
                    }
                } else {
                    var parentElement = ui.draggable.parent().prev();
                    $(parentElement.clone()).appendTo(this);

                    var parentUl = $('<ul></ul>').appendTo(this);
                    $(dragEl).appendTo(parentUl);
                }

            } else {
                if (!$(event.target).find('li[identifier="' + identifier + '"]').length) {
                    $(dragEl).appendTo(this);
                }
            }
            $(this).parent().animate({scrollTop: $(this).height()}, 60);

            var intervalBlinck = setInterval(function () {
                var element = dragEl;

                if (element[0]) {
                    if (!element[0].style.color) {
                        element.css('color', 'red');
                    }

                    if (element[0].style.color === "red") {
                        element.css('color', '#333');
                    } else {
                        element.css('color', 'red');
                    }
                }
            }, 200);

            setTimeout(function () {
                clearInterval(intervalBlinck);
            }, 1400);
        }
    });

//    $(".drop li").live('dblclick', function () {
//        if ($(this).next().prop('tagName') === 'UL') {
//            $(this).next().remove();
//        }
//        $(this).remove();
//    });

    $(".sortable > ul").sortable();
//    $(".sortable > ul").sortable();
});




var AdminMenu = {
    searchTariff: function (el) {
        var searchText = $(el).val().toLowerCase();
        var tariffs = $('.menusList > div');

        if (searchText) {
            $(tariffs).each(function () {
                var tariffName = $.trim($(this).find('h5').text()).toLowerCase();
                if (tariffName.indexOf(searchText) != -1) {
                    $(this).show();
                    con(tariffName)
                } else {
                    $(this).hide();
                }
            });
        } else {
            $(tariffs).show();
        }


    },
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
        var corporate = $('.corporate > ul > li');
        var professional = $('.professional > ul > li');
        var premium = $('.premium > ul > li');

        $.ajax({
            url: '/admin/components/init_window/admin_menu/saveMenu',
            type: 'POST',
            data: {
                corporate: this.prepareItem(corporate),
                professional: this.prepareItem(professional),
                premium: this.prepareItem(premium)
            },
            success: function (data) {
                $('.notifications').html(data);
            }
        });

    },
    saveTariffs: function (obj) {
        var tariffs = $('.tariff');
        var tariffsMenus = {};

        var self = this;
        $(tariffs).each(function () {
            var tariffId = $(this).attr('tariff_id');
            var menuList = $(this).find('> ul > li');

            tariffsMenus[tariffId] = self.prepareItem(menuList);
        });

        $.ajax({
            url: '/admin/components/init_window/admin_menu/saveTariffsMenus',
            type: 'POST',
            data: {
                tariffsMenus: JSON.stringify(tariffsMenus)
            },
            success: function (data) {
                $('.notifications').html(data);
            }
        });
    },
    getData: function (obj) {
        return data = {
            'identifier': $(obj).attr('identifier'),
            'text': $(obj).attr('text'),
            'link': $(obj).attr('link'),
            'class': $(obj).attr('item_class'),
            'id': $(obj).attr('item_id'),
            'pjax': $(obj).attr('pjax'),
            'icon': $(obj).attr('icon'),
            'divider': $(obj).attr('divider') ? true : false,
        };
    },
    prepareItem: function (obj) {
        var data = {};
        var self = this;
        $(obj).each(function (iF) {

            data[iF] = self.getData(this);

            if ($(this).next().prop('tagName') === 'UL') {
                data[iF]['subMenu'] = {};
                var nextLevel = $(this).next();

                $(nextLevel).find(' > li').each(function (iS) {
                    data[iF]['subMenu'][iS] = self.getData(this);

                    if ($(this).next().prop('tagName') === 'UL') {

                        data[iF]['subMenu'][iS]['subMenu'] = {};

                        $(this).next().find(' > li').each(function (iT) {
                            data[iF]['subMenu'][iS]['subMenu'][iT] = self.getData(this);
                        });
                    }

                });
            }
        });

        return data;
    },
    searchModule: function (el) {
        var searchText = $(el).val().toLowerCase();
        var modules = $(el).closest('ul').find('a');

        if (event.keyCode != 13) {
            if (searchText) {
                $(modules).each(function () {
                    var moduleName = $.trim($(this).text()).toLowerCase();
                    if (moduleName.indexOf(searchText) != -1) {
                        $(this).closest('li').show();
                    } else {
                        if ($(this).attr('href').indexOf('modules_table') == -1) {
                            $(this).closest('li').hide();
                        }
                    }
                });
            } else {
                $(modules).closest('ul').find('li').show();
            }
        } else {
            var searched = $(el).closest('ul').find('li').not('[style="display: none;"]');
            if (searched.length >= 4) {
                var url = $(searched[4]).find('a').attr('href');
                if (url) {
                    location.href = url;
                }
            }
        }
    }
};


//$(function () {
//    $.contextMenu({
//        trigger: 'none',
//        selector: '.menusList li',
//        itemData: '',
//        items: {
////            editMenuItem: {
////                name: lang('Edit menu item'),
////                callback: function (key, options) {
////                    var m = "edit was clicked";
////                    $('.modal').modal('show');
////                    var itemData
////                    console.log(this);
////                }
////            },
//            deleteMenuItem: {
//                name: lang('Delete menu item'),
//                callback: function (key, options) {
//                    if ($(this).next().prop('tagName') === 'UL') {
//                        $(this).next().remove();
//                    }
//                    $(this).remove();
//                }
//            }
//        }
//    });
//
//    $('.menusList li').on('dblclick', function (e) {
//        e.preventDefault();
//        $(this).contextMenu();
//    });
//});