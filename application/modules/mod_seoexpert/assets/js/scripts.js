$(document).ready(function() {
    /**  Autocomplete for categories    */
    if ($('#autocomleteCategory').length) {
        $('#autocomleteCategory').autocomplete({
            source: base_url + 'admin/components/cp/mod_seoexpert/categoryAutocomplete?limit=20',
            select: function(event, ui) {
                categoriesData = ui.item;
            },
            close: function() {
                $('#autocomleteCategoryId').val(categoriesData.id);
            }
        });
    }


    /** Change active or not category*/
    $('.seoProductCategoriesTable').find('span.prod-on_off.categorySeo').off('click').on('click', function() {
        var catId = $(this).attr('data-id');
        changeActive();
        $.ajax({
            type: 'POST',
            data: 'id=' + catId,
            url: base_url + 'admin/components/init_window/mod_seoexpert/ajaxChangeActiveCategory',
            success: function(response) {
                if (response == 'true')
                    showMessage(lang('Status changed'), '', 'g')
            }
        });
    });


    /** Change use for empty meta*/
    $('.seoProductCategoriesTable').find('span.prod-on_off.emptyMetaSeo').off('click').on('click', function() {
        var catId = $(this).attr('data-id');
        changeEmtyActive();
        $.ajax({
            type: 'POST',
            data: 'id=' + catId,
            url: base_url + 'admin/components/init_window/mod_seoexpert/ajaxChangeEmptyMetaCategory',
            success: function(response) {
                if (response == 'true')
                    showMessage(lang('Status changed'), '', 'g')
            }
        });
    });

    function changeEmtyActive() {
        $('.prod-on_off.emptyMetaSeo').die('click');
        $('.prod-on_off.emptyMetaSeo').live('click', function() {
            var $this = $(this);
            if (!$this.hasClass('disabled')) {
                if ($this.hasClass('disable_tovar')) {

                    $this.parent().attr('data-original-title', lang('No'))
                    $('.tooltip-inner').text(lang('No'));

                }
                else {

                    if ($this.parent().data('only-original-title') == undefined) {
                        $this.parent().attr('data-original-title', lang('Yes'))

                        $('.tooltip-inner').text(lang('Yes'));
                    }
                }

            }
        });
    }
    /**Change Active */
    function changeActive() {
        $('.prod-on_off.categorySeo').die('click');
        $('.prod-on_off.categorySeo').live('click', function() {
            var $this = $(this);
            if (!$this.hasClass('disabled')) {
                if ($this.hasClass('disable_tovar')) {

                    $this.parent().attr('data-original-title', lang('Not show'))
                    $('.tooltip-inner').text(lang('Not show'));

                }
                else {

                    if ($this.parent().data('only-original-title') == undefined) {
                        $this.parent().attr('data-original-title', lang('Show'))

                        $('.tooltip-inner').text(lang('Show'));
                    }
                }

            }
        });
    }

});