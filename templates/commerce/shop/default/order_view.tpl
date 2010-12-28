{# View ordered products}

<h5>Заказ № {echo $model->getId()}</h5>
    {if $CI->session->flashdata('makeOrder') === true}
    <div style="padding:10px;background-color:#f5f5dc;">
        Спасибо за Ваш заказ.
    </div>
    {/if}

<div class="spLine"></div>

<div class="orderViewInfo">
    Оплачен: {if $model->getPaid() == true} Да{else: }Нет{/if}
   <br/>Статус: {echo SOrders::$statuses[$model->getStatus()]}
    {if $model->getDeliveryMethod() > 0}
        <br/>Способ доставки: {echo $model->getSDeliveryMethods()->getName()}
    {/if}
</div>

<div class="spLine"></div>

<table class="cartTable" width="100%">
    <thead align="left">
        <th>{echo ShopCore::t('Фото')}</th>
        <th>{echo ShopCore::t('Название')}</th>
        <th>{echo ShopCore::t('Цена')}</th>
        <th>{echo ShopCore::t('Количество')}</th>
        <th>{echo ShopCore::t('Всего')}</th>
    </thead>
    <tbody>
    {foreach $model->getSOrderProductss() as $item}
    {$total = $total + $item->getQuantity() * $item->toCurrency()}
    {$product = $item->getSProducts()}
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
            <td>
                 {echo $item->getQuantity()} шт.
            </td>
            <td>{echo $item->getQuantity() * $item->toCurrency()} {$CS}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tfoot>
</table>

<div id="total">
    <span class="value" id="totalPriceText">
        {echo $total + $model->getDeliveryPrice()} {$CS}
    </span>
    <span class="label">
        {echo ShopCore::t('Итог')}
    </span>
</div>

<div class="sp"></div>
<h5>Способы оплаты</h5>
<ul>
    {foreach $paymentMethods as $pm}
    <li>
        <label><b>{echo encode($pm->getName())}</b></label>
        <p>
            {echo $pm->getDescription()}
            {echo $pm->getPaymentForm($model)}
        </p>
    </li>
    {/foreach}
</ul>

