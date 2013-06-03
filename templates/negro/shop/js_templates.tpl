<!-- floating elements-->
<div id="popupCart" style="display: none;" class="drop drop-bask drop-style"></div>
<a href="#" data-drop="#popupCart" data-place="center" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" id="showCart" style="display: none;"></a>

<script type="text/template" id="cartPopupTemplate">
    {literal}   
    <div class="fancy-cleaner">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="togglePopupCart()"></button>
        <div class="drop-header">
            <div class="title">Ваша корзина</div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">

                <div class="msg" style="display: none;"><div class="success">Ваша корзина пуста.</div></div>

                <table class="table-order">
                    <tbody>
                        <% _.each(Shop.Cart.getAllItems(), function(item){ %>

                        <!-- for single product -->
                        <% if (!item.kit) { %>
                        <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupProduct_<%- item.id+'_'+item.vId %>">
                            <td><button class="icon_times_remove_cart" onclick="rmFromPopupCart(this);"></button></td>
                            <td>
                                <a href="<%-item.url%>" class="d_i-b photo">
                                    <figure>
                                        <img src="<% if(item.img) { %><%-item.img%><% } else { %>/uploads/shop/<%- item.id %>_mainMod.jpg<% } %>" alt="<%- '('+item.vname+')'%>"/>
                                    </figure>
                                </a>
                            </td>
                            <td>
                                <a href="<%-item.url%>"><%- item.name %></a><%if(item.vname) {%> <%- '('+item.vname+')'%><%}%><span class="c_97"><% if (item.number) { %> (<%- item.number %>) <% } %></span>
                                <div class="price price_f-s_16">
                                    <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(pricePrecision) %></span> <%-curr%>.</span>
                                </div>
                            </td>
                            <td>
                                <div class="frame-count number" data-title="количество на складе <%-item.maxcount%>">
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
                                <span class="countOrCompl"><%-pcs%></span>
                            </td>
                            <td>
                                <span class="d_b">Сумма: </span>
                                <div class="price price_f-s_16 d_i-b">
                                    <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span> <%-curr%></span>
                                </div>
                            </td>
                        </tr>
                        <% } else { %>
                        <!-- for product kit -->
                        <% var i=0 %>
                        <% var names = item.name %>
                        <% var ids = item.id %>
                        <% var prices = item.prices %>

                        <tr class="cartKit" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupKit_<%- item.kitId %>">
                            <td colspan="5">
                                <table>
                                    <colgroup>
                                        <col width="20px">
                                        <col width="80px">
                                        <col width="260px">
                                        <col width="140px">
                                        <col width="140px">
                                    </colgroup>
                                    <tbody>

                                        <% _.each(ids, function(id){  %>

                                        <% if (0==i) { %>

                                        <tr>
                                            <td rowspan="<%- names.length %>"><button class="icon_times_remove_cart" onclick="rmFromPopupCart(this, true);"></button></td>
                                            <td>
                                                <a class="photo" href="#">
                                                    <figure>
                                                        <img src="/uploads/shop/<%-id%>_mainMod.jpg" alt="<%- '('+item.vname+')'%>">
                                                    </figure>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#"><%- names[i] %></a>
                                                <div class="price price_f-s_16">
                                                    <span class="first_cash"><span class="f-w_b"><%-prices[i]%></span> <%-curr%></span>
                                                </div>
                                            </td>
                                            <td rowspan="<%- names.length %>">
                                                <div class="frame-count number" data-title="количество на складе <%-item.maxcount%>">
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
                                                <span class="countOrCompl"><%-pcs%></span>
                                            </td>
                                            <td rowspan="<%- names.length %>">
                                                <span>Сумма: </span>
                                                <div class="price price_f-s_16 d_i-b">
                                                    <span class="first_cash"><span class="f-w_b"><%-parseFloat(item.price*item.count).toFixed(pricePrecision)%></span> <%-curr%></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <% } else { %> 

                                        <tr>
                                            <td>
                                                <a class="d_i-b photo" href="#">
                                                    <figure>
                                                        <img src="/uploads/shop/<%-id%>_mainMod.jpg" alt="<%- '('+item.vname+')'%>">
                                                    </figure>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#"><%-names[i]%></a>
                                                <div class="price price_f-s_16">
                                                    <span class="first_cash"><span class="f-w_b"><%-prices[i]%></span> <%-curr%></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <% }; i++;  %>

                                        <% }); %>

                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <% } %>

                        <% }); %>
                    </tbody>
                </table>
            </div>
            <div class="inside-padd foot">
                <table class="table-order">
                    <colgroup>
                        <col width="20px"/>
                        <col width="80px"/>
                        <col width="260px"/>
                        <col width="140px"/>
                        <col width="140px"/>
                    </colgroup>
                    <tfoot>
                        <tr>
                            <% if ( Shop.Cart.totalCount  == 0 ) { %>
                            <td colspan="5"><div class="form_alert">
                                    <p>Ваша корзина пуста</p>
                                </div></td>
                        </tr>
                        <tr>
                            <% } %>
                            <% if ( document.getElementById('orderDetails')) { %>
                            <% if ( Shop.Cart.totalCount  == 0 ) { %>
                            <% setTimeout("location.href = '/';", 2000); %>
                            <% } %>
                            <td colspan="4" class="t-a_r">
                            </td>
                            <% } else { %>
                            <td colspan="4">
                                <a href="/shop/cart" class="btn_cart m-r_30 f_r">Оформить заказ</a>
                                <button type="button" onclick="togglePopupCart()" class="d_l_b w-s_n-w f_l">← Продолжить покупки</button>
                            </td>

                            <% } %>
                            <td>
                                <div class="t-a_l d_i-b v-a_m">
                                    <span class="d_b">Итого:</span>
                                    <div class="price price_f-s_24">
                                        <span class="first_cash"><span class="f-w_b" id="popupCartTotal"><%- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span> <%-curr%></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {/literal}  
</script>

<script type="text/template" id="orderDetailsTemplate">
    {literal}
    <div class="frame_head_content">
        <div class="title">Ваш заказ</div>
        <table class="table-order preview-order">
            <tbody>
                <% _.each(Shop.Cart.getAllItems(), function(item){ %>
                <% if (!item.kit) { %>
                <tr>
                    <td class="v-a_m">
                        <a class="photo" href="<%-item.url%>">
                            <figure>
                                <img src="<% if(item.img) { %><%-item.img%><% } else { %>/uploads/shop/<%- item.id %>_mainMod.jpg<% } %>" alt="<%- '('+item.vname+')'%>">
                            </figure>
                        </a>
                    </td>
                    <td>
                        <a href="<%-item.url%>"><%- item.name %></a><%if(item.vname)%> <%- '('+item.vname+')'%><span class="c_97"><% if (item.number) { %> (<%-item.number %>) <% } %></span>
                        <div class="price price_f-s_16">
                            <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(pricePrecision) %></span> <%- curr %>.</span>
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

                <tr class="cartKit" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>">
                    <td colspan="4">
                        <table>
                            <tbody>

                                <% _.each(ids, function(id){  %>

                                <% if (0==i) { %>

                                <tr>
                                    <td>
                                        <a class="photo" href="#">
                                            <figure>
                                                <img src="/uploads/shop/<%-id%>_mainMod.jpg" alt="<%- '('+item.vname+')'%>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"><%- names[i] %></a>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b"><%-prices[i]%></span> <%-curr%></span>
                                        </div>
                                    </td>
                                    <td rowspan="<%- names.length %>" class="v-a_m">
                                        <span class="c_8a">х</span> <span class="f-w_b f-s_16"><%- item.count %></span> <%-kits%> =
                                    </td>
                                    <td rowspan="<%- names.length %>" class="v-a_m">
                                        <span>Сумма: </span>
                                        <div class="price price_f-s_16 d_i-b">
                                            <span class="first_cash"><span class="f-w_b"><%-  parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(pricePrecision) %></span> <%- curr %></span>
                                        </div>
                                    </td>
                                </tr>

                                <% } else { %> 

                                <tr>
                                    <td>
                                        <a class="d_i-b photo" href="#">
                                            <figure>
                                                <img src="/uploads/shop/<%-id%>_mainMod.jpg" alt="<%- '('+item.vname+')'%>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#"><%-names[i]%></a>
                                        <div class="price price_f-s_16">
                                            <span class="first_cash"><span class="f-w_b"><%-prices[i]%></span> <%-curr%></span>
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
                        <div class="f_l">
                            <span class="helper"></span>
                            <button class="d_l_b" type="button" onclick="initShopPage();">Редактировать</button>
                        </div>
                        <div class="f_r">
                            <span class="v-a_m">Итого:&nbsp;&nbsp;</span>
                            <span class="price price_f-s_24 v-a_m d_i-b">
                                <span class="first_cash"><span class="f-w_b"><%- parseFloat( Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span> <%- curr %></span>
                            </span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
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