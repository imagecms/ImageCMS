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