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
<script type="text/javascript">
    def_min={$minPrice};
    def_max={$maxPrice};
    cur_min={$curMin};
    cur_max={$curMax};
    totalProducts = parseInt('{$totalProducts}');
</script>
<div class="block-filter shadow-w_220">
    <div class="title_h3">Подробор по параметрам</div>
    <div class="inside-padd">
        <div class="title_h4">Цена в гривнах</div>
        <div class="sliderCont">
            <noscript>Джаваскрипт не включен</noscript>
            <div id="slider">
                <a class="ui-slider-handle" href="#" id="left_slider"></a>
                <a class="ui-slider-handle" href="#" id="right_slider"></a>
            </div>
        </div>
    </div>
    <div class="formCost">
        <div class="inside-padd">
            <div class="t-a_j">
                <label>
                    <input type="text" id="minCost" data-title="только цифры" name="lp" value="{echo $curMin}" data-mins="{echo $curMin}"/>
                </label>
                <label>
                    <input type="text" id="maxCost" data-title="только цифры" name="rp" value="{echo $curMax}" data-maxs="{echo $curMax}"/>
                </label>
                <input type="submit" value="ОК"/>
            </div>
        </div>
    </div>
    <div class="frame-group-checks">
        <div class="inside-padd">
            {if count($brands) > 0}
                <div class="title_h4">Производитель</div>
                <ul>
                    {foreach $brands as $brand}
                        {if is_array(ShopCore::$_GET['brand']) && in_array($brand->id, ShopCore::$_GET['brand'])}
                            {$check = 'checked="checked"'}
                        {else:}
                            {$check = ''}
                        {/if}
                        {if $brand->countProducts == 0}
                        {//$class = "disabled"}
                            {$dis = 'disabled="disabled"'}
                        {else:}
                            {$class = $dis = ""}
                        {/if}
                        <li>
                            <div class="frame-label" id="brand_{echo $brand->id}">
                                <span class="niceCheck b_n">
                                    <input {$dis} class="brand{echo $brand->id}" name="brand[]" value="{echo $brand->id}" type="checkbox" {$check}/>
                                </span>
                                <div class="name-count">
                                    <span class="title">{echo $brand->name}</span>
                                    <span class="count">({echo $brand->countProducts})</span>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>


    {if count($propertiesInCat) > 0}
        {foreach $propertiesInCat as $prop}
            <div class="frame-group-checks">
                <div class="inside-padd">
                    <div class="title_h4">{echo $prop->name}</div>
                    <ul>
                        {foreach $prop->possibleValues as $item}
                            {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array($item.value, ShopCore::$_GET['p'][$prop->property_id])}
                                {$check = 'checked="checked"'}
                            {else:}
                                {$check = ''}
                            {/if}
                            {if $item.count == 0}
                            {//$class = "disabled"}
                                {$dis = 'disabled="disabled"'}
                            {else:}
                                {$class = $dis = ""}
                            {/if}
                            <li>
                                <div class="frame-label {$class}" id="p_{echo $prop->property_id}_{echo $item.id}">
                                    <span class="niceCheck b_n">
                                        <input {$dis} name="p[{echo $prop->property_id}][]" value="{echo $item.value}" type="checkbox" {$check} />
                                    </span>
                                    <div class="name-count">
                                        <span class="title">{echo $item.value}</span>
                                        <span class="count">({echo $item.count})</span>
                                    </div>
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        {/foreach}
    {/if}
</div>
<input disabled="disabled" type="hidden" name="requestUri" value="{echo site_url($CI->uri->uri_string())}"/>