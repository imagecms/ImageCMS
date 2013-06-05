<!-- floating elements-->
<div id="popupCart" style="display: none;" class="drop drop-bask drop-style"></div>
<a href="#" data-drop="#popupCart" id="showCart" style="display: none;"></a>

<script type="text/template" id="cartPopupTemplate">
    {literal}   
    <div class="fancy-bask">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="togglePopupCart()"></button>
        <div class="drop-header">
            <div class="title">В вашей корзине <span class="add-info"><%- Shop.Cart.totalCount %></span> товара на сумму <span class="add-info"><%- Shop.Cart.totalPrice %></span> <%-curr%></div>
        </div>
        <div class="drop-content">
            <div class="frame-bask-scroll">
                <div class="frame-bask-main">
                    <div class="inside-padd">
                        <div class="msg" style="display: none;"><div class="success">Ваша корзина пуста.</div></div>
                        <table class="table-order">
                            <tbody>
                                <% _.each(Shop.Cart.getAllItems(), function(item){ %>

                                <!-- for single product -->
                                <% if (!item.kit) { %>
                                <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupProduct_<%- item.id+'_'+item.vId %>" class="items items-bask">
                                    <td class="frame-remove-bask-btn"><button class="icon_times_remove_cart" onclick="rmFromPopupCart(this);"></button></td>
                                    <td class="frame-items">
                                        <a href="<%-item.url%>" class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<%- item.img%>" alt="<%- '('+item.vname+')'%>">
                                            </span>
                                            <span class="title"><%- item.name %>
                                        </a>
                                        <div class="description">
                                            <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                            <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                            <div class="frame-prices f-s_0">
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price"><%- parseFloat(item.price).toFixed(pricePrecision) %></span>
                                                            <span class="curr"><%-curr%></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="frame-count" data-title="количество на складе <%-item.maxcount%>">
                                        <span class="countOrCompl"><%-pcs%></span>
                                        <div class="number">
                                            <div class="frame-change-count" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" >
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
                                            <input type="text" value="<%- item.count %>" data-rel="plusminus" data-title="только цифры" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                        </div>
                                    </td>
                                    <td class="frame-cur-sum-price">
                                        <span class="title">Сумма: </span>
                                        <div class="frame-prices f-s_0">
                                            <span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
                                                        <span class="price" data-rel="priceOrder"><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span>
                                                        <span class="curr"><%-curr%></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <% } else { %>
                                <!-- for product kit -->
                                <% var i=0 %>
                                <% var names = item.name %>
                                <% var ids = item.id %>
                                <% var prices = item.prices %>
                                <% var images = item.img %>
                                <% var urls = item.url %>

                                <tr class="cartKit" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupKit_<%- item.kitId %>">
                                    <td colspan="4">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="frame-remove-bask-btn"><button class="icon_times_remove_cart" onclick="rmFromPopupCart(this, true);"></button></td>
                                                    <td class="frame-items frame-items-kit">
                                                        <ul class="items items-bask">
                                                            <% var idsL = ids.length; _.each(ids, function(id){  %>
                                                            <li>
                                                                <div class="frame-kit">
                                                                    <% if (0==i) { %>
                                                                    <a class="frame-photo-title" href="#">
                                                                        <span class="photo-block">
                                                                            <span class="helper"></span>
                                                                            <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                                        </span>
                                                                        <span class="title"><%- names[i] %></span>
                                                                    </a>
                                                                    <div class="description">
                                                                        <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                                        <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                                        <div class="frame-prices f-s_0">
                                                                            <span class="current-prices f-s_0">
                                                                                <span class="price-new">
                                                                                    <span>
                                                                                        <span class="price"><%-prices[i]%></span>
                                                                                        <span class="curr"><%-curr%></span>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <% } else { %>

                                                                    <a class="frame-photo-title" href="#">
                                                                        <span class="photo-block">
                                                                            <span class="helper"></span>
                                                                            <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                                        </span>
                                                                        <span class="title"><%-names[i]%></span>
                                                                    </a>
                                                                    <div class="description">
                                                                        <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                                        <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                                        <div class="frame-prices f-s_0">
                                                                            <span class="current-prices f-s_0">
                                                                                <span class="price-new">
                                                                                    <span>
                                                                                        <span class="price"><%-prices[i]%></span>
                                                                                        <span class="curr"><%-curr%></span>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <% } %>
                                                                </div>
                                                                <% if (i != idsL-1){ %>
                                                                <div class="next-kit">+</div>
                                                                <% } %>
                                                            </li>
                                                            <% i++;  }); %>
                                                        </ul>
                                                    </td>
                                                    <td class="frame-count" data-title="количество на складе <%-item.maxcount%>">
                                                        <span class="countOrCompl"><%-kits%></span>
                                                        <div class="number">
                                                            <div class="frame-change-count" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-kit="<%-item.kit %>">
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
                                                            <input type="text" value="<%- item.count %>" data-rel="plusminus" data-title="только цифры" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                        </div>
                                                    </td>
                                                    <td class="frame-cur-sum-price">
                                                        <span class="title">Сумма: </span>
                                                        <div class="frame-prices f-s_0">
                                                            <span class="current-prices f-s_0">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price" data-rel="priceOrder"><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span>
                                                                        <span class="curr"><%-curr%></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <% } %>

                                <% }); %>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="frame-foot">
                <div class="inside-padd">
                    <table class="table-order">
                        <tfoot>
                            <% if ( Shop.Cart.totalCount  == 0 ) { %>
                            <tr>
                                <td colspan="4">
                                    <div class="form_alert">
                                        <p>Ваша корзина пуста</p>
                                    </div>
                                </td>
                            </tr>
                            <% } %>
                            <tr>
                                <% if ( document.getElementById('orderDetails')) { %>
                                <% if ( Shop.Cart.totalCount  == 0 ) { %>
                                <% setTimeout("location.href = '/';", 2000); %>
                                <% } %>
                                <td colspan="3">&nbsp;</td>
                                <% } else { %>
                                <td colspan="3">
                                    <div class="btn-cart-p">
                                        <a href="/shop/cart">
                                            <span class="icon_cart_p"></span>
                                            <span class="text-el">Оформить заказ</span>
                                        </a>
                                    </div>
                                    <div class="btn-form">
                                        <button type="button" onclick="togglePopupCart()">
                                            <span class="icon_form"></span>
                                            <span class="text-el">← Продолжить покупки</span>
                                        </button>
                                    </div>
                                </td>

                                <% } %>
                                <td>
                                    <div class="frame-gen-sum-price">
                                        <span class="title">Итого:</span>
                                        <div class="frame-prices f-s_0">
                                            <span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
                                                        <span class="price" id="popupCartTotal"><%- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span>
                                                        <span class="curr"><%-curr%></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {/literal}  
</script>

<script type="text/template" id="orderDetailsTemplate">
    {literal}
    <div class="frame-head-order">
        <div class="title">Ваш заказ</div>
    </div>
    <div class="frame-bask-main preview-order">
        <div class="inside-padd">
            <table class="table-order">
                <tbody>
                    <% _.each(Shop.Cart.getAllItems(), function(item){ %>
                    <% if (!item.kit) { %>
                    <tr class="items items-bask">
                        <td>
                            <a class="frame-photo-title" href="<%-item.url%>">
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="<%- item.img%>" alt="<%- '('+item.vname+')'%>">
                                </span>
                                <span class="title"><%if(item.vname)%> <%- '('+item.vname+')'%></span>
                            </a>
                            <div class="description">
                                <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                <div class="frame-prices f-s_0">
                                    <span class="current-prices f-s_0">
                                        <span class="price-new">
                                            <span>
                                                <span class="price"><%- parseFloat(item.price).toFixed(pricePrecision) %></span>
                                                <span class="curr"><%-curr%></span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="c_8a">х</span> <span class="f-w_b f-s_16"><%- item.count %></span> <%- pcs %> =
                        </td>
                        <td>
                            <div class="price price_f-s_16">
                                <span class="first_cash"><span class="f-w_b"><%-  parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(pricePrecision) %></span> <%- curr %></span>
                            </div>
                        </td>
                    </tr>

                    <% } else { %>
                    <!-- for product kit -->
                    <% var i=0 %>
                    <% var names = item.name %>
                    <% var ids = item.id %>
                    <% var prices = item.prices %>
                    <% var images = item.img %>
                    <% var urls = item.url %>

                    <tr class="cartKit" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>">
                        <td colspan="4">
                            <table>
                                <tbody>

                                    <% _.each(ids, function(id){  %>

                                    <% if (0==i) { %>

                                    <tr class="items items-bask">
                                        <td>
                                            <a class="frame-photo-title" href="#">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                </span>
                                                <span class="title"><%- names[i] %></span>
                                            </a>
                                            <div class="description">
                                                <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                <div class="frame-prices f-s_0">
                                                    <span class="current-prices f-s_0">
                                                        <span class="price-new">
                                                            <span>
                                                                <span class="price"><%-prices[i]%></span>
                                                                <span class="curr"><%-curr%></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="v-a_m">
                                            <span class="c_8a">х</span> <span class="f-w_b f-s_16"><%- item.count %></span> <%-kits%> =
                                        </td>
                                        <td class="frame-cur-sum-price">
                                            <span class="title">Сумма: </span>
                                            <div class="frame-prices f-s_0">
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price" data-rel="priceOrder"><%- parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(pricePrecision) %></span>
                                                            <span class="curr"><%-curr%></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>

                                    <% } else { %> 

                                    <tr class="items items-bask">
                                        <td>
                                            <a class="frame-photo-title" href="#">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                </span
                                                <span class="title"><%-names[i]%></span>
                                            </a>
                                            <div class="description">
                                                <%if(item.vname){ %><span class="frame-variant-name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                <%if (item.number) { %><span class="frame-number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                <div class="frame-prices f-s_0">
                                                    <span class="current-prices f-s_0">
                                                        <span class="price-new">
                                                            <span>
                                                                <span class="price"><%-prices[i]%></span>
                                                                <span class="curr"><%-curr%></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <% }; i++;  %>

                                    <% }) %>

                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <% } %>

                    <% }) %>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="frame-foot">
                                <div class="inside-padd">
                                    <div class="foot-left-order">
                                        <span class="helper"></span>
                                        <div class="btn-edit-bask">
                                            <button class="d_l_1" type="button" onclick="initShopPage();">
                                                <span class="text-el d_l_1">Редактировать</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="foot-right-order frame-gen-sum-price">
                                        <span class="title">Итого:</span>
                                        <div class="frame-prices f-s_0">
                                            <span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
                                                        <span class="price"><%- parseFloat( Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span>
                                                        <span class="curr"><%-curr%></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
        </div>
    </div>
    {/literal}
</script>

<div class="apply">
    <div>
        <div class="description">Найдено <span id="apply-count">5</span> тов.</div>
        <a href="#">Показать</a>
    </div>
    <span class="icon_times-apply"></span>
</div>