<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><b>Создать альбом</b></p> 
        </li>
        </ul>
    </div>
</div>

<form method="post" action="{site_url('admin/components/cp/gallery/create_album')}" id="create_album_form" style="width:100%;">

   		<div class="form_text">Категория:</div>
		<div class="form_input">
            <select name="category_id">
                <!-- <option value="0">Нет</option> -->
            {foreach $categories as $item}
                <option value="{$item.id}">{$item.name}</option>
            {/foreach}
            </select>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Имя:</div>
		<div class="form_input"><input type="text" name="name" value="" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">Описание:</div>
		<div class="form_input"><textarea name="description" class="mceEditor"></textarea></div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Создать Альбом" onclick="ajax_me('create_album_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery'); return false;" style="padding:5px;">Отмена</a> 
        </div>
		<div class="form_overflow"></div> 

{form_csrf()}</form>

{literal}
<script type="text/javascript">
    load_editor();
</script>
{/literal}
