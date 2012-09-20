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
                    //alert('Что-то пошло не так. Статус автозагрузки не изменен.');
                    showMessage('Ошибка', 'Что-то пошло не так. Статус автозагрузки не изменен.');
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
                    showMessage('Ошибка', 'Что-то пошло не так. Доступ по URL не изменен.');
                //alert('Что-то пошло не так. Доступ по URL не изменен.');
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
                        $('#nimc').html('</br><div class="alert alert-info">Нету модулей для установки</div>');
                    }
                    showMessage('Установка модуля', 'Модуль успешно устновлен');
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
            if(confirm('Удалить модуль?')){
                if($('.niceCheck:first-child').children('input').attr('checked') === 'checked')
                {
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
                                    }else
                                    {
                                    }
                                }
                            });
                        });
                        location.reload();
                    }
                }
                else
                {
                    var inputs = $('.niceCheck').children('input');
                    inputs.each(function(){
                        var inp = $(this);
                        if(inp.attr('checked') === 'checked')
                        {
                            $.ajax({
                                type:       'post',
                                dataType:   "json",
                                url:        '/admin/components/deinstall/'+inp.attr('value'),
                                success: function(obj){
                                    if(obj.result)
                                    {
                                    }else
                                    {
                                    }
                                }
                            });
                        }
                    });
                    location.reload();
                }
            }
        }
    });
        
    $( "#mtbl" ).bind( "sortstop", function(event, ui) {
        var rows =  $('#mtbl').children('tr');
        var arr = new Array();
        rows.each(function(){
            arr[$(this).index()] = $(this).attr('data-id'); 
        });
        $.ajax({
            type:       'post',
            dataType:   "json",
            url:        '/admin/components/save_components_positions/'+arr,
            success: function(obj){
                if(obj.result)
                {
                }
            }
        });
    });
    
    $('span.selwid').bind('click', function(){
        var title = $(this).attr('data-title');
        var mname = $(this).attr('data-mname');
        var mmethod = $(this).attr('data-method');
        $('.selmod').html('<b>'+title+'</b>');
        $('#sw').attr('value', mname);
        $('#swm').attr('value', mmethod);
    });
    
    $('#inputType').on('change', function(){
        if($(this).attr('value') === 'html')
        {
            $('#moduleholder').hide('slow', function(){
                $('#textareaholder').css('display', '')
            });
            $('#mod_name').hide('slow');
            
        }else{
            $('#textareaholder').hide('slow', function(){
                $('#moduleholder').css('display', 'inline-table');
            });
        }
    });
    
    $('.submit_form').live('click', function(){
        var options = {
            dataType: "json",
            success: function(obj) {
                if(obj.result === false)
                {
                    showMessage('Создание виджета', 'Ошибка'+obj.message);
                }else{
                    var url = '/admin/widgets_manager';
                    showMessage('Создание виджета', 'Виджет успешно создан');
                    redirect_url(url);
                }
            }
        };
        $('#wid_cr_form').ajaxSubmit(options);
    });
    
    $('.submit_an_create').live('click', function(){
        var options = {
            dataType: "json",
            success: function(obj) {
                if(obj.result === false)
                {
                    showMessage('Создание виджета', 'Ошибка'+obj.message);
                }else{
                    var url = '/admin/widgets_manager/create_tpl';
                    showMessage('Создание виджета', 'Виджет успешно создан');
                    redirect_url(url);
                }
            }
        };
        $('#wid_cr_form').ajaxSubmit(options);
    });
    
    function redirect_url(url)
    {
        $(location).attr('href',url);
    }
    
    $('#cr_wid_page').live('click', function(){
        var url = '/admin/widgets_manager/create_tpl';
        redirect_url(url);
    });
    
    $('#del_sel_wid').live('click', function(){
        var $this = $(this);
        if($this.hasClass('disabled'))
        {
            alert('Сначала выберите виджет для удаления');
        }else
        {
            if(confirm('Удалить виджет?'))
            {
                if($('.niceCheck:first-child').children('input').attr('checked') === 'checked')
                {
                    if($('.niceCheck:first-child').children('input').attr('value') === 'On')
                    {
                        var inputs = $('.niceCheck').children('input');
                        inputs.each(function(){
                            var inp = $(this);
                            $.ajax({
                                type:       'post',
                                dataType:   "json",
                                url:        '/admin/widgets_manager/delete/'+inp.attr('value'),
                                success: function(obj){
                                    if(obj.result)
                                    {
                                    }else
                                    {
                                    }
                                }
                            });
                        });
                        location.reload();
                    }
                }else{
                    var inputs = $('.niceCheck').children('input');
                    var count = 0;
                    inputs.each(function(){
                        var inp = $(this);
                        if(inp.attr('checked') === 'checked')
                        {
                            $.ajax({
                                type:       'post',
                                dataType:   "json",
                                url:        '/admin/widgets_manager/delete/'+inp.attr('value'),
                                success: function(obj){
                                    if(obj.result)
                                    {
                                        count++;
                                    }else
                                    {
                                    }
                                }
                            });
                        }
                    });
                    showMessage('Удаление виджетов', 'Удалено'+count+'виджетов');
                    location.reload();
                }
            }
        }
    });
    
    $('#watermark_type').on('change', function(){
        if($(this).attr('value') === 'overlay'){
            $('.fortextblock').hide('slow', function(){
                $('.forimageblock').css('display', '');
            });
        }
        if($(this).attr('value') === 'text'){
            $('.forimageblock').hide('slow', function(){
                $('.fortextblock').css('display', '');
            });
        }
    });
    
    $('.select_tpl').live('click', function(){
        var path = $(this).attr('data-path');
        $('img.tpl_image').removeClass('sel_template');
        $(this).children('img').addClass('sel_template');
        $('#systemTemplatePath').attr('value', path);
    });
    
    $('.select_mobile_tpl').live('click', function(){
        var path = $(this).attr('data-path');
        $('img.mobile_tpl_image').removeClass('sel_template');
        $(this).children('img').addClass('sel_template');
        $('#mobileTemplatePath').attr('value', path);
    });

});


