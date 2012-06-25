<form action="{$BASE_URL}admin/components/save_settings/{$name}" method="post" id="component_save_form" style="width:100%;">
&nbsp;
	<div class="form_text"></div>
	<div class="form_input"><label><input name="status" value="1" {if $enabled == 1} checked="checked" {/if}  type="checkbox" /> Включить доступ по URL</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="autoload" value="1" {if $autoload == 1} checked="checked" {/if}  type="checkbox" /> Автозагрузка</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input"><label><input name="in_menu" value="1" {if $in_menu == 1} checked="checked" {/if}  type="checkbox" /> Добавить в меню</label></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
	    <input type="submit" name="button" class="button" value="Сохранить"
	    onclick="ajax_me('component_save_form'); MochaUI.closeWindow($('edit_component_window'));"/>
	</div>
{form_csrf()}</form>
