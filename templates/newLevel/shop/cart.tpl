<div class="frame-inside page-cart">
    <div class="container">
        <div class="empty {if count($items) == 0}d_b{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i">{lang('Оформление заказа','newLevel')}</h1>
                </div>
            </div>
            <div class="msg layout-highlight layout-highlight-msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">{lang('Корзина пуста','newLevel')}</span>
                </div>
            </div>
        </div>
        <div class="no-empty {if count($items) == 0}d_n{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i">{lang('Оформление заказа','newLevel')}</h1>
                </div>
            </div>
            <div class="left-cart">
                {if !$is_logged_in}
                    <nav>
                        <ul class="nav nav-order-user">
                            <li class="new-buyer">
                                <span>
                                    <span class="text-el">{lang('Я новый покупатель','newLevel')}</span>
                                </span>
                            </li>
                            <li class="old-buyer">
                                <button type="button" data-trigger="#loginButton">
                                    <span class="d_l text-el">{lang('Я постоянный покупатель','newLevel')}</span>
                                </button>
                            </li>
                        </ul>
                    </nav>
                {/if}
                <div class="horizontal-form order-form">
                    <form method="post" action="{$BASE_URL}shop/cart">
                        {if $errors}
                            <div class="groups-form">
                                <div class="msg">
                                    <div class="error">
                                        <span class="icon_error"></span>
                                        <span class="text-el">{echo $errors}</span>
                                    </div>
                                </div>
                            </div>
                        {/if}
                        <div class="groups-form">
                            <label>
                                <span class="title">{lang('Имя: ','newLevel')}</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[fullName]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('Телефон','newLevel')}:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[phone]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" name="userInfo[phone]" value="{$profile.phone}">
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('Email','newLevel')}:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[email]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" value="{$profile.email}" name="userInfo[email]">
                                </span>
                            </label>
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('country','order',$profile.id,'user')->asHtml()}
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('Selo','order',$profile.id,'user')->asHtml()}
                            <label>
                                <span class="title">{lang('Город','newLevel')}:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[deliverTo]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <textarea name="userInfo[deliverTo]">{echo $profile.address}</textarea>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('Комментарий:','newLevel')}</span>
                                <span class="frame-form-field"><textarea name="userInfo[commentText]" ></textarea></span>
                            </label>
                        </div>
                        <div class="groups-form">
                            <div class="frame-label">
                                <span class="title">{lang('Доставка:','newLevel')}</span>
                                <div class="frame-form-field check-variant-delivery">
                                    {/*<div class="lineForm">
                                                <select id="method_deliv" name="deliveryMethodId">
                                        {foreach $deliveryMethods as $deliveryMethod}
                                    {$del_id = $deliveryMethod->getId()}
                                    <option
                                        {if $counter} selected="selected"
                                            {$del_id = $deliveryMethod->getId()}
                                            {$counter = false}
                                            {$price = ceil($deliveryMethod->getPrice())}
                                            {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}
                                        {/if}
                                        name="met_del"
                                        value="{echo $del_id}"
                                        data-price="{echo $price}"
                                        data-freefrom="{echo $del_freefrom}"/>
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
                                                    {if $counter} checked="checked"{/if}
                                                    {$del_id = $deliveryMethod->getId()}
                                                    {$counter = false}
                                                    {$price = ceil($deliveryMethod->getPrice())}
                                                    {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}
                                                    name="deliveryMethodId"
                                                    value="{echo $del_id}"
                                                    data-price="{$price}"
                                                    data-freefrom="{echo $del_freefrom}"
                                                    />
                                            </span>
                                            <div class="name-count">
                                                <span class="text-el">{echo $deliveryMethod->getName()}</span>
                                            </div>
                                            <div class="help-block">
                                                {if $deliveryMethod->getDescription()}
                                                    {echo $deliveryMethod->getDescription()}
                                                {/if}
                                                <div>{lang('Цена: ','newLevel')} {echo $price} <span class="curr">{$CS}</span></div>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>

                        {if count($paymentMethods)}
                            <div class="frame-label">
                                <span class="title">{lang('Оплата:','newLevel')}</span>
                                <div class="frame-form-field check-variant-payment p_r">
                                    <div class="paymentMethod">
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
                                                           {/if}
                                                           value="{echo $paymentMethod->getId()}"
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
                                <div class="preloader"></div>
                            </div>
                    </div>
                {/if}
            </div>
            <div id="gift">
                <div class="preloader"></div>
            </div>
            <div class="groups-form">
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <div class="frame-form-field">
                        <ul class="items items-order-gen-info">
                            <li>
                                <span class="s-t">{lang('Доставка: ','newLevel')}</span>
                                <span class="price-item">
                                    <span>
                                        <span class="price"><span class="text-el">+</span><span id="shipping"></span></span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            </li>
                        </ul>
                        <div class="p_r">
                            <ul class="items items-order-gen-info" id="discount">

                            </ul>
                            <div class="preloader"></div>
                        </div>
                        <ul class="items items-order-gen-info">
                            <li id="giftCertSpan" style="display: none;">
                                <span class="s-t">{lang('Promo код: ','newLevel')}</span>
                                <span class="price-item">
                                    <span class="text-discount">
                                        <span class="text-el">-</span><span id="giftCertPrice"></span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            </li>
                        </ul>
                        <div class="gen-sum-order">
                            <span class="title">{lang('Всего к оплате:','newLevel')}</span>
                            <span class="frame-prices f-s_0">
                                <span class="price-discount">
                                    <span>
                                        <span class="price frame-gen-discount" id="totalPrice"></span>
                                        <span class="curr frame-gen-discount">{$CS}</span>
                                    </span>
                                </span>
                                <span class="current-prices f-s_0">
                                    <span class="price-new">
                                        <span>
                                            <span class="price" id="finalAmount"></span>
                                            <span class="curr">{$CS}</span>
                                        </span>
                                    </span>
                                    {if $NextCS != null}
                                        <span class="price-add">
                                            <span>
                                                (<span class="price" id="finalAmountAdd"></span>
                                                <span class="curr-add">{$NextCS}</span>)
                                            </span>
                                        </span>
                                    {/if}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="frame-label">
                    <span class="title">&nbsp;</span>
                    <span class="frame-form-field">
                        <div class="btn-cart btn-cart-p">
                            <input type="submit" class="btn btn_cart" value="{lang('Подтвердить заказ','newLevel')}"/>
                        </div>
                    </span>
                </div>
            </div>
            <input type="hidden" name="makeOrder" value="1">
            <input type="hidden" name="checkCert" value="0">
            {form_csrf()}
            </form>
        </div>
    </div>
    <div class="right-cart">
        <div id="orderDetails">
            <div class="preloader"></div>
        </div>
    </div>
</div>
</div>
</div>
{/* <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>*/}
