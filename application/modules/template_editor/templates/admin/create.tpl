<form method="post" action="{$BASE_URL}admin/components/cp/template_editor/create_file/{$path}" id="update_file_form" style="width:100%">
{form_csrf()}

<input type="hidden" name="path" value="{$path}" />
    <input type="text" name="file_name" class="textbox"/> .tpl
        
    <input type="submit" class="button_silver" value="{lang('amt_to_create')}" onclick="ajax_me('update_file_form');" />
</form>
