<div id="menus_table">
    <div id="sortable">
	<table width="100%" border="0" align="left" class="items_table" id="mt1">
	  <thead>
		<th width="15px">ID</th>
		<th>Название</th>
		<th>Имя</th>
		<th>Описание</th>
		<th>Создано</th>
		<th></th>
	  </thead>
	  <tbody>
      {if count($menus) > 0}
	  {foreach $menus as $item}
	  	<tr>
			<td>{$item.id}</td>
			<td><a href="#" onclick="ajax_div('menus_table','{$SELF_URL}/menu_item/{$item.name}'); return false;">{$item.main_title}</a></td>
			<td>{$item.name}</td>
			<td>{$item.description}</td>
			<td>{$item.created}</td>
			<td>
				<img style="cursor:pointer;" onclick="edit_menu({$item.id}); return false;" src="{$THEME}/images/edit.png" width="16" height="16" />
				<img style="cursor:pointer;" onclick="delete_menu('{$item.name}','{$item.name}'); return false;" src="{$THEME}/images/delete.png" width="16" height="16" />
			</td>
		</tr>
	  {/foreach}
      {/if}
	  </tbody>
	</table>
    </div>

<div class="form_overflow"></div>

    <div align="right" style="padding:5px;">
            <input type="button" class="button" value="Создать Меню" onclick="open_create_winow(); return false;" />
    </div>

    {literal}
        <script language="text/javascript">
 			window.addEvent('domready', function(){
				menus_table = new sortableTable('mt1', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                menus_table.altRow();
			}); 
  
            function open_create_winow()
            {
                new MochaUI.Window({
                    id: 'create_menu_w',
                    title: '',
                    type: 'modal',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/components/cp/menu/create_tpl/',
                    width: 490,
                    height: 350
                });            
            }

            function edit_menu(id)
            {
                new MochaUI.Window({
                    id: 'edit_menu_w',
                    title: '',
                    type: 'modal',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/components/cp/menu/edit_menu/' + id,
                    width: 490,
                    height: 350
                });       
            }

            function delete_menu(name,title)
            {
                alertBox.confirm('<h1> </h1><p>Удалить меню <b>'+ title + '</b> ? </p>', {onComplete:
                    function(returnvalue) {
                    if(returnvalue)
                    {
                        var req = new Request.HTML({
                        method: 'post',
                        url: base_url + 'admin/components/cp/menu/delete_menu/' + name,
                        onComplete: function(response) { 
                            ajax_div('menu_module_block',base_url + 'admin/components/cp/menu/index');
                            }
                        }).post();
                    }
                    }
                });
            }
        </script>
    {/literal}
</div>
