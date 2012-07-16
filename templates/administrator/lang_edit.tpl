<form action="{$BASE_URL}admin/languages/update/{$id}" method="post" id="lang_edit_form" style="width:100%;">
	<div class="form_text">{lang('a_name')}:</div>
	<div class="form_input"><input type="text" name="name" id="" value="{$lang_name}" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_identif')}:</div>
	<div class="form_input"><input type="text" name="identif" id="" value="{$identif}" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_image_url')}:</div>
	<div class="form_input"><input type="text" name="image" id="" value="{$image}" class="textbox_short" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_folder')}:</div>
	<div class="form_input">
		<select name="folder">
         {foreach $lang_folders as $folder}
            <option {if $folder == $folder_selected} selected="selected" {/if} >{$folder}</option>
         {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>


	<div class="form_text">{lang('a_tpl')}:</div>
	<div class="form_input">
		<select name="template">
        {foreach $templates as $template}
            <option {if $template == $template_selected} selected="selected" {/if} >{$template}</option>
        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
	<input type="submit" name="button" class="button"  value="{lang('a_save')}" onclick="ajax_me('lang_edit_form');" />
	</div>
	<div class="form_overflow"></div>
{form_csrf()}</form>
