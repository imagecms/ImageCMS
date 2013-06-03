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

                                <!--                            {if $NextCSId != null}
                                                            <span class="price-add">
                                                                <span>
                                                                    (<span class="price">{echo $p->firstVariant->toCurrency('Price',1)}</span>
                                                                    <span class="add-curr">{$NextCs}</span>)
                                                                </span>
                                                            </span>
                                                            {/if}
                                -->
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