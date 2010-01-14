<table  width="100%">
		  	<tr style="background-color:#EDEDED">
				<td><b>Название</b></td>
				<td><b>Папка</b></td>
				<td><b>URL Идентификатор</b></td>
				<td><b>Шаблон</b></td>
				<td><b>Изображение</b></td>
				<td></td>
			</tr>
			<tbody>

		{foreach $langs as $lang}
		<tr>
			<td><a onclick="edit_lang('{$lang.id}');">{$lang.lang_name}</a></td>
			<td>{$lang.folder}</td>
			<td>{$lang.identif}</td>
			<td>{$lang.template}</td>
			<td><img src="{$lang.image}" width="16" height="16" /></td>
			<td><img src="{$THEME}/images/delete.png" width="16" height="16" style="cursor:pointer;" alt="Удалить {$lang.lang_name}" title="Удалить {$lang.lang_name}" onclick="delete_lang('{$lang.id}');" /></td>
		</tr>
		{/foreach}

		</tbody>
 </table>

<hr/>
По умолчанию: <select name="folder" id="def_lang_folder" onchange="set_def_lang($('def_lang_folder').value);">
		{foreach $langs as $lang}
			<option value="{$lang.id}" {if $lang['default'] == "1"} selected="selected" {/if}>{$lang.lang_name}</option>
		{/foreach}
		</select>
<hr/>
<div style="clear:left;" align="center">
<input type="submit" name="button"  class="button" value="Создать" onclick="MochaUI.languages_create_lang_w();" />
</div>
