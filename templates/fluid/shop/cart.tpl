<div class="frame-inside page-cart pageCart">
    <div class="container">
        <div class="js-empty empty {if count($items) == 0}d_b{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <div class="frame-title">
                    <h1 class="title">{lang('Оформление заказа','newLevel')}</h1>
                </div>
            </div>
            <div class="msg layout-highlight layout-highlight-msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">{lang('Корзина пуста','newLevel')}</span>
                </div>
            </div>
        </div>
        {if count($items) !== 0}
            <div class="js-no-empty no-empty">
                <form method="post" action="{$BASE_URL}shop/order/make_order" class="clearfix">
                    <div class="left-cart">
                        <div class="f-s_0 title-cart without-crumbs clearfix">
                            <div class="frame-title f_l">
                                <h1 class="title">{lang('Оформление заказа','newLevel')}</h1>
                            </div>
                            {if !$is_logged_in}
                                <span class="old-buyer f_r">
                                    <span class="s-t">{lang('Если вы зарегистрированы', 'newLevel')} — </span>
                                    <button type="button" data-trigger="#loginButton">
                                        <span class="d_l text-el">{lang('авторизуйтесь','newLevel')}</span>
                                    </button>
                                </span>
                            {/if}
                        </div>
                        <div class="horizontal-form order-form big-title">
                            <div class="inside-padd">
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
                                        <span class="title">
                                            <span class="p_r">
                                                {lang('Имя ','newLevel')}
                                                {if $isRequired['userInfo[fullName]']}
                                                    <span class="must">*</span>
                                                {/if}
                                            </span>
                                        </span>
                                        <span class="frame-form-field">
                                            <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                        </span>
                                    </label>
                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('secondname','order',$profile.id,'user')->asHtml()}

                                    <div class="frame-label">
                                        <span class="title">{lang('Телефон','newLevel')}</span>
                                        <div class="frame-form-field">
                                            {if trim(ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('addphone','order',$profile.id,'user')->asHtml()) != ''}
                                                <span class="f_r l-h_35">
                                                    <button type="button" class="d_l_1" data-drop=".drop-add-phone" data-overlay-opacity="0" data-place="inherit">Еще один номер</button>
                                                </span>
                                            {/if}
                                            <div class="d_b o_h maskPhoneFrame">
                                                {if $isRequired['userInfo[phone]']}
                                                    <span class="must">*</span>
                                                {/if}
                                                <input type="text" name="userInfo[phone]" value="{$profile.phone}" class="m-b_5">
                                                <div class="drop drop-add-phone">
                                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('addphone','order',$profile.id,'user')->asHtml()}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label>
                                        <span class="title">
                                            <span class="p_r">
                                                {lang('Email','newLevel')}
                                                {if $isRequired['userInfo[email]']}
                                                    <span class="must">*</span>
                                                {/if}
                                            </span>
                                        </span>
                                        <span class="frame-form-field">
                                            <input type="text" value="{$profile.email}" name="userInfo[email]">
                                        </span>
                                    </label>
                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('country','order',$profile.id,'user')->asHtml()}
                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('Selo','order',$profile.id,'user')->asHtml()}
                                </div>
                                <div class="groups-form">
                                    <!-- Start. Delivery methods block -->
                                    <div class="frame-label" id="frameDelivery">
                                        <span class="title">{lang('Способ доставки','newLevel')}</span>
                                        <div class="frame-form-field check-variant-delivery">
                                            {/* <div class="lineForm">
                                            <select id="method_deliv" name="deliveryMethodId">
                                                <option value="">{lang('--Выбирете способ доставки--', 'newLevel')}</option>
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
                                                                <div>{lang('Бесплатно при заказе от','newLevel')}: {echo ceil($deliveryMethod->getFreeFrom())} <span class="curr">{$CS}</span></div>
                                                                {/if}
                                                        </div>
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>
                                        <!-- End. Delivery methods block -->
                                    </div>
                                </div>
                                <div class="groups-form">
                                    <!-- Start. Delivery  address block and comment-->
                                    {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}
                                    <div class="frame-label">
                                        <span class="title">
                                            <span class="p_r">
                                                {lang('Адрес доставки', 'newLevel')}
                                                {if $isRequired['userInfo[deliverTo]']}
                                                    <span class="must">*</span>
                                                {/if}
                                            </span>
                                        </span>
                                        <span class="frame-form-field">
                                            <input name="userInfo[deliverTo]" type="text" value="{$profile.address}"/>
                                        </span>
                                    </div>
                                    <!-- End. Delivery  address block and comment-->

                                    <div class="frame-label">
                                        <div class="frame-form-field">
                                            <button type="button" class="m-b_5" data-drop=".hidden-comment" data-place="inherit" data-overlay-opacity="0"><span class="d_l_1">{lang('Добавить комментарий к заказу', 'newLevel')}</span></button>
                                            <div class="hidden-comment drop">
                                                <textarea name="userInfo[commentText]" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="groups-form">
                                    <!-- Start. Payment methods block-->
                                    <div class="frame-payment p_r">
                                        <div id="framePaymentMethod">
                                            <div class="frame-label">
                                                <span class="title">{lang('Способ оплаты','newLevel')}</span>
                                                <div class="frame-form-field" style="padding-top: 6px;">
                                                    <div class="help-block">{lang('Выберите доставку', 'newLevel')}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="preloader d_n_"></div>
                                    </div>
                                    <!-- End. Payment methods block-->
                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                        <span class="frame-form-field">
                                            <div class="btn-buy">
                                                <button type="submit" id="submitOrder">
                                                    <span class="text-el">{lang('Оформить заказ','newLevel')}</span>
                                                </button>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-cart">
                        <div class="frame-bask frame-bask-order">
                            <div class="title-default">
                                <div class="frame-title d_b clearfix">
                                    <div class="title f_l">{lang('Мой заказ', 'newLevel')}</div>
                                    <div class="f_r">
                                        <button type="button" class="d_l_1 editCart">{lang('Редактировать', 'newLevel')}</button>
                                    </div>
                                </div>
                            </div>

                            <div id="orderDetails" class="p_r">
                                {include_tpl('cart_order')}
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        {/if}
    </div>
</div>
<script type="text/javascript">
    initDownloadScripts(['jquery.maskedinput-1.3.min', 'cusel-min-2.5', '_order'], 'initOrderTrEv', 'initOrder');
</script>