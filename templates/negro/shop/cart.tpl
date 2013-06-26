<div class="frame-inside page-cart">
    <div class="container">
        <div class="{if count($items) > 0}d_n{/if}" id="shopCartPageEmpty">
            <div class="f-s_0 title-cart without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i">Корзина</h1>
                </div>
            </div>
            <div class="msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">Ваша корзина пуста</span>
                </div>
            </div>
        </div>
        {if count($items) > 0}
            <div id="shopCartPage">
                <div class="f-s_0 title-cart without-crumbs">
                    <div class="frame-title">
                        <h1 class="d_i">Оформление заказа</h1>
                    </div>
                </div>
                <div class="left-cart">
                    {if !$is_logged_in}
                        <ul class="tabs-data-cart items">
                            <li class="new-buyer">
                                <span>
                                    <span class="text-el">Я новый покупатель</span>
                                </span>
                            </li>
                            <li>
                                <button type="button" data-trigger="#loginButton">
                                    <span class="d_l text-el">Я уже здесь покупал</span>
                                </button>
                            </li>
                        </ul>
                    {/if}
                    <div class="frameGroupsForm">
                        <div class="horizontal-form">
                            <form method="post" action="{$BASE_URL}shop/cart" id="makeOrderForm">
                                {if $errors}
                                    <div class="groups-form">
                                        <div class="msg">
                                            <div class="error">{echo $errors}</div>
                                        </div>
                                    </div>
                                {/if}
                                <div class="groups-form">
                                    <label>
                                        <span class="title">Имя:</span>
                                        <span class="frame-form-field">
                                            {if $isRequired['userInfo[fullName]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('s_phone')}</span>
                                        <span class="frame-form-field">
                                            {if $isRequired['userInfo[phone]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <input type="text" name="userInfo[phone]" value="{$profile.phone}">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('s_c_uoy_user_el')}</span>
                                        <span class="frame-form-field">
                                            {if $isRequired['userInfo[email]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <input type="text" value="{$profile.email}" name="userInfo[email]">
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('s_addresrec')}</span>
                                        <span class="frame-form-field">
                                            {if $isRequired['userInfo[deliverTo]']}
                                                <span class="must">*</span>
                                            {/if}
                                            <input type="text" name="userInfo[deliverTo]" value="{echo $profile.address}"></span>
                                    </label>
                                </div>
                                <div class="groups-form">
                                    <div class="frame-label">
                                        <span class="title">Способ доставки</span>
                                        <div class="frame-form-field check-variant-delivery">
                                            {/*<div class="lineForm">
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
                                                            value="{echo $del_id}"
                                                            data-price="{echo ceil($deliveryMethod->getPrice())}"
                                                            data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"/>
                                                {echo $deliveryMethod->getName()}
                                                        </option>
                                            {/foreach}
                                                </select>
                                            </div>*/}
                                            {$counter = true}
                                            <div class="frame-radio">
                                                {foreach $deliveryMethods as $deliveryMethod}
                                                    {$del_id = $deliveryMethod->getId()}
                                                    <div class="frame-label">
                                                        <span class="niceRadio b_n">
                                                            <input type="radio"
                                                                   {if $counter} checked="checked"
                                                                       {$del_id = $deliveryMethod->getId()}
                                                                       {$counter = false}
                                                                       {$del_price = ceil($deliveryMethod->getPrice())}
                                                                       {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}
                                                                   {/if}
                                                                   name="met_del"
                                                                   value="{echo $del_id}"
                                                                   data-price="{echo ceil($deliveryMethod->getPrice())}"
                                                                   data-freefrom="{echo ceil($deliveryMethod->getFreeFrom())}"
                                                                   />
                                                        </span>
                                                        <div class="name-count">
                                                            <span class="text-el">{echo $deliveryMethod->getName()}</span>
                                                        </div>
                                                        {if $deliveryMethod->getDescription()}
                                                            <div class="help-block">{echo $deliveryMethod->getDescription()}</div>
                                                        {/if}
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>
                                    </div>

                                    {if count($paymentMethods)}
                                        <div class="frame-label">
                                            <span class="title">Способ оплаты</span>
                                            <div class="frame-form-field">
                                                <div class="paymentMethod check-variant-payment">
                                                    {/*<div class="lineForm">
                                                    <select name="paymentMethodId" id="paymentMethod">
                                                    {$counter = true}
                                                    {foreach $paymentMethods as $paymentMethod}
                                                    <label>
                                                    <option
                                                        {if $counter} checked="checked"
                                                            {$counter = false}
                                                            {$pay_id = $paymentMethod->getId()}
                                                        {/if}
                                                    value="{echo $pay_id}"
                                                    />
                                                        {echo $paymentMethod->getName()}
                                                    </option>
                                                    </label>
                                                    {/foreach}
                                                    </select>
                                                    </div>*/}
                                                    <div class="frame-radio">
                                                        {$counter = true}
                                                        {foreach $paymentMethods as $paymentMethod}
                                                            <div class="frame-label">
                                                                <span class="niceRadio b_n">
                                                                    <input type="radio"
                                                                           {if $counter} checked="checked"
                                                                               {$counter = false}
                                                                               {$pay_id = $paymentMethod->getId()}
                                                                           {/if}
                                                                           value="{echo $pay_id}"
                                                                           name="paymentMethodId"
                                                                           />
                                                                </span>
                                                                <div class="name-count">
                                                                    <span class="text-el">{echo $paymentMethod->getName()}</span>
                                                                </div>
                                                                {if $paymentMethod->getDescription()}
                                                                    <div class="help-block">{echo $paymentMethod->getDescription()}</div>
                                                                {/if}
                                                            </div>
                                                        {/foreach}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                                {if ShopCore::app()->SSettings->usegifts == 1}
                                    <div class="groups-form" >
                                        <label for="giftcert">
                                            <span class="title">{lang('s_cert_code')}</span>
                                            <span class="frame-form-field">
                                                <div class="btn-def f_r">
                                                    <button id="applyGiftCert">{lang('s_apply_sertif')}</button>
                                                </div>
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
                                <div class="groups-form">
                                    <label>
                                        <span class="title">{lang('s_comment')}</span>
                                        <span class="frame-form-field"><textarea name="userInfo[commentText]" ></textarea></span>
                                    </label>
                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                        <div class="frame-form-field">
                                            <div>(Сумма товаров: <span class="f-w_b" id="totalPrice"></span> <span class="curr"></span> + Доставка: <span id="shipping"></span> <span class="curr"></span>)
                                                <span id="giftCertSpan" style="display: none;">(Скидка подарочного сертификата: <span id="giftCertPrice"></span> )</span>
                                            </div>
                                            <span>Сумма:</span> <span id="finalAmount"></span> <span class="curr"></span>
                                        </div>
                                    </div>
                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                        <span class="frame-form-field">
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
                <div class="right-cart" id="orderDetails">

                </div>
            </div>
        {/if}
    </div>
</div>
</div>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>