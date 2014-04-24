<div class="content_head">
    {widget('path')}
    <div class="crumbs">
        <h1>Подбор по параметрам</h1>
    </div>       
</div>
<hr class="head_cle_foot"/>
<form method="get" action="">
    <div class="main_frame_inside filter">
        <div class="title">Цена</div>
        <div class="range_price">
            <label class="f_l">
                <span class="f_l">от</span>
                <span class="frame_input">
                    <input name="lp" type="text" value="{if isset(ShopCore::$_GET['lp'])}{echo ShopCore::$_GET['lp']}{else:}{echo (int)$priceRange.minCost}{/if}"/>
                </span>
            </label>
            <label class="f_l">
                <span class="f_l">до</span>
                <span class="frame_input">
                    <input name="rp" type="text" value="{if isset(ShopCore::$_GET['rp'])}{echo ShopCore::$_GET['rp']}{else:}{echo (int)$priceRange.maxCost}{/if}"/>
                </span>
            </label>

        </div>
        {if count($brands)>0}        
            <div class="check_frame">
                <div class="title">Производитель</div>
                {foreach $brands as $brand}
                    {if is_array(ShopCore::$_GET['brand']) && in_array($brand->id, ShopCore::$_GET['brand'])}
                        {$check = 'checked="checked"'}
                    {else:}
                        {$check = ''}
                    {/if}
                    {if $brand->countProducts == 0 && $check == ''}
                        {$dis = 'disabled="disabled"'}
                    {else:}
                        {$dis = ""}
                    {/if}
                    <div class="frame_label">
                        <span class="f-s_0">
                            <span class="niceCheck b_n">
                                
                                <input {$dis} class="brand{echo $brand->id}" name="brand[]" value="{echo $brand->id}" type="checkbox" {$check}/>
                            </span>
                            <span class="neigh_r-o_c-k">{echo $brand->name}</span>
                        </span>
                    </div>
                {/foreach}
            </div>
        {/if}
        {if count($propertiesInCat) > 0}
            {foreach $propertiesInCat as $prop}
                {if count($prop->possibleValues) > 0}
                    <hr class="head_cle_foot"/>
                    <div class="check_frame">
                        <div class="title">{echo $prop->name}</div>

                        {foreach $prop->possibleValues as $item}

                            {if is_array(ShopCore::$_GET['p'][$prop->property_id]) && (in_array($item.value, ShopCore::$_GET['p'][$prop->property_id]) or in_array(htmlspecialchars_decode($item.value), ShopCore::$_GET['p'][$prop->property_id]))}
                                {$check = 'checked="checked"'} 
                            {else:} 
                                {$check = ''}
                            {/if}

                            {if $item.count == 0 && $check == ''}
                                {$dis = 'disabled="disabled"'}
                            {else:}
                                {$dis = ""}
                            {/if}
                            <div class="frame_label">
                                <span class="f-s_0" {if !$count_property}class="disabled"{/if}>
                                    <span class="niceCheck b_n">
                                        <input {$dis} name="p[{echo $prop->property_id}][]" value='{echo $item.value}' type="checkbox" {$check} />
                                    </span>
                                    <span class="neigh_r-o_c-k">{echo $item.value}</span>
                                </span>
                            </div>
                        {/foreach}
                    </div>
                {/if}
            {/foreach}
        {/if}

        <div class="f_l subm_filter">
            <input type="submit" value="Подобрать"/>
        </div>
        <!--                поставити
                        <hr class="head_cle_foot"/>
                        якщо є ще один блок - <div class="check_frame">-->
    </div>
    <div class="main_f_i_f-r"></div>
</form>