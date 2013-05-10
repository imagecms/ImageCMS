{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}
<div class="content_head">
    <h1>Заказ №{echo $model->getId()}</h1>
    {if $CI->session->flashdata('makeOrder') === true}<h2>Спасибо за Ваш заказ.</h2>{/if}
</div>
<table class="tableOrderData">
    <!-- Start. Render Order number -->
    <tr>
        <th>{lang('s_order')} #:</th>
        <td>{echo ShopCore::encode($model->getId())}</td>
    </tr>
    <!-- End. Render Order number -->

    <!-- Start. Display Paid status -->
    <tr>
        <th>{lang('s_paid')}:</th>
        <td>{if $model->getPaid() == true} {lang('s_yes')}{else:}{lang('s_no')}{/if}</td>
    </tr>
    <!-- End. Display Paid status -->

    <!-- Start. Show Order status name -->
    <tr>
        <th>{lang('s_status')}:</th>
        <td>{echo SOrders::getStatusName('Id', $model->getStatus())}</td>
    </tr>
    <!-- End. Show Order status name -->

    <!-- Start. Render certificate -->
    {if $model->getGiftCertKey() != null}
    <tr>
        <th>{lang('s_do_you_cer_tif')}: </th>
        <td>-{echo $model->getGiftCertPrice()} {$CS}</td>
    </tr>
    {/if}
    <!-- End. Render certificate -->

    <!-- Start. Delivery Method name -->
    {if $model->getDeliveryMethod() > 0}
    <tr>
        <th>{lang('s_dostavka')}:</th>
        <td>{echo $model->getSDeliveryMethods()->getName()}</td>
    </tr>
    {/if}
    <!-- End. Delivery Method name -->

    <!-- Start. Render payment button and payment description -->
    {if $model->getPaid() != true && $model->getTotalPriceWithGift() > 0}
    <tr class="b_n">
        <th></th>
        <td>{echo $paymentMethod->getPaymentForm($model)}
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
    <li> 
        <div class="top_frame_tov">
            <span class="figure">
                <a href="{shop_url('product/' . $product->getUrl())}">
                    <img src="{productImageUrl($product->getSmallModimage())}"/>
                </a>
            </span>
            <span class="descr">
                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                <span class="d_b price">{echo $item->getPrice()} {$CS}</span>
                <span class="count">{echo $item->getQuantity()} шт.</span>
            </span>
        </div>  
    </li>
    {/foreach}
</ul>
<div class="main_frame_inside">
    <div class="gen_sum">
        <span class="total_pay">Всего к оплате:</span>
        <span class="price">
            {echo $total} {$CS}
        </span>
    </div>
</div>