<div class="top-navigation">
    <ul>
        <li style="padding:5px;"><input type="button" class="button_silver_130" onclick="ajax_div('page', base_url + 'admin/widgets_manager/create_tpl'); return false;" value="Создать Виджет" /></li>
    </ul>
</div>
<div class="form_overflow"></div>

{if $widgets}
<div id="sortable">
		  <table id="widgets_table" >
		  	<thead>
                <th width="5px" axis="number">ID</th>
                <th axis="string">Имя</th>
                <th axis="string">Тип</th>
                <th axis="string">Описание</th>
                <th axis="date">Создан</th>
                <th></th>
			</thead>
			<tbody>
            {foreach $widgets as $widget}
    		<tr>
                <td>{$widget.id}</td>
                <td {if $widget.config == TRUE} onclick="edit_widget({$widget.id});" {/if}  {if $widget.type == 'html'} onclick="edit_widget_html({$widget.id});" {/if} >{$widget.name}</td>
                <td>
                    {switch $widget.type}
                        {case 'module':}
                            Модуль {$widget.data}
                        {break}
                        {case 'html':}
                            html
                        {break}
                    {/switch}
                </td>
                <td>{$widget.description}</td>
                <td>{date('d-m-Y',$widget.created)}</td>
                <td align="right">
                    {if $widget.config == TRUE}
                        <img src="{$THEME}/images/edit.png" title="Изменить данные" onclick="ajax_div('page', base_url + 'admin/widgets_manager/edit_module_widget/{$widget.id}'); return false;" style="cursor:pointer;" />
                        <img src="{$THEME}/images/module_admin.png" title="Настройки Виджета" onclick="edit_widget({$widget.id}); return false;" style="cursor:pointer;" />
                    {/if}
                    {if $widget.type == 'html'}
                        <img src="{$THEME}/images/edit.png" title="Настройки" onclick="edit_widget_html({$widget.id}); return false;" style="cursor:pointer;" />
                    {/if}

                    <img src="{$THEME}/images/delete.png"  onclick="confim_delete_widget('{$widget.name}');" title="Удалить"  style="cursor:pointer;" />
                </td>
      		</tr>
            {/foreach}
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

    {literal}
            <script type="text/javascript">
                window.addEvent('domready', function(){
                    widgets_table = new sortableTable('widgets_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                    widgets_table.altRow();
                });
            </script>
    {/literal}

{/if}