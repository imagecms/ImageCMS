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

    $('.mailTestResultsHide').on('click', function() {
        $('.mailTestResults').css('display', 'none');
        $(this).css('display', 'none');

    });


});

function mailTest() {
    var from = $('#from').val();
    var from_email = $('#from_email').val();
    var theme = $('#theme').val();
    var protocol = $('#protocol').val();
    var port = $('#port').val();
    var mailpath = $('#mailpath').val();
    var send_to = $('#admin_email').val();

    $.ajax({
        type: 'POST',
        data: {
            from: from,
            from_email: from_email,
            theme: theme,
            protocol: protocol,
            port: port,
            mailpath: mailpath,
            send_to: send_to
        },
        url: '/email/mailTest',
        success: function(data) {
            $('.mailTestResults').html(data);
            $('.mailTestResults').css('display', 'block');
            $('.mailTestResultsHide').css('display', 'block');
            var curPos = $(document).scrollTop();
            var height = $("body").height();
            var scrollTime = (height - curPos) / 1.73;
            $("body,html").animate({"scrollTop": height}, scrollTime);
        }
    });
    return false;
}
