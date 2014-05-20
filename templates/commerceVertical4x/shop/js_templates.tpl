<!-- floating elements-->
<div id="popupCart" style="display: none;" class="drop"></div>
<a href="#" data-drop="#popupCart" data-place="center"data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" id="showCart" style="display: none;"></a>

<script type="text/template" id="cartPopupTemplate">
    {literal}   
    <div class="fancy fancy_cleaner frame_head_content">
        <div class="header_title">Ваша корзина
        </div>
        <button type="button" class="icon-times-enter" data-closed="closed-js" onclick="togglePopupCart()"></button>
        <div class="drop-content">
            <div class="inside_padd">

                <div class="msg" style="display: none;"><div class="success">Ваша корзина пуста.</div></div>

                <table class="table table_order">
                    <colgroup>
                        <col width="20px"/>
                        <col width="80px"/>
                        <col width="260px"/>
                        <col width="140px"/>
                        <col width="140px"/>
                    </colgroup>
                    <tbody>
                        <% _.each(Shop.Cart.getAllItems(), function(item){ %>

                        <!-- for single product -->
                        <% if (!item.kit) { %>
                        <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupProduct_<%- item.id+'_'+item.vId %>">
                            <td><button type="button" class="times d_i-b" onclick="rmFromPopupCart(this);">&times;</button></td>
                            <td>
                                <a href="<%-item.url%>" class="d_i-b photo">
                                    <figure>
                                        <img src="<%-item.img%>"/>
                                    </figure>
                                </a>
                            </td>
                            <td class="description">
                                <a href="<%-item.url%>"><%- item.name %></a>
                                <div>
                                    <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                    <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                </div>
                                <div class="price price_f-s_16">
                                    <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(pricePrecision) %></span> <%-curr%>.</span>
                                </div>
                            </td>
                            <td>
                                <div class="frame_count number d_i-b v-a_m" data-title="количество на складе <%-item.maxcount%>">
                                    <div class="frame_change_count" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" >
                                        <button type="button" class="d_b btn_small btn plus">
                                            <span class="icon-plus"></span>
                                        </button>
                                        <button type="button" class="d_b btn_small btn minus">
                                            <span class="icon-minus"></span>
                                        </button>
                                    </div>
                                    <input type="text" value="<%- item.count %>" data-rel="plusminus" data-title="только цифры" data-min="1" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                </div>
                                <span class="v-a_m countOrCompl"><%-pcs%></span>
                            </td>
                            <td>
                                <span class="d_b">Сумма: </span>
                                <div class="price price_f-s_16 d_i-b">
                                    <span class="first_cash"><span class="f-w_b priceOrder"><%- parseFloat(item.count*item.price).toFixed(pricePrecision) %></span> <%-curr%></span>
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
                                            <td rowspan="<%- names.length %>"><button type="button" class="times d_i-b" onclick="rmFromPopupCart(this, true);">×</button></td>
                                            <td>
                                                <a class="photo" href="<%- urls[i]%>">
                                                    <figure>
                                                        <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                    </figure>
                                                </a>
                                            </td>
                                            <td class="description">
                                                <a href="<%- urls[i]%>"><%- names[i] %></a>
                                                <div>
                                                    <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                    <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                </div>
                                                <div class="price price_f-s_16">
                                                    <span class="first_cash"><span class="f-w_b"><%-prices[i]%></span> <%-curr%></span>
                                                </div>
                                            </td>
                                            <td rowspan="<%- names.length %>">
                                                <div class="frame_count number d_i-b v-a_m" data-title="количество на складе <%-item.maxcount%>">
                                                    <div class="frame_change_count" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" data-kit="<%-item.kit%>">
                                                        <button id="plus" class="d_b btn_small btn plus" type="button">
                                                            <span class="icon-plus"></span>
                                                        </button>
                                                        <button id="minus" class="d_b btn_small btn minus" type="button">
                                                            <span class="icon-minus"></span>
                                                        </button>
                                                    </div>
                                                    
                                                    <input type="text" data-min="1" data-title="только цифры" data-rel="plusminus" value="<%-item.count%>" <% if (item.maxcount) { %> data-max="<%-item.maxcount%>" <% } %> />
                                                </div>
                                                <span class="v-a_m countOrCompl"><%-kits%></span>
                                            </td>
                                            <td rowspan="<%- names.length %>">
                                                <span>Сумма: </span>
                                                <div class="price price_f-s_16 d_i-b">
                                                    <span class="first_cash"><span class="f-w_b priceOrder"><%-parseFloat(item.price*item.count).toFixed(pricePrecision)%></span> <%-curr%></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <% } else { %> 
                                        

                                        <tr>
                                            <td>
                                                <a class="d_i-b photo" href="<%- urls[i]%>">
                                                    <figure>
                                                        <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                                    </figure>
                                                </a>
                                            </td>
                                            <td class="description">
                                                <a href="<%- urls[i]%>"><%-names[i]%></a>
                                                <div>
                                                    <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span> <% } %>
                                                    <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                                </div>
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
            <div class="inside_padd foot">
                <table class="table table_order">
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
                            <% setTimeout("location.href = '/' + locale;", 2000); %>
                            <% } %>
                            <td colspan="4" class="t-a_r">
                                <a href="#"  onclick="renderOrderDetails(); togglePopupCart(); return false;" class="btn btn_cart v-a_m m-r_30">{/literal}{lang('Закрыть','commerce4x')}{literal}</a>
                            </td>
                            <% } else { %>
                            <td colspan="4">
                                <a href="/shop/cart" class="btn btn_cart m-r_30 f_r">Оформить заказ</a>
                                <button type="button" onclick="togglePopupCart()" class="d_l_b w-s_n-w f_l">← Продолжить покупки</button>
                            </td>

                            <% } %>
                            <td style="padding-left: 0;">
                                <div class="t-a_l d_i-b v-a_m">
                                    <span class="d_b">Итого:</span>
                                    <div class="price price_f-s_24">
                                        <span class="first_cash"><span class="f-w_b priceOrder" id="popupCartTotal"><%- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span> <%-curr%></span>
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
        <div class="header_title">Ваш заказ</div>
        <table class="table v-a_bas table_order preview_order">
            <thead class="v_h">
                <tr>
                    <td class="span1"></td>
                    <td class="span3"></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <% _.each(Shop.Cart.getAllItems(), function(item){ %>
                <% if (!item.kit) { %>
                <tr>
                    <td class="v-a_m">
                        <a class="photo" href="<%-item.url%>">
                            <figure>
                                <img src="<%- item.img %>" alt="<%- '('+item.vname+')'%>">
                            </figure>
                        </a>
                    </td>
                    <td class="description">
                        <a href="<%-item.url%>"><%- item.name %></a>
                        <div>
                            <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal} <span class="code">(<%- item.vname%>)</span></span><% } %>
                            <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span><% } %>
                        </div>
                        <div class="price price_f-s_16">
                            <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(pricePrecision) %></span> <%- curr %>.</span>
                        </div>
                    </td>
                    <td>
                        <span class="c_8a">х</span> <span class="f-w_b f-s_16"><%- item.count %></span> <%- pcs %> =
                    </td>
                    <td>
                        <div class="price price_f-s_16">
                            <span class="first_cash"><span class="f-w_b priceOrder"><%-  parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(pricePrecision) %></span> <%- curr %></span>
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
                            <thead class="v_h">
                                <tr>
                                    <td class="span1"></td>
                                    <td class="span3"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>

                                <% _.each(ids, function(id){  %>

                                <% if (0==i) { %>

                                <tr>
                                    <td>
                                        <a class="photo" href="<%- urls[i] %>">
                                            <figure>
                                                <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="description">
                                        <a href="<%- urls[i] %>"><%- names[i] %></a>
                                        <div>
                                            <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal}<span class="code">(<%- item.vname%>)</span></span> <% } %>
                                            <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                        </div>
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
                                            <span class="first_cash"><span class="f-w_b priceOrder"><%-  parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(pricePrecision) %></span> <%- curr %></span>
                                        </div>
                                    </td>
                                </tr>

                                <% } else { %> 

                                <tr>
                                    <td>
                                        <a class="d_i-b photo" href="<%- urls[i] %>">
                                            <figure>
                                                <img src="<%- images[i]%>" alt="<%- '('+item.vname+')'%>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="description">
                                        <a href="<%- urls[i]%>"><%-names[i]%></a>
                                        <div>
                                            <%if(item.vname){ %><span class="frame_variant_name">{/literal}{lang(s_variant)} {literal}<span class="code">(<%- item.vname%>)</span></span> <% } %>
                                            <%if (item.number) { %><span class="frame_number">{/literal}{lang(s_article)} {literal} <span class="code">(<%-item.number %>)</span></span> <% } %>
                                        </div>
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
                            <span style="height: 36px;" class="helper"></span>
                            <button class="d_l_b" type="button" onclick="initShopPage();">Редактировать</button>
                        </div>
                        <div class="f_r">
                            <span class="v-a_m">Итого:&nbsp;&nbsp;</span>
                            <span class="price price_f-s_24 v-a_m d_i-b">
                                <span class="first_cash"><span class="f-w_b priceOrder"><%- parseFloat( Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span> <%- curr %></span>
                            </span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    {/literal}
</script>

<script>
    var curr = '{$CS}';
</script>