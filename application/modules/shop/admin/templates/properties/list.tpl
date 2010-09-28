<div class="saPageHeader" style="float:left;width:100%;">

    <div style="float:right;padding:10px 10px 0 0">
        Фильтр: 
        <select name="CategoryId"  style="margin-right:15px;" onChange="filterPropertiesByCategory(this);">
        <option value="0">- Все категории -</option>
            {foreach $categories as $category}
            {$selected = ''}
            {if $filterCategory instanceof SCategory && $category->getId() == $filterCategory->getId()}
                {$selected='selected="selected"'}
            {/if}
                <option value="{echo $category->getId()}" {$selected} >{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>

           <input type="button" class="button_silver_130" value="Создать свойство" onclick="ajaxShop('properties/create');"/>
    </div>

    <h2>Просмотр свойств товаров</h2>
</div>


{if sizeof($model) == 0}
    <div id="notice" style="width: 500px; margin-top:50px;">Список свойств пустой.
        <a href="#" onclick="ajaxShop('properties/create'); return false;">Создать.</a>
    </div>
    {return}
{/if}

<div id="sortable" style="clear:both;"> 
		  <table id="ShopProductsPropertiesHtmlTable">
		  	<thead>
                <th width="5px;">ID</th>
                <th>Название</th>
			</thead>
			<tbody>
                {foreach $model as $p}
                <tr>
                    <td>{echo $p->getId()}</td>
                    <td><a href="javascript:ajaxShop('properties/edit/{echo $p->getId()}');">{truncate(ShopCore::encode($p->getName()),100)}</a></td>
                </tr>
                {/foreach}
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
                </tr>
			</tfoot>
		  </table>
</div>

{literal}
    <script type="text/javascript">
        window.addEvent('domready', function(){
            shopProductPropertiesTable = new sortableTable('ShopProductsPropertiesHtmlTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
            shopProductPropertiesTable.altRow();
        });
    </script>
{/literal}
