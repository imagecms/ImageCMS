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

});