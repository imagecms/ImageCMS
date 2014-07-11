$(document).ready(function() {
$('#categories option').click(function() {
$('#categories option').removeAttr('selected');
 $(this).attr('selected', 'selected');
});    
$('#categories').on('click', function() {

 var msg = $(this).val();
 $('.controls11').html("<p style='margin-left:20px;'>please wait...</p>");
        $.ajax({
          type: 'POST',
          url: '/admin/components/cp/hotline/getProperties',
          data: {category:msg},
          success: function(data) {
            $('.controls11').html(data);   
            $('.empty').on('click', function() {
            var msg1 = $( "#categories option:selected" ).val();
                $.ajax({
                        type: 'POST',
                        data: {category:msg1},
                        url: '/admin/components/cp/hotline/getProperties/empty',
                        success: function(data) {
                            $('.controls11 .but_clear').before(data);
                                        $('.controls1 .del_item').on('click', function() {
                $(this).parent().parent().remove();
            });
                        }
                });          
                
            });
                $(' .save_btn').on('click', function() {
                var str = $("#settings_form_properties").serialize();
                var msg2 = $( "#categories option:selected" ).val();
                $.ajax({
                    type: 'POST',
                    url: '/admin/components/cp/hotline/setProperties',
                    data: {settings_form_properties:str, category:msg2},
                        });
                 });                 
            $('.controls1 .del_item').on('click', function() {
                $(this).parent().parent().remove();
            });
          }
        });

});
})


