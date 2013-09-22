{if count($items) > 0}
    <div class="content_head">
        <h1>Оформление заказа</h1>
        <p class="alert">Способ оплаты и доставки вы сможете согласовать с менеджером, который свяжется с вами после оформления заказа.</p>
    </div>
    <hr class="head_cle_foot"/>
    <form method="post" action="{site_url(uri_string())}" id="cartForm">
        <div class="main_frame_inside">
            {if validation_errors()}
                <label><span class="red d_b">{validation_errors()}</span></label>
                {/if}
            <label>
                {lang('Имя','commerce_mobiles_new')}:<span class="must">*</span>
                <input type="text" name="userInfo[fullName]" value="{$profile.name}" />
            </label>
            <label>
                {lang('Е-mail','commerce_mobiles_new')}:<span class="must">*</span>
                <input type="text" name="userInfo[email]" value="{$profile.email}"/>
            </label>
            <label>
                {lang('Телефон','commerce_mobiles_new')}:
                <input type="text" name="userInfo[phone]" value="{$profile.phone}" />
            </label>
            <label>
                {lang('Способ доставки','commerce_mobiles_new')}
                <select id="method_deliv" name="deliveryMethodId">
                    {foreach $deliveryMethods as $deliveryMethod}
                        {$del_id = $deliveryMethod->getId()}
                        <option
                            {if $counter} selected="selected"
                                {$del_id = $deliveryMethod->getId()}
                                {$counter = false}
                                {$del_price = ceil($deliveryMethod->getPrice())}
                                {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}
                            {/if}
                            name="met_del"
                            class="met_del"
                            value="{echo $del_id}"
                            data-price="{echo ceil($deliveryMethod->getPrice())}"
                            data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}">
                            {echo $deliveryMethod->getName()}
                        </option>
                    {/foreach}
                </select>
            </label>

            {if count($paymentMethods)}
                <label>
                    {lang('Способ оплаты','commerce_mobiles_new')}
                    {foreach $deliveryMethods as $dm}
                        <select id="paymentMethod{echo $dm->getId()}">
                            {$counter = true}
                            {foreach $dm->getPaymentMethodss() as $pm}
                                <option value="{echo $pm->getId()}">
                                    {echo $pm->getName()}
                                </option>
                            {/foreach}
                        </select>
                    {/foreach}
                    <input type="hidden" name="paymentMethodId" >
                </label>
            {/if}
            <label>
                Коментарий к заказу:
                <textarea name="userInfo[commentText]"></textarea>
            </label>
        </div>
        <div class="main_f_i_f-r"></div>
        <div class="content_head">
            <div class="title_h1">{lang('Ваш заказ','commerce_mobiles_new')}</div>
        </div>
        <ul class="catalog">
            {foreach $items as $key=>$item}
                {$variants = $item.model->getProductVariants()}
                {foreach $variants as $v}
                    {if $v->getId() == $item.variantId}
                        {$variant = $v}
                    {/if}
                {/foreach}
                <li>
                    <div class="top_frame_tov">
                        <a href="{shop_url('product/' . $item.model->getUrl())}" class="t-d_n">
                            <span class="figure">
                                <img src="{echo $variant->getMainPhoto()}"/>
                            </span>
                            <span class="descr">
                                <span class="title">{echo ShopCore::encode($item.model->getName())}</span>
                                {if $item.variantName}
                                    <span class="code_v">{lang('Варіант','commerce_mobiles_new')}: {echo $item.variantName}</span>
                                {/if}
                                {if $variant->getNumber()}
                                    <span class="divider">/</span>
                                    <span class="code">{lang('Артикул','commerce_mobiles_new')}: {echo $variant->getNumber()}</span>
                                {/if}
                                <input name="products[{$key}]" type="hidden" value="{$item.quantity}"/>
                                <span class="d_b price">{$summary = $variant->getPrice() * $item.quantity}{echo $summary} {$CS}</span>
                            </span>
                        </a>
                        <span class="descr">
                            <a href="{shop_url('cart/delete/'.$key)}" class="remove_ref red"><span>×</span> Удалить</a>
                            <input type="text"
                                   price="{echo $variant->getPrice()}"
                                   value="{$item.quantity}"
                                   readonly="readonly"
                                   onblur=""/>
                            <span class="count">шт.</span>
                        </span>
                    </div>
                </li>
                {$total     += $summary}
                {$total_nc  += $summary_nextc}
            {/foreach}
        </ul>
        <div class="main_frame_inside">
            <div class="gen_sum">
                <span class="total_pay">Всего к оплате:</span>
                <span class="price">
                    {if $total < $item.delivery_free_from}
                        {$total += $item.delivery_price}
                    {/if}
                    {if isset($item.gift_cert_price)}
                        {$total -= $item.gift_cert_price}
                    {/if}
                    {echo $total} {$CS}
                </span>
            </div>
            <span class="but_buy inp">
                <span class="b_buy_in">
                    <span class="helper"></span>
                    <input type="submit"
                           value="Оформить заказ"
                           class="v-a_m"/>
                </span>
            </span>
        </div>
        <!-- <input type="hidden" name="userInfo[email]" value="mobile@device.order" /> -->
        <input type="hidden" name="setOrderMobile" value="1"/>
        <input type="hidden" name="makeOrder" value="1"/>
        {form_csrf()}
    </form>
    <div class="main_f_i_f-r"></div>
{else:}
    <div class="content_head">
        <h1>Оформление заказа</h1>
    </div>
    <div class="main_frame_inside">
        <div class="gen_sum">
            <span class="total_pay">{echo ShopCore::t('Корзина пуста')}</span>
        </div>
    </div>
{/if}