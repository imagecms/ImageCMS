<span id="opt1" data-def_min = "{echo (int)$priceRange.minCost}"></span>
<span id="opt2" data-def_max = "{echo (int)$priceRange.maxCost}"></span>
<span id="opt3" data-cur_min = "{if isset(ShopCore::$_GET['lp'])}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}"></span>
<span id="opt4" data-cur_max = "{if isset(ShopCore::$_GET['rp'])}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}"></span>

{$aurl = urldecode(site_url($_SERVER['REQUEST_URI']))}
<div class="filter">
    <form name="brandsfilter" id="brandsfilter" method="get" action="{shop_url('category/'.$model->full_path)}">
        <input type="hidden" name="order" value="{echo ShopCore::$_GET['order']}">
        <input type="hidden" name="user_per_page" value="{echo ShopCore::$_GET['user_per_page']}">
        {if ($_GET['lp'] and $_GET[lp] > $priceRange.minCost) or ($_GET['rp'] and $_GET['rp'] < $priceRange.maxCost) or $_GET['f'] or $_GET['brand']}
            <div class="title padding_filter">{lang('s_filter_search_f_paramet')}</div>
            <div class="checked_filter padding_filter">
                <span class="c_4f">{$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))} {lang('s_filter_s_foa')}:</span>
                <ul>
                    {if count($brands) > 0}
                        {foreach $brands as $brand}
                            {foreach $_GET['brand'] as $id}
                                {if $id == $brand->id}
                                    <li><a href="{echo str_replace('&brand[]=' . $brand->id,'',$aurl)}"><i class="times"></i>{echo $brand->name}</a></li>
                                {/if}
                            {/foreach}
                        {/foreach}
                    {/if}
                    {if count($propertiesInCat) > 0}
                        {foreach $propertiesInCat as $prop}
                            {if count(ShopCore::$_GET['p'][$prop->id])>0}
                                {foreach $prop->possibleValues as $key}
                                    {foreach $_GET['p'][$prop->id] as $id}
                                        {if $id == $key.value}
                                            <li><a href="{echo str_replace('&p[' . $prop->id . '][]=' . $key.value,'',$aurl)}"><i class="times"></i>{echo $key.value}</a></li>
                                        {/if}
                                    {/foreach}
                                {/foreach}
                            {else:}
                                <li><a href="{echo str_replace('&p[' . $prop->id . '][single]=' . ShopCore::$_GET['p'][$prop->id]['single'], '' ,$aurl)}"><i class="times"></i>{echo ShopCore::$_GET['f'][$prop->id]['single']}</a></li>
                            {/if}
                        {/foreach}
                    {/if}
                    {if isset(ShopCore::$_GET['lp']) OR isset(ShopCore::$_GET['rp'])}
                        <li><a href="{echo str_replace('&lp=' . ShopCore::$_GET['lp'] . '&rp=' . ShopCore::$_GET['rp'], '&lp=' . $priceRange.minPrice . '&rp=' . $priceRange.maxPrice, $aurl)}"><i class="times"></i>{if isset(ShopCore::$_GET['lp'])}{lang('s_from')} {echo ShopCore::$_GET['lp']}{$CS}{/if}{if isset(ShopCore::$_GET['rp'])} {lang('s_do')} {echo ShopCore::$_GET['rp']} {$CS}{/if}</a></li>
                    {/if}
                </ul>
                <a href="{site_url($CI->uri->uri_string())}" class="reset">{lang('s_filter_all_reset')}</a>
            </div>
        {/if}
        <div class="clearfix padding_filter">
            <div class="title">{lang('s_price')}</div>
            <div class="sliderCont">
                <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                    <div class="ui-slider-range ui-widget-header"></div>
                    <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                    <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                </div>
            </div>
            <div class="formCost f_l">
                <label>{lang('s_from')}</label>
                <input type="text" id="minCost" name="lp" value="{if ShopCore::$_GET['lp'] && (int)ShopCore::$_GET['lp']>0}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}" autocomplete="off"/>
                <label>{lang('s_do')}</label>
                <input type="text" id="maxCost" name="rp" value="{if ShopCore::$_GET['rp'] && (int)ShopCore::$_GET['rp']>0}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}" autocomplete="off"/>
                <div class="buttons button_bs">
                    <input type="submit" value="ok" name="pricebutton"/>
                </div>
            </div>
        </div>
        <div class="padding_filter">
            <div class="padding_filter check_frame">
                <div class="title">Брэнды в категории</div>
                <div class="clearfix check_form">
                    {foreach $brands as $br}
                        <label>
                            <input {if $br->countProducts == 0}disabled="disabled"{/if} id="brand_{echo $br->id}" name="brand[]" value="{echo $br->id}" type="checkbox" {if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && in_array($br->id, ShopCore::$_GET['brand'])}checked="checked"{/if}/>
                            <span class="name_model">{echo $br->name}</span>
                            <span>&nbsp;({if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && !in_array($br->id, ShopCore::$_GET['brand'])}+{/if}{echo $br->countProducts}) </span>
                        </label>
                    {/foreach}
                </div>
            </div>
        </div>
        <div class="padding_filter">
            <div class="padding_filter check_frame">
                <div class="title">Свойства</div>
                <div class="clearfix check_form">
                    {foreach $propertiesInCat as $prop}
                        {if empty($prop->possibleValues)}{continue}{/if}
                        <div class="padding_filter">
                            <div class="padding_filter check_frame">
                                <div class="title">{echo $prop->name}</div>
                                <div class="clearfix check_form">
                                    {foreach $prop->possibleValues as $item}
                                        <label>
                                            <input {if $item.count == 0}disabled="disabled"{/if} class="propertyCheck" name="p[{echo $prop->property_id}][]" value="{echo $item.value}" type="checkbox" {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array($item.value, ShopCore::$_GET['p'][$prop->property_id]) && $item.count != 0}checked="checked"{/if}/>
                                            <span class="name_model">{echo $item.value}</span>
                                            <span>&nbsp;({if $item.count != 0 && is_array(ShopCore::$_GET['p'][$prop->property_id]) && !in_array($item.value, ShopCore::$_GET['p'][$prop->property_id])}+{/if}{echo $item.count}) </span>
                                        </label>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </form>
</div>