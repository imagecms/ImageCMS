{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}
{$cartPrice = $model->gettotalprice()}
{$discount = ShopCore::app()->SCurrencyHelper->convert($model->getdiscount())}
<div class="content_head">
    <h1>Заказ №{echo $model->getId()}</h1>
    {if $CI->session->flashdata('makeOrder') === true}<h2>{lang('Спасибо за Ваш заказ','commerce_mobiles')}.</h2>{/if}
</div>
<table class="tableOrderData">
    <!-- Start. Render Order number -->
    <tr>
        <th>{lang('Заказ','commerce_mobiles')} #:</th>
        <td>{echo ShopCore::encode($model->getId())}</td>
    </tr>
    <!-- End. Render Order number -->

    <!-- Start. Display Paid status -->
    <tr>
        <th>{lang('Оплачен','commerce_mobiles')}:</th>
        <td>{if $model->getPaid() == true} {lang('Да','commerce_mobiles')}{else:}{lang('Нет','commerce_mobiles')}{/if}</td>
    </tr>
    <!-- End. Display Paid status -->

    <!-- Start. Show Order status name -->
    <tr>
        <th>{lang('Статус','commerce_mobiles')}:</th>
        <td>{echo SOrders::getStatusName('Id', $model->getStatus())}</td>
    </tr>
    <!-- End. Show Order status name -->

    <!-- Start. Show address -->
    {if $model->getUserDeliverTo()}
        <tr>
            <th>{lang('Адрес','commerce_mobiles')}:</th>
            <td>{echo $model->getUserDeliverTo()}</td>
        </tr>
    {/if}
    <!-- End. Show address -->

    <!-- Start. Render certificate -->
    {if $model->getGiftCertKey() != null}
        <tr>
            <th>{lang('Подарочний сертификат','commerce_mobiles')}: </th>
            <td>-{echo $model->getGiftCertPrice()} {$CS}</td>
        </tr>
    {/if}
    <!-- End. Render certificate -->
    {if $discount}
        <tr>
            <th>{lang('Ваша текущая скидка','commerce_mobiles')}: </th>
            <td>-{echo $discount} {$CS}</td>
        </tr>
    {/if}


    <!-- Start. Delivery Method name -->
    {$deliveryMethod = $model->getSDeliveryMethods()}
    {if $deliveryMethod}
        <tr>
            <th>{lang('Доставка','commerce_mobiles')}:</th>
            <td>{echo $model->getSDeliveryMethods()->getName()}</td>
        </tr>
        {$priceDelFreeFrom = ceil($deliveryMethod->getFreeFrom())}

        {if $cartPrice < $priceDelFreeFrom}
            {$cartPrice += $priceDel}
        {/if}
    {/if}
    <!-- End. Delivery Method name -->

    <!-- Start. Render payment button and payment description -->
    {if $model->getPaid() != true && $model->getTotalPriceWithGift() > 0 && $paymentMethod != null}
        <tr class="b_n">
            <th></th>
            <td>
                {echo $paymentMethod->getPaymentForm($model)}
                {if $paymentMethod->getDescription()}
                    <div class="m-t_10" style="font-style: italic">{echo ShopCore::t($paymentMethod->getDescription())}</div>
                {/if}
            </td>
        </tr>
    {/if}
    <!-- End. Render payment button and payment description -->

</table>
<ul class="catalog">
    {foreach $model->getSOrderProductss() as $item}
        {$total = $total + $item->getQuantity() * $item->toCurrency()}
        {$product = $item->getSProducts()}
        {$variants = $product->getProductVariants()}
        {foreach $variants as $v}
            {if $v->getId() == $item->variant_id}
                {$variant = $v}
            {/if}
        {/foreach}
        <li>
            <div class="top_frame_tov">
                <span class="figure">
                    <a href="{mobile_url('product/' . $product->getUrl())}">
                        <img src="{echo $variant->getMediumPhoto()}"/>
                    </a>
                </span>
                <span class="descr">
                    <a href="{mobile_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                    {if $variant->getName()}
                        <span class="code_v">{lang('Вариант', 'commerce_mobiles')}: {echo $variant->getName()}</span>
                    {/if}
                    {if $variant->getNumber()}
                        <span class="divider">/</span>
                        <span class="code">{lang('Артикул', 'commerce_mobiles')}: {echo $variant->getNumber()}</span>
                    {/if}
                    <span class="d_b price">{echo $item->getPrice()} {$CS}</span>
                    <span class="count">{echo $item->getQuantity()} шт.</span>
                </span>
            </div>
        </li>
    {/foreach}
</ul>
<div class="main_frame_inside">
    <div class="gen_sum">
        <span class="total_pay">{lang('Всего к оплате','commerce_mobiles')}:</span>
        <span class="price">
            {echo $cartPrice} {$CS}
        </span>
    </div>
</div>