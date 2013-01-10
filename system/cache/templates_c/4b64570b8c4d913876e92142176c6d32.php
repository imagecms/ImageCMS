<?php # Variables
# @var model
# @var editProductUrl
# @var jsCode
#?>

<?php if(isset($jsCode)){ echo $jsCode; } ?>

<?php $forCompareProducts = $CI->session->userdata('shopForCompare')?>
<?php $cart_data= ShopCore::app()->SCart->getData();?>

<script type="text/javascript">
    var currentProductId = '<?php echo $model->getId()?>';
</script>

<link rel="stylesheet" href="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.6" type="text/css" media="screen" />
<script type="text/javascript" src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.6"></script>

<div class="content">   
    <div class="center">
        <div class="tovar_frame clearfix<?php if($model->firstvariant->getstock()== 0): ?> not_avail<?php endif; ?>">
            <div class="left-tovar_frame">
                <div class="thumb_frame f_l">
                    <?php if(sizeof($model->getSProductImagess()) > 0): ?>
                        <?php $i = 1?>
                        <?php if(is_true_array($model->getSProductImagess())){ foreach ($model->getSProductImagess() as $image){ ?>
                            <span>
                                <a class="grouped_elements fancybox-thumb" rel="fancybox-thumb" href="<?php echo $image->getThumbUrl()?>" data-title-id="fancyboxAdditionalContent">                         
                                    <img src="<?php echo $image->getThumbUrl()?>" width="90" alt="<?php echo ShopCore::encode($model->getName())?> - <?php echo $i?>"/>
                                </a>                                
                            </span>
                            <?php $i++?>
                        <?php }} ?>
                    <?php endif; ?>                
                </div>
                <div class="photo_block">
                    <a class="grouped_elements fancybox-thumb" rel="fancybox-thumb" href="<?php echo productImageUrl ($model->getMainImage()); ?>" data-title-id="fancyboxAdditionalContent" >
                        <img id="mim<?php echo $model->getId()?>" src="<?php echo productImageUrl ($model->getMainimage()); ?>" alt="<?php echo ShopCore::encode($model->getName())?> - <?php echo $model->getId()?>" />
                        <img id="vim<?php echo $model->getId()?>" class="smallpimagev" src="<?php echo productImageUrl ($model->getMainimage()); ?>" alt="<?php echo ShopCore::encode($model->getName())?> - <?php echo $model->getId()?>" />
                    </a>
                </div>
                <div class="star_rating">
                    <div id="star_rating_<?php echo $model->getId()?>" class="rating <?php echo count_star($model->getRating())?> star_rait" data-id="<?php echo $model->getId()?>">
                        <div id="1" class="rate one">
                            <span title="1" class="clickrate">1</span>
                        </div>
                        <div id="2" class="rate two">
                            <span title="2" class="clickrate">2</span>
                        </div>
                        <div id="3" class="rate three">
                            <span title="3" class="clickrate">3</span>
                        </div>
                        <div id="4" class="rate four">
                            <span title="4" class="clickrate">4</span>
                        </div>
                        <div id="5" class="rate five">
                            <span title="5" class="clickrate">5</span>
                        </div>
                    </div>
                </div>
                <span itemscope="" itemtype="http://data-vocabulary.org/Review-aggregate" id="pageRatingData"> 
                    &nbsp;&nbsp;Рейтинг товара <?php if($model->firstVariant->getNumber() != ''): ?>«<span itemprop="itemreviewed"><?php echo $model->firstvariant->getNumber()?></span>»<?php endif; ?> 
                    <meta itemprop="rating" content="4"> оставило <span itemprop="count"><?php echo $model->getVotes()?></span> человек(а).
                </span>
                <div class="m-t_10"><?php echo $CI->load->module('share')->_make_share_form()?></div>
            </div>
            <?php $style = productInCartI($cart_data, $model->getId(), $model->firstVariant->getId(), $model->firstVariant->getStock())?>
            <!-- Fancybox additional blocks -->
            <div id="fancyboxAdditionalContent" style="display: none;">
                <div class="price f-s_26">
                    <span id="pricem76"><?php echo $model->firstVariant->getPrice()?></span>
                    <sub><?php echo $CS?></sub>
                </div>
                <?php if(count($model->getProductVariants())==1): ?>
                    <div class="in_cart"></div>
                    <div class="<?php echo str_replace('f_l', '',  $style['class'] ) ?> pfancy">
                        <span class="fancybuy <?php echo  $style['identif']  ?> bfancy" data-id="<?php echo $model->getId()?>"><?php echo  $style['message']  ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Fancybox additional blocks -->

            <div class="func_description">
                <div class="crumbs">
                    <?php echo renderCategoryPath ($model->getMainCategory()); ?>
                </div>
                    <h1 class="d_i"><?php echo ShopCore::encode($model->getName())?></h1>&nbsp;&nbsp;&nbsp;
                <?php if($model->firstVariant->getNumber() != ''): ?><span class="code">Код:<?php echo $model->firstVariant->getNumber()?></span><?php endif; ?>
                <div>
                    <div class="price f-s_26 d-i_b v-a_m">
                        <?php if($model->getOldPrice() > 0): ?>
                            <?php if($model->getOldPrice() > $model->firstVariant->toCurrency()): ?>
                                <span>
                                    <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                        <?php echo $model->getOldPrice()?>
                                        <sub> <?php if(isset($CS)){ echo $CS; } ?></sub>
                                    </del>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <span id="pricem<?php echo $model->getId()?>">   
                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                <?php $prOne = $model->firstVariant->getPrice()?>
                                <?php $prTwo = $model->firstVariant->getPrice()?>
                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                <del class="price price-c_red f-s_12 price-c_9"><?php echo $model->firstVariant->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></del> 
                            <?php else:?>
                                <?php $prThree = $model->firstVariant->getPrice()?>
                            <?php endif; ?>
                            <?php echo money_format('%i',$prThree)?><sub> <?php if(isset($CS)){ echo $CS; } ?></sub>
                        </span>
                    </div>
                </div>

                <div class="buy clearfix">
                    <?php if(count($model->getProductVariants()) > 1): ?>
                        Выбор варианта:</br>
                        <?php if(is_true_array($model->getProductVariants())){ foreach ($model->getProductVariants() as $key => $pv){ ?>
                            <input type="radio" class="selectVar" id="sVar<?php echo $pv->getId()?>" name="selectVar" <?php if($model->firstVariant->getId() == $pv->getId()): ?>checked="checked"<?php endif; ?>
                                   value="<?php echo $pv->getId()?>" 
                                   data-pp="1" 
                                   data-cs = "<?php if(isset($CS)){ echo $CS; } ?>"
                                   data-st="<?php echo $pv->getStock()?>" 
                                   data-pr="<?php echo $pv->getPrice()?>" 
                                   data-pid="<?php echo $model->getId()?>" 
                                   data-img="<?php echo $pv->getmainimage()?>" 
                                   data-vname="<?php echo $pv->getName()?>" 
                                   data-vnumber="<?php echo $pv->getNumber()?>"/>
                            <label for="sVar<?php echo $pv->getId()?>">
                                <?php if($pv->getName() != ''): ?>
                                    <i><?php echo $pv->getName()?></i><b>: <?php echo $pv->getPrice()?></b> <?php if(isset($CS)){ echo $CS; } ?>
                                <?php else:?>
                                    <i><?php echo $model->getName()?></i><b>: <?php echo $pv->getPrice()?></b> <?php if(isset($CS)){ echo $CS; } ?>
                                <?php endif; ?>
                            </label></br>
                        <?php }} ?>
                    <?php endif; ?>
                    <div class="in_cart">
                        <?php if($style['identif']  == "goToCart"): ?>
                            Уже в корзине
                        <?php endif; ?>
                    </div>
                    <div id="p<?php echo $model->getId()?>" class="<?php echo $style['class']; ?>">
                        <a id="buy<?php echo $model->getId()?>" class="<?php echo $style['identif']; ?>" href="<?php echo $style['link']; ?>" data-varid="<?php echo $model->firstVariant->getId()?>" data-prodid="<?php echo $model->getId()?>" ><?php echo $style['message']; ?></a>
                    </div>
                    <span class="v-a_m">
                        <span data-prodid="<?php echo $model->id?>" class="m-r_20 compare
                              <?php if($forCompareProducts && in_array($model->getId(), $forCompareProducts)): ?>
                                  is_avail">
                                  <a href="<?php echo shop_url ('compare'); ?>" class="red"><?php echo lang ('s_compare'); ?></a>
                              <?php else:?>
                                  toCompare blue">
                                  <span class="js blue"><?php echo lang ('s_compare_add'); ?></span>
                                  <a href="<?php echo shop_url ('compare'); ?>" class="red" style="display: none;"><?php echo lang ('s_compare'); ?></a>
                              <?php endif; ?>
                        </span>

                        <span class="frame_wish-list">
                            <?php if(!is_in_wish($model->getId())): ?>
                                <span data-logged_in="<?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>true<?php endif; ?>" 
                                      data-varid="<?php echo $model->firstVariant->getId()?>" 
                                      data-prodid="<?php echo $model->getId()?>" 
                                      class="addToWList">
                                    <span class="icon-wish"></span>
                                    <span class="js blue"><?php echo lang ('s_slw'); ?></span>
                                </span>
                                <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span><?php echo lang ('s_ilw'); ?></a>
                            <?php else:?>
                                <a href="/shop/wish_list" class="red"><span class="icon-wish"></span><?php echo lang ('s_ilw'); ?></a>
                            <?php endif; ?>
                        </span>
                </div>
                <?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>
                    <?php if(!is_in_spy(ShopCore::$ci->dx_auth->get_user_id(), $model->getId())): ?>
                        <span data-logged_in="<?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>true<?php endif; ?>" 
                              data-price="<?php echo $model->firstVariant->toCurrency()?>" 
                              data-user_id="<?php echo ShopCore::$ci->dx_auth->get_user_id()?>" 
                              data-varid="<?php echo $model->firstVariant->getId()?>" 
                              data-prodid="<?php echo $model->getId()?>" 
                              class="js gray addtoSpy">
                            <?php echo lang ('s_sle_product'); ?>
                        </span>
                    <?php else:?>
                        <span data-user_id="<?php echo ShopCore::$ci->dx_auth->get_user_id()?>" 
                              data-varid="<?php echo $model->firstVariant->getId()?>" 
                              data-prodid="<?php echo $model->getId()?>" 
                              class="deleteFromSpy js gray">
                            <?php echo lang ('s_sle_product_alerady'); ?>
                        </span>
                    <?php endif; ?>
                    </span>
                <?php endif; ?>
                <?php if($model->getShortDescription() != ''): ?>
                    <p class="c_b"><?php echo $model->getShortDescription()?></p>
                <?php endif; ?>
                <div>
                    <?php echo $CI->load->module('share')->_make_like_buttons()?>
                </div>
                <ul class="info_buy one_item">
                    <li>
                        <img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/order_phone.png" class="phone_product"/>
                        <div>
                            <div class="title"><?php echo lang ('s_zaka_phone'); ?>:</div>
                            <span>(093)<span class="d_n">&minus;</span> 000-20-00,  (093)<span class="d_n">&minus;</span> 000-08-00,   (093)<span class="d_n">&minus;</span> 000-40-00</span>
                        </div>
                    </li>
                </ul>
                <ul class="info_buy two_item">
                    <li>
                        <img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/buy.png">
                        <div>
                            <div class="title"><?php echo lang ('s_pay'); ?> <span><a href="/oplata"><?php echo lang ('s_all_infor_b'); ?></a></span></div>
                            <?php if(is_true_array($payment_methods)){ foreach ($payment_methods as $methods){ ?>
                                <span class="small_marker"><?php echo  $methods['name']  ?></span>
                            <?php }} ?>
                        </div>
                    </li>
                    <li>
                        <img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/deliver.png">
                        <div>
                            <div class="title"><?php echo lang ('s_delivery1'); ?> <span><a href="/dostavka"><?php echo lang ('s_all_infor_b'); ?></a></span></div>
                            <?php if(is_true_array($delivery_methods)){ foreach ($delivery_methods as $methods){ ?>
                                <span class="small_marker"><?php echo  $methods['name']  ?></span>
                            <?php }} ?>
                        </div>
                    </li>
                </ul>
                <div class="tabs info_tovar">
                    <ul class="nav_tabs">
                        <?php if($model->getFullDescription()): ?>
                            <li><a href="#first"><?php echo lang ('s_information'); ?></a></li>
                        <?php endif; ?>
                        <?php if(ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)): ?>
                            <li><a href="#second"><?php echo lang ('s_properties'); ?></a></li>
                        <?php endif; ?>
                        <?php if($model->getRelatedProductsModels()): ?>
                            <li><a href="#third"><?php echo lang ('s_accessories'); ?></a></li>
                        <?php endif; ?>
                        <li>
                            <a href="#four">
                                <?php echo SStringHelper::Pluralize($data['total_comments'], array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))?>(<?php echo $data['total_comments']?>)
                            </a>
                        </li>
                    </ul>
                    <?php if($model->getFullDescription()): ?>
                        <div id="first">
                            <div class="info_text">
                                <?php echo $model->getFullDescription()?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)): ?>
                        <div id="second">
                            <?php echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)?>
                        </div>
                    <?php endif; ?>
                    <?php if($model->getRelatedProductsModels()): ?>
                        <div id="third">
                            <ul class="accessories f-s_0">
                                <?php if(is_true_array($model->getRelatedProductsModels())){ foreach ($model->getRelatedProductsModels() as $p){ ?>
                                    <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($p->id)?>
                                    <?php $rel_prod = currency_convert($p->firstvariant->getPrice(), $p->firstvariant->getCurrency())?>
                                    <?php $style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())?>
                                    <li>
                                        <div class="small_item">
                                            <a class="img" href="<?php echo shop_url ('product/' . $p->getUrl()); ?>">
                                                <span><img src="<?php echo productImageUrl ($p->getSmallModImage()); ?>" /></span>
                                            </a>
                                            <div class="info">
                                                <a href="<?php echo shop_url ('product/'.$p->getUrl()); ?>" class="title"><?php echo ShopCore::encode($p->getName())?></a>
                                                <div class="buy">
                                                    <div class="price f-s_16 f_l">

                                                        <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                            <?php $prOne = $p->firstvariant->getPrice()?>
                                                            <?php $prTwo = $p->firstvariant->getPrice()?>
                                                            <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                            <del class="price price-c_red f-s_12 price-c_9"><?php echo $p->firstvariant->getPrice()?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                                        <?php else:?>
                                                            <?php $prThree = $p->firstvariant->getPrice()?>
                                                        <?php endif; ?>
                                                        <?php echo $prThree?> 
                                                        <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                                    </div>
                                                    <div class="<?php echo $style['class']; ?> buttons"><a class="<?php echo $style['identif']; ?>" href="<?php echo $style['link']; ?>" data-varid="<?php echo $p->firstVariant->getId()?>" data-prodid="<?php echo $p->getId()?>" ><?php echo $style['message']; ?></a></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }} ?>    
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div id="four">
                        <a name="four"></a>
                        <?php if(isset($comments)){ echo $comments; } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if($model->getShopKits()->count() > 0): ?>
            <div class="f-s_18 c_6 center"><?php echo lang ('s_spec_promotion'); ?></div>
            <div class="promotion carusel_frame carousel_js">
                <div class="carusel">
                    <ul class="">
                        <?php if(is_true_array($model->getShopKits())){ foreach ($model->getShopKits() as $kid){ ?>
                            <li>
                                <div class="f_l smallest_item">
                                    <div class="photo_block">
                                        <a href="<?php echo shop_url ('product/' . $kid->getMainProduct()->getUrl()); ?>" class="photo_block">
                                            <figure>
                                                <img src="<?php echo productImageUrl ($kid->getMainProduct()->getSmallModImage()); ?>"/>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="func_description">
                                        <a href="<?php echo shop_url ('product/' . $kid->getMainProduct()->getUrl()); ?>"><?php echo ShopCore::encode($kid->getMainProduct()->getName())?></a>
                                        <div class="buy">
                                            <div class="price f-s_16 f_l"><?php echo  $prices['main']['price']  ?>
                                                <sub><?php echo  $prices['main']['symbol']  ?></sub>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $summa =  $prices['main']['price']  ?>
                                <?php $summa_with_discount =  $prices['main']['price']  ?>
                                <div class="plus_eval">+</div>
                                <?php $i = 1?>
                                <?php if(is_true_array($kid->getShopKitProducts())){ foreach ($kid->getShopKitProducts() as $coompl){ ?>
                                    <?php $ap = $coompl->getSProducts()?>
                                    <?php $kp = currency_convert($ap->getFirstVariant()->getPrice(), $ap->getFirstVariant()->getCurrency())?>
                                    <div class="f_l smallest_item">                                        
                                        <div class="photo_block">
                                            <a href="<?php echo shop_url ('product/' . $ap->getUrl()); ?>">
                                                <figure>
                                                    <img src="<?php echo productImageUrl ($ap->getSmallModImage()); ?>"/>
                                                </figure>                                        
                                            </a>
                                        </div>
                                        <div class="func_description">
                                            <a href="<?php echo shop_url ('product/' . $ap->getUrl()); ?>"><?php echo ShopCore::encode($ap->getName())?></a>
                                            <?php if($coompl->getDiscount() != 0): ?>
                                                <del class="d_b price-f-s_12 price-c_red">
                                                    <span ><?php echo  $kp['main']['price']  ?> <sub><?php echo $kp['main']['symbol']; ?></sub</span>
                                                </del>
                                            <?php endif; ?>
                                            <div class="buy">
                                                <div class="price f-s_16 f_l">
                                                    <span><?php echo number_format( $kp['main']['price'] *(1 - $coompl->getdiscount()/100), 2, '.', '') ?> <sub><?php echo $kp['main']['symbol']; ?></sub></span>
                                                </div>
                                            </div>                                        
                                        </div> 
                                    </div>
                                    <?php if($i == count($kid->getShopKitProducts())): ?>
                                        <div class="plus_eval"><div>=</div></div>
                                    <?php else:?>
                                        <div class="plus_eval">+</div>
                                    <?php endif; ?>
                                    <?php $i++?>
                                    <?php $summa +=  $kp['main']['price']  ?>
                                    <?php $summa_with_discount += number_format( $kp['main']['price'] *(1 - $coompl->getdiscount()/100), 2, '.', '') ?>
                                <?php }} ?>
                                <div class="button_block ">
                                    <div class="buy">
                                        <del class="price f-s_12 price-c_9">
                                            <span><?php echo $summa?> <span><?php if(isset($CS)){ echo $CS; } ?></span>
                                            </span>
                                        </del>
                                        <div class="price f-s_18">
                                            <span><?php echo $summa_with_discount?> <?php if(isset($CS)){ echo $CS; } ?></span>
                                        </div>
                                        <?php $inCart = ShopCore::app()->SCart->getData()?>
                                        <?php $prod_in_cart = false?>
                                        <?php if(is_true_array($inCart)){ foreach ($inCart as $Cart){ ?>
                                            <?php if($Cart[kitId] == $kid->getId()): ?>
                                                <?php $prod_in_cart = true?>
                                            <?php endif; ?>
                                        <?php }} ?>
                                        <div class="buttons <?php if($prod_in_cart): ?>button_middle_blue<?php else:?>button_gs<?php endif; ?>">
                                            <div class="buy"> 
                                                <?php if(!$prod_in_cart): ?>                                       
                                                    <span data-id="<?php echo $kid->getId()?>" class="add_cart_kid" id="kitBuy"><?php echo lang ('s_buy'); ?></span>
                                                <?php else:?>
                                                    <span class="goToCart">Оформить</br> заказ</span>
                                                <?php endif; ?>
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
            </div>
        <?php endif; ?>   

        <?php if(count(getSimilarProduct($model)) > 1): ?>
            <div class="featured carusel_frame carousel_js">
                <div class="f-s_18 c_6 center"><?php echo lang ('s_similar_product'); ?></div>
                <div class="carusel">
                    <ul>
                        <?php $simprod = getSimilarProduct($model)?>
                        <?php if(is_true_array($simprod)){ foreach ($simprod as $sp){ ?>
                            <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($sp['ProductId'])?>
                            <?php $sim_prod = currency_convert($sp['price'], $sp['currency'])?>
                            <?php $style = productInCart($cart_data, $sp['ProductId'], $sp['ProductId'], $sp['stock'])?>
                            <li>
                                <div class="smallest_item <?php if($sp['stock']==0): ?>not_avail<?php endif; ?>">
                                    <div class="photo_block">
                                        <a href="<?php echo site_url ('shop/product/'.$sp['url']); ?>">
                                            <img src="<?php echo productImageUrl ($sp['smallModImage']); ?>"/>
                                        </a>
                                    </div>
                                    <div class="func_description">
                                        <a href="<?php echo site_url ('shop/product/'.$sp['url']); ?>" class="title"><?php echo ShopCore::encode($sp['name'])?></a>
                                        <div class="buy">
                                            <div class="price f-s_14">
                                                <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                    <?php $prOne =  $sim_prod['main']['price']  ?>
                                                    <?php $prTwo =  $sim_prod['main']['price']  ?>
                                                    <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                    <del class="price price-c_red f-s_12 price-c_9"><?php echo money_format('%i',  $sim_prod['main']['price'] ) ?> <?php echo $sim_prod['main']['symbol']; ?></del><br /> 
                                                <?php else:?>
                                                    <?php $prThree =  $sim_prod['main']['price']  ?>
                                                <?php endif; ?>

                                                <?php echo money_format('%i', $prThree)?>
                                                <sub><?php echo $sim_prod['main']['symbol']; ?></sub>

                                                <?php if($NextCS != $CS AND empty($discount)): ?>
                                                    <span><?php echo money_format('%i',  $sim_prod['second']['price'] ) ?> <?php echo $sim_prod['second']['symbol']; ?></span> 
                                                <?php endif; ?>

                                            </div>                                                                             
                                            <div class="<?php echo $style['class']; ?> buttons">                                            
                                                <a class="<?php echo  $style['identif']  ?>" href="<?php echo $style['link']; ?>" data-varid="<?php echo $sp['VariandId']; ?>"  data-prodid="<?php echo $sp['ProductId']?>" ><?php echo $style['message']; ?></a>
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
            </div>
        <?php endif; ?> 
        <div class="m-t_29 featured">
            <?php if(count(getPromoBlock('hot', 3))>0): ?>
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
            <?php echo widget ('latest_news'); ?>
        </div>
    </div>
</div>
<?php $mabilis_ttl=1357909944; $mabilis_last_modified=1357825281; //C:\wamp\www\imagecms.loc\templates\commerce\shop\default/product.tpl ?>