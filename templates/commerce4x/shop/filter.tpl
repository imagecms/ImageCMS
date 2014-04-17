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


{//main filter container}
<aside class="span3">
    {//define default values for price slider}
    <span id="opt1" data-def_min = "{echo (int)$priceRange.minCost}"></span>
    <span id="opt2" data-def_max = "{echo (int)$priceRange.maxCost}"></span>
    <span id="opt3" data-cur_min = "{if isset(ShopCore::$_GET['lp'])}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}"></span>
    <span id="opt4" data-cur_max = "{if isset(ShopCore::$_GET['rp'])}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}"></span>

    {//creating current url string}
    {$aurl = urldecode(site_url($_SERVER['REQUEST_URI']))}


    {//displaying checked filters and count of found products}
    {if ($_GET['lp'] and $_GET['lp'] > $priceRange.minCost) or ($_GET['rp'] and $_GET['rp'] < $priceRange.maxCost) or $_GET['p'] or $_GET['brand'] or $_GET['category']}
        <div class="checked_filter">

            {//displaying count of found products}
            <div class="title">
                {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array(lang("product","admin"), lang("product","admin"), lang("product","admin")))} {lang("with filters","admin")}:
            </div>
            <ul>
                {//displaying checked brands filters}
                {if count($brands) > 0}
                    {foreach $brands as $brand}
                        {foreach $_GET['brand'] as $id}
                            {if $id == $brand->id}
                                <li>
                                    <div class="o_h">
                                        {//link to uncheck current filter}
                                        <a data-id="brand_{echo $brand->id}" class="del_filter_item" href="{echo str_replace(array('&brand[]=' . $brand->id, '?brand[]=' . $brand->id), '', $aurl)}" style="text-decoration: none;"><span class="times">&times;</span>{echo ShopCore::encode($brand->name)}</a>
                                    </div>
                                </li>
                            {/if}
                        {/foreach}
                    {/foreach}
                {/if}

                {//displaying checked category filters}
                {if count($categoriesInBrand) > 0}
                    {foreach $categoriesInBrand as $category}
                        {foreach $_GET['category'] as $id}
                            {if $id == $category->category_id}
                                <li>
                                    <div class="o_h">
                                        {//link to uncheck current filter}
                                        <a class="del_filter_item" data-id="category_{echo $category->category_id}" href="{echo str_replace(array('&category[]=' . $category->category_id, '?category[]=' . $category->category_id), '', $aurl)}" style="text-decoration: none;"><span class="times">&times;</span>{echo ShopCore::encode($category->name)}</a>
                                    </div>
                                </li>
                            {/if}
                        {/foreach}
                    {/foreach}
                {/if}

                {//displaying checked properties filters}
                {if count($propertiesInCat) > 0}
                    {foreach $propertiesInCat as $prop}
                        {if count(ShopCore::$_GET['p'][$prop->property_id])>0}
                            {foreach $prop->possibleValues as $key}
                                {foreach $_GET['p'][$prop->property_id] as $id}
                                    {if ShopCore::encode($id) == $key.value}
                                        <li>
                                            <div class="o_h">
                                                {//link to unckeck current filter}
                                                <a class="del_filter_item" data-id="prop_{echo $prop->property_id}/{$key.value}" href="{echo str_replace(array('&p[' . $prop->property_id . '][]=' . htmlspecialchars_decode($key.value), '?p[' . $prop->property_id . '][]=' . htmlspecialchars_decode($key.value)),'',$aurl)}" style="text-decoration: none;"><span class="times">&times;</span>{echo ShopCore::encode($prop->name).": ".$key.value}</a>
                                            </div>
                                        </li>
                                    {/if}
                                {/foreach}
                            {/foreach}
                        {/if}
                    {/foreach}
                {/if}

                {//displaying price range filter}
                {if isset(ShopCore::$_GET['lp']) OR isset(ShopCore::$_GET['rp'])}
                    {if ShopCore::$_GET['lp'] > (int)$priceRange.minCost or ShopCore::$_GET['rp'] < (int)$priceRange.maxCost}
                        <li>
                            <div class="o_h">
                                {//link to uncheck filter by price}
                                {$url = str_replace(array('&lp=' . ShopCore::$_GET['lp'], '&rp=' . ShopCore::$_GET['rp'], '?rp=' . ShopCore::$_GET['rp'], '?lp=' . ShopCore::$_GET['lp']), '', $aurl)}
                                {$position = strpos($url, '&')}
                                <a class="del_price" def_min="{(int)$priceRange.minCost}" def_max="{echo (int)$priceRange.maxCost}" href="{echo substr_replace($url, '?', $position,1)}">

                                    <span class="times">&times;</span>
                                    {if isset(ShopCore::$_GET['lp']) && ShopCore::$_GET['lp'] != (int)$priceRange.minCost}

                                        {lang("of","admin")} 
                                        {echo ShopCore::$_GET['lp']} {$CS}
                                    {/if}
                                    {if isset(ShopCore::$_GET['rp']) && ShopCore::$_GET['rp'] != (int)$priceRange.maxCost}
                                        {lang("to","admin")} 

                                        {echo ShopCore::$_GET['rp']} {$CS}
                                    {/if}
                                </a>
                            </div>
                        </li>
                    {/if}
                {/if}
            </ul>

            {//link to remove all checked filters}
           
            <a href="{site_url($CI->uri->uri_string())}">
                <span class="icon-return"></span>
                {lang("Reset all filters","admin")}
            </a>
         
        </div>
    {/if}

    {//all filters container}
    <div class="filter">

        {//form for submiting checked filters}
        <form id="filter" method="get" action="">
            <input type=hidden name="order" value="{echo $order_method}"/>
            <input type=hidden name="user_per_page" value="{if !$_GET['user_per_page']}{echo \ShopCore::app()->SSettings->frontProductsPerPage}{else:}{echo $_GET['user_per_page']}{/if}"/>
            {if (int)$priceRange.minCost >= 0 && (int)$priceRange.maxCost != 0}
                <div class="boxFilter">
                    {//meet slider}
                    <div class="title">{lang("Price","admin")}</div>
                    <div class="sliderCont">
                        <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                            <img src="{$THEME}images/slider.png" alt="slider"/>
                            <div class="ui-slider-range ui-widget-header"></div>
                            <a href="#" class="ui-slider-handle" id="left_slider"></a>
                            <a href="#" class="ui-slider-handle" id="right_slider"></a>
                        </div>
                    </div>

                    {//inputs for displaying price range in numeric format}
                    <div class="formCost t-a_j number">
                        <label>

                            {//left price value}
                            <input type="text" name="lp" id="minCost" value="{if ShopCore::$_GET['lp'] && (int)ShopCore::$_GET['lp']>0 && (int)ShopCore::$_GET['lp']>(int)$priceRange.minCost}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}" data-title="только цифры" data-minS="{echo (int)$priceRange.minCost}"/>
                        </label>
                        <span class="f-s_12">&ndash;</span>
                        <label>

                            {//rigth price value}
                            <input type="text" name="rp" id="maxCost" value="{if ShopCore::$_GET['rp'] && (int)ShopCore::$_GET['rp']>0}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}" data-title="только цифры" data-maxS="{echo (int)$priceRange.maxCost}"/>
                        </label>

                        {//button for submiting filter}
                        <button type="submit" class="btn f-s_0 filterSubmit">
                            <span class="icon-filter"></span>
                            <span class="text-el">Подобрать</span>
                        </button>
                    </div>
                </div>
            {/if}

            {//displaying all possible brands in current category}
            {if count($brands)>0}
                <div class="boxFilter">
                    <div class="title">{lang("Brands in category","admin")}</div>
                    <div class="clearfix check_form">
                        {//loop for which outputs all brands}
                        {foreach $brands as $br}
                            <div class="frameLabel">
                                <span class="niceCheck b_n">

                                    {//one brand checkbox input}
                                    <input type="checkbox" {if $br->countProducts == 0}disabled="disabled"{/if} id="brand_{echo $br->id}" name="brand[]" value="{echo $br->id}" type="checkbox" {if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && in_array($br->id, ShopCore::$_GET['brand'])}checked="checked"{/if}/>
                                </span>
                                <span class="filterLable">

                                    {//displaying brand name}
                                    {echo ShopCore::encode($br->name)}&nbsp;

                                    {//displaying products number with this brand in current category}
                                    <span>({if $br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && !in_array($br->id, ShopCore::$_GET['brand'])}+{/if}{echo $br->countProducts})</span>
                                </span>
                            </div>
                        {/foreach}
                    </div>
                </div>
            {/if}

            {//displaying all possible properties in current category}

            {//checking all properties with empty possible values}
            {foreach $propertiesInCat as $p}
                {if empty($p->possibleValues)}
                    {$show[] = "1"}
                {/if}
            {/foreach}

            {//display properties only if they have possible values}
            {if count($show) != count($propertiesInCat)}

                {//loop for properties array}
                {foreach $propertiesInCat as $prop}
                    {//check if property has not empty possible values}
                    {if empty($prop->possibleValues)}
                        {continue}
                    {/if}

                    {//property possible values container}
                    <div class="boxFilter">

                        {//displaying property name}
                        <div class="title">{echo ShopCore::encode($prop->name)}</div>

                        <div class="clearfix check_form">

                            {//loop for displaying all current property possible values}
                            {foreach $prop->possibleValues as $item}
                                <div class="frameLabel">
                                    <span class="niceCheck b_n">
                                        {//if we dont have products in current category with such possible value, we will disable checkbox}
                                        <input id="prop_{echo $prop->property_id}" {if $item.count == 0}disabled="disabled"{/if} class="propertyCheck" name="p[{echo $prop->property_id}][]" value="{echo $item.value}" type="checkbox" {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array($item.value, ShopCore::$_GET['p'][$prop->property_id]) && $item.count != 0}checked="checked"{/if}/>
                                    </span>

                                    {//displaying possible value}
                                    <span class="filterLable">{echo $item.value}&nbsp;

                                        {//displaying possible value products count}
                                        <span>({//if $item.count != 0 && is_array(ShopCore::$_GET['p'][$prop->property_id]) && !in_array($item.value, ShopCore::$_GET['p'][$prop->property_id])}{///if}{echo $item.count})</span>
                                    </span>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                {/foreach}
            {/if}

            {//displaying all possible categories in current brand}
            {if count($categoriesInBrand)>0}
                <div class="boxFilter">
                    <div class="title">Категории</div>
                    <div class="clearfix check_form">
                        {//loop which outputs all brands}
                        {foreach $categoriesInBrand as $category}
                            <div class="frameLabel">
                                <span class="niceCheck b_n">

                                    {//one category checkbox input}
                                    <input id="category_{echo $category->category_id}" type="checkbox" {if $category->countProducts == 0}disabled="disabled"{/if} name="category[]" value="{echo $category->category_id}" type="checkbox" {if $category->countProducts !=0 && is_array(ShopCore::$_GET['category']) && in_array($category->category_id, ShopCore::$_GET['category'])}checked="checked"{/if}/>
                                </span>
                                <span class="filterLable">

                                    {//displaying category name}
                                    {echo ShopCore::encode($category->name)}&nbsp;

                                    {//displaying products number with this category in current brand}
                                    <span>({if $category->countProducts !=0 && is_array(ShopCore::$_GET['category']) && !in_array($category->category_id, ShopCore::$_GET['category'])}+{/if}{echo $category->countProducts})</span>
                                </span>
                            </div>
                        {/foreach}
                    </div>
                </div>
            {/if}
            {//hidden input for saving users order method}
            <input type="hidden" name="order" value="{echo ShopCore::$_GET['order']}">

            {//hidden input for saving users products per page count}
            <input type="hidden" name="user_per_page" value="{echo ShopCore::$_GET['user_per_page']}">

            {//container for displaying price range slider}
        </form>
    </div>
</aside>
<script type="text/javascript" src="{$THEME}js/jquery.ui-slider.js"></script>
