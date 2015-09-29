function log(arg) {
    console.log(arg);
}

function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}

$(document).ready(function () {
    $('body').on('click', '.nav-tabs-seo-links > li', function () {
        $(this).closest('ul').find('li').removeClass('active');
        $(this).addClass('active');
        SeoPhysicalPages.fillForm($(this).find('a'));
    });

    $('body').on('click', '.nav-tabs-seo-links > li', function () {
        $(this).closest('ul').find('li').removeClass('active');
        $(this).addClass('active');
        SeoPhysicalPages.fillForm($(this).find('a'));
    });
});

var SeoPhysicalPages = {
    nav_tabs: '.nav-tabs-seo-links',
    table: '.seo-filter-table',
    form: '.formSeoPhysicalPages',
    getBrands: function (categoryObj) {
        var categoryId = $(categoryObj).val();
        var locale = $('input[name="Locale"]').val();

        if (categoryId == 0) {
            $('.brands_url_entity_finder > .brands-select').html('');
            $('.brands_url_entity_finder').hide();
            return false;
        }

        $.ajax({
            type: 'GET',
            url: '/admin/components/cp/smart_filter/ajaxGetBrands/' + categoryId + '/' + locale,
            success: function (data) {
                if (data) {
                    $('.brands_url_entity_finder > .brands-select').html(data);
                    $('.brands_url_entity_finder').show();
                    $('.brands_url_entity_finder > select').chosen();
                    $('.brands_url_entity_finder > select').trigger("chosen:updated");
                } else {
                    showMessage(lang('Error'), lang('No brands for this category'), 'r');
                }
            }

        });
    },
    urlExist: function (entityId, categoryId, entityType) {
        log($(this.table + ' a[data-entityid="' + entityId + '"][data-categoryid="' + categoryId + '"][data-entitytype="' + entityType + '"]'))
        return $(this.table + ' a[data-entityid="' + entityId + '"][data-categoryid="' + categoryId + '"][data-entitytype="' + entityType + '"]').length;
    },
    prependToNavs: function (selectedObj) {
        var entityName = $.trim($(selectedObj).find('option:selected').data('name'));
        var entityUrl = $.trim($(selectedObj).find('option:selected').data('url'));
        var entityId = $(selectedObj).val();
        var entityType = $(selectedObj).data('type');
        var categoryId = $(this.table + ' select[name="category"]').val();
        var categoryName = $.trim($(this.table + ' select[name="category"]').find('option:selected').text());
        var entityLang = (entityType === 'brand') ? lang('Brand') : lang('Property');
        categoryName = replaceAll('-', '', categoryName);

        if (!entityName) {
            return false;
        }

        if (this.urlExist(entityId, categoryId, entityType)) {
            showMessage(lang('Warning'), lang('Such url already exist'), 'w');
            return false;
        }

        var item = '<li class="active">' +
            '<a data-entityId="' + entityId +
            '" data-entityType="' + entityType +
            '" data-categoryId="' + categoryId + '">' +
            lang('Category') + ': ' +
            categoryName + ', ' +
            entityLang + ': ' +
            entityName +
            '</a><button style="display: none" onclick="SeoPhysicalPages.removeLink(this)" type="button" class="btn btn-small removeLink pull-right"><i class="icon-trash" style="z-index: 3;"></i></button>' +
            '</li>';

        $(this.nav_tabs).closest('ul').find('li').removeClass('active');
        $(this.nav_tabs).prepend(item);
        this.fillForm($(this.nav_tabs).find('li.active > a'));
        $(this.table + ' .empty-urls-list').hide();
    },
    fillForm: function (itemObj) {
        this.clearForm();
        var categoryId = $(itemObj).data('categoryid');
        var entityId = $(itemObj).data('entityid');
        var entityType = $(itemObj).data('entitytype');
        var linkId = $(itemObj).data('id');
        var linkLocale = $('input[name="Locale"]').val();

        $(this.form).find('input[name="smart_filter[category_id]"]').val(categoryId);
        $(this.form).find('input[name="smart_filter[type]"]').val(entityType);
        $(this.form).find('input[name="smart_filter[entity_id]"]').val(entityId);

        if (linkId) {
            $.ajax({
                async: false,
                type: 'POST',
                url: '/admin/components/cp/smart_filter/ajaxGetLinkData',
                data: {
                    id: linkId,
                    locale: linkLocale
                },
                success: function (data) {
                    data = JSON.parse(data);
                    link = data.data[0];

                    $(SeoPhysicalPages.form).find('input[name="smart_filter[h1]"]').val(link.h1);
                    $(SeoPhysicalPages.form).find('input[name="smart_filter[id]"]').val(link.id);
                    $(SeoPhysicalPages.form).find('textarea[name="smart_filter[meta_description]"]').val(link.meta_description);
                    $(SeoPhysicalPages.form).find('textarea[name="smart_filter[meta_keywords]"]').val(link.meta_keywords);
                    $(SeoPhysicalPages.form).find('textarea[name="smart_filter[meta_title]"]').val(link.meta_title);
                    $(SeoPhysicalPages.form).find('textarea[name="smart_filter[seo_text]"]').val(link.seo_text);
                    $(SeoPhysicalPages.form).find('iframe').contents().find('body').html(link.seo_text);

                    if (link.active) {
                        $(this.form).find('.niceCheck').trigger('click');
                    }

                    //log(link.meta_keywords);
                }
            });
        }


    },
    clearForm: function () {
        $(this.form).find('input, textarea').val('');

        if ($(this.form).find('.niceCheck').parent('span').hasClass('active')) {
            $(this.form).find('.niceCheck').trigger('click');
        }
        $(this.form).find('iframe').contents().find('body').html('');
    },
    saveSettings: function () {
        var formElements = $('[name^="smart_filter["]');
        var $_POST = {};
        $_POST['smart_filter[locale]'] = $('[name="Locale"]').val();

        $(formElements).each(function () {
            $_POST[$(this).attr('name')] = $(this).val();
        });

        if ($(this.form).find('.niceCheck').parent('span').hasClass('active')) {
            $_POST['smart_filter[active]'] = 1;
        } else {
            $_POST['smart_filter[active]'] = 0;
        }

        $.ajax({
            type: 'POST',
            data: $_POST,
            url: '/admin/components/cp/smart_filter/savePhysicalPages',
            success: function (data) {
                data = JSON.parse(data);

                var messageType = data.success ? '' : 'r';
                var messageTitle = data.success ? lang('Message') : lang('Error');
                showMessage(messageTitle, data.message, messageType);
                if (data.success) {
                    $(SeoPhysicalPages.form).find('input[name="smart_filter[id]"]').val(data.data.id);
                    $(SeoPhysicalPages.nav_tabs).find('li.active > button').attr('data-id', data.data.id);
                    $(SeoPhysicalPages.nav_tabs).find('li.active > button').show();
                }
            }
        });
    },
    removeLink: function (linkObj) {
        var linkId = $(linkObj).data('id');
        var linkLocale = $('input[name="Locale"]').val();

        $.ajax({
            type: 'POST',
            data: {
                id: linkId,
                locale: linkLocale
            },
            url: '/admin/components/cp/smart_filter/deleteLink',
            success: function (data) {
                $(linkObj).closest('li').remove();
                $(SeoPhysicalPages.nav_tabs).find('li').first().addClass('active');
                $(SeoPhysicalPages.nav_tabs).find('li').first().trigger('click');
                showMessage(lang('Success'), lang('Link deleted'));
            }
        });
    }
};