$(document).ready(function(){
    $('.autoload_ch').live('click', function(){
        var mid = $(this).attr('data-mid');
        var $this = $(this);
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
        var murl = $(this).attr('data-murl');
        var mname = $(this).attr('data-mname');
        var $this = $(this);
        $.ajax({
            type:       'post',
            data:       'mid='+mid,
            dataType:   "json",
            url:        '/admin/components/change_url_access',
            success: function(obj){
                if(obj.result === false){
                    alert('Что-то пошло не так. Доступ по URL не изменен.');
                }else{
                    if(obj.result.enabled === 1)
                    {
                        $this.parents('tr:first').children('td.urlholder').html('<a target="_blank" href="'+murl+'">'+mname+'</a>');
                    }else{
                        $this.parents('tr:first').children('td.urlholder').html(' - ');
                    }
                }
            }
        });
    });
    
    $('.mod_instal').live('click', function(){
        var mname = $(this).attr('data-mname');
        var $this = $(this);
        $.ajax({
            type:       'post',
            dataType:   "json",
            url:        '/admin/components/install/'+mname,
            success: function(obj){
                if(obj.result === true){
                    var trin = $this.parents('tr:first').clone();
                    trin.children('td.fdel').remove();
                    trin.children('td.fdel2').remove();
                    trin.append('<td><p> - <p></td>');
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="включить"  data-off="выключить"><span class="prod-on_off autoload_ch" data-mid="{$module.id}"></span></div></td>')
                    trin.append('<td><div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="выключить"  data-off="выключить"><span class="prod-on_off urlen_ch" data-mid="{$module.id}"></span></div></td>')
                    $('#mtbl').append(trin);
                    $this.parents('tr:first').remove();
                    if($('tbody.nim').children('tr').contents().length === 0)
                    {
                        $('#nimt').remove();
                        $('#nimc').html('</br><div class="alert alert-info">Нето модулей для установки</div>');
                    }
                    location.reload();
                }
            }
        });
    });
    
    $('#module_delete').live('click', function(){
        var $this = $(this);
        if($this.hasClass('disabled'))
        {
            alert('Сначала выберите модуль для удаления');
        }
        else{
            if($('.niceCheck:first-child').children('input').attr('value') === 'On')
            {
                var inputs = $('.niceCheck').children('input');
                inputs.each(function(){
                    var inp = $(this);
                    $.ajax({
                        type:       'post',
                        dataType:   "json",
                        url:        '/admin/components/deinstall/'+inp.attr('value'),
                        success: function(obj){
                            if(obj.result)
                            {
                                //alert('Модуль'+inp.attr('value')+'успешно удален');
                                location.reload();
                            }else
                            {
                                alert('Ошибка удаления модуля');
                            }
                        }
                    });
                });
            }
            else
            {
                var inputs = $('.niceCheck').children('input');
                inputs.each(function(){
                    var inp = $(this);
                    if(inp.attr('checked') === 'checked')
                    {
                        if(inp.attr('value') != 'On')
                        {
                            $.ajax({
                                type:       'post',
                                dataType:   "json",
                                url:        '/admin/components/deinstall/'+inp.attr('value'),
                                success: function(obj){
                                    console.log(obj);
                                    if(obj.result)
                                    {
                                        //alert('Модуль'+inp.attr('value')+'успешно удален');
                                        location.reload();
                                    }else
                                    {
                                        alert('Ошибка удаления модуля');
                                    }
                                }
                            });
                        }
                    }
                });
            }
        }
    });
});


