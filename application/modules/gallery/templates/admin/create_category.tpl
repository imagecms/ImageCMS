<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><b>Создать категорию</b></p> 
        </li>
        </ul>
    </div>
</div>

<form method="post" action="{site_url('admin/components/cp/gallery/create_category')}" id="create_category_form" style="width:100%;">
   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Имя:</div>
		<div class="form_input"><input type="text" name="name" value="" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Описание:</div>
		<div class="form_input"><textarea name="description" id="g_c_desc" class="mceEditor">{htmlspecialchars($category.description)}</textarea></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Позиция:</div>
		<div class="form_input"><input type="text" name="position" value="" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Создать" onclick="ajax_me('create_category_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery'); return false;" style="padding:5px;">Отмена</a> 
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>

{literal}
<script type="text/javascript">
    load_editor();
</script>
{/literal}
