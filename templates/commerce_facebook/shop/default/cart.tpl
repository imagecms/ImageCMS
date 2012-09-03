<div class="center">    
    <h1>Оформление заказа</h1>
    {if count($items) > 0}
    <form method="post" action="{site_url(uri_string())}" id="cartForm">
        
        <table class="cleaner_table forCartProducts" cellspacing="0">
            <caption>Корзина</caption>
            <colgroup>
                <col span="1" width="120">
                <col span="1" width="396">
                <col span="1" width="160">
                <col span="1" width="140">
                <col span="1" width="160">
                <col span="1" width="25">
            </colgroup>
            <tbody>
                {foreach $items as $key=>$item}
                {$variants = $item.model->getProductVariants()}
                {foreach $variants as $v}
                    {if $v->getId() == $item.variantId}
                        {$variant = $v}
                    {/if}
                {/foreach}
                {$vprices = currency_convert($variant->getPrice(), $variant->getCurrency())}
                <tr>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                            <img src="{if count($variants)>1}{productImageUrl($variant->getsmallimage())}{else:}{productImageUrl($item.model->getMainModimage())}{/if}" alt="{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}"/>
                        </a>
                    </td>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}{if count($variants)>1} - {echo ShopCore::encode($variant->name)}{/if}</a>
                    </td>
                    <td>
                        <div class="price f-s_16 f_l">{echo $vprices.main.price} <sub>{$vprices.main.symbol}</sub>
                            <!--<span class="d_b">{echo $item.model->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>-->
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
                        <div class="price f-s_18 f_l">{$summary = $vprices.main.price * $item.quantity}
                                                {echo $summary}
                            <sub>{$vprices.main.symbol}</sub>
                            <!--<span class="d_b">{echo $summary_nextc = $item.model->firstVariant->toCurrency('Price', $NextCSId) * $item.quantity} {$NextCS}</span>-->
                        </div>
                    </td>
                    <td>
                        <a href="{shop_url('cart/delete/'.$key)}" class="delete_text inCartProducts">&times;</a>
                    </td>
                </tr>
                {$total     += $summary}
                {$total_nc  += $summary_nextc}
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
                                    {if isset($item.delivery_price)}
                                        {$dprice =  currency_convert($item.delivery_price, Null)}
                                        {$item.delivery_price = $dprice.main.price}
                                    {/if}
                                    {if $total < $item.delivery_free_from}
                                    {$total += $item.delivery_price}
                                    {/if}
                                    {if isset($item.gift_cert_price)}
                                        {$cprice = currency_convert($item.gift_cert_price, Null)}
                                        {$item.gift_cert_price = $cprice.main.price}
                                        {$total -= $item.gift_cert_price}
                                    {/if}
                                    {echo $total}
                                    <sub>{$CS}</sub>
                                    {if $item.delivery_price > 0}<span style="font-size:16px;">Доставка: {echo $item.delivery_price} руб</span>{/if}
                                    {if $item.gift_cert_price > 0}<span style="font-size:16px;">Подарочный сертификат: {echo $item.gift_cert_price} руб</span>{/if}
                                    <!--<span class="d_b">{$total_nc} {$NextCS}</span>-->
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <input type="hidden" name="forCart" value ="1"/>
        </table>
        <div class="f_l method_deliver_buy">
            {if ShopCore::app()->SSettings->__get('usegifts') == 1}
                <div class="block_title_18"><span class="title_18">У Вас есть подарочный сертификат?</span></div>
                    <label>
                        <input type="text" name="giftcert" id="giftcertkey"/>
                        <input type="button" name="giftcert" value="Применить" class="giftcertcheck"/></label>
                    
            {/if}
            <div class="block_title_18"><span class="title_18">Выберите способ доставки</span></div>
            
            {$counter = true}
            {foreach $deliveryMethods as $deliveryMethod}
            {literal}
            {$del_id = $deliveryMethod->getId()}
            <label><input type="radio" {if $counter} checked="checked" {$del_id = $deliveryMethod->getId()} {$counter = false}{$del_price = ceil($deliveryMethod->getPrice())}{$del_freefrom = ceil($deliveryMethod->getFreeFrom())}{/if} name="met_del" class="met_del" value="{echo $del_id}" data-price="{echo ceil($deliveryMethod->getPrice())}" data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"/>{echo $deliveryMethod->getName()}</label>
            {/foreach}

            <!--    Show payment methods    -->
            {if sizeof($paymentMethods) > 0}
            <div class="block_title_18"><span class="title_18">Выберите способ оплаты</span></div>
            <div id="paymentMethods">
                {$counter = true}
                {foreach $paymentMethods as $paymentMethod}
                    
                <label>
                    <input type="radio"{if $counter} checked="checked"{$counter = false}{$pay_id = $paymentMethod->getId()}{/if} name="met_buy" class="met_buy" value="{echo $pay_id}" />{echo $paymentMethod->getName()}
                </label>                        
                
                {/foreach}
            </div>
            {/if}            
            <!--    Show payment methods    -->

        </div>
        <div class="addres_recip f_r">
            <div class="block_title_18">
                {}
                {if validation_errors()}
                <div class="foot_cleaner red" style="background-color: #FFBFBF;border: 1px solid #FF0400;padding: 0 7px">{validation_errors()}</div>
                {/if}
                <span class="title_18">Адрес получателя</span></div>
            <div class="label_block">
                <label class="f_l">
                    {if $isRequired['userInfo[fullName]']}
                    <span class="red">*</span>
                    {/if}
                    Ваше имя
                    <input type="text"{if $isRequired['userInfo[fullName]']} class="required"{/if} name="userInfo[fullName]" value="{$profile.name}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[email]']}
                    <span class="red">*</span>
                    {/if}
                    Электронный адрес
                    <input type="text"{if $isRequired['userInfo[email]']} class="required email"{/if} name="userInfo[email]" value="{$profile.email}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[phone]']}
                    <span class="red">*</span>
                    {/if}
                    Телефон
                    <input type="text"{if $isRequired['userInfo[phone]']} class="required"{/if} name="userInfo[phone]" value="{$profile.phone}">
                </label>
                <label class="f_l">
                    {if $isRequired['userInfo[deliverTo]']}
                    <span class="red">*</span>
                    {/if}
                    Адрес получателя
                    <input type="text"{if $isRequired['userInfo[deliverTo]']} class="required"{/if} name="userInfo[deliverTo]" value="{echo $profile.address}">
                </label>
            </div>
            <label class="c_b d_b">
                {if $isRequired['userInfo[commentText]']}
                    <span class="red">*</span>
                    {/if}
                Комментарий
                <textarea{if $isRequired['userInfo[commentText]']} class="required"{/if} name="userInfo[commentText]"></textarea> 
            </label>
            
            <div>
                {echo ShopCore::app()->CustomFieldsWidgetHelper->renderPartOfFormWithCustomFields(-1, 'order', 'cartCustomData') }
            </div>
            
        </div>
        <div class="foot_cleaner c_b t-a_c">
            <div class="buttons button_big_blue">
                <input type="submit" value="Оформить заказ"/>
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
            <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t('Корзина пуста')}</div>
        </div>
    {/if}
</div>