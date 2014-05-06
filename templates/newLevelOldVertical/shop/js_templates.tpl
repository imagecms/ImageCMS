<div id="popupCart" style="display: none;" class="drop drop-bask drop-style"></div>
<button type="button" data-drop="#popupCart" id="showCart" style="display: none;"></button>

<script type="text/template" id="cartPopupTemplate">
    {literal}
        <div class="frame-bask frameBask">
            <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
            <div class="no-empty js-no-empty">
                <div class="drop-header">
                    <div class="title bask"><span>{/literal}{lang('В корзине','newLevel')}{literal}</span> <span class="add-info"><span class="topCartCount"><%- Shop.Cart.totalCount %></span></span> <span class="plurProd"><%- pluralStr(Shop.Cart.totalCount, text.plurProd) %></span> <span>{/literal}{lang('Сумма','newLevel')}{literal}</span> <span class="add-info"><span class="topCartTotalPrice"><%- parseFloat(Shop.Cart.totalPrice).toFixed(pricePrecision) %></span></span> <%-curr%></div>
                </div>
                <div class="drop-content">
                    <div class="no-empty js-no-empty">
                            <div class="inside-padd">
                                <table class="table-order">
                                    <tbody>
                                        <% _.each(Shop.Cart.getAllItems(), function(item){ %>

        <!-- for single product -->
                                        <% if (!item.kit) { %>
                                        <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-id="popupProduct_<%- item.id+'_'+item.vId %>" class="items items-bask cart-product <%if(Shop.Cart.lastAdd.id == item.id && Shop.Cart.lastAdd.vId == item.vId){%>cart-last-add<%}%>">
                                            <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="ShopFront.Cart.rm(this);"></button></td>
                                            <td class="frame-items">
                                                <a href="<%-item.url%>" class="frame-photo-title">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="<%- item.img%>" alt="<%- '('+item.vname+')'%>"/>
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
                                            <td class="frame-count frameCount">
                                                <span class="countOrCompl"><%-text.pcs%></span>
                                                <div class="number js-number" data-title="{/literal}{lang('Количество на складе','newLevel')} {literal}<%-' '+item.maxcount%>">
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
                                                    <input type="text" value="<%- item.count %>" class="plusMinus plus-minus" data-title="{/literal}{lang('Только цифры','newLevel')}{literal}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                </div>
                                            </td>
                                            <td class="frame-cur-sum-price">
                                                <span class="title">{/literal}{lang('Сумма','newLevel')}{literal}: </span>
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
                                                            <%/*if (nextCsCond){%>
                                                            <span class="price-add">
                                                                <span>
                                                                    <span class="price priceAddOrder"><%- parseFloat(item.count*item.addprice).toFixed(pricePrecision) %></span>
                                                                    <span class="curr-add"><%-nextCs%></span>
                                                                </span>
                                                            </span>
                                                            <%}*/%>
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

                                        <tr class="rowKits row-kits" data-prodid="<%- item.id %>" data-kitId="<%- item.kitId %>" data-varid="<%- item.vId %>" data-id="popupKit_<%- item.kitId %>">
                                            <td class="frame-remove-bask-btn"><button type="button" class="icon_times_cart" onclick="ShopFront.Cart.rm(this, true);"></button></td>
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
                                            <td class="frame-count frameCount">
                                                <span class="countOrCompl"><%-text.kits%></span>
                                                <div class="number js-number" data-title="{/literal}{lang('Количество на складе','newLevel')}{literal} <%-' '+item.maxcount%>">
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
                                                    <input type="text" value="<%- item.count %>" class="plusMinus plus-minus" data-title="{/literal}{lang('Только цифры','newLevel')}{literal}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                </div>
                                            </td>
                                            <td class="frame-cur-sum-price">
                                                <span class="title">{/literal}{lang('Сумма','newLevel')}{literal}: </span>
                                                <div class="frame-prices f-s_0">
                                                    <span class="price-discount">
                                                        <span>
                                                            <span class="price priceOrigOrder"><%- parseFloat(item.count*item.origprice).toFixed(pricePrecision) %></span>
                                                            <span class="curr"><%-curr%></span>
                                                        </span>
                                                    </span>
                                                    <span class="current-prices f-s_0">
                                                        <span class="price-new">
                                                            <span>
                                                                <span class="price priceOrder"><%- parseFloat(item.count * item.price).toFixed(pricePrecision) %></span>
                                                                <span class="curr"><%-curr%></span>
                                                            </span>
                                                        </span>
                                                        <%/*if (nextCsCond){%>
                                                        <span class="price-add">
                                                            <span>
                                                                <span class="price priceAddOrder"><%- parseFloat(item.count * item.addprice).toFixed(pricePrecision) %></span>
                                                                <span class="curr"><%-nextCs%></span>
                                                            </span>
                                                        </span>
                                                        <%}*/%>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <% } %>

                                        <% }); %>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="footer-bask drop-footer">
                        <div class="inside-padd">
                            <div class="clearfix">
                                <span class="frame-discount frameDiscount">
                                    <span class="s-t">{/literal}{lang('Ваша текущая скидка','newLevel')}{literal}:</span>
                                    <span class="text-discount current-discount"><span class="curDiscount"></span> <span class="curr"><%-curr%></span></span>
                                </span>
                                <% if (orderDetails) { %>
                                <div class="btn-form f_l">
                                    <button type="button" data-closed="closed-js">
                                        <span class="text-el"><span class="f-s_14">←</span> {/literal}{lang('Вернуться к оформлению','newLevel')}{literal}</span>
                                    </button>
                                </div>
                                <% } %>
                                <span class="s-t">{/literal}{lang('Всего','newLevel')}{literal}:</span>
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
                            </div>
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
            <div class="empty js-empty">
                <div class="drop-header">
                    <div class="title">{/literal}{lang('Ваша корзина','newLevel')}{literal} <span class="add-info">{/literal}{lang('пуста','newLevel')}{literal}</span></div>
                </div>
                <div class="drop-content">
                    <div class="inside-padd">
                        <div class="msg f-s_0">
                            <div class="success"><span class="icon_info"></span><span class="text-el">{/literal}{lang('Вы удалили все элементы из корзины','newLevel')}{literal}</span></div>
                        </div>
                        <% if (!orderDetails) { %>
                        <div class="btn-form">
                            <button type="button" data-closed="closed-js">
                                <span class="text-el"><span class="f-s_14">←</span> {/literal}{lang('Вернуться к покупкам','newLevel')}{literal}</span>
                            </button>
                        </div>
                        <% } %>
                    </div>
                </div>
            </div>
        </div>
    {/literal}  
</script>

{#
/**
* @file Render autocomplete results
* @partof main.tpl
* @updated 25 February 2013;
* Variables
*   items : (object javascript) Contain found products
*/
#}
{literal}
    <script type="text/template" id="searchResultsTemplate">
        <div class="inside-padd">
        <% if (_.keys(items).length > 1) { %>
        <ul class="items items-search-autocomplete">
        <% _.each(items, function(item){
        if (item.name != null){%>
        <li>{/literal}
        <!-- Start. Photo Block and name  -->
        <a href="{shop_url('product')}/{literal}<%- item.url %>" class="frame-photo-title">
        <span class="photo-block">
        <span class="helper"></span>
        <img src="<%- item.smallImage %>">
        </span>
        <span class="title"><% print(item.name)  %></span>
        <!-- End. Photo Block and name -->

        <span class="description">
        <!-- Start. Product price  -->
        <span class="frame-prices f-s_0">
        <span class="current-prices var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
        <span class="price-new">
        <span>
        <span class="price"><%- item.price %></span>{/literal}
        <span class="curr">{$CS}</span>{literal}
        </span>
        </span>
        <% if (item.nextCurrency != null) { %>
        <span class="price-add">
        <span>
        (<span class="price addCurrPrice"><%- item.nextCurrency %></span>
    {/literal}<span class="curr-add">{$NextCS}</span>){literal}                                            
        </span>
        </span>
        <% } %>
        </span>
        </span>
        </span>
        <!-- End. Product price  -->
        </a>
        </li>
        <% }
        }) %>
        </ul>
        <!-- Start. Show link see all results if amount products >0  -->
        <div>
        <div class="btn-autocomplete">{/literal}
        <a href="{shop_url('search')}?text={literal}<%- items.queryString %>" {/literal} class="f-s_0 t-d_u">
        <span class="icon_show_all"></span><span class="text-el">{lang('Посмотреть все результаты','newLevel')} →</span>
        </a>
        </div>{literal}
        <!-- End. Show link  -->
        <% } else {%>    
    {/literal}<div class="msg f-s_0">
    <div class="info"><span class="icon_info"></span><span class="text-el">{echo ShopCore::t(lang('По Вашему запросу ничего не найдено','newLevel'))}</span></div>
    </div>{literal}
    <% }%>
    </div>
    </div>
</script>
{/literal}
    {literal}
        <script type="text/template" id="reportappearance">
            <% var nextCsCond = nextCs == '' ? false : true %>
            <ul class="items items-bask item-report">
            <li>
            <a href="<%-item.url%>" class="frame-photo-title" title="<%-item.name%>">
            <span class="photo-block">
            <span class="helper"></span>
            <img src="<%-item.img%>" alt="<%-item.name%>">
            </span>
            <span class="title"><%-item.name%></span>
            </a>
            <div class="description">
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
            <span class="price priceVariant"><%-parseFloat(item.price).toFixed(pricePrecision)%></span>
            <span class="curr"><%-curr%></span>
            </span>
            </span>
            <%if (nextCsCond){%>
            <span class="price-add">
            <span>
            (<span class="price addCurrPrice"><%-parseFloat(item.addprice).toFixed(pricePrecision)%></span>
            <span class="curr-add"><%-nextCs%></span>)
            </span>
            </span>
            <%}%>
            </span>
            </div>
            </div>
            </li>
            </ul>
        </script>
    {/literal}
    <span class="tooltip"></span>
    <div class="apply">
        <div class="content-apply">
            <a href="#">{lang('Фильтр','newLevel')}</a>
            <div class="description">{lang('Найдено','newLevel')} <span class="f-s_0"><span id="apply-count">5</span><span class="text-el">&nbsp;</span><span class="plurProd"></span></span></div>
        </div>
        <button type="button" class="icon_times_drop icon_times_apply"></button>
    </div>
    <div class="drop drop-style" id="notification">
        <div class="drop-content-notification">
            <div class="inside-padd notification">

            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
    <button style="display: none;" type="button" data-drop="#notification"  data-modal="true" data-effect-on="fadeIn" data-effect-off="fadeOut" class="trigger"></button>

   <div class="drop drop-style" id="confirm">
        <div class="drop-header">
            <div class="title">{lang('Удалить список?' , 'newLevel')}</div>
        </div>
        <div class="drop-content-confirm">
            <div class="inside-padd cofirm w-s_n-w">
                <div class="btn-def">
                    <button type="button" data-button-confirm data-modal="true">
                        <span class="text-el">{lang('Подтвердить' , 'newLevel')}</span>
                    </button>
                </div>
                <div class="btn-def">
                    <button type="button" data-closed="closed-js">
                        <span class="text-el">{lang('Отменить' , 'newLevel')}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
    <button style="display: none;" type="button" data-drop="#confirm"  data-modal="true" data-confirm="true" data-effect-on="fadeIn" data-effect-off="fadeOut"></button>
    {if !$is_logged_in}
        <div class="drop drop-style" id="dropAuth">
            <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
            <div class="drop-content t-a_c" style="width: 350px;min-height: 0;">
                <div class="inside-padd">
                    {lang('Для того, что бы добавить товар в список желаний, Вам нужно', 'newLevel')} <button type="button" class="d_l_1" data-drop=".drop-enter" data-source="{site_url('auth')}">{lang('авторизоваться', 'newLevel')}</button>
                </div>
            </div>
        </div>
    {/if}