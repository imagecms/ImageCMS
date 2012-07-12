{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}
<div class="content">
    <div class="center">
        <h1>Личный кабинет</h1>
        {if $CI->session->flashdata('makeOrder') === true}<div style="padding:10px;border: 1px #f5f5dc solid;">Спасибо за Ваш заказ.</div>{/if}
        <table class="cleaner_table" cellspacing="0">
            <caption>Заказ №{echo $model->getId()}</caption>
            <colgroup>
                <col span="1" width="120">
                <col span="1" width="400">
                <col span="1" width="165">
                <col span="1" width="140">
                <col span="1" width="160">
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
                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo_block">
                            <img src="{productImageUrl($product->getSmallModimage())}" border="0" alt="{echo ShopCore::encode($product->getName())}"/>
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
                            <img src="{productImageUrl($product->getSmallModimage())}" border="0" alt="{echo ShopCore::encode($product->getName())}"/>
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
                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo_block">
                            <img src="{productImageUrl($product->getSmallModimage())}" alt="{echo ShopCore::encode($product->getName())}"/>
                        </a>
                    </td>
                    <td>
                        <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> {$item->getVariantName()}
                    </td>
                    <td>
                        <div class="price f-s_16 f_l">{echo $item->toCurrency()}<sub> {$CS}</sub><span class="d_b">{echo $item->toCurrency('Price', $NextCSId)} {$NextCS}</span></div>
                    </td>
                    <td>
                        <div class="count">
                            {echo $item->getQuantity()} шт.
                        </div>
                    </td>
                    <td>
                        <div class="price f-s_18 f_l">{echo $item->getQuantity() * $item->toCurrency()} <sub> {$CS}</sub><span class="d_b">{echo $item->toCurrency('Price', $NextCSId)} {$NextCS}</span></div>
                    </td>
                </tr>
                {/if}
                {/foreach}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="foot_cleaner">
                            <div class="f_r">
                                <div class="price f-s_26 f_l" style="margin-top: 25px;">
                                    {if $total >= $deliveryMethod->getFreeFrom()}
                                    {echo $total} {$CS}
                                    {else:}{echo $total + $model->getDeliveryPrice()} {$CS}{/if}</div>
                            </div>
                            <div class="f_l" style="width: 775px;">
                                <ul class="info_curr_buy f_l" >
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
                                    {if $paymentMethods[0] != null && !$model->getPaid()}
                                    <li><span>Оплата:</span>
                                        <b>
                                            <div class="sp"></div>
                                            <ul>
                                                {foreach $paymentMethods as $pm}
                                                <li class="buyandpay">
                                                    <label><b>{echo encode($pm->getName())}</b></label>
                                                    <div>{echo $pm->getPaymentForm($model)} </div>
                                                    {echo $pm->getDescription()}

                                                </li>
                                                {/foreach}
                                            </ul>
                                        </b>
                                    </li>
                                    {/if}
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






