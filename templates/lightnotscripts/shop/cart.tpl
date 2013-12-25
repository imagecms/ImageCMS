<div class="frame-inside page-cart pageCart">
    <div class="container">
        <!-- Start. Show empty cart -->
        <div class="js-empty empty {if count($items) == 0}d_b{/if}">
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
        <!-- End. Show empty cart -->

        <!-- Start. Show cart-->
        <div class="js-no-empty no-empty {if count($items) == 0}d_n{/if}">
            <div class="f-s_0 title-cart without-crumbs">
                <!-- Start. Show login button -->
                <div class="frame-title">
                    <h1 class="d_i">{lang('Оформление заказа','newLevel')}</h1>
                    {if !$is_logged_in}
                        <span class="old-buyer">
                            <button type="button" data-trigger="#loginButton">
                                <span class="d_l text-el">{lang('Я уже здесь покупал','newLevel')}</span>
                            </button>
                        </span>
                    {/if}
                </div>
                <!-- End. Show login button -->
            </div>
            <form method="post" action="{$BASE_URL}shop/order/make_order" class="clearfix">
                <div class="left-cart">
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
                                <span class="title">{lang('Имя: ','newLevel')}</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[fullName]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input type="text" value="{$profile.name}" name="userInfo[fullName]">
                                </span>
                            </label>
                            <div class="frame-label">
                                <span class="title">{lang('Телефон','newLevel')}:</span>
                                <div class="frame-form-field">
                                    {if trim(ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('addphone','order',$profile.id,'user')->asHtml()) != ''}
                                        <span class="f_r l-h_35">
                                            <button type="button" class="d_l_black" data-drop=".drop-add-phone" data-overlay-opacity="0" data-place="inherit">Еще один номер</button>
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
                                <span class="title">{lang('Email','newLevel')}:</span>
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
                            <!-- Start. Delivery methods block -->
                            <div class="frame-label" id="frameDelivery">
                                <span class="title">{lang('Доставка:','newLevel')}</span>
                                <div class="frame-form-field check-variant-delivery">
                                    <div class="frame-radio">
                                        {foreach $deliveryMethods as $deliveryMethod}
                                            {$del_id = $deliveryMethod->getId()}
                                            {$price = ShopCore::app()->SCurrencyHelper->convert($deliveryMethod->getPrice())}
                                            <div class="frame-label">
                                                <span class="niceRadio b_n">
                                                    <input type="radio"
                                                           name="deliveryMethodId"
                                                           value="{echo $del_id}" 
                                                           data-price="{echo $price}"
                                                           onchange="Cart.getPaymentSystems(this,{$del_id})"
                                                           />
                                                </span>
                                                <div class="name-count">
                                                    <span class="text-el">{echo $deliveryMethod->getName()}</span>
                                                    {if $deliveryMethod->getDescription() && trim($deliveryMethod->getDescription()) != ""}
                                                        <span class="icon_ask" data-rel="tooltip" data-title="{echo $deliveryMethod->getDescription()}"></span>
                                                    {/if}
                                                </div>
                                                <div class="help-block">
                                                    <div>{lang('Стоимость ','newLevel')}: {echo $price} <span class="curr">{$CS}</span></div>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                            <!-- End. Delivery methods block -->

                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}

                            <!-- Start. Delivery  address block and comment-->
                            <div class="frame-label">
                                <span class="title">Адрес доставки:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[deliverTo]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input name="userInfo[deliverTo]" type="text" value="{$profile.address}"/>
                                </span>
                            </div>
                            <div class="frame-label">
                                <div class="frame-form-field">
                                    <button type="button" class="d_l_1 m-b_5" data-drop=".hidden-comment" data-place="inherit" data-overlay-opacity="0">Добавить комментарий к заказу</button>
                                    <div class="hidden-comment drop">
                                        <textarea name="userInfo[commentText]" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- End. Delivery  address block and comment-->




                            <!-- Start. Payment methods block-->
                            <div class="frame-label" id="paymentMethodBlock" style="display: none;">
                                <span class="title">{lang('Оплата:','newLevel')}</span>
                                <div class="frame-form-field check-variant-payment p_r">
                                    <div class="paymentMethod">
                                        <div class="lineForm">
                                            <select name="paymentMethodId" id="paymentMethod">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End. Payment methods block-->

                        </div>
                        <div class="groups-form">
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <span class="frame-form-field">
                                    <div class="btn-buy btn-buy-p">
                                        <input type="submit" value="{lang('Оформить заказ','newLevel')}"/>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-cart">
                    <div class="frameBask frame-bask frame-bask-order">
                        <div class="frame-title clearfix">
                            <div class="title f_l">Мой заказ</div>
                            <div class="f_r">
                                <button type="button" class="d_l_1">Редактировать</button>
                            </div>
                        </div>
                        <div id="orderDetails">
                            <table class="table-order table-order-view">
                                <colgroup>
                                    <col/>
                                    <col width="120"/>
                                </colgroup>
                                <tbody>
                                    {foreach $items as $item}



                                        <!-- Start. For single product -->
                                        {if  $item->instance == 'SProducts'}
                                            <tr class="items items-bask cart-product">
                                                <td class="frame-items">
                                                    <a href="{echo shop_url('product/'.$item->getSProducts()->getUrl())}" class="frame-photo-title">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{echo $item->getSmallPhoto()}" alt="">
                                                        </span>
                                                        {if !$item->getName()}
                                                            <span class="title">{echo $item->getSProducts()->getName()}</span>
                                                        {else:}
                                                            <span class="title">{echo $item->getName()}</span>
                                                        {/if}
                                                    </a>
                                                    <div class="description">
                                                        {if $item->getSProducts()->getNumber()}
                                                            <span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  
                                                                <span class="code js-code">({echo $item->getSProducts()->getNumber()})
                                                                </span>
                                                            </span> 
                                                        {/if}
                                                        <div class="frame-prices f-s_0">
                                                            {if ShopCore::app()->SCurrencyHelper->convert($item->originPrice) != ShopCore::app()->SCurrencyHelper->convert($item->price)}
                                                                <span class="price-discount">
                                                                    <span>
                                                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->originPrice)}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                            {/if}

                                                            <span class="current-prices f-s_0">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($item->price)}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>

                                                            </span>
                                                        </div>

                                                    </div>
                                                    {echo 'Кількість - '.$item->quantity}
                                                    <a href="{site_url('shop/cart_new/removeProductByVariantId/'.$item->id)}">Видалити</a>
                                                </td>
                                            </tr>
                                        {else:}
                                            <!-- Start. Shop kit -->
                                            <tr class="row row-kits rowKits">
                                                <td class="frame-items frame-items-kit">
                                                    <div class="title-h3 c_9">{lang('Комплект товаров', 'newLevel')}</div>
                                                    <ul class="items items-bask">
                                                        <li>
                                                            {foreach $item->items as $kitItem}
                                                                <div class="frame-kit">
                                                                    <a class="frame-photo-title" href="{echo shop_url('product/'.$kitItem->getSProducts()->getUrl())}">
                                                                        <span class="photo-block">
                                                                            <span class="helper"></span>
                                                                            <img src="{echo $kitItem->getSmallPhoto()}">
                                                                        </span>
                                                                        {if !$kitItem->getName()}
                                                                            <span class="title">{echo $kitItem->getSProducts()->getName()}</span>
                                                                        {else:}
                                                                            <span class="title">{echo $kitItem->getName()}</span>
                                                                        {/if}
                                                                    </a>
                                                                    <div class="description">
                                                                        {if $kitItem->getSProducts()->getNumber()}
                                                                            <span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  
                                                                                <span class="code js-code">({echo $kitItem->getSProducts()->getNumber()})
                                                                                </span>
                                                                            </span> 
                                                                        {/if}
                                                                        <div class="frame-prices f-s_0">
                                                                            {if ShopCore::app()->SCurrencyHelper->convert($kitItem->originPrice) != ShopCore::app()->SCurrencyHelper->convert($kitItem->price)}
                                                                                <span class="price-discount">
                                                                                    <span>
                                                                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($kitItem->originPrice)}</span>
                                                                                        <span class="curr">{$CS}</span>
                                                                                    </span>
                                                                                </span>
                                                                            {/if}
                                                                            <span class="current-prices f-s_0">
                                                                                <span class="price-new">
                                                                                    <span>
                                                                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($kitItem->price)}</span>
                                                                                        <span class="curr">{$CS}</span>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    {if !next($item->items)}
                                                                        <div class="next-kit">+</div>
                                                                    {/if}
                                                                </div>
                                                            {/foreach}
                                                        </li>
                                                    </ul>
                                                    {echo 'Кількість - '.$item->quantity}
                                                    <a href="{site_url('shop/cart_new/removeKit/'.$item->id)}">Видалити</a>
                                                </td>
                                            </tr>
                                            <!-- End. Shop kit -->
                                        {/if}
                                    {/foreach}   
                                    </div>
                                </tbody>
                                <tfoot class="gen-info-price">
                                    <tr>
                                        <td colspan="2">
                                            <span class="s-t">{lang('Начальная стоимость товаров','newLevel')}:</span>
                                        </td>
                                        <td class="t-a_r">
                                            <span class="price"><span class="text-el">{echo ShopCore::app()->SCurrencyHelper->convert($cartOriginPrice)}</span><span class="f-w_b" id="shipping"></span></span>
                                            <span class="curr">{$CS}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="s-t">{lang('Доставка','newLevel')}:</span>
                                        </td>
                                        <td class="t-a_r">
                                            <span class="price"><span class="text-el deliveryPriceSum">0</span>
                                            <span class="curr">{$CS}</span>
                                        </td>
                                    </tr>
                                    {if $discount_val}
                                        <tr id="frameGenDiscount">
                                            <td colspan="2">
                                                <span class="s-t">{lang('Ваша текущая скидка','newLevel')}:</span>
                                            </td>
                                            <td class="t-a_r">
                                                <div class="text-discount current-discount frameDiscount">
                                                    <span class="curDiscount"></span>
                                                    <span class="curr">{echo ShopCore::app()->SCurrencyHelper->convert($discount_val)}{$CS}</span>
                                                </div>
                                                <div id="discount"></div>
                                            </td>
                                        </tr>
                                    {/if}
                                    <tr id="frameGift" style="display: none;">
                                        <td>
                                            <span class="s-t">{lang('Подарочный сертификат','newLevel')}:</span>
                                        </td>
                                        <td colspan="2" class="t-a_r">
                                            <div class="f_r btn-toggle-gift">
                                                <button type="button" class="d_l_1" data-drop="#gift" data-place="inherit" data-overlay-opacity="0">
                                                    <span class="text-el">Ввести промо-код</span>
                                                </button>
                                            </div>
                                            <div id="gift" class="drop o_h">
                                                <div class="preloader"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="gen-sum-order frame-foot">
                                <div class="header-frame-foot">
                                    <div class="inside-padd clearfix">
                                        <span class="title f_l">{lang('К оплате','newLevel')}:</span>
                                        <span class="frame-prices f_r">
                                            <span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
                                                        <span class="price" id="finalAmount">
                                                            {echo ShopCore::app()->SCurrencyHelper->convert($cartPrice)}
                                                        </span>
                                                        <span class="price deliveryPriceSum" id="finalAmount">
                                                            
                                                        </span>
                                                        <span class="curr">{$CS}</span>
                                                    </span>
                                                </span>
                                                {if $NextCS != null}
                                                    <span class="price-add">
                                                        <span>
                                                            (<span class="price" id="finalAmountAdd">{echo ShopCore::app()->SCurrencyHelper->convert($cartPrice, $NextCSId)}</span>
                                                            <span class="curr-add">{$NextCS}</span>)
                                                        </span>
                                                    </span>
                                                {/if}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="checkCert" value="0">
                    {form_csrf()}
                    </form>
                </div>
        </div>
        <!-- End. Show cart -->
    </div>
</div>
<script type="text/javascript">
    initDownloadScripts(['jquery.maskedinput-1.3.min', 'cusel-min-2.5', '_order'], 'initOrderTrEv', 'initOrder');
</script>


<!-- Start. Uses as template for select payment methods -->
<div id="paymentMethodSelectItemTemplate">
    <div class="lineForm">
        <select name="paymentMethodId" id="paymentMethod">
        </select>
    </div>

</div>
<!-- End. Uses as template for select payment methods -->