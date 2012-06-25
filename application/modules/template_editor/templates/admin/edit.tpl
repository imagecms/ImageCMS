<form method="post" action="{$BASE_URL}admin/components/cp/template_editor/update_file" id="update_file_form" style="width:100%">
{form_csrf()}

<input type="hidden" name="path" value="{$path}" />
    <textarea name="data" style="width:100%;height:540px;">{htmlspecialchars($file_data)}</textarea>

    <p align="right">
        <input type="submit" class="button_silver_130" value="Сохранить" onclick="ajax_me('update_file_form');" style="margin-right:5px;"/>  
        <input type="button" class="button_red_130" value="Удалить" onclick="confirm_delete_file('{$path}');" />
    </p>
</form>

{literal}
<script type="text/javascript">
function confirm_delete_file(path)
{
alertBox.confirm('<h1>Удалить файл ' + path + '? </h1>', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
		var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/components/cp/template_editor/delete_file',
			evalResponse: true,
		}).post({'path': path});

	}
	else
	{

	}
	}
});
}
</script>
{/literal}
