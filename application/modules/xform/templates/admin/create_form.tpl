<div class="top-navigation">
    <ul style="float:left;">
        <li><p>Создать форму</p></li>
    </ul>
    <div align="right" style="float:right;padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Отмена" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/'); return false;" />
    </div>
</div>

<div style="clear:both"></div> 

<form method="post" action="{site_url('admin/components/cp/xform/create_form')}" id="create_form" style="width:100%;">        
      	<div class="form_text">Название</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="page_title" id="page_title_u" value="" />
            <br />
            <span class="lite">Выводится в заголовке и title</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">URL</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="page_url" value="" id="page_url" />
            <img onclick="translite_title($('page_title_u').value);" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" title="Транслитерация заголовка." /> 
            <br />
            <span class="lite">URL формы</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">E-mail</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="email" id="email" value="" />
            <br />
            <span class="lite">E-mail куда приходят сообщения с формы</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">Тема</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="subject" id="subject" value="" />
            <br />
            <span class="lite">Тема письма (Subject)</span>
        </div>
        <div class="form_overflow"></div>
        
        <div class="form_text">Описание формы</div>
		<div class="form_input">
        <textarea name="desc" id="desc" class="mceEditor"></textarea>
        </div>
        <div class="form_overflow"></div> 
        
        <div class="form_text">Сообщение об успешном отправлении</div>
		<div class="form_input">
        <textarea name="good" id="good"></textarea><br />
         <span class="lite">Сообщение которое получит пользователь отправив сообщение через данную форму</span>
        </div>
        <div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Сохранить" onclick="ajax_me('create_form');" />
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/xform'); return false;" style="padding:5px;">Отмена</a> 
        </div>
		<div class="form_overflow"></div> 
        {form_csrf()}
</form>
{literal}
<script type="text/javascript">
        load_editor();
</script>
{/literal}