function change_status(hrefFn) {  
    $.ajax({
        type: 'POST',
        url: hrefFn,
        onComplete: function(response) { }
    });
}
//var changeStatus2 =  new Object({
//
////changestatus:function(id, statusId)
////	{
////		$.post('/admin/components/run/shop/notifications/changeStatus/', {CallbackId:id, StatusId:statusId}, function(data){
////			$('.notifications').append(data);
////		});
////		$('#notification_1').closest('tr').data('status', statusId);
////		this.reorderList(id);
////	}
////    });

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
    
    
  
        

	
     
    

});


var delete_function = new Object({
    
    deleteFunction:function (){
		
        $('.modal').modal();
		
    },
        
        
    deleteFunctionConfirm:function (href)
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function(){
            ids.push($(this).val());
        });
        $.post(href, {
            ids:ids
        }, function(data){
            $('#mainContent').after(data);
            $.pjax({
                url:window.location.pathname, 
                container:'#mainContent'
            });
        });
        $('.modal').modal('hide');
        return true;
    }
    
});
