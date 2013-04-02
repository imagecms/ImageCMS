<div class="left-catalog filter">


    <!-- selected filters block -->
    {$minPrice = (int)$priceRange.minCost;}
    {$maxPrice = (int)$priceRange.maxCost;}
    {if $_GET['lp']}
        {$curMin = (int)$_GET['lp'];}
    {else:}
        {$curMin = $minPrice;}
    {/if}
    {if $_GET['rp']}
        {$curMax = (int)$_GET['rp'];}
    {else:}
        {$curMax = $maxPrice;}
    {/if}

    {if $_GET['brand'] != "" || $_GET['p'] != "" || ($_GET['lp'] && $_GET['lp'] != $minPrice) || ($_GET['rp'] && $_GET['rp'] != $maxPrice)}
        <div class="frame-check-filter inside-padd">
            <div class="title_h4">{echo count($products)} {echo SStringHelper::Pluralize(count($products), array('товар','товара','товаров'))} с фильтрами:</div>
            <ul class="check-filter">
                {if $curMin != $minPrice || $curMax != $maxPrice}
                    <li class="ref cleare_price"><span class="icon-remove"></span><div>Цена от {echo $_GET['lp']} до {echo $_GET['rp']} <span class="cur">{$CS}</span></div></li>
                {/if}
                {if count($brands) > 0}
                    {foreach $brands as $brand}
                        {foreach $_GET['brand'] as $id}
                            {if $id == $brand->id}
                                <li data-name="brand_{echo $brand->id}" class="cleare_filter ref"><span class="icon-remove"></span><div>{echo $brand->name}</div></li>
                            {/if}
                        {/foreach}
                    {/foreach}
                {/if}
                {if count($propertiesInCat) > 0}
                    {foreach $propertiesInCat as $prop}
                        {foreach $prop->possibleValues as $key}
                            {foreach $_GET['p'][$prop->property_id] as $nm}
                                {if $nm == $key.value}
                                    <li data-name="p_{echo $prop->property_id}_{echo $key.id}" class="cleare_filter ref"><span class="icon-remove"></span><div>{echo $prop->name}: {echo $key.value}</div></li>
                                {/if}
                            {/foreach}
                        {/foreach}
                    {/foreach}
                {/if}
            </ul>
            <button type="button" onclick="location.href = '{site_url($CI->uri->uri_string())}'" class="d_l_o">Сбросить фильтр</button>
        </div>
    {/if}
    <!-- end of selected filters block -->

    {if $totalProducts > 0}
        <form action="" method="get" id="catalog_form">
            <input type="hidden" name="order" value="{echo $_GET[order]}" />
            <div class="popup_container">
                {include_tpl('filter')}
            </div>
        </form>
    {/if}

</div>


</div>