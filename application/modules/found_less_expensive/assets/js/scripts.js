/** Show form**/
$('#foundLessExpensixe').live('click',function(){
       $('#foundLessExpensixeDrop').fadeIn(100);
       $('.errorMessage').hide();
       $('.badData').removeClass('badData');
       $('.horizontalF_form').show();
});
/** Hide form**/
$('#hideFormButton').live('click',function(){
       $('.forClear').val('');
       $('#foundLessExpensixeDrop').fadeOut(100);
       $('.errorMessage').hide();
       $('.badData').removeClass('badData');
       $('.horizontalF_form').show();
});
/** On send form **/
$('.btnF_Send').live('click',function(){
   var data   = $('#fLessExpensiveForm').serialize();
   var validation = true;
   var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
    $('.horizontalF_form').show();
    $('.errorMessage').hide();
    $('.badData').removeClass('badData');
    $('.required').each(function() {
        if(!$(this).val().length) {
            $(this).addClass('badData');
            $('.errorMessage').html(lang('Fill in required fields!')).show();
            validation = false;
            return false;
        }else {
            if ($(this).hasClass('emailRequired') && $(this).val().search(pattern) != 0){
                 $(this).addClass('badData');
                 $('.errorMessage').html(lang('Invalid email!')).show();
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
                $('.horizontalF_form').hide();
                $('.errorMessage').html(lang('Sent! Thanks for the notification!')).show();;
                $('#foundLessExpensixeDrop').fadeOut(2000);
                $('.forClear').val('');
             }
         });
    }
    return false;
});

/**
 * Admin part
 */
var expensive = new Object({
    deleteOne: function(id , el) {
        var row = $(el).closest('tr');
        $.ajax({
                type: "POST",
                data:  'id='+id,
                url: '/found_less_expensive/admin/ajax_delete',
                success: function(res) {
                        $('.notifications').append(res);
                        expensive.recheckCount(el);
                        row.hide();
                }
        });
    },
    recheckCount: function (obj){
        var tabActive = $('.btn.btn-small.pjax.active').children('span');
        var newCount = parseInt(tabActive.html())-1;
        var tabAll = $('#countAll');
        //remove from tabs with all
        if (tabAll.data('statusTab') != tabActive.data('statusTab')){
             tabAll.html(parseInt(tabAll.html())-1);
             tabActive.html(newCount);
        }else{
             tabAll.html(parseInt(tabAll.html())-1);
             idForChange = '#' + $(obj).closest('tr').find('.statusSelect').children('option:selected').data('status');
             $(idForChange).html(parseInt($(idForChange).html())-1);
        } 
    }
});

/** Change status**/
$('.statusSelect').die().live('change',function(){
      var tabActive = $('.btn.btn-small.pjax.active').children('span');
      var tabAll = $('#countAll');
      var newStatus = $(this).children('option:selected').data('statusnumber');
      id = $(this).closest('tr').data('id');
      row = $(this).closest('tr');
      $.ajax({
                type: "POST",
                data:  'id='+id+'&status='+newStatus,
                url: '/found_less_expensive/admin/ajax_change_status',
                success: function(res) {
                        $('.notifications').append(res);
                        if (tabAll.data('statustab') != tabActive.data('statustab')){
                            row.hide();
                        }
                        if (newStatus == '1') {
                            $('#countNew').html(parseInt($('#countNew').html())-1);
                            $('#countAccepted').html(parseInt($('#countAccepted').html())+1);
                        }else {
                            $('#countNew').html(parseInt($('#countNew').html())+1);
                            $('#countAccepted').html(parseInt($('#countAccepted').html())-1);
                        }
                }
        });
});
$('#settingsSave').die().live('click',function(event){
    $.ajax({
        type: "POST",
        data:  $('#settingsForm').serialize(),
        url: '/found_less_expensive/admin/ajax_save_settings',
        success: function(res) {
                $('.notifications').append(res);

        }
    });
    
    
});





