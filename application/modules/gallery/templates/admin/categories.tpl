<div class="top-navigation">
    <ul style="float:left;">
        <li><p>Категории</p></li>
    </ul>
    <div align="right" style="float:right;padding:7px 13px;">
        <input type="button" class="button_silver_130" value="Создать Категорию" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/show_create_category'); return false;" />
        <input type="button" class="button_silver_130" value="Создать Альбом" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/show_crate_album'); return false;" />
        <input type="button" class="button_silver_130" value="Настройки" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/settings'); return false;" />
    </div>
</div>

<div style="clear:both"></div> 
{if $categories}
<div id="sortable" >
		  <table id="cats_table">
		  	<thead>
                <th width="5px"></th>
				<th width="5px;">ID</th>
                <th axis="string">Имя</th>
                <th axis="string">Альбомы</th>
                <th axis="string">Описание</th>
                <th axis="date">Создано</th>
                <th></th>
			</thead>
			<tbody>
		{foreach $categories as $category}
		<tr>
            <td></td>
            <td>{$category.id}</td>
            <td onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$category.id}'); return false;">{$category.name}</td>
            <td>{$category.albums_count}</td>
            <td>{truncate(htmlspecialchars($category.description), 75)}</td>
            <td>{date('Y-d-m H:i', $category.created)}</td>
            <td align="right">
                <img src="{$THEME}/images/edit.png"  onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_category/{$category.id}');" style="cursor:pointer;" />
                <img src="{$THEME}/images/delete.png"  onclick="confirm_delete_gcategory({$category.id});" style="cursor:pointer;" />
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

            function confirm_delete_gcategory(id)
            {
                alertBox.confirm('<h1> </h1><p>Удалить категорию ' + id + '? </p>', {onComplete:
                function(returnvalue){
                if(returnvalue)
                {
                        var req = new Request.HTML({
                           method: 'post',
                           url: base_url + 'admin/components/cp/gallery/delete_category',
                           onRequest: function() { },
                           onComplete: function(response) {  
                                ajax_div('page', base_url + 'admin/components/cp/gallery/');   
                            }
                        }).post({'category': id });
                }
                }
                });
            }

        </script>
{/literal}

{/if}
