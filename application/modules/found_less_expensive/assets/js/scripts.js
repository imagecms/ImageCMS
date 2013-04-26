$('#foundLessExpensixe').live('click',function(){
       $('#foundLessExpensixeDrop').fadeIn(100);
})
$('#hideFormButton').live('click',function(){
       $('#foundLessExpensixeDrop').fadeOut(100);
       $('.errorMessage').hide();
       $('.badData').removeClass('badData');
})
$('.btnF_Send').live('click',function(){
   var data   = $('#fLessExpensiveForm').serialize();
   var validation = true;
   var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
    $('.errorMessage').hide();
    $('.badData').removeClass('badData');
    $('.required').each(function() {
        if(!$(this).val().length) {
            $(this).addClass('badData');
            $('.errorMessage').html('Заполните обязательные поля!').show();
            validation = false;
            return false;
        }else {
            console.log($(this).val());
            if ($(this).hasClass('emailRequired') && $(this).val().search(pattern) != 0){
                 $(this).addClass('badData');
                 $('.errorMessage').html('Неверный email!').show();
                 validation = false;
                 return false;
            }
        }
    });
    if (validation == true){
        $.ajax({
             type: "POST",
             data:  data,
             url: '/found_less_expensive/save_message',
             success: function(res) {
                 console.log(res);
                 $('#foundLessExpensixeDrop').fadeOut(100);
                 $('.forClear').val('');
             }
         });
    }
    return false;
})
//chage processed
function ChangeProcessed(el, Id)
{
    var currentActiveStatus = $(el).attr('rel');

    $.post('/found_less_expensive/admin/changeProcessed', {
        fleId: Id,
        status: currentActiveStatus
    }, function(data) {
        $('.notifications').append(data)
        if (currentActiveStatus == 'true')
        {
            $(el).addClass('disable_tovar').attr('rel', false);

        } else {
            $(el).removeClass('disable_tovar').attr('rel', true);
        }

    });
}