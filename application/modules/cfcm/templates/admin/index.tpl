{$top_navigation}
<!--
{foreach $fields as $f}
    <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_field/{$f.field_name}');">{$f.type} {$f.field_name}</a>
    <br />
{/foreach}
-->

<div style="clear:both"></div>

{if $fields}
<div id="sortable" >
		  <table id="cfcfm_fields_table">
		  	<thead>
                <th axis="string">Label</th>
                <th axis="string">Имя</th>
                <th axis="string">Тип</th>
                <th axis="string">Группа</th>
                <th>
                    Вес
<img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" onclick="save_cfcfm_fields_weight(); return false;" />
                </th>
                <th width="100px"></th>
            </thead>
			<tbody>
		    {foreach $fields as $f}
                <tr>
                    <td>
                        <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_field/{$f.field_name}');">{$f.label}</a>
                    </td>
                    <td>{$f.field_name}</td>
                    <td>{$f.type}</td>
                    <td>{$groups[$f.group]}</td>
                    <td>
                        <input type="text" value="{$f.weight}" style="width:26px;" class="field_pos" id="field{$f.field_name}" />  
                    </td>
                    <td align="right">
<img onclick="ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_field_data_type/{$f.field_name}');" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="Редактировать" />
<img onclick="confirm_delete_cfcfm_field('{$f.field_name}');" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />  
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
            cfcfm_fields_table = new sortableTable('cfcfm_fields_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
            cfcfm_fields_table.altRow();
        });
    </script>
{/literal}

{else:}
<div id="notice">
    Список полей пустой. <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/create_field');">Создать поле.</a>
</div>
{/if}


{literal}
<script type="text/javascript">
function confirm_delete_cfcfm_field(name)
{
    alertBox.confirm('<h1> </h1><p>Удалить поле '+ name + '? </p>', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
				var req = new Request.HTML({
				method: 'post',
				url: base_url + 'admin/components/cp/cfcm/delete_field/' + name,
				onComplete: function(response) { 
                    ajax_div('page', base_url + 'admin/components/cp/cfcm/index');    
                }
			}).post();
	}
	else
	{

	}
	}
});
}

function save_cfcfm_fields_weight()
{
    var fields_pos = new Array();     
    var fields_names = new Array();     

    var items = $('cfcfm_fields_table').getElements('input');
    items.each(function(el,i){
            if(el.hasClass('field_pos')) 
            {
                id = el.id;
                val = el.value;    
                fields_pos.include(val);
                fields_names.include(id);
            }  
            });

    var req = new Request.HTML({
       method: 'post',
       url: base_url + 'admin/components/cp/cfcm/save_weight',
       onRequest: function() { },
       onComplete: function(response) { 
                ajax_div('page', base_url + 'admin/components/cp/cfcm/index');   
           }
    }).post({'fields_pos': fields_pos, 'fields_names': fields_names});
}

</script>
{/literal}
