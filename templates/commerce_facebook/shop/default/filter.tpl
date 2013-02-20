{if $model}
{$def_price_min = getLimiPrice($model->getid(), 'min');}
{$def_price_max = getLimiPrice($model->getid(), 'max');}
{else:}
{$def_price_min = getLimitAllPrice('min');}
{$def_price_max = getLimitAllPrice('max');}
{/if}
{if encode(ShopCore::$_GET['lp'])}
{$min_price = encode(ShopCore::$_GET['lp']);}
{else:}
{$min_price = $def_price_min}
{/if}
{if encode(ShopCore::$_GET['rp'])}
{$max_price = encode(ShopCore::$_GET['rp']);}
{else:}
{$max_price = $def_price_max}
{/if}
{$aurl = urldecode(site_url($_SERVER['REQUEST_URI']))}

<script type="text/javascript">
    var def_min= {$def_price_min};
    var def_max= {$def_price_max};
    var cur_min= {$min_price};
    var cur_max= {$max_price};
    
    {literal}
    $(document).ready(function() {
        if ($('#user_per_page_c').val() == '')
            $('#user_per_page_c').val($('#cusel-scroll-count').children('span:first-child').html());
    });
    {/literal}
</script>

<div class="filter">
    <form method="GET" action="{shop_url('category/'.$model->getFullPath())}" class="clearfix">
        {if isset($_GET['order'])}<input type="hidden" name="order" value="{echo $_GET['order']}">{/if}
        
        {/*}<div class="box_title padding_filter">
            <div class="title">Клас</div>
            <div class="lineForm">
                <select id="class" name="order" tabindex="1">
                    <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>от дешевых к дорогим</option>
                    <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >от дорогих к дешевым</option>
                    <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>популярные</option>
                    <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>новинки</option>
                    <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>акции</option>
                </select>
            </div>
        </div>{*/}

        {if ($_GET['lp'] and $_GET[lp] > $def_price_min) or ($_GET['rp'] and $_GET['rp'] < $def_price_max) or $_GET['f'] or $_GET['brand']}
        <div class="title padding_filter">Подбор по параметрам</div>
        <div class="checked_filter padding_filter">
            <span class="c_4f">{count($products)} {echo SStringHelper::Pluralize(count($products), array('товар','товара','товаров'))} с фильтрами:</span>
            <ul>
            {if count($allBrandsInCategory) > 0}
                {foreach $allBrandsInCategory as $brand}
                    {foreach $_GET['brand'] as $id}
                        {if $id == $brand->getId()}
                            <li><a href="{echo str_replace('&brand[]=' . $brand->getId(),'',$aurl)}"><i class="times"></i>{echo $brand->getName()}</a></li>
                        {/if}
                    {/foreach}
                {/foreach}
            {/if}
            {if count($model->getProperties()) > 0}
                {foreach $model->getProperties() as $prop}
                    {foreach $prop->asArray() as $key=>$val}
                        {foreach $_GET['f'][$prop->getId()] as $id}
                            {if $id == $key}
                                <li><a href="{echo str_replace('&f[' . $prop->getId() . '][]=' . $key,'',$aurl)}"><i class="times"></i>{echo $val}</a></li>
                            {/if}
                        {/foreach}
                    {/foreach}
                {/foreach}
            {/if}
            {if $_GET['lp'] or $_GET['rp']}
                {if $_GET['lp'] > $def_price_min or $_GET['rp'] < $def_price_max}
                    <li><a href="{echo str_replace('&lp=' . $min_price . '&rp=' . $max_price,'&lp=' . $def_price_min . '&rp=' . $def_price_max, $aurl)}"><i class="times"></i>От {echo $_GET['lp']} до {echo $_GET['rp']} {$CS}</a></li>
                {/if}
            {/if}
            </ul>
            <a href="{site_url($CI->uri->uri_string())}" class="reset">Сбросить все фильтры</a>
        </div>
        {/if}
        <input type="hidden" value="{if $_GET['user_per_page']}{$_GET['user_per_page']}{/if}" id="user_per_page_c" name="user_per_page" />
        <div class="clearfix padding_filter">
            <div class="title">Цена</div>
            <div class="sliderCont">
                <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                    <div class="ui-slider-range ui-widget-header"></div>
                    <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                    <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                </div>
            </div>
            <div class="formCost f_l">
                <label>от</label>
                <input type="text" id="minCost" name="lp" value="{$min_price}" autocomplete="off"/>
                <label>до</label>
                <input type="text" id="maxCost" name="rp" value="{$max_price}" autocomplete="off"/>
                <div class="buttons button_bs">
                    <input type="submit" value="ok"/>
                </div>
            </div>
        </div>
        {$count_brands = array_count_values($brandsInCategory)}        
        {if $count_brands}
        <div class="padding_filter check_frame">
            <div class="title">Производитель</div>
            <div class="clearfix check_form">
                <!--<label class="disabled"><input type="checkbox" disabled="disabled"/><span class="name_model">Philips <span>(14)</span></span></label>-->
            {$count_brands = array_count_values($brandsInCategory)}
            {foreach $allBrandsInCategory as $brand}
                {$count_brand = $count_brands[$brand->getId()];}
                {if $_GET['brand']}
                    {if in_array($brand->getId(), $_GET['brand'])}{$check = 'checked="checked"'} {else:} {$check = ''}{/if}
                {/if}
                {if $count_brand}
                    {$activeness = ''}
                {else:}
                    {$activeness = 'class="not_disabled"'}
                    {$count_brand = 0}
                {/if}
                    <label><input id="brand_{echo $brand->getId()}" name="brand[]" value="{echo $brand->getId()}" type="checkbox" {echo $check} {echo $activeness} />
                    <span class="name_model">{echo $brand->getName()}</span>
                    <span>({echo $count_brand})</span>
                    </label>
            {/foreach}
                <!--<label><input type="checkbox"/><span class="name_model">Toshiba <span>(15)</span></span></label>-->
            </div>
        </div>
        {/if}
        <div class="padding_filter check_frame">            
            {foreach $model->getProperties() as $prop}
            {if !$prop->getShowInFilter()} { continue; } {/if}
            <div class="title">{echo $prop->getName()}</div>
            <div class="clearfix check_form">
            {if $propertiesInCategory[$prop->getId()]}
                {$count_properties = array_count_values($propertiesInCategory[$prop->getId()])}                
            {else:}
                {$count_properties = array('0')}
            {/if}
            {foreach $prop->asArray() as $key=>$val}                
                {$count_property = $count_properties[$val];}
                {if is_property_in_get($prop->getId(), $key)}{$check = 'checked="checked"'} {else:} {$check = ''}{/if}
                {if $count_property}
                    {$activeness = ''}
                {else:}
                    {$activeness = 'class="not_disabled"'}
                    {$count_property = 0}
                {/if}                
                <label {if !$count_property}class="disabled"{/if}>
                    <input  {if !$count_property}disabled="disabled"{/if} id="prop_{echo $prop->getId() . '_' . $key}" type="checkbox" name="f[{echo $prop->getId()}][]" value="{echo $key}" {echo $check} {echo $activeness} />
                    <span class="name_model">{echo $val}</span>
                    <span>({$count_property})</span>
                </label>
            {/foreach}
            </div>
            {/foreach}
            <div class="button_middle_blue buttons t-a_c"><input type="submit" value="Подобрать"/></div>
        </div>
    </form>
</div>   