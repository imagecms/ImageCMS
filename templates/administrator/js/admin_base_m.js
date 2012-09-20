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

    $('#createLink').live('click', function(){

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
                    showMessage(obj.title, obj.message);
                else
                    showMessage(obj.title, obj.message, 'r');
               
            }
        });

    });
    
    
    $('.createMenu').live('click', function(){         
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $('.createMenuForm').serialize(),
            url: '/admin/components/cp/menu/create_menu/',
            success: function(obj){
                
                if(obj.result == true){
                    
                    var url = '/admin/components/cp/menu/';
                    redirect_url(url);
                    showMessage(obj.title, obj.message);
                
                }else{
                    
                    showMessage(obj.title, obj.message, 'r');
                }
                    
               
            }
        });

    });
    

        
 
    
    $('.export').live('click', function(){ 
        
//        console.log($('input[name=export]:checked').val());
//        return false;
        
        if($('input[name=export]:checked').val() == 'csv'){
            
            $('#exportUsers').submit();
            
        }//else{
//            $.ajax({
//            type: 'post',
//            dataType: 'json',
//            data: $('#exportUsers').serialize(),
//            url: '/admin/components/run/shop/system/exportUsers'
//
//        });
//        } 
    });
       
    
    
    
    $('.deleteMenu').live('click', function(){

        var data_id = $(this).attr('product_id');
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: $('#deleteMenu').serialize(),
            url: '/admin/components/cp/menu/update_menu/',
            success: function(obj){
                console.log(obj.color);
                if(obj.result == true)
                    showMessage(obj.title, obj.message);
                else
                    showMessage(obj.title, obj.message, 'r');
               
            }
        });   
        alert(data_id);
       
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $('.createLink').live('click', function(){

        alert('Create Link');
    });
    
    
    function redirect_url(url)
    {
        $(location).attr('href',url);
    }
    

});
