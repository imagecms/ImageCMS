<form action="{$SELF_URL}/update_user/{$id}" id="edit_user_form">

<div id="user_edit_block">

	<div class="form_text">Логин</div>
	<div class="form_input"><input type="text" name="username" value="{$username}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Email</div>
	<div class="form_input"><input type="text" name="email" value="{$email}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Группа</div>
	<div class="form_input">
	<select name="role_id">
		{foreach $roles as $role}
		  <option value ="{$role['id']}" {if $role['id'] == $role_id} selected="selected" {/if}>{$role.alt_name}</option>
		{/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">Новый Пароль</div>
	<div class="form_input"><input type="text" name="new_pass" value="" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Бан</div>
	<div class="form_input">
	<select name="banned">
		  <option value ="1" {if $banned == "1"} selected="selected" {/if}>Да</option>
		  <option value ="0" {if $banned == "0"} selected="selected" {/if}>Нет</option>
	</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">Причина Бана</div>
	<div class="form_input"><input type="text" name="ban_reason" value="" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
		<input type="submit" name="button" class="button" value="Сохранить" onclick="ajax_me('edit_user_form');" />
		<input type="submit" name="button" class="button" value="Отмена" onclick="MochaUI.closeWindow($('user_edit_window')); return false;" />
	</div>
	<div class="form_overflow"></div>

</div>
{form_csrf()}</form>
