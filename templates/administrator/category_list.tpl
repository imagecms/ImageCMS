<div id="sortable">
		  <table id="pages_table" >
		  	<thead>
                <th width="5px">ID</th>
				<th>Заголовок</th>
				<th>Страниц</th>
				<th>URL</th>
				<th></th>
			</thead>
			<tbody>
		{foreach $tree as $item}
		<tr id="{$item.number}">
			<td class="">{$item.id}</td>
			<td onclick="edit_category({$item.id}); return false;">
            {if $item.parent_id == "0"}
            <b>{truncate($item.name, 100)}</b>
            {else:}
                |{for $i=0;$i<=$item.level;$i++}
                    -
                {/for}
                    {truncate($item.name, 100)}
            {/if}
            </td>
            <td>{$item.pages}</td>
			<td><a href="{$BASE_URL}{$item.path_url}" target="_blank">{truncate($item.url, 75)}</a></td>
			<td  class="rightAlign">
        	<img onclick="confirm_delete_cat('{str_replace(array("'",'"'), '', $item.name)}', {$item.id} );" src="{$THEME}/images/delete_page.png"  style="cursor:pointer" width="16" height="16" title="Удалить" />
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
				pages_table = new sortableTable('pages_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                pages_table.altRow();
			});
        </script>
{/literal}
