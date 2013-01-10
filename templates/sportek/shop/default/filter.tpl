{if $customField}        
{$requestArray = explode('/', $CI->uri->uri_string());}
<?php unset($requestArray[count($requestArray)-1]) ?>
{$base_url = implode('/', array_slice($requestArray, 2))}
{/if}
{if $_GET['f'] || $customField}
<script type="text/javascript" src="{$SHOP_THEME}js/libraries/jquery.scrollTo-min.js"></script>
{literal}
<script type="text/javascript">
    jQuery(document).ready(function(){jQuery.scrollTo('#toProducts', 1000);});
</script>
{/literal}
{/if}
{if !$def_price_min && !$def_price_max}
{$def_price_min = getLimiPrice($model->getid(), 'min');}
{$def_price_max = getLimiPrice($model->getid(), 'max');}
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
<div class="filter">
    <div class="title_h3">Подбор по параметрам</div>
    {if ($_GET['lp'] and $_GET[lp] > $def_price_min) or ($_GET['rp'] and $_GET['rp'] < $def_price_max) or $_GET['f'] or $_GET['brand']}
    <dl>
        <dd>
            <ul>
                {if $_GET['brand']}
                {foreach $allBrandsInCategory as $brand}
                {$j = 0}
                {foreach $_GET['brand'] as $id}
                {if $id == $brand->getId()}
                <li class="pun_fil" data-name="brand{echo $brand->getId()}"><span class="times"></span><span>{echo $brand->getName()}</span></li>
                {/if}
                {$j++}
                {/foreach}
                {/foreach}
                {/if}
                {if count($model->getProperties()) > 0}


                {foreach $model->getProperties() as $prop}
                {/*}
                {$show = false}
                {foreach $_GET['f'][$prop->getId()] as $id}
                {foreach $prop->asArray() as $key=>$val}
                {if $id == $key}
                {$show = true}
                {/if}
                {/foreach}
                {/foreach}
                {if $show}<span>{echo $prop->getName()}</span>{/if}
                {*/}

                {$j=0}
                {foreach $_GET['f'][$prop->getId()] as $id}
                {foreach $prop->asArray() as $key=>$val}
                {if $id == $key}
                <li class="pun_fil" data-name="prop{echo $prop->getId()}{echo $key}"><span class="times"></span><span>{echo $prop->getName()} - {echo $val}</span></li>
                {/if}
                {/foreach}
                {$i++}
                {/foreach}
                {/foreach}
                {/if} 
                {if $_GET['lp'] or $_GET['rp']}
                {if $_GET['lp'] > $def_price_min or $_GET['rp'] < $def_price_max}
                <li class="pun_fil delete_price"><span class="times"></span><span>От {echo $_GET['lp']} до {echo $_GET['rp']} {$CS}</span></li>
                {/if}
                {/if}
            </ul>
            <a href="{site_url($CI->uri->uri_string())}" class="reset">Сбросить все фильтры</a>
        </dd>
    </dl>
    {/if}
    {if $def_price_min != $def_price_max}
    <dl>
        <dt>Цена:</dt>
        <dd class="price">
            <div class="sliderCont">
                <div id="slider">
                    <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                    <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                </div>
            </div>
            <div class="formCost">
                <input type="text" data-default="{echo $def_price_min}" id="minCost" value="{$min_price}" name="lp" title="{$def_price_min}"><span>&mdash;</span>
                <input type="text" data-default="{echo $def_price_max}" id="maxCost" value="{$max_price}" name="rp" title="{$def_price_max}">
            </div>
        </dd>
    </dl>
    {/if}
    {if count($brandsInCategory) > 0}
    <dl>
        <dt>Бренды:</dt>
        <dd>
            {foreach $brandsInCategory as $brand}
            {if $_GET['brand'] && in_array($brand->getId(), $_GET['brand'])}{$check = ' checked="checked"'; $act = 'class="active"'} {else:} {$check = '';$act = ''}{/if}
            <label {$act}><input type="checkbox" name="brand[]" value="{echo $brand->getId()}"{$check} class="brand{echo $brand->getId()}"/><span>{echo ShopCore::encode($brand->getName())}</span></label>
            {/foreach}
        </dd>
    </dl>        
    {/if}
    {if $model->countProperties() > 0}
    {$ecvator = round(count($model->getProperties())/2)}{$count = -1}
    {foreach $model->getProperties() as $prop} {$count++}
    <dl>
        <dt>{echo $prop->getName()}:</dt>
        <dd>
            {foreach $prop->asArray() as $key=>$val}
            {if is_property_in_get($prop->getId(), $key) || is_property_in_customField($customField, $prop->getId(), $key)} {$checked = 'checked="checked"'; $active = 'class="active"'} {else:} {$checked = '';$active = ''} {/if}
            <label {$active}><input type="checkbox"  name="f[{echo $prop->getId()}][]" {$checked} value="{$key}" class="prop{echo $prop->getId()}{echo $key}"/><span>{$val}</span></label>
            {/foreach}
        </dd>
    </dl>
    {/foreach}
    {/if}
    <dl>
        <dd>
            <div class="sear_fil">
                <input type="submit" class="b_f" value="Фильтровать" />
            </div>
        </dd>
    </dl>

</div>
<div id="toProducts" class="clear"></div>
