<div id="module_manager_tabs">
<h4 title="Настройки">Модули</h4>
    <div id="modules_table">
        {if count($installed) != 0 }
        <div id="sortable">
              <table id="modules_table">
              <thead>
                    <th axis="string">Модуль</th>
                    <th axis="string">Описание</th>
                    <th axis="string">URL</th>
                    <th axis="string">Версия</th>
                    <th>Автозагрузка</th>
                    <th>URL доступ</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
            {foreach $installed as $item}
            <tr id="{$page.number}">
                <td>
                {if $item['admin_file'] == 1}
					{if $item.name == 'shop'}
						<a href="#" onclick="javascript:loadShopInterface(); return false;">{$item.menu_name}</a>
					{else:}
						<a href="#" onclick="com_admin('{$item.name}'); return false;">{$item.menu_name}</a>
					{/if}
                {else:}
                    {$item.menu_name}
                {/if}
                </td>
                <td>{$item.description}</td>
                <td>{$item.identif}</td>
                <td>{$item.version}</td>
                <td>
                {if $item['autoload'] == "0"}
                <img src="{$THEME}/images/minus.png" width="16" height="16" />
                {else:}
                <img src="{$THEME}/images/plus.png" width="16" height="16" />
                {/if}
                </td>
                <td>
                {if $item['enabled'] == "0"}
                <img src="{$THEME}/images/minus.png" width="16" height="16" />
                {else:}
                <img src="{$THEME}/images/plus.png" width="16" height="16" />
                {/if}
                </td>
                <td>
                    <img src="{$THEME}/images/preferences.png" onclick="com_settings('{$item.name}');" title="Настройки" width="16" height="16" />
                {if $item['admin_file'] == "1"}
                    <img src="{$THEME}/images/module_admin.png" onclick="com_admin('{$item.name}');" title="Администрирование" width="16" height="16" />
                {/if}
                </td>
                <td>
                <img src="{$THEME}/images/delete.png" onclick="confirm_delete_module('{$item.menu_name}','{$item.name}');" title="Удалить" width="16" height="16" />
                </td>
            </tr>
            {/foreach}
                </tbody>
              </table>
        </div>
        </div>

        {if count($not_installed) > 0 }
        <h4 title="Настройки">Установить модули</h4>
        <div id="not_installed_tabs"> 
            <div style="font-size:12px;">
            <div class="form_input"></div>
            <div class="form_overflow"></div>
            {foreach $not_installed as $item}
                <div class="form_text">{$item.name}</div>
                <div class="form_input">
                {$item.description} <br/>
                Версия: {$item.version} <br/>
                <a href="#" onclick="install_module('{$item.com_name}'); return false;">Установить</a>
                </div>
            <div class="form_overflow"></div>
            {/foreach}
            </div>
        </div>
        {/if}

</div>

	{else:}
    	<div align="center"><p><h3>Модули не установлены!</h3></p></div>
	{/if}


{literal}
<script type="text/javascript">

function install_module(name)
{

    var req = new Request.HTML({
        method: 'post',
        url: base_url + 'admin/components/install/' + name,
        onComplete: function(response) { 
               ajax_div('modules_table', base_url + 'admin/components/modules_table/'); 
            }
    }).post();

}

function confirm_delete_module(menu_name,com_name)
{
	alertBox.confirm('<h1> </h1><p>Удалить модуль '+ menu_name +' ? </p>', {onComplete:
	function(returnvalue) {
		if(returnvalue)
		{
					var req = new Request.HTML({
					method: 'post',
					update: 'modules_table',
					url: base_url + 'admin/components/deinstall/' + com_name,
					onComplete: function(response) { }
				}).post();
		}
	}
});
}
</script>

<script type="text/javascript">
window.addEvent('domready', function(){
    pages_table = new sortableTable('modules_table', {overCls: 'over', onClick: function(){}});

		var modules_tabs = new SimpleTabs('module_manager_tabs', {
		selector: 'h4'
		});


});
</script>
{/literal}


