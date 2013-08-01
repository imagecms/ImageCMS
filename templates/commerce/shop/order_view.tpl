{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}
<div class="content">
    <div class="center">
        <h1>{lang("Private office","admin")}</h1>
    {if $CI->session->flashdata('makeOrder') === true}<div style="padding:10px;border: 1px #f5f5dc solid;">{lang("Thank you for your order.","admin")}</div>{/if}
    <div class="foot_cleaner">
        <ul class="info_curr_buy">
            <li>
                <span>{lang("Paid","admin")}:</span>
                <b>{if $model->getPaid() == true} {lang("Yes","admin")}{else:}{lang("No","admin")}{/if}</b>
            </li>
            <li>
                <span>{lang("Status","admin")}:</span>
                <b>{echo SOrders::getStatusName('Id',$model->getStatus())} {if $model->getDeliveryMethod() > 0}</b>
            </li>                                   
            {if $model->getGiftCertKey() != null}
                <li>
                    <span>{lang("Certificate","admin")}: </span>
                    <b>-{echo $model->getgiftCertPrice()} {$CS}</b>
                </li>
            {/if}                                    
            {if count($discountCom)}
                <li>
                    <span>Скидка: </span>
                    <b>(-{echo $model->getComulativ()}%)
                    </b>
                </li>
            {/if}
            <li>
                <span>{lang("Delivery","admin")}:</span>
                <b>{echo $model->getSDeliveryMethods()->getName()}{/if}</b>
            </li>
            {if $paymentMethods[0] != null && !$model->getPaid()}
                <li><span>{lang("Payment","admin")}:</span>
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
    </div>
    <div class="order-cleaner">
        <table class="cleaner_table" cellspacing="0">
            <caption>{lang("Order","admin")} №{echo $model->getId()}</caption>
            <colgroup>
                <col span="1" width="120">
                <col span="1" width="412">
                <col span="1" width="165">
                <col span="1" width="140">
                <col span="1" width="160">
            </colgroup>
            <tbody>
                {foreach $model->getSOrderProductss() as $item}
                    {$total = $total + $item->getQuantity() * $item->toCurrency()}
                    {$product = $item->getSProducts()}
                    {$variants = $item->getSProducts()->getProductVariants()}
                    {foreach $variants as $v}
                        {if $v->getId() == $item->getVariantId()}
                            {$variant = $v}
                        {/if}
                    {/foreach}                   
                    {if $item->getKitId() > 0}
                        {if $item->getIsMain()}
                            <tr>
                                <td>
                                    {if $product->getmainimage()}
                                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo_block">
                                            <img src="{productImageUrl($product->getSmallModimage())}" border="0" alt="{echo ShopCore::encode($product->getName())}"/>
                                        </a>
                                    {/if}
                                </td>
                                <td>
                                    <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> 
                                </td>
                                <td>{echo $item->toCurrency()} {$CS}</td>
                                <td rowspan="{echo $kits[$item->getKitId()]['total']}">
                                    {echo $item->getQuantity()} {lang("Pcs","admin")}.
                                </td>
                                <td rowspan="{echo $kits[$item->getKitId()]['total']}">
                                    {echo $item->getQuantity() * $item->toCurrency()} {$CS}  
                                </td>
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
                                    <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> 
                                </td>
                                </td>
                                <td>{echo $item->toCurrency()} {$CS}</td>
                            </tr>
                        {$summm += $item->toCurrency()}
                        {/if}
                    {else:}                         
                        <tr>
                            <td>
                                <a href="{shop_url('product/' . $product->getUrl())}" class="photo_block">
                                    <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($product->getSmallModimage())}{/if}" alt="{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                </a>
                            </td>
                            <td>
                                <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a> 
                            </td>
                            <td>
                                <div class="price f-s_16 f_l">{echo $variant->getPrice()}
                                    <sub> {$CS}</sub>
                                </div>
                            </td>
                            <td>
                                <div class="count">
                                    {echo $item->getQuantity()} {lang("Pcs","admin")}.
                                </div>
                            </td>
                            <td> {//echo $summary = ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)}
                                <div class="price f-s_18 f_l">                                  

                                    {echo $item->toCurrency() * $item->getQuantity()}
                                    <sub>{$CS}</sub>
                                </div>
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
                                <div class="price f-s_26 f_l">
                                    {if $model->getgiftcertprice()>0}
                                        {$giftPrice = $model->getgiftcertprice()}
                                        {$total -= $model->getgiftcertprice()}
                                    {/if}
                                    {if $total AND $model->getDeliveryPrice()}
                                        {echo $total + $model->getDeliveryPrice()} {$CS}
                                    {elseif !$model->getDeliveryPrice()}
                                        {echo $total}
                                    {else :}
                                        {echo $total + $model->getDeliveryPrice()} {$CS} 
                                        <div class="price f-s_12">Доставка: +{echo $model->getDeliveryPrice()} {$CS}</div>
                                        {if $giftPrice}
                                            <div class="price f-s_12">Сертификат: -{echo $giftPrice} {$CS}</div>
                                        {/if}
                                    {/if}                                    
                                </div>
                            </div>
                            <div class="f_l" style="width: 250px;">
                                {if $model->getComulativ()}
                                    <div class="sum f_l">
                                        Скидка: 
                                        {echo $model->getComulativ()} %</div>
                                {/if}</div>
                            <div class="sum f_r">
                                {lang("Total","admin")}: 
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>






