$(document).ready(function() {
    $('.protocolSettings').on('change', function() {
        if ($(this).val() === "SMTP") {
            $('.portControlGroup').css('display', 'block');
        } else {
            $('.portControlGroup').css('display', 'none');
        }
    });

    $('.niceCheck').on('click', function() {
        if ($(this).find('.wraper_activSettings').attr('checked')) {
            $('.wraperControlGroup').slideUp(500);
        } else {
            $('.wraperControlGroup').slideDown(500);
        }
    });

    $('#userMailVariables').on('click', function() {
        $('#userMailText').append(' ' + $(this).val() + ' ');
    });
    $('#adminMailVariables').on('click', function() {
        $('#adminMailText').append(' ' + $(this).val() + ' ');
    });
});