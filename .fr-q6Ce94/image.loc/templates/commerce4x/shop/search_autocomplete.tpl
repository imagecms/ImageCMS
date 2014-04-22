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
        <div class="inside_padd">
            <% var ids=[] %>
            <% if (_.keys(items).length > 1) { %>
            <ul class="frame-search-thumbail">
                <% _.each(items, function(item){

                    if (item.name != null && ids.indexOf(item.product_id)){%>
                    <% ids.push(item.product_id) %>
                    <li>{/literal}
                        <!-- Start. Photo Block and name  -->
                        <a href="{shop_url('product')}/{literal}<%- item.url %>">
                            <span class="photo">
                                <span class="helper"></span>
                            {/literal}<img src="{literal}<%- item.mainImage %>">
                            </span>
                            <span class="title"><% print( item.name)  %></span>
                             <!-- End. Photo Block and name -->
                        <!-- Start. Product price  -->
                            <span class="price price_f-s_16"><span class="f-w_b"><%- Math.round(item.price) %></span>{/literal}<span class="curr"> {$CS}</span>{literal}</span>
                        <!-- End. Product price  -->
                        </a>
                    </li>
                    <% }
                }) %>
            </ul>
            <!-- Start. Show link see all results if amount products >0  -->
            <div class="btn-form">{/literal}
                <a href="{shop_url('search')}?text={literal}<%- items.queryString %>" {/literal} class="f-s_0">
                    <span class="icon-show-all"></span><span class="text-el">{lang("View all results","admin")}</span>
                </a>
            </div>{literal}
            <!-- End. Show link  -->
            <% } else {%>    
        {/literal}<div class="p_lr_10">{echo ShopCore::t(lang("Your search did not match","admin"))}</div>{literal}
            <% }%>
        </div>
    </script>
{/literal}