{# Variables
# @var items
# @var deliveryMethods
# @var paymentMethods
# @var paymentMethodsArray
# @var ranges
# @var profile
#}


{$this->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">')}
<script type="text/javascript" src="/templates/commerce/shop/default/js/cart.js"></script>

<script type="text/javascript">
    var deliveryMethods_prices = new Array;
    var currencySymbol = '{$CS}';
    var totalPrice = '{echo ShopCore::app()->SCart->totalPrice()}';

    {foreach $deliveryMethods as $d}
        {if $d->getIsPriceInPercent() == true}
            {$delPrice = round(ShopCore::app()->SCart->totalPrice() * $d->toCurrency() / 100, 2)}
            {else:}
            {$delPrice = $d->toCurrency()}
        {/if}
    deliveryMethods_prices[{echo $d->getId()}] = '{echo $delPrice}';
    {/foreach}
</script>

<h5>Корзина</h5>
<div class="spLine"></div>

{if !$items}
    {echo ShopCore::t('Корзина пуста')}
    {return}
{/if}

<form action="{shop_url('cart')}" method="post" name="cartForm">
<input type="hidden" name="recount" value="1">
{form_csrf()}
<table class="cartTable" width="100%">
    <thead align="left">
        <th>{echo ShopCore::t('Фото')}</th>
        <th>{echo ShopCore::t('Название')}</th>
        <th>{echo ShopCore::t('Цена')}</th>
        <th>{echo ShopCore::t('Количество')}</th>
        <th>{echo ShopCore::t('Всего')}</th>
        <th class="admin"></th>
    </thead>
    <tbody>
    {foreach $items as $key=>$item}
		{if $item.model instanceof SProducts}
			<tr>
				<td style="width:90px;padding:2px;">
					<div style="width:90px;height:90px;overflow:hidden;">
					{if $item.model->getMainImage()}
						<img src="{productImageUrl($item.model->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
					{/if}
					</div>
				</td>
				<td>
					<a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a> {$item.variantName}
				</td>
				<td>{echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}</td>
				<td>
					<input type="text" name="products[{$key}]" value="{$item.quantity}" style="width:24px;">
				</td>
				<td>{echo ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {$CS}</td>
				<td><a href="{shop_url('cart/delete/' . $key)}" rel="nofollow" class="delete">X</a></td>
			</tr>
		{elseif($item.model instanceof ShopKit):}
			<tr>
				<td style="width:90px;padding:2px;">
					<div style="width:90px;height:90px;overflow:hidden;">
					{if $item.model->getMainProduct()->getMainImage()}
						<img src="{productImageUrl($item.model->getMainProduct()->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
					{/if}
					</div>
				</td>
				<td>
					<a href="{shop_url('product/' . $item.model->getMainProduct()->getUrl())}">{echo ShopCore::encode($item.model->getMainProduct()->getName())}</a> {echo ShopCore::encode($item.model->getMainProduct()->firstVariant->getName())}
					<br /><span style="font-size:16px;">{echo $item.model->getMainProduct()->firstVariant->toCurrency()} {$CS}</span>
				</td>
				<td rowspan="{echo $item.model->countProducts()}">{echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}</td>
				<td rowspan="{echo $item.model->countProducts()}"><input type="text" name="products[{$key}]" value="{$item.quantity}" style="width:24px;"/></td>
				<td rowspan="{echo $item.model->countProducts()}">{echo ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {$CS}</td>
				<td rowspan="{echo $item.model->countProducts()}"><a href="{shop_url('cart/delete/' . $key)}" rel="nofollow" class="delete">X</a></td>
			</tr>
			{foreach $item.model->getShopKitProducts() as $shopKitProduct}
				{$ap = $shopKitProduct->getSProducts()}
				{$ap->setLocale(ShopController::getCurrentLocale())}
				{$kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)}
				<tr>
					<td style="width:90px;padding:2px;">
						<div style="width:90px;height:90px;overflow:hidden;">
						{if $ap->getMainImage()}
							<img src="{productImageUrl($ap->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
						{/if}
						</div>
					</td>
					<td>
						<a href="{shop_url('product/' . $ap->getUrl())}">{echo ShopCore::encode($ap->getName())}</a> {echo ShopCore::encode($kitFirstVariant->getName())}
						{if $kitFirstVariant->getEconomy() > 0}
							<br /><s style="font-size:14px;">{echo $kitFirstVariant->toCurrency('origPrice')} {$CS}</s>
							<span style="font-size:16px;">{echo $kitFirstVariant->toCurrency()} {$CS}</span>
						{else:}
							<span style="font-size:16px;">{echo $kitFirstVariant->toCurrency()} {$CS}</span>
						{/if}
					</td>
				</tr>
				{$i++}
			{/foreach}
		{/if}
    {/foreach}
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tfoot>
</table>

<div id="buttons">
    <a href="#" id="checkout" onClick="document.cartForm.submit();">Пересчитать</a>
</div>

</form>

<div class="sp"></div>
<h5>Способ доставки</h5>
<div class="spLine"></div>

{if sizeof($deliveryMethods) > 0}
<ul class="deliveryMethods">
    {$n=0}
    {foreach $deliveryMethods as $deliveryMethod}
    {if $deliveryMethod->getIsPriceInPercent() == true}
        {$delPrice = round(ShopCore::app()->SCart->totalPrice() * $deliveryMethod->getPrice() / 100, 2)}
    {else:}
        {$delPrice = $deliveryMethod->toCurrency()}
    {/if}
    {if $n==0}
        {$checked = "checked"}
        {$activeDeliveryMethod = $deliveryMethod->getId()}
    {else:}
        {$checked = ''}
    {/if}
    {$n++}
    {if $deliveryMethod->getFreeFrom() == 0 && $deliveryMethod->getPrice() > 0}
        {$priceStr = "$delPrice".' '.$CS}
        {$free = false}
    {elseif(ShopCore::app()->SCart->totalPrice(false) >= $deliveryMethod->getFreeFrom()):}
        {$priceStr = "бесплатно"}
        {$free = true}
    {elseif($deliveryMethod->getFreeFrom() > 0 && $deliveryMethod->getPrice() > 0):}
        {$priceStr = "$delPrice".' '.$CS}
        {$free = false} 
    {/if}
    
    <li>
        <h3>
            <label>
                {if $free==true}
                    <input type="radio" onclick="changeDeliveryMethod(this.value,true);" {$checked} name="deliveryMethod" value="{echo $deliveryMethod->getId()}" />
                {else:}
                    <input type="radio" onclick="changeDeliveryMethod(this.value);" {$checked} name="deliveryMethod" value="{echo $deliveryMethod->getId()}" />
                {/if}

                {echo ShopCore::encode($deliveryMethod->getName())} ({$priceStr}) 
            </label>
        </h3>
        <div class="desc">{echo $deliveryMethod->getDescription()}</div>
    </li>
    {if $n==1}
        {if $free==true}
            {$srciptText = "changeDeliveryMethod($activeDeliveryMethod, true);\r\n"}
        {else:}
            {$srciptText = "changeDeliveryMethod($activeDeliveryMethod);\r\n"}
        {/if}
    {/if}
    {/foreach}
</ul>
{/if}
<div id="paymentMethods">
{if sizeof($paymentMethods) > 0}
<div class="sp"></div>
<h5>Способ оплаты</h5>
<div class="spLine"></div>


<ul class="deliveryMethods">
    {$n=0}
    {foreach $paymentMethods as $paymentMethod}
    
    {if $n==0}
        {$checked = "checked"}
        {$activePaymentMethod = $paymentMethod->getId()}
        {$n++}
    {else:}
        {$checked = ''}
    {/if}
	<li>
		<h3>
            <label>
				 <input type="radio" onclick="changePaymentMethod(this.value);" {$checked} name="paymentMethod" value="{echo $paymentMethod->getId()}" />
				 
				 {echo ShopCore::encode($paymentMethod->getName())}
			</label>
		</h3>
        <div class="desc">{echo $paymentMethod->getDescription()}</div>
	</li>
    {/foreach}
</ul>
{/if}
</div>


<div id="total">
    <span class="value" id="totalPriceText">
        {echo ShopCore::app()->SCart->totalPrice()} {$CS}
    </span>
    <span class="label">
        {echo ShopCore::t('Итог')}
    </span>
</div>

<div class="sp"></div>
<h5>Адрес получателя</h5>

{if $errors}
    <div class="spLine"></div>
    <div class="errors">
        {$errors}
    </div>
{/if}

<div class="spLine"></div><br/>
<div style="margin-left:20px;">
    <form action="{shop_url('cart')}" method="post" name="orderForm">
    <input type="hidden" name="deliveryMethodId" id="deliveryMethodId" value="0">
	<input type="hidden" name="paymentMethodId" id="paymentMethodId" value="0">
    <input type="hidden" name="makeOrder" value="1">
        <div class="fieldName">Имя, фамилия:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[fullName]" value="{$profile.name}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Email:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[email]" value="{$profile.email}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Телефон:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[phone]" value="{$profile.phone}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Адрес доставки:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[deliverTo]" value="{echo $profile.address}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Комментарий к заказу:</div>
        <div class="field">
            <textarea name="userInfo[commentText]" class="input" rows="6"></textarea> 
        </div>
        <div class="clear"></div>

        <div id="buttons">
            <a href="#" id="checkout" onClick="document.orderForm.submit();">{echo ShopCore::t('Оформить Заказ')}</a>
        </div>
        {form_csrf()}
    </form>
</div>

<script type="text/javascript">
    {$srciptText}
    changePaymentMethod({echo $activePaymentMethod});
</script>
