<!-- floating elements-->
<div id="popupCart" style="display: none;" class="drop drop-bask drop-style" data-event="trigger"></div>
<a href="#" data-drop="#popupCart" id="showCart" style="display: none;"></a>

<script type="text/template" id="cartPopupTemplate">
    {literal}   
    <div class="frame-bask">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="togglePopupCart()"></button>
        <div class="no-empty">
            <div class="drop-header">
                <div class="title">В вашей корзине <span class="add-info"><%- Shop.Cart.totalCount %></span> товара на сумму <span class="add-info"><%- Shop.Cart.totalPrice %></span> <%-curr%></div>
            </div>
        </div>
        <div class="drop-content">
            <div class="no-empty">
                <div class="frame-bask-scroll">
                    <div class="frame-bask-main">
                        <div class="inside-padd">
                            <table class="table-order">
                                <tbody>
                                    <% _.each(Shop.Cart.getAllItems(), function(item){ %>

                                    <!-- for single product -->
                                    <% if (!item.kit) { %>
                                    <tr data-prodid="<%- item.id %>" data-varid="<%- item.vId %>" id="popupProduct_<%- item.id+'_'+item.vId %>" class="items items-bask cartProduct">
                                        <td class="frame-remove-bask-btn"><button class="icon_times_cart" onclick="rmFromPopupCart(this);"></button></td>
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
                                                        <td class="frame-remove-bask-btn"><button class="icon_times_cart" onclick="rmFromPopupCart(this, true);"></button></td>
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
                        <div class="header-frame-foot">
                            <span class="simple-text">Ваша текущая скидка:</span>
                            <span class="text-discount current-discount">10%</span>
                            <span class="simple-text">Всего:</span>
                            <span class="frame-prices f-s_0">
                                <span class="price-discount">
                                    <span>
                                        <span class="price">500</span>
                                        <span class="curr">RUR</span>
                                    </span>
                                </span>
                                <span class="current-prices f-s_0">
                                    <span class="price-new">
                                        <span>
                                            <span class="price" id="popupCartTotal"><%- parseFloat(Shop.Cart.getTotalPrice()).toFixed(pricePrecision) %></span>
                                            <span class="curr"><%-curr%></span>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </div>
                        <div class="content-frame-foot">
                            <% if ( document.getElementById('orderDetails')) { %>
                            <% if ( Shop.Cart.totalCount  == 0 ) { %>
                            <% setTimeout("location.href = '/';", 2000); %>
                            <% } %>
                            <% } else { %>
                            <div class="clearfix">
                                <div class="btn-form f_l">
                                    <button type="button" onclick="togglePopupCart()">
                                        <span class="icon_form"></span>
                                        <span class="text-el"><span class="f-s_14">←</span> Вернуться к покупкам</span>
                                    </button>
                                </div>
                                <div class="btn-cart btn-cart-p f_r">
                                    <a href="/shop/cart">
                                        <span class="icon_cart_p"></span>
                                        <span class="text-el">Оформить заказ</span>
                                    </a>
                                </div>
                            </div>
                            <% } %>
                        </div>
                    </div>
                </div>
            </div>
            <div class="empty">
                <div class="drop-header">
                    <div class="title">В вашей корзине <span class="add-info">пусто</span></div>
                </div>
                <div class="drop-content">
                    <div class="inside-padd">
                        <div class="msg f-s_0">
                            <div class="success"><span class="icon_info"></span><span class="text-el">Вы удалили все товары с корзины</span></div>
                        </div>
                        <div class="btn-form">
                            <button type="button" onclick="togglePopupCart()">
                                <span class="icon_form"></span>
                                <span class="text-el"><span class="f-s_14">←</span> Вернуться к покупкам</span>
                            </button>
                        </div>
                    </div>
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
                    <tr class="items items-bask cartProduct">
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
        <% var ids=[] %>
        <% if (_.keys(items).length > 1) { %>
        <ul class="items items-search-autocomplete">
            <% _.each(items, function(item){

            if (item.name != null && ids.indexOf(item.product_id)){%>
            <% ids.push(item.product_id) %>
            <li>{/literal}
                <!-- Start. Photo Block and name  -->
                <a href="{shop_url('product')}/{literal}<%- item.url %>" class="frame-photo-title">
                    <span class="photo-block">
                        <span class="helper"></span>
                        {/literal}<img src="{base_url()}uploads/shop/products/small/{literal}<%- item.mainImage %>">
                    </span>
                    <span class="title"><% print( item.name)  %></span>
                    <!-- End. Photo Block and name -->

                    <span class="description">
                        <!-- Start. Product price  -->
                        <span class="frame-prices f-s_0">
                            <span class="current-prices f-s_0 var_price_{echo $p->firstVariant->getId()} prod_price_{echo $p->getId()}">
                                <span class="price-new">
                                    <span>
                                        <span class="price"><%- Math.round(item.price) %></span>{/literal}
                                        <span class="curr">{$CS}</span>{literal}
                                    </span>
                                </span>
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
                <a href="{shop_url('search')}?text={literal}<%- items.queryString %>" {/literal} class="f-s_0">
                   <span class="icon_show_all"></span><span class="text-el">{lang('s_all_result')} →</span>
                </a>
            </div>{literal}
            <!-- End. Show link  -->
            <% } else {%>    
            {/literal}<div class="alert alert-success">{echo ShopCore::t(lang('s_not_found'))}</div>{literal}
            <% }%>
        </div>
    </div>
</script>
{/literal}

<span class="tooltip"></span>
<div class="apply">
    <div class="content-apply">
        <a href="#">Фильтровать</a>
        <div class="description">Найдено <span class="f-s_0"><span id="apply-count">5</span><span class="plurProd"></span></span></div>
    </div>
    <span class="icon_times-apply"></span>
</div>
