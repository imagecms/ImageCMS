var polls = new Object();

polls.deleteOne = function(id)
{
    $.post('/admin/components/cp/polls/delete/'+id, {'id':id}, function(data){
                $('.notifications').append(data);
            }
        );
}

polls.addAnswerField = function(){
    var count = $('.control-group').length -2;
    var answer = $('#answerTpl').clone();
    $(answer).find('input').val('');
    $(answer).find('.control-label').html('Оевет '+count+":");
    $('#poll .control-group').not('.addAnswerBtn').last().after($(answer).fadeIn(200));
}

polls.deleteAnswer = function(pid, id)
{
    $.post('/admin/components/cp/polls/delete_answer/'+pid+'/'+id, {}, function(data){
                $('.notifications').append(data);
            }
        );
}