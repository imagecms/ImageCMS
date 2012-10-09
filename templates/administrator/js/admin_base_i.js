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
    
    $('.currency_def').live('click', function(){
        var currency_id = $(this).data('currid');
        $.ajax({
            type:   'post',
            data:   'id='+currency_id,
            url:    '/admin/components/run/shop/currencies/makeCurrencyDefault',
            success: function(data){
                if(data){
                    $('.currency_def').removeClass('active');
                    $('#currdef'+currency_id).addClass('active');
                }
            }
        });
    });
    
    $('.currency_main').live('click', function(){
        var currency_id = $(this).data('currid');
        $.ajax({
            type: 'post',
            data:   'id='+currency_id,
            url:    '/admin/components/run/shop/currencies/makeCurrencyMain',
            success: function(data){
                if(data){
                    $('.currency_main').removeClass('active');
                    $('#currmain'+currency_id).addClass('active');
                }
            }
        });
    });
    
    //get values from niceCheck checkboxes
    function getcheckedvalues()
    {
        var arr = new Array();
        var inputs = $('.niceCheck').children('input');
        inputs.each(function(){
            var inp = $(this);
            if(inp.attr('checked') === 'checked')
            {
                if(inp.attr('value') != 'On'){
                    arr.push(inp.attr('value'));
                }
            }
        });
        return arr;
    }


    
    $('.maincheck').bind('change', function(){
        var ch = '';
        if($(this).attr('checked')==='checked'){
            ch = $(this).attr('checked');
        }
        var tbl = $(this).parents('table').children('tbody').children('tr').children('td:first-child');
        tbl.each(function(){
            if(ch){
                $(this).children('input').attr('checked', ch);
            }else{
                $(this).children('input').removeAttr('checked');
            }
        })
    });
    
    $('.chldcheck').bind('change', function(){
        var tbl = $(this).parents('table').children('thead').children('tr').children('th:first-child');
        if($(this).attr('checked')!='checked')
        {
            tbl.children('input').removeAttr('checked');
        }
        var c = 0;
        $(this).parents('tbody').children('tr').each(function(){
            c++; 
        });
        var par = $(this).parents('tbody').children('tr').children('td:first-child').children('input');
        var i = 0;
        par.each(function(){
            if($(this).attr('checked')==='checked'){
                i++;
            }
        });
        if(c===i){
            tbl.children('input').attr('checked', 'checked');
        }
    });
    
    $('#del_sel_group').live('click', function(){
        if($(this).hasClass('disabled')){
            return false;
        }else{
            if(confirm('Удалить группу?'))
            {
                var arr = getcheckedvalues();
                $.post('/admin/components/run/shop/rbac/group_delete',{
                    id: arr
                },
                function(data){
                    $('.notifications').append(data);
                }
                );
            }
        }
    });
    
    $('#del_sel_priv').live('click', function(){
        if($(this).hasClass('disabled')){
            return false;
        }else{
            if(confirm('Удалить группу?'))
            {
                var arr = getcheckedvalues();
                $.post('/admin/components/run/shop/rbac/privilege_delete',{
                    id: arr
                },
                function(data){
                    $('.notifications').append(data);
                }
                );
            }
        }
    });
    
    $('.catfilter').on('change', function(){
        $.pjax({
            url:'/admin/components/run/shop/properties/index/'+$(this).attr('value'), 
            container: '#mainContent'
        });
    });
    
    $('#generateButton').live('click', function(){
        $.ajax({
            type: "post",
            dataType: "json",
            url: '/admin/components/run/shop/gifts/generateKey',
            success: function(obj){
                $('#keyholder').attr('value', obj.key);    
            }
        })
    });
    
    $('.ch_active').live('click', function(){
        var cid = $(this).attr('data-cid');
        var $this = $(this);
        $.ajax({
            type:       'post',
            url:        '/admin/components/run/shop/gifts/ChangeActive/'+cid,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('.comment_update').live('click', function(){
        var id = $(this).attr('data-cid');
        var user_name = $('#u_ed'+id).attr('value');
        var user_mail = $('#m_ed'+id).attr('value');
        var status = $(this).attr('data-cstatus');
        var text = $('#edited_com_text'+id).attr('value');
        var text_plus = $('#edited_com_text_plus'+id).attr('value');
        var text_minus = $('#edited_com_text_minus'+id).attr('value');
        $.ajax({
            type: 'post',
            url: '/admin/components/cp/comments/update',
            data: 'id='+id+'&user_name='+user_name+'&user_mail='+user_mail+'&text='+text+'&status='+status+'&text_plus='+text_plus+'&text_minus='+text_minus,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('.to_spam').live('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type:   'post',
            url:    '/admin/components/cp/comments/update_status',
            data:   'id='+id+'&status='+2,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('#comment_delete').live('click', function(){
        if($(this).hasClass('disabled')){}else{
            var arr = getcheckedvalues();
            $.post('/admin/components/cp/comments/delete',{
                id: arr
            },
            function(data){
                $('.notifications').append(data);
            }
            );

        }
    });
    
    $('.com_del').live('click', function(){
        var id = $(this).attr('data-id');
        $.post('/admin/components/cp/comments/delete',{
            id: id
        },
        function(data){
            $('.notifications').append(data);
        }
        );
    });
    
    $('.to_approved').live('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type:   'post',
            url:    '/admin/components/cp/comments/update_status',
            data:   'id='+id+'&status='+0,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('.to_waiting').live('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type:   'post',
            url:    '/admin/components/cp/comments/update_status',
            data:   'id='+id+'&status='+1,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('.comment_update_cancel').live('click', function(){
        var id = $(this).attr('data-cid');
        $('#nc'+id).trigger('click');
    });
    
    $('.text_comment, a.u_ed, a.m_ed').live('click', function(){
        var id = $(this).parents('tr').attr('data-id');
        display_edit_fields(id);
    });
    
    function display_edit_fields(id)
    {
        $('#nc'+id).trigger('click');
    }
    
    $('#translateCategoryTitle').live('click', function(){
        var str = $('#inputName').attr('value');
        $.ajax({
            type:   'post',
            url:    '/admin/components/run/shop/categories/ajax_translit',
            data:   'str='+str,
            success: function(data){
                $('#inputUrl').attr('value', data);
            }
        });
    });
    
    $('.cat_change_active').live('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type:   "post",
            url:    '/admin/components/run/shop/categories/changeActive',
            data:   'id='+id,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
    $('#create_tpl').live('click', function(){
        var name = prompt('Введите название шаблона', '');
        if (name!=null && name!=""){
            $.ajax({
                type:   "post",
                dataType: "json",
                url:    "/admin/components/run/shop/categories/create_tpl",
                data:   "filename="+name,
                success: function(obj){
                    $('.notifications').append(obj.responce);
                    if(obj.result){
                        $('#inputTemplateCategory').attr('value', name);
                    }
                }
            });
        }
    });

    if (window.hasOwnProperty('tpls'))
        $('#inputTemplateCategory').autocomplete({
            source:tpls
        });
    
    $('.prop_active').live('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "/admin/components/run/shop/properties/changeActive",
            data: "id="+id,
            success: function(data){
                $('.notifications').append(data);
            }
        });
    });
    
//  sortstop blocks start   
    
    $( "#positions_for_save" ).bind( "sortstop", function(event, ui) {
        var url = $(this).attr('data-url');
        save_positions(url);
    });
    
    function save_positions(url){
        var arr = new Array();
        $('input[name=ids]').each(function(){
            arr.push($(this).val());
        });
        $.post(
                url, 
            {
                positions:arr
            },
            function(data){
                $('.notifications').append(data);
            });
    }
    
//  sortstop blocks end    
    
});


