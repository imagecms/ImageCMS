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
})