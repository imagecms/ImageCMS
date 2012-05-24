<div class="center">    
    <h1>Оформление заказа</h1>
    <form method="post" action="{site_url(uri_string())}">
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
                <tr>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                            <img src="{productImageUrl($item.model->getMainModimage())}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                        </a>
                    </td>
                    <td>
                        <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a>
                    </td>
                    <td>
                        <div class="price f-s_16 f_l">{echo $item.model->firstVariant->toCurrency()} <sub>{$CS}</sub><span class="d_b">{echo $item.model->firstVariant->toCurrency('Price', 1)} $</span></div>
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
                        <div class="price f-s_18 f_l">{echo $summary = $item.model->firstVariant->toCurrency() * $item.quantity} <sub>{$CS}</sub>
                            <span class="d_b">{echo $summary_nextc = $item.model->firstVariant->toCurrency('Price', 1) * $item.quantity} $</span></div>
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
                                <div class="price f-s_26 f_l">{$total} <sub>{$CS}</sub><span class="d_b">{$total_nc} $</span></div>
                            </div>
                            <div class="f_r sum">Сумма:</div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <input type="hidden" name="forCart" />            
        </table>
        <div class="f_l method_deliver_buy">
            <div class="block_title_18"><span class="title_18">Выберите способ доставки</span></div>
            {$counter = true}
            {foreach $deliveryMethods as $deliveryMethod}
            <label><input type="radio" {if $counter} checked="checked"{$counter = false}{$del_price = ceil($deliveryMethod->getPrice())}{$del_freefrom = ceil($deliveryMethod->getFreeFrom())}{/if}{$del_id = $deliveryMethod->getId()} name="met_del" class="met_del" value="{echo $del_id}" data-price="{echo ceil($deliveryMethod->getPrice())}" data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"/>{echo $deliveryMethod->getName()}</label>                
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
            <div class="block_title_18"><span class="title_18">Адрес получателя</span></div>
            <div class="label_block">
                <label class="f_l">
                    Ваше имя
                    <input type="text" name="userInfo[fullName]" value="{$profile.name}">
                </label>
                <label class="f_l">
                    Электронный адрес
                    <input type="text" name="userInfo[email]" value="{$profile.email}">
                </label>
                <label class="f_l">
                    Телефон
                    <input type="text" name="userInfo[phone]" value="{$profile.phone}">
                </label>
                <label class="f_l">
                    Адрес получателя
                    <input type="text" name="userInfo[deliverTo]" value="{echo $profile.address}">
                </label>
            </div>
            <label class="c_b d_b">
                Комментарий
                <textarea name="userInfo[commentText]"></textarea> 
            </label>
        </div>
        <div class="foot_cleaner c_b t-a_c">
            <div class="buttons button_big_blue">
                <input type="submit" value="Оформить заказ"/>
            </div>
        </div>

        <table class="max_w c_b">
            <colgroup span="1" width="80px"></colgroup>
            <colgroup span="1" width="150px"></colgroup>
            <colgroup span="1" width="45px"></colgroup>
            <colgroup span="1" width="145px"></colgroup>
            <colgroup span="1" width="35px"></colgroup>
            <colgroup span="1" width="120px"></colgroup>
            <colgroup span="1" width="145px"></colgroup>
            <colgroup span="1" width="200px"></colgroup>
            <tbody>                
                <tr class="blue_block">
                    <td class="tar fs_18 grey" width="80px">Сумма:</td>
                    <td width="150px">
                        <div class="price f_30">
                            <div class="grn green" id="totalgrn_s">{echo $total} {$CS}</div>
                            <div class="dol green" id="totaldol_s">{echo $total_nc} $</div>
                        </div>
                    </td>
                    <td class="blue3 f_38 f_w_b" width="45px">+</td>
                    <td width="145px" class="t_a_c">
                        <div class="price f_30">
                            <div class="grey f_14 f_w_b">Вартість доставки:</div>
                            <div class="grn green tac"><div class="d_i"><span id="delivery_price">{echo $del_price = ($del_freefrom!=0 && $del_freefrom<$tpr) ? 0 : $del_price}</span> {$CS}</div></div>
                        </div>
                    </td>           
                    <td class="blue3 f_38 f_w_b tar" width="35px">=</td>             
                    <td class="tar fs_18 grey" width="120px">До виплати:</td>
                    <td width="145px">
                        <div class="price f_30">
                            <div class="grn green f_w_b"><span id="gtprice">{echo $tpr + $del_price}</span> {$CS}</div>
                            <div class="dol green"><span id="gtpricev">{echo $tprv + ceil($del_price/$second_v)}</span> $</div>
                        </div>
                    </td>                        
                    <td width="200px">
                        <div class="buttons button_4 f_l">
                            <input type="submit" value="Оформити замовлення"/>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>        
        <input type="hidden" name="deliveryMethodId" id="deliveryMethodId" value="{echo $del_id}">
        <input type="hidden" name="deliveryMethod" value="1">
        <input type="hidden" name="paymentMethodId" id="paymentMethodId" value="{echo $pay_id}">
        <input type="hidden" name="paymentMethod" value="5">
        <input type="hidden" name="makeOrder" value="0">
        {form_csrf()}
    </form>
</div>