{if count($items) > 0}
    <form method="post" action="{$BASE_URL}shop/order/make_order" id="cartForm">
        <div class="content_head">
            <div class="title_h1">{lang('Ваш заказ','commerce_mobiles')}</div>
        </div>
        <ul class="catalog">
            {foreach $items as $item}
                <li>
                    <div class="top_frame_tov">
                        <a href="{echo shop_url('product/'.$item->getSProducts()->getUrl())}" class="t-d_n">
                            <span class="figure">
                                <img src="{echo $item->getSmallPhoto()}"/>
                            </span>
                            <span class="descr">
                                <span class="title">{echo $item->getSProducts()->getName()}</span>
                                {if $item->getName() && trim($item->getName()) != trim($item->getSProducts()->getName())}
                                    <span class="code_v">{lang('Варіант','commerce_mobiles')}: {echo trim($item->getName())}</span>
                                {/if}
                                {if $item->getNumber()}
                                    <span class="divider">/</span>
                                    <span class="code">{lang('Артикул','commerce_mobiles')}: {echo $item->getNumber()}</span>
                                {/if}
                                <input name="products[{echo $item->quantity}]" type="hidden" value="{echo $item->quantity}"/>
                                <span class="d_b price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price * $item->quantity)} {$CS}</span>
                            </span>
                        </a>
                        <span class="descr">
                            <a href="{shop_url('cart/removeProductByVariantId/'.$item->id)}" class="remove_ref red"><span>×</span> Удалить</a>
                            <input type="text"
                                   name="products[{echo $item->quantity}]"
                                   price="{echo $item->price}"
                                   value="{echo $item->quantity}"
                                   data-id="{echo $item->id}"
                                   autocomplete="off"
                                   onblur=""/>
                            <span class="frame_count">
                                <span class="refresh_price"></span>
                                <span class="count">шт.</span>
                            </span>

                        </span>
                    </div>
                </li>
            {/foreach}
        </ul>
        <div class="main_frame_inside">
            <div class="gen_sum">
                {if $discount_val}
                    Скидка: {echo ShopCore::app()->SCurrencyHelper->convert($discount_val)} {$CS} <br/>
                {/if}
                <span class="total_pay">Всего к оплате:</span>

                <span class="price">
                    {echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)} {$CS} 
                </span>
            </div>
        </div>
        <div class="main_f_i_f-r"></div>
        <div class="content_head">
            <h1>Оформление заказа</h1>
            <p class="alert">Способ оплаты и доставки вы сможете согласовать с менеджером, который свяжется с вами после оформления заказа.</p>
        </div>
        <hr class="head_cle_foot"/>
        <div class="main_frame_inside">
            {if validation_errors()}
                <label><span class="red d_b">{validation_errors()}</span></label>
                {/if}
            <label>
                {lang('Имя','commerce_mobiles')}:<span class="must">*</span>
                <input type="text" name="userInfo[fullName]" value="{$profile.name}" />
            </label>
            <label>
                {lang('Е-mail','commerce_mobiles')}:<span class="must">*</span>
                <input type="text" name="userInfo[email]" value="{$profile.email}"/>
            </label>
            <label>
                {lang('Телефон','commerce_mobiles')}:
                <input type="text" name="userInfo[phone]" value="{$profile.phone}" />
            </label>
            <label>
                {lang('Способ доставки','commerce_mobiles')}
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
                    {lang('Способ оплаты','commerce_mobiles')}
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
        <div class="main_frame_inside">

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
        <input id="recount" type="hidden" name="recount" value="0" />
        <!-- <input type="hidden" name="setOrderMobile" value="1"/>-->
        <input id="makeOrderMobile" type="hidden" name="makeOrder" value="1"/>
        {form_csrf()}
    </form>
    <div class="main_f_i_f-r"></div>
{else:}
    <div class="main_frame_inside">
        <div class="gen_sum">
            <span class="total_pay">{echo ShopCore::t('Корзина пуста')}</span>
        </div>
    </div>
{/if}