<article class="container">
    <div class="{if count($items) > 0}d_n{/if}" id="shopCartPageEmpty">
        <div class="bot_border_grey m-b_10">
            <div class="d_i title_h1">Корзина</div>
        </div>
        <div class="alert alert-search-result">
            <div class="title_h2 t-a_c">Ваша корзина пуста</div>
        </div>
    </div>

    {if count($items) > 0}
        <div id="shopCartPage">
            <h1>Оформление заказа</h1>
            <div class="row">
                <div class="span6">
                    <div class="frameGroupsForm">
                        <div class="header_title">Данные заказа</div>
                        <div class="standart_form horizontal_form">
                            <form method="post" action="{$BASE_URL}shop/cart" id="makeOrderForm">
                                {if $errors}
                                    <div class="groups_form">
                                        <div class="msg">
                                            <div class="error">{echo $errors}</div>
                                        </div>
                                    </div>
                                {/if}
                                <div class="groups_form">
                                    <label>
                                        <span class="title">{lang("You name","admin")}</span>
                                        <span class="frame_form_field">
                                            {if $isRequired['userInfo[fullName]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <span class="icon-person"></span>
                                            <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('Электронный адрес','commerce4x')}</span>
                                        <span class="frame_form_field">
                                            {if $isRequired['userInfo[email]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <span class="icon-email"></span>
                                            <input type="text" value="{$profile.email}" name="userInfo[email]">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('Телефон','commerce4x')}</span>
                                        {if $isRequired['userInfo[phone]']}
                                            <span class="must">*</span>
                                        {/if}
                                        <span class="frame_form_field">
                                            <span class="icon-phone"></span>
                                            <input type="text" name="userInfo[phone]" value="{$profile.phone}">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('Адрес получателя','commerce4x')}</span>
                                        <span class="frame_form_field">
                                            {if $isRequired['userInfo[deliverTo]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <span class="icon-address"></span>
                                            <input type="text" name="userInfo[deliverTo]" value="{echo $profile.address}"></span>
                                    </label>
                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getCustomFields('order',$profile.id,'user')->asHtml()}
                                    <div class="groups_form">
                                        <div class="frameLabel" style="position: relative; z-index: 6;">
                                            <span class="title">Способ доставки</span>
                                            <div class="frame_form_field">
                                                <div class="row-fluid">
                                                    <div class="lineForm">
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
                                                                    data-price="{echo ShopCore::app()->SCurrencyHelper->convert(ceil($deliveryMethod->getPrice()))}"
                                                                    data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"
                                                                    value="{echo $del_id}">{echo $deliveryMethod->getName()}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {if count($paymentMethods)}
                                            <div class="frameLabel" style="position: relative; z-index: 5;">
                                                <span class="title">Способ оплаты</span>
                                                <div class="frame_form_field">
                                                    <div class="row-fluid paymentMethod">
                                                        <div class="lineForm">
                                                            <select name="paymentMethodId"  id="paymentMethod">
                                                                {$counter = true}
                                                                {foreach $paymentMethods as $paymentMethod}
                                                                    <label>
                                                                        <option
                                                                            {if $counter} checked="checked"
                                                                                {$counter = false}
                                                                                {$pay_id = $paymentMethod->getId()}
                                                                            {/if}
                                                                            value="{echo $pay_id}">
                                                                        {echo $paymentMethod->getName()}
                                                                        </option>
                                                                    </label>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    </div>
                                    <div id="gift"></div>
                                    {/*}
                                    {if ShopCore::app()->SSettings->usegifts == 1}
                                        <div class="groups_form" >
                                            <label for="giftcert">
                                                <span class="title">{lang('Код сертификата','commerce4x')}</span>
                                                <span class="frame_form_field">
                                                    <button class="btn f_r" id="applyGiftCert">{lang('Применить','commerce4x')}</button>
                                                    <div class="o_h">
                                                        <input type="text" name="giftcert" value="">
                                                    </div>
                                                    {if $isRequired['giftcert']}
                                                        <span class="must">*</span>
                                                    {/if}
                                                </span>
                                            </label>
                                        </div>
                                    {/if}
                                    { */}
                                    <div class="groups_form">
                                        <label>
                                            <span class="title">{lang('Комментарий','commerce4x')}</span>
                                            <span class="frame_form_field"><textarea name="userInfo[commentText]" ></textarea></span>
                                        </label>
                                        <div class="frameLabel c_t" style="position: relative; z-index: 4;">
                                            <span class="title">&nbsp;</span>
                                            <div class="frame_form_field">
                                                <div class="form_alert">
                                                    <div style="margin-bottom: 4px;" class="c_97">(Сумма товаров: <span class="f-w_b" id="totalPrice"></span> <span class="curr"></span> + Доставка: <span class="f-w_b" id="shipping"></span> <span class="curr"></span>)
                                                        <br/><span id="giftCertSpan" style="display: none;" >(Скидка подарочного сертификата: <span id="giftCertPrice" class="f-w_b"></span> )</span>
                                                        <br/><span id="Discount" style="display: none;" ></span>
                                                    </div>

                                                    <span class="f-s_18">Сумма:</span> <span class="f-s_24" id="finalAmount"></span> <span class="f-s_14 curr"></span>
                                                    <input type="hidden" name="totalprice" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="frameLabel" style="position: relative; z-index: 3;">
                                            <span class="title">&nbsp;</span>
                                            <span class="frame_form_field">
                                                <input type="submit" class="btn btn_cart" value="Подтверждаю заказ">
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="makeOrder" value="1">
                                    <input type="hidden" name="checkCert" value="0">
                                    {form_csrf()}
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="span6" id="orderDetails">

                </div>
            </div>
        </div>
    </article>

{/if}

<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
