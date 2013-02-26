<script type="text/template" id="cartPopupTemplate">
{literal}   
   <div class="fancy fancy_cleaner frame_head_content">
       <div class="header_title">Ваша корзина</div>
       <div class="inside_padd" style="background: #fff;">
           <table class="table table_order">
               <colgroup>
                   <col width="20px"/>
                   <col width="80px"/>
                   <col width="260px"/>
                   <col width="140px"/>
                   <col width="140px"/>
               </colgroup>
               <tbody>
                   <% _.each(cart.getAllItems(), function(item){ %>
                   <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>"> 
                       <td><span class="times d_i-b" onclick="rmFromPopupCart(this);">&times;</span></td>
                       <td>
                           <a href="#" class="d_i-b photo">
                               <figure>
                                   <img src="/uploads/shop/<%- item.id %>_mainMod.jpg"/>
                               </figure>
                           </a>
                       </td>
                       <td>
                           <a href="#"><%- item.name %></a>
                           <div class="price price_f-s_16">
                               <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(2) %></span> грн.</span>
                           </div>
                       </td>
                       <td>
                           <div class="frame_count number d_i-b v-a_m">
                               <div class="frame_change_count" data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" data-price="<%- item.price %>" >
                                   <button type="button" class="d_b btn_small btn">
                                       <span class="icon-plus"></span>
                                   </button>
                                   <button type="button" class="d_b btn_small btn">
                                       <span class="icon-minus"></span>
                                   </button>
                               </div>
                               <input type="text" value="<%- item.count %>" data-rel="plusminus" data-title="только цифры" data-min="1"/>
                           </div>
                           <span class="v-a_m"><%- item.count %> шт.</span>
                       </td>
                       <td>
                           <span>Сумма: </span>
                           <div class="price price_f-s_16 d_i-b">
                               <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.count*item.price).toFixed(2) %></span> грн.</span>
                           </div>
                       </td>
                   </tr>
                   <% }); %>
               </tbody>
               <tfoot>
                   <tr>
                       <% if ( document.getElementById('orderDetails')) { %>
                       <td colspan="4" class="t-a_r">
                           <a href="#"  onclick="renderOrderDetails(); togglePopupCart(); return false;" class="btn btn_cart v-a_m m-r_30">Подтвердить</a>
                       </td>
                       <% } else { %>
                       <td colspan="2">
                           <button type="button" onclick="togglePopupCart()" class="d_l_b w-s_n-w">← Продолжить покупки</button>
                       </td>
                       <td colspan="2" class="t-a_r">
                           <a href="/shop/cart" class="btn btn_cart v-a_m m-r_30">Оформить заказ</a>
                       </td>
                       
                       <% } %>
                       <td colspan="1">
                           <div class="t-a_l d_i-b v-a_m">
                               <span>Итого:</span>
                               <div class="price price_f-s_24">
                                   <span class="first_cash"><span class="f-w_b"><%- parseFloat(cart.getTotalPrice()).toFixed(2) %></span> руб.</span>
                               </div>
                           </div>
                       </td>
                   </tr>
               </tfoot>
           </table>
       </div>
   </div>
{/literal}  
</script>



<script type="text/template" id="orderDetailsTemplate">
    {literal}
    <div class="frame_head_content">
        <div class="header_title">Ваш заказ</div>
        <table class="table v-a_bas table_order">
            <thead class="v_h">
                <tr>
                    <td class="span1"></td>
                    <td class="span3"></td>
                    <td class="span1"></td>
                    <td class="span1"></td>
                </tr>
            </thead>
            <tbody>
                <% _.each(Shop.Cart.getAllItems(), function(item){ %>
                <tr>
                    <td class="v-a_m">
                        <a class="photo" href="#">
                            <figure>
                                <img src="/uploads/shop/<%- item.id %>_mainMod.jpg">
                            </figure>
                        </a>
                    </td>
                    <td>
                        <a class="c_97" href="#"><%- item.name %></a>
                        <div class="price price_f-s_16">
                            <span class="first_cash"><span class="f-w_b"><%- parseFloat(item.price).toFixed(2) %></span> <%- curr %>.</span>
                        </div>
                    </td>
                    <td>
                        <span class="c_8a">х</span> <span class="f-w_b f-s_16"><%- item.count %></span> <%- pcs %> =
                    </td>
                    <td>
                        <div class="price price_f-s_16">
                            <span class="first_cash"><span class="f-w_b"><%-  parseFloat( parseInt(item.count)*parseFloat(item.price) ).toFixed(2) %></span> <%- curr %></span>
                        </div>
                    </td>
                </tr>
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
                                <span class="first_cash"><span class="f-w_b"><%- parseFloat( Shop.Cart.getTotalPrice()).toFixed(2) %></span> <%- curr %></span>
                            </span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    {/literal}
</script>