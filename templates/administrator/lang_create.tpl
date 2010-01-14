<form action="{$BASE_URL}admin/languages/insert" method="post" id="lang_create_form" style="width:100%;">
	<div class="form_text">Название:</div>
	<div class="form_input"><input type="text" name="name" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Идентификатор:</div>
	<div class="form_input"><input type="text" name="identif" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">URL Изображения:</div>
	<div class="form_input"><input type="text" name="image" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Папка:</div>
	<div class="form_input">
		<select name="folder">
        {foreach $lang_folders as $folder}
        <option value="{$folder}">{$folder}</option>
        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>


	<div class="form_text">Шаблон:</div>
	<div class="form_input">
		<select name="template">
        {foreach $templates as $tpl_folder}
        <option value="{$tpl_folder}">{$tpl_folder}</option>
        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><input type="submit" name="button" class="button"  value="Создать" onclick="ajax_me('lang_create_form');" /></div>
	<div class="form_overflow"></div>
{form_csrf()}</form>
