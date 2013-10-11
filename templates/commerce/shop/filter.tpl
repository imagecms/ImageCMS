{# Variables
/**
* @file - template for displaying shop filter
* Variables
*   $category: (object) instance of SCategory
*   $priceRange: array which contains price range values
*       $priceRange['minCost']: integer variable which contains the minimum left price range
*       $priceRange['maxCost']: integer variable which contains the maximum right price range
*   $propertiesInCat - array of (object)s of stdClass which contains data conserning properties in current category
*       $propertiesInCat[$key]->name: contains property name according to current locale
*       $propertiesInCat[$key]->possibleValues: array which contains all possible values of property according to current category and products number which have such properties
*   $brands - array of (object)s of stdClass which contains all brands according to current category
*       $brands[$key]->name: returns brands name
*       $brands[$key]->countProducts: returns products number with current brand
*
*/
#}

<span id="opt1" data-def_min = "{echo (int)$priceRange.minCost}"></span>
<span id="opt2" data-def_max = "{echo (int)$priceRange.maxCost}"></span>
<span id="opt3" data-cur_min = "{if isset(ShopCore::$_GET['lp'])}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}"></span>
<span id="opt4" data-cur_max = "{if isset(ShopCore::$_GET['rp'])}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}"></span>

{$aurl = urldecode(site_url($_SERVER['REQUEST_URI']))}
<div class="filter">
    <form name="brandsfilter" id="brandsfilter" method="get" action="{shop_url('category/'.$category->getFullPath())}">
        <input type="hidden" name="order" value="{echo ShopCore::$_GET['order']}">
        <input type="hidden" name="user_per_page" value="{echo ShopCore::$_GET['user_per_page']}">
        {if ($_GET['lp'] and $_GET['lp'] > $priceRange.minCost) or ($_GET['rp'] and $_GET['rp'] < $priceRange.maxCost) or $_GET['p'] or $_GET['brand']}
            <div class="checked_filter padding_filter">
                <span class="c_4f">{$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang("product","admin"), lang("product","admin"), lang("product","admin")))} {lang("with filters","admin")}:</span>
                <ul>
                    {if count($brands) > 0}
                        {foreach $brands as $brand}
                            {foreach $_GET['brand'] as $id}
                                {if $id == $brand->id}
                                    <li>
                                        <a href="{echo str_replace('&brand[]=' . $brand->id, '', $aurl)}"><i class="icon-times-red"></i>{echo ShopCore::encode($brand->name)}</a>
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
                                                <a href="{echo str_replace('&p[' . $prop->property_id . '][]=' . htmlspecialchars_decode($key.value),'',$aurl)}"><i class="icon-times-red"></i>{echo $prop->name.": ".$key.value}</a>
                                            </li>
                                        {/if}
                                    {/foreach}
                                {/foreach}
                            {/if}
                        {/foreach}
                    {/if}
                    {if isset(ShopCore::$_GET['lp']) OR isset(ShopCore::$_GET['rp'])}
                        {if ShopCore::$_GET['lp'] > (int)$priceRange.minCost or ShopCore::$_GET['rp'] < (int)$priceRange.maxCost}
                            <li>
                                <a href="{echo str_replace(array('&lp=' . ShopCore::$_GET['lp'], '&rp=' . ShopCore::$_GET['rp'], '?rp=' . ShopCore::$_GET['rp'], '?lp=' . ShopCore::$_GET['lp']), "", $aurl)}">
                                    <i class="icon-times-red"></i>
                                    {if isset(ShopCore::$_GET['lp']) && ShopCore::$_GET['lp'] != (int)$priceRange.minCost}
                                        {lang("of","admin")} 
                                        {echo ShopCore::$_GET['lp']} {$CS}
                                    {/if}
                                    {if isset(ShopCore::$_GET['rp']) && ShopCore::$_GET['rp'] != (int)$priceRange.maxCost} 
                                        {lang("to","admin")} 
                                        {echo ShopCore::$_GET['rp']} {$CS}
                                    {/if}
                                </a>
                            </li>
                        {/if}
                    {/if}
                </ul>
                <a href="{site_url($CI->uri->uri_string())}" class="reset"><span class="icon-reset"></span>{lang("Reset all filters","admin")}</a>
            </div>
        {/if}
        <div class="content-filter">
            <div class="clearfix padding_filter">
                <div class="title">{lang("Price","admin")}</div>
                <div class="sliderCont">
                    <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                        <div class="ui-slider-range ui-widget-header"></div>
                        <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                        <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                    </div>
                </div>
                <div class="formCost f_l">
                    <label>{lang("of","admin")}</label>
                    <input type="text" id="minCost" name="lp" value="{if ShopCore::$_GET['lp'] && (int)ShopCore::$_GET['lp']>0 && (int)ShopCore::$_GET['lp']>(int)$priceRange.minCost}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}" autocomplete="off"/>
                    <label>{lang("to","admin")}</label>
                    <input type="text" id="maxCost" name="rp" value="{if ShopCore::$_GET['rp'] && (int)ShopCore::$_GET['rp']>0}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}" autocomplete="off"/>
                    <div class="buttons button_bs">
                        <input type="submit" value="ok" name="pricebutton"/>
                    </div>
                </div>
            </div>
            <div class="padding_filter">
                {if count($brands)>0}
                    <div class="check_frame">
                        <div class="title">{lang("Brands in category","admin")}</div>
                        <div class="clearfix check_form">
                            {foreach $brands as $br}
                                <label>
                                    <input {if $br->countProducts == 0}disabled="disabled"{/if} id="brand_{echo $br->id}" name="brand[]" value="{echo $br->id}" type="checkbox" {if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && in_array($br->id, ShopCore::$_GET['brand'])}checked="checked"{/if}/>
                                    <span class="name_model">{echo $br->name}<span>&nbsp;({if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && !in_array($br->id, ShopCore::$_GET['brand'])}+{/if}{echo $br->countProducts}) </span></span>
                                </label>
                            {/foreach}
                        </div>
                    </div>
                {/if}
                <div class="check_frame">
                    {foreach $propertiesInCat as $p}
                        {if empty($p->possibleValues)}{$show[] = "1"}{/if}
                    {/foreach}
                    {if count($show) != count($propertiesInCat)}
                        <div class="title">{lang("Properties","admin")}</div>
                        <div class="clearfix check_form">
                            {foreach $propertiesInCat as $prop}
                                {if empty($prop->possibleValues)}{continue}{/if}
                                <div class="padding_filter">
                                    <div class="title2">{echo $prop->name}</div>
                                    <div class="clearfix">
                                        {foreach $prop->possibleValues as $item}
                                            <label>
                                                <input {if $item.count == 0}disabled="disabled"{/if} class="propertyCheck" name="p[{echo $prop->property_id}][]" value="{echo $item.value}" type="checkbox" {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array($item.value, ShopCore::$_GET['p'][$prop->property_id]) && $item.count != 0}checked="checked"{/if}/>
                                                <span class="name_model">{echo $item.value}<span>&nbsp;({if $item.count != 0 && is_array(ShopCore::$_GET['p'][$prop->property_id]) && !in_array($item.value, ShopCore::$_GET['p'][$prop->property_id])}+{/if}{echo $item.count}) </span></span>
                                            </label>
                                        {/foreach}
                                    </div>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </form>
</div>