<div class="saPageHeader">
    <h2>Редактирование категорий</h2>
</div>

{if sizeof($tree)==0}
    <div id="notice" style="width: 500px; ">Список категорий пустой.
        <a href="#" onclick="ajaxShop('categories/create'); return false;">Создать.</a>
    </div>

    {return}
{/if}

<div id="sortable">
		  <table id="ShopCatsHtmlTable">
		  	<thead>
                <th width="5px">ID</th>
                <th>Имя</th>
                <th>URL</th>
                <th>
                    Позиция
                    <img src="{$THEME}/images/save.png" align="absmiddle" style="cursor:pointer;width:22px;height:22px;" 
                    onclick="SaveCategoriesPositions(); return false;" />  
                </th>
                <th width="15px"></th>
			</thead>
			<tbody>
		{foreach $tree as $c}
		<tr>
			<td>{echo $c->getId()}</td>
			<td onclick="javascript:ajaxShop('categories/edit/{echo $c->getId()}');">
                {str_repeat('-',$c->getLevel())}
                {if $c->getLevel()==0}
                    <b>{echo ShopCore::encode($c->getName())}</b>
                {else:}
                    {echo ShopCore::encode($c->getName())}
                {/if}
            </td>
			<td><a href="{shop_url('category/' . $c->getFullPath())}" target="_blank">{echo $c->getFullPath()}</a></td>
            <td>
                <input type="text" value="{echo $c->getPosition()}" style="width:26px;" class="SCategoryPos" id="SCat{echo $c->getId()}" /> 
            </td>
            <td><img onclick="confirm_shop_category({echo $c->getId()});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" /></td>
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
				shopCatsTable = new sortableTable('ShopCatsHtmlTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                shopCatsTable.altRow();
			});

function confirm_shop_category(id)
{
alertBox.confirm('<h1>Удалить категорию ID: ' + id + '? </h1>', {onComplete:
	function(returnvalue) {
        if(returnvalue)
        {
            var req = new Request.HTML({
                method: 'post',
                url: shop_url + 'categories/delete',
                evalResponse: true,
                onComplete: function(response) {  
                    ajaxShop('categories/c_list');
                    loadShopSidebarCats();
                }
            }).post({'id': id});
        }
	}
});
}

        </script>
{/literal}
