<?php # Variables
# @var model
# @var jsCode
# @var products
# @var totalProducts
# @var brandsInCategory
# @var pagination
# @var cart_data
#?>

<?php $forCompareProducts = $CI->session->userdata('shopForCompare')?>
<div class="content">
    <div class="center">
        <?php $this->include_tpl('filter', '/var/www/imagecms.loc/templates/commerce/shop/default'); ?>
        <div class="catalog_content">
            <!--   Right sidebar     -->
            <div class="nowelty_auction">
                <!--   New products block     -->
                <?php if(count(getPromoBlock('hot', 3, $product->category_id))): ?>
                    <div class="box_title">
                        <span><?php echo lang ('s_new'); ?></span>
                    </div>
                    <ul>
                        <?php $result = getPromoBlock('hot', 3, $product->category_id); 
 if(is_true_array($result)){ foreach ($result as $hotProduct){ ?>
                            <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)?>
                            <li class="smallest_item">
                                <div class="photo_block">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>">
                                        <img src="<?php echo productImageUrl ($hotProduct->getSmallModimage()); ?>" alt="<?php echo ShopCore::encode($hotProduct->getName())?> - <?php echo $hotProduct->getId()?>" />
                                    </a>
                                </div>
                                <div class="func_description">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="title"><?php echo ShopCore::encode($hotProduct->getName())?></a>
                                    <div class="buy">
                                        <div class="price f-s_14">
                                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                <?php $prOne = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prTwo = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                <del class="price price-c_red f-s_12 price-c_9"><?php echo number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                            <?php else:?>
                                                <div class="price f-s_14"><?php $prThree = number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")?>
                                                <?php endif; ?>
                                                <?php echo number_format($prThree, 2, ".", "")?> 
                                                <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                            </div>
                                        </div>
                                    </div>
                            </li>
                        <?php }} ?>
                    </ul>
                <?php endif; ?>
                <!--   New products block     -->

                <!--   Promo products block     -->
                <?php if(count(getPromoBlock('action', 3, $product->category_id))): ?>
                    <div class="box_title">
                        <span><?php echo lang ('s_action'); ?></span>
                    </div>
                    <ul>
                        <?php $result = getPromoBlock('action', 3, $product->category_id); 
 if(is_true_array($result)){ foreach ($result as $hotProduct){ ?>
                            <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)?>
                            <li class="smallest_item">
                                <div class="photo_block">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>">
                                        <img src="<?php echo productImageUrl ($hotProduct->getSmallModImage()); ?>" alt="<?php echo ShopCore::encode($hotProduct->getName())?> - <?php echo $hotProduct->getId()?>" />
                                    </a>
                                </div>
                                <div class="func_description">
                                    <a href="<?php echo shop_url ('product/' . $hotProduct->getUrl()); ?>" class="title"><?php echo ShopCore::encode($hotProduct->getName())?></a>
                                    <div class="buy">
                                        <div class="price f-s_14">
                                            <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                                <?php $prOne = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prTwo = $hotProduct->firstVariant->getPrice()?>
                                                <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                                <del class="price price-c_red f-s_12 price-c_9"><?php echo number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")?> <?php if(isset($CS)){ echo $CS; } ?></del><br /> 
                                            <?php else:?>
                                                <div class="price f-s_14"><?php $prThree = number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")?>
                                                <?php endif; ?>
                                                <?php echo number_format($prThree, 2, ".", "")?> 
                                                <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                            </div>
                                        </div>
                                    </div>
                            </li>
                        <?php }} ?>
                    </ul>
                <?php endif; ?>
                <!--   Promo products block     -->
                <?php echo widget ('latest_news'); ?>
            </div>
            <!--   Right sidebar     -->
            <div class="catalog_frame">
                <div class="crumbs"><?php echo $crumbs?></div>
                <div class="box_title clearfix">
                    <div class="f-s_24">
                        <?php echo ShopCore::encode($model->name)?>
                        <span class="count_search">(<?php if(isset($totalProducts)){ echo $totalProducts; } ?>)</span>
                    </div>
                </div>
                <form method="GET">
                    <div class="f_l">
                        <span class="v-a_m">Сортировать:&nbsp;</span>
                        <div class="lineForm w_145 v-a_m">
                            <select id="sort" name="order">
                                <option value="" <?php if(!ShopCore::$_GET['order']): ?>selected="selected"<?php endif; ?>>-Нет-</option>
                                <option value="rating" <?php if(ShopCore::$_GET['order']=='rating'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_po'); ?> <?php echo lang ('s_rating'); ?></option>
                                <option value="price" <?php if(ShopCore::$_GET['order']=='price'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_dewevye'); ?></option>
                                <option value="price_desc" <?php if(ShopCore::$_GET['order']=='price_desc'): ?>selected="selected"<?php endif; ?> ><?php echo lang ('s_dor'); ?></option>
                                <option value="hit" <?php if(ShopCore::$_GET['order']=='hit'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_popular'); ?></option>
                                <option value="hot" <?php if(ShopCore::$_GET['order']=='hot'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_new'); ?></option>
                                <option value="action" <?php if(ShopCore::$_GET['order']=='action'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_action'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="f_r">
                        <span class="v-a_m">Товаров на странице:&nbsp;</span>
                        <div class="lineForm w_50 v-a_m">
                            <select id="count" name="user_per_page">
                                <option value="12" <?php if(ShopCore::$_GET['user_per_page']=='12'): ?>selected="selected"<?php endif; ?> >12</option>
                                <option value="24" <?php if(ShopCore::$_GET['user_per_page']=='24'): ?>selected="selected"<?php endif; ?> >24</option>
                                <option value="36" <?php if(ShopCore::$_GET['user_per_page']=='36'): ?>selected="selected"<?php endif; ?> >36</option>
                            </select>
                        </div>
                    </div>
                <?php if(isset($_GET['lp'])): ?><input type="hidden" name="lp" value="<?php echo $_GET['lp']?>"><?php endif; ?>
            <?php if(isset($_GET['rp'])): ?><input type="hidden" name="rp" value="<?php echo $_GET['rp']?>"><?php endif; ?>
        </form>
        <ul>            
            <?php if((int)$pageNumber == 1): ?>
                <?php if(trim($model->description)): ?>
                    <li>
                        <div class="box_title">
                            <span class="f-s_18">Описание</span>
                        </div>
                        <?php echo $model->description?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <!--  Render produts list   -->
            <?php if(is_true_array($products)){ foreach ($products as $product){ ?>
                <?php $style = productInCart($cart_data, (int)$product->id, (int)$product->variants[0]->id, (int)$product->variants[0]->stock)?>
                <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)?>
                <li <?php if($product->variants[0]->stock == 0): ?>class="not_avail"<?php endif; ?>>
                    <div class="photo_block">
                        <a href="<?php echo shop_url ('product/' . $product->url); ?>">
                            <img id="mim<?php echo $product->id?>" src="<?php echo productImageUrl ($product->mainModImage); ?>" alt="<?php echo ShopCore::encode($product->name)?> - <?php echo $product->id?>" />
                            <img id="vim<?php echo $product->id?>" class="smallpimagev" src="" alt="" />
                            <?php if($product->hot == 1): ?>
                                <div class="promoblock nowelty"><?php echo lang ('s_shot'); ?></div>
                            <?php endif; ?>
                            <?php if($product->action == 1): ?>
                                <div class="promoblock action"><?php echo lang ('s_saction'); ?></div>
                            <?php endif; ?>
                            
                            <?php if($product->hit == 1): ?>
                                <div class="promoblock hit"><?php echo lang ('s_s_hit'); ?></div>
                            <?php endif; ?>
                                <?php $discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)?>
                        </a>
                        <span class="ajax_refer_marg t-a_c">
                            <span data-prodid="<?php echo $product->id?>" class="compare
                                  <?php if($forCompareProducts && in_array($product->id, $forCompareProducts)): ?>
                                      is_avail">
                                      <a href="<?php echo shop_url ('compare'); ?>" class="red"><?php echo lang ('s_compare'); ?></a>
                                  <?php else:?>
                                      toCompare blue">
                                      <span class="js blue"><?php echo lang ('s_compare_add'); ?></span>
                                      <a href="<?php echo shop_url ('compare'); ?>" class="red" style="display: none;"><?php echo lang ('s_compare'); ?></a>
                                  <?php endif; ?>
                            </span>
                        </span>
                    </div>
                    <div class="func_description">
                        <a href="<?php echo shop_url ('product/' . $product->url); ?>" class="title"><?php echo ShopCore::encode($product->name)?></a>
                        <div class="f-s_0">
                            <?php if($product->variants[0]->number): ?>
                                <span id="code<?php echo $product->id?>" class="code">
                                    <?php echo lang ('s_kod'); ?> <?php echo ShopCore::encode($product->variants[0]->number)?>
                                </span>
                            <?php endif; ?>
                            <div>
                                <div class="star_rating">
                                    <div id="<?php echo $model->id?>_star_rating" class="rating_nohover <?php echo count_star(countRating($product->id))?> star_rait" data-id="<?php echo $model->id?>">
                                        <div id="1" class="rate one">
                                            <span title="1">1</span>
                                        </div>
                                        <div id="2" class="rate two">
                                            <span title="2">2</span>
                                        </div>
                                        <div id="3" class="rate three">
                                            <span title="3">3</span>
                                        </div>
                                        <div id="4" class="rate four">
                                            <span title="4">4</span>
                                        </div>
                                        <div id="5" class="rate five">
                                            <span title="5">5</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo shop_url ('product/'.$product->id.'#four'); ?>" rel="nofollow" class="response">
                                    <?php echo totalComments ($product->id); ?>
                                    <?php echo SStringHelper::Pluralize((int)totalComments($product->id), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))?>
                                </a>
                                <?php if(count($product->variants)>1): ?>
                                    <select class="m-l_10" name="selectVar">
                                        <?php if(is_true_array($product->variants)){ foreach ($product->variants as $pv){ ?>
                                            <option class="selectVar"
                                                    value="<?php echo $pv->id?>"
                                                    data-cs = "<?php if(isset($CS)){ echo $CS; } ?>"
                                                    data-st="<?php echo $pv->stock?>"
                                                    data-pr="<?php echo number_format($pv->price, 2 , ".", "")?>"
                                                    data-pid="<?php echo $product->id?>"
                                                    data-img="<?php echo $pv->smallimage?>"
                                                    data-vname="<?php echo $pv->name?>"
                                                    data-vnumber="<?php echo $pv->number?>">
                                                <?php if($pv->name != ''): ?>
                                                    <?php echo $pv->name?>
                                                <?php else:?>
                                                    <?php echo $product->name?>
                                                <?php endif; ?>
                                            </option>
                                        <?php }} ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="buy">
                            <div class="price f-s_18 d_b">
                                <?php if((float)$product->old_price > 0): ?>
                                    <?php if($product->old_price > $product->price): ?>
                                        <div>
                                            <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                                <?php echo number_format($product->old_price, 2, ".", "")?>
                                                <sub> <?php if(isset($CS)){ echo $CS; } ?></sub>
                                            </del>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div id="pricem<?php echo $product->id?>">
                                    <?php if($discount AND ShopCore::$ci->dx_auth->is_logged_in() === true): ?>
                                        <?php $prOne = $product->variants[0]->price?>
                                        <?php $prTwo = $product->variants[0]->price?>
                                        <?php $prThree = $prOne - $prTwo / 100 * $discount?>
                                        <del class="price price-c_red f-s_12 price-c_9"><?php echo number_format($product->variants[0]->price, 2, ".", "")?> <?php if(isset($CS)){ echo $CS; } ?></del>
                                    <?php else:?>
                                        <?php $prThree = $product->variants[0]->price?>
                                    <?php endif; ?>
                                    <?php echo number_format($prThree, 2, ".", "")?> 
                                    <sub><?php if(isset($CS)){ echo $CS; } ?></sub>
                                </div>
                            </div>
                            <div id="p<?php echo $product->id?>" class="<?php echo $style['class']; ?> buttons">
                                <span id="buy<?php echo $product->id?>"
                                      class="<?php echo $style['identif']; ?>"
                                      data-varid="<?php echo $product->variants[0]->id?>"
                                      data-prodid="<?php echo $product->id?>">
                                    <?php echo $style['message']; ?>
                                </span>
                            </div>
                            <span class="frame_wish-list">
                                <?php if(!is_in_wish($product->id)): ?>
                                    <span data-logged_in="<?php if(ShopCore::$ci->dx_auth->is_logged_in()===true): ?>true<?php endif; ?>"
                                          data-varid="<?php echo $product->variants[0]->id?>"
                                          data-prodid="<?php echo $product->id?>"
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

                        <?php if(ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->id)): ?>
                            <p class="c_b">
                                <?php echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->id)?>
                                &nbsp;&nbsp;<a href="<?php echo shop_url ('product/' . $product->url); ?>" class="t-d_n"><span class="t-d_u"><?php echo lang ('s_more'); ?></span> →</a>
                            </p>
                        <?php endif; ?>
                    </div>
                </li>
            <?php }} ?>
        </ul>
        <div class="pagination">
            <div class="t-a_c"><?php if(isset($pagination)){ echo $pagination; } ?></div>
        </div>
    </div>
    <!--   Right sidebar     -->
</div>
</div>
</div>
        
<?php $mabilis_ttl=1357399731; $mabilis_last_modified=1357310744; ///var/www/imagecms.loc/templates/commerce/shop/default/category.tpl ?>