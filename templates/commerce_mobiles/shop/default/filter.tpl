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
</script>

        <div class="content_head">
            <div class="crumbs">{renderCategoryPath($model)}<h1>Подбор по параметрам</h1>
            </div>
        </div>
        <hr class="head_cle_foot"/>
        <form method="GET" action="{shop_url('category/'.$model->getFullPath())}">
            <div class="main_frame_inside filter">
                <div class="title">Цена</div>
                <div class="range_price">
                    <label class="f_l">
                        <span class="f_l">от</span><span class="frame_input"><input type="text" id="minCost" name="lp" value="{$min_price}" /></span>
                    </label>
                    <label class="f_l">
                        <span class="f_l">до</span><span class="frame_input"><input type="text" id="minCost" name="rp" value="{$max_price}" /></span>
                    </label>
                    <div class="f_l subm_filter">
                        <input type="submit" value="Подобрать"/>
                    </div>
                </div>
                <div class="check_frame">
                    <div class="title">Производитель</div>
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
                    <div class="frame_label">
                        <span class="f-s_0">
                            <span class="niceCheck b_n"><input id="brand_{echo $brand->getId()}" name="brand[]" value="{echo $brand->getId()}" type="checkbox" {echo $check} {echo $activeness} /></span>
                            <span class="neigh_r-o_c-k">{echo $brand->getName()}</span>
                        </span>
                    </div>
                    {/foreach}
                </div>
                {foreach $model->getProperties() as $prop}
                {if !$prop->getShowInFilter()} { continue; } {/if}
                <hr class="head_cle_foot"/>
                <div class="check_frame">
                <div class="title">{echo $prop->getName()}</div>

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
                    <div class="frame_label">
                    <span class="f-s_0" {if !$count_property}class="disabled"{/if}>
                        <span class="niceCheck b_n"><input  {if !$count_property}disabled="disabled"{/if} id="prop_{echo $prop->getId() . '_' . $key}" type="checkbox" name="f[{echo $prop->getId()}][]" value="{echo $key}" {echo $check} {echo $activeness} /></span>
                        <span class="neigh_r-o_c-k">{echo $val}</span>
                    </span>
                    </div>
                {/foreach}
                </div>
                {/foreach}
                <div class="f_l subm_filter">
                    <input type="submit" value="Подобрать"/>
                </div>
                <!--                поставити
                                <hr class="head_cle_foot"/>
                                якщо є ще один блок - <div class="check_frame">-->
            </div>
            <div class="main_f_i_f-r"></div>
        </form>