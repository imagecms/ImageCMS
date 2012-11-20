var USTickets = new Object();

USTickets.deleteOne  = function(id)
{
    $.post('/admin/components/cp/user_support/delete_ticket', {id:id}, function(data){
       $('.notifications').append(data);
    });
}

USTickets.deleteComment = function(id)
{
    $.post('/admin/components/cp/user_support/delete_comment', {id:id}, function(data){
       $('.notifications').append(data);
    });    
}

USTickets.addComment = function(ticketId, text)
{
    $.post('/admin/components/cp/user_support/add_comment/'+ticketId, {text:text}, function(data){
       $('.notifications').append(data);
    });    
}

USTickets.deleteDepartment = function(id)
{
    $.post('/admin/components/cp/user_support/delete_department', {id:id}, function(data){
       $('.notifications').append(data);
    });    
}