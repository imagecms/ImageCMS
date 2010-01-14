{if $fields}
<div id="sortable">
        <table id="xfields_table" >
		  	<thead>
				<th width="5px"></th>
				<th axis="string" width="10px">ID</th>
				<th axis="string">Заголовок</th>
				<th axis="string">Имя</th>
				<th axis="string">Тип</th>
				<th axis="string">Группа</th>
            	<th style="width:80px;" width="80px">
                Позиция
                <img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" onclick="save_fields_position(); return false;" /> 
                </th>
                <th></th>
			</thead>
			<tbody>
		{foreach $fields as $item}
		<tr>
			<td><input type="checkbox" id="chkb_{$item.id}" class="chbx"/></td>
			<td>{$item.id}</td>
			<td><span onclick="edit_field({$item.id},'{$item.type}');">{$item.data.label_text}</span></td>
			<td>{$item.name}</td>
			<td>{$item.type}</td>
			<td>{$item.group}</td>
            <td>
                <div align="center">
                <input type="text" value="{$item.position}" style="width:26px;" class="field_pos" id="field_{$item.id}" /> 
                </div>
            </td>
			<td  class="rightAlign">
			<img onclick="edit_field({$item.id},'{$item.type}'); return false;"  style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="Редактировать" />
			<img onclick="delete_field({$item.id});" style="cursor:pointer" src="{$THEME}/images/delete.png" width="16" height="16" title="Удалить" />
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
					<td></td>
				</tr>
			</tfoot>
		  </table>
</div>

<div style="padding-left:15px;padding-top:2px;">
<a href="#" onclick="check_all(); return false;">Отметить все</a>  /  <a href="#" onclick="uncheck_all(); return false;">Снять выделение</a> 
</div>

<p align="right" style="padding:5px;padding-top:10px;">
С отмечеными:
<input type="submit" name="delete"  class="button_130" value="Назначить группу" onclick="move_fields_window();" />
<input type="submit" name="delete"  class="button" style="font-weight:bold;" value="Удалить" onclick="delete_sel_fields(); return false;" />
</p>

{else:}

<div id="notice">Дополнительных полей не найдено.</div>

{/if}

{literal}
		<script type="text/javascript">

            function move_fields_window()
            {
                new MochaUI.Window({
                    id: 'move_xfields_w',
                    title: 'Назначить группу для полей',
                    loadMethod: 'xhr',
                    type: 'modal',
                    contentURL: base_url + 'admin/components/cp/xfields/move_fields_window/',
                    width: 490,
                    height: 160
                });
            }

            function save_fields_position()
            {
                fields = new Array();     

                var items = $('xfields_table').getElements('input');
                items.each(function(el,i){
                        if(el.hasClass('field_pos'))  
                        {
                            id = el.id + '_' + el.value ;
                            fields.include( id );
                        }  
                        });

                var req = new Request.HTML({
                   method: 'post',
                   url: base_url + 'admin/components/cp/xfields/set_fields_position/',
                   onRequest: function() { },
                   onComplete: function(response) {
                           ajax_div('xfields_list', base_url + 'admin/components/cp/xfields/fields_list'); 
                       }
                }).post({'fields': fields});

            }

            function delete_sel_fields()
            {
                alertBox.confirm('<h1> </h1><p>Удалить отмеченые поля? </p>', {onComplete:
                function(returnvalue) {
                if(returnvalue)
                {
                    fields = new Array();     

                    var items = $('xfields_table').getElements('input');
                    items.each(function(el,i){
                            if(el.hasClass('chbx') && el.checked == true ) 
                            {
                                id = el.id;
                                fields.include( id );
                            }  
                            });

                    var req = new Request.HTML({
                       method: 'post',
                       url: base_url + 'admin/components/cp/xfields/delete_fields',
                       onRequest: function() { },
                       onComplete: function(response) {
                               ajax_div('xfields_list', base_url + 'admin/components/cp/xfields/fields_list'); 
                           }
                    }).post({'fields': fields });
                }
                }
                });
            }

            function move_fields()
            {
                fields = new Array();     
                group = $('group_id_select').value;

                var items = $('xfields_table').getElements('input');
                items.each(function(el,i){
                        if(el.hasClass('chbx') && el.checked == true )  
                        {
                            id = el.id;
                            fields.include( id );
                        }  
                        });

                var req = new Request.HTML({
                   method: 'post',
                   url: base_url + 'admin/components/cp/xfields/set_fields_group/',
                   onRequest: function() { },
                   onComplete: function(response) {
                           ajax_div('xfields_list', base_url + 'admin/components/cp/xfields/fields_list'); 
                       }
                }).post({'fields': fields, 'group_id': group });
            }

            function check_all()
            {
                var items = $('xfields_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = true;
                }  
                });
            }

            function uncheck_all()
            {
                var items = $('xfields_table').getElements('input');
                items.each(function(el,i){
                if(el.hasClass('chbx')) 
                {
                    el.checked = false;
                }  
                });
            }



		</script>
{/literal}

{literal}
		<script type="text/javascript">
			window.addEvent('domready', function(){
				xfields_table = new sortableTable('xfields_table', {overCls: 'over', onClick: function(){}});
			});
        </script>
{/literal}
