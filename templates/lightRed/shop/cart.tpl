<div class="frame-inside page-cart pageCart">
    <div class="container">
        <!-- Start. Show empty cart -->
        <div class="js-empty empty {if count($items) == 0}d_b{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i">{lang('Оформление заказа','lightRed')}</h1>
                </div>
            </div>
            <div class="msg layout-highlight layout-highlight-msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">{lang('Корзина пуста','lightRed')}</span>
                </div>
            </div>
        </div>
        <!-- End. Show empty cart -->

        <!-- Start. Show cart-->
        <div class="js-no-empty no-empty {if count($items) == 0}d_n{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <!-- Start. Show login button -->
                <div class="frame-title">
                    <h1 class="d_i">{lang('Оформление заказа','lightRed')}</h1>
                    {if !$is_logged_in}
                        <span class="old-buyer">
                            <button type="button" data-trigger="#loginButton">
                                <span class="d_l text-el">{lang('Я уже здесь покупал','lightRed')}</span>
                            </button>
                        </span>
                    {/if}
                </div>
                <!-- End. Show login button -->
            </div>

            <div class="left-cart">
                <form method="post" action="{$BASE_URL}shop/order/make_order" class="clearfix">
                    {if $gift_key}
                        <input type="hidden" name="gift" value="{echo $gift_key}"/>
                        <input type="hidden" name="gift_ord" value="1"/>
                    {/if}
                    <div class="horizontal-form order-form big-title">
                        <!-- Start. Errors block -->
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
                        <!-- End . Errors block -->

                        <!-- Start. User info block -->
                        <div class="groups-form">
                            <label>
                                <span class="title">{lang('Имя: ','lightRed')}</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[fullName]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                </span>
                            </label>
                            <div class="frame-label">
                                <span class="title">{lang('Телефон','lightRed')}:</span>
                                <div class="frame-form-field">
                                    {if trim(ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('addphone','order',$profile.id,'user')->asHtml()) != ''}
                                        <span class="f_r l-h_35">
                                            <button type="button" class="d_l_black" data-drop=".drop-add-phone" data-overlay-opacity="0" data-place="inherit">{lang('Еще один номер', 'lightRed')}</button>
                                        </span>
                                    {/if}
                                    <div class="d_b o_h maskPhoneFrame">
                                        {if $isRequired['userInfo[phone]']}
                                            <span class="must">*</span>
                                        {/if}
                                        <input type="text" name="userInfo[phone]" value="{$profile.phone}" class="m-b_5">
                                        <div class="drop drop-add-phone">
                                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label>
                                <span class="title">{lang('Email','lightRed')}:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[email]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" value="{$profile.email}" name="userInfo[email]">
                                </span>
                            </label>
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('country','order',$profile.id,'user')->asHtml()}
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('Selo','order',$profile.id,'user')->asHtml()}
                        </div>
                        <!-- End. User info block -->

                        <div class="groups-form">
                            {if count($deliveryMethods) > 0}
                                <!-- Start. Delivery methods block -->
                                <div class="frame-label" id="frameDelivery">
                                    <span class="title">{lang('Доставка:','lightRed')}</span>
                                    <div class="frame-form-field check-variant-delivery">
                                        {/* <div class="lineForm">
                                            <select id="method_deliv" name="deliveryMethodId">
                                                <option value="">{lang('--Выбирете способ доставки--', 'lightRed')}</option>
                                        {foreach $deliveryMethods as $deliveryMethod}
                                        <option
                                            name="met_del"
                                            value="{echo $deliveryMethod->getId()}">
                                            {echo $deliveryMethod->getName()}
                                        </option>
                                        {/foreach}
                                    </select>
                                </div>*/}
                                        <div class="frame-radio">
                                            {foreach $deliveryMethods as $deliveryMethod}
                                                <div class="frame-label">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio"
                                                               name="deliveryMethodId"
                                                               value="{echo $deliveryMethod->getId()}"
                                                               />
                                                    </span>
                                                    <div class="name-count">
                                                        <span class="text-el">{echo $deliveryMethod->getName()}</span>
                                                        {if $deliveryMethod->getDescription() && trim($deliveryMethod->getDescription()) != ""}
                                                            <span class="icon_ask" data-rel="tooltip" data-title="{echo $deliveryMethod->getDescription()}"></span>
                                                        {/if}
                                                    </div>
                                                    <div class="help-block">
                                                        {if $deliveryMethod->getDeliverySumSpecified()}
                                                            {echo $deliveryMethod->getDeliverySumSpecifiedMessage()}
                                                        {else:}
                                                            <div>{lang('Стоимость','lightRed')}: {echo ceil($deliveryMethod->getPrice())} <span class="curr">{$CS}</span></div>
                                                            <div>{lang('Бесплатно от','lightRed')}: {echo ceil($deliveryMethod->getFreeFrom())} <span class="curr">{$CS}</span></div>
                                                            {/if}
                                                    </div>
                                                </div>
                                            {/foreach}
                                        </div>
                                    </div>
                                    <!-- End. Delivery methods block -->
                                </div>
                            {/if}

                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}

                            <!-- Start. Delivery  address block and comment-->
                            <div class="frame-label">
                                <span class="title">{lang('Адрес доставки', 'lightRed')}:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[deliverTo]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input name="userInfo[deliverTo]" type="text" value="{$profile.address}"/>
                                </span>
                            </div>
                            <div class="frame-label">
                                <div class="frame-form-field">
                                    <button type="button" class="d_l_1 m-b_5" data-drop=".hidden-comment" data-place="inherit" data-overlay-opacity="0">{lang('Добавить комментарий к заказу', 'lightRed')}</button>
                                    <div class="hidden-comment drop">
                                        <textarea name="userInfo[commentText]" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- End. Delivery  address block and comment-->
                            {if count($deliveryMethods) > 0}
                                <!-- Start. Payment methods block-->
                                <div class="frame-payment p_r">
                                    <div id="framePaymentMethod">
                                        <div class="frame-label">
                                            <span class="title">{lang('Оплата','lightRed')}:</span>
                                            <div class="frame-form-field" style="padding-top: 6px;">
                                                <div class="help-block">{lang('Выберите доставку', 'lightRed')}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preloader d_n_"></div>
                                </div>
                                <!-- End. Payment methods block-->
                            {/if}
                        </div>
                        <div class="groups-form">
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <span class="frame-form-field">
                                    <div class="btn-buy btn-buy-p">
                                        <input type="submit" value="{lang('Оформить заказ','lightRed')}" id="submitOrder"/>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
            <div class="right-cart">
                <div class="frameBask frame-bask frame-bask-order">
                    <div class="frame-title clearfix">
                        <div class="title f_l">{lang('Мой заказ', 'lightRed')}</div>
                        <div class="f_r">
                            <button type="button" class="d_l_1 editCart">{lang('Редактировать', 'lightRed')}</button>
                        </div>
                    </div>
                    <div id="orderDetails" class="p_r">
                        {include_tpl('cart_order')}
                    </div>
                </div>
            </div>
        </div>
        <!-- End. Show cart -->
    </div>
</div>
<script type="text/javascript">     initDownloadScripts(['jquery.maskedinput-1.3.min', 'cusel-min-2.5', 'order'], 'initOrderTrEv', 'initOrder');
</script>