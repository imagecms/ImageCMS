$(document).ready(function(){
    $('.protocolSettings').change(function(){
        console.log($(this).val());
        if($(this).val() =="SMTP"){
            $('.portControlGroup').css('display', 'block');
        }else{
            $('.portControlGroup').css('display', 'none');
        }
    });
});