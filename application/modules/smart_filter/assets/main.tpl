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
<div class="frame-check-filter">
    <div class="inside-padd">
        <div class="title">{echo count($products)} {echo SStringHelper::Pluralize(count($products), array('товар','товара','товаров'))} с фильтрами:</div>
        <ul class="list-check-filter">
            {if $curMin != $minPrice || $curMax != $maxPrice}
            <li class="cleare_price" data-rel="#frame-slider1"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">Цена от {echo $_GET['lp']} до {echo $_GET['rp']} <span class="cur">{$CS}</span></></button></li>
            {/if}
            {if count($brands) > 0}
            {foreach $brands as $brand}
            {foreach $_GET['brand'] as $id}
            {if $id == $brand->id}
            <li data-name="brand_{echo $brand->id}" class="cleare_filter"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">{echo $brand->name}</span></button></li>
            {/if}
            {/foreach}
            {/foreach}
            {/if}
            {if count($propertiesInCat) > 0}
            {foreach $propertiesInCat as $prop}
            {foreach $prop->possibleValues as $key}
            {foreach $_GET['p'][$prop->property_id] as $nm}
            {if $nm == $key.value}
            <li data-name="p_{echo $prop->property_id}_{echo $key.id}" class="cleare_filter"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">{echo $prop->name}: {echo $key.value}</span></button></li>
            {/if}
            {/foreach}
            {/foreach}
            {/foreach}
            {/if}
        </ul>
        <div class="foot-check-filter">
            <button type="button" onclick="location.href = '{site_url($CI->uri->uri_string())}'" class="btn-reset-filter">
                <span class="icon_times icon_remove_all_filter f_l"></span>
                <span class="text-el d_l_r_f">Сбросить фильтр</span>
            </button>
        </div>
    </div>
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
{else:}
{literal}
<script type="text/javascript">
    var slider1 = $('<div></div>', {
        id: slider1
    }).insertAfter('body').hide();
</script>
{/literal}
<script type="text/javascript">
    $("#slider1").data();
    data.defMin = "{$minPrice}";
    data.defMax = "{$maxPrice}";
    data.curMin = "{$curMin}";
    data.curMax = "{$curMax}";
</script>
{/if}