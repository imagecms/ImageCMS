<form action="{$BASE_URL}admin/components/save_settings/{$name}" method="post" id="component_save_form" style="width:100%;">&nbsp;
	<div class="form_text"></div>
	<div class="form_input"><label><input name="status" value="1" {if $enabled == 1} checked="checked" {/if}  type="checkbox" /> {lang('a_url_access_on')}</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="autoload" value="1" {if $autoload == 1} checked="checked" {/if}  type="checkbox" /> {lang('a_autoload')}</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="in_menu" value="1" {if $in_menu == 1} checked="checked" {/if}  type="checkbox" /> {lang('a_add_to_menu')}</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
	    <input type="submit" name="button" class="button" value="{lang('a_save')}"
	    onclick="ajax_me('component_save_form'); MochaUI.closeWindow($('edit_component_window'));"/>
	</div>
{form_csrf()}</form>