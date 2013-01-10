<div class="main_wrap p_bot">
    <h1>Заказ № {echo $model->getId()}</h1>
    {if $CI->session->flashdata('makeOrder') === true}
    <div class="flashBack">
        Спасибо за Ваш заказ.
    </div>
    {/if}

    <div class="orderViewInfo">
        <dl>
            <dt>Оплачен:</dt>
            <dd>{if $model->getPaid() == true} Да{else: }Нет{/if}</dd>
        </dl>
        <dl>
            <dt>Статус:</dt>
            <dd>{echo SOrders::getStatusName('Id',$model->getStatus())}</dd>
        </dl>        
        {if $model->getSDeliveryMethods()->id != 10}
        <dl>
            <dt>Способ доставки:</dt>
            <dd>{echo $model->getSDeliveryMethods()->getName()}</dd>
        </dl>
        {/if}
        {if $model->getSPaymentMethods()->id != 5}
        <dl>
            <dt>Способ оплаты:</dt>
            <dd>{echo $model->getSPaymentMethods()->getName()}</dd>
        </dl>
        {/if}
    </div>

    <div class="spLine"></div>

    <table class="cartTable" width="100%">
        <thead align="left">
        <th>{echo ShopCore::t('Товар')}</th>
        <th></th>
        <th>{echo ShopCore::t('Цена')}</th>
        <th>{echo ShopCore::t('Количество')}</th>
        <th class="ctLastElement">{echo ShopCore::t('Сумма')}</th>
        </thead>
        <tbody>
            {foreach $model->getSOrderProductss() as $item}
            {$total = $total + $item->getQuantity() * $item->toCurrency()}
            {$product = $item->getSProducts()}            
            <tr>
                <td style="width:90px;">                
                    {if getAddMainImg($item->variant_id)}
                    <img src="{productImageUrl(getAddMainImg($item->variant_id))}" border="0" alt="image" width="90" style="margin-right: 10px;" />
                    {else:}
                    <img src="{productImageUrl($product->getSmallImage())}" border="0" alt="image" width="90" style="margin-right: 10px;" />
                    {/if}                
                </td>
                <td class="prodName">
                    <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($item->getVariantName())}</a>
                </td>
                <td>{echo $item->toCurrency()} {$CS}</td>
                <td>
                    {echo $item->getQuantity()} шт.
                </td>
                <td>{echo my_money_format('',$item->getQuantity() * $item->toCurrency())} {$CS}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>

    <div id="total">
        <span class="value" id="totalPriceText">
            {if $total >= $deliveryMethod->getFreeFrom()}
            {echo my_money_format('',$total)}
            {else:}
            {echo my_money_format('',$total + $model->getDeliveryPrice())}
            {/if}
            <span class="currency"> {$CS}</span>
        </span>
        <span class="label">
            {echo ShopCore::t('Итог:')}
        </span>
    </div>
</div>