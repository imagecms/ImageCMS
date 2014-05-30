$(document).ready(function() {
    $('[name="openLevels"]').change(function(){
        if ($(this).val() === '2')
            $('.frame-level-2-select select').attr('disabled', 'disabled');
        else
            $('.frame-level-2-select select').removeAttr('disabled', 'disabled');
    });
});