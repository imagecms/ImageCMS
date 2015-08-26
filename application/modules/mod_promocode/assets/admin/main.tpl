<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Скидки','mod_promocode')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>    
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#upload_form" data-submit><i class="icon-ok icon-white"></i>{lang('Save', 'admin')}</button>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane active">
                <table class="table table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="1">{lang('Настройки','mod_promocode')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <form action='/admin/components/init_window/mod_promocode/save' method='POST' id='upload_form'>
                                    <div class="control-group">
                                        <label class="control-label">{lang("ID доп.поля, в которое вводится промокод", 'mod_promocode')}:</label>
                                        <div class="controls ">                       
                                            <input type="text" name="id_custom_field" value='{echo $data['id_custom_field']}' required="required">                        
                                        </div>
                                    </div>
                                    {form_csrf()}
                                </form>
                                <div class="control-group">
                                    <label class="control-label">{lang("Промокод / Скидка %", 'mod_promocode')}:</label>
                                    <div class="controls ">                       
                                        <input id="fAddInput" type="text"  value='' required="required">    
                                        <input id="fAddDisc" type="text" value='' required="required">    
                                        <button onclick='fAdd();' type="button" class="btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Добавить', 'mod_promocode')}</button>
                                    </div>
                                </div>
                                <div style="border:2px solid grey; width: 215px; height: 400px; overflow:auto">
                                    <ul id='fAddUl'>
                                        {foreach $codes as $code}      
                                            <li id="hidden_{echo $code["id"]}"><a onclick="fDel('{echo $code["id"]}');" title="Удалить"> X </a><span>{echo $code['value']} - {echo $code['disc']}%</span></li>
                                        {/foreach}      
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> 
        </div>
    </div>
<div id='pustMessage'>
</div>
                                    
</section>
{literal}
<script type="text/javascript">
    function fDel(el){
        $.post('/admin/components/init_window/mod_promocode/fDel',{
            'id':el
        }, function(data){
            $('#pustMessage').html(data);
            $('#hidden_'+el).fadeOut(100);
        });
    }
    
    function fAdd(){
        $.post('/admin/components/init_window/mod_promocode/fAdd',{
            'code':$('#fAddInput').val(),
            'disc':$('#fAddDisc').val()
        }, function(data){
            $('#pustMessage').html(data);
            
            if (data.length < 100){
                var tag = "<li id='hidden_"+data+"'><a onclick='fDel("+data+");' title='Удалить'> X </a>";
                $('#fAddUl').append(tag + $('#fAddInput').val() + ' - '+$('#fAddDisc').val()+'%</li>');
            }
        });
    }
</script>
{/literal}
