<span id="opt1" data-def_min = "<?php echo (int) $priceRange['minCost']  ?>"></span>
<span id="opt2" data-def_max = "<?php echo (int) $priceRange['maxCost']  ?>"></span>
<span id="opt3" data-cur_min = "<?php if(isset(ShopCore::$_GET['lp'])): ?><?php echo ShopCore::$_GET['lp']?><?php else:?><?php echo (int) $priceRange['minCost']  ?><?php endif; ?>"></span>
<span id="opt4" data-cur_max = "<?php if(isset(ShopCore::$_GET['rp'])): ?><?php echo ShopCore::$_GET['rp']?><?php else:?><?php echo (int) $priceRange['maxCost']  ?><?php endif; ?>"></span>

<?php $aurl = urldecode(site_url($_SERVER['REQUEST_URI']))?>
<div class="filter">
    <form name="brandsfilter" id="brandsfilter" method="get" action="<?php echo shop_url ('category/'.$model->full_path); ?>">
        <input type="hidden" name="order" value="<?php echo ShopCore::$_GET['order']?>">
        <input type="hidden" name="user_per_page" value="<?php echo ShopCore::$_GET['user_per_page']?>">
        <?php if(($_GET['lp'] and $_GET['lp'] >  $priceRange['minCost'] ) or ($_GET['rp'] and $_GET['rp'] <  $priceRange['maxCost'] ) or $_GET['p'] or $_GET['brand']): ?>
            <div class="checked_filter padding_filter">
                <span class="c_4f"><?php if(isset($totalProducts)){ echo $totalProducts; } ?> <?php echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))?> <?php echo lang ('s_filter_s_foa'); ?>:</span>
                <ul>
                    <?php if(count($brands) > 0): ?>
                        <?php if(is_true_array($brands)){ foreach ($brands as $brand){ ?>
                            <?php if(is_true_array($_GET['brand'])){ foreach ($_GET['brand'] as $id){ ?>
                                <?php if($id == $brand->id): ?>
                                    <li><a href="<?php echo str_replace('&brand[]=' . $brand->id,'',$aurl)?>"><i class="icon-times-red"></i><?php echo $brand->name?></a></li>
                                        <?php endif; ?>
                                    <?php }} ?>
                                <?php }} ?>
                            <?php endif; ?>
                            <?php if(count($propertiesInCat) > 0): ?>
                                <?php if(is_true_array($propertiesInCat)){ foreach ($propertiesInCat as $prop){ ?>
                                    <?php if(count(ShopCore::$_GET['p'][$prop->property_id])>0): ?>
                                        <?php if(is_true_array($prop->possibleValues)){ foreach ($prop->possibleValues as $key){ ?>
                                            <?php if(is_true_array($_GET['p'][$prop->property_id])){ foreach ($_GET['p'][$prop->property_id] as $id){ ?>
                                                <?php if($id ==  $key['value']): ?>
                                            <li><a href="<?php echo str_replace('&p[' . $prop->property_id . '][]=' .  $key['value'] ,'',$aurl) ?>"><i class="icon-times-red"></i><?php echo $prop->name.": ". $key['value']  ?></a></li>
                                                <?php endif; ?>
                                            <?php }} ?>
                                        <?php }} ?>
                                    <?php endif; ?>
                                <?php }} ?>
                            <?php endif; ?>
                            <?php if(isset(ShopCore::$_GET['lp']) OR isset(ShopCore::$_GET['rp'])): ?>
                        <li><a href="<?php echo str_replace('&lp=' . ShopCore::$_GET['lp'] . '&rp=' . ShopCore::$_GET['rp'], "", $aurl)?>"><i class="icon-times-red"></i><?php if(isset(ShopCore::$_GET['lp'])): ?><?php echo lang ('s_from'); ?> <?php echo ShopCore::$_GET['lp']?> <?php if(isset($CS)){ echo $CS; } ?><?php endif; ?><?php if(isset(ShopCore::$_GET['rp'])): ?> <?php echo lang ('s_do'); ?> <?php echo ShopCore::$_GET['rp']?> <?php if(isset($CS)){ echo $CS; } ?><?php endif; ?></a></li>
                        <?php endif; ?>
                </ul>
                <a href="<?php echo site_url ($CI->uri->uri_string()); ?>" class="reset"><span class="icon-reset"></span><?php echo lang ('s_filter_all_reset'); ?></a>
            </div>
        <?php endif; ?>
        <div class="content-filter">
            <div class="clearfix padding_filter">
                <div class="title"><?php echo lang ('s_price'); ?></div>
                <div class="sliderCont">
                    <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content">
                        <div class="ui-slider-range ui-widget-header"></div>
                        <a class="ui-slider-handle ui-state-default" href="#" id="left_slider"></a>
                        <a class="ui-slider-handle ui-state-default" href="#" id="right_slider"></a>
                    </div>
                </div>
                <div class="formCost f_l">
                    <label><?php echo lang ('s_from'); ?></label>
                    <input type="text" id="minCost" name="lp" value="<?php if(ShopCore::$_GET['lp'] && (int)ShopCore::$_GET['lp']>0 && (int)ShopCore::$_GET['lp']>(int) $priceRange['minCost']): ?><?php echo ShopCore::$_GET['lp']?><?php else:?><?php echo (int) $priceRange['minCost']  ?><?php endif; ?>" autocomplete="off"/>
                    <label><?php echo lang ('s_do'); ?></label>
                    <input type="text" id="maxCost" name="rp" value="<?php if(ShopCore::$_GET['rp'] && (int)ShopCore::$_GET['rp']>0): ?><?php echo ShopCore::$_GET['rp']?><?php else:?><?php echo (int) $priceRange['maxCost']  ?><?php endif; ?>" autocomplete="off"/>
                    <div class="buttons button_bs">
                        <input type="submit" value="ok" name="pricebutton"/>
                    </div>
                </div>
            </div>
            <div class="padding_filter">
                <?php if(count($brands)>0): ?>
                    <div class="check_frame">
                        <div class="title">Бренды в категории</div>
                        <div class="clearfix check_form">
                            <?php if(is_true_array($brands)){ foreach ($brands as $br){ ?>
                                <label>
                                    <input <?php if($br->countProducts == 0): ?>disabled="disabled"<?php endif; ?> id="brand_<?php echo $br->id?>" name="brand[]" value="<?php echo $br->id?>" type="checkbox" <?php if($br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && in_array($br->id, ShopCore::$_GET['brand'])): ?>checked="checked"<?php endif; ?>/>
                                    <span class="name_model"><?php echo $br->name?><span>&nbsp;(<?php if($br->countProducts !=0 && is_array(ShopCore::$_GET['brand']) && !in_array($br->id, ShopCore::$_GET['brand'])): ?>+<?php endif; ?><?php echo $br->countProducts?>) </span></span>
                                </label>
                            <?php }} ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="check_frame">
                    <?php if(is_true_array($propertiesInCat)){ foreach ($propertiesInCat as $p){ ?>
                    <?php if(empty($p->possibleValues)): ?><?php $show[] = "1"?><?php endif; ?>
                <?php }} ?>
                <?php if(count($show) != count($propertiesInCat)): ?>
                    <div class="title">Свойства</div>
                    <div class="clearfix check_form">
                        <?php if(is_true_array($propertiesInCat)){ foreach ($propertiesInCat as $prop){ ?>
                        <?php if(empty($prop->possibleValues)): ?><?php continue?><?php endif; ?>
                        <div class="padding_filter">
                            <div class="title2"><?php echo $prop->name?></div>
                            <div class="clearfix">
                                <?php if(is_true_array($prop->possibleValues)){ foreach ($prop->possibleValues as $item){ ?>
                                    <label>
                                        <input <?php if($item['count']  == 0): ?>disabled="disabled"<?php endif; ?> class="propertyCheck" name="p[<?php echo $prop->property_id?>][]" value="<?php echo  $item['value']  ?>" type="checkbox" <?php if(is_array(ShopCore::$_GET['p'][$prop->property_id]) && in_array( $item['value'] , ShopCore::$_GET['p'][$prop->property_id]) &&  $item['count']  != 0): ?>checked="checked"<?php endif; ?>/>
                                        <span class="name_model"><?php echo  $item['value']  ?><span>&nbsp;(<?php if($item['count']  != 0 && is_array(ShopCore::$_GET['p'][$prop->property_id]) && !in_array( $item['value'] , ShopCore::$_GET['p'][$prop->property_id])): ?>+<?php endif; ?><?php echo  $item['count']  ?>) </span></span>
                                    </label>
                                <?php }} ?>
                            </div>
                        </div>
                    <?php }} ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</form>
</div><?php $mabilis_ttl=1357399731; $mabilis_last_modified=1356779795; ///var/www/imagecms.loc/templates/commerce/shop/default/filter.tpl ?>