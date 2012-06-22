<form action="{$BASE_URL}admin/components/cp/menu/translate_item/{$id}" method="post" id="item_t_save_form" style="width:100%;">

{foreach $langs as $l}
	<div class="form_text">{$l.lang_name}:</div>
	<div class="form_input"><input type="text" name="lang_{$l.id}" value="{$l.curt}" class="textbox_long" /></div>
	<div class="form_overflow"></div>
{/foreach}

{form_csrf()}

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="Сохранить" onclick="ajax_me('item_t_save_form');" />
    <input type="button" name="button" class="button" value="Отмена" onclick="MochaUI.closeWindow($('translate_m_Window'));" />
<div class="form_overflow"></div>
</div>

</form>
