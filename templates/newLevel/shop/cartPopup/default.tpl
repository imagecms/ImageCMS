<div id="popupCart" class="drop drop-bask drop-style">
    <div class="frame-bask frameBask">
        <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
        <div class="no-empty js-no-empty">
            <div class="drop-header">
                <div class="title bask"><span>{lang('В корзине','newLevel')}</span><span class="add-info"><span class="topCartCount"><%- Shop.Cart.totalCount %></span></span> <span class="plurProd"><%- pluralStr(Shop.Cart.totalCount, text.plurProd) %></span> <span>{lang('Сумма','newLevel')}</span> <span class="add-info"><span class="topCartTotalPrice"><%- parseFloat(Shop.Cart.totalPrice).toFixed(pricePrecision) %></span></span> <%-curr%></div>
            </div>
            <div class="drop-content">
                <div class="no-empty js-no-empty">
                    <div class="frame-bask-main">
                        <div class="inside-padd">
                            <table class="table-order">
                                <tbody>
                                    {foreach $items as $item}
                                        {var_dump($item)}
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
                                                <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{lang('Вариант','newLevel')}  <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
                                                <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
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
                                            <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} <%-' '+item.maxcount%>">
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
                                                <input type="text" value="<%- item.count %>" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                            </div>
                                        </td>
                                        <td class="frame-cur-sum-price">
                                            <span class="title">{lang('Сумма','newLevel')}: </span>
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
                                            </div>
                                        </td>
                                    </tr>
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
                                                            <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{lang('Вариант','newLevel')}  <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
                                                            <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
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
                                                            <%if(item.vname){ %><span class="frame-variant-name frameVariantName">{lang('Вариант','newLevel')}  <span class="code js-code">(<%- item.vname%>)</span></span> <% } %>
                                                            <%if (item.number) { %><span class="frame-variant-code frameVariantCode">{lang('Артикул','newLevel')}  <span class="code js-code">(<%-item.number %>)</span></span> <% } %>
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
                                            <div class="number js-number" data-title="{lang('Количество на складе','newLevel')} <%-' '+item.maxcount%>">
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
                                                <input type="text" value="<%- item.count %>" class="plusMinus plus-minus" data-title="{lang('Только цифры','newLevel')}" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                            </div>
                                        </td>
                                        <td class="frame-cur-sum-price">
                                            <span class="title">{lang('Сумма','newLevel')}: </span>
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
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frame-foot drop-footer">
                <div class="header-frame-foot">
                    <div class="inside-padd">
                        <div class="clearfix">
                            <span class="frame-discount frameDiscount">
                                <span class="s-t">{lang('Ваша текущая скидка','newLevel')}:</span>
                                <span class="text-discount current-discount"><span class="curDiscount"></span> <span class="curr"><%-curr%></span></span>
                            </span>
                            <% if (orderDetails) { %>
                            <div class="btn-form f_l">
                                <button type="button" data-closed="closed-js">
                                    <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к оформлению','newLevel')}</span>
                                </button>
                            </div>
                            <% } %>
                            <span class="s-t">{lang('Всего','newLevel')}:</span>
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
                    </div>
                    <% if (!orderDetails) { %>
                    <div class="content-frame-foot">
                        <div class="clearfix inside-padd">
                            <div class="btn-form f_l">
                                <button type="button" data-closed="closed-js">

                                    <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevel')}</span>
                                </button>
                            </div>
                            <div class="btn-cart btn-cart-p f_r">
                                <a href="/shop/cart">
                                    <span class="icon_cart_p"></span>
                                    <span class="text-el">{lang('Оформить заказ','newLevel')}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <% } %>
                </div>
            </div>
        </div>
        <div class="empty js-empty">
            <div class="drop-header">
                <div class="title">{lang('Ваша корзина','newLevel')} <span class="add-info">{lang('пуста','newLevel')}</span></div>
            </div>
            <div class="drop-content">
                <div class="inside-padd">
                    <div class="msg f-s_0">
                        <div class="success"><span class="icon_info"></span><span class="text-el">{lang('Вы удалили все элементы из корзины','newLevel')}</span></div>
                    </div>
                    <% if (!orderDetails) { %>
                    <div class="btn-form">
                        <button type="button" data-closed="closed-js">
                            <span class="text-el"><span class="f-s_14">←</span> {lang('Вернуться к покупкам','newLevel')}</span>
                        </button>
                    </div>
                    <% } %>
                </div>
            </div>
        </div>
    </div>
</div>