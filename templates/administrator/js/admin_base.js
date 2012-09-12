$(document).ready(function(){
    //$('span.prod-on_off').live('click', function(){
    $('.autoload_ch').live('click', function(){
        var mid = $(this).attr('data-mid');
        var $this = $(this);
        //console.log(mid);
        $.ajax({
            type:       'post',
            data:       'mid='+mid,
            dataType:   "json",
            url:        '/admin/components/change_autoload',
            success: function(obj){
                if(obj.result === false){
                    alert('Что-то пошло не так. Статус автозагрузки не изменен.');
                }
            }
        });
    });
    
    $('.urlen_ch').live('click', function(){
        var mid = $(this).attr('data-mid');
        var $this = $(this);
        //console.log(mid);
        $.ajax({
            type:       'post',
            data:       'mid='+mid,
            dataType:   "json",
            url:        '/admin/components/change_url_access',
            success: function(obj){
                if(obj.result === false){
                    alert('Что-то пошло не так. Доступ по URL не изменен.');
                }
            }
        });
    });
    
    $('.mod_instal').live('click', function(){
        var mname = $(this).attr('data-mname');
        var $this = $(this);
        $.ajax({
            type: 'post',
            data: 'mname='+mname,
            dataType:   "json",
            url:  '/admin/components/install',
            success: function(obj){
                if(obj.result === true){
                    var trin = $this.parents('tr:first').clone();
                    trin.children('td.fdel').remove();
                    trin.children('td.fdel2').remove();
                    trin.append('<td><p> - <p></td>');
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="включить"  data-off="выключить"><span class="prod-on_off autoload_ch" data-mid="{$module.id}"></span></div></td>')
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="выключить"  data-off="выключить"><span class="prod-on_off urlen_ch" data-mid="{$module.id}"></span></div></td>')
                    //console.log(trin);
                    $('#mtbl').append(trin);
                    $this.parents('tr:first').remove();
                }
            }
        });
    });

    $('#testclick').live('click', function(){
        //alert('skjfkdjfksld');
        console.log('fjsdhfljkdfjlskd');
    });
});


