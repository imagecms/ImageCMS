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
                                   <img src="images/temp/item_thumb.png"/>
                               </figure>
                           </a>
                       </td>
                       <td>
                           <a href="#"><%- item.name %></a>
                           <div class="price price_f-s_16">
                               <span class="first_cash"><span class="f-w_b"><%- item.price %></span> грн.</span>
                           </div>
                       </td>
                       <td>
                           <div class="frame_count number d_i-b v-a_m">
                               <div class="frame_change_count">
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
                               <span class="first_cash"><span class="f-w_b"><%- item.count*item.price %></span> грн.</span>
                           </div>
                       </td>
                   </tr>
                   <% }); %>
               </tbody>
               <tfoot>
                   <tr>
                       <td colspan="2">
                           <button type="button" class="d_l_b w-s_n-w">← Продолжить покупки</button>
                       </td>
                       <td colspan="2" class="t-a_r">
                           <a href="#" class="btn btn_cart v-a_m m-r_30">Оформить заказ</a>
                       </td>
                       <td colspan="1">
                           <div class="t-a_l d_i-b v-a_m">
                               <span>Итого:</span>
                               <div class="price price_f-s_24">
                                   <span class="first_cash"><span class="f-w_b"><%- cart.getTotalPrice() %></span> руб.</span>
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