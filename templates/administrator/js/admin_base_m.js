$(document).ready(function(){
    
    $('.clearCashe').on('click', function(){
        $this = $(this);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: 'param='+$this.attr('data-param'),
            url: $this.data('target'),
            success: function(obj){
                console.log(obj.color);
                if(obj.result == true)
                    showMessage(null, obj.message, obj.color);
                else
                    showMessage(obj.message, null, obj.color);
                console.log(obj.fileCount);
                $('.filesCount').text(obj.filesCount);
            }
        });
    })
    
//            $('#del').live('click', function(){
//     alert('Delete menu');
//    })

    $('#createMenu').live('click', function(){
//        var url = '/admin/widgets_manager/create_tpl';
//        redirect_url(url);
alert('Create Menu');
    });
    
    
    
   
    $('.saveButton').live('click', function(){
        var idMenu = $(this).attr('idMenu');  
         $.ajax({
            type: 'post',
            dataType: 'json',
            data: $('.saveForm').serialize(),
            url: '/admin/components/cp/menu/update_menu/'+idMenu,
            success: function(obj){
               console.log(obj.color);
                if(obj.result == true)
                      showMessage('Успех', obj.message);
                else
                    showMessage('Ошибка', obj.message, 'r');
               
            }
        });

    });
   

});
