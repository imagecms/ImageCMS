function renderPosts($this)
{
    $.ajax({
        url: "/comments/api/renderPosts",
        dataType: "json",
        type: "post",
        success: function(obj) {
            $('#four').empty();

            var tpl = obj.comments;

            $('#four').append(tpl);
            $('#comment').val('');
            $('#plus').val('');
            $('#minus').val('');
            $('.comment_ajax_refer > a').bind('click', function() {
                $this = $(this);
                $this.next().slideToggle(200, function() {
                    $this.parent().toggleClass('visible');
                }).end().parent().parent().next().slideToggle(200).end().find('.blue_arrow').toggleClass('up');
                return false;
            });
            
            if (obj.total_comments !== 0) {
                $('#cc').html('');
                $('#cc').append("Всего комментариев: " + obj.total_comments);
            }
        }
    });
}

function post($this)
{
    $.ajax({
        url: "/comments/api/newPost",
        data: $($this).closest('form').serialize() +
                '&action=newPost',
        dataType: "json",
        type: "post",
        success: function(obj) {

            $('#comment_text').val('');
            $('#comment_plus').val('');
            $('#comment_minus').val('');

            if (obj.answer == 'sucesfull') {
                renderPosts();
            }
            else {
                $('#error_text').html('');
                $('#error_text').append(obj.validation_errors);
            }
        }
    });
}