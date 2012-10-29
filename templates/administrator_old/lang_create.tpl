<form action="{$BASE_URL}admin/languages/insert" method="post" id="lang_create_form" style="width:100%;">
	<div class="form_text">{lang('a_name')}:</div>
	<div class="form_input"><input type="text" name="name" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_identif')}:</div>
	<div class="form_input"><input type="text" name="identif" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_image_url')}:</div>
	<div class="form_input"><input type="text" name="image" id="" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_folder')}:</div>
	<div class="form_input">
		<select name="folder">
        {foreach $lang_folders as $folder}
        <option value="{$folder}">{$folder}</option>
        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>


	<div class="form_text">{lang('a_tpl')}:</div>
	<div class="form_input">
		<select name="template">
        {foreach $templates as $tpl_folder}
        <option value="{$tpl_folder}">{$tpl_folder}</option>
        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><input type="submit" name="button" class="button"  value="{lang('a_create')}" onclick="ajax_me('lang_create_form');" /></div>
	<div class="form_overflow"></div>
{form_csrf()}</form>
