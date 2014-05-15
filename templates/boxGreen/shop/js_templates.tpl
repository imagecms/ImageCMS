<button type="button" id="showCartPopup" data-drop="#popupCart" style="display: none;"></button>
<div class="drop-bask drop drop-style" id="popupCart"></div>

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
        <span class="description">
        <span class="title"><% print(item.name)  %></span>
        <!-- End. Photo Block and name -->

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
        <!-- End. Product price  -->
        </span>
        </a>
        </li>
        <% }
        }) %>
        </ul>
        <!-- Start. Show link see all results if amount products >0  -->
        <div>
        <div class="btn-autocomplete">{/literal}
        <a href="{shop_url('search')}?text={literal}<%- items.queryString %>" {/literal} class="f-s_0 t-d_u ref2">
        <span class="icon_arrow"></span><span class="text-el">{lang('Смотреть все результаты','boxGreen')}</span>
        </a>
        </div>{literal}
        <!-- End. Show link  -->
        <% } else {%>    
    {/literal}<div class="msg f-s_0">
    <div class="info"><span class="icon_info"></span><span class="text-el">{echo ShopCore::t(lang('По Вашему запросу ничего не найдено','boxGreen'))}</span></div>
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
            (<span class="price addCurrPrice"><%-parseFloat(item.addPrice).toFixed(pricePrecision)%></span>
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
            <div class="description">{lang('Найдено','boxGreen')} <a href="#"><span id="apply-count">5</span> <span class="plurProd"></span></a></div>
        </div>
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
            <div class="title">{lang('Подтвердите' , 'boxGreen')}</div>
        </div>
        <div class="drop-content-confirm">
            <div class="inside-padd cofirm w-s_n-w">
                <div class="btn-def">
                    <button type="button" data-button-confirm data-modal="true">
                        <span class="text-el">{lang('Подтвердить' , 'boxGreen')}</span>
                    </button>
                </div>
                <div class="btn-cancel">
                    <button type="button" data-closed="closed-js">
                        <span class="text-el d_l_1">{lang('Отменить' , 'boxGreen')}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
    <button style="display: none;" type="button" data-drop="#confirm" data-confirm="true" data-effect-on="fadeIn" data-effect-off="fadeOut"></button>

    {if !$is_logged_in}
        <div class="drop drop-style" id="dropAuth">
            <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
            <div class="drop-content t-a_c" style="width: 350px;min-height: 0;">
                <div class="inside-padd">
                    {lang('Для того, что бы добавить товар в список желаний, Вам нужно', 'boxGreen')} <button type="button" class="d_l_1" data-drop=".drop-enter" data-source="{site_url('auth')}">{lang('авторизоваться', 'boxGreen')}</button>
                </div>
            </div>
        </div>
    {/if}