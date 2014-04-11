<div class="frame-inside page-cart pageCart">
    <div class="container">
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
        <div class="js-no-empty no-empty {if count($items) == 0}d_n{/if}">
            <div class="f-s_0 title-cart without-crumbs">
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
            </div>
            <form method="post" action="{$BASE_URL}shop/cart" class="clearfix">
                <div class="left-cart">
                    <div class="horizontal-form order-form big-title">
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
                            <div class="frame-label">
                                <span class="title">{lang('Телефон','newLevel')}:</span>
                                <div class="frame-form-field">
                                    {if trim(ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field_phone')->getOneCustomFieldsByName('addphone','order',$profile.id,'user')->asHtml()) != ''}
                                        <span class="f_r l-h_35">
                                            <button type="button" class="d_l_1" data-drop=".drop-add-phone" data-overlay-opacity="0" data-place="inherit">{lang('Еще один номер', 'newLevel')}</button>
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
                        <div class="groups-form">
                            <div class="frame-label" id="frameDelivery">
                                <span class="title">{lang('Доставка:','newLevel')}</span>
                                {$counter = true}
                                <div class="frame-form-field check-variant-delivery">
                                    { /* <div class="lineForm">
                                        <select id="method_deliv" name="deliveryMethodId">
                                            {foreach $deliveryMethods as $deliveryMethod}
                                                {$del_id = $deliveryMethod->getId()}
                                                <option
                                                    {if $counter} selected="selected"{/if}
                                                    {$counter = false}
                                                    {$del_id = $deliveryMethod->getId()}
                                                    {$price = ceil($deliveryMethod->getPrice())}
                                                    {$del_freefrom = ceil($deliveryMethod->getFreeFrom())}

                                                    name="met_del"
                                                    value="{echo $del_id}"
                                                    data-price="{$price}"
                                                    data-freefrom="{echo $del_freefrom}"/>
                                                {echo $deliveryMethod->getName()}
                                                </option>
                                            {/foreach}
                                        </select>
                                    </div>*/}
                                    <div class="frame-radio">
                                        {foreach $deliveryMethods as $deliveryMethod}
                                            {$del_id = $deliveryMethod->getId()}
                                            <div class="frame-label">
                                                <span class="niceRadio b_n">
                                                    <input type="radio"
                                                           {if $counter} checked="checked"{/if}
                                                           {$counter = false}
                                                           {$del_id = $deliveryMethod->getId()}
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
                            <div class="frame-label">
                                <span class="title">Адрес доставки:</span>
                                <span class="frame-form-field">
                                    {if $isRequired['userInfo[deliverTo]']}
                                        <span class="must">*</span>
                                    {/if}
                                    <input name="userInfo[deliverTo]" type="text" value="{$profile.address}"/>
                                </span>
                            </div>
                            {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPatternMain('pattern_custom_field')->getOneCustomFieldsByName('city','order',$profile.id,'user')->asHtml()}
                            <div class="frame-label">
                                <div class="frame-form-field">
                                    <button type="button" class="d_l_1 m-b_5" data-drop=".hidden-comment" data-place="inherit" data-overlay-opacity="0">{lang('Добавить комментарий к заказу', 'newLevel')}</button>
                                    <div class="hidden-comment drop">
                                        <textarea name="userInfo[commentText]" ></textarea>
                                    </div>
                                </div>
                            </div>
                            {if count($paymentMethods)}
                                <div class="frame-label">
                                    <span class="title">{lang('Оплата:','newLevel')}</span>
                                    <div class="frame-form-field check-variant-payment p_r">
                                        <div class="paymentMethod">
                                            {$counter = true}
                                            <div class="lineForm">
                                                <select name="paymentMethodId" id="paymentMethod">
                                                    {foreach $paymentMethods as $paymentMethod}
                                                        <label>
                                                            <option
                                                                {$pay_id = $paymentMethod->getId()}
                                                                {if $counter} checked="checked"
                                                                    {$counter = false}
                                                                {/if}
                                                                value="{echo $pay_id}"
                                                                />
                                                            {echo $paymentMethod->getName()}
                                                            </option>
                                                        </label>
                                                    {/foreach}
                                                </select>
                                            </div>
                                            {/*<div class="frame-radio">
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
                                    */}
                                        </div>
                                        <div class="preloader"></div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                        <div class="groups-form">
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <span class="frame-form-field">
                                    <div class="btn-cart btn-cart-p">
                                        <input type="submit" class="btn btn_cart" value="{lang('Подтвердить заказ','newLevel')}"/>
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
                                <button type="button" class="d_l_1" onClick="ShopFront.Cart.togglePopup()">Редактировать</button>
                            </div>
                        </div>
                        <div id="orderDetails">
                            <div class="preloader"></div>
                        </div>
                        <table class="table-order table-order-view">
                            <tfoot class="gen-info-price">
                                <tr class="frame-gen-discount" id="frameGenSumDiscount">
                                    <td colspan="2">
                                        <span class="s-t">{lang('Сумма товаров','newLevel')}</span>
                                    </td>
                                    <td>
                                        <span class="price f-w_b" id="totalPrice">{echo str_replace(',', '.', ShopCore::app()->SCart->totalPrice())}</span>
                                        <span class="curr"> {$CS}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span class="s-t">{lang('Стоимость доставки','newLevel')}:</span>
                                    </td>
                                    <td>
                                        <span class="price"><span class="text-el"></span><span class="f-w_b" id="shipping"></span></span>
                                        <span class="curr">{$CS}</span>
                                    </td>
                                </tr>
                                <tr id="frameGenDiscount" style="display: none;">
                                    <td colspan="2">
                                        <span class="s-t">{lang('Ваша текущая скидка','newLevel')}:</span>
                                    </td>
                                    <td>
                                        <div class="text-discount current-discount frameDiscount">
                                            <span class="curDiscount"></span>
                                            <span class="curr">{$CS}</span>
                                        </div>
                                        <div id="discount"></div>
                                    </td>
                                </tr>
                                <tr id="frameGift" style="display: none;">
                                    <td>
                                        <span class="s-t">{lang('Подарочный сертификат','newLevel')}:</span>
                                    </td>
                                    <td colspan="2">
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
                        <div class="gen-sum-order footer-bask">
                            <div class="inside-padd clearfix">
                                <span class="title f_l">{lang('К оплате с учетом доставки','newLevel')}:</span>
                                <span class="frame-prices f_r">
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
                </div>
                <input type="hidden" name="makeOrder" value="1">
                <input type="hidden" name="checkCert" value="0">
                {form_csrf()}
            </form>
        </div>
    </div>
</div>
<script type="text/template" id="orderDetailsTemplate">
    {literal}   
        <div class="js-no-empty no-empty">
        <div class="inside-padd">
        <table class="table-order">
        <tbody>
        <% _.each(Shop.Cart.getAllItems(), function(item){ %>

        <!-- for single product -->
        <% if (!item.kit) { %>
        <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-id="popupProduct_<%- item.id+'_'+item.vId %>" class="items items-bask cart-product">
        <td class="frame-items">
        <a href="<%-item.url%>" class="frame-photo-title">
        <span class="photo-block">
        <span class="helper"></span>
        <img src="<%- item.img%>" alt="<%- '('+item.vname+')'%>">
        </span>
        <span class="title"><%- item.name %></span>
        </a>
        <div class="description">
        <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
        <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
        <%/*%>
        <div class="frame-prices f-s_0">
        <%if (item.origprice) { %>
        <span class="price-discount">
        <span>
        <span class="price"><%- parseFloat(item.origprice).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <% } %>
        <span class="current-prices f-s_0">
        <span class="price-new">
        <span>
        <span class="price"><%- parseFloat(item.price).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <%if (nextCsCond){%>
        <span class="price-add">
        <span>
        <span class="price"><%- parseFloat(item.addprice).toFixed(pricePrecision) %></span>
        <span class="curr-add"><%-nextCs%></span>
        </span>
        </span>
        <%}%>
        </span>
        </div>
        <%*/%>
        </div>
        </td>
        <td>
        <div class="frame-frame-count">
        <div class="frame-count frameCount">
        <div class="s-t"><%-text.quant%></div>
        <div class="js-number d_i-b">
        <div class="frameChangeCount" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-addprice="<%- item.addprice %>" data-origprice="<%- item.origprice %>"></div>
        <span class="plusMinus"><%- item.count %></span>
        <span><%-text.pc%></span>
        </div>
        </div>
        </div>
        </td>
        <td>
        <div class="s-t"><%-text.sum%></div>
        <div class="frame-prices f-s_0">
        <%if (item.origprice) { %>
        <span class="price-discount">
        <span>
        <span class="price priceOrigOrder"><%- parseFloat(item.count*item.origprice).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <% } %>
        <span class="current-prices f-s_0">
        <span class="price-new">
        <span>
        <span class="price priceOrder"><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <%/*%>
        <%if (nextCsCond){%>
        <span class="price-add">
        <span>
        <span class="price priceAddOrder"><%- parseFloat(item.count*item.addprice).toFixed(pricePrecision) %></span>
        <span class="curr-add"><%-nextCs%></span>
        </span>
        </span>
        <%}%>
        <%*/%>
        </span>
        </div>
        </td>
        </tr>
        <% } else { %>
        <!-- for product kit -->
        <% var i=0 %>
        <% var names = typeof item.name == "string" ? JSON.parse(item.name) : item.name %>
        <% var images = typeof item.img == "string" ? JSON.parse(item.img) : item.img %>
        <% var urls = typeof item.url == "string" ? JSON.parse(item.url) : item.url %>

        <% var prices = typeof item.prices == "string" ? JSON.parse(item.prices) : item.prices %>
        <% var addprices = typeof item.addprices == "string" ? JSON.parse(item.addprices) : item.addprices %>
        <% var origprices = typeof item.origprices == "string" ? JSON.parse(item.origprices) : item.origprices %>
        <% var prodstatus = typeof item.prodstatus == "string" ? JSON.parse(item.prodstatus) : item.prodstatus %>

        <tr class="row row-kits rowKits" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-kitId="<%- item.kitId %>" data-id="popupKit_<%- item.kitId %>">
        <td class="frame-items frame-items-kit">
        <div class="title-h3 c_9">{/literal}{lang('Комплект товаров', 'newLevel')}{literal}</div>
        <ul class="items items-bask">
        <% _.each(prices, function(id){  %>
        <li>
        <% if (i != 0){ %>
        <div class="next-kit">+</div>
        <% } %>
        <div class="frame-kit <% if (i == 0){%> main-product <% } %>">
        <% if (0==i) { %>
        <a class="frame-photo-title" href="<%- urls[i]%>">
        <span class="photo-block">
        <span class="helper"></span>
        <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
        </span>
        <span class="title"><%- names[i] %></span>
        </a>
        <div class="description">
        <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
        <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
        <%/*%>
        <div class="frame-prices f-s_0">
        <span class="current-prices f-s_0">
        <span class="price-new">
        <span>
        <span class="price"><%-parseFloat(prices[i]).toFixed(pricePrecision)%></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <%if (nextCsCond){%>
        <span class="price-add">
        <span>
        <span class="price"><%- parseFloat(addprices[i]).toFixed(pricePrecision) %></span>
        <span class="curr-add"><%-nextCs%></span>
        </span>
        </span>
        <%}%>
        </span>
        </div>
        <%*/%>
        </div>
        <% } else { %>

        <a class="frame-photo-title" href="<%- urls[i]%>">
        <span class="photo-block">
        <span class="helper"></span>
        <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
        </span>
        <span class="title"><%-names[i]%></span>
        </a>
        <div class="description">
        <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
        <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
        <%/*%>
        <div class="frame-prices f-s_0">
        <span class="price-discount">
        <span>
        <span class="price"><%-parseFloat(origprices[i]).toFixed(pricePrecision)%></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <span class="current-prices f-s_0">
        <span class="price-new">
        <span>
        <span class="price"><%-parseFloat(prices[i]).toFixed(pricePrecision)%></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <%if (nextCsCond){%>
        <span class="price-add">
        <span>
        <span class="price"><%- parseFloat(addprices[i]).toFixed(pricePrecision) %></span>
        <span class="curr-add"><%-nextCs%></span>
        </span>
        </span>
        <%}%>
        </span>
        </div>
        <%*/%>
        </div>
        <% } %>
        </div>
        </li>
        <% i++;  }); %>
        </ul>
        </td>
        <td data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-id="popupKit_<%- item.kitId %>">
        <div class="frame-frame-count">
        <div class="frame-count frameCount">
        <span class="s-t"><%-text.quant%></span>
        <div class="js-number" data-title="{/literal}{lang('Количество на складе','newLevel')}{literal} <%-item.maxcount%>">
        <div class="frameChangeCount" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-origprice="<%- item.origprice %>" data-addprice="<%- item.addprice %>" data-kit="<%-item.kit %>"></div>
        <span class="plusMinus"><%- item.count %></span>
        <span><%-text.pc%></span>
        </div>
        </div>
        </div>
        </td>
        <td>
        <div class="s-t"><%-text.sum%></div>
        <div class="frame-prices f-s_0">
        <%if (item.origprice) { %>
        <span class="price-discount">
        <span>
        <span class="price priceOrigOrder"><%- parseFloat(item.count*item.origprice).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <% } %>
        <span class="current-prices f-s_0">
        <span class="price-new">
        <span>
        <span class="price priceOrder"><%- parseFloat(item.count * item.price).toFixed(pricePrecision) %></span>
        <span class="curr"><%-curr%></span>
        </span>
        </span>
        <%/*%>
        <%if (nextCsCond){%>
        <span class="price-add">
        <span>
        <span class="price priceAddOrder"><%- parseFloat(item.count * item.addprice).toFixed(pricePrecision) %></span>
        <span class="curr-add"><%-nextCs%></span>
        </span>
        </span>
        <%}%>
        <%*/%>
        </span>
        </div>
        </div>
        </td>
        </tr>
        <% } %>

        <% }); %>
        </tbody>
        </table>
        </div>
        </div>
        <div class="js-empty empty">
        <div class="drop-header">
        <div class="title">{/literal}{lang('В вашей корзине','newLevel')}{literal} <span class="add-info">{/literal}{lang('пусто','newLevel')}{literal}</span></div>
        </div>
        <div class="drop-content">
        <div class="inside-padd">
        <div class="msg f-s_0">
        <div class="success"><span class="icon_info"></span><span class="text-el">{/literal}{lang('Вы удалили все товары из корзины','newLevel')}{literal}</span></div>
        </div>
        </div>
        </div>
        </div>
    {/literal}
</script>
<script type="text/template" id="orderPaymentSelect">
    {literal}
        <div class = "lineForm">
        <select id = "paymentMethod" name = "paymentMethodId" >
        <% _.each(data, function(item) { %>
        <option value = "<%-item.id%>"><%- item.name %></option>
        <% }) %>
        </select>
        </div>
    {/literal}
</script>
<script type="text/template" id="orderPaymentRadio">
    {literal}
        <div class="frame-radio">
        <% var i=0 %>
        <% _.each(data, function(item) { %>
        <div class="frame-label">
        <span class = "niceRadio b_n">
        <input type = "radio" name = "paymentMethodId" value = "<%-item.id%>" <% if (i == 0){ %>checked = "checked"<% i++} %>/>
        </span>
        <div class = "name-count">
        <span class = "text-el"><%-item.name%></span>
        </div>
        <div class="help-block"><%=item.description%></div>
        </div>
        <% }) %>
        </div>
    {/literal}
</script>
<script type="text/javascript">
    initDownloadScripts(['jquery.maskedinput-1.3.min', 'cusel-min-2.5', 'order'], 'initOrderTrEv', 'initOrder');
</script>