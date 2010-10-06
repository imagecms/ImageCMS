<div class="saPageHeader">
    <h2>Редактирование способов доставки</h2>
</div>

{if sizeof($model)==0}
    <div id="notice" style="width: 500px; ">Список пустой.
        <a href="#" onclick="ajaxShop('deliverymethods/create'); return false;">Создать.</a>
    </div>

    {return}
{/if}

<div id="sortable">
		  <table id="ShopDeliveryMethodsTable">
		  	<thead>
                <th width="5px">ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Бесплатен от</th>
                <th>Активен</th>
                <th width="15px"></th>
			</thead>
			<tbody>
		{foreach $model as $c}
		<tr id="deliverymethodRow{echo $c->getId()}">
			<td>{echo $c->getId()}</td>
			<td onclick="javascript:ajaxShop('deliverymethods/edit/{echo $c->getId()}');">{echo ShopCore::encode($c->getName())}</td>
            <td>{echo $c->getPrice()}</td>
            <td>{echo $c->getFreeFrom()}</td>
            <td>{if $c->getEnabled()} Да {else:} Нет {/if}</td> 
            <td><img onclick="confirm_shop_delete_dm({echo $c->getId()});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="Удалить" /></td>
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
				var ShopDeliveryMethodsTable = new sortableTable('ShopDeliveryMethodsTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
                ShopDeliveryMethodsTable.altRow();
			});

function confirm_shop_delete_dm(id)
{
alertBox.confirm('<h1>Удалить способ доставки ID: ' + id + '? </h1>', {onComplete:
	function(returnvalue) {
        if(returnvalue)
        {
            $('deliverymethodRow' + id).setStyle('background-color','#D95353');
            var req = new Request.HTML({
                method: 'post',
                url: shop_url + 'deliverymethods/delete',
                evalResponse: true,
                onComplete: function(response) {  
                    $('deliverymethodRow' + id).dispose();
                    if ($$('#ShopDeliveryMethodsTable tbody tr')=='')
                    {
                        ajaxShop('deliverymethods/c_list'); 
                    }
                }
            }).post({'id': id});
        }
	}
});
}

        </script>
{/literal}
