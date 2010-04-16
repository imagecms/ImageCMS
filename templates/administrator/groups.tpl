<div id="groups-tabs-block"  style="float:left;width:100%">
	<h4 title="Предварительное содержание">Список Групп</h4>
		<div>
			<table cellpadding="2" cellpadding="2" width="100%">
						<tr style="background-color:#EDEDED">
							<td><b>ID</b></td>
							<td><b>Название</b></td>
							<td><b>Идентификатор</b></td>
							<td><b>Описание</b></td>
							<td></td>
						</tr>
						<tbody>

					{foreach $roles as $group}
					<tr>
						<td>{$group.id}</td>
						<td>{$group.alt_name}</td>
						<td>{$group.name}</td>
						<td>{$group.desc}</td>
						<td>
						<img src="{$THEME}/images/edit_page.png" width="16" height="16" style="cursor:pointer;" onclick="edit_group('{$group.id}');">
						<img src="{$THEME}/images/delete.png" width="16" height="16" style="cursor:pointer;" onclick="delete_group('{$group.id}');">
						</td>
					</tr>
					{/foreach}

					</tbody>
			</table>
		</div>

	<h4 title="Параметры">Создать</h4>
		<div>
		<form action="{$BASE_URL}admin/groups/create" method="post" id="groups_create_form" style="width:100%;">
			<div class="form_text">Название:</div>
			<div class="form_input"><input type="text" name="alt_name" id="alt_name" class="textbox_short"></div>
			<div class="form_overflow"></div>

			<div class="form_text">Идентификатор:</div>
			<div class="form_input"><input type="text" name="name" id="name" class="textbox_short"> (только латинские символы)</div>
			<div class="form_overflow"></div>

			<div class="form_text">Описание:</div>
			<div class="form_input">
			<textarea id="desc" name="desc" ></textarea>
			</div>
			<div class="form_overflow"></div>

			<div class="form_text"></div>
			<div class="form_input"><input type="submit" name="button" class="button"  value="Создать" onclick="ajax_me('groups_create_form');" ></div>
			<div class="form_overflow"></div>
		{form_csrf()}
        </form>
		</div>
</div>

{literal}
		<script type="text/javascript">
		var groups_tabs = new SimpleTabs('groups-tabs-block', {
		selector: 'h4'
		});
		</script>
{/literal}
