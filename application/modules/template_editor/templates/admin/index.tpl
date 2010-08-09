<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li><p>Редактор шаблонов</p></li>
            {$navigation}
        </ul>
    </div>

    <div align="right" style="padding:5px 13px;">
      <input type="button" class="button_green_130" value="Создать Файл" onclick="file_create_window('{$path}');" /> 
    </div>
</div>

<div style="clear:both"></div>

{foreach $files as $key=>$val}
    {if is_array($val)}
        <div style="float:left;padding:5px;width:100px;height:100px;" align="center">
        <a href="javascript:ajax_div('page',base_url+'admin/components/cp/template_editor/renderDir/{$path}/{$key}');" title="{$key}">
            <img src="/application/modules/template_editor/templates/admin/images/folder-blue.png" align="center"/>
            </a>
            <div align="center" style="clear:both;">
                <a href="javascript:ajax_div('page',base_url+'admin/components/cp/template_editor/renderDir/{$path}/{$key}');" title="{$key}">{truncate($key,15,'...')}</a>
            </div>
        </div>
    {else:}
        <div style="float:left;padding:5px;width:100px;height:100px;" align="center">
            <a href="#" onclick="edit_file('{$path}/{$val}'); return false" title="{$val}">
            <img src="/application/modules/template_editor/templates/admin/images/document.png" align="center"/>
            </a>
            <div align="center" style="clear:both;">
                <a href="#" onclick="edit_file('{$path}/{$val}'); return false" title="{$val}">{truncate($val,15,'...')}</a>
            </div>
        </div>
    {/if}
{/foreach}

{literal}
<script type="text/javascript">
    function edit_file(path)
    {
       	new MochaUI.Window({
			id: 'edit_template_window',
			title: 'Редактирование файла: ' + path,
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/template_editor/edit_file/'+path,
			width: 800,
			height: 600
		}); 
    }

    function file_create_window(path)
    {
       	new MochaUI.Window({
			id: 'create_filetemplate_window',
			title: 'Создание файла',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/template_editor/create_file/'+path,
			width: 300,
			height: 80
		}); 
    }
</script>
{/literal}
