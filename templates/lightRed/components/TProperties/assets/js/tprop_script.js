$(document).ready(function() {
    $('#prorerties_filter').keyup(function() {
        var inputValue = $(this).val();
        if (inputValue == "") {
            $('.property_row').show();
            return;
        }
        $('.property_row').each(function() {
            var name = $(this).find('.property_name').text().toLowerCase();
            if (
                    name.indexOf(inputValue) != -1 ||
                    inputValue.indexOf(name) != -1
                    ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});