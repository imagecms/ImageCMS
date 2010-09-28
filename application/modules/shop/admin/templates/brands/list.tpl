<div class="saPageHeader">
    <h2>Редактирование брендов</h2>
</div>

{if sizeof($model)==0}
    <div id="notice" style="width: 500px; ">Список брендов пустой.
        <a href="#" onclick="ajaxShop('brands/create'); return false;">Создать.</a>
    </div>

    {return}
{/if}

<div id="sortable">
		  <table id="ShopBrandsTable">
		  	<thead>
                <th width="5px">ID</th>
                <th>Название</th>
                <th>URL</th>
                <th width="15px"></th>
			</thead>
			<tbody>
		{foreach $model as $c}
		<tr id="brandRow{echo $c->getId()}">
			<td>{echo $c->getId()}</td>
			<td onclick="javascript:ajaxShop('brands/edit/{echo $c->getId()}');">{echo ShopCore::encode($c->getName())}</td>
			<td><a href="{echo shop_url('brands/'.$c->getUrl())}">{echo shop_url('brands/'.$c->getUrl())}</a></td>
            <td><img onclick="confirm_shop_delete_brand({echo $c->getId()});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" /></td>
		</tr>
		{/foreach}
			</tbody>
			<tfoot>
				<tr>
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
				var ShopBrandsTable = new sortableTable('ShopBrandsTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                ShopBrandsTable.altRow();
			});

function confirm_shop_delete_brand(id)
{
alertBox.confirm('<h1>Удалить бренд ID: ' + id + '? </h1>', {onComplete:
	function(returnvalue) {
        if(returnvalue)
        {
            $('brandRow' + id).setStyle('background-color','#D95353');
            var req = new Request.HTML({
                method: 'post',
                url: shop_url + 'brands/delete',
                evalResponse: true,
                onComplete: function(response) {  
                    $('brandRow' + id).dispose();
                    if ($$('#ShopBrandsTable tbody tr')=='')
                    {
                        ajaxShop('brands/c_list'); 
                    }
                }
            }).post({'id': id});
        }
	}
});
}

        </script>
{/literal}
