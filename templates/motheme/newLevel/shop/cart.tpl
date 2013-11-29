<div class="frame-inside page-cart pageCart">
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
                            <div class="frame-label" id="frameDelivery">
                                <span class="title">{lang('Доставка:','newLevel')}</span>
                                {$counter = true}
                                <div class="frame-form-field check-variant-delivery">
                                    {/*<div class="lineForm">
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
                                    {$counter = true}
                                    {/*<div class="lineForm">
                                        <select name="paymentMethodId" id="paymentMethod">
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
                                                <span class="price frame-gen-discount genDiscount" id="totalPrice">{echo str_replace(',', '.', ShopCore::app()->SCart->totalPrice())}</span>
                                                <span class="curr frame-gen-discount genDiscount">{$CS}</span>
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
<script type="text/template" id="orderDetailsTemplate">
    {literal}   
        <div class="frameBask frame-bask frame-bask-order">
            <div class="no-empty">
                <div class="frame-bask-main">
                    <div class="inside-padd">
                        <table class="table-order">
                            <tbody>
                                <% _.each(Shop.Cart.getAllItems(), function(item){ %>

        <!-- for single product -->
                                <% if (!item.kit) { %>
                                <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-id="popupProduct_<%- item.id+'_'+item.vId %>" class="items items-bask cartProduct">
                                    <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="rmFromPopupCart(this);"></button></td>
                                    <td class="frame-items">
                                        <a href="<%-item.url%>" class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<%- item.img%>" alt="<%- '('+item.vname+')'%>">
                                            </span>
                                            <span class="title"><%- item.name %>
                                        </a>
                                        <div class="description">
                                            <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                            <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
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
                                            <div class="frame-frame-count">
                                                <div class="frame-count frameCount">
                                                    <div class="number d_i-b" data-title="{/literal}{lang('Количество на складе','newLevel')}{literal} <%-' '+item.maxcount%>">
                                                        <div class="frame-change-count frameChangeCount" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-addprice="<%- item.addprice %>" data-origprice="<%- item.origprice %>">
                                                            <div class="btn-plus">
                                                                <button type="button">
                                                                    <span class="icon-plus"></span>
                                                                </button>
                                                            </div>
                                                            <div class="btn-minus">
                                                                <button type="button">
                                                                    <span class="icon-minus"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <input type="text" value="<%- item.count %>" class="plusMinus" data-title="{/literal}{lang('Только цифры','newLevel')}{literal}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                    </div>
                                                    <span class="countOrCompl"><%-pluralStr(item.count, plurProd)%></span>
                                                </div>
                                            </div>
                                            <div class="frame-cur-sum-price">
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
                                                                <span class="price priceOrder><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span>
                                                                <span class="curr"><%-curr%></span>
                                                            </span>
                                                        </span>
                                                        <%if (nextCsCond){%>
                                                        <span class="price-add">
                                                            <span>
                                                                <span class="price priceAddOrder"><%- parseFloat(item.count*item.addprice).toFixed(pricePrecision) %></span>
                                                                <span class="curr-add"><%-nextCs%></span>
                                                            </span>
                                                        </span>
                                                        <%}%>
                                                    </span>
                                                </div>
                                            </div>
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

                                <tr class="row-kits rowKits" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-kitId="<%- item.kitId %>" data-id="popupKit_<%- item.kitId %>">
                                    <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="rmFromPopupCart(this, true);"></button></td>
                                    <td class="frame-items frame-items-kit">
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
                                                        <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                        <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
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
                                                        <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{/literal}{lang('Вариант','newLevel')} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                        <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{/literal}{lang('Артикул','newLevel')} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
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
                                                    </div>
                                                    <% } %>
                                                </div>
                                            </li>
                                            <% i++;  }); %>
                                        </ul>
                                    </td>
                                </tr>
                                <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-id="popupKit_<%- item.kitId %>">
                                    <td class="frame-kits-gen-sum" colspan="2">
                                        <div class="kits-gen-sum">
                                            <img src="<%-theme%><%-colorScheme%>/images/kits_sum.png" />
                                        </div>
                                        <div class="frame-frame-count">
                                            <div class="frame-count frameCount">
                                                <div class="number" data-title="{/literal}{lang('Количество на складе','newLevel')}{literal} <%-item.maxcount%>">
                                                    <div class="frame-change-count frameChangeCount" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-origprice="<%- item.origprice %>" data-addprice="<%- item.addprice %>" data-kit="<%-item.kit %>">
                                                        <div class="btn-plus">
                                                            <button type="button">
                                                                <span class="icon-plus"></span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-minus">
                                                            <button type="button">
                                                                <span class="icon-minus"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <input type="text" value="<%- item.count %>" class="plusMinus" data-title="{/literal}{lang('Только цифры','newLevel')}{literal}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                </div>
                                                <span class="countOrCompl"><%-pluralStr(item.count, plurKits)%></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="frame-cur-sum-price">
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
                                                            <span class="price priceOrder""><%- parseFloat(item.count * item.price).toFixed(pricePrecision) %></span>
                                                            <span class="curr"><%-curr%></span>
                                                        </span>
                                                    </span>
                                                    <%if (nextCsCond){%>
                                                    <span class="price-add">
                                                        <span>
                                                            <span class="price priceAddOrder"><%- parseFloat(item.count * item.addprice).toFixed(pricePrecision) %></span>
                                                            <span class="curr-add"><%-nextCs%></span>
                                                        </span>
                                                    </span>
                                                    <%}%>
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
                <div class="frame-foot drop-footer">
                    <div class="header-frame-foot">
                        <div class="inside-padd">

                            <span class="frame-discount frameDiscount">

                                <span class="s-t">{/literal}{lang('Ваша текущая скидка','newLevel')}{literal}:</span>
                                <span class="text-discount current-discount"><span class="genDiscount"></span> <span class="curr"><%-curr%></span></span>

                            </span>

                            <span class="s-t">{/literal}{lang('Всего','newLevel')}{literal}:</span>
                            <span class="frame-cur-sum-price">
                                <span class="frame-prices f-s_0">
                                    <span class="price-discount">
                                        <span class="frame-discount frameDiscount">
                                            <span class="price genSumDiscount"></span>
                                            <span class="curr"><%-curr%></span>
                                        </span>
                                    </span>
                                    <span class="current-prices f-s_0">
                                        <span class="price-new">
                                            <span>
                                                <span class="price topCartTotalPrice"><%- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span>
                                                <span class="curr"><%-curr%></span>
                                            </span>
                                        </span>
                                        <%if (nextCsCond){%>
                                        <span class="price-add">
                                            <span>
                                                <span class="price topCartTotalAddPrice"><%- parseFloat(Shop.Cart.getTotalAddPrice()).toFixed(pricePrecision) %></span>
                                                <span class="curr-add"><%-nextCs%></span>
                                            </span>
                                        </span>
                                        <%}%>
                                    </span>
                                </span>
                            </span>
                        </div>
                        <% if (!orderDetails) { %>
                        <div class="content-frame-foot">
                            <div class="clearfix inside-padd">
                                <div class="btn-form f_l">
                                    <button type="button" data-closed="closed-js">
                                        <span class="text-el"><span class="f-s_14">←</span> {/literal}{lang('Вернуться к покупкам','newLevel')}{literal}</span>
                                    </button>
                                </div>
                                <div class="btn-cart btn-cart-p f_r">
                                    <a href="/shop/cart">
                                        <span class="icon_cart_p"></span>
                                        <span class="text-el">{/literal}{lang('Оформить заказ','newLevel')}{literal}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <% } %>
                    </div>
                </div>
            </div>
            <div class="empty">
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
        </div>
    {/literal}
</script>
{/* <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>*/}
<script type="text/javascript">
    initDownloadScripts(['_order'], 'initOrderTrEv', 'initOrder');
</script>