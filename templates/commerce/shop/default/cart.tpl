<div class="center content">
    <h1>{lang('orderind_shop_sg')}</h1>
    {if count($items) > 0}
        <form method="post" action="{site_url(uri_string())}" id="cartForm">
            <div class="order-cleaner">
                <table class="cleaner_table forCartProducts" cellspacing="0">
<!--                    <caption>{lang('s_cart')}</caption>-->
                    <colgroup>
                        <col span="1" width="120">
                        <col span="1" width="390">
                        <col span="1" width="160">
                        <col span="1" width="140">
                        <col span="1" width="160">
                        <col span="1" width="25">
                    </colgroup>
                    <tbody>
                        {foreach $items as $key=>$item}
                            {if $item.model instanceof SProducts}
                                {$variants = $item.model->getProductVariants()}
                                {foreach $variants as $v}
                                    {if $v->getId() == $item.variantId}
                                        {$variant = $v}
                                    {/if}
                                {/foreach}
                                <tr>
                                    <td>
                                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                                            <img src="{if count($variants)>1 && $variant->getSmallImage() != ''}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($item.model->getMainModimage())}{/if}" alt="{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                                    </td>
                                    <td>
                                        <div class="price f-s_16 f_l">{echo $variant->getPrice()} <sub>{$CS}</sub>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="count">
                                            <input name="products[{$key}]" type="text" value="{$item.quantity}"/>
                                            <span class="plus_minus">
                                                <button class="count_up inCartProducts">&#9650;</button>
                                                <button class="count_down inCartProducts">&#9660;</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price f-s_18 f_l">{$summary = $variant->getPrice() * $item.quantity}
                                            {echo $summary}
                                            <sub>{$CS}</sub>
                                            <span id="allpriceholder" data-summary="{echo $summary}"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{shop_url('cart/delete/'.$key)}" class="delete_text inCartProducts">&times;</a>
                                    </td>
                                </tr>
                            {elseif($item.model instanceof ShopKit):}
                                <tr>
                                    <td style="width:90px;padding:2px;">

                                        {if $item.model->getMainProduct()->getMainImage()}
                                            <a href="{shop_url('product/' . $item.model->getProductId())}" class="photo_block">
                                                <img src="{productImageUrl($item.model->getMainProduct()->getId() . '_main.jpg')}" border="0"  width="100" />
                                            </a>                                        
                                        {/if}                                   
                                    </td>
                                    <td>
                                        <a href="{shop_url('product/' . $item.model->getMainProduct()->getUrl())}">{echo ShopCore::encode($item.model->getMainProduct()->getName())}</a> {echo ShopCore::encode($item.model->getMainProduct()->firstVariant->getName())}
                                        <br /><span style="font-size:16px;">{echo $item.model->getMainProduct()->firstVariant->toCurrency()} {$CS}</span>
                                    </td>
                                    <td rowspan="{echo $item.model->countProducts()}">
                                        {//echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {//$CS}                              
                                        {echo $item.price} {$CS}                              
                                    </td>
                                    <td rowspan="{echo $item.model->countProducts()}">
                                        <div class="count">
                                            <input type="text" name="products[{$key}]" value="{$item.quantity}">
                                            <span class="plus_minus">
                                                <button class="count_up inCartProducts">&#9650;</button>
                                                <button class="count_down inCartProducts">&#9660;</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td rowspan="{echo $item.model->countProducts()}">
                                        {echo $summary = ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} {$CS}
                                    </td>
                                    <td rowspan="{echo $item.model->countProducts()}"><a href="{shop_url('cart/delete/' . $key)}" rel="nofollow" class="delete_text inCartProducts">&times;</a></td>
                                </tr>
                                {foreach $item.model->getShopKitProducts() as $shopKitProduct}
                                    {$ap = $shopKitProduct->getSProducts()}
                                    {$ap->setLocale(ShopController::getCurrentLocale())}
                                    {$kitFirstVariant = $ap->getKitFirstVariant($shopKitProduct)}
                                    <tr>
                                        <td style="width:90px;padding:2px;">
                                            {if $ap->getMainImage()}
                                                <a href="{shop_url('product/' . $ap->getId())}" class="photo_block">
                                                    <img src="{productImageUrl($ap->getId() . '_main.jpg')}" border="0" width="100" alt="{echo ShopCore::encode($ap->getName())}" />                                                
                                                </a>
                                            {/if}                      
                                        </td>
                                        <td>
                                            <a href="{shop_url('product/' . $ap->getUrl())}">{echo ShopCore::encode($ap->getName())}</a> 
                                            {echo ShopCore::encode($kitFirstVariant->getName())}
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
                        {$total += $summary}
                        {$total_nc += $summary_nextc}
                    {/foreach}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="foot_cleaner">
                                    <div class="f_r">
                                        {if $NextCS == $CS}
                                            <div class="price f-s_26_lh_50 f_l">
                                            {else:}
                                                <div class="price f-s_26 f_l">
                                                {/if}
                                                <div class="price f-s_26 f_l">
                                                    {if $total < $item.delivery_free_from}
                                                        {$total += $item.delivery_price}
                                                    {/if}
                                                    {if isset($item.gift_cert_price)}
                                                        {$total -= $item.gift_cert_price}
                                                    {/if}
                                                    {echo $total}
                                                    <sub>{$CS}</sub>
                                                {if $item.delivery_price > 0}<span style="font-size:16px;">{lang('s_delivery')}: {echo $item.delivery_price} {$CS}</span>{/if}
                                            {if $item.gift_cert_price > 0}<span style="font-size:16px;">{lang('s_do_you_syrp_pr')}: {echo $item.gift_cert_price} {$CS}</span>{/if}
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>
            </tfoot>
            <input type="hidden" name="forCart" value ="1"/>

        </table>
    </div>
    <div class="order-cleaner clearfix">
        <div class="f_l method_deliver_buy">
            {if ShopCore::app()->SSettings->__get('usegifts') == 1}
                <div class="block_title_18"><span class="title_18">{lang('s_do_you_have')}</span></div>
                <label>
                    <input type="text" name="giftcert" id="giftcertkey"/>
                    <input type="button" name="giftcert" value="{lang('s_apply_sertif')}" class="giftcertcheck"/>
                </label>
            {/if}
            <div class="block_title_18"><span class="title_18">{lang('s_sdm')}</span></div>
                {$counter = true}
                {foreach $deliveryMethods as $deliveryMethod}
                    {$del_id = $deliveryMethod->getId()}
                <label>
                    <input type="radio" 
                           {if $counter} checked="checked" 
                               {$del_id = $deliveryMethod->getId()} 
                               {$counter = false}
                               {$del_price = ceil($deliveryMethod->getPrice())}
                               {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}
                           {/if} 
                           name="met_del" 
                           class="met_del" 
                           value="{echo $del_id}" 
                           data-price="{echo ceil($deliveryMethod->getPrice())}" 
                           data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"/>
                    {echo $deliveryMethod->getName()}
                </label>
            {/foreach}

            <!--    Show payment methods    -->
            {if sizeof($paymentMethods) > 0}
                <div class="block_title_18"><span class="title_18">{lang('s_spm')}</span></div>
                <div id="paymentMethods">
                    {$counter = true}
                    {foreach $paymentMethods as $paymentMethod}
                        <label>
                            <input type="radio"
                                   {if $counter} checked="checked"
                                       {$counter = false}
                                       {$pay_id = $paymentMethod->getId()}
                                   {/if} 
                                   name="met_buy" 
                                   class="met_buy" 
                                   value="{echo $pay_id}" />
                            {echo $paymentMethod->getName()}
                        </label>                        
                    {/foreach}
                </div>
            {/if}            
            <!--    Show payment methods    -->
        </div>
        <div class="addres_recip f_r">
            <div class="block_title_18">
                {if validation_errors()}
                    <div class="foot_cleaner red" style="background-color: #FFBFBF;border: 1px solid #FF0400;padding: 0 7px">{validation_errors()}</div>
                {/if}
                <span class="title_18">{lang('s_addresrec')}</span>
            </div>
            <div class="label_block">
                <label class="f_l">
                    {if $isRequired['userInfo[fullName]']}
                        <span class="red">*</span>
                    {/if}
                    {lang('s_c_uoy_name_u')}
                    <input type="text"{if $isRequired['userInfo[fullName]']} class="required"{/if} name="userInfo[fullName]" value="{$profile.name}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[email]']}
                        <span class="red">*</span>
                    {/if}
                    {lang('s_c_uoy_user_el')}
                    <input type="text" {if $isRequired['userInfo[email]']} class="required email"{/if} name="userInfo[email]" value="{$profile.email}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[phone]']}
                        <span class="red">*</span>
                    {/if}
                    {lang('s_phone')}
                    <input type="text"{if $isRequired['userInfo[phone]']} class="required"{/if} name="userInfo[phone]" value="{$profile.phone}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[deliverTo]']}
                        <span class="red">*</span>
                    {/if}
                    {lang('s_addresrec')}
                    <input type="text"{if $isRequired['userInfo[deliverTo]']} class="required"{/if} name="userInfo[deliverTo]" value="{echo $profile.address}">
                </label>
            </div>
            <label class="c_b d_b">
                {if $isRequired['userInfo[commentText]']}
                    <span class="red">*</span>
                {/if}
                {lang('s_comment')}
                <textarea{if $isRequired['userInfo[commentText]']} class="required"{/if} name="userInfo[commentText]"></textarea> 
            </label>
            <div>
                {echo ShopCore::app()->CustomFieldsWidgetHelper->renderPartOfFormWithCustomFields(-1, 'order', 'cartCustomData')}
            </div>
        </div>
    </div>
    <div class="foot_cleaner c_b result">
        <span class="v-a_m">
            <span class="c_9 f-s_16">(Сумма товаров: <span class="b" id="price1">{echo $total}</span> {$CS} +   Доставка: <span class="b" id="price2">{echo $deliveryMethod->getPrice()}</span> {$CS})</span>
            <span class="c_3 f-s_18">&nbsp;&nbsp;Сумма товаров: <span class="f-s_26 b" id="price3">{echo $total + $deliveryMethod->getPrice()}</span> {$CS}</span>
        </span>
        <div class="buttons button_big_blue v-a_m">
            <input type="submit" value="{lang('s_c_of_z_')}" id="orderSubmit" data-logged="{if ShopCore::$ci->dx_auth->is_logged_in()===true}1{else:}0{/if}"/>
        </div>
    </div>
    <input type="hidden" name="deliveryMethodId" id="deliveryMethodId" value="{echo $del_id}" />
    <input type="hidden" name="deliveryMethod" value="1" />
    <input type="hidden" name="paymentMethodId" id="paymentMethodId" value="{echo $pay_id}" />
    <input type="hidden" name="paymentMethod" value="5" />
    <input type="hidden" name="makeOrder" value="1" />
    {form_csrf()}
</form>
{else:}
    <div class="comparison_slider">
        <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t(lang('s_cart_empty'))}</div>
    </div>
{/if}
</div>
