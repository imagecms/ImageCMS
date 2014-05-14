{if $_GET['brand'] != "" || $_GET['p'] != "" || ($_GET['lp'] && $_GET['lp'] != $minPrice) || ($_GET['rp'] && $_GET['rp'] != $maxPrice)}
    <div class="frame-check-filter">
        <div class="inside-padd">
            <div class="title">{echo count($products)} {echo SStringHelper::Pluralize(count($products), array('товар','товара','товаров'))} {lang('с фильтрами', 'newLevel')}:</div>
            <ul class="list-check-filter">
                {if $curMin != $minPrice || $curMax != $maxPrice}
                    <li class="clear-slider" data-rel="sliders.slider1"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">{lang('Цена от', 'newLevel')} {echo $_GET['lp']} до {echo $_GET['rp']} <span class="cur">{$CS}</span></></button></li>
                    {/if}
                    {if count($brands) > 0}
                        {foreach $brands as $brand}
                            {foreach $_GET['brand'] as $id}
                                {if $id == $brand->id}
                                <li data-name="brand_{echo $brand->id}" class="clear-filter"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">{echo $brand->name}</span></button></li>
                                        {/if}
                                    {/foreach}
                                {/foreach}
                            {/if}
                            {if count($propertiesInCat) > 0}
                                {foreach $propertiesInCat as $prop}
                                    {foreach $prop->possibleValues as $key}
                                        {foreach $_GET['p'][$prop->property_id] as $nm}
                                            {if $nm == $key.value}
                                    <li data-name="p_{echo $prop->property_id}_{echo $key.id}" class="clear-filter"><button type="button"><span class="icon_times icon_remove_filter f_l"></span><span class="name-check-filter">{echo $prop->name}: {echo $key.value}</span></button></li>
                                            {/if}
                                        {/foreach}
                                    {/foreach}
                                {/foreach}
                            {/if}
            </ul>
            <div class="foot-check-filter">
                <button type="button" onclick="location.href = '{site_url($CI->uri->uri_string())}'" class="btn-reset-filter">
                    <span class="icon_times icon_remove_all_filter f_l"></span>
                    <span class="text-el d_l_r_f">{lang('Сбросить фильтр', 'newLevel')}</span>
                </button>
            </div>
        </div>
    </div>
{/if}
<!-- end of selected filters block -->

<form method="get" id="catalogForm">
    <input type="hidden" name="order" value="{echo $order_method}" />
    <input type="hidden" name="user_per_page" value="{if !$_GET['user_per_page']}{echo \ShopCore::app()->SSettings->frontProductsPerPage}{else:}{echo $_GET['user_per_page']}{/if}"/>
    <div class="frame-filter p_r">
        {include_tpl('filter')}
    </div>
</form>
