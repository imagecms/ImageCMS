<div class="top-navigation">
    <ul style="float:left;">
        <li><p>xForm Field - Конструктор полей для формы <b>"{$form_name}"</b></p></li>
    </ul>
    <div align="right" style="float:right;padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Создать поле" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/mix_field/{$form_id}/new'); return false;" /> <input type="button" class="button_silver_130" value="Отмена" onclick="ajax_div('page', base_url + 'admin/components/cp/xform/'); return false;" />
    </div>
</div>

<div style="clear:both"></div> 
{if $fields}
<div id="sortable" >
		  <table id="cats_table">
		  	<thead>
				<th width="5px;">ID</th>
                <th axis="string">Тип</th>
                <th axis="string">Имя</th>
                <th axis="string">Лейбл</th>
                <th> <div align="center">Позиция <img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" onclick="save_position({$form_id});" /></div></th>
                <th></th>
			</thead>
			<tbody>
		{foreach $fields as $field}
		<tr>
            <td>{$field.id}</td>
            <td>{$field.type}</td>
            <td>{$field.name}</td>
            <td>{$field.label}</td>
            <td><div align="center"><input type="text" value="{$field.position}" style="width:23px;" class="item_pos" id="item{$field.id}" /></div></td>
            <td align="right">
                <img src="{$THEME}/images/edit.png"  onclick="ajax_div('page', base_url + 'admin/components/cp/xform/mix_field/{$form_id}/{$field.id}');" style="cursor:pointer;" title="Редактировать поле" />
                <img src="{$THEME}/images/delete.png"  onclick="confirm_delete_gcategory({$field.id},{$form_id});" style="cursor:pointer;" title="Удалить поле" />
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
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

{literal}
    	<script type="text/javascript">
			window.addEvent('domready', function(){
				cats_table = new sortableTable('cats_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                cats_table.altRow();
			});

            function confirm_delete_gcategory(id,fid)
            {
                alertBox.confirm('<h1> </h1><p>Удалить поле ID - ' + id + '? </p>', {onComplete:
                function(returnvalue){
                if(returnvalue)
                {
                        var req = new Request.HTML({
                           method: 'post',
                           url: base_url + 'admin/components/cp/xform/delete_field/',
                           onRequest: function() { },
                           onComplete: function(response) {  
                                ajax_div('page', base_url + 'admin/components/cp/xform/fields/'+fid);   
                            }
                        }).post({'id': id });
                }
                }
                });
            }
			
			function save_position(fid)
        {
            var pos = new Array();     

            var items = $('cats_table').getElements('input');
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
               url: base_url + 'admin/components/cp/xform/save_positions/',
               onRequest: function() { },
               onComplete: function(response) {  
                    ajax_div('page', base_url + 'admin/components/cp/xform/fields/' + fid);   
                }
            }).post({'items_pos': pos });
        }

        </script>
{/literal}

{/if}
