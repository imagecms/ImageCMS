<h5>Корзина</h5>
<div class="spLine"></div>

{if !$items}
    {echo ShopCore::t('Корзина пуста')}
    {return}
{/if}


<script type="text/javascript">
var deliveryMethods_prices = new Array;
var currencySymbol = '{$CS}';
var totalPrice = '{echo ShopCore::app()->SCart->totalPrice()}';

{foreach $deliveryMethods as $d}
    deliveryMethods_prices[{echo $d->getId()}] = '{echo $d->toCurrency()}';
{/foreach}

{literal}
    function changeDeliveryMethod(id, free)
    {
        document.getElementById('deliveryMethodId').value = id;

        if (free == true)
        {
            document.getElementById('totalPriceText').innerHTML = totalPrice + ' ' + currencySymbol; 
        }
        else
        {
            var result = parseFloat(deliveryMethods_prices[id]) + parseFloat(totalPrice);
            document.getElementById('totalPriceText').innerHTML = result.toFixed(2).toString() + ' ' + currencySymbol;
        }
    }
{/literal}
</script>

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
                {form_dropdown("products[$key]",$ranges, $item.quantity, 'onChange="document.cartForm.submit();"')}
            </td>
            <td>{echo ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {$CS}</td>
            <td><a href="{shop_url('cart/delete/' . $key)}" class="delete">X</a></td>
        </tr>
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
</form>

<div class="sp"></div>
<h5>Способ доставки</h5>
<div class="spLine"></div>

{if sizeof($deliveryMethods) > 0}
<ul class="deliveryMethods">
    {$n=0}
    {foreach $deliveryMethods as $deliveryMethod}
    
    {if $n==0}
        {$checked = "checked"}
        {$activeDeliveryMethod = $deliveryMethod->getId()}
        {$n++}
    {else:}
        {$checked = ''}
    {/if}

    {if $deliveryMethod->getFreeFrom() == 0 && $deliveryMethod->getPrice() > 0}
        {$priceStr = $deliveryMethod->toCurrency().' '.$CS}
        {$free = false}
    {elseif(ShopCore::app()->SCart->totalPrice() >= $deliveryMethod->getFreeFrom()):}
        {$priceStr = "бесплатно"}
        {$free = true}
    {elseif($deliveryMethod->getFreeFrom() > 0 && $deliveryMethod->getPrice() > 0):}
        {$priceStr = $deliveryMethod->toCurrency().' '.$CS}
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
    {/foreach}
</ul>
{/if}

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
    <input type="hidden" name="makeOrder" value="1">
        <div class="fieldName">Имя, фамилия:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[fullName]">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Email:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[email]">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Телефон:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[phone]">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Адрес доставки:</div>
        <div class="field">
            <input type="text" class="input" name="userInfo[deliverTo]">
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
    changeDeliveryMethod({echo $activeDeliveryMethod});
</script>
