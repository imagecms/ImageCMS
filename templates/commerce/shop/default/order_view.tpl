{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}


{# View ordered products}






 <div class="content">
                <div class="center">
                    <h1>Личный кабинет</h1>
                    <table class="cleaner_table" cellspacing="0">
                        <caption>Заказ</caption>
                        <colgroup>
                            <col span="1" width="120">
                            <col span="1" width="396">
                            <col span="1" width="160">
                            <col span="1" width="140">
                            <col span="1" width="160">
                            <col span="1" width="25">
                        </colgroup>
                        <tbody>
			
		 {foreach $model->getSOrderProductss() as $item}
		{$total = $total + $item->getQuantity() * $item->toCurrency()}
		{$product = $item->getSProducts()}
		{if $item->getKitId() > 0}
			{if $item->getIsMain()}
				<tr>
					<td>  
						{if $product->getMainImage()}
						<a href="#" class="photo_block">
						<img src="{productImageUrl($product->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
						</a>{/if}
					</td>
					 <td>
						<a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> {$item->getVariantName()}
					</td>
					<td>{echo $item->toCurrency()} {$CS}</td>
					<td rowspan="{echo $kits[$item->getKitId()]['total']}">
						 {echo $item->getQuantity()} шт.
					</td>
					<td rowspan="{echo $kits[$item->getKitId()]['total']}">{echo $item->getQuantity() * $kits[$item->getKitId()]['price']} {$CS}</td>
				</tr>
			{else:}
				<tr>
					<td style="width:90px;padding:2px;">
						<div style="width:90px;height:90px;overflow:hidden;">
						{if $product->getMainImage()}
							<img src="{productImageUrl($product->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
						{/if}
						</div>
					</td>
					<td>
						<a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> {$item->getVariantName()}
					</td>
					<td>{echo $item->toCurrency()} {$CS}</td>
				</tr>
			{/if}
		{else:}
			<tr>
				<td>
					{if $product->getMainImage()}
					<a href="{shop_url('product/' . $product->getUrl())}" class="photo_block">
					<img src="{productImageUrl($product->getId() . '_main.jpg')}"/>
					</a>{/if}
				</td>
				<td>
					<a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> {$item->getVariantName()}
				</td>
				<td>
					<div class="price f-s_16 f_l">{echo $item->toCurrency()}<sub> {$CS}</sub><span class="d_b">859 $</span></div>
					
				</td>
				<td>
					  <div class="count">
                      {echo $item->getQuantity()} шт.
                      </div>
				</td>
				<td>					 
					 <div class="price f-s_18 f_l">{echo $item->getQuantity() * $item->toCurrency()} <sub> {$CS}</sub><span class="d_b">859 $</span></div>
				</td>
<!--				<td>
                     <a href="#" class="delete_text">&times;</a>
                </td>-->
			</tr>
		{/if}
    {/foreach}

						</tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="foot_cleaner">
                                        <div class="f_r">
                                            <div class="price f-s_26 f_l">
											{if $total >= $deliveryMethod->getFreeFrom()}
											 {echo $total} {$CS}
											{else:}{echo $total + $model->getDeliveryPrice()} {$CS}{/if}
											<span class="d_b">
												4454$</span></div>
                                        </div>
                                        <div class="f_l">
                                            <ul class="info_curr_buy f_l">
                                                <li>
                                                    <span>Оплачен:</span>
                                                    <b>{if $model->getPaid() == true} Да{else: }Нет{/if}</b>
                                                </li>
                                                <li>
                                                    <span>Cтатус:</span>
                                                    <b>{echo SOrders::getStatusName('Id',$model->getStatus())} {if $model->getDeliveryMethod() > 0}</b>
                                                </li>
                                                <li>
                                                    <span>Доставка:</span>
                                                    <b>{echo $model->getSDeliveryMethods()->getName()}{/if}</b>
                                                </li>
                                                <li>
                                                    <span>Оплата:</span>
                                                    <b>	{if $paymentMethods[0] != null && !$model->getPaid()}
													   {foreach $paymentMethods as $pm}
													   {echo encode($pm->getName())}
													   {echo $pm->getDescription()}
<!--													   {echo $pm->getPaymentForm($model)}-->
													   {/foreach}
													   {/if}
													</b>
                                                </li>
                                            </ul>
                                            <div class="sum f_r">
                                                Сумма:
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
           
 
    {if $CI->session->flashdata('makeOrder') === true}
    <div style="padding:10px;background-color:#f5f5dc;">
        Спасибо за Ваш заказ.
    </div>
    {/if}
