$(document).ready(function(){
    $('.protocolSettings').change(function(){
        if($(this).val() === "SMTP"){
            $('.portControlGroup').css('display', 'block');
        }else{
            $('.portControlGroup').css('display', 'none');
        }
    });
    
    $('.niceCheck').click(function(){
        if($(this).find('.wraper_activSettings').attr('checked')){
            $('.wraperControlGroup').slideUp(500);
        }else{
            $('.wraperControlGroup').slideDown(500);
        }
       
    });
});

function mailTest(){
    var from = $('#from').val();
    var from_email = $('#from_email').val();
    var theme = $('#theme').val();
    var protocol = $('#protocol').val();
    var port = $('#port').val();
    var mailpath = $('#mailpath').val();
    var send_to = $('#admin_email').val();
    
  //  console.log(from +" "+ from_email+" "+theme+" "+protocol+" "+port+" "+type+" "+mailpath);
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
            }
        });
    
    return false;
    
}