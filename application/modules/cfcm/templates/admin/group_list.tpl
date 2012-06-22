{$top_navigation}

<!--
{foreach $fields as $f}
    <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_field/{$f.field_name}');">{$f.type} {$f.field_name}</a>
    <br />
{/foreach}
-->

<div style="clear:both"></div>

{if $groups}
<div id="sortable" >
		  <table id="cfcfm_fields_table">
		  	<thead>
                <th style="width:15px;">ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Поля</th>
                <th width="100px"></th>
            </thead>
			<tbody>
		    {foreach $groups as $g}
                <tr>
                    <td>{$g.id}</td>
                    <td>
                        <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_group/{$g.id}');">{$g.name}</a>
                    </td>
                    <td>{truncate($g.description, 35)}</td>
                    <td>
                        {echo $this->CI->db->get_where('content_fields', array('group' => $g.id))->num_rows()}
                    </td>
                    <td align="right">
<img onclick="ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_group/{$g.id}');" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="Редактировать" />
<img onclick="confirm_delete_cfcfm_group('{$g.id}');" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" /> 
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
    Список групп пустой. <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/create_group');">Создать Группу.</a>
</div>
{/if}

{literal}
<script type="text/javascript">
function confirm_delete_cfcfm_group(id)
{
    alertBox.confirm('<h1> </h1><p>Удалить группу ID: '+ id + '? </p>', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
				var req = new Request.HTML({
				method: 'post',
				url: base_url + 'admin/components/cp/cfcm/delete_group/' + id,
				onComplete: function(response) { 
                    ajax_div('page', base_url + 'admin/components/cp/cfcm/list_groups');    
                }
			}).post();
	}
	else
	{

	}
	}
});
}
</script>
{/literal}
