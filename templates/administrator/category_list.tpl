     <section class="mini-layout">
                        <div class="frame_title clearfix">
                            <div class="pull-left">
                                <span class="help-inline"></span>
                                <span class="title">Категории</span>
                            </div>
                            <div class="pull-right">
                                <div class="d-i_b">
                                    <button type="button" class="btn btn-small disabled action_on"><i class="icon-trash"></i>Удалить</button>
                                    <button type="button" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>Создать категорию</button>
                                </div>
                            </div>                            
                        </div>
 <div class="frame_table">
                            <div id="category">
                                <div class="row-category head">
                                    <div class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"/>
                                            </span>
                                        </span>
                                    </div>
                               <div>{lang('a_id')}</div>
				<tdivh>{lang('a_title')}</div>
				<div>{lang('a_pages')}</div>
				<div>{lang('a_url')}</div>
				<div></div>
                                </div>
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
        	<img onclick="confirm_delete_cat('{str_replace(array("'",'"'), '', $item.name)}', {$item.id} );" src="{$THEME}/images/delete_page.png"  style="cursor:pointer" width="16" height="16" title="{lang('a_delete')}" />
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
