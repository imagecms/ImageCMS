<span id="opt1" data-def_min = "{echo (int)$priceRange.minCost}"></span>
<span id="opt2" data-def_max = "{echo (int)$priceRange.maxCost}"></span>
<span id="opt3" data-cur_min = "{if isset(ShopCore::$_GET['lp'])}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}"></span>
<span id="opt4" data-cur_max = "{if isset(ShopCore::$_GET['rp'])}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}"></span>
{$aurl = urldecode(site_url($_SERVER['REQUEST_URI']))}

<aside class="span3">
    {if ($_GET['lp'] and $_GET['lp'] > $priceRange.minCost) or ($_GET['rp'] and $_GET['rp'] < $priceRange.maxCost) or $_GET['p'] or $_GET['brand']}
        <div class="checked_filter">
            <div class="title">
                {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))} {lang('s_filter_s_foa')}:
            </div>
            <ul>
                {if count($brands) > 0}
                    {foreach $brands as $brand}
                        {foreach $_GET['brand'] as $id}
                            {if $id == $brand->id}
                                <li>
                                    <span class="times">&times;</span>
                                    <div class="o_h">
                                        <a href="{echo str_replace('brand[]=' . $brand->id, '', $aurl)}" style="text-decoration: none;">{echo $brand->name}</a>
                                    </div>
                                </li>
                            {/if}
                        {/foreach}
                    {/foreach}
                {/if}
                {if count($propertiesInCat) > 0}
                    {foreach $propertiesInCat as $prop}
                        {if count(ShopCore::$_GET['p'][$prop->property_id])>0}
                            {foreach $prop->possibleValues as $key}
                                {foreach $_GET['p'][$prop->property_id] as $id}
                                    {if ShopCore::encode($id) == $key.value}
                                        <li>
                                            <span class="times">&times;</span>
                                            <div class="o_h">
                                                <a href="{echo str_replace('&p[' . $prop->property_id . '][]=' . htmlspecialchars_decode($key.value),'',$aurl)}" style="text-decoration: none;">{echo $prop->name.": ".$key.value}</a>
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            {/foreach}
                        {/if}
                    {/foreach}
                {/if}
                {if isset(ShopCore::$_GET['lp']) OR isset(ShopCore::$_GET['rp'])}
                    <li>
                        <span class="times">&times;</span>
                        <div class="o_h">
                            <a href="{echo str_replace('&lps=' . ShopCore::$_GET['lp'] . '&rp=' . ShopCore::$_GET['rp'], "", ShopCore::encode($aurl))}">
                                {if isset(ShopCore::$_GET['lp'])}
                                    {lang('s_from')} 
                                    {echo ShopCore::$_GET['lp']} {$CS}
                                {/if}
                                {if isset(ShopCore::$_GET['rp'])} 
                                    {lang('s_do')} 
                                    {echo ShopCore::$_GET['rp']} {$CS}
                                {/if}
                            </a>
                        </div>
                    </li>
                {/if}
            </ul>
            <a href="{site_url($CI->uri->uri_string())}" class="reset"><span class="icon-reset"></span>{lang('s_filter_all_reset')}</a>
        </div>
    {/if}
    <div class="filter">
        <form name="brandsfilter" id="brandsfilter" method="get" action="{shop_url('category/'.$category->getFullPath())}">
            <input type="hidden" name="order" value="{echo ShopCore::$_GET['order']}">
            <input type="hidden" name="user_per_page" value="{echo ShopCore::$_GET['user_per_page']}">
            <div class="boxFilter">
                <div class="title">{lang('s_price')}</div>
                <div class="sliderCont">
                    <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                        <img src="images/slider.png"/>
                        <div class="ui-slider-range ui-widget-header"></div>
                        <a href="#" class="ui-slider-handle" id="left_slider"></a>
                        <a href="#" class="ui-slider-handle" id="right_slider"></a>
                    </div>
                </div>
                <div class="formCost t-a_j">
                    <label>
                        <input type="text" id="minCost" value="{if ShopCore::$_GET['lp'] && (int)ShopCore::$_GET['lp']>0 && (int)ShopCore::$_GET['lp']>(int)$priceRange.minCost}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}" data-title="только цифры"/>
                    </label>
                    <span class="f-s_12">&ndash;</span>
                    <label>
                        <input type="text" id="maxCost" value="{if ShopCore::$_GET['rp'] && (int)ShopCore::$_GET['rp']>0}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}" data-title="только цифры"/>
                    </label>
                    <button type="submit" class="btn f-s_0"><span class="icon-filter"></span><span class="text-el">Подобрать</span></button>
                </div>
            </div>
            {if count($brands)>0}
                <div class="boxFilter">
                    <div class="title">Бренды в категории</div>
                    <div class="clearfix check_form">
                        {foreach $brands as $br}
                            <div class="frameLabel">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" {if $br->countProducts == 0}disabled="disabled"{/if} id="brand_{echo $br->id}" name="brand[]" value="{echo $br->id}" type="checkbox" {if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && in_array($br->id, ShopCore::$_GET['brand'])}checked="checked"{/if}/>
                                </span>
                                <span>
                                    {echo $br->name}&nbsp;
                                    <span>({if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && !in_array($br->id, ShopCore::$_GET['brand'])}+{/if}{echo $br->countProducts})</span>
                                </span>
                            </div>
                        {/foreach}
                    </div>
                </div>
            {/if}
            {foreach $propertiesInCat as $p}
                {if empty($p->possibleValues)}{$show[] = "1"}{/if}
            {/foreach}
            {if count($show) != count($propertiesInCat)}
                {foreach $propertiesInCat as $prop}
                    {if empty($prop->possibleValues)}{continue}{/if}
                        <div class="boxFilter">
                            <div class="title">{echo $prop->name}</div>
                            <div class="clearfix check_form">
                                {foreach $prop->possibleValues as $item}
                                    <div class="frameLabel">
                                        <span class="niceCheck b_n">
                                            <input {if $item.count == 0}disabled="disabled"{/if} class="propertyCheck" name="p[{echo $prop->property_id}][]" value="{echo $item.value}" type="checkbox" {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array($item.value, ShopCore::$_GET['p'][$prop->property_id]) && $item.count != 0}checked="checked"{/if}/>
                                        </span>
                                        <span>{echo $item.value}&nbsp;
                                            <span>({if $item.count != 0 && is_array(ShopCore::$_GET['p'][$prop->property_id]) && !in_array($item.value, ShopCore::$_GET['p'][$prop->property_id])}+{/if}{echo $item.count})</span>
                                        </span>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                {/foreach}
            {/if}
        </form>
    </div>
</aside>