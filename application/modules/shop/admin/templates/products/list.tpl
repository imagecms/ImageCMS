<div class="saPageHeader" style="float:left;width:100%;">

    <div style="float:right;padding:10px 10px 0 0">
           <input type="button" class="button_silver_130" value="Создать товар" onclick="ajaxShop('products/create');"/>
    </div>

    <h2>Просмотр товаров категории "{truncate(ShopCore::encode($model->getName()),60)}"</h2>
</div>

{if $totalProducts == 0}
    <div id="notice" style="width: 500px; margin-top:50px;">В категории нет товаров.
        <a href="#" onclick="ajaxShop('products/create'); return false;">Создать.</a>
    </div>
    {return}
{/if}

<div id="sortable" style="clear:both;"> 
		  <table id="ShopProductsHtmlTable">
		  	<thead>
                <th width="1px"><input type="checkbox"/></th>
                <th width="5px">ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th width="5px"></th>
			</thead>
			<tbody>
        {foreach $products as $p}
		<tr id="productRow{echo $p->getId()}" class="row">
            <td width="1px"><input type="checkbox" /></td>
			<td>{echo $p->getId()}</td>
			<td>
                <a href="#" onClick="ajaxShop('products/edit/{echo $p->getId()}?redirect={base64_encode(ShopCore::$ci->uri->uri_string())}'); return false;">{truncate(ShopCore::encode($p->getName()),100)}</a>
            </td>
            <td>{echo $p->getPrice()}</td>
			<td>
                <img 
                onclick="confirm_delete_product({echo $p->getId()}, {echo $model->getId()});"
                src="{$THEME}/images/delete.png"  
                style="cursor:pointer;width:16px;height:16px;" title="Удалить" /> 
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

<div style="float:right;padding:10px 10px 0 0" class="pagination">
        {$pagination}
</div>

<div style="padding:10px 10px 0 20px;">
    <b>Всего товаров:</b> {$totalProducts}
</div>

{literal}
    <script type="text/javascript">
        window.addEvent('domready', function(){
            shopProductsTable = new sortableTable('ShopProductsHtmlTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
            shopProductsTable.altRow();
        });

    function confirm_delete_product(id, category_id)
    {
        alertBox.confirm('<h1>Удалить товар ID: ' + id + '? </h1>', {onComplete:
            function(returnvalue) {
                if(returnvalue)
                {
                    $('productRow' + id).setStyle('background-color','#D95353'); 

                    var req = new Request.HTML({
                        method: 'post',
                        url: shop_url + 'products/delete',
                        evalResponse: true,
                        onComplete: function(response) {  
                            $('productRow' + id).dispose();
                            if ($$('#ShopProductsHtmlTable tbody tr')=='')
                            {
                                ajaxShop('products/index/' + category_id);
                            }
                        }
                    }).post({'productId': id});
                }
            }
        });
    }

    </script>
{/literal}
