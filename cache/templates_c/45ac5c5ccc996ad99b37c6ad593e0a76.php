<div class="content">

    <!-- Show Brands in circle -->
    <?php $banners = getBanners()?>
    <?php if(count($banners)): ?>
        <div class="cycle center">
            <ul>
                <?php if(is_true_array($banners)){ foreach ($banners as $banner){ ?>
                    <li>
                        <a href="<?php echo $banner->getUrl()?>">
                            <img src="/uploads/shop/banners/<?php echo $banner->getImage()?>" alt="<?php echo ShopCore::encode($banner->getName())?>" />
                        </a>
                    </li>
                <?php }} ?>
            </ul>
            <span class="nav"></span>
            <button class="prev"></button>
            <button class="next"></button>
        </div>
    <?php endif; ?>
    <!-- Show Brands in circle -->


    <!--                ТЕСТ ФЕНСІ-->
    <!--    <a href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/images/temp/cycle_1.jpg" class="img" rel="group"><img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--    <a href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/images/temp/cycle_2.jpg" class="img" rel="group"><img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--                ЕНД-->

    <?php $cart_data = ShopCore::app()->SCart->getData()?>
    <div class="center">
        <?php if(count(getPromoBlock('popular', 10))>0): ?>
        <div class="box_title"><span class="f-s_24"><?php echo lang ('s_PP'); ?></span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    <?php $result = getPromoBlock('popular', 10); 
 if(is_true_array($result)){ foreach ($result as $hotProduct){ ?>
                        <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)?>
                        <?php $style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())?>
                        <li <?php if($hotProduct->firstvariant->getstock()==0): ?>class="not_avail"<?php endif; ?>>
                            <div class="small_item">
                                <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="img">
                                    <span>
                                        <img src="<?php echo productImageUrl ($hotProduct->getMainModimage()); ?>" alt="<?php echo ShopCore::encode($hotProduct->getName())?>" />
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="title"><?php echo ShopCore::encode($hotProduct->getName())?></a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                <?php $prOne = $hotProduct->firstvariant->getPrice()?>
                                                <?php $prTwo = $hotProduct->firstvariant->getPrice()?>
                                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $hotProduct->firstvariant->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                            <?php else:?>
                                                <?php $prThree = $hotProduct->firstvariant->getPrice()?>
                                            <?php endif; ?>
                                            <?php echo $prThree?> 
                                            <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                        </div>
                                        <div class="<?php echo $style['class']; ?> buttons">
                                            <span class="<?php echo $style['identif']; ?>" data-varid="<?php echo $hotProduct->firstVariant->getId()?>" data-prodid="<?php echo $hotProduct->getId()?>"><?php echo $style['message']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }} ?>
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div><?php endif; ?>
                <!-- featured -->
       
        <?php if(count(getPromoBlock('hot', 10))>0): ?>
        <div class="box_title"><span class="f-s_24"><?php echo lang ('s_new'); ?></span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    <?php $result = getPromoBlock('hot', 10); 
 if(is_true_array($result)){ foreach ($result as $hotProduct){ ?>
                        <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)?>
                        <?php $style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())?>
                        <li <?php if($hotProduct->firstvariant->getstock()==0): ?>class="not_avail"<?php endif; ?>>
                            <div class="small_item">
                                <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="img">
                                    <span>
                                        <img src="<?php echo productImageUrl ($hotProduct->getMainModimage()); ?>" alt="<?php echo ShopCore::encode($hotProduct->getName())?>"/>
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="title"><?php echo ShopCore::encode($hotProduct->getName())?></a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                <?php $prOne = $hotProduct->firstvariant->getPrice()?>
                                                <?php $prTwo = $hotProduct->firstvariant->getPrice()?>
                                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $hotProduct->firstvariant->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                            <?php else:?>
                                                <?php $prThree = $hotProduct->firstvariant->getPrice()?>
                                            <?php endif; ?>
                                            <?php echo $prThree?> 
                                            <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                        </div>
                                        <div class="<?php echo $style['class']; ?> buttons">
                                            <span class="<?php echo $style['identif']; ?>" data-varid="<?php echo $hotProduct->firstVariant->getId()?>" data-prodid="<?php echo $hotProduct->getId()?>"><?php echo $style['message']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }} ?>
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div><?php endif; ?>
         <?php if(count(getPromoBlock('action', 10))>0): ?>
        <div class="box_title"><span class="f-s_24"><?php echo lang ('s_action'); ?></span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    <?php $result = getPromoBlock('action', 10); 
 if(is_true_array($result)){ foreach ($result as $hotProduct){ ?>
                        <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)?>
                        <?php $style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())?>
                        <li <?php if($hotProduct->firstvariant->getstock()==0): ?>class="not_avail"<?php endif; ?>>
                            <div class="small_item">
                                <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="img">
                                    <span>
                                        <img src="<?php echo productImageUrl ($hotProduct->getMainModimage()); ?>" alt="<?php echo ShopCore::encode($hotProduct->getName())?>" />
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="title"><?php echo ShopCore::encode($hotProduct->getName())?></a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                <?php $prOne = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prTwo = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $hotProduct->firstVariant->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                            <?php else:?>
                                                <?php $prThree = $hotProduct->firstVariant->getPrice()?>
                                            <?php endif; ?>
                                            <?php echo $prThree?> 
                                            <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                        </div>
                                        <div class="<?php echo $style['class']; ?> buttons">
                                            <span class="<?php echo $style['identif']; ?>"  data-varid="<?php echo $hotProduct->firstVariant->getId()?>" data-prodid="<?php echo $hotProduct->getId()?>"><?php echo $style['message']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }} ?>
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div><?php endif; ?>
        <?php echo widget ('latest_news'); ?>
    </div>
</div><?php $mabilis_ttl=1357399234; $mabilis_last_modified=1355836317; ///var/www/imagecms.loc/templates/commerce/shop/default/start_page.tpl ?>