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
                                    <span class="code_v">{lang('Вариант','commerce_mobiles')}: {echo trim($item->getName())}</span>
                                {/if}
                                {if $item->getNumber()}
                                    <span class="divider">/</span>
                                    <span class="code">{lang('Артикул','commerce_mobiles')}: {echo $item->getNumber()}</span>
                                {/if}
                                <input name="products[{echo $item->quantity}]" type="hidden" value="{echo $item->quantity}"/>
                                {if ShopCore::app()->SCurrencyHelper->convert($item->originPrice) != ShopCore::app()->SCurrencyHelper->convert($item->price)}
                                    <span class="d_b price" style="color: red; text-decoration: line-through;">
                                        {echo ShopCore::app()->SCurrencyHelper->convert($item->originPrice)} {$CS}
                                    </span>
                                {/if}
                                <span class="d_b price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price)} {$CS}</span>
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
                {if $gift_val}
                    {lang('Подарочный сертификат','commerce_mobiles')}:
                    {echo ShopCore::app()->SCurrencyHelper->convert($gift_val)} {$CS}
                    {if $gift_key}
                        <input type="hidden" name="gift" value="{echo $gift_key}"/>
                        <input type="hidden" name="gift_ord" value="1"/>
                    {/if}
                {elseif $CI->load->module('mod_discount/discount_api')->isGiftCertificat()}
                    <span>{lang('Подарочный сертификат','commerce_mobiles')}:</span>
                    <div class="frame-gift">
                        {if $gift_error}
                            <span class="text-el" style="color:red;">{lang('Неверный код подарочного сертификата', 'commerce_mobiles')}</span><br/>
                        {/if}
                        <input type="text" name="gift" class="inputGift">
                        <div class="subm_filter submitGiftButton">
                            <input id="checkGiftButton" type="button" value="{lang('Применить', 'commerce_mobiles')}" style="cursor: pointer !important;">
                        </div>
                    </div>
                {/if}
                <br/>
                {if $discount_val}
                    {lang('Скидка', 'commerce_mobiles')}: {echo ShopCore::app()->SCurrencyHelper->convert($discount_val)} {$CS} <br/>
                {/if}
                <span class="total_pay">{lang('Всего к оплате', 'commerce_mobiles')}:</span>
                <span class="price">
                    {echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)} {$CS} 
                </span>
            </div>
        </div>
        <div class="main_f_i_f-r"></div>
        <div class="content_head">
            <h1>{lang('Оформление заказа', 'commerce_mobiles')}</h1>
            <p class="alert">{lang('Способ оплаты и доставки вы сможете согласовать с менеджером, который свяжется с вами после оформления заказа.', 'commerce_mobiles')}</p>
        </div>
        <hr class="head_cle_foot"/>
        <div class="main_frame_inside">
            {if $errors}
                <label><span class="red d_b">{echo $errors}</span></label>
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
                {lang('Телефон','commerce_mobiles')}:<span class="must">*</span>
                <input type="text" name="userInfo[phone]" value="{$profile.phone}" />
            </label>
            <label>
                {lang('Адрес', 'newLevel')}:
                <input name="userInfo[deliverTo]" type="text" value="{$profile.address}"/>
            </label>
            <label>
                {lang('Способ доставки', 'commerce_mobiles')}:
                <select id="method_deliv" name="deliveryMethodId">
                    {$counter = true}
                    {foreach $deliveryMethods as $deliveryMethod}
                        {if $counter}
                            <option value="">
                                {lang('Не выбран','commerce_mobiles')}
                            </option>
                            {$counter = false}
                        {/if}
                        <option
                            {$del_id = $deliveryMethod->getId()}
                            {$del_price = ceil($deliveryMethod->getPrice())}
                            {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}

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
                    {$counter = true}
                    {lang('Способ оплаты','commerce_mobiles')}:
                    <span id="notSelectedPayment">
                        {lang('Выберите доставку','commerce_mobiles')}
                    </span>
                    {foreach $deliveryMethods as $dm}
                        {if count($dm->getPaymentMethodss()) > 0}
                            <select id="paymentMethod{echo $dm->getId()}">
                                <option value="">
                                    {lang('Не выбран','commerce_mobiles')}
                                </option>
                                {foreach $dm->getPaymentMethodss() as $pm}
                                    {if $pm->getActive()}
                                        <option value="{echo $pm->getId()}">
                                            {echo $pm->getName()}
                                        </option>
                                    {/if}
                                {/foreach}
                            </select>
                        {/if}
                    {/foreach}
                    <input type="hidden" name="paymentMethodId" >
                </label>
            {/if}
            <label>
                {lang('Коментарий к заказу', 'commerce_mobiles')}:
                <textarea name="userInfo[commentText]"></textarea>
            </label>
        </div>
        <div class="main_frame_inside">

            <span class="but_buy inp">
                <span class="b_buy_in">
                    <span class="helper"></span>
                    <input type="submit"
                           value="{lang('Оформить заказ', 'commerce_mobiles')}"
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
            <span class="total_pay">{lang('Корзина пуста', 'commerce_mobiles')}</span>
        </div>
    </div>
{/if}