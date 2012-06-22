<div id="menus_table">
<div class="top-navigation">
    <ul>
        <li style="padding:5px;"><input type="button" class="button_silver_130" onclick="create_link_window({$insert_id}); return false;" value="Создать ссылку" /></li>
        <li><input type="button" class="button_silver" onclick="ajax_div('menus_table', '{$SELF_URL}/'); return false;" value="Отмена" /></li>
    </ul>
</div>

{if $menu_result}
<div id="sortable">
	<table width="100%" border="0" align="left" class="items_table" style="text-align:left;">
	  <thead>
		<th width="15px">ID</th>
		<th align="left">Название</th>
		<th>Ссылка</th>
		<th align="left">
        Тип
        </th>
		<th>
        <div align="center">
        Позиция  <img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" onclick="save_position(); return false;" />
        </div>
        </th>
		<th>Скрытая</th>
		<th></th>
	  </thead>
	  <tbody>
	  {foreach $menu_result as $item}
			<tr class="{ counter("row_even","row_odd") }">
			<td>{$item.id}</td>
			<td>
				{if $item.padding == "0"}
					<strong><a href="{$item.link}"  onclick="edit_item({$item.id},{$insert_id}); return false;"   style="padding-left:{$item.padding}px;">{$item.title}</a></strong>
				{else:}
					<a href="{$item.link}" onclick="edit_item({$item.id},{$insert_id}); return false;"  style="padding-left:{$item.padding}px;">{for $i=0; $i < $item['padding'];$i++}-{/for} {$item.title}</a>
				{/if}
			</td>
			<td>{$item.url}</td>
			<td>
           	{ switch $item['item_type'] }
		    { case "page": }
			    Страница
                {break;}
		    { case "category": }
			    Категория
                {break;}
		    { case "module" }
			    Модуль
                {break;}
            { case "url": }
                URL
                {break;}
        	{ /switch } 
            </td>
			<td><div align="center"> <input type="text" value="{$item.position}" style="width:23px;" class="item_pos" id="item{$item.id}" /> </div></td>
			<td>
               {if $item['hidden'] == "0"}
                 <div id="item_visible"></div>
               {else:}
                <div id="item_nonvisible"></div> 
               {/if}
            </td>
			<td>
            {if count($langs) > 1}
    	        <img onclick="translate_m_item({$item.id}); return false;" src="{$THEME}/images/translit.png" width="16" height="16" /> 	
            {/if}
				<img onclick="edit_item({$item.id},{$insert_id}); return false;" src="{$THEME}/images/edit.png" width="16" height="16" />
				<img onclick="delete_item({$item.id},'{$item.name}'); return false;" src="{$THEME}/images/delete.png" width="16" height="16" />
			</td>
		  </tr>
	  {/foreach}
	  </tbody>
	</table>
	</div>
 {/if}

<div class="form_overflow"></div>

</div>

<script type="text/javascript">
var insert_id = {$insert_id};
</script>

{literal}
        <style type="text/css">
            #item_visible{
            background-color:#8EAF3B;width:10px;height:10px;
            }
            #item_nonvisible{
            background-color:silver;width:10px;height:10px;     
            }
        </style>

		<script type="text/javascript">

        var menu_action = 'insert';
        var menu_update_id = 0;

        function translate_m_item(iid)
        {
            MochaUI.translate_m_Window = function() {
                new MochaUI.Window({
                    id: 'translate_m_Window',
                    title: 'Перевод меню',
                    loadMethod: 'xhr',
                    contentURL: base_url + 'admin/components/cp/menu/translate_window/' + iid,
                    width: 490,
                    height: 300
                });
            }
            
            MochaUI.translate_m_Window();
        }

        function save_position()
        {
            var pos = new Array();     

            var items = $('menus_table').getElements('input');
            items.each(function(el,i){
                    if(el.hasClass('item_pos')) 
                    {
                        id = el.id;
                        val = el.value;
                        new_pos = id + '_' + val;
                        pos.include( new_pos );
                    }  
                    });
        
            var req = new Request.HTML({
               method: 'post',
               url: base_url + 'admin/components/cp/menu/save_positions/',
               onRequest: function() { },
               onComplete: function(response) {  
                    ajax_div('menus_table', base_url + 'admin/components/cp/menu/list_menu_items/' + insert_id);   
                }
            }).post({'items_pos': pos });
        }

		function edit_item(item_id,menu_id)
		{
            menu_action = 'update';
            menu_update_id = item_id;

    			new MochaUI.Window({
					id: 'createnewlink',
					title: 'Редактировать Сcылку',
					type: 'window',
					loadMethod: 'xhr',
					contentURL: base_url + 'admin/components/cp/menu/create_item/' + menu_id,
					width: 750,
					height: 550
				});
		}

        function create_link_window(menu_id)
        {
            menu_action = 'insert';
            menu_update_id = 0;

				new MochaUI.Window({
					id: 'createnewlink',
					title: 'Создать Сcылку',
					type: 'window',
					loadMethod: 'xhr',
					contentURL: base_url + 'admin/components/cp/menu/create_item/' + menu_id,
					width: 750,
					height: 550
				});
        }

        function delete_item(id,name)
        {
        	var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/components/cp/menu/delete_item/' + id,
			evalResponse: true,
			onComplete: function(response) {
                ajax_div('menus_table',base_url + 'admin/components/cp/menu/menu_item/' + name );                    
            }
	    	}).send(); 
        }
		</script>
{/literal}
