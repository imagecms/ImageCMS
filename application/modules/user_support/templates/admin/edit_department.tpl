<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><input type="button" class="button_silver_130" value="Все билеты" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support'); return false;" /></p>
        </li>
    
        <li>
            <input type="button" class="button_silver_130" value="Департаменты" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support/departments'); return false;" />
        </li>

        </ul>
    </div>

</div>
<div style="clear:both"></div>

<form action="{$BASE_URL}admin/components/cp/user_support/edit_department/{$model.id}" method="post" id="save_form" style="width:100%;">
{form_csrf()}
	<div class="form_text">Название:</div>
	<div class="form_input"><input type="text" name="name" value="{$model.name}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
	<input type="submit" name="button" class="button" value="Сохранить" onclick="ajax_me('save_form');" />
	</div>

</form>
